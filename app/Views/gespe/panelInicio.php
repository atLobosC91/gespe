<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <h2 class="text-center">Bienvenido(a): <?= esc($usuario['nombres'] . ' ' . $usuario['apellidos']) ?></h2>
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="info-box bg-light p-3 rounded text-center shadow-sm">
                            <strong class="text-muted">Rol:</strong>
                            <?= esc($rol == 2 ? 'Administrador' : ($rol == 3 ? 'Supervisor' : ($rol == 4 ? 'Operativo' : 'Gerente'))) ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="info-box bg-light p-3 rounded text-center shadow-sm">
                            <strong class="text-muted">Email:</strong> <?= esc($usuario['correo']) ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="info-box bg-light p-3 rounded text-center shadow-sm">
                            <strong class="text-muted">Teléfono:</strong> <?= esc($usuario['telefono']) ?>
                        </div>
                    </div>
                </div>

                <!-- KPIs -->
                <?php if ($rol == 3 || $rol == 4): ?>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="info-box bg-info text-white p-4 rounded text-center shadow-sm">
                                <h4 class="text-light">Permisos Mes Actual</h4>
                                <h2 class="text-light"><?= esc($permisosMesActual) ?></h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box bg-warning text-white p-4 rounded text-center shadow-sm">
                                <h4 class="text-light">Permisos Totales</h4>
                                <h2 class="text-light"><?= esc($permisosTotales) ?></h2>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
