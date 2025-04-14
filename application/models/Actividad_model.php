<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function registrar_actividad($datos) {
        // Asegurarse de que estamos usando la tabla correcta 'actividades' (no 'actividad')
        $data = array(
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => $this->session->userdata('nombre') ? $this->session->userdata('nombre') : 'Sistema',
            'accion' => $datos['accion'],
            'descripcion' => $datos['descripcion']
        );
        
        // Agregar log para depuración
        log_message('debug', 'Registrando actividad: ' . print_r($data, true));
        
        return $this->db->insert('actividades', $data);
    }
    
    public function obtener_actividades() {
        $this->db->order_by('fecha', 'DESC');
        return $this->db->get('actividades')->result();
    }
}