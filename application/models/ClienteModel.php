<?php
	class ClienteModel extends CI_Model{
		public function getClientes($clientes){
			return $clientes;
		}

		public function agregar_solicitud($productos,$horario){
			$obj['productos'] = $productos;
			$total = 0;
			$obj['horario'] = $horario;
			$this->db->query('INSERT INTO solicitud (id_usuario,fecha,hora) VALUES ('.$this->session->userdata['usuario']['id_usuario'].', "'.$horario[0]['fecha'].'","'.$horario[0]['hora'].'")');
			$id_solicitud = $this->db->insert_id();
			foreach($productos as $producto){
				$subtotal = $producto['cantidad'] * $producto['precio_venta'];
				$total += $subtotal;
				$this->db->query('INSERT INTO solicitud_productos (nombre,sku,cantidad,subtotal,id_producto,id_solicitud) VALUES ("'.$producto['nombre'].'","'.$producto['sku'].'",'.$producto['cantidad'].', '.$subtotal.', '.$producto['id'].', '.$id_solicitud.')');
			}
			$this->db->query("UPDATE solicitud SET subtotal = ".$total." WHERE id = ".$id_solicitud);
			return $obj;
		}

	}
