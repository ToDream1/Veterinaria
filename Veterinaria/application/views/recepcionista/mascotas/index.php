<div class="container mt-4">
    <h2><?= $titulo ?></h2>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <a href="<?= base_url('recepcionista/crear_mascota') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Nueva Mascota
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Color</th>
                            <th>Edad</th>
                            <th>Peso</th>
                            <th>Propietario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($mascotas)): ?>
                            <?php foreach($mascotas as $mascota): ?>
                                <tr>
                                    <td><?= $mascota->nombre ?></td>
                                    <td><?= $mascota->especie ?></td>
                                    <td><?= $mascota->raza ?></td>
                                    <td><?= $mascota->color ?></td>
                                    <td><?= $mascota->edad_aproximada ?> años</td>
                                    <td><?= $mascota->peso ?> kg</td>
                                    <td><?= $mascota->nombre_propietario ?></td>
                                    <td>
                                        <a href="<?= base_url('recepcionista/editar_mascota/' . $mascota->id) ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">No hay mascotas registradas</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>