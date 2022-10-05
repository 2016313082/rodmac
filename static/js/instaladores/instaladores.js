var columnas = [];
var tabla;

$(document).ready(function() {
	$.ajaxSetup({
		'error' : function(xhr){
			swal.fire({
				'icon' : 'error',
				'title' : 'Error en el servidor',
				'html' : '<b>Mensaje técnico:</b><br>' +
						 '<p>' + xhr.status + ' ' + xhr.statusText + '</p>',
				confirmButtonText: 'Aceptar'
			});
		}
	});
	
	$('#tabla_crud thead tr th').each(function() {
		columnas.push($(this).html());
	});

	tabla = $('#tabla_crud').DataTable({
		responsive: true,
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
		}
	});
	
	cargar_datos();
	
	$('#formulario_editar').on('submit', function(e) {
		e.preventDefault();
		
		$.ajax({
			'url' : base_url + 'instaladores/editar_instalador',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				if(obj['resultado']){
					swal.fire({
						'icon' : 'success',
						'title' : 'El instalador se ha actualizado correctamente',
						confirmButtonText: 'Aceptar'
					});
					cargar_datos();
				}else{
					swal.fire({
						'icon' : 'error',
						'title' : 'El instalador no se ha actualizado correctamente',
						confirmButtonText: 'Aceptar'
					});
				}
				$('#editar').modal('hide');
			}
		});
	});
	
	$('#formulario_agregar').on('submit', function(e) {
		e.preventDefault();
		
		$.ajax({
			'url' : base_url + 'instaladores/agregar_instalador',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				if(obj['resultado']){
					swal.fire({
						'icon' : 'success',
						'title' : 'El instalador se ha agregado correctamente',
						showCancelButton: true,
						confirmButtonText: 'Agregar otro instalador',
						cancelButtonText: 'Volver a la gestión de instaladores',
					}).then((result) => {
						if (result.isConfirmed) {
							$('#formulario_agregar').trigger('reset');
						} else{
							$('#agregar').modal('hide');
						}
					});
					cargar_datos();
				}else{
					swal.fire({
						'icon' : 'error',
						'title' : 'El instalador no se ha agregado correctamente',
						confirmButtonText: 'Aceptar'
					});
				}
			},
			'complete' : function(data) {
				$('#formulario_agregar').trigger("reset");
			}
		});
	});
	
});

function cargar_datos() {
	$.ajax({
		'url' : base_url + 'instaladores/obtener_datos',
		'datatype' : 'json',
		'success' : function(obj){
			if(obj['resultado']){
				tabla.clear().draw();
				$.each(obj['instaladores'], function(i, elemento){
					var nuevaFila = tabla.row.add([
						elemento.nombre,
						elemento.telefono,
						"$ " + elemento.precio_panel,
						'<button type="button" class="btn btn-primary" data-toggle="modal" onclick="editar('+elemento.id_instalador+')"><i class="fa fa-edit"></i></button> ' +
						'<button type="button" class="btn btn-info" data-toggle="modal" onclick="ver('+elemento.id_instalador+')"><i class="fa fa-eye"></i></button> ' +
						'<button type="button" class="btn btn-danger" onclick="borrar('+elemento.id_instalador+')"><i class="fa fa-trash-o" ></i></button>'
					]).draw().node();
					$('td', nuevaFila).each(function(index,td){
						$(td).attr('data-label',columnas[index]);
					});
				});
			}
		}
	});
}

function editar(id) {
	$.ajax({
		'url' : base_url + 'instaladores/cargar_instalador',
		'method' : 'post',
		'data': {
			'id_instalador' : id 
		},
		'datatype' : 'json',
		'success' : function(obj) {
			if(obj['resultado']) {
				$('#formulario_editar').trigger('reset');
				
				var instalador = obj.instalador;
				
				$('#id_instalador').val(instalador.id_instalador);
				$('#nombre_editar').val(instalador.nombre);
				$('#telefono_editar').val(instalador.telefono);
				$('#precio_panel_editar').val(instalador.precio_panel);
				$('#editar').modal('show');
			}
			else {
				Swal.fire('Error al editar', 'No se encontró el instalador', 'error');
			}
		}
	});
}

function ver(id) {
	$.ajax({
		'url' : base_url + 'instaladores/cargar_instalador',
		'method' : 'post',
		'data': {
			'id_instalador' : id 
		},
		'datatype' : 'json',
		'success' : function(obj) {
			if(obj['resultado']) {
				var instalador = obj.instalador;
				
				$('#ver_id_instalador').html(instalador.id_instalador == null ? "-" : instalador.id_instalador);
				$('#ver_nombre').html(instalador.nombre == null ? "-" : instalador.nombre);
				$('#ver_telefono').html(instalador.telefono == null ? "-" : instalador.telefono);
				$('#ver_precio_panel').html(instalador.precio_panel == null ? "-" : instalador.precio_panel);
				$('#ver_fecha_agregacion').html(instalador.fecha_agregacion == null ? "-" : instalador.fecha_agregacion);
				$('#ver_fecha_actualizacion').html(instalador.fecha_actualizacion == null ? "-" : instalador.fecha_actualizacion);
				$('#ver').modal('show');
			}
			else {
				Swal.fire('Error al ver', 'No se encontró el instalador.', 'error');
			}
		}
	});
}

function borrar(id) {
	Swal.fire({
		'icon' : 'warning',
		'title' : '¿Está seguro que desea eliminar este instalador?',
		denyButtonText: 'Cancelar',
		confirmButtonText: 'Aceptar',
		showDenyButton: true
	}).then((result) => {
		if(result.isConfirmed){
			$.ajax({
				'url' : base_url + 'instaladores/borrar_instalador',
				'method' : 'post',
				'data': {
					'id_instalador' : id 
				},
				'datatype' : 'json',
				'success' : function(obj) {
					if(obj['resultado']) {
						swal.fire({
							'icon' : 'success',
							'title' : 'El instalador se ha borrado correctamente',
							confirmButtonText: 'Aceptar'
						});
						cargar_datos();
					}
					else {
						swal.fire({
							'icon' : 'error',
							'title' : 'El instalador no se pudo borrar',
							confirmButtonText: 'Aceptar'
						});
					}
				}
			});
		}
	});
}