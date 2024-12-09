<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <h2 class="text-center mb-4">Crear Nuevo Usuario</h2>

                <!-- Formulario para crear un nuevo usuario -->
                <form action="<?= site_url('gespe/usuarios/crearUsuario') ?>" method="post">
                    <div class="row g-3">

                        <!-- Nombres -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputNombres" name="nombres" placeholder="Nombres" value="<?= old('nombres') ?>" required>
                                <label for="inputNombres">Nombres</label>
                            </div>
                        </div>

                        <!-- Apellidos -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputApellidos" name="apellidos" placeholder="Apellidos" value="<?= old('apellidos') ?>" required>
                                <label for="inputApellidos">Apellidos</label>
                            </div>
                        </div>

                        <!-- Usuario -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputUsuario" name="usuario" placeholder="Usuario" value="<?= old('usuario') ?>" required>
                                <label for="inputUsuario">Usuario</label>
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Contraseña" required>
                                <label for="inputPassword">Contraseña</label>
                            </div>
                        </div>

                        <!-- Correo -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="inputCorreo" name="correo" placeholder="Correo" value="<?= old('correo') ?>" required>
                                <label for="inputCorreo">Correo</label>
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputTelefono" name="telefono" placeholder="Teléfono" value="<?= old('telefono') ?>" pattern="569[0-9]{8}" title="El número debe tener el formato 569 seguido de 8 dígitos" maxlength="11" required>
                                <label for="inputTelefono">Teléfono</label>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder="Dirección" value="<?= old('direccion') ?>" required>
                                <label for="inputDireccion">Dirección</label>
                            </div>
                        </div>

                        <!-- Rol -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="inputRol" name="rol" required>
                                    <option value="" disabled <?= old('rol') ? '' : 'selected' ?>>Seleccionar Rol</option>
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?= esc($rol['id_rol']) ?>" <?= old('rol') == $rol['id_rol'] ? 'selected' : '' ?>>
                                            <?= esc($rol['descripcion']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputRol">Rol</label>
                            </div>
                        </div>

                        <!-- Área -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="inputArea" name="id_area" required>
                                    <option value="" disabled <?= old('id_area') ? '' : 'selected' ?>>Seleccionar Área</option>
                                    <?php foreach ($areas as $area): ?>
                                        <option value="<?= esc($area['id']) ?>" <?= old('id_area') == $area['id'] ? 'selected' : '' ?>>
                                            <?= esc($area['descripcion']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputArea">Área</label>
                            </div>
                        </div>

                        <!-- Especialidad -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <select class="form-select" id="inputEspecialidad" name="id_especialidad" required>
                                    <option value="" disabled <?= old('id_especialidad') ? '' : 'selected' ?>>Seleccionar Especialidad</option>
                                    <?php foreach ($especialidades as $especialidad): ?>
                                        <option value="<?= esc($especialidad['id']) ?>" <?= old('id_especialidad') == $especialidad['id'] ? 'selected' : '' ?>>
                                            <?= esc($especialidad['descripcion']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputEspecialidad">Especialidad</label>
                            </div>
                        </div>
                        
                        <!-- Supervisor (visible solo si se selecciona el rol operativo) -->
                        <div class="col-md-6" id="supervisorField" style="display: none;">
                            <div class="form-floating">
                                <select class="form-select" id="inputSupervisor" name="id_supervisor">
                                    <option value="" disabled <?= old('id_supervisor') ? '' : 'selected' ?>>Seleccionar Supervisor</option>
                                    <?php foreach ($supervisores as $supervisor): ?>
                                        <option value="<?= esc($supervisor['id_usuario']) ?>" <?= old('id_supervisor') == $supervisor['id_usuario'] ? 'selected' : '' ?>>
                                            <?= esc($supervisor['nombres'] . ' ' . $supervisor['apellidos']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputSupervisor">Supervisor</label>
                            </div>
                        </div>

                        <script>
                            // Mostrar/ocultar el campo de supervisor según el rol seleccionado
                            document.getElementById('inputRol').addEventListener('change', function() {
                                const supervisorField = document.getElementById('supervisorField');
                                if (this.value == 4) { // Rol 4 = Operativo
                                    supervisorField.style.display = 'block';
                                } else {
                                    supervisorField.style.display = 'none';
                                }
                            });
                        </script>



                    </div>

                    <!-- Botones de acción -->
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-primary btn-lg" type="submit">
                                <i class="fas fa-save"></i> Crear Usuario
                            </button>
                        </div>
                        <div class="col-md-3 d-grid">
                            <a class="btn btn-danger btn-lg" href="<?= site_url('gespe/usuarios/nomina') ?>">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Mostrar errores de validación -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger mt-4">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </main>