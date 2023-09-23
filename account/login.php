<?php session_start(); ?>
<!DOCTYPE html>
<?php
//include('todos.php');

$error = '';

$returnUrl = '';
if(isset($_GET['returnUrl'])) {
  $returnUrl = $_GET['returnUrl'];
}

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
      echo '<p>' . $error . ' <button class="btn-close" onclick="dismissError()"></button></p>';
      echo '</div>';
    }
    ?>
    <div class="card p-3 shadow mb-3">
      <form action="server.php" method="post">
        <div class="form-group mb-3">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" placeholder="Email...">
          <label for="password">Contraseña</label>
          <div id="password-container" class="input-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña...">
            <button type="button" class="btn btn-secondary" onclick="showPassword()">
              <i class="fa-solid fa-eye"></i>
            </button>
          </div>
          <input type="hidden" name="acc" id="acc" value="login">
          <input type="hidden" name="returnUrl" id="returnUrl" value="<?= $returnUrl ?>">
        </div>
        <p>¿No tenés cuenta? <a href="/account/register.php">Hacé click acá</a></p>
        
        <p>¿Te olvidaste el password? <a href="/account/recover.php">Hacé click acá</a></p>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
      </form>
    </div>
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
    </script>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>