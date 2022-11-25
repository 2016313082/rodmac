<?php
	class Cliente extends MY_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('ClienteModel');
			$this->data['datos_pagina']['seccion'] = "";
			$this->data['datos_pagina']['subseccion'] = "";
			$this->load->library('PHPExcel');
        	$this->load->library('excel');
			$this->load->library('upload'); 
		}
        
        public function index(){
			$this->data['datos_pagina']['titulo_pagina'] = "Cliente";
			$this->load->view('cliente/cliente_view', $this->data);
		}

		public function tienda(){
			$this->data['datos_pagina']['titulo_pagina'] = "Cliente";
			$this->load->view('tienda/tienda_view', $this->data);
		}

		public function cliente_excel(){
			$this->data['datos_pagina']['titulo_pagina'] = "Cliente";
			$this->load->view('cliente/cliente_excel', $this->data);
		}

		public function subir_excel(){	
			$id_usuario = $this->session->usuario['id_usuario'];
			if(!empty($_FILES["excel"]["type"])){
				$extension = pathinfo($_FILES['excel']['name']);
				$info = $extension['extension'];
				$nombre_bd = $id_usuario.'.'.$info;
				$nombre_serv = $id_usuario;
				//$obj = $this->ClienteModel->subir_excel($nombre_bd,$nombre_bd);
				//aqui va la line de registro a la base de datos
				$config['upload_path'] = './img/excel/';
				$config['file_name'] = $nombre_serv;
				$config['allowed_types'] = 'xlsx';
				// $config['max_size'] = 5000;
				// $config['max_width'] = 2000;
				// $config['max_height'] = 2000;
				$this->upload->initialize($config); 
				if(!$this->upload->do_upload('excel')) {  
					echo $this->upload->display_errors(); 
					$obj = false; 
				}else{
					$obj = true;
				}
			}
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function eliminar_excel(){
			$url = $this->input->post('url');
			//$obj = unlink($url);
			if(unlink($url)) {
				$obj = true;
			}else{
				$obj = false;
			}
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function traer_productos(){
			$productos = [];
			$arreglo = [];
			$produitParam = ["sortfield" => "rowid","limit"=>"-1","sqlfilters" => "ref like '%FR%' OR ref like '%VE%'"];
			$listProduitsResult = $this->callAPI("GET", $this->apiKey, $this->apiUrl."products", $produitParam);
        	$listProduitsResult = json_decode($listProduitsResult, true);
			foreach($listProduitsResult as $producto){
				$arreglo = array(	
					'id' => $producto['id'],
					'sku' => $producto['ref'],
					'nombre' => $producto['label'],
					'precio_venta' => $producto['price']
				);
				array_push($productos,$arreglo);
			}
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($productos));
		}

		function export(){
			$object = new PHPExcel();
			$object->setActiveSheetIndex(0);
			$table_columns = array(
				"id",
				"sku",
				"nombre",
				"precio_venta",
				"cantidad"
			);
			$column = 0;
			foreach ($table_columns as $field) {
				$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
				$column ++;
			}
			$productos = [];
			$arreglo = [];
			$produitParam = ["sortfield" => "rowid","limit"=>"-1","sqlfilters" => "ref like '%FR%' OR ref like '%VE%'"];
			$listProduitsResult = $this->callAPI("GET", $this->apiKey, $this->apiUrl."products", $produitParam);
        	$listProduitsResult = json_decode($listProduitsResult, true);
			foreach($listProduitsResult as $producto){
				$arreglo = array(	
					'id' => $producto['id'],
					'sku' => $producto['ref'],
					'nombre' => $producto['label'],
					'precio_venta' => $producto['price']
				);
				array_push($productos,$arreglo);
			}
		
			$excel_row = 2;
	
			foreach ($listProduitsResult as $row) {
				$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row['id']);
				$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row['ref']);
				$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row['label']);
				$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row['price']);
				$excel_row ++;
			}
	
			$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="plantilla_rodmac.xlsx"');
			header('Cache-Control: max-age=0');
			$objWriter->save('php://output');
		}

		public function agregar_solicitud(){
			$productos = $this->input->post('productos');
			$horario = $this->input->post('horario');
			$productos = json_decode($productos,true);
			$horario = json_decode($horario, true);
			$obj = $this->ClienteModel->agregar_solicitud($productos,$horario);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}
	}

