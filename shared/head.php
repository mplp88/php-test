<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
$selectedTheme = 'default';

require_once($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/account/Usuario.php');
include_once('session.php');

if(isset($_SESSION["usuario"])) {
  $usuario = unserialize($_SESSION["usuario"]);
  $selectedTheme = getTheme($usuario->getId());
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
<script src="/js/index.js"></script>
<script src="https://kit.fontawesome.com/17ae34bd66.js" crossorigin="anonymous"></script>
<title>Pon Site</title>