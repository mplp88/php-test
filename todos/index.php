<?php session_start(); ?>
<!DOCTYPE html>
<?php
include('todos.php');

$error = '';

$lists = getLists();
$selectedList = '';
$todoList = [];
if(isset($_GET['todoList'])) 
{
  $selectedList = $_GET['todoList'];
  $todoList = getListById($selectedList);
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
    <h1>To Do Lists</h1>
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
      <form action="server.php" method="post">
        <div class="form-group mb-3">
          <label for="descripcion">Descripción</label>
          <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción...">
          <input type="hidden" name="listId" id="listId" value="<?= $selectedList ?>">
          <input type="hidden" name="acc" id="acc" value="newTodo">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </form>
    </div>

    <div class="row">
      <div class="col-6">
        <h3>Listas</h3>
        <table class="todo-list-table table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Descripcion</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          <?php
            if(count($lists) == 0) {
            ?>
            <tr>
              <td colspan="3">
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
                <?= $list->getId() ?>
              </td>
              <td>
                <?= $list->getDescripcion() ?>
              </td>
              <td>
                <a href="/todos/edit.php?id=<?= $list->getId() ?>">Editar</a>
                <a href="/todos/delete.php?id=<?= $list->getId() ?>">Eliminar</a>
              </td>
            </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="col-6">
        <h3>To Do</h3>
        <?php
        if(!empty($selectedList)) {
        ?>
        <table class="todo-table table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Descripcion</th>
              <th>Hecho</th>
              <th>Acciones</th>
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
                <?= $fila->getId() ?>
              </td>
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
        <?php
        }
        ?>
      </div>
    </div>
    <form id="formu" action="server.php" method="post">
      <input type="hidden" name="acc" id="acc" value="" />
      <input type="hidden" name="todoId" id="todoId" value="" />
      <input type="hidden" name="todoDescription" id="todoDescription" value="" />
      <input type="hidden" name="checked" id="checked" value="0" />
      <input type="hidden" name="theme" id="theme" value="" />
    </form>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>