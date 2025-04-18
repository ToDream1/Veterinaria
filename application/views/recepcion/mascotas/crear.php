<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Registrar Nueva Mascota</h3>
        </div>
        <div class="card-body">
            <form action="<?= base_url('recepcionista/guardar_mascota') ?>" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre de la Mascota *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="especie">Especie *</label>
                            <select class="form-control" id="especie" name="especie" required>
                                <option value="">Seleccione una especie</option>
                                <option value="Perro">Perro</option>
                                <option value="Gato">Gato</option>
                                <option value="Ave">Ave</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="raza">Raza</label>
                            <input type="text" class="form-control" id="raza" name="raza">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                        </div>
                        <div class="form-group mb-3">
                            <label for="propietario_id">Propietario *</label>
                            <select class="form-control" id="propietario_id" name="propietario_id" required>
                                <option value="">Seleccione un propietario</option>
                                <?php if(isset($propietarios)): ?>
                                    <?php foreach($propietarios as $propietario): ?>
                                        <option value="<?= $propietario->id ?>"><?= $propietario->nombre ?> - <?= $propietario->rut ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="observaciones">Observaciones</label>
                            <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <a href="<?= base_url('recepcionista/mascotas') ?>" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Mascota</button>
                </div>
            </form>
        </div>
    </div>
</div>