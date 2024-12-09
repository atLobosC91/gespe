<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <h2 class="text-center">Perfil de Usuario</h2>
                <form method="post" action="<?= site_url('gespe/perfil/actualizarPerfil') ?>">
                    <div class="row mt-4">
                        <!-- Información del perfil -->
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" id="inputUsuario" name="usuario" type="text" value="<?= esc($usuario['usuario']) ?>" required />
                                <label for="inputUsuario">Usuario:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" id="inputPass" name="password" type="password" placeholder="Ingresa una nueva contraseña (opcional)" />
                                <label for="inputPass">Contraseña:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" id="inputNombre" name="nombres" type="text" value="<?= esc($usuario['nombres']) ?>" required />
                                <label for="inputNombre">Nombres:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" id="inputApellido" name="apellidos" type="text" value="<?= esc($usuario['apellidos']) ?>" required />
                                <label for="inputApellido">Apellidos:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" id="inputTelefono" name="telefono" type="text" value="<?= esc($usuario['telefono']) ?>" pattern="569[0-9]{8}" title="El número debe tener el formato 569 seguido de 8 dígitos" maxlength="11" required />
                                <label for="inputTelefono">Teléfono:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" id="inputEmail" name="correo" type="email" value="<?= esc($usuario['correo']) ?>" required />
                                <label for="inputEmail">Email:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" id="inputRol" type="text" value="<?= esc($usuario['id_rol'] == 2 ? 'Administrador' : ($usuario['id_rol'] == 3 ? 'Supervisor' : ($usuario['id_rol'] == 4 ? 'Operativo' : 'Gerente'))) ?>" readonly />
                                <label for="inputRol">Rol:</label>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" id="inputDireccion" name="direccion" type="text" value="<?= esc($usuario['direccion']) ?>" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\#\-]+" title="La dirección solo puede contener letras, números, espacios, # y -" maxlength="100" required />
                                <label for="inputDireccion">Dirección:</label>
                            </div>
                        </div>

                        <!-- Selección de Área -->
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select class="form-control" id="inputArea" name="id_area" required>
                                    <option value="">Seleccione un área</option>
                                    <?php foreach ($areas as $area): ?>
                                        <option value="<?= esc($area['id']) ?>" 
                                            <?= $usuario['id_area'] == $area['id'] ? 'selected' : '' ?>>
                                            <?= esc($area['descripcion']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputArea">Área:</label>
                            </div>
                        </div>

                        <!-- Selección de Especialidad -->
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select class="form-control" id="inputEspecialidad" name="id_especialidad" required>
                                    <option value="">Seleccione una especialidad</option>
                                    <?php foreach ($especialidades as $especialidad): ?>
                                        <option value="<?= esc($especialidad['id']) ?>" 
                                            <?= $usuario['id_especialidad'] == $especialidad['id'] ? 'selected' : '' ?>>
                                            <?= esc($especialidad['descripcion']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputEspecialidad">Especialidad:</label>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-primary btn-lg w-100" type="submit">
                                <i class="fas fa-save"></i> Actualizar
                            </button>
                        </div>
                        <div class="col-md-3 d-grid">
                            <a class="btn btn-danger btn-lg w-100" href="<?= site_url('gespe/panelInicio') ?>">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>