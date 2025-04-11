<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Usuarios Registrados</h3>
            <a href="<?= base_url('admin/crear_usuario') ?>" class="btn btn-primary">Nuevo Usuario</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($usuarios as $usuario): ?>
                            <tr>
                                <td><?= $usuario->id ?></td>
                                <td><?= $usuario->nombre ?></td>
                                <td><?= $usuario->email ?></td>
                                <td><?= $usuario->rol ?></td>
                                <td>
                                    <a href="<?= base_url('admin/editar_usuario/'.$usuario->id) ?>" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="<?= base_url('admin/eliminar_usuario/'.$usuario->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>