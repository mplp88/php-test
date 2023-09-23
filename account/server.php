<?php
session_start();
include('account.php');
$redirect = '';

$acc;
if(isset($_POST["acc"])){
  $acc = $_POST["acc"];
} else {
  $_SESSION['errorMessage'] = 'Error de transmision de datos';
  header("Location: index.php");
}

switch($acc) {
  case 'login':
    $email = $_POST['email'];
    $password = $_POST['password'];
    $returnUrl = $_POST['returnUrl'];
    $usuario = login($email, $password);

    if(!is_null($usuario->getId())) {
      $_SESSION['usuario'] = serialize($usuario);
      setcookie('sesion', $usuario->getId());
      $redirect .= '/' . $returnUrl;
    } else {
      $_SESSION['errorMessage'] = 'Email / Contraseña invalidos.';
      $redirect .= '/account/login.php';
    }
    break;
  case 'register':
    $continue = true;
    unset($_SESSION['email']);

    $email = $_POST['email']; //TODO: Validar que el email tenga formato correcto (Regex).
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];

    if($password != $repeatPassword) {
      $redirect .= '/account/register.php';
      $_SESSION['errorMessage'] = 'Las Contraseñas no coinciden.';
      $_SESSION['email'] = $email;
      $continue = false;
    }

    if($continue) {
      $usuario = new Usuario();
      $usuario->setEmail($email);
      $usuario->setPassword($password);
      register($usuario);
      $redirect = '/account/registerSuccessful.php';
    }
    break;
  case 'changePassword':
    $token = $_POST['token'];
    $password = $_POST['password'];
    $action = $_POST['action'];
    $redirect = '/account/changePassword.php';
    if($action == 'recover' && empty($token)) {
      $_SESSION['changePasswordError'] = 'Token inválido';
      break;
    }

    $success = changePassword($action, $password, $token);
    
    if ($success) {
      if($action == 'recover') {
        $message = 'El password se cambió correctamente.';
        $message .= ' <a href="/account/login.php">Click aquí para ingresar</a>';
        $_SESSION['changePasswordMessage'] = $message;
      } else {
        $redirect = '/account/profile.php';
      }
    }
    
    break;
  case 'recover':
    $email = $_POST['email'];
    generateRecoveryToken($email);
    $_SESSION['recoverMessage'] = "Si el email existe como usuario se enviará un link para recuperar su password.";
    $redirect = '/account/recover.php';
    break;
  case 'editProfile':
    $continue = true;
    $usuarioId = $_POST['usuarioId'];
    $email = $_POST['email']; //TODO: Validar que el email tenga formato correcto (Regex).
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    if(empty($email)) {
      $_SESSION['errorMessage'] = 'El email es obligatorio';
      $continue = false;
    }
    if($continue) {
      $usuario = new Usuario();

      $usuario->setId($usuarioId);
      $usuario->setEmail($email);
      $usuario->setNombre($nombre);
      $usuario->setApellido($apellido);

      edit($usuario);
      $_SESSION['usuario'] = serialize($usuario);
    }

    $redirect = '/account/profile.php';
    break;
  case 'dismissError':
    unset($_SESSION['errorMessage']);
    $referer = $_SERVER['HTTP_REFERER'];
    $temp = explode('/', $referer);
    $redirect .= '/'. $temp[count($temp) - 2] .'/' . $temp[count($temp) - 1];
    break;
  default:
    break;
}

header("Location: " . $redirect);
?>