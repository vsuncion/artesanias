<?php include("cabecera.php"); ?>

  <!-- Wrapper container -->
<div class="container py-4">

<!-- Bootstrap 5 starter form -->
<form id="formcontacto" action="enviarcorreo.php" method="post">

  <!-- Name input -->
  <div class="mb-3">
    <label class="form-label" for="nombre"><strong>Nombres y Apellidos</strong></label>
    <input class="form-control" name="nombre" type="text" placeholder="Nombres y Apellidos" required/>
  </div>

  <!-- Email address input -->
  <div class="mb-3">
    <label class="form-label" for="correo"><strong>Correo Electronico</strong></label>
    <input class="form-control" name="correo" type="email" placeholder="Correo Electronico" required/>
  </div>

  <!-- Message input -->
  <div class="mb-3">
    <label class="form-label" for="mensaje"><strong>Mensaje</strong></label>
    <textarea class="form-control" name="mensaje" type="text" placeholder="Mensaje" style="height: 10rem;" required></textarea>
  </div>

  <!-- Form submit button -->
  <div class="d-grid">
    <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
  </div>

</form>

</div>

  <?php include("pie_pagina.php"); ?>
