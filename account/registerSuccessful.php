<?php session_start(); ?>
<!DOCTYPE html>
<?php

$error = '';

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
    <h1>Registrarse</h1>
    <?php
    if (!empty($error)) {
      echo '<div id="error-message" class="alert alert-danger">';
      echo '<a onclick="dismissError()" href="#">&times;</a>';
      echo '<p>' . $error . '</p>';
      echo '</div>';
    }
    $email = '';
    if(isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
    }
    ?>
    <div class="alert alert-success">
      <h3>Registro completo</h3>
    </div>
    <p>Por favor, <a href="/account/login.php">ingrese</a> para poder configurar su perfil y hacer uso completo del sitio.</p>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>