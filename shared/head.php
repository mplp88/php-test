<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
$selectedTheme = 'default';

if(isset($_SESSION["theme"])) {
  $selectedTheme = $_SESSION["theme"];
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
<title>Pon Site</title>