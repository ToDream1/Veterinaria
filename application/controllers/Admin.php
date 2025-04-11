<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('User_model');
        $this->load->model('Mascota_model');
        $this->load->model('Actividad_model');
    }

    public function index() {
        $data['titulo'] = 'Dashboard Administrativo';
        $data['total_usuarios'] = $this->User_model->count_users();
        $data['total_mascotas'] = $this->Mascota_model->count_mascotas();
        $data['actividades'] = $this->Actividad_model->obtener_actividades();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar', $data);
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('admin/templates/footer');
    }

    // Funciones para Usuarios
    public function usuarios() {
        $data['titulo'] = 'Gestión de Usuarios';
        $data['usuarios'] = $this->User_model->get_all_users();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/usuarios/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function crear_usuario() {
        if ($this->input->post()) {
            $datos = $this->input->post();
            if($this->User_model->crear($datos)) {
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'CREATE',
                    'descripcion' => 'Se creó un nuevo usuario: ' . $datos['nombre']
                ]);
                redirect('admin/usuarios');
            }
        }

        $data['titulo'] = 'Crear Usuario';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/usuarios/crear');
        $this->load->view('admin/templates/footer');
    }

    public function editar_usuario($id) {
        if ($this->input->post()) {
            $datos = $this->input->post();
            if($this->User_model->actualizar($id, $datos)) {
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'UPDATE',
                    'descripcion' => 'Se actualizó el usuario: ' . $datos['nombre']
                ]);
                redirect('admin/usuarios');
            }
        }

        $data['titulo'] = 'Editar Usuario';
        $data['usuario'] = $this->User_model->get_user($id);
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/usuarios/editar', $data);
        $this->load->view('admin/templates/footer');
    }

    // Funciones para Mascotas
    public function mascotas() {
        $data['titulo'] = 'Gestión de Mascotas';
        $data['mascotas'] = $this->Mascota_model->get_all_mascotas();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/mascotas/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function crear_mascota() {
        if ($this->input->post()) {
            $datos = $this->input->post();
            if($this->Mascota_model->crear_mascota($datos)) {
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'CREATE',
                    'descripcion' => 'Se registró una nueva mascota: ' . $datos['nombre']
                ]);
                redirect('admin/mascotas');
            }
        }

        $data['titulo'] = 'Registrar Mascota';
        $data['usuarios'] = $this->User_model->get_all_users();
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/mascotas/crear', $data);
        $this->load->view('admin/templates/footer');
    }

    public function editar_mascota($id) {
        if ($this->input->post()) {
            $datos = $this->input->post();
            if($this->Mascota_model->actualizar_mascota($id, $datos)) {
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'UPDATE',
                    'descripcion' => 'Se actualizó la mascota: ' . $datos['nombre']
                ]);
                redirect('admin/mascotas');
            }
        }

        $data['titulo'] = 'Editar Mascota';
        $data['mascota'] = $this->Mascota_model->get_mascota($id);
        $data['usuarios'] = $this->User_model->get_all_users();
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/mascotas/editar', $data);
        $this->load->view('admin/templates/footer');
    }

    public function eliminar_mascota($id) {
        $mascota = $this->Mascota_model->get_mascota($id);
        if($this->Mascota_model->eliminar_mascota($id)) {
            $this->Actividad_model->registrar_actividad([
                'accion' => 'DELETE',
                'descripcion' => 'Se eliminó la mascota: ' . $mascota->nombre
            ]);
            redirect('admin/mascotas');
        }
    }
}