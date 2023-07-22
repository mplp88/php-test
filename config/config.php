<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/database.php');
$db = DatabaseContext::getInstance();
include('Configuracion.php');

function insertOrUpdate($configuracion) {
  $sql = 'SELECT `theme` FROM `configuracion`';
  $sql .= 'WHERE `usuarioId` = ' . $configuracion->getUsuarioId();
  
  $result = executeQuery($sql);

  if($result->num_rows == 0) {
    $sql = 'INSERT INTO `configuracion` ';
    $sql .= '(`theme`, `usuarioId`) ';
    $sql .= 'VALUES ';
    $sql .= '(\'' . $configuracion->getTheme() . '\', ' . $configuracion->getUsuarioId() . ');';
  } else {
    $sql = 'UPDATE `configuracion` ';
    $sql .= 'SET `theme` = \'' . $configuracion->getTheme() . '\' ';
    $sql .= 'WHERE `usuarioId` = ' . $configuracion->getUsuarioId() . ';';
  }

  executeQuery($sql);
}

function getTheme($usuarioId) {
  $theme = 'default';
  
  $sql = 'SELECT `theme` FROM `configuracion` ';
  $sql .= 'WHERE `usuarioId` = ' . $usuarioId;

  $result = executeQuery($sql);

  if($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc())
    {
      $theme = ($fila['theme']);
    }
  }

  return $theme;
}
?>