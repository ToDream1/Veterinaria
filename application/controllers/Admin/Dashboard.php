<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Load necessary models if any
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'administrador') {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = 'Panel Administrativo';
        
        // Load the template views in correct order
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/navbar');
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('admin/templates/footer');
    }
}