<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function registrar_actividad($datos) {
        // Add current timestamp with proper timezone
        date_default_timezone_set('America/Santiago'); // Set to Chile timezone
        $datos['fecha'] = date('Y-m-d H:i:s');
        
        return $this->db->insert('actividades', $datos);
    }
    
    public function get_all_actividades() {
        $this->db->order_by('fecha', 'DESC');
        $query = $this->db->get('actividades');
        return $query->result();
    }
    
    public function obtener_actividades_filtradas($filtros = array(), $limite = NULL, $offset = NULL) {
        // Aplicar filtros si existen
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
        
        // Ordenar por fecha descendente (más reciente primero)
        $this->db->order_by('fecha', 'DESC');
        
        // Aplicar límite y offset para paginación
        if ($limite !== NULL && $offset !== NULL) {
            $this->db->limit($limite, $offset);
        }
        
        $query = $this->db->get('actividades');
        return $query->result();
    }
    
    public function contar_actividades_filtradas($filtros = array()) {
        // Aplicar filtros si existen
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
    
    public function obtener_acciones_unicas() {
        $this->db->distinct();
        $this->db->select('accion');
        $query = $this->db->get('actividades');
        
        $acciones = array();
        foreach ($query->result() as $row) {
            $acciones[] = $row->accion;
        }
        
        return $acciones;
    }
}