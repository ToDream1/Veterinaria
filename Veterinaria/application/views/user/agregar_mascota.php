<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h5 class="m-0 font-weight-bold text-primary">Agregar Nueva Mascota</h5>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= $this->session->flashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('index.php/user/agregar_mascota') ?>" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de la Mascota</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="especie" class="form-label">Especie</label>
                                <select class="form-select" id="especie" name="especie" required>
                                    <option value="">Seleccione una especie</option>
                                    <option value="Perro">Perro</option>
                                    <option value="Gato">Gato</option>
                                    <option value="Ave">Ave</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="raza" class="form-label">Raza</label>
                                <input type="text" class="form-control" id="raza" name="raza">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                            </div>
                            <div class="col-md-6">
                                <label for="sexo" class="form-label">Sexo</label>
                                <select class="form-select" id="sexo" name="sexo" required>
                                    <option value="">Seleccione el sexo</option>
                                    <option value="Macho">Macho</option>
                                    <option value="Hembra">Hembra</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="peso" class="form-label">Peso (kg)</label>
                            <input type="number" class="form-control" id="peso" name="peso" step="0.01">
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
    </div>
</div>