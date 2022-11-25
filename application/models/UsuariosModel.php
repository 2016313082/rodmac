<?php
	class UsuariosModel extends CI_Model{
		
		public function agregar_usuario($nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $contrasenia, $telefono, $nivel){
			$query = $this->db->query("INSERT INTO usuarios(nombre, apellido_paterno, apellido_materno, usuario, correo, contrasenia, telefono, nivel) VALUES(?, ?, ?, ?, ?, MD5(?), ?, ?)", array($nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $contrasenia, $telefono, $nivel));
			if($this->db->affected_rows() > 0){
				$id_usuario = $this->db->insert_id();
				$departamentos = $this->db->query("SELECT * FROM departamentos");
				foreach($departamentos->result() as $depa){
					$this->db->query("INSERT INTO departamentos_usuarios (id_usuario,id_departamento) VALUES (".$id_usuario.",".$depa->id_departamento.")");
				}
				$obj['resultado'] = true;
			} else {
				$obj['resultado'] = false;
			}	
			return $obj;
		}
		
		public function cargar_usuarios(){
			$query = $this->db->query("SELECT id_usuario, nombre, apellido_paterno, apellido_materno, usuario, nivel, correo, telefono,id_dolibarr from usuarios WHERE nivel <> 'Cliente'");
			if($query->num_rows() > 0){
				$obj['resultado'] = true;
				$obj['usuarios'] = $query->result();
			}else{
				$obj['resultado'] = false;
				$obj['mensaje'] = "No se encontraron usuarios";
			}	
			return $obj;
		}
		
		public function visualizar_usuario($id_usuario){
			$query = $this->db->query("SELECT id_usuario, CONCAT(nombre,' ',apellido_paterno,' ',apellido_materno) as nombre, usuario, nivel, telefono from usuarios WHERE id_usuario = '$id_usuario'");
			if($query->num_rows() > 0){
				$obj['resultado'] = true;
				$obj['datos_usuario'] = $query->row();
			}else{
				$obj['resultado'] = false;
			}	
			return $obj;
		}
		
		public function cargar_usuario($id_usuario){
			$query = $this->db->query("SELECT id_usuario, nombre, apellido_paterno, apellido_materno, usuario, nivel, correo, telefono, fecha_registro from usuarios WHERE id_usuario = ?", $id_usuario);
			if($query->num_rows() > 0){
				$obj['resultado'] = true;
				$obj['datos_usuario'] = $query->row();
			}else{
				$obj['resultado'] = false;
			}	
			return $obj;
		}
		
		public function editar_usuario($id_usuario, $nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $telefono, $nivel){
			$query = $this->db->query("UPDATE usuarios set nombre = ?, apellido_paterno = ?, apellido_materno = ?, usuario = ?, correo = ?, telefono = ?, nivel = ? WHERE id_usuario = ?", array($nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $telefono, $nivel, $id_usuario));
			if($this->db->affected_rows() > 0){
				$obj['resultado'] = true;
			}else{
				$obj['resultado'] = false;
			}
			return $obj;
		}
		
		public function cargar_responsables() {
			$query = $this->db->query("SELECT id_usuario, CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as responsable from usuarios");
			if($query->num_rows() > 0) {
				$obj['resultado'] = true;
				$obj['responsables'] = $query->result();
			} else {
				$obj['resultado'] = false;
			}	
			return $obj;
		}

		public function cargar_accesos($id_usuario){
			$query = $this->db->query("SELECT link_dashboard,link_usuarios,link_proveedores,link_configuracion,link_cuentas,link_ingresos,link_gastos FROM usuarios where id_usuario = ?",$id_usuario);
			if($query->num_rows() > 0) {
				$obj = $query->result();
			}else{
				$obj = false;
			}	
			return $obj;
		}

		public function agregar_acceso($id_usuario,$acceso,$link){
			$query = $this->db->query("UPDATE usuarios set ".$acceso." = ".$link." WHERE id_usuario = ".$id_usuario);
			if($this->db->affected_rows() > 0) {
				$obj['resultado'] = true;
			} else {
				$obj['resultado'] = false;
			}	
			return $obj;
		}

		public function agregar_id($id_usuario,$id_dolibarr){
			$query = $this->db->query("UPDATE usuarios set id_dolibarr = ? where id_usuario = ?",array($id_dolibarr,$id_usuario));
			if($this->db->affected_rows() > 0) {
				$obj = true;
			} else {
				$obj = false;
			}	
			return $obj;
		}

		public function cargar_clientes(){
			$query = $this->db->query("SELECT id_usuario, nombre, apellido_paterno, apellido_materno, usuario, nivel, correo, telefono,id_dolibarr from usuarios WHERE nivel = 'Cliente'");
			if($query->num_rows() > 0){
				$obj['resultado'] = true;
				$obj['usuarios'] = $query->result();
			}else{
				$obj['resultado'] = false;
				$obj['mensaje'] = "No se encontraron usuarios";
			}	
			return $obj;
		}

		public function agregar_cliente($nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $contrasenia, $telefono, $nivel, $nombre_comercial, $razon_social, $rfc, $banco, $num_cuenta, $nombre_titular, $cuenta_clabe, $direccion_fiscal, $cfdi, $metodo_pago, $forma_pago, $correo_facturas,$requisitos_entrega,$fecha_pago){
			$query = $this->db->query("INSERT INTO usuarios(nombre, apellido_paterno, apellido_materno, usuario, correo, contrasenia, telefono, nivel) VALUES(?, ?, ?, ?, ?, MD5(?), ?, ?)", array($nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $contrasenia, $telefono, $nivel));
			if($this->db->affected_rows() > 0){
				$id_usuario = $this->db->insert_id();
				$departamentos = $this->db->query("SELECT * FROM departamentos");
				foreach($departamentos->result() as $depa){
					$this->db->query("INSERT INTO departamentos_usuarios (id_usuario,id_departamento) VALUES (".$id_usuario.",".$depa->id_departamento.")");
				}
				$this->db->query("INSERT INTO datos_cliente(nombre_comercial, razon_social, rfc, banco, titular_cuenta, num_cuenta, cuenta_clabe, direccion_fiscal, uso_cfdi, metodo_pago, forma_pago, correo_facturas, requisitos_entrega, id_usuario,fecha_pago) VALUES('".$nombre_comercial."', '".$razon_social."', '".$rfc."', '".$banco."', '".$nombre_titular."', '".$num_cuenta."', '".$cuenta_clabe."', '".$direccion_fiscal."', '".$cfdi."', '".$metodo_pago."', '".$forma_pago."', '".$correo_facturas."', '".$requisitos_entrega."', ".$id_usuario.",'".$fecha_pago."')");
				$obj['resultado'] = true;
				$obj['id'] = $id_usuario;
			} else {
				$obj['resultado'] = false;
			}	
			
			return $obj;
		}

		public function cargar_cliente($id_usuario){
			$query = $this->db->query("SELECT * from usuarios INNER JOIN datos_cliente ON usuarios.id_usuario = datos_cliente.id_usuario WHERE usuarios.id_usuario = ?", $id_usuario);
			if($query->num_rows() > 0){
				$obj['resultado'] = true;
				$obj['datos_usuario'] = $query->row();
			}else{
				$obj['resultado'] = false;
			}	
			return $obj;
		}

		public function editar_cliente($id_usuario,$nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $telefono, $nivel, $nombre_comercial, $razon_social, $rfc, $banco, $num_cuenta, $nombre_titular, $cuenta_clabe, $direccion_fiscal, $cfdi, $metodo_pago, $forma_pago, $correo_facturas, $requisitos_entrega,$fecha_pago){
			$query = $this->db->query("UPDATE usuarios set nombre = ?, apellido_paterno = ?, apellido_materno = ?, usuario = ?, correo = ?, telefono = ?, nivel = ? WHERE id_usuario = ?", array($nombre, $apellido_paterno, $apellido_materno, $usuario, $correo, $telefono, $nivel, $id_usuario));
			if($this->db->affected_rows() > 0){
				$this->db->query("UPDATE datos_cliente set nombre_comercial = ".$nombre_comercial.", razon_social = ".$razon_social.",rfc = ".$rfc.", banco = ".$banco.", titular_cuenta = ".$nombre_titular.", num_cuenta = ".$num_cuenta.", cuenta_clabe".$cuenta_clabe.", direccion_fiscal = ".$direccion_fiscal.", uso_cfdi = ".$cfdi.", metodo_pago = ".$metodo_pago.", forma_pago = ".$forma_pago.", fecha_pago = ".$fecha_pago.", correo_facturas = ".$correo_facturas.", requisitos_entrega = ".$requisitos_entrega." WHERE id_usuario = ".$id_usuario);
				$obj['resultado'] = true;
			}else{
				$obj['resultado'] = false;
			}
			return $obj;
		}
		
	}
