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
	$.ajax({
		'url' : base_url + 'pedidos_clientes/ver_pedidos',
		'datatype' : 'json',
		'success' : function(obj){
			console.log(obj);
			tabla.clear().draw();
			$.each(obj,function(i,elemento){
				var nuevaFila = tabla.row.add([
					elemento.ref_client,
					elemento.note_private,
					elemento.total_ttc,
					elemento.date_commande
				])
				console.log(elemento);
			})
		}
	})
}
