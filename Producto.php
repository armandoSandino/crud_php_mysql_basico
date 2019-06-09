<?php

 class Producto {
 private $Id_pro;
 private $Cod_producto;
 private $Descripcion;
 private $Precio;
 private $Stock;
 public function __construct(){}
 public function __GET($para){ return $this->$para;}
 public function __SET($para,$dat){return $this->$para = $dat;}
}
 ?>