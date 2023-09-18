<?php session_start(); ?>
<!DOCTYPE html>
<?php
include('todos.php');

$error = '';

$lists = '';
if(isset($_SESSION["usuario"])) {
  $lists = getLists();
}
$selectedList = -1;
$todoList = [];
if(isset($_GET['todoList'])) 
{
  $selectedList = $_GET['todoList'];
  $todoList = getListById($selectedList);
  $todos = getTodosByListId($todoList);
}

if(isset($_SESSION["errorMessage"])) {
  $error = $_SESSION["errorMessage"];
}

if(empty($error) && !empty($db->getError())) {
  global $db;
  $error = $db->getError();
}
?>
<html lang="es">

<head>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/head.php'); ?>
</head>

<body>
  <header>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/navbar.php') ?>
  </header>
  <main class="container">
  <?php if(!isset($_SESSION['usuario'])) { ?>
    <p class="alert alert-warning">
      Tenés que <a href="/account/login.php?returnUrl=todos">iniciar sesión</a> para ver esta página...
    </p>
  <?php } else { ?>
    <h1>Listas de quehaceres</h1>
    <?php
    if (!empty($error)) {
      echo '<div id="error-message" class="alert alert-danger">';
      echo '<a onclick="dismissError()" href="#">&times;</a>';
      echo '<p>' . $error . '</p>';
      echo '</div>';
    }
    ?>
    <div class="mb-3">
      <button class="btn btn-primary" onclick="crearLista()">
       Crear lista
      </button>
    </div>
    <div class="card p-3 shadow mb-3">
      <form class="needs-validation" onsubmit="return validate()" action="server.php" method="post" novalidate>
        <div class="form-group mb-3">
          <label for="descripcion">Descripción</label>
          <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción..." required>
          <div class="invalid-feedback">
            La descripcion no puede estar vacía.
          </div>
          <input type="hidden" name="listId" id="listId" value="<?= $selectedList ?>">
          <input type="hidden" name="acc" id="acc" value="newTodo">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-md-4">
        <h3>Listas</h3>
        <table class="todo-list-table table">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          <?php
            if(count($lists) == 0) {
            ?>
            <tr>
              <td colspan="2">
                No hay listas que mostrar
              </td>
            </tr>
            <?php
            } else {
              foreach ($lists as $list)
              {
            ?>
            <tr style="cursor: pointer;" onclick="selectList(<?= $list->getId() ?>)">
              <td>
                <?= $list->getDescripcion() ?>
              </td>
              <td>
                <a href="/todos/editList.php?id=<?= $list->getId() ?>">Editar</a>
                <a href="/todos/deleteList.php?id=<?= $list->getId() ?>">Eliminar</a>
              </td>
            </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
      if($selectedList != -1) {
      ?>
      <div id="todo-list" class="col-md-8">
        <div class="row">

          <div class="col-10">
            <h3>Items de lista '<?= $todoList->getDescripcion() ?>'</h3>
          </div>
          <div class="col-2"><button class="btn btn-outline-danger" onclick="closeList()"><i class="fa-solid fa-xmark"></i></button></div>
        </div>
          <table class="todo-table table">
          <thead>
            <tr>
              <th>Descripcion</th>
              <th>Hecho</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            if($todoList->count() == 0) {
            ?>
            <tr>
              <td colspan="4">
                La lista está vacía
              </td>
            </tr>
            <?php
            } else {
              foreach ($todoList->getTodos() as $fila)
              {
            ?>
            <tr>
              <td>
                <?= $fila->getDescripcion() ?>
              </td>
              <td>
                <input 
                  type="checkbox"
                  id="checked-<?= $fila->getId() ?>"
                  <?= $fila->getHecho() ? 'checked' : '' ?>
                  onchange="toggleChecked(<?= $fila->getId() ?>)"
                  style="cursor: pointer;" />
              </td>
              <td>
                <a href="/todos/edit.php?id=<?= $fila->getId() ?>">Editar</a>
                <a href="/todos/delete.php?id=<?= $fila->getId() ?>">Eliminar</a>
              </td>
            </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <?php
      }
      ?>
    </div>
    <?php }?>
    <script src="/js/todos.js"></script>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>