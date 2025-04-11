<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function login($rut, $password) {
        $this->db->where('rut', $rut);
        $user = $this->db->get('users')->row();
        
        if (!$user) {
            return 'rut_invalido';
        }
        
        // Verificar primero con password_verify para contraseñas hasheadas
        if (password_verify($password, $user->password)) {
            return $user;
        }
        
        // Si falla, verificar con md5 para compatibilidad con contraseñas antiguas
        if (md5($password) === $user->password) {
            // Actualizar a hash seguro para próximos logins
            $this->db->where('id', $user->id);
            $this->db->update('users', ['password' => password_hash($password, PASSWORD_DEFAULT)]);
            return $user;
        }
        
        return 'password_invalido';
    }

    /**
     * Cuenta el número total de usuarios en el sistema
     * 
     * @return int Número total de usuarios
     */
    public function count_users() {
        return $this->db->count_all('users');
    }

    public function get_all_users() {
        return $this->db->get('users')->result();
    }

    public function crear($datos) {
        $datos['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
        return $this->db->insert('users', $datos);
    }

    public function actualizar($id, $datos) {
        $data = array(
            'nombre' => $datos['nombre'],
            'email' => $datos['email'],
            'role' => $datos['role']
        );
        if(!empty($datos['password'])) {
            $data['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
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
}