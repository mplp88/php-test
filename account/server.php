<?php
session_start();
include('account.php');

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
    $usuario = login($email, $password);

    if(!is_null($usuario->getId())) {
      $_SESSION['usuario'] = serialize($usuario);
    } else {
      $_SESSION['errorMessage'] = 'Email / Contraseña invalidos';
    }
    break;
  case 'register':
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usuario = new Usuario();
    $usuario->setEmail($email);
    $usuario->setPassword($password);
    register($usuario);
    break;
  case 'changePassword':
    break;
  case 'recover':
    break;
  case 'dismissError':
    unset($_SESSION['errorMessage']);
    break;
  default:
    break;
}
        
header("Location: /");
?>