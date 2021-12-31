<?php 
session_start();
include("cabecera.php");
 
if(isset($_REQUEST['btnagregar'])){
//var_dump($_POST);

$codigoProducto=$_POST['p_codigo'];
if(isset($_SESSION["cesta"])){
    foreach($_SESSION["cesta"] as $indice =>$arreglo){
       if($arreglo["codigo"]==$codigoProducto){
         echo "si encontro ".$codigoProducto;
       }
    }
}

 $nombre=$_POST['p_nombre'];
 $precio=$_POST['p_precio'];
 $cantidad=$_POST['p_cantidad'];
 $subtotal=$precio * $cantidad;

 $_SESSION["cesta"][$codigoProducto]["codigo"]  = $codigoProducto;
 $_SESSION["cesta"][$codigoProducto]["nombre"]  = $nombre;
 $_SESSION["cesta"][$codigoProducto]["cantidad"]= $cantidad;
 $_SESSION["cesta"][$codigoProducto]["precio"]  = $precio;
 $_SESSION["cesta"][$codigoProducto]["subtotal"]   = $subtotal;
}else{
    echo "no inicio";
}
 
?>

<div class="container p-3">
    <div class="row justify-content-center">

     <div class="alert alert-primary text-center" role="alert">
      El producto <strong><?php echo $nombre ?></strong> fue agregado con éxito
     </div>

     <div class="row col-sm-2 ">
      <a href="index.php" class="btn btn-info" role="button" aria-disabled="true">SEGUIR COMPRANDO</a>
    </div>

    </div>

</div>

<?php include("pie_pagina.php"); ?>