<?php
session_start();
unset($_SESSION['usuario']);
setcookie('sesion', '');
header('Location: /');
?>