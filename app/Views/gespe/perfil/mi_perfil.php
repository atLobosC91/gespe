<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card-header">
                <h3>Mi Perfil</h3>
            </div>


            <!-- Información adicional del usuario -->
            <div class="card-body">
                <form>
                    <div class="row mb-3">

                        <div class="col-md-4">
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="inputRol" type="text" value="<?= esc($usuario['nombre']) ?>" readonly disabled />
                                <label for="inputRol">Nombre:</label>
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

                        <div class="col-md-8">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputDireccion" type="text" value="<?= esc($usuario['direccion']) ?>" disabled />
                                <label for="inputDireccion">Dirección:</label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="inputCiudad" type="text" value="" disabled />
                                <label for="inputCiudad">Ciudad:</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
</div>