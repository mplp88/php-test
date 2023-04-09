<?php
session_start();

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
  case 'saveConfig':
    $theme = $_POST['theme'];
    $_SESSION['theme'] = $theme;
    break;
  default:
    break;
}

header("Location: index.php");
?>