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
    var arregloPrimario = {
        'datos': []
    };
</script>



<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Bitácora de revisión mensual señalética</h2>
                    </div>
                    <div class="body">
                        <form id="formDatosBitacora"></form>
                        
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
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
                                           <form id="form">
                                                <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?=$idAsignacion?>"> 
                                                <div class="row">
                                                    <?php
                                                    $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                                                    $conexion->query("SET CHARACTER SET utf8");
                                                    $tabla='BitacoraSenaletica';
                                                    $bitacoraPrimaria=$conexion->query("SELECT * FROM $tabla WHERE idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
                                                    if(empty($bitacoraPrimaria))
                                                    {
                                                        $insert=$conexion->prepare("INSERT INTO $tabla (idAsignacion) VALUES(?)");
                                                        $insert->bindParam(1, $idAsignacion);
                                                        $insert->execute();
                                                        $bitacoraPrimaria=$conexion->query("SELECT * FROM $tabla WHERE idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
                                                    }
                                                    $tablaPuente='BitacoraSenaleticaPuente';
                                                    $tabla='BitacoraSenaletica';
                                                    $llavePrimaria='idBitacoraSenaletica';
                                                    $tablaBitacora=$conexion->query("SELECT $tablaPuente.* FROM $tablaPuente JOIN $tabla ON $tablaPuente.$llavePrimaria=$tabla.idBitacora WHERE $tabla.idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
                                                    $areasUbicacion=$conexion->query("SELECT * FROM areaClubesSW");

                                                    ?>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Ubicación</b>
                                                                <select class="form-control" id="ubicacion" name="ubicacion" required>
                                                                     <option value="">Seleccione una opción</option>
                                                                    <?php if($areasUbicacion):?>
                                                                    <?php foreach($areasUbicacion as $row):?>
                                                                    <option value="<?=$row['idArea']?>"><?=$row['descripcion']?></option>
                                                                    <?endforeach; ?>
                                                                    <?php endif;?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>En plano</b>
                                                                <select class="form-control" id="enPlano" name="enPlano" required>
                                                                    <option value="">Seleccione una opción</option>
                                                                    <option value="1">Si</option>
                                                                    <option value="2">No</option>
                                                                    <option value="3">N/A</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
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
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Bien colocada</b>
                                                                <select class="form-control" id="bienColocada" name="bienColocada" required>
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
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Se encuentra limpia</b>
                                                                <select class="form-control" id="limpia" name="limpia" required>
                                                                    <option value="">Seleccione una opción</option>
                                                                    <option value="1">Si</option>
                                                                    <option value="2">No</option>
                                                                    <option value="3">N/A</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
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
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Es legible</b>
                                                                <select class="form-control" id="legible" name="legible" required>
                                                                    <option value="">Seleccione una opción</option>
                                                                    <option value="1">Si</option>
                                                                    <option value="2">No</option>
                                                                    <option value="3">N/A</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Observaciones</b>
                                                                <input type="text" class="form-control" id="observaciones" name="observaciones">
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
                                            </form>
                                            <div class="body table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Ubicación</th>
                                                        <th>En el plano</th>
                                                        <th>En buen estado</th>
                                                        <th>Bien colocada</th>
                                                        <th>Se encuentra limpia</th>
                                                        <th>Libre de obstrucción</th>
                                                        <th>Es legible</th>
                                                        <th>Observaciones</th>
                                                        <th>Oportunidades de mejora</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="lista">

                                                    </tbody>

                                                </table>
                                            </div>
                                            <?php
                                            $datosBit;
                                            foreach($bitacoraPrimaria as $row)
                                            {
                                                $datosBit=$row;
                                            }
                                            ?>
                                        <form id="formComple">
                                            <div class="row">
                                                <input type="hidden" name="idPrimaria" id="idPrimaria" value="<?php echo $datosBit['idBitacora']?>">

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <b>Total de señales</b>
                                                        <div class="form-line">
                                                            <input class="form-control"  type="number" name="total" id="total" value="<?php echo $datosBit['total']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <b>Cantidad de señales bloqueadas</b>
                                                        <div class="form-line">
                                                            <input class="form-control" type="number" name="bloqueadaCantidad" id="bloqueadaCantidad" value="<?php echo $datosBit['bloqueadaCantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de señales bloqueadas</b>
                                                            <input class="form-control"  type="number" name="bloqueadaNumero" id="bloqueadaNumero" value="<?php echo $datosBit['bloqueadaNumero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones de señales bloqueadas</b>
                                                            <input class="form-control"  type="text" name="bloqueadaObservaciones" id="bloqueadaObservaciones" value="<?php echo $datosBit['bloqueadaObservaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de señales que requieren limpieza</b>
                                                            <input class="form-control"  type="number" name="limpiezaCantidad" id="limpiezaCantidad" value="<?php echo $datosBit['limpiezaCantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de señales que requieren limpieza</b>
                                                            <input class="form-control"  type="number" name="limpiezaNumero" id="limpiezaNumero" value="<?php echo $datosBit['limpiezaNumero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones de señales que requieren limpieza</b>
                                                            <input class="form-control"  type="text" name="limpiezaObservaciones" id="limpiezaObservaciones" value="<?php echo $datosBit['limpiezaObservaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de señales con daño físico</b>
                                                            <input class="form-control"  type="number" name="danoCantidad" id="danoCantidad" value="<?php echo $datosBit['danoCantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de señales con daño físico</b>
                                                            <input class="form-control"  type="number" name="danoNumero" id="danoNumero" value="<?php echo $datosBit['danoNumero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones de señales con daño físico</b>
                                                            <input class="form-control"  type="text" name="danoObservaciones" id="danoObservaciones" value="<?php echo $datosBit['danoObservaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </form>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                 
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
                Oportunidades de mejora de lámpara
            </div>
            <div class="modal-body" id="contenidoModal">
                <div class="row">
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraSenaletica1" name="fotoOportunidadMejoraSenaletica1[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraSenaletica2" name="fotoOportunidadMejoraSenaletica2[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraSenaletica3" name="fotoOportunidadMejoraSenaletica3[]" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <div class="form-line">
                                <b>Oportunidad de mejora</b>
                                <textarea class="form-control" id="oportunidadMejoraSenaletica" name="oportunidadMejoraSenaletica" onblur="subirOportunidadMejora()"></textarea>
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
    function modalFotos(llavePrimaria)
    {
        $("#contenidoModal").empty();
        $("#contenidoModal").append("<div class=\"row\">\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraSenaletica1\" name=\"fotoOportunidadMejoraSenaletica1[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraSenaletica2\" name=\"fotoOportunidadMejoraSenaletica2[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraSenaletica3\" name=\"fotoOportunidadMejoraSenaletica3[]\" >\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row\">\n" +
            "                        <div class=\"col-md-6 col-md-offset-3\">\n" +
            "                            <div class=\"form-group\">\n" +
            "                                <div class=\"form-line\">\n" +
            "                                    <b>Oportunidad de mejora</b>\n" +
            "                                    <textarea class=\"form-control\" id=\"oportunidadMejoraSenaletica\" name=\"oportunidadMejoraSenaletica\" onblur=\"subirOportunidadMejora()\"></textarea>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>");
        llavePrimariaActual=llavePrimaria;
        var nombreTabla='OportunidadMejoraSenaletica';
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

        var oportunidad=$("#oportunidadMejoraSenaletica").val();
        oportunidad=oportunidad.replace(" ", "%20");
        oportunidad=oportunidad.replace("/", "%30");
        $.ajax(
            {
                url: "<?=$site_url.('CrudBitacoras/subirOportunidadMejora/')?>"+oportunidad+"/"+llavePrimariaActual+"/OportunidadMejoraSenaletica/oportunidadMejoraSenaletica",
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


    function registrarDatos()
    {
        accion = "actualizarBitacora006/"+$("#idAsignacion").val()+"/"+$("#idPrimaria").val();
        var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/';?>" + accion;
        var formData=new FormData(document.getElementById("formComple"));
        formData.append('datosBitacora', (JSON.stringify(array.datosBitacora)));

        arregloPrimario.datos.push({'idBitacora': $("#idPrimaria").val(),'total': $("#total").val(),'bloqueadaCantidad': $("#bloqueadaCantidad").val(),'bloqueadaNumero': $("#bloqueadaNumero").val(),'bloqueadaObservaciones': $("#bloqueadaObservaciones").val(),'limpiezaCantidad': $("#limpiezaCantidad").val(),'limpiezaNumero': $("#limpiezaNumero").val(),'limpiezaObservaciones': $("#limpiezaObservaciones").val(),'danoCantidad': $("#danoCantidad").val(),'danoNumero': $("#danoNumero").val(),'danoObservaciones': $("#danoObservaciones").val()});

        formData.append('datosPrimarios', (JSON.stringify(arregloPrimario.datos)));
        console.log(JSON.stringify(array.datosBitacora));
        console.log(JSON.stringify(arregloPrimario.datos));
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
        var idBit = $("#idPrimaria").val();
        var ubicacion = $("#ubicacion").val();
        var enPlano = $("#enPlano").val();
        var enBuenEstado = $("#enBuenEstado").val();
        var bienColocada = $("#bienColocada").val();
        var limpia = $("#limpia").val();
        var libreObstruccion = $("#libreObstruccion").val();
        var legible = $("#legible").val();
        var observaciones = $('#observaciones').val();
         var arreglo = {'datos': []};

         arreglo.datos.push({'ubicacion': ubicacion, 'enPlano': enPlano, 'enBuenEstado': enBuenEstado, 'bienColocada': bienColocada, 'limpia': limpia, 'libreObstruccion': libreObstruccion,'legible': legible, 'observaciones': observaciones}); 
       /* array.datosBitacora.push({'idBitacora': '-1','ubicacion': ubicacion, 'enPlano': enPlano, 'enBuenEstado': enBuenEstado, 'bienColocada': bienColocada, 'limpia': limpia, 'libreObstruccion': libreObstruccion,'legible': legible,'action' : 1, 'observaciones': observaciones});*/
        console.log(JSON.stringify(array.datosBitacora, null, 4));
        var formData = new FormData(document.getElementById('formDatosBitacora'));
        formData.append('datos', JSON.stringify(arreglo.datos));
        $.ajax(
            {
               // url: "https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/insertarArreglo/" + idAsigns+"/BitacoraProteccionPersonal/",
               url: "<?=$site_url.('CrudBitacoras/insertarArregloSe/'.$datosBit["idBitacora"].'/BitacoraSenaleticaPuente');?>",
                // url: "<?=$site_url.('CrudBitacoras/insertarArregloSe/BitacoraSenaleticaPuente');?>",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    array.datosBitacora.push({'idBitacora': data,'ubicacion': ubicacion, 'enPlano': enPlano, 'enBuenEstado': enBuenEstado, 'bienColocada': bienColocada, 'limpia': limpia, 'libreObstruccion': libreObstruccion,'legible': legible,'action' : 0, 'observaciones': observaciones});

                     $("#lista").append('<tr>'+
                        '<td>'+$("#ubicacion option:selected").text()+'</td>'+
                        '<td style="font-weight: normal !important;">'+$("#enPlano option:selected").text()+'</td>'+
                        '<td>'+$("#enBuenEstado option:selected").text()+'</td>'+
                        '<td>'+$("#bienColocada option:selected").text()+'</td>'+
                        '<td>'+$("#limpia option:selected").text()+'</td>'+
                        '<td>'+$("#libreObstruccion option:selected").text()+'</td>'+
                        '<td>'+$("#legible option:selected").text()+'</td>'+
                        '<td>'+observaciones+'</td>'+
                        '<td><button type="button" class="btn btn-default" onClick="modalFotos('+data+')"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
                        '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                        '</tr>');
                   
                    limpiarFormulario();
                }
            }
        );
    }

    function limpiarFormulario()
    {
        $("#ubicacion").val("");
        $("#enPlano").val("");
        $("#enBuenEstado").val("");
        $("#bienColocada").val("");
        $("#libreObstruccion").val("");
        $("#limpia").val("");
        $("#legible").val("");
        $('#observaciones').val("");
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
        foreach ($tablaBitacora as $row) {
            $idBitacora = $row["idBitacora"];
            $areaUbicacion = $row["ubicacion"];
            $enPlano = $row["enPlano"];
            $enBuenEstado = $row["enBuenEstado"];
            $bienColocada = $row["bienColocada"];
            $limpia = $row["limpia"];
            $libreObstruccion = $row["libreObstruccion"];
            $legible = $row["legible"];
            $observaciones = $row["observaciones"];


            print "array.datosBitacora.push({'idBitacora': $idBitacora, 'ubicacion': $areaUbicacion,'enPlano': $enPlano,'enBuenEstado': $enBuenEstado, 'bienColocada': $bienColocada,'limpia': $limpia,'libreObstruccion': $libreObstruccion, 'legible': $legible, 'action' : 0, 'observaciones': '$observaciones'}); \n";
            $areasUbicacion=$conexion->query("SELECT * FROM areaClubesSW");

            foreach ($areasUbicacion as $itemArea)
            {
                if($areaUbicacion==$itemArea['idArea'])
                {
                    $areaUbicacion=$itemArea['descripcion'];
                    break;
                }
            }

            //$ubicacion= ($ubicacion==1)? "Si":(($ubicacion==2)? "No": "N/A");
            $enPlano= ($enPlano==1)? "Si":(($enPlano==2)? "No": "N/A");
            $enBuenEstado= ($enBuenEstado==1)? "Si":(($enBuenEstado==2)? "No": "N/A");
            $bienColocada= ($bienColocada==1)? "Si":(($bienColocada==2)? "No": "N/A");
            $limpia= ($limpia==1)? "Si":(($limpia==2)? "No": "N/A");
            $libreObstruccion= ($libreObstruccion==1)? "Si":(($libreObstruccion==2)? "No": "N/A");
            $legible= ($legible==1)? "Si":(($legible==2)? "No": "N/A");
            print "$('#lista').append('<tr><td hidden>$idBitacora</td><td>$areaUbicacion</td><td>$enPlano</td><td>$enBuenEstado</td><td>$bienColocada</td><td>$limpia</td><td>$libreObstruccion</td><td>$legible</td><td>$observaciones</td><td><button type=\"button\" class=\"btn btn-default\" onClick=\"modalFotos($idBitacora)\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
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
