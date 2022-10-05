<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=1024">
		<link rel="stylesheet" href="<?= base_url() ?>static/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>static/css/reporte.css">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>/img/favicon.png">
		<title>Cotización generada</title>
		<style type="text/css">
			@media print { body { -webkit-print-color-adjust: exact; } }
			.row {
			  display: -webkit-box;
			  display: flex;
			  flex-wrap: wrap; 
			}
		</style>
	</head>
	<body>
		<div class="container pb-2">
			<div class="row mb-2 mt-2">
				<div class="col-6">
					<img src="<?= base_url() ?>/img/logoazul.png" width="115" height="100">
				</div>
				<div class="col-6 text-right">
					<span class="font-weight-bold texto-azul">Energía solar</span>
				</div>
			</div>
			<nav class="p-2" style="background:#087E88;">
				<span class="navbar-text" style="color:#FFFFFF">
					<span id="nombre-cliente">HÉCTOR LÓPEZ DONJUÁN</span><br>
					<center><img src="<?= base_url() ?>/img/Imagen_1.png" width="196" height="165"></center>
					<center>Juntos somos energía</center>
				</span>
			</nav>
			<nav class="fondo-azul">
					<div class="row h-100 p-2">
						<div class="col-9">
							<span class="navbar-text" style="color:#05405F">
							Propuesta personalizada<br>
							Ubicada en <span id="ubicacion">Av. Los Robles 234 Querétaro</span><br>
							Asesor comercial: <span id="nombre-asesor">Ing. María de la Cruz Mejía</span>
							</span>
						</div>
						<div class="col-3 my-auto">
							<span>
								Vigencia de cotización:
							</span><br>
							<span id="fecha_vigencia">
								26/06/2021
							</span>
						</div>
					</div>
			</nav>
			<div class="row no-gutters p-2 fondo-gris mb-2 text-center">
				<div class="col-4 text-left">
					<h3>Diagnóstico</h3>
				</div>
				<div class="col-2 my-auto">
					<span class="text-amarillo">
						Diagnóstico
					</span>
				</div>
				<div class="col-2 my-auto">
					<span>
						Propuesta
					</span>
				</div>
				<div class="col-2 my-auto">
					<span>
						Cotización
					</span>
				</div>
				<div class="col-2 my-auto">
					<span>
						Pago
					</span>
				</div>
			</div>
			<div class="pr-5 pl-5">
				<div class="row">
					<div class="col">
						<h4>Diagnóstico de servicio</h4>
						<hr style="background:#FEDE2F">
					</div>
				</div>
				<div class="row no-gutters text-center mb-4 mt-4">
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center">
						<div style="font-size: large">Consumo <br>promedio</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center pr-md-1">
						<div style="font-size: large" id="consumo-promedio">800 kWh</div>
					</div>
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center pl-md-1">
						<div style="font-size: large">Consumo <br>promedio ($)</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center">
						<div style="font-size: large" id="consumo-pesos">$ 1,784.00</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<div style="margin-left:auto margin-right:auto">
							<center><img id="imagen-grafica" width="100%" height="100%"></center>
						</div>
					</div>
				</div>
			</div>
			<div class="row no-gutters p-2 fondo-gris mb-2 text-center mt-4">
				<div class="col-4 text-left">
					<h3>Propuesta y análisis</h3>
				</div>
				<div class="col-2 my-auto">
					<span>
						Diagnóstico
					</span>
				</div>
				<div class="col-2 my-auto">
					<span class="text-amarillo">
						Propuesta
					</span>
				</div>
				<div class="col-2 my-auto">
					<span>
						Cotización
					</span>
				</div>
				<div class="col-2 my-auto">
					<span>
						Pago
					</span>
				</div>
			</div>
			<div class="pr-5 pl-5">
				<div class="row">
					<div class="col">
						<h4>Información del sistema</h4>
						<hr style="background:#FEDE2F">
					</div>
				</div>
				<div class="row no-gutters text-center mb-2">
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center">
						<div style="font-size: large">Número de <br>paneles</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center pr-md-1">
						<div style="font-size: large" id="numero-paneles">13</div>
					</div>
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center pl-md-1">
						<div style="font-size: large">Producción <br>anual</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center">
						<div style="font-size: large" id="produccion-anual">8,106.23 kWh</div>
					</div>
				</div>
				<div class="row no-gutters text-center mb-4">
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center">
						<div style="font-size: large">Tipo de <br>sistema</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center pr-md-1">
						<div style="font-size: large" id="tipo-interconexion">Inversor central con optimizadores</div>
					</div>
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center pl-md-1">
						<div style="font-size: large">Producción <br>bimestral</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center">
						<div style="font-size: large" id="produccion-bimestral">1,493 kWh</div>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<h4>Ahorros estimados</h4>
						<hr style="background:#FEDE2F">
					</div>
				</div>
				<table class="table text-center tabla-azul">
					<thead>
						<th>Periodo</th>
						<th>Actual</th>
						<th class="text-amarillo">Con AAMPERIA</th>
						<th>Ahorro</th>
					</thead>
					<tbody id="ahorros-estimados">
						
					</tbody>
				</table>
			</div>
			<div class="row no-gutters p-2 fondo-gris mb-4 text-center mt-4">
				<div class="col-4 text-left">
					<h3>Cotización</h3>
				</div>
				<div class="col-2 my-auto">
					<span>
						Diagnóstico
					</span>
				</div>
				<div class="col-2 my-auto">
					<span>
						Propuesta
					</span>
				</div>
				<div class="col-2 my-auto">
					<span class="text-amarillo">
						Cotización
					</span>
				</div>
				<div class="col-2 my-auto">
					<span>
						Pago
					</span>
				</div>
			</div>
			<div class="pr-5 pl-5">
				<table class="table text-center tabla-azul">
					<thead>
						<th>Sistema</th>
						<th>Cantidad</th>
						<th>P. Unitario</th>
						<th>Importe</th>
					</thead>
					<tbody id="sistema">
						
					</tbody>
				</table>
				<div class="row text-center">
					<div class="col-6 my-auto">
						<div class="fondo-azul-oscuro text-white">
							<h2>Retorno de inversión</h2>
						</div>
						<h1 id="retorno-inversion"></h1>
					</div>
					<div class="col-6">
						<table class="table table-borderless tabla-totales font-weight-bold">
							<tbody>
								<tr>
									<td>SUBTOTAL</td>
									<td id="subtotal"></td>
								</tr>
								<tr>
									<td>IVA</td>
									<td id="iva"></td>
								</tr>
								<tr>
									<td>TOTAL</td>
									<td id="total"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row no-gutters p-2 fondo-gris mb-4 text-center mt-4">
				<div class="col-4 text-left">
					<h3>Pago</h3>
				</div>
				<div class="col-2 my-auto">
					<span>
						Diagnóstico
					</span>
				</div>
				<div class="col-2 my-auto">
					<span>
						Propuesta
					</span>
				</div>
				<div class="col-2 my-auto">
					<span>
						Cotización
					</span>
				</div>
				<div class="col-2 my-auto">
					<span class="text-amarillo">
						Pago
					</span>
				</div>
			</div>
			<div class="pr-5 pl-5">
				<div class="row">
					<div class="col">
						<h4>Condiciones de pago</h4>
						<hr style="background:#FEDE2F">
					</div>
				</div>
				<div class="row text-center condiciones-pago mb-2">
					<div class="col-6 fondo-azul-oscuro text-white">
						Anticipo
					</div>
					<div class="col-3">
						70%
					</div>
					<div class="col-3 borde-amarillo" id="fin-instalacion-result">
						$ 78,694.00
					</div>
				</div>
				<div class="row text-center condiciones-pago mb-2">
					<div class="col-6 fondo-azul-oscuro text-white">
						Finalizar la instalación
					</div>
					<div class="col-3">
						20%
					</div>
					<div class="col-3 borde-amarillo" id="fin-instalacion-result">
						$ 25,293.00
					</div>
				</div>
				<div class="row text-center condiciones-pago">
					<div class="col-6 fondo-azul-oscuro text-white">
						Cambio de medidor CFE
					</div>
					<div class="col-3">
						10%
					</div>
					<div class="col-3 borde-amarillo" id="cambio-medidor-result">
						$ 8,239.00
					</div>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col">
					<h3>Términos y condiciones</h3>
					<ul>
						<li>Precios en MXN.</li>
						<li>Tipo de cambio: $ 20.12</li>
						<li>Vigencia de cotización: 05/06/2021</li>	
						<li>Tiempo de entrega máximo: 4 semanas.</li>				
					</ul>
					<div id="terminos"></div>
				</div>
			</div>
		</div>
	</body>
</html>