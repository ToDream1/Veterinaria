<div class="container mt-4">
    <!-- Remove the flash message code from here -->
    
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="mb-3">Panel Administrativo</h1>
                    <div class="alert alert-success">
                        <h4 class="alert-heading">¡Bienvenido, <?= $this->session->userdata('nombre') ?>!</h4>
                        <p class="mb-0">Has iniciado sesión como administrador en el sistema de la Veterinaria Municipal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Rest of the dashboard content remains unchanged -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Usuarios</h6>
                            <h2 class="mb-0"><?= isset($total_usuarios) ? $total_usuarios : 0 ?></h2>
                        </div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?= base_url('admin/usuarios') ?>" class="text-white">Ver detalles</a>
                    <i class="fas fa-angle-right text-white"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Mascotas</h6>
                            <h2 class="mb-0"><?= isset($total_mascotas) ? $total_mascotas : 0 ?></h2>
                        </div>
                        <i class="fas fa-paw fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?= base_url('admin/mascotas') ?>" class="text-white">Ver detalles</a>
                    <i class="fas fa-angle-right text-white"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Citas</h6>
                            <h2 class="mb-0"><?= isset($total_citas) ? $total_citas : 0 ?></h2>
                        </div>
                        <i class="fas fa-calendar-check fa-2x"></i>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a href="<?= base_url('admin/citas') ?>" class="text-white">Ver detalles</a>
                    <i class="fas fa-angle-right text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Añadir botones para crear nuevos usuarios y mascotas -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('admin/crear_usuario') ?>" class="card text-center p-3 text-decoration-none btn-hover-effect text-primary">
                                <div class="mb-2">
                                    <i class="fas fa-user-plus fa-3x"></i>
                                </div>
                                <div>Nuevo Usuario</div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('admin/crear_mascota') ?>" class="card text-center p-3 text-decoration-none btn-hover-effect text-success">
                                <div class="mb-2">
                                    <i class="fas fa-paw fa-3x"></i>
                                </div>
                                <div>Nueva Mascota</div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('admin/crear_cita') ?>" class="card text-center p-3 text-decoration-none btn-hover-effect text-info">
                                <div class="mb-2">
                                    <i class="fas fa-calendar-plus fa-3x"></i>
                                </div>
                                <div>Nueva Cita</div>
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="<?= base_url('auth/logout') ?>" class="card text-center p-3 text-decoration-none btn-hover-effect text-danger">
                                <div class="mb-2">
                                    <i class="fas fa-sign-out-alt fa-3x"></i>
                                </div>
                                <div>Cerrar Sesión</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar estilos personalizados al final del archivo -->
    <style>
        .hover-white:hover {
            color: white !important;
        }
        
        /* Estilos para el efecto hover en los botones de acción rápida */
        .btn-hover-effect {
            transition: all 0.3s ease;
        }
        
        .btn-hover-effect:hover {
            color: white !important;
        }
        
        .btn-hover-effect.text-primary:hover {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        
        .btn-hover-effect.text-success:hover {
            background-color: #198754;
            border-color: #198754;
        }
        
        .btn-hover-effect.text-info:hover {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
        }
        
        .btn-hover-effect.text-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
</div>