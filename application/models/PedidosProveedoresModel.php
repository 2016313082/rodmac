<?php
	class PedidosProveedoresModel extends CI_Model{
		public function capturar_cantidades($cantidades, $id_pedido){
			$query = $this->db->query("SELECT count(*) as num_row FROM productos_cantidades where id_pedido = ?",$id_pedido);
			$rs = $query->row();
			if($rs->num_row > 0){
				foreach($cantidades as $cantidad){
					//aqui es donde se agrega el precio de compra 
					$qry = $this->db->query("SELECT * FROM productos_cantidades WHERE id_pedido = ? AND id_producto = ?",array($id_pedido,$cantidad['id_producto']));
					$rsq = $qry->row();
					$merma = intval($cantidad['qty']) - intval($cantidad['qty_entregada']);
					$query = $this->db->query("UPDATE productos_cantidades SET  id_producto = ?, cantidad_esperada = ? ,cantidad_entregada = ? ,merma = ?, nombre_producto = ?, precio_compra = ? where id = ?", array($cantidad['id_producto'],$cantidad['qty'],$cantidad['qty_entregada'],$merma,$cantidad['nombre'],$cantidad['precio_compra'],$rsq->id));
				}
				$this->db->query("INSERT INTO acciones (id_usuario,accion,fecha_accion) values (".$this->session->userdata['usuario']['id_usuario'].",'".$this->session->userdata['usuario']['nombre']." Agrego cantidades al pedido".$id_pedido."',now())");
			}else{
				foreach($cantidades as $cantidad){
					$merma = intval($cantidad['qty']) - intval($cantidad['qty_entregada']);
					$query = $this->db->query("INSERT INTO productos_cantidades (id_pedido,id_producto,cantidad_esperada,cantidad_entregada,merma,nombre_producto,precio_compra) VALUES (?,?,?,?,?,?,?)", array($id_pedido,floatval($cantidad['id_producto']),$cantidad['qty'],$cantidad['qty_entregada'],$merma,$cantidad['nombre'],$cantidad['precio_compra']));
				}
				$this->db->query("INSERT INTO acciones (id_usuario,accion,fecha_accion) values (".$this->session->userdata['usuario']['id_usuario'].",'".$this->session->userdata['usuario']['nombre']." Agrego cantidades al pedido".$cantidad['nombre']."',now())");
			}
			return true;
		}
		/* 
			Agregar campos a productos_proveedores 
			- nombre de fotografia 
			- nombre de producto
		*/
		public function traer_productos_pedidos($id_pedido){
			$query = $this->db->query("SELECT * FROM productos_cantidades where id_pedido = ?", $id_pedido);
			return $query->result();
		}

		public function traer_datos($id_evidencia){
			$query = $this->db->query('SELECT * FROM productos_cantidades WHERE id = ?',$id_evidencia);
			return $query->row();
		}

		public function registrar_evidencias($comentario,$nombre_bd,$id_evidencia){
			/* 
			status 
			0 = iniciado (se hace al aceptar continuar con el proceso)
			1 = ingreso de cantidades
			2 = ingreso de evidencias
			3 = calificacion a proveedores
			4 = finalizado
			*/
			$query = $this->db->query("UPDATE productos_cantidades SET comentario = ?, fotografia = ? WHERE id = ?",array($comentario, $nombre_bd, $id_evidencia));
			if($this->db->affected_rows() > 0){
				$this->db->query("INSERT INTO acciones (id_usuario,accion,fecha_accion) values (".$this->session->userdata['usuario']['id_usuario'].",'".$this->session->userdata['usuario']['nombre']." ingresó el comentario: ".$comentario."',now())");
				$obj = true;
			}else{
				$obj = false;
			}
			return $obj;
		}

		public function cambiar_status($id_pedido,$status){
			$query = $this->db->query("SELECT count(*) as num_row FROM pedidos_status WHERE id_pedido = ?", $id_pedido);
			$rs = $query->row();
			if($rs->num_row == 0){
				$qry = $this->db->query("INSERT INTO pedidos_status (id_pedido,fecha,id_usuario) VALUES (?,now(),?)",array($id_pedido,$this->session->userdata['usuario']['id_usuario']));
				if($this->db->affected_rows() > 0){
					$obj = true;
				}else{
					$obj = false;
				}
			}else{
				$qry = $this->db->query("UPDATE pedidos_status SET fecha = now(),id_usuario = ?, status = ? WHERE id_pedido = ?",array($this->session->userdata['usuario']['id_usuario'],$status, $id_pedido));
				if($this->db->affected_rows() > 0){
					$obj = true;
				}else{
					$obj = false;
				}
			}
			return $obj;
		}

		public function primer_paso($id_pedido){
			$query = $this->db->query("SELECT count(*) as num_rows FROM pedidos_status WHERE id_pedido = ?", $id_pedido);
			$rs = $query->row();
			if($rs->num_rows == 0){
				$this->db->query("INSERT INTO pedidos_status (id_pedido,status,fecha,id_usuario) values (".$id_pedido.",1,now(),".$this->session->userdata['usuario']['id_usuario'].")");
				if($this->db->affected_rows() > 0){
					$obj = true;
				}else{
					$obj = false;
				}
			}else{
				$obj = false;
				$obj['mensaje'] = 'Este proceso ya fue iniciado';
			}
			return true;
			//return $rs->num_rows;
		}

		public function traer_status(){
			$query['espera'] = $this->db->query("SELECT COUNT(*) as num_rows FROM pedidos_status WHERE status = 3");
			$query['aprobado'] = $this->db->query("SELECT COUNT(*) as num_rows FROM pedidos_status WHERE status = 4");
			$obj['espera'] = $query['espera']->row();
			$obj['aprobado'] = $query['aprobado']->row();
			return $obj;
		}

		public function traer_evidencias($id_pedido){
			$query = $this->db->query("SELECT * FROM productos_cantidades WHERE id_pedido = ?",$id_pedido);
			return $query->result();
		}

		//terminar registro de calificaciones 
		public function registrar_calificacion($id_pedido,$id_pregunta,$id_proveedor,$calificacion){
			if($id_pregunta == 4){
				$qry = $this->db->query("UPDATE pedidos_status SET fecha = now(),id_usuario = ?, status = 3 WHERE id_pedido = ?",array($this->session->userdata['usuario']['id_usuario'], $id_pedido));
			}
			$query = $this->db->query("INSERT INTO calificaciones_proveedores (id_pedido,id_pregunta,id_proveedor,calificacion,fecha) VALUES (?,?,?,?,now())",array($id_pedido,$id_pregunta,$id_proveedor,$calificacion));
			if($this->db->affected_rows() > 0){
				$obj = true;
			}else{
				$obj = false;
			}
			return $obj;
		}
	}
