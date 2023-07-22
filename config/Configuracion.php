<?php
class Configuracion {
  private $usuarioId;
  private $theme;

  //getters
  function getUsuarioId() {
    return $this->usuarioId;
  }
  
  function getTheme() {
    return $this->theme;
  }
  
  //setters
  function setUsuarioId($usuarioId) {
    $this->usuarioId = $usuarioId;
  }

  function setTheme($theme) {
    $this->theme = $theme;
  }
}
?>