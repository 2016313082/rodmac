<?php 
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);
    if(isset($uri_segments[4])){
        $id_usuario = $uri_segments[4];
    }
?>
<script>
    var id_usuario = <?= $id_usuario ?>
</script>
<!doctype html>
<html lang="en">
	<head>
		<!-- HEADER (links de CSS y título) -->
		<?php $this->load->view('include/header', $datos_pagina); ?>
	</head>
    <style>
        body,
        html {
            height: 100%;
        }
        

        /*
 * Off Canvas sidebar at medium breakpoint
 * --------------------------------------------------
 */
        @media screen and (max-width: 992px) {

            .row-offcanvas {
                position: relative;
                -webkit-transition: all 0.25s ease-out;
                -moz-transition: all 0.25s ease-out;
                transition: all 0.25s ease-out;
            }

            .row-offcanvas-left .sidebar-offcanvas {
                left: -33%;
            }

            .row-offcanvas-left.active {
                left: 33%;
                margin-left: -6px;
            }

            .sidebar-offcanvas {
                position: absolute;
                top: 0;
                width: 33%;
                height: 100%;
            }
        }
        /*
 * Off Canvas wider at sm breakpoint
 * --------------------------------------------------
 */
        @media screen and (max-width: 34em) {
            .row-offcanvas-left .sidebar-offcanvas {
                left: -45%;
            }

            .row-offcanvas-left.active {
                left: 45%;
                margin-left: -6px;
            }

            .sidebar-offcanvas {
                width: 45%;
            }
        }

        .card {
            overflow: hidden;
        }

        .card-body .rotate {
            z-index: 8;
            float: right;
            height: 100%;
        }

        .card-body .rotate i {
            color: rgba(20, 20, 20, 0.15);
            position: absolute;
            left: 0;
            left: auto;
            right: -10px;
            bottom: 0;
            display: block;
            -webkit-transform: rotate(-44deg);
            -moz-transform: rotate(-44deg);
            -o-transform: rotate(-44deg);
            -ms-transform: rotate(-44deg);
            transform: rotate(-44deg);
        }
		@media screen and (max-width: 600px) {
			table {
				width:100%;
			}
			thead {
				display: none;
			}
			tr:nth-of-type(2n) {
				background-color: inherit;
			}
			tr td:first-child {
				background: #f0f0f0;
				font-weight:bold;
				font-size:1.3em;
			}
			tbody td {
				display: block;
				text-align:center;
			}
			tbody td:before {
				content: attr(data-th);
				display: block;
				text-align:center;
			}
		}
    </style>
	<body>
        <div class="container">
            <div class="wrapper d-flex align-items-stretch">
                <div id="content" class="main">
                    <!-- BARRA SUPERIOR DE USUARIO -->
                    <?php $this->load->view('include/barra_superior', $datos_pagina);  ?>
                    <div id="contenido" class="container-fluid">
                        <div class="row mt-4">
                                <div class="col">
                                    <h2>Control de usuarios</h2>
                                    <div class="form-row">
                                        <div class="col-12 col-sm-4">
                                            <div class="card border-info mb-3" style="max-width: 25rem;">
                                                <div class="card-header">Información del usuario</div>
                                                <div class="card-body text-info">
                                                    <h5 class="card-title" id="nombre-usuario"></h5>
                                                    <p class="card-text"><b>Correo: </b><span id="correo-usuario"></span></p>
                                                    <p class="card-text"><b>Telefono: </b><span id="telefono-usuario"></span></p>
                                                    <p class="card-text"><b>Fecha registro: </b><span id="fecha-usuario"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-8">
                                            <table class="table table-striped table-bordered table-sm" style="overflow-y: scroll;">
                                                <thead>
                                                    <th><div>Accion</div></th>
                                                    <th><div>Fecha</</th>
                                                </thead>
                                                <tbody id="tabla-acciones"></tbody>
                                            </table>
                                        </div>
                                    </div>
									<h4>Asignación de accesos</h4>
									<div id="switch-acceso" class="form-row border"></div><br>
                                    <h4>Asignación de departamentos</h4>        
                                    <div class="form-row mb-3" id="departamentos"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- SCRIPTS DE JS -->
		<?php $this->load->view('include/scripts');  ?>
		<script src="<?= base_url() ?>static/js/departamentos/departamentos.js"></script>
	</body>
</html>
