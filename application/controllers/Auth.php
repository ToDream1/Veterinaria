<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        if($this->session->userdata('logged_in')) {
            if($this->session->userdata('role') === 'administrador') {
                redirect('admin');  // Cambiado de 'admin/dashboard' a 'admin'
            } else {
                redirect('user/index');
            }
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $rut = $this->input->post('rut');
        $password = $this->input->post('password');
        
        $result = $this->User_model->login($rut, $password);
        
        if(is_object($result)) {
            $userdata = array(
                'id' => $result->id,
                'rut' => $result->rut,
                'email' => $result->email,
                'nombre' => $result->nombre,
                'role' => $result->role,
                'logged_in' => TRUE
            );
            
            $this->session->set_userdata($userdata);
            
            if($result->role === 'administrador') {
                redirect('admin');  // Cambiado de 'admin/dashboard' a 'admin'
            } else {
                redirect('user/index');
            }
        } else {
            $mensaje_error = $result === 'rut_invalido' ? 'El RUT ingresado no existe en nuestros registros' : 'La contraseña ingresada es incorrecta';
            $this->session->set_flashdata('error', $mensaje_error);
            redirect('auth');
        }
    }

    public function register() {
        if($this->input->method() === 'post') {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('rut', 'RUT', 'required|is_unique[users.rut]');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('direccion', 'Dirección', 'required');
            $this->form_validation->set_rules('telefono', 'Teléfono', 'required');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirmar Contraseña', 'required|matches[password]');
            
            if($this->form_validation->run()) {
                $datos = array(
                    'rut' => $this->input->post('rut'),
                    'nombre' => $this->input->post('nombre'),
                    'email' => $this->input->post('email'),
                    'direccion' => $this->input->post('direccion'),
                    'telefono' => $this->input->post('telefono'),
                    'password' => $this->input->post('password'),
                    'role' => 'usuario'  // Este está correcto, lo dejamos así
                );
                
                if($this->User_model->crear($datos)) {
                    $this->session->set_flashdata('success', 'Usuario registrado exitosamente. Por favor inicia sesión.');
                    redirect('auth');
                } else {
                    $this->session->set_flashdata('error', 'Error al registrar el usuario. Por favor intenta nuevamente.');
                    redirect('auth/register');
                }
            } else {
                $this->session->set_flashdata('error', validation_errors());
                redirect('auth/register');
            }
        }
        
        $this->load->view('auth/register');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}