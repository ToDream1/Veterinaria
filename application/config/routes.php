<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['admin/dashboard'] = 'admin';  // Redirige admin/dashboard a admin
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Asegúrate de que existan estas rutas
$route['admin/actividades'] = 'admin/actividades';
$route['admin/obtener_todas_actividades'] = 'admin/obtener_todas_actividades';
$route['admin/nueva_cita'] = 'admin/nueva_cita';
$route['recepcionista/usuarios'] = 'recepcionista/usuarios/index';
$route['recepcionista/usuarios/editar/(:num)'] = 'recepcionista/usuarios/editar/$1';
$route['recepcionista/usuarios/actualizar/(:num)'] = 'recepcionista/usuarios/actualizar/$1';
$route['recepcionista/usuarios/editar/(:num)'] = 'recepcionista/usuarios/editar/$1';
$route['recepcionista/usuarios/actualizar/(:num)'] = 'recepcionista/usuarios/actualizar/$1';
$route['admin/citas/crear'] = 'admin/citas/crear';
