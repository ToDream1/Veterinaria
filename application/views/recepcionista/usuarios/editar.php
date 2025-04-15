<div class="container mt-4">
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error') ?>
        </div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-header">
            <h3>Editar Usuario</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('recepcionista/usuarios/actualizar/'.$usuario->id) ?>" method="POST">
                <div class="mb-3">
                    <label for="rut" class="form-label">RUT</label>
                    <input type="text" class="form-control" id="rut" name="rut" value="<?= isset($usuario->rut) ? $usuario->rut : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= isset($usuario->nombre) ? $usuario->nombre : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($usuario->email) ? $usuario->email : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?= isset($usuario->direccion) ? $usuario->direccion : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?= isset($usuario->telefono) ? $usuario->telefono : '' ?>">
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="<?= base_url('recepcionista/usuarios') ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>