<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Registro de Actividad del Sistema</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha y Hora</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($actividades)): ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay actividades registradas</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($actividades as $actividad): ?>
                                <tr>
                                    <td><?= $actividad->id ?></td>
                                    <td><?= date('d/m/Y H:i:s', strtotime($actividad->fecha)) ?></td>
                                    <td><?= $actividad->usuario ?></td>
                                    <td>
                                        <?php 
                                        $badge_class = '';
                                        switch(strtoupper($actividad->accion)) {
                                            case 'CREATE': $badge_class = 'bg-success'; break;
                                            case 'UPDATE': $badge_class = 'bg-warning'; break;
                                            case 'DELETE': $badge_class = 'bg-danger'; break;
                                            case 'LOGIN': $badge_class = 'bg-info'; break;
                                            default: $badge_class = 'bg-secondary';
                                        }
                                        ?>
                                        <span class="badge <?= $badge_class ?>">
                                            <?= $actividad->accion ?>
                                        </span>
                                    </td>
                                    <td><?= $actividad->descripcion ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Función para filtrar actividades
document.addEventListener('DOMContentLoaded', function() {
    // Aquí puedes agregar funcionalidad de filtrado si lo deseas
});
</script>