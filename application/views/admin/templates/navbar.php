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
                    <a class="nav-link <?= $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>" 
                       href="<?= base_url('admin/dashboard') ?>">
                        <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'usuarios' ? 'active' : '' ?>" 
                       href="<?= base_url('admin/usuarios') ?>">
                        <i class="fas fa-users me-1"></i>Usuarios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'mascotas' ? 'active' : '' ?>" 
                       href="<?= base_url('admin/mascotas') ?>">
                        <i class="fas fa-dog me-1"></i>Mascotas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'citas' ? 'active' : '' ?>" 
                       href="<?= base_url('admin/citas') ?>">
                        <i class="fas fa-calendar-alt me-1"></i>Citas
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>