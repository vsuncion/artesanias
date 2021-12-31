<?php 
include("conexion.php");
include("cabecera.php");
$link= Conectarse();
$query="SELECT PIDPRODUCTO,VNOMBRE,VDESCRIPCION,DPRECIO,VIMAGEN,VRUTA_IMAGEN FROM productos WHERE NESTADO=1";
$result=mysqli_query($link,$query);
?>

  <div class="container-fluid">
  
  <div class="row m-2">
    <?php while($row=mysqli_fetch_array($result)){ ?>
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">

            <img src='<?php echo $row["VRUTA_IMAGEN"]."/".$row["VIMAGEN"] ?>' alt="<?php echo $row["VDESCRIPCION"]  ?>">

          <div class="card-body">
                <h5 class="card-title"><?php echo $row["VNOMBRE"]  ?></h5>
                  <p class="card-text"><?php echo $row["VDESCRIPCION"]  ?></p>
                <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                          <a class="btn btn-sm btn-outline-secondary" href="infoproducto.php?id=<?php echo $row["PIDPRODUCTO"]?>" role="button">COMPRAR</a>
                      </div>
                      <small class="text-muted">9 mins</small>
                  </div>
              </div>
          </div>
      </div>

<?php
  }
mysqli_free_result($result);
mysqli_close($link); 
?> 
  </div> 

  </div>

  <?php include("pie_pagina.php"); ?>
