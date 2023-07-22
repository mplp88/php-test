<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/account/Usuario.php');
include('config.php');

$configuracion = new Configuracion();

$acc;
if(isset($_POST["acc"])){
  $acc = $_POST["acc"];
} else {
  $_SESSION['errorMessage'] = 'Error de transmision de datos';
  header("Location: index.php");
}

switch($acc) {
  case 'dismissError':
    unset($_SESSION['errorMessage']);
    break;
  case 'saveTheme':
    $theme = $_POST['theme'];
    $usuario = unserialize($_SESSION['usuario']);

    $configuracion->setUsuarioId($usuario->getId());
    $configuracion->setTheme($theme);
    insertOrUpdate($configuracion);
    break;
  default:
    break;
}

header("Location: index.php");
?>