<div id="layoutSidenav_content">
    <main>
        <div class="container mt-4">
            <div class="card p-4 shadow-sm">
                <h2 class="text-center">Modificar Área</h2>
                <form action="<?= site_url('gespe/area/actualizar/' . $area['id']) ?>" method="post">
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-8 mb-3">
                            <input type="text" class="form-control" id="inputNombreArea" name="nombre" value="<?= esc($area['descripcion']) ?>" required>
                        </div>
                    </div>
                    <div class="row mt-4 justify-content-center">
                        <div class="col-md-3 d-grid">
                            <button class="btn btn-primary btn-lg w-100" type="submit">
                                <i class="fas fa-save"></i> Guardar Cambios
                            </button>
                        </div>
                        <div class="col-md-3 d-grid">
                            <a class="btn btn-danger btn-lg w-100" href="<?= site_url('gespe/area/listaArea') ?>">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
