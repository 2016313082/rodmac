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
			'url' : base_url + 'usuarios/agregar_cliente',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				console.log(obj);
				if(obj['resultado'] == true){
					swal.fire({
						'icon' : 'success',
						'title' : 'El cliente se ha agregado correctamente',
						confirmButtonText: 'Aceptar'
					});
				}else{
					swal.fire({
						'icon' : 'error',
						'title' : 'El cliente no se ha agregado correctamente',
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
			'url' : base_url + 'usuarios/editar_cliente',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				console.log(obj);
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
		'url' : base_url + 'usuarios/cargar_clientes',
		'datatype' : 'json',
		'success' : function(obj){
			tabla_usuarios.clear().draw();
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
					'<button class="btn btn-danger" onclick="ver_docs('+elemento.id_usuario+')"><i class="fa fa-folder-open-o" aria-hidden="true"></i></button> ' +
					'<button type="button" class="btn '+clase+'" onclick="id_dolibar('+elemento.id_usuario+')"><i class="fa fa-user-plus" aria-hidden="true"></i></button>'
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

function editar_usuario(id_usuario){
	$.ajax({
		'url' : base_url + 'usuarios/cargar_cliente',
		'type' : 'post',
		'data' : {
			'id_usuario': id_usuario
		},
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
			if(obj['resultado'] == true){
				var data = obj['datos_usuario'];
				$('#requisitos_entrega_editar').val(data.requisitos_entrega);
				$('#id_usuario_editar').val(id_usuario);
				$('#usuario_editar').val(data.usuario);
				$('#nombre_editar').val(data.nombre);
				$('#correo_editar').val(data.correo);
				$('#apellido_paterno_editar').val(data.apellido_paterno);
				$('#apellido_materno_editar').val(data.apellido_materno);
				$('#telefono_editar').val(data.telefono);
				$('#nombre_comercial_editar').val(data.nombre_comercial);
				$('#razon_social_editar').val(data.razon_social);
				$('#rfc_editar').val(data.rfc);
				$('#banco_editar').val(data.banco);
				$('#nombre_titular_editar').val(data.titular_cuenta);
				$('#num_cuenta_editar').val(data.num_cuenta);
				$('#cuenta_clabe_editar').val(data.cuenta_clabe);
				$('#direccion_fiscal_editar').val(data.direccion_fiscal);
				$('#cfdi_editar').val(data.uso_cfdi);
				$('#metodo_pago_editar').val(data.metodo_pago);
				$('#forma_pago_editar').val(data.forma_pago);
				$('#fecha_pago_editar').val(data.fecha_pago);
				$('#correo_facturas_editar').val(data.correo_facturas);
			
				//se agrega todo al html
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
		'url' : base_url + 'usuarios/clientes_dolibar',
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
			tabla_dolibar.clear().draw();
			$.each(obj, function(i,elemento){
				console.log(elemento.firstname);
				var nuevaFila = tabla_dolibar.row.add([
					elemento.name,
					elemento.name_alias,
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
 
function ver_docs(id_usuario){
	var cont = '';
	cont = '<div class="col-12">' +
	'<h5>Constancia de situacion fiscal</h5>' +
	'<a class="btn btn-danger" target="_blank" href="'+base_url+'img/documentos_'+id_usuario+'/constancia_fiscal_'+id_usuario+'.pdf"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
	'</div>' +
	'<div class="col-12">' +
		'<h5>CIF (Codigo de identificacion fiscal)</h5>' +
		'<a class="btn btn-danger" target="_blank" href="'+base_url+'img/documentos_'+id_usuario+'/cif_'+id_usuario+'.pdf"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
	'</div>' + 
	'<div class="col-12">' +
		'<h5>Comprobante de domicilio</h5>' +
		'<a target="_blank" class="btn btn-danger" href="'+base_url+'img/documentos_'+id_usuario+'/comprobante_dom_'+id_usuario+'.pdf"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
	'</div>' +
	'<div class="col-12">' +
		'<h5>Acta constitutiva</h5>' +
		'<a target="_blank" class="btn btn-danger" href="'+base_url+'img/documentos_'+id_usuario+'/acta_constitutiva_'+id_usuario+'.pdf"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
	'</div>' + 
	'<div class="col-12">' +
		'<h5>Copia ine</h5>' +
		'<a target="_blank" class="btn btn-danger" class="btn btn-danger" href="'+base_url+'img/documentos_'+id_usuario+'/copia_ine_'+id_usuario+'.pdf"><i class="fa fa-eye" aria-hidden="true"></i></a>' +
	'</div>';
	$('#docs').html(cont);
	$('#ver_docs').modal('show');
}

/*
Este codigo sirve para las notificaciones push de google 
const notificarBtn = document.querySelector('#notificar');

notificarBtn.addEventListener('click', () => {
    Notification.requestPermission().then(resultado => {
        console.log('Respuesta: ', resultado);
    })
})

const verNotificacion = document.querySelector('#vernotificacion');

verNotificacion.addEventListener('click', () => {
    if (Notification.permission === 'granted') {
        const notificacion = new Notification('Esta es la notificacion', {
            icon: '/images/example-logo.jpg',
            body: 'Tutoriales de js con blackCode'
        });

        notificacion.onclick = function(){
            window.open('http://google.com');
        }
    }
}) */
