<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['admin/dashboard'] = 'admin';  // Redirige admin/dashboard a admin
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
