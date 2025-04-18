<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Dashboard Administrativo</h1>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Registro de Actividades Recientes</h5>
                </div>
                <div class="card-body">
                    <?php if(isset($actividades) && !empty($actividades)): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Usuario</th>
                                        <th>Acción</th>
                                        <th>Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($actividades as $actividad): ?>
                                    <tr>
                                        <td><?= date('d/m/Y H:i', strtotime($actividad->created_at)) ?></td>
                                        <td><?= $actividad->user_id ?></td>
                                        <td><?= $actividad->action ?></td>
                                        <td><?= $actividad->description ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">No hay actividades registradas.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>