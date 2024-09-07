<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            background-color: #f1f1f1;
            padding: 10px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: #000;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        .dashboard-content {
            padding: 20px;
        }

        .info-card {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="position-sticky">
                    <h4>LOGO</h4>
                    <a href="#">Panel de Inicio</a>
                    <a href="#">Solicitudes</a>
                    <a href="#">Mis Permisos</a>
                    <ul>
                        <li><a href="#">Nuevo Permiso</a></li>
                        <li><a href="#">Listado Permisos</a></li>
                    </ul>
                    <a href="#">Administración</a>
                    <ul>
                        <li><a href="#">Usuarios</a></li>
                        <li><a href="#">Roles</a></li>
                        <li><a href="#">Áreas</a></li>
                        <li><a href="#">Tipo Permiso</a></li>
                    </ul>
                    <a href="#">Configuración</a>
                    <ul>
                        <li><a href="#">Mi Perfil</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 dashboard-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Panel de Inicio</h2>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <span>Bienvenido (a) - RRHH</span>
                        </div>
                    </div>
                </div>

                <!-- User Info Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="info-card">
                            <h5>Bienvenido (a): Usuario X</h5>
                            <p><strong>Rol:</strong> RRHH &nbsp;&nbsp;|&nbsp;&nbsp; <strong>Email:</strong> user@insid.cl &nbsp;&nbsp;|&nbsp;&nbsp; <strong>Teléfono:</strong> +56912345678</p>
                            <p><strong>Dirección:</strong> Villa Aleatoria, Pasaje 5 #1234 &nbsp;&nbsp;|&nbsp;&nbsp; <strong>Ciudad:</strong> Yerbas Buenas</p>
                        </div>
                    </div>
                </div>

                <!-- Metrics Section -->
                <div class="row text-center">
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6>Días Solicitados Mes Actual</h6>
                            <h3>0</h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card">
                            <h6>Días Solicitados Totales</h6>
                            <h3>4</h3>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>