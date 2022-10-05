<?php 
class Notificaciones extends MY_Controller {
	private $data = array();
	public function __construct(){
		parent::__construct();
		//$this->checar_acceso_privilegiado();
		$this->load->model('NotificacionesModel');
		//$this->load->library('upload'); 
	}

	public function traer_notificaciones(){
		$obj = $this->NotificacionesModel->traer_notificaciones();
		$this->output->set_content_type( "application/json" );
		$this->output->set_output(json_encode($obj));
	}
}
