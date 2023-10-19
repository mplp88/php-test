<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/database.php');
include('todos.php');

$db = DatabaseContext::getInstance();

$acc;
$listId = -1;

if(isset($_POST["acc"])){
  $acc = $_POST["acc"];
} else {
  $_SESSION['errorMessage'] = 'Error de transmision de datos';
  header("Location: index.php");
}

if(isset($_POST['listId'])) {
  $listId = $_POST['listId'];
}

switch($acc) {
  case 'newTodo':
    $descripcion = $_POST['descripcion'];
    if($listId == -1) {
      $_SESSION['errorMessage'] = 'Debe seleccionar una lista';
    } else {
      insertTodo($descripcion, $listId);
    }
    break;
  case 'toggleChecked':
    $todoId = $_POST['todoId'];
    $checked = $_POST['checked'] == 1 ? true : false;
    $todo = getTodoById($todoId);
    $listId = $todo->getTodoListId();

    $todo->setHecho($checked);

    updateTodo($todo);
    break;
  case 'dismissError':
    unset($_SESSION['errorMessage']);
    break;
  case 'updateTodo':
    $todoId = $_POST['todoId'];
    $descripcion = $_POST['descripcion'];
    $checked = isset($_POST['checked']) ? true : false;
    if(isset($_POST['checked'])) {
      echo 'Checked: ' . $_POST['checked'];
    }

    $todo = getTodoById($todoId);
    $todo->setDescripcion($descripcion);
    $todo->setHecho($checked);

    updateTodo($todo);
    break;
  case 'deleteTodo':
    $todoId = $_POST['todoId'];
    deleteTodo($todoId);
    break;
  case 'createList':
    $descripcion = $_POST['descripcion'];
    createList($descripcion);
    $listId = $db->getInsertId();
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