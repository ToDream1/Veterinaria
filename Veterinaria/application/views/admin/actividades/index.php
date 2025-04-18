<div class="container mt-4">
    <h2>Registro de Actividad</h2>
    
    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Filtros</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="<?= base_url('admin/actividades') ?>" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Buscar..." value="<?= isset($filtros['descripcion']) ? htmlspecialchars($filtros['descripcion']) : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="">Todos</option>
                                <?php if(isset($tipos_acciones) && is_array($tipos_acciones)): ?>
                                    <?php foreach($tipos_acciones as $tipo): ?>
                                        <option value="<?= $tipo ?>" <?= (isset($filtros['tipo']) && $filtros['tipo'] == $tipo) ? 'selected' : '' ?>><?= $tipo ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control" value="<?= isset($filtros['fecha_inicio']) ? htmlspecialchars($filtros['fecha_inicio']) : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fecha Fin</label>
                            <input type="date" name="fecha_fin" class="form-control" value="<?= isset($filtros['fecha_fin']) ? htmlspecialchars($filtros['fecha_fin']) : '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-right">
                        <button type="submit" class="btn btn-primary mr-2">Filtrar</button>
                        <a href="<?= base_url('admin/actividades') ?>" class="btn btn-secondary">Limpiar Filtros</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Paginación colocada entre el cuadro de filtros y la tabla de actividades -->
    <div class="d-flex justify-content-center mb-4">
        <?php echo $paginacion; ?>
    </div>
        
    <!-- Tabla de actividades -->
    <div class="card">
        <div class="card-body">
            <?php if(isset($filtros) && (
                !empty($filtros['descripcion']) || 
                !empty($filtros['tipo']) || 
                !empty($filtros['fecha_inicio']) || 
                !empty($filtros['fecha_fin'])
            )): ?>
                <div class="alert alert-info">
                    <strong>Filtros aplicados:</strong>
                    <?php if(!empty($filtros['descripcion'])): ?> Descripción: <?= $filtros['descripcion'] ?><?php endif; ?>
                    <?php if(!empty($filtros['tipo'])): ?> Tipo: <?= $filtros['tipo'] ?><?php endif; ?>
                    <?php if(!empty($filtros['fecha_inicio'])): ?> Desde: <?= $filtros['fecha_inicio'] ?><?php endif; ?>
                    <?php if(!empty($filtros['fecha_fin'])): ?> Hasta: <?= $filtros['fecha_fin'] ?><?php endif; ?>
                </div>
            <?php endif; ?>
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Acción</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($actividades)): ?>
                            <tr>
                                <td colspan="4" class="text-center">
                                    <?php if(isset($filtros) && (
                                        !empty($filtros['descripcion']) || 
                                        !empty($filtros['tipo']) ||  // cambiar 'accion' por 'tipo'
                                        !empty($filtros['fecha_inicio']) ||  // cambiar 'fecha_desde' por 'fecha_inicio'
                                        !empty($filtros['fecha_fin'])  // cambiar 'fecha_hasta' por 'fecha_fin'
                                    )): ?>
                                        <div class="alert alert-warning mt-3">
                                            No hay actividades que coincidan con los parámetros de búsqueda.
                                        </div>
                                    <?php else: ?>
                                        No hay actividades registradas
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($actividades as $actividad): ?>
                                <tr>
                                    <td><?= $actividad->descripcion ?></td>
                                    <td>
                                        <?php 
                                            $badge_class = '';
                                            switch(strtoupper($actividad->accion)) {
                                                case 'CREATE': $badge_class = 'bg-success'; break;
                                                case 'UPDATE': $badge_class = 'bg-warning'; break;
                                                case 'DELETE': $badge_class = 'bg-danger'; break;
                                                case 'LOGIN': $badge_class = 'bg-info'; break;
                                                case 'LOGOUT': $badge_class = 'bg-secondary'; break;
                                                default: $badge_class = 'bg-secondary';
                                            }
                                        ?>
                                        <span class="badge <?= $badge_class ?>"><?= $actividad->accion ?></span>
                                    </td>
                                    <td>
                                        <?php 
                                            if(!empty($actividad->usuario_id)) {
                                                $usuario = $this->User_model->get_user_by_id($actividad->usuario_id);
                                                echo $usuario ? $usuario->nombre : 'Usuario desconocido';
                                            } else {
                                                echo 'Sistema';
                                            }
                                        ?>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($actividad->fecha)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- Eliminar esta segunda paginación -->
    </div>
