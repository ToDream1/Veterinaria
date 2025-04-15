<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function registrar_actividad($datos) {
        // Configurar la zona horaria a Chile y restar una hora
        date_default_timezone_set('America/Santiago');
        $hora_chile = date('Y-m-d H:i:s', strtotime('-1 hour'));
        
        $data = array(
            'fecha' => $hora_chile,
            'accion' => $datos['accion'],
            'descripcion' => $datos['descripcion'],
            'usuario' => isset($datos['usuario']) ? $datos['usuario'] : $this->session->userdata('nombre')
        );
        
        return $this->db->insert('actividades', $data);
    }
    
    public function obtener_actividades($limite = 10, $offset = 0) {
        $this->db->order_by('fecha', 'DESC');
        return $this->db->get('actividades', $limite, $offset)->result();
    }
    
    public function obtener_total_actividades() {
        return $this->db->count_all('actividades');
    }
    
    // Agregar método para obtener acciones únicas
    public function obtener_acciones_unicas() {
        $this->db->distinct();
        $this->db->select('accion');
        $this->db->order_by('accion', 'ASC');
        return $this->db->get('actividades')->result();
    }
    
    // Agregar método para filtrar y contar actividades
    public function contar_actividades_filtradas($filtros = array()) {
        if (!empty($filtros['descripcion'])) {
            $this->db->like('descripcion', $filtros['descripcion']);
        }
        if (!empty($filtros['accion'])) {
            $this->db->where('accion', $filtros['accion']);
        }
        if (!empty($filtros['fecha_desde'])) {
            $this->db->where('fecha >=', $filtros['fecha_desde'] . ' 00:00:00');
        }
        if (!empty($filtros['fecha_hasta'])) {
            $this->db->where('fecha <=', $filtros['fecha_hasta'] . ' 23:59:59');
        }
        
        return $this->db->count_all_results('actividades');
    }
    
    // Agregar método para obtener actividades filtradas
    public function obtener_actividades_filtradas($filtros = array(), $limite = 10, $offset = 0) {
        if (!empty($filtros['descripcion'])) {
            $this->db->like('descripcion', $filtros['descripcion']);
        }
        if (!empty($filtros['accion'])) {
            $this->db->where('accion', $filtros['accion']);
        }
        if (!empty($filtros['fecha_desde'])) {
            $this->db->where('fecha >=', $filtros['fecha_desde'] . ' 00:00:00');
        }
        if (!empty($filtros['fecha_hasta'])) {
            $this->db->where('fecha <=', $filtros['fecha_hasta'] . ' 23:59:59');
        }
        
        $this->db->order_by('fecha', 'DESC');
        return $this->db->get('actividades', $limite, $offset)->result();
    }
}