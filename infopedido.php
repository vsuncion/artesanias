<?php 
session_start();
include("conexion.php");
$link= Conectarse();
$codigo=$_GET['codigo']; 


// CABCERA 
$query="SELECT ";
$query.="  T1.DFECVENTA,T1.PIDVENTA, CASE T1.NESTADO_PEDIDO WHEN 1 THEN 'PENDIENTES' WHEN 2 THEN 'FINALIZADOS' WHEN 3 THEN 'OBSERVADAS' WHEN 4 THEN 'CANCELADAS' ELSE 'DESCONOCIDO' END ESTADO_DEL_PEDIDO, ";
$query.="  T1.FTOTAL AS TOTAL,(SELECT COUNT(1) FROM detalle_venta T2 WHERE T2.NVENTA=T1.PIDVENTA) AS CANTIDAD_PRODUCTOS, ";
$query.="  T3.VAPEPATERNO,T3.VAPEMATERNO,T3.VNOMBRE,T4.FECPAGO AS FECHA_PAGO ";
$query.=" FROM VENTAS T1  ";
$query.="  INNER JOIN usuarios T2 ON T1.NUSUARIO=T2.PIDUSUARIO "; 
$query.="  INNER JOIN personas T3 ON T3.PIDPERSONA=T2.FPERSONA ";
$query.="  LEFT JOIN PAGOS T4 ON T1.PIDVENTA=T4.VENTA AND T4.NESTADO=1 ";
$query.=" WHERE T1.NUSUARIO=2 AND T1.PIDVENTA=".$codigo." ORDER BY T1.PIDVENTA DESC"; 
$result=mysqli_query($link,$query);
$info=mysqli_fetch_array($result);

// DETALLE
$query_det="SELECT ";
$query_det.=" T1.DFECREGISTRO,T2.VNOMBRE,T1.FPRECIO,T1.NCANTIDAD, T1.FPRECIO * T1.NCANTIDAD AS SUBTOTAL ";
$query_det.="FROM detalle_venta T1 ";
$query_det.=" INNER JOIN productos T2 ON T1.NPRODUCTO=T2.PIDPRODUCTO ";
$query_det.="WHERE T1.NVENTA =".$codigo;
$result_det=mysqli_query($link,$query_det); 

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="container py-4">
  <h5 class="text-center p-3">INFORMACION DE VENTA</h5>



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
    <label for="fecha" class="form-label"><strong>Fecha Registro </strong></label>
    <input type="text" class="form-control" value="<?php echo $info["DFECVENTA"] ?>"  name="fecha" readonly>
  </div>

  <!-- FECHA REGISTRO -->
  <div class="col">
    <label for="fecha_pago" class="form-label"><strong>Fecha Pago </strong></label>
    <input type="text" class="form-control" value="<?php echo $info["FECHA_PAGO"] ?>"  name="fecha_pago" readonly>
  </div>

</div>
 

    </p>
     
  </div>
</div>
 

<h5 class="text-center p-3"><strong>DETALLE DE VENTA</strong></h5>

 <!-- LISTA DE REGISTROS-->
 <table class="table table-hover text-center ">
            <thead>
              <tr>
                <th scope="col">FECHA REGISTRO</th>
                <th scope="col">NOMBRE PRODUCTO</th>
                <th scope="col">PRECIO</th>
                <th scope="col">CANTIDAD</th>
                <th scope="col">SUB TOTAL</th> 
              </tr>
            </thead>
            <tbody>
                <?php while($row=mysqli_fetch_array($result_det)){ ?>
              <tr>
                <th><?php echo $row["DFECREGISTRO"]  ?></th>
                <td><?php echo $row["VNOMBRE"]  ?></td>
                <td><?php echo $row["FPRECIO"]  ?></td>
                <td><?php echo $row["NCANTIDAD"]  ?></td>
                <td><?php echo $row["SUBTOTAL"]  ?></td> 
              </tr>
              <?php
                }
                 mysqli_free_result($result);
                 mysqli_close($link); 
              ?>
            </tbody>
          </table>




</div>
