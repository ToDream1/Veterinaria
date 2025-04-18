<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <h2>Panel de Recepción</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-user-plus fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Registro de Usuarios</h5>
                    <p class="card-text">Registra nuevos propietarios de mascotas</p>
                    <a href="<?= base_url('recepcionista/crear_usuario') ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Nuevo Usuario
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-paw fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Registro de Mascotas</h5>
                    <p class="card-text">Registra nuevas mascotas y propietarios</p>
                    <a href="<?= base_url('recepcionista/crear_mascota') ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Nueva Mascota
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-calendar-plus fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Agenda</h5>
                    <p class="card-text">Programa nuevas citas médicas para las mascotas</p>
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Agendar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-danger">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-ambulance fa-3x text-danger"></i>
                    </div>
                    <h5 class="card-title text-danger">Atención de Urgencia</h5>
                    <p class="card-text">Ingreso prioritario para casos que requieren atención inmediata</p>
                    <a href="<?= base_url('recepcionista/urgencia') ?>" class="btn btn-danger">
                        <i class="fas fa-plus-circle me-2"></i>Ingresar Atención de Urgencia
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Próximas Citas</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Mascota</th>
                                    <th>Propietario</th>
                                    <th>Veterinario</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center">Próximamente disponible</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>