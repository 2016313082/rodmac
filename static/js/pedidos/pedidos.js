var columnas = [];
var columnas_productos = []; 
var columnas_cantidades = [];
var tabla_proveedores;
var tabla_productos;
var tabla_cantidades;
var url_document = "https://betaerp.metusgroup.com/documents/fournisseur/commande/";
//var url_document = "https://erp.metusgroup.com/documents/" //entorno de produccion
$('#tabla-proveedores thead tr th').each(function(){
	columnas.push($(this).html());
});

$('#tabla-productos thead tr th').each(function(){
	columnas_productos.push($(this).html());
});

$('#lista_productos thead tr th').each(function(){
	columnas_cantidades.push($(this).html());
});

$(document).ready(function(){
	$('#estrellas0').starrr({
		change: function(e, value){
			var id_pregunta = 1;
			var id_proveedor = $('#id_proveedor').val();
			var id_pedido = $('#id_pedido').val();
			var data = {
				'id_pregunta' : id_pregunta,
				'id_proveedor' : id_proveedor,
				'id_pedido' : id_pedido,
				'calificacion' : value
			};
			$.ajax({
				'url' : base_url + 'pedidos_proveedores/registrar_calificacion',
				'type' : 'post',
				'data' : data,
				'datatype' : 'json',
				'success' : function(obj){
					console.log(obj);
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
						})
							
						Toast.fire({
							icon: 'success',
							title: 'Se ha calificado al proveedor'
						})
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
						})
							
						Toast.fire({
							icon: 'error',
							title: 'No se pudo calificar al proveedor'
						})
					}
				}
			})
		}
	});

	$('#estrellas1').starrr({
		change: function(e, value){
			var id_pregunta = 2;
			var id_proveedor =$('#id_proveedor').val();
			var id_pedido = $('#id_pedido').val();
			var data ={
				'id_pregunta' : id_pregunta,
				'id_proveedor' : id_proveedor,
				'id_pedido' : id_pedido,
				'calificacion' : value
			}; 
			$.ajax({
				'url': base_url+ 'pedidos_proveedores/registrar_calificacion',
				'type':'post',
				'data': data,
				'datatype':'json',
				'success':function(obj){
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
						})

						Toast.fire({
							icon: 'success',
							title: 'Se ha calificado al proveedor'
						})
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
						})
							
						Toast.fire({
							icon: 'error',
							title: 'No se pudo calificar al proveedor'
						})
					}
				}
			})
		}
	});

	$('#estrellas2').starrr({
		change: function(e, value){
			var id_pregunta = 3;
			var id_proveedor = $('#id_proveedor').val();
			var id_pedido = $('#id_pedido').val();
			var data ={
				'id_pregunta' : id_pregunta,
				'id_proveedor' : id_proveedor,
				'id_pedido' : id_pedido,
				'calificacion' : value
			};  
			$.ajax({
				'url': base_url+ 'pedidos_proveedores/registrar_calificacion',
				'type': 'post',
				'data': data,
				'datatype': 'json',
				'success':function(obj){
					console.log(obj);
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
						})
							
						Toast.fire({
							icon: 'success',
							title: 'Se ha calificado al proveedor'
						})
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
						})
							
						Toast.fire({
							icon: 'error',
							title: 'No se pudo calificar al proveedor'
						})
					}
				}
			})
		  //alert('new rating is ' + value)
		}
	});

	$('#estrellas3').starrr({
		change: function(e, value){
			var id_pregunta = 4;
			var id_proveedor = $('#id_proveedor').val();
			var id_pedido = $('#id_pedido').val();
			var data ={
				'id_pregunta': id_pregunta,
				'id_proveedor': id_proveedor,
				'id_pedido': id_pedido,
				'calificacion': value
			};
			$.ajax({
				'url': base_url+ 'pedidos_proveedores/registrar_calificacion',
				'type':'post',
				'data': data,
				'datatype':'json',
				'success':function(obj){
					console.log(obj);
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
							})
							
							Toast.fire({
							icon: 'success',
							title: 'Se ha calificado al proveedor'
							})
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
						})
							
						Toast.fire({
							icon: 'error',
							title: 'No se pudo calificar al proveedor'
						})
					}
				}
			})	
		}
	});

	$('#estatus_pedido').text('(En proceso)');
	tabla_pedidos = $('#tabla-pedidos').DataTable({
		responsive: true,
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		},
        scrollCollapse: true,
		"aaSorting": []
	});

	tabla_productos = $('#tabla-productos').DataTable({
		responsive: true,
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		},
        scrollCollapse: true,
		'iDisplayLength': 100,
		"aaSorting": [],
		columnDefs:[{
            targets: "_all",
            sortable: false
        }]
	});

	tabla_cantidades = $('#lista_productos').DataTable({
		responsive: true,
		"language": {
			"url" : "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
		},
        scrollCollapse: true,
		'iDisplayLength': 100,
		"aaSorting": []
	});

	ver_pedidos();

	$('.radio-group .radio').click(function(){
		$(this).parent().find('.radio').removeClass('selected');
		$(this).addClass('selected');
	});

	$(".submit").click(function(){
		return false;
	})
});

