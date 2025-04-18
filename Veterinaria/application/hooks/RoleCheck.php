<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RoleCheck {
    
    public function verify() {
        $CI =& get_instance();
        
        // Asegúrate de que la sesión esté iniciada
        if (!isset($CI->session)) {
            $CI->load->library('session');
        }
        
        // Si el usuario no ha iniciado sesión, no hacemos nada
        if (!$CI->session->userdata('logged_in')) {
            return;
        }
        
        // Verificar el rol y redirigir según corresponda
        $role = $CI->session->userdata('role');
        $current_controller = $CI->router->fetch_class();
        
        if ($role === 'administrador' && $current_controller !== 'admin' && $current_controller !== 'auth') {
            redirect('admin/dashboard');
        } elseif ($role !== 'administrador' && $current_controller === 'admin') {
            redirect('user/index');
        }
    }
}