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
	
	$('#formulario_articulo').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			'url' : base_url + 'Costos/agregar_articulo',
			'type' : 'post',
			'data' : new FormData(this),
			'contentType': false,
            'cache': false,
            'processData': false,
			'success' : function(obj){
				if(obj['resultado'] == true){
					swal.fire({
						'icon' : 'success',
						'title' : 'El costo se ha ingresado correctamente',
						showCancelButton: true,
						confirmButtonText: `Agregar otro costo`,
						cancelButtonText: `Volver a la gestión de costos`,
					}).then((result) => {
						if (result.isConfirmed) {
							$("#formulario_articulo")[0].reset();
						} else{
							window.location.href = base_url + 'Costos';
						}
					})
						
				}else{
					alert('No se pudo ingresar el costo');
				}
			}
		})
	});
});




