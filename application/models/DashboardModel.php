<?php
	class DashboardModel extends CI_Model{
		public function getProveedores($proveedores){
			
            //$proveedores = json_decode($proveedores);
           /*  foreach($proveedores as $proveedor){
				$nombre=$proveedor['name'];
				$alias=$proveedor['name_alias'];
				$codigo=$proveedor['code_client'];
				$id = $proveedor['id'];
				$query = $this->db->query('UPDATE proveedores set nombre = ?,alias = ?, codigo = ? where id = ?',array($nombre,$alias,$codigo,$id));
				if($query->affected_rows() > 0){
					$obj = true;
				}else{
					$obj = false;
				}
            } */
			return $proveedores;
		}

		
	}