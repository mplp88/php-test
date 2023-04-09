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
      <h1>¡Bienvenido a mi página!</h1>
      <p class="alert alert-warning">
        Sitio en construcción, disculpe las molestias...
      </p>
      <button class="btn btn-primary" onclick="testBootbox()">Test Bootbox</button>
    </main>
    <footer class="footer">
      <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
    </footer>
  </body>
</html>