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
<script>
    var array = {
        'datosBitacora': []
    };
</script>

<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Bitácora de Protección Personal</h2>
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
                                            <form id="form" enctype="multipart/form-data">
                                            
                                                <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                                                <div class="row">
                                                    <?php
                                                    $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                                                    $conexion->query("SET CHARACTER SET utf8");
                                                    $tabla='BitacoraProteccionPersonal';
                                                    $tablaBitacor=$conexion->query("SELECT $tabla.* FROM $tabla WHERE idAsignacion=$idAsignacion");
                                                    $tablaBitacora=$tablaBitacor->fetchAll(PDO::FETCH_ASSOC);
                                                    $tabla='Resultado_ProteccionPersonal';
                                                    $resultadosBitacor=$conexion->query("SELECT $tabla.* FROM $tabla WHERE idAsignacion=$idAsignacion");
                                                    $resultadosBitacora=$resultadosBitacor->fetchAll(PDO::FETCH_ASSOC);
                                                    $areasUbicacion=$conexion->query("SELECT * FROM areaClubesSW");
                                                    ?>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>En el plano</b>
                                                                <select class="form-control" id="enElPlano" name="enElPlano" required>
                                                                    <option value="">Seleccione una opción</option>
                                                                    <?php if($areasUbicacion):?>
                                                                    <?php foreach($areasUbicacion as $row):?>
                                                                    <option value="<?=$row['idArea']?>"><?=$row['descripcion']?></option>
                                                                    <?endforeach; ?>
                                                                    <?php endif;?>

                                                                    <!-- <option value="">Seleccione una opción</option>
                                                                    <option value="1">Si</option>
                                                                    <option value="2">No</option>
                                                                    <option value="3">N/A</option> -->
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
                                                                <b>Casco</b>
                                                                <select class="form-control" id="casco" name="casco" required>
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
                                                                <b>Monja</b>
                                                                <select class="form-control" id="monja" name="monja" required>
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
                                                                <b>Chaquetón</b>
                                                                <select class="form-control" id="chaqueton" name="chaqueton" required>
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
                                                                <b>Pantalonera</b>
                                                                <select class="form-control" id="pantalonera" name="pantalonera" required>
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
                                                                <b>Tirantes</b>
                                                                <select class="form-control" id="tirantes" name="tirantes" required>
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
                                                                <b>Botas</b>
                                                                <select class="form-control" id="botas" name="botas" required>
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
                                                                <b>Mascarilla</b>
                                                                <select class="form-control" id="mascarilla" name="mascarilla" required>
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
                                                                <b>Hachas</b>
                                                                <select class="form-control" id="hachas" name="hachas" required>
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
                                                                <b>Guantes</b>
                                                                <select class="form-control" id="guantes" name="guantes" required>
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
                                                                <b>Acceso</b>
                                                                <select class="form-control" id="acceso" name="acceso" required>
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
                                            </form>
                                            <div class="body table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>En el plano</th>
                                                        <th>Libre de obstrucción</th>
                                                        <th>Casco</th>
                                                        <th>Monja</th>
                                                        <th>Chaquetón</th>
                                                        <th>Pantalonera</th>
                                                        <th>Tirantes</th>
                                                        <th>Botas</th>
                                                        <th>Mascarilla</th>
                                                        <th>Hachas</th>
                                                        <th>Guantes</th>
                                                        <th>Acceso</th>
                                                        <th>Observaciones</th>
                                                        <th>Oportunidades de mejora</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="lista">

                                                    </tbody>

                                                </table>
                                            </div>
                                        <form id="formComple">
                                            <div class="row">
                                                <?php
                                                if(empty($resultadosBitacora))
                                                {
                                                    $resultadosBitacora=array(
                                                        array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null)
                                                    );
                                                    for($i=0; $i<5; $i++)
                                                    {
                                                        array_push($resultadosBitacora,array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null, 'numero' =>null, 'observaciones' => null));
                                                    }
                                                }

                                                ?>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total de equipos de protección personal</b>
                                                            <input type="number" class="form-control" name="total" id="total" value="<?=$resultadosBitacora[0]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de equipo bloqueado</b>
                                                            <input type="number" class="form-control" name="cantidadBloqueados" id="cantidadBloqueados" value="<?=$resultadosBitacora[1]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de equipos bloqueados</b>
                                                            <input type="number" class="form-control" name="numeroBloqueados" id="numeroBloqueados" value="<?=$resultadosBitacora[1]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesBloqueados" id="observacionesBloqueados" value="<?=$resultadosBitacora[1]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de equipo que requiere limpieza</b>
                                                            <input type="number" class="form-control" name="cantidadLimpieza" id="cantidadLimpieza" value="<?=$resultadosBitacora[2]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de equipo que requiere limpieza</b>
                                                            <input type="number" class="form-control" name="numeroLimpieza" id="numeroLimpieza" value="<?=$resultadosBitacora[2]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesLimpieza" id="observacionesLimpieza" value="<?=$resultadosBitacora[2]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de equipo que tiene daño físico</b>
                                                            <input type="number" class="form-control" name="cantidadDano" id="cantidadDano" value="<?=$resultadosBitacora[3]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de equipo que tiene daño físico</b>
                                                            <input type="number" class="form-control" name="numeroDano" id="numeroDano" value="<?=$resultadosBitacora[3]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesDano" id="observacionesDano" value="<?=$resultadosBitacora[3]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de equipo sin señalamiento</b>
                                                            <input type="number" class="form-control" name="cantidadSenalamiento" id="cantidadSenalamiento" value="<?=$resultadosBitacora[4]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de equipo sin señalamiento</b>
                                                            <input type="number" class="form-control" name="numeroSenalamiento" id="numeroSenalamiento" value="<?=$resultadosBitacora[4]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesSenalamiento" id="observacionesSenalamiento" value="<?=$resultadosBitacora[4]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Comentarios y/o observaciones</b>
                                                            <textarea class="form-control" name="observacionesGenerales" id="observacionesGenerales" ><?=$resultadosBitacora[5]['observaciones']?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
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
                Oportunidades de mejora de protección personal
            </div>
            <div class="modal-body" id="contenidoModal">
                <div class="row">
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraProteccionPersonal1" name="fotoOportunidadMejoraProteccionPersonal1[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraProteccionPersonal2" name="fotoOportunidadMejoraProteccionPersonal2[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraProteccionPersonal3" name="fotoOportunidadMejoraProteccionPersonal3[]" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <div class="form-line">
                                <b>Oportunidad de mejora</b>
                                <textarea class="form-control" id="oportunidadMejoraProteccionPersonal" name="oportunidadMejoraProteccionPersonal" onblur="subirOportunidadMejora()"></textarea>
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
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraProteccionPersonal1\" name=\"fotoOportunidadMejoraProteccionPersonal1[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraProteccionPersonal2\" name=\"fotoOportunidadMejoraProteccionPersonal2[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraProteccionPersonal3\" name=\"fotoOportunidadMejoraProteccionPersonal3[]\" >\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row\">\n" +
            "                        <div class=\"col-md-6 col-md-offset-3\">\n" +
            "                            <div class=\"form-group\">\n" +
            "                                <div class=\"form-line\">\n" +
            "                                    <b>Oportunidad de mejora</b>\n" +
            "                                    <textarea class=\"form-control\" id=\"oportunidadMejoraProteccionPersonal\" name=\"oportunidadMejoraProteccionPersonal\" onblur=\"subirOportunidadMejora()\"></textarea>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>");
        llavePrimariaActual=llavePrimaria;
        var nombreTabla='OportunidadMejoraProteccionPersonal';
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

        var oportunidad=$("#oportunidadMejoraProteccionPersonal").val();
        oportunidad=oportunidad.replace(" ", "%20");
        oportunidad=oportunidad.replace("/", "%30");
        $.ajax(
            {
                url: "<?=$site_url.('CrudBitacoras/subirOportunidadMejora/')?>"+oportunidad+"/"+llavePrimariaActual+"/OportunidadMejoraProteccionPersonal/oportunidadMejoraProteccionPersonal",
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

        accion = "actualizarBitacora004/"+$("#idAsignacion").val();
        var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/';?>" + accion;
        var formData=new FormData(document.getElementById("formComple"));
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
        var enElPlano = $("#enElPlano").val();
        var libreObstruccion = $("#libreObstruccion").val();
        var casco = $("#casco").val();
        var monja = $("#monja").val();
        var chaqueton = $('#chaqueton').val();
        var pantalonera = $('#pantalonera').val();
        var tirantes = $('#tirantes').val();
        var botas = $('#botas').val();
        var mascarilla = $('#mascarilla').val();
        var hachas = $('#hachas').val();
        var guantes = $('#guantes').val();
        var acceso = $('#acceso').val();
        var observaciones = $('#observaciones').val();
         var arreglo = {'datos': []};

          arreglo.datos.push({'enElPlano': enElPlano, 'libreObstruccion': libreObstruccion,'casco': casco,'monja': monja,'chaqueton':chaqueton,'pantalonera':pantalonera,'tirantes':tirantes,'botas':botas,'mascarilla':mascarilla,'hachas':hachas,'guantes':guantes,'acceso':acceso, 'observaciones': observaciones});

      /*  array.datosBitacora.push({'idBitacora': '-1', 'enElPlano': enElPlano, 'libreObstruccion': libreObstruccion,'casco': casco,'monja': monja,'chaqueton':chaqueton,'pantalonera':pantalonera,'tirantes':tirantes,'botas':botas,'mascarilla':mascarilla,'hachas':hachas,'guantes':guantes,'acceso':acceso, 'action' : 1, 'observaciones': observaciones});*/

        console.log(JSON.stringify(array.datosBitacora, null, 4));
        var formData = new FormData(document.getElementById('formDatosBitacora'));
        formData.append('datos', JSON.stringify(arreglo.datos));

        $.ajax(
            {
               // url: "https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/insertarArreglo/" + idAsigns+"/BitacoraProteccionPersonal/",
                 url: "<?=$site_url.('CrudBitacoras/insertarArreglo/'.$idAsignacion.'/BitacoraProteccionPersonal');?>",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                   array.datosBitacora.push({'idBitacora': data, 'enElPlano': enElPlano, 'libreObstruccion': libreObstruccion,'casco': casco,'monja': monja,'chaqueton':chaqueton,'pantalonera':pantalonera,'tirantes':tirantes,'botas':botas,'mascarilla':mascarilla,'hachas':hachas,'guantes':guantes,'acceso':acceso, 'action' : 0, 'observaciones': observaciones});
                   
                    $("#lista").append('<tr>'+
                        '<td>'+$("#enElPlano option:selected").text()+'</td>'+
                        '<td style="font-weight: normal !important;">'+$("#libreObstruccion option:selected").text()+'</td>'+
                        '<td>'+$("#casco option:selected").text()+'</td>'+
                        '<td>'+$("#monja option:selected").text()+'</td>'+
                        '<td>'+$("#chaqueton option:selected").text()+'</td>'+
                        '<td>'+$("#pantalonera option:selected").text()+'</td>'+
                        '<td>'+$("#tirantes option:selected").text()+'</td>'+
                        '<td>'+$("#botas option:selected").text()+'</td>'+
                        '<td>'+$("#mascarilla option:selected").text()+'</td>'+
                        '<td>'+$("#hachas option:selected").text()+'</td>'+
                        '<td>'+$("#guantes option:selected").text()+'</td>'+
                        '<td>'+$("#acceso option:selected").text()+'</td>'+
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
        $("#enElPlano").val("");
        $("#libreObstruccion").val("");
        $("#monja").val("");
        $("#casco").val("");
        $('#chaqueton').val("");
        $('#pantalonera').val("");
        $('#tirantes').val("");
        $('#botas').val("");
        $('#mascarilla').val("");
        $('#hachas').val("");
        $('#guantes').val("");
        $('#acceso').val("");
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
            $areaUbicacion = $row["enElPlano"];
            $libreObstruccion = $row["libreObstruccion"];
            $casco = $row["casco"];
            $monja = $row["monja"];
            $chaqueton = $row["chaqueton"];
            $pantalonera = $row["pantalonera"];
            $tirantes = $row["tirantes"];
            $botas = $row["botas"];
            $mascarilla = $row["mascarilla"];
            $hachas = $row["hachas"];
            $guantes = $row["guantes"];
            $acceso = $row["acceso"];
            $observaciones = $row["observaciones"];
            $idAsignacion = $row["idAsignacion"];

            print "array.datosBitacora.push({'idBitacora': $idBitacora, 'enElPlano': $areaUbicacion, 'libreObstruccion': $libreObstruccion, 'casco': $casco,'monja': $monja,'chaqueton': $chaqueton,'pantalonera': $pantalonera,'tirantes': $tirantes,'botas': $botas,'mascarilla': $mascarilla,'hachas': $hachas,'guantes': $guantes,'acceso': $acceso, 'action' : 0, 'observaciones': '$observaciones'}); \n";

            $areasUbicacion=$conexion->query("SELECT * FROM areaClubesSW");
             foreach ($areasUbicacion as $itemArea)
            {
                if($areaUbicacion==$itemArea['idArea'])
                {
                    $areaUbicacion=$itemArea['descripcion'];
                    break;
                }
            }

            //$enElPlano= ($enElPlano==1)? "Si":(($enElPlano==2)? "No": "N/A");
            $libreObstruccion= ($libreObstruccion==1)? "Si":(($libreObstruccion==2)? "No": "N/A");
            $casco= ($casco==1)? "Si":(($casco==2)? "No": "N/A");
            $monja= ($monja==1)? "Si":(($monja==2)? "No": "N/A");
            $chaqueton= ($chaqueton==1)? "Si":(($chaqueton==2)? "No": "N/A");
            $pantalonera= ($pantalonera==1)? "Si":(($pantalonera==2)? "No": "N/A");
            $tirantes= ($tirantes==1)? "Si":(($tirantes==2)? "No": "N/A");
            $botas= ($botas==1)? "Si":(($botas==2)? "No": "N/A");
            $mascarilla= ($mascarilla==1)? "Si":(($mascarilla==2)? "No": "N/A");
            $hachas= ($hachas==1)? "Si":(($hachas==2)? "No": "N/A");
            $guantes= ($guantes==1)? "Si":(($guantes==2)? "No": "N/A");
            $acceso= ($acceso==1)? "Si":(($acceso==2)? "No": "N/A");
            print "$('#lista').append('<tr><td hidden>$idBitacora</td><td>$areaUbicacion</td><td>$libreObstruccion</td><td>$casco</td><td>$monja</td><td>$chaqueton</td><td>$pantalonera</td><td>$tirantes</td><td>$botas</td><td>$mascarilla</td><td>$hachas</td><td>$guantes</td><td>$acceso</td><td>$observaciones</td><td><button type=\"button\" class=\"btn btn-default\" onClick=\"modalFotos($idBitacora)\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
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