function cargar_pedidos(){
	var cliente = "";
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/traer_pedidos',
		'datatype' : 'json',
		'success' : function(obj){
			tabla_proveedores.clear().draw();
			$.each(obj, function(i,elemento){
				console.log(elemento);
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

function ver_pedidos(){
	var status_pedido = 0;
	var clase = '';
	var boton = '';
	var funcion = '';
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/traer_pedidos',
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
			tabla_pedidos.clear().draw();
			$.each(obj,function(i, elemento){
				status_pedido = elemento[0].status_pedido;
				switch(parseInt(status_pedido)){
					case 0:
						clase = 'table-primary';
						boton = '';
						funcion = 'mostrar_ventana';
						break;
					case 1:
						clase = 'table-primary';
						boton = '';
						funcion = 'mostrar_ventana';
						break;
					case 2:
						clase = 'table-primary';
						boton = '';
						break;
						funcion = 'mostrar_ventana';
					case 3:
						clase = 'table-secondary';
						boton = '';
						funcion = 'mostrar_ventana';
						break;
					case 4:
							
							clase = 'table-success';
							boton = '';
							funcion = 'finalizar_pedido';
							break;
					default:
						clase = 'table-warning';
						funcion = 'mostrar_ventana';
						boton = '';
						break;
				}

				var date = new Date(elemento.delivery_date * 1000);
				var hours = date.getHours();
				var minutes = "0" + date.getMinutes();
				var seconds = "0" + date.getSeconds();
				var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
				date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
				var strDate = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + date.getSeconds();
					// expected output "8/30/2017"
				var nuevaFila = tabla_pedidos.row.add([
					elemento.ref,
					elemento.user_author_id,
					elemento.socid,
					strDate,
					elemento.status,
					'<button type="button" class="btn btn-primary" '+boton+' onclick="'+funcion+'('+elemento.id+')"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button> ' +
					'<button type="button" class="btn btn-secondary" onclick="pedido_pdf(`'+elemento.ref+'`,`'+url_document+'`)"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button> ' +
					'<a href="http://betaerp.metusgroup.com/fourn/commande/card.php?id='+elemento.id+'" target="_blank" type="button" class="btn btn-danger")"><i class="fa fa-eye" aria-hidden="true"></i></a>'
				]).draw().node();
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas[index]);
				});
				$( nuevaFila ).addClass(clase)
				$("#spinner").addClass("d-none");
				$(".overlay").addClass("d-none");
			});
		}
	})
}

function traer_tipo(tipo_pedido){
	$("#spinner").removeClass("d-none");
	$(".overlay").removeClass("d-none");
	var modulo = "";
	if(tipo_pedido == 'draft'){
		$('#estatus_pedido').text('(Borrador)');
		//modulo = "commande";
	}else if(tipo_pedido == 'validated'){
		$('#estatus_pedido').text('(Validado)');
	}else if(tipo_pedido == 'approved'){
		$('#estatus_pedido').text('(Aprovado)');
	}else if(tipo_pedido == 'running'){
		$('#estatus_pedido').text('(En proceso)');
	}else if(tipo_pedido == 'received_start'){
		$('#estatus_pedido').text('(Inicio recibido)');
	}else if(tipo_pedido == 'received_end'){
		$('#estatus_pedido').text('(Final recibido)');
	}else if(tipo_pedido == 'cancelled'){
		$('#estatus_pedido').text('(Cancelado)');
	}else if(tipo_pedido){
		$('#estatus_pedido').text('(Rechazado)');
	}
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/traer_pedidos_estatus',
		'type' : 'post',
		'data' : {'tipo_pedido':tipo_pedido},
		'datatype' : 'json',
		'success' : function(obj){
			
			tabla_pedidos.clear().draw();
			$.each(obj,function(i, elemento){
				var date = new Date(elemento.delivery_date * 1000);
				var hours = date.getHours();
				var minutes = "0" + date.getMinutes();
				var seconds = "0" + date.getSeconds();
				var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
				date.setMinutes(date.getMinutes() + date.getTimezoneOffset());
				var strDate = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + date.getSeconds();
				var nuevaFila = tabla_pedidos.row.add([
					elemento.ref,
					elemento.user_author_id,
					elemento.socid,
					strDate,
					elemento.status,
					'<button type="button" class="btn btn-primary" onclick="mostrar_ventana('+elemento.id+')"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></button> ' +
					'<button type="button" class="btn btn-secondary" onclick="pedido_pdf(`'+elemento.ref+'`,`'+url_document+'`)"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button> ' +
					'<a href="http://betaerp.metusgroup.com/fourn/commande/card.php?id='+elemento.id+'" target="_blank" type="button" class="btn btn-danger")"><i class="fa fa-eye" aria-hidden="true"></i></a>'
				]).draw().node();
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas[index]);
				});
				
				$("#spinner").addClass("d-none");
				$(".overlay").addClass("d-none");
			});
		}
	})
}

