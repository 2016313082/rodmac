var columnas_dolibar = [];
var tabla_dolibar;
var tabla_usuarios;
var columnas = [];
//console.log(usuarios);
$(document).ready(function(){
	tabla_usuarios = $('#tabla-usuarios').DataTable({
		responsive: true,
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		}
	});
	
	$('#tabla-usuarios thead tr th').each(function() {
		columnas.push($(this).html());
	});

	tabla_dolibar = $('#tabla-dolibar').DataTable({
		responsive: true,
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
			scrollY: '300px',
        	scrollCollapse: true
		}
	});
	
	$('#tabla-dolibar thead tr th').each(function() {
		columnas_dolibar.push($(this).html());
	});

	cargar_usuarios();
	
	$('#formulario_agregar').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			'url' : base_url + 'usuarios/agregar_usuario',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				if(obj['resultado']){
					swal.fire({
						'icon' : 'success',
						'title' : 'El usuario se ha agregado correctamente',
						confirmButtonText: 'Aceptar'
					});
				}else{
					swal.fire({
						'icon' : 'error',
						'title' : 'El usuario no se ha agregado correctamente',
						confirmButtonText: 'Aceptar'
					});
				}
				$('#agregar-usuario').modal('hide');
				$('#formulario_agregar').trigger("reset");
				cargar_usuarios();
			}
		});
	});
	
	$('#formulario_editar').on('submit',function(e){
		e.preventDefault();
		$('#nivel_editar').prop('disabled', false);
		$.ajax({
			'url' : base_url + 'usuarios/editar_usuario',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				if(obj['resultado']){
					swal.fire({
						'icon' : 'success',
						'title' : 'El usuario se ha actualizado correctamente',
						confirmButtonText: 'Aceptar'
					});
				}else{
					swal.fire({
						'icon' : 'error',
						'title' : 'El usuario no se ha actualizado',
						confirmButtonText: 'Aceptar'
					});
				}
				$('#editar-usuario').modal('hide');
				$('#formulario_editar').trigger('reset');
				cargar_usuarios();
			}
		});
	});
});

function cargar_usuarios() {
	var clase = ""
	$.ajax({
		'url' : base_url + 'usuarios/cargar_usuarios',
		'datatype' : 'json',
		'success' : function(obj){
			tabla_usuarios.clear().draw();
			if(obj['resultado']){
				$.each(obj.usuarios, function(i,elemento){
					if(elemento.id_dolibarr == 0){
						clase = "btn-danger";
					}else{
						clase = "btn-success";
					}
					var nuevaFila = tabla_usuarios.row.add([
						elemento.nombre + " " + elemento.apellido_paterno + " " + elemento.apellido_materno,
						elemento.correo,
						elemento.usuario,
						elemento.telefono,
						elemento.nivel,
						'<button type="button" class="btn btn-primary" onclick="editar_usuario('+elemento.id_usuario+')"><i class="fa fa-edit"></i></button> ' +
						'<a href="'+base_url+'departamentos/departamentos_view/'+elemento.id_usuario+'" target="_blank" class="btn btn-info"><i class="fa fa-id-card-o" aria-hidden="true"></i></a> ' +
						'<button type="button" class="btn '+clase+'" onclick="id_dolibar('+elemento.id_usuario+')"><i class="fa fa-user-plus" aria-hidden="true"></i></button>'
					]).draw().node();
					$('td', nuevaFila).each(function(index,td){
						$(td).attr('data-label',columnas[index]);
					});
				});
				$("#spinner").addClass("d-none");
				$(".overlay").addClass("d-none");
			}
		}
	});
}

