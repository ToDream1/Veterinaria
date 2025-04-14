<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function registrar_actividad($datos) {
        $data = array(
            'usuario_id' => $this->session->userdata('id'),  // Make sure this matches your database column name
            'accion' => $datos['accion'],
            'descripcion' => $datos['descripcion'],
            'fecha' => date('Y-m-d H:i:s')
        );
        
        // Check if the column exists in the database table
        // If not, remove it from the data array to prevent errors
        $fields = $this->db->list_fields('actividades');
        if (!in_array('usuario_id', $fields)) {
            unset($data['usuario_id']);
        }
        
        return $this->db->insert('actividades', $data);
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