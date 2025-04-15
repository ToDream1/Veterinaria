<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Lista de Usuarios</h3>
            <a href="<?= base_url('recepcionista/usuarios/crear') ?>" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Nuevo Usuario
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= $usuario->id ?></td>
                                <td><?= $usuario->rut ?></td>
                                <td><?= $usuario->nombre ?></td>
                                <td><?= $usuario->email ?></td>
                                <td><?= $usuario->direccion ?></td>
                                <td><?= $usuario->telefono ?></td>
                                <td>
                                    <a href="<?= base_url('index.php/recepcionista/usuarios/editar/'.$usuario->id) ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
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