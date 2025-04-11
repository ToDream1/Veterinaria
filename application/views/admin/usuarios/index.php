<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Usuarios Registrados</h3>
            <a href="<?= base_url('admin/crear_usuario') ?>" class="btn btn-primary">Nuevo Usuario</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($usuarios)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay usuarios registrados</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($usuarios as $usuario): ?>
                                <tr>
                                    <td><?= $usuario->id ?></td>
                                    <td><?= $usuario->rut ?></td>
                                    <td><?= $usuario->nombre ?></td>
                                    <td><?= $usuario->email ?></td>
                                    <td>
                                        <span class="badge <?= $usuario->role == 'administrador' ? 'bg-danger' : 'bg-primary' ?>">
                                            <?= ucfirst($usuario->role) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/editar_usuario/'.$usuario->id) ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
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