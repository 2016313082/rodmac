<!doctype html>
<html lang="en">

<head>
    <!-- HEADER (links de CSS y título) -->
    <?php $this->load->view('include/header', $datos_pagina); ?>
    <link rel="stylesheet" href="<?= base_url() ?>/static/css/summernote-bs4.min.css">
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
    </style>
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <!-- MENU LATERAL -->
        <?php $this->load->view('include/menu_lateral', $datos_pagina);  ?>

        <div id="content" class="main">
            <!-- BARRA SUPERIOR DE USUARIO -->
            <?php $this->load->view('include/barra_superior', $datos_pagina);  ?>

            <div id="contenido" class="container-fluid">
                <div class="form-row">
                    <div class="col main pt-5 mt-3">
                        <h1 class="display-4 d-none d-sm-block">
                            Dashboard - Rodmac
    </h1>
                        <div class="row mb-3">
                            <div class="col-xl-3 col-sm-6 py-2">
                                <div class="card bg-success text-white h-100">
                                    <div class="card-body bg-success">
                                        <div class="rotate">
                                            <i class="fa fa-user fa-4x"></i>
                                        </div>
                                        <h6 class="text-uppercase">Users</h6>
                                        <h1 class="display-4">134</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 py-2">
                                <div class="card text-white bg-danger h-100">
                                    <div class="card-body bg-danger">
                                        <div class="rotate">
                                            <i class="fa fa-list fa-4x"></i>
                                        </div>
                                        <h6 class="text-uppercase">Posts</h6>
                                        <h1 class="display-4">87</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 py-2">
                                <div class="card text-white bg-info h-100">
                                    <div class="card-body bg-info">
                                        <div class="rotate">
                                            <i class="fa fa-twitter fa-4x"></i>
                                        </div>
                                        <h6 class="text-uppercase">Tweets</h6>
                                        <h1 class="display-4">125</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 py-2">
                                <div class="card text-white bg-warning h-100">
                                    <div class="card-body">
                                        <div class="rotate">
                                            <i class="fa fa-share fa-4x"></i>
                                        </div>
                                        <h6 class="text-uppercase">Shares</h6>
                                        <h1 class="display-4">36</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-sm-6 py-2 border"><canvas id="bar-chart" width="800" height="450"></canvas></div>
                    <div class="col-12 col-sm-6 py-2 border"><canvas id="line-chart" width="800" height="450"></canvas></div>
                </div>
                <div class="form-row">
                    <div class="col-12 col-sm-4 py-2 border"><canvas id="pie-chart" width="800" height="450"></canvas></div>
                    <div class="col-12 col-sm-4 py-2 border"><canvas id="radar-chart" width="800" height="600"></canvas></canvas></div>
                    <div class="col-12 col-sm-4 py-2 border"><canvas id="doughnut-chart" width="800" height="450"></canvas></canvas></div>
                </div>
            </div>
        </div>
    </div>
    <!-- SCRIPTS DE JS -->
    <?php $this->load->view('include/scripts');  ?>
    <script src="<?= base_url() ?>/static/js/summernote-bs4.min.js"></script>
    <script src="<?= base_url() ?>/static/js/dashboard/dashboard.js"></script>
</body>

</html>