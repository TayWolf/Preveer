<?php
$idUsuarioBase = $_REQUEST['idusuariobase'];
$tipoUser = $_REQUEST['tipoUser'];
$cambioPas = $_REQUEST['cambioPas'];
$idUsuarioBase = 9;
$idAsignacion=$_REQUEST['idAsignacion'];
$idFormulario=$_REQUEST['idControl'];
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
<!--Header-->

<?php
$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
$conexion->query("SET CHARACTER SET utf8");

$idCentroTrabajo=$conexion->query("SELECT idCentroTrabajo FROM asignaInmueble WHERE idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);

$idCentroTrabajo=$idCentroTrabajo[0]['idCentroTrabajo'];

$arregloFormularioAsignacion=$conexion->query("SELECT idFormularioAsignacion FROM FormularioAsignacion WHERE idAsignacion=$idAsignacion AND idFormulario=$idFormulario")->fetchAll(PDO::FETCH_ASSOC);
if(empty($arregloFormularioAsignacion))
{


    $conexion->query("INSERT INTO FormularioAsignacion (idFormulario, idAsignacion) VALUES ('$idFormulario', '$idAsignacion')");


    $arregloFormularioAsignacion=$conexion->query("SELECT idFormularioAsignacion FROM FormularioAsignacion WHERE idAsignacion=$idAsignacion AND idFormulario=$idFormulario")->fetchAll(PDO::FETCH_ASSOC);

}

$idFormularioAsignacion=$arregloFormularioAsignacion[0]['idFormularioAsignacion'];

$idReporteAsignacion=$arregloFormularioAsignacion;

$tablas=$conexion->query("SELECT FormularioAlmacenamientoAcordeon.*, FormularioTablaAcordeon.idAcordeon, FormularioTablaAcordeon.idFormularioAsignacion FROM FormularioAlmacenamientoAcordeon JOIN FormularioTablaAcordeon ON FormularioTablaAcordeon.idFormularioTablaAcordeon= FormularioAlmacenamientoAcordeon.idFormularioTablaAcordeon JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador=FormularioAlmacenamientoAcordeon.idIndicador AND AcordeonIndicador.idAcordeon=FormularioTablaAcordeon.idAcordeon WHERE idFormularioAsignacion=$idFormularioAsignacion ORDER BY idAcordeon, idFormularioTablaAcordeon, AcordeonIndicador.posicion")->fetchAll(PDO::FETCH_ASSOC);

$fotos=$conexion->query("SELECT * FROM FormularioFotos WHERE idFormularioAsignacion=$idFormularioAsignacion")->fetchAll(PDO::FETCH_ASSOC);
$nombreFormulario=$conexion->query("SELECT nombreFormulario FROM Aut WHERE idControl=$idFormulario")->fetchAll(PDO::FETCH_ASSOC);
$acordeones=$conexion->query("SELECT Acordeon.* FROM Acordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$idFormulario ORDER BY FormularioAcordeon.posicion")->fetchAll(PDO::FETCH_ASSOC);
$indicadores=$conexion->query("SELECT formIndicador.*, Acordeon.idAcordeon FROM formIndicador JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador=formIndicador.idIndicador JOIN Acordeon on Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$idFormulario ORDER BY AcordeonIndicador.posicion")->fetchAll(PDO::FETCH_ASSOC);

$nombreFormulario=$conexion->query("SELECT nombreFormulario FROM Aut WHERE idControl=$idFormulario")->fetchAll(PDO::FETCH_ASSOC);
$nombreFormulario=$nombreFormulario[0]['nombreFormulario'];

//echo $data['nombreFormulario']."==Datos Generales||$idFormulario==12";
if($nombreFormulario=="Datos Generales"||$idFormulario==12)
{
    $inmueble=$conexion->query("SELECT * FROM inmuebles")->fetchAll(PDO::FETCH_ASSOC);
    $formato=$conexion->query("SELECT * FROM Formato")->fetchAll(PDO::FETCH_ASSOC);

}


?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-right: 0px !important;">
        <div class="card" style="margin-bottom: 0px !important;">
            <div class="header">
                <h2><?php foreach ($nombreFormulario as $key ) {
                        echo $key['nombreFormulario'];
                    } ?>
                </h2>
            </div>
            <div class="body">
                <?php
                //Si es el formulario de datos generales, imprime los datos del centro de trabajo
                if($tituloFormulario=="Datos Generales"||$idFormulario==12)
                {

                    ?>
                    <!--INICIO DEL ACORDEON DE DATOS DEL CENTRO DE TRABAJO-->
                    <form id="formDatosCentro">
                        <input type="hidden" name="idCentroTrabajo" id="idCentroTrabajo" value="<?php echo $idCentroTrabajo;?>">
                        <div class="panel-group full-body" id="accordion_DatosCentro" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-lightgray">
                                <div class="panel-heading" role="tab" id="headingOne_DatosCentro">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_DatosCentro" aria-expanded="true" aria-controls="collapseOne_DatosCentro">
                                            <i class="material-icons">assignment</i> Datos del centro de trabajo
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_DatosCentro" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_DatosCentro">
                                    <div class="panel-body">
                                        <div class="row">


                                            <div class="col-sm-4">
                                                <label for="Formato">Cliente</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" id="idFormato" name="idFormato" style="width: 100%; border: none;color:#000;" required>
                                                            <option value="0">Seleccione cliente</option>
                                                            <?php
                                                            foreach ($formato as $row) {
                                                                $idFormat=$row["idFormato"];
                                                                $nombreFormat=$row["nombre"];

                                                                echo "<option value='$idFormat'>$nombreFormat</option>";
                                                            }
                                                            ?>

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" style="display: none;">
                                                <label for="Tipo de inmueble">Tipo de inmueble</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" id="inmueble" name="inmueble" style="width: 100%; border: none;color:#000;" required>
                                                            <option value="0">Seleccione inmueble</option>
                                                            <?php
                                                            foreach ($inmueble as $row) {
                                                                $idIn=$row["idInmueble"];
                                                                $nombreIn=$row["nombreInmueble"];

                                                                echo "<option value='$idIn'>$nombreIn</option>";
                                                            }
                                                            ?>

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="razonSocial">Razón social</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="email_address">Nombre de centro de trabajo</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="nombreCentro" name="nombreCentro" placeholder="Nombre"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" style="display: none;">
                                                <label for="email_address">IdDet</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="idDet" name="idDet" placeholder="IdDet"/>
                                                    </div>
                                                </div>
                                            </div>
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
                                            <div class="col-sm-3">
                                                <label for="calle">Calle</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="numExterior">Número Exterior</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" class="form-control" id="numExterior" name="numExterior" placeholder="Número Exterior"/>
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
                                                        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Código Postal" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="email_address">Nombre de contacto</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="nomContacto" name="nomContacto" placeholder="Nombre de contacto"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="email_address">Puesto de contacto</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="puestoContacto" name="puestoContacto" placeholder="Puesto de contacto"/>
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
                                            <div class="col-sm-4">
                                                <label for="email_address">Teléfono del inmueble</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="tel" class="form-control" id="telefonoInmueble" name="telefonoInmueble" placeholder="Teléfono del inmueble" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="email_address">Correo del inmueble</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="correoInmueble" name="correoInmueble" placeholder="Correo del inmueble" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="giroInmueble">Giro completo</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="giroInmueble" name="giroInmueble" placeholder="Giro del inmueble" />
                                                    </div>
                                                </div>
                                            </div>
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
                                                    <input type="checkbox" value="NoAplica" class="form-control" id="aplicaHorarioAtencion"  onChange="habilitarAtencionClientes();" name="aplicaHorarioAtencion" placeholder="Horario" ><label for="aplicaHorarioAtencion"> No Aplica</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="email_address">Inicio de atención a clientes</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="time" class="form-control" id="horarioAtencionInicio" name="horarioAtencionInicio" placeholder="Horario"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="email_address">Fin de atención a clientes</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="time" class="form-control" id="horarioAtencionFin" name="horarioAtencionFin" placeholder="Horario" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="latitud">Latitud</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud (Coordenadas)"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="longitud">Longitud</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud (Coordenadas)"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="longitud">Metros</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="Metros" name="Metros" placeholder="Metros (Coordenadas)"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" align="center">
                                                <div class="form-line">
                                                    <input type="button" id="obtener" class="btn bg-black waves-effect waves-light"value="Obtener mi ubicación">
                                                </div>
                                            </div>
                                            <div class="col-sm-4 col-sm-offset-4" align="center">
                                                <label for="atendioVisita">Nombre de quien atendió la visita</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="atendioVisita" name="atendioVisita" placeholder="Nombre de la persona quien atendió la visita"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4 col-sm-offset-4" align="center">
                                                    <input type="submit" class="btn bg-red">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                foreach ($acordeones as $acordeon)
                {
                    if($acordeon['tablaRegistro']==1)
                    {
                        echo "<form id='formTabla".$acordeon['idAcordeon']."' name='formTabla".$acordeon['idAcordeon']."'></form>";
                    }
                }
                ?>
                <form id="form" name="form">
                    <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                    <input type="hidden" name="idFormulario" id="idFormulario" value="<?php echo $idFormulario;?>">
                </form>
                <?php
                $recorridoTabla=0;
                $contadorIndicador=0;
                $contadorIndicadorParaAcordeon=0;
                $arregloFileInput=array();
                foreach ($acordeones as $acordeon)
                {
                    ?>
                    <div class="panel-group full-body" id="accordion_<?=$acordeon['idAcordeon']?>" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-col-lightgray">
                            <div class="panel-heading" role="tab" id="headingOne_<?=$acordeon['idAcordeon']?>">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapseOne_<?=$acordeon['idAcordeon']?>" aria-expanded="true" aria-controls="collapseOne_<?=$acordeon['idAcordeon']?>">
                                        <i class="material-icons">assignment</i> <?=$acordeon['nombreAcordeon']?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne_<?=$acordeon['idAcordeon']?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_<?=$acordeon['idAcordeon']?>">
                                <div class="panel-body">
                                    <div class="row">
                                        <!--Inicio Contenido del acordeon-->
                                        <?php
                                        if($acordeon['tablaRegistro']==2)
                                            foreach ($indicadores as $indicador)
                                            {

                                                $nombreIn=$indicador['nombreIndicador'];
                                                $tipoIndicador=$indicador['tipoIndicador'];
                                                $idIndicador=$indicador['idIndicador'];
                                                $idAcordeon=$indicador['idAcordeon'];
                                                if($idAcordeon==$acordeon['idAcordeon'])
                                                {
                                                    $formularioAlQuePertenece='form="form"';
                                                    $finCamp="";
                                                    switch ($tipoIndicador) {
                                                        case 1:
                                                            $camp = " <select class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece required>";
                                                            $finCamp = "</select>";
                                                            break;
                                                        case 2:
                                                        case 7:
                                                            $camp = " <input type='text' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece>";
                                                            break;
                                                        case 3:
                                                            $camp = " <input type='number' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece>";
                                                            break;
                                                        case 4:
                                                            $camp = " <input type='checkbox' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece value='1'><label for=\"idIndic$idIndicador\">$nombreIn</label>";
                                                            break;
                                                        case 5:
                                                            $camp = " <input type='date' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece>";
                                                            break;
                                                        case 6:
                                                            array_push($arregloFileInput, array($idIndicador, $idAcordeon));
                                                            $camp = "<input type='file' class='$idIndicador-$idAcordeon' name='$idIndicador-" . $idAcordeon . "[]' data-min-file-count='1' $formularioAlQuePertenece>";
                                                            break;
                                                    }
                                                    switch ($tipoIndicador)
                                                    {
                                                        case 4:
                                                            echo " 
                                                                        <div class='col-sm-6'>
                                                                                <div class='form-group'>
                                                                                    <input type='hidden' name='idIndicador$contadorIndicador' value='$idIndicador' $formularioAlQuePertenece>
                                                                                    <input type='hidden' name='idAcordeonPerteneciente$contadorIndicador' value='$idAcordeon' $formularioAlQuePertenece>
                                                                                    <b>$nombreIn</b><br><br>
                                                                                   $camp $finCamp
                                                                                   </div>
                                                                        </div>";
                                                            break;
                                                        default:
                                                            echo " 
                                                                        <div class='col-sm-6'>
                                                                            <div class='form-group'>
                                                                                <div class='form-line'>
                                                                                    <input type='hidden' name='idIndicador$contadorIndicador' value='$idIndicador' $formularioAlQuePertenece>
                                                                                    <input type='hidden' name='idAcordeonPerteneciente$contadorIndicador' value='$idAcordeon' $formularioAlQuePertenece>
                                                                                    <b>$nombreIn</b>
                                                                                   $camp $finCamp
                                                                                </div>
                                                                            </div>
                                                                        </div>";
                                                    }


                                                    $contadorIndicador++;
                                                }
                                            }
                                        if($acordeon['tablaRegistro']==1)
                                        {
                                            foreach ($indicadores as $indicador)
                                            {
                                                $nombreIn=$indicador['nombreIndicador'];
                                                $tipoIndicador=$indicador['tipoIndicador'];
                                                $idIndicador=$indicador['idIndicador'];
                                                $idAcordeon=$indicador['idAcordeon'];

                                                if($idAcordeon==$acordeon['idAcordeon'])
                                                {
                                                    $formularioAlQuePertenece='form="formTabla'.$acordeon['idAcordeon'].'"';
                                                    $finCamp="";
                                                    switch ($tipoIndicador) {
                                                        case 1:
                                                            $camp = " <select class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece required>";
                                                            $finCamp = "</select>";
                                                            break;
                                                        case 2:
                                                        case 7:
                                                            $camp = " <input type='text' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece>";
                                                            break;
                                                        case 3:
                                                            $camp = " <input type='number' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece>";
                                                            break;
                                                        case 4:
                                                            $camp = " <input type='checkbox' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece>";
                                                            break;
                                                        case 5:
                                                            $camp = " <input type='date' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece>";
                                                            break;
                                                        case 6:
                                                            array_push($arregloFileInput, array($idIndicador, $idAcordeon));
                                                            $camp = " <input type='file' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon" . $contadorIndicadorParaAcordeon . "[]' data-min-file-count='1' $formularioAlQuePertenece>";
                                                            break;
                                                    }

                                                    echo " 
                                                            <div class='col-sm-6'>
                                                                <div class='form-group'>
                                                                    <div class='form-line'>
                                                                    <input type='hidden' name='idAcordeonIndicador$contadorIndicadorParaAcordeon' value='$idIndicador' $formularioAlQuePertenece>
                                                                        <b>$nombreIn</b>
                                                                       $camp $finCamp
                                                                    </div>
                                                                </div>
                                                            </div>";

                                                    $contadorIndicadorParaAcordeon++;

                                                }
                                            }

                                            ?>
                                            <div class="col-xs-12">
                                                <div class="col-xs-offset-4 col-xs-4" align="center">
                                                    <input type="submit" class="btn bg-red" form="formTabla<?=$acordeon['idAcordeon']?>">
                                                    <script>
                                                        $("#formTabla<?=$acordeon['idAcordeon']?>").on('submit', function (e) {
                                                            e.preventDefault();

                                                            formdata=new FormData(document.getElementById("formTabla<?=$acordeon['idAcordeon']?>"));
                                                            $.ajax({
                                                                url: '<?=$site_url.('CrudVisitaAnalisis/subirFilaTabla/'.$acordeon['idAcordeon']."/".$contadorIndicadorParaAcordeon."/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>',
                                                                contentType: false,
                                                                data: formdata,
                                                                processData: false,
                                                                type: 'POST',
                                                                dataType: 'html',
                                                                success: function(data)
                                                                {
                                                                    var fila="<tr id='fila"+data+"'>";
                                                                    <?php

                                                                    foreach ($indicadores as $indicador)
                                                                    {
                                                                        $idIndicador=$indicador['idIndicador'];
                                                                        $idAcordeon=$indicador['idAcordeon'];
                                                                        if($idAcordeon==$acordeon['idAcordeon'])
                                                                        {
                                                                            echo "fila+=\"<td>\"+$('.$idIndicador-$idAcordeon').val()+\"</td>\";\n";
                                                                        }
                                                                    }
                                                                    $contadorIndicadorParaAcordeon=0;
                                                                    ?>
                                                                    <?php
                                                                    $salida='<td><button onClick=\"mostrarFotos(\''.$acordeon['nombreAcordeon'].'\',"+data+",'.$acordeon['cantidadFotos'].')\" type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td>';
                                                                    ?>
                                                                    fila+="<?php if($acordeon['cantidadFotos']) echo $salida;?><td><button id=\"eliminar"+data+"\" onClick='borrarFila("+data+")' type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>";
                                                                    $("#tableBody<?=$acordeon['idAcordeon']?>").append(fila);

                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-10 table table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <?php
                                                            $arregloIndicadoresEncabezado=array();
                                                            $contadorTh=0;
                                                            foreach ($indicadores as $indicador)
                                                            {
                                                                $idAcordeon=$indicador['idAcordeon'];
                                                                if($idAcordeon==$acordeon['idAcordeon'])
                                                                {
                                                                    $nombreIn = $indicador['nombreIndicador'];
                                                                    echo "<th>$nombreIn</th>";
                                                                    $arregloIndicadoresEncabezado[$contadorTh] = $indicador['idIndicador'];
                                                                    $contadorTh++;
                                                                    $contadorIndicador++;
                                                                }
                                                            }
                                                            if($acordeon['cantidadFotos'])
                                                            {
                                                                echo "<th>Fotos</th>";
                                                            }
                                                            ?>

                                                            <th>Eliminar</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tableBody<?=$acordeon['idAcordeon']?>">
                                                        <?php

                                                        $iteradorTabla=0;
                                                        //SI SE NECESITA DOCUMENTACION, VER EL ARCHIVO: gridBitacoraAdministrable
                                                        $numeroRegistros=sizeof($tablas);
                                                        while($iteradorTabla<sizeof($tablas))
                                                        {
                                                            if($tablas[$iteradorTabla]['idAcordeon']==$acordeon['idAcordeon'])
                                                            {
                                                                $i=$iteradorTabla;
                                                                $fila=array();
                                                                $ultimoAlmacenamiento=$tablas[$i]['idFormularioTablaAcordeon'];
                                                                $j=0;
                                                                while($ultimoAlmacenamiento==$tablas[$i]['idFormularioTablaAcordeon'])
                                                                {
                                                                    $fila[$j++] = $tablas[$i];
                                                                    $ultimoAlmacenamiento = $tablas[$i++]['idFormularioTablaAcordeon'];
                                                                    if ($i >= $numeroRegistros)
                                                                        break;
                                                                }

                                                                echo "<tr>";

                                                                //obtiene la diferencia entre los registros de la tabla y sus encabezados
                                                                $diferencia = sizeof($arregloIndicadoresEncabezado) - sizeof($fila);
                                                                for ($k = 0; $k < sizeof($fila); $k++)
                                                                {
                                                                    //por cada uno de los encabezados
                                                                    for($l=$k; $l < sizeof($arregloIndicadoresEncabezado); $l++ )
                                                                    {
                                                                        //si el encabezado coincide con el dato de la fila
                                                                        if ($fila[$k]['idIndicador'] == $arregloIndicadoresEncabezado[$l])
                                                                        {
                                                                            echo "<td>" . $fila[$k]['valor'] . "</td>";
                                                                            $k++;
                                                                            if($k>=sizeof($fila))
                                                                                break;
                                                                        }
                                                                        else
                                                                        {
                                                                            $diferencia--;
                                                                            echo "<td></td>";
                                                                        }
                                                                    }
                                                                    while($diferencia>0)
                                                                    {
                                                                        echo "<td></td>";
                                                                        $diferencia--;
                                                                    }
                                                                    if($acordeon['cantidadFotos'])
                                                                        echo "<td><button id='fotos".$ultimoAlmacenamiento."' onClick=\"mostrarFotos('".$acordeon['nombreAcordeon']."',".$ultimoAlmacenamiento.",".$acordeon['cantidadFotos'].")\" type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td>";
                                                                    echo "<td><button id='eliminar".$ultimoAlmacenamiento."' onClick='borrarFila(".$ultimoAlmacenamiento.")' type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>";

                                                                }
                                                                $iteradorTabla=$i;
                                                            }
                                                            else
                                                                $iteradorTabla++;
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <!--Fin Contenido del acordeon-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-xs-offset-4 col-xs-4" align="center">
                        <input type="submit" class="btn bg-red" form="form">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalFotos" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="tituloModalFotos"></h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" id="contenidoModalFotos">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function mostrarFotos(titulo, idFilaTabla, cantidadFotos)
        {
            $("#contenidoModalFotos").empty();
            $("#tituloModalFotos").text("Fotos sobre "+titulo);
            for(i=0; i<cantidadFotos; i++)
                $("#contenidoModalFotos").append("<div class=\"col-md-6\">\n" +
                    "                            <input type=\"file\" id=\"fotoModal"+i+"\" name=\"fotoModal"+i+"[]\" data-min-file-count=\"1\"/>\n" +
                    "                        </div>");
            $.ajax(
                {
                    url: '<?=$site_url.('CrudVisitaAnalisis/obtenerFotosFila/')?>'+idFilaTabla,
                    contentType: false,
                    processData:false,
                    dataType: 'JSON',
                    success: function (data)
                    {

                        arrayAgregados=[];
                        for(j=0; j<cantidadFotos; j++)
                        {
                            for(i=0; i<data.length;i++)
                            {
                                if(data[i].numeroFotoTabla==j)
                                {
                                    crearFileInputModal(idFilaTabla, j, data[i].foto);
                                    arrayAgregados.push(j);
                                }

                            }
                        }
                        var yaFueAgregado=false;
                        for (i=0; i<cantidadFotos; i++)
                        {
                            for(j=0; j<arrayAgregados.length; j++)
                            {
                                if(arrayAgregados[j]==i)
                                {
                                    yaFueAgregado=true;
                                }
                            }
                            if(!yaFueAgregado)
                                crearFileInputModal(idFilaTabla, i, "");
                            yaFueAgregado=false;
                        }
                    },
                    complete: function ()
                    {
                        $("#modalFotos").modal();
                    }
                }
            );

        }
    </script>

    <script>
        arregloFileInput=<?=json_encode($arregloFileInput)?>;
        arregloFotos=<?=json_encode($fotos)?>;

        $(document).ready(function ()
        {
            if($("#idCentroTrabajo").val())
                cargarDatosCentroTrabajo();
            $.ajax(
                {
                    url: '<?=$site_url.('CrudVisitaAnalisis/getPonderadores/')?>'+$("#idFormulario").val(),
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',
                    success: function (data)
                    {
                        console.table(data);
                        for(i=0; i<data.length; i++)
                        {
                            $("."+data[i].idIndicador+"-"+data[i].idAcordeon).append("<option value='"+data[i].nombrePonderador+"'>"+data[i].nombrePonderador+"</option>");
                        }
                    },
                    complete: function ()
                    {
                        $.ajax(
                            {
                                url: '<?=$site_url.('CrudVisitaAnalisis/obtenerDatosGuardados/').$idReporteAsignacion[0]['idFormularioAsignacion']?>',
                                contentType: false,
                                processData: false,
                                dataType: 'JSON',
                                success: function (data)
                                {
                                    console.table(data);
                                    for(i=0; i<data.length; i++)
                                    {
                                        if(data[i].valor)
                                        {
                                            $("."+data[i].idIndicador+"-"+data[i].idAcordeon).val(data[i].valor);
                                            $("."+data[i].idIndicador+"-"+data[i].idAcordeon).prop("checked", true);
                                        }

                                    }
                                }
                            }
                        );
                    }
                }
            );
            for(i=0; i<arregloFileInput.length;i++)
            {

                crearFileInput(arregloFileInput[i][0],arregloFileInput[i][1]);
            }

        });
        function crearFileInput(idIndicador, idAcordeon)
        {
            foto="";


            for(j=0; j<arregloFotos.length; j++)
            {
                if(arregloFotos[j]['idIndicador']==idIndicador&&arregloFotos[j]['idAcordeon']==idAcordeon)
                {
                    foto="<img class='file-preview-image' src='<?=$base_url.("assets/img/fotoAnalisisRiesgo/".$idReporteAsignacion[0]['idFormularioAsignacion']."/")?>"+arregloFotos[j]['foto']+"'/>";
                    console.log(foto);
                }
            }
            $("."+idIndicador+"-"+idAcordeon).fileinput(
                {
                    'showUploadedThumbs': false,
                    'showCaption': false,
                    'showCancel': false,
                    'showRemove':false,
                    'showUpload':false,
                    'uploadAsync': false,
                    'uploadUrl': '<?=$site_url.("CrudVisitaAnalisis/subirFoto/".$idFormulario."/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>'+"/"+idIndicador+"/"+idAcordeon,
                    'language': 'es',
                    'maxFileCount': 1,
                    'allowedFileExtensions' : ['jpg', 'gif', 'png'],
                    'initialPreview' : [foto]
                }).on('change', function (event, data, previewId, index) {
                $("."+idIndicador+"-"+idAcordeon).fileinput("upload");
            }).on('fileclear', function (event)
            {
                $.ajax(
                    {
                        url: '<?=$site_url.("CrudVisitaAnalisis/borrarFoto/$idFormulario/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>/'+idIndicador+"/"+idAcordeon,
                        contentType: false,
                        processData: false
                    }
                );
            });
        }
        function crearFileInputModal(idFila, numeroFoto, valor)
        {
            foto="";
            if(valor)
                foto="<img class='file-preview-image' src='<?=$base_url.("assets/img/fotoAnalisisRiesgo/".$idReporteAsignacion[0]['idFormularioAsignacion']."/")?>"+valor+"'/>";

            $("#fotoModal"+numeroFoto).fileinput(
                {
                    'showUploadedThumbs': false,
                    'showCaption': false,
                    'showCancel': false,
                    'showRemove':false,
                    'showUpload':false,
                    'uploadAsync': false,
                    'uploadUrl': '<?=$site_url.("CrudVisitaAnalisis/subirFotoFila/".$idFormulario."/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>'+"/"+idFila+"/"+numeroFoto,
                    'language': 'es',
                    'maxFileCount': 1,
                    'allowedFileExtensions' : ['jpg', 'gif', 'png'],
                    'initialPreview' : [foto]
                }).on('change', function (event, data, previewId, index) {
                $("#fotoModal"+numeroFoto).fileinput("upload");
            }).on('fileclear', function (event)
            {
                $.ajax(
                    {
                        url: '<?=$site_url.("CrudVisitaAnalisis/borrarFotoModal/$idFormulario/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>/'+idFila+"/"+numeroFoto,
                        contentType: false,
                        processData: false
                    }
                );
            });
        }

        $("#form").on('submit',function (e)
        {
            var formData=new FormData(document.getElementById("form"));
            e.preventDefault();
            $.ajax(
                {
                    url: '<?=$site_url.("CrudVisitaAnalisis/subirAnalisisRiesgo/".$idReporteAsignacion[0]['idFormularioAsignacion']."/".$contadorIndicador)?>',
                    processData: false,
                    contentType: false,
                    data: formData,
                    type: 'POST',
                    dataType: 'html',
                    success: function(data)
                    {
                        swal('Bien!', 'El analisis de riesgo ha sido guardado!', 'success');
                    }
                }
            );
        });
        function borrarFila(idFila)
        {
            swal({
                title: '¡Precaución!',
                text: '¿Está seguro de eliminar este registro?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: "Si, quiero eliminarlo"
            }, function (isConfirm)
            {
                if(isConfirm)
                {


                    $.ajax(
                        {
                            url: '<?=$site_url.("CrudVisitaAnalisis/eliminarFilaTabla/")?>'+idFila,
                            contentType: false,
                            complete: function ()
                            {
                                var btnEliminar=$("#eliminar"+idFila);
                                $(btnEliminar).closest('tr').hide();
                            }
                        }
                    );


                }
            });
        }    $("#formDatosCentro").on("submit", function(e){
            var url;
            $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/modificarDatos/';?>";
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formDatosCentro"));

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


                });

            $.ajax({
                url: '<?=$site_url.('CrudCentrosTrabajo/cambiarNombreAtendioVisita/'.$idAsignacion)?>',
                type: "post",
                data: {nombre: $("#atendioVisita").val()},
            });


        });
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
        function habilitarAtencionClientes()
        {
            $("#horarioAtencionInicio").prop('disabled', $("#aplicaHorarioAtencion").is(":checked"));
            $("#horarioAtencionFin").prop('disabled', $('#aplicaHorarioAtencion').is(':checked'));

        }

        function iniciarMap()
        {

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
        function cargarDatosCentroTrabajo(){


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
                },complete:function(){
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
                            $("#idFormato").val(data.idFormato);
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
                            $("#razonSocial").val(data.razonSocial);



                            if(data.aplicaHorarioAtencion==1)
                            {
                                $("#aplicaHorarioAtencion").prop("checked", true);
                            }
                            var ruta="";

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });
                }
            });
            $.ajax({
                url: '<?=$site_url.('CrudCentrosTrabajo/getNombreAtendioVisita/'.$idAsignacion)?>',
                dataType: 'JSON',
                success: function(data)
                {
                    $("#atendioVisita").val(data.nombreAtendioVisita);
                }
            })


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
    <!--<script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/piexif.min.js')?>"></script>-->
    <script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/sortable.min.js')?>"></script>
    <script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/purify.min.js')?>"></script>
    <script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/fileinput.min.js')?>"></script>
    <script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/es.js')?>"></script>





</body>

</html>
