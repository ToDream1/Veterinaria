<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Crear Nueva Mascota</h3>
        </div>
        <div class="card-body">
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $this->session->flashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <div class="alert alert-info">
                <strong>Propietario:</strong> <?= $propietario->nombre ?> (<?= $propietario->rut ?>)
            </div>
            
            <form action="<?= base_url('admin/crear_mascota/'.$propietario->id) ?>" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre de la Mascota</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="especie" class="form-label">Especie</label>
                        <input type="text" class="form-control" id="especie" name="especie" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="raza" class="form-label">Raza</label>
                        <input type="text" class="form-control" id="raza" name="raza">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" id="sexo" name="sexo" required>
                            <option value="">Seleccione</option>
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="edad_aproximada" class="form-label">Edad Aproximada (años)</label>
                        <input type="number" class="form-control" id="edad_aproximada" name="edad_aproximada" min="0" step="0.1">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="peso" class="form-label">Peso (kg)</label>
                        <input type="number" class="form-control" id="peso" name="peso" min="0" step="0.1">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="alergias_conocidas" class="form-label">Alergias Conocidas</label>
                    <textarea class="form-control" id="alergias_conocidas" name="alergias_conocidas" rows="3"></textarea>
                    <div class="form-text">Deje en blanco si no hay alergias conocidas.</div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="<?= base_url('admin/mascotas') ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Mascota</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validación del formulario
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Validar nombre
        const nombre = document.getElementById('nombre');
        if (nombre.value.trim() === '') {
            isValid = false;
            nombre.classList.add('is-invalid');
        } else {
            nombre.classList.remove('is-invalid');
        }
        
        // Validar especie
        const especie = document.getElementById('especie');
        if (especie.value.trim() === '') {
            isValid = false;
            especie.classList.add('is-invalid');
        } else {
            especie.classList.remove('is-invalid');
        }
        
        // Validar sexo
        const sexo = document.getElementById('sexo');
        if (sexo.value === '') {
            isValid = false;
            sexo.classList.add('is-invalid');
        } else {
            sexo.classList.remove('is-invalid');
        }
        
        if (!isValid) {
            event.preventDefault();
            alert('Por favor, complete todos los campos obligatorios.');
        }
    });
});
</script>