<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <br>
            <div class="card-header">
                <h3>Mis Solicitudes de Permisos</h3>
            </div>
            <a href="<?= site_url('gespe/solicitud/nuevaSolicitud') ?>" class="btn btn-success" style="margin-top: 20px; margin-left: 20px;">
                <i class="fa-solid fa-plus"></i> Nueva Solicitud
            </a>



            <!-- Mostrar las solicitudes de permisos -->
            <div class="card card-body" style="margin: 20px; padding: 20px">
                <?php if (!empty($permisos)) : ?>
                    <div class="table-responsive">
                        <table class="table table-bordered border-primary">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo Permiso</th>
                                    <th>Desde</th>
                                    <th>Hasta</th>
                                    <th>Estado</th>
                                    <th>Supervisor</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($permisos as $permiso) : ?>
                                    <tr>
                                        <td><?= esc($permiso['id_solicitud']) ?></td>
                                        <td><?= esc($permiso['tipo_permiso']) ?></td>
                                        <td><?= esc($permiso['fecha_hora_inicio']) ?></td>
                                        <td><?= esc($permiso['fecha_hora_fin']) ?></td>
                                        <td><?= esc($permiso['estado']) ?></td>
                                        <td><?= esc($permiso['supervisor']) ?></td>
                                        <td>
                                            <a href="<?= site_url('gespe/solicitud/misSolicitudes') . '?page=' . $currentPage . '&id_solicitud=' . esc($permiso['id_solicitud']) ?>" class="btn btn-primary">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Componente de paginación -->
                    <div class="pagination justify-content-center">
                        <?= $pager->links('solicitudes', 'default_full') ?> <!-- Renderiza los links de paginación -->
                    </div>

                <?php else : ?>
                    <p>No tienes permisos solicitados.</p>
                <?php endif; ?>
            </div>

            <!-- Bloque para mostrar los detalles de la solicitud seleccionada -->
            <?php if (!empty($detallePermiso)) : ?>
                <div id="detallesPermiso" class="card" style="margin: 20px; padding: 20px">
                    <h5>Datos de Solicitud Ingresada</h5>

                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <label for="detalleId" class="form-label">ID</label>
                            <input type="text" id="detalleId" class="form-control" value="<?= esc($detallePermiso['id_solicitud']) ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="detalleTipoPermiso" class="form-label">Tipo Permiso</label>
                            <input type="text" id="detalleTipoPermiso" class="form-control" value="<?= esc($detallePermiso['tipo_permiso']) ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="detalleEstado" class="form-label">Estado</label>
                            <input type="text" id="detalleEstado" class="form-control" value="<?= esc($detallePermiso['estado']) ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="detalleFechaInicio" class="form-label">Desde</label>
                            <input type="text" id="detalleFechaInicio" class="form-control" value="<?= esc($detallePermiso['fecha_hora_inicio']) ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="detalleFechaFin" class="form-label">Hasta</label>
                            <input type="text" id="detalleFechaFin" class="form-control" value="<?= esc($detallePermiso['fecha_hora_fin']) ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="detalleSupervisor" class="form-label">Supervisor</label>
                            <input type="text" id="detalleSupervisor" class="form-control" value="<?= esc($detallePermiso['supervisor']) ?>" readonly>
                        </div>

                        <div class="col-md-12">
                            <label for="detalleMotivo" class="form-label">Motivo</label>
                            <input type="text" id="detalleMotivo" class="form-control" value="<?= esc($detallePermiso['motivo']) ?>" readonly>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


        </div>
    </main>