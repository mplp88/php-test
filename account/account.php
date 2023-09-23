<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/database.php');
$db = DatabaseContext::getInstance();

include('Usuario.php');

function login($email, $password) {
  $query = 'SELECT * FROM `usuarios` WHERE ';
  $query .= '`email` LIKE \'%' . $email . '%\' ';
  $query .= 'AND `password` = PASSWORD(\'' . $password . '\')';

  $result = executeQuery($query);
  $usuario = new Usuario();

  if($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc()) {
      $usuario->setId($fila['id']);
      $usuario->setEmail($fila['email']);
      $usuario->setNombre($fila['nombre']);
      $usuario->setApellido($fila['apellido']);
    }
  }

  return $usuario;
}

function register($usuario) {
  $query = 'INSERT INTO `usuarios` ';
  $query .= '(`email`, `password`) ';
  $query .= 'VALUES (';
  $query .= '\''. $usuario->getEmail() . '\',';
  $query .= 'PASSWORD(\''.$usuario->getPassword() . '\')';
  $query .= ')';
  
  executeQuery($query);
}

function edit($usuario) {
  $query = 'UPDATE `usuarios` ';
  $query .= 'SET ';
  $query .= '`email` = \''. $usuario->getEmail() . '\', ';
  $query .= '`nombre` = \''. $usuario->getNombre() . '\', ';
  $query .= '`apellido` = \''. $usuario->getApellido() . '\' ';
  $query .= 'WHERE `id` = ' . $usuario->getId();
  
  executeQuery($query);
}

function generateRecoveryToken($email) {
  if(!checkEmail($email)) {
    return;
  }

  $token = generateToken();
  $expire = new DateTime(); 
  $expire->modify('+1 hour');

  $query = 'INSERT INTO `recoverytokens` ';
  $query .= '(email, token, expire) ';
  $query .= 'VALUES ';
  $query .= '(\''. $email . '\', \'' . $token . '\', \'' . $expire->format('Y-m-d H:i:s') . '\')';
  executeQuery($query);

  $_SESSION['token'] = $token;
  //sendEmail($email);
}

function generateToken() {
  $length = 32;
  $token = bin2hex(random_bytes($length));
  return $token;
}

function changePassword($action, $password, $token) {
  global $db;
  unset($_SESSION['changePasswordError']);
  unset($_SESSION['changePasswordMessage']);
  unset($_SESSION['recoverMessage']);
  unset($_SESSION['token']);

  if($action == 'recover') {
    $query = 'SELECT `email`, `expire` ';
    $query .= 'FROM `recoverytokens` ';
    $query .= 'WHERE `token` = \'' . $token . '\';';
    
    executeQuery($query);
    $result = $db->getResultSet();
    $email = '';
    $date = new DateTime();
    $expire = '';
    if($result->num_rows > 0) {
      while ($fila = $result->fetch_assoc()) {
        $email = $fila['email'];
        $expire = new DateTime($fila['expire']);
      }
    }
    
    if($expire < $date) {
      //Token expirado, devolver error
      $_SESSION['changePasswordError'] = 'El token expiró. Por favor solicite uno nuevo.';
      return false;
    }
  } else {
    $usuario = unserialize($_SESSION["usuario"]);
    $email = $usuario->getEmail();
  }

  $query = 'UPDATE `usuarios` ';
  $query .= 'SET `password` = PASSWORD(\''. $password . '\') ';
  $query .= 'WHERE `email` = \'' . $email . '\';';
  
  executeQuery($query);

  //Password cambiado de manera exitosa, devolver al login
  return true;
}

function checkEmail($email) {
  $query = 'SELECT id FROM `usuarios` WHERE ';
  $query .= '`email` LIKE \'%' . $email . '%\' ';

  $result = executeQuery($query);

  if($result->num_rows == 0) {
    return false;
  }

  return true;
}
?>