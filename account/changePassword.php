<?php session_start(); ?>
<!DOCTYPE html>
<?php

$error = '';
$token = '';
$action = 'change';

if(isset($_GET['token'])) {
  $token = $_GET['token'];
} 

if(isset($_GET['action'])) {
  $action = ($_GET['action']);
}

if(isset($_SESSION["errorMessage"])) {
  $error = $_SESSION["errorMessage"];
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
    <h1>Cambiar contraseña</h1>
    <?php
    if (!empty($error)) {
      echo '<div id="error-message" class="alert alert-danger">';
      echo '<a onclick="dismissError()" href="#">&times;</a>';
      echo '<p>' . $error . '</p>';
      echo '</div>';
    }
    ?>
    <div class="card p-3 shadow mb-3">
      <?php if (isset($_SESSION['changePasswordMessage'])) {?>
        <p class="alert alert-success"><?= $_SESSION['changePasswordMessage'] ?></p>
      <?php } else { ?>
      <form action="/account/server.php" method="post">
        <div class="form-group mb-3">
        <label for="password">Contraseña</label>
        <div id="password-container" class="input-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña..." required>
            <button type="button" class="btn btn-secondary" onclick="showPassword()">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          <label for="repeatPassword">Repetir contraseña</label>
          <div id="repeat-password-container" class="input-group">
            <input type="password" class="form-control" name="repeatPassword" id="repeatPassword" placeholder="Repetir contraseña..." required>
            <button type="button" class="btn btn-secondary" onclick="showConfirm()">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
        </div>
        <input type="hidden" name="token" id="token" value="<?= $token ?>">
        <input type="hidden" name="action" id="action" value="<?= $action ?>">
        <input type="hidden" name="acc" id="acc" value="changePassword">
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </form> 
        <?php } ?>
      <?php if (isset($_SESSION['changePasswordError'])) { ?>
      <p class="alert alert-danger"><?= $_SESSION['changePasswordError'] ?></p>
      <?php } ?>
    </div>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
  <script>
    function showPassword() {
      let container = document.querySelector('#password-container');
      let input = container.querySelector('input');
      let icon = container.querySelector('button > i.fa-solid');
      if (input.type == 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }

    function showConfirm() {
      let container = document.querySelector('#repeat-password-container');
      let input = container.querySelector('input');
      let icon = container.querySelector('button > i.fa-solid');
      if (input.type == 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>
</body>

</html>