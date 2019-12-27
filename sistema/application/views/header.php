<?php
$idUsuarioBase = $_SESSION['idusuariobase'];
$tipoUser = $_SESSION['tipoUser'];
$cambioPas = $_SESSION['cambioPas'];

if ($idUsuarioBase == "") {
    header("location: https://cointic.com.mx/preveer/sistema/");
}
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

    <!-- Morris Chart Css-->
    <link href="<?=base_url('assets/plugins/morrisjs/morris.css')?>" rel="stylesheet" />

    <!-- Custom Css -->

    <link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet">



    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=base_url('assets/css/themes/all-themes.css')?>" rel="stylesheet" />

    <link href="<?=base_url('assets/css/personalizado.css')?>" rel="stylesheet" />
    <link href="<?=base_url('assets/css/mfb.css')?>" rel="stylesheet" />


    <link rel="stylesheet" href="https://cointic.com.mx/preveer/sistema/assets/css/font-awesome.min.css">
    <script src="https://cointic.com.mx/preveer/sistema/assets/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cointic.com.mx/preveer/sistema/assets/sweetalert-master/dist/sweetalert.css">



    <script type="text/javascript">
        window.onload=cambioPassword;
        function cambioPassword()
        {
            var idUsergo=$("#idUsuariogogeado").val();
            $.ajax({
                url : "<?php echo site_url('Crudusuarios/getcamb/')?>/" + idUsergo,
                type: "get",
                dataType: "JSON",
                success: function(data)
                {
                    $("#cambioPassword").val(data.cambio);
                    var tipoCa=$("#cambioPassword").val();
                    if (tipoCa==0)
                    {
                        $("#myModal").modal();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error sget data from ajax');
                }
            });


        }




        function modificarPassword(e)
        {
            var newContra=$("#newContra").val();
            var contraDos=$("#contraDos").val();
            var idUsuarioBase=$("#idUsuariogogeado").val();

            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==13)
                if (newContra!="" && contraDos!="") {
                    if (newContra==contraDos)
                    {
                        $.ajax({
                            url : "<?php echo site_url('Crudusuarios/ModPassword/')?>/" + newContra+"/"+idUsuarioBase,
                            type: "get",
                            dataType: "JSON",
                            success: function(data)
                            {
                                // alert(data)
                                swal("ÉXITO", "La contraseña actualizada", "success")
                                $("#myModal").modal('hide');
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                alert('Error sget data from ajax');
                            }
                        });

                    }else{
                        swal("Aviso", "La contraseña no coinciden.", "warning")
                    }
                }else{
                    swal("Aviso", "Por favor ingrese la contraseña.", "warning")
                };
        }

        function modificarPasswordOn()
        {
            var newContra=$("#newContra").val();
            var contraDos=$("#contraDos").val();
            var idUsuarioBase=$("#idUsuariogogeado").val();


            if (newContra!="" && contraDos!="") {
                if (newContra==contraDos)
                {
                    $.ajax({
                        url : "<?php echo site_url('Crudusuarios/ModPassword/')?>/" + newContra+"/"+idUsuarioBase,
                        type: "get",
                        dataType: "JSON",
                        success: function(data)
                        {
                            // alert(data)
                            swal("ÉXITO", "La contraseña actualizada", "success")
                            $("#myModal").modal('hide');
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error sget data from ajax');
                        }
                    });

                }else{
                    swal("Aviso", "La contraseña no coinciden.", "warning")
                }
            }else{
                swal("Aviso", "Por favor ingrese la contraseña.", "warning")
            }
        }

    </script>
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

            <input type="hidden" id="cambioPassword" name="cambioPassword" >
            <input type="hidden" id="idUsuariogogeado" name="idUsuariogogeado" value="<?php echo $idUsuarioBase ?>">
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Call Search -->
                <!--<li class="text-right"><img src="https://dummyimage.com/100x100/000/fff" style="width: 60%; border-radius: 50%; margin-top: 15px;" alt=""></li>-->
                <li>
                    <a style="text-transform:uppercase;cursor: auto;font-weight:bold;color:black;">
                        <?=$this->session->userdata('nombre');?>
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
                            <a href="<?php echo site_url('Crudusuarios/logout')?>"><i class="material-icons">lock</i> Cerrar sesión</a></li>
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

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content
        <form id="formcontrActua" mmethod="post" action="">-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Por favor actualice su contraseña</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="newContra" name="newContra" onkeypress="modificarPassword(event)" class="form-control" placeholder="Nueva contraseña" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="contraDos" name="contraDos" onkeypress="modificarPassword(event)" class="form-control" placeholder="Verificar contraseña" required />
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <!-- <input type="submit" class="btn btn-default" value="Aceptar">  -->
                <button type="button" class="btn btn-default" id="cambiContraModal" onclick="modificarPasswordOn()" >Aceptar</button>
            </div>

        </div>
        <!--  </form> -->
    </div>
</div>
      