<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Editar Perfil</h4>
                    <a href="<?= base_url('index.php/user/perfil') ?>" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('index.php/user/actualizar_perfil') ?>" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                value="<?= $usuario->nombre ?? '--------' ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                value="<?= $usuario->email ?? '--------' ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" 
                                value="<?= $usuario->telefono ?? '--------' ?>" 
                                placeholder="Ingrese su teléfono">
                        </div>
                        
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" 
                                value="<?= $usuario->direccion ?? '--------' ?>" 
                                placeholder="Ingrese su dirección">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('index.php/user/perfil') ?>" class="btn btn-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.card-header {
    background-color: #4e73df;
    border-bottom: none;
}

.form-control:disabled, .form-control[readonly] {
    background-color: #f8f9fc;
    opacity: 1;
}
</style>