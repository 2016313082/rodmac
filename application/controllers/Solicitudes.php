<?php

class Solicitudes extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->checar_acceso_privilegiado();
		$this->load->model('SolicitudesModel');
		$this->data['datos_pagina']['seccion'] = "";
		$this->data['datos_pagina']['subseccion'] = "Solicitudes";
	}

	public function index()
	{
		$this->data['datos_pagina']['titulo_pagina'] = "Solicitudes";
		$this->load->view('solicitudes/solicitudes_view', $this->data);
	}

	public function traer_solicitudes()
	{
		$status = $this->input->post('status');
		$obj = $this->SolicitudesModel->traer_solicitudes($status);
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($obj));
	}

	public function traer_productos()
	{
		$id = $this->input->post('id');
		$obj = $this->SolicitudesModel->traer_productos($id);
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($obj));
	}

	public function enviar_pedido()
	{
		$arreglo = [];
		$arreglo2 = [];
		$id = $this->input->post('id');
		$id_usuario = $this->input->post('id_usuario');
		$productos = $this->SolicitudesModel->traer_productos($id);
		$solicitud = $this->SolicitudesModel->traer_solicitud($id);
		$usuario = $this->SolicitudesModel->traer_usuario($id_usuario);
		$dt = DateTime::createFromFormat("Y-n-d H:i:s T", $solicitud->fecha . ' ' . $solicitud->hora . ' CET');
		$ts = $dt->getTimestamp();
		foreach ($productos as $producto) {
			$arreglo2 = array(
				'fk_product' => $producto->id_producto,
				'qty' => $producto->cantidad,
				'subprice' => $producto->subtotal,
			);
			array_push($arreglo, $arreglo2);
		}
		$arreglo3 = array(
			"socid" => $usuario->id_dolibarr,
			"date" => $ts,
			"type" => 0,
			"lines" => $arreglo
		);
		//hacer baja sobre el invetario virtual 
		$insertar_stock = $this->callAPI("POST", $this->apiKey, $this->apiUrl . "orders", json_encode($arreglo3));
		$insertar_stock = json_decode($insertar_stock, true);
		if (!empty($insertar_stock)) {
			$obj = $insertar_stock;
			$this->SolicitudesModel->editar_status($id);
		} else {
			$obj = false;
		}
		$this->output->set_content_type("application/json");
		$this->output->set_output(json_encode($obj));
	}

	public function email(){
		$this->load->library('email');
		$this->email->from('2016313082@uteq.edu.mx', 'Sistema RODMAC');
		$this->email->to('gustavo@getnada.com');
		$this->email->subject('Prueba de mail');
		$this->email->message('Hola, como estas');
		if($this->email->send()){
			$obj['mail_envio'] = true;
		}
		else{
			$obj['mail_envio'] = false;
		}
	}
}

//Productos que hay que jalar de sku FRU - HYV
//Clasificar clientes por categoria 
//hacer stock virtual en app rodmac 
/* 
	1.- descontar de stock virtual cuando hayan pedidos solicitados y salidas de almacen 
	2.- descontar stock fisico en salidas de almacen 

	pedidos de clientes en panel de admin 
*/
 /* 
 array(
	 "socid" => 287,
	 "date" => strtotime(),
	 "type"=> 0,
	 "lines" => array(
		 ""
	 )
 )
 */
