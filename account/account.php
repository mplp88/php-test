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
  $query = 'INSERT INTO`usuarios` ';
  $query = '(email, password) ';
  $query = 'VALUES (';
  $query = $usuario->email . ',';
  $query = 'PASSWORD('.$usuario->password . ')';
  $query = ')';
  
  executeQuery($query);
}

function executeQuery($query) {
  global $db;
  $db->connect();
  $result = $db->executeQuery($query);
  $db->close();
  return $db->getResultSet();
}
?>