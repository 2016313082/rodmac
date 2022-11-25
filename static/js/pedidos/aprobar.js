
var columnas = [];
var tabla;
$('#tabla thead tr th').each(function () {
	columnas.push($(this).html());
});

$(document).ready(function () {
	tabla = $('#tabla').DataTable({
		responsive: true,
		"language": {
			"url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		},
		scrollCollapse: true,
		'iDisplayLength': 100,
		"aaSorting": []
	});
	ver_pedidos();
	$("#spinner").addClass("d-none");
	$(".overlay").addClass("d-none");
});

function ver_pedidos() {
	var status_pedido = 0;
	var clase = '';
	$.ajax({
		'url': base_url + 'pedidos_proveedores/traer_pedidos',
		'datatype': 'json',
		'success': function (obj) {
			console.log(obj);
			tabla.clear().draw();
			$.each(obj, function (i, elemento) {
				status_pedido = elemento[0].status_pedido;
				switch (parseInt(status_pedido)) {
					case 0:
						clase = 'table-primary';
						break;
					case 1:
						clase = 'table-primary';
						break;
					case 2:
						clase = 'table-primary';
						break;
					case 3:
						clase = 'table-secondary';

						var date = new Date(elemento.delivery_date * 1000);
						var hours = date.getHours();
						var minutes = "0" + date.getMinutes();
						var seconds = "0" + date.getSeconds();
						var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
						var strDate = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + date.getSeconds();
						// expected output "8/30/2017"
						var nuevaFila = tabla.row.add([
							elemento.ref,
							elemento.user_author_id,
							elemento.socid,
							strDate,
							elemento.status,
							'<button class="btn btn-success" onclick="mostrar_evidencias(' + elemento.id + ')"><i class="fa fa-eye" aria-hidden="true"></i></button>'
						]).draw().node();
						$('td', nuevaFila).each(function (index, td) {
							$(td).attr('data-label', columnas[index]);
						});
						$(nuevaFila).addClass(clase)
						$("#spinner").addClass("d-none");
						$(".overlay").addClass("d-none");
						break;
					case 4:
						clase = 'table-success';
						break;
					default:
						clase = 'table-warning';
						break;
				}
			});
		}
	})
}

/* function mostrar_evidencias(id_pedido){
	var contenido = '';
	var almacenes = '';

	$.ajax({
		'url': base_url + 'pedidos_proveedores/traer_evidencias',
		'type': 'post',
		'data': { 'id_pedido': id_pedido },
		'datatype': 'json',
		'success': function (obj) {
			$.each(obj, function (i, elemento) {
				$.each(obj.almacenes, function(i, elemento){
					almacenes += '<option value="'+elemento.id+'">'+elemento.libelle+'</option>'
				});
				$('#almacenes'+id_producto).append(almacenes);
				console.log(elemento);
				contenido += '<div class="row p-2 bg-white border rounded">' +
					'<div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="'+base_url+'img/evidencias/'+elemento.fotografia+'"></div>' +
					'<div class="col-md-6 mt-1">' +
					'<h5>' + elemento.nombre_producto + '</h5>' +
					'<div class="d-flex flex-row">' +
					'<div class="ratings mr-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div><span>310</span>' +
					'</div>' +
					'<div class="mt-1 mb-1 spec-1"><span>100% cotton</span><span class="dot"></span><span>Light weight</span><span class="dot"></span><span>Best finish<br></span></div>' +
					'<div class="mt-1 mb-1 spec-1"><span>Unique design</span><span class="dot"></span><span>For men</span><span class="dot"></span><span>Casual<br></span></div>' +
					'<select id="almacenes'+elemento.id_producto+'" class="form-control"></select>'+
				'</div>' +
					'<div class="align-items-center align-content-center col-md-3 border-left mt-1">' +
					'<div class="d-flex flex-row align-items-center">' +
					'<input class="form-control" id="precio_compra'+elemento.id_producto+'">' +
					'</div>' +
					'<h6 class="text-success">Free shipping</h6>' +
					'<div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Details</button><button onclick="agregar_cantidades('+id_pedido+','+elemento.id_producto+',)" class="btn btn-outline-success btn-sm mt-2" type="button">Enviar datos</button></div>' +
					'</div>'+
					'</div>';
			})
			$('#aprobar_evidencia').html(contenido);
			
			$('#evidencias').modal('show');
		}
	});
} */

function mostrar_evidencias(id_pedido) {
	var contenido = '';
	var almacenes = '';
	var contador = 0;
	const ids_productos = [];
	$.ajax({
		'url': base_url + 'pedidos_proveedores/traer_evidencias',
		'type': 'post',
		'data': { 'id_pedido': id_pedido },
		'datatype': 'json',
		'success': function (obj) {
			$('#id_pedido').val(id_pedido);
			$('#aprobar_evidencia').html('');
			almacenes += '<option disabled selected>Selecciona un almacen</option>';
			$.each(obj.almacenes, function (i, elemento) {
				almacenes += '<option value="' + elemento.id + '">' + elemento.libelle + '</option>'
			});
			$.each(obj, function (i, elemento) {
				
				contador++;
				if(elemento.status != 0){
					var check = 'checked';
				}else{
					var check = '';
				}

				if(elemento.status == 0){
					var cont = '<div class="d-flex flex-column mt-4" id="btn-productos'+elemento.id+'"><button onclick="estatus_producto(' + elemento.id + ', 1,'+obj.total_productos.productos+')" class="btn btn-outline-success btn-sm mt-2" type="button">Aprobar producto</button><button onclick="estatus_producto(' + elemento.id + ', 2,'+obj.total_productos.productos+')" class="btn btn-outline-danger btn-block btn-sm mt-2" type="button">Regresar producto</button><input placeholder="Comentario" type="text" id="comentario'+elemento.id+'"></div>';
				}

				if(elemento.status == 1){
					var cont = '<span>Has aprobado este producto <i class="fa fa-check-circle-o" style="color: green;" aria-hidden="true"></i></span>';
				}

				if(elemento.status == 2){
					var cont = '<span>Has regresado este producto <i class="fa fa-times-circle-o" style="color: red;" aria-hidden="true"></i></span>';
				}
				if (elemento.nombre_producto != null) {
					contenido += '<div id="data'+elemento.id+'" class="row p-2 bg-white border rounded" data-index-number="'+contador+'">' +
						'<div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="' + base_url + 'img/evidencias/' + elemento.fotografia + '"><input type="checkbox" class="CheckedAK" id="check'+elemento.id+'" '+check+'></div>' +
						'<div class="col-md-6 mt-1">' +
						'<h5>' + elemento.nombre_producto + '</h5>' +
						'<div><span>Cantidad esperada: </span><span class="dot"><h7>' + elemento.cantidad_esperada + '</h7></span></div>' +
						'<div><span>Cantidad entregada: </span><span class="dot"><h7>' + elemento.cantidad_entregada + '</h7></span></div>' +
						'<div><span>Merma: </span><span class="dot"><h7>' + elemento.merma + '</h7></span></div>' +
						'<div><span>Comentarios: </span><span class="dot"><h7>' + elemento.comentario + '</h7></span></div>' +
						'</div>' +
						'<div class="align-items-center align-content-center col-md-3 border-left mt-1">' +
						'<div class="d-flex flex-column mt-4">' +
						'<h7 class="text-success">Precio de compra</h7>' +
						'<input class="form-control" id="precio_compra' + elemento.id_producto + '" value="' + elemento.precio_compra + '" readonly>' +
						'</div>' +
						'<div class="d-flex flex-column mt-4" id="btn-productos'+elemento.id+'">'+cont+'</div>'+
						'<div id="estatus_producto' + elemento.id + '"></div>' +
						'<span id="validar'+elemento.id+'" style="color:red;"></span>' +
						'</div>' +
						'</div>';
					ids_productos.push(elemento.id_producto);
				}
			});
			$('#aprobar_evidencia').html(contenido);
			$('#almacenes').append(almacenes);
			var checked = $(".CheckedAK:checked").length; 
			var total_checked = checked + 1;
			console.log(checked + ' ' + obj.total_productos.productos);
			if(checked == obj.total_productos.productos){
				var boton_estatus = '<div class="col-sm-12">' +
					'<button class="btn btn-success btn-block" onclick="cambiar_status();">Enviar datos</button>' +
				'</div>';
			}else{
				var boton_estatus = '';
			}
			$('#cambiar_status').html(boton_estatus);
			$('#evidencias').modal('show');
		}
	});
}

function cambiar_status() {
	var id_pedido = $('#id_pedido').val();
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/cambiar_status',
		'type' : 'post',
		'data' : {'id_pedido':id_pedido,'status' : 4},
		'datatype' : 'json',
		'success' : function(obj){
			if(obj == true){
				swal.fire({
					'icon' : 'success',
					'title' : 'Se cambio el status del pedido, se notificara al encargado de almacen',
				})
				ver_pedidos();
			}else{
				swal.fire({
					'icon' : 'error',
					'title' : 'No se pudo cambiar el status del pedido',
				})
			}
		}
	});
}

