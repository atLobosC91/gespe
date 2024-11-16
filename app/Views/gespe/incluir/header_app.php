<?php
$rol = isset($usuario['id_rol']) ? $usuario['id_rol'] : null;
//echo "Rol del usuario: " . $rol;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Panel de Inicio - Gestión de Permisos" />
    <meta name="author" content="INSID Ltda." />
    <title>PANEL DE INICIO</title>
    <!-- Custom Stylesheets -->
    <link href="/assets/css/style.min.css" rel="stylesheet">
    <link href="/assets/css/styles_app.css" rel="stylesheet">
    <!-- JavaScript Libraries -->
    <script src="/assets/js/all.js"></script>
    <script src="/assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="sb-nav-fixed">
    <!-- Top Navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Logo and Brand -->
        <a href="<?= site_url(''); ?>" class="logo">
            <img src="/assets/img/logo.png" alt="INSID Logo" class="img-fluid">
        </a>
        <!-- Sidebar Toggle Button -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- User Dropdown Menu -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="<?= site_url('/logout') ?>">Cerrar Sesión</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar and Main Content Layout -->
    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Dashboard</div>
                        <a class="nav-link" href="<?= site_url('gespe/panelInicio'); ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house-chimney-window"></i></div>
                            Panel de Inicio
                        </a>

                        <!-- Role-Based Menu Options -->
                        <?php if ($rol == 2): // Administrador 
                        ?>
                            <div class="sb-sidenav-menu-heading">Administración</div>

                            <a class="nav-link" href="<?= site_url('gespe/solicitudesDerivadas'); ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                                Solicitudes Derivadas
                            </a>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsuarios"
                                aria-expanded="false" aria-controls="collapseUsuarios">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Gestión de Usuarios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUsuarios" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= site_url('gespe/usuarios/nomina'); ?>">Nómina de Usuarios</a>
                                    <a class="nav-link" href="<?= site_url('gespe/usuarios/nuevoUsuario'); ?>">Nuevo Usuario</a>
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseArea"
                                aria-expanded="false" aria-controls="collapseArea">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Gestión de Área
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseArea" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= site_url('gespe/area/listaArea'); ?>">Lista de Áreas</a>
                                    <a class="nav-link" href="<?= site_url('gespe/area/nuevaArea'); ?>">Nueva Área</a>
                                </nav>
                            </div>



                        <?php elseif ($rol == 3): // Supervisor 
                        ?>
                            <div class="sb-sidenav-menu-heading">Administración</div>

                            <a class="nav-link" href="<?= site_url('gespe/solicitudesDerivadas'); ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                                Solicitudes Derivadas
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePermisos"
                                aria-expanded="false" aria-controls="collapsePermisos">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Gestión de Permisos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePermisos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= site_url('gespe/solicitud/misSolicitudes'); ?>">Mis Permisos</a>
                                    <a class="nav-link" href="<?= site_url('gespe/solicitud/nuevaSolicitud') ?>">Nuevo Permiso</a>
                                </nav>
                            </div>


                        <?php elseif ($rol == 4): // Operativo 
                        ?>
                            <div class="sb-sidenav-menu-heading">Administración</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePermisos"
                                aria-expanded="false" aria-controls="collapsePermisos">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Gestión de Permisos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePermisos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= site_url('gespe/solicitud/misSolicitudes'); ?>">Mis Permisos</a>
                                    <a class="nav-link" href="<?= site_url('gespe/solicitud/nuevaSolicitud') ?>">Nuevo Permiso</a>
                                </nav>
                            </div>

                        <?php elseif ($rol == 1): // Gerente 
                        ?>
                            <div class="sb-sidenav-menu-heading">Gestión Gerencial</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseGerencial"
                                aria-expanded="false" aria-controls="collapseGerencial">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                Gestión Gerencial
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseGerencial" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= site_url('gespe/kpi/kpi') ?>">Dashboard (KPI's)</a>
                                </nav>
                            </div>
                        <?php endif; ?>

                        <div class="sb-sidenav-menu-heading">Configuración</div>
                        <a class="nav-link" href="<?= site_url('gespe/perfil/mi_perfil'); ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            Mi Perfil
                        </a>
                    </div>
                </div>
            </nav>
        </div>