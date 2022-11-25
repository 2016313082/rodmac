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
							<h2>Gestión de usuarios</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 col-12 d-flex justify-content-center align-items-end">
							<button class="btn btn-success btn-block" type="button" data-toggle="modal" data-target="#agregar-usuario">Agregar nuevo usuario</button>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col">
						<table id="tabla-usuarios" class="table-striped table-bordered tabla-responsiva">
							<thead>
								<tr>
									<th scope="col">Nombre</th>
									<th scope="col">Correo</th>
									<th scope="col">Usuario</th>
									<th scope="col">Teléfono</th>
									<th scope="col">Nivel</th>
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
						<h5>Entrega de pedido</h5>
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="requisitos_entrega">Requisitos de entrega</label>
								<input class="form-control" type="text" placeholder="Ej. Tipo de vestimenta o cuidados e higiene, copias de factura a la entrega, etc. " id="requisitos_entrega" name="requisitos_entrega" required>
							</div>
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
								<input class="form-control" id="nivel" name="nivel" value="Cliente" readonly required>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="nombre_comercial">Nombre comercial</label>
								<input class="form-control" type="text" id="nombre_comercial" name="nombre_comercial" required>
							</div>
							<div class="col-6 form-group">
								<label for="razon_social">Razon social</label>
								<input class="form-control" id="razon_social" name="razon_social" required>
							</div>
							<div class="col-6 form-group">
								<label for="rfc">RFC</label>
								<input class="form-control" id="rfc" name="rfc" required>
							</div>
							<div class="col-6 form-group">
								<label for="banco">Banco</label>
								<input class="form-control" id="banco" name="banco" required>
							</div>
							<div class="col-6 form-group">
								<label for="nombre_titular">Nombre/titular de la cuenta</label>
								<input class="form-control" id="nombre_titular" name="nombre_titular" required>
							</div>
							<div class="col-6 form-group">
								<label for="num_cuenta">No. de cuenta</label>
								<input class="form-control" id="num_cuenta" name="num_cuenta" required>
							</div>
							<div class="col-6 form-group">
								<label for="cuenta_clabe">Cuenta CLABE</label>
								<input class="form-control" id="cuenta_clabe" name="cuenta_clabe" required>
							</div>
						</div>
						<hr>
						<h5>Datos de facturacion</h5>
						<div class="form-row">
							<div class="col-6 form-group">
								<label for="direccion_fiscal">Direccion fiscal</label>
								<input class="form-control" type="text" id="direccion_fiscal" name="direccion_fiscal" required>
							</div>
							<div class="col-6 form-group">
								<label for="cfdi">Uso CFDI</label>
								<input class="form-control" id="cfdi" name="cfdi" required>
							</div>
							<div class="col-6 form-group">
								<label for="metodo_pago">Metodo de pago</label>
								<input class="form-control" id="metodo_pago" name="metodo_pago" required>
							</div>
							<div class="col-6 form-group">
								<label for="forma_pago">Forma de pago</label>
								<input class="form-control" id="forma_pago" name="forma_pago" required>
							</div>
							<div class="col-6 form-group">
								<label for="fecha_pago">Fechas de pago (credito)</label>
								<input class="form-control" id="fecha_pago" name="fecha_pago" type="date" required>
							</div>
							<div class="col-6 form-group">
								<label for="Correo facturas">Correo facturas</label>
								<input class="form-control" id="correo_facturas" name="correo_facturas" required>
							</div>
						</div>
						<hr>
						<div class="form-row">
							<h5>Documentos requeridos</h5>
							<div class="col-12 form-group">
								<label for="constancia_fiscal">Constancia de situacion fiscal</label>
								<input class="form-control" type="file" id="constancia_fiscal" name="constancia_fiscal" required>
							</div>
							<div class="col-12 form-group">
								<label for="cif">CIF (Codigo de identificacion fiscal)</label>
								<input class="form-control" type="file" id="cif" name="cif" required>
							</div>
							<div class="col-12 form-group">
								<label for="comprobante_dom">Comprobante de domicilio</label>
								<input class="form-control" type="file" id="comprobante_dom" name="comprobante_dom" required>
							</div>
							<div class="col-12 form-group">
								<label for="copia_ine">Copia INE del representante</label>
								<input class="form-control" type="file" id="copia_ine" name="copia_ine" required>
							</div>
							<div class="col-12 form-group">
								<label for="acta_constitutiva">Acta constitutiva</label>
								<input class="form-control" type="file" id="acta_consitutiva" name="acta_constitutiva" required>
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
						<h5>Entrega de pedido</h5>
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="requisitos_entrega_editar">Requisitos de entrega</label>
								<input class="form-control" type="text" placeholder="Ej. Tipo de vestimenta o cuidados e higiene, copias de factura a la entrega, etc. " id="requisitos_entrega_editar" name="requisitos_entrega" required>
							</div>
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
								<input class="form-control" name="nivel" id="nivel_editar" value="Cliente" readonly required>
							</div>
						</div>
						<div class="form-row">
							<div class="col-12 form-group">
								<label for="nombre_comercial">Nombre comercial</label>
								<input class="form-control" type="text" id="nombre_comercial_editar" name="nombre_comercial" required>
							</div>
							<div class="col-6 form-group">
								<label for="razon_social">Razon social</label>
								<input class="form-control" id="razon_social_editar" name="razon_social" required>
							</div>
							<div class="col-6 form-group">
								<label for="rfc">RFC</label>
								<input class="form-control" id="rfc_editar" name="rfc" required>
							</div>
							<div class="col-6 form-group">
								<label for="banco">Banco</label>
								<input class="form-control" id="banco_editar" name="banco" required>
							</div>
							<div class="col-6 form-group">
								<label for="nombre_titular">Nombre/titular de la cuenta</label>
								<input class="form-control" id="nombre_titular_editar" name="nombre_titular" required>
							</div>
							<div class="col-6 form-group">
								<label for="num_cuenta">No. de cuenta</label>
								<input class="form-control" id="num_cuenta_editar" name="num_cuenta" required>
							</div>
							<div class="col-6 form-group">
								<label for="cuenta_clabe">Cuenta CLABE</label>
								<input class="form-control" id="cuenta_clabe_editar" name="cuenta_clabe" required>
							</div>
						</div>
						<hr>
						<h5>Datos de facturacion</h5>
						<div class="form-row">
							<div class="col-6 form-group">
								<label for="direccion_fiscal">Direccion fiscal</label>
								<input class="form-control" type="text" id="direccion_fiscal_editar" name="direccion_fiscal" required>
							</div>
							<div class="col-6 form-group">
								<label for="cfdi">Uso CFDI</label>
								<input class="form-control" id="cfdi_editar" name="cfdi" required>
							</div>
							<div class="col-6 form-group">
								<label for="metodo_pago">Metodo de pago</label>
								<input class="form-control" id="metodo_pago_editar" name="metodo_pago" required>
							</div>
							<div class="col-6 form-group">
								<label for="forma_pago">Forma de pago</label>
								<input class="form-control" id="forma_pago_editar" name="forma_pago" required>
							</div>
							<div class="col-6 form-group">
								<label for="fecha_pago">Fechas de pago (credito)</label>
								<input class="form-control" id="fecha_pago_editar" name="fecha_pago" type="date" required>
							</div>
							<div class="col-6 form-group">
								<label for="Correo facturas">Correo facturas</label>
								<input class="form-control" id="correo_facturas_editar" name="correo_facturas" required>
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

	<div class="modal fade" id="ver_docs" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ver documentos</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row" id="docs">

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
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

		<?php $this->load->view('include/scripts');  ?>
		<script src="<?= base_url() ?>static/js/usuarios/clientes.js"></script>
		<script>
			$('[data-toggle="tooltip"]').tooltip();
		</script>
</body>

</html>

<!-- 
	Este codigo sirve para las notificaciones push de google
<section style="text-align: center; margin-top: 10%;">
        <button style="padding: 7px;" id="notificar">
            Notificar...
        </button>
        <button style="padding: 7px;" id="vernotificacion">
            Ver Notificacion...
        </button> 
    </section> -->
