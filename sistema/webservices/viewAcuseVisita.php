<?php

ini_set('error_reporting', E_ALL);

$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
$idAsignacion = $_REQUEST['idAsignacion'];
$idCentroTrabajo = $_REQUEST['idCentroTrabajo'];

?>
<!DOCTYPE html>
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
</head>
<body class="theme-red">
<div class="overlay"></div>

<?php
$conexion->query("SET CHARACTER SET utf8");

$data = array();

for($i=1; $i<11; $i++) {
    $data['instalacion'.$i] = $conexion->query("SELECT idIndicador, nombreIndicador FROM AcuseIndicadores WHERE idGrupoIndicador=$i")->fetchAll(PDO::FETCH_ASSOC);
}

$centroTrabajo = $conexion->query("SELECT CentrosDeTrabajo.* 
                                                    FROM CentrosDeTrabajo, municipios, estados, regiones 
                                                    WHERE idColonia=idRegiones 
                                                    AND regiones.municipio=municipios.idMunicipio 
                                                    AND municipios.estado=estados.id_Estado 
                                                    AND idCentroTrabajo=$idCentroTrabajo")->fetchAll(PDO::FETCH_ASSOC);


$acuses = $conexion->query("SELECT * FROM acuseVisita WHERE idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);



?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<div class="card">
                <div class="header">
                    <h2>Acuse de visita</h2>
                </div>
                <div class="body">
                    <form id="form">
                        <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel-group full-body" id="accordion_instalacionesElectricas" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_instalacionesElectricas">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_instalacionesElectricas" aria-expanded="true" aria-controls="collapseOne_instalacionesElectricas">
                                                    <i class="material-icons">assignment</i> Instalaciones electricas
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_instalacionesElectricas" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_instalacionesElectricas">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Ponderador</b>
                                                    </div>

                                                </div>
                                                <?php
                                                $contadorTotal=0;
                                                $contador1=0;
                                                foreach($data['instalacion1'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];
                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorInstalacionesElectricas$contador1'  value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorInstalacionesElectricas$contador1' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador1++;
                                                }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel-group full-body" id="accordion_riesgosEstructurales" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_riesgosEstructurales">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_riesgosEstructurales" aria-expanded="true" aria-controls="collapseOne_riesgosEstructurales">
                                                    <i class="material-icons">assignment</i> Riesgos estructurales
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_riesgosEstructurales" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_riesgosEstructurales">
                                            <div class="panel-body"><div class="row">
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Ponderador</b>
                                                    </div>

                                                </div>

                                                <?php
                                                $contador2=0;
                                                foreach($data['instalacion2'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];

                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorRiesgosEstructurales$contador2' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorRiesgosEstructurales$contador2' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador2++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel-group full-body" id="accordion_instalacionesGas" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_instalacionesGas">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_instalacionesGas" aria-expanded="true" aria-controls="collapseOne_instalacionesGas">
                                                    <i class="material-icons">assignment</i> Instalaciones de gas
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_instalacionesGas" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_instalacionesGas">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Ponderador</b>
                                                    </div>

                                                </div>
                                                <?php
                                                $contador3=0;
                                                foreach($data['instalacion3'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];

                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorInstalacionesGas$contador3' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorInstalacionesGas$contador3' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador3++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel-group full-body" id="accordion_instalacionesHidroSanitarias" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_instalacionesHidroSanitarias">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_instalacionesHidroSanitarias" aria-expanded="true" aria-controls="collapseOne_instalacionesHidroSanitarias">
                                                    <i class="material-icons">assignment</i> Instalaciones Hidrosanitarias
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_instalacionesHidroSanitarias" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_instalacionesHidroSanitarias">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Ponderador</b>
                                                    </div>

                                                </div>
                                                <?php
                                                $contador4=0;
                                                foreach($data['instalacion4'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];

                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorInstalacionesHidrosanitarias$contador4' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorInstalacionesHidrosanitarias$contador4' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador4++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel-group full-body" id="accordion_contenidoBotiquin" role="tablist" aria-multiselectable="true">
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
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                                        <b>Ponderador</b>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                                        <b>Cantidad</b>
                                                    </div>

                                                </div>
                                                <?php
                                                $contador6=0;
                                                foreach($data['instalacion6'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];
                                                    echo "
                                                        <div class='row'>
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorMaterialSeco$contador6' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorMaterialSeco$contador6' id='select$llavePrimaria'>
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
                                                                        <input class='form-control' type='number' name='cantidadMaterialSeco$contador6' id='cantidad$llavePrimaria'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador6++;
                                                }
                                                ?>
                                                <h4>Material Húmedo</h4>
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                                        <b>Ponderador</b>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                                        <b>Cantidad</b>
                                                    </div>

                                                </div>
                                                <?php
                                                $contador5=0;
                                                foreach($data['instalacion5'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];

                                                    echo "
                                                        <div class='row'>
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorMaterialHumedo$contador5' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorMaterialHumedo$contador5' id='select$llavePrimaria'>
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
                                                                        <input class='form-control' type='number' name='cantidadMaterialHumedo$contador5' id='cantidad$llavePrimaria'>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador5++;
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel-group full-body" id="accordion_elementosNoEstructurales" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_elementosNoEstructurales">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_elementosNoEstructurales" aria-expanded="true" aria-controls="collapseOne_elementosNoEstructurales">
                                                    <i class="material-icons">assignment</i> Revisión por elementos no estructurales
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_elementosNoEstructurales" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_elementosNoEstructurales">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Ponderador</b>
                                                    </div>

                                                </div>
                                                <?php
                                                $contador7=0;
                                                foreach($data['instalacion7'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];

                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorInstalacionesNoEstructurales$contador7' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorInstalacionesNoEstructurales$contador7' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador7++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel-group full-body" id="accordion_Otros" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_Otros">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_Otros" aria-expanded="true" aria-controls="collapseOne_Otros">
                                                    <i class="material-icons">assignment</i> Datos adicionales
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_Otros" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_Otros">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Ponderador</b>
                                                    </div>

                                                </div>
                                                <?php
                                                $contador10=0;
                                                foreach($data['instalacion10'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];

                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                    <div class='form-line'>
                                                                        <input type='hidden' name='indicadorOtros$contador10' value='".$row['idIndicador']."'>
                                                                       <select class='form-control' name='ponderadorOtros$contador10' id='select$llavePrimaria'>
                                                                           <option value=''>Seleccione una opción</option>
                                                                           <option value='1'>Si</option>
                                                                           <option value='2'>No</option>
                                                                           <option value='3'>N/A</option>
                                                                       </select>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador10++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel-group full-body" id="accordion_equiposEmergencia" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_equiposEmergencia">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_equiposEmergencia" aria-expanded="true" aria-controls="collapseOne_equiposEmergencia">
                                                    <i class="material-icons">assignment</i> Riesgo por deficiencia en los equipos de emergencia y las condiciones de seguridad...
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_equiposEmergencia" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_equiposEmergencia">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Ponderador</b>
                                                    </div>

                                                </div>
                                                <?php
                                                $contador8=0;
                                                foreach($data['instalacion8'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];

                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                    <div class='form-line'>
                                                                        <input type='hidden' name='indicadorEquiposEmergencia$contador8' value='".$row['idIndicador']."'>
                                                                       <select class='form-control' name='ponderadorEquiposEmergencia$contador8' id='select$llavePrimaria'>
                                                                           <option value=''>Seleccione una opción</option>
                                                                           <option value='1'>Si</option>
                                                                           <option value='2'>No</option>
                                                                       </select>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador8++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="panel-group full-body" id="accordion_riesgosExternos" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_riesgosExternos">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_riesgosExternos" aria-expanded="true" aria-controls="collapseOne_riesgosExternos">
                                                    <i class="material-icons">assignment</i> Identificación de riesgos externos
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_riesgosExternos" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_riesgosExternos">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Descripción</b>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <b>Dist.</b>
                                                    </div>

                                                </div>
                                                <?php
                                                $contador9=0;
                                                foreach($data['instalacion9'] as $row)
                                                {
                                                    $llavePrimaria=$row['idIndicador'];

                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                    echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorRiesgosExternos$contador9' value='".$row['idIndicador']."'>
                                                                   <input type='number' class='form-control' name='distRiesgosExternos$contador9' id='dist$llavePrimaria'>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                    $contadorTotal++;
                                                    $contador9++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-4 col-md-offset-5">
                                    <div class="form-line">
                                        <input type="submit" class="btn bg-red waves-effect waves-light" value="Guardar">
                                        <input onclick="popUpImprimir(<?=$idAsignacion?>);" type="button" class="btn bg-red waves-effect waves-light" value="Imprimir" id="btn-imprimir">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#correoModal" id="btn-enviar">
                                            Enviar correo
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

<!-- Modal -->
<div class="modal fade" id="correoModal" tabindex="-1" role="dialog" aria-labelledby="correoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="correoModalLabel">Enviar correo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="correo-acuse">Correo electrónico</label>
                                <input type="email" class="form-control" id="correo-acuse" name="correo-acuse" value="<?=$centroTrabajo[0]['correoInmueble']?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="enviarCorreoPDF(<?=$idAsignacion?>,<?=$idCentroTrabajo?>)">Enviar</button>
            </div>
        </div>
    </div>
</div>

<script>

    function  popUpImprimir(id)
    {
        window.location = "https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/acuse/"+id;
    }
    

    function enviarCorreoPDF(idAsignacion, idCentroTrabajo)
    {
        var correoAcuse = document.getElementById("correo-acuse").value;
        swal({
                title: "Aviso",
                text: "¿Desea enviar el correo electrónico?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function(){
                $.ajax({
                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/enviarPDFAcuse/"+idAsignacion+"/"+idCentroTrabajo,
                    type: "POST",
                    data: {correoAcuse: correoAcuse},
                    dataType: "HTML",
                    success: function(data)
                    {
                        swal("Hecho", "Correo enviado con éxito", "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Error", "Ocurio un error inesperado", "warning");
                    }
                });
            });
    }

    $(document).ready(function ()
    {
        <?php
        foreach ($acuses as $row)
        {
            if(!empty($row['idPonderador']))
            {
                echo "$('#select".$row['idIndicador']."').val(".$row['idPonderador'].");\n";
                if(!empty($row['cantidad']))
                {
                    echo "$('#cantidad".$row['idIndicador']."').val(".$row['cantidad'].");\n";
                }
            }
            else if(!empty($row['distancia']))
            {
                echo "$('#dist".$row['idIndicador']."').val(".$row['distancia'].");\n";
            }

        }
        ?>
    });
</script>

<script>
    $("#form").submit(function (e)
    {
        e.preventDefault();

        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudVisitaAcuse/guardarAcuse/<?php echo $idAsignacion."/".$contador1."/".$contador2."/".$contador3."/".$contador4."/".$contador5."/".$contador6."/".$contador7."/".$contador8."/".$contador9."/".$contador10?>",
                data: $("#form").serialize(),
                type: 'post',
                success: function (data)
                {
                    swal("Bien hecho", "Acuse de visita guardado", "success");
                }
            }
        );
    });
</script>


<!-- Bootstrap Core Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/bootstrap/js/bootstrap.js"></script>


<!-- Jquery Core Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery/jquery.min.js"></script>

<!--JQuery UI-->
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!--Datatable-->
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.dataTables.min.js"></script>


<!-- Bootstrap Core Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<!-- <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

<!-- Slimscroll Plugin Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/node-waves/waves.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Morris Plugin Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/raphael/raphael.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/morrisjs/morris.js"></script>

<!-- ChartJs -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/chartjs/Chart.bundle.js"></script>

<!-- Flot Charts Plugin Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.time.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Custom Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/js/admin.js"></script>

<script src="https://cointic.com.mx/preveer/sistema/assets/js/pages/index.js"></script>



<!-- Demo Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/js/demo.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/modernizr.touch.js"></script>
<!--<script src="<?/*=base_url('assets/js/mfb.js.js')*/?>"></script>
-->


<!--JS PARA EDITAR IMAGENES AUTOMATICAMENTE -->
<link href="https://cointic.com.mx/preveer/sistema/assets/css/fileinput.min.css" rel="stylesheet">
<script src="https://cointic.com.mx/preveer/sistema/assets/js/piexif.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/sortable.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/purify.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/fileinput.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/es.js"></script>



<script>

    var panel = document.getElementById('panel'),
        menu = document.getElementById('menu'),
        showcode = document.getElementById('showcode'),
        selectFx = document.getElementById('selections-fx'),
        selectPos = document.getElementById('selections-pos'),
        // demo defaults
        effect = 'mfb-zoomin',
        pos = 'mfb-component--br';

    //showcode.addEventListener('click', _toggleCode);
    //selectFx.addEventListener('change', switchEffect);
    //selectPos.addEventListener('change', switchPos);

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
