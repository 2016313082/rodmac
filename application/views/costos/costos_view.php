<!doctype html>
<html lang="en">
	<head>
		<title>Gestión de costos</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="<?= base_url() ?>static/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>static/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>static/css/jquery-ui.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>static/css/datatables_bootstrap4.min.css">
		<!--<link rel="stylesheet" href="<?= base_url() ?>/static/css/jquery.dataTables.min.css">-->
		<link rel="stylesheet" href="<?= base_url() ?>/static/css/buttons.dataTables.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>/static/css/style.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
		<script>var base_url = "<?= base_url() ?>"</script>
	</head>
	<body>
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="sticky-top">
				<div class="sticky-menu">
					<img class="logo-barra" src="<?= base_url() ?>/img/logoblanco.png">
					<ul class="list-unstyled components mb-5">
						<li>
							<a href="#"><i class="fa fa-file-text-o"></i>Cotizador</a>
						</li>			
						<li>
							<a data-toggle="collapse" href="#datos_generales" role="button" aria-expanded="false" aria-controls="datos_generales" class="collapsed"><i class="fa fa-sliders"></i>Datos generales</a>
						</li>
						<li class="collapse" id="datos_generales" style="">
							<ul class="list-unstyled components">
								<li>
									<a href="#"><i class="fa fa-tasks"></i>Tarifas CFE</a>
								</li>
								<li class="active">
									<a href="#"><i class="fa fa-users"></i>Proveedores</a>
								</li>	
								<li>
									<a href="#"><i class="fa fa-id-card-o"></i>Responsables</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-money"></i>Comisiones</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-dollar"></i>Gestión de costos</a>
						</li>
						<li>
							<a data-toggle="collapse" href="#gestion_especifica" role="button" aria-expanded="false" aria-controls="gestion_especifica" class="collapsed"><i class="fa fa-cogs"></i>Gestión específica</a>
						</li>
						<li class="collapse" id="gestion_especifica" style="">
							<ul class="list-unstyled components">
								<li>
									<a href="#"><i class="fa fa-sun-o"></i>Paneles solares</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-dashboard"></i>Optimizadores</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-hdd-o"></i>Inversores centrales</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-building"></i>Estructura</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-cog"></i>Configuración general</a>
						</li>
					</ul>
				</div>
			</nav>
			<div id="content" class="main">
				<nav id="topbar" class="navbar navbar-expand-lg">
					<div class="container-fluid">
						<button type="button" id="boton-sidebar" class="btn d-lg-none">
							<i class="fa fa-bars"></i>
							<span class="sr-only">Toggle Menu</span>
						</button>
						<div id="boton-usuario" class="btn-group ml-auto">
							<a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span>Pedro Suárez</span>
								<span class="sr-only">Toggle Dropdown</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="cuenta">Cuenta</a>
								<a class="dropdown-item" href="buzon">Buzón</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="ogout">Cerrar sesión</a>
							</div>
						</div>
					</div>
				</nav>

				<div id="contenido" class="container-fluid">
					<div class="botones_crud mt-4">
						<div class="row">
							<div class="col">
								<h2>Gestión costos</h2>
							</div>
						</div>
						<form action="<?= base_url() ?>costos/DetallePdf" method="post">
							<input class="form-control" name="prueba">
							<button class="btn btn-info" type="submit">button</button>
						</form>
						<div class="row">
							<div class="col-sm-6 d-flex justify-content-center align-items-end">
								<a class="btn btn-success btn-block" href="<?= base_url()?>Costos/vista_agregar" type="button" class="btn btn-primary">Registrar nuevo costo</a>
							</div>
							<div class="col-sm-6">
								<label for="id_tipo_articulo">Mostrar tipo de costos</label>
								<select class="form-control" id="id_tipo_articulo">
									<option selected disabled>Seleccione una opción</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col">
							<table id="tabla-costos" class="table-striped table-bordered tabla-responsiva">
								<thead>
									<tr>
										<th scope="col">Nombre</th>
										<th scope="col">Tipo</th>
										<th scope="col">Costo MXN</th>
										<th scope="col">Costo USD</th>
										<th scope="col">Fecha agregación</th>
										<th scope="col">Fecha actualización</th>
										<th scope="col">Acción</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="<?= base_url() ?>static/js/jquery.min.js"></script>
		<!-- <script src="<?= base_url() ?>/static/js/popper.min.js"></script>-->
		<!--<script src="<?= base_url() ?>/static/js/pdfmake.min.js"></script>-->
		<!--<script src="<?= base_url() ?>/static/js/vfs_fonts.js"></script>-->
		<script src="<?= base_url() ?>static/js/bootstrap.bundle.min.js"></script>
		<script src="<?= base_url() ?>static/js/datatables.min.js"></script>
		<!--<script src="<?= base_url() ?>/static/js/datatables.buttons.min.js"></script>-->
		<!--<script src="<?= base_url() ?>/static/js/buttons.html5.min.js"></script>-->
		<!--<script src="<?= base_url() ?>/static/js/buttons.print.min.js"></script>-->
		<script src="<?= base_url() ?>static/js/main.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<script src="<?= base_url() ?>static/js/costos/costos.js"></script>
	</body>
</html>