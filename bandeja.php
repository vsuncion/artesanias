<?php 
session_start();
include("conexion.php");
include("cabecera.php");
$link= Conectarse();
$estado=$_GET['tipo']; 

$query="SELECT ";
$query.="  T1.DFECVENTA,T1.PIDVENTA, CASE T1.NESTADO_PEDIDO WHEN 1 THEN 'PENDIENTES' WHEN 2 THEN 'ENVIADOS' WHEN 3 THEN 'FINALIZADOS' WHEN 4 THEN 'OBSERVADOS' WHEN 5 THEN 'CANCELADOS' ELSE 'DESCONOCIDO' END ESTADO_DEL_PEDIDO, ";
$query.="  T1.FTOTAL AS TOTAL,(SELECT COUNT(1) FROM detalle_venta T2 WHERE T2.NVENTA=T1.PIDVENTA) AS CANTIDAD_PRODUCTOS ,T3.FECPAGO AS FECHA_PAGO";
$query.=" FROM VENTAS T1  ";
$query.="  INNER JOIN usuarios T2 ON T1.NUSUARIO=T2.PIDUSUARIO ";
$query.="  LEFT JOIN PAGOS T3 ON T1.PIDVENTA=T3.VENTA AND T3.NESTADO=1 ";
$query.=" WHERE T1.NUSUARIO=2 AND T1.NESTADO_REGISTRO=0 AND T1.NESTADO_PEDIDO=".$estado." ORDER BY T1.PIDVENTA DESC";
$result=mysqli_query($link,$query);
//echo $query;

?>

  <div class="container">
    <h4 class="text-center p-3">BANDEJA DE PEDIDOS</h4>

    <form id="formcontacto" action="listarbandeja.php" method="post">
      
    <!-- FORMULARIO DE BUSQUEDA -->

    <!-- LINEA 1 -->
    <div class="row">

    <div>


    
    </form>


    <!-- LISTA DE REGISTROS-->
    <table class="table table-hover text-center ">
            <thead>
              <tr>
                <th scope="col">FECHA REGISTRO</th>
                <th scope="col">ESTADO</th>
                <th scope="col">CODIGO</th>
                <th scope="col">CANTIDAD</th>
                <th scope="col">TOTAL</th>
                <th scope="col">FECHA PAGO</th> 
                <th scope="col">VER</th>
                <th scope="col">PAGAR</th>
                <th scope="col">CANCELAR</th>
              </tr>
            </thead>
            <tbody>
                <?php while($row=mysqli_fetch_array($result)){ ?>
              <tr>
                <th><?php echo $row["DFECVENTA"]  ?></th>
                <td><?php echo $row["ESTADO_DEL_PEDIDO"]  ?></td>
                <td><?php echo $row["PIDVENTA"]  ?></td>
                <td><?php echo $row["CANTIDAD_PRODUCTOS"]  ?></td>
                <td><?php echo $row["TOTAL"]  ?></td>
                <td><?php echo $row["FECHA_PAGO"]  ?></td>
                 <td><a href="infopedido.php?codigo=<?php echo $row["PIDVENTA"] ?>"   class="btn btn-outline-primary" role="button" aria-disabled="true"><i class="fa fa-shopping-basket"></i></a></td>
                <!--<td><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-shopping-basket"></i>
                </button></td>-->
                <td>
                  <?php if($estado==1 || $estado==4){ ?>
                  <a href="pagopedido.php?codigo=<?php echo $row["PIDVENTA"] ?>"   class="btn btn-outline-primary" role="button" aria-disabled="true"><i class="fa fa-dollar"></i></a>
                  <?php } ?>
                </td>

                <td>
                  <?php if($estado==1 || $estado==4){ ?>
                  <a href="eliminar_pedido.php?tipo=e&codigo=<?php echo $row["PIDVENTA"] ?>"   class="btn btn-outline-primary" role="button" aria-disabled="true"><i class="fa fa-trash"></i></a>
                  <?php } ?>
                </td> 
              </tr>
              <?php
                }
                 mysqli_free_result($result);
                 mysqli_close($link); 
              ?>
            </tbody>
          </table>


    
  </div>
<p><p>

 

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
      </div>
    </div>
  </div>
</div>
 

  <?php include("pie_pagina.php"); ?>
