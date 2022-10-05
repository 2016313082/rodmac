<?php 
	class Departamentos extends MY_Controller {
		private $data = array();
		public function __construct(){
			parent::__construct();
			$this->checar_acceso_privilegiado();
			$this->load->model('DepartamentosModel');
			$this->data['datos_pagina']['seccion'] = "";
			$this->data['datos_pagina']['subseccion'] = "";
		}

        public function departamentos_view(){
            $this->data['datos_pagina']['titulo_pagina'] = "Departamentos";
			$this->load->view('departamentos/departamentos_view', $this->data);
        }

        public function traer_departamentos(){
			$id_usuario = $this->input->post('id_usuario');
            $obj = $this->DepartamentosModel->traer_departamentos($id_usuario);
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
        }

        public function asignar_departamento(){
			$status = $this->input->post('status');
            $id_departamento = $this->input->post('id_departamento');
            $id_usuario = $this->input->post('id_usuario');
			$id = $this->input->post('id');
            $obj = $this->DepartamentosModel->asignar_departamento($id_departamento,$id_usuario,$status,$id);
            $this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
        }

		public function traer_acciones(){
			$id_usuario = $this->input->post('id_usuario');
			$obj = $this->DepartamentosModel->traer_acciones($id_usuario);
			$this->output->set_content_type( "application/json" );
			$this->output->set_output(json_encode($obj));
		}

    }
