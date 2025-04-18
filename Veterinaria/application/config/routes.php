<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['admin/dashboard'] = 'admin';  // Redirige admin/dashboard a admin
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Asegúrate de que existan estas rutas
$route['admin/actividades'] = 'admin/actividades';
$route['admin/obtener_todas_actividades'] = 'admin/obtener_todas_actividades';
