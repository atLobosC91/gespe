<main>
    <div class="container-fluid px-4">
        <div class="card-header">
            <h3>Detalle de la Solicitud Derivada</h3>
        </div>

        <div class="card card-body" style="margin: 20px; padding: 20px">
            <div class="row g-3 mt-2">
                <div class="col-md-4">
                    <label for="detalleId" class="form-label">ID</label>
                    <input type="text" id="detalleId" class="form-control" value="<?= esc($solicitud['id_solicitud']) ?>" readonly>
                </div>

                <div class="col-md-4">
                    <label for="detalleSolicitante" class="form-label">Solicitante</label>
                    <input type="text" id="detalleSolicitante" class="form-control" value="<?= esc($solicitud['id_usuario']) ?>" readonly>
                </div>

                <div class="col-md-4">
                    <label for="detalleTipoPermiso" class="form-label">Tipo Permiso</label>
                    <input type="text" id="detalleTipoPermiso" class="form-control" value="<?= esc($solicitud['id_permiso']) ?>" readonly>
                </div>

                <!-- Opción de Derivar a Administrador -->
                <div class="col-md-6 mt-3">
                    <form action="<?= site_url('gespe/solicitud/procesarDerivacion') ?>" method="post">
                        <input type="hidden" name="id_solicitud" value="<?= esc($solicitud['id_solicitud']) ?>">
                        <div class="form-group">
                            <label for="id_administrador">Selecciona Administrador para derivar:</label>
                            <select name="id_administrador" id="id_administrador" class="form-control" required>
                                <option value="">-- Selecciona un administrador --</option>
                                <?php foreach ($administradores as $admin): ?>
                                    <option value="<?= esc($admin['id_usuario']) ?>"><?= esc($admin['nombres']) . ' ' . esc($admin['apellidos']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Derivar Solicitud</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>