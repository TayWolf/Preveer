<?php
$idUsuarioBase = $_REQUEST['idusuariobase'];
$tipoUser = $_REQUEST['tipoUser'];
$cambioPas = $_REQUEST['cambioPas'];
$idUsuarioBase = 9;
$tipoUser = 4;
$cambioPas = 1;

if ($idUsuarioBase == "") {
    header("location: https://cointic.com.mx/preveer/sistema/");
}
?>
<!DOCTYPE html>

<html xmlns="">

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


<!--FORMULARIO-->
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

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Lista del equipo dieléctrico y trabajo en alturas del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <?php
                        $idAsignacion=$_REQUEST['idAsignacion'];
                        $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                        $conexion->query("SET CHARACTER SET utf8");
                        $existencia=$conexion->query("SELECT equipoDielectico.* FROM equipoDielectico JOIN asignaInmueble ON equipoDielectico.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                        $contador=0;
                        foreach ($existencia as $row)
                        {
                            $contador++;
                        }
                        if($contador==0)
                        {
                            $insercion=$conexion->prepare("INSERT INTO equipoDielectico (idAsignacion)  VALUES (?)");
                            $insercion->bindParam(1, $idAsignacion);
                            $insercion->execute();

                            $existencia=$conexion->query("SELECT equipoDielectico.* FROM equipoDielectico JOIN asignaInmueble ON equipoDielectico.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                        }
                        ?>
                        <form id="form" enctype="multipart/form-data" >
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">

                            <?php
                            $contador=0;
                            $row;
                            foreach ($existencia as $row2)
                            {
                                $row=$row2;
                                $contador++;
                            }
                            ?>
                            

                            <div class="panel-body">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="body table-responsive">
                                                <table class="table table-hover" id="tablaListado">
                                                    <thead>
                                                        <tr>
                                                            <th>EQUIPO</th>
                                                            <th>CANTIDAD</th>
                                                            <!-- <th>FOTO</th> -->
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Perdiga</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="number" id="cantPerti" name="cantPerti" class="form-control" placeholder="Cantidad" value="<?php echo $row['pertiga'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>

                                                           <!--  <td><button data-toggle="modal" data-target="#myModalFotografias" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Casco dieléctrico</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="number" id="cantCasco" name="cantCasco" class="form-control" placeholder="Cantidad" value="<?php echo $row['casco'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                           <!--  <td><button data-toggle="modal" data-target="#myModalFotografiasCasco" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Lente/google</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input  type="number" id="cantiLente" name="cantiLente" class="form-control" placeholder="Cantidad" value="<?php echo $row['googles'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasLente" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Guantes dieléctricos</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="number" id="cantGuante" name="cantGuante" class="form-control" placeholder="Cantidad" value="<?php echo $row['guantes'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasGuantes" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Guantes carnaza</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="number" id="cantCarn" name="cantCarn" class="form-control" placeholder="Cantidad" value="<?php echo $row['guantesCarnazas'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                           <!--  <td><button data-toggle="modal" data-target="#myModalFotografiasGuantesC" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Calzado dieléctrico</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="number" id="cantCalza" name="cantCalza" class="form-control" placeholder="Cantidad" value="<?php echo $row['calzado'];?>"/>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasCalzado" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Tarimas dieléctricas</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="number" id="cantTarim" name="cantTarim" class="form-control" placeholder="Cantidad" value="<?php echo $row['tarimas'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasTarimas" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Arnés</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="number" id="cantArn" name="cantArn" class="form-control" placeholder="Cantidad" value="<?php echo $row['arnes'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasArnes" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Línea de vida</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="number" id="cantLine" name="cantLine" class="form-control" placeholder="Cantidad" value="<?php echo $row['lineaVida'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasLineaVida" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Sistema de anclaje</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="number" id="cantiSistema" name="cantiSistema" class="form-control" placeholder="Cantidad" value="<?php echo $row['sistemaAnclaje'];?>"/>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasAnclajes" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-group full-body" id="accordion_pertiga" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_pertiga">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_pertiga" aria-expanded="true" aria-controls="collapseOne_pertiga">
                                                    <i class="material-icons">assignment</i> Datos Generales
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_pertiga" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_pertiga">
                                            <div class="panel-body">
                                                <div >
                                                    <input type="hidden" name="idEquipo" value="<?php echo $row['idEquipo'];?>">
                                                    <div class="col-sm-12">
                                                        <b>Observaciones</b>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <textarea id="obserbacionesGrales" name="obserbacionesGrales" rows="4" class="form-control no-resize" placeholder="Observaciones Generales..."><?php echo $row['observacionesGrales']; ?> </textarea>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6 ">
                                                            <b>Foto Uno</b>
                                                            <input type="file" id="fotoGrales" name="fotoGrales[]" data-min-file-count="1">
                                                        </div>  
                                                        <div class="col-sm-6 col-md-6 ">
                                                            <b>Foto Dos</b>
                                                            <input type="file" id="fotoGralesD" name="fotoGralesD[]" data-min-file-count="1">
                                                        </div> 
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="col-sm-6 col-md-6 ">
                                                            <b>Foto Tres</b>
                                                            <input type="file" id="fotoGralesT" name="fotoGralesT[]" data-min-file-count="1">
                                                        </div>  
                                                        <div class="col-sm-6 col-md-6 ">
                                                            <b>Foto Cuatro</b>
                                                            <input type="file" id="fotoGralesC" name="fotoGralesC[]" data-min-file-count="1">
                                                        </div>  
                                                    </div>
                                                    <!-- <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Condiciones de la pertiga</b>
                                                                <input type="text" class="form-control" id="condicionesPertiga" name="condicionesPertiga" value="<?php echo $row['condicionesPertiga'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 col-md-offset-4 col-sm-offset-4">
                                                        <b>Foto de la pertiga</b>
                                                        <input type="file" id="fotoPertiga" name="fotoPertiga[]" data-min-file-count="1">
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-offset-5">
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


</section>

  <!-- <div class="modal fade" id="myModalFotografiasAnclajes" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Foto del Anclaje</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6 col-md-6 ">
                    <b>Foto Uno</b>
                     <input type="file" id="fotoAnclaje" name="fotoAnclaje[]" data-min-file-count="1">
                </div>  
                <div class="col-sm-6 col-md-6 ">
                    <b>Foto Dos</b>
                     <input type="file" id="fotoAnclajeD" name="fotoAnclajeD[]" data-min-file-count="1">
                </div> 
            </div>
            <div class="row"> 
                <div class="col-sm-6 col-md-6 ">
                    <b>Foto Tres</b>
                     <input type="file" id="fotoAnclajeT" name="fotoAnclajeT[]" data-min-file-count="1">
                </div>  
                <div class="col-sm-6 col-md-6 ">
                    <b>Foto Cuatro</b>
                     <input type="file" id="fotoAnclajeC" name="fotoAnclajeC[]" data-min-file-count="1">
                </div>  
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div> -->

<script type="text/javascript">

    

    $(function(){
        $("#form").on("submit", function(e){
            var url;
            var accion=<?php echo $contador;?>;
            accion="actualizarEquipoDielectrico/";
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
                            text: "Se han registrado los equipos dieléctricos",
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
       

        /*FOTO PARA GUANTES CARNAZA*/


       
        
        /*FOTO PARA ANCLAJE*/

        //Grales
        $('#fotoGrales').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoGrales/equipoDielectico/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoGrales"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . ('https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoGrales/') . $row['fotoGrales'] . "\' class='file-preview-image' alt=\'" . $row['fotoGrales'] . "\' title=\'" . $row['fotoGrales'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoGrales").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoGrales';
                $tabla = 'equipoDielectico';

                echo ("https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //DOS
        $('#fotoGralesD').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoGralesD/equipoDielectico/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoGralesD"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . ('https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoGralesD/') . $row['fotoGralesD'] . "\' class='file-preview-image' alt=\'" . $row['fotoGralesD'] . "\' title=\'" . $row['fotoGralesD'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoGralesD").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoGralesD';
                $tabla = 'equipoDielectico';

                echo ("https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //DOS
        //TRES
        $('#fotoGralesT').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoGralesT/equipoDielectico/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoGralesT"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . ('https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoGralesT/') . $row['fotoGralesT'] . "\' class='file-preview-image' alt=\'" . $row['fotoGralesT'] . "\' title=\'" . $row['fotoGralesT'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoGralesT").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoGralesT';
                $tabla = 'equipoDielectico';

                echo ("https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //TRES
        //CUATRO
        $('#fotoGralesC').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoGralesC/equipoDielectico/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoGralesC"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . ('https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoGralesC/') . $row['fotoGralesC'] . "\' class='file-preview-image' alt=\'" . $row['fotoGralesC'] . "\' title=\'" . $row['fotoGralesC'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoGralesC").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoGralesC';
                $tabla = 'equipoDielectico';

                echo ("https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //CUATRO

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