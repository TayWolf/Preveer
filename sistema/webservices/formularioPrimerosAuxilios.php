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

<!--FORM-->

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



<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Lista de los primeros auxilios del centro de trabajo</h2>
            </div>
            <div class="body">
                <form id="form" enctype="multipart/form-data">
                    <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">

                    <?php
                    $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                    $conexion->query("SET CHARACTER SET utf8");
                    $existencia=$conexion->query("SELECT primerosAuxilios.* FROM primerosAuxilios JOIN asignaInmueble ON primerosAuxilios.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                    $contador=0;
                    foreach($existencia as $fila)
                    {
                        $contador++;
                    }
                    if($contador==0)
                    {
                        $insercion=$conexion->prepare("INSERT INTO primerosAuxilios(idAsignacion) VALUES(?)");
                        $insercion->bindParam(1, $idAsignacion);
                        $insercion->execute();
                    }

                    $existencia=$conexion->query("SELECT primerosAuxilios.* FROM primerosAuxilios JOIN asignaInmueble ON primerosAuxilios.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");

                    $contador=0;
                    $row=array('camilla'=>"", 'fotoCamillas'=>"", 'ferulas'=>"", 'fotoFerulas'=> "", 'collarin'=>"", 'fotoCollarin'=>"",
                        'botiquinFijo'=>"", 'fotoBotiquinF'=>"", 'botiquinMovil'=>"", 'fotoBotiquinMovil'=>"", 'inmoCraneal'=>"",
                        'fotoInmoviCraneal'=>"", 'inmoviTipoarana'=>"", 'fotoTipoarana'=>"", 'regadera'=>"", 'fotoRegadera'=>"",'idAsignacion'=>"");
                    foreach ($existencia as $row2)
                    {
                        $row=$row2;

                        $contador++;
                    }

                    $contenidoBotiquin=$conexion->query("SELECT * FROM contenidoBotiquin WHERE idAsignacion=$idAsignacion");
                    ?>

                    <div class="panel-body">
                        <div class="panel-group full-body" id="accordion_Tabla" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-lightgray">
                                <div class="panel-heading" role="tab" id="headingOne_Tabla">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_Tabla" aria-expanded="true" aria-controls="collapseOne_Tabla">
                                            <i class="fa fa-table"></i> Tabla
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_Tabla" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_Tabla">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="body table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Equipo</th>
                                                        <th>Cantidad</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>Camilla</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="number" class="form-control" id="camilla" name="camilla" min="0" value="<?php echo $row['camilla']; ?>"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Férulas</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="number" class="form-control" id="ferulas" name="ferulas" min="0" value="<?php echo $row['ferulas']; ?>"/>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Collarín</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="number" class="form-control" id="collarin" name="collarin" min="0" value="<?php echo $row['collarin']; ?>"/>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Botiquín fijo</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="number" class="form-control" id="botiquinFijo" name="botiquinFijo" min="0" value="<?php echo $row['botiquinFijo']; ?>"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Botiquín móvil</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="number" class="form-control" id="botiquinMovil" name="botiquinMovil" min="0" value="<?php echo $row['botiquinMovil']; ?>"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Inmovilizador craneal</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="number" class="form-control" id="inmoCraneal" name="inmoCraneal" min="0" value="<?php echo $row['inmoCraneal']; ?>"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Inmovilizador tipo araña</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="number" class="form-control" id="inmoviTipoarana" name="inmoviTipoarana" min="0" value="<?php echo $row['inmoviTipoarana']; ?>"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Regadera</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="number" class="form-control" id="regadera" name="regadera" min="0" value="<?php echo $row['regadera']; ?>"/>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <input type="hidden" name="idPauxilios" value="<?php echo $row['idPauxilios'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="panel-group full-body" id="accordion_Tabla" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-lightgray">
                                <div class="panel-heading" role="tab" id="headingOne_contenidoBotiquin">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_contenidoBotiquin" aria-expanded="true" aria-controls="collapseOne_contenidoBotiquin">
                                            <i class="material-icons">assignment</i> Contenido del botiquín
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_contenidoBotiquin" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_contenidoBotiquin">
                                    <div class="panel-body">
                                        <h4>Material seco</h4>

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Ponderador</th>
                                                <th>Cantidad</th>
                                            </tr>
                                            </thead>
                                        </table>

                                        <?php

                                        $contador6=0;
                                        $instalacion6=$conexion->query("SELECT idIndicador, nombreIndicador FROM AcuseIndicadores WHERE idGrupoIndicador=6");

                                        foreach($instalacion6 as $row3)
                                        {

                                            $llavePrimaria=$row3['idIndicador'];
                                            echo "
                                                        <div class='row'>
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                ".$row3["nombreIndicador"]."
                                                            </div>";
                                            echo "
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorMaterialSeco".$contador6."' value='".$row3['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorMaterialSeco".$contador6."' id='select".$llavePrimaria."'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                <div class='form-group'>
                                                                    <div class='form-line'>
                                                                        <input class='form-control' type='number' name='cantidadMaterialSeco".$contador6."' id='cantidad".$llavePrimaria."'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>";
                                            $contador6++;
                                        }
                                        ?>
                                        <h4>Material Húmedo</h4>

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Ponderador</th>
                                                <th>Cantidad</th>
                                            </tr>
                                            </thead>
                                        </table>

                                        <?php
                                        $contador5=0;
                                        $instalacion5=$conexion->query("SELECT idIndicador, nombreIndicador FROM AcuseIndicadores WHERE idGrupoIndicador=5");
                                        foreach($instalacion5 as $row3)
                                        {

                                            $llavePrimaria=$row3['idIndicador'];

                                            echo "
                                                        <div class='row'>
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                ".$row3["nombreIndicador"]."
                                                            </div>";
                                            echo "
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorMaterialHumedo".$contador5."' value='".$row3['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorMaterialHumedo".$contador5."' id='select".$llavePrimaria."'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                <div class='form-group'>
                                                                    <div class='form-line'>
                                                                        <input class='form-control' type='number' name='cantidadMaterialHumedo".$contador5."' id='cantidad".$llavePrimaria."'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>";
                                            $contador5++;
                                        }
                                        ?>

                                        <div class="row">
                                            <div class="col-sm-offset-2 col-sm-8">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Otros contenidos de botiquín</b>

                                                        <textarea class="form-control" name="botiquinOtros" id="botiquinOtros"><?=$row['otrosContenidoBotiquin']?></textarea>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <div class="panel-group full-body" id="accordion_imagenes" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-lightgray">
                                <div class="panel-heading" role="tab" id="headingOne_imagenes">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_imagenes" aria-expanded="true" aria-controls="collapseOne_imagenes">
                                            <i class="material-icons">camera_enhance</i> Fotos
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_imagenes" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_imagenes">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <b>Foto de botiquín abierto</b>
                                                <input type="file" id="fotoBotiquinF" name="fotoBotiquinF[]" data-min-file-count="1">
                                            </div>
                                            <div class="col-sm-4">
                                                <b>Foto de botiquín cerrado</b>
                                                <input type="file" id="fotoBotiquinMovil" name="fotoBotiquinMovil[]" data-min-file-count="1">
                                            </div>
                                            <div class="col-sm-4">
                                                <b>Foto de camilla</b>
                                                <input type="file" id="fotoCamillas" name="fotoCamillas[]" data-min-file-count="1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <b>Foto de equipo inmovilizador</b>
                                                <input type="file" id="fotoInmoviCraneal" name="fotoInmoviCraneal[]" data-min-file-count="1">
                                            </div>
                                            <div class="col-sm-4">
                                                <b>Foto de señalización</b>
                                                <input type="file" id="fotoFerulas" name="fotoFerulas[]" data-min-file-count="1">

                                            </div>
                                            <div class="col-sm-4">
                                                <b>Foto de equipos extras</b>
                                                <input type="file" id="fotoTipoarana" name="fotoTipoarana[]" data-min-file-count="1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <b>Oportunidad de mejora 1</b>
                                                <input type="file" id="fotoRegadera" name="fotoRegadera[]" data-min-file-count="1">
                                            </div>
                                            <div class="col-sm-4">
                                                <b>Oportunidad de mejora 2</b>
                                                <input type="file" id="fotoCollarin" name="fotoCollarin[]" data-min-file-count="1">

                                            </div>
                                            <div class="col-sm-4">
                                                <b>Oportunidad de mejora 3</b>
                                                <input type="file" id="fotoOportunidad3" name="fotoOportunidad3[]" data-min-file-count="1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-offset-5">
                                <div class="form-line">
                                    <input type="submit" class="btn bg-red waves-effect waves-light" value="Guardar">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<script>
    $(document).ready(function ()
    {
        <?php
        foreach ($contenidoBotiquin as $row4)
        {
            if(!empty($row4['idPonderador']))
            {
                echo "$('#select".$row4['idIndicador']."').val(".$row4['idPonderador'].");\n";
                if(!empty($row4['cantidad']))
                {
                    echo "$('#cantidad".$row4['idIndicador']."').val(".$row4['cantidad'].");\n";
                }
            }
        }
        ?>
    });
</script>

<script type="text/javascript">

    $(function(){
        $("#form").on("submit", function(e){
            var url;
            var accion=<?php echo $contador;?>;
            accion='actualizarPrimerosAuxilios/<?php echo $idAsignacion."/".$contador5."/".$contador6?>';

            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/';?>"+accion;
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
                            text: "Se han registrado los primeros auxilios",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){

                            location.reload();
                        });

                });

        });
    });


