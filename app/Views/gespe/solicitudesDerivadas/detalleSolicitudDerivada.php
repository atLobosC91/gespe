<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <h2 class="text-start mb-4">
                    Detalle de la Solicitud Derivada #<?= $detallePermiso['id_solicitud'] ?>
                </h2>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Tipo de Permiso:</strong> <?= $detallePermiso['tipo_permiso'] ?></p>
                        <p><strong>Desde:</strong> <?= $detallePermiso['fecha_hora_inicio'] ?></p>
                        <p><strong>Hasta:</strong> <?= $detallePermiso['fecha_hora_fin'] ?></p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p><strong>Estado:</strong>
                            <td>
                                <?php if ($detallePermiso['estado_solicitud'] == 4): ?>
                                    <span class="badge bg-primary"><i class="fas fa-share-square"></i> Derivada</span>
                                <?php elseif ($detallePermiso['estado_solicitud'] == 2): ?>
                                    <span class="badge bg-success"><i class="fas fa-check-circle"></i> Aprobada</span>
                                <?php elseif ($detallePermiso['estado_solicitud'] == 3): ?>
                                    <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Rechazada</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half"></i> En Curso</span>
                                <?php endif; ?>
                            </td>
                        </p>
                        <p><strong>Solicitado por:</strong> <?= $detallePermiso['solicitado_por'] ?></p>
                    </div>

                    <label><strong>Motivo:</strong></label>
                    <p><?= esc($detallePermiso['motivo']) ?></p>


                </div>

                <!-- Mostrar botones solo si la solicitud está en curso -->
                <?php if ($detallePermiso['estado_solicitud'] == 1 || $detallePermiso['estado_solicitud'] == 4): // En Curso, donde 1 es el valor para En Curso 
                ?>
                    <!-- Verificar si el usuario es un administrador -->
                    <?php if ($rol == 2): ?>
                        <form action="<?= base_url('gespe/solicitudesDerivadas/aprobarSolicitud/' . $detallePermiso['id_solicitud']) ?>" method="post" class="mt-4">
                            <div class="d-flex justify-content-start gap-3">
                                <div class="d-flex justify-content-center mt-4">
                                    <!-- Botón para aprobar (solo administradores) -->
                                    <button type="submit" class="btn-custom btn-success me-3">
                                        <i class="fas fa-check"></i> Aprobar
                                    </button>
                                    <!-- Botón para rechazar (modal) -->
                                    <button type="button" class="btn-custom btn-rechazar me-3" data-bs-toggle="modal" data-bs-target="#rechazarModal">
                                        <i class="fas fa-times"></i> Rechazar
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Verificar si el usuario es un supervisor -->
                    <?php elseif ($rol == 3): ?>
                        <form action="<?= base_url('gespe/solicitudesDerivadas/derivarSolicitud/' . $detallePermiso['id_solicitud']) ?>" method="post" class="mt-4">
                            <div class="mb-3">
                                <label for="administrador_id" class="form-label">Derivar a:</label>
                                <select name="administrador_id" id="administrador_id" class="form-control" required>
                                    <option value="">Seleccionar administrador</option>
                                    <?php foreach ($administradores as $admin): ?>
                                        <option value="<?= $admin['id_usuario'] ?>"><?= $admin['nombres'] . ' ' . $admin['apellidos'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="d-flex justify-content-start gap-3">
                                <div class="d-flex justify-content-center mt-4">
                                    <!-- Botón para derivar -->
                                    <button type="submit" class="btn-custom btn-derivar me-3">
                                        <i class="fas fa-share"></i> Derivar
                                    </button>
                                    <!-- Botón para rechazar (modal) -->
                                    <button type="button" class="btn-custom btn-rechazar me-3" data-bs-toggle="modal" data-bs-target="#rechazarModal">
                                        <i class="fa-solid fa-x"></i> Rechazar
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>



                <div class="d-flex mt-4">
                    <!-- Botón de volver con icono, siempre visible -->
                    <a href="<?= base_url('gespe/solicitudesDerivadas') ?>" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>

                    <?php if ($detallePermiso['estado'] == 'Aprobado'): ?>
                        <a href="<?= site_url('gespe/solicitudesDerivadas/pdfSolicitudDerivada/' . $detallePermiso['id_solicitud']) ?>" class="btn btn-success btn-lg ms-3">
                            <i class="fas fa-file-pdf"></i> Descargar PDF
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Modal para rechazar solicitud -->
        <div class="modal fade" id="rechazarModal" tabindex="-1" aria-labelledby="rechazarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?= base_url('gespe/solicitudesDerivadas/rechazarSolicitudDerivada/' . $detallePermiso['id_solicitud']) ?>" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="rechazarModalLabel">Rechazar Solicitud</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="motivo" class="form-label">Motivo de Rechazo</label>
                                <textarea class="form-control" name="motivo" id="motivo" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Rechazar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>