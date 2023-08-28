<div class="page">
    <!-- Main Navbar-->
    <header class="header z-index-50">
        <nav class="nav navbar py-3 px-0 shadow-sm text-white position-relative bg-warning"
            aria-label="Main navigation">
            <!-- Search Box-->
            <div class="search-box shadow-sm">
                <button class="dismiss d-flex align-items-center">
                    <svg class="svg-icon svg-icon-heavy">
                        <use xlink:href="#close-1"> </use>
                    </svg>
                </button>
                <form id="searchForm" action="#" role="search">
                    <input class="form-control shadow-0" type="text" placeholder="What are you looking for...">
                </form>
            </div>
            <div class="container-fluid w-100">
                <div class="navbar-holder d-flex align-items-center justify-content-between w-100">
                    <!-- Navbar Header-->
                    <div class="navbar-header">
                        <!-- Navbar Brand --><a class="navbar-brand d-none d-sm-inline-block" href="index.html">
                            <div class="brand-text d-none d-lg-inline-block"><span>Formatos
                                </span><strong>Registros</strong></div>
                            <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div>
                        </a>
                        <!-- Toggle Button--><a class="menu-btn active" id="toggle-btn"
                            href="#"><span></span><span></span><span></span></a>
                    </div>
                    <!-- Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Search-->
                        <li class="nav-item d-flex align-items-center"><a id="search" href="#">
                                <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                                    <use xlink:href="#find-1"> </use>
                                </svg></a></li>
                        <!-- Logout    -->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url('logout');?>">
                                <span class="d-none d-sm-inline">Cerrar sesión</span>
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar z-index-40" aria-label="Main navigation">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center py-4 px-3"><img
                    class="avatar shadow-0 img-fluid rounded-circle"
                    src="<?php echo base_url('assets/img/faviconLogo.svg');?>" alt="...">
                <div class="ms-3 title">
                    <h1 class="h4 mb-2"><?php echo ucwords($this->session->userdata('nombre_grupo'));?>
                    </h1>
                    <p class="text-sm text-gray-500 fw-light mb-0 lh-1">Registro de usuarios</p>
                </div>
            </div>
            <!-- Sidebar Navidation Menus--><span
                class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Menú</span>
            <ul class="list-unstyled py-4">
                <li class="sidebar-item"><a class="sidebar-link" href="#exampledropdownDropdown"
                        data-bs-toggle="collapse">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pen" viewBox="0 0 16 16">
                            <path
                                d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                        </svg>&nbsp;Registros </a>
                    <ul class="collapse list-unstyled " id="exampledropdownDropdown">
                        <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url('registros');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                    <path
                                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2v9.255S12 12 8 12s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h5.5v2z" />
                                </svg>&nbsp;Personas </a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url('registros');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-people" viewBox="0 0 16 16">
                                    <path
                                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>&nbsp;Equipo </a></li>
                    </ul>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url('reportes');?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-bar-graph" viewBox="0 0 16 16">
                            <path
                                d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1z" />
                            <path
                                d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z" />
                        </svg> Reportes </a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url('configuracion');?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-wrench-adjustable-circle" viewBox="0 0 16 16">
                            <path
                                d="M12.496 8a4.491 4.491 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11c.027.2.04.403.04.61Z" />
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1 0a7 7 0 1 0-13.202 3.249l1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.49 4.49 0 0 1-1.592-.29L4.747 14.2A7 7 0 0 0 15 8Zm-8.295.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27.596-.894Z" />
                        </svg>&nbsp;Configuración </a></li>
            </ul>
        </nav>