<?php 
session_start();
include("conexion.php");
include("cabecera.php");
$link= Conectarse();
$tipo=$_GET['tipo']; 
$codigo=$_GET['codigo']; 
echo $codigo;
$query="UPDATE VENTAS SET NESTADO_PEDIDO=5 WHERE PIDVENTA=".$codigo;
echo $query;
$link->query($query);
?>

  <div class="container">
  </div>

<?php include("pie_pagina.php"); ?>