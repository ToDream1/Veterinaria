<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mascota_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function agregar_mascota($data) {
        $mascota_data = array(
            'nombre' => $data['nombre'],
            'especie' => $data['especie'],
            'raza' => $data['raza'],
            'sexo' => $data['sexo'],
            'edad_aproximada' => $data['edad_aproximada'],
            'peso' => $data['peso'],
            'color' => $data['color'],
            'alergias_conocidas' => $data['alergias_conocidas'],
            'usuario_id' => $data['usuario_id'],
            'created_at' => $data['created_at']
        );

        return $this->db->insert('mascotas', $mascota_data);
    }

    public function crear_mascota($datos) {
        return $this->db->insert('mascotas', $datos);
    }

    // Añade este método al modelo Mascota_model si no existe
    // Añade este método si no existe
    public function count_mascotas() {
        return $this->db->count_all('mascotas');
    }

    public function get_mascotas() {
        return $this->db->get('mascotas')->result();
    }

    public function get_mascotas_by_usuario($usuario_id) {
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->get('mascotas')->result();
    }

    public function get_mascota($id) {
        return $this->db->get_where('mascotas', array('id' => $id))->row();
    }

    public function actualizar_mascota($id, $data) {
        $this->db->where('id', $id);
        $result = $this->db->update('mascotas', $data);
        
        // Debug para verificar la consulta SQL
        log_message('debug', 'SQL Query: ' . $this->db->last_query());
        
        return $result;
    }

    public function eliminar_mascota($id) {
        $this->db->where('id', $id);
        return $this->db->delete('mascotas');
    }

    public function get_all_mascotas() {
        $this->db->select('mascotas.*, users.nombre as nombre_propietario');
        $this->db->from('mascotas');
        $this->db->join('users', 'users.id = mascotas.usuario_id'); 
        return $this->db->get()->result();
    }
}