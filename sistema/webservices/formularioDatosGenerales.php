<?php
$idUsuarioBase = $_REQUEST['idusuariobase'];
$tipoUser = $_REQUEST['tipoUser'];
$cambioPas = $_REQUEST['cambioPas'];
$idUsuarioBase = 9;
$tipoUser = 4;
$cambioPas = 1;
$base_url="https://cointic.com.mx/preveer/sistema/";
$site_url="https://cointic.com.mx/preveer/sistema/index.php/";
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

<script type="text/javascript">
    function iniciarMap(){

        var boton=document.getElementById('obtener');

        boton.addEventListener('click', obtener, false);

    }


    function obtener(){navigator.geolocation.getCurrentPosition(mostrar, gestionarErrores);}
    function mostrar(posicion){
        var ubicacion=document.getElementById('localizacion');
        var datos='';
        datos+='Latitud: '+posicion.coords.latitude+'<br>';
        datos+='Longitud: '+posicion.coords.longitude+'<br>';
        datos+='Exactitud: '+posicion.coords.accuracy+' metros.<br>';

        $("#latitud").val(posicion.coords.latitude);
        $("#longitud").val(posicion.coords.longitude);
        $("#Metros").val(posicion.coords.accuracy+" metros.");
    }

    function gestionarErrores(error){
        alert('Error: '+error.code+' '+error.message+ '\n\nPor favor compruebe que está conectado '+
            'a internet y habilite la opción permitir compartir ubicación física');
    }
    window.addEventListener('load', iniciarMap, false);
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Lista de datos generales del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <form id="form" enctype="multipart/form-data" action="CrudAnalisisRiesgo/actualizarDatosGenerales/">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
                                <?php
                                $idAsignacion=$_REQUEST['idAsignacion'];
                                $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                                $conexion->query("SET CHARACTER SET utf8");
                                $existencia=$conexion->query("SELECT DatosGenerales.* FROM DatosGenerales JOIN asignaInmueble ON DatosGenerales.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                                $contador=0;
                                $contadorFotos=0;
                                $tipoVisita=0;
                                $fotos=$conexion->query("SELECT fotosDatosGenerales.* FROM fotosDatosGenerales JOIN asignaInmueble ON fotosDatosGenerales.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                                ;
                                foreach ($existencia as $row)
                                {
                                    $contador++;
                                }
                                if($contador==0)
                                {
                                    $tipoVisita=1;
                                    $insercion=$conexion->prepare("INSERT INTO DatosGenerales (fechaVisita,numVisita, idAsignacion)  VALUES (?, ?, ?)");
                                    $fecha=date("Y-m-d");
                                    $insercion->bindParam(1, $fecha);
                                    $insercion->bindParam(2, $tipo);

                                    $insercion->bindParam(3, $idAsignacion);
                                    $insercion->execute();


                                    $existencia=$conexion->query("SELECT DatosGenerales.* FROM DatosGenerales JOIN asignaInmueble ON DatosGenerales.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                                }

                                if($contadorFotos==0)
                                {

                                    $insercionFotos=$conexion->prepare("INSERT INTO fotosDatosGenerales (idAsignacion)  VALUES (?)");
                                    $insercionFotos->bindParam(1, $idAsignacion);
                                    $insercionFotos->execute();
                                    $fotos=$conexion->query("SELECT fotosDatosGenerales.* FROM fotosDatosGenerales JOIN asignaInmueble ON fotosDatosGenerales.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");

                                }

                                $CT=$conexion->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CentrosDeTrabajo.idFormato FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo WHERE asignaInmueble.idAsignacion=$idAsignacion");
                                $idCentroTrabajo;
                                $idFormato;
                                foreach($CT as $id)
                                {
                                    $idCentroTrabajo=$id['idCentroTrabajo'];
                                    $idFormato=$id['idFormato'];
                                }

                                $contador=0;
                                $rowFotos=null;
                                $row=array('idDatosGenerales'=>"", 'fechaVisita'=>"", 'numVisita'=>"", 'licenciaFuncionamiento'=>"", 'fachada'=>"",
                                    'numPersonalInterno'=>"", 'numPersonalExterno'=>"", 'aforo'=>"", 'fechaConstruccion'=>"", 'fechaInicioOperaciones'=>"",
                                    'areasRemodeladas'=>"", 'metrosConstruccion'=>"", 'metrosTerreno'=>"", 'usoDelInmueble'=>"", 'vidrioTemplado'=>"",
                                    'peliculaAntiAsalto'=>"", 'docRespaldo'=>"", 'retardante'=>"", 'alertaSismo'=>"", 'fotoVidrio'=>"", 'fotoPelicula'=>"", 'idAsignacion'=>"", );
                                $existencia=$conexion->query("SELECT DatosGenerales.* FROM DatosGenerales JOIN asignaInmueble ON DatosGenerales.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");

                                foreach ($existencia as $row2)
                                {
                                    $row=$row2;
                                    $contador++;
                                }
                                $fotos=$conexion->query("SELECT fotosDatosGenerales.* FROM fotosDatosGenerales JOIN asignaInmueble ON fotosDatosGenerales.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                                foreach ($fotos as $row3)
                                {
                                    $rowFotos=$row3;
                                }
                                ?>

                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                                <i class="material-icons">assignment</i> Visitas
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">
                                            <div class="row">
                                                <input type="hidden" name="idDatosGenerales" value="<?php echo $row['idDatosGenerales'];?>">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de Visita</b>
                                                            <input type="date" class="form-control" id="fechaVisita" name="fechaVisita"  required value="<?php echo date("Y-m-d"); ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de visita</b>
                                                            <input type="number" class="form-control" id="numVisita" name="numVisita" min="0" value="<?php echo $row['numVisita'];?>" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tipo de visita</b>
                                                            <select class="form-control" id="tipoVisita" name="tipoVisita">
                                                                <?php
                                                                if(($tipoVisita)==0)
                                                                    echo '
                                                                    <option value="2">Actualización</option>
                                                                    <option value="3">Apertura</option>
                                                                    <option value="4">Recolección Documental</option>
                                                                    <option value="5">Otro</option>';
                                                                else
                                                                    echo "
                                                                    <option value='1'>Nueva</option>";
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-offset-3 col-md-offset-3 col-sm-3 col-md-3">
                                                    <a href="#" onclick="editarCentroTrabajo()" >
                                                        <div class="demo-google-material-icon">
                                                            <i class="material-icons" >group_work</i> <span class="icon-name">Editar centro de trabajo</span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-sm-3 col-md-3">
                                                    <a href="#" onclick="editarFormato()" >
                                                        <div class="demo-google-material-icon">
                                                            <i class="material-icons" >store_mall_directory</i> <span class="icon-name">Editar formato</span>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-group full-body" id="accordion_19" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_19">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">
                                                <i class="material-icons">assignment</i> Datos
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de personal interno</b>
                                                            <input type="number" class="form-control" id="numPersonalInterno" name="numPersonalInterno"   value="<?php echo $row['numPersonalInterno'];?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de personal externo</b>
                                                            <input type="number" class="form-control" id="numPersonalExterno" name="numPersonalExterno" min="0" value="<?php echo $row['numPersonalExterno'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Aforo</b>
                                                            <input type="number" class="form-control" id="aforo" name="aforo" min="0" value="<?php echo $row['aforo'];?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de construcción</b>
                                                            <input type="date" class="form-control" id="fechaConstruccion" name="fechaConstruccion" value="<?php echo $row['fechaConstruccion'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de inicio de operaciones</b>
                                                            <input type="date" class="form-control" id="fechaInicioOperaciones" name="fechaInicioOperaciones" value="<?php echo $row['fechaInicioOperaciones'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <b>Última remodelación</b>
                                                        <br><input class="form-control" type="checkbox" value="NoAplica" id="aplicaUltimaRemodelacion" value="aplicaUltimaRemodelacion" onchange="habilitarUltimaRemodelacion();" onload="habilitarUltimaRemodelacion();" <?php if($row['aplicaUltimaRemodelacion']==1) echo 'checked';?>><label for="aplicaUltimaRemodelacion">No aplica</label></br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de última remodelación</b>
                                                            <input type="date" class="form-control" id="ultimaRemodelacion" name="ultimaRemodelacion" value="<?php echo $row['ultimaRemodelacion'];?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Descripción de modificaciones realizadas</b>
                                                            <input type="text" class="form-control" id="modificacionesRealizadas" name="modificacionesRealizadas" value="<?php echo $row['modificacionesRealizadas'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <b>Otras entidades</b>
                                                        <br><input class="form-control" type="checkbox" id="aplicaOtrasEntidades" value="NoAplica" onchange="habilitarOtrasEntidades();" onload="habilitarOtrasEntidades();" <?php if($row['aplicaOtrasEntidades']==1) echo 'checked';?>><label for="aplicaOtrasEntidades">No aplica</label></br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Descripción de entidades</b>
                                                            <input class="form-control" id="otrasEntidades" name="otrasEntidades" value="<?php echo $row['otrasEntidades'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <b>Otras actividades</b>
                                                        <br><input class="form-control" type="checkbox" id="aplicaOtrasActividades" value="NoAplica" onchange="habilitarOtrasActividades();" onload="habilitarOtrasActividades();" <?php if($row['aplicaOtrasActividades']==1) echo 'checked';?>><label for="aplicaOtrasActividades">No aplica</label></br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Descripción de actividades</b>
                                                            <input class="form-control" id="otrasActividades" name="otrasActividades" value="<?php echo $row['otrasActividades'];?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de niveles</b>
                                                            <input type="number" class="form-control" id="numeroNiveles" name="numeroNiveles"   value="<?php echo $row['numeroNiveles'];?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" id="observacionesNiveles" name="observacionesNiveles" value="<?php echo $row['observacionesNiveles'];?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Metros de construcción</b>
                                                            <input type="text" class="form-control" id="metrosConstruccion" name="metrosConstruccion"   value="<?php echo $row['metrosConstruccion'];?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Metros de terreno</b>
                                                            <input type="text" class="form-control" id="metrosTerreno" name="metrosTerreno" min="0" value="<?php echo $row['metrosTerreno'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Documento de respaldo</b>
                                                            <select type="number" class="form-control" id="docRespaldo" name="docRespaldo" min="0" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['docRespaldo']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['docRespaldo']==2) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Areas remodeladas</b>
                                                            <textarea class="form-control" id="areasRemodeladas" name="areasRemodeladas"><?php echo $row['areasRemodeladas'];?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group ">
                                                        <div class="form-line">
                                                            <b>Uso para el que el inmueble fue creado</b>
                                                            <textarea class="form-control" id="usoDelInmueble" name="usoDelInmueble"><?php echo $row['usoDelInmueble'];?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--AQUI EMPIEZA LA PARTE DE DISCAPACITADOS-->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>¿El inmueble presta servicios a personas con discapacidad?</b>
                                                            <select class="form-control" id="serviciosDiscapacidad" name="serviciosDiscapacidad" >
                                                                <option value="" >Seleccione una opción</option>
                                                                <option value="1" <?php if($row['serviciosDiscapacidad']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['serviciosDiscapacidad']==2) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input class="form-control" type="text" id="observacionesServiciosDiscapacidad" name="observacionesServiciosDiscapacidad" value="<?php echo $row['observacionesServiciosDiscapacidad'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>¿El inmueble cuenta con personal con alguna discapacidad?</b>
                                                            <select class="form-control" id="personalDiscapacidad" name="personalDiscapacidad" onChange="habilitarPersonalDiscapacidad();">
                                                                <option value="2" <?php if($row['personalDiscapacidad']==2) echo "selected"?>>No</option>
                                                                <option value="1" <?php if($row['personalDiscapacidad']==1) echo "selected"?>>Si</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <b>Tipos de discapacidad</b>
                                                    <br>
                                                    <input type="checkbox" class="form-control" value='visual1' name="visual" id="visual" <?php if($row['visual']==1) echo 'checked';?> /><label for="visual" >Visual</label>
                                                    <input type="checkbox" class="form-control" value='auditiva1' name="auditiva" id="auditiva" <?php if($row['auditiva']==1) echo 'checked';?>/><label for="auditiva" >Auditiva</label>
                                                    <input type="checkbox" class="form-control" value='fisica1' name="fisica" id="fisica" <?php if($row['fisica']==1) echo 'checked';?>/><label for="fisica">Física</label>
                                                    <input type="checkbox" class="form-control" value='intelectual1' name="intelectual" id="intelectual" <?php if($row['intelectual']==1) echo 'checked';?>/><label for="intelectual">Intelectual</label>
                                                    <input type="checkbox" class="form-control" value='mental1' name="mental" id="mental" <?php if($row['mental']==1) echo 'checked';?>/><label for="mental">Mental</label>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de personal con discapacidad</b>
                                                            <input type="number" class="form-control" id="cantidadPersonalDiscapacidad" name="cantidadPersonalDiscapacidad" min="0" value="<?php echo $row['cantidadPersonalDiscapacidad'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones del personal con discapacidad</b>
                                                            <input type="text" class="form-control" id="observacionesPersonalDiscapacidad" name="observacionesPersonalDiscapacidad" value="<?php echo $row['observacionesPersonalDiscapacidad'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--AQUI Termina LA PARTE DE DISCAPACITADOS-->

                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Vidrio templado</b>
                                                            <select class="form-control" id="vidrioTemplado" name="vidrioTemplado" >
                                                                <option value="" >Seleccione una opción</option>
                                                                <option value="1" <?php if($row['vidrioTemplado']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['vidrioTemplado']==2) echo "selected"?>>No</option>
                                                                <option value="3" <?php if($row['vidrioTemplado']==3) echo "selected"?>>No aplica</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de vidrio templado</b>
                                                    <input type="file" class="file" id="fotoVidrio" name="fotoVidrio[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de vidrio templado</b>
                                                    <input type="file" class="file" id="fotoVidrio1" name="fotoVidrio1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de vidrio templado</b>
                                                    <input type="file" class="file" id="fotoVidrio2" name="fotoVidrio2[]" data-min-file-count="1" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12" align="center">
                                                    <div class="form-group ">
                                                        <div class="form-line">
                                                            <b>Observaciones del vidrio templado</b>
                                                            <textarea class="form-control" id="obsevacionesVidrio" name="obsevacionesVidrio"><?php echo $row3['observacionesVidrio'];?> </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Pelicula antiasalto</b>
                                                            <select class="form-control" id="peliculaAntiAsalto" name="peliculaAntiAsalto" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['peliculaAntiAsalto']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['peliculaAntiAsalto']==2) echo "selected"?>>No</option>
                                                                <option value="3" <?php if($row['peliculaAntiAsalto']==3) echo "selected"?>>No aplica</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de pelicula antiasalto</b>
                                                    <input type="file" class="file" id="fotoPelicula" name="fotoPelicula[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de pelicula antiasalto</b>
                                                    <input type="file" class="file" id="fotoPelicula1" name="fotoPelicula1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de pelicula antiasalto</b>
                                                    <input type="file" class="file" id="fotoPelicula2" name="fotoPelicula2[]" data-min-file-count="1" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12" align="center">
                                                    <div class="form-group ">
                                                        <div class="form-line">
                                                            <b>Observaciones de pelicula antiasalto</b>
                                                            <textarea class="form-control" id="observacionesPelicula" name="observacionesPelicula"> <?php echo $row3['observacionesPelicula'];?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Retardante a fuego</b>
                                                            <select class="form-control" id="retardante" name="retardante" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['retardante']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['retardante']==2) echo "selected"?>>No</option>
                                                                <option value="3" <?php if($row['retardante']==3) echo "selected"?>>No aplica</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-offset-2 col-md-offset-2 col-sm-4 col-md-4">
                                                    <b>Foto de retardante a fuego</b>
                                                    <input type="file" class="file" id="fotoRetardante" name="fotoRetardante[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de retardante a fuego</b>
                                                    <input type="file" class="file" id="fotoRetardante1" name="fotoRetardante1[]" data-min-file-count="1" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12" align="center">
                                                    <div class="form-group ">
                                                        <div class="form-line">
                                                            <b>Observaciones de retardante de fuego</b>
                                                            <textarea class="form-control" id="obsevacionesFuego" name="obsevacionesFuego"><?php echo $row3['observacionesRetardante'];?> </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Alerta sísmica</b>
                                                            <select class="form-control" id="alertaSismo" name="alertaSismo" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['alertaSismo']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['alertaSismo']==2) echo "selected"?>>No</option>
                                                                <option value="3" <?php if($row['alertaSismo']==3) echo "selected"?>>No aplica</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de alerta sísmica</b>
                                                    <input type="file" class="file" id="fotoAlertaSismica" name="fotoAlertaSismica[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de alerta sísmica</b>
                                                    <input type="file" class="file" id="fotoAlertaSismica1" name="fotoAlertaSismica1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de alerta sísmica</b>
                                                    <input type="file" class="file" id="fotoAlertaSismica2" name="fotoAlertaSismica2[]" data-min-file-count="1" />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12" align="center">
                                                    <div class="form-group ">
                                                        <div class="form-line">
                                                            <b>Observaciones de alerta sismica</b>
                                                            <textarea class="form-control" id="obsevacionesAlerta" name="obsevacionesAlerta"><?php echo $row3['observacionesSismica'];?> </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-offset-4 col-sm-offset-3 col-sm-6 col-md-4">
                                                    <b>Fachada</b>
                                                    <input type="file" class="file"  id="fachada" name="fachada[]" data-min-file-count="1"  />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Descripción del techo</b>
                                                            <input class="form-control" type="text" id="descripcionTecho" name="descripcionTecho" value="<?php echo $rowFotos['descripcionTecho'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones del techo</b>
                                                            <input class="form-control" type="text" id="observacionesTecho" name="observacionesTecho" value="<?php echo $rowFotos['observacionesTecho'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto del techo</b>
                                                    <input type="file" class="file" id="fotoTecho" name="fotoTecho[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto del techo</b>
                                                    <input type="file" class="file" id="fotoTecho1" name="fotoTecho1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto del techo</b>
                                                    <input type="file" class="file" id="fotoTecho2" name="fotoTecho2[]" data-min-file-count="1" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Descripción de los muros</b>
                                                            <input class="form-control" type="text" id="descripcionMuro" name="descripcionMuro" value="<?php echo $rowFotos['descripcionMuro'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones de los muros</b>
                                                            <input class="form-control" type="text" id="observacionesMuro" name="observacionesMuro" value="<?php echo $rowFotos['observacionesMuro'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto del Muro</b>
                                                    <input type="file" class="file" id="fotoMuro" name="fotoMuro[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto del Muro</b>
                                                    <input type="file" class="file" id="fotoMuro1" name="fotoMuro1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto del Muro</b>
                                                    <input type="file" class="file" id="fotoMuro2" name="fotoMuro2[]" data-min-file-count="1" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Descripción de los pisos</b>
                                                            <input class="form-control" type="text" id="descripcionPiso" name="descripcionPiso" value="<?php echo $rowFotos['descripcionPiso'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones de los pisos</b>
                                                            <input class="form-control" type="text" id="observacionesPiso" name="observacionesPiso" value="<?php echo $rowFotos['observacionesPiso'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto del piso</b>
                                                    <input type="file" class="file" id="fotoPiso" name="fotoPiso[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto del piso</b>
                                                    <input type="file" class="file" id="fotoPiso1" name="fotoPiso1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto del piso</b>
                                                    <input type="file" class="file" id="fotoPiso2" name="fotoPiso2[]" data-min-file-count="1" />
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Descripción de la iluminación</b>
                                                            <input class="form-control" type="text" id="descripcionIluminacion" name="descripcionIluminacion" value="<?php echo $rowFotos['descripcionIluminacion'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones de la iluminación</b>
                                                            <input class="form-control" type="text" id="observacionesIluminacion" name="observacionesIluminacion" value="<?php echo $rowFotos['observacionesIluminacion'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de la iluminación</b>
                                                    <input type="file" class="file" id="fotoIluminacion" name="fotoIluminacion[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de la iluminación</b>
                                                    <input type="file" class="file" id="fotoIluminacion1" name="fotoIluminacion1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto de la iluminación</b>
                                                    <input type="file" class="file" id="fotoIluminacion2" name="fotoIluminacion2[]" data-min-file-count="1" />
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>





<div class="modal fade" id="myModalCentro" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title encabezado-modal">Editar centro de trabajo</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="formModal" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" id="idCentroTrabajo" name="idCentroTrabajo" value="<?=$idCentroTrabajo?>">

                        <div class="col-sm-6">
                            <label for="nombreCentro">Nombre del centro de trabajo</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="nombreCentro" name="nombreCentro" placeholder="Nombre" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="idDet">IdDet</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="idDet" name="idDet" placeholder="IdDet" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-4">
                            <label>Estado</label>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select id="estado" name="estado" style="width: 100%; border: none;color:#000;"  onChange="obtenerMunicipios();" required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Municipio o Delegación</label>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select id="municipio" name="municipio" style="width: 100%; border: none;color:#000;"  onChange="obtenerColonias();" required>
                                        <option value="">Seleccione el municipio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Colonia</label>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <select id="colonia" name="colonia" style="width: 100%; border: none;color:#000;" onChange="obtenerCodigoPostal();" required>
                                        <option value="">Seleccione la colonia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-3">
                            <label for="calle">Calle</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label for="numExterior">Número Exterior</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" id="numExterior" name="numExterior" placeholder="Número Exterior"  />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="numInterior">Número Interior</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="numInterior" name="numInterior" placeholder="Número Interior" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label for="codigoPostal">Código Postal</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Código Postal" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-3">
                            <label for="Nombre">Nombre de contacto</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="nomContacto" name="nomContacto" placeholder="Nombre de contacto" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="email_address">Puesto de contacto</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="puestoContacto" name="puestoContacto" placeholder="Puesto de contacto" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label for="email_address">Teléfono de contacto</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="telContacto" name="telContacto" placeholder="Teléfono de contacto" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="email_address">Correo de contacto</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="correoContacto" name="correoContacto" placeholder="Correo de contacto" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email_address">Teléfono del inmueble</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="tel" class="form-control" id="telefonoInmueble" name="telefonoInmueble" placeholder="Teléfono del inmueble" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="email_address">Correo del inmueble</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="email" class="form-control" id="correoInmueble" name="correoInmueble" placeholder="Correo del inmueble"  />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-1">
                            <label for="email_address">Inicio de funcionamiento</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" class="form-control" id="horarioFuncionamientoInicio" name="horarioFuncionamientoInicio" placeholder="Horario"  />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="email_address">Fin de funcionamiento</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" class="form-control" id="horarioFuncionamientoFin" name="horarioFuncionamientoFin" placeholder="Horario" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="">¿Aplica atención a clientes?</label>
                            <div class="form-group">
                                <input type="checkbox" value="NoAplica" class="form-control" id="aplicaHorarioAtencion" onChange="habilitarAtencionClientes();" name="aplicaHorarioAtencion" placeholder="Horario" ><label for="aplicaHorarioAtencion"> No Aplica</label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="email_address">Inicio de atención a clientes</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" class="form-control" id="horarioAtencionInicio" name="horarioAtencionInicio" placeholder="Horario" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="email_address">Fin de atención a clientes</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="time" class="form-control" id="horarioAtencionFin" name="horarioAtencionFin" placeholder="Horario" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="giroInmueble">Giro completo</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="giroInmueble" name="giroInmueble" placeholder="Giro del inmueble" required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="latitud">Latitud</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud (Coordenadas)" readonly required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="longitud">Longitud</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud (Coordenadas)" readonly required/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <label for="longitud">Metros</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="Metros" name="Metros" placeholder="Metros (Coordenadas)" readonly required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-line">
                                <input type="button" id="obtener" class="btn bg-black waves-effect waves-light"value="Obtener mi ubicación">

                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-md-offset-5">
                            <div class="form-line">
                                <input type="submit" class="btn bg-black waves-effect waves-light" value="Actualizar">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalFormato" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title encabezado-modal">Editar Formato de trabajo</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="formFormato" enctype="multipart/form-data">
                    <input type="hidden" id="idFormato" name="idFormato" value="<?=$idFormato;?>">
                    <input type="hidden" id="fotoBase" name="fotoBase">
                    <!-- datos fiscales -->
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="email_address">Razón social</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón social del centro de trabajo" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="email_address">Nombre</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="nombreFormato" name="nombreFormato" placeholder="Nombre del formato" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="rfc">Nombre del representante legal</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="nombreRepresentante" name="nombreRepresentante" placeholder="Nombre del representante legal"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="email_address">RFC</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC del centro de trabajo" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="email_address">Comentarios RFC</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="comenRFC" name="comenRFC" placeholder="Comentarios sobre el RFC del centro de trabajo" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <label for="email_address">Domicilio Fiscal</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="domFiscal" name="domFiscal" placeholder="Domicilio Fiscal del centro de trabajo" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-md-offset-5">
                            <div class="form-line">
                                <input type="submit" class="btn bg-black waves-effect waves-light" value="Actualizar">
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(function(){
        $("#form").on("submit", function(e){
            var url;
            var accion=<?php echo $contador;?>;
            // if(accion==0)
            //     accion="insertarDatosGenerales/";
            // else
            accion="actualizarDatosGenerales/";





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
                            text: "Se han registrado los datos generales",
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
<!--TODO: colocar estos js en el servidor-->





<script type="text/javascript">


    $(window).on('load', function()
    {

        $('#fachada').fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFachada/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fachada"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/').$row['fachada']."\' class='file-preview-image' alt=\'".$row['fachada']."\' title=\'".$row['fachada']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fachada").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fachada';
                $tabla = 'DatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        $("#fotoVidrio").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoVidrio/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoVidrio"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoVidrio').$rowFotos['fotoVidrio']."\' class='file-preview-image' alt=\'".$rowFotos['fotoVidrio']."\' title=\'".$rowFotos['fotoVidrio']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoVidrio").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoVidrio';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoVidrio1").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoVidrio1/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoVidrio1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoVidrio1').$rowFotos['fotoVidrio1']."\' class='file-preview-image' alt=\'".$rowFotos['fotoVidrio1']."\' title=\'".$rowFotos['fotoVidrio1']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoVidrio1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoVidrio1';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoVidrio2").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoVidrio2/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoVidrio2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoVidrio2').$rowFotos['fotoVidrio2']."\' class='file-preview-image' alt=\'".$rowFotos['fotoVidrio2']."\' title=\'".$rowFotos['fotoVidrio2']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoVidrio2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoVidrio2';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoPelicula").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPelicula/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoPelicula"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoPelicula').$rowFotos['fotoPelicula']."\' class='file-preview-image' alt=\'".$rowFotos['fotoPelicula']."\' title=\'".$rowFotos['fotoPelicula']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPelicula").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPelicula';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        $("#fotoPelicula1").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPelicula1/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoPelicula1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoPelicula1').$rowFotos['fotoPelicula1']."\' class='file-preview-image' alt=\'".$rowFotos['fotoPelicula1']."\' title=\'".$rowFotos['fotoPelicula1']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPelicula1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPelicula1';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        $("#fotoPelicula2").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPelicula2/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoPelicula2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoPelicula2').$rowFotos['fotoPelicula2']."\' class='file-preview-image' alt=\'".$rowFotos['fotoPelicula2']."\' title=\'".$rowFotos['fotoPelicula2']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPelicula2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPelicula2';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoRetardante").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoRetardante/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($rowFotos["fotoRetardante"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoRetardante').$rowFotos['fotoRetardante']."\' class='file-preview-image' alt=\'".$rowFotos['fotoRetardante']."\' title=\'".$rowFotos['fotoRetardante']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoRetardante").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoRetardante';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoRetardante1").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoRetardante1/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoRetardante1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoRetardante1').$rowFotos['fotoRetardante1']."\' class='file-preview-image' alt=\'".$rowFotos['fotoRetardante1']."\' title=\'".$rowFotos['fotoRetardante1']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoRetardante1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoRetardante1';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        $("#fotoAlertaSismica").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoAlertaSismica/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoAlertaSismica"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoAlertaSismica').$rowFotos['fotoAlertaSismica']."\' class='file-preview-image' alt=\'".$rowFotos['fotoAlertaSismica']."\' title=\'".$rowFotos['fotoAlertaSismica']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoAlertaSismica").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoAlertaSismica';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoAlertaSismica1").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoAlertaSismica1/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoAlertaSismica1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoAlertaSismica1').$rowFotos['fotoAlertaSismica1']."\' class='file-preview-image' alt=\'".$rowFotos['fotoAlertaSismica1']."\' title=\'".$rowFotos['fotoAlertaSismica1']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoAlertaSismica1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoAlertaSismica1';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoAlertaSismica2").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoAlertaSismica2/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoAlertaSismica2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoAlertaSismica2').$rowFotos['fotoAlertaSismica2']."\' class='file-preview-image' alt=\'".$rowFotos['fotoAlertaSismica2']."\' title=\'".$rowFotos['fotoAlertaSismica2']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoAlertaSismica2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoAlertaSismica2';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        //FOTOS DE LOS TECHOS
        $("#fotoTecho").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoTecho/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoTecho"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoTecho').$rowFotos['fotoTecho']."\' class='file-preview-image' alt=\'".$rowFotos['fotoTecho']."\' title=\'".$rowFotos['fotoTecho']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoTecho").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoTecho';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoTecho1").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoTecho1/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoTecho1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoTecho1').$rowFotos['fotoTecho1']."\' class='file-preview-image' alt=\'".$rowFotos['fotoTecho1']."\' title=\'".$rowFotos['fotoTecho1']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoTecho1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoTecho1';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoTecho2").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoTecho2/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoTecho2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoTecho2').$rowFotos['fotoTecho2']."\' class='file-preview-image' alt=\'".$rowFotos['fotoTecho2']."\' title=\'".$rowFotos['fotoTecho2']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoTecho2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoTecho2';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        // FIN FOTOS DE LOS TECHOS


        //FOTOS DE LOS MUROS
        $("#fotoMuro").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoMuro/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoMuro"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoMuro').$rowFotos['fotoMuro']."\' class='file-preview-image' alt=\'".$rowFotos['fotoMuro']."\' title=\'".$rowFotos['fotoMuro']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoMuro").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoMuro';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoMuro1").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoMuro1/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoMuro1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoMuro1').$rowFotos['fotoMuro1']."\' class='file-preview-image' alt=\'".$rowFotos['fotoMuro1']."\' title=\'".$rowFotos['fotoMuro1']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoMuro1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoMuro1';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoMuro2").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoMuro2/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoMuro2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoMuro2').$rowFotos['fotoMuro2']."\' class='file-preview-image' alt=\'".$rowFotos['fotoMuro2']."\' title=\'".$rowFotos['fotoMuro2']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoMuro2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoMuro2';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        // FIN FOTOS DE LOS MUROS
        //FOTOS DE LOS PISOS
        $("#fotoPiso").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPiso/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoPiso"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoPiso').$rowFotos['fotoPiso']."\' class='file-preview-image' alt=\'".$rowFotos['fotoPiso']."\' title=\'".$rowFotos['fotoPiso']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPiso").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPiso';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoPiso1").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPiso1/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoPiso1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoPiso1').$rowFotos['fotoPiso1']."\' class='file-preview-image' alt=\'".$rowFotos['fotoPiso1']."\' title=\'".$rowFotos['fotoPiso1']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPiso1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPiso1';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoPiso2").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPiso2/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoPiso2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoPiso2').$rowFotos['fotoPiso2']."\' class='file-preview-image' alt=\'".$rowFotos['fotoPiso2']."\' title=\'".$rowFotos['fotoPiso2']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPiso2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPiso2';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
// FIN FOTOS DE LOS PISOS

        //FOTOS DE Iluminacion
        $("#fotoIluminacion").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoIluminacion/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoIluminacion"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoIluminacion').$rowFotos['fotoIluminacion']."\' class='file-preview-image' alt=\'".$rowFotos['fotoIluminacion']."\' title=\'".$rowFotos['fotoIluminacion']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoIluminacion").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoIluminacion';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoIluminacion1").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoIluminacion1/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoIluminacion1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoIluminacion1').$rowFotos['fotoIluminacion1']."\' class='file-preview-image' alt=\'".$rowFotos['fotoIluminacion1']."\' title=\'".$rowFotos['fotoIluminacion1']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoIluminacion1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoIluminacion1';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        $("#fotoIluminacion2").fileinput({'showUploadedThumbs': false, 'resizeImage': true, 'maxImageWidth': 300, 'maxImageHeight': 300, 'resizePreference': 'width', 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoIluminacion2/fotosDatosGenerales/<?php echo  $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
            <?php
            if($rowFotos["fotoIluminacion2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoIluminacion2').$rowFotos['fotoIluminacion2']."\' class='file-preview-image' alt=\'".$rowFotos['fotoIluminacion2']."\' title=\'".$rowFotos['fotoIluminacion2']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoIluminacion2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoIluminacion2';
                $tabla = 'fotosDatosGenerales';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
// FIN FOTOS DE ILUMINACION

        modalCentroTrabajo();
        inicioFormato();
        habilitarPersonalDiscapacidad();
    });

    $(function(){
        $("#formModal").on("submit", function(e){
            var url;
            $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/modificarDatosPorAnalista/';?>";
            e.preventDefault();

            var formData = new FormData(document.getElementById("formModal"));

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
                    swal("HECHO", "Datos modificados.", "success");
                    $("#myModalCentro").modal("hide");
                    return false;
                });

        });
    });

    $(function(){
        $("#formFormato").on("submit", function(e){
            var url;
            $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudFormatos/modificarDatosPorAnalista/';?>";
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formFormato"));

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

                    $("#myModalFormato").modal("hide");
                    swal("HECHO", "Datos modificados.", "success")
                    //$('#cargando').fadeIn(1000).html(data);


                });

        });
    });

    function modalCentroTrabajo(){

        $.ajax({
            url : "<?php echo $site_url.('CrudCentrosTrabajo/obtenerEstados')?>/",
            type: "get",
            dataType: "json",
            success: function(data)
            {
                for(var i=0; i<data.length; i++)
                {
                    $("#estado").append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']))
                }
            }
        });

        var idc = $("#idCentroTrabajo").val();
        $.ajax({
            url : "<?php echo $site_url.('CrudCentrosTrabajo/obtenerDatos')?>/" + idc,
            type: "get",
            dataType: "JSON",
            success: function(data)
            {
                $("#estado").val(data.id_Estado);
                var idEstado=data.id_Estado;
                $.ajax({
                    url : "<?php echo $site_url.('CrudCentrosTrabajo/obtenerMunicipios')?>/"+idEstado,
                    type: "get",
                    dataType: "json",
                    success: function(municipio)
                    {
                        $("#municipio").empty();
                        for(var i=0; i<municipio.length; i++)
                        {
                            $("#municipio").append(new Option(municipio[i]['nombreMunicipio'],municipio[i]['idMunicipio']))
                        }
                        $("#municipio").val(data.idMunicipio);
                        $.ajax({
                            url : "<?php echo $site_url.('CrudCentrosTrabajo/obtenerColonias')?>/"+data.idMunicipio,
                            type: "get",
                            dataType: "json",
                            success: function(colonias)
                            {
                                $("#colonia").empty();
                                for(var i=0; i<colonias.length; i++)
                                {
                                    $("#colonia").append(new Option(colonias[i]['nombreRegion'],colonias[i]['idRegiones']))
                                }
                                $("#colonia").val(data.idColonia);

                                obtenerCodigoPostal();
                            }
                        });

                    }
                });
                $("#calle").val(data.calle);
                $("#numInterior").val(data.numeroInterior);
                $("#numExterior").val(data.numeroExterior);
                $("#inmueble").val(data.idInmueble);
                $("#nombreCentro").val(data.nombre);
                $("#idDet").val(data.idDet);
                $("#nomContacto").val(data.nomContacto);
                $("#puestoContacto").val(data.puestoContacto);
                $("#telContacto").val(data.telContacto);
                $("#correoContacto").val(data.email);

                $("#correoInmueble").val(data.correoInmueble);
                $("#telefonoInmueble").val(data.telefonoInmueble);

                $("#horarioFuncionamientoInicio").val(data.horarioFuncionamientoInicio);
                $("#horarioFuncionamientoFin").val(data.horarioFuncionamientoFin);

                $("#horarioAtencionInicio").val(data.horarioAtencionInicio);
                $("#horarioAtencionFin").val(data.horarioAtencionFin);
                $("#giroInmueble").val(data.giroInmueble);

                $("#latitud").val(data.latitud);
                $("#longitud").val(data.longitud);
                $("#Metros").val(data.metros);


                if(data.aplicaHorarioAtencion==1)
                {

                    $("#aplicaHorarioAtencion").prop("checked", true);
                }

                habilitarAtencionClientes();


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function obtenerMunicipios()
    {
        $("#colonia").empty();
        $("#codigoPostal").val("");
        var idEstado=$("#estado").val();
        $.ajax({
            url : "<?php echo $site_url.('CrudCentrosTrabajo/obtenerMunicipios')?>/"+idEstado,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                $("#municipio").empty();
                for(var i=0; i<data.length; i++)
                {
                    $("#municipio").append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']))
                }
            }
        });

    }
    function obtenerColonias()
    {
        $("#codigoPostal").val("");
        var idMunicipio=$("#municipio").val();
        $.ajax({
            url : "<?php echo $site_url.('CrudCentrosTrabajo/obtenerColonias')?>/"+idMunicipio,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                $("#colonia").empty();
                for(var i=0; i<data.length; i++)
                {
                    $("#colonia").append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']))
                }
            }
        });
    }
    function obtenerCodigoPostal()
    {
        var idColonia=$("#colonia").val();
        $.ajax({
            url : "<?php echo $site_url.('CrudCentrosTrabajo/obtenerCodigoPostal')?>/"+idColonia,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                $("#codigoPostal").val(data[0]["cp"]);
            }
        });
    }

    function inicioFormato(){
        var idu = $("#idFormato").val();
        $.ajax({
            url : "<?php echo $site_url.('CrudFormatos/obtenerDatos')?>/" + idu,
            type: "get",
            dataType: "JSON",
            success: function(data)
            {

                $("#razonSocial").val(data.razonSocial);
                $("#rfc").val(data.rfc);
                $("#nombreFormato").val(data.nombre);
                $("#nombreRepresentante").val(data.nombreRepresentante);
                $("#comenRFC").val(data.comentarioRFC);
                $("#domFiscal").val(data.domicilioFiscal);


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

</script>

<script>
    function  habilitarUltimaRemodelacion()
    {

        $('#ultimaRemodelacion').prop('disabled', $('#aplicaUltimaRemodelacion').is(':checked'));
        $('#modificacionesRealizadas').prop('disabled', $('#aplicaUltimaRemodelacion').is(':checked'));
    }
    function  habilitarOtrasEntidades()
    {
        $('#otrasEntidades').prop('disabled', $('#aplicaOtrasEntidades').is(':checked'));
    }
    function  habilitarOtrasActividades()
    {
        $('#otrasActividades').prop('disabled', $('#aplicaOtrasActividades').is(':checked'));
    }
    function habilitarPersonalDiscapacidad()
    {
        var valor=$("#personalDiscapacidad").val();
        if(valor==2)
        {
            $('#visual').prop('disabled', true);
            $('#mental').prop('disabled', true);
            $('#auditiva').prop('disabled', true);
            $('#fisica').prop('disabled', true);
            $('#intelectual').prop('disabled', true);
            $('#intelectual').prop('disabled', true);
            $('#cantidadPersonalDiscapacidad').prop('disabled', true);


        }
        else
        {
            $('#visual').removeAttr('disabled');
            $('#mental').removeAttr ('disabled');
            $('#auditiva').removeAttr ('disabled');
            $('#fisica').removeAttr ('disabled');
            $('#intelectual').removeAttr ('disabled');
            $('#cantidadPersonalDiscapacidad').removeAttr ('disabled');

        }

    }


    function editarCentroTrabajo()
    {
        $("#myModalCentro").modal();
    }
    function editarFormato()
    {
        $("#myModalFormato").modal();

    }
    function habilitarAtencionClientes()
    {
        $("#horarioAtencionInicio").prop('disabled', $("#aplicaHorarioAtencion").is(":checked"));
        $("#horarioAtencionFin").prop('disabled', $('#aplicaHorarioAtencion').is(':checked'));

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