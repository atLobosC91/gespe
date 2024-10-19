<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Lista de Áreas</h2>
                    <a href="<?= site_url('gespe/area/nuevaArea') ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Añadir Nueva Área
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
                            <?php if (!empty($areas) && is_array($areas)): ?>
                                <?php foreach ($areas as $area): ?>
                                    <tr>
                                        <td><?= esc($area['id']) ?></td>
                                        <td><?= esc($area['descripcion']) ?></td>
                                        <td class="text-center">
                                            <!-- Botón de Modificar -->
                                            <a href="<?= site_url('gespe/area/modificar/' . $area['id']) ?>" class="btn btn-outline-warning btn-sm">
                                                <i class="fa fa-edit"></i> Modificar
                                            </a>
                                            <!-- Botón de Eliminar -->
                                            <a href="<?= site_url('gespe/area/eliminar/' . $area['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta área?');">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">No hay áreas disponibles</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
