<?php session_start(); ?>
<!DOCTYPE html>
<?php
//include('todos.php');

$error = '';

//$todoList = getAllTodos(); 

if(isset($_SESSION["errorMessage"])) {
  $error = $_SESSION["errorMessage"];
}

// if(empty($error) && !empty($db->getError())) {
//   global $db;
//   $error = $db->getError();
// }
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
    <h1>Ingresar</h1>
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
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" placeholder="Email...">
          <label for="password">Contraseña</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña...">
          <input type="hidden" name="acc" id="acc" value="login">
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