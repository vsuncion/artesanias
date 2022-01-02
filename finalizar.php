<?php 
session_start();
include("conexion.php");
include("cabecera.php"); 
include("utilitarios.php"); 
$link= Conectarse();
// PREGUNTAMOS  SI SE INICIO SESSION  

// PREGUNTAMOS  SI EL CARRITO ESTA VACIO  
if(isset($_SESSION["cesta"])){
    $pcontinua=0;
    $pmensaje_error="";
    $pusuario=2;
   
    //INSERTAMOS LOS DATOS DE LA CEBECERA DEL COMPRA
    $sql="INSERT INTO ventas(";
    $sql.=" NUSUARIO,  DFECVENTA) ";
    $sql.=" VALUES (".$pusuario.",'".fecha_hora_actual()."')";
    //echo $sql;
    if ($link->query($sql) === TRUE) {
        $pcontinua=1;
        $id_venta = $link->insert_id;
    
        //INSERTAMOS LOS DETALLE DE LA COMPRA
        $total=0;
        $cantidad=0;
        foreach($_SESSION["cesta"] as $indice =>$arreglo){
           $total+=$arreglo["subtotal"];
           $cantidad+=$arreglo["cantidad"];
           $sql_det="INSERT INTO detalle_venta(NVENTA, NPRODUCTO, VNOMBRE_PRODUCTO, FPRECIO, NCANTIDAD, DFECREGISTRO) ";
           $sql_det.=" VALUES (".$id_venta.",".$arreglo["codigo"].",'".$arreglo["nombre"]."',";
           $sql_det.=$arreglo["precio"].",".$arreglo["cantidad"].",'".fecha_hora_actual()."')";
           if ($link->query($sql_det) === TRUE) {
            $pcontinua=1;
           }else{
            $pcontinua=0;
            $pmensaje_error="Error: " . $sql_det . "<br>" . $link->error; 
           // echo "Error: " . $sql_det . "<br>" . $link->error; 
           }
   
           //PREGUNTAMOS SI SE INSERTO CORRECTO EL DETALLE
           if($pcontinua==0){
             break;
           }
        }
   
        // PREGUNTAMOS SI CONTINUAMOS
        if($pcontinua==1){
          //ACTUALIZAMOS EL TOTAL
          $sql="UPDATE ventas SET FTOTAL=".$total." WHERE PIDVENTA=".$id_venta;
          $link->query($sql);
        }
   
       
   
      } else {
        //echo "Error: " . $sql . "<br>" . $link->error;
        $pcontinua=0;
        $pmensaje_error="Error: " . $sql . "<br>" . $link->error; 
      }
   
   
   }else{
       echo "CESTA VACIA";
   }

   //ELIMINAMOS LOS REGISTROS ERRADOS
   if($pcontinua==0){
       $sql="DELETE FROM ventas WHERE PIDVENTA=".$id_venta;
       $link->query($sql);

       $sql="DELETE FROM detalle_venta WHERE NVENTA=".$id_venta;
       $link->query($sql);
   }
   
?>

  <div class="container">
  
   <div class="row justify-content-center">
       <h4 class="text-center p-3">MENSAJE DE LA COMPRA</h4>
    <?php if($pcontinua==1){ ?>

        <div class="alert alert-primary text-center" role="alert"> 
          juan su pedido fue registrado con éxito y se genero con el siguiente código <strong><?php echo $id_venta ?>
        </strong>  con un total de <strong><?php echo $cantidad ?></strong>  productos y un monto de <strong>
            <?php echo $total ?> S/</strong>, revise su bandeja de pedidos
        </div>
        <a href="bandeja.php" class="btn btn-outline-info" role="button" aria-disabled="true">IR A LA BANDEJA</a>

      <?php UNSET($_SESSION["cesta"]); }else{ ?>
        <div class="row justify-content-center p-3">
          <div class="alert alert-danger text-center"  role="alert">
            <?php echo $pmensaje_error ?>
          </div>
        </div> 
        <?php } ?>
    


   </div>
  </div>

  <?php $link->close(); include("pie_pagina.php"); ?>