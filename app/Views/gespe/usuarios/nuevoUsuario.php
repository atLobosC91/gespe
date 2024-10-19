<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <h2 class="text-center">Nueva Solicitud de Permiso</h2>
                <form action="<?= site_url('gespe/solicitud/crearSolicitud') ?>" method="post">
                    <div class="row mt-4">
                        <!-- Tipo de Permiso -->
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="inputTipoPermiso" name="id_permiso" required>
                                    <option value="" disabled selected>Selecciona un tipo de permiso</option>
                                    <?php foreach ($tiposPermiso as $permiso): ?>
                                        <option value="<?= esc($permiso['id_permiso']) ?>"><?= esc($permiso['descripcion']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputTipoPermiso">Tipo de Permiso</label>
                            </div>
                        </div>

                        <!-- Fecha y Hora de Inicio -->
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="inputFechaInicio" name="fecha_hora_inicio" required>
                                <label for="inputFechaInicio">Fecha y Hora de Inicio</label>
                            </div>
                        </div>

                        <!-- Fecha y Hora de Término -->
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="inputFechaFin" name="fecha_hora_fin" required>
                                <label for="inputFechaFin">Fecha y Hora de Término</label>
                            </div>
                        </div>

                        <!-- Motivo del Permiso -->
                        <div class="col-md-12 mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" id="inputMotivo" name="motivo" style="height: 100px" required></textarea>
                                <label for="inputMotivo">Motivo del Permiso</label>
                            </div>
                        </div>

                        <!-- Selección de Supervisor -->
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="inputSupervisor" name="id_supervisor" required>
                                    <option value="" disabled selected>Selecciona un supervisor</option>
                                    <?php foreach ($supervisores as $supervisor): ?>
                                        <option value="<?= esc($supervisor['id_usuario']) ?>"><?= esc($supervisor['nombres'] . ' ' . $supervisor['apellidos']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputSupervisor">Supervisor</label>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-primary btn-lg w-100" type="submit">
                                <i class="fas fa-save"></i> Guardar Solicitud
                            </button>
                        </div>
                        <div class="col-md-3 d-grid">
                            <a class="btn btn-danger btn-lg w-100" href="<?= site_url('gespe/solicitud/misSolicitudes') ?>">
                                <i class="fas fa-times"></i> Cancelar Solicitud
                            </a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </main>
