<?php session_start(); ?>
<!DOCTYPE html>
<?php
include('todos.php');

$error = '';

$todoId = $_GET["id"];
$todo = getTodoById($todoId);

if(is_null($todo->getId())){
  echo '<script>location.href="/todos"</script>';
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
    <h1>Eliminar</h1>
    <?php
    if (!empty($error)) {
      echo '<div id="error-message" class="alert alert-danger">';
      echo '<a onclick="dismissError()" href="#">&times;</a>';
      echo '<p>' . $error . '</p>';
      echo '</div>';
    }
    ?>
    <div>
      <form action="server.php" method="post">
        <input type="hidden" name="todoId" id="todoId" value="<?= $todo->getId() ?>">
        <input type="hidden" name="listId" id="listId" value="<?= $todo->getTodoListId() ?>">
        <input type="hidden" name="acc" id="acc" value="deleteTodo">
        <div class="form-group mb-3">
          <h3>Está a punto de eliminar este registro. ¿Está seguro?</h3>
          <p>
            <strong>Descripción: </strong>
            <?= $todo->getDescripcion() ?>
          </p>
        </div>
        <div class="form-group mb-3">
          <strong>Hecho</strong>
          <input type="checkbox" name="checked" id="checked" <?= $todo->getHecho() ? 'checked' : '' ?> disabled />
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-danger">Enviar</button>
        </div>
      </form>
    </div>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>