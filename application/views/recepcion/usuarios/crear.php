<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Registrar Nuevo Usuario</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('recepcionista/guardar_usuario') ?>" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="rut">RUT *</label>
                            <input type="text" class="form-control" id="rut" name="rut" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre Completo *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Correo Electrónico *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="telefono">Teléfono *</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="direccion">Dirección *</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Contraseña *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <a href="<?= base_url('recepcionista/usuarios') ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>