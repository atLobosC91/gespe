<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <h2 class="text-center">Modificar Usuario</h2>
                <form action="<?= site_url('gespe/usuarios/actualizarUsuario/' . $usuarioVisto['id_usuario']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <!-- Nombres -->
                                <tr>
                                    <th>Nombres</th>
                                    <td>
                                        <input type="text" class="form-control" id="nombres" name="nombres" value="<?= esc($usuarioVisto['nombres']) ?>" placeholder="Nombres" required>
                                    </td>
                                </tr>

                                <!-- Apellidos -->
                                <tr>
                                    <th>Apellidos</th>
                                    <td>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= esc($usuarioVisto['apellidos']) ?>" placeholder="Apellidos" required>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Usuario</th>
                                    <td>
                                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?= esc($usuarioVisto['usuario']) ?>" placeholder="Usuario" required>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Nueva Contraseña</th>
                                    <td>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Dejar vacío si no desea cambiar la contraseña">
                                    </td>
                                </tr>


                                <!-- Correo -->
                                <tr>
                                    <th>Correo</th>
                                    <td>
                                        <input type="email" class="form-control" id="correo" name="correo" value="<?= esc($usuarioVisto['correo']) ?>" placeholder="Correo" required>
                                    </td>
                                </tr>

                                <!-- Teléfono -->
                                <tr>
                                    <th>Teléfono</th>
                                    <td>
                                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= esc($usuarioVisto['telefono']) ?>" placeholder="Teléfono" required>
                                    </td>
                                </tr>

                                <!-- Rol -->
                                <tr>
                                    <th>Rol</th>
                                    <td>
                                        <select name="rol" id="rol" class="form-select" required>
                                            <option value="1" <?= $usuarioVisto['id_rol'] == 1 ? 'selected' : '' ?>>Gerente</option>
                                            <option value="2" <?= $usuarioVisto['id_rol'] == 2 ? 'selected' : '' ?>>Administrador</option>
                                            <option value="3" <?= $usuarioVisto['id_rol'] == 3 ? 'selected' : '' ?>>Supervisor</option>
                                            <option value="4" <?= $usuarioVisto['id_rol'] == 4 ? 'selected' : '' ?>>Operativo</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- Estado Activo/Inactivo -->
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        <select name="estado" id="estado" class="form-select" required>
                                            <option value="1" <?= $usuarioVisto['activo'] == 1 ? 'selected' : '' ?>>Activo</option>
                                            <option value="0" <?= $usuarioVisto['activo'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Botones de acción -->
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-3 d-grid">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                        <div class="col-md-3 d-grid">
                            <a href="<?= site_url('gespe/usuarios/nomina') ?>" class="btn btn-danger btn-lg w-100">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>