</script>


<script type="text/javascript">


    $(window).on('load', function()
    {
        $('#fotoCamillas').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoCamillas/primerosAuxilios/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoCamillas"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoCamillas/') . $row['fotoCamillas'] . "\' class='file-preview-image' alt=\'" . $row['fotoCamillas'] . "\' title=\'" . $row['fotoCamillas'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoCamillas").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCamillas';
                $tabla = 'primerosAuxilios';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });

        $('#fotoFerulas').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoFerulas/primerosAuxilios/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoFerulas"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoFerulas/') . $row['fotoFerulas'] . "\' class='file-preview-image' alt=\'" . $row['fotoFerulas'] . "\' title=\'" . $row['fotoFerulas'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoFerulas").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoFerulas';
                $tabla = 'primerosAuxilios';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });


        /*FOTO PARA collarin*/


        $('#fotoCollarin').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoCollarin/primerosAuxilios/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoCollarin"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoCollarin/') . $row['fotoCollarin'] . "\' class='file-preview-image' alt=\'" . $row['fotoCollarin'] . "\' title=\'" . $row['fotoCollarin'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoCollarin").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCollarin';
                $tabla = 'primerosAuxilios';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });

        /*FOTO PARA botiquinFijo*/


        $('#fotoBotiquinF').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoBotiquinF/primerosAuxilios/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoBotiquinF"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoBotiquinF/') . $row['fotoBotiquinF'] . "\' class='file-preview-image' alt=\'" . $row['fotoBotiquinF'] . "\' title=\'" . $row['fotoBotiquinF'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoBotiquinF").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoBotiquinF';
                $tabla = 'primerosAuxilios';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });

        /*foto para botiquinMovil*/

        $('#fotoBotiquinMovil').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoBotiquinMovil/primerosAuxilios/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoBotiquinMovil"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoBotiquinMovil/') . $row['fotoBotiquinMovil'] . "\' class='file-preview-image' alt=\'" . $row['fotoBotiquinMovil'] . "\' title=\'" . $row['fotoBotiquinMovil'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoBotiquinMovil").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoBotiquinMovil';
                $tabla = 'primerosAuxilios';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        /*FOTO PARA TARIMA*/



        $('#fotoInmoviCraneal').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoInmoviCraneal/primerosAuxilios/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoInmoviCraneal"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoInmoviCraneal/') . $row['fotoInmoviCraneal'] . "\' class='file-preview-image' alt=\'" . $row['fotoInmoviCraneal'] . "\' title=\'" . $row['fotoInmoviCraneal'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoInmoviCraneal").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoInmoviCraneal';
                $tabla = 'primerosAuxilios';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        /*FOTO PÄRA inmoviTipoarana*/

        $('#fotoTipoarana').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoTipoarana/primerosAuxilios/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoTipoarana"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoTipoarana/') . $row['fotoTipoarana'] . "\' class='file-preview-image' alt=\'" . $row['fotoTipoarana'] . "\' title=\'" . $row['fotoTipoarana'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoTipoarana").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoTipoarana';
                $tabla = 'primerosAuxilios';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        /*Foto para regadera*/


        $('#fotoRegadera').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoRegadera/primerosAuxilios/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoRegadera"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoRegadera/') . $row['fotoRegadera'] . "\' class='file-preview-image' alt=\'" . $row['fotoRegadera'] . "\' title=\'" . $row['fotoRegadera'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoRegadera").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoRegadera';
                $tabla = 'primerosAuxilios';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        $('#fotoOportunidad3').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoOportunidad3/primerosAuxilios/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoOportunidad3"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . $base_url.('assets/img/fotoAnalisisRiesgo/fotoOportunidad3/') . $row['fotoOportunidad3'] . "\' class='file-preview-image' alt=\'" . $row['fotoOportunidad3'] . "\' title=\'" . $row['fotoOportunidad3'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoOportunidad3").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoOportunidad3';
                $tabla = 'primerosAuxilios';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });

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

<!-- <?php
//include "footer.php";
?> -->