<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <h2 class="mb-4">Detalles de la Solicitud</h2>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label><strong>ID de la Solicitud:</strong></label>
                        <p><?= esc($detallePermiso['id_solicitud']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Tipo de Permiso:</strong></label>
                        <p><?= esc($detallePermiso['tipo_permiso']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Fecha y Hora de Inicio:</strong></label>
                        <p><?= esc($detallePermiso['fecha_hora_inicio']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Fecha y Hora de Término:</strong></label>
                        <p><?= esc($detallePermiso['fecha_hora_fin']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Estado:</strong></label>
                        <p>
                            <?php if ($detallePermiso['estado'] == 'Aprobado'): ?>
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle"></i> Aprobado
                                </span>
                            <?php elseif ($detallePermiso['estado'] == 'Rechazado'): ?>
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle"></i> Rechazado
                                </span>
                            <?php elseif ($detallePermiso['estado'] == 'Derivada'): ?>
                                <span class="badge bg-primary">
                                    <i class="fas fa-share-square"></i> Derivada
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning">
                                    <i class="fas fa-hourglass-half"></i> En Curso
                                </span>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Supervisor:</strong></label>
                        <p><?= esc($detallePermiso['supervisor']) ?></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>Motivo:</strong></label>
                        <p><?= esc($detallePermiso['motivo']) ?></p>
                    </div>
                    <!-- Si fue derivada -->
                    <?php if (!empty($detallePermiso['derivado_a'])): ?>
                        <div class="col-md-6 mb-3">
                            <label><strong>Derivado a:</strong></label>
                            <p><?= esc($detallePermiso['derivado_a']) ?></p>
                        </div>
                    <?php endif; ?>
                    <!-- Si fue aprobado o rechazado -->
                    <?php if (!empty($detallePermiso['aprobador'])): ?>
                        <div class="col-md-6 mb-3">
                            <label><strong>Aprobado/Rechazado por:</strong></label>
                            <p><?= esc($detallePermiso['aprobador']) ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="d-flex mt-4">
                    <a href="<?= site_url('gespe/solicitud/misSolicitudes') ?>" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>

                    <?php if ($detallePermiso['estado'] == 'Aprobado'): ?>
                        <a href="<?= site_url('gespe/solicitud/descargarPDF/' . $detallePermiso['id_solicitud']) ?>" class="btn btn-success btn-lg ms-3">
                            <i class="fas fa-file-pdf"></i> Descargar PDF
                        </a>
                    <?php endif; ?>
                </div>





            </div>
        </div>
    </main>