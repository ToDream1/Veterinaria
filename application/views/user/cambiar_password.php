<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Cambiar Contraseña</h4>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="alert alert-info">
                        <strong>Requisitos de la contraseña:</strong>
                        <ul class="mb-0">
                            <li>Mínimo 6 caracteres</li>
                            <li>Al menos una letra mayúscula</li>
                            <li>Al menos un número</li>
                        </ul>
                    </div>
                    <form action="<?= base_url('index.php/user/cambiar_password') ?>" method="POST">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Contraseña Actual</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar Nueva Contraseña</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                        <a href="<?= base_url('index.php/user/perfil') ?>" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
function togglePassword(inputId, buttonId) {
    const input = document.getElementById(inputId);
    const button = document.getElementById(buttonId);
    
    button.addEventListener('mousedown', function() {
        input.type = 'text';
        button.querySelector('i').classList.remove('bi-eye');
        button.querySelector('i').classList.add('bi-eye-slash');
    });
    
    button.addEventListener('mouseup', function() {
        input.type = 'password';
        button.querySelector('i').classList.remove('bi-eye-slash');
        button.querySelector('i').classList.add('bi-eye');
    });
    
    button.addEventListener('mouseleave', function() {
        input.type = 'password';
        button.querySelector('i').classList.remove('bi-eye-slash');
        button.querySelector('i').classList.add('bi-eye');
    });
}

togglePassword('current_password', 'toggleCurrentPassword');
togglePassword('new_password', 'toggleNewPassword');
togglePassword('confirm_password', 'toggleConfirmPassword');
</script>