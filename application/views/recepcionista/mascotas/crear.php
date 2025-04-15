<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Registrar Nueva Mascota</h2>
            <form action="<?= base_url('recepcionista/mascotas/guardar') ?>" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Mascota</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="especie" class="form-label">Especie</label>
                    <select class="form-control" id="especie" name="especie" required>
                        <option value="">Seleccione una especie</option>
                        <option value="perro">Perro</option>
                        <option value="gato">Gato</option>
                        <option value="ave">Ave</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="raza" class="form-label">Raza</label>
                    <input type="text" class="form-control" id="raza" name="raza" required>
                </div>
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad" required>
                </div>
                <div class="mb-3">
                    <label for="propietario" class="form-label">Propietario</label>
                    <select class="form-control" id="propietario" name="propietario_id" required>
                        <option value="">Seleccione un propietario</option>
                        <?php foreach($propietarios as $propietario): ?>
                            <option value="<?= $propietario->id ?>"><?= $propietario->nombre . ' ' . $propietario->apellido ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Mascota</button>
                <a href="<?= base_url('recepcionista/mascotas') ?>" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>