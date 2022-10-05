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
								<h2>Cuentas bancarias</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 offset-sm-6 col-12 d-flex justify-content-center align-items-end">
								<button class="btn btn-success btn-block" type="button" data-toggle="modal" data-target="#agregar-proveedor">Agregar nueva cuenta bancaria</button>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col">
							<table id="tabla-proveedores" class="table-striped table-bordered tabla-responsiva">
								<thead>
									<tr>
										<th scope="col">Nombre cuenta</th>
										<th scope="col">Titular</th>
										<th scope="col">Tipo</th>
										<th scope="col">Banco</th>
										<th scope="col">No. Cuenta</th>
										<th scope="col">Clabe</th>
										<th scope="col">Desarrollo</th>
                                        <th scope="col">Saldo</th>
                                        <th scope="col">Transacciones</th>
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

		<div class="modal fade" id="agregar-proveedor" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Agregar nueva cuenta bancaria</h5>
						<button type="button" class="close" data-dismiss="modal">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="post" id="formulario_agregar">
							<div class="form-row">
								<div class="col-12 form-group">
									<label for="empresa_nuevo">Nombre de la cuenta</label>
									<input class="form-control" type="text" id="empresa_nuevo" name="empresa" required>
								</div>
							</div>
							<div class="form-row">
								<div class="col-6 form-group">
									<label for="ciudad_nuevo">Tipo de cuenta</label>
									<input class="form-control" type="text" id="ciudad_nuevo" name="ciudad">
								</div>
								<div class="col-6 form-group">
									<label for="direccion_nuevo">Nombre del banco</label>
									<input class="form-control" type="text" id="direccion_nuevo" name="direccion" required>
								</div>
							</div>
							<div class="form-row">
								<div class="col-4 form-group">
									<label for="estado_nuevo">Numero de la cuenta</label>
									<input class="form-control" type="text" id="estado_nuevo" name="estado">
								</div>
								<div class="col-4 form-group">
									<label for="contacto_nuevo">CLABE</label>
									<input class="form-control" type="text" id="contacto_nuevo" name="contacto">
								</div>
								<div class="col-4 form-group">
									<label for="telefono_nuevo">Titular</label>
									<input class="form-control" type="text" id="telefono_nuevo" name="telefono">
								</div>
							</div>
							<div class="form-row">
								<div class="col-6 form-group">
									<label for="pagina_nuevo">Direccion</label>
									<input class="form-control" type="text" id="pagina_nuevo" name="pagina_web">
								</div>
								<div class="col-6 form-group">
									<label for="correo_nuevo">Saldo inicial</label>
									<input class="form-control" type="text" id="correo_nuevo" name="correo">
								</div>
							</div>
                            <div class="form-row">
								<div class="col-6 form-group">
									<label for="pagina_nuevo">Estatus</label>
									<input class="form-control" type="text" id="estatus_nuevo" name="pagina_web">
								</div>
								<div class="col-6 form-group">
									<label for="correo_nuevo">Desarrollo relacionado</label>
									<input class="form-control" type="text" id="estatus_nuevo" name="correo">
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
		<script src="<?= base_url() ?>static/js/bancos/bancos.js"></script>
	</body>
</html>