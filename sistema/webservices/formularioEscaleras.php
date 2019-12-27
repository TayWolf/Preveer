<?php
$idUsuarioBase = $_REQUEST['idusuariobase'];
$tipoUser = $_REQUEST['tipoUser'];
$cambioPas = $_REQUEST['cambioPas'];
$idUsuarioBase = 9;
$tipoUser = 4;
$cambioPas = 1;
$tipoFormato = 3;
$nombre=$_REQUEST['nombre'];
$idAsignacion=$_REQUEST['idAsignacion'];
$idCentroTrabajo=$_REQUEST['idCentroTrabajo'];
$base_url="https://cointic.com.mx/preveer/sistema/";
$site_url="https://cointic.com.mx/preveer/sistema/index.php/";

if ($idUsuarioBase == "")
{
    header("location: https://cointic.com.mx/preveer/sistema/");
}
?>
<!DOCTYPE html>
<!--HEADER-->
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sistema | Preveer</title>
    <!-- Favicon-->
    <link rel="icon" href="https://cointic.com.mx/preveer/sistema/assets/img/favicon.png" type="image/png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="https://cointic.com.mx/preveer/sistema/assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->

    <link href="https://cointic.com.mx/preveer/sistema/assets/css/style.css" rel="stylesheet">



    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/themes/all-themes.css" rel="stylesheet" />

    <link href="https://cointic.com.mx/preveer/sistema/assets/css/personalizado.css" rel="stylesheet" />
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/mfb.css" rel="stylesheet" />


    <link rel="stylesheet" href="https://cointic.com.mx/preveer/sistema/assets/css/font-awesome.min.css">
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



<style type="text/css">
    .centrico{
        text-align: center;

    }
    .centrado
    {
    }
    .centrado>tr
    {

    }
    .centrado>tr>td
    {
        vertical-align: middle !important;
        align: center !important;
        text-align: center !important;
        /*display:  !important;*/
    }
    .centrado>tr>td>div>div
    {
        vertical-align: middle !important;
        align: center !important;
        text-align: center !important;
        /*display:  !important;*/
    }
    .centrado>tr>td>input
    {
        text-align: center !important;
    }

