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
    <div class="card p-3 shadow mb-3">
      <form action="server.php" method="post">
        <div class="form-group mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Email..." value="<?= $email ?>" required>
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
          <input type="hidden" name="acc" id="acc" value="register">
        </div>
        <p>¿Ya tenés cuenta? <a href="/account/login.php">Hacé click acá</a></p>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </form>
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