<div class="container mt-4">
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
    
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Usuarios</h6>
                            <h2 class="mb-0">0</h2>
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
                            <h2 class="mb-0">0</h2>
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
                            <h2 class="mb-0">0</h2>
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
    
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Acciones Rápidas</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <a href="<?= base_url('admin/crear_usuario') ?>" class="btn btn-outline-primary w-100 py-3">
                        <i class="fas fa-user-plus mb-2 d-block fs-4"></i>
                        Nuevo Usuario
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="<?= base_url('admin/crear_mascota') ?>" class="btn btn-outline-success w-100 py-3">
                        <i class="fas fa-dog mb-2 d-block fs-4"></i>
                        Nueva Mascota
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="<?= base_url('admin/crear_cita') ?>" class="btn btn-outline-info w-100 py-3">
                        <i class="fas fa-calendar-plus mb-2 d-block fs-4"></i>
                        Nueva Cita
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-danger w-100 py-3">
                        <i class="fas fa-sign-out-alt mb-2 d-block fs-4"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>