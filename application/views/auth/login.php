<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Veterinario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #4e73df;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .form-control {
            padding: 12px;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #4e73df;
            border: none;
            padding: 12px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
        }
        .alert {
            margin-bottom: 20px;
            padding: 15px;
        }
        .logo-top-left {
            position: absolute;
            top: 20px;
            left: 20px;
            max-width: 100px;
        }
    </style>
</head>
<body>
    <!-- Logo in the top-left corner -->
    <img src="<?= base_url('assets/img/logo.svg') ?>" alt="Logo" class="logo-top-left">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                    <h4 class="text-center">Veterinaria Municipal</h4>
                        <div class="text-center mb-3">
                            <img src="<?= base_url('assets/img/logo_mascotas.svg') ?>" alt="Logo" class="img-fluid" style="max-width: 150px;">
                        </div>   
                    </div>
                    <div class="card-body">
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= $this->session->flashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('index.php/auth/login') ?>" method="post">
                            <div class="mb-3">
                                <label for="rut" class="form-label">RUT</label>
                                <input type="text" class="form-control" id="rut" name="rut" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="width: 42px;">
                                        <i class="bi bi-eye" style="font-size: 1.1rem;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-3">
                            <p>¿No tienes una cuenta? <a href="<?= base_url('index.php/auth/register') ?>">Regístrate aquí</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, buttonId) {
            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const icon = button.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        document.getElementById('togglePassword').addEventListener('click', function() {
            togglePasswordVisibility('password', 'togglePassword');
        });
    </script>
</body>
</html>