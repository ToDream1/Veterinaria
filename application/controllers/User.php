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
        $this->load->model('Actividad_model'); // Añadiendo el modelo de actividades
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
    
        $user_id = $this->session->userdata('id');
        $this->load->model('Usuario_model');
        $data['usuario'] = $this->Usuario_model->get_usuario($user_id);
    
        if (!$data['usuario']) {
            $this->session->set_flashdata('error', 'No se pudo cargar la información del usuario');
            redirect('user/index');
            return;
        }
        
        // Asegurarse de que el RUT esté disponible
        if (!isset($data['usuario']->rut) && $this->session->userdata('rut')) {
            $data['usuario']->rut = $this->session->userdata('rut');
        }
    
        $this->load->view('user/perfil_nuevo', $data);
    }

    public function editar_perfil() {
        // Obtener datos del usuario actual
        $usuario_id = $this->session->userdata('id');
        $data['usuario'] = $this->Usuario_model->get_usuario($usuario_id);
        
        if (!$data['usuario']) {
            $this->session->set_flashdata('error', 'No se pudo cargar la información del usuario');
            redirect('user/index');
            return;
        }
        
        // Asegurarse de que el RUT esté disponible
        if (!isset($data['usuario']->rut) && $this->session->userdata('rut')) {
            $data['usuario']->rut = $this->session->userdata('rut');
        }
        
        // Cargar solo la vista sin header ni navbar
        $this->load->view('user/editar_perfil', $data);
    }

    public function actualizar_perfil() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        if ($this->input->post()) {
            $id = $this->session->userdata('id');
            $datos = $this->input->post();
            
            // Asegurarse de usar el modelo User_model en lugar de Usuario_model
            $this->load->model('User_model'); // Cambiar esta línea si estabas usando Usuario_model
            
            // Validar que si se ingresa contraseña, no esté vacía
            if (isset($datos['password']) && !empty(trim($datos['password']))) {
                // Verificar que las contraseñas coincidan
                if ($datos['password'] !== $datos['confirm_password']) {
                    $this->session->set_flashdata('error', 'Las contraseñas no coinciden');
                    redirect('user/perfil');
                    return;
                }
                // Asegurarse de que la contraseña se hashee
                $datos['password'] = trim($datos['password']);
            } else {
                // Si la contraseña está vacía, no la actualizamos
                unset($datos['password']);
            }
            
            // Eliminar confirm_password antes de enviar al modelo
            unset($datos['confirm_password']);
            
            // Registrar la actividad con el nombre del usuario que realiza la acción
            $nombre_usuario = $this->session->userdata('nombre');
            $this->Actividad_model->registrar_actividad([
                'accion' => 'UPDATE',
                'descripcion' => 'Se actualizó el usuario: ' . $datos['nombre'],
                'usuario' => $nombre_usuario // Usar el nombre del usuario en lugar de 'Sistema'
            ]);
            
            if($this->User_model->actualizar($id, $datos)) {
                $this->session->set_flashdata('success', 'Perfil actualizado correctamente');
            } else {
                $this->session->set_flashdata('error', 'Error al actualizar el perfil');
            }
            redirect('user/perfil');
        }
    }

    public function eliminar_cuenta() {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }

        $id = $this->session->userdata('id');
        $usuario = $this->Usuario_model->get_usuario($id);

        if ($this->Usuario_model->eliminar($id)) {
            $this->Actividad_model->registrar_actividad([
                'accion' => 'DELETE',
                'descripcion' => 'El usuario eliminó su cuenta: ' . $usuario->nombre,
                'usuario' => $this->session->userdata('nombre')  // Nombre del usuario que realiza la acción
            ]);
            
            $this->session->sess_destroy();
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar la cuenta');
            redirect('user/perfil');
        }
    }

    public function nueva_mascota() {
        // Display the form
        $this->load->view('templates/header');
        $this->load->view('user/nueva_mascota');
        $this->load->view('templates/footer');
    }

    public function agregar_mascota() {
        if ($this->input->post()) {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'especie' => $this->input->post('especie'),
                'raza' => $this->input->post('raza'),
                'sexo' => $this->input->post('sexo'),
                'edad_aproximada' => $this->input->post('edad_aproximada'),
                'peso' => $this->input->post('peso'),
                'color' => $this->input->post('color'),
                'alergias_conocidas' => $this->input->post('alergias_conocidas') ?: 'Ninguna conocida',
                'usuario_id' => $this->session->userdata('id')
            );
            
            if ($this->Mascota_model->crear_mascota($data)) {
                $nombre_usuario = $this->session->userdata('nombre');
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'CREATE',
                    'descripcion' => 'El usuario registró una nueva mascota: ' . $data['nombre'],
                    'usuario' => $nombre_usuario
                ]);
                
                $this->session->set_flashdata('success', 'Mascota agregada exitosamente');
                redirect('user/mascotas');
            } else {
                $this->session->set_flashdata('error', 'Error al agregar la mascota');
                redirect('user/nueva_mascota');
            }
        } else {
            // Si no hay datos POST, mostrar el formulario
            $this->load->view('templates/header');
            $this->load->view('user/nueva_mascota');
            $this->load->view('templates/footer');
        }
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
                // Registrar la actividad con el nombre del usuario
                $nombre_usuario = $this->session->userdata('nombre');
                $this->Actividad_model->registrar_actividad([
                    'accion' => 'UPDATE',
                    'descripcion' => 'Se actualizó la mascota: ' . $update_data['nombre'],
                    'usuario' => $nombre_usuario
                ]);
                
                $this->session->set_flashdata('success', 'Mascota actualizada exitosamente');
                redirect('user/mascotas');
            }
            else {
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
    
    // Añadir cualquier otro método que necesites aquí
    
} // Esta es la llave de cierre que falta para la clase User