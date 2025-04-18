<div class="container mt-4">
    <h2><?= $titulo ?></h2>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <a href="<?= base_url('recepcionista/crear_usuario') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Nuevo Usuario
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($usuarios)): ?>
                            <?php foreach($usuarios as $usuario): ?>
                                <tr>
                                    <td><?= $usuario->nombre ?></td>
                                    <td><?= $usuario->email ?></td>
                                    <td><?= $usuario->telefono ?></td>
                                    <td><?= $usuario->direccion ?></td>
                                    <td>
                                        <a href="<?= base_url('recepcionista/editar_usuario/' . $usuario->id) ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay usuarios registrados</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>