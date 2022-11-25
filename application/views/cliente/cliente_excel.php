<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Subir excel</title>
</head>
<body>
	<script>var id_usuario = <?= $this->session->usuario['id_usuario'];?>;</script>
	<div class="wrapper d-flex align-items-stretch">
	<?php $this->load->view('include/menu_lateral_cliente', $datos_pagina);  ?>
	<div id="content" class="main">
			<div class="container-fluid">
				<div>
					<h1>Ingresa el excel</h1>
					<form id="formulario" method="post">
						<div class="form-row">
							<div class="col-12 col-sm-6">
								<input type="file" id="inputBox" name="excel">
							</div>
							<div class="col-12 col-sm-6">
								<a href="<?= base_url() ;?>cliente/export" class="btn btn-danger float-right">Descargar plantilla <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
							</div>
						</div>
					</form>
				</div>
				<div class="form-row">
						<div class="col-4">
							<span> 	Fecha de pedido: </span><input id="fecha-pedido" type="date" class="form-control" min="<?= date("Y-m-d") ?>">
						</div>
						<div class="col-4">
							<span> 	Hora de pedido: </span><input id="hora-pedido" type="time" class="form-control" min="<?= date("Y-m-d") ?>">
						</div>
				</div>
				<!-- <div id="pedido_anterior" class="d-none">
					<center><h5>Tiene un registro anterior. deseas repetirlo o hacer uno nuevo?</h5></center>
					<hr>
					<div class="form-row">
						<div class="col-4">
							<span> 	Fecha de pedido: </span><input type="date" class="form-control" min="<?= date("Y-m-d") ?>">
						</div>
						<div class="col-8">
							<button class="btn btn-info float-right">Repetir pedido</button>
							<button class="btn btn-primary float-right" onclick="eliminar_excel()">Hacer nuevo pedido</button>
						</div>
					</div>
				</div> -->
				<hr>
			</div>
			<div class="container" id="div-tabla">
				<table class="table tabla-responsiva">
				<caption>Solicitud de pedido</caption>
					<thead>
						<th scope="col">ID</th>
						<th scope="col">SKU</th>
						<th scope="col">Item</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Precio de venta</th>
					</thead>
					<tbody id="tabla-pedido"></tbody>
				</table>
				<div class="alert alert-danger d-none" id="alerta-error">
  					<strong>Error! </strong><span id="alerta-mensaje"></span>
				</div>
				<div class="form-row">
					<div class="col-12 col-sm-6">
						<button class="btn btn-danger btn-block float-right" onclick="eliminar_excel();">Cancelar pedido</button>
					</div>
					<div class="col-12 col-sm-6" id="btn-confirmar">
						
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
<div class="modal fade" id="modal-resumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
			<div class="col-12">
				<h5><b>Detalles de facturacion</b></h5>
			</div><hr>
			<div class="col-6 col-sm-12">
				<span><b>Fecha de pago:</b> </span><span id="resumen-fecha"></span>
			</div>
			<div class="col-6 col-sm-12">
				<span><b>Hora de pago:</b> </span><span id="resumen-hora"></span>
			</div><hr>
			<div class="col-12">
				<table class="table tabla-responsiva">
					<thead>
						<th scope="col">Producto</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Subtotal</th>
					</thead>
					<tbody id="resumen-productos"></tbody>
				</table>
			</div>
			<div class="col-6"><span><b>TOTAL</b></span></div>
			<div class="col-6"><span id="resumen-total"></span></div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <div id="btn-resumen-confirmar"></div>
      </div>
    </div>
  </div>
</div>
	<?php $this->load->view('include/header', $datos_pagina); ?>
	<?php $this->load->view('include/scripts');  ?>
	<script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
	<script src="<?= base_url(); ?>static/js/cliente/cliente_excel.js"></script>
</body>
</html>
