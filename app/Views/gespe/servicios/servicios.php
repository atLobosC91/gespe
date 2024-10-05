<!-- servicios.php -->
<div class="container">
    <h1>Gestión de Servicios</h1>
    <a href="/servicios/nuevo" class="btn btn-primary mb-3">Agregar Nuevo Servicio</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Servicio</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Iterar sobre los servicios (datos de ejemplo) -->
            <?php foreach ($servicios as $servicio): ?>
                <tr>
                    <td><?= esc($servicio['id']) ?></td>
                    <td><?= esc($servicio['nombre']) ?></td>
                    <td><?= esc($servicio['descripcion']) ?></td>
                    <td>
                        <a href="/servicios/editar/<?= esc($servicio['id']) ?>" class="btn btn-warning">Editar</a>
                        <a href="/servicios/eliminar/<?= esc($servicio['id']) ?>" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>