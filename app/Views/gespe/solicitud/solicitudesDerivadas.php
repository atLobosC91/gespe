<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <h3 class="mb-4">Solicitudes Derivadas</h3>

                <?php if (count($solicitudes) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Solicitante</th>
                                    <th>Tipo Permiso</th>
                                    <th>Derivado Por</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Estado</th>
                                    <th>Ver Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($solicitudes as $solicitud): ?>
                                    <tr>
                                        <td><?= esc($solicitud['solicitante']) ?></td>
                                        <td><?= esc($solicitud['tipo_permiso']) ?></td>
                                        <td><?= esc($solicitud['supervisor_id']) ?></td>
                                        <td><?= esc($solicitud['fecha_hora_inicio']) ?></td>
                                        <td><?= esc($solicitud['fecha_hora_fin']) ?></td>
                                        <td><span class="badge bg-info text-dark"><?= esc($solicitud['estado']) ?></span></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('gespe/solicitud/detalleSolicitudesDerivada/' . $solicitud['id_solicitud']) ?>" class="btn btn-outline-primary btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">No tienes solicitudes derivadas pendientes.</div>
                <?php endif; ?>
            </div>
        </div>


    </main>