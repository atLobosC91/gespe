<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <h2 class="text-start mb-4">Solicitudes Derivadas</h2>

                <!-- Buscador -->
                <form class="mb-4" method="get">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por tipo de permiso o estado" value="<?= esc($search) ?>">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>

                <!-- Tabla de Solicitudes Derivadas -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-center align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Permiso</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Estado</th>
                                <th>Solicitado por</th>
                                <th>Derivado a</th>
                                <th>Administrador</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($solicitudesDerivadas): ?>
                                <?php foreach ($solicitudesDerivadas as $solicitud): ?>
                                    <tr>
                                        <td><?= $solicitud['id_solicitud'] ?></td>
                                        <td><?= $solicitud['tipo_permiso'] ?></td>
                                        <td><?= $solicitud['fecha_hora_inicio'] ?></td>
                                        <td><?= $solicitud['fecha_hora_fin'] ?></td>
                                        <td>
                                            <?php if ($solicitud['estado_solicitud'] == 4): ?>
                                                <span class="badge bg-primary"><i class="fas fa-share-square"></i> Derivada</span>
                                            <?php elseif ($solicitud['estado_solicitud'] == 2): ?>
                                                <span class="badge bg-success"><i class="fas fa-check-circle"></i> Aprobada</span>
                                            <?php elseif ($solicitud['estado_solicitud'] == 3): ?>
                                                <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Rechazada</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half"></i> En Curso</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $solicitud['solicitado_por'] ?></td>
                                        <td><?= $solicitud['supervisor'] ?></td>
                                        <td><?= $solicitud['administrador'] ?></td>
                                        <td>
                                            <div class="d-flex mt-4">
                                                <a href="<?= base_url('gespe/solicitudesDerivadas/detalleSolicitudDerivada/' . $solicitud['id_solicitud']) ?>" class="btn btn-info btn-sm me-2">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?= base_url('gespe/solicitudesDerivadas/eliminarSolicitudDerivada/' . $solicitud['id_solicitud']) ?>" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">No tienes solicitudes derivadas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>


                <!-- Paginación -->
                <?php if (isset($pager)): ?>
                    <div class="pagination justify-content-center">
                        <?= $pager->links('solicitudesDerivadas', 'default_full') ?>
                    </div>
                <?php endif; ?>

                <!-- Botón para volver -->
                <div class="d-flex mt-4">
                    <a href="<?= base_url('gespe/panelInicio') ?>" class="d-flex justify-content-start gap-3 btn-custom btn-volver">
                        <i class="fas fa-arrow-left"></i> Volver a Panel de Inicio
                    </a>
                </div>
            </div>
        </div>
    </main>