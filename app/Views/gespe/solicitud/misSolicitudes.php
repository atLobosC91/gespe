<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <h2 class="mb-4">Mis Solicitudes de Permisos</h2>

                <form class="mb-4" method="get">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por tipo de permiso o estado" value="<?= esc($search) ?>">
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Tipo Permiso</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Estado</th>
                                <th>Supervisor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($permisos)): ?>
                                <?php foreach ($permisos as $permiso): ?>
                                    <tr>
                                        <td><?= esc($permiso['id_solicitud']) ?></td>
                                        <td><?= esc($permiso['tipo_permiso']) ?></td>
                                        <td><?= esc($permiso['fecha_hora_inicio']) ?></td>
                                        <td><?= esc($permiso['fecha_hora_fin']) ?></td>
                                        <td>
                                            <?php if ($permiso['estado'] == 'Aprobado'): ?>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle"></i> Aprobado
                                                </span>
                                            <?php elseif ($permiso['estado'] == 'Rechazado'): ?>
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle"></i> Rechazado
                                                </span>
                                            <?php elseif ($permiso['estado'] == 'Derivada'): ?>
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-share-square"></i> Derivada
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-hourglass-half"></i> En Curso
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?= esc($permiso['supervisor']) ?></td>
                                        <td>
                                            <a href="<?= site_url('gespe/solicitud/detalles/' . $permiso['id_solicitud']) ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No tienes solicitudes.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="pagination justify-content-center">
                        <?= $pager->links('solicitudes', 'default_full') ?>
                    </div>
                </div>
            </div>
        </div>
    </main>