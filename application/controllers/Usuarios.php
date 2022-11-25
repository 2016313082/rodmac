<?php 
	class Usuarios extends MY_Controller {
		private $data = array();
		public function __construct(){
			parent::__construct();
			$this->checar_acceso_privilegiado();
			$this->load->model('UsuariosModel');
			$this->data['datos_pagina']['seccion'] = "gestion_general";
			$this->data['datos_pagina']['subseccion'] = "usuarios";
			$this->load->library('upload');
		}
		
		public function index(){
			$this->data['datos_pagina']['titulo_pagina'] = "Usuarios";
			$this->load->view('usuarios/usuarios_view', $this->data);
		}
		
		public function vista_agregar(){
			$this->load->view('usuarios/agregar_usuarios');
		}
		
		public function agregar_usuario(){
			$nombre = $this->input->post('nombre');
			$apellido_paterno = $this->input->post('apellido_paterno');
			$apellido_materno = $this->input->post('apellido_materno');
			$usuario = $this->input->post('usuario');
			$correo = $this->input->post('correo');
			$contrasenia = $this->input->post('contrasenia');
			$telefono = $this->input->post('telefono');
			$nivel = $this->input->post('nivel');
			$obj = $this->UsuariosModel->agregar_usuario($nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $contrasenia, $telefono, $nivel);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}
		
		public function editar_usuario(){
			$id_usuario = $this->input->post('id_usuario');
			$nombre = $this->input->post('nombre');
			$apellido_paterno = $this->input->post('apellido_paterno');
			$apellido_materno = $this->input->post('apellido_materno');
			$usuario = $this->input->post('usuario');
			$correo = $this->input->post('correo');
			$telefono = $this->input->post('telefono');
			$nivel = $this->input->post('nivel');
			$obj = $this->UsuariosModel->editar_usuario($id_usuario, $nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $telefono, $nivel);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}
		
		public function cargar_usuarios(){
			$obj = $this->UsuariosModel->cargar_usuarios();
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}
		
		public function visualizar_usuario(){
			$id_usuario = $this->input->post('id_usuario');
			$obj = $this->UsuariosModel->visualizar_usuario($id_usuario);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}
		
		public function cargar_usuario(){
			$id_usuario = $this->input->post('id_usuario');
			$obj = $this->UsuariosModel->cargar_usuario($id_usuario);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}
		
		public function eliminar_usuario(){
			$id_usuario = $this->input->post('id_usuario');
			$obj = $this->UsuariosModel->eliminar_usuario($id_usuario);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}
		
		public function cargar_responsables() {
			$obj = $this->UsuariosModel->cargar_responsables();
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function cargar_accesos(){
			$id_usuario = $this->input->post('id_usuario');
			$obj = $this->UsuariosModel->cargar_accesos($id_usuario);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function agregar_acceso(){ 
			$id_usuario = $this->input->post('id_usuario');
			$link = $this->input->post('link');
			$acceso = $this->input->post('acceso');
			$obj = $this->UsuariosModel->agregar_acceso($id_usuario,$acceso,$link);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function departamentos_usuarios(){
			$obj = $this->UsuariosModel->departamentos_usuarios();
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function usuarios_dolibar(){
            $produitParam = ["sortfield" => "rowid","limit"=>"-1"];
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."users");
            $order = json_decode($order,true);
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($order));
		}

		public function agregar_id(){
			$id_usuario = $this->input->post('id_usuario');
			$id_dolibarr = $this->input->post('id_dolibarr');
			$obj = $this->UsuariosModel->agregar_id($id_usuario,$id_dolibarr);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
 		}

		public function cargar_clientes(){
			$obj = $this->UsuariosModel->cargar_clientes();
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function clientes(){
			$this->data['datos_pagina']['titulo_pagina'] = "Clientes";
			$this->load->view('usuarios/clientes_view', $this->data);
		}

		public function agregar_cliente(){
			$nombre = $this->input->post('nombre');
			$apellido_paterno = $this->input->post('apellido_paterno');
			$apellido_materno = $this->input->post('apellido_materno');
			$usuario = $this->input->post('usuario');
			$correo = $this->input->post('correo');
			$contrasenia = $this->input->post('contrasenia');
			$telefono = $this->input->post('telefono');
			$nivel = $this->input->post('nivel');
			$nombre_comercial = $this->input->post('nombre_comercial');
			$razon_social =$this->input->post('razon_social');
			$rfc = $this->input->post('rfc');
			$banco = $this->input->post('banco');
			$num_cuenta = $this->input->post('num_cuenta');
			$nombre_titular = $this->input->post('nombre_titular');
			$cuenta_clabe = $this->input->post('cuenta_clabe');
			$direccion_fiscal = $this->input->post('direccion_fiscal');
			$cfdi = $this->input->post('cfdi');
			$metodo_pago = $this->input->post('metodo_pago');
			$forma_pago = $this->input->post('forma_pago');
			$fecha_pago = $this->input->post('fecha_pago');
			$correo_facturas = $this->input->post('correo_facturas');
			$requisitos_entrega = $this->input->post('requisitos_entrega');
			$usuario = $this->UsuariosModel->agregar_cliente($nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $contrasenia, $telefono, $nivel, $nombre_comercial, $razon_social, $rfc, $banco, $num_cuenta, $nombre_titular, $cuenta_clabe, $direccion_fiscal, $cfdi, $metodo_pago, $forma_pago, $correo_facturas, $requisitos_entrega,$fecha_pago);
			$id_usuario = $usuario['id'];
			mkdir("./img/documentos_".$id_usuario."/", 0755);
			if(!empty($_FILES["acta_constitutiva"]["type"])){
				$extension = pathinfo($_FILES['acta_constitutiva']['name']);
				$info = $extension['extension'];
				$nombre_bd = 'acta_constitutiva_'.$id_usuario.'.'.$info;
				$nombre_serv = 'acta_constitutiva_'.$id_usuario;
				//$obj = $this->ClienteModel->subir_excel($nombre_bd,$nombre_bd);
				//aqui va la line de registro a la base de datos
				$config['upload_path'] = './img/documentos_'.$id_usuario.'/';
				$config['file_name'] = $nombre_serv;
				$config['allowed_types'] = 'pdf';
				// $config['max_size'] = 5000;
				// $config['max_width'] = 2000;
				// $config['max_height'] = 2000;
				$this->upload->initialize($config); 
				if(!$this->upload->do_upload('acta_constitutiva')) {  
					echo $this->upload->display_errors(); 
					$obj = false; 
				}else{
					$obj = true;
				}
			}

			if(!empty($_FILES["cif"]["type"])){
				$extension = pathinfo($_FILES['cif']['name']);
				$info = $extension['extension'];
				$nombre_bd = 'cif_'.$id_usuario.'.'.$info;
				$nombre_serv = 'cif_'.$id_usuario;
				//$obj = $this->ClienteModel->subir_excel($nombre_bd,$nombre_bd);
				//aqui va la line de registro a la base de datos
				$config['upload_path'] = './img/documentos_'.$id_usuario.'/';
				$config['file_name'] = $nombre_serv;
				$config['allowed_types'] = 'pdf';
				// $config['max_size'] = 5000;
				// $config['max_width'] = 2000;
				// $config['max_height'] = 2000;
				$this->upload->initialize($config); 
				if(!$this->upload->do_upload('cif')) {  
					echo $this->upload->display_errors(); 
					$obj = false; 
				}else{
					$obj = true;
				}
			}

			if(!empty($_FILES["comprobante_dom"]["type"])){
				$extension = pathinfo($_FILES['comprobante_dom']['name']);
				$info = $extension['extension'];
				$nombre_bd = 'comprobante_dom_'.$id_usuario.'.'.$info;
				$nombre_serv = 'comprobante_dom_'.$id_usuario;
				//$obj = $this->ClienteModel->subir_excel($nombre_bd,$nombre_bd);
				//aqui va la line de registro a la base de datos
				$config['upload_path'] = './img/documentos_'.$id_usuario.'/';
				$config['file_name'] = $nombre_serv;
				$config['allowed_types'] = 'pdf';
				// $config['max_size'] = 5000;
				// $config['max_width'] = 2000;
				// $config['max_height'] = 2000;
				$this->upload->initialize($config); 
				if(!$this->upload->do_upload('comprobante_dom')) {  
					echo $this->upload->display_errors(); 
					$obj = false; 
				}else{
					$obj = true;
				}
			}

			if(!empty($_FILES["constancia_fiscal"]["type"])){
				$extension = pathinfo($_FILES['constancia_fiscal']['name']);
				$info = $extension['extension'];
				$nombre_bd = 'constancia_fiscal_'.$id_usuario.'.'.$info;
				$nombre_serv = 'constancia_fiscal_'.$id_usuario;
				//$obj = $this->ClienteModel->subir_excel($nombre_bd,$nombre_bd);
				//aqui va la line de registro a la base de datos
				$config['upload_path'] = './img/documentos_'.$id_usuario.'/';
				$config['file_name'] = $nombre_serv;
				$config['allowed_types'] = 'pdf';
				// $config['max_size'] = 5000;
				// $config['max_width'] = 2000;
				// $config['max_height'] = 2000;
				$this->upload->initialize($config); 
				if(!$this->upload->do_upload('constancia_fiscal')) {  
					echo $this->upload->display_errors(); 
					$obj = false; 
				}else{
					$obj = true;
				}

				if(!empty($_FILES["copia_ine"]["type"])){
					$extension = pathinfo($_FILES['copia_ine']['name']);
					$info = $extension['extension'];
					$nombre_bd = 'copia_ine_'.$id_usuario.'.'.$info;
					$nombre_serv = 'copia_ine_'.$id_usuario;
					//$obj = $this->ClienteModel->subir_excel($nombre_bd,$nombre_bd);
					//aqui va la line de registro a la base de datos
					$config['upload_path'] = './img/documentos_'.$id_usuario.'/';
					$config['file_name'] = $nombre_serv;
					$config['allowed_types'] = 'pdf';
					// $config['max_size'] = 5000;
					// $config['max_width'] = 2000;
					// $config['max_height'] = 2000;
					$this->upload->initialize($config); 
					if(!$this->upload->do_upload('copia_ine')) {  
						echo $this->upload->display_errors(); 
						$obj = false; 
					}else{
						$obj = true;
					}
				}
			}
			//$obj = $this->UsuariosModel->agregar_cliente();
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($usuario));
		}

		public function clientes_dolibar(){
            $produitParam = ["sortfield" => "rowid","limit"=>"-1","mode"=>"1"];
			$order = $this->callAPI("GET", $this->apiKey, $this->apiUrl."thirdparties",$produitParam);
            $order = json_decode($order,true);
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($order));
		}

		public function cargar_cliente(){
			$id_usuario = $this->input->post('id_usuario');
			$obj = $this->UsuariosModel->cargar_cliente($id_usuario);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

		public function editar_cliente(){
			$id_usuario = $this->input->post('id_usuario');
			$nombre = $this->input->post('nombre');
			$apellido_paterno = $this->input->post('apellido_paterno');
			$apellido_materno = $this->input->post('apellido_materno');
			$usuario = $this->input->post('usuario');
			$correo = $this->input->post('correo');
			$telefono = $this->input->post('telefono');
			$nivel = $this->input->post('nivel');
			$nombre_comercial = $this->input->post('nombre_comercial');
			$razon_social =$this->input->post('razon_social');
			$rfc = $this->input->post('rfc');
			$banco = $this->input->post('banco');
			$num_cuenta = $this->input->post('num_cuenta');
			$nombre_titular = $this->input->post('nombre_titular');
			$cuenta_clabe = $this->input->post('cuenta_clabe');
			$direccion_fiscal = $this->input->post('direccion_fiscal');
			$cfdi = $this->input->post('cfdi');
			$metodo_pago = $this->input->post('metodo_pago');
			$forma_pago = $this->input->post('forma_pago');
			$fecha_pago = $this->input->post('fecha_pago');
			$correo_facturas = $this->input->post('correo_facturas');
			$requisitos_entrega = $this->input->post('requisitos_entrega');
			$obj = $this->UsuariosModel->editar_cliente($id_usuario,$nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $telefono, $nivel, $nombre_comercial, $razon_social, $rfc, $banco, $num_cuenta, $nombre_titular, $cuenta_clabe, $direccion_fiscal, $cfdi, $metodo_pago, $forma_pago, $correo_facturas, $requisitos_entrega,$fecha_pago);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}
	}
	//Si  se va a poder modificar la password del usuario, se requiere verificación de contraseña anterior.
