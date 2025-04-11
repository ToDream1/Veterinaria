<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Usuario_model');
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
            return;
        }
        
        // Verificar que sea un usuario normal y tenga rol definido
        if($this->session->userdata('role') === 'administrador') {
            redirect('admin/dashboard');
            return;
        }
        
        $this->load->model('Mascota_model');
    }

    public function index() {
        $this->load->view('templates/header');
        $this->load->view('user/index');
        $this->load->view('templates/footer');
    }
    
    public function mascotas() {
        $this->load->model('Mascota_model');
        $usuario_id = $this->session->userdata('id');
        
        $data['mascotas'] = $this->Mascota_model->get_mascotas_by_usuario($usuario_id);
        
        $this->load->view('templates/header');
        $this->load->view('user/mascotas', $data);
        $this->load->view('templates/footer');
    }

    public function citas() {
        $this->load->view('templates/header');
        $this->load->view('user/citas');
        $this->load->view('templates/footer');
    }

    public function historial() {
        $this->load->view('templates/header');
        $this->load->view('user/historial');
        $this->load->view('templates/footer');
    }

    public function mapa() {
        // Cargar directamente la vista sin el template
        $this->load->view('user/mapa');
    }

    public function perfil() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
            return;
        }
    
        $user_id = $this->session->userdata('id'); // Cambiado de user_id a id
        $this->load->model('Usuario_model');
        $data['usuario'] = $this->Usuario_model->get_usuario($user_id); // Usando get_usuario en lugar de get_usuario_by_id
    
        if (!$data['usuario']) {
            $this->session->set_flashdata('error', 'No se pudo cargar la información del usuario');
            redirect('user/index');
            return;
        }
    
        $this->load->view('user/perfil_nuevo', $data);
    }

    public function editar_perfil() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
            return;
        }

        $usuario_id = $this->session->userdata('id');
        $this->load->model('Usuario_model');

        if ($this->input->method() === 'post') {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'email' => $this->input->post('email'),
                'telefono' => $this->input->post('telefono'),
                'direccion' => $this->input->post('direccion')
            );

            if ($this->Usuario_model->actualizar_usuario($usuario_id, $data)) {
                $this->session->set_flashdata('success', 'Perfil actualizado correctamente');
                redirect('user/perfil');
                return;
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar el perfil');
            }
        }

        $data['usuario'] = $this->Usuario_model->get_usuario($usuario_id);
        $this->load->view('templates/header');
        $this->load->view('user/editar_perfil', $data);
        $this->load->view('templates/footer');
    }

    public function actualizar_perfil() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $usuario_id = $this->session->userdata('id');
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'email' => $this->input->post('email'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion')
        );

        if ($this->Usuario_model->actualizar_usuario($usuario_id, $data)) {
            $this->session->set_flashdata('success', 'Datos actualizados correctamente');
        } else {
            $this->session->set_flashdata('error', 'Error al actualizar los datos');
        }

        redirect('user/perfil');
    }

    public function nueva_mascota() {
        // Display the form
        $this->load->view('templates/header');
        $this->load->view('user/nueva_mascota');
        $this->load->view('templates/footer');
    }

    public function agregar_mascota() {
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') === 'admin') {
            redirect('auth/login');
        }

        if ($this->input->method() == 'post') {
            // Obtener el ID del usuario de la sesión
            $usuario_id = $this->session->userdata('id');
            
            if (!$usuario_id) {
                $this->session->set_flashdata('error', 'Error de sesión');
                redirect('auth/login');
            }
            
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'especie' => $this->input->post('especie'),
                'raza' => $this->input->post('raza'),
                'sexo' => $this->input->post('sexo'),
                'edad_aproximada' => $this->input->post('edad_aproximada'),
                'peso' => $this->input->post('peso'),
                'color' => $this->input->post('color'),
                'alergias_conocidas' => $this->input->post('alergias_conocidas') ?: 'Ninguna conocida',
                'usuario_id' => $usuario_id,
                'created_at' => date('Y-m-d H:i:s')
            );

            if ($this->Mascota_model->agregar_mascota($data)) {
                $this->session->set_flashdata('success', 'Mascota agregada exitosamente');
                redirect('user/mascotas');
            } else {
                $this->session->set_flashdata('error', 'Error al agregar la mascota');
                redirect('user/nueva_mascota');
            }
        }
    }

    public function ver_mascota($id) {
        $data['mascota'] = $this->Mascota_model->get_mascota($id);
        
        // Verificar que la mascota exista y pertenezca al usuario
        if (!$data['mascota'] || $data['mascota']->usuario_id != $this->session->userdata('id')) {
            $this->session->set_flashdata('error', 'Mascota no encontrada');
            redirect('user/mascotas');
        }

        $this->load->view('templates/header');
        $this->load->view('user/ver_mascota', $data);
        $this->load->view('templates/footer');
    }

    public function editar_mascota($id) {
        // Agregar debug para verificar los datos
        $data['mascota'] = $this->Mascota_model->get_mascota($id);
        
        if ($this->input->method() == 'post') {
            $update_data = array(
                'nombre' => $this->input->post('nombre'),
                'especie' => $this->input->post('especie'),
                'raza' => $this->input->post('raza'),
                'sexo' => $this->input->post('sexo'),
                'edad_aproximada' => $this->input->post('edad_aproximada'),
                'peso' => $this->input->post('peso'),
                'color' => $this->input->post('color'),
                'alergias_conocidas' => $this->input->post('alergias_conocidas') ?: 'Ninguna conocida'
            );

            // Agregar log para debug
            log_message('debug', 'Actualizando mascota: ' . print_r($update_data, true));

            if ($this->Mascota_model->actualizar_mascota($id, $update_data)) {
                $this->session->set_flashdata('success', 'Mascota actualizada exitosamente');
                redirect('user/mascotas');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar la mascota');
                redirect('user/editar_mascota/' . $id);
            }
        }

        $this->load->view('templates/header');
        $this->load->view('user/editar_mascota', $data);
        $this->load->view('templates/footer');
    }

    public function eliminar_mascota($id) {
        $mascota = $this->Mascota_model->get_mascota($id);
        
        // Verificar que la mascota exista y pertenezca al usuario actual
        if (!$mascota || $mascota->usuario_id != $this->session->userdata('id')) {
            $this->session->set_flashdata('error', 'No tienes permiso para eliminar esta mascota');
            redirect('user/mascotas');
            return;
        }

        if ($this->Mascota_model->eliminar_mascota($id)) {
            $this->session->set_flashdata('success', 'Mascota eliminada exitosamente');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar la mascota');
            log_message('error', 'Error al eliminar mascota: ' . $this->db->error()['message']);
        }
        
        redirect('user/mascotas');
    }
    
    public function debug_session() {
        echo "<pre>";
        print_r($this->session->userdata());
        echo "\nID de usuario: " . $this->session->userdata('id');
        echo "\nLogged in: " . ($this->session->userdata('logged_in') ? 'true' : 'false');
        echo "</pre>";
        die();
    }
}