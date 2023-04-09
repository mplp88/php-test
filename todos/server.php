<?php
session_start();
include('todos.php');

$acc;
if(isset($_POST["acc"])){
  $acc = $_POST["acc"];
} else {
  $_SESSION['errorMessage'] = 'Error de transmision de datos';
  header("Location: index.php");
}

switch($acc) {
  case 'newTodo':
    $descripcion = $_POST['descripcion'];
    insertTodo($descripcion);
    break;
  case 'toggleChecked':
    $todoId = $_POST['todoId'];
    $checked = $_POST['checked'];

    // echo '<p>Toggling checked. Todo with Id ' . $todoId . ' is now ';
    // echo intval($checked) == 1 ? 'done' : 'undone';
    // echo '</p>';
    // echo '<br />';
    // echo '<button onclick="history.back()">Go Back</button>';
    // echo '<br />';
    updateTodo($todoId, '', $checked);
    break;
  case 'dismissError':
    unset($_SESSION['errorMessage']);
    break;
  default:
    break;
}

header("Location: index.php");
?>