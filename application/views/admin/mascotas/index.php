<div class="container mt-4">
    <!-- Eliminar la sección de estadísticas que estaba aquí -->
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Mascotas Registradas</h3>
            <a href="<?= base_url('admin/crear_mascota') ?>" class="btn btn-success">Nueva Mascota</a>
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
                                        <a href="<?= base_url('admin/eliminar_mascota/'.$mascota->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta mascota?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>
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

<!-- Después del script existente -->
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
</script>