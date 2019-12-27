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
if ($idUsuarioBase == "") {
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
<script type="text/javascript">
    var array = {
        'datosGabinete': []
    };
</script>

<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body">


                        <form id="formDatos"></form>
                        <form id="form" enctype="multipart/form-data" action="">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">

                            <?php

                            $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                            $conexion->query("SET CHARACTER SET utf8");

                            $existencia=$conexion->query("SELECT equipoBombero.* FROM equipoBombero JOIN asignaInmueble ON equipoBombero.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                            $contador=0;
                            foreach($existencia as $filas)
                            {
                                $contador++;
                            }
                            if($contador==0)
                            {
                                  $insercion=$conexion->prepare("INSERT INTO equipoBombero(idAsignacion) VALUES(?)");
                                  $insercion->bindParam(1, $idAsignacion);
                                  $insercion->execute();
                            }
                            $existencia=$conexion->query("SELECT equipoBombero.* FROM equipoBombero JOIN asignaInmueble ON equipoBombero.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                            $tablaEquipo=$conexion->query("SELECT * FROM equipoBomberospuente  WHERE idAsignacion=$idAsignacion");
                            $contador=0;
                            $row=array('idControl'=>"", 'Observaciones'=>"",'fotoEquipoB'=>"",'fotoEquipoBD'=>"",'fotoEquipoBT'=>"",'fotoEquipoBC'=>"",'idAsignacion'=>"");
                            foreach ($existencia as $row2)
                            {
                                $row=$row2;
                                $contador++;
                            }
                            ?>

                            <div class="panel-group full-body" id="accordion_5" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_5">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_5" aria-expanded="true" aria-controls="collapseOne_5">
                                                <i class="material-icons">assignment</i> EQUIPO DE BOMBERO
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_5" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_5">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad Cascos</b>
                                                            <input type="number" class="form-control" id="casco" name="casco" placeholder="Cantidad" min="0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad Monja</b>
                                                            <input type="number" class="form-control" id="monjaCant" name="monjaCant" placeholder="Cantidad" min="0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad Chaquetón</b>
                                                            <input type="number" class="form-control" id="chaquetonCant" name="chaquetonCant" placeholder="Cantidad" min="0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad Pantalón</b>
                                                            <input type="number" class="form-control" id="cantidadPanta" name="cantidadPanta" placeholder="Cantidad" min="0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad Guantes</b>
                                                            <input type="number" class="form-control" id="cantidGuantes" name="cantidGuantes" placeholder="Cantidad" min="0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad Botas</b>
                                                            <input type="number" class="form-control" id="botasCantida" name="botasCantida" placeholder="Cantidad" min="0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad Pala</b>
                                                            <input type="number" class="form-control" id="palaCantida" name="palaCantida" placeholder="Cantidad" min="0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad Pico</b>
                                                            <input type="number" class="form-control" id="picoCantida" name="picoCantida" placeholder="Cantidad" min="0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad Hacha</b>
                                                            <input type="number" class="form-control" id="hachaCantida" name="hachaCantida" placeholder="Cantidad" min="0" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cuenta con bitácora de revisión de gabinetes y equipo de protección personal?</b>
                                                            <select class="form-control" id="cuentaBitacora" name="cuentaBitacora" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                            </select>
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
                                                        <th>#</th>
                                                        <th># Cascos</th>
                                                        <th># Monja</th>
                                                        <th># Chaquetón</th>
                                                        <th># Pantalón</th>
                                                        <th># Guantes</th>
                                                        <th># Botas</th>
                                                        <th># Palas</th>
                                                        <th># Picos</th>
                                                        <th># Hacha</th>
                                                        <th>¿Cuenta con bitácora?</th>
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
                            <div class="panel-group full-body" id="accordion_4" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_4">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_4" aria-expanded="true" aria-controls="collapseOne_4">
                                                <i class="material-icons">assignment</i>Datos generales
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_4">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <b>Observaciones</b>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea id="obserbacionesGrales" name="obserbacionesGrales" rows="4" class="form-control no-resize" placeholder="Observaciones Generales..."><?php echo $row['Observaciones']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 ">
                                                    <b>Foto Uno</b>
                                                    <input type="file" id="fotoEquipoB" name="fotoEquipoB[]" data-min-file-count="1">
                                                </div>
                                                <div class="col-sm-6 col-md-6 ">
                                                    <b>Foto Dos</b>
                                                    <input type="file" id="fotoEquipoBD" name="fotoEquipoBD[]" data-min-file-count="1">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 ">
                                                    <b>Foto Tres</b>
                                                    <input type="file" id="fotoEquipoBT" name="fotoEquipoBT[]" data-min-file-count="1">
                                                </div>
                                                <div class="col-sm-6 col-md-6 ">
                                                    <b>Foto Cuatro</b>
                                                    <input type="file" id="fotoEquipoBC" name="fotoEquipoBC[]" data-min-file-count="1">
                                                </div>
                                            </div>

                                        </div>
                                        <div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4 col-md-offset-5">
                                    <div class="form-line">
                                        <input type="submit" onclick="registrarDatos()" class="btn bg-red waves-effect waves-light" value="Guardar">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>




<script type="text/javascript">
    /*$(function(){
        $("#form").on("submit", function(e){
            var url;
            var accion

            // if(accion==0)
            //     accion="insertarDatosGenerales/";
            // else
                accion="actualizarEquipoBombero/";

            url= ""+accion;
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("form"));

            $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
                .done(function(res){

                    swal({
                            title: "Éxito",
                            text: "Se ha registrado equipo de bombero",
                            type: "success",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",
                        },
                        function(){
                            location.href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formEquipoBombero/'+$("#idAsignacion").val();
                        });
                });
        });
    });
*/
    function registrarDatos()
    {
        var url;
        var accion=<?php echo $contador;?>;
        accion="actualizarEquipoBombero/";
        //accion = "actualizarBitacora006/"+$("#idAsignacion").val()+"/"+$("#idPrimaria").val();
        // var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/';?>" + accion;
        url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/';?>"+accion;
        var formData=new FormData(document.getElementById("form"));
        formData.append('datosGabinete', (JSON.stringify(array.datosGabinete)));

        /*arregloPrimario.datos.push({'idBitacora': $("#idPrimaria").val(),'total': $("#total").val(),'bloqueadaCantidad': $("#bloqueadaCantidad").val(),'bloqueadaNumero': $("#bloqueadaNumero").val(),'bloqueadaObservaciones': $("#bloqueadaObservaciones").val(),'limpiezaCantidad': $("#limpiezaCantidad").val(),'limpiezaNumero': $("#limpiezaNumero").val(),'limpiezaObservaciones': $("#limpiezaObservaciones").val(),'danoCantidad': $("#danoCantidad").val(),'danoNumero': $("#danoNumero").val(),'danoObservaciones': $("#danoObservaciones").val()});*/

        //formData.append('datosPrimarios', (JSON.stringify(arregloPrimario.datos)));
        console.log(JSON.stringify(array.datosGabinete));
        //console.log(JSON.stringify(arregloPrimario.datos));
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
                    text: "Se ha registrado equipo de bombero",
                    type: "success",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                },
                function(){
                    location.reload();
                });
        });

    }
