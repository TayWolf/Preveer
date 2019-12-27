<?php
$idUsuarioBase = $_REQUEST['idusuariobase'];
$tipoUser = $_REQUEST['tipoUser'];
$cambioPas = $_REQUEST['cambioPas'];
$idUsuarioBase = 9;
$tipoUser = 4;
$cambioPas = 1;
$idAsignacion=$_REQUEST['idAsignacion'];
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

<!--Formulario-->
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
<script>
    var array = {
        'datosBitacora': []
    };
</script>


<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Bitácora de detectores de humo</h2>
                    </div>
                    <div class="body">
                        <form id="formDatosBitacora"></form>
                        <form id="form">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
                                <?php
                                $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                                $conexion->query("SET CHARACTER SET utf8");
                                $tabla='BitacoraDetectoresHumo';
                                $tablaBitacora=$conexion->query("SELECT $tabla.* FROM $tabla WHERE idAsignacion=$idAsignacion");
                                ?>
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                                <i class="material-icons">assignment</i> Bitácora
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Área de ubicación</b>
                                                            <select class="form-control" id="areaUbicacion" name="areaUbicacion" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <?php
                                                                $areasUbicacion=$conexion->query("SELECT * FROM areaClubesSW");
                                                                    if($areasUbicacion):?>
                                                                <?php foreach($areasUbicacion as $row):?>
                                                                <option value="<?=$row['idArea']?>"><?=$row['descripcion']?></option>
                                                                <?endforeach; ?>
                                                                <?php endif;?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>En el plano</b>
                                                            <select class="form-control" id="enElPlano" name="enElPlano" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tipo de sensor</b>
                                                            <select class="form-control" id="tipoSensor" name="tipoSensor" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Humo</option>
                                                                <option value="2">Calor</option>
                                                                <option value="3">Gases de combustión</option>
                                                                <option value="4">Flama</option>
                                                                <option value="5">Otros</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Libre de obstrucción</b>
                                                            <select class="form-control" id="libreObstruccion" name="libreObstruccion" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Indicador luminoso funcionando</b>
                                                            <select class="form-control" id="indicadorLuminoso" name="indicadorLuminoso" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cuenta con baterias</b>
                                                            <select class="form-control" id="carga" name="carga" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Activación indicada en el tablero</b>
                                                            <select class="form-control" id="activacionTablero" name="activacionTablero" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>En buen estado</b>
                                                            <select class="form-control" id="enBuenEstado" name="enBuenEstado" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Limpio</b>
                                                            <select class="form-control" id="limpio" name="limpio" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Revisar que no se encuentren insectos</b>
                                                            <select class="form-control" id="insectos" name="insectos" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Equipo fijo y correcto en su ubicación</b>
                                                            <select class="form-control" id="equipoFijo" name="equipoFijo" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Mes de mantenimiento</b>
                                                            <select class="form-control" id="mesMantenimiento" name="mesMantenimiento" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <textarea type="text" class="form-control" id="observaciones" name="observaciones" min="0" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <div class="row text-center">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-md-offset-5">
                                                        <div class="form-line">
                                                            <input type="submit" value="Agregar" class="btn bg-red" id="agregar-in">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="body table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Área de ubicación</th>
                                                        <th>En el plano</th>
                                                        <th>Tipo de sensor</th>
                                                        <th>Libre de obstrucción</th>
                                                        <th>Indicador luminoso funcionando</th>
                                                        <th>Cuenta con baterias</th>
                                                        <th>Activación indicada en el tablero</th>
                                                        <th>En buen estado</th>
                                                        <th>Limpio</th>
                                                        <th>Revisar que no se encuentren insectos</th>
                                                        <th>Equipo fijo y correcto en su ubicación</th>
                                                        <th>Mes de mantenimiento</th>
                                                        <th>Observaciones</th>
                                                        <th>Oportunidades de mejora</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="lista">

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </form>
                    <div class="panel-body">
                        <div class="row text-center">
                            <div class="col-sm-12 col-md-offset-5">
                                <div class="form-line">
                                    <input type="submit" onclick="registrarDatos();" class="btn bg-red waves-effect waves-light"  value="Guardar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalFoto" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                Oportunidades de mejora del detector de humo
            </div>
            <div class="modal-body" id="contenidoModal">
                <div class="row">
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraHumo1" name="fotoOportunidadMejoraHumo1[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraHumo2" name="fotoOportunidadMejoraHumo2[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraHumo3" name="fotoOportunidadMejoraHumo3[]" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <div class="form-line">
                                <b>Oportunidad de mejora</b>
                                <textarea class="form-control" id="oportunidadMejoraHumo" name="oportunidadMejoraHumo" onblur="subirOportunidadMejora()"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="subirOportunidadMejora()">Subir oportunidad de mejora</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var llavePrimariaActual;
    function registrarDatos()
    {
        accion = "actualizarBitacora001/"+$("#idAsignacion").val();
        var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/';?>" + accion;
        var formData=new FormData(document.getElementById("formDatosBitacora"));
        formData.append('datosBitacora', (JSON.stringify(array.datosBitacora)));

        console.log(JSON.stringify(array.datosBitacora));
        $.ajax({
            url: url,
            type: "post",
            dataType: "html",
            data: formData,
            cache : false,
            contentType: false,
            processData: false

        }).done(function (res) {
            console.log(res);
            swal({
                    title: "Éxito",
                    text: "Se ha registrado la bitacora",
                    type: "success",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                },
                function () {
                    location.reload();
                });
        });

    }


    $("#form").on("submit", function(e){
        e.preventDefault();
        AgregarDatosBitacora();
    });


    function AgregarDatosBitacora()
    {
        var areaUbicacion = $("#areaUbicacion").val();
        var enElPlano = $("#enElPlano").val();
        var tipoSensor = $("#tipoSensor").val();
        var libreObstruccion = $("#libreObstruccion").val();
        var indicadorLuminoso = $("#indicadorLuminoso").val();
        var carga = $("#carga").val();
        var activacionTablero = $('#activacionTablero').val();
        var enBuenEstado = $('#enBuenEstado').val();
        var limpio = $('#limpio').val();
        var insectos = $('#insectos').val();
        var equipoFijo = $('#equipoFijo').val();
        var mesMantenimiento = $('#mesMantenimiento').val();
        var observaciones = $('#observaciones').val();

        var arregloTemporal={'datos':[]};
        // array.datosBitacora.push({'idBitacora': '-1', 'areaUbicacion': areaUbicacion ,'enElPlano': enElPlano,'tipoSensor': tipoSensor,'libreObstruccion': libreObstruccion,'indicadorLuminoso': indicadorLuminoso,'carga': carga,'activacionTablero':activacionTablero,'enBuenEstado':enBuenEstado,'limpio':limpio,'insectos':insectos,'equipoFijo':equipoFijo,'mesMantenimiento':mesMantenimiento, 'action' : 1, 'observaciones': observaciones});
        arregloTemporal.datos.push({'areaUbicacion': areaUbicacion ,'enElPlano': enElPlano,'tipoSensor': tipoSensor,'libreObstruccion': libreObstruccion,'indicadorLuminoso': indicadorLuminoso,'cargaBien': carga,'activacionTablero':activacionTablero,'enBuenEstado':enBuenEstado,'limpio':limpio,'insectos':insectos,'equipoFijo':equipoFijo,'mesMantenimiento':mesMantenimiento, 'observaciones': observaciones});

        var formData=new FormData(document.getElementById("formDatosBitacora"));
        formData.append('datos', (JSON.stringify(arregloTemporal.datos)));

        //console.log(JSON.stringify(array.datosBitacora, null, 4));

        $.ajax(
            {
                url: "<?=$site_url.('CrudBitacoras/insertarArreglo/'.$idAsignacion.'/BitacoraDetectoresHumo');?>",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'html',
                type: 'post',
                success: function (llavePrimaria)
                {
                    console.log(llavePrimaria);
                    array.datosBitacora.push({'idBitacora': llavePrimaria, 'areaUbicacion': areaUbicacion ,'enElPlano': enElPlano,'tipoSensor': tipoSensor,'libreObstruccion': libreObstruccion,'indicadorLuminoso': indicadorLuminoso,'carga': carga,'activacionTablero':activacionTablero,'enBuenEstado':enBuenEstado,'limpio':limpio,'insectos':insectos,'equipoFijo':equipoFijo,'mesMantenimiento':mesMantenimiento, 'action' : 0, 'observaciones': observaciones});
                    $("#lista").append('<tr>'+
                        '<td>'+array.datosBitacora.length+'</td>'+
                        '<td style="font-weight: normal !important;">'+$("#areaUbicacion option:selected").text()+'</td>'+
                        '<td style="font-weight: normal !important;">'+$("#enElPlano option:selected").text()+'</td>'+
                        '<td>'+$("#tipoSensor option:selected").text()+'</td>'+
                        '<td>'+$("#libreObstruccion option:selected").text()+'</td>'+
                        '<td>'+$("#indicadorLuminoso option:selected").text()+'</td>'+
                        '<td>'+$("#carga option:selected").text()+'</td>'+
                        '<td>'+$("#activacionTablero option:selected").text()+'</td>'+
                        '<td>'+$("#enBuenEstado option:selected").text()+'</td>'+
                        '<td>'+$("#limpio option:selected").text()+'</td>'+
                        '<td>'+$("#insectos option:selected").text()+'</td>'+
                        '<td>'+$("#equipoFijo option:selected").text()+'</td>'+
                        '<td>'+$("#mesMantenimiento option:selected").text()+'</td>'+
                        '<td>'+observaciones+'</td>'+
                        '<td><button type="button" class="btn btn-default" onClick="modalFotos('+llavePrimaria+')"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
                        '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                        '</tr>');
                    console.log(JSON.stringify(array.datosBitacora, null, 4));
                    limpiarFormulario();
                }
            }
        );




    }

    function limpiarFormulario()
    {
        $("#areaUbicacion").val("");
        $("#enElPlano").val("");
        $("#tipoSensor").val("");
        $("#libreObstruccion").val("");
        $("#indicadorLuminoso").val("");
        $("#carga").val("");
        $('#activacionTablero').val("");
        $('#enBuenEstado').val("");
        $('#limpio').val("");
        $('#insectos').val("");
        $('#equipoFijo').val("");
        $('#mesMantenimiento').val("");
        $('#observaciones').val("");
    }

    function modalFotos(llavePrimaria)
    {
        $("#contenidoModal").empty();
        $("#contenidoModal").append("<div class=\"row\">\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraHumo1\" name=\"fotoOportunidadMejoraHumo1[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraHumo2\" name=\"fotoOportunidadMejoraHumo2[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraHumo3\" name=\"fotoOportunidadMejoraHumo3[]\" >\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row\">\n" +
            "                        <div class=\"col-md-6 col-md-offset-3\">\n" +
            "                            <div class=\"form-group\">\n" +
            "                                <div class=\"form-line\">\n" +
            "                                    <b>Oportunidad de mejora</b>\n" +
            "                                    <textarea class=\"form-control\" id=\"oportunidadMejoraHumo\" name=\"oportunidadMejoraHumo\" onblur=\"subirOportunidadMejora()\"></textarea>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>");
        llavePrimariaActual=llavePrimaria;
        var nombreTabla='OportunidadMejoraHumo';
        var campoLlave='idBitacora';
        $.ajax(
            {
                url: "<?=$site_url.("CrudBitacoras/getOportunidadMejora/")?>"+llavePrimaria+"/"+nombreTabla,
                dataType: 'json',
                processData: false,
                cache: false,
                contentType: false,
                success: function (data)
                {
                    var nombreCampo = data[0];

                    for (var key in nombreCampo)
                    {
                        if(key.includes("foto"))
                            crearFileInputTabla(key, data[0][key],nombreTabla, llavePrimaria, campoLlave);
                        else if(key.includes("oportunidad"))
                        {
                            $("#"+key).val(data[0][key]);
                        }
                    }
                }
            }
        );
        $("#modalFoto").modal();
    }
    function crearFileInputTabla(nombreCampo, valorCampo, tabla, llavePrimaria, campoLlave )
    {

        imagen='';
        if(valorCampo)
        {

            imagen="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoBitacoras/"+nombreCampo+"/"+valorCampo+"' class='file-preview-image'>";
        }
        $('#'+nombreCampo).fileinput({
            'resizeImage': true,
            'maxImageWidth': 300,
            'maxImageHeight': 300,
            'resizePreference': 'width',
            'showUploadedThumbs': false,
            'showCaption': false,
            'showCancel': false,
            'showRemove': false,
            'showUpload': false,
            'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/subirFotoGeneralTabla/"+nombreCampo+"/"+tabla+"/"+llavePrimaria+"/"+campoLlave+"",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png'],
            'initialPreview' : [imagen]
        }).on('change', function (event, data, previewId, index) {

            $("#"+nombreCampo).fileinput("upload");

        }).on('fileclear', function (event) {
            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/eliminarImagenArreglo/"+nombreCampo+"/"+tabla+"/"+llavePrimaria+"/"+campoLlave;
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
    }
    function subirOportunidadMejora()
    {

        var oportunidad=$("#oportunidadMejoraHumo").val();
        oportunidad=oportunidad.replace(" ", "%20");
        oportunidad=oportunidad.replace("/", "%30");
        $.ajax(
            {
                url: "<?=$site_url.('CrudBitacoras/subirOportunidadMejora/')?>"+oportunidad+"/"+llavePrimariaActual+"/OportunidadMejoraHumo/oportunidadMejoraHumo",
                dataType: 'html',
                processData: false,
                contentType: false,
                cache: false,
                type: 'post',
                success: function (data)
                {
                    $("#modalFoto").modal("hide");
                }
            }
        );
    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();
        var indice =  $(this).closest('tr').index();
        if(array.datosBitacora[indice]['idBitacora'] == -1)
        {
            array.datosBitacora.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosBitacora[indice]['action']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array.datosBitacora, null, 4));

    });


</script>


<script>
    window.onload = cargaDatosTabla;

    function cargaDatosTabla(){

        <?php
        $contBitacora =1;


        foreach ($tablaBitacora as $row) {

            $idBitacora = $row["idBitacora"];
            $areaUbicacion = $row["areaUbicacion"];
            $enElPlano = $row["enElPlano"];
            $tipoSensor = $row["tipoSensor"];
            $libreObstruccion = $row["libreObstruccion"];
            $indicadorLuminoso = $row["indicadorLuminoso"];
            $cargaBien = $row["cargaBien"];
            $activacionTablero = $row["activacionTablero"];
            $enBuenEstado = $row["enBuenEstado"];
            $limpio = $row["limpio"];
            $insectos = $row["insectos"];
            $equipoFijo = $row["equipoFijo"];
            $mesMantenimiento = $row["mesMantenimiento"];
            $observaciones = $row["observaciones"];
            $idAsignacion = $row["idAsignacion"];



            print "array.datosBitacora.push({'idBitacora': $idBitacora, 'areaUbicacion': $areaUbicacion, 'enElPlano': $enElPlano, 'tipoSensor': $tipoSensor, 'libreObstruccion': $libreObstruccion, 'indicadorLuminoso': $indicadorLuminoso,'carga': $cargaBien,'activacionTablero': $activacionTablero, 'enBuenEstado': $enBuenEstado,'limpio': $limpio,'insectos': $insectos, 'equipoFijo':$equipoFijo,'mesMantenimiento': $mesMantenimiento, 'action' : 0, 'observaciones': '$observaciones'}); \n";

            $areasUbicacion=$conexion->query("SELECT * FROM areaClubesSW");
            //CODIGO PARA CAMBIAR LA UBICACION
            foreach ($areasUbicacion as $itemArea)
            {
                if($areaUbicacion==$itemArea['idArea'])
                {
                    $areaUbicacion=$itemArea['descripcion'];
                    break;
                }
            }


            $enElPlano= ($enElPlano==1)? "Si":(($enElPlano==2)? "No": "N/A");
            $tipoSensor= ($tipoSensor==1)? "Humo":(($tipoSensor==2)? "Calor":($tipoSensor==3)? "Gases de combustión":($tipoSensor==4)? "Flama": "Otros");
            $libreObstruccion= ($libreObstruccion==1)? "Si":(($libreObstruccion==2)? "No": "N/A");
            $indicadorLuminoso= ($indicadorLuminoso==1)? "Si":(($indicadorLuminoso==2)? "No": "N/A");
            $cargaBien= ($cargaBien==1)? "Si":(($cargaBien==2)? "No": "N/A");
            $activacionTablero= ($activacionTablero==1)? "Si":(($activacionTablero==2)? "No": "N/A");
            $enBuenEstado= ($enBuenEstado==1)? "Si":(($enBuenEstado==2)? "No": "N/A");
            $limpio= ($limpio==1)? "Si":(($limpio==2)? "No": "N/A");
            $insectos= ($insectos==1)? "Si":(($insectos==2)? "No": "N/A");
            $equipoFijo= ($equipoFijo==1)? "Si":(($equipoFijo==2)? "No": "N/A");
            $mesMantenimiento= ($mesMantenimiento==1)? "Si":(($mesMantenimiento==2)? "No": "N/A");
            $insectos= ($insectos==1)? "Si":(($insectos==2)? "No": "N/A");
            print "$('#lista').append(
                     '<tr><td hidden>$idBitacora</td><td>$contBitacora</td><td>$areaUbicacion</td><td>$enElPlano</td><td>$tipoSensor</td><td>$libreObstruccion</td><td>$indicadorLuminoso</td><td>$cargaBien</td><td>$activacionTablero</td><td>$enBuenEstado</td><td>$limpio</td><td>$insectos</td><td>$equipoFijo</td><td>$mesMantenimiento</td><td>$observaciones</td><td><button type=\"button\" class=\"btn btn-default\" onClick=\"modalFotos($idBitacora)\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";

            $contBitacora++;
        }
        print("console.log(JSON.stringify(array.datosBitacora, null, 4));");
        ?>
    }

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
