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
        
        // Eliminar estas líneas de valores estáticos
        // $data['total_usuarios'] = 5; 
        // $data['total_mascotas'] = 10;
        // $data['total_citas'] = 3;
        
        // Los modelos ya están cargados en el constructor, no es necesario cargarlos de nuevo
        // $this->load->model('User_model');
        // $this->load->model('Mascota_model');
        
        // Obtener los datos reales de la base de datos
        $data['total_usuarios'] = $this->User_model->count_users();
        $data['total_mascotas'] = $this->Mascota_model->count_mascotas();
        $data['total_citas'] = 0; // Por ahora dejamos esto en 0
        
        // Comentamos esto por ahora si no está implementado
        // $data['actividades'] = $this->Actividad_model->obtener_actividades();
        $data['actividades'] = [];
        
        // ELIMINAR ESTAS LÍNEAS - están sobrescribiendo los valores reales con ceros
        // $data['total_usuarios'] = 0;
        // $data['total_mascotas'] = 0;
        
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
            
            // Verificar si se está cambiando la contraseña
            if (empty($datos['password'])) {
                unset($datos['password']);
            }
            
            if($this->User_model->actualizar($id, $datos)) {
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'UPDATE',
                    'descripcion' => 'Se actualizó el usuario: ' . $datos['nombre']
                ]);
                $this->session->set_flashdata('success', 'Usuario actualizado correctamente');
                redirect('admin/usuarios');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar el usuario');
            }
        }

        $data['titulo'] = 'Editar Usuario';
        $data['usuario'] = $this->User_model->get_user_by_id($id);
        
        if (!$data['usuario']) {
            $this->session->set_flashdata('error', 'Usuario no encontrado');
            redirect('admin/usuarios');
        }
        
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
    
    // Añadir este método al controlador Admin
    // Cambiar de private a public para que sea accesible desde la vista
    public function get_badge_color($accion) {
        switch(strtoupper($accion)) {
            case 'CREATE':
                return 'bg-success';
            case 'UPDATE':
                return 'bg-warning';
            case 'DELETE':
                return 'bg-danger';
            case 'LOGIN':
                return 'bg-info';
            case 'LOGOUT':
                return 'bg-secondary';
            default:
                return 'bg-secondary';
        }
    }
    public function actividades() {
        $data['titulo'] = 'Registro de Actividad';
        
        // Cargar el modelo de actividades
        $this->load->model('Actividad_model');
        
        // Obtener todas las actividades ordenadas por fecha descendente (más recientes primero)
        $data['actividades'] = $this->Actividad_model->obtener_actividades();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/actividades/index', $data);
        $this->load->view('admin/templates/footer');
    }
    public function estadisticas() {
        $data['titulo'] = 'Estadísticas del Sistema';
        
        // Cargar datos para los gráficos
        $data['mascotas'] = $this->Mascota_model->get_all_mascotas();
        $data['usuarios'] = $this->User_model->get_all_users();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/estadisticas/index', $data);
        $this->load->view('admin/templates/footer');
    }
}