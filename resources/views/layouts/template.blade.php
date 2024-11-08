<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">


</head>
<body>
    <div  class="content-template">

        @yield('content')

    </div>

    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid container-fluid-nav">
            <!-- Brand -->
            <a class="navbar-brand" href="#">Administracion</a>
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://via.placeholder.com/40" alt="profile" class="profile-pic">

                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                        </ul>
                    </li>
                    <div class="sidebar-item-display">
                        <a href="#reclamos" data-bs-toggle="collapse" class="d-flex align-items-center justify-content-between">
                            <span>RECLAMOS</span> <i class="fas fa-angle-down"></i>
                        </a>
                        <div class="submenu collapse" id="reclamos">
                            <ul class="list-unstyled">
                                <li><a href="/admin/personas-naturales" class="sidebar-link"><i class="fas fa-user me-2"></i>P. Naturales</a></li>
                                <li><a href="#" class="sidebar-link"><i class="fas fa-building me-2"></i>P. Jurídicas</a></li>
                                <li><a href="#" class="sidebar-link"><i class="fas fa-check-circle me-2"></i>Atendidas</a></li>
                                <li><a href="#" class="sidebar-link"><i class="fas fa-hourglass-half me-2"></i>En atención</a></li>
                                <li><a href="#" class="sidebar-link"><i class="fas fa-exclamation-circle me-2"></i>Por atender</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-item-display">
                        <a href="#quejas" data-bs-toggle="collapse" class="d-flex align-items-center justify-content-between">
                            <span>QUEJAS</span> <i class="fas fa-angle-down"></i>
                        </a>
                        <div class="submenu collapse" id="quejas">
                            <ul class="list-unstyled">
                                <li><a href="#" class="sidebar-link"><i class="fas fa-user me-2"></i>P. Naturales</a></li>
                                <li><a href="#" class="sidebar-link"><i class="fas fa-building me-2"></i>P. Jurídicas</a></li>
                                <li><a href="#" class="sidebar-link"><i class="fas fa-check-circle me-2"></i>Atendidas</a></li>
                                <li><a href="#" class="sidebar-link"><i class="fas fa-hourglass-half me-2"></i>En atención</a></li>
                                <li><a href="#" class="sidebar-link"><i class="fas fa-exclamation-circle me-2"></i>Por atender</a></li>
                            </ul>
                        </div>
                    </div>

                    
                </ul>
            </div>
        </div>
    </nav>


    <!-- Content here -->
    <div class="container-fluid sidebar">
        <div class="sidebar ">
            <div class="sidebar-image p-3">
                <figure class="figure">
                    <a href="/admin">
                        <img src="{{ asset('images/logo-parque.png') }}" alt="Logo Empresa" class="figure-img img-fluid">
                    </a>
                </figure>
            </div>

            <div class="sidebar-item-scroll">
                <div class="sidebar-item">
                    <a href="#reclamos" data-bs-toggle="collapse" class="d-flex align-items-center justify-content-between sidebar-link" onclick="toggleArrow('reclamos')">
                        <span><strong>RECLAMOS</strong></span> <i class="fas fa-angle-down"></i>
                    </a>
                    <div class="submenu collapse" id="reclamos">
                        <ul class="list-unstyled">
                            <li>
                                <a href="#" class="sidebar-link" onclick="showSubmenu('naturales')">
                                    <i class="fas fa-user me-2 "></i><strong>P. Naturales</strong>
                                    <i class="fas fa-chevron-right float-end " id="arrow-reclamos-naturales"></i>
                                </a>
                            </li>
                            <div class="submenu collapse" id="submenu-naturales">
                                <ul class="list-unstyled">
                                    <li><a href="/reclamos-naturales-atendidas" class="sidebar-link"><i class="fas fa-check-circle me-2"></i>Atendidas</a></li>
                                    <li><a href="/reclamos-naturales-por-atender" class="sidebar-link"><i class="fas fa-exclamation-circle me-2"></i>Por atender</a></li>
                                    <li><a href="/reclamos-naturales-en-atencion" class="sidebar-link"><i class="fas fa-hourglass-half me-2"></i>En atención</a></li>
                                </ul>
                            </div>
                            <li>
                                <a href="#" class="sidebar-link" onclick="showSubmenu('juridicas')">
                                    <i class="fas fa-building me-2"></i><strong>P. Jurídicas</strong>
                                    <i class="fas fa-chevron-right float-end " id="arrow-reclamos-juridicas"></i>
                                </a>
                            </li>
                            <div class="submenu collapse" id="submenu-juridicas">
                                <ul class="list-unstyled">
                                    <li><a href="/reclamos-juridicas-atendidas" class="sidebar-link"><i class="fas fa-check-circle me-2"></i>Atendidas</a></li>
                                    <li><a href="/reclamos-juridicas-por-atender" class="sidebar-link"><i class="fas fa-exclamation-circle me-2"></i>Por atender</a></li>
                                    <li><a href="/reclamos-juridicas-en-atencion" class="sidebar-link"><i class="fas fa-hourglass-half me-2"></i>En atención</a></li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="sidebar-item">
                    <a href="#quejas" data-bs-toggle="collapse" class="d-flex align-items-center justify-content-between sidebar-link" onclick="toggleArrow('quejas')">
                        <span><strong>QUEJAS</strong></span> <i class="fas fa-angle-down"></i>
                    </a>
                    <div class="submenu collapse" id="quejas">
                        <ul class="list-unstyled">
                            <li>
                                <a href="#" class="sidebar-link" onclick="showSubmenu('quejas-naturales')">
                                    <i class="fas fa-user me-2"></i><b>P. Naturales</b>
                                    <i class="fas fa-chevron-right float-end" id="arrow-quejas-naturales"></i>
                                </a>
                            </li>
                            <div class="submenu collapse" id="submenu-quejas-naturales">
                                <ul class="list-unstyled">
                                    <li><a href="/quejas-naturales-atendidas" class="sidebar-link"><i class="fas fa-check-circle me-2"></i>Atendidas</a></li>
                                    <li><a href="/quejas-naturales-por-atender" class="sidebar-link"><i class="fas fa-exclamation-circle me-2"></i>Por atender</a></li>
                                    <li><a href="/quejas-naturales-en-atencion" class="sidebar-link"><i class="fas fa-hourglass-half me-2"></i>En atención</a></li>
                                </ul>
                            </div>
                            <li>
                                <a href="#" class="sidebar-link" onclick="showSubmenu('quejas-juridicas')">
                                    <i class="fas fa-building me-2"></i><b>P. Jurídicas</b>
                                    <i class="fas fa-chevron-right float-end" id="arrow-quejas-juridicas"></i>
                                </a>
                            </li>
                            <div class="submenu collapse" id="submenu-quejas-juridicas">
                                <ul class="list-unstyled">
                                    <li><a href="/quejas-juridicas-atendidas" class="sidebar-link"><i class="fas fa-check-circle me-2"></i>Atendidas</a></li>
                                    <li><a href="/quejas-juridicas-por-atender" class="sidebar-link"><i class="fas fa-exclamation-circle me-2"></i>Por atender</a></li>
                                    <li><a href="/quejas-juridicas-en-atencion" class="sidebar-link"><i class="fas fa-hourglass-half me-2"></i>En atención</a></li>
                                </ul>
                            </div>
                        </ul>
                    </div>
                    
                    <a href="/generar-reporte"  class="d-flex align-items-center justify-content-between">
                            <span>Reportes</span>
                    </a>

                    
                </div>
            </div>


        <script>
            function showSubmenu(submenuId) {
            console.log(`Showing submenu for: ${submenuId}`);
            const submenu = document.getElementById(`submenu-${submenuId}`);
            if (submenu) {
                submenu.classList.toggle('show');
            }
        }
        </script>







        </div>



    </div>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>