</script>
<!--TODO: colocar estos js en el servidor-->




<script type="text/javascript">

    $(window).on('load', function()
    {

        /* $("#fotoPicoHac").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
             'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoPicoHacB/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
        if($row["fotoPicoHac"]!=NULL)
        {
            echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/').$row['fotoPicoHac']."\' class='file-preview-image' alt=\'".$row['fotoPicoHac']."\' title=\'".$row['fotoPicoHac']."\'>\"]";
        }
        ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPicoHac").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
        $campo = 'fotoPicoHac';
        $tabla = 'equipoBombero';

        echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

        ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });*/

        //
        $('#fotoEquipoB').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoEquipoB/equipoBombero/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoEquipoB"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoEquipoB/') . $row['fotoEquipoB'] . "\' class='file-preview-image' alt=\'" . $row['fotoEquipoB'] . "\' title=\'" . $row['fotoEquipoB'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoEquipoB").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoEquipoB';
                $tabla = 'equipoBombero';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //DOS
        $('#fotoEquipoBD').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoEquipoBD/equipoBombero/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoEquipoBD"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoEquipoBD/') . $row['fotoEquipoBD'] . "\' class='file-preview-image' alt=\'" . $row['fotoEquipoBD'] . "\' title=\'" . $row['fotoEquipoBD'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoEquipoBD").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoEquipoBD';
                $tabla = 'equipoBombero';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //DOS
        //TRES
        $('#fotoEquipoBT').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoEquipoBT/equipoBombero/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoEquipoBT"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoEquipoBT/') . $row['fotoEquipoBT'] . "\' class='file-preview-image' alt=\'" . $row['fotoEquipoBT'] . "\' title=\'" . $row['fotoEquipoBT'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoEquipoBT").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoEquipoBT';
                $tabla = 'equipoBombero';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //TRES
        //CUATRO
        $('#fotoEquipoBC').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoEquipoBC/equipoBombero/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoEquipoBC"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoEquipoBC/') . $row['fotoEquipoBC'] . "\' class='file-preview-image' alt=\'" . $row['fotoEquipoBC'] . "\' title=\'" . $row['fotoEquipoBC'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoEquipoBC").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoEquipoBC';
                $tabla = 'equipoBombero';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //CUATRO

    });
    $("#form").on("submit", function(e){
        e.preventDefault();
        AgregarGabinete();
    });

    function AgregarGabinete()
    {
        var casco = $("#casco").val();
        var monjaCant = $("#monjaCant").val();
        var chaquetonCant = $("#chaquetonCant").val();
        var cantidadPanta = $("#cantidadPanta").val();
        var cantidGuantes = $("#cantidGuantes").val();
        var botasCantida = $("#botasCantida").val();
        var palaCantida = $("#palaCantida").val();
        var picoCantida = $('#picoCantida').val();
        var hachaCantida = $('#hachaCantida').val();
        var cuentaBitacora = $('#cuentaBitacora').val();

        array.datosGabinete.push({'idControl': '-1','casco': casco, 'monjaCant': monjaCant, 'chaquetonCant': chaquetonCant, 'cantidadPanta': cantidadPanta, 'cantidGuantes': cantidGuantes, 'botasCantida': botasCantida,'palaCantida': palaCantida,'picoCantida':picoCantida,'hachaCantida':hachaCantida,'action' : 1, 'cuentaBitacora': cuentaBitacora});
        console.log(JSON.stringify(array.datosGabinete, null, 4));
        //alert(array.datosGabinete.length)
        $("#lista").append('<tr>'+
            '<td>Gabinete '+array.datosGabinete.length+'</td>'+
            '<td>'+casco+'</td>'+
            '<td>'+monjaCant+'</td>'+
            '<td>'+chaquetonCant+'</td>'+
            '<td>'+cantidadPanta+'</td>'+
            '<td>'+cantidGuantes+'</td>'+
            '<td>'+botasCantida+'</td>'+
            '<td>'+palaCantida+'</td>'+
            '<td>'+picoCantida+'</td>'+
            '<td>'+hachaCantida+'</td>'+
            '<td>'+$("#cuentaBitacora option:selected").text()+'</td>'+
            '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
            '</tr>');

        limpiarFormulario();
    }
    function limpiarFormulario()
    {
        $("#casco").val("");
        $("#monjaCant").val("");
        $("#chaquetonCant").val("");
        $("#cantidadPanta").val("");
        $("#cantidGuantes").val("");
        $("#botasCantida").val("");
        $("#palaCantida").val("");
        $('#picoCantida').val("");
        $('#hachaCantida').val("");
        $('#cuentaBitacora').val("");

    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();
        var indice =  $(this).closest('tr').index();
        if(array.datosGabinete[indice]['idControl'] == -1)
        {
            array.datosGabinete.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosGabinete[indice]['action']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array.datosGabinete, null, 4));

    });

    window.onload = cargaDatosTabla;

    function cargaDatosTabla(){
        <?php
        $nGab=1;
        foreach ($tablaEquipo as $row) {
            $idControl = $row["idControl"];
            $casco = $row["casco"];
            $monja = $row["monja"];
            $chaqueton = $row["chaqueton"];
            $pantalon = $row["pantalon"];
            $guantes = $row["guantes"];
            $botas = $row["botas"];
            $pala = $row["pala"];
            $pico = $row["pico"];
            $hacha = $row["hacha"];
            $cuentaBitacora = $row["cuentaBitacora"];



            print "array.datosGabinete.push({'idControl': $idControl, 'casco': $casco,'monjaCant': $monja,'chaquetonCant': $chaqueton, 'cantidadPanta': $pantalon,'cantidGuantes': $guantes,'botasCantida': $botas, 'palaCantida': $pala,'picoCantida':$pico,'hachaCantida':$hacha, 'action' : 0, 'cuentaBitacora': '$cuentaBitacora'}); \n";

            $cuentaBitacora= ($cuentaBitacora==1)? "Si":(($cuentaBitacora==2)? "No": "N/A");
            //'<td>Gabinete '+array.datosGabinete.length+'</td>'+
            print "$('#lista').append('<tr><td hidden>$idControl</td><td>Gabinete $nGab</td><td>$casco</td><td>$monja</td><td>$chaqueton</td><td>$pantalon</td><td>$guantes</td><td>$botas</td><td>$pala</td><td>$pico</td><td>$hacha</td><td>$cuentaBitacora</td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";

            $nGab++;
        }
        print("console.log(JSON.stringify(array.datosGabinete, null, 4));");
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

<!-- <?php
//include "footer.php";
?> -->