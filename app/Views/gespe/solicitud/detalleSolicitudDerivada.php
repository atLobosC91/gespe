<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card shadow-sm p-4">
                <h3 class="mb-4">Detalle de la Solicitud Derivada</h3>

                <div class="row g-3">
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" id="detalleId" class="form-control" value="<?= esc($solicitud['id_solicitud']) ?>" readonly>
                            <label for="detalleId">ID Solicitud</label>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" id="detalleSolicitante" class="form-control" value="<?= esc($solicitud['solicitante']) ?>" readonly>
                            <label for="detalleSolicitante">Solicitante</label>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-floating">
                            <input type="text" id="detalleDerivado" class="form-control" value="<?= esc($solicitud['solicitante']) ?>" readonly>
                            <label for="detalleDerivado">Derivado por</label>
                        </div>
                    </div>

                    

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="detalleFechaInicio" class="form-control" value="<?= esc($solicitud['fecha_hora_inicio']) ?>" readonly>
                            <label for="detalleFechaInicio">Fecha Inicio</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="detalleFechaFin" class="form-control" value="<?= esc($solicitud['fecha_hora_fin']) ?>" readonly>
                            <label for="detalleFechaFin">Fecha Fin</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="detalleTipoPermiso" class="form-control" value="<?= esc($solicitud['tipo_permiso']) ?>" readonly>
                            <label for="detalleTipoPermiso">Tipo Permiso</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" id="detalleEstado" class="form-control" value="<?= esc($solicitud['estado_solicitud']) ?>" readonly>
                            <label for="detalleEstado">Estado</label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea id="detalleMotivo" class="form-control" rows="3" readonly><?= esc($solicitud['motivo']) ?></textarea>
                            <label for="detalleMotivo">Motivo</label>
                        </div>
                    </div>
                </div>

                <!-- Botones para aprobar o rechazar solicitud -->
                <form action="<?= site_url('gespe/solicitud/aprobarSolicitud/' . esc($solicitud['id_solicitud'])) ?>" method="post" class="mt-4">
                    <button type="submit" class="btn btn-success mt-3">Aprobar</button>
                </form>
                <form action="<?= site_url('gespe/solicitud/rechazarSolicitud/' . esc($solicitud['id_solicitud'])) ?>" method="post" class="mt-2">
                    <button type="submit" class="btn btn-danger mt-3">Rechazar</button>
                </form>
            </div>
        </div>
    </main>