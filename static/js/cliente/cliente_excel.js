$(document).ready(function(){
	valida_status();
	$('#formulario').on('submit',function(e){
		e.preventDefault();
		//alert('si se pudo');
		$.ajax({
			'url' : base_url + 'cliente/subir_excel',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				console.log(obj);
				if(obj == true){
					datos_excel();
				}
				/* if(obj['resultado']){
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
				cargar_usuarios(); */
			}
		});
	})
})

	

	var inputBox = document.getElementById("inputBox");
	var img = document.getElementById("img");
	inputBox.addEventListener("change",function(){
		var reader = new FileReader();
		reader.readAsDataURL (inputBox.files[0]); // Iniciar una solicitud asincrónica
		//console.log(inputBox.files[0]);
		reader.onload = function(){
				// Después de leer, asigna el resultado al src de img
			//img.src = this.result
			$('#formulario').submit();
			//console.log(img);
		}
	});

	function datos_excel(){
		/* set up XMLHttpRequest */
		var cont = '';
		var url = base_url + "img/excel/"+id_usuario+".xlsx";
		var oReq = new XMLHttpRequest();
		oReq.open("GET", url, true);
		oReq.responseType = "arraybuffer";
		
		oReq.onload = function(e) {
			var arraybuffer = oReq.response;
			let pedido = [];
			var arreglo = [];
			/* convert data to binary string */
			var data = new Uint8Array(arraybuffer);
			var arr = new Array();
			for(var i = 0; i != data.length; ++i) arr[i] = String.fromCharCode(data[i]);
			var bstr = arr.join("");

			/* Call XLSX */
			var workbook = XLSX.read(bstr, {type:"binary"});

			/* DO SOMETHING WITH workbook HERE */
			var first_sheet_name = workbook.SheetNames[0];
			/* Get worksheet */
			var worksheet = workbook.Sheets[first_sheet_name];
			//console.log(XLSX.utils.sheet_to_json(worksheet,{raw:true}));
			var datos = XLSX.utils.sheet_to_json(worksheet,{raw:true});
			console.log(datos);
			$.each(datos,function(i,elemento){
				if(elemento.cantidad){
					arreglo = {
						'id' : elemento.id,
						'sku' : elemento.sku,
						'nombre' : elemento.nombre,
						'cantidad' : elemento.cantidad,
						'precio_venta' : elemento.precio_venta
					};

					pedido.push(arreglo);

					cont += '<tr>' +
					'<td>'+elemento.id+'</td>' +
					'<td>'+elemento.sku+'</td>' +
					'<td>'+elemento.nombre+'</td>' +
					'<td>'+elemento.cantidad+'</td>' +
					'<td>'+elemento.precio_venta+'</td>';
				}
			});
			console.log(pedido);
			$('#btn-confirmar').html("<button class='btn btn-success btn-block float-right' onclick='resumen(`"+JSON.stringify(pedido)+"`);'>Ver resumen</button>");
			$('#tabla-pedido').html(cont);
			$('#div-tabla').removeClass('d-none');
			$("#spinner").addClass("d-none");
			$(".overlay").addClass("d-none");
		}

		oReq.send();
	}


function eliminar_excel(){
	var url = "./img/excel/"+id_usuario+".xlsx";
	swal.fire({
		'icon' : 'question',
		'title' : 'Seguro que desea cancelar el pedido?',
		showDenyButton: true,
		confirmButtonText: 'confirmar',
		denyButtonText: `cancelar`,
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				'url' : base_url + 'cliente/eliminar_excel',
				'type' : 'post',
				'data' : {'url' : url},
				'datatype' : 'json',
				'success' : function(obj){
					console.log(obj);
					if(obj == true){
						swal.fire({
							'icon' : 'success',
							'title' : 'Se ha cancelado el pedido correctamente', 
						}).then((result) => {
							window.location.reload();
						})
					}
				}
			});
		}
	})
}

function valida_status(){
	$.ajax({
		url: base_url + 'img/excel/'+id_usuario+'.xlsx',
		type:'HEAD',
		error: function()
		{	
			$('#formulario').removeClass('d-none');
			$('#pedido_anterior').addClass('d-none');
			$('#div-tabla').addClass('d-none');
			$("#spinner").addClass("d-none");
			$(".overlay").addClass("d-none");
		},
		success: function()
		{	
			$('#formulario').addClass('d-none');
			datos_excel();
		}
	});
}

function resumen(pedido){
	if($('#hora-pedido').val() == ''){
		$('#alerta-error').removeClass('d-none');
		$('#alerta-mensaje').text('No se ha ingresado una hora');
	}else if($('#fecha-pedido').val() == ''){
		$('#alerta-error').removeClass('d-none');
		$('#alerta-mensaje').text('No se ha ingresado una fecha');
	}else{
		const formato = new Intl.NumberFormat('es-MX', { maximumFractionDigits: 2 });
		var data = []
		data['productos'] = $.parseJSON(pedido);
		var horario = {
			'hora' : $('#hora-pedido').val(),
			'fecha' : $('#fecha-pedido').val()
		};
		var subtotal = 0;
		var total = 0;
		var cont = '';
		data.push(horario);
		console.log(data[0].fecha);
		$.each(data.productos,function(i,elemento){
			//se multiplica la cantidad por el precio de venta
			subtotal = elemento.cantidad * elemento.precio_venta;
			total += subtotal;
			cont += '<tr>' +
			'<td>'+elemento.nombre+'</td>' + 
			'<td>' + elemento.cantidad + '</td>' + 
			'<td>$' + formato.format(subtotal) + '</td>'
			'</tr>';
		});
		$('#resumen-fecha').text(data[0].fecha);
		$('#resumen-hora').text(data[0].hora);
		$('#resumen-total').text('$'+formato.format((total)));
		$('#resumen-productos').html(cont);
		$('#btn-resumen-confirmar').html("<button class='btn btn-success btn-block float-right' onclick='enviar_solicitud(`"+JSON.stringify(data)+"`,`"+JSON.stringify(data['productos'])+"`);'>Enviar solicitud</button>");

		$('#modal-resumen').modal('show');
	}
}

function enviar_solicitud(data,productos){
	var pedido = [];
	var prod = [];
	var horario = [];
	prod['productos'] = $.parseJSON(productos);
	horario['horario'] = $.parseJSON(data);
	pedido.push(prod);
	pedido.push(horario);
	console.log(pedido);
	$.ajax({
		'url' : base_url + 'cliente/agregar_solicitud',
		'type' : 'post',
		'data' : {'productos' : JSON.stringify(prod['productos']), 'horario' : JSON.stringify(horario['horario'])},
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
		}
	});
}
