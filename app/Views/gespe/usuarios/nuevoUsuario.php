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
                                <input type="text" class="form-control" id="inputNombres" name="nombres" placeholder="Nombres" required>
                                <label for="inputNombres">Nombres</label>
                            </div>
                        </div>

                        <!-- Apellidos -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputApellidos" name="apellidos" placeholder="Apellidos" required>
                                <label for="inputApellidos">Apellidos</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputUsuario" name="usuario" placeholder="Usuario" required>
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
                                <input type="email" class="form-control" id="inputCorreo" name="correo" placeholder="Correo" required>
                                <label for="inputCorreo">Correo</label>
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputTelefono" name="telefono" placeholder="Teléfono" required>
                                <label for="inputTelefono">Teléfono</label>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="col-md-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder="Dirección" required>
                                <label for="inputDireccion">Dirección</label>
                            </div>
                        </div>

                        <!-- Rol (rellenado dinámicamente desde la base de datos) -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="inputRol" name="rol" required>
                                    <option value="" disabled selected>Seleccionar Rol</option>
                                    <?php foreach ($roles as $rol): ?>
                                        <option value="<?= esc($rol['id_rol']) ?>"><?= esc($rol['descripcion']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputRol">Rol</label>
                            </div>
                        </div>

                        <!-- Área (rellenado dinámicamente desde la base de datos) -->
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="inputArea" name="id_area" required>
                                    <option value="" disabled selected>Seleccionar Área</option>
                                    <?php foreach ($areas as $area): ?>
                                        <option value="<?= esc($area['id']) ?>"><?= esc($area['descripcion']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputArea">Área</label>
                            </div>
                        </div>

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
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>
    </main>