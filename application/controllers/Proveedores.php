<?php 
	class Proveedores extends MY_Controller {
		private $data = array();
		public function __construct(){
			parent::__construct();
			$this->checar_acceso_privilegiado();
			$this->load->model('ProveedoresModel');
			$this->data['datos_pagina']['seccion'] = "gestion_general";
			$this->data['datos_pagina']['subseccion'] = "proveedores";
		}
		
		public function index(){
			$this->data['datos_pagina']['titulo_pagina'] = "Proveedores";
			$this->load->view('proveedores/proveedores_view', $this->data);
		}

		public function traer_proveedores(){
			$obj = $this->ProveedoresModel->traer_proveedores();
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}
    }
