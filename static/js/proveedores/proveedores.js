var columnas = [];
var tabla_proveedores;
	
$('#tabla-proveedores thead tr th').each(function(){
	columnas.push($(this).html());
});
	
$(document).ready(function(){
	tabla_proveedores = $('#tabla-proveedores').DataTable({
		responsive: true,
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
		},
        scrollCollapse: true
	});
	cargar_proveedores();
	
	$('#formulario_agregar').on('submit', function(e){
		e.preventDefault();
		
		$.ajax({
			'url' : base_url + 'proveedores/agregar_proveedor',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			beforeSend: setHeader,
			'success' : function(obj){
				if(obj['resultado']){
					swal.fire({
						'icon' : 'success',
						'title' : 'El proveedor se ha agregado correctamente',
						confirmButtonText: 'Aceptar'
					});
				}else{
					swal.fire({
						'icon' : 'error',
						'title' : 'El proveedor no se ha agregado correctamente',
						confirmButtonText: 'Aceptar'
					});
				}
				$('#agregar-proveedor').modal('hide');
				$('#formulario-agregar').trigger("reset");
				cargar_proveedores();
			}
		});
	});
	
	$('#formulario_editar').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			'url' : base_url + 'proveedores/editar_proveedor',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				if(obj['resultado']){
					swal.fire({
						'icon' : 'success',
						'title' : 'El proveedor se ha actualizado correctamente',
						confirmButtonText: 'Aceptar'
					});
				}else{
					swal.fire({
						'icon' : 'error',
						'title' : 'El proveedor no se ha actualizado',
						confirmButtonText: 'Aceptar'
					});
				}
				$('#editar-proveedor').modal('hide');
				cargar_proveedores();
			}
		});
	});
});

function cargar_proveedores(){
	var cliente = "";
	$.ajax({
		'url' : base_url + 'proveedores/traer_proveedores',
		'datatype' : 'json',
		'beforeSend': setHeader,
		'success' : function(obj){
			tabla_proveedores.clear().draw();
			$.each(obj, function(i,elemento){
				if(elemento.cliente == 0){
					cliente =  "No es cliente potencial ni cliente";
				}else if(elemento.cliente == 1){
					cliente = "Cliente";
				}else if(elemento.cliente ==  2){
					cliente = "Cliente potencial";
				}else if(elemento.cliente == 3){
					cliente = "Cliente potencial y cliente";
				}
				var nuevaFila = tabla_proveedores.row.add([
					elemento.nombre,
					elemento.alias,
					elemento.codigo,
					cliente,
					'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editar-proveedor" onclick="editar_proveedor('+elemento.id+')"><i class="fa fa-edit"></i></button> ' +
					'<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizar-proveedor" onclick="visualizar_proveedor('+elemento.id+')"><i class="fa fa-eye"></i></button> ' +
					'<button type="button" class="btn btn-danger" onclick="eliminar_proveedor('+elemento.id+')"><i class="fa fa-trash-o"></i></button>'
				]).draw().node();
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas[index]);
				});
			});
			$("#spinner").addClass("d-none");
			$(".overlay").addClass("d-none");
		}
	});
}

function editar_proveedor(id_proveedor){
	$.ajax({
		'url' : base_url + 'proveedores/obtener_proveedor',
		'type' : 'post',
		'data' : {
			'id_proveedor': id_proveedor
		},
		'datatype' : 'json',
		'success' : function(obj){
			if(obj['resultado']){
				var data = obj['datos_proveedor'];
				console.log(data);
				$('#id_proveedor_editar').val(id_proveedor);
				$('#empresa_editar').val(data.empresa);
				$('#direccion_editar').val(data.direccion);
				$('#ciudad_editar').val(data.ciudad);
				$('#estado_editar').val(data.estado);
				$('#telefono_editar').val(data.telefono);
				$('#contacto_editar').val(data.contacto);
				$('#correo_editar').val(data.correo_electronico);
				$('#pagina_editar').val(data.pagina_web);
			}
			else {
				Swal.fire("Error","No se encontó el proveedor","error");
				$('#editar-proveedor').modal('hide');
			}
		}
	})
}

function visualizar_proveedor(id_proveedor){
	$.ajax({
		'url' : base_url + 'proveedores/obtener_proveedor',
		'type' : 'post',
		'data' : {
			'id_proveedor': id_proveedor
		},
		'datatype' : 'json',
		'success' : function(obj){
			if(obj['resultado']){
				var data = obj['datos_proveedor'];
				console.log(data);
				$('#id_proveedor_visualizar').val(id_proveedor);
				$('#empresa_visualizar').val(data.empresa);
				$('#direccion_visualizar').val(data.direccion);
				$('#ciudad_visualizar').val(data.ciudad);
				$('#estado_visualizar').val(data.estado);
				$('#telefono_visualizar').val(data.telefono);
				$('#contacto_visualizar').val(data.contacto);
				$('#correo_visualizar').val(data.correo_electronico);
				$('#pagina_visualizar').val(data.pagina_web);
			}
			else {
				Swal.fire("Error","No se encontó el proveedor","error");
				$('#visualizar-proveedor').modal('hide');
			}
		}
	})
}

function eliminar_proveedor(id_proveedor){
	swal.fire({
		'icon' : 'warning',
		'title' : '¿Está seguro que desea eliminar este proveedor?',
		showCancelButton: true,
		confirmButtonText: 'Aceptar',
	}).then((result) => {
		if(result.isConfirmed){
			$.ajax({
				'url' : base_url + 'proveedores/eliminar_proveedor',
				'type' : 'post',
				'data' : {'id_proveedor' : id_proveedor},
				'datatype' : 'json',
				'success' : function(obj){
					if(obj['resultado'] == true){
						swal.fire({
							'icon' : 'success',
							'title' : 'El proveedor se ha eliminado correctamente',
						});
					}else{
						swal.fire({
							'icon' : 'danger',
							'title' : 'No se pudo eliminar al proveedor',
						});
					}
					cargar_proveedores();
				}
			});
		}	
	});
}

function setHeader(xhr) {
  xhr.setRequestHeader('Authorization', token);
}