<?php
class SolicitudesModel extends CI_Model{
	public function traer_solicitudes($status){
		$query = $this->db->query("SELECT id, fecha, hora, subtotal, descuento, nombre, apellido_paterno, apellido_materno, usuarios.id_usuario FROM solicitud INNER JOIN usuarios ON usuarios.id_usuario = solicitud.id_usuario WHERE status = ?", $status);
		return $query->result();
	}

	public function traer_productos($id){
		$query = $this->db->query("SELECT * FROM solicitud_productos WHERE id_solicitud = ?",$id);
		return $query->result();
	}

	public function traer_usuario($id_usuario){
		$query = $this->db->query("SELECT * FROM usuarios WHERE id_usuario = ?",$id_usuario);
		return $query->row();
	}

	public function traer_solicitud($id){
		$query = $this->db->query("SELECT * FROM solicitud WHERE id = ?",$id);
		return $query->row();
	}

	public function editar_status($id){
		$query = $this->db->query("UPDATE solicitud set status = 1 WHERE id = ?",$id);
		if($this->db->affected_rows() > 0){
			$obj = true;
		}else{
			$obj = false;
		}
		return $obj;
	}
}
