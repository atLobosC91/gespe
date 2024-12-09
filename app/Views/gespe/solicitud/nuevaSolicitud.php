<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <h2 class="mb-4">Nueva Solicitud de Permiso</h2>

                <form action="<?= site_url('gespe/solicitud/crearSolicitud') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row">
                        <!-- Selección del tipo de permiso -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Tipo de Permiso</strong></label>
                            <select class="form-select" name="id_permiso" required>
                                <option value="" disabled selected>Selecciona un tipo de permiso</option>
                                <?php foreach ($tiposPermiso as $permiso): ?>
                                    <option value="<?= esc($permiso['id_permiso']) ?>"><?= esc($permiso['descripcion']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Mostrar Supervisor Asignado -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Supervisor</strong></label>
                            <input type="text" class="form-control" value="<?= isset($supervisor) ? esc($supervisor['nombres'] . ' ' . $supervisor['apellidos']) : 'Sin asignar' ?>" readonly>
                            <input type="hidden" name="supervisor_id" value="<?= isset($supervisor) ? esc($supervisor['id_usuario']) : '' ?>">
                        </div>

                        <!-- Fechas y motivo -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Fecha y Hora de Inicio</strong></label>
                            <input type="datetime-local" name="fecha_hora_inicio" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><strong>Fecha y Hora de Fin</strong></label>
                            <input type="datetime-local" name="fecha_hora_fin" class="form-control" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label"><strong>Motivo</strong></label>
                            <textarea name="motivo" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-start mt-4">
                        <button type="submit" class="btn btn-info btn-lg me-2">
                            <i class="fas fa-paper-plane"></i> Enviar
                        </button>
                        <a href="<?= site_url('gespe/solicitud/misSolicitudes') ?>" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-times-circle"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
