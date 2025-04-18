<div class="container mt-4">
    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2><?= $mascota->nombre ?></h2>
                <a href="<?= base_url('index.php/user/mascotas') ?>" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Volver
                </a>
            </div>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Especie:</strong></div>
                        <div class="col-md-8"><?= $mascota->especie ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Raza:</strong></div>
                        <div class="col-md-8"><?= $mascota->raza ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Sexo:</strong></div>
                        <div class="col-md-8"><?= $mascota->sexo ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Edad:</strong></div>
                        <div class="col-md-8"><?= $mascota->edad_aproximada ?> años</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Color:</strong></div>
                        <div class="col-md-8"><?= $mascota->color ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Alergias:</strong></div>
                        <div class="col-md-8"><?= $mascota->alergias_conocidas ?: 'Ninguna registrada' ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>