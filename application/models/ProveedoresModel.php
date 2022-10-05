<?php
class ProveedoresModel extends CI_Model{
	public function traer_proveedores(){
		$query = $this->db->query("SELECT * FROM proveedores");
		return $query->result();
	}
}
