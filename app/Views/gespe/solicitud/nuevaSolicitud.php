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


                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>



                <form action="<?= site_url('gespe/solicitud/crearSolicitud') ?>" method="post">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" id="tipoPermiso" name="id_permiso">
                                    <option value="">Seleccione un tipo de permiso</option>
                                    <?php foreach ($tiposPermiso as $permiso) : ?>
                                        <option value="<?= $permiso['id_permiso'] ?>"><?= $permiso['descripcion'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="tipoPermiso">Tipo de Permiso</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control" id="inputSupervisor" name="id_supervisor" required>
                                    <option value="">Seleccione a quién derivar solicitud</option>
                                    <?php foreach ($supervisores as $supervisor): ?>
                                        <option value="<?= esc($supervisor['id_usuario']) ?>">
                                            <?= esc($supervisor['nombres']) ?> <?= esc($supervisor['apellidos']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="inputSupervisor">Derivar a:</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_hora_inicio" class="form-label">Desde</label>
                            <input type="datetime-local" id="fecha_hora_inicio" name="fecha_hora_inicio" class="form-control" value="<?= set_value('fecha_hora_inicio') ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="fecha_hora_fin" class="form-label">Hasta</label>
                            <input type="datetime-local" id="fecha_hora_fin" name="fecha_hora_fin" class="form-control" value="<?= set_value('fecha_hora_fin') ?>">
                        </div>


                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea id="motivo" class="form-control" name="motivo" rows="3" required></textarea>
                                <label for="motivo">Motivo</label>
                            </div>
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