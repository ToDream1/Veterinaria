<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Lista de Mascotas</h3>
            <a href="<?= base_url('recepcionista/mascotas/crear') ?>" class="btn btn-primary">
                <i class="fas fa-paw"></i> Nueva Mascota
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Edad</th>
                            <th>Propietario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mascotas as $mascota): ?>
                            <tr>
                                <td><?= $mascota->id ?></td>
                                <td><?= $mascota->nombre ?></td>
                                <td><?= $mascota->especie ?></td>
                                <td><?= $mascota->raza ?></td>
                                <td><?= $mascota->edad ?></td>
                                <td><?= $mascota->propietario_nombre . ' ' . $mascota->propietario_apellido ?></td>
                                <td>
                                    <a href="<?= base_url('recepcionista/mascotas/editar/'.$mascota->id) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('recepcionista/mascotas/ver/'.$mascota->id) ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>