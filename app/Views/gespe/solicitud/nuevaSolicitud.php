<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <h2 class="mb-4">Nueva Solicitud de Permiso</h2>

                <form action="<?= site_url('gespe/solicitud/crearSolicitud') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de Permiso</label>
                            <select class="form-select" name="id_permiso" required>
                                <option value="" disabled selected>Selecciona un tipo de permiso</option>
                                <?php foreach ($tiposPermiso as $permiso): ?>
                                    <option value="<?= esc($permiso['id_permiso']) ?>"><?= esc($permiso['descripcion']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Supervisor</label>
                            <select class="form-select" name="id_supervisor" required>
                                <option value="" disabled selected>Selecciona un supervisor</option>
                                <?php foreach ($supervisores as $supervisor): ?>
                                    <option value="<?= esc($supervisor['id_usuario']) ?>"><?= esc($supervisor['nombres'] . ' ' . $supervisor['apellidos']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha y Hora de Inicio</label>
                            <input type="datetime-local" name="fecha_hora_inicio" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha y Hora de Fin</label>
                            <input type="datetime-local" name="fecha_hora_fin" class="form-control" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Motivo</label>
                            <textarea name="motivo" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Solicitud</button>
                </form>
            </div>
        </div>
    </main>
