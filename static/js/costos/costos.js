$(document).ready(function(){
	var tablaCostos = $('#tabla-costos').DataTable({
		responsive: true,
		"language": {
			"lengthMenu": "Mostrar _MENU_ registros",
			"zeroRecords": "No se encontraron resultados",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch": "Buscar:",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast":"Último",
				"sNext":"Siguiente",
				"sPrevious": "Anterior"
			 },
			"sProcessing":"Procesando...",
		},
	});
	
	var columnas = [
		"Nombre",
		"Tipo",
		"Costo MXN",
		"Costo USD",
		"Fecha agregación",
		"Fecha actualización",
		"Acciçon"
	];
	
	$.ajax({
		'url' : base_url + 'costos/traer_costos',
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
			var contenidoTabla = "";
			var avisoFechaActualizacion = "";
			var avisoMXN = "";
			var avisoUSD = "";
			$.each(obj['data'], function(i,elemento){
				if(elemento.fecha_actualizacion == null){
					avisoFechaActualizacion = "Sin actualizar";
				}else{
					avisoFechaActualizacion = elemento.fecha_actualizacion;
				}
				
				if(elemento.costo_MXN == null){
					avisoMXN = "Sin precio";
				}else{
					avisoMXN = elemento.costo_MXN;
				}
				
				if(elemento.costo_USD == null){
					avisoUSD = "Sin precio";
				}else{
					avisoUSD = elemento.costo_USD;
				}
				
				var nuevaFila = tablaCostos.row.add([
					elemento.nombre_articulo,
					elemento.nombre_tipo_articulo,
					avisoMXN,
					avisoUSD,
					elemento.fecha_agregacion,
					avisoFechaActualizacion,
					'<a type="button" class="btn btn-primary" href="'+base_url+'Costos/vista_editar/'+elemento.id_costo+''+'"><i class="fa fa-edit"></i></a>' +
					'<a type="button" class="btn btn-info" href="'+base_url+'Costos/vista_visualizar/'+elemento.id_costo+''+'"><i class="fa fa-eye"></i></a>' +
					'<button type="button" class="btn btn-danger" onclick="eliminar_costo('+elemento.id_costo+')"><i class="fa fa-trash-o"></i></button>'
				]).draw().node();
				
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas[index]);
				});
				
			});
		}
	});
	
	$.ajax({
		'url' : base_url + 'costos/traer_tipo_articulo',
		'datatype' : 'json',
		'success' : function(obj){
			var selectContenido = "";
			selectContenido += 
			'<option value="'+""+'">Todos los articulos</option>'
			$.each(obj,function(i,elemento){
				selectContenido += 
				'<option value="'+elemento.id_tipo_articulo+'">'+elemento.nombre_tipo_articulo+'</option>'
			});
			$('#id_tipo_articulo').append(selectContenido);
		}
	});
	
	$('#id_tipo_articulo').change(function(){
		var idTipoArticulo = $(this).val();
		$.ajax({
			'url' : base_url + 'costos/traer_costos',
			'type' : 'post',
			'data' : {'id_tipo_articulo' : idTipoArticulo},
			'datatype' : 'json',
			'success' : function(obj){
				$('#tabla-costos').DataTable().clear().draw();
				console.log(obj);
				var contenidoTabla = "";
				var avisoFechaActualizacion = "";
				var avisoMXN = "";
				var avisoUSD = "";
				$.each(obj['data'], function(i,elemento){
					if(elemento.fecha_actualizacion == null){
						avisoFechaActualizacion = "Sin actualizar";
					}else{
						avisoFechaActualizacion = elemento.fecha_actualizacion;
					}
					
					if(elemento.costo_MXN == null){
						avisoMXN = "Sin precio";
					}else{
						avisoMXN = elemento.costo_MXN;
					}
					
					if(elemento.costo_USD == null){
						avisoUSD = "Sin precio";
					}else{
						avisoUSD = elemento.costo_USD;
					}
					
					var nuevaFila = tablaCostos.row.add([
						elemento.nombre_articulo,
						elemento.nombre_tipo_articulo,
						avisoMXN,
						avisoUSD,
						elemento.fecha_agregacion,
						avisoFechaActualizacion,
						'<a type="button" class="btn btn-primary" href="'+base_url+'Costos/vista_editar/'+elemento.id_costo+''+'"><i class="fa fa-edit"></i></a>' +
						'<a type="button" class="btn btn-info" href="'+base_url+'Costos/vista_visualizar/'+elemento.id_costo+''+'"><i class="fa fa-eye"></i></a>' +
						'<button type="button" class="btn btn-danger" onclick="eliminar_costo('+elemento.id_costo+')"><i class="fa fa-trash-o"></i></button>'
					]).draw().node();
					
					$('td', nuevaFila).each(function(index,td){
						$(td).attr('data-label',columnas[index]);
					});
				});
			}
		});
	})
});

function eliminar_costo(id_costo){
	swal.fire({
		'icon' : 'warning',
		'title' : '¿Está seguro que desea eliminar el costo?',
		showCancelButton: true,
		confirmButtonText: `Aceptar`,
	}).then((result) => {
		if(result.isConfirmed){
			$.ajax({
				'url' : base_url + 'Costos/eliminar_costo',
				'type' : 'post',
				'data' : {'id_costo' : id_costo},
				'datatype' : 'json',
				'success' : function(obj){
					if(obj['resultado'] == true){
						swal.fire({
							'icon' : 'success',
							'title' : 'El costo se ha eliminado correctamente',
						}).then((result) => {
							location.reload();
						})
					}else{
						alert('No se pudo actualizar el costo');
					}
				}
			});
		}	
	})
}