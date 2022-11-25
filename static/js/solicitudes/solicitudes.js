var tabla_usuarios;
var columnas = [];
$(document).ready(function(){
	tabla_usuarios = $('#tabla-solicitud').DataTable({
		responsive: true,
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		}
	});
	
	$('#tabla-usuarios thead tr th').each(function() {
		columnas.push($(this).html());
	});

	traer_solicitudes();
	$("#spinner").addClass("d-none");
	$(".overlay").addClass("d-none");
});

function traer_solicitudes(){
	var status = 0;
	$.ajax({
		'url' : base_url + 'solicitudes/traer_solicitudes',
		'type' : 'post',
		'data' : {'status' : status},
		'datatype' : 'json',
		'success' : function(obj){
			tabla_usuarios.clear().draw();
			$.each(obj, function(i,elemento){
				var nuevaFila = tabla_usuarios.row.add([
					elemento.nombre + " " + elemento.apellido_paterno + " " + elemento.apellido_materno,
					elemento.fecha,
					elemento.hora,
					elemento.subtotal,
					elemento.descuento,
					'<button class="btn btn-success" onclick="traer_productos('+elemento.id+','+elemento.id_usuario+')"><i class="fa fa-table" aria-hidden="true"></i></button>'
				]).draw().node();
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas[index]);
				});
			})
			console.log(obj);
		}
	})
}

function traer_productos(id,id_usuario){
	var cont = "";
	$.ajax({
		'url' : base_url + 'solicitudes/traer_productos',
		'type' : 'post',
		'data' : {'id' : id},
		'datatype' : 'json',
		'success' : function(obj){
			$('#ver').modal('show');
			$('#btn-enviar').html('<button type="button" onclick="enviar_productos('+id+','+id_usuario+')" class="btn btn-success">Enviar datos</button>');
			$.each(obj, function(i,elemento){
				cont += '<tr>' +
				'<td>'+elemento.sku+'</td>'+
				'<td>'+elemento.nombre+'</td>'+
				'<td>'+elemento.cantidad+'</td>'+
				'<td>'+elemento.subtotal+'</td>'+
				'<td>'+elemento.descuento+'</td>'+
				'</tr>';
				
			});
			$('#tabla-productos').html(cont);
		}
	})
}

function enviar_productos(id,id_usuario){
	Swal.fire({
		title: 'Seguro que deseas agregar la solicitud a un pedido?',
		icon: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Agregar solicitud'
	  }).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				'url' : base_url + 'solicitudes/enviar_pedido',
				'type' : 'post',
				'data' : {'id' : id, 'id_usuario' : id_usuario},
				'datatype' : 'post',
				'success' : function(obj){
					console.log(obj);
					Swal.fire(
						'Se ha agregado el pedido a dolibar',
						'El pedido en dolibarr tiene el id ' + obj,
						'success'
					);
					traer_solicitudes();
				}
			})
		  
		}
	  })
}

function ver_anteriores(){
	var status = 1;
	$.ajax({
		'url' : base_url + 'solicitudes/traer_solicitudes',
		'type' : 'post',
		'data' : {'status' : status},
		'datatype' : 'json',
		'success' : function(obj){
			tabla_usuarios.clear().draw();
			$.each(obj, function(i,elemento){
				var nuevaFila = tabla_usuarios.row.add([
					elemento.nombre + " " + elemento.apellido_paterno + " " + elemento.apellido_materno,
					elemento.fecha,
					elemento.hora,
					elemento.subtotal,
					elemento.descuento,
					'<button class="btn btn-success" onclick="traer_productos('+elemento.id+','+elemento.id_usuario+')"><i class="fa fa-table" aria-hidden="true"></i></button>'
				]).draw().node();
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas[index]);
				});
			})
			console.log(obj);
		}
	})
}

function productos_anteriores(){
	$.ajax({
		'url' : base_url + 'solicitudes/traer_productos',
		'type' : 'post',
		'data' : {'id' : id},
		'datatype' : 'json',
		'success' : function(obj){
			$('#ver').modal('show');
			$('#btn-enviar').html('<button type="button" onclick="clonar_pedido('+id+','+id_usuario+')" class="btn btn-success">Clonar pedido</button>');
			$.each(obj, function(i,elemento){
				cont += '<tr>' +
				'<td>'+elemento.sku+'</td>'+
				'<td>'+elemento.nombre+'</td>'+
				'<td>'+elemento.cantidad+'</td>'+
				'<td>'+elemento.subtotal+'</td>'+
				'<td>'+elemento.descuento+'</td>'+
				'</tr>';
				
			});
			$('#tabla-productos').html(cont);
		}
	})
}

function clonar_pedido(){

}

function agregar_solicitud(){
	$('#generar_solicitud').modal('show');
}
