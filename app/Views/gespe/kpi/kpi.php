<!-- kpi.php -->
<div class="container">
    <h1>Dashboard de KPIs</h1>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Total Proyectos</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"><?= esc($total_proyectos) ?></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Permisos Aprobados</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div class="small text-white"><?= esc($permisos_aprobados) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>