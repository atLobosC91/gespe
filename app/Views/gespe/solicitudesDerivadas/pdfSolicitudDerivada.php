<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Solicitud Derivada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #000;
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
            <th>Solicitado por</th>
            <td><?= $detallePermiso['solicitado_por'] ?></td>
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
            <th>Motivo</th>
            <td><?= $detallePermiso['motivo'] ?></td>
        </tr>
    </table>
</body>

</html>