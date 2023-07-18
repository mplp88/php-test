<?php// include($_SERVER['DOCUMENT_ROOT'] . '/account/Usuario.php'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">MartínPonce.com.ar</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse collapse">
    <div class="navbar-nav mr-auto">
      <div class="nav-item">
        <a href="/" class="nav-link">Inicio</a>
      </div>
      <?php if(isset($_SESSION['usuario'])) { ?>
      <div class="nav-item">
        <a href="/todos" class="nav-link">To Do List</a>
      </div>
      <?php } ?>
      <div class="nav-item">
        <a href="/about" class="nav-link">Acerca de mi</a>
      </div>
      <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Cuenta</a>
        <ul class="dropdown-menu">
          <?php if(!isset($_SESSION['usuario'])) { ?>
          <li>
            <a href="/account/login.php" class="dropdown-item">Ingresar</a>
          </li>
          <li>
            <a href="/account/register.php" class="dropdown-item">Registrarse</a>
          </li>
          <?php } else {
            $usuario = unserialize($_SESSION['usuario']);
            ?>
          <li>
            <p class="dropdown-item">Bienvenido, <?= $usuario->getEmail() ?></p>
          </li>
          <li>
            <a href="/account/profile.php" class="dropdown-item">Perfil</a>
          </li>
          <li>
            <a href="/config" class="dropdown-item">Configuracion</a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <a href="/account/logout.php" class="dropdown-item">Salir</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</nav>
<script src="/js/navbar.js"></script>