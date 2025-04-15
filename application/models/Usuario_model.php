<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }

    public function get_usuarios_by_rol($rol) {
        $this->db->where('rol', $rol);
        return $this->db->get('users')->result();  // Cambiado a 'users'
    }

    public function get_usuario($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function actualizar($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    // Eliminar este método ya que es redundante
    // public function actualizar_usuario($id, $data) {
    //     $this->db->where('id', $id);
    //     return $this->db->update('users', $data);
    // }

    public function get_propietarios() {
        $this->db->select('id, nombre, apellidos, email, telefono, direccion');
        $this->db->from('users');  // Cambiado a 'users'
        $this->db->where('rol', 'propietario');
        return $this->db->get()->result();
    }
}