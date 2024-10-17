<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0">Nómina de Usuarios</h3>
                    <a href="<?= site_url('gespe/usuarios/nuevoUsuario') ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Añadir Nuevo Usuario
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Rol</th>
                                <th>Opción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($usuarios) && is_array($usuarios)): ?>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?= esc($usuario['id_usuario']) ?></td>
                                        <td><?= esc($usuario['nombres']) . ' ' . esc($usuario['apellidos']) ?></td>
                                        <td><?= esc($usuario['correo']) ?></td>
                                        <td><?= esc($usuario['telefono']) ?></td>
                                        <td><?= esc($usuario['id_rol'] == 1 ? 'Gerente' : ($usuario['id_rol'] == 2 ? 'Administrador' : 'Supervisor')) ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('gespe/usuarios/detalleUsuario/' . $usuario['id_usuario']) ?>" class="btn btn-outline-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No hay usuarios disponibles</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="pagination justify-content-center">
                        <?= $pager->links('usuarios', 'default_full') ?>
                    </div>
                </div>
            </div>
        </div>

    </main>