function agregar_cantidades() {
	$("#spinner").removeClass("d-none");
	$(".overlay").removeClass("d-none");
	var id_pedido = $('#id_pedido').val();
	var almacen = $('#almacenes').val();
	$.ajax({
		'url': base_url + 'pedidos_proveedores/agregar_cantidades',
		'type': 'post',
		'data': { 'id_pedido': id_pedido, 'almacen': almacen },
		'datatype': 'json',
		'success': function (obj) {
			console.log(obj);
			if (obj == false) {
				$("#spinner").addClass("d-none");
				$(".overlay").addClass("d-none");
				swal.fire({
					'icon': 'error',
					'title': 'No se pudo actualizar con dolibarr',
				})
			} else {
				$("#spinner").addClass("d-none");
				$(".overlay").addClass("d-none");
				swal.fire({
					'icon': 'success',
					'title': 'Se han sincronizado los datos con dolibar de manera correcta',
				});
				ver_pedidos();
				$('#evidencias').modal('hide');
			}
		}
	});
}

function estatus_producto(id, status, total_productos){
	
	var checked = $(".CheckedAK:checked").length; 
	var total_checked = checked + 1;
	if(total_checked == total_productos){
		var boton_estatus = '<div class="col-sm-6" hidden>' + 
		'<select class="form-control" id="almacenes"></select>' + 
		'</div>' +
		'<div class="col-sm-12">' +
			'<button class="btn btn-success btn-block" onclick="cambiar_status();">Enviar datos</button>' +
		'</div>';
		console.log(checked + ' ' + total_productos);
	}else{
		console.log(checked + ' ' + total_productos);
	}
/* 	console.log($('#check'+id).is( ":checked" )); */
	var index = $('#data'+id).data('index-number');
	var comentario = $('#comentario'+id).val();
	var cont = '';
	if (status == 1) {
		swal.fire({
			'icon': 'question',
			'title': 'Seguro que deseas aprobar este producto?',
			showDenyButton: true,
			denyButtonText: `Cancelar`,
		}).then((result) => {
			if (result.isConfirmed){
				$.ajax({
					'url': base_url + 'pedidos_proveedores/estatus_producto',
					'type': 'post',
					'data': { 'id': id, 'estatus': status,'comentario' : comentario },
					'datatype': 'json',
					'success': function (obj) {
						console.log(obj);
						if(obj ==  true){
							cont = '<span>Has aprobado este producto <i class="fa fa-check-circle-o" style="color: green;" aria-hidden="true"></i></span>';
							$('#btn-productos'+id).html('');
							$('#btn-productos'+id).html(cont);
							$('#check'+id).prop("checked",true);
						}
						
					}
				})
			}
		})
	} else {
		if(comentario != ''){
			swal.fire({
				'icon': 'question',
				'title': 'Seguro que deseas regresar este producto?',
				showDenyButton: true,
				denyButtonText: `Cancelar`,
			}).then((result) => {
				if (result.isConfirmed){
					$.ajax({
						'url': base_url + 'pedidos_proveedores/estatus_producto',
						'type': 'post',
						'data': { 'id': id, 'estatus': status , 'comentario' : comentario},
						'datatype': 'json',
						'success': function (obj) {
							console.log(obj);
							if(obj ==  true){
								cont = '<span>Has regresado este producto <i class="fa fa-times-circle-o" style="color: red;" aria-hidden="true"></i></span>';
								$('#btn-productos'+id).html('');
								$('#btn-productos'+id).html(cont);
								$('#check'+id).prop("checked",true);
							}	
						}
					})
				}
			})
		}else{
			$('#validar'+id).text('No has agregado un comentario');
		} 
	}
}
//
