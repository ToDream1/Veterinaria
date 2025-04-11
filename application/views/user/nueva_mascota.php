<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6">
            <h4 class="text-center mb-4">Agregar Nueva Mascota</h4>
            
            <form action="<?= base_url('index.php/user/agregar_mascota') ?>" method="post">
                <div class="mb-4">
                    <label for="nombre" class="form-label">Nombre de la Mascota</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="row mb-4">
                    <div class="col-12 col-sm-6 mb-3 mb-sm-0">
                        <label for="especie" class="form-label">Especie</label>
                        <select class="form-select" id="especie" name="especie" required>
                            <option value="">Seleccione una especie</option>
                            <option value="Perro">Perro</option>
                            <option value="Gato">Gato</option>
                            <option value="Ave">Ave</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" id="sexo" name="sexo" required>
                            <option value="">Seleccione el sexo</option>
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12 col-sm-6 mb-3 mb-sm-0">
                        <label for="raza" class="form-label">Raza</label>
                        <input type="text" class="form-control" id="raza" name="raza" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12 col-sm-6 mb-3 mb-sm-0">
                        <label for="edad_aproximada" class="form-label">Edad Aproximada (años)</label>
                        <input type="number" class="form-control" id="edad_aproximada" name="edad_aproximada" min="0" step="0.1" required>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label for="peso" class="form-label">Peso (kg)</label>
                        <input type="number" class="form-control" id="peso" name="peso" min="0" step="0.01" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="alergias" class="form-label">Alergias Conocidas</label>
                    <textarea class="form-control" id="alergias" name="alergias" rows="3" 
                        placeholder="Describa las alergias conocidas de su mascota. Si no tiene ninguna o las desconoce, escriba 'Ninguna conocida'"></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Agregar Mascota
                    </button>
                    <a href="<?= base_url('index.php/user/mascotas') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>