</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    var contador=0;



    function getDatos()
    {
        var idAsignacion=$("#idAsignacion").val();
        var idTip=$("#idTip").val();
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/getDatosEscaleras/"+idAsignacion+"/"+idTip,
                type: 'POST',
                dataType: 'JSON',
                success: function(data)
                {
                    console.log(data);
                    if (data.length>0)
                    {
                        for(i=0; i<data.length;i++)
                        {
                            $("#optima"+data[i]["idIndicador"]).val(data[i]["optima"]);
                            $("#remplazo"+data[i]["idIndicador"]).val(data[i]["remplazo"]);
                            $("#observaciones"+data[i]["idIndicador"]).val(data[i]["observaciones"]);
                        }
                    }
                }
            });
    }

    function pintadoDatos()
    {
        var tipoF=$("#idTip").val();
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/getGrup/"+tipoF,
                type: 'POST',
                dataType: 'JSON',
                success: function(data)
                {
                    if (data.length>0)
                    {
                        for(i=0; i<data.length;i++)
                        {

                            var titu = "FORMATO DE INSPECCION DE ESCALERAS PORTATILES";

                            $("#contenidoAcordion").append('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">'+
                                '<div class="panel-group full-body" id="accordion_'+data[i]['idGrupo']+'" role="tablist" aria-multiselectable="true">'+
                                '<div class="panel panel-col-lightgray">'+
                                '<div class="panel-heading" role="tab" id="headingOne_'+data[i]['idGrupo']+'">'+
                                '<h4 class="panel-title">'+
                                '<a role="button" data-toggle="collapse" href="#collapseOne_'+data[i]['idGrupo']+'" aria-expanded="true" aria-controls="collapseOne_'+data[i]['idGrupo']+'">'+
                                '<i class="material-icons">assignment</i>'+data[i]['nombreGrupo']+''+
                                '</a>'+
                                '</h4>'+
                                '</div>'+
                                '<div id="collapseOne_'+data[i]['idGrupo']+'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_'+data[i]['idGrupo']+'">'+
                                '<div id="conteniIndica'+data[i]['idGrupo']+'" class="panel-body">'+

                                '</div>'+
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                '</div>');
                            contenidoIn(data[i]['idGrupo']);

                        }
                        $("#tituloPrincipal").append(titu);
                    }
                },
                complete: function()
                {
                    getDatos();
                }
            });
    }

    function contenidoIn(idGrupo)
    {
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/getIndicadores/"+idGrupo,
                type: 'POST',
                dataType: 'JSON',
                success: function(data)
                {
                    if (data.length>0)
                    {
                        for(i=0; i<data.length;i++)
                        {
                            //Colocar name="nombreInputContador" id="nombreInputIdIndicador"

                            $("#conteniIndica"+idGrupo).append(
                                '<div class="col-md-12 col-sm-12 ">'+
                                '<input type="hidden" id="idIni'+data[i]['idIndicador']+'" name="idIni'+contador+'" value="'+data[i]['idIndicador']+'">'+
                                data[i]['nombreIndicador']+
                                '</div>'+
                                // Optima
                                '<div class="col-md-4">'+
                                '<div class="form-group">'+
                                '<div class="form-line">'+
                                '<textarea class="form-control" id="optima'+data[i]['idIndicador']+'" name="optima'+contador+'" placeholder="Optima"></textarea>'+
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                // Remplazo
                                '<div class="col-md-4">'+
                                '<div class="form-group">'+
                                '<div class="form-line">'+
                                '<textarea class="form-control" id="remplazo'+data[i]['idIndicador']+'" name="remplazo'+contador+'" placeholder="Remplazo"></textarea>'+
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                // Observaciones
                                '<div class="col-md-4">'+
                                '<div class="form-group">'+
                                '<div class="form-line">'+
                                '<textarea class="form-control" id="observaciones'+data[i]['idIndicador']+'" name="observaciones'+contador+'" placeholder="Observaciones"></textarea>'+
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                '<div id="Contenid'+data[i]['idIndicador']+'"></div>'
                            );
                            contador++;
                        }

                    }

                }
            });
    }

</script>


