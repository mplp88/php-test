<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
$selectedTheme = 'default';

require_once($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/account/Usuario.php');
include_once('session.php');

try {
  if(isset($_SESSION["usuario"])) {
    $usuario = unserialize($_SESSION["usuario"]);
    $selectedTheme = getTheme($usuario->getId());
  }
} catch (Exception $ex) {
  echo '<script>window.location.href = /account/logout.php';
}

$bootstrapStyleSheet = '<link rel="stylesheet" href="/css/bootstrap.';
$bootstrapStyleSheet .= $selectedTheme;
$bootstrapStyleSheet .= '.min.css">';
echo $bootstrapStyleSheet;
?>
<link rel="stylesheet" href="/css/index.css">
<link rel="stylesheet" href="/css/todos.css">
<script src="/js/bootstrap.bundle.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootbox.all.min.js"></script>
<script src="https://kit.fontawesome.com/17ae34bd66.js" crossorigin="anonymous"></script>
<script src="/js/main.js?v=2"></script>
<title>Pon Site</title>