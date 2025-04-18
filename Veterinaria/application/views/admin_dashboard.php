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
            <a class="navbar-brand" href="#">
                <i class="fas fa-paw me-2"></i>Veterinaria Municipal
            </a>
            <div class="d-flex">
                <span class="navbar-text me-3 text-white">
                    <i class="fas fa-user me-1"></i><?= $this->session->userdata('nombre') ?>
                </span>
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                </a>
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
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Usuarios</h5>
                        <p class="card-text">Administra los usuarios del sistema.</p>
                        <a href="#" class="btn btn-light">Ir a Usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Mascotas</h5>
                        <p class="card-text">Administra las mascotas registradas.</p>
                        <a href="#" class="btn btn-light">Ir a Mascotas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Citas</h5>
                        <p class="card-text">Administra las citas médicas.</p>
                        <a href="#" class="btn btn-light">Ir a Citas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>