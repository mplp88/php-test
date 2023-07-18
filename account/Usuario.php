<?php
class Usuario {
  private $id;
  private $email;
  private $password;
  private $nombre;
  private $apellido;

  //getters
  function getId() {
    return $this->id;
  }

  function getEmail() {
    return $this->email;
  }

  function getPassword() {
    return $this->password;
  }

  function getNombre() {
    return $this->nombre;
  }

  function getApellido() {
    return $this->apellido;
  }
  
  //setters
  function setId($id) {
    $this->id = $id;
  }

  function setEmail($email) {
    $this->email = $email;
  }
  
  function setPassword($password) {
    $this->password = $password;
  }

  function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  function setApellido($apellido) {
    $this->apellido = $apellido;
  }
}
?>