</div>

<script>
$(document).ready(function() {
    // Variable para almacenar todas las actividades
    var todasLasActividades = [];
    
    // Cargar todas las actividades al inicio
    $.ajax({
        url: '<?= base_url('admin/obtener_todas_actividades') ?>',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            todasLasActividades = data;
            
            // Aplicar filtro inicial si existe
            var filtroInicial = $('#descripcion').val();
            if (filtroInicial) {
                filtrarActividades(filtroInicial);
            }
        }
    });
    
    // Filtro en tiempo real para descripción
    $('#descripcion').on('keyup', function() {
        var query = $(this).val().toLowerCase();
        filtrarActividades(query);
    });
    
    // Función para filtrar actividades
    function filtrarActividades(query) {
        if (todasLasActividades.length === 0) return;
        
        // Limpiar la tabla
        var tbody = $('table tbody');
        tbody.empty();
        
        // Filtrar actividades
        var actividadesFiltradas = todasLasActividades.filter(function(actividad) {
            return actividad.descripcion.toLowerCase().includes(query);
        });
        
        // Si no hay resultados
        if (actividadesFiltradas.length === 0) {
            tbody.append('<tr><td colspan="4" class="text-center">No hay actividades que coincidan con la búsqueda.</td></tr>');
            return;
        }
        
        // Mostrar actividades filtradas
        actividadesFiltradas.forEach(function(actividad) {
            var badgeClass = '';
            switch(actividad.accion.toUpperCase()) {
                case 'CREATE': badgeClass = 'bg-success'; break;
                case 'UPDATE': badgeClass = 'bg-warning'; break;
                case 'DELETE': badgeClass = 'bg-danger'; break;
                case 'LOGIN': badgeClass = 'bg-info'; break;
                case 'LOGOUT': badgeClass = 'bg-secondary'; break;
                default: badgeClass = 'bg-secondary';
            }
            
            var row = '<tr>' +
                '<td>' + actividad.descripcion + '</td>' +
                '<td><span class="badge ' + badgeClass + '">' + actividad.accion + '</span></td>' +
                '<td>' + (actividad.nombre_usuario || 'Sistema') + '</td>' +
                '<td>' + formatDate(actividad.fecha) + '</td>' +
                '</tr>';
            tbody.append(row);
        });
    }
    
    // Función para formatear fecha
    function formatDate(dateString) {
        var date = new Date(dateString);
        var day = date.getDate().toString().padStart(2, '0');
        var month = (date.getMonth() + 1).toString().padStart(2, '0');
        var year = date.getFullYear();
        var hours = date.getHours().toString().padStart(2, '0');
        var minutes = date.getMinutes().toString().padStart(2, '0');
        
        return day + '/' + month + '/' + year + ' ' + hours + ':' + minutes;
    }
    
    // Aplicar filtros de acción y fecha al enviar el formulario
    $('#tipo, #fecha_inicio, #fecha_fin').on('change', function() {
        $('#filtroForm').submit();
    });
});
</script>

<style>
    select option[value="CREATE"] { color: #198754; }
    select option[value="UPDATE"] { color: #ffc107; }
    select option[value="DELETE"] { color: #dc3545; }
    select option[value="LOGIN"] { color: #0dcaf0; }
    select option[value="LOGOUT"] { color: #6c757d; }
</style>