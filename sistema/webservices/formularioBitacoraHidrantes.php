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
                        <h2>Bitácora de Hidrantes</h2>
                    </div>
                    <div class="body">
                        <form id="formDatosBitacora"></form>
                        <form id="form">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
                                <?php
                                $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                                $conexion->query("SET CHARACTER SET utf8");
                                $tabla='BitacoraHidrantes';
                                $tablaBitacor=$conexion->query("SELECT $tabla.* FROM $tabla WHERE idAsignacion=$idAsignacion");
                                $tablaBitacora=$tablaBitacor->fetchAll(PDO::FETCH_ASSOC);
                                $tabla='Resultado_Hidrante';
                                $resultadosBitacor=$conexion->query("SELECT $tabla.* FROM $tabla WHERE idAsignacion=$idAsignacion");
                                $resultadosBitacora=$resultadosBitacor->fetchAll(PDO::FETCH_ASSOC);
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
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Ubicación en el plano</b>
                                                            <select class="form-control" id="ubicacion" name="ubicacion" required>
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
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cuenta con numeración</b>
                                                            <select class="form-control" id="numeracion" name="numeracion" required>
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
                                                            <b>Libre de obstrucción</b>
                                                            <select class="form-control" id="obstruido" name="obstruido" required>
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
                                                            <b>Señalamiento correcto y en buen estado</b>
                                                            <select class="form-control" id="senalamiento" name="senalamiento" required>
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
                                                            <b>Cilindro sin corrosión y sin golpes</b>
                                                            <select class="form-control" id="estadoGabinete" name="estadoGabinete" required>
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
                                                            <b>Manómetro en buen estado</b>
                                                            <select class="form-control" id="manometro" name="manometro" required>
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
                                                            <b>Manguera</b>
                                                            <select class="form-control" id="manguera" name="manguera" required>
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
                                                            <b>Válvula</b>
                                                            <select class="form-control" id="valvula" name="valvula" required>
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
                                                            <b>Cople de válvula</b>
                                                            <select class="form-control" id="copleValvula" name="copleValvula" required>
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
                                                            <b>Cristales o micas del gabinete / Bolsa en buen estado</b>
                                                            <select class="form-control" id="cristales" name="cristales" required>
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
                                                            <b>Sistema de cierre</b>
                                                            <select class="form-control" id="sistemaCierre" name="sistemaCierre" required>
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
                                                            <b>Identificación de seguridad para operación</b>
                                                            <select class="form-control" id="identificacion" name="identificacion" required>
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
                                                            <b>Almacenamiento de manguera adecuado</b>
                                                            <select class="form-control" id="doblesManguera" name="doblesManguera" required>
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
                                                            <b>Llave de acople</b>
                                                            <select class="form-control" id="llaveAcople" name="llaveAcople" required>
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
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" id="observaciones" name="observaciones" min="0" >
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
                                                        <th>Cuenta con numeración</th>
                                                        <th>Libre de obstrucción</th>
                                                        <th>Señalamiento correcto y en buen estado</th>
                                                        <th>Cilindro sin corrosión y sin golpes</th>
                                                        <th>Manómetro en buen estado</th>
                                                        <th>Manguera</th>
                                                        <th>Válvula</th>
                                                        <th>Cople de válvula</th>
                                                        <th>Cristales del gabinete</th>
                                                        <th>Sistema de cierre</th>
                                                        <th>Identificación de seguridad</th>
                                                        <th>Almacenamiento de manguera adecuado</th>
                                                        <th>Llave de Acople</th>
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
                                            if(empty($resultadosBitacora))
                                            {
                                                $resultadosBitacora=array(
                                                    array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null),
                                                    array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null),
                                                    array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null),
                                                    array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null)
                                                );
                                                for($i=0; $i<8; $i++)
                                                {
                                                    array_push($resultadosBitacora,array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null, 'numero' =>null, 'observaciones' => null));
                                                }
                                            }
                                            ?>
                                            <div class="row">
                                                <br>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total de hidrantes exteriores</b>
                                                            <input type="number" class="form-control" name="cantidadExterior" id="cantidadExterior" value="<?=$resultadosBitacora[0]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total de hidrantes interiores</b>
                                                            <input type="number" class="form-control" name="cantidadInterior" id="cantidadInterior" value="<?=$resultadosBitacora[1]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total de hidrantes en buen estado</b>
                                                            <input type="text" class="form-control" name="cantidadBuenEstado" id="cantidadBuenEstado" value="<?=$resultadosBitacora[2]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total de hidrantes en mal estado</b>
                                                            <input type="text" class="form-control" name="cantidadMalEstado" id="cantidadMalEstado" value="<?=$resultadosBitacora[3]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Bloqueados-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de hidrantes bloqueados</b>
                                                            <input type="number" class="form-control" name="cantidadBloqueados" id="cantidadBloqueados" value="<?=$resultadosBitacora[4]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de hidrantes bloqueados</b>
                                                            <input type="number" class="form-control" name="numeroBloqueados" id="numeroBloqueados" value="<?=$resultadosBitacora[4]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesBloqueados" id="observacionesBloqueados" value="<?=$resultadosBitacora[4]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Señalamiento-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de hidrantes sin señalamiento</b>
                                                            <input type="number" class="form-control" name="cantidadSenalamiento" id="cantidadSenalamiento" value="<?=$resultadosBitacora[5]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de hidrantes sin señalamiento</b>
                                                            <input type="number" class="form-control" name="numeroSenalamiento" id="numeroSenalamiento" value="<?=$resultadosBitacora[5]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesSenalamiento" id="observacionesSenalamiento" value="<?=$resultadosBitacora[5]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Manguera-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de mangueras en malas condiciones o sin acomodar</b>
                                                            <input type="number" class="form-control" name="cantidadMangueras" id="cantidadMangueras" value="<?=$resultadosBitacora[6]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de mangueras en malas condiciones o sin acomodar</b>
                                                            <input type="number" class="form-control" name="numeroMangueras" id="numeroMangueras" value="<?=$resultadosBitacora[6]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesMangueras" id="observacionesMangueras" value="<?=$resultadosBitacora[6]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Pitón-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de hidrantes sin pitón o en malas condiciones </b>
                                                            <input type="number" class="form-control" name="cantidadPiton" id="cantidadPiton" value="<?=$resultadosBitacora[7]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de hidrantes sin pitón o en malas condiciones r</b>
                                                            <input type="number" class="form-control" name="numeroPiton" id="numeroPiton" value="<?=$resultadosBitacora[7]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesPiton" id="observacionesPiton" value="<?=$resultadosBitacora[7]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Llave-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de hidrantes sin llave o en malas condiciones </b>
                                                            <input type="number" class="form-control" name="cantidadLlaves" id="cantidadLlaves" value="<?=$resultadosBitacora[8]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de hidrantes sin pitón o en malas condiciones</b>
                                                            <input type="number" class="form-control" name="numeroLlaves" id="numeroLlaves" value="<?=$resultadosBitacora[8]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesLlaves" id="observacionesLlaves" value="<?=$resultadosBitacora[8]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Gabinete-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de gabinetes / fundas en mal estado</b>
                                                            <input type="number" class="form-control" name="cantidadGabinete" id="cantidadGabinete" value="<?=$resultadosBitacora[9]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de gabinetes / fundas en mal estado</b>
                                                            <input type="number" class="form-control" name="numeroGabinete" id="numeroGabinete" value="<?=$resultadosBitacora[9]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesGabinete" id="observacionesGabinete" value="<?=$resultadosBitacora[9]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Presion-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de hidrantes sin presión de trabajo en el sistema</b>
                                                            <input type="number" class="form-control" name="cantidadPresion" id="cantidadPresion" value="<?=$resultadosBitacora[10]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de hidrantes sin presión de trabajo en el sistema</b>
                                                            <input type="number" class="form-control" name="numeroPresion" id="numeroPresion" value="<?=$resultadosBitacora[10]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesPresion" id="observacionesPresion" value="<?=$resultadosBitacora[10]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Comentarios y/o observaciones</b>
                                                            <textarea class="form-control" name="observacionesGenerales" id="observacionesGenerales" ><?=$resultadosBitacora[11]['observaciones']?></textarea>
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
                Oportunidades de mejora del hidrante
            </div>
            <div class="modal-body" id="contenidoModal">
                <div class="row">
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraHidrante1" name="fotoOportunidadMejoraHidrante1[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraHidrante2" name="fotoOportunidadMejoraHidrante2[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraHidrante3" name="fotoOportunidadMejoraHidrante3[]" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <div class="form-line">
                                <b>Oportunidad de mejora</b>
                                <textarea class="form-control" id="oportunidadMejoraHidrante" name="oportunidadMejoraHidrante" onblur="subirOportunidadMejora()"></textarea>
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
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraHidrante1\" name=\"fotoOportunidadMejoraHidrante1[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraHidrante2\" name=\"fotoOportunidadMejoraHidrante2[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraHidrante3\" name=\"fotoOportunidadMejoraHidrante3[]\" >\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row\">\n" +
            "                        <div class=\"col-md-6 col-md-offset-3\">\n" +
            "                            <div class=\"form-group\">\n" +
            "                                <div class=\"form-line\">\n" +
            "                                    <b>Oportunidad de mejora</b>\n" +
            "                                    <textarea class=\"form-control\" id=\"oportunidadMejoraHidrante\" name=\"oportunidadMejoraHidrante\" onblur=\"subirOportunidadMejora()\"></textarea>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>");
        llavePrimariaActual=llavePrimaria;
        var nombreTabla='OportunidadMejoraHidrante';
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

        var oportunidad=$("#oportunidadMejoraHidrante").val();
        oportunidad=oportunidad.replace(" ", "%20");
        oportunidad=oportunidad.replace("/", "%30");
        $.ajax(
            {
                url: "<?=$site_url.('CrudBitacoras/subirOportunidadMejora/')?>"+oportunidad+"/"+llavePrimariaActual+"/OportunidadMejoraHidrante/oportunidadMejoraHidrante",
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
        
            accion = "actualizarBitacora002/"+$("#idAsignacion").val();
            var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/';?>" + accion;
            var formData=new FormData(document.getElementById("form"));
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
        var ubicacion = $("#ubicacion").val();
        var numeracion = $("#numeracion").val();
        var obstruido = $("#obstruido").val();
        var senalamiento = $("#senalamiento").val();
        var estadoGabinete = $("#estadoGabinete").val();
        var manometro = $('#manometro').val();
        var manguera = $('#manguera').val();
        var valvula = $('#valvula').val();
        var copleValvula = $('#copleValvula').val();
        var cristales = $('#cristales').val();
        var sistemaCierre = $('#sistemaCierre').val();
        var identificacion = $('#identificacion').val();
        var doblesManguera = $('#doblesManguera').val();
        var llaveAcople = $('#llaveAcople').val();
        var observaciones = $('#observaciones').val();

        array.datosBitacora.push({'idBitacora': '-1', 'ubicacion': ubicacion ,'numeracion': numeracion, 'obstruido': obstruido, 'senalamiento': senalamiento,'estadoGabinete': estadoGabinete,'manometro':manometro,'manguera':manguera, 'valvula': valvula , 'copleValvula':copleValvula,'cristales':cristales,'sistemaCierre':sistemaCierre, 'identificacion' : identificacion,'doblesManguera' : doblesManguera,'llaveAcople' : llaveAcople,'action' : 1, 'observaciones': observaciones});
        console.log(JSON.stringify(array.datosBitacora, null, 4));


        var arregloTemporal={'datos':[]};
        arregloTemporal.datos.push({'ubicacion': ubicacion ,'numeracion': numeracion, 'obstruido': obstruido, 'senalamiento': senalamiento,'estadoGabinete': estadoGabinete,'manometro':manometro,'manguera':manguera, 'valvula': valvula , 'copleValvula':copleValvula,'cristales':cristales,'sistemaCierre':sistemaCierre, 'identificacion' : identificacion,'doblesManguera' : doblesManguera,'llaveAcople' : llaveAcople, 'observaciones': observaciones});

        var formData=new FormData(document.getElementById("formDatosBitacora"));
        formData.append('datos', (JSON.stringify(arregloTemporal.datos)));

        $.ajax(
            {
                url: "<?=$site_url.('CrudBitacoras/insertarArreglo/'.$idAsignacion.'/BitacoraHidrantes');?>",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'html',
                type: 'post',
                success: function (llavePrimaria)
                {
                    console.log(llavePrimaria);
                    array.datosBitacora.push({'idBitacora': llavePrimaria, 'ubicacion': ubicacion ,'numeracion': numeracion, 'obstruido': obstruido, 'senalamiento': senalamiento,'estadoGabinete': estadoGabinete,'manometro':manometro,'manguera':manguera, 'valvula': valvula , 'copleValvula':copleValvula,'cristales':cristales,'sistemaCierre':sistemaCierre, 'identificacion' : identificacion,'doblesManguera' : doblesManguera,'llaveAcople' : llaveAcople,'action' : 0, 'observaciones': observaciones});

                    $("#lista").append('<tr>'+
                        '<td>'+$("#ubicacion option:selected").text()+'</td>'+
                        '<td style="font-weight: normal !important;">'+$("#numeracion option:selected").text()+'</td>'+
                        '<td>'+$("#obstruido option:selected").text()+'</td>'+
                        '<td>'+$("#senalamiento option:selected").text()+'</td>'+
                        '<td>'+$("#estadoGabinete option:selected").text()+'</td>'+
                        '<td>'+$("#manometro option:selected").text()+'</td>'+
                        '<td>'+$("#manguera option:selected").text()+'</td>'+
                        '<td>'+$("#valvula option:selected").text()+'</td>'+
                        '<td>'+$("#copleValvula option:selected").text()+'</td>'+
                        '<td>'+$("#cristales option:selected").text()+'</td>'+
                        '<td>'+$("#sistemaCierre option:selected").text()+'</td>'+
                        '<td>'+$("#identificacion option:selected").text()+'</td>'+
                        '<td>'+$("#doblesManguera option:selected").text()+'</td>'+
                        '<td>'+$("#llaveAcople option:selected").text()+'</td>'+
                        '<td>'+observaciones+'</td>'+
                        '<td><button type="button" class="btn btn-default"><i class="fa fa-picture-o" aria-hidden="true" onClick="modalFotos('+llavePrimaria+')"></i></button></td>'+
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
        $("#ubicacion").val("");
        $("#numeracion").val("");
        $("#obstruido").val("");
        $("#senalamiento").val("");
        $("#estadoGabinete").val("");
        $('#manometro').val("");
        $('#manguera').val("");
        $('#valvula').val("");
        $('#copleValvula').val("");
        $('#cristales').val("");
        $('#sistemaCierre').val("");
        $('#identificacion').val("");
        $('#doblesManguera').val("");
        $('#llaveAcople').val("");
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
            $idBitacora= $row['idBitacora'];
            $areaUbicacion = $row["ubicacion"];
            $numeracion = $row["numeracion"];
            $obstruido = $row["obstruido"];
            $senalamiento = $row["senalamiento"];
            $estadoGabinete = $row["estadoGabinete"];
            $manometro = $row['manometro'];
            $manguera = $row['manguera'];
            $valvula = $row['valvula'];
            $copleValvula = $row['copleValvula'];
            $cristales = $row['cristales'];
            $sistemaCierre = $row['sistemaCierre'];
            $identificacion = $row['identificacion'];
            $doblesManguera = $row['doblesManguera'];
            $llaveAcople = $row['llaveAcople'];
            $observaciones = $row['observaciones'];
            print "array.datosBitacora.push({'idBitacora': '$idBitacora', 'ubicacion': $areaUbicacion ,'numeracion': $numeracion, 'obstruido': $obstruido, 'senalamiento': $senalamiento,'estadoGabinete': $estadoGabinete,'manometro': $manometro,'manguera': $manguera,'valvula': $valvula,'copleValvula': $copleValvula,'cristales': $cristales,'sistemaCierre': $sistemaCierre, 'identificacion' : $identificacion,'doblesManguera' : $doblesManguera,'llaveAcople' : $llaveAcople,'action' : 0, 'observaciones': '$observaciones'}); \n";

             foreach ($areasUbicacion as $itemArea)
            {
                if($areaUbicacion==$itemArea['idArea'])
                {
                    $areaUbicacion=$itemArea['descripcion'];
                    break;
                }
            }

           // $ubicacion= ($ubicacion==1)? "Si":(($ubicacion==2)? "No": "N/A");
            $senalamiento= ($senalamiento==1)? "Si":(($senalamiento==2)? "No": "N/A");
            $numeracion= ($numeracion==1)? "Si":(($numeracion==2)? "No": "N/A");
            $obstruido= ($obstruido==1)? "Si":(($obstruido==2)? "No": "N/A");
            $estadoGabinete= ($estadoGabinete==1)? "Si":(($estadoGabinete==2)? "No": "N/A");
            $manometro= ($manometro==1)? "Si":(($manometro==2)? "No": "N/A");
            $manguera= ($manguera==1)? "Si":(($manguera==2)? "No": "N/A");
            $valvula= ($valvula==1)? "Si":(($valvula==2)? "No": "N/A");
            $copleValvula= ($copleValvula==1)? "Si":(($copleValvula==2)? "No": "N/A");
            $cristales= ($cristales==1)? "Si":(($cristales==2)? "No": "N/A");
            $sistemaCierre= ($sistemaCierre==1)? "Si":(($sistemaCierre==2)? "No": "N/A");
            $identificacion= ($identificacion==1)? "Si":(($identificacion==2)? "No": "N/A");
            $doblesManguera= ($doblesManguera==1)? "Si":(($doblesManguera==2)? "No": "N/A");
            $llaveAcople= ($llaveAcople==1)? "Si":(($llaveAcople==2)? "No": "N/A");



            print "$('#lista').append('<tr><td hidden>$idBitacora</td><td>$areaUbicacion</td><td>$numeracion</td><td>$obstruido</td><td>$senalamiento</td><td>$estadoGabinete</td><td>$manometro</td><td>$manguera</td><td>$valvula</td><td>$copleValvula</td><td>$cristales</td><td>$sistemaCierre</td><td>$identificacion</td><td>$doblesManguera</td><td>$llaveAcople</td><td>$observaciones</td><td><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\" onClick=\"modalFotos($idBitacora)\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
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
