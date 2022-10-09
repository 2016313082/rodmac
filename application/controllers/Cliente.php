<?php
	class Cliente extends MY_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('ClienteModel');
			$this->data['datos_pagina']['seccion'] = "";
			$this->data['datos_pagina']['subseccion'] = "";
		}
        
        public function index(){
			$this->data['datos_pagina']['titulo_pagina'] = "Cliente";
			$this->load->view('cliente/cliente_view', $this->data);
		}

		public function tienda(){
			$this->data['datos_pagina']['titulo_pagina'] = "Cliente";
			$this->load->view('tienda/tienda_view', $this->data);
		}
	}
?>
