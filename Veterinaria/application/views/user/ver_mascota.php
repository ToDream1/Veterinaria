<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detalles de <?= $mascota->nombre ?></h5>
                    <div>
                        <a href="<?= base_url('index.php/user/editar_mascota/'.$mascota->id) ?>" class="btn btn-light btn-sm">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarModal">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">Información General</h6>
                            <dl class="row">
                                <dt class="col-sm-4">Especie</dt>
                                <dd class="col-sm-8"><?= $mascota->especie ?></dd>
                                
                                <dt class="col-sm-4">Raza</dt>
                                <dd class="col-sm-8"><?= $mascota->raza ?></dd>
                                
                                <dt class="col-sm-4">Sexo</dt>
                                <dd class="col-sm-8"><?= $mascota->sexo ?></dd>
                                
                                <dt class="col-sm-4">Color</dt>
                                <dd class="col-sm-8"><?= $mascota->color ?></dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Datos Físicos</h6>
                            <dl class="row">
                                <dt class="col-sm-4">Edad</dt>
                                <dd class="col-sm-8"><?= $mascota->edad_aproximada ?> años</dd>
                                
                                <dt class="col-sm-4">Peso</dt>
                                <dd class="col-sm-8"><?= $mascota->peso ?> kg</dd>
                                
                                <dt class="col-sm-4">Alergias</dt>
                                <dd class="col-sm-8"><?= $mascota->alergias_conocidas ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('index.php/user/mascotas') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmación para Eliminar -->
<div class="modal fade" id="eliminarModal" tabindex="-1">
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