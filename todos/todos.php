<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/database.php');
$db = DatabaseContext::getInstance();

class Todo {
  private $id;
  private $descripcion;
  private $hecho;

  //getters
  public function getId() : ?int {
    return $this->id;
  }

  public function getDescripcion() : ?string {
    return $this->descripcion;
  }

  public function getHecho() : ?bool {
    return $this->hecho;
  }

  //setters
  public function setId($id) : void {
    $this->id = $id;
  }

  public function setDescripcion($descripcion) : void {
    $this->descripcion = $descripcion;
  }

  public function setHecho($hecho) : void {
    $this->hecho = $hecho;
  }
}

class TodoList {
  private $id;
  private $todos;

  public function __construct() {
    $this->todos = array();
  }

  //getters
  public function getId() : ?int {
    return $this->id;
  }

  public function getTodos() : ?array {
    return $this->todos;
  }

  
  //setters
  public function setId($id) : void {
    $this->id = $id;
  }

  //metodos
  public function addTodo($todo) : void {
    array_push($this->todos, $todo);
  }

  public function getElement($id) : Todo {
    return $this->todos($id);
  }

  public function count() : int {
    return count($this->todos);
  }
}

function getAllTodos() {
  $todoList = new TodoList();

  $sql = '';
  $sql .= 'SELECT `id`, `descripcion`, `hecho` ';
  $sql .= 'FROM `todos`';

  $result = executeQuery($sql);

  while ($fila = $result->fetch_assoc())
  {
    $todo = new Todo();
    $todo->setId($fila['id']);
    $todo->setDescripcion($fila['descripcion']);
    $todo->setHecho($fila['hecho']);
    $todoList->addTodo($todo);
  }

  return $todoList;
}

function getTodoById($id) {
  $todo = new Todo();
  $sql = '';
  $sql .= 'SELECT `id`, `descripcion`, `hecho` ';
  $sql .= 'FROM `todos`';
  $sql .= 'WHERE id = ' . $id;

  $result = executeQuery($sql);

  if($result->num_rows > 0) {
    while ($fila = $result->fetch_assoc())
    {
      $todo->setId($fila['id']);
      $todo->setDescripcion($fila['descripcion']);
      $todo->setHecho($fila['hecho']);
    }
  }

  return $todo;
}

function insertTodo($descripcion) {
  $sql = '';
  $sql .= 'INSERT INTO `todos` ';
  $sql .= '(`descripcion`) ';
  $sql .= 'VALUES ';
  $sql .= '(\'' . $descripcion . '\');';

  $result = executeQuery($sql);
  return $result;
}

function updateTodo($id, $descripcion, $hecho) {
  $sql = '';
  $sql .= 'UPDATE `todos` SET ';
  if(!empty($descripcion)){
    $sql .= 'descripcion = \'' . $descripcion . '\', ';
  }

  if(empty($hecho)) {
    $sql .= '`hecho` = 0 ';
  } else {
    $sql .= '`hecho` = 1 ';
  }
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
?>