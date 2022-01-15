<?php
session_start();
include("conexion.php");
include("cabecera.php");
include("utilitarios.php");
$link= Conectarse();

$IDVENTA=$_POST['idventa'];

//echo var_dump($_POST);
$target_dir = "imagenes/comprobantes/";
$target_dir_final = "imagenes/comprobantes/";
$target_file = $target_dir . basename($_FILES["archivo"]["name"]); 
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$codigo="codigousuario_".mt_rand().".".$imageFileType;
$target_file_final = $target_dir_final.$codigo;

// SE VERIFICA SI ES UNA IMAGEN
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["archivo"]["tmp_name"]);
  if($check !== false) {
   // echo "EL ARCHIVO ES UNA IMAGEN " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
   //echo "File is not an image.";
    $uploadOk = 0;
  }
}

// VERIFICA EL ARCHIVO SI EXISTE
if (file_exists($target_file_final)) {
  $mensaje="EL ARCHIVO NO EXISTE";
  $uploadOk = 0;
}

// Check file size
/*
if ($_FILES["archivo"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}*/

// Allow certain file formats
/*
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}*/

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $mensaje="EL ARCHIVO NO SE LOGRO SUBIR";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file_final)) {
    $mensaje= "EL ARCHIVO ".$codigo. " FUE SUBIDO CORRECTAMENTE.";
  } else {
    $mensaje= "OCURRIO UN ERROR AL ESCRIBIR EL ARCHIVO";
  }
}

?>

<div class="container py-4">
  

   <?php
     if ($uploadOk == 1) {
   ?>    
   <h5 class="text-center p-3">INFORMACION DEl COMPROBANTE</h5>
   <?php
    // VERIFICAMOS SI FUE SUBIDO EL PAGO
    $query="SELECT COUNT(1)  AS CANTIDAD FROM PAGOS WHERE VENTA=".$IDVENTA;
    $result=mysqli_query($link,$query);
    $info=mysqli_fetch_array($result);
    $encontro = $info["CANTIDAD"];

    if($encontro==0){
    // INSERTAR PAGO
    $query_sql="INSERT INTO pagos (VENTA,FECPAGO) VALUES(".$IDVENTA.",'".fecha_hora_actual()."')";
    $result=mysqli_query($link,$query_sql);

    }else{
    // CASO CONTRARIO SI YA FUE SUIDO SE ACTUALIZAMOS
    $query_sql="UPDATE  pagos SET FECACTUALIZACION ='".fecha_hora_actual()."' WHERE VENTA =".$IDVENTA;
    $result=mysqli_query($link,$query_sql);
    }


    // ACTUALIAR ESTADO DE LA COMPRA
    $query_sql="UPDATE ventas SET NESTADO_PEDIDO=2 WHERE PIDVENTA=".$IDVENTA;
    $result=mysqli_query($link,$query_sql);

   ?>
    <div class="alert alert-success text-center" role="alert">
      <?php echo $mensaje; ?>
    </div>

   <?php
    }else{
   ?>
     <div class="alert alert-warning text-center" role="alert">
       <?php echo $mensaje; ?>
      </div>
   <?php
    }
   ?>


</div 


<?php include("pie_pagina.php"); ?>