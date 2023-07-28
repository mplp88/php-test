<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/data/database.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/account/Usuario.php');

$db = DatabaseContext::getInstance();

if(isset($_SESSION["usuario"])) {
  $usuario = unserialize($_SESSION["usuario"]);
  $usuarioId = $usuario->getId();
}

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
  private $usuarioId;
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

  public function getUsuarioId() : ?int {
    return $this->usuarioId;
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
  
  public function setUsuarioId($usuarioId) : void {
    $this->usuarioId = $usuarioId;
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
  global $usuarioId;

  $sql = '';
  $sql .= 'INSERT INTO `todoLists` ';
  $sql .= '(`descripcion`, `usuarioId`) ';
  $sql .= 'VALUES ';
  $sql .= '(\'' . $descripcion . '\', ' . $usuarioId . '); ';

  $result = executeQuery($sql);
}

function updateList($id, $descripcion) {
  $sql = '';
  $sql .= 'UPDATE `todoLists` SET ';
  $sql .= 'descripcion = \'' . $descripcion . '\' ';
  $sql .= 'WHERE `id` = ' . $id . ';';

  $result = executeQuery($sql);
  return $result;
}

function deleteList($listId) {
  $sql = '';
  $sql .= 'DELETE FROM `todoLists` ';
  $sql .= 'WHERE `id` = ' . $listId . ';';

  $result = executeQuery($sql);
}

function getLists() {
  global $usuarioId;
  $todoLists = [];

  $sql = '';
  $sql .= 'SELECT `id`, `descripcion` ';
  $sql .= 'FROM `todoLists` ';
  $sql .= 'WHERE `usuarioId` = ' . $usuarioId;

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
  $sql .= 'SELECT `id`, `descripcion`, `usuarioId` ';
  $sql .= 'FROM `todoLists` ';
  $sql .= 'WHERE `id` = ' . $id . ';';
       
  $result = executeQuery($sql);
 
  $fila = $result->fetch_assoc();
  if($fila) {

    $todoList->setId($fila['id']);
    $todoList->setDescripcion($fila['descripcion']);
    $todoList->setUsuarioId($fila['usuarioId']);
    
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
  global $usuarioId;
  
  if($usuarioId != $todoList->getUsuarioId()) {
    $todoList->setDescripcion('LISTA INACCESIBLE');
    $todo = new Todo();
    $todo->setId(-1);
    $todo->setDescripcion('Usted no posee privilegios para poder ver esta lista');
    $todo->setHecho(true);
    $todoList->addTodo($todo);
    
    return $todoList;
  }

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