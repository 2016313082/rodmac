<?php 

/* 
Estatus de productos 
	 0. Inicializado
	 1. Arpobado
	 2. Cancelado 

Estatus de pedido
	0. Inicializado
	1.- Primer paso
	estatus hasta segunda etapa
	5.- inicio de segunda etapa 

*/
	class Pedidos_proveedores extends MY_Controller {
		private $data = array();
		public function __construct(){
			parent::__construct();
			//$this->checar_acceso_privilegiado();
			$this->load->model('PedidosProveedoresModel');
			$this->data['datos_pagina']['seccion'] = "gestion_general";
			$this->data['datos_pagina']['subseccion'] = "pedidos";
			$this->load->library('upload'); 
		}

		public function index(){
			$this->data['datos_pagina']['titulo_pagina'] = "Proveedores";
			$this->load->view('pedidos_proveedores/pedidos_view', $this->data);
		}

		public function aprobar_view(){
			$this->data['datos_pagina']['titulo_pagina'] = "Arobar pedidos";
			$this->load->view('pedidos_proveedores/aprobar_view', $this->data);
		}

		public function traer_pedidos($tipo_pedido = 'running'){
            $status = [];
			$i = 0;
            $produitParam = ["sortfield" => "rowid","sortorder"=>"desc",'status'=>$tipo_pedido];
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."supplierorders", $produitParam);
            $order = json_decode($order,true);
			if(!empty($order)){
				foreach($order as $pedido){
					$query = $this->db->query("SELECT count(*) AS num_rows FROM pedidos_status WHERE id_pedido = ?",$pedido['id']);
					$rs = $query->row();
					if($rs->num_rows > 0){
						$query = $this->db->query("SELECT * FROM pedidos_status WHERE id_pedido = ?",$pedido['id']);
						$rsqry = $query->row();
						$status = array(
							'status_pedido'=>$rsqry->status,
						);
						array_push($order[$i],$status);
					}else{
						$status = array(
							'status_pedido'=>'',
						);
						array_push($order[$i],$status);
					}
					$i++;
				}
			}
            $this->output->set_content_type("application/json");
			$this->output->set_output(json_encode($order));
		}

		public function traer_pedidos_inicio($tipo_pedido = 'received_start'){
            $status = [];
			$i = 0;
            $produitParam = ["sortfield" => "rowid","sortorder"=>"desc",'status'=>$tipo_pedido];
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."supplierorders", $produitParam);
            $order = json_decode($order,true);
			if(!empty($order)){
				foreach($order as $pedido){
					$query = $this->db->query("SELECT count(*) AS num_rows FROM pedidos_status WHERE id_pedido = ?",$pedido['id']);
					$rs = $query->row();
					if($rs->num_rows > 0){
						$query = $this->db->query("SELECT * FROM pedidos_status WHERE id_pedido = ?",$pedido['id']);
						$rsqry = $query->row();
						$status = array(
							'status_pedido'=>$rsqry->status,
						);
						array_push($order[$i],$status);
					}else{
						$status = array(
							'status_pedido'=>'',
						);
						array_push($order[$i],$status);
					}
					$i++;
				}
			}
            $this->output->set_content_type("application/json");
			$this->output->set_output(json_encode($order));
		}

		public function traer_pedidos_pruebas($tipo_pedido = 'running'){
			$status = [];
			$i = 0;
            $produitParam = ["sortfield" => "rowid","sortorder"=>"desc",'status'=>$tipo_pedido];
			//$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."products");
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."products");
            //$order = json_decode($order,true); 
			/* foreach($order as $pedido){
				$query = $this->db->query("SELECT count(*) AS num_rows FROM pedidos_status WHERE id_pedido = ?",$pedido['id']);
				$rs = $query->row();
				if($rs->num_rows > 0){
					$query = $this->db->query("SELECT * FROM pedidos_status WHERE id_pedido = ?",$pedido['id']);
					$rsqry = $query->row();
					$status = array(
						'status_pedido'=>$rsqry->status,
					);
					array_push($order[$i],$status);
				}
				$i++;
			}  */
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($order));
		}

		public function traer_pedidos_estatus(){
			$tipo_pedido = $this->input->post('tipo_pedido');
            $produitParam = ["sortfield" => "rowid","sortorder"=>"desc",'status'=>$tipo_pedido];
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."supplierorders", $produitParam);
            $order = json_decode($order,true);
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($order));
		}

		public function pedido_pdf(){
			$ref = $this->input->post('ref');
			$modulo = $this->input->post('modulo');
			$produitParam = ["modulepart" => $modulo,'ref'=>$ref];
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."documents", $produitParam);
            $order = json_decode($order,true);
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($order));
		}

		public function traer_productos(){
			$id_pedido = $this->input->post('id_pedido');
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."supplierorders/".$id_pedido);
            $order = json_decode($order,true);
			$query = $this->db->query("SELECT * FROM pedidos_status WHERE id_pedido = ?", $id_pedido);
			if($query->num_rows() == 0){
				$this->db->query("INSERT INTO pedidos_status (id_pedido,status,fecha,id_usuario) values (".$id_pedido.",1,now(),".$this->session->userdata['usuario']['id_usuario'].")");
			}
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($order));
		}

		public function capturar_cantidades(){
			$cantidades = $this->input->post('contenido');
			$id_pedido = $this->input->post('id_pedido');
			$obj = $this->PedidosProveedoresModel->capturar_cantidades($cantidades,$id_pedido);
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function traer_productos_pedidos(){
			$id_pedido = $this->input->post('id_pedido');
			$obj = $this->PedidosProveedoresModel->traer_productos_pedidos($id_pedido);
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function registrar_evidencias(){
			$comentario = $this->input->post('comentario');
			$id_evidencia = $this->input->post('id_evidencia');
			if(!empty($_FILES["camera"]["type"])){
				$extension = pathinfo($_FILES['camera']['name']);
				$info = $extension['extension'];
				$nombre_bd = 'evidencia_'.$id_evidencia.'.'.$info;
				$nombre_serv = 'evidencia_'.$id_evidencia;
				$obj = $this->PedidosProveedoresModel->registrar_evidencias($comentario,$nombre_bd,$id_evidencia);
				//aqui va la line de registro a la base de datos
				$config['upload_path'] = './img/evidencias/';
				$config['file_name'] = $nombre_serv;
				$config['allowed_types'] = 'jpg|jpeg|gif|png';
				// $config['max_size'] = 5000;
				// $config['max_width'] = 2000;
				// $config['max_height'] = 2000;
				$this->upload->initialize($config); 
				if(!$this->upload->do_upload('camera')) {  
					echo $this->upload->display_errors();  
				} 
			}
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function editar_evidencias(){
            $this->data['datos_pagina']['titulo_pagina'] = "Evidencias";
			$this->load->view('pedidos_proveedores/editar_evidencias', $this->data);
        }

		public function traer_datos(){
			$id_evidencia = $this->input->post('id_evidencia');
			$query = $this->PedidosProveedoresModel->traer_datos($id_evidencia);

			$obj['pedido'] = $this->callAPI("GET", $this->apiKey, $this->apiUrl."supplierorders/".$query->id_pedido);
			$obj['pedido'] = json_decode($obj['pedido'],true);
			$obj['evidencias'] = $query;
			$obj['proveedor'] = $this->callAPI("GET", $this->apiKey, $this->apiUrl."thirdparties/".$obj['pedido']['socid']);
			$obj['proveedor'] = json_decode($obj['proveedor'],true);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function cambiar_status(){
			//probar si despues se puede extender una funcion para agregar notificaciones globales a my_controller 
			$id_pedido = $this->input->post('id_pedido');
			$status = $this->input->post('status');
			if($status == 3){
				$pedido = $this->callAPI("GET", $this->apiKey, $this->apiUrl."supplierorders/".$id_pedido);
				$pedido = json_decode($pedido,true);
				$this->db->query("INSERT INTO notificaciones (texto,fecha,id_departamento) VALUE ('El usuario ".$this->session->usuario['nombre']." ".$this->session->usuario['apellido_paterno']." se encuentra en espera de aprobación del pedido ".$pedido['ref']."',now(),3)");
			}
			$obj = $this->PedidosProveedoresModel->cambiar_status($id_pedido,$status);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function primer_paso(){
			$id_pedido = $this->input->post('id_pedido');
			$obj = $this->PedidosProveedoresModel->primer_paso($id_pedido);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function traer_status(){
			$id_pedido = $this->input->post('id_pedido');
			$obj = $this->PedidosProveedoresModel->traer_status($id_pedido);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function traer_evidencias(){
			$id_pedido = $this->input->post('id_pedido');
			$obj = $this->PedidosProveedoresModel->traer_evidencias($id_pedido);
			$obj['total_productos'] = $this->PedidosProveedoresModel->contar_productos($id_pedido);
			$produitParam = ["sortfield" => "rowid","sortorder"=>"asc","limit"=>-1];
			$obj['almacenes'] = $this->callAPI("GET", $this->apiKey, $this->apiUrl."warehouses", $produitParam);
            $obj['almacenes'] = json_decode($obj['almacenes'],true);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function registrar_calificacion(){
			$id_pedido = $this->input->post('id_pedido');
			$id_pregunta = $this->input->post('id_pregunta');
			$id_proveedor = $this->input->post('id_proveedor');
			$calificacion = $this->input->post('calificacion'); 
			$obj = $this->PedidosProveedoresModel->registrar_calificacion($id_pedido,$id_pregunta,$id_proveedor,$calificacion);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function agregar_cantidades(){ 
			$productos = [];
			$stock_mov = [];
			$produitParam = [];
			$id_pedido = $this->input->post('id_pedido');
			$almacen = $this->input->post('almacen');
			$obj['pedido'] = $this->callAPI("GET", $this->apiKey, $this->apiUrl."supplierorders/".$id_pedido);
			$obj['pedido'] = json_decode($obj['pedido'],true);
			$obj['proveedor'] = $this->callAPI("GET", $this->apiKey, $this->apiUrl."thirdparties/".$obj['pedido']['socid']);
			$obj['proveedor'] = json_decode($obj['proveedor'],true);
			$id_proveedor = $obj['pedido']['socid'];
			$ref_proveedor = $obj['proveedor']['name_alias'];
			foreach($obj['pedido']['lines'] AS $producto){
				$query = $this->db->query("SELECT * FROM productos_cantidades WHERE id_producto = ? AND id_pedido = ?",array($producto['fk_product'],$id_pedido));
				$result = $query->row();
				$cantidad_entregada = $result->cantidad_entregada;
				$stock_mov = array(
					"product_id"        => $producto['fk_product'],
					"warehouse_id"      => $almacen,
					"qty"               => $cantidad_entregada,
					"dlc"               => date("Y-m-d"),
					"dluo"              => date("Y-m-d")
				);
				$produitParam = array(
					"qty" 				=> 	"1",
					"buyprice"			=>	$result->precio_compra,
					'price_base_type'	=>	'HT',
					'fourn_id'			=>	$id_proveedor,
					'availability'		=>	"0",
					"ref_fourn" 		=> 	$ref_proveedor,
					"tva_tx" 			=> 	"0"
				);
				$insertar_stock = $this->callAPI("POST", $this->apiKey, $this->apiUrl."stockmovements", json_encode($stock_mov));
				$insertar_stock = json_decode($insertar_stock,true);
				$insertar_precio = $this->callAPI("PUT", $this->apiKey, $this->apiUrl."products/".$producto['fk_product'],json_encode($produitParam));
				$insertar_precio = json_decode($insertar_precio,true);
				array_push($productos,$insertar_precio);
			}
			$respuesta = $this->PedidosProveedoresModel->cambiar_status($id_pedido,4);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($respuesta));
		}
		//supplierorders/receive puede servir para recibir todos los productos de golpe en el api
		public function finalizar_pedido(){
			$id_pedido = $this->input->post('id_pedido');
			$cambiar_status = array(
				"statut" => 4
			);
			$obj = $this->callAPI("PUT", $this->apiKey, $this->apiUrl."supplierorders/".$id_pedido,json_encode($cambiar_status));
			$obj = json_decode($obj,true);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function traer_almacenes(){
			$produitParam = ["sortfield" => "rowid","sortorder"=>"asc","limit"=>-1];
			$obj = $this->callAPI("GET", $this->apiKey, $this->apiUrl."warehouses", $produitParam);
            $obj = json_decode($obj,true);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function estatus_producto(){
			$comentario = $this->input->post('comentario');
			$id = $this->input->post('id');
			$estatus = $this->input->post('estatus');
			$obj = $this->PedidosProveedoresModel->estatus_producto($estatus,$id,$comentario); 
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function inicio_recibido(){
			$this->data['datos_pagina']['titulo_pagina'] = "Inicio recibido";
			$this->load->view('pedidos_proveedores/inicio_aprobado', $this->data);
		}

		public function segunda_etapa(){
			$id_pedido = $this->input->post('id_pedido');
			$obj = $this->PedidosProveedoresModel->segunda_etapa($id_pedido);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function registro_segunda_etapa(){
			$this->data['datos_pagina']['titulo_pagina'] = "Evidencias";
			$this->load->view('pedidos_proveedores/registro_segunda_etapa', $this->data);
		}

		public function traer_productos_segunda(){
			$i = 0;
			$id_pedido = $this->input->post('id_pedido');
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."supplierorders/".$id_pedido);
            $order = json_decode($order,true);
			$qry = $this->db->query("SELECT * FROM productos_cantidades WHERE id_pedido = ".$id_pedido);
			foreach($qry->result() as $evidencia){
				array_push($order['lines'][$i],$evidencia);
				$i++;
			}
			//array_push($order['lines'],$qry->result());
			$query = $this->db->query("SELECT * FROM pedidos_status WHERE id_pedido = ?", $id_pedido);
			if($query->num_rows() == 0){
				$this->db->query("INSERT INTO pedidos_status (id_pedido,status,fecha,id_usuario) values (".$id_pedido.",1,now(),".$this->session->userdata['usuario']['id_usuario'].")");
			}
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($order));
		}

		public function terminar_segunda(){
			$textura = $this->input->post('textura');
			$color = $this->input->post('color');
			$tamanio = $this->input->post('tamanio');
			$tiempo_maduracion = $this->input->post('tiempo_maduracion');
			$cuidado = $this->input->post('cuidado');
			$etapa_madurez = $this->input->post('etapa_madurez');
			$calibre = $this->input->post('calibre');
			$motivo_rechazo = $this->input->post('motivo_rechazo');
			$empaque = $this->input->post('empaque');
			$cantidad_rechazada = $this->input->post('cantidad_rechazada');
			$id_evidencia = $this->input->post('id_evidencia');
			$almacen = $this->input->post('almacen');
			$query = $this->db->query("SELECT * FROM productos_cantidades WHERE id = ".$id_evidencia);
			$evidencia = $query->row();
			$obj = $this->PedidosProveedoresModel->terminar_segunda($textura,$color,$tamanio,$tiempo_maduracion,$cuidado,$etapa_madurez,$calibre,$motivo_rechazo,$empaque,$id_evidencia,$evidencia->id_producto);
			$id_pedido = $evidencia->id_pedido;
			$total = $evidencia->cantidad_entregada - $cantidad_rechazada;
			$stock_mov = array(
				"product_id"        => $evidencia->id_producto,
				"warehouse_id"      => $almacen,
				"qty"               => $total,
				"dlc"               => date("Y-m-d"),
				"dluo"              => date("Y-m-d")
			);
			$obj['pedido'] = $this->callAPI("GET", $this->apiKey, $this->apiUrl."supplierorders/".$id_pedido);
			$obj['pedido'] = json_decode($obj['pedido'],true);
			$obj['proveedor'] = $this->callAPI("GET", $this->apiKey, $this->apiUrl."thirdparties/".$obj['pedido']['socid']);
			$obj['proveedor'] = json_decode($obj['proveedor'],true);
			$id_proveedor = $obj['pedido']['socid'];
			$ref_proveedor = $obj['proveedor']['name']. ' ' .$obj['proveedor']['name_alias'];
			$produitParam = array(
				"qty" 				=> 	"1",
				"buyprice"			=>	$evidencia->precio_compra,
				'price_base_type'	=>	'HT',
				'fourn_id'			=>	$id_proveedor,
				'availability'		=>	"0",
				"ref_fourn" 		=> 	$ref_proveedor,
				"tva_tx" 			=> 	"0"
			);
			$insertar_stock = $this->callAPI("POST", $this->apiKey, $this->apiUrl."stockmovements", json_encode($stock_mov));
			$insertar_stock = json_decode($insertar_stock,true);
			$insertar_precio = $this->callAPI("PUT", $this->apiKey, $this->apiUrl."products/".$evidencia->id_producto,json_encode($produitParam));
			$insertar_precio = json_decode($insertar_precio,true);
			if(is_int($insertar_stock)){
				$respuesta = $this->PedidosProveedoresModel->cambiar_status($id_pedido,6);
			}else{
				$respuesta = false;
			}
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($respuesta));
		}

	}

	/* 
	{
 "qty" : "1",
 "buyprice" : "55",
 "price_base_type" : "TTC",
 "fourn_id" : "277",
 "availability" : "0",
 "ref_fourn" : "SAN BENITO DISTRIBUIDORA",
 "tva_tx" : "0"
}
	*/
