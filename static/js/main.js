$(document).ready(function() {
	"use strict";
	
	/* $.ajaxSetup({
		'error' : function(xhr){
			Swal.fire({
				'icon' : 'error',
				'title' : 'Error en el servidor',
				'html' : '<b>Mensaje técnico:</b><br>' +
						 '<p>' + xhr.status + ' ' + xhr.statusText + '</p>',
				confirmButtonText: 'Aceptar'
			});
		}
	}); */

	var fullHeight = function() {
		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});
	};
	
	fullHeight();
	
	$('#boton-sidebar').on('click', function (e) {
		e.stopPropagation();
		$('#sidebar').toggleClass('active');
		$('#content').toggleClass('inactive');
	});
	
	$('#cerrar_sidebar').click(function() {
		$('#sidebar').toggleClass('active');
		$('#content').toggleClass('inactive');
	});

	$('body,html').click(function (e) {
		var container = $("#sidebar");

		if (!container.is(e.target) && container.has(e.target).length === 0) {
			$('#sidebar').removeClass('active');
			$('#content').removeClass('inactive');
		}
	});
	
	$('#minimizar_sidebar').click(function() {
		$('#sidebar').toggleClass('minimizado');
	});
});