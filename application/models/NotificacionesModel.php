<?php 
class NotificacionesModel extends CI_Model{
	public function traer_notificaciones(){
		$notificaciones = [];
		$query = $this->db->query("SELECT * FROM departamentos_usuarios WHERE id_usuario = ? AND status = 1",$this->session->userdata['usuario']['id_usuario']);
		$rs = $query->result();
		foreach($rs as $departamento){
			$not = $this->db->query("SELECT * FROM notificaciones WHERE id_departamento = ? ORDER BY id DESC LIMIT 6 ",$departamento->id_departamento);
			if(!empty($not->result())){
				array_push($notificaciones,$not->result());
			}
		}
		return $notificaciones[0];
	}
}
