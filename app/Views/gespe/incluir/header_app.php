<?php
// Esta parte es donde inicias la sesión y obtienes el rol del usuario
$rol = isset($usuario['id_rol']) ? $usuario['id_rol'] : null;  // Validar que $usuario esté definido
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PANEL DE INICIO</title>
    <link href="/assets/css/style.min.css" rel="stylesheet">
    <link href="/assets/css/styles_app.css" rel="stylesheet">
    <script src="/assets/js/all.js"></script>
    <script src="/assets/js/scripts.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a href="<?= site_url(''); ?>" class="logo">
            <img src="/assets/img/logo.png" alt="" class="img-fluid">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i>

                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="">Cerrar Sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <br>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Dashboard</div>
                        <a class="nav-link" href="<?= site_url('gespe/panelInicio'); ?>">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house-chimney-window"></i></div>
                            Panel de Inicio
                        </a>

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

                        <!-- Opciones de menú según el rol del usuario -->
                        <?php if ($rol == 2): // Administrador 
                        ?>

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
                            <a class="nav-link" href="<?= site_url('gespe/solicitud/solicitudesDerivadas'); ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                                Solicitudes Derivadas
                            </a>

                        <?php elseif ($rol == 3): // Supervisor 
                        ?>
                            <a class="nav-link" href="<?= site_url('gespe/solicitud/solicitudesDerivadas'); ?>">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                                Solicitudes Derivadas
                            </a>
                        <?php elseif ($rol == 4): // Operativo 
                        ?>
                            <!-- Opciones específicas del rol Operativo -->
                        <?php elseif ($rol == 1): // Gerente 
                        ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseGerencial"
                                aria-expanded="false" aria-controls="collapseGerencial">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                Gestión Gerencial
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseGerencial" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="">Dashboard (KPI's)</a>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Mantención Página Web</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseServicios"
                                aria-expanded="false" aria-controls="collapseServicios">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                Gestión de Servicios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseServicios" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="">Mis Servicios</a>
                                    <a class="nav-link" href="">Nuevo Servicio</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProyectos"
                                aria-expanded="false" aria-controls="collapseProyectos">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                Gestión de Proyectos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProyectos" aria-labelledby="headingOne"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="">Mis Proyectos</a>
                                    <a class="nav-link" href="">Nuevo Proyecto</a>
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