function pedido_pdf(ref,url_document){
	window.open(url_document+ref+'/'+ref+'.pdf','_blank');
}

function mostrar_ventana(id_pedido){
	var i = 0;
	swal.fire({
		'icon':'question',
		'title' : 'Desea iniciar el proceso de aceptacion?',
		'text' : 'Una vez iniciado este proceso se debe de finalizar',
		showDenyButton: true,
		showCancelButton: false,
		confirmButtonText: 'Iniciar',
		denyButtonText: `Cancelar`,
	}).then((result) => {
		
		/* Read more about isConfirmed, isDenied below */
		if (result.isConfirmed) {
			
			$.ajax({
				'url' : base_url + 'pedidos_proveedores/primer_paso',
				'type' : 'post',
				'data' : {'id_pedido' : id_pedido},
				'datatype' : 'json',
				'success' : function(obj){
					console.log(obj);
					//Desco,m
					//if(obj == true){
						empezar_proceso(id_pedido);
					/* }else{
						swal.fire({
							'icon' : 'error',
							'title' : 'No se pudo iniciar con el proceso',
							'text' : 'Contactate con tu asesor',
						})
					} */
				}
			})
		}
	})
}

function empezar_proceso(id_pedido){
	$('#clonar').html('<a href="#" onclick="clonar('+id_pedido+')">Clonar cantidad solicitada a cantidad entregada</a>');
	$('#enviar_pedido').html('<button class="btn btn-success" onclick="enviar_pedido('+id_pedido+')">Enviar</button>');
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/traer_productos',
		'type' : 'post',
		'data' : {'id_pedido':id_pedido},
		'datatype' : 'json',
		'success' : function(obj){
			//id_pedido = socid
			$('#id_proveedor').val(obj.socid);
			$('#id_pedido').val(id_pedido);
			tabla_productos.clear().draw();
			console.log(obj.lines);
			$.each(obj.lines,function(i,elemento){
				i++;
				var nuevaFila = tabla_productos.row.add([
					elemento.fk_product,
					elemento.product_ref,
					elemento.product_label,
					elemento.pu_ht,
					elemento.qty,
					'<input type="text" class="form-control" id="qty_entregada'+i+'">'
				]).draw().node();
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas_productos[index]);
				});
			})
		}
	});
	ver_pedidos();
	$('#proceso-ingreso').modal({backdrop: 'static', keyboard: false});
	$('#proceso-ingreso').modal('show');
}

function clonar(id_pedido){
	var i = 0;
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/traer_productos',
		'type' : 'post',
		'data' : {'id_pedido':id_pedido},
		'datatype' : 'json',
		'success' : function(obj){
			tabla_productos.clear().draw();
			$.each(obj.lines,function(i,elemento){
				i++;
				var nuevaFila = tabla_productos.row.add([
					elemento.fk_product,
					elemento.product_ref,
					elemento.product_label,
					elemento.pu_ht,
					elemento.qty,
					'<input type="text" class="form-control" value="'+elemento.qty+'" id="qty_entregada'+i+'">'
				]).draw().node();
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas_productos[index]);
				});
			})
		}
	});
}

function enviar_pedido(id_pedido){
	var productos;
	var i = 0;
	var contenido = [];
	$('#tabla-productos tr').each(function(){
		//console.log($(celdas[0]).html());
        var celdas = $(this).find('td');
		productos = {
			'id_producto' :  $(celdas[0]).html(),
			'qty' : $(celdas[4]).html(),
			'qty_entregada' : $('#qty_entregada'+i).val(),
			'nombre' : $(celdas[2]).html(),
			'precio_compra' : $(celdas[3]).html()
		};
		i++;
		contenido.push(productos);

	});

	$.ajax({
		'url' : base_url + 'pedidos_proveedores/capturar_cantidades',
		'type' : 'post',
		'data' : {'contenido':contenido,'id_pedido':id_pedido},
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
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
				})
				  
				Toast.fire({
					icon: 'success',
					title: 'Se registraron las cantidades, puedes ir al siguiente paso'
				})
				$('#btn-cantidades').removeClass('d-none');
				lista_productos(id_pedido);
			}
		}
	});
}

