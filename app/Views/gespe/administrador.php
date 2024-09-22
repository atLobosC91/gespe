<?= $this->include('gespe/incluir/header_app') ?>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <!-- Menu del Administrador -->
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        PANEL DE INICIO
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        GESTIÓN DE USUARIOS
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="/usuarios/crear">Crear Usuario</a>
                            <a class="nav-link" href="/usuarios/ver">Ver Usuarios</a>
                            <a class="nav-link" href="/usuarios/editar">Editar Usuarios</a>
                            <a class="nav-link" href="/usuarios/eliminar">Eliminar Usuarios</a>
                        </nav>
                    </div>
                    <a class="nav-link" href="/nomina">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                        NÓMINA DE TRABAJADORES
                    </a>
                    <a class="nav-link" href="/permisos/solicitudes">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                        GESTIÓN DE PERMISOS
                    </a>
                    <div class="sb-sidenav-menu-heading">CONFIGURACIÓN</div>
                    <a class="nav-link" href="/perfil">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        PERFIL
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">PANEL DE INICIO</h1>
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="font-weight-light my-4">Bienvenido (a): <?= $usuario['nombres'] ?> <?= $usuario['apellidos'] ?></h3>
                    </div>
                    <div class="card-body">
                        <p>Rol: Administrador</p>
                        <p>Email: <?= $usuario['correo'] ?></p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?= $this->include('gespe/incluir/footer_app') ?>