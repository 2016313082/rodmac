<style>
	.scroll-container {
		width: 350px;
		height: 200px;
		overflow-y: scroll;
		scroll-behavior: smooth;
	}

	#cart_menu_num {
		position: absolute;
		top: -2px;
		left: 45%;
		background: red;
		width: 20px;
		height: 20px;
		border-radius: 50%;
		display: flex;
		justify-content: center;
		align-items: center;
		color: white;
		padding: 5px;
	}

	.notification{
		color: #000000;
	}

	.dropdown-menu-notification {
		background-color: #F9F8F8;
		width: 350px !important;
		height: 450px !important;
	}

	.dropdown-content {
		display: none;
		position: absolute;
		background-color: #f9f9f9;
		min-width: 160px;
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		padding: 12px 16px;
		z-index: 1;
	}

	@media only screen and (max-width: 414px){
		.notification {
			color: #fff;
		}

		.dropdown-menu-notification {
			background-color: #F9F8F8;
			width: 350px !important;
			height: 450px !important;
		}

		.dropdown-divider-notification{
			background-color: #000;
		}

		.dropdown-content {
			left: -20%;
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 360px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			padding: 12px 16px;
			z-index: 1;
		}
			
		
	}

	@media only screen and (max-width: 360px){
		.notification {
			color: #fff;
		}

		.dropdown-menu-notification {
			background-color: #F9F8F8;
			width: 350px !important;
			height: 450px !important;
		}

		.dropdown-divider-notification{
			background-color: #000;
		}

		.dropdown-content {
			left: -550%;
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 360px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			padding: 12px 16px;
			z-index: 1;
		}
			
		
	}

</style>
<nav id="topbar" class="navbar navbar-expand-lg">
	<div class="container-fluid">
		<button type="button" id="boton-sidebar" class="btn d-xl-none boton-sidebar">
			<i class="fa fa-bars"></i>
			<span class="sr-only">Toggle Menu</span>
		</button>
		<div class="btn-group">
			<a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span style="font-size: 12px;" id="cart_menu_num" data-action="cart-can" class="badge rounded-circle"></span><i class="fa fa-bell fa-lg notification" aria-hidden="true"></i></span>
				<span class="sr-only">Toggle Dropdown</span>
			</a>
			<div class="dropdown-menu dropdown-menu-notification dropdown dropdown-content scroll-container" id="dropdown-notificaciones">
				<h5>Notificaciones</h5>
				<span style="font-size: 15px;"  id="texto-notificacion"></span><br>
			</div>
		</div>
		<div id="boton-usuario" class="btn-group">
			<a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span><?=$this->session->usuario['nombre'].' '.$this->session->usuario['apellido_paterno'].' '.$this->session->usuario['apellido_materno']?></span>
				<span class="sr-only">Toggle Dropdown</span>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="<?= base_url() ?>cuenta">Cuenta</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?= base_url() ?>logout">Cerrar sesión</a>
			</div>
		</div>
		
	</div>
</nav>
<script src="<?= base_url() ?>static/js/jquery.min.js"></script>
<script>

	/* var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	}; */

	$(document).ready(function(){
		notificaciones(); 
		/* if(isMobile.iOS()) {
			alert('hola');
			$('#dropdown-notificaciones').removeClass('dropdown-content');
			$('#dropdown-notificaciones').addClass('dropdown-content-iphone');
		} */
	});
    
	var nivel = '<?= $this->session->usuario['nivel']?>';

	function notificaciones(){
		var contador = 0;
		var contenido = '';
		var tiempo = '';
		$.ajax({
			'url' : base_url + 'notificaciones/traer_notificaciones',
			'datatype' :'json',
			'success' : function(obj){
				$.each(obj, function(i, elemento){
					contador++;
					if(nivel == 'Propietario' || nivel == 'Administrador'){
						contenido += '<a href="'+base_url+'pedidos_proveedores/aprobar_view"><b>' + elemento.texto + '</b>' + '<br><span>'+elemento.fecha+'</span><div class="dropdown-divider dropdown-divider-notification"></div></a>';
					}else{
						contenido += '<b>' + elemento.texto + '</b>' + '<br><span>'+elemento.fecha+'</span><div class="dropdown-divider dropdown-divider-notification"></div>';
					}
						
					tiempo += elemento.fecha;
				});
				$('#texto-notificacion').html(contenido);
				$('#cart_menu_num').text(contador);
			}
		});
	} 

	setInterval(function(){
    	notificaciones();
	}, 5000);
</script>
