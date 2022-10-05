<!doctype html>
<html lang="en">
	<head>
		<?php $this->load->view('include/header', $datos_pagina); ?>
		<link rel="stylesheet" href="http://localhost/panel/static/css/starrr.css">
		<style>
			/*form styles*/
			#msform {
				text-align: center;
				position: relative;
				margin-top: 20px;
			}

			#msform fieldset .form-card {
				background: white;
				border: 0 none;
				border-radius: 0px;
				box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
				padding: 20px 40px 30px 40px;
				box-sizing: border-box;
				width: 94%;
				margin: 0 3% 20px 3%;

				/*stacking fieldsets above each other*/
				position: relative;
			}

			#msform fieldset {
				background: white;
				border: 0 none;
				border-radius: 0.5rem;
				box-sizing: border-box;
				width: 100%;
				margin: 0;
				padding-bottom: 20px;

				/*stacking fieldsets above each other*/
				position: relative;
			}

			/*Hide all except first fieldset*/
			#msform fieldset:not(:first-of-type) {
				display: none;
			}

			#msform fieldset .form-card {
				text-align: left;
				color: #9E9E9E;
			}


			/*Blue Buttons*/
			#msform .action-button {
				width: 100px;
				background: skyblue;
				font-weight: bold;
				color: white;
				border: 0 none;
				border-radius: 0px;
				cursor: pointer;
				padding: 10px 5px;
				margin: 10px 5px;
			}

			#msform .action-button:hover, #msform .action-button:focus {
				box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
			}

			/*Previous Buttons*/
			#msform .action-button-previous {
				width: 100px;
				background: #616161;
				font-weight: bold;
				color: white;
				border: 0 none;
				border-radius: 0px;
				cursor: pointer;
				padding: 10px 5px;
				margin: 10px 5px;
			}

			#msform .action-button-previous:hover, #msform .action-button-previous:focus {
				box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
			}

			/*Dropdown List Exp Date*/
			select.list-dt {

				
				border: none;
				outline: 0;
				border-bottom: 1px solid #ccc;
				padding: 2px 5px 3px 5px;
				margin: 2px;
			}

			select.list-dt:focus {
				border-bottom: 2px solid skyblue;
			}

			/*The background card*/
			.card {
				z-index: 0;
				border: none;
				border-radius: 0.5rem;
				position: relative;
			}

			/*FieldSet headings*/
			.fs-title {
				font-size: 25px;
				color: #2C3E50;
				margin-bottom: 10px;
				font-weight: bold;
				text-align: left;
			}

			/*progressbar*/
			#progressbar {
				margin-bottom: 30px;
				overflow: hidden;
				color: lightgrey;
			}

			#progressbar .active {
				color: #000000;
			}

			#progressbar li {
				list-style-type: none;
				font-size: 14px;
				width: 23%;
				float: left;
				position: relative;
			}

			/*Icons in the ProgressBar*/
			#progressbar #account:before {
				font-family: FontAwesome;
				content: "\f291";
			}

			#progressbar #personal:before {
				font-family: FontAwesome;
				content: "\f007";
			}

			#progressbar #payment:before {
				font-family: FontAwesome;
				content: "\f09d";
			}

			#progressbar #confirm:before {
				font-family: FontAwesome;
				content: "\f00c";
			}

			/*ProgressBar before any progress*/
			#progressbar li:before {
				width: 50px;
				height: 50px;
				line-height: 45px;
				display: block;
				font-size: 18px;
				color: #ffffff;
				background: lightgray;
				border-radius: 50%;
				margin: 0 auto 10px auto;
				padding: 2px;
			}

			/*ProgressBar connectors*/
			#progressbar li:after {
				content: '';
				width: 100%;
				height: 2px;
				background: lightgray;
				position: absolute;
				left: 0;
				top: 25px;
				z-index: -1;
			}

			/*Color number of the step and the connector before it*/
			#progressbar li.active:before, #progressbar li.active:after {
				background: #3DD830;
			}

			/*Imaged Radio Buttons*/
			.radio-group {
				position: relative;
				margin-bottom: 25px;
			}

			.radio {
				display:inline-block;
				width: 204;
				height: 104;
				border-radius: 0;
				background: lightblue;
				box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
				box-sizing: border-box;
				cursor:pointer;
				margin: 8px 2px; 
			}

			.radio:hover {
				box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
			}

			.radio.selected {
				box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
			}

			/*Fit image in bootstrap div*/
			.fit-image{
				width: 100%;
				object-fit: cover;
			}
			
		</style>
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
								<h2>Pedidos a proveedores <span id="estatus_pedido"></span></h2>
							</div>
						</div>
						<div class="form-row">
							<div class="col-sm-6 col-12">
								<h5>Estados de pedido</h5>
								<button id="borrador" onclick="traer_tipo('draft')" type="button" class="btn btn-outline-info rounded-pill">Borrador</button>
								<!-- <button id="validado" onclick="traer_tipo('validated')" type="button" class="btn btn-outline-info rounded-pill">Validado</button> -->
								<button id="aprovado" onclick="traer_tipo('approved')" type="button" class="btn btn-outline-info rounded-pill">Aprovado</button>
								<button id="proceso" onclick="traer_tipo('running')" type="button" class="btn btn-outline-info rounded-pill">En proceso</button>
								<button id="inicio" onclick="traer_tipo('received_start')" type="button" class="btn btn-outline-info rounded-pill">Inicio recibido</button>
								<button id="final" onclick="traer_tipo('received_end')" type="button" class="btn btn-outline-info rounded-pill">Final recibido</button>
								<button id="cancelado" onclick="traer_tipo('cancelled')" type="button" class="btn btn-outline-danger rounded-pill">Cancelado</button>
								<!-- <button id="rechazado" onclick="traer_tipo('refused')" type="button" class="btn btn-outline-info rounded-pill">Rechazado</button> -->
							</div>
							<div class="col-sm-6 col-12">
								<h5>Colores por estatus</h5>
								<span style="font-size: 17px;" class="badge badge-primary">Pedido Iniciado</span>
								<span style="font-size: 17px;" class="badge badge-secondary">Respuesta de pedido</span>
								<span style="font-size: 17px;" class="badge badge-success">Pedido finalizado</span>
								<span style="font-size: 17px;" class="badge badge-warning">Pedido no abierto</span>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col">
							<table id="tabla-pedidos" class="table-bordered tabla-responsiva">
								<thead>
									<tr>
										<th scope="col">Ref</th>
										<th scope="col">Autor/solicitante</th>
										<th scope="col">Tercero</th>
										<th scope="col">Fecha prevista de entrega</th>
										<th scope="col">Estado</th>
										<th scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade bd-example-modal-lg" id="proceso-ingreso" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Proceso de ingresos</h5>
						<input id="id_proveedor" hidden>
						<input id="id_pedido" hidden>
					</div>
					<div class="modal-body">
						<!-- MultiStep Form -->
						<div class="container-fluid" id="grad1">
							<div class="form-row">
								<div class="col-12">
									<div class="card">
										<h2><strong>Control de calidad de producto</strong></h2>
										<p>Proceso de ingreso de producto</p>
										<div class="form-row">
											<div class="col-12">
												<div id="msform">
													<!-- progressbar -->
													<ul id="progressbar">
														<li class="active" id="account"><strong></strong></li>
														<li id="personal"><strong></strong></li>
														<li id="payment"><strong></strong></li>
														<li id="confirm"><strong></strong></li>
													</ul>
													<!-- fieldsets -->
													<fieldset>
														<h2 class="fs-title">Productos del pedido</h2>
														<div id="clonar"></div>
														<div class="form-row">
															<div class="col-12">
																<form method="post" id="form-evidencias"></form>
																<table class="table-striped table-bordered tabla-responsiva" id="tabla-productos">
																	<thead> 
																		<th>ID</th>
																		<th>SKU</th>
																		<th>Nombre</th>
																		<th>Precio compra</th>
																		<th>Cantidad solicitada</th>
																		<th>Cantidad entregada</th>
																	</thead>
																</table>
																<div id="enviar_pedido"></div>
															</div>
														</div>
														<input type="button" name="next" class="next action-button d-none" value="Siguiente" onclick="btn_cantidades()" id="btn-cantidades"/>
													</fieldset>
													<fieldset>
														<h2>Lista de productos</h2>
														<table id="lista_productos" class="table-striped table-bordered table-sm tabla-responsiva">
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Nombre</th>
																	<th>Cantidad esperada</th>
																	<th>Cantidad entregada</th>
																	<th>Merma</th>
																	<th>15%</th>
																	<th>Acciones</th>
																</tr>
															</thead>
														</table>
														<div id="enviar_evidencias"></div>
														<!-- asignar permisos -->
													</fieldset>
													<fieldset>
														<h2 class="fs-title">Calificación a proveedor</h2>
														<div class="card">
															<div class="card mb-4 mb-md-0">
																<p class="mb-4"><span class="text-primary font-italic me-1">Calidad</span> Calificacion sobre proveedores
																</p>
																<div id="estrellas"></div>
																<!-- 
																1. Proveedor llegó en tiempo y forma
																2. Producto completo
																3. Calidad de producto
																4. Acomodo correcto de transporte
																-->
																<p class="t-4 mb-1" style="font-size: .77rem;">Proveedor llegó en tiempo y forma</p>
																	<div id="estrellas0" class="starrr"></div>
																<p class="mt-4 mb-1" style="font-size: .77rem;">Producto completo</p>
																	<div id="estrellas1" class="starrr"></div>
																<p class="mt-4 mb-1" style="font-size: .77rem;">Calidad de producto</p>
																	<div id="estrellas2" class="starrr"></div>
																<p class="mt-4 mb-1" style="font-size: .77rem;">Acomodo correcto de transorte</p>
																	<div id="estrellas3" class="starrr"></div>
															</div>
														</div>
														<div id="calificacion">
														
														</div>
													</fieldset>
													<fieldset>
														<div class="form-card">
															<h2 class="fs-title text-center">Estupendo!</h2>
															<br><br>
															<div class="row justify-content-center">
																<div class="col-3">
																	<img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
																</div>
															</div>
															<br><br>
															<div class="row justify-content-center">
																<div class="col-7 text-center">
																	<h5>Has completado el proceso de recepción</h5>
																</div>
																<div id="btn_finalizar"></div>
															</div>
														</div>
													</fieldset>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="editar-proveedor" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Editar proveedor</h5>
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="post" id="formulario_editar">
							<div class="form-row">
								<div class="col-2 form-group">
									<label for="id_proveedor_editar">ID</label>
									<input class="form-control" type="text" id="id_proveedor_editar" name="id_proveedor" readonly>
								</div>
								<div class="col-10 form-group">
									<label for="empresa_editar">Empresa</label>
									<input class="form-control" type="text" id="empresa_editar" name="empresa" required>
								</div>
							</div>
							<div class="form-row">
								<div class="col-6 form-group">
									<label for="direccion_editar">Dirección</label>
									<input class="form-control" type="text" id="direccion_editar" name="direccion">
								</div>
								<div class="col-6 form-group">
									<label for="telefono_editar">Teléfono</label>
									<input class="form-control" type="text" id="telefono_editar" name="telefono">
								</div>
							</div>
							<div class="form-row">
								<div class="col-6 form-group">
									<label for="ciudad_editar">Ciudad</label>
									<input class="form-control" type="text" id="ciudad_editar" name="ciudad">
								</div>
								<div class="col-6 form-group">
									<label for="estado_editar">Estado</label>
									<input class="form-control" type="text" id="estado_editar" name="estado">
								</div>
								<div class="col-12 form-group">
									<label for="contacto_editar">Responsable</label>
									<input class="form-control" type="text" id="contacto_editar" name="contacto">
								</div>
							</div>
							<div class="form-row">
								<div class="col-6 form-group">
									<label for="correo_editar">Correo electrónico</label>
									<input class="form-control" type="text" id="correo_editar" name="correo_electronico">
								</div>
								<div class="col-6 form-group">
									<label for="pagina_editar">Página web</label>
									<input class="form-control" type="text" id="pagina_editar" name="pagina_web">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success" form="formulario_editar">Guardar</button>
						<button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="modal fade" id="visualizar-proveedor" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Visualizar proveedor</h5>
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="post" id="formulario_visualizar">
							<div class="form-row">
								<div class="col-2 form-group">
									<label for="id_proveedor_visualizar">ID</label>
									<input class="form-control" type="text" id="id_proveedor_visualizar" name="id_proveedor" readonly>
								</div>
								<div class="col-10 form-group">
									<label for="empresa_visualizar">Empresa</label>
									<input class="form-control" type="text" id="empresa_visualizar" name="empresa" required>
								</div>
							</div>
							<div class="form-row">
								<div class="col-6 form-group">
									<label for="direccion_visualizar">Dirección</label>
									<input class="form-control" type="text" id="direccion_visualizar" name="direccion">
								</div>
								<div class="col-6 form-group">
									<label for="telefono_visualizar">Teléfono</label>
									<input class="form-control" type="text" id="telefono_visualizar" name="telefono">
								</div>
							</div>
							<div class="form-row">
								<div class="col-6 form-group">
									<label for="ciudad_visualizar">Ciudad</label>
									<input class="form-control" type="text" id="ciudad_visualizar" name="ciudad">
								</div>
								<div class="col-6 form-group">
									<label for="estado_visualizar">Estado</label>
									<input class="form-control" type="text" id="estado_visualizar" name="estado">
								</div>
								<div class="col-12 form-group">
									<label for="contacto_visualizar">Responsable</label>
									<input class="form-control" type="text" id="contacto_visualizar" name="contacto">
								</div>
							</div>
							<div class="form-row">
								<div class="col-6 form-group">
									<label for="correo_visualizar">Correo electrónico</label>
									<input class="form-control" type="text" id="correo_visualizar" name="correo_electronico">
								</div>
								<div class="col-6 form-group">
									<label for="pagina_visualizar">Página web</label>
									<input class="form-control" type="text" id="pagina_visualizar" name="pagina_web">
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-success">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
		
		<?php $this->load->view('include/scripts');  ?>
		<script src="<?= base_url() ?>static/js/pedidos/pedidos.js"></script>
		<script src="<?= base_url() ?>static/js/starrr.js"></script>
	</body>
</html>