function editar_usuario(id_usuario){
	$.ajax({
		'url' : base_url + 'usuarios/cargar_usuario',
		'type' : 'post',
		'data' : {
			'id_usuario': id_usuario
		},
		'datatype' : 'json',
		'success' : function(obj){
			if(obj['resultado']){
				var data = obj['datos_usuario'];
				$('#id_usuario_editar').val(id_usuario);
				$('#usuario_editar').val(data.usuario);
				$('#nombre_editar').val(data.nombre);
				$('#correo_editar').val(data.correo);
				$('#apellido_paterno_editar').val(data.apellido_paterno);
				$('#apellido_materno_editar').val(data.apellido_materno);
				$('#telefono_editar').val(data.telefono);
				if(nivel == "Administrador") {
					if(data.nivel == "Administrador" || data.nivel == "Propietario") {
						$('#nivel_editar').empty();
						$('#nivel_editar').append('<option value="Propietario">Propietario</option>');
						$('#nivel_editar').append('<option value="Administrador">Administrador</option>');
						$('#nivel_editar').append('<option value="Empleado">Empleado</option>');
						$('#nivel_editar').append('<option value="Inactivo">Inactivo</option>');
						$('#nivel_editar').prop('required', false);
						$('#nivel_editar').prop('disabled', true);
						
						$('#id_usuario_editar').prop('disabled', true);
						$('#usuario_editar').prop('disabled', true);
						$('#nombre_editar').prop('disabled', true);
						$('#correo_editar').prop('disabled', true);
						$('#apellido_paterno_editar').prop('disabled', true);
						$('#apellido_materno_editar').prop('disabled', true);
						$('#telefono_editar').prop('disabled', true);
						$('#enviar_edit').prop('disabled', true);
					}
					else {
						$('#nivel_editar').empty();
						$('#nivel_editar').append('<option value="Empleado">Empleado</option>');
						$('#nivel_editar').append('<option value="Inactivo">Inactivo</option>');
						$('#nivel_editar').prop('required', true);
						$('#nivel_editar').prop('disabled', false);
						
						$('#id_usuario_editar').prop('disabled', false);
						$('#usuario_editar').prop('disabled', false);
						$('#nombre_editar').prop('disabled', false);
						$('#correo_editar').prop('disabled', false);
						$('#apellido_paterno_editar').prop('disabled', false);
						$('#apellido_materno_editar').prop('disabled', false);
						$('#telefono_editar').prop('disabled', false);
						$('#enviar_edit').prop('disabled', false);
					}
				}
				else {
					if(nivel == "Propietario") {
						$('#nivel_editar').empty();
						$('#nivel_editar').append('<option value="Propietario">Propietario</option>');
						$('#nivel_editar').append('<option value="Administrador">Administrador</option>');
						$('#nivel_editar').append('<option value="Empleado">Empleado</option>');
						$('#nivel_editar').append('<option value="Inactivo">Inactivo</option>');
						$('#nivel_editar').prop('required', true);
						$('#nivel_editar').prop('disabled', false);
						
						$('#id_usuario_editar').prop('disabled', false);
						$('#usuario_editar').prop('disabled', false);
						$('#nombre_editar').prop('disabled', false);
						$('#correo_editar').prop('disabled', false);
						$('#apellido_paterno_editar').prop('disabled', false);
						$('#apellido_materno_editar').prop('disabled', false);
						$('#telefono_editar').prop('disabled', false);
						$('#enviar_edit').prop('disabled', false);
					}
				}
				$('#nivel_editar option[value="' + data.nivel + '"]').prop('selected', true);
				$('#editar-usuario').modal('show');
			}
			else {
				Swal.fire("Error","No se encontó el usuario","error");
			}
		}
	})
}

function ver_usuario(id_usuario){
	$.ajax({
		'url' : base_url + 'usuarios/cargar_usuario',
		'type' : 'post',
		'data' : {
			'id_usuario': id_usuario
		},
		'datatype' : 'json',
		'success' : function(obj){
			if(obj['resultado']){
				var data = obj['datos_usuario'];
				$('#ver_id_usuario').html(data.id_usuario);
				$('#ver_usuario').html(data.usuario);
				$('#ver_nombre').html(data.nombre);
				$('#ver_apellido_paterno').html(data.apellido_paterno);
				$('#ver_apellido_materno').html(data.apellido_materno);
				$('#ver_correo').html(data.correo);
				$('#ver_telefono').html(data.telefono);
				$('#ver_nivel').html(data.nivel);
				$('#ver_fecha_registro').html(data.fecha_registro);
				$('#ver').modal('show');
			}
			else {
				Swal.fire("Error","No se encontó el usuario","error");
			}
		}
	})
}

function id_dolibar(id_usuario){
	$('#id_dolibar').modal('show');
	$.ajax({
		'url' : base_url + 'usuarios/usuarios_dolibar',
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
			tabla_dolibar.clear().draw();
			$.each(obj, function(i,elemento){
				console.log(elemento.firstname);
				var nuevaFila = tabla_dolibar.row.add([
					elemento.firstname + " " + elemento.lastname,
					elemento.login,
					'<button type="button" class="btn btn-success" onclick="agregar_id('+elemento.id+','+id_usuario+')"><i class="fa fa-plus"></i></button> '
				]).draw().node();
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas_dolibar[index]);
				});
			});
		}
 	});
}

function agregar_id(id_dolibarr,id_usuario){
	$.ajax({
		'url' : base_url + 'usuarios/agregar_id',
		'type' : 'post',
		'data' : {
			'id_dolibarr' : id_dolibarr,
			'id_usuario' : id_usuario
		},
		'datatype' : 'json',
		'success' : function(obj){
			if(obj == true){
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
					  toast.addEventListener('mouseenter', Swal.stopTimer)
					  toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				});
				  
				Toast.fire({
					icon: 'success',
					title: 'Se vinculo el id de dolibarr'
				});
			}else{
				const Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000,
					timerProgressBar: true,
					didOpen: (toast) => {
					  toast.addEventListener('mouseenter', Swal.stopTimer)
					  toast.addEventListener('mouseleave', Swal.resumeTimer)
					}
				});
				  
				Toast.fire({
					icon: 'error',
					title: 'no se pudo vincular id de dolibarr'
				});
			}
		}
	});
}
 