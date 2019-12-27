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
                        <h2>Bitácora de revisión mensual de lámparas de emergencia</h2>
                    </div>
                    <div class="body">
                        <form id="formDatosBitacora"></form>
                        <form id="form">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?=$idAsignacion?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
                                <?php
                                $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                                $conexion->query("SET CHARACTER SET utf8");
                                $tabla='BitacoraLampara';
                                $bitacoraPrimaria=$conexion->query("SELECT * FROM $tabla WHERE idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
                                if(empty($bitacoraPrimaria))
                                {
                                    $insert=$conexion->prepare("INSERT INTO $tabla (idAsignacion) VALUES(?)");
                                    $insert->bindParam(1, $idAsignacion);
                                    $insert->execute();
                                    $bitacoraPrimaria=$conexion->query("SELECT * FROM $tabla WHERE idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
                                }
                                $tablaPuente='BitacoraLamparaPuente';
                                $tabla='BitacoraLampara';
                                $llavePrimaria='idBitacoraLampara';
                                $tablaBitacora=$conexion->query("SELECT $tablaPuente.* FROM $tablaPuente JOIN $tabla ON $tablaPuente.$llavePrimaria=$tabla.idBitacora WHERE $tabla.idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
                                $areasUbicacion=$conexion->query("SELECT * FROM areaClubesSW");

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
                                                            <b>Pilas en buen estado</b>
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
                                                            <b>Correcto encendido/apagado</b>
                                                            <select class="form-control" id="encendido" name="encendido" required>
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
                                                            <b>Barra de Led</b>
                                                            <select class="form-control" id="barraled" name="barraled" required>
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
                                                            <b>Dos focos</b>
                                                            <select class="form-control" id="dosfocos" name="dosfocos" required>
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
                                                            <b>Otro</b>
                                                            <select class="form-control" id="otro" name="otro" required>
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
                                                            <b>Conectada</b>
                                                            <select class="form-control" id="conectada" name="conectada" required>
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
                                                            <b>Conexiones en buen estado</b>
                                                            <select class="form-control" id="conexionesestado" name="conexionesestado" required>
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
                                                            <b>Tubos fluorecentes en buen estado</b>
                                                            <select class="form-control" id="tubofluorecente" name="tubofluorecente" required>
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
                                                            <b>Prende completa</b>
                                                            <select class="form-control" id="prendecomp" name="prendecomp" required>
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
                                            </div>

                                            <div class="row">
                                            <div class="col-sm-12">
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
                                            <div class="body table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Ubicación</th>
                                                        <th>En el plano</th>
                                                        <th>Pilas en buen estado</th>
                                                        <th>Correcto encendido/apagado</th>
                                                        <th>Barra de Led</th>
                                                        <th>Dos focos</th>
                                                        <th>Otro</th>
                                                        <th>Conectada</th>
                                                        <th>Conexiones en buen estado</th>
                                                        <th>Tubos fluorecentes en buen estado</th>
                                                        <th>Prende completa</th>
                                                        <th>Se encuentra limpia</th>
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
                    	 <?php
                                            $datosBit;
                                            foreach($bitacoraPrimaria as $row)
                                            {
                                                $datosBit=$row;
                                            }
                                            ?>
                                            <div class="row">
                                                <input type="hidden" name="idPrimaria" id="idPrimaria" value="<?php echo $datosBit['idBitacora']?>">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <b>¿El área de ubicación se ilumina por completo con la lámpara de emergencia?</b>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="form-control" id="ubicacionilumina" name="ubicacionilumina" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($datosBit['ubicacionilumina']==1) echo "selected"?>>Sí</option>
                                                                <option value="2" <?php if($datosBit['ubicacionilumina']==2) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <b>Observaciones</b>
                                                        <div class="form-line">
                                                            <input class="form-control"  type="text" name="obserubicacionilumina" id="obserubicacionilumina" value="<?php echo $datosBit['obserUbicacion']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <b>¿La ruta de evacuación se visualiza con la iluminación de emergencia instalada?</b>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="form-control" id="evacuacionilumina" name="evacuacionilumina" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($datosBit['evacilumina']==1) echo "selected"?>>Sí</option>
                                                                <option value="2" <?php if($datosBit['evacilumina']==2) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <b>Observaciones</b>
                                                        <div class="form-line">
                                                            <input class="form-control"  type="text" name="observacionevacuailumina" id="observacionevacuailumina" value="<?php echo $datosBit['obserEvacua']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <b>¿Encuentra la salida de emergencia con la iluminación de emergencia?</b>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <select class="form-control" id="salidailumina" name="salidailumina" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($datosBit['salidailumina']==1) echo "selected"?>>Sí</option>
                                                                <option value="2" <?php if($datosBit['salidailumina']==2) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <b>Observaciones</b>
                                                        <div class="form-line">
                                                            <input class="form-control"  type="text" name="observacionsalidailumina" id="observacionsalidailumina" value="<?php echo $datosBit['obserSalida']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <b>Comentarios y/o observaciones: </b>
                                                        <div class="form-line">
                                                            <input class="form-control"  type="text" name="comentsobservaciones" id="comentsobservaciones" value="<?php echo $datosBit['comentariosObservaciones']?>">
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
                        <input type="file" id="fotoOportunidadMejoraLamparaPuente1" name="fotoOportunidadMejoraLamparaPuente1[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraLamparaPuente2" name="fotoOportunidadMejoraLamparaPuente2[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraLamparaPuente3" name="fotoOportunidadMejoraLamparaPuente3[]" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <div class="form-line">
                                <b>Oportunidad de mejora</b>
                                <textarea class="form-control" id="oportunidadMejoraLamparaPuente" name="oportunidadMejoraLamparaPuente" onblur="subirOportunidadMejora()"></textarea>
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
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraLamparaPuente1\" name=\"fotoOportunidadMejoraLamparaPuente1[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraLamparaPuente2\" name=\"fotoOportunidadMejoraLamparaPuente2[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraLamparaPuente3\" name=\"fotoOportunidadMejoraLamparaPuente3[]\" >\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row\">\n" +
            "                        <div class=\"col-md-6 col-md-offset-3\">\n" +
            "                            <div class=\"form-group\">\n" +
            "                                <div class=\"form-line\">\n" +
            "                                    <b>Oportunidad de mejora</b>\n" +
            "                                    <textarea class=\"form-control\" id=\"oportunidadMejoraLamparaPuente\" name=\"oportunidadMejoraLamparaPuente\" onblur=\"subirOportunidadMejora()\"></textarea>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>");
        llavePrimariaActual=llavePrimaria;
        var nombreTabla='OportunidadMejoraLamparaPuente';
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

        var oportunidad=$("#oportunidadMejoraLamparaPuente").val();
        oportunidad=oportunidad.replace(" ", "%20");
        oportunidad=oportunidad.replace("/", "%30");
        $.ajax(
            {
                url: "<?=$site_url.('CrudBitacoras/subirOportunidadMejora/')?>"+oportunidad+"/"+llavePrimariaActual+"/OportunidadMejoraLamparaPuente/oportunidadMejoraLamparaPuente",
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
        accion = "actualizarBitacora005/"+$("#idAsignacion").val()+"/"+$("#idPrimaria").val();
        var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/';?>" + accion;
        var formData=new FormData(document.getElementById("formDatosBitacora"));
        formData.append('datosBitacora', (JSON.stringify(array.datosBitacora)));

        arregloPrimario.datos.push({'idBitacora': $("#idPrimaria").val(),'ubicacionilumina': $("#ubicacionilumina").val(),'obserubicacionilumina': $("#obserubicacionilumina").val(),'evacuacionilumina': $("#evacuacionilumina").val(),'observacionevacuailumina': $("#observacionevacuailumina").val(),'salidailumina': $("#salidailumina").val(),'observacionsalidailumina': $("#observacionsalidailumina").val(),'comentsobservaciones': $("#comentsobservaciones").val()});

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
        var ubicacion = $("#ubicacion").val();
        var enPlano = $("#enPlano").val();
        var enBuenEstado = $("#enBuenEstado").val();
        var encendido = $("#encendido").val();
        var barraled = $("#barraled").val();
        var dosfocos = $("#dosfocos").val();
        var otro = $("#otro").val();
        var conectada = $('#conectada').val();
        var conexionesestado = $('#conexionesestado').val();
        var tubofluorecente = $('#tubofluorecente').val();
        var prendecomp = $('#prendecomp').val();
        var limpia = $('#limpia').val();
        var observaciones = $('#observaciones').val();

        var arreglo = {'datos': []};
        //arreglo.datos.push({'idBitacora': '-1','ubicacion': ubicacion, 'enPlano': enPlano, 'enBuenEstado': enBuenEstado, 'encendido': encendido, 'barraled': barraled, 'dosfocos': dosfocos,'otro': otro,'conectada':conectada, 'conexionesestado':conexionesestado, 'tubofluorecente':tubofluorecente, 'prendecomp':prendecomp, 'limpia':limpia, 'action' : 1, 'observaciones': observaciones});
        arreglo.datos.push({'ubicacion': ubicacion, 'enPlano': enPlano, 'pilasEstado': enBuenEstado, 'encendido': encendido, 'barraLed': barraled, 'dosFocos': dosfocos,'otro': otro,'conectada':conectada, 'conexionesEstado':conexionesestado, 'tuboFluorecente':tubofluorecente, 'prendeCompleta':prendecomp, 'limpia':limpia, 'observaciones': observaciones});
        var formData = new FormData(document.getElementById('formDatosBitacora'));
        formData.append('datos', JSON.stringify(arreglo.datos));

        $.ajax(
            {
                // url: "https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/insertarArreglo/" + idAsigns+"/BitacoraLampara/",
                url: "<?=$site_url.('CrudBitacoras/insertarArregloPuente/'.$datosBit['idBitacora'].'/BitacoraLamparaPuente/idBitacoraLampara');?>",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    array.datosBitacora.push({'idBitacora': data,'ubicacion': ubicacion, 'enPlano': enPlano, 'enBuenEstado': enBuenEstado, 'encendido': encendido, 'barraled': barraled, 'dosfocos': dosfocos,'otro': otro,'conectada':conectada, 'conexionesestado':conexionesestado, 'tubofluorecente':tubofluorecente, 'prendecomp':prendecomp, 'limpia':limpia, 'action' : 0, 'observaciones': observaciones});

                    $("#lista").append('<tr>'+
                        '<td>'+$("#ubicacion option:selected").text()+'</td>'+
                        '<td style="font-weight: normal !important;">'+$("#enPlano option:selected").text()+'</td>'+
                        '<td>'+$("#enBuenEstado option:selected").text()+'</td>'+
                        '<td>'+$("#encendido option:selected").text()+'</td>'+
                        '<td>'+$("#barraled option:selected").text()+'</td>'+
                        '<td>'+$("#dosfocos option:selected").text()+'</td>'+
                        '<td>'+$("#otro option:selected").text()+'</td>'+
                        '<td>'+$("#conectada option:selected").text()+'</td>'+
                        '<td>'+$("#conexionesestado option:selected").text()+'</td>'+
                        '<td>'+$("#tubofluorecente option:selected").text()+'</td>'+
                        '<td>'+$("#prendecomp option:selected").text()+'</td>'+
                        '<td>'+$("#limpia option:selected").text()+'</td>'+
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
        $("#encendido").val("");
        $("#barraled").val("");
        $("#dosfocos").val("");
        $("#otro").val("");
        $("#conectada").val("");
        $("#conexionesestado").val("");
        $("#tubofluorecente").val("");
        $("#prendecomp").val("");
        $("#limpia").val("");
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
            $pilasEstado = $row["pilasEstado"];
            $encendido = $row["encendido"];
            $barraLed = $row["barraLed"];
            $dosFocos = $row["dosFocos"];
            $otro = $row["otro"];
            $conectada = $row["conectada"];
            $conexionesEstado = $row["conexionesEstado"];
            $tubofluorecente = $row["tubofluorecente"];
            $prendeCompleta = $row["prendeCompleta"];
            $limpia = $row["limpia"];
            $observaciones = $row["observaciones"];


            print "array.datosBitacora.push({'idBitacora': $idBitacora, 'ubicacion': $areaUbicacion,'enPlano': $enPlano,'pilasEstado': $pilasEstado, 'encendido': $encendido,'barraLed': $barraLed,'dosFocos': $dosFocos, 'otro': $otro, 'conectada':$conectada, 'conexionesEstado':$conexionesEstado, 'tubofluorecente':$tubofluorecente, 'prendeCompleta':$prendeCompleta, 'limpia':$limpia, 'action' : 0, 'observaciones': '$observaciones'}); \n";
            $areasUbicacion=$conexion->query("SELECT * FROM areaClubesSW");
                foreach ($areasUbicacion as $itemArea)
            {
                if($areaUbicacion==$itemArea['idArea'])
                {
                    $areaUbicacion=$itemArea['descripcion'];
                    break;
                }
            }

           // $ubicacion= ($ubicacion==1)? "Si":(($ubicacion==2)? "No": "N/A");
            $enPlano= ($enPlano==1)? "Si":(($enPlano==2)? "No": "N/A");
            $pilasEstado= ($pilasEstado==1)? "Si":(($pilasEstado==2)? "No": "N/A");
            $encendido= ($encendido==1)? "Si":(($encendido==2)? "No": "N/A");
            $barraLed= ($barraLed==1)? "Si":(($barraLed==2)? "No": "N/A");
            $dosFocos= ($dosFocos==1)? "Si":(($dosFocos==2)? "No": "N/A");
            $otro= ($otro==1)? "Si":(($otro==2)? "No": "N/A");
            $conectada= ($conectada==1)? "Si":(($conectada==2)? "No": "N/A");
            $conexionesEstado= ($conexionesEstado==1)? "Si":(($conexionesEstado==2)? "No": "N/A");
            $tubofluorecente= ($tubofluorecente==1)? "Si":(($tubofluorecente==2)? "No": "N/A");
            $prendeCompleta= ($prendeCompleta==1)? "Si":(($prendeCompleta==2)? "No": "N/A");
            $limpia= ($limpia==1)? "Si":(($limpia==2)? "No": "N/A");
            print "$('#lista').append('<tr><td hidden>$idBitacora</td><td>$areaUbicacion</td><td>$enPlano</td><td>$pilasEstado</td><td>$encendido</td><td>$barraLed</td><td>$dosFocos</td><td>$otro</td><td>$conectada</td><td>$conexionesEstado</td><td>$tubofluorecente</td><td>$prendeCompleta</td><td>$limpia</td><td>$observaciones</td><td><button type=\"button\" class=\"btn btn-default\" onClick=\"modalFotos($idBitacora)\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
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
