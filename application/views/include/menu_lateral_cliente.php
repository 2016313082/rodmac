<style>
	.loader {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
		opacity: .8;
	}

	.overlay {
		position:absolute;
		top:0;
		left:0;
		right:0;
		bottom:0;
		background-color:#ffff;
		background: url(data:;base64,iVBORw0KGgoAAAANSUhEUgAAAAIAAAACCAYAAABytg0kAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAgY0hSTQAAeiYAAICEAAD6AAAAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAABl0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjUuNUmK/OAAAAATSURBVBhXY2RgYNgHxGAAYuwDAA78AjwwRoQYAAAAAElFTkSuQmCC) repeat scroll transparent\9; /* ie fallback png background image */
		z-index:1;
		color:white;
	}
</style>
<div class="overlay"></div>
<div id="spinner"></div>
<nav id="sidebar" class="pb-5 minimizado">
	<div class="sticky-menu mb-5">
		<button type="button" id="cerrar_sidebar" class="btn d-xl-none boton-sidebar mt-4">
			<i class="fa fa-bars"></i>
		</button>
		<button type="button" id="minimizar_sidebar" class="btn boton-sidebar d-none d-xl-block">
			<i class="fa fa-bars"></i>
		</button>
		<img class="logo-barra" src="<?= base_url() ?>img/logorodmactransparente.png">
		<ul class="list-unstyled components mb-5">
			<!-- <li class="<?= $seccion == 'cotizador' ? 'active' : ''?>">
				<a href="<?=base_url()?>cotizacion"><i class="fa fa-file-text-o"></i>Cotizador</a>
			</li> -->
			<?php if($this->session->usuario['link_menu'] == 1){ ?>
				<li class="<?= $seccion == 'configuracion_general' ? 'active' : ''?>">
					<a href="<?=base_url()?>cliente"><i class="fa fa-home" aria-hidden="true"></i></i>Home</a>
				</li>
			<?php } ?>
			<?php if($this->session->usuario['link_pedidos_cliente'] == 1){ ?>
			<li class="<?= $seccion == 'configuracion_general' ? 'active' : ''?>">
				<a href="<?=base_url()?>pedidos_cliente"><i class="fa fa-book" aria-hidden="true"></i></i>Mis pedidos</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</nav>
