<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/head.php'); ?>
</head>

<body>
  <header>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/navbar.php') ?>
  </header>
  <main class="container">
    <h1>Acerca de mi</h1>
    <p>
      Soy programador fullstack con 6+ años de experiencia centrado principalmente en stack .NET (MVC, WebApi, Entity Framework).
      Poseo experiencia en otros lenguajes como Java, Javascript, Node.js, Visual Basic 6.0, ASP 3.0 (clásico) y PHP.
      Para bases de datos principalmente uso SQL Server, pero he trabajado con Oracle y DB2. Este sitio usa MySQL el cual estoy
      aprendiendo sobre el hacer. Por último, también conozco frameworks como Vue.js y librerías como JQuery y Bootstrap.
    </p>
    <p>
      Este sitio nace como iniciativa propia de aprender el lenguaje PHP plano, sin frameworks con el fin de agregarlos (probablemente)
      más adelante.
    </p>
    <h3>Lista de cosas completadas hasta ahora</h3>
    <ul>
      <li>Página de inicio.</li>
      <li>Página de presentación (Acerca de mi).</li>
      <li>Registración y login.</li>
      <li>Lista de Quehaceres (To Do List). Se necesita una cuenta y estar loggeado para poder verlo.</li>
      <li>Página de configuración para seleccionar el tema. Se necesita una cuenta y estar loggeado para poder verlo.</li>
      <li>Página para modificar datos de perfil. Se necesita una cuenta y estar loggeado para poder verlo.</li>
    </ul>
    <h3>Lista de cosas pendientes en desarrollo</h3>
    <ul>
      <li>Reestablecimiento de contraseña.</li>
      <li>Envio de email para validación y reestablecer contraseña.</li>
      <li>Página para Curriculum Vitae.</li>
      <li>Traducción de la página al inglés y selector de idioma.</li>
    </ul>
    <p>Se aceptan donaciones con el botón de abajo.</p>
    <a href='https://cafecito.app/tehpon' rel='noopener' target='_blank'>
      <img
        srcset='https://cdn.cafecito.app/imgs/buttons/button_5.png 1x, https://cdn.cafecito.app/imgs/buttons/button_5_2x.png 2x, https://cdn.cafecito.app/imgs/buttons/button_5_3.75x.png 3.75x'
        src='https://cdn.cafecito.app/imgs/buttons/button_5.png' alt='Invitame un café en cafecito.app' />
    </a>
  </main>
  <footer class="footer">
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>