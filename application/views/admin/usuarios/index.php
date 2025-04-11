<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Usuarios Registrados</h3>
            <a href="<?= base_url('admin/crear_usuario') ?>" class="btn btn-primary">Nuevo Usuario</a>
        </div>
        <div class="card-body">
            <!-- Añadir caja de búsqueda -->
            <div class="row mb-3">
                <div class="col-md-6 offset-md-6">
                    <div class="input-group">
                        <input type="text" id="searchUsuarios" class="form-control" placeholder="Buscar usuario...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tablaUsuarios">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RUT</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($usuarios)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay usuarios registrados</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach($usuarios as $usuario): ?>
                                <tr>
                                    <td><?= $usuario->id ?></td>
                                    <td><?= $usuario->rut ?></td>
                                    <td><?= $usuario->nombre ?></td>
                                    <td><?= $usuario->email ?></td>
                                    <td>
                                        <span class="badge <?= $usuario->role == 'administrador' ? 'bg-danger' : 'bg-primary' ?>">
                                            <?= ucfirst($usuario->role) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/editar_usuario/'.$usuario->id) ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
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

<!-- Al final del archivo -->
<script>
// Función de búsqueda para usuarios
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchUsuarios');
    const tabla = document.getElementById('tablaUsuarios');
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