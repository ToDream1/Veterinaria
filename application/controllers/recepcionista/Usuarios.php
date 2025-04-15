<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('rol') !== 'recepcionista') {
            redirect('auth/login');
        }
        $this->load->model('Usuario_model');
    }

    public function index() {
        $this->load->model('Usuario_model');
        $data['usuarios'] = $this->Usuario_model->get_usuarios_by_rol('usuario');
        $data['title'] = 'Lista de Usuarios';
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/usuarios/index', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function ver($id) {
        $usuario = $this->Usuario_model->get_usuario($id);
        
        if ($usuario) {
            header('Content-Type: application/json');
            echo json_encode($usuario);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Usuario no encontrado']);
        }
    }

    public function editar($id) {
        // Add debugging
        log_message('debug', 'Editar method called with ID: ' . $id);
        
        $data['usuario'] = $this->Usuario_model->get_usuario($id);
        
        if (!$data['usuario']) {
            $this->session->set_flashdata('error', 'Usuario no encontrado');
            redirect('recepcionista/usuarios');
            return;
        }
    
        $data['title'] = 'Editar Usuario';
    
        // Load views
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/usuarios/editar', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function actualizar($id) {
        log_message('debug', 'Actualizar method called with ID: ' . $id);
        log_message('debug', 'POST data: ' . print_r($_POST, true));

        $data = array(
            'rut' => $this->input->post('rut'),
            'nombre' => $this->input->post('nombre'),
            'email' => $this->input->post('email'),
            'direccion' => $this->input->post('direccion'),
            'telefono' => $this->input->post('telefono')
        );

        if ($this->Usuario_model->actualizar($id, $data)) {
            $this->session->set_flashdata('success', 'Usuario actualizado correctamente');
        } else {
            $this->session->set_flashdata('error', 'Error al actualizar el usuario');
        }
        redirect('recepcionista/usuarios');
    }
}