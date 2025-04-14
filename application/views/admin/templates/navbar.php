<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">
            <i class="fas fa-paw me-2"></i> Veterinaria Municipal
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'usuarios' ? 'active' : '' ?>" href="<?= base_url('admin/usuarios') ?>">
                        <i class="fas fa-users me-1"></i> Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'mascotas' ? 'active' : '' ?>" href="<?= base_url('admin/mascotas') ?>">
                        <i class="fas fa-dog me-1"></i> Mascotas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'citas' ? 'active' : '' ?>" href="<?= base_url('admin/citas') ?>">
                        <i class="fas fa-calendar-check me-1"></i> Citas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'estadisticas' ? 'active' : '' ?>" href="<?= base_url('admin/estadisticas') ?>">
                        <i class="fas fa-chart-pie me-1"></i> Estadísticas
                    </a>
                </li>
                <!-- Nueva sección para Registro de Actividad -->
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'actividades' ? 'active' : '' ?>" href="<?= base_url('admin/actividades') ?>">
                        <i class="fas fa-history me-1"></i> Registro de Actividad
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- Modificar el botón de cerrar sesión en la barra de navegación -->
                    <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                        <i class="fas fa-sign-out-alt me-1"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- After the navbar but before the main content -->
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Continue with the rest of the navbar template -->