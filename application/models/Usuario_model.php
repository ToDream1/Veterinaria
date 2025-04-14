<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get_usuario($id) {
        $this->db->select('id, rut, nombre, email, telefono, direccion');
        $this->db->from('users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        
        return false;
    }

    // Podemos eliminar get_usuario_by_id ya que usaremos get_usuario
    public function get_usuario_by_id($user_id) {
        $this->db->select('nombre, email, telefono, direccion');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        
        return $query->row();
    }

    public function actualizar($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
    
    // O si prefieres mantener el nombre que estabas usando:
    public function actualizar_usuario($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }
}