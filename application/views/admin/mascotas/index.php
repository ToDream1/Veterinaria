<div class="container mt-4">
    <!-- Eliminar la sección de estadísticas que estaba aquí -->
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Mascotas Registradas</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#seleccionarPropietarioModal">
                Nueva Mascota
            </button>
        </div>
        <div class="card-body">
            <!-- Añadir caja de búsqueda -->
            <div class="row mb-3">
                <div class="col-md-6 offset-md-6">
                    <div class="input-group">
                        <input type="text" id="searchMascotas" class="form-control" placeholder="Buscar mascota...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tablaMascotas">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Especie</th>
                            <th>Raza</th>
                            <th>Propietario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($mascotas)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay mascotas registradas</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($mascotas as $mascota): ?>
                                <tr>
                                    <td><?= $mascota->id ?></td>
                                    <td><?= $mascota->nombre ?></td>
                                    <td><?= $mascota->especie ?></td>
                                    <td><?= $mascota->raza ?></td>
                                    <td><?= $mascota->nombre_propietario ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/editar_mascota/'.$mascota->id) ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                onclick="confirmarEliminacion(<?= $mascota->id ?>, '<?= $mascota->nombre ?>')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar la mascota <span id="nombreMascota" class="fw-bold"></span>?
                <p class="text-danger mt-2">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="btnEliminar" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Script para la búsqueda y confirmación de eliminación -->
<script>
// Función de búsqueda para mascotas
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchMascotas');
    const tabla = document.getElementById('tablaMascotas');
    const filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    searchInput.addEventListener('keyup', function() {
        const termino = searchInput.value.toLowerCase();
        
        for (let i = 0; i < filas.length; i++) {
            const fila = filas[i];
            const celdas = fila.getElementsByTagName('td');
            let encontrado = false;
            
            for (let j = 0; j < celdas.length - 1; j++) { // Excluimos la columna de acciones
                const texto = celdas[j].textContent.toLowerCase();
                if (texto.indexOf(termino) > -1) {
                    encontrado = true;
                    break;
                }
            }
            
            if (encontrado) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        }
    });
});

// Función para mostrar el modal de confirmación
function confirmarEliminacion(id, nombre) {
    document.getElementById('nombreMascota').textContent = nombre;
    document.getElementById('btnEliminar').href = '<?= base_url('admin/eliminar_mascota/') ?>' + id;
    
    // Mostrar el modal
    var modal = new bootstrap.Modal(document.getElementById('eliminarModal'));
    modal.show();
}
</script>

<!-- Agregar Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Contar mascotas por tipo
    const mascotas = <?= json_encode($mascotas) ?>;
    const tiposMascota = {
        'perro': 0,
        'gato': 0,
        'otro': 0
    };
    
    // Contar cada tipo de mascota
    mascotas.forEach(mascota => {
        const especie = mascota.especie.toLowerCase();
        if (especie.includes('perro')) {
            tiposMascota.perro++;
        } else if (especie.includes('gato')) {
            tiposMascota.gato++;
        } else {
            tiposMascota.otro++;
        }
    });
    
    // Crear el gráfico de torta
    const ctx = document.getElementById('mascotasPorTipoChart').getContext('2d');
    const mascotasPorTipoChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Perros', 'Gatos', 'Otros'],
            datasets: [{
                label: 'Tipos de Mascotas',
                data: [tiposMascota.perro, tiposMascota.gato, tiposMascota.otro],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribución por Tipo de Mascota'
                }
            }
        }
    });
});
</script>

<!-- Modal para seleccionar propietario -->
<div class="modal fade" id="seleccionarPropietarioModal" tabindex="-1" aria-labelledby="seleccionarPropietarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seleccionarPropietarioModalLabel">Seleccionar Propietario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Seleccione el propietario para la nueva mascota:</p>
                
                <div class="mb-3">
                    <input type="text" id="buscarPropietario" class="form-control" placeholder="Buscar propietario...">
                </div>
                
                <div class="list-group" id="listaPropietarios">
                    <?php foreach($propietarios as $propietario): ?>
                        <a href="<?= base_url('admin/crear_mascota/'.$propietario->id) ?>" class="list-group-item list-group-item-action">
                            <?= $propietario->nombre ?> (<?= $propietario->rut ?>)
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Script para búsqueda de propietarios -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buscarPropietario = document.getElementById('buscarPropietario');
    const listaPropietarios = document.getElementById('listaPropietarios').getElementsByTagName('a');
    
    buscarPropietario.addEventListener('keyup', function() {
        const termino = buscarPropietario.value.toLowerCase();
        
        for (let i = 0; i < listaPropietarios.length; i++) {
            const texto = listaPropietarios[i].textContent.toLowerCase();
            if (texto.indexOf(termino) > -1) {
                listaPropietarios[i].style.display = '';
            } else {
                listaPropietarios[i].style.display = 'none';
            }
        }
    });
});
</script>