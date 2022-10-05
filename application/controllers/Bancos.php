<?php 
    class Bancos extends MY_Controller{
        private $data = array();
		
		public function __construct(){
			parent::__construct();
			$this->load->model('CuentaModel');
			$this->data['datos_pagina']['seccion'] = "";
			$this->data['datos_pagina']['subseccion'] = "";
		}
        
        public function index(){
			$this->data['datos_pagina']['titulo_pagina'] = "Banco";
			$this->load->view('banco/banco_view', $this->data);
		}
    }