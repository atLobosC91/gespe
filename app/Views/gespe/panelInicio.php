<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="/dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Panel de Inicio
                    </a>

                    <!-- Opciones de menú según el rol del usuario -->
                    <?php if ($rol == 2): // Administrador 
                    ?>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePermisos"
                            aria-expanded="false" aria-controls="collapsePermisos">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Gestión de Permisos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePermisos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/permisos_adm">Mis Permisos</a>
                                <a class="nav-link" href="/permiso_nuevo">Nuevo Permiso</a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsuarios"
                            aria-expanded="false" aria-controls="collapseUsuarios">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Gestión de Usuarios
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseUsuarios" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/nomina">Nómina de Usuarios</a>
                                <a class="nav-link" href="/usuarios/nuevo">Nuevo Usuario</a>
                            </nav>
                        </div>

                    <?php elseif ($rol == 3): // Supervisor 
                    ?>

                        <a class="nav-link" href="/dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Solicitudes Derivadas
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSupervisor"
                            aria-expanded="false" aria-controls="collapseSupervisor">
                            <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                            Gestión de Permisos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseSupervisor" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/permiso_nuevo">Mis Permisos</a>
                                <a class="nav-link" href="/permiso_nuevo">Nuevo Permiso</a>
                            </nav>
                        </div>

                    <?php elseif ($rol == 4): // Operativo 
                    ?>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTrabajador"
                            aria-expanded="false" aria-controls="collapseTrabajador">
                            <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                            Gestión de Permisos
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseTrabajador" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/permiso_nuevo">Mis Permisos</a>
                                <a class="nav-link" href="/permiso_nuevo">Nuevo Permiso</a>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Configuración</div>
                        <a class="nav-link" href="/perfil">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                            Mi Perfil
                        </a>

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
                                <a class="nav-link" href="/kpi">Dashboard (KPI's)</a>
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
                                <a class="nav-link" href="/servicios">Mis Servicios</a>
                                <a class="nav-link" href="/servicios/nuevo">Nuevo Servicio</a>
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
                                <a class="nav-link" href="/proyectos">Mis Proyectos</a>
                                <a class="nav-link" href="/proyectos/nuevo">Nuevo Proyecto</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseClientes"
                            aria-expanded="false" aria-controls="collapseClientes">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                            Gestión de Clientes
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseClientes" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/clientes">Mis Clientes</a>
                                <a class="nav-link" href="/clientes/nuevo">Nuevo Cliente</a>
                            </nav>
                        </div>
                    <?php endif; ?>

                    <div class="sb-sidenav-menu-heading">Configuración</div>
                    <a class="nav-link" href="/perfil">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Mi Perfil
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="card-header">
                    <h3>Panel de Inicio</h3>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <h4 class="font-weight-light my-4">Bienvenido(a): <?= esc($usuario['nombres']) ?> <?= esc($usuario['apellidos']) ?></h4>
                    </div>

                </div>
                <!-- Mostrar algunas estadísticas o KPIs -->
                <div class="row">
                    <div class="col-xl-4 col-md-4">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Permisos Mes Actual</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="small text-white">0</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Permisos Totales</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="small text-white">4</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Permisos Mes Actual</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="small text-white">0</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información adicional del usuario -->
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input class="form-control" id="inputRol" type="text" value="<?= esc($rol == 2 ? 'Administrador' : ($rol == 3 ? 'Supervisor' : ($rol == 4 ? 'Operativo' : 'Gerente'))) ?>" readonly disabled />
                                    <label for="inputRol">Rol:</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputEmail" type="email" value="<?= esc($usuario['correo']) ?>" disabled />
                                    <label for="inputEmail">Email:</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputTelefono" type="telefono" value="<?= esc($usuario['telefono']) ?>" disabled />
                                    <label for="inputTelefono">Teléfono:</label>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputDireccion" type="direccion" value="<?= esc($usuario['direccion']) ?>" disabled />
                                    <label for="inputDireccion">Dirección:</label>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="inputCiudad" type="direccion" value="" disabled />
                                    <label for="inputCiudad">Ciudad:</label>
                                </div>
                            </div>


                        </div>

                    </form>
                </div>
            </div>
        </main>
    </div>
</div>