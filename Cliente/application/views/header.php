<?php
//$idUsuarioBase = $_SESSION['idCliente'];
$idUsuarioBase=$this->session->userdata('idCliente');
$nombreCliente=$this->session->userdata('nombreCliente');
if ($idUsuarioBase == "") {
    header("location: https://cointic.com.mx/preveer/Cliente/");
}
//echo "datos ".$idUsuarioBase;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sistema | Preveer</title>
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url('assets/img/favicon.png')?>" type="image/png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">


    <!-- Bootstrap Core Css -->
    <link href="<?=base_url('assets/plugins/bootstrap/css/bootstrap.css')?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url('assets/plugins/node-waves/waves.css')?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url('assets/plugins/animate-css/animate.css')?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=base_url('assets/css/themes/all-themes.css')?>" rel="stylesheet" />


    <link href="<?=base_url('assets/css/personalizado.css')?>" rel="stylesheet" />
    <script src="https://cointic.com.mx/preveer/sistema/assets/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cointic.com.mx/preveer/sistema/assets/sweetalert-master/dist/sweetalert.css">

</head>

<body class="theme-red">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Cargando...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->

<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <!-- <a href="javascript:void(0);" class="bars"></a> -->

            <a class="navbar-brand" href="<?=site_url('menus')?>">
                <img src="<?=base_url('assets/img/logo-preveer.png')?>" alt="Preveer logo">
            </a>

           
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <!--<li class="text-right"><img src="https://dummyimage.com/100x100/000/fff" style="width: 60%; border-radius: 50%; margin-top: 15px;" alt=""></li>-->
                <li>
                    <a style="text-transform:uppercase;cursor: auto;font-weight:bold;color:black;">
                        <?=$this->session->userdata('nombreCliente');?>
                    </a>
                </li>
                <!-- #END# Call Search -->
                <!-- Notifications -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons" style="color:black;">exit_to_app</i>
                    </a>
                    <ul class="dropdown-menu">

                        <li class="footer">
                            <a href="<?php echo site_url('Login/logout')?>"><i class="material-icons">lock</i> Cerrar sesión</a>
                        </li>
                    </ul>
                </li>
                <!-- #END# Notifications -->
                <!-- Tasks -->
                <li class="dropdown">

                </li>
                <!-- #END# Tasks -->
                <li class="pull-right">

                </li>
            </ul>
        </div>
    </div>
</nav>


      