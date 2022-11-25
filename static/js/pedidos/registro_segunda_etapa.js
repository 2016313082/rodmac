$(document).ready(function(){
	traer_datos();
	traer_almacen();
	
	$('#id_evidencia').val(id_evidencia);
	$('#form-segunda').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			'url' : base_url + 'pedidos_proveedores/terminar_segunda',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				console.log(obj);
			}
		});
	})
	$("#spinner").addClass("d-none");
	$(".overlay").addClass("d-none");
})

function traer_datos(){
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/traer_datos',
		'type' : 'post',
		'data' : {'id_evidencia':id_evidencia},
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
			if(obj.proveedor.email == null){
				var email = 'No se ha registrado correo';
			}else{
				var email = obj.proveedor.email;
			}
			
			if(obj.proveedor.phone == null){
				var telefono = 'No se ha registrado telefono';
			}else{
				var telefono = obj.proveedor.phone;
			}

			if(obj.proveedor.address == ""){
				var direccion = 'No se ha registrado direccion';
			}else{
				var direccion = obj.proveedor.address;
			}
			console.log(obj);
			var porcentaje = obj.evidencias.cantidad_entregada * 0.15;
			$('#nombre_producto').html(obj.evidencias.nombre_producto);
			$('#cantidad_esperada').text(obj.evidencias.cantidad_esperada);
			$('#cantidad_entregada').text(obj.evidencias.cantidad_entregada);
			$('#porcentaje_revisado').text(porcentaje);
			$('#proveedor').text(obj.proveedor.name + ' ('+obj.proveedor.name_alias+')');
			$('#email').text(email);
			$('#telefono').text(telefono);
			$('#codigo').text(obj.proveedor.code_fournisseur);
			$('#direccion').text(direccion);
		}
	})
}

function readURL(){
	const input = document.getElementById('camera');
	if (input.files && input.files[0]){
	  var reader = new FileReader();
	  reader.onload = function(e){
		//Asignamos el atributo src a la tag de imagen
		$('#imagenmuestra').removeClass('d-none');
		$('#imagenmuestra').attr('src', e.target.result);
	  }
	  reader.readAsDataURL(input.files[0]);
	}
}

function traer_almacen(){
	var cont = '';
	$('#almacen').append('<option selected disabled>Selecciona un almacen</option>')
	$.ajax({
		'url' : base_url + 'pedidos_proveedores/traer_almacenes',
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
			$.each(obj, function(i,elemento){
				cont += '<option value="'+elemento.id+'">'+elemento.ref+'</option>'
			});
			$('#almacen').append(cont);
		}
	})
		
}
