<!DOCTYPE html>
<html>
	<head>
		<title>Cotizacion PDF</title>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="<?= base_url() ?>static/css/bootstrap3.min.css">
		<style>
		body {
			font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
		}
		
		.texto-blanco {
			color: #fff!important;
		}
		
		.vcenter {
			display: inline-block;
			vertical-align: middle;
			float: none;
		}

		.fondo-azul-oscuro {
			background-color: #05405F;
		}

		.texto-azul {
			color: #003749;
		}
		
		.text-amarillo {
			color:#f0a102;
		}
		
		.text-blanco {
			color:#fff;
		}
		
		.fondo-gris {
			background-color:#EAEAEA;
		}
		
		.fondo-azul {
			background-color: #EBF2FA;
		}
		
		.row {
			margin-left: 0; 
			margin-right: 0; 
		}

		.row .col-xs-1, .row .col-xs-2, .row .col-xs-3, .row .col-xs-4, .row .col-xs-5, .row .col-xs-6, .row .col-xs-7, .row .col-xs-8, .row .col-xs-9, .row .col-xs-10, .row .col-xs-11, .row .col-xs-12 {
			padding-left: 0;
			padding-right: 0;
		}
		
		.tabla-azul thead th {
			text-align: center;
		}
		
		.tabla-azul tbody th{
			background-color:#05405F;
			color: #fff;
			text-align: center;
		}

		.tabla-azul tbody td{
			background-color:#EBF2FA;
			color: #000;
		}
		
		div.page_break {
			page-break-before: always;
		}

		.table-borderless td {
			border: 0!important;
		}
		
		.borde-amarillo {
			border: 1px solid #f0a102;
		}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row" style="margin-bottom: 10px">
				<div class="col-xs-6">
					<img src="http://agctecnologias.com/cotizador/img/logoazul.png" width="115" height="100">
				</div>
				<div class="col-xs-6" style="text-align:right">
					<span class="font-weight-bold texto-azul" style="font-weight: 700!important">Energía solar</span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12" style="background:#087E88; color:#fff; padding:5px">
					<?=$cotizacion->nombre?><br>
					<img src="http://agctecnologias.com/cotizador/img/Imagen_1.png" width="30%"><br>
					Juntos somos energía
				</div>
			</div>
			<div class="row fondo-azul">
				<div class="col-xs-6" style="padding:5px">
					Propuesta personalizada<br>
					Ubicada en <?=$cotizacion->ubicacion?><br>
					Asesor comercial: <?=$cotizacion->nombre_asesor?>
				</div>
				<div class="col-xs-6" style="padding:5px; font-size: 20px; text-align: right">
					Vigencia de la cotización: <select>
						<option value="1">1 días</option>
						<option value="2">2 días</option>
						<option value="3">3 días</option>
						<option value="4">4</option>
						<option value="5">5 días</option>
						</select><br>
					Al 24 de junio de 2021
				</div>
			</div>
			<div class="row fondo-gris" style="font-size: 0;">
				<div class="col-xs-4 vcenter">
					<span style="font-size: 20pt">
						Diagnóstico
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span class="text-amarillo" style="font-size: 14pt;">
						Diagnóstico
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span style="font-size: 14pt;">
						Propuesta
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span style="font-size: 14pt;">
						Cotización
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span style="font-size: 14pt;">
						Pago
					</span>
				</div>
			</div>
			<div class="row" style="margin-top:10px">
				<div class="col-xs-12">
					<span style="font-size: 18pt;">
						Diagnóstico de servicio
					</span>
					<hr style="border-top: 1px solid #FEDE2F; background:#FEDE2F; margin-top:0">
				</div>
			</div>
			<div class="row" style="text-align:center; font-size: 0; width:100%; display:table; height:50px">
				<div class="col-xs-3 fondo-azul-oscuro texto-blanco" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large">Consumo <br>promedio (kWh)</div>
				</div>
				<div class="col-xs-3 fondo-azul" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large">	
						<?=number_format($cotizacion->consumo_promedio_kwh, 2)?> (kwh)
					</div>
				</div>
				<div class="col-xs-3 fondo-azul-oscuro texto-blanco" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large">Consumo <br>promedio ($)</div>
				</div> 
				<div class="col-xs-3 fondo-azul" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large">$ <?=number_format($cotizacion->consumo_promedio_precio, 2)?></div>
				</div>
			</div>
			<?php 
				if($cotizacion->forma_calculo == "recibo") { ?>
					<div class="row" style="margin-top:10px">
						<div class="col-xs-12">
							<div style="margin-left:auto margin-right:auto">
								<center><img width="80%" src="<?=$cotizacion->grafica_consumo?>"></center>
							</div>
						</div>
					</div>
			<?
				}
			?>
			<div class="row fondo-gris" style="font-size: 0; margin-top: 30px">
				<div class="col-xs-4 vcenter">
					<span style="font-size: 20pt">
						Propuesta y análisis
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span  style="font-size: 14pt;">
						Diagnóstico
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span class="text-amarillo" style="font-size: 14pt;">
						Propuesta
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span style="font-size: 14pt;">
						Cotización
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span style="font-size: 14pt;">
						Pago
					</span>
				</div>
			</div>
			<div class="row" style="margin-top:10px">
				<div class="col-xs-12">
					<span style="font-size: 18pt;">
						Información del sistema
					</span>
					<hr style="border-top: 1px solid #FEDE2F; background:#FEDE2F; margin-top:0">
				</div>
			</div>
			<div class="row" style="text-align:center; font-size: 0; width:100%; display:table; height:50px">
				<div class="col-xs-3 fondo-azul-oscuro texto-blanco" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large">Número de <br>paneles</div>
				</div>
				<div class="col-xs-3 fondo-azul" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large"><?=$cotizacion->num_paneles?></div>
				</div>
				<div class="col-xs-3 fondo-azul-oscuro texto-blanco" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large">Producción <br>anual</div>
				</div> 
				<div class="col-xs-3 fondo-azul" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large"><?=$cotizacion->produccion_anual?> kWh</div>
				</div>
			</div>
			<div class="row" style="text-align:center; font-size: 0; width:100%; display:table; height:50px; margin-top:10px">
				<div class="col-xs-3 fondo-azul-oscuro texto-blanco" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large">Tipo de <br>sistema</div>
				</div>
				<div class="col-xs-3 fondo-azul" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large"><?=$cotizacion->tipo_interconexion?></div>
				</div>
				<div class="col-xs-3 fondo-azul-oscuro texto-blanco" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large">Producción <br>bimestral</div>
				</div> 
				<div class="col-xs-3 fondo-azul" style="float: none;display: table-cell; vertical-align:middle; height:50px">
					<div style="font-size: large"><?=$cotizacion->produccion_bimestral?> kWh</div>
				</div>
			</div>
			<div class="row" style="margin-top:10px">
				<div class="col-xs-12">
					<span style="font-size: 18pt;">
						Ahorros estimados
					</span>
					<hr style="border-top: 1px solid #FEDE2F; background:#FEDE2F; margin-top:0">
				</div>
			</div>
			<table class="table text-center tabla-azul">
				<thead>
					<tr>
						<th>Periodo</th>
						<th>Actual</th>
						<th class="text-amarillo">Con AAMPERIA</th>
						<th>Ahorro</th>
					</tr>
				</thead>
					<tbody>
						<tr>
							<th>Bimestral</th>
							<td>$ <?=number_format($ahorro[0]->actual,2)?></td>
							<td>$ <?=number_format($ahorro[0]->con_aamperia,2)?></td>
							<td>$ <?=number_format($ahorro[0]->ahorro,2)?></td>
						</tr>
						<tr>
							<th>1 anio</th>
							<td>$ <?=number_format($ahorro[1]->actual,2)?></td>
							<td>$ <?=number_format($ahorro[1]->con_aamperia,2)?></td>
							<td>$ <?=number_format($ahorro[1]->ahorro,2)?></td>
						</tr>
						<tr>
							<th>5 anios</th>
							<td>$ <?=number_format($ahorro[2]->actual,2)?></td>
							<td>$ <?=number_format($ahorro[2]->con_aamperia,2)?></td>
							<td>$ <?=number_format($ahorro[2]->ahorro,2)?></td>
						</tr>
						<tr>
							<th>10 anios</th>
							<td>$ <?=number_format($ahorro[3]->actual,2)?></td>
							<td>$ <?=number_format($ahorro[3]->con_aamperia,2)?></td>
							<td>$ <?=number_format($ahorro[3]->ahorro,2)?></td>
						</tr>
						<tr>
							<th>25 anios</th>
							<td>$ <?=number_format($ahorro[4]->actual,2)?></td>
							<td>$ <?=number_format($ahorro[4]->con_aamperia,2)?></td>
							<td>$ <?=number_format($ahorro[4]->ahorro,2)?></td>
						</tr>
					</tbody>
			</table>
			<div class="page_break"></div>
			<div class="row fondo-gris" style="font-size: 0;">
				<div class="col-xs-4 vcenter">
					<span style="font-size: 20pt">
						Cotización
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span  style="font-size: 14pt;">
						Diagnóstico
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span style="font-size: 14pt;">
						Propuesta
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span class="text-amarillo" style="font-size: 14pt;">
						Cotización
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span style="font-size: 14pt;">
						Pago
					</span>
				</div>
			</div>
			<table class="table text-center tabla-azul" style="margin-top:10px">
				<thead>
					<tr>
						<th>Sistema</th>
						<th>Cantidad</th>
						<th>P. Unitario</th>
						<th>Importe</th>
					</tr>
				</thead>
				<tbody>
					<? 
						foreach($productos as $producto) {
					?>
						<tr>
							<th><?=$producto->nombre?></th>
							<td><?=$producto->cantidad?></td>
							<td>$ <?=number_format($producto->precio_unitario,2)?></td>
							<td>$ <?=number_format($producto->importe,2)?></td>
						</tr>
					<?
						}
					?>
				</tbody>
			</table>
			<div class="row text-center">
				<div class="col-xs-6 my-auto">
					<div class="fondo-azul-oscuro text-blanco">
						<h2>Retorno de inversión</h2>
					</div>
					<h1><?=$cotizacion->retorno_inversion?> años</h1>
				</div>
				<div class="col-xs-6" style="padding-left:20px">
					<table class="table table-borderless tabla-totales" style="font-weight: 700!important;">
						<tbody>
							<tr style="border-bottom: 1px solid #f0a102 !important; font-size: 20px;">
								<td>SUBTOTAL</td>
								<td>$ <?=number_format($cotizacion->subtotal,2)?></td>
							</tr>
							<tr style="border-bottom: 1px solid #f0a102; font-size: 20px;">
								<td>IVA</td>
								<td>$ <?=number_format($cotizacion->iva,2)?></td>
							</tr>
							<tr style="border-bottom: 1px solid #f0a102; font-size: 20px;">
								<td>TOTAL</td>
								<td>$ <?=number_format($cotizacion->total,2)?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div style="margin-left:auto margin-right:auto">
						<center><img id="imagen-grafica" width="80%" src="<?=$cotizacion->grafica_roi?>"></center>
					</div>
				</div>
			</div>
			<div class="row fondo-gris" style="font-size: 0; margin-top:20px">
				<div class="col-xs-4 vcenter">
					<span style="font-size: 20pt">
						Pago
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span  style="font-size: 14pt;">
						Diagnóstico
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span style="font-size: 14pt;">
						Propuesta
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span style="font-size: 14pt;">
						Cotización
					</span>
				</div>
				<div class="col-xs-2 vcenter">
					<span class="text-amarillo" style="font-size: 14pt;">
						Pago
					</span>
				</div>
			</div>
			<div class="row" style="margin-top:10px">
				<div class="col-xs-12">
					<span style="font-size: 18pt;">
						Condiciones de pago
					</span>
					<hr style="border-top: 1px solid #FEDE2F; background:#FEDE2F; margin-top:0">
				</div>
			</div>
			<div class="row text-center condiciones-pago mb-2" style="margin-top:5px">
				<div class="col-xs-6 fondo-azul-oscuro texto-blanco"  style="padding:5px">
					<span style="font-size: 16pt;">Anticipo</span>
				</div>
				<div class="col-xs-3"  style="padding:5px">
					<input type="number">
				</div>
				<div class="col-xs-3 borde-amarillo"  style="padding:5px">
					<span style="font-size: 16pt;">$ <?=number_format($cotizacion->anticipo,2)?></span>
				</div>
			</div>
			<div class="row text-center condiciones-pago mb-2" style="margin-top:10px">
				<div class="col-xs-6 fondo-azul-oscuro texto-blanco"  style="padding:10px">
					<span style="font-size: 16pt;">Finalizar la instalación</span>
				</div>
				<div class="col-xs-3" style="padding:10px">
					<span style="font-size: 16pt;"><?=$cotizacion->finalizar_instalacion_porcentaje?> %</span>
				</div>
				<div class="col-xs-3 borde-amarillo" style="padding:10px">
					<span style="font-size: 16pt;">$ <?=number_format($cotizacion->finalizar_instalacion,2)?></span>
				</div>
			</div>
			<div class="row text-center condiciones-pago mb-2" style="margin-top:10px">
				<div class="col-xs-6 fondo-azul-oscuro texto-blanco" style="padding:10px">
					<span style="font-size: 16pt;">Cambio de medidor CFE</span>
				</div>
				<div class="col-xs-3" style="padding:10px">
					<span style="font-size: 16pt;"><?=$cotizacion->cambio_medidor_cfe_porcentaje?> %</span>
				</div>
				<div class="col-xs-3 borde-amarillo" style="padding:10px">
					<span style="font-size: 16pt;">$ <?=number_format($cotizacion->cambio_medidor_cfe,2)?></span>
				</div>
			</div>
			<div class="row" style="margin-top:20px">
				<div class="col-xs-12">
					<h3>Términos y condiciones</h3>
					<ul>
						<li>Precios en MXN.</li>
						<li>Tipo de cambio: $ <?=number_format($cotizacion->tasa_cambio,2)?></li>
						<li>Vigencia de cotización: <?=$cotizacion->vigencia?></li>	
						<li>Tiempo de entrega máximo: 4 semanas.</li>
					</ul>
					<div><?=$terminos?></div>
				</div>
			</div>
			<div class="row" style="margin-top:20px;margin-bottom: 40px;">
				<div class="col-xs-6" style="padding-right: 10px;">
					<button class="btn btn-success btn-block" style="font-size: 20px;">Descargar PDF</button>
				</div>
				<div class="col-xs-6" style="padding-left: 10px;">
					<button class="btn btn-danger btn-block" style="font-size: 20px;">Cancelar cotización</button>
				</div>
			</div>
		</div>
	</body>
</html>