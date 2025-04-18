<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_model extends CI_Model {
    
    public function registrar_actividad($datos) {
        $data = array(
            'fecha' => date('Y-m-d H:i:s'),
            'accion' => $datos['accion'],
            'descripcion' => $datos['descripcion'],
            'usuario' => isset($datos['usuario']) ? $datos['usuario'] : $this->session->userdata('nombre')
        );
        
        return $this->db->insert('actividades', $data);
    }
    
    public function contar_actividades_filtradas($filtros = array()) {
        if (!empty($filtros['descripcion'])) {
            $this->db->like('descripcion', $filtros['descripcion']);
        }
        if (!empty($filtros['fecha_inicio'])) {
            $this->db->where('fecha >=', $filtros['fecha_inicio']);
        }
        if (!empty($filtros['fecha_fin'])) {
            $this->db->where('fecha <=', $filtros['fecha_fin']);
        }
        if (!empty($filtros['tipo'])) {
            $this->db->where('accion', $filtros['tipo']);
        }
        
        return $this->db->count_all_results('actividades');
    }
    
    public function obtener_actividades_filtradas($filtros = array(), $limit = null, $offset = null) {
        if (!empty($filtros['descripcion'])) {
            $palabras = explode(' ', trim($filtros['descripcion']));
            foreach ($palabras as $palabra) {
                if (strlen($palabra) > 2) { // Ignorar palabras muy cortas
                    $this->db->like('descripcion', $palabra);
                }
            }
        }
        if (!empty($filtros['fecha_inicio'])) {
            $this->db->where('fecha >=', $filtros['fecha_inicio']);
        }
        if (!empty($filtros['fecha_fin'])) {
            $this->db->where('fecha <=', $filtros['fecha_fin']);
        }
        if (!empty($filtros['tipo'])) {
            $this->db->where('accion', $filtros['tipo']);
        }
        if (!empty($filtros['usuario'])) {
            $this->db->like('usuario', $filtros['usuario']);
        }
        
        $this->db->order_by('fecha', 'DESC');
        
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
        
        return $this->db->get('actividades')->result();
    }
    
    public function obtener_acciones_unicas() {
        $this->db->distinct();
        $this->db->select('accion');
        $this->db->order_by('accion', 'ASC');
        $resultado = $this->db->get('actividades')->result();
        
        $acciones = array();
        foreach ($resultado as $row) {
            $acciones[] = $row->accion;
        }
        
        return $acciones;
    }
}