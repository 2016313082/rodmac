<!doctype html>
<html lang="en">
	<head>
		<title>Agregar Costo</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="<?= base_url() ?>static/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>static/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>static/css/jquery-ui.min.css">
		<!--<link rel="stylesheet" href="<?= base_url() ?>static/css/datatables_bootstrap4.min.css">-->
		<!--<link rel="stylesheet" href="<?= base_url() ?>/static/css/jquery.dataTables.min.css">-->
		<!--<link rel="stylesheet" href="<?= base_url() ?>/static/css/buttons.dataTables.min.css">-->
		<link rel="stylesheet" href="<?= base_url() ?>/static/css/style.css">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
		<script>base_url = "<?= base_url()?>"</script>
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
							<a href="#"><i class="fa fa-pencil-square-o"></i>Inversores</a>
						</li>
						<li class="active">
							<a href="#"><i class="fa fa-users"></i>Proveedores</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Gestión general</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Tarifas CFE</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Datos generales</a>
						</li>
						<!--<li>
							<a href="#"><i class="fa fa-users"></i>Tarifas CFE</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Paneles solares</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Microinversores</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Optimizadores</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Inversores centrales</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Sistemas de monitoreo</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Materiales</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Estructura</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Responsables</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Comisiones</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-users"></i>Datos generales</a>
						</li>-->
					</ul>
				</div>
			</nav>
			<div id="content" class="container-fluid">
				<div class="row no-gutters sticky-top">
					<div class="col">
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
					</div>
				</div>
				<div class="pl-4 pr-4 pt-2 pd-2 mt-2">
					<div class="row mt-2">
						<div class="col-10">
							<h2>Agregar nuevo costo</h2>
						</div>
						<!--<div class="col-2">
							<button class="btn btn-info">Gestión tipo de articulo</button>
						</div>-->
					</div>
					<form method="post" id="formulario_articulo">
						<div class="row mt-2">
							<div class="col-sm-12">
								<label for="nombre_articulo">Nombre del articulo</label>
								<input class="form-control" type="text" id="nombre_articulo" name="nombre_articulo">
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-sm-4">
								<label for="costo_MXN">Costo MXN</label>
								<input class="form-control" type="text" id="costo_MXN" name="costo_MXN">
							</div>
							<div class="col-sm-4">
								<label for="costo_USD">Costo USD</label>
								<input class="form-control" type="text" id="costo_USD" name="costo_USD">
							</div>
							<div class="col-sm-4">
								<label for="id_tipo_articulo">Tipo de articulo</label>
								<select class="form-control" id="id_tipo_articulo" name="id_tipo_articulo">
									<option disabled selected>Seleccione una opción</option>
								</select>
							</div>
						</div>
						<div class="row mt-4">
							<div class="col-6">
								<button class="btn btn-success form-control" type="submit">Guardar</button>
							</div>
							<div class="col-6">
								<a class="btn btn-danger form-control" href="<?= base_url() ?>Costos">Cancelar</a>
							</div>
						</div>
						<br>
					</form>
				</div>
			</div>
		</div>
		<script src="<?= base_url() ?>static/js/jquery.min.js"></script>
		<!-- <script src="<?= base_url() ?>/static/js/popper.min.js"></script>-->
		<!--<script src="<?= base_url() ?>static/js/pdfmake.min.js"></script>-->
		<!--<script src="<?= base_url() ?>static/js/vfs_fonts.js"></script>-->
		<script src="<?= base_url() ?>static/js/bootstrap.bundle.min.js"></script>
		<!--<script src="<?= base_url() ?>/static/js/datatables.min.js"></script>-->
		<!--<script src="<?= base_url() ?>/static/js/datatables.buttons.min.js"></script>-->
		<!--<script src="<?= base_url() ?>static/js/buttons.html5.min.js"></script>-->
		<!--<script src="<?= base_url() ?>static/js/buttons.print.min.js"></script>-->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
		<script src="<?= base_url() ?>static/js/costos/agregar_costos.js"></script>
	</body>
</html>