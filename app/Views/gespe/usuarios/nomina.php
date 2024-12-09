<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <h2 class="text-center mb-4">Nómina de Usuarios</h2>
            <div class="card shadow-sm">
                <div class="card-header">
                    <a href="<?= site_url('gespe/usuarios/nuevoUsuario') ?>" class="btn btn-primary">
                        + Añadir Nuevo Usuario
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Rol</th>
                                <th>Supervisor</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($usuarios)): ?>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?= esc($usuario['id_usuario']) ?></td>
                                        <td><?= esc($usuario['nombres'] . ' ' . $usuario['apellidos']) ?></td>
                                        <td><?= esc($usuario['correo']) ?></td>
                                        <td><?= esc($usuario['telefono']) ?></td>
                                        <td><?= esc($usuario['rol']) ?></td>
                                        <td>
                                            <?= !empty($usuario['supervisor']) ? esc($usuario['supervisor']) : 'N/A' ?>
                                        </td>
                                        <td>
                                            <a href="<?= site_url('gespe/usuarios/modificarUsuario/' . $usuario['id_usuario']) ?>" class="btn btn-warning btn-sm">
                                                Modificar
                                            </a>
                                            <a href="<?= site_url('gespe/usuarios/eliminar/' . $usuario['id_usuario']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No hay usuarios registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Sección de paginación -->
                    <div class="d-flex justify-content-center mt-4">
                        <?= $pager->links('usuarios', 'default_full') ?>
                    </div>
                </div>
            </div>
        </div>
    </main>