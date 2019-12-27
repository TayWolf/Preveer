<?php
$idUsuarioBase = $_REQUEST['idusuariobase'];
$tipoUser = $_REQUEST['tipoUser'];
$cambioPas = $_REQUEST['cambioPas'];
$idUsuarioBase = 9;
$idAsignacion=$_REQUEST['idAsignacion'];
$idReporte=$_REQUEST['idReporte'];
$nombreBitacora=$_REQUEST['nombre'];
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

<body class="theme-red" style="background: white;">
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

<?php
$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
$conexion->query("SET CHARACTER SET utf8");
$ReporteAsignacion=$conexion->query("SELECT * FROM ReporteAsignacion WHERE idReporte=$idReporte AND idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
if(empty($ReporteAsignacion))
{
    $conexion->query("INSERT INTO ReporteAsignacion (idReporte, idAsignacion, fecha) VALUES ($idReporte, $idAsignacion, '".date("Y-m-d")."')");
    $ReporteAsignacion=$conexion->query("SELECT * FROM ReporteAsignacion WHERE idReporte=$idReporte AND idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
}

$nombreReporte=$conexion->query("SELECT nombreReportes FROM Reportes_SSHL WHERE idReporte=$idReporte")->fetchAll(PDO::FETCH_ASSOC)[0]["nombreReportes"];
$apartados=$conexion->query("SELECT Reporte_ApartadoReporte.*, ApartadoReporte.nombre FROM Reporte_ApartadoReporte JOIN ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte WHERE Reporte_ApartadoReporte.idReporte=$idReporte ORDER BY Reporte_ApartadoReporte.posicion")->fetchAll(PDO::FETCH_ASSOC);
$indicadores=$conexion->query("SELECT Apartado_IndicadorReporte.*, indicadorReporte.nombreIndicador, indicadorReporte.tipo, indicadorReporte.required FROM Reporte_ApartadoReporte JOIN ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte JOIN Apartado_IndicadorReporte ON Apartado_IndicadorReporte.idApartadoReporte=Reporte_ApartadoReporte.idApartadoReporte JOIN indicadorReporte ON indicadorReporte.idIndicador=Apartado_IndicadorReporte.idIndicadorReporte WHERE Reporte_ApartadoReporte.idReporte=$idReporte ORDER BY Reporte_ApartadoReporte.posicion")->fetchAll(PDO::FETCH_ASSOC);
$correccion=$conexion->query("SELECT numeroCorrecciones, posicionCorreccion FROM Reportes_SSHL WHERE idReporte=$idReporte")->fetchAll(PDO::FETCH_ASSOC);

?>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="card">

                    <div class="header">

                        <h2><?=$nombreReporte?></h2>

                    </div>

                    <form id="datosReporte" method="post">

                        <div class="body">



                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?=$idAsignacion;?>">

                            <input type="hidden" name="idReporte" id="idReporte" value="<?=$idReporte?>">

                            <?php

                            $contadorIndicadores=0;

                            $numeroApartado=0;

                            $correcionPintada=false;

                            foreach ($apartados as $apartado)

                            {

                                if($numeroApartado==$correccion[0]['posicionCorreccion']&&$correccion[0]['numeroCorrecciones']!=0)

                                {

                                    ?>

                                    <div class="panel-group full-body" id="accordion_correccion" role="tablist" aria-multiselectable="true">

                                        <div class="panel panel-col-lightgray">

                                            <div class="panel-heading" role="tab" id="headingOne_correccion">

                                                <h4 class="panel-title">

                                                    <a style="text-align: center" role="button" data-toggle="collapse" href="#collapseOne_correccion" aria-expanded="true" aria-controls="collapseOne_correccion">

                                                        CORRECCIONES PARA APLICACIÓN

                                                    </a>

                                                </h4>

                                            </div>

                                            <div id="collapseOne_correccion" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_correccion">

                                                <div class="panel-body">



                                                    <?php

                                                    for($conclusion=0; $conclusion<$correccion[0]['numeroCorrecciones']; $conclusion++)

                                                    {

                                                        //TODO: LA CONCLUSIÓN DEBE ABARCAR EL ALTO DEL ROW, FALTA QUE BORRE LAS IMAGENES, Y UN BOTON DE SUBIDA

                                                        ?>

                                                        <div class="row">

                                                            <div class="col-sm-offset-1 col-sm-4">

                                                                <label>Evidencia fotográfica</label>

                                                                <input type="file" id="evidenciaFotografica<?=$conclusion?>" name="evidenciaFotografica<?=$conclusion?>[]" data-min-file-count="0">

                                                            </div>

                                                            <div class='col-sm-offset-1 col-sm-6'>

                                                                <div class='form-group'>

                                                                    <div class="form-line">

                                                                        <b>Corrección/Conclusión</b>

                                                                        <textarea class="form-control" id="correccion<?=$conclusion?>" name="correccion<?=$conclusion?>"></textarea>

                                                                        <input type="hidden" name="idCorreccion<?=$conclusion?>" id="idCorreccion<?=$conclusion?>">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>



                                                        <?php

                                                    }

                                                    ?>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <?php



                                }



                                $indicadorInicio=$apartado['idApartadoReporte'];

                                ?>

                                <div class="panel-group full-body" id="accordion_<?=$apartado['idApartadoReporte']?>" role="tablist" aria-multiselectable="true">

                                    <div class="panel panel-col-lightgray">

                                        <div class="panel-heading" role="tab" id="headingOne_<?=$apartado['idApartadoReporte']?>">

                                            <h4 class="panel-title">

                                                <a style="text-align: center" role="button" data-toggle="collapse" href="#collapseOne_<?=$apartado['idApartadoReporte']?>" aria-expanded="true" aria-controls="collapseOne_<?=$apartado['idApartadoReporte']?>">

                                                    <?=$apartado['nombre']?>

                                                </a>

                                            </h4>

                                        </div>

                                        <div id="collapseOne_<?=$apartado['idApartadoReporte']?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_<?=$apartado['idApartadoReporte']?>">

                                            <div class="panel-body">



                                                <div class="row">

                                                    <?php

                                                    for ($i=$contadorIndicadores; $i<sizeof($indicadores) && $indicadorInicio==$indicadores[$i]['idApartadoReporte']; $i++)

                                                    {

                                                        //$requerido=($indicadores[$i]['required'])? "required" : "";

                                                        $requerido="";



                                                        echo "<input type='hidden' name='idIndicador$contadorIndicadores' value='".$indicadores[$i]['idIndicadorReporte']."'>";

                                                        if($indicadores[$i]['tipo']==1)

                                                        {

                                                            ?>

                                                            <div class='col-sm-4'>

                                                                <div class='form-group'>

                                                                    <div class='form-line'>

                                                                        <b><?= $indicadores[$i]['nombreIndicador'] ?></b>

                                                                        <select name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>>

                                                                        </select>

                                                                        <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <?php

                                                        }

                                                        else if($indicadores[$i]['tipo']==2)

                                                        {

                                                            ?>

                                                            <div class='col-sm-4'>

                                                                <div class='form-group'>

                                                                    <div class='form-line'>

                                                                        <b><?= $indicadores[$i]['nombreIndicador'] ?></b>

                                                                        <input type="text" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>>

                                                                        <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <?php

                                                        }

                                                        else if($indicadores[$i]['tipo']==3)

                                                        {

                                                            ?>

                                                            <div class='col-sm-4'>

                                                                <div class='form-group'>

                                                                    <div class='form-line'>

                                                                        <b><?= $indicadores[$i]['nombreIndicador'] ?></b>

                                                                        <input type="date" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>>

                                                                        <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <?php

                                                        }
                                                        else if($indicadores[$i]['tipo']==5)

                                                        {

                                                            ?>

                                                            <div class='col-sm-4'>

                                                                <div class='form-group'>

                                                                    <div class='form-line'>

                                                                        <b><?= $indicadores[$i]['nombreIndicador'] ?></b>
                                                                        <textarea style="height: 81px;" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>" class="form-control"></textarea>
                                                                        <!-- <input type="text" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>> -->

                                                                        <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <?php

                                                        }



                                                    }

                                                    ?>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <?php

                                $numeroApartado++;

                            }

                            ?>

                            <div class="row">

                                <div class="col-sm-offset-5 col-sm-2">

                                    <input class="btn bg-red waves-effect waves-light" type="submit" value="Guardar">

                                </div>

                            </div>



                        </div>

                    </form>

                </div>

            </div>

        </div>
        


        <script>

            function crearFileInput(nombreCampo, valorCampo, numeroConclusion, idCorreccion, textoCorreccion)

            {

                imagen='';

                if(valorCampo)

                {

                    imagen="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoReportes/evidenciaFotografica"+valorCampo+"' class='file-preview-image'>";

                }

                $("#correccion"+numeroConclusion).val(textoCorreccion);

                $("#idCorreccion"+numeroConclusion).val(idCorreccion);



                $('#'+nombreCampo).fileinput({

                    'showUploadedThumbs': false,

                    'showCaption': false,

                    'showCancel': false,

                    'showRemove': false,

                    'showUpload': false,

                    'uploadAsync': false,

                    'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudReportes/subirFotoGeneral/"+nombreCampo,

                    'uploadExtraData': {conclusion: $("#correccion"+numeroConclusion).val(), idReporteAsignacion: <?=$ReporteAsignacion[0]['idReporteAsignacion']?>, idReporteCorreccion: idCorreccion},

                    'language': 'es',

                    'maxFileCount': 1,

                    'allowedFileExtensions': ['jpg', 'gif', 'png'],

                    'initialPreview' : [imagen]

                }).on('change', function (event, data, previewId, index) {





                }).on('fileclear', function (event) {

                    url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenArreglo/"+nombreCampo+"/FotoExtintor/"+data+"/idExtintor";

                    $.ajax({

                        url: url,

                        type: "post",

                        dataType: "html"

                    }).done(function (res) { });





                });

            }

            var arregloCorrecciones;

            //Carga los ponderadores

            $(document).ready(function ()

            {



                $.ajax(

                    {

                        url: '<?=$site_url.('CrudReportes/obtenerCorrecciones/').$ReporteAsignacion[0]['idReporteAsignacion']?>',

                        contentType: false,

                        dataType: 'json',

                        success: function (data)

                        {

                            arregloCorrecciones=data;

                            var restantes=0;

                            for(i=0; i<<?=$correccion[0]['numeroCorrecciones']?>; i++)

                            {

                                //

                                //nombre del fileinput, imagen, numero de correccion a subir, idCorreccion(BD)

                                if(restantes<data.length)

                                    crearFileInput("evidenciaFotografica"+i, data[restantes]['evidenciaFotografica'], i, data[restantes]['idReporteCorreccion'], data[restantes++]['correccion']);

                                else

                                    crearFileInput("evidenciaFotografica"+i, null, i, 0, "");

                            }

                        }

                    }

                );





                $.ajax(

                    {

                        url: '<?=$site_url.('CrudReportes/obtenerPonderadoresReporte/').$idReporte?>',

                        contentType: false,

                        dataType: 'JSON',

                        success: function(ponderadores)

                        {

                            for(i=0; i<ponderadores.length; i++)

                            {

                                $(".select"+ponderadores[i]['idIndicador']+"-"+ponderadores[i]['idApartadoReporte']).append('<option value="'+ponderadores[i]['idPonderador']+'">'+ponderadores[i]['nombrePonderador']+'</option>');

                            }

                        },

                        complete: function()

                        {

                            $.ajax(

                                {

                                    url: '<?=$site_url.('CrudReportes/cargarResultados/').$ReporteAsignacion[0]['idReporteAsignacion']?>',

                                    contentType: false,

                                    dataType: 'json',

                                    success: function (resultados)

                                    {



                                        for(i=0; i<resultados.length; i++)

                                        {

                                            $(".select"+resultados[i]['idIndicadorReporte']+"-"+resultados[i]['idApartadoReporte']).val(resultados[i]['valor']);

                                        }

                                    }

                                }

                            );

                        }

                    }

                );

            });



            //envia los resultados para que se almacenen

            $("#datosReporte").submit(function (e)

                {



                    var restantes=0;

                    for(i=0; i<<?=$correccion[0]['numeroCorrecciones']?>; i++)

                    {



                        //nombre del fileinput, imagen, numero de correccion a subir, idCorreccion(BD)

                        if(restantes<arregloCorrecciones.length)

                        {

                            var extraData={conclusion: $("#correccion"+i).val(), idReporteAsignacion: <?=$ReporteAsignacion[0]['idReporteAsignacion']?>, idReporteCorreccion: arregloCorrecciones[restantes++]['idReporteCorreccion']};

                            $("#evidenciaFotografica"+i).fileinput('refresh', {'uploadExtraData': extraData});

                            $("#evidenciaFotografica"+i).fileinput("upload");



                        }

                        else

                        {

                            var extraData={conclusion: $("#correccion"+i).val(), idReporteAsignacion: <?=$ReporteAsignacion[0]['idReporteAsignacion']?>, idReporteCorreccion: 0};

                            $("#evidenciaFotografica"+i).fileinput('refresh', {'uploadExtraData': extraData});

                            $("#evidenciaFotografica"+i).fileinput("upload");

                        }



                    }





                    e.preventDefault();

                    var formData=new FormData(document.getElementById("datosReporte"));



                    $.ajax({

                        url: '<?=$site_url.('CrudReportes/actualizarReporte')?><?="/".$contadorIndicadores.'/'.$ReporteAsignacion[0]['idReporteAsignacion']."'"?>,

                        contentType: false,

                        data: formData,

                        type: 'post',

                        cache : false,

                        processData: false,

                        success: function (res)

                        {

                            swal({

                                title: "Éxito",

                                text: "Se ha guardado el reporte",

                                type: "success",

                                confirmButtonClass: "btn-danger",

                                confirmButtonText: "Aceptar"

                            }, function(){

                                location.reload();

                            });

                        }

                    });

                }

            );

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
<!--<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/piexif.min.js')?>"></script>-->
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
