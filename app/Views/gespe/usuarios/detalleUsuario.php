<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4"></div>
            <form action="<?= site_url('gespe/usuarios/actualizarUsuario/' . $usuarioVisto['id_usuario']) ?>" method="post">
                <?= csrf_field() ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" name="nombres" id="nombres" class="form-control" value="<?= esc($usuarioVisto['nombres']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?= esc($usuarioVisto['apellidos']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control" value="<?= esc($usuarioVisto['correo']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="<?= esc($usuarioVisto['telefono']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label for="rol" class="form-label">Rol</label>
                        <select name="rol" id="rol" class="form-select" required>
                            <option value="1" <?= $usuarioVisto['id_rol'] == 1 ? 'selected' : '' ?>>Gerente</option>
                            <option value="2" <?= $usuarioVisto['id_rol'] == 2 ? 'selected' : '' ?>>Administrador</option>
                            <option value="3" <?= $usuarioVisto['id_rol'] == 3 ? 'selected' : '' ?>>Supervisor</option>
                            <option value="4" <?= $usuarioVisto['id_rol'] == 4 ? 'selected' : '' ?>>Operativo</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Actualizar Usuario</button>
            </form>
        </div>
    </main>