<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/head.php'); ?>
</head>

<body>
  <header>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/navbar.php') ?>
  </header>
  <main class="container">
    <h1>Config</h1>
    <form action="server.php" method="POST">
      <div class="form-group mb-3">
        <label class="" for="theme">Theme</label>
        <select class="form-control" name="theme" id="theme">
        <?php
        $availableThemes = array('default', 'cerulean', 'darkly', 'lux');
        foreach($availableThemes as $theme) {
          echo '<option value="'.$theme.'"';
          echo $theme == $selectedTheme ? 'selected' : '';
          echo '>';
          echo ucfirst($theme);
          echo '</option>';
        }
        ?>
        </select>
      </div>
      <input type="hidden" name="acc" id="acc" value="saveConfig">
      <input class="btn btn-primary" type="submit" value="Guardar" />
    </form>
  </main>
  <footer class="footer">
    <p>Temas obtenidos de <a href="https://bootswatch.com/" target="_blank">bootswatch.com</a></p>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/shared/copyright.php') ?>
  </footer>
</body>

</html>