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
							<h2>Aprobar recepción</h2>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col">
						<section style="background-color: #eee;">
							<table class="table-bordered tabla-responsiva" id="tabla">
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
							</table>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade bd-example-modal-lg" id="evidencias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Aprobar evidencias</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container mt-5 mb-5">
					<input id="id_pedido" hidden>
						
						<div class="d-flex justify-content-center row">
							<div class="col-md-10" id="aprobar_evidencia">
								
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				<div class="row" id="cambiar_status">
							
				</div><br>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('include/scripts');  ?>
	<script src="<?= base_url() ?>static/js/pedidos/aprobar.js"></script>
</body>

</html>
