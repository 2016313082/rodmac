<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php $this->load->view('include/header', $datos_pagina); ?>
</head>
<body>
	<div id="content" class="main">
            <!-- BARRA SUPERIOR DE USUARIO -->
            <?php $this->load->view('include/barra_superior', $datos_pagina);  ?>
			<div id="contenido" class="container-fluid">
				<div class="col-auto text-center">
					<h1>¿Qué quieres hacer?</h1>
				</div>
				<div class="vh-100 row m-0 text-enter align-items-center justify-content-center">
					<form id="login-form" class="text-center" method="post" action="<?= base_url() ?>cliente/tienda">
							<div class="form-group mt-4">
								<button class="btn-success">Comprar</button>
								<button class="btn-warning">Cargar excel</button>
							</div>
						</form>					
				</div>
			</div>
	</div>
	
	<!--Scripts-->
	<?php $this->load->view('include/scripts');  ?>
	<script src="<?= base_url() ?>/static/js/dashboard/dashboard.js"></script>
</body>
</html>
