<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Cotizacion extends MY_Controller {
		private $data = array();
		
		public function __construct(){
			parent::__construct();
			$this->checar_acceso_privilegiado();
			$this->load->model('CotizacionModel');
			$this->load->model('ConfiguracionModel');
			$this->load->model('EstructurasModel');
			$this->load->model('InversoresModel');
			$this->load->model('MicroinversoresModel');
			$this->load->model('OptimizadoresModel');
			$this->load->model('PanelesModel');
			$this->load->model('SistemasMonitoreoModel');	
			$this->load->model('UsuariosModel');
			$this->load->model('HistorialCotizacionesModel');	
			$this->data['datos_pagina']['seccion'] = "cotizador";
			$this->data['datos_pagina']['subseccion'] = "";
		}
	
		public function index() {
			$this->data['datos_pagina']['titulo_pagina'] = "Cotizador";
			if($this->checar_admin()) {
				$this->load->view('cotizador/cotizador_view', $this->data);
			}
			else {
				$this->load->view('cotizador/cotizador_empleado_view', $this->data);
			}
		}
		
		public function cotizador_empleado() {
			$this->data['datos_pagina']['titulo_pagina'] = "Cotizador";
			$this->load->view('cotizador/cotizador_empleado_view', $this->data);
		}
		
		public function obtener_datos_iniciales() {
			$obj['actualizar_dolar'] = $this->ConfiguracionModel->actualizar_dolar();
			$obj['datos_iniciales'] = $this->CotizacionModel->obtener_datos_iniciales();
			$obj['responsables'] = $this->UsuariosModel->cargar_responsables();
			$obj['paneles'] = $this->PanelesModel->cargar_paneles();
			$obj['sistemas_monitoreo'] = $this->SistemasMonitoreoModel->cargar_sistemas();
			$obj['inversores'] = $this->InversoresModel->cargar_inversores();
			$obj['optimizadores'] = $this->OptimizadoresModel->cargar_optimizadores();
			$obj['microinversores'] = $this->MicroinversoresModel->cargar_microinversores();
			$obj['tipos_estructura'] = $this->EstructurasModel->cargar_tipos_estructura();
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode($obj));
		}
		
		public function calcular_precio_promedio() {
			$tarifa_elegida = $this->input->post('tarifa_elegida');
			$consumo_bimestral = (float) $this->input->post('consumo_bimestral');
			$periodo = $this->input->post('periodo');
			
			$tarifa = $this->CotizacionModel->cargar_tarifa($tarifa_elegida);
			$costos_generales = $this->CotizacionModel->costos_generales();
			$iva = ((float) $costos_generales->iva)/100;
			$dap = ((float) $costos_generales->dap)/100;
			$obj['resultado'] = true;
			
			switch($tarifa_elegida) {
				case 'tarifa_dac' : 
					$suministro = (float) $tarifa->suministro_residencial;
					$dac = (float) $tarifa->dac*$consumo_bimestral;
					$valor_dap =  $dap*$dac;
					$valor_iva =  $iva*$dac;
					$precio_promedio = round($suministro + $dac + $valor_dap + $valor_iva, 2);
					break;
				case 'tarifa_pdbt' : 
					$suministro = (float) $tarifa->suministro_comercial;
					$pdbt = (float) $tarifa->pdbt*$consumo_bimestral;
					$valor_dap =  $dap*$pdbt;
					$valor_iva =  $iva*$pdbt;
					$precio_promedio = round($suministro + $pdbt + $valor_dap + $valor_iva, 2);
					break;
				case 'tarifa_01' : 
					$tarifa_limite_1 = 0;
					$tarifa_limite_2 = 0;
					$tarifa_limite_3 = 0;
					$consumo_aux = $consumo_bimestral;
					$suministro = (float) $tarifa->suministro_residencial;
					
					if($consumo_aux >= (float) $tarifa->d1_limite_superior) {
						$tarifa_limite_1 =  ((float) $tarifa->d1_limite_superior)*((float) $tarifa->d1);
						$consumo_aux -= (float) $tarifa->d1_limite_superior;
						if($consumo_aux >= (float) $tarifa->d2_limite_superior) {
							$tarifa_limite_2 =  ((float) $tarifa->d2_limite_superior)*((float) $tarifa->d2);
							$consumo_aux -= (float) $tarifa->d2_limite_superior;
							if($consumo_aux > 0) {
								$tarifa_limite_3 =  $consumo_aux*((float) $tarifa->d3);
							}
						}
						else {
							$tarifa_limite_2 =  $consumo_aux*((float) $tarifa->d2);
						}
					}
					else {
						$tarifa_limite_1 =  $consumo_aux*((float) $tarifa->d1);
					}
					
					$tarifa_01 = $tarifa_limite_1 + $tarifa_limite_2 + $tarifa_limite_3;
					$valor_dap = $tarifa_01*$dap;
					$valor_iva = $tarifa_01*$iva;
					$precio_promedio = round($suministro + $tarifa_01 + $valor_dap + $valor_iva, 2);
					break;
				default :
					$obj['resultado'] = false;
					break;
			}
			
			if($obj['resultado']) {
				if($periodo == 'mensual') {
					$gasto_anual = round($precio_promedio*12, 2);
					$gasto_bimestral = $precio_promedio*2;
				}
				else {
					$gasto_anual = round($precio_promedio*6, 2);
					$gasto_bimestral = $precio_promedio;
				}
				$obj['precio_promedio'] = $precio_promedio;
				$obj['gasto_anual'] = $gasto_anual;
				$obj['gasto_bimestral'] = $gasto_bimestral;
			}
			
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode($obj));
		}
		
		public function calcular_consumo_promedio() {
			$tarifa_elegida = $this->input->post('tarifa_elegida');
			$precio_promedio = (float) $this->input->post('precio_promedio');
			$periodo = $this->input->post('periodo');
			
			$tarifa = $this->CotizacionModel->cargar_tarifa($tarifa_elegida);
			$costos_generales = $this->CotizacionModel->costos_generales();
			$iva = ((float) $costos_generales->iva)/100;
			$dap = ((float) $costos_generales->dap)/100;
			$porcentaje_real = 1-$iva-$dap;
			
			if(!is_null($tarifa) && $precio_promedio>0) {
				$obj['resultado'] = true;
			
				switch($tarifa_elegida) {
					case 'tarifa_dac' : 
						$consumo_promedio = round($precio_promedio*$porcentaje_real/((float) $tarifa->dac), 2);
						break;
					case 'tarifa_pdbt' : 
						$consumo_promedio = round($precio_promedio*$porcentaje_real/((float) $tarifa->pdbt), 2);
						break;
					case 'tarifa_01' : 
						$consumo_limite_1 = 0;
						$consumo_limite_2 = 0;
						$consumo_limite_3 = 0;
						$total_aux = $precio_promedio*$porcentaje_real;
						
						$tarifa_limite_1 = ((float) $tarifa->d1_limite_superior)*((float) $tarifa->d1);
						$tarifa_limite_2 = ((float) $tarifa->d2_limite_superior)*((float) $tarifa->d2);
						
						if($total_aux >= $tarifa_limite_1) {
							$consumo_limite_1 = (float) $tarifa->d1_limite_superior;
							$total_aux -= $tarifa_limite_1;
							
							if($total_aux > 0) {
								if($total_aux >= $tarifa_limite_2) {
									$consumo_limite_2 = (float) $tarifa->d2_limite_superior;
									$total_aux -= $tarifa_limite_2;
									
									if($total_aux > 0) {
										$consumo_limite_3 = $total_aux/((float) $tarifa->d3);
									}
								}
								else {
									$consumo_limite_2 = $total_aux/((float) $tarifa->d2);
								}
							}
						}
						else {
							$consumo_limite_1 = $total_aux/((float) $tarifa->d1);
						}
						
						$consumo_promedio = round($consumo_limite_1 + $consumo_limite_2 + $consumo_limite_3, 2);
						break;
					default :
						$obj['resultado'] = false;
						break;
				}
				
				if($obj['resultado']) {
					if($periodo == 'mensual') {
						$gasto_anual = round($precio_promedio*12, 2);
						$gasto_bimestral = $precio_promedio*2;
					}
					else {
						$gasto_anual = round($precio_promedio*6, 2);
						$gasto_bimestral = $precio_promedio;
					}
					$obj['consumo_promedio'] = $consumo_promedio;
					$obj['gasto_anual'] = $gasto_anual;
					$obj['gasto_bimestral'] = $gasto_bimestral;
				}
			}
			else {
				$obj['resultado'] = false;
			}
			
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode($obj));
		}
		
		public function calcular_panel() {
			$id_panel = $this->input->post('id_panel');
			$consumo_promedio = (float) $this->input->post('consumo_promedio');
			$periodo = $this->input->post('periodo');
			
			$panel = $this->PanelesModel->cargar_panel($id_panel);
			$datos_generales = $this->CotizacionModel->datos_generales();
			$tasa_cambio = $this->CotizacionModel->tasa_cambio();
			
			if(!is_null($panel) && $consumo_promedio>0) {
				$hps = (float) $datos_generales->hps;
				$eficiencia = ((float) $datos_generales->eficiencia)/100;
				
				$costo_usd = (float) $panel->usd_panel;
				$costo_mxn = round($costo_usd*((float)$tasa_cambio->tasa_cambio), 2);
				$kw_panel = ((float) $panel->watts_panel)/1000;
				
				if($periodo == "mensual") {
					$produccion_panel = round($hps*$kw_panel*$eficiencia*30, 3);
				}
				else {
					$produccion_panel = round($hps*$kw_panel*$eficiencia*60, 3);
				}
				
				$num_paneles = floor($consumo_promedio/$produccion_panel);

				$obj['resultado'] = true;
				$obj['panel'] = $panel;
				$obj['num_paneles'] = $num_paneles;
			}
			else {
				$obj['resultado'] = false;
			}
			
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode($obj));
		}
		
		public function cambio_numero_paneles() {
			$id_panel = $this->input->post('id_panel');
			$consumo_promedio = (float) $this->input->post('consumo_promedio');
			$num_paneles = (int) $this->input->post('num_paneles');
			$periodo = $this->input->post('periodo');
			
			$panel = $this->PanelesModel->cargar_panel($id_panel);
			$datos_generales = $this->CotizacionModel->datos_generales();
			$tasa_cambio = $this->CotizacionModel->tasa_cambio();
			
			if(!is_null($panel) && $consumo_promedio>0 && $num_paneles>0) {
				$hps = (float) $datos_generales->hps;
				$eficiencia = ((float) $datos_generales->eficiencia)/100;
				
				$kw_panel = ((float) $panel->watts_panel)/1000;
				$potencia_total = round($kw_panel*$num_paneles, 3);
				
				if($periodo == "mensual") {
					$produccion_panel = round($hps*$kw_panel*$eficiencia*30, 3);
					$produccion_promedio = round($produccion_panel*$num_paneles, 3);
					$produccion_anual = round($produccion_promedio*12, 3);
				}
				else {
					$produccion_panel = round($hps*$kw_panel*$eficiencia*60, 3);
					$produccion_promedio = round($produccion_panel*$num_paneles, 3);
					$produccion_anual = round($produccion_promedio*6, 3);
				}
				
				$ahorro = round(($produccion_promedio/$consumo_promedio)*100, 2);
				
				$costo_usd = (float) $panel->usd_panel;
				$costo_mxn = round($costo_usd*((float)$tasa_cambio->tasa_cambio), 2);
				$costo_total = round($costo_usd*((float)$tasa_cambio->tasa_cambio)*$num_paneles, 2);

				$obj['resultado'] = true;
				$obj['panel'] = $panel;
				$obj['ahorro'] = $ahorro;
				$obj['costo_mxn'] = $costo_mxn;
				$obj['costo_total'] = $costo_total;
				$obj['potencia_total'] = $potencia_total;
				$obj['produccion_promedio'] = $produccion_promedio;
				$obj['produccion_anual'] = $produccion_anual;
				$obj['kw_panel'] = $kw_panel;
				$obj['produccion_panel'] = $produccion_panel;
				$obj['num_paneles'] = $num_paneles;
			}
			else {
				$obj['resultado'] = false;
			}
			
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode($obj));
		}
		
		public function agregar_estructura() {
			$id_estructura = $this->input->post('id_estructura');
			$cantidad = $this->input->post('cantidad');
			$tasa_cambio = $this->CotizacionModel->tasa_cambio();
			$estructura = $this->EstructurasModel->cargar_estructura($id_estructura);
			
			if(!is_null($estructura) && $cantidad>0) {
				$costo_usd = (float) $estructura->usd_panel;
				$costo_mxn = round($costo_usd*((float)$tasa_cambio->tasa_cambio), 2);
				$costo_total = round($costo_mxn*$cantidad, 2);
				
				$obj['resultado'] = true;
				
			}
		}

		public function pruebita() {
			$textoprueba = $this->input->post('textoprueba');
			echo $textoprueba;
		}
		
		public function guardar_cotizacion() {
			$datos_cotizacion = $this->input->post('datos_cotizacion');
			$datos_consumo = $this->input->post('datos_consumo');
			$datos_sistema = $this->input->post('datos_sistema');
			$datos_ahorro = $this->input->post('datos_ahorro');
			$productos_cotizacion = $this->input->post('productos_cotizacion');
			$totales_cotizacion = $this->input->post('totales_cotizacion');
			$grafica_consumo = $this->input->post('grafica_consumo');
			$grafica_roi = $this->input->post('grafica_roi');
			
			$obj = $this->CotizacionModel->guardar_cotizacion($datos_cotizacion, $datos_consumo, $datos_sistema, $datos_ahorro, $productos_cotizacion, $totales_cotizacion, $grafica_consumo, $grafica_roi);
			
			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode($obj));
		}
		
		public function previsualizar_cotizacion($id_cotizacion = null) {
			$obj = $this->HistorialCotizacionesModel->descargar_cotizacion($id_cotizacion);
			if($obj['resultado']) {
				if($obj['estado_cotizacion'] != "Incompleto") {
					redirect("historial_cotizaciones");
				}
				else {
					if($this->checar_admin()) {
						$this->load->view('reporte/reporte_view',$obj);
					}
					else {
						$this->load->view('reporte/reporte_empleado_view',$obj);
					}
				}
			}
			else {
				redirect("historial_cotizaciones");
			}
		}
		
		public function finalizar_cotizacion() {
			$id_cotizacion = $this->input->post('id_cotizacion');
			$condiciones_pago = $this->input->post('condiciones_pago');
			$vigencia = $this->input->post('vigencia');
			$tiempo_entrega = $this->input->post('tiempo_entrega');
			
			$obj = $this->CotizacionModel->finalizar_cotizacion($id_cotizacion, $condiciones_pago, $vigencia, $tiempo_entrega);

			$this->output->set_content_type("application/json");
			$this->output->set_output(json_encode($obj));
		}
			
			
	}
	
	