<?php   
    class DepartamentosModel extends CI_Model{
        public function traer_departamentos($id_usuario){
            $query = $this->db->query("SELECT id, departamentos_usuarios.id_departamento, nombre, icono, texto, status FROM departamentos_usuarios INNER JOIN departamentos ON departamentos.id_departamento = departamentos_usuarios.id_departamento WHERE id_usuario =".$id_usuario);
            return $query->result();
        }

        public function asignar_departamento($id_departamento,$id_usuario,$status,$id){
            $query = $this->db->query("UPDATE departamentos_usuarios SET id_departamento = ".$id_departamento.", id_usuario = ".$id_usuario.",status = ".$status." where id = ".$id.";");
            if($this->db->affected_rows() > 0){
				$obj['resultado'] = true;
			} else {
				$obj['resultado'] = false;
			}
			$departamento = $this->db->query("SELECT * FROM departamentos where id_departamento =".$id_departamento);
			$depa = $departamento->row();
			$usuario = $this->db->query("SELECT * FROM usuarios where id_usuario = ".$id_usuario);
			$us = $usuario->row();
            $this->db->query("INSERT INTO acciones (id_usuario,accion,fecha_accion) values (".$this->session->userdata['usuario']['id_usuario'].",'".$this->session->userdata['usuario']['nombre']." asigno al usuario ".$us->nombre." al departamento ".$depa->nombre."',now())");
			return $obj;
        }

		public function traer_acciones($id_usuario){
			$query = $this->db->query("SELECT * FROM acciones where id_usuario = ".$id_usuario." ORDER BY id DESC LIMIT 5");
			return $query->result();
		}
    }
