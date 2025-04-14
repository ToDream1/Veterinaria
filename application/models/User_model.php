<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    // Aquí deberías tener un método crear() o similar
    // Si no existe, necesitamos implementarlo
    
    public function login($rut, $password) {
        $this->db->where('rut', $rut);
        $query = $this->db->get('users');
        
        if($query->num_rows() == 0) {
            return 'rut_invalido';
        }
        
        $user = $query->row();
        
        if(password_verify($password, $user->password)) {
            return $user;
        } else {
            return 'password_invalido';
        }
    }
    
    /**
     * Cuenta el número total de usuarios en el sistema
     * 
     * @return int Número total de usuarios
     */
    // Añade este método si no existe
    public function count_users() {
        return $this->db->count_all('users');
    }

    public function get_all_users() {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function buscar_usuarios_por_nombre($nombre) {
        // Limit the search to 10 results for better performance
        $this->db->like('nombre', $nombre);
        $this->db->or_like('rut', $nombre);
        $this->db->or_like('email', $nombre);
        $this->db->limit(10);
        $query = $this->db->get('users');
        return $query->result();
    }

    public function crear($datos) {
        // Eliminar confirm_password si existe en el array
        if (isset($datos['confirm_password'])) {
            unset($datos['confirm_password']);
        }
        
        // Asignar rol por defecto si no se especifica
        if (!isset($datos['role']) || empty($datos['role'])) {
            $datos['role'] = 'usuario';
        }
        
        // Encriptar la contraseña antes de guardarla
        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
        
        // Insertar en la base de datos
        return $this->db->insert('users', $datos);
    }

    public function actualizar($id, $datos) {
        // Preparar los datos para actualizar
        $data = array(
            'rut' => $datos['rut'],
            'nombre' => $datos['nombre'],
            'email' => isset($datos['email']) ? $datos['email'] : NULL,
            'direccion' => isset($datos['direccion']) ? $datos['direccion'] : '',
            'telefono' => isset($datos['telefono']) ? $datos['telefono'] : '',
            'role' => $datos['role']
        );
        
        // Si se proporcionó una nueva contraseña, encriptarla
        if(isset($datos['password']) && !empty($datos['password'])) {
            $data['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
        }
        
        // Actualizar el usuario en la base de datos
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function eliminar($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function get_user_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function get_users_by_role($role) {
        $this->db->where('role', $role);
        $query = $this->db->get('users'); // Corregido de 'usuarios' a 'users'
        return $query->result();
    }
    
    // Añadir este método para resolver el error
    public function get_user($id) {
        return $this->get_user_by_id($id);
    }
}