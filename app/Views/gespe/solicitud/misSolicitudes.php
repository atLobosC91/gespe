<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0">Mis Solicitudes de Permisos</h3>
                    <a href="<?= site_url('gespe/solicitud/nuevaSolicitud') ?>" class="btn btn-success">
                        <i class="fa-solid fa-plus"></i> Nueva Solicitud
                    </a>
                </div>

                <div class="table-responsive">
                    <?php if (!empty($permisos)): ?>
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo Permiso</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Estado</th>
                                    <th>Supervisor</th>
                                    <th>Ver Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($permisos as $permiso): ?>
                                    <tr>
                                        <td><?= esc($permiso['id_solicitud']) ?></td>
                                        <td><?= esc($permiso['tipo_permiso']) ?></td>
                                        <td><?= esc($permiso['fecha_hora_inicio']) ?></td>
                                        <td><?= esc($permiso['fecha_hora_fin']) ?></td>
                                        <td><span class="badge bg-info text-dark"><?= esc($permiso['estado']) ?></span></td>
                                        <td><?= esc($permiso['supervisor']) ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('gespe/solicitud/detalles/' . esc($permiso['id_solicitud'])) ?>" class="btn btn-outline-primary btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="pagination justify-content-center">
                            <?= $pager->links('solicitudes', 'default_full') ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">No tienes permisos solicitados.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </main>