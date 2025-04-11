

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="<?= base_url('index.php/user/index') ?>" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
        <h2><i class="bi bi-heart-fill text-danger"></i> Mis Mascotas</h2>
        <a href="<?= base_url('index.php/user/nueva_mascota') ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Agregar Mascota
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($mascotas as $mascota): ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-emoji-smile fs-4 text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0"><?= $mascota->nombre ?></h5>
                            <p class="text-muted mb-0"><?= $mascota->especie ?></p>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="p-2 bg-light rounded">
                                <small class="text-muted d-block">Raza</small>
                                <strong><?= $mascota->raza ?></strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded">
                                <small class="text-muted d-block">Edad</small>
                                <strong><?= $mascota->edad_aproximada ?> años</strong>
                            </div>
                        </div>
                    </div>

                    <p class="card-text mb-3">
                        <small class="text-muted">Color: </small>
                        <span class="badge bg-light text-dark"><?= $mascota->color ?></span>
                    </p>

                    <div class="d-flex gap-2">
                        <a href="<?= base_url('index.php/user/ver_mascota/'.$mascota->id) ?>" class="btn btn-sm btn-outline-primary flex-grow-1">
                            <i class="bi bi-eye"></i> Detalles
                        </a>
                        <a href="<?= base_url('index.php/user/editar_mascota/'.$mascota->id) ?>" class="btn btn-sm btn-outline-secondary flex-grow-1">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-danger flex-grow-1" data-bs-toggle="modal" data-bs-target="#eliminarModal<?= $mascota->id ?>">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmación para Eliminar -->
        <div class="modal fade" id="eliminarModal<?= $mascota->id ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro que desea eliminar a <?= $mascota->nombre ?>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <a href="<?= base_url('index.php/user/eliminar_mascota/'.$mascota->id) ?>" class="btn btn-danger">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Custom Navbar for Mobile -->
<nav class="navbar fixed-bottom navbar-light bg-white shadow-lg d-block d-md-none">
    <div class="container-fluid justify-content-around">
        <a class="nav-link" href="<?= base_url('index.php/user') ?>">
            <i class="bi bi-house-door-fill"></i>
        </a>
        <a class="nav-link active" href="<?= base_url('index.php/user/mascotas') ?>">
            <i class="bi bi-heart-fill text-danger"></i>
        </a>
        <a class="nav-link" href="<?= base_url('index.php/user/citas') ?>">
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