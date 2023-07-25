<?php
  if(!isset($_SESSION["usuario"]) && isset($_COOKIE["sesion"])) {
    $_SESSION["usuario"] = $_COOKIE["sesion"];
  }
?>