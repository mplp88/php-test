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
  private $descripcion;
  private $todos;

  public function __construct() {
    $this->todos = array();
  }

  //getters
  public function getId() : ?int {
    return $this->id;
  }

  public function getDescripcion() : ?string {
    return $this->descripcion;
  }

  public function getTodos() : ?array {
    return $this->todos;
  }

  
  //setters
  public function setId($id) : void {
    $this->id = $id;
  }

  public function setDescripcion($descripcion) : void {
    $this->descripcion = $descripcion;
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

$db = DatabaseContext::getInstance();

function createList($descripcion) {
  $sql = '';
  $sql .= 'INSERT INTO `todolists` ';
  $sql .= '(`descripcion`) ';
  $sql .= 'VALUES ';
  $sql .= '(\'' . $descripcion . '\'); ';

  $result = executeQuery($sql);
}

function deleteList($listId) {
  $sql = '';
  $sql .= 'DELETE FROM `todolists` ';
  $sql .= 'WHERE `id` = ' . $listId . ';';

  $result = executeQuery($sql);
}

function getLists() {
  $todoLists = [];

  $sql = '';
  $sql .= 'SELECT `id`, `descripcion` ';
  $sql .= 'FROM `todolists`';

  $result = executeQuery($sql);

  while ($fila = $result->fetch_assoc())
  {
    $list = new TodoList();
    $list->setId($fila['id']);
    $list->setDescripcion($fila['descripcion']);
    array_push($todoLists, $list);
  }

  return $todoLists;
}

function getListById($id) {
  $todoList = new TodoList();

  $sql = '';
  $sql .= 'SELECT `id`, `descripcion`';
  $sql .= 'FROM `todolists` ';
  $sql .= 'WHERE `id` = ' . $id . ';';
       
  $result = executeQuery($sql);
 
  $fila = $result->fetch_assoc();
  if($fila) {

    $todoList->setId($fila['id']);
    $todoList->setDescripcion($fila['descripcion']);
    
    // $result->data_seek(0);
    // while ($fila = $result->fetch_assoc())
    // {
    //   $todo = new Todo();
    //   $todo->setId($fila['todoId']);
    //   $todo->setDescripcion($fila['descripcionTodo']);
    //   $todo->setHecho($fila['hecho']);
    //   $todoList->addTodo($todo);
    // }
  }
    
  return $todoList;
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

function getTodosByListId($todoList) {
  //$todoList = new TodoList();

  $sql = '';
  $sql .= 'SELECT `id`, `descripcion`, `hecho` ';
  $sql .= 'FROM `todos` ';
  $sql .= 'WHERE `todoListId` = ' . $todoList->getId();

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

function insertTodo($descripcion, $todoListId) {
  $sql = '';
  $sql .= 'INSERT INTO `todos` ';
  $sql .= '(`descripcion`, `todoListId`) ';
  $sql .= 'VALUES ';
  $sql .= '(\'' . $descripcion . '\', ' . $todoListId . ');';

  $result = executeQuery($sql);
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