<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 id="tituloPrincipal"></h2>
                    </div>
                    <div class="body">
                        <form id="form2">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">

                                <?php
                                $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                                $conexion->query("SET CHARACTER SET utf8");
                                $datosGenerales=$conexion->query("SELECT * FROM datosGeneralesEscalereas WHERE idAsignacion = $idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
                                if(empty($datosGenerales))
                                {
                                    $insert=$conexion->prepare("INSERT INTO datosGeneralesEscalereas(idAsignacion) VALUES (?)");
                                    $insert->bindParam(1, $idAsignacion);
                                    $insert->execute();
                                    $datosGenerales=$conexion->query("SELECT * FROM datosGeneralesEscalereas WHERE idAsignacion = $idAsignacion")->fetchAll(PDO::FETCH_ASSOC);


                                }
                                $datosInspeccion=$conexion->query("SELECT Clientes.nombreCliente, CentrosDeTrabajo.nombre AS CentroDeTrabajo, Formato.nombre, CentrosDeTrabajo.nomContacto, CentrosDeTrabajo.puestoContacto, Usuario.nombre as usuario FROM Clientes JOIN Formato ON Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario = Usuario.idUsuario WHERE CentrosDeTrabajo.idCentroTrabajo = $idCentroTrabajo AND asignaInmueble.idAsignacion = $idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
                                                                ?>
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                                <i class="material-icons">assignment</i> Datos generales
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">

                                            <div class="row">
                                                <input type="hidden" name="idDatosGenerales" value="<?php echo $datosGenerales[0]['idDatosGenerales'];?>">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de revisión</b>
                                                            <input type="date" class="form-control" id="fechaInspeccion" name="fechaInspeccion" required value="<?php echo $datosGenerales[0]['fechaInspeccion']; ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Folio</b>
                                                            <input type="text" class="form-control" id="folio" name="folio" value="<?php echo $datosGenerales[0]['folio']; ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Altura de la escalera (mts)</b>
                                                            <input type="number" class="form-control" id="alturaEscalera" name="alturaEscalera" min="1" value="<?php echo $datosGenerales[0]['alturaEscalera']; ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Uso</b>
                                                            <input type="text" class="form-control" id="uso" name="uso" value="<?php echo $datosGenerales[0]['uso']; ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Inspeccionada por:</b>
                                                            <input type="text" class="form-control" id="inspeccion" name="inspeccion" value="<?php echo $datosGenerales[0]['inspeccionPor']; ?>" required disabled/>
                                                            <input type="hidden" class="form-control" id="inspeccionB" name="inspeccionB" value="<?=$nombre?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <b>Tipo</b>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <br><input class="form-control" type="checkbox" id="tijera" value="0" name="tijera" <?php if($datosGenerales[0]["tijera"] == 1) print 'checked' ?>><label for="tijera">Tijera</label><br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <br><input class="form-control" type="checkbox" id="extensible" value="0" name="extensible" <?php if($datosGenerales[0]["extensible"] == 1) print 'checked' ?>><label for="extensible">Extensible</label><br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <br><input class="form-control" type="checkbox" id="simple" value="0" name="simple" <?php if($datosGenerales[0]['simple'] == 1) print 'checked' ?>><label for="simple">Simple</label><br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <br><input class="form-control" type="checkbox" id="rotula" value="0" name="rotula" <?php if($datosGenerales[0]['rotula'] == 1) print 'checked' ?>><label for="rotula">Rotula</label><br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <b>Material</b>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <br><input class="form-control" type="checkbox" id="metal" value="0" name="metal" <?php if($datosGenerales[0]["metal"] == 1) print 'checked' ?>><label for="metal">Metal</label><br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <br><input class="form-control" type="checkbox" id="madera" value="0" name="madera" <?php if($datosGenerales[0]["madera"] == 1) print 'checked' ?>><label for="madera">Madera</label><br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <br><input class="form-control" type="checkbox" id="aleacion" value="0" name="aleacion" <?php if($datosGenerales[0]["aleacion"] == 1) print 'checked' ?>><label for="aleacion">Aleación Esp.</label><br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <br><input class="form-control" type="checkbox" id="sinteticos" value="0" name="sinteticos" <?php if($datosGenerales[0]["sinteticos"] == 1) print 'checked' ?>><label for="sinteticos">Sintético</label><br>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form id="form">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <input type="hidden" name="idTip" id="idTip" value="<?php echo $tipoFormato;?>">
                            <div class="row">
                                <div id="contenidoAcordion">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4 col-md-offset-5">
                                        <div class="form-line">
                                            <input type="submit" class="btn bg-red waves-effect waves-light" value="Guardar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--<form id="form3">
                            <div class="panel-group full-body" id="accordion_14" role="tablist" aria-multiselectable="true">

                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_14">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_14" aria-expanded="true" aria-controls="collapseOne_14">
                                                <i class="material-icons">assignment</i> Datos de inspección
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_14" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_14">
                                        <div class="panel-body">

                                            <div class="row">
                                                <input type="hidden" name="idDatosGenerales" value="<?php /*//echo $datosGenerales[0]['idDatosGenerales'];*/?>">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Empresa</b>
                                                            <input type="text" class="form-control" id="empresa" name="empresa" required value="<?php /*echo $datosInspeccion[0]['nombreCliente']; */?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Departamento o Área</b>
                                                            <input type="text" class="form-control" id="departamento" name="departamento" value="<?php /*echo $datosInspeccion[0]['CentroDeTrabajo']; */?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Responsable del trabajo</b>
                                                            <input type="text" class="form-control" id="responsableTrabajo" name="responsableTrabajo" min="1" value="<?php /*echo $datosInspeccion[0]['nomContacto']; */?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cargo del responsable del trabajo</b>
                                                            <input type="text" class="form-control" id="cargoResponsableTrabajo" name="cargoResponsableTrabajo" value="<?php /*echo $datosInspeccion[0]['puestoContacto']; */?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Responsable de inspección</b>
                                                            <input type="text" class="form-control" id="responsableInspeccion" name="responsableInspeccion" value="<?php /*echo $datosInspeccion[0]['usuario']; */?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cargo del responsable de inspección</b>
                                                            <input type="text" class="form-control" id="cargoResponsableInspeccion" name="cargoResponsableInspeccion" value="Análista de Riesgo" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>-->

                    </div>
                </div>
            </div>
        </div>

<script>

</script>

<script>
    $("#form").submit(function (e)
    {
        e.preventDefault();

        $("#tijera").is(':checked') ? $("#tijera").val('1') : $("#tijera").val('0');
        $("#extensible").is(':checked') ? $("#extensible").val('1') : $("#extensible").val('0');
        $("#rotula").is(':checked') ? $("#rotula").val('1') : $("#rotula").val('0');
        $("#simple").is(':checked') ? $("#simple").val('1') : $("#simple").val('0');
        $("#metal").is(':checked') ? $("#metal").val('1') : $("#metal").val('0');
        $("#madera").is(':checked') ? $("#madera").val('1') : $("#madera").val('0');
        $("#aleacion").is(':checked') ? $("#aleacion").val('1') : $("#aleacion").val('0');
        $("#sinteticos").is(':checked') ? $("#sinteticos").val('1') : $("#sinteticos").val('0');


        var formData = new FormData(document.getElementById("form"));
        formData.append('datosGenerales', JSON.stringify($('#form2').serializeArray()));

        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/guardarFormatoEscalera/"+contador,
                data: formData,
                type: 'post',
                dataType: 'html',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data)
                {
                    console.log(data);

                    swal({
                            title: "Bien hecho",
                            text: "Formato registrado " + contador,
                            type: "success",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false
                        },
                        function(){
                            location.reload();
                        });
                }
            }
        );
    });


