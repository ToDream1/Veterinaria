

<div class="container mt-4">
    <h2 class="text-center">Mis Mascotas</h2>
    
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

    <style>
        .btn-custom {
            color: #007bff;
            border: 1px solid #007bff;
            background-color: transparent;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-custom:hover {
            background-color: #007bff;
            color: #fff;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
    </style>
    <a href="<?= base_url('user/index') ?>" class="btn btn-custom mb-3">
        <i class="fas fa-arrow-left me-1"></i> Volver
    </a>
    <div class="row">
        <?php if(!empty($mascotas)): ?>
            <?php foreach($mascotas as $mascota): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if(isset($mascota->foto) && !empty($mascota->foto)): ?>
                            <img src="<?= base_url('uploads/mascotas/' . $mascota->foto) ?>" 
                                 class="card-img-top" 
                                 alt="Foto de <?= $mascota->nombre ?>">
                        <?php else: ?>
                            <div class="text-center p-3 bg-light">
                                <i class="fas fa-camera fa-3x text-muted mb-2"></i>
                                <p class="text-muted">Sube una foto de tu mascota</p>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= $mascota->nombre ?></h5>
                            <p class="card-text"><strong>Especie:</strong> <?= $mascota->especie ?></p>
                            <p class="card-text"><strong>Raza:</strong> <?= $mascota->raza ?></p>
                            <p class="card-text"><strong>Color:</strong> <?= $mascota->color ?></p>
                            <p class="card-text"><strong>Edad:</strong> <?= $mascota->edad_aproximada ?> años</p>
                            <p class="card-text"><strong>Peso:</strong> <?= $mascota->peso ?> kg</p>
                            <p class="card-text"><strong>Alergias:</strong> <?= $mascota->alergias_conocidas ?></p>
                            <form action="<?= base_url('user/subir_foto/' . $mascota->id) ?>" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input type="file" name="foto" class="form-control" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-camera me-2"></i>Actualizar Foto
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No tienes mascotas registradas
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>