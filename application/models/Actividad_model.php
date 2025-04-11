<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_model extends CI_Model {
    
    public function registrar_actividad($datos) {
        $data = array(
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => $this->session->userdata('nombre'),
            'accion' => $datos['accion'],
            'descripcion' => $datos['descripcion']
        );
        
        return $this->db->insert('actividades', $data);
    }
    
    /**
     * Obtiene las actividades recientes del sistema
     * 
     * @param int $limit Límite de registros a obtener
     * @return array Lista de actividades
     */
    public function obtener_actividades($limit = 10) {
        $this->db->order_by('fecha', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get('actividades');
        return $query->result();
    }
}