<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="<?= base_url() ?>static/css/bootstrap3.min.css">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<!--<link rel="stylesheet" href="<?= base_url() ?>/static/bootstrap-3.3.6/dist/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="<?= base_url() ?>/static/css/prueba_reporte.css">
		
		<!--<link rel="stylesheet" href="<?= base_url() ?>/static/css/prueba_reporte.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
		<title>Cotización generada</title>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-6">
					<img src="<?= base_url() ?>/img/logoazul.png" width="115" height="100">
				</div>
				<div class="col-xs-6">
					<span class="font-weight-bold texto-azul">Energía solar</span>
				</div>
			</div>
			<nav class="navbar" style="background:#087E88;">
				<span class="navbar-text" style="color:#FFFFFF">
					HECTOR MACÍAS GUZMÁN<br>
					<center><img src="<?= base_url() ?>/img/Imagen_1.png" width="196" height="165"></center>
					<center>Juntos somos energía</center>
				</span>
			</nav>
			<nav class="fondo-azul navbar">
					<div class="row">
						<div class="col-xs-9">
							<span class="navbar-text" style="color:#05405F">
							Propuesta personalizada<br>
							Ubicada en AV. DE LA LUZ 234 QUERÉTARO, QRO. <br>
							Asesor comercial: Ing. María de la Cruz Mejía
							</span>
						</div>
						<div class="col-xs-3">
							<label for="vigencia">
								Vigencia de cotización:
							</label>
							<input class="form-control input-sm" id="vigencia" placeholder="Fecha de vencimiento" type="date">
						</div>
					</div>
			</nav>
			<div class="row fondo-gris">
				<div class="col-xs-4 text-left">
					<h3>Diagnóstico</h3>
				</div>
				<div class="col-xs-2">
					<span class="text-amarillo">
						Diagnóstico
					</span>
				</div>
				<div class="col-xs-2">
					<span>
						Propuesta
					</span>
				</div>
				<div class="col-xs-2">
					<span>
						Cotización
					</span>
				</div>
				<div class="col-xs-2">
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
				<div class="row no-gutters text-center mb-4">
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center">
						<div style="font-size: large">Consumo <br>promedio (kWh)</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center pr-md-1">
						<div style="font-size: large">828.12 kWh</div>
					</div>
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center pl-md-1">
						<div style="font-size: large">Consumo <br>promedio ($)</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center">
						<div style="font-size: large">$ 2632.01</div>
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
						<div style="font-size: large">8</div>
					</div>
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center pl-md-1">
						<div style="font-size: large">Producción <br>anual</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center">
						<div style="font-size: large">4632.01</div>
					</div>
				</div>
				<div class="row no-gutters text-center mb-4">
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center">
						<div style="font-size: large">Tipo de <br>sistema</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center pr-md-1">
						<div style="font-size: large">Inversor central (austero)</div>
					</div>
					<div class="col-3 text-white fondo-azul-oscuro d-flex justify-content-center align-items-center pl-md-1">
						<div style="font-size: large">Producción <br>bimestral</div>
					</div>
					<div class="col-3 fondo-azul text-dark d-flex justify-content-center align-items-center">
						<div style="font-size: large">772.00 kWh</div>
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
					<tbody>
						<tr>
							<th>Bimestral</th>
							<td>$4,415.56 </td>
							<td>$52.00</td>
							<td>$4,363.56</td>
						</tr>
						<tr>
							<th>1er Año</th>
							<td>$26,493.36</td>
							<td>$312.00</td>
							<td>$26,181.36</td>
						</tr>
						<tr>
							<th>5 años</th>
							<td>$138,447.03 </td>
							<td>$1,560.00</td>
							<td>$136,887.03</td>
						</tr>
						<tr>
							<th>10 años</th>
							<td>$306,795.24</td>
							<td>$3,120.00</td>
							<td>$303,675.24</td>
						</tr>
						<tr>
							<th>25 años</th>
							<td>$991,246.87</td>
							<td>$7,800.00</td>
							<td>$983,446.87</td>
						</tr>
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
					<tbody>
						<tr>
							<th>Modulo Seraphim 385 W  (Precio por watt)</th>
							<td>8</td>
							<td>$3,109.04</td>
							<td>$24,872.36</td>
						</tr>
						<tr>
							<th>Sistema de Monitoreo Envoy IQ ENV-IQ-AM1-240 M</th>
							<td>1</td>
							<td>$7,851.81</td>
							<td>$7,851.81</td>
						</tr>
						<tr>
							<th>Fronius Primo 10.0-1 208/240</th>
							<td>1</td>
							<td>$64,815.03</td>
							<td>$64,815.03</td>
						</tr>
						<tr>
							<th>-</th>
							<td>1</td>
							<td>-</td>
							<td>-</td>
						</tr>
						<tr>
							<th>Material E instalación</th>
							<td>1</td>
							<td>$16,170.00</td>
							<td>$16,170.00</td>
						</tr>
						<tr>
							<th>ESTRUCTURA SENCILLA  72 CELDAS</th>
							<td>1</td>
							<td>$5,236.61</td>
							<td>$5,236.61</td>
						</tr>
						<tr>
							<th>Medidor de CFE</th>
							<td>1</td>
							<td>-</td>
							<td>-</td>
						</tr>
					</tbody>
				</table>
				<div class="row text-center">
					<div class="col-6 my-auto">
						<div class="fondo-azul-oscuro text-white">
							<h2>Retorno de inversión</h2>
						</div>
						<h1>4 años</h1>
					</div>
					<div class="col-6">
						<table class="table table-borderless tabla-totales font-weight-bold">
							<tbody>
								<tr>
									<td>SUBTOTAL</td>
									<td>$ 118,945.81</td>
								</tr>
								<tr>
									<td>IVA</td>
									<td>$ 19,031.33</td>
								</tr>
								<tr>
									<td>TOTAL</td>
									<td>$ 137,977.14</td>
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
						<div class="input-group">
							<input type="number" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</div>
					<div class="col-3 borde-amarillo">
						$ 159,273.23
					</div>
				</div>
				<div class="row text-center condiciones-pago mb-2">
					<div class="col-6 fondo-azul-oscuro text-white">
						Finalizar la instalación
					</div>
					<div class="col-3">
						<div class="input-group">
							<input type="number" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</div>
					<div class="col-3 borde-amarillo">
						$ 159,273.23
					</div>
				</div>
				<div class="row text-center condiciones-pago">
					<div class="col-6 fondo-azul-oscuro text-white">
						Cambio de medidor CFE
					</div>
					<div class="col-3">
						<div class="input-group">
							<input type="number" class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">%</span>
							</div>
						</div>
					</div>
					<div class="col-3 borde-amarillo">
						$ 159,273.23
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
						<li>Tiempo de entrega máximo: 4 semanas</li>						
						<li>No incluye obra civil en caso de ser requerido en la instalación.</li>					
						<li>AAMPERIA no se hace responsable de variaciones de voltaje existentes.</li>				
						<li>Tarjetas de crédito: aplican cargos adicionales.</li>
						<li>En caso de lluvia o clima no favorable, será necesario reagendar intalación.</li>
						<li>AAMPERIA no se hace responsable de cualquier error de lectura que pueda tener el medidor actual.</li>
						<li>No incluye trabajos de albañilería en caso de que así lo requiera la instalación del sistema y/o el medidor bidereccional.</li>
						<li>En caso de adquirir el sistema de monitoreo, el cliente es responsable de mantener una conexión a internet para el correcto funcionamiento del monitoreo de producción. En caso de alguna falla, AAMPERIA se compromete a dar soporte telefónico y proveer un manual. Cualquier asistencia diferente a ésta tendrá un costo adicional.</li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>