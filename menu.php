<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: cyan;">
	<div class="container-fluid">
		<a href="index.php" class="navbar-brand">
			<img src="imagenes/logo.jpeg" width="30" class="d-inline-block align-top">
		Artesanias</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#contenido">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="contenido">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-link">
					<a href="quienesomos.php" class="nav-link active">QUIENES SOMOS</a>
				</li>
				<li class="nav-link" >
					<a href="politicas.php" class="nav-link active">POLITICAS DE COMPRA</a>
				</li>
				<li class="nav-link">
					<a href="contactenos.php" class="nav-link active">CONTACTENOS</a>
				</li>
				<li class="nav-link">
					<a href="registrase.php" class="nav-link active">REGISTRARSE</a>
				</li>
				
				<li class="nav-item dropdown pt-2">
					<a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					 BANDEJA
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<li><a class="dropdown-item" href="bandeja.php?tipo=1">Pendientes</a></li>
						<li><a class="dropdown-item" href="bandeja.php?tipo=2">Enviadas</a></li>
						<li><a class="dropdown-item" href="bandeja.php?tipo=3">Finalizados</a></li>
						<li><a class="dropdown-item" href="bandeja.php?tipo=4">Observados</a></li> 
						<li><a class="dropdown-item" href="bandeja.php?tipo=5">Cancelados</a></li>
					</ul>
					</li>
			</ul>
			<form class="d-flex"> 
				<a href="carrito.php"   class="btn btn-outline-primary" role="button" aria-disabled="true">Carrito Compras <i class="fa fa-shopping-cart"></i></a>&nbsp;
				<a href="salir.php"   class="btn btn-outline-danger" role="button" aria-disabled="true">Salir del sistema</a> 
			</form>
		</div>
	</div>
</nav>