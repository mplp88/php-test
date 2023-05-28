<?php session_start(); ?>
<!DOCTYPE html>
<?php
include('todos.php');

$error = '';

$todoId = $_GET["id"];
$todo = getTodoById($todoId);

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
    <div class="card p-3 shadow mb-3">
      <form action="server.php" method="post">
        <div class="form-group mb-3">
          <h3>Está a punto de eliminar este registro. ¿Está seguro?</h3>
          <p><strong>Descripción: </strong><?= $todo->getDescripcion() ?></p>
          <strong>Hecho</label>
            <input 
            type="checkbox"
            name="checked"
            id="checked"
            <?= $todo->getHecho() ? 'checked' : '' ?>
            disabled />
          <input type="hidden" name="todoId" id="todoId" value="<?= $todo->getId() ?>">
          <input type="hidden" name="acc" id="acc" value="deleteTodo">
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