<?php 
session_start();
include("cabecera.php");
if(isset($_SESSION["cesta"])){
    /*
    foreach($_SESSION["cesta"] as $indice =>$arreglo){
        // echo "producto ".$indice."<br>";
          foreach($arreglo as $key => $value){
           echo $key.": ".$value;
          }
          echo "<br>";
        }
        */
 //ELIMINAMOS 
 if(isset($_REQUEST["item"])){
   $codigoProducto = $_REQUEST["item"];
   UNSET($_SESSION["cesta"][$codigoProducto]);
 } 
 
 //PREGUNTAMOS SI LA CESTA TIENE MINIMO UN PRODUCTO
?>

<div class="container">
    <br>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">PRODUCTO</th>
      <th scope="col">PRECIO</th>
      <th scope="col">CANTIDAD</th>
      <th scope="col">SUBTOTAL S/</th>
      <th scope="col">ELIMINAR</th>
    </tr>
  </thead>
  <tbody>
<?php
    $total=0;
    foreach($_SESSION["cesta"] as $indice =>$arreglo){
      $total+=$arreglo["subtotal"];
 ?>
  <tr>
      <th scope="row"><?php echo $arreglo["codigo"] ?></th>
      <td><?php echo $arreglo["nombre"] ?></td>
      <td><?php echo $arreglo["precio"] ?></td>
      <td><?php echo $arreglo["cantidad"] ?></td>
      <td><?php echo $arreglo["subtotal"] ?></td>
      <td><a href="carrito.php?item=<?php echo $arreglo["codigo"] ?>"  class="btn btn-outline-primary" role="button" aria-disabled="true"><i class="fa fa-trash"></i></a></td>
    </tr>
 <?php
    }
  ?> 

  </tbody>
</table>
 <div class="row justify-content-center p-3">
     <div class="col-sm-3">
      
     </div>
    <div class="col-sm-6 text-center">
      <div class="btn-group">
       <a href="finalizar.php" class="btn btn-outline-primary" aria-current="page">FINALIZAR COMPRA</a> &nbsp;&nbsp;&nbsp;
       <a href="index.php" class="btn btn-outline-danger" aria-current="page">SEGUIR COMPRANDO</a>
      </div>
    </div>
    <div class="col-sm-3">
     <h5>TOTAL A PAGAR : <strong><?php echo $total ?> S/</strong></h5>
    </div>
 </div>
 <?php
}else{
?>
<div class="row justify-content-center p-3">
  <div class="alert alert-info text-center"  role="alert">
  <h3> La cesta se encuentra vacía </h3>
  </div>
</div>

<?php
}
?>

<?php include("pie_pagina.php"); ?>