<?php 
    class Dashboard extends MY_Controller{
        private $data = array();
		
		public function __construct(){
			parent::__construct();
            $this->checar_acceso_privilegiado();
			$this->load->model('DashboardModel');
			$this->data['datos_pagina']['seccion'] = "";
			$this->data['datos_pagina']['subseccion'] = "";
		}
        
        public function index(){
			$this->data['datos_pagina']['titulo_pagina'] = "Dashboard";
			$this->load->view('dashboard/dashboard_view', $this->data);
		}

        public function pruebas(){
			$pedido = array(
				'socid' => 277,
				'date'=>date("Y-m-d"),
				'ref_client'=>'JUSTO',
				'type'=>0,
				'lines'=> [
					['qty'=>1,'fk_product'=>1080]
				],
				'note_private'=>'Pedido a proveedor'
			);
            //$produitParam = ["sortfield" => "rowid","limit"=>"-1","sqlfilters" => "rowid in (select fk_product from metus973_dolibarr.llxtm_product_stock where fk_entrepot = 5)"];
            $produitParam = ["sortfield" => "rowid","limit"=>"-1"];
			// Al insertar, regresa el id del pedido
            //$order = $this->callAPI("POST", $this->apiKey, $this->apiUrl."orders", json_encode($pedido));
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."users");
            $order = json_decode($order,true);
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($order));
        }

        public function datos(){
            $produitParam = ["sortfield" => "rowid","limit"=>"-1","mode" => 4]; //parametros para traer todos los terceros sin limites 
            $proveedores = $this->callAPI("GET", $this->apiKey, $this->apiUrl."thirdparties",$produitParam);
            $proveedores = json_decode($proveedores,true);
            foreach($proveedores as $proveedor){
                $query = $this->db->query('INSERT INTO proveedores (id,nombre,alias,codigo,cliente)VALUES('.$proveedor['id'].',"'.$proveedor['name'].'","'.$proveedor['name_alias'].'","'.$proveedor['code_client'].'",'.$proveedor['client'].') ON DUPLICATE KEY UPDATE nombre = "'.$proveedor['name'].'",alias = "'.$proveedor['name_alias'].'", codigo = "'.$proveedor['code_client'].'",cliente = '.$proveedor['client']);
				if($this->db->affected_rows() > 0){
					$obj = true;
				}else{
					$obj = false;
				}
            }
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
        }

    }
