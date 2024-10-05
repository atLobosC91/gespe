<!-- permisos_adm.php -->
<div class="container">
    <h1>Gestión de Permisos</h1>
    <p>Aquí puedes ver, aceptar o rechazar los permisos solicitados.</p>

    <!-- Tabla de permisos -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empleado</th>
                <th>Fecha de Solicitud</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterar sobre permisos (datos de ejemplo) -->
            <?php foreach ($permisos as $permiso): ?>
                <tr>
                    <td><?= esc($permiso['id']) ?></td>
                    <td><?= esc($permiso['empleado']) ?></td>
                    <td><?= esc($permiso['fecha']) ?></td>
                    <td><?= esc($permiso['motivo']) ?></td>
                    <td><?= esc($permiso['estado']) ?></td>
                    <td>
                        <a href="/permisos/aceptar/<?= esc($permiso['id']) ?>" class="btn btn-success">Aceptar</a>
                        <a href="/permisos/rechazar/<?= esc($permiso['id']) ?>" class="btn btn-danger">Rechazar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
