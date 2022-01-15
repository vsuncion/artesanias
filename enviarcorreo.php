<?php 
include("cabecera.php"); 
require("PHPMailer.php");
require("SMTP.php");
$v_nombre=$_POST["nombre"];
$v_correo=$_POST["correo"];
$v_mensaje=$_POST["mensaje"];
//echo $v_nombre." -- ".$v_correo." -- ".$v_mensaje;
$headers = "From: camello.9999@gmail.com" . "\r\n";
mail($v_correo,"CONTACTENOS - ARTESANIAS ZORRITOS",$v_mensaje,$headers);
 
?>

<div class="container">
<h4 class="text-center p-3">CONTACTENOS</h4>

  <div class="row m-3  justify-content-center">
    <div class="alert alert-primary text-center" role="alert">
     El correo fue envioado con exito.
    </div>
  </div>

</div>

<?php include("pie_pagina.php"); ?>