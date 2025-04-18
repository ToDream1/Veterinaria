<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Crear Nuevo Usuario</h3>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('admin/crear_usuario') ?>" method="post">
                        <div class="mb-3">
                            <label for="rut" class="form-label">RUT *</label>
                            <input type="text" class="form-control" id="rut" name="rut" required value="<?= set_value('rut') ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= set_value('nombre') ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
                            <small class="text-muted">Opcional</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?= set_value('direccion') ?>">
                            <small class="text-muted">Opcional</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?= set_value('telefono') ?>">
                            <small class="text-muted">Opcional</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar Contraseña *</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="role">Rol</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="usuario" class="text-primary">Usuario</option>
                                <option value="veterinario" class="text-success">Veterinario</option>
                                <option value="recepcionista" class="text-info">Recepcionista</option>
                                <option value="administrador" class="text-danger">Administrador</option>
                            </select>
                        </div>
                        
                        <style>
                            #role option[value="usuario"] { color: #0d6efd; }
                            #role option[value="veterinario"] { color: #198754; }
                            #role option[value="recepcionista"] { color: #0dcaf0; }
                            #role option[value="administrador"] { color: #dc3545; }
                        </style>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('admin/usuarios') ?>" class="btn btn-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Crear Usuario</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>