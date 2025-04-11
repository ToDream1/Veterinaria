<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Mascotas Registradas</h3>
            <a href="<?= base_url('admin/crear_mascota') ?>" class="btn btn-success">Nueva Mascota</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Propietario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($mascotas)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay mascotas registradas</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($mascotas as $mascota): ?>
                                <tr>
                                    <td><?= $mascota->id ?></td>
                                    <td><?= $mascota->nombre ?></td>
                                    <td><?= $mascota->especie ?></td>
                                    <td><?= $mascota->raza ?></td>
                                    <td><?= $mascota->nombre_propietario ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/editar_mascota/'.$mascota->id) ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <a href="<?= base_url('admin/eliminar_mascota/'.$mascota->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta mascota?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>