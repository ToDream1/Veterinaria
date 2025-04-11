<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="<?= base_url('index.php/user/index') ?>" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <h2><i class="bi bi-calendar"></i> Mis Citas</h2>
        <div></div>
    </div>

    <!-- Tarjeta de Próximamente -->
    <div class="card text-center shadow-sm my-5">
        <div class="card-body py-5">
            <i class="fas fa-clock text-primary mb-3" style="font-size: 4rem;"></i>
            <h3 class="card-title mb-3">Próximamente</h3>
            <p class="card-text text-muted">
                Esta función estará disponible en futuras actualizaciones.
            </p>
        </div>
    </div>
</div>

<!-- Custom Navbar for Mobile -->
<nav class="navbar fixed-bottom navbar-light bg-white shadow-lg d-block d-md-none">
    <div class="container-fluid justify-content-around">
        <a class="nav-link" href="<?= base_url('index.php/user') ?>">
            <i class="bi bi-house-door-fill"></i>
        </a>
        <a class="nav-link" href="<?= base_url('index.php/user/mascotas') ?>">
            <i class="bi bi-heart-fill text-danger"></i>
        </a>
        <a class="nav-link active" href="<?= base_url('index.php/user/citas') ?>">
            <i class="bi bi-calendar-check text-primary"></i>
        </a>
        <a class="nav-link" href="<?= base_url('index.php/user/historial') ?>">
            <i class="bi bi-journal-medical text-success"></i>
        </a>
        <a class="nav-link" href="<?= base_url('index.php/user/mapa') ?>">
            <i class="bi bi-geo-alt-fill text-info"></i>
        </a>
        <a class="nav-link" href="<?= base_url('index.php/user/perfil') ?>">
            <i class="bi bi-person-fill text-primary"></i>
        </a>
    </div>
</nav>