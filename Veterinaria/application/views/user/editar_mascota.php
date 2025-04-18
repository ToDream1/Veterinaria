<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Editar <?= $mascota->nombre ?></h2>
            
            <form action="<?= base_url('index.php/user/editar_mascota/'.$mascota->id) ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $mascota->nombre ?>" required>
                </div>

                <div class="mb-3">
                    <label for="especie" class="form-label">Especie</label>
                    <select class="form-select" id="especie" name="especie" required>
                        <option value="Perro" <?= $mascota->especie == 'Perro' ? 'selected' : '' ?>>Perro</option>
                        <option value="Gato" <?= $mascota->especie == 'Gato' ? 'selected' : '' ?>>Gato</option>
                        <option value="Ave" <?= $mascota->especie == 'Ave' ? 'selected' : '' ?>>Ave</option>
                        <option value="Otro" <?= $mascota->especie == 'Otro' ? 'selected' : '' ?>>Otro</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="raza" class="form-label">Raza</label>
                    <input type="text" class="form-control" id="raza" name="raza" value="<?= $mascota->raza ?>" required>
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control" id="color" name="color" value="<?= $mascota->color ?>" required>
                </div>

                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select class="form-select" id="sexo" name="sexo" required>
                        <option value="Macho" <?= $mascota->sexo == 'Macho' ? 'selected' : '' ?>>Macho</option>
                        <option value="Hembra" <?= $mascota->sexo == 'Hembra' ? 'selected' : '' ?>>Hembra</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="edad_aproximada" class="form-label">Edad Aproximada (años)</label>
                    <input type="number" class="form-control" id="edad_aproximada" name="edad_aproximada" value="<?= $mascota->edad_aproximada ?>" min="0" step="0.1" required>
                </div>

                <div class="mb-3">
                    <label for="peso" class="form-label">Peso (kg)</label>
                    <input type="number" class="form-control" id="peso" name="peso" value="<?= $mascota->peso ?>" min="0" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="alergias_conocidas" class="form-label">Alergias Conocidas</label>
                    <textarea class="form-control" id="alergias_conocidas" name="alergias_conocidas" rows="3"><?= $mascota->alergias_conocidas ?></textarea>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Cambios
                    </button>
                    <a href="<?= base_url('index.php/user/mascotas') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>