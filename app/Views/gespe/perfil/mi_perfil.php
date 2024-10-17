<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card-header">
                <h3>Perfil de Usuario</h3>
            </div>

            <!-- Información adicional del usuario -->
            <div class="card-body">
                <form method="post" action="<?= site_url('gespe/perfil/actualizarPerfil') ?>">
                    <!-- Datos Personales -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>Datos Personales</h5>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputUsuario" name="usuario" type="text" value="<?= esc($usuario['usuario']) ?>" required />
                                        <label for="inputUsuario">Usuario:</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputPass" name="password" type="password"
                                            placeholder="Ingresa una nueva contraseña (opcional)" />
                                        <label for="inputPass">Contraseña:</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputNombre" name="nombres" type="text" value="<?= esc($usuario['nombres']) ?>" required />
                                        <label for="inputNombre">Nombre:</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputApellido" name="apellidos" type="text" value="<?= esc($usuario['apellidos']) ?>" required />
                                        <label for="inputApellido">Apellido:</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputTelefono" name="telefono" type="text"
                                            value="<?= esc($usuario['telefono']) ?>" pattern="569[0-9]{8}"
                                            title="El número debe tener el formato 569 seguido de 8 dígitos" maxlength="11" required />
                                        <label for="inputTelefono">Teléfono:</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" name="correo" type="email"
                                            value="<?= esc($usuario['correo']) ?>" required />
                                        <label for="inputEmail">Email:</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputDireccion" name="direccion" type="text"
                                            value="<?= esc($usuario['direccion']) ?>" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\#\-]+"
                                            title="La dirección solo puede contener letras, números, espacios, # y -" maxlength="100" required />
                                        <label for="inputDireccion">Dirección:</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php if (session()->has('errors')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <!-- Datos Faena -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>Datos Faena</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputCargo" type="text" value="<?= esc($rol == 2 ? 'Administrador' : ($rol == 3 ? 'Supervisor' : ($rol == 4 ? 'Operativo' : 'Gerente'))) ?>" readonly />
                                        <label for="inputCargo">Cargo:</label>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <button class="btn btn-primary w-100" type="submit">Actualizar</button>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button class="btn btn-secondary w-100" type="button">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
</div>