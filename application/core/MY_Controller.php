<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	protected $datos_sesion;
	
    public function __construct(){
		//$this->apiUrl = "https://erp.metusgroup.com/api/index.php/";//URL para apuntar a ambiente productivo
		$this->apiUrl = "https://betaerp.metusgroup.com/api/index.php/";
		$this->apiKey = 'oTH0Yj820E9TFKk7nwxsm5UySQ4n6Rh2';
		$this->clienteDuki = 233; //Id de cliente DUKI
		$this->almacenDuki = 5; //Id del almacén en donde se harán todas las bajas
		$this->ctatc = 5; //Id de cuenta de banco en donde se realizan los depósitos 
		$this->paiment_id_cc = 6; //Id correspondiente al diccionario de Modo de pago para tarjeta de crédito
		$this->paiment_id_cash = 4; //Id correspondiente al diccionario de Modo de pago para efectivo
		$this->paiment_id_transfer = 2; //Id correspondiente al diccionario de Modo de pago para TEF
        parent::__construct();
		if($this->session->userdata('usuario')) {
			$this->datos_sesion = $this->session->userdata('usuario');
		}
		else {
			redirect('login');
		}
    }
	
	public function checar_acceso_privilegiado($allowed = null) {
		$nivel = $this->datos_sesion['nivel'];
		$link_dashboard = $this->datos_sesion['link_dashboard'];
		$link_usuarios = $this->datos_sesion['link_usuarios'];
		$link_proveedores = $this->datos_sesion['link_proveedores'];
		$link_configuracion = $this->datos_sesion['link_cuentas'];
		$link_ingresos = $this->datos_sesion['link_ingresos'];
		$link_gastos = $this->datos_sesion['link_gastos'];
		if(is_null($allowed)) {
			if($link_dashboard == 1 || $link_usuarios == 1 || $link_proveedores == 1 || $link_configuracion == 1 || $link_ingresos == 1 || $link_gastos == 1) {
				return;
			}
			else{
				show_404();
			}
		}
		else {
			if($nivel != "Administrador" && $nivel != "Propietario") {
				if ( ! in_array($this->router->fetch_method(), $allowed)) {
					show_404();
				}
			}
		}
	}
	
	public function checar_admin() {
		$nivel = $this->datos_sesion['nivel'];
		if($nivel == "Administrador" || $nivel == "Propietario"){
			return true;
		}
		else{
			return false;
		}
	}

	function callAPI($method, $apikey, $url, $data = false){

		$curl = curl_init();
		$httpheader = ['DOLAPIKEY: '.$apikey];
		switch ($method){
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);
				$httpheader[] = "Content-Type:application/json";

				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

				break;
			case "PUT":

			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
				$httpheader[] = "Content-Type:application/json";

				if ($data)
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

				break;
			default:
				if ($data){
					$url = sprintf("%s?%s", $url, http_build_query($data));
				}
		}

		// Optional Authentication:
		//    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		//    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);

		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
		
}
