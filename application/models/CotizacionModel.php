<?php
	class CotizacionModel extends CI_Model{
		public function cargar_tarifa($tarifa_elegida) {
			switch($tarifa_elegida) {
				case 'tarifa_dac' : 
					$query = $this->db->query("SELECT dac, suministro_residencial FROM tarifas_cfe");
					break;
				case 'tarifa_pdbt' : 
					$query = $this->db->query("SELECT pdbt, suministro_comercial FROM tarifas_cfe");
					break;
				case 'tarifa_01' : 
					$query = $this->db->query("SELECT d1, d1_limite_inferior, d1_limite_superior, d2, d2_limite_inferior, d2_limite_superior, d3, d3_limite_inferior, d3_limite_superior, suministro_residencial FROM tarifas_cfe");
					break;
			}
			
			return $query->row();
		}
		
		public function costos_generales() {
			$query = $this->db->query("SELECT * FROM costos_generales");
			return $query->row();
		}
		
		public function datos_generales() {
			$query = $this->db->query("SELECT * FROM datos_generales");
			return $query->row();
		}
		
		public function tasa_cambio() {
			$query = $this->db->query("SELECT * FROM tasa_cambio");
			return $query->row();
		}
		
		public function cargar_panel($id_panel) {
			$query = $this->db->query("SELECT * FROM paneles WHERE id_panel = ?", $id_panel);
			return $query->row();
		}
		
		public function obtener_datos_iniciales() {
			$obj['resultado'] = true;
			
			$query = $this->db->query("SELECT * FROM costos_generales");
			if($query->num_rows() > 0) {
				$obj['costos_generales'] = $query->row();
			}
			else {
				$obj['resultado'] = false;
			}
			
			$query = $this->db->query("SELECT * FROM datos_generales");
			if($query->num_rows() > 0) {
				$obj['datos_generales'] = $query->row();
			}
			else {
				$obj['resultado'] = false;
			}
			
			$query = $this->db->query("SELECT *, DATE_FORMAT(fecha_tasa,'%d/%m/%Y') as solo_fecha_tasa, TIME_FORMAT(fecha_tasa, '%H:%i %p') as solo_hora_tasa FROM tasa_cambio");
			if($query->num_rows() > 0) {
				$obj['tasa_cambio'] = $query->row();
			}
			else {
				$obj['resultado'] = false;
			}
			
			$query = $this->db->query("SELECT *, DATE_FORMAT(fecha_actualizacion,'%d/%m/%Y') as solo_fecha_cfe, TIME_FORMAT(fecha_actualizacion, '%H:%i %p') as solo_hora_cfe FROM tarifas_cfe");
			
			if($query->num_rows() > 0) {
				$obj['tarifas_cfe'] = $query->row();
			}
			else {
				$obj['resultado'] = false;
			}
			
			return $obj;
		}
		
		public function guardar_cotizacion($datos_cotizacion, $datos_consumo, $datos_sistema, $datos_ahorro, $productos_cotizacion, $totales_cotizacion, $grafica_consumo, $grafica_roi) {
			$this->db->trans_begin();
			
			$query = $this->db->query("INSERT INTO cotizaciones (
				id_usuario, 
				nombre, 
				ubicacion, 
				telefono,
				correo,
				numero_servicio, 
				fecha_cotizacion, 
				tarifa, 
				periodo, 
				forma_calculo, 
				consumo_promedio_kwh, 
				consumo_promedio_precio, 
				tasa_cambio, 
				tipo_interconexion, 
				num_paneles, 
				produccion_periodo, 
				produccion_anual, 
				subtotal, 
				iva, 
				total, 
				retorno_inversion, 
				grafica_consumo, 
				grafica_roi,
				anticipo_porcentaje) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				array(
				$datos_cotizacion['id_asesor'], 
				$datos_cotizacion['nombre_usuario'], 
				$datos_cotizacion['ubicacion'], 
				$datos_cotizacion['telefono'], 
				$datos_cotizacion['correo'], 
				$datos_cotizacion['num_servicio'], 
				$datos_cotizacion['fecha_cotizacion'], 
				$datos_consumo['tarifa'], 
				$datos_consumo['periodo'], 
				$datos_consumo['forma_calculo'], 
				$datos_consumo['consumo_promedio_kwh'], 
				$datos_consumo['consumo_promedio_pesos'], 
				$datos_cotizacion['tasa_cambio'], 
				$datos_sistema['tipo_interconexion'], 
				$datos_sistema['num_paneles'], 
				$datos_sistema['produccion_promedio'], 
				$datos_sistema['produccion_anual'],  
				$totales_cotizacion['costo_proyecto_utilidad'], 
				$totales_cotizacion['iva_final'], 
				$totales_cotizacion['costo_final'], 
				$totales_cotizacion['retorno_inversion'], 
				$grafica_consumo, 
				$grafica_roi,
				$totales_cotizacion['porcentaje_minimo']));
			$obj['id_cotizacion'] = $this->db->insert_id();

			foreach($productos_cotizacion as $producto) {
				$query = $this->db->query("INSERT INTO cotizaciones_productos (id_cotizacion, nombre, cantidad, precio_unitario, importe) VALUES(?,?,?,?,?)", array($obj['id_cotizacion'], $producto['nombre'], $producto['cantidad'], $producto['p_unitario'], $producto['importe']));	
			}
			
			foreach($datos_ahorro as $dato_ahorro) {
				$query = $this->db->query("INSERT INTO cotizaciones_ahorro (id_cotizacion, periodo, actual, con_aamperia, ahorro) VALUES(?,?,?,?,?)", array($obj['id_cotizacion'], $dato_ahorro['periodo'], $dato_ahorro['actual'], $dato_ahorro['con_aamperia'], $dato_ahorro['ahorro']));	
			}
			
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
		
		public function finalizar_cotizacion($id_cotizacion, $condiciones_pago, $vigencia, $tiempo_entrega) {
			$this->db->trans_begin();
			
			$query = $this->db->query("UPDATE cotizaciones SET 
				vigencia = DATE_ADD(fecha_cotizacion, INTERVAL ? DAY), 
				tiempo_entrega = ?,
				anticipo = ?,
				anticipo_porcentaje = ?,
				finalizar_instalacion = ?,
				finalizar_instalacion_porcentaje = ?,
				cambio_medidor_cfe = ?,
				cambio_medidor_cfe_porcentaje = ?,
				estado_cotizacion = 'Pendiente'
				WHERE id_cotizacion = ?",
				array($vigencia, $tiempo_entrega, $condiciones_pago['anticipo'], $condiciones_pago['anticipo_porcentaje'], $condiciones_pago['fin_instalacion'], $condiciones_pago['fin_instalacion_porcentaje'], $condiciones_pago['cambio_medidor'], $condiciones_pago['cambio_medidor_porcentaje'], $id_cotizacion));
				
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
	}