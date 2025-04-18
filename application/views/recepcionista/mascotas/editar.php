<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3><?= $titulo ?></h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('recepcionista/actualizar_mascota') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $mascota->id ?>">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre de la Mascota</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $mascota->nombre ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="especie" class="form-label">Especie</label>
                        <input type="text" class="form-control" id="especie" name="especie" value="<?= $mascota->especie ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="raza" class="form-label">Raza</label>
                        <input type="text" class="form-control" id="raza" name="raza" value="<?= $mascota->raza ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color" value="<?= $mascota->color ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="edad_aproximada" class="form-label">Edad Aproximada (años)</label>
                        <input type="number" class="form-control" id="edad_aproximada" name="edad_aproximada" value="<?= $mascota->edad_aproximada ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="peso" class="form-label">Peso (kg)</label>
                        <input type="number" step="0.1" class="form-control" id="peso" name="peso" value="<?= $mascota->peso ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="usuario_id" class="form-label">Propietario</label>
                        <select class="form-select" id="usuario_id" name="usuario_id" required>
                            <?php foreach($propietarios as $propietario): ?>
                                <option value="<?= $propietario->id ?>" <?= ($propietario->id == $mascota->usuario_id) ? 'selected' : '' ?>>
                                    <?= $propietario->nombre ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alergias_conocidas" class="form-label">Alergias Conocidas</label>
                    <textarea class="form-control" id="alergias_conocidas" name="alergias_conocidas" rows="3"><?= $mascota->alergias_conocidas ?></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('recepcionista/mascotas') ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-warning">Actualizar Mascota</button>
                </div>
            </form>
        </div>
    </div>
</div>