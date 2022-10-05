$(document).ready(function(){
	var fecha_d = fecha_cotizacion.split("-");
	var fecha_original = new Date(fecha_d[0], fecha_d[1] - 1, fecha_d[2])
	var nueva_fecha;
	
	var anticipo_porcentaje = 70;
	var fin_instalacion_porcentaje = 20;
	var cambio_medidor_porcentaje = 10;
	
	var anticipo = 0;
	var fin_instalacion = 0;
	var cambio_medidor = 0;
	
	anticipo = round(total*(anticipo_porcentaje/100),2);
	fin_instalacion = round(total*(fin_instalacion_porcentaje/100),2);
	cambio_medidor = round(total*(cambio_medidor_porcentaje/100),2);
	
	var total_preliminar = round(anticipo + fin_instalacion + cambio_medidor,2);
	var centavos = total - total_preliminar;
	var anticipo = anticipo + centavos;
	
	$('#anticipo-result').text(dinero(anticipo));
	$('#fin-instalacion-result').text(dinero(fin_instalacion));
	$('#cambio-medidor-result').text(dinero(cambio_medidor));
	
	$('#dias_vigencia').change(function() {
		var dias = parseInt($(this).val());
		nueva_fecha = addDays(fecha_original, dias);
		var texto_fecha = ('0' + nueva_fecha.getDate()).slice(-2) + '/' + ('0' + (nueva_fecha.getMonth()+1)).slice(-2) + '/' + nueva_fecha.getFullYear();
		$('#vigencia_1').html(texto_fecha);
		$('#vigencia_2').html(texto_fecha);
	});
	
	$('#dias_vigencia').trigger("change");
	
	$('#descargar_cotizacion').click(function() {
		var condiciones_pago = {
			'anticipo_porcentaje' : anticipo_porcentaje,
			'fin_instalacion_porcentaje' : fin_instalacion_porcentaje,
			'cambio_medidor_porcentaje' : cambio_medidor_porcentaje,
			'anticipo' : anticipo,
			'fin_instalacion' : fin_instalacion,
			'cambio_medidor' : cambio_medidor 
		}
		$.ajax({
			'url' : base_url + 'cotizacion/finalizar_cotizacion',
			'data' : {
				'id_cotizacion' : id_cotizacion,
				'condiciones_pago' : condiciones_pago,
				'vigencia' : $('#dias_vigencia').val(),
				'tiempo_entrega' : $('#tiempo_entrega').val()
			},
			'type' : 'post',
			'success' : function(obj){
				if(obj['resultado']) {
					window.open(base_url + 'historial_cotizaciones/descargar_cotizacion/' + id_cotizacion);
					window.location.replace(base_url + 'cotizacion');
				}
			}
		});
	});

	function addDays(date, days) {
		var result = new Date(date);
		result.setDate(result.getDate() + days);
		return result;
	}
});

function cancelar_cotizacion(id_cotizacion) {
	swal.fire({
		'icon' : 'warning',
		'title' : '¿Desea cancelar la cotización?',
		showCancelButton: true,
		confirmButtonText: 'Aceptar',
	}).then((result) => {
		$.ajax({
			'url' : base_url + 'reporte/cancelar_cotizacion',
			'type' : 'post',
			'data' : {'id_cotizacion' : id_cotizacion},
			'datatype' : 'json',
			'success' : function(obj){
				if(obj['resultado'] == true){
					Swal.fire({
						'icon' : 'success',
						'title' : 'La cotización se ha cancelado correctamente.',
					}).then(function() {
						window.location.replace(base_url);
					});
				}
			}
		})
	})	
}
