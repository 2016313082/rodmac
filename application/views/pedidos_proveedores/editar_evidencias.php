<?php 
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    if(isset($uri_segments[4])){
        $id_evidencia = $uri_segments[4];
		$id_pedido = $uri_segments[5];
    }
?>
<script>var id_evidencia = <?= $uri_segments[4]; ?>;</script>
<!doctype html>
<html lang="en">

<head>
	<?php $this->load->view('include/header', $datos_pagina); ?>
</head>

<body>
	<div class="wrapper d-flex align-items-stretch">
		<?php $this->load->view('include/menu_lateral', $datos_pagina);  ?>

		<div id="content" class="main">
			<?php $this->load->view('include/barra_superior', $datos_pagina);  ?>
			<div id="contenido" class="container-fluid">
				<div class="botones_crud mt-4">
					<div class="row">
						<div class="col">
							<h2>Registrar evidencias</h2>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col">
						<section style="background-color: #eee;">
							<div class="container py-5">
								<div class="row">
									<div class="col-lg-4">
										<div class="card mb-4">
											<div class="card-body text-center">
												<img class="d-none" src="" width="250px" id="imagenmuestra">
												<div class="card">
													<form id="form-evidencias" method="post">
														<h5 class="my-3" id="nombre_producto"></h5>
														<p class="text-muted mb-1"><b>Cantidad esperada: </b><span id="cantidad_esperada"></span></p>
														<p class="text-muted mb-1"><b>Cantidad entregada: </b><span id="cantidad_entregada"></span></p>
														<p class="text-muted mb-4"><b>Porcentaje revisado: </b><span id="porcentaje_revisado"></span></p>
														<div class="d-flex justify-content-center mb-2">
															<label for="camera">
																<span class="btn btn-info" aria-hidden="true">Evidencia fotografica <i class="fa fa-camera" aria-hidden="true"></i></span>
																<input class="form-control" name="camera" style="display: none;" type="file" accept="image/*" capture="camera" id="camera" onchange="readURL()" />
															</label>
															
														</div>
														<input class="form-control" name="comentario" placeholder="Ingresa un comentario">
														<input name="id_evidencia" value="<?= $id_evidencia ?>" hidden>
														<input name="id_pedido" value="<?= $id_pedido ?>" hidden>
														<br><button class="btn btn-success form-control" type="submit" form="form-evidencias">Enviar datos</button>
													</form>
												</div>
											</div>
										</div>
										<div class="card mb-4 mb-lg-0">
											<div class="card-body p-0">
												<ul class="list-group list-group-flush rounded-3">
													<li class="list-group-item d-flex justify-content-between align-items-center p-3">
														<i class="fas fa-globe fa-lg text-warning"></i>
														<p class="mb-0">https://mdbootstrap.com</p>
													</li>
													<li class="list-group-item d-flex justify-content-between align-items-center p-3">
														<i class="fab fa-github fa-lg" style="color: #333333;"></i>
														<p class="mb-0">mdbootstrap</p>
													</li>
													<li class="list-group-item d-flex justify-content-between align-items-center p-3">
														<i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
														<p class="mb-0">@mdbootstrap</p>
													</li>
													<li class="list-group-item d-flex justify-content-between align-items-center p-3">
														<i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
														<p class="mb-0">mdbootstrap</p>
													</li>
													<li class="list-group-item d-flex justify-content-between align-items-center p-3">
														<i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
														<p class="mb-0">mdbootstrap</p>
													</li>
												</ul>
											</div>
										</div>
											
									</div>
									<div class="col-lg-8">
										<div class="card mb-4">
											<div class="card-body">
												<div class="row">
													<div class="col-sm-3">
														<p class="mb-0">Proveedor</p>
													</div>
													<div class="col-sm-9">
														<p class="text-muted mb-0" id="proveedor"></p>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-sm-3">
														<p class="mb-0">Email</p>
													</div>
													<div class="col-sm-9">
														<p class="text-muted mb-0" id="email"></p>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-sm-3">
														<p class="mb-0">Telefono</p>
													</div>
													<div class="col-sm-9">
														<p class="text-muted mb-0" id="telefono"></p>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-sm-3">
														<p class="mb-0">Codigo</p>
													</div>
													<div class="col-sm-9">
														<p class="text-muted mb-0" id="codigo"></p>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-sm-3">
														<p class="mb-0">Direccion</p>
													</div>
													<div class="col-sm-9">
														<p class="text-muted mb-0" id="direccion"></p>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="card mb-4 mb-md-0">
													<div class="card-body">
														<p class="mb-4"><span class="text-primary font-italic me-1">Calidad</span> Calificacion sobre productos
														</p>
														<p class="t-4 mb-1" style="font-size: .77rem;">Pregunta 1</p>
															<input type="range" class="custom-range" min="0" max="10" step="0.5" id="rango-calidad0">
														<p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
															<input type="range" class="custom-range" min="0" max="10" step="0.5" id="rango-calidad1">
														<p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
															<input type="range" class="custom-range" min="0" max="10" step="0.5" id="rango-calidad2">
														<p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
															<input type="range" class="custom-range" min="0" max="10" step="0.5" id="rango-calidad3">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="card mb-4 mb-md-0">
													<div class="card-body">
														<p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
														</p>
														<p class="mb-1" style="font-size: .77rem;">Web Design</p>
														<div class="progress rounded" style="height: 5px;">
															<div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
														<p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
														<div class="progress rounded" style="height: 5px;">
															<div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
														<p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
														<div class="progress rounded" style="height: 5px;">
															<div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
														<p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
														<div class="progress rounded" style="height: 5px;">
															<div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
														<p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
														<div class="progress rounded mb-2" style="height: 5px;">
															<div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('include/scripts');  ?>
	<script src="<?= base_url() ?>static/js/pedidos/evidencias.js"></script>
</body>
</html>
