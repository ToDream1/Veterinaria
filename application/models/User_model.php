<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    // Definir roles válidos del sistema
    private $roles_validos = [
        'administrador',
        'usuario',
        'recepcionista',
        'veterinario'
    ];
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_roles_validos() {
        return $this->roles_validos;
    }
    
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
    
    public function count_users() {
        return $this->db->count_all('users');
    }

    public function get_all_users() {
        $this->db->order_by('role', 'ASC');
        $this->db->order_by('nombre', 'ASC');
        $query = $this->db->get('users');
        return $query->result();
    }

    public function buscar_usuarios_por_nombre($nombre) {
        $this->db->like('nombre', $nombre);
        $this->db->or_like('rut', $nombre);
        $this->db->or_like('email', $nombre);
        $this->db->limit(10);
        $query = $this->db->get('users');
        return $query->result();
    }

    public function crear($datos) {
        // Validar que el rol sea válido
        if (!isset($datos['role']) || !in_array($datos['role'], $this->roles_validos)) {
            $datos['role'] = 'usuario';
        }
        
        if (isset($datos['confirm_password'])) {
            unset($datos['confirm_password']);
        }
        
        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
        
        return $this->db->insert('users', $datos);
    }

    public function actualizar($id, $datos) {
        if (isset($datos['role']) && !in_array($datos['role'], $this->roles_validos)) {
            return false;
        }
        
        $data = array(
            'nombre' => $datos['nombre'],
            'email' => isset($datos['email']) ? $datos['email'] : NULL,
            'direccion' => isset($datos['direccion']) ? $datos['direccion'] : '',
            'telefono' => isset($datos['telefono']) ? $datos['telefono'] : '',
            'role' => isset($datos['role']) ? $datos['role'] : 'usuario'
        );
        
        if (isset($datos['rut'])) {
            $data['rut'] = $datos['rut'];
        }

        if (isset($datos['password']) && !empty(trim($datos['password']))) {
            $data['password'] = password_hash(trim($datos['password']), PASSWORD_BCRYPT);
            if ($data['password'] === false) {
                log_message('error', 'Error al generar hash de contraseña para usuario ID: ' . $id);
                return false;
            }
        }
        
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
        if (!in_array($role, $this->roles_validos)) {
            return array();
        }
        $this->db->where('role', $role);
        $this->db->order_by('nombre', 'ASC');
        return $this->db->get('users')->result();
    }
    
    public function get_user($id) {
        return $this->get_user_by_id($id);
    }

    public function count_users_by_role($role) {
        $this->db->where('role', $role);
        return $this->db->count_all_results('users');
    }
}