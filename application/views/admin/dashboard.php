<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - Veterinaria Municipal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">
                <i class="fas fa-paw me-2"></i>Veterinaria Municipal
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= base_url('admin/dashboard') ?>">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/usuarios') ?>">
                            <i class="fas fa-users me-1"></i>Usuarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/mascotas') ?>">
                            <i class="fas fa-dog me-1"></i>Mascotas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('admin/citas') ?>">
                            <i class="fas fa-calendar-check me-1"></i>Citas
                        </a>
                    </li>
                </ul>
                <div class="d-flex">
                    <span class="navbar-text me-3 text-white">
                        <i class="fas fa-user me-1"></i><?= $this->session->userdata('nombre') ?>
                    </span>
                    <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

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
                        <a href="<?= base_url('admin/citas/crear') ?>" class="btn btn-primary">
                            <i class="fas fa-calendar-plus"></i> Crear Cita
                        </a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>
</html>