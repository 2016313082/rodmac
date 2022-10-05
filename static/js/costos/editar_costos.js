$(document).ready(function(){
	$.ajax({
		'url' : base_url + 'Costos/traer_tipo_articulo',
		'datatype' : 'json',
		'success' : function(obj){
			var selectContenido = "";
			$.each(obj,function(i,elemento){
				selectContenido += 
				'<option value="'+elemento.id_tipo_articulo+'">'+elemento.nombre_tipo_articulo+'</option>'
			});
			$('#id_tipo_articulo').append(selectContenido);
		}
	});
	
	$.ajax({
		'url' : base_url + 'Costos/traer_costos',
		'type' : 'post',
		'data' : {id_costo},
		'datatype' : 'json',
		'success' : function(obj){
			var data = obj.data;
			console.log(data);
			$('#nombre_articulo').val(data.nombre_articulo);
			$('#costo_MXN').val(data.costo_MXN);
			$('#costo_USD').val(data.costo_USD);
		}
	})
	
	$('#formulario_articulo').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			'url' : base_url + 'Costos/editar_articulo',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				if(obj['resultado'] == true){
					swal.fire({
						'icon' : 'success',
						'title' : 'El costo se ha actualizado correctamente',
						confirmButtonText: `Aceptar`,
					}).then((result) => {
						window.location.href = base_url + 'Costos';
					})
				}else{
					alert('No se pudo actualizar el costo');
				}
			}
		})
	});
});