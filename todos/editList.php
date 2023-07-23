<?php session_start(); ?>
<!DOCTYPE html>
<?php
include('todos.php');

$error = '';

$listId = $_GET["id"];
$list = getListById($listId);

if(is_null($list->getId())){
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
        <input type="hidden" name="listId" id="listId" value="<?= $list->getId() ?>">
        <input type="hidden" name="acc" id="acc" value="updateList">
        <div class="form-group mb-3">
          <label for="descripcion">Descripción</label>
          <input class="form-control" name="descripcion" id="descripcion" value="<?= $list->getDescripcion()?>"/>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </form>
    </div>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>