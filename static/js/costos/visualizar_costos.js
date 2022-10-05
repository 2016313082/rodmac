$(document).ready(function(){
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
			$('#nombre_tipo_articulo').val(data.nombre_tipo_articulo);
		}
	})
});