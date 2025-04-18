<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recepcionista extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        // Verificar si el usuario está logueado y es recepcionista
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        if ($this->session->userdata('role') !== 'recepcionista') {
            $this->session->set_flashdata('error', 'No tienes permiso para acceder a esta sección');
            redirect($this->session->userdata('role'));
        }
        
        $this->load->model('User_model');
        $this->load->model('Mascota_model');
        
        // Cargar datos para el navbar
        $data['usuarios'] = $this->User_model->get_all_users();
        $data['total_usuarios'] = count($data['usuarios']);
        $data['mascotas'] = $this->Mascota_model->get_all_mascotas();
        $data['total_mascotas'] = count($data['mascotas']);
        
        $this->load->vars($data);
    }

    public function index() {
        $data['titulo'] = 'Panel de Recepción';
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcion/dashboard/index', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function mascotas() {
        $data['titulo'] = 'Gestión de Mascotas';
        $data['mascotas'] = $this->Mascota_model->get_all_mascotas();
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/mascotas/index', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function usuarios() {
        $data['titulo'] = 'Gestión de Usuarios';
        $data['usuarios'] = $this->User_model->get_all_users();
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/usuarios/index', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function citas() {
        $data['titulo'] = 'Gestión de Citas';
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/citas/index', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function crear_mascota() {
        $data['titulo'] = 'Registrar Nueva Mascota';
        $data['propietarios'] = $this->User_model->get_all_users();
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/mascotas/crear', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function guardar_mascota() {
        if ($this->input->post()) {
            $datos = array(
                'nombre' => $this->input->post('nombre'),
                'especie' => $this->input->post('especie'),
                'raza' => $this->input->post('raza'),
                'color' => $this->input->post('color'),
                'edad_aproximada' => $this->input->post('edad_aproximada'),
                'peso' => $this->input->post('peso'),
                'usuario_id' => $this->input->post('usuario_id'),
                'alergias_conocidas' => $this->input->post('alergias_conocidas')
            );
            
            if ($this->Mascota_model->crear_mascota($datos)) {
                $this->session->set_flashdata('success', 'Mascota registrada correctamente');
            } else {
                $this->session->set_flashdata('error', 'Error al registrar la mascota');
            }
        }
        redirect('recepcionista/mascotas');
    }

    public function crear_usuario() {
        $data['titulo'] = 'Registrar Nuevo Usuario';
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/usuarios/crear', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function guardar_usuario() {
        if ($this->input->post()) {
            $datos = $this->input->post();
            $datos['role'] = 'usuario'; // Aseguramos que se registre como usuario normal
            
            if ($this->User_model->crear($datos)) {
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'CREATE',
                    'descripcion' => 'Se registró un nuevo usuario: ' . $datos['nombre']
                ]);
                $this->session->set_flashdata('success', 'Usuario registrado correctamente');
            } else {
                $this->session->set_flashdata('error', 'Error al registrar el usuario');
            }
        }
        redirect('recepcionista/usuarios');
    }

    public function editar_mascota($id) {
        $data['titulo'] = 'Editar Mascota';
        $data['mascota'] = $this->Mascota_model->get_mascota($id);
        $data['propietarios'] = $this->User_model->get_all_users();
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/mascotas/editar', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function actualizar_mascota() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $datos = array(
                'nombre' => $this->input->post('nombre'),
                'especie' => $this->input->post('especie'),
                'raza' => $this->input->post('raza'),
                'color' => $this->input->post('color'),
                'edad_aproximada' => $this->input->post('edad_aproximada'),
                'peso' => $this->input->post('peso'),
                'usuario_id' => $this->input->post('usuario_id'),
                'alergias_conocidas' => $this->input->post('alergias_conocidas')
            );
            
            if ($this->Mascota_model->actualizar_mascota($id, $datos)) {
                $this->session->set_flashdata('success', 'Mascota actualizada correctamente');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar la mascota');
            }
        }
        redirect('recepcionista/mascotas');
    }

    public function editar_usuario($id) {
        $data['titulo'] = 'Editar Usuario';
        $data['usuario'] = $this->User_model->get_user($id);
        
        $this->load->view('recepcionista/templates/header', $data);
        $this->load->view('recepcionista/templates/navbar');
        $this->load->view('recepcionista/usuarios/editar', $data);
        $this->load->view('recepcionista/templates/footer');
    }

    public function actualizar_usuario() {
        if ($this->input->post()) {
            $id = $this->input->post('id');
            $datos = array(
                'nombre' => $this->input->post('nombre'),
                'email' => $this->input->post('email'),
                'telefono' => $this->input->post('telefono'),
                'direccion' => $this->input->post('direccion')
            );
            
            if ($this->User_model->actualizar_usuario($id, $datos)) {
                $this->session->set_flashdata('success', 'Usuario actualizado correctamente');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar el usuario');
            }
        }
        redirect('recepcionista/usuarios');
    }
}