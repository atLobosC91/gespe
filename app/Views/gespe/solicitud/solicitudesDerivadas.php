<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3>Solicitudes Derivadas</h3>

            <?php if (!empty($solicitudes)) : ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Solicitante</th>
                            <th>Tipo Permiso</th>
                            <th>Inicio</th>
                            <th>Término</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($solicitudes as $solicitud) : ?>
                            <tr>
                                <td><?= esc($solicitud['solicitante']) ?></td>
                                <td><?= esc($solicitud['tipo_permiso']) ?></td>
                                <td><?= esc($solicitud['fecha_hora_inicio']) ?></td>
                                <td><?= esc($solicitud['fecha_hora_fin']) ?></td>
                                <td><?= esc($solicitud['estado']) ?></td>
                                <td>
                                    <a href="<?= site_url('gespe/solicitud/aprobarSolicitud/' . $solicitud['id_solicitud']) ?>" class="btn btn-success">Aprobar</a>
                                    <a href="<?= site_url('gespe/solicitud/rechazarSolicitud/' . $solicitud['id_solicitud']) ?>" class="btn btn-danger">Rechazar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No tienes solicitudes derivadas pendientes.</p>
            <?php endif; ?>
        </div>

    </main>