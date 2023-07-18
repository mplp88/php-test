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
  <?php if(!isset($_SESSION['usuario'])) { ?>
    <p class="alert alert-warning">
      Tenes que <a href="/account/login.php">iniciar sesión</a> para ver esta página...
    </p>
  <?php
    } else {
      $usuario = unserialize($_SESSION["usuario"]);
  ?>
    <h1>Perfil</h1>
    <?php
    if (!empty($error)) {
      echo '<div id="error-message" class="alert alert-danger">';
      echo '<a onclick="dismissError()" href="#">&times;</a>';
      echo '<p>' . $error . '</p>';
      echo '</div>';
    }
    $editProfile = false;
    if(isset($_GET['editProfile'])) {
      $editProfile = $_GET['editProfile'];
    }
    ?>
    <?php if(!$editProfile) { ?>
      <h2>Datos Personales</h2>
      <p><strong>Email:</strong> <?= $usuario->getEmail() ?></p>
      <p><strong>Nombre:</strong> <?= $usuario->getNombre() ?></p>
      <p><strong>Apellido:</strong> <?= $usuario->getApellido() ?></p>
      <a href="/account/profile.php?editProfile=true" class="btn btn-primary">Editar Perfil</a>
      <hr>
      <h2>Password</h2>
      <a href="#">Cambiar Pasword</a>
    <?php } else { ?>
    <div class="card p-3 shadow mb-3">
      <form action="server.php" method="post">
        <div class="form-group mb-3">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" placeholder="Email..." value="<?= $usuario->getEmail() ?>">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre..." value="<?= $usuario->getNombre() ?>">
          <label for="apellido">Nombre</label>
          <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido..." value="<?= $usuario->getApellido() ?>">
          <input type="hidden" name="usuarioId" id="usuarioId" value="<?= $usuario->getId() ?>">
          <input type="hidden" name="acc" id="acc" value="editProfile">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Enviar</button>
          <a href="/account/profile.php" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
    </div>
    <?php } ?>
  <?php } ?>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>