</script>
<script type="text/javascript">
    $( document ).ready(function() {
        pintadoDatos();
    });
</script>



<!--FOOTER-->
<!-- Jquery Core Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/jquery/jquery.min.js')?>"></script>



<!-- Bootstrap Core Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/bootstrap/js/bootstrap.js')?>"></script>

<!-- Select Plugin Js -->
<!-- <script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/bootstrap-select/js/bootstrap-select.js')?>"></script> -->

<!-- Slimscroll Plugin Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-slimscroll/jquery.slimscroll.js')?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/node-waves/waves.js')?>"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-countto/jquery.countTo.js')?>"></script>

<!-- Morris Plugin Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/raphael/raphael.min.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/morrisjs/morris.js')?>"></script>

<!-- ChartJs -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/chartjs/Chart.bundle.js')?>"></script>

<!-- Flot Charts Plugin Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.resize.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.pie.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.categories.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.time.js')?>"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-sparkline/jquery.sparkline.js')?>"></script>

<!-- Custom Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/admin.js')?>"></script>

<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/pages/index.js')?>"></script>


<!-- Demo Js -->
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/demo.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/modernizr.touch.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/mfb.js.js')?>"></script>



<!--JS PARA EDITAR IMAGENES AUTOMATICAMENTE -->
<link href="<?=('https://cointic.com.mx/preveer/sistema/assets/css/fileinput.min.css')?>" rel="stylesheet">
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/piexif.min.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/sortable.min.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/purify.min.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/fileinput.min.js')?>"></script>
<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/es.js')?>"></script>



<script>

    var panel = document.getElementById('panel'),
        menu = document.getElementById('menu'),
        showcode = document.getElementById('showcode'),
        selectFx = document.getElementById('selections-fx'),
        selectPos = document.getElementById('selections-pos'),
        // demo defaults
        effect = 'mfb-zoomin',
        pos = 'mfb-component--br';

    showcode.addEventListener('click', _toggleCode);
    selectFx.addEventListener('change', switchEffect);
    selectPos.addEventListener('change', switchPos);

    function _toggleCode() {
        panel.classList.toggle('viewCode');
    }

    function switchEffect(e){
        effect = this.options[this.selectedIndex].value;
        renderMenu();
    }

    function switchPos(e){
        pos = this.options[this.selectedIndex].value;
        renderMenu();
    }

    function renderMenu() {
        menu.style.display = 'none';
        // ?:-)
        setTimeout(function() {
            menu.style.display = 'block';
            menu.className = pos + effect;
        },1);
    }

</script>


</body>

</html>
