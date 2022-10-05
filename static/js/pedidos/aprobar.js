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

function ver_pedidos(){
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

function mostrar_evidencias(id_pedido){
	var contenido = '';
	var almacenes = '';
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
			$.each(obj.almacenes, function(i, elemento){
				almacenes += '<option value="'+elemento.id+'">'+elemento.libelle+'</option>'
			});
			$.each(obj, function (i, elemento){
				if(elemento.nombre_producto != null){
					contenido += '<div class="row p-2 bg-white border rounded">' +
					'<div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image" src="'+base_url+'img/evidencias/'+elemento.fotografia+'"></div>' +
					'<div class="col-md-6 mt-1">' +
					'<h5>' +elemento.nombre_producto+ '</h5>' +
					'<div><span>Cantidad esperada: </span><span class="dot"><h7>' +elemento.cantidad_esperada+ '</h7></span></div>'+
					'<div><span>Cantidad entregada: </span><span class="dot"><h7>' +elemento.cantidad_entregada+ '</h7></span></div>'+
					'<div><span>Merma: </span><span class="dot"><h7>' +elemento.merma+ '</h7></span></div>'+
					'<div><span>Comentarios: </span><span class="dot"><h7>' +elemento.comentario+ '</h7></span></div>'+
					'</div>' +
					'<div class="align-items-center align-content-center col-md-3 border-left mt-1">' +
					'<div class="d-flex flex-column mt-4">' +
					'<h7 class="text-success">Precio de compra</h7>' +
					'<input class="form-control" id="precio_compra'+elemento.id_producto+'" value="'+elemento.precio_compra+'" readonly>' +
					'</div>' +
					'<div class="d-flex flex-column mt-4"><button class="btn btn-primary btn-sm" type="button">Ver fotografia</button><button onclick="agregar_cantidades('+id_pedido+','+elemento.id_producto+','+elemento.cantidad_entregada+')" class="btn btn-outline-success btn-sm mt-2" type="button">Enviar datos</button></div>' +
					'</div>'+
					'</div>';
					ids_productos.push(elemento.id_producto);
				}
			});
			$('#aprobar_evidencia').html(contenido);
			$('#almacenes').append(almacenes);
			$('#evidencias').modal('show');
		}
	});
}

function cambiar_status(id_pedido){
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/cambiar_status',
		'type' : 'post',
		'data' : {'id_pedido':id_pedido,'status' : 4},
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
		}
	});
}

function agregar_cantidades(){
	$("#spinner").removeClass("d-none");
	$(".overlay").removeClass("d-none");
	var id_pedido = $('#id_pedido').val();
	var almacen = $('#almacenes').val();
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/agregar_cantidades',
		'type' : 'post',
		'data' : {'id_pedido' : id_pedido,'almacen' : almacen},
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
			if(obj == false){
				$("#spinner").addClass("d-none");
				$(".overlay").addClass("d-none");
				swal.fire({
					'icon' : 'error',
					'title' : 'No se pudo actualizar con dolibarr',
				})
			}else{
				$("#spinner").addClass("d-none");
				$(".overlay").addClass("d-none");
				swal.fire({
					'icon' : 'success',
					'title' : 'Se han sincronizado los datos con dolibar de manera correcta',
				});
				ver_pedidos();
				$('#evidencias').modal('hide');
			}
		}
	});
}
