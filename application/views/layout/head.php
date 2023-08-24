<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Formatos registros</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables/media/js/jquery.dataTables.min.js"
        integrity="sha256-3aHVku6TxTRUkkiibvwTz5k8wc7xuEr1QqTB+Oo5Q7I=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables/media/css/jquery.dataTables.min.css"
        integrity="sha256-YY1izqyhIj4W3iyJOaGWOpXDSwrHWFL4Nfk+W0LyCHE=" crossorigin="anonymous">

    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- Choices CSS-->
    <link rel="stylesheet"
        href="<?php echo base_url('assets/vendor/choices.js/public/assets/styles/choices.min.css'); ?>">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.default.css'); ?>" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <!-- Favicon -->
    <link rel="icon" href="<?php echo base_url('assets/img/faviconLogo.png'); ?>" type="image/png">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- XLSX -->
    <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
</head>

<body>
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
                            <li class="nav-item"><a class="nav-link text-white" href="login.html"> <span
                                        class="d-none d-sm-inline">Cerrar sesión</span>
                                    <i class="fa-solid fa-right-from-bracket"></i></a></li>
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
                        <h1 class="h4 mb-2">Envio masivo</h1>
                        <p class="text-sm text-gray-500 fw-light mb-0 lh-1">Registro de usuarios</p>
                    </div>
                </div>
                <!-- Sidebar Navidation Menus--><span
                    class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Menú</span>
                <ul class="list-unstyled py-4">
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url('registros');?>">
                            <i class="fa-solid fa-house fa-xl me-md-3"></i> Registros </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url('estadisticas');?>">
                            <i class="fa-solid fa-chart-line fa-xl me-md-3"></i>Reportes </a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url('configuracion');?>">
                            <i class="fa-solid fa-gear fa-xl me-md-3"></i>Configuración </a></li>
                    <li class="sidebar-item d-none"><a class="sidebar-link" href="login.html">
                            <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                                <use xlink:href="#disable-1"> </use>
                            </svg>Login page </a>
                    </li>
                </ul>
            </nav>