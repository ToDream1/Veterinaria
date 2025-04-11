<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['admin/dashboard'] = 'Admin/Dashboard';  // Changed to match controller name exactly
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
