<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Mascotas Registradas</h3>
            <a href="<?= base_url('admin/crear_mascota') ?>" class="btn btn-primary">Nueva Mascota</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Sexo</th>
                            <th>Edad</th>
                            <th>Color</th>
                            <th>Alergias</th>
                            <th>Propietario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($mascotas as $mascota): ?>
                            <tr>
                                <td><?= $mascota->id ?></td>
                                <td><?= $mascota->nombre ?></td>
                                <td><?= $mascota->especie ?></td>
                                <td><?= $mascota->raza ?></td>
                                <td><?= $mascota->sexo ?></td>
                                <td><?= $mascota->edad_aproximada ?></td>
                                <td><?= $mascota->color ?></td>
                                <td><?= $mascota->alergias_conocidas ?></td>
                                <td><?= $mascota->usuario_id ?></td>
                                <td>
                                    <a href="<?= base_url('admin/editar_mascota/'.$mascota->id) ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="<?= base_url('admin/eliminar_mascota/'.$mascota->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>