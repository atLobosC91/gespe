<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <br>
            <div class="card-header">
                <h3>Nueva Solicitud de Permiso</h3>
            </div>
            <a href="<?= site_url('gespe/solicitud/misSolicitudes') ?>" class="btn btn-primary" style="margin-top: 20px; margin-left: 20px;">
                <i class="fa-solid fa-arrow-left"></i> Volver a Mis Solicitudes
            </a>
            <!-- Formulario para crear una nueva solicitud -->
            <div class="card card-body" style="margin: 20px; padding: 20px">
                <form action="<?= site_url('gespe/solicitud/crearSolicitud') ?>" method="post">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="tipoPermiso" class="form-label">Tipo de Permiso</label>
                            <select class="form-control" id="tipoPermiso" name="id_permiso">
                                <option value="">Seleccione un tipo de permiso</option>
                                <?php foreach ($tiposPermiso as $permiso) : ?>
                                    <option value="<?= $permiso['id_permiso'] ?>"><?= $permiso['descripcion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Derivar a:</label>
                            <select class="form-control" id="" name="">
                                <option value="">Seleccione a quién derivar solicitud</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="fechaInicio" class="form-label">Desde (Ejemplo: 01-01-2024 08:00)</label>
                            <input type="datetime-local" id="fechaInicio" class="form-control" name="fecha_hora_inicio" required>
                        </div>

                        <div class="col-md-6">
                            <label for="fechaFin" class="form-label">Hasta (Ejemplo: 01-01-2024 18:00)</label>
                            <input type="datetime-local" id="fechaFin" class="form-control" name="fecha_hora_fin" required>
                        </div>

                        

                        <div class="col-md-12">
                            <label for="motivo" class="form-label">Motivo</label>
                            <textarea id="motivo" class="form-control" name="motivo" rows="3" required></textarea>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-paper-plane"></i> Enviar Solicitud
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>