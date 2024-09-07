
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        PANEL DE INICIO
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        MIS PERMISOS
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="permiso_nuevo.html">PERMISO NUEVO</a>
                            <a class="nav-link" href="solicitudes.html">SOLICITADOS</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">CONFIGURACIÓN</div>
                    <a class="nav-link" href="perfil.html">
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
                        <h3 class="font-weight-light my-4">Bienvenido (a): Usuario</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputFirstName" type="text"
                                            placeholder="Enter your first name" />
                                        <label for="inputFirstName">Rol: </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="inputEmail" type="email"
                                            placeholder="name@example.com" />
                                        <label for="inputEmail">Email: </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputPassword" type="password"
                                            placeholder="Create a password" />
                                        <label for="inputPassword">Dirección: </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input class="form-control" id="inputPasswordConfirm" type="password"
                                            placeholder="Confirm password" />
                                        <label for="inputPasswordConfirm">Ciudad: </label>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <br>
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">DÍAS SOLICITADOS MES ACTUAL</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="small text-white">0</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <br>
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">DÍAS SOLICITADOS TOTALES</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="small text-white">4</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>