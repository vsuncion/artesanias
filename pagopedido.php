<?php 
session_start();
include("conexion.php");
include("cabecera.php");
$link= Conectarse();
$codigo=$_GET['codigo']; 


// CABCERA 
$query="SELECT ";
$query.="  T1.DFECVENTA,T1.PIDVENTA, CASE T1.NESTADO_PEDIDO WHEN 1 THEN 'PENDIENTES' WHEN 2 THEN 'FINALIZADOS' WHEN 3 THEN 'OBSERVADAS' WHEN 4 THEN 'CANCELADAS' ELSE 'DESCONOCIDO' END ESTADO_DEL_PEDIDO, ";
$query.="  T1.FTOTAL AS TOTAL,(SELECT COUNT(1) FROM detalle_venta T2 WHERE T2.NVENTA=T1.PIDVENTA) AS CANTIDAD_PRODUCTOS, ";
$query.="  T3.VAPEPATERNO,T3.VAPEMATERNO,T3.VNOMBRE ";
$query.=" FROM VENTAS T1  ";
$query.="  INNER JOIN usuarios T2 ON T1.NUSUARIO=T2.PIDUSUARIO "; 
$query.="  INNER JOIN personas T3 ON T3.PIDPERSONA=T2.FPERSONA ";
$query.=" WHERE T1.NUSUARIO=2 AND T1.PIDVENTA=".$codigo." ORDER BY T1.PIDVENTA DESC";
$result=mysqli_query($link,$query);
$info=mysqli_fetch_array($result);


?>


<div class="container py-4">
  <h5 class="text-center p-2">INFORMACION DE VENTA</h5>



  <div class="card" >
  <div class="card-body"> 
    <p class="card-text">
        
<!-- LINEA 1 -->
<div class="row">

<!-- CODIGO -->
<div class="col">
    <label for="codigo" class="form-label"><strong>Codigo </strong></label>
    <input type="text" class="form-control"   name="codigo" value="<?php echo $info["PIDVENTA"] ?>" readonly>
  </div>
  
  <!-- NOMBRE -->
  <div class="col">
    <label for="Nombre" class="form-label"><strong>Nombre </strong></label>
    <input type="text" class="form-control" value="<?php echo $info["VNOMBRE"] ?>"  name="Nombre" readonly>
  </div>

  <!-- PATERNO -->  
  <div class="col">
    <label for="paterno" class="form-label"><strong>Paterno </strong></label>
    <input type="text" class="form-control" value="<?php echo $info["VAPEPATERNO"] ?>"  name="paterno" readonly>
  </div>

  <!-- MATERNO -->
  <div class="col">
    <label for="materno" class="form-label"><strong>Materno </strong></label>
    <input type="text" class="form-control" value="<?php echo $info["VAPEMATERNO"] ?>"  name="materno" readonly>
  </div>

</div>
<p>

 
<!-- LINEA 2 -->
<br>
<div class="row">

<!-- MONTO -->
<div class="col">
    <label for="monto" class="form-label"><strong>Monto S/</strong></label>
    <input type="text" class="form-control"   name="monto" value="<?php echo $info["TOTAL"] ?>" readonly>
  </div>
  
  <!-- CANTIDAD -->
  <div class="col">
    <label for="cantidad" class="form-label"><strong>Cantidad </strong></label>
    <input type="text" class="form-control" value="<?php echo $info["CANTIDAD_PRODUCTOS"] ?>"  name="cantidad" readonly>
  </div>

  <!-- ESTADO DE PEDIDO -->  
  <div class="col">
    <label for="estado" class="form-label"><strong>Estado</strong></label>
    <input type="text" class="form-control" value="<?php echo $info["ESTADO_DEL_PEDIDO"] ?>"  name="estado" readonly>
  </div>

  <!-- FECHA REGISTRO -->
  <div class="col">
    <label for="fecha" class="form-label"><strong>Registro </strong></label>
    <input type="text" class="form-control" value="<?php echo $info["DFECVENTA"] ?>"  name="fecha" readonly>
  </div>

</div>
 

    </p>
     
  </div>
</div>

<!-- SI TIENE OBSERVACION LA MOSTRAMOS ESTADOS 1 = PENDIENTE 2=PAGADO 3=OBSERVADO 4=ANULADO -->
<?php
  $sql="SELECT ";
  $sql.="PIDPAGO,VENTA,FECPAGO,NESTADO,FECACTUALIZACION,OBSERVACION ";
  $sql.="FROM  pagos WHERE  VENTA=".$codigo;
  $result=mysqli_query($link,$sql);
  $datos_nm=mysqli_fetch_assoc($result);

  $cantidad_nm=mysqli_num_rows($result);
 
  if($cantidad_nm>0){
?>
<h5 class="text-center text-danger p-2">OBSERVACION DEL PAGO</h5>
<div class="alert alert-danger  text-center" role="alert">
  <span class="text-dark"><strong> <?php echo $datos_nm["OBSERVACION"]  ?> </strong></span>
</div>
<hr />
<?php
  }
?>

<!-------------------->
 
<h5 class="text-center p-2">SUBIR COMPROBANTE DE PAGO</h5>

<div class="card" >
  <div class="card-body"> 
    <p class="card-text">
    <form method="post" action="realizar_pago.php" enctype="multipart/form-data">
    <input  name="idventa" type="hidden" value="<?php echo $codigo ?>">
     <div class="form-group">
      <label for="exampleFormControlFile1">Subir imagen del comprobante</label>
      <input accept="image/*" type="file" class="form-control-file" name="archivo" required>
      <button type="submit" class="btn btn-primary" name="submit">Subir Comprobante</button>
    </div>
</form>
  </div>
</div>      
 
</div>
 <br><br>
<?php include("pie_pagina.php"); ?>