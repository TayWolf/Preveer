
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
<!--HEADER-->
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    var array = {
        'datosAntecendentes': []
    };
    var arregloJson;

    function AgregarArrayAntecedente()
    {
        var anioAnte=$("#anioAnte").val();
        var eventoAnte=$("#eventoAnte").val();
        var observaAnte=$("#observaAnte").val();
        var idColindancia=$("#idColindancia").val();
        if (anioAnte!="" && eventoAnte!="")
        {
            array.datosAntecendentes.push({'anioAnte':anioAnte,'eventoAnte': eventoAnte,'observaAnte': observaAnte,'idColindancia': idColindancia});
            $("#listadoAntecendente").append('<tr>'+
                '<td>'+anioAnte+'</td>'+
                '<td>'+eventoAnte+'</td>'+
                '<td>'+observaAnte+'</td>'+
                '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                '</tr>');
            limpiacampos();
        }
    }
    function limpiacampos()
    {
        var vaciar="";
        $("#anioAnte").val(vaciar);
        $("#eventoAnte").val(vaciar);
        $("#observaAnte").val(vaciar);
    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();
        var indice=  $(this).closest('tr').index(); //para eliminar el registro de la tabla y en el crud
        $(this).closest('tr').remove();
        array.datosAntecendentes.splice(indice, 1);
        //alert(indice)
        if(array.datosAntecendentes.length > 0)
        {
            for(i=0; i<array.datosAntecendentes.length; i++)
            {
                jQuery.each(array.datosAntecendentes[i], function(i,val)
                {
                    // alert("valor"+val+"indice"+i);
                });
            }
        }
    });
