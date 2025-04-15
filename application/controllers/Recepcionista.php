<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recepcionista extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Verificar si el usuario está logueado y es recepcionista
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'recepcionista') {
            redirect('auth/login');
        }
        $this->load->model('User_model');
        $this->load->model('Mascota_model');
        $this->load->model('Actividad_model');
    }

    public function index() {
        $data['titulo'] = 'Dashboard Recepcionista';
        
        // Obtener estadísticas
        $data['total_usuarios'] = $this->User_model->count_users();
        $data['total_mascotas'] = $this->Mascota_model->count_mascotas();
        $data['total_citas'] = 0; // Por implementar
        $data['actividades'] = $this->Actividad_model->obtener_actividades(5);
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/dashboard/index', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function usuarios() {
        $data['titulo'] = 'Gestión de Usuarios';
        $data['usuarios'] = $this->User_model->get_users_by_role('usuario');
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/usuarios/index', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    // Solo puede crear y editar usuarios normales
    public function crear_usuario() {
        if ($this->input->post()) {
            $datos = $this->input->post();
            $datos['role'] = 'usuario'; // Forzar rol de usuario
            
            if($this->User_model->crear($datos)) {
                $this->session->set_flashdata('success', 'Usuario creado correctamente');
            } else {
                $this->session->set_flashdata('error', 'Error al crear el usuario');
            }
            redirect('recepcionista/usuarios');
        }
        
        $data['titulo'] = 'Crear Usuario';
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/usuarios/crear', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function actividades() {
        $data['titulo'] = 'Registro de Actividades';
        $data['actividades'] = $this->Actividad_model->obtener_actividades();
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/actividades/index', $data);
        $this->load->view('recepcionista/templates/footer');
    }
}