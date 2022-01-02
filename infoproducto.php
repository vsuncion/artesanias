<?php 
session_start();
include("conexion.php");
include("cabecera.php");
$link= Conectarse();
$codigo=$_GET['id'];
//echo $codigo;
$query="SELECT PIDPRODUCTO,VNOMBRE,VDESCRIPCION,DPRECIO,VIMAGEN,VRUTA_IMAGEN FROM productos WHERE NESTADO=1 AND PIDPRODUCTO=".$codigo;
$result=mysqli_query($link,$query);
$info=mysqli_fetch_array($result);
?>

<div class="container">

<div class="row m-3  justify-content-center">

  <div class="card">
    <div class="row g-0">
      <div class="col-md-4 text-end">
        <img src="<?php echo $info["VRUTA_IMAGEN"]."/".$info["VIMAGEN"] ?>" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8 text-start">
        <div class="card-body">
        <form method="post" action="agregarcarrito.php">
          <input type="hidden" name="p_codigo" value="<?php echo $info["PIDPRODUCTO"] ?>">
          <input type="hidden" name="p_nombre" value="<?php echo $info["VNOMBRE"] ?>">
          <input type="hidden" name="p_precio" value="<?php echo $info["DPRECIO"] ?>">
          <h5 class="card-title"><?php echo $info["VNOMBRE"]  ?></h5>
          <p class="card-text"><?php echo $info["VDESCRIPCION"]  ?></p>
          <p class="card-text"><span class="badge bg-info text-dark">PRECIO :</span>&nbsp;<span><strong><?php echo $info["DPRECIO"]  ?></strong</span> S/</p>
          
          <div class="form-group row">
             <label for="staticEmail" class="col-sm-2 col-form-label text-left">
              CANTIDAD :
             </label>
            <div class="col-sm-2 text-start">
             <input class="form-control"  type="number" name="p_cantidad" min="1" max="100" value="1">
            </div>
            <div class="col-sm-4 text-start">
              <button class="btn btn-primary" type="submit" name="btnagregar">AGREGAR PRODUCTO</button>
            </div>
          </div>

          <div class="form-group row m-3">
          <a href="index.php" class="btn btn-outline-info" role="button" aria-disabled="true">REGRESAR</a>
          </div>  
          
          </form>

        </div>
      </div>
    </div>
  </div>

 </div>

</div>

  <?php $link->close(); include("pie_pagina.php"); ?>


