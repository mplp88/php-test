<?php session_start(); ?>
<!DOCTYPE html>
<?php

$error = '';

$returnUrl = '';
if(isset($_GET['returnUrl'])) {
  $returnUrl = $_GET['returnUrl'];
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
    <h1>Recuperar contraseña</h1>
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
          <input type="hidden" name="acc" id="acc" value="recover">
        </div>
        <?php if(isset($_SESSION['recoverMessage'])) { ?>
        <div class="alert alert-success">
          <p><?= $_SESSION['recoverMessage'] ?></p>
        </div>
        <?php } ?>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </form>
      <?php
      if(isset($_SESSION['token'])) {
        $token = $_SESSION['token'];
        echo '<p>Se generó el token para recuperar. ';
        echo '<a href="/account/changePassword.php/?action=recover&token=' . $token . '">';
        echo 'Click para ir a modificar el password.</a>';
        echo '<br>';
        echo '(Este token será enviado por email cuando se implemente envío de emails)';
            
        unset($_SESSION['changePasswordError']);
        unset($_SESSION['changePasswordMessage']);
      }
      ?>
    </div>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>