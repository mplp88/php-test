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

    updateTodo($todoId, '', $checked);
    break;
  case 'dismissError':
    unset($_SESSION['errorMessage']);
    break;
  case 'updateTodo':
    $todoId = $_POST['todoId'];
    $descripcion = $_POST['descripcion'];
    $checked = '';
    if(isset($_POST['checked'])) {
      $checked = 1;
    }
    updateTodo($todoId, $descripcion, $checked);
    break;
  case 'deleteTodo':
    $todoId = $_POST['todoId'];
    deleteTodo($todoId);
    break;
  default:
    break;
}

header("Location: /todos");
?>