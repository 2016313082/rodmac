<?php
	class HistorialCotizacionesModel extends CI_Model{
		public function cargar_cotizaciones() {
			$query = $this->db->query("SELECT CONCAT(usuarios.nombre, ' ', usuarios.apellido_paterno, ' ', usuarios.apellido_materno) as nombre_asesor, id_cotizacion, cotizaciones.nombre, cotizaciones.telefono, tipo_interconexion, num_paneles, total, fecha_cotizacion, vigencia, estado_cotizacion, estado_cotizacion FROM cotizaciones INNER JOIN usuarios ON (cotizaciones.id_usuario = usuarios.id_usuario) ORDER BY id_cotizacion DESC");
			if($query->num_rows() >= 0) {
				$obj['resultado'] = true;
				$obj['cotizaciones'] = $query->result();
			}
			else {
				$obj['resultado'] = false;
			}	
			return $obj;
		}
		
		public function cargar_cotizaciones_empleado($id_usuario) {
			$query = $this->db->query("SELECT CONCAT(usuarios.nombre, ' ', usuarios.apellido_paterno, ' ', usuarios.apellido_materno) as nombre_asesor, id_cotizacion, cotizaciones.nombre, cotizaciones.telefono, tipo_interconexion, num_paneles, total, fecha_cotizacion, vigencia, estado_cotizacion, estado_cotizacion FROM cotizaciones INNER JOIN usuarios ON (cotizaciones.id_usuario = usuarios.id_usuario) WHERE cotizaciones.id_usuario = ? ORDER BY id_cotizacion DESC", $id_usuario);
			if($query->num_rows() >= 0) {
				$obj['resultado'] = true;
				$obj['cotizaciones'] = $query->result();
			}
			else {
				$obj['resultado'] = false;
			}	
			return $obj;
		}
		
		public function cargar_cotizacion($id_cotizacion) {
			$query = $this->db->query("SELECT CONCAT(usuarios.nombre, ' ', usuarios.apellido_paterno, ' ', usuarios.apellido_materno) as nombre_asesor, id_cotizacion, cotizaciones.nombre, cotizaciones.telefono, tipo_interconexion, num_paneles, total, fecha_cotizacion, vigencia, estado_cotizacion, estado_cotizacion FROM cotizaciones INNER JOIN usuarios ON (cotizaciones.id_usuario = usuarios.id_usuario) WHERE id_cotizacion = ?", $id_cotizacion);
			if($query->num_rows() > 0) {
				$obj['resultado'] = true;
				$obj['cotizacion'] = $query->row();
			}
			else {
				$obj['resultado'] = false;
			}	
			return $obj;
		}
		
		public function modificar_cotizacion($id_cotizacion, $estado) {
			$query = $this->db->query("UPDATE cotizaciones SET estado_cotizacion = ? WHERE id_cotizacion = ?", array($estado, $id_cotizacion));
			if($this->db->affected_rows() >= 0) {
				$obj['resultado'] = true;
			}
			else {
				$obj['resultado'] = false;
			}	
			return $obj;
		}
		
		public function descargar_cotizacion($id_cotizacion) {
			$query = $this->db->query("SELECT CONCAT(usuarios.nombre, ' ', usuarios.apellido_paterno, ' ', usuarios.apellido_materno) nombre_asesor, usuarios.telefono as telefono_asesor, cotizaciones.* FROM cotizaciones INNER JOIN usuarios ON (cotizaciones.id_usuario = usuarios.id_usuario) WHERE id_cotizacion = ?", $id_cotizacion);
			if($query->num_rows() > 0) {
				$obj['cotizacion'] = $query->row();
				$obj['estado_cotizacion'] = $query->row()->estado_cotizacion;
				$query = $this->db->query("SELECT * FROM cotizaciones_productos WHERE id_cotizacion = ?", $id_cotizacion);
				if($query->num_rows() > 0) {
					$obj['productos'] = $query->result();
		
					$query = $this->db->query("SELECT * FROM cotizaciones_ahorro WHERE id_cotizacion = ?", $id_cotizacion);
					if($query->num_rows() > 0) {
						$obj['ahorro'] = $query->result();
						$query = $this->db->query("SELECT terminos FROM datos_generales");
						$obj['terminos'] = $query->row()->terminos;
						$obj['resultado'] = true;
					}
					else {
						$obj['resultado'] = false;
					}
				}
				else {
					$obj['resultado'] = false;
				}
			}
			else {
				$obj['resultado'] = false;
			}	
			return $obj;
		}
		
		public function eliminar_cotizacion($id_cotizacion){
			$this->db->trans_begin();
			$query = $this->db->query("DELETE FROM cotizaciones_ahorro WHERE id_cotizacion = ?", $id_cotizacion);
			$query = $this->db->query("DELETE FROM cotizaciones_productos WHERE id_cotizacion = ?", $id_cotizacion);
			$query = $this->db->query("DELETE FROM cotizaciones WHERE id_cotizacion = ?", $id_cotizacion);
			
			if ($this->db->trans_status() === FALSE) {
				$obj['resultado'] = false;
				$this->db->trans_rollback();
			}
			else {
				$this->db->trans_commit();
				$obj['resultado'] = true;
			}
			
			return $obj;
		}
		
		public function actualizar_vigencias(){
			$this->db->query("UPDATE cotizaciones SET estado_cotizacion = 'Vencido' WHERE (NOW() > vigencia) AND estado_cotizacion like 'Pendiente'");
		}
	}