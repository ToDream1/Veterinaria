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
                                    <!-- En la columna de acciones de la tabla de usuarios -->
                                    <td>
                                        <a href="<?= base_url('admin/editar_usuario/'.$usuario->id) ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" 
                                                onclick="confirmarEliminacion(<?= $usuario->id ?>, '<?= $usuario->nombre ?>')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </td>
                                    
                                    <!-- Al final del archivo, añade el modal de confirmación -->
                                    <!-- Modal de confirmación para eliminar -->
                                    <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="eliminarModalLabel">Confirmar eliminación</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Está seguro que desea eliminar el usuario <span id="nombreUsuario" class="fw-bold"></span>?
                                                    <p class="text-danger mt-2">Esta acción no se puede deshacer.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                    <a href="#" id="btnEliminar" class="btn btn-danger">Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Script para la confirmación de eliminación -->
                                    <script>
                                    // Función para mostrar el modal de confirmación
                                    function confirmarEliminacion(id, nombre) {
                                        document.getElementById('nombreUsuario').textContent = nombre;
                                        document.getElementById('btnEliminar').href = '<?= base_url('admin/eliminar_usuario/') ?>' + id;
                                        
                                        // Mostrar el modal
                                        var modal = new bootstrap.Modal(document.getElementById('eliminarModal'));
                                        modal.show();
                                    }
                                    </script>
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

<?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>