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

                        <!-- Selección del tipo de responsable -->
                        <?php if ($rol == 4): /* Rol Operativo */ ?>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Responsable</strong></label>
                                <select id="tipo_responsable" class="form-select" name="tipo_responsable" onchange="toggleResponsable()" required>
                                    <option value="supervisor">Supervisor</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                            </div>

                            <!-- Selección del supervisor -->
                            <div id="supervisor_section" class="col-md-6 mb-3">
                                <label class="form-label"><strong>Selecciona un Supervisor</strong></label>
                                <select class="form-select" name="supervisor_id">
                                    <option value="" disabled selected>Selecciona un supervisor</option>
                                    <?php foreach ($supervisores as $supervisor): ?>
                                        <option value="<?= esc($supervisor['id_usuario']) ?>"><?= esc($supervisor['nombres'] . ' ' . $supervisor['apellidos']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Selección del administrador -->
                            <div id="admin_section" class="col-md-6 mb-3" style="display:none;">
                                <label class="form-label"><strong>Selecciona un Administrador</strong></label>
                                <select class="form-select" name="administrador_id">
                                    <option value="" disabled selected>Selecciona un administrador</option>
                                    <?php foreach ($administradores as $administrador): ?>
                                        <option value="<?= esc($administrador['id_usuario']) ?>"><?= esc($administrador['nombres'] . ' ' . $administrador['apellidos']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif; ?>

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

    <script>
        // Mostrar u ocultar secciones según el responsable seleccionado
        function toggleResponsable() {
            var tipoResponsable = document.getElementById("tipo_responsable").value;
            if (tipoResponsable === "supervisor") {
                document.getElementById("supervisor_section").style.display = "block";
                document.getElementById("admin_section").style.display = "none";
            } else {
                document.getElementById("supervisor_section").style.display = "none";
                document.getElementById("admin_section").style.display = "block";
            }
        }
    </script>