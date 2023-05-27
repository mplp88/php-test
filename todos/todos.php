<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/database.php');

$db = DatabaseContext::getInstance();

function getAllTodos() {
  $sql = '';
  $sql .= 'SELECT `id`, `descripcion`, `hecho` ';
  $sql .= 'FROM `todos`';

  $result = executeQuery($sql);
  return $result;
}

function getTodoById($id) {
  $sql = '';
  $sql .= 'SELECT `id`, `descripcion`, `hecho` ';
  $sql .= 'FROM `todos`';
  $sql .= 'WHERE id = ' . $id;

  $result = executeQuery($sql);
  return $result;
}

function insertTodo($descripcion) {
  $sql = '';
  $sql .= 'INSERT INTO `todos` ';
  $sql .= '(`descripcion`) ';
  $sql .= 'VALUES ';
  $sql .= '(`' . $descripcion . '`);';

  $result = executeQuery($sql);
  return $result;
}

function updateTodo($id, $descripcion, $hecho) {
  $sql = '';
  $sql .= 'UPDATE `todos` SET ';
  //$sql .= 'descripcion = \'' . $descripcion . '\', ';
  $sql .= '`hecho` = '. $hecho . ' ';
  $sql .= 'WHERE `id` = ' . $id . ';';

  $result = executeQuery($sql);
  return $result;
}

function deleteTodo($id) {
  $sql = '';
  $sql .= 'DELETE FROM `todos`';
  $sql .= 'WHERE `id` = ' . $id .';';

  $result = executeQuery($sql);
  return $result;
}

function executeQuery($query) {
  global $db;
  $db->connect();
  $result = $db->executeQuery($query);
  $db->close();
  return $db->getResultSet();
}
?>