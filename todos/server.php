<?php
session_start();
include('todos.php');

$listId = -1;
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
    $listId = $_POST['listId'];
    if($listId == -1) {
      $_SESSION['errorMessage'] = 'Debe seleccionar una lista';
    } else {
      insertTodo($descripcion, $listId);
    }
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
  case 'createList':
    $descripcion = $_POST['descripcion'];
    createList($descripcion);
    break;
  case 'deleteList':
    $listId = $_POST['listId'];
    deleteList($listId);
    $listId = -1;
    break;
  case 'updateList':
    $listId = $_POST['listId'];
    $descripcion = $_POST['descripcion'];
    updateList($listId, $descripcion);
    break;
  default:
    break;
}

$location = "Location: /todos";
if($listId != -1) {
  $location .= "/?todoList=" . $listId;
}

header($location);
?>