<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card-header">
                <h3>Crear Nuevo Usuario</h3>
            </div>

            <div class="card card-body" style="margin: 20px; padding: 20px">
                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('gespe/usuarios/crearUsuario') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" name="nombres" id="nombres" class="form-control" value="<?= old('nombres') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?= old('apellidos') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" name="correo" id="correo" class="form-control" value="<?= old('correo') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" value="<?= old('telefono') ?>" required>
                        </div>

                        <div class="col-md-12">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" value="<?= old('direccion') ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="rol" class="form-label">Rol</label>
                            <select name="rol" id="rol" class="form-select" required>
                                <option value="">Seleccionar Rol</option>
                                <option value="1">Gerente</option>
                                <option value="2">Administrador</option>
                                <option value="3">Supervisor</option>
                                <option value="4">Operativo</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Crear Usuario</button>
                </form>
            </div>
        </div>
    </main>