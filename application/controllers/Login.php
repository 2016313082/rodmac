<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Login extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('LoginModel');
			$this->load->library("session");
		}
		
		public function index() {
			if($this->session->userdata('usuario')) {
				redirect('dashboard');
			}
			else {
				$data['datos_pagina']['titulo_pagina'] = "Iniciar sesión";
				$this->load->view('login/login_view');
				
			}
		}	

		public function iniciar_sesion(){
			$usuario = $this->input->post('usuario');
			$contrasenia = $this->input->post('contrasenia');
			$obj = $this->LoginModel->iniciar_sesion($usuario, $contrasenia);
			if($obj['usuario']) {
				if($obj['activo']) {
					if($obj['contrasenia']){
						$_SESSION['usuario'] = $obj['usuario'];
						redirect('dashboard');
						/* $this->session->set_userdata("usuario",$obj['usuario']);
						redirect('dashboard'); */
					}
					else {
						$this->session->set_flashdata('nombre_usuario', $usuario);
						$this->session->set_flashdata('mensaje_error', 'La contraseña introducida es incorrecta.');
						redirect('login');
					}
				}
				else {
					$this->session->set_flashdata('nombre_usuario', $usuario);
					$this->session->set_flashdata('mensaje_error', 'El usuario se encuentra inactivo, contacta con RODMAC si crees que es un error.');
					redirect('login');
				}
			}
			else {
				$this->session->set_flashdata('nombre_usuario', $usuario);
				$this->session->set_flashdata('mensaje_error', 'El usuario no existe, verifica tu información.');
				redirect('login');
			}
			/* $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj)); */
		}
		
		public function vista_mail(){
			$this->load->view('plantillas/mail_view');
		}
		
		public function cambiar_pass(){
			$password = $this->input->post('password');
			$id_usuario = $this->input->post('id_usuario');
			$obj = $this->LoginModel->cambiar_pass($password,$id_usuario);
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($obj));
		}	
	}
	