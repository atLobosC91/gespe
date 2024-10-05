<!-- permiso_nuevo.php -->
<div class="container">
    <h1>Solicitar Nuevo Permiso</h1>
    <form action="/permisos/crear" method="post">
        <div class="form-group">
            <label for="motivo">Motivo del Permiso</label>
            <input type="text" class="form-control" id="motivo" name="motivo" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
        </div>
        <button type="submit" class="btn btn-primary">Solicitar Permiso</button>
    </form>
</div>