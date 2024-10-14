<br><br>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card-header">
                <h3>Panel de Inicio</h3>
            </div>


            <!-- Mostrar algunas estadísticas o KPIs -->
            <br>
            <div class="row">
                <div class="col-xl-3 col-md-4">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Permisos Mes Actual</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <div class="small text-white">0</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Permisos Mes Actual</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <div class="small text-white">0</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Permisos Totales</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <div class="small text-white">4</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-4">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Permisos Mes Actual</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <div class="small text-white">0</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información adicional del usuario -->
            <div class="card card-body">
                <form>
                    <div class="row mb-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="font-weight-light my-4">Bienvenido(a): <?= esc($usuario['nombres']) ?> <?= esc($usuario['apellidos']) ?></h4>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="inputRol" type="text" value="<?= esc($rol == 2 ? 'Administrador' : ($rol == 3 ? 'Supervisor' : ($rol == 4 ? 'Operativo' : 'Gerente'))) ?>" readonly disabled />
                                <label for="inputRol">Rol:</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputEmail" type="email" value="<?= esc($usuario['correo']) ?>" disabled />
                                <label for="inputEmail">Email:</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputTelefono" type="telefono" value="<?= esc($usuario['telefono']) ?>" disabled />
                                <label for="inputTelefono">Teléfono:</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputDireccion" type="text" value="<?= esc($usuario['direccion']) ?>" disabled />
                                <label for="inputDireccion">Dirección:</label>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </main>
