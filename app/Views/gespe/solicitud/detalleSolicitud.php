<br>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card-header">
                <h3>Detalle de la Solicitud</h3>
            </div>

            <div class="card card-body" style="margin: 20px; padding: 20px">
                <div class="row g-3 mt-2">
                    <div class="col-md-4">
                        <label for="detalleId" class="form-label">ID</label>
                        <input type="text" id="detalleId" class="form-control" value="<?= esc($detallePermiso['id_solicitud']) ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="detalleTipoPermiso" class="form-label">Tipo Permiso</label>
                        <input type="text" id="detalleTipoPermiso" class="form-control" value="<?= esc($detallePermiso['tipo_permiso']) ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="detalleEstado" class="form-label">Estado</label>
                        <input type="text" id="detalleEstado" class="form-control" value="<?= esc($detallePermiso['estado']) ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="detalleFechaInicio" class="form-label">Desde</label>
                        <input type="text" id="detalleFechaInicio" class="form-control" value="<?= esc($detallePermiso['fecha_hora_inicio']) ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="detalleFechaFin" class="form-label">Hasta</label>
                        <input type="text" id="detalleFechaFin" class="form-control" value="<?= esc($detallePermiso['fecha_hora_fin']) ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="detalleSupervisor" class="form-label">Supervisor</label>
                        <input type="text" id="detalleSupervisor" class="form-control" value="<?= esc($detallePermiso['supervisor']) ?>" readonly>
                    </div>

                    <div class="col-md-12">
                        <label for="detalleMotivo" class="form-label">Motivo</label>
                        <textarea id="detalleMotivo" class="form-control" readonly><?= esc($detallePermiso['motivo']) ?></textarea>
                    </div>
                </div>

                <a href="<?= site_url('gespe/solicitud/misSolicitudes') ?>" class="btn btn-primary mt-4">
                    <i class="fa-solid fa-arrow-left"></i> Volver a Mis Solicitudes
                </a>
            </div>
        </div>
    </main>