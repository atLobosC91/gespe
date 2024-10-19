<br><br>
<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <h2 class="text-center">Bienvenido(a): <?= esc($usuario['nombres'] . ' ' . $usuario['apellidos']) ?></h2>
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="info-box bg-light p-3 rounded text-center shadow-sm">
                            <strong class="text-muted">Rol:</strong>
                            <?= esc($usuario['id_rol'] == 2 ? 'Administrador' : ($usuario['id_rol'] == 3 ? 'Supervisor' : ($usuario['id_rol'] == 4 ? 'Operativo' : 'Gerente'))) ?>
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



                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="info-box bg-info text-white p-4 rounded text-center shadow-sm">
                            <h4 class="text-light">Permisos Mes Actual</h4>
                            <h2 class="text-light">2</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box bg-warning text-white p-4 rounded text-center shadow-sm">
                            <h4 class="text-light">Permisos Totales</h4>
                            <h2 class="text-light">2</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </main>