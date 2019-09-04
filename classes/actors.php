<?php
class Actors
{
 private $name;
 private $apellido;
 private $pelicula;

 public function __construct($name, $apellido, $pelicula)
 {
   $this->name = $name;
   $this->apellido = $apellido;
  $this->pelicula = $pelicula;
 }

 public function setName($name)
 {
   $this->name = $name;
 }

 public function getName()
 {
   return $this->name;
 }
 public function setApellido($apellido)
 {
   $this->apellido= $apellido;
 }

 public function getApellido()
 {
   return $this->apellido;
 }

 public function setPelicula($pelicula)
 {
   $this->pelicula = $pelicula;
 }

 public function getPelicula()
 {
   return $this->pelicula;
 }
 ?>
