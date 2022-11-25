<?php
class Pedidos_clientes extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('PedidosClientesModel');
		$this->data['datos_pagina']['seccion'] = "";
		$this->data['datos_pagina']['subseccion'] = "";
	}

	public function index(){
		$this->data['datos_pagina']['titulo_pagina'] = "Pedidos clientes";
			$this->load->view('pedidos/pedidos_cliente', $this->data);
	}

	public function ver_pedidos(){
		$produitParam = ["sortfield" => "rowid","limit"=>"-1"];
		$listOrderResult = $this->callAPI("GET", $this->apiKey, $this->apiUrl."orders",$produitParam);
		$listOrderResult = json_decode($listOrderResult, true);
		$this->output->set_content_type( "application/json" );
		$this->output->set_output(json_encode($listOrderResult));
	}
}
