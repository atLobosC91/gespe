<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Lista de Especialidades</h2>
                    <a href="<?= site_url('gespe/especialidad/nuevaEspecialidad') ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Añadir Nueva Especialidad
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($especialidades) && is_array($especialidades)): ?>
                                <?php foreach ($especialidades as $especialidad): ?>
                                    <tr>
                                        <td><?= esc($especialidad['id']) ?></td>
                                        <td><?= esc($especialidad['descripcion']) ?></td>
                                        <td class="text-center">
                                            <!-- Botón de Modificar -->
                                            <a href="<?= site_url('gespe/especialidad/modificar/' . $especialidad['id']) ?>" class="btn btn-outline-warning btn-sm">
                                                <i class="fa fa-edit"></i> Modificar
                                            </a>
                                            <!-- Botón de Eliminar -->
                                            <a href="<?= site_url('gespe/especialidad/eliminar/' . $especialidad['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta especialidad?');">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">No hay especialidades disponibles</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
