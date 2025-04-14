<div class="container mt-4">
    <h2>Registro de Actividad</h2>
    
    <!-- Filtros -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Filtros</h5>
        </div>
        <div class="card-body">
            <!-- Modificar la etiqueta del formulario para añadir un ID -->
            <form id="filtroForm" action="<?= base_url('admin/actividades') ?>" method="get" class="row g-3">
                <!-- Filtro por descripción primero -->
                <div class="col-md-6">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" 
                           placeholder="Buscar en descripción..." 
                           value="<?= isset($filtros['descripcion']) ? $filtros['descripcion'] : '' ?>">
                </div>
                
                <!-- Filtro por acción - con colores -->
                <div class="col-md-6">
                    <label for="accion" class="form-label">Acción</label>
                    <select class="form-select" id="accion" name="accion">
                        <option value="">Todas las acciones</option>
                        <?php foreach($acciones as $accion): 
                            $option_class = '';
                            switch(strtoupper($accion)) {
                                case 'CREATE': $option_class = 'text-success'; break;
                                case 'UPDATE': $option_class = 'text-warning'; break;
                                case 'DELETE': $option_class = 'text-danger'; break;
                                case 'LOGIN': $option_class = 'text-info'; break;
                                case 'LOGOUT': $option_class = 'text-secondary'; break;
                                default: $option_class = 'text-secondary';
                            }
                        ?>
                            <option value="<?= $accion ?>" class="<?= $option_class ?>" <?= (isset($filtros['accion']) && $filtros['accion'] == $accion) ? 'selected' : '' ?>><?= $accion ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Filtro por fecha desde -->
                <div class="col-md-6">
                    <label for="fecha_desde" class="form-label">Fecha desde</label>
                    <input type="date" class="form-control" id="fecha_desde" name="fecha_desde" value="<?= isset($filtros['fecha_desde']) ? $filtros['fecha_desde'] : '' ?>">
                </div>
                
                <!-- Filtro por fecha hasta -->
                <div class="col-md-6">
                    <label for="fecha_hasta" class="form-label">Fecha hasta</label>
                    <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta" value="<?= isset($filtros['fecha_hasta']) ? $filtros['fecha_hasta'] : '' ?>">
                </div>
                
                <!-- Botones de acción -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="<?= base_url('admin/actividades') ?>" class="btn btn-secondary">Limpiar filtros</a>
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
                !empty($filtros['accion']) || 
                !empty($filtros['fecha_desde']) || 
                !empty($filtros['fecha_hasta'])
            )): ?>
                <div class="alert alert-info">
                    <strong>Filtros aplicados:</strong>
                    <?php if(!empty($filtros['descripcion'])): ?> Descripción: <?= $filtros['descripcion'] ?><?php endif; ?>
                    <?php if(!empty($filtros['accion'])): ?> Acción: <?= $filtros['accion'] ?><?php endif; ?>
                    <?php if(!empty($filtros['fecha_desde'])): ?> Desde: <?= $filtros['fecha_desde'] ?><?php endif; ?>
                    <?php if(!empty($filtros['fecha_hasta'])): ?> Hasta: <?= $filtros['fecha_hasta'] ?><?php endif; ?>
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
                                        !empty($filtros['usuario']) || 
                                        !empty($filtros['accion']) || 
                                        !empty($filtros['fecha_desde']) || 
                                        !empty($filtros['fecha_hasta'])
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
        <!-- Eliminamos la paginación que estaba aquí -->
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
    $('#accion, #fecha_desde, #fecha_hasta').on('change', function() {
        $('#filtroForm').submit();
    });
});
</script>