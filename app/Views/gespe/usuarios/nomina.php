<!-- nomina.php -->
<div class="container">
    <h1>Nómina de Usuarios</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterar sobre usuarios (datos de ejemplo) -->
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= esc($usuario['id']) ?></td>
                    <td><?= esc($usuario['nombre']) ?></td>
                    <td><?= esc($usuario['email']) ?></td>
                    <td><?= esc($usuario['rol']) ?></td>
                    <td>
                        <a href="/usuarios/editar/<?= esc($usuario['id']) ?>" class="btn btn-warning">Editar</a>
                        <a href="/usuarios/eliminar/<?= esc($usuario['id']) ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>