<?php 
session_start();
include("conexion.php");
include("cabecera.php"); 
include("utilitarios.php"); 
$link= Conectarse();

$sql_departamento="SELECT ID,NAME FROM departamento ORDER BY NAME ASC";
$result=mysqli_query($link,$sql_departamento); 
?>

    <!-- Wrapper container -->
<div class="container py-4">

<h4 class="text-center p-3">REGISTRO DE USUARIO</h4>

<!-- Bootstrap 5 starter form -->
<form id="formcontacto" action="registrapersona.php" method="post">
 
<!-- LINEA 1 -->
<div class="row">
  
    <!-- NOMBRE -->
    <div class="col">
      <label for="Nombre" class="form-label"><strong>Nombre </strong></label>
      <input type="text" class="form-control" placeholder="Nombre" name="Nombre" required>
    </div>

    <!-- PATERNO -->  
    <div class="col">
      <label for="paterno" class="form-label"><strong>Apellido Paterno </strong></label>
      <input type="text" class="form-control" placeholder="Apellido Paterno" name="paterno" required>
    </div>

    <!-- MATERNO -->
    <div class="col">
      <label for="materno" class="form-label"><strong>Apellido Materno </strong></label>
      <input type="text" class="form-control" placeholder="Apellido Materno" name="materno" required>
    </div>

  </div>
  <p>

  <!-- LINEA 2 -->
  <div class="row">
    
  <!-- DEPARTAMENTO -->
  <div class="col">
      <label for="cbdepartamento" class="form-label"><strong>Departamento </strong></label>
      <select class="form-control form-select" aria-label="Default select example" name="cbdepartamento" id="cbdepartamento" required>
      <option value=""> -- SELECCIONE --</option>
      <?php while($row=mysqli_fetch_array($result)){ ?>
          <option value="<?php echo $row["ID"]; ?>"><?php echo $row["NAME"]; ?></option>
        <?php } ?> 
      </select>
    </div>

     <!-- PROVINCIA -->
  <div class="col">
      <label for="cbprovincia" class="form-label"><strong>Provincia </strong></label>
      <select class="form-control form-select" aria-label="Default select example" name="cbprovincia" id="cbprovincia"   required>
      </select>
    </div>


     <!-- DISTRITO -->
  <div class="col">
      <label for="cbdistrito" class="form-label"><strong>Distrito </strong></label>
      <select class="form-control form-select" aria-label="Default select example" name="cbdistrito" id="cbdistrito"   required>
      </select>
    </div>

  </div>
  <p>

<!-- LINEA 3 -->
<div class="row">

  <!-- DIRECCION -->
  <div class="col">
    <label for="direccion" class="form-label"><strong>Direccion </strong></label>
    <input type="text" class="form-control" placeholder="Direccion" name="direccion" required>
  </div>

  <!-- REFERENCIA -->
  <div class="col">
    <label for="referencia" class="form-label"><strong>Referencia </strong></label>
    <input type="text" class="form-control" placeholder="Referencia" name="referencia">
  </div>

</div> 
<p>

<!-- LINEA 4 -->
<div class="row">

 <!-- TELEFONO -->
 <div class="col">
    <label for="telefono" class="form-label"><strong>Telefono </strong></label>
    <input type="number" class="form-control" placeholder="Telefono" name="telefono">
  </div>

   <!-- CORREO -->
   <div class="col">
    <label for="correo" class="form-label"><strong>Correo </strong></label>
    <input type="email" class="form-control" placeholder="Correo Electronico" name="correo" required>
  </div>

  <!-- BLANCO -->
  <div class="col">
  </div>

</div> 
<p>

<!-- LINEA 5 -->
<div class="row justify-content-center">

 <!-- columna 1-->
 <div class="col">
 </div>

   <!-- columna 2-->
   <div class="col">
     <div class="btn-group" role="group" aria-label="Basic example"> 
      <button type="reset" class="btn btn-outline-secondary" name="btnlimpiar">LIMPIAR FORMULARIO</button> &nbsp;&nbsp;&nbsp;
      <button type="submit" class="btn btn-outline-primary" name="btngrabar">GRABAR REGISTRO</button>
     </div>
   </div>

   <!-- columna 3-->
 <div class="col">
 </div>
  
</div>



</form>

</div>
<script type="text/javascript">
   $(document).ready(function(){

    $('#cbdepartamento').on('change', function() {
      var p_tipo = "PR";
      var p_codigo = $(this).val(); 
      if(p_codigo !== ''){ //verificar haber seleccionado una opcion valida
        /*Inicio de llamada ajax*/
        $.ajax({
              data: {p_tipo:p_tipo,p_codigo:p_codigo,}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: 'combos.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

              $('#cbprovincia').html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
              $('#cbprovincia').prop('disabled', false); //habilitar el select
             // $('#cbdistrito').prop('disabled', true); //habilitar el select
              $("#cbdistrito").val(''); 
            });
            /*fin de llamada ajax*/
      }
    });



    $('#cbprovincia').on('change', function() {
      var p_tipo = "DT";
      var p_codigo = $(this).val(); 
      if(p_codigo !== ''){ //verificar haber seleccionado una opcion valida
        /*Inicio de llamada ajax*/
        $.ajax({
              data: {p_tipo:p_tipo,p_codigo:p_codigo,}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: 'combos.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

              $('#cbdistrito').html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
              $('#cbdistrito').prop('disabled', false); //habilitar el select
            });
            /*fin de llamada ajax*/
      }
    });





  });

  


  </script>

  <?php include("pie_pagina.php"); ?>
