<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/database.php');
$db = DatabaseContext::getInstance();

function insertOrUpdate($theme, $usuarioId) {
  $sql = 'SELECT `theme` FROM `configuracion`';
  $sql .= 'WHERE `usuarioId` = ' . $usuarioId;
  
  $result = executeQuery($sql);

  if($result->num_rows == 0) {
    $sql = 'INSERT INTO `configuracion` ';
    $sql .= '(`theme`, `usuarioId`) ';
    $sql .= 'VALUES ';
    $sql .= '(\'' . $theme . '\', ' . $usuarioId . ');';
  } else {
    $sql = 'UPDATE `configuracion` ';
    $sql .= 'SET `theme` = \'' . $theme . '\' ';
    $sql .= 'WHERE `usuarioId` = ' . $usuarioId . ';';
  }

  executeQuery($sql);
}

function getTheme($usuarioId) {
  $theme = 'default';
  
  $sql = 'SELECT `theme` FROM `configuracion` ';
  $sql .= 'WHERE usuarioId = ' . $usuarioId;

  $result = executeQuery($sql);

  if($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc())
    {
      $theme = ($fila['theme']);
    }
  }

  return $theme;
}

function executeQuery($query) {
  global $db;
  $db->connect();
  $result = $db->executeQuery($query);
  $db->close();
  return $db->getResultSet();
}
?>