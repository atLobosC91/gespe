<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de la Solicitud Derivada</title>
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

    <h1>Detalle de la Solicitud Derivada</h1>

    <table>
        <tr>
            <th>ID de la Solicitud</th>
            <td><?= $detallePermiso['id_solicitud'] ?></td>
        </tr>
        <tr>
            <th>Tipo de Permiso</th>
            <td><?= $detallePermiso['tipo_permiso'] ?></td>
        </tr>
        <tr>
            <th>Desde</th>
            <td><?= $detallePermiso['fecha_hora_inicio'] ?></td>
        </tr>
        <tr>
            <th>Hasta</th>
            <td><?= $detallePermiso['fecha_hora_fin'] ?></td>
        </tr>
        <tr>
            <th>Estado</th>
            <td><?= $detallePermiso['estado'] ?></td>
        </tr>
        <tr>
            <th>Solicitado por</th>
            <td><?= $detallePermiso['solicitado_por'] ?></td>
        </tr>
        <tr>
            <th>Derivado a</th>
            <td><?= $detallePermiso['supervisor'] ?></td>
        </tr>
        <tr>
            <th>Motivo</th>
            <td><?= $detallePermiso['motivo'] ?></td>
        </tr>
        <tr>
            <th>Administrador</th>
            <td><?= isset($detallePermiso['administrador']) ? $detallePermiso['administrador'] : 'No Derivado' ?></td>
        </tr>
    </table>

</body>

</html>
