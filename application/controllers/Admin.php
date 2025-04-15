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

    public function actualizar_usuario($id) {
        if ($this->input->post()) {
            $datos = $this->input->post();
            
            if($this->User_model->actualizar($id, $datos)) {
                // Registrar la actividad con el nombre del administrador
                $nombre_admin = $this->session->userdata('nombre');
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'UPDATE',
                    'descripcion' => 'Se actualizó el usuario: ' . $datos['nombre'],
                    'usuario' => $nombre_admin
                ]);
                
                $this->session->set_flashdata('success', 'Usuario actualizado correctamente');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar el usuario');
            }
            redirect('admin/usuarios');
        }
    }

    public function eliminar_usuario($id) {
        // Obtener información del usuario antes de eliminarlo
        $usuario = $this->User_model->get_user_by_id($id);
        
        if (!$usuario) {
            $this->session->set_flashdata('error', 'El usuario no existe o ya ha sido eliminado');
            redirect('admin/usuarios');
        }
        
        // Intentar eliminar el usuario
        if ($this->User_model->eliminar($id)) {
            // Registrar la actividad con el nombre del administrador
            $nombre_admin = $this->session->userdata('nombre');
            $this->Actividad_model->registrar_actividad([
                'accion' => 'DELETE',
                'descripcion' => 'Se eliminó el usuario: ' . $usuario->nombre,
                'usuario' => $nombre_admin
            ]);
            
            $this->session->set_flashdata('success', 'Usuario eliminado correctamente');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar el usuario');
        }
        
        redirect('admin/usuarios');
    }

    public function crear_usuario() {
        if ($this->input->post()) {
            $datos = $this->input->post();
            
            if($this->User_model->crear($datos)) {
                // Registrar la actividad con el nombre del administrador
                $nombre_admin = $this->session->userdata('nombre');
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'CREATE',
                    'descripcion' => 'Se creó el usuario: ' . $datos['nombre'],
                    'usuario' => $nombre_admin
                ]);
                
                $this->session->set_flashdata('success', 'Usuario creado correctamente');
            } else {
                $this->session->set_flashdata('error', 'Error al crear el usuario');
            }
            redirect('admin/usuarios');
        }
    }

    public function editar_usuario($id) {
        if ($this->input->post()) {
            $datos = $this->input->post();
            
            // Verificar si se está cambiando la contraseña
            if (empty($datos['password'])) {
                unset($datos['password']);
            }
            
            try {
                if($this->User_model->actualizar($id, $datos)) {
                    // Try to register the activity, but don't let it stop the process if it fails
                    try {
                        $this->Actividad_model->registrar_actividad([
                            'accion' => 'UPDATE',
                            'descripcion' => 'Se actualizó el usuario: ' . $datos['nombre']
                        ]);
                    } catch (Exception $e) {
                        // Log the error but continue
                        log_message('error', 'Error registering activity: ' . $e->getMessage());
                    }
                    
                    $this->session->set_flashdata('success', 'Usuario actualizado correctamente');
                    // Make sure to use redirect with TRUE to preserve flashdata
                    redirect('admin/usuarios', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Error al actualizar el usuario');
                }
            } catch (Exception $e) {
                // Log the error and show a user-friendly message
                log_message('error', 'Error updating user: ' . $e->getMessage());
                $this->session->set_flashdata('error', 'Error al actualizar el usuario. Por favor, inténtelo de nuevo.');
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
        $data['title'] = 'Mascotas';
        $data['mascotas'] = $this->Mascota_model->get_all_mascotas();
        
        // Cambiar esta línea para usar un método que sí exista en tu modelo
        // En lugar de get_users_by_role, usamos get_all_users y filtramos por rol
        $data['propietarios'] = $this->User_model->get_all_users();
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar'); // Añadiendo esta línea para cargar el navbar
        $this->load->view('admin/mascotas/index', $data);
        $this->load->view('admin/templates/footer');
    }

    public function crear_mascota($propietario_id = null) {
        // Verificar si se proporcionó un ID de propietario
        if ($propietario_id === null) {
            $this->session->set_flashdata('error', 'Debe seleccionar un propietario para la mascota');
            redirect('admin/mascotas');
        }
        
        // Obtener datos del propietario
        $propietario = $this->User_model->get_user_by_id($propietario_id);
        if (!$propietario) {
            $this->session->set_flashdata('error', 'El propietario seleccionado no existe');
            redirect('admin/mascotas');
        }
        
        // Procesar el formulario si se envió
        if ($this->input->post()) {
            $datos = $this->input->post();
            
            // Asignar el ID del propietario
            $datos['usuario_id'] = $propietario_id;
            
            // Guardar la mascota
            if ($this->Mascota_model->crear_mascota($datos)) {
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'CREATE',
                    'descripcion' => 'Se creó una nueva mascota: ' . $datos['nombre']
                ]);
                $this->session->set_flashdata('success', 'Mascota creada correctamente');
                redirect('admin/mascotas');
            } else {
                $this->session->set_flashdata('error', 'Error al crear la mascota');
            }
        }
        
        // Cargar la vista con los datos del propietario
        $data['propietario'] = $propietario;
        $data['title'] = 'Crear Nueva Mascota';
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
                $this->session->set_flashdata('success', 'Mascota actualizada correctamente');
                redirect('admin/mascotas');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar la mascota');
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
        // Obtener información de la mascota antes de eliminarla
        $mascota = $this->Mascota_model->get_mascota($id);
        
        if (!$mascota) {
            $this->session->set_flashdata('error', 'La mascota no existe o ya ha sido eliminada');
            redirect('admin/mascotas');
        }
        
        // Intentar eliminar la mascota
        if ($this->Mascota_model->eliminar_mascota($id)) {
            // Registrar la actividad
            $this->Actividad_model->registrar_actividad([
                'accion' => 'DELETE',
                'descripcion' => 'Se eliminó la mascota: ' . $mascota->nombre
            ]);
            
            $this->session->set_flashdata('success', 'Mascota eliminada correctamente');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar la mascota');
        }
        
        redirect('admin/mascotas');
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
    // Asegúrate de que exista este método en tu controlador Admin
    // Modificar el método actividades para corregir la verificación de rol
    // En el método que maneja la página de actividades
    public function actividades($pagina = 1) {
        // Verificar que el usuario esté logueado (sin restricción de rol)
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        
        // Configurar la paginación
        $por_pagina = 8;
        
        // Obtener filtros de la URL
        $filtros = array(
            'descripcion' => $this->input->get('descripcion'),
            'accion' => $this->input->get('accion'),
            'fecha_desde' => $this->input->get('fecha_desde'),
            'fecha_hasta' => $this->input->get('fecha_hasta')
        );
        
        // Obtener el total de registros para la paginación
        $total_registros = $this->Actividad_model->contar_actividades_filtradas($filtros);
        
        // Configurar la paginación
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/actividades');
        $config['total_rows'] = $total_registros;
        $config['per_page'] = $por_pagina;
        $config['uri_segment'] = 3;
        $config['use_page_numbers'] = TRUE;
        
        // Estilo de la paginación con Bootstrap
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; Primera';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Última &raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        
        // Calcular el offset para la consulta
        $offset = ($pagina - 1) * $por_pagina;
        
        // Obtener actividades filtradas y paginadas
        $data['actividades'] = $this->Actividad_model->obtener_actividades_filtradas($filtros, $por_pagina, $offset);
        $data['acciones'] = $this->Actividad_model->obtener_acciones_unicas();
        $data['filtros'] = $filtros;
        $data['paginacion'] = $this->pagination->create_links();
        
        // Cargar vistas
        $data['titulo'] = 'Registro de Actividad';
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar', $data);
        $this->load->view('admin/actividades/index', $data);
        $this->load->view('admin/templates/footer');
    }
    
    // Añadir este método para el filtro en tiempo real
    public function obtener_todas_actividades() {
        // Verificar solo que el usuario esté logueado
        if (!$this->session->userdata('logged_in')) {
            $this->output->set_status_header(403);
            echo json_encode(['error' => 'No autorizado']);
            return;
        }
        
        $this->load->model('Actividad_model');
        $this->load->model('User_model');
        $actividades = $this->Actividad_model->get_all_actividades();
        
        // Preparar datos para JSON
        $datos = [];
        foreach ($actividades as $actividad) {
            $usuario = null;
            if (!empty($actividad->usuario_id)) {
                $usuario = $this->User_model->get_user_by_id($actividad->usuario_id);
            }
            
            $datos[] = [
                'id' => $actividad->id,
                'fecha' => $actividad->fecha,
                'usuario_id' => $actividad->usuario_id,
                'nombre_usuario' => $usuario ? $usuario->nombre : 'Sistema',
                'accion' => $actividad->accion,
                'descripcion' => $actividad->descripcion
            ];
        }
        
        $this->output->set_content_type('application/json');
        echo json_encode($datos);
    }
    public function citas() {
        $data['titulo'] = 'Gestión de Citas';
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/citas/index');
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
    
    public function buscar_usuarios() {
        // Check if this is an AJAX request
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        
        $query = $this->input->post('query');
        $this->load->model('User_model');
        $usuarios = $this->User_model->buscar_usuarios_por_nombre($query);
        
        echo json_encode($usuarios);
    }
}