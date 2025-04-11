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
    
    public function obtener_actividades() {
        $this->db->order_by('fecha', 'DESC');
        $this->db->limit(10); // Mostrar solo las últimas 10 actividades
        return $this->db->get('actividades')->result();
    }
}