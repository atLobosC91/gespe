<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la Solicitud</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            font-size: 20px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #000;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h1>Detalle de la Solicitud de Permiso</h1>

    <table>
        <tr>
            <th>ID de la Solicitud</th>
            <td><?= esc($detallePermiso['id_solicitud']) ?></td>
        </tr>
        <tr>
            <th>Tipo de Permiso</th>
            <td><?= esc($detallePermiso['tipo_permiso']) ?></td>
        </tr>
        <tr>
            <th>Fecha de Inicio</th>
            <td><?= esc($detallePermiso['fecha_hora_inicio']) ?></td>
        </tr>
        <tr>
            <th>Fecha de Fin</th>
            <td><?= esc($detallePermiso['fecha_hora_fin']) ?></td>
        </tr>
        <tr>
            <th>Estado</th>
            <td><?= esc($detallePermiso['estado']) ?></td>
        </tr>
        <tr>
            <th>Supervisor</th>
            <td><?= esc($detallePermiso['supervisor']) ?></td>
        </tr>
        <tr>
            <th>Motivo</th>
            <td><?= esc($detallePermiso['motivo']) ?></td>
        </tr>
    </table>

</body>

</html>