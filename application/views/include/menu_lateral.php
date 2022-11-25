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
			<?php if($this->session->usuario['link_dashboard'] == 1){ ?>
				<li class="<?= $seccion == 'configuracion_general' ? 'active' : ''?>">
					<a href="<?=base_url()?>dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i></i>Dashboard</a>
				</li>
			<?php } ?>
			<?php if($this->session->usuario['link_usuarios'] == 1 || $this->session->usuario['link_proveedores']){ ?>
				<li>
					<a data-toggle="collapse" href="#gestion_general" role="button" aria-expanded="false" aria-controls="gestion_general" class="collapsed"><i class="fa fa-sliders"></i>Gestión general</a>
				</li>
			<?php } ?>
				<li class="collapse <?= $seccion == 'gestion_general' ? 'show' : ''?>" id="gestion_general">
					<ul class="list-unstyled components">
					<?php if($this->session->usuario['link_usuarios'] == 1){ ?>
						<li class="<?= $subseccion == 'usuarios' ? 'active' : ''?>">
							<a href="<?=base_url()?>usuarios"><i class="fa fa-id-card-o"></i>Usuarios</a>
						</li>
					<?php } ?>
					<?php if($this->session->usuario['link_proveedores'] == 1){ ?>
						<li class="<?= $subseccion == 'proveedores' ? 'active' : ''?>">
							<a href="<?=base_url()?>proveedores"><i class="fa fa-truck" aria-hidden="true"></i></i>Proveedores</a>
						</li>
					<?php } ?>
					<?php if($this->session->usuario['link_clientes'] == 1){ ?>
						<li class="<?= $subseccion == 'proveedores' ? 'active' : ''?>">
							<a href="<?=base_url()?>usuarios/clientes"><i class="fa fa-user-circle" aria-hidden="true"></i>Clientes</a>
						</li>
					<?php } ?>
					</ul>
				</li>
			<!-- 
				Aqui empieza los li de la gestion de pedidos
			 -->	

			 <?php if($this->session->usuario['link_usuarios'] == 1 || $this->session->usuario['link_proveedores']){ ?>
				<li>
					<a data-toggle="collapse" href="#pedidos" role="button" aria-expanded="false" aria-controls="pedidos" class="collapsed"><i class="fa fa-cart-plus" aria-hidden="true"></i>Pedidos</a>
				</li>
			<?php } ?>
			<li class="collapse <?= $seccion == 'pedidos' ? 'show' : ''?>" id="pedidos">
				<ul class="list-unstyled components">
					<li class="<?= $subseccion == 'proveedores' ? 'active' : ''?>">
						<a href="<?=base_url()?>pedidos_proveedores"><i class="fa fa-truck" aria-hidden="true"></i>Proveedores</a>
					</li>
					<li class="<?= $subseccion == 'proveedores' ? 'active' : ''?>">
						<a href="<?=base_url()?>pedidos_clientes"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Clientes</a>
					</li>
				</ul>
			</li>

			 <!-- 
				 Aqui termina los li de la gestion de pedidos
			  -->
			  	<li class="<?= $seccion == 'Almacen' ? 'active' : ''?>">
					<a href="<?=base_url()?>pedidos_proveedores/inicio_recibido"><i class="fa fa-book" aria-hidden="true"></i>Almacén</a>
				</li>
				<?php if($this->session->usuario['link_cuentas'] == 1 || $this->session->usuario['link_ingresos'] == 1 || $this->session->usuario['link_gastos'] == 1){ ?>
				<li>
					<a data-toggle="collapse" href="#gestion_especifica" role="button" aria-expanded="false" aria-controls="gestion_especifica" class="<?= $seccion == 'gestion_especifica' ? '' : 'collapse'?>"><i class="fa fa-university" aria-hidden="true"></i>Finanzas</a>
				</li>
				<?php } ?>
				<li class="collapse <?= $seccion == 'gestion_especifica' ? 'show' : ''?>" id="gestion_especifica" style="">
					<ul class="list-unstyled components">
						<li class="<?= $subseccion == 'bancos' ? 'active' : ''?>">
							<a href="<?=base_url()?>bancos"><i class="fa fa-university" aria-hidden="true"></i>Cuentas bancarias</a>
						</li>
						<li class="<?= $subseccion == 'paneles' ? 'active' : ''?>">
							<a href="<?=base_url()?>prueba"><i class="fa fa-user" aria-hidden="true"></i>Clientes externos</a>
						</li>
						<li class="<?= $subseccion == 'paneles' ? 'active' : ''?>">
							<a href="<?=base_url()?>prueba"><i class="fa fa-users" aria-hidden="true"></i>Proveedores</a>
						</li>
						<li class="<?= $subseccion == 'paneles' ? 'active' : ''?>">
							<a href="<?=base_url()?>prueba"><i class="fa fa-money" aria-hidden="true"></i>Ingresos</a>
						</li>
						<li class="<?= $subseccion == 'paneles' ? 'active' : ''?>">
							<a href="<?=base_url()?>prueba"><i class="fa fa-money" aria-hidden="true"></i>Ingresos a 30 días</a>
						</li>
						<li class="<?= $subseccion == 'paneles' ? 'active' : ''?>">
							<a href="<?=base_url()?>prueba"><i class="fa fa-usd" aria-hidden="true"></i>Gastos</a>
						</li>
						<li class="<?= $subseccion == 'paneles' ? 'active' : ''?>">
							<a href="<?=base_url()?>prueba"><i class="fa fa-check-square" aria-hidden="true"></i>Autorizaciones</a>
						</li>
					</ul>
				</li>
				<?php if($this->session->usuario['link_solicitud'] == 1){ ?>
				<li class="<?= $seccion == 'configuracion_general' ? 'active' : ''?>">
					<a href="<?=base_url()?>solicitudes"><i class="fa fa-address-book" aria-hidden="true"></i>Solicitudes de pedidos</a>
				</li>
				<?php } ?>
				<?php if($this->session->usuario['link_configuracion'] == 1){ ?>
				<li class="<?= $seccion == 'configuracion_general' ? 'active' : ''?>">
					<a href="<?=base_url()?>configuracion"><i class="fa fa-cog"></i>Configuración general</a>
				</li>
				<?php } ?>
		</ul>
	</div>
</nav>
