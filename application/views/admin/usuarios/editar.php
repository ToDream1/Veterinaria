<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Editar Usuario</h3>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('admin/editar_usuario/'.$usuario->id) ?>" method="post">
                        <div class="mb-3">
                            <label for="rut" class="form-label">RUT</label>
                            <input type="text" class="form-control" id="rut" name="rut" required value="<?= $usuario->rut ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= $usuario->nombre ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $usuario->email ?>">
                            <small class="text-muted">Opcional</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $usuario->direccion ?>">
                            <small class="text-muted">Opcional</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $usuario->telefono ?>">
                            <small class="text-muted">Opcional</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="role" class="form-label">Rol</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="usuario" <?= ($usuario->role == 'usuario') ? 'selected' : '' ?>>Usuario</option>
                                <option value="administrador" <?= ($usuario->role == 'administrador') ? 'selected' : '' ?>>Administrador</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="text-muted">Dejar en blanco para mantener la contraseña actual</small>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('admin/usuarios') ?>" class="btn btn-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>