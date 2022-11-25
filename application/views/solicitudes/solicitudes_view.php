<!doctype html>
<html lang="en">

<head>
	<?php $this->load->view('include/header', $datos_pagina); ?>
	<script>
		var usuario = <?= json_encode($this->session->usuario) ?>;
		var nivel = "<?= $this->session->usuario['nivel'] ?>";
	</script>
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
							<h2>Gestión de solicitudes</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<button class="btn btn-warning" onclick="ver_anteriores()">ver solicitudes anteriores</button>
							<button class="btn btn-info" onclick="traer_solicitudes()">ver solicitudes pendientes</button>
							<div id="add_solicitud"><button class="btn btn-success float-right" onclick="agregar_solicitud()">Agregar solicitud</button></div>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col">
						<table id="tabla-solicitud" class="table-striped table-bordered tabla-responsiva">
							<thead>
								<tr>
									<th scope="col">Nombre</th>
									<th scope="col">Fecha</th>
									<th scope="col">Hora</th>
									<th scope="col">Subtotal</th>
									<th scope="col">Descuento</th>
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

	<div class="modal fade" id="agregar-usuario" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Agregar usuario</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" id="formulario_agregar">
						<div class="form-row">
							<div class="col-6 form-group">
								<label for="usuario_nuevo">Usuario</label>
								<input class="form-control" type="text" id="usuario_nuevo" name="usuario" required>
							</div>
							<div class="col-6 form-group">
								<label for="contrasenia_nuevo">Contraseña</label>
								<input class="form-control" type="password" id="contrasenia_nuevo" name="contrasenia" required>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="correo_nuevo">Correo electrónico</label>
								<input class="form-control" type="email" id="correo_nuevo" name="correo" required>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="nombre_nuevo">Nombre(s)</label>
								<input class="form-control" type="text" id="nombre_nuevo" name="nombre" required>
							</div>
							<div class="col-6 form-group">
								<label for="apellido_paterno_nuevo">Apellido paterno</label>
								<input class="form-control" type="text" id="apellido_paterno_nuevo" name="apellido_paterno">
							</div>
							<div class="col-6 form-group">
								<label for="apellido_materno_nuevo">Apellido materno</label>
								<input class="form-control" type="text" id="apellido_materno_nuevo" name="apellido_materno">
							</div>
						</div>
						<div class="form-row">
							<div class="col-6 form-group">
								<label for="telefono_nuevo">Teléfono</label>
								<input class="form-control" type="number" id="telefono_nuevo" name="telefono" required>
							</div>
							<div class="col-6 form-group">
								<label for="nivel_editar">Nivel de usuario</label>
								<select class="form-control" name="nivel" id="nivel" required>
									<option selected disabled>Selecciona un nivel</option>
									<option value="Propietario">Propietario</option>
									<option value="Administrador">Administrador</option>
									<option value="Empleado">Empleado</option>
									<option value="Inactivo">Inactivo</option>
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" form="formulario_agregar">Agregar</button>
					<button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editar-usuario" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Editar usuario</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" id="formulario_editar">
						<div class="form-row">
							<div class="col-2 form-group">
								<label for="id_usuario_editar">ID</label>
								<input class="form-control" type="text" id="id_usuario_editar" name="id_usuario" readonly>
							</div>
							<div class="col-10 form-group">
								<label for="usuario_editar">Usuario</label>
								<input class="form-control" type="text" id="usuario_editar" name="usuario" required>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="correo_editar">Correo electrónico</label>
								<input class="form-control" type="email" id="correo_editar" name="correo" required>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="nombre_editar">Nombre(s)</label>
								<input class="form-control" type="text" id="nombre_editar" name="nombre">
							</div>
							<div class="col-6 form-group">
								<label for="apellido_paterno_editar">Apellido paterno</label>
								<input class="form-control" type="text" id="apellido_paterno_editar" name="apellido_paterno">
							</div>
							<div class="col-6 form-group">
								<label for="apellido_materno_editar">Apellido materno</label>
								<input class="form-control" type="text" id="apellido_materno_editar" name="apellido_materno">
							</div>
						</div>
						<div class="form-row">
							<div class="col-6 form-group">
								<label for="telefono_editar">Teléfono</label>
								<input class="form-control" type="text" id="telefono_editar" name="telefono" required>
							</div>
							<div class="col-6 form-group">
								<label for="nivel_editar">Nivel de usuario</label>
								<select class="form-control" name="nivel" id="nivel_editar" required>
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button id="enviar_edit" type="submit" class="btn btn-success" form="formulario_editar">Guardar</button>
					<button type="button" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="ver" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ver productos</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-hover table-sm">
						<thead>
							<th>SKU</th>
							<th>Nombre</th>
							<th>Cantidad</th>
							<th>Subtotal</th>
							<th>Descuento</th>
						</thead>
						<tbody id="tabla-productos"></tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
					<div id="btn-enviar"></div>

				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="id_dolibar" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Agregar usuario de dolibarr</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table id="tabla-dolibar" class="table-striped table-bordered tabla-responsiva">
						<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Correo</th>
								<th scope="col">Acción</th>
							</tr>
						</thead>
						<tboady>

						</tboady>
					</table>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="generar_solicitud">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Agregar solicitud de pedido</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('include/scripts');  ?>
	<script src="<?= base_url() ?>static/js/solicitudes/solicitudes	.js"></script>
	<script>
		$('[data-toggle="tooltip"]').tooltip();
	</script>
</body>

</html>