</script>

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


 
<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Colindancia, estacionamiento y antecedentes del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <?php $idAsignacion=$_REQUEST['idAsignacion'];
                        $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                        $conexion->query("SET CHARACTER SET utf8");
                        $existencia=$conexion->query("SELECT Colindancia.*,Estacionamiento.* FROM Colindancia JOIN asignaInmueble ON Colindancia.idAsignacion=asignaInmueble.idAsignacion join Estacionamiento on Estacionamiento.idAsignacion=Colindancia.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                        $contador=0;

                        foreach ($existencia as $row)
                        {

                            $contador++;
                        }
                        if($contador==0)
                        {
                            $insercion=$conexion->prepare("INSERT INTO Colindancia (fechaVisita, idAsignacion)  VALUES (?, ?)");
                            $fecha=date("Y-m-d");
                            $insercion->bindParam(1, $fecha);
                            $insercion->bindParam(2, $idAsignacion);
                            $insercion->execute();



                            $insercion=$conexion->prepare("INSERT INTO Estacionamiento(idAsignacion) VALUES (?)");
                            $insercion->bindParam(1, $idAsignacion);
                            $insercion->execute();

                            $existencia=$conexion->query("SELECT Colindancia.*,Estacionamiento.* FROM Colindancia JOIN asignaInmueble ON Colindancia.idAsignacion=asignaInmueble.idAsignacion join Estacionamiento on Estacionamiento.idAsignacion=Colindancia.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");
                        }


                        ?>
                        <!-- <form id="form" enctype="multipart/form-data" action="CrudAnalisisRiesgo/actualizarDatosGenerales/"> -->
                        <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                        <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">

                            <?php
                            $contador=0;
                            $row=array('idColindancia'=>"", 'fechaVisita'=>"",'calleNorte'=>"", 'localNorte'=>"", 'calleSur'=>"", 'localSur'=>"",
                                'calleOriente'=>"", 'localOriente'=>"", 'callePoniente'=>"",'localPoniente'=>"", 'idAsignacion'=>"", 'cajones'=>"", 'area'=>"", 'cajonesDiscapacitados'=>"",'tipo'=>"", 'obsEstacionamiento'=>"");
                            $existencia=$conexion->query("SELECT Colindancia.*,Estacionamiento.* FROM Colindancia JOIN asignaInmueble ON Colindancia.idAsignacion=asignaInmueble.idAsignacion join Estacionamiento on Estacionamiento.idAsignacion=Colindancia.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion");

                            foreach ($existencia as $row2)
                            {
                                $row=$row2;
                                $contador++;
                            }
                            ?>

                            <div class="panel panel-col-lightgray">
                                <div class="panel-heading" role="tab" id="headingOne_18">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                            <i class="material-icons">date_range</i> Visitas
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                    <div class="panel-body">
                                        <div class="row">
                                            <input type="hidden" id="idColindancia"name="idColindancia" value="<?php echo $row['idColindancia'];?>">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Fecha de Visita</b>
                                                        <input type="date" class="form-control" id="fechaVisita" name="fechaVisita" value="<?php echo $row['fechaVisita']; ?>" readonly required />
                                                    </div>
                                                </div>
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

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Calle Norte</b>
                                                        <input type="text" class="form-control" id="calleNorte" name="calleNorte" value="<?php echo $row['calleNorte']; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Local Norte</b>
                                                        <input type="text" class="form-control" id="localNorte" name="localNorte" value="<?php echo $row['localNorte']; ?>"  />
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4 col-sm-12">
                                                <b>Foto de calle norte</b>
                                                <input type="file" class="file" id="fotoCalleNorte" name="fotoCalleNorte[]" data-min-file-count="1"  />
                                            </div>
                                            <div class="col-md-offset-2 col-md-4 col-sm-12">
                                                <b>Foto de local norte</b>
                                                <input type="file" class="file" id="fotoLocalNorte" name="fotoLocalNorte[]" data-min-file-count="1"  />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Calle Sur</b>
                                                        <input type="text" class="form-control" id="calleSur" name="calleSur" value="<?php echo $row['calleSur']; ?>"  />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Local Sur</b>
                                                        <input type="text" class="form-control" id="localSur" name="localSur" value="<?php echo $row['localSur']; ?>" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4 col-sm-12">
                                                <b>Foto de calle sur</b>
                                                <input type="file" class="file" id="fotoCalleSur" name="fotoCalleSur[]" data-min-file-count="1"  />
                                            </div>
                                            <div class="col-md-offset-2 col-md-4 col-sm-12">
                                                <b>Foto de local sur</b>
                                                <input type="file" class="file" id="fotoLocalSur" name="fotoLocalSur[]" data-min-file-count="1"  />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Calle Oriente</b>
                                                        <input type="text" class="form-control" id="calleOriente" name="calleOriente" value="<?php echo $row['calleOriente']; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Local Oriente</b>
                                                        <input type="text" class="form-control" id="localOriente" name="localOriente" value="<?php echo $row['localOriente']; ?>"  />
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4 col-sm-12">
                                                <b>Foto de calle oriente</b>
                                                <input type="file" class="file" id="fotoCalleOriente" name="fotoCalleOriente[]" data-min-file-count="1"  />
                                            </div>
                                            <div class="col-md-offset-2 col-md-4 col-sm-12">
                                                <b>Foto de local oriente</b>
                                                <input type="file" class="file" id="fotoLocalOriente" name="fotoLocalOriente[]" data-min-file-count="1"  />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Calle Poniente</b>
                                                        <input type="text" class="form-control" id="callePoniente" name="callePoniente" value="<?php echo $row['callePoniente']; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <div class="form-line">
                                                            <b>Local Poniente</b>
                                                            <input type="text" class="form-control" id="localPoniente" name="localPoniente" value="<?php echo $row['localPoniente']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-offset-1 col-md-4 col-sm-12">
                                                <b>Foto de calle poniente</b>
                                                <input type="file" class="file" id="fotoCallePoniente" name="fotoCallePoniente[]" data-min-file-count="1"  />
                                            </div>
                                            <div class="col-md-offset-2 col-md-4 col-sm-12">
                                                <b>Foto de local poniente</b>
                                                <input type="file" class="file" id="fotoLocalPoniente" name="fotoLocalPoniente[]" data-min-file-count="1"  />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4 col-sm-offset-2">
                                                <div class="form-group">
                                                    <b>Identificación de riesgos externos en las colindancias</b><br>
                                                    <input class="form-control" type="checkbox" onChange="habilitarRiesgosExternos()" value="NoAplica" id="aplicaRiesgosExternos" name="aplicaRiesgosExternos" value="aplicaRiesgosExternos" onchange="habilitarUltimaRemodelacion();" onload="habilitarUltimaRemodelacion();" <?php if($row['aplicaRiesgosExternos']==1) echo 'checked';?>><label for="aplicaRiesgosExternos">No aplica</label>

                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Observaciones de los riesgos externos</b>
                                                        <input class="form-control" type="text" name="riesgosExternos" id="riesgosExternos" value="<?php echo $row['riesgosExternos'];?>">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="panel-group full-body" id="accordion_1" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-lightgray">
                                <div class="panel-heading" role="tab" id="headingOne_1">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1">
                                            <i class="material-icons">directions_car</i> Estacionamiento
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Área m²</b>
                                                        <input type="text" class="form-control" id="areaMetros" name="areaMetros" value="<?php echo $row['area']; ?>"  required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>No. total de cajones</b>
                                                        <input type="number" class="form-control" id="numberCajo" name="numberCajo" value="<?php echo $row['cajones']; ?>" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>No. total de cajones incapacitados</b>
                                                        <input type="number" class="form-control" id="numberCajoincapa" name="numberCajoincapa" value="<?php echo $row['cajonesDiscapacitados']; ?>" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Tipo</b>
                                                        <select  class="form-control" id="tipoEsta" name="tipoEsta" >
                                                            <option value="">Seleccione una opción</option>
                                                            <option value="1" <?php if($row['tipo']==1) echo "selected"?>>Plaza</option>
                                                            <option value="2" <?php if($row['tipo']==2) echo "selected"?>>Propio</option>
                                                            <option value="3" <?php if($row['tipo']==3) echo "selected"?>>Compartido</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group ">
                                                    <div class="form-line">
                                                        <b>Observaciones</b>
                                                        <textarea class="form-control" id="obsEstacionamiento" name="obsEstacionamiento"><?php echo $row['obsEstacionamiento']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <b>Foto de estacionamiento</b>
                                                <input type="file" class="file" id="fotoEstacionamiento" name="fotoEstacionamiento[]" data-min-file-count="1"  />
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <b>Foto de cajones para discapacitados</b>
                                                <input type="file" class="file" id="fotoEstaDisca" name="fotoEstaDisca[]" data-min-file-count="1"  />
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <b>Foto estacionamiento</b>
                                                <input type="file" class="file" id="fotoEstacionamientotres" name="fotoEstacionamientotres[]" data-min-file-count="1"  />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group full-body" id="accordion_2" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-lightgray">
                                <div class="panel-heading" role="tab" id="headingOne_2">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseOne_2" aria-expanded="true" aria-controls="collapseOne_2">
                                            <i class="material-icons">local_hospital</i> Antecedentes accidentales
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_2">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Año</b>
                                                        <input type="number" class="form-control" id="anioAnte" name="anioAnte"    />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Evento</b>
                                                        <input type="text" class="form-control" id="eventoAnte" name="eventoAnte"    />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group ">
                                                    <div class="form-line">
                                                        <b>Observaciones</b>
                                                        <textarea class="form-control" id="observaAnte" name="observaAnte"> </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div align="center">
                                                <input type="button"  onclick="AgregarArrayAntecedente()" value="agregar" class="btn bg-red">
                                            </div>
                                        </div>
                                        <div class="body table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>AÑO</th>
                                                    <th>EVENTO</th>
                                                    <th>OBSERVACIONES</th>
                                                    <th>ELIMINAR</th>
                                                </tr>
                                                </thead>
                                                <tbody id="listadoAntecendente">
                                                </tbody>
                                            </table>
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
                                    <input onclick="sactualizarColindancia()" type="submit" class="btn bg-red waves-effect waves-light" value="Guardar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  </form> -->
                </div>
            </div>
        </div>


<script type="text/javascript">

    function sactualizarColindancia() {
        arregloJson=JSON.stringify(array);
        arre = JSON.parse(arregloJson);

        var idAsignacion = $("#idAsignacion").val();
        var idColindancia = $("#idColindancia").val();
        //alert("id asiga"+idAsignacion+" idColindancia"+idColindancia)
        var fechaVisita = $("#fechaVisita").val();
        var calleNorte = $("#calleNorte").val();
        var localNorte = $("#localNorte").val();
        var calleSur = $("#calleSur").val();
        var localSur = $("#localSur").val();
        var calleOriente = $("#calleOriente").val();
        var localOriente = $("#localOriente").val();
        var callePoniente = $("#callePoniente").val();
        var localPoniente = $("#localPoniente").val();

        var areaMetros = $("#areaMetros").val();
        var numberCajo = $("#numberCajo").val();
        var numberCajoincapa = $("#numberCajoincapa").val();
        var tipoEsta = $("#tipoEsta").val();
        var obsEstacionamiento = $("#obsEstacionamiento").val();



        var parametros = {
            "idAsignacion":idAsignacion,
            "idColindancia":idColindancia,
            "fechaVisita":fechaVisita,
            "calleNorte":calleNorte,
            "localNorte":localNorte,
            "calleSur":calleSur,
            "localSur":localSur,
            "calleOriente":calleOriente,
            "localOriente":localOriente,
            "callePoniente":callePoniente,
            "localPoniente":localPoniente,
            "areaMetros":areaMetros,
            "numberCajo":numberCajo,
            "numberCajoincapa":numberCajoincapa,
            "tipoEsta":tipoEsta,
            "obsEstacionamiento":obsEstacionamiento,
            "arreglo" : arre
        };
        var url= "<?php echo $site_url.( 'CrudAnalisisRiesgo/actualizarColindancia/');?>";
        $.ajax({

            url : url,
            type: "POST",
            data: parametros,
            dataType: "HTML",
            success: function(data)
            {
                swal({
                        title: "Éxito",
                        text: "Se han registrado colindancia",
                        type: "success",

                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",

                    },
                    function(){
                        window.location.reload()
                    });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });

    }

    window.onload=traerArray();

    function traerArray()
    {
        var idAsignacion=$("#idAsignacion").val();
        $.ajax({
            url : "<?php echo $site_url.('CrudAnalisisRiesgo/getArray')?>/" + idAsignacion,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i = 0; i < data.length; i++) {
                        var anioAnte= data[i]['fecha'];
                        var eventoAnte= data[i]['evento'];
                        var observaAnte= data[i]['observacion'];
                        var idAsignacion= data[i]['idAsignacion'];


                        array.datosAntecendentes.push({'anioAnte':anioAnte,'eventoAnte': eventoAnte,'observaAnte': observaAnte,'idColindancia': idAsignacion});
                        $("#listadoAntecendente").append('<tr>'+
                            '<td>'+anioAnte+'</td>'+
                            '<td>'+eventoAnte+'</td>'+
                            '<td>'+observaAnte+'</td>'+
                            '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                            '</tr>');
                        limpiacampos();
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    }

    /*$(function(){
        $("#form").on("submit", function(e){
            var url;

             arregloJson=JSON.stringify(array);
             arre = JSON.parse(arregloJson);
            // if(accion==0)
            //     accion="insertarDatosGenerales/";
            // else
                accion="actualizarColindancia/";


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
                            text: "Se han registrado colindancia",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){

                            location.href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formColindancia/'+$("#idAsignacion").val();
                        });

                });

        });
    });
*/

</script>
<!--TODO: colocar estos js en el servidor-->




<script type="text/javascript">

    $(window).on('load', function()
    {


        $("#fotoLocalPoniente").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoLocalPoniente/Colindancia/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoLocalPoniente"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoLocalPoniente/').$row['fotoLocalPoniente']."\' class='file-preview-image' alt=\'".$row['fotoLocalPoniente']."\' title=\'".$row['fotoLocalPoniente']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoLocalPoniente").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoLocalPoniente';
                $tabla = 'Colindancia';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });



        $("#fotoCallePoniente").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoCallePoniente/Colindancia/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoCallePoniente"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoCallePoniente/').$row['fotoCallePoniente']."\' class='file-preview-image' alt=\'".$row['fotoCallePoniente']."\' title=\'".$row['fotoCallePoniente']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoCallePoniente").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCallePoniente';
                $tabla = 'Colindancia';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoLocalOriente").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoLocalOriente/Colindancia/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoLocalOriente"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoLocalOriente/').$row['fotoLocalOriente']."\' class='file-preview-image' alt=\'".$row['fotoLocalOriente']."\' title=\'".$row['fotoLocalOriente']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoLocalOriente").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoLocalOriente';
                $tabla = 'Colindancia';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });



        $("#fotoCalleOriente").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoCalleOriente/Colindancia/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoCalleOriente"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoCalleOriente/').$row['fotoCalleOriente']."\' class='file-preview-image' alt=\'".$row['fotoCalleOriente']."\' title=\'".$row['fotoCalleOriente']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoCalleOriente").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCalleOriente';
                $tabla = 'Colindancia';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        $("#fotoLocalSur").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoLocalSur/Colindancia/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoLocalSur"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoLocalSur/').$row['fotoLocalSur']."\' class='file-preview-image' alt=\'".$row['fotoLocalSur']."\' title=\'".$row['fotoLocalSur']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoLocalSur").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoLocalSur';
                $tabla = 'Colindancia';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });



        $("#fotoCalleSur").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoCalleSur/Colindancia/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoCalleSur"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoCalleSur/').$row['fotoCalleSur']."\' class='file-preview-image' alt=\'".$row['fotoCalleSur']."\' title=\'".$row['fotoCalleSur']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoCalleSur").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCalleSur';
                $tabla = 'Colindancia';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });



        $("#fotoLocalNorte").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoLocalNorte/Colindancia/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoLocalNorte"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoLocalNorte/').$row['fotoLocalNorte']."\' class='file-preview-image' alt=\'".$row['fotoLocalNorte']."\' title=\'".$row['fotoLocalNorte']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoLocalNorte").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoLocalNorte';
                $tabla = 'Colindancia';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });



        $("#fotoCalleNorte").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoCalleNorte/Colindancia/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoCalleNorte"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/fotoCalleNorte/').$row['fotoCalleNorte']."\' class='file-preview-image' alt=\'".$row['fotoCalleNorte']."\' title=\'".$row['fotoCalleNorte']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoCalleNorte").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCalleNorte';
                $tabla = 'Colindancia';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        $("#fotoEstacionamiento").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoEstacionamiento/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoEstacionamiento"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/').$row['fotoEstacionamiento']."\' class='file-preview-image' alt=\'".$row['fotoEstacionamiento']."\' title=\'".$row['fotoEstacionamiento']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoEstacionamiento").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoEstacionamiento';
                $tabla = 'Estacionamiento';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoEstaDisca").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoEstaDisca/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoEstaDisca"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/').$row['fotoEstaDisca']."\' class='file-preview-image' alt=\'".$row['fotoEstaDisca']."\' title=\'".$row['fotoEstaDisca']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoEstaDisca").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoEstaDisca';
                $tabla = 'Estacionamiento';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoEstacionamientotres").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoEstacionamientotres/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoEstacionamientotres"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".$base_url.('assets/img/fotoAnalisisRiesgo/').$row['fotoEstacionamientotres']."\' class='file-preview-image' alt=\'".$row['fotoEstacionamientotres']."\' title=\'".$row['fotoEstacionamientotres']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoEstacionamientotres").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoEstacionamientotres';
                $tabla = 'Estacionamiento';

                echo $base_url.("index.php/CrudAnalisisRiesgo/eliminarImagenServidor/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });
        habilitarRiesgosExternos();
    });


</script>
<script>
    function  habilitarRiesgosExternos()
    {

        $('#riesgosExternos').prop('disabled', $('#aplicaRiesgosExternos').is(':checked'));

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