function lista_productos(id_pedido){
	var porcentaje = 0;
	$('#enviar_pedido').html('<button class="btn btn-success" onclick="enviar_evidencias('+id_pedido+')">Enviar</button>');
	$('#enviar_evidencias').html('<input id="btn_status" onclick="cambiar_status('+id_pedido+')" type="button" name="next" class="next action-button" value="Siguiente"/>');
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/traer_productos_pedidos',
		'type' : 'post',
		'data' : {
			'id_pedido' : id_pedido
		},
		'datatype' : 'json',
		'success' : function(obj){
			tabla_cantidades.clear().draw();
			$.each(obj, function(i,elemento){
				
				porcentaje = elemento.cantidad_entregada * 0.15;
				var nuevaFila = tabla_cantidades.row.add([
					elemento.id,
					elemento.nombre_producto,
					elemento.cantidad_esperada,
					elemento.cantidad_entregada,
					elemento.merma,
					porcentaje,
					'<a class="btn btn-success" href="'+base_url+'pedidos_proveedores/editar_evidencias/'+elemento.id+'/'+id_pedido+'" target="_blank"><i class="fa fa-plus" aria-hidden="true"></i></a> '
				]).draw().node();
				$('#camera'+elemento.id).css('display', 'none');
				$('td', nuevaFila).each(function(index,td){
					$(td).attr('data-label',columnas_cantidades[index]);
				});
			});
		}
	})
}
// mostrar foto 
/* 
	evidencia fotografica 
	calcular el 15% de la cantidad entregada 
	comentarios osbre producto
*/

function cambiar_status(id_pedido){
	current_fs = $('#btn_status').parent().parent();
	next_fs = $('#btn_status').parent().parent().next();
		//Add Class Active
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now) {
				// for making fielset appear animation
				opacity = 1 - now;
				console.log(opacity);
				current_fs.css({
					'display': 'none',
					'position': 'relative'
				});
				next_fs.css({'opacity': opacity});
			}, 
			duration: 600
		});
	
		$.ajax({
			'url' : base_url + 'pedidos_proveedores/cambiar_status',
			'type' : 'post',
			'data' : {'id_pedido':id_pedido,'status' : 2},
			'datatype' : 'json',
			'success' : function(obj){
				console.log(obj);
			}
		});
		$('#calificacion').html('<input hidden onclick="btn_calificacion('+id_pedido+')" type="button" id="btn_calificacion" name="next" class="next action-button" value="Siguiente"/>');
}

function btn_cantidades(){
	current_fs = $('#btn-cantidades').parent();
	next_fs = $('#btn-cantidades').parent().next();
		//Add Class Active
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now) {
				// for making fielset appear animation
				opacity = 1 - now;

				current_fs.css({
					'display': 'none',
					'position': 'relative'
				});
				next_fs.css({'opacity': opacity});
			}, 
			duration: 600
		});
}

function btn_calificacion(){
	var id_pedido = $('#id_pedido').val();
	$('#btn_finalizar').html('<a href="#" onclick="finalizar_pedido('+id_pedido+')" class="btn btn-success btn-block">Terminar proceso de recepcion</a>');
	current_fs = $('#btn_calificacion').parent().parent();
	next_fs = $('#btn_calificacion').parent().parent().next();
		//Add Class Active
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
		//console.log(current_fs);
		//show the next fieldset
		next_fs.show(); 
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
			step: function(now) {
				// for making fielset appear animation
				opacity = 1 - now;
				current_fs.css({
					'display': 'none',
					'position': 'relative'
				});
				next_fs.css({'opacity': opacity});
			}, 
			duration: 600
		});
}

function finalizar_pedido(id_pedido){
	swal.fire({
		'icon' : 'question',
		'title' : 'Desea cambiar el pedido a inicio recibido?',
		showDenyButton: true,
		showCancelButton: false,
		confirmButtonText: 'Finalizar',
		denyButtonText: `Cancelar`,
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				'url' : base_url + 'pedidos_proveedores/finalizar_pedido',
				'type' : 'post',
				'data' : {'id_pedido' : id_pedido},
				'datatype' : 'json',
				'success' : function(obj){
					if(obj != null){
						location.reload();
					}else{
						alert('No se pudo cambiar de status');
					}
				}
			})
		}
	})
}

setInterval(function(){
	var id_pedido = $('#id_pedido').val();
    $.ajax({
		'url' : base_url + 'pedidos_proveedores/traer_status',
		'type' : 'post',
		'data' : {'id_pedido' : id_pedido},
		'datatype' : 'json',
		'success' : function(obj){
			if(obj.espera.num_rows > 0){
				ver_pedidos();
			}

			if(obj.aprobado.num_rows > 0){
				btn_calificacion();
				console.log(id_pedido);
			}
		}
	})
}, 30000);
