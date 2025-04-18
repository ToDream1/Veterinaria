<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('index.php/user') ?>">Veterinaria</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'mascotas' ? 'active' : '' ?>" 
                       href="<?= base_url('index.php/user/mascotas') ?>">Mis Mascotas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'citas' ? 'active' : '' ?>" 
                       href="<?= base_url('index.php/user/citas') ?>">Mis Citas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'historial' ? 'active' : '' ?>" 
                       href="<?= base_url('index.php/user/historial') ?>">Historial</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= $this->uri->segment(2) == 'perfil' ? 'active' : '' ?>" 
                       href="<?= base_url('index.php/user/perfil') ?>">
                       <i class="fas fa-user"></i> Mi Perfil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('index.php/auth/logout') ?>">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>