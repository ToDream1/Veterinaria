<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Veterinario extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->check_role(['veterinario']);
    }

    public function index() {
        $data['titulo'] = 'Panel Veterinario';
        $this->load->view('veterinario/templates/header', $data);
        $this->load->view('veterinario/templates/navbar');
        $this->load->view('veterinario/dashboard/index');
        $this->load->view('veterinario/templates/footer');
    }
}