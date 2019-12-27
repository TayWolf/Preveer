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

<!--FORMULARIO--->
<?php
    $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
    $conexion->query("SET CHARACTER SET utf8");
    $datoExtintor=$conexion->query("SELECT * FROM DatoExtintor WHERE idAsignacion=$idAsignacion");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    var array = {
        'datosExtintores': []
    };
    var arregloJson;

    function AgregarArrayAntecedente()
    {
        var tipoFuego=$("#tipoFuego").val();
        var textoFuego;
        if($("#tipoFuego").val()!=5)
            textoFuego=$("#tipoFuego option:selected").text();
        else
        {
            textoFuego=$("#otroTipo").val();
            tipoFuego=$("#otroTipo").val();
        }

        var capacidad=$("#capacidad").val();
        var cantidad=$("#cantidad").val();
        var idExtintores=$("#idExtintores").val();
        var tipoRecipiente=$("#tipoRecipiente").val();
        var textoRecipiente=$("#tipoRecipiente option:selected").text();
        var sistemaSupresion=$("#sistemaSupresion").val();
        var textoSistemaSupresion=$("#sistemaSupresion option:selected").text();
        var sistemaSupresionObservaciones=$("#sistemaSupresionObservaciones").val();
        if (tipoFuego!="" && capacidad!="" && cantidad!="" && tipoRecipiente!="" && sistemaSupresion != "")
        {
            var arrayTemporal = {
                'datos': []
            };
            arrayTemporal.datos.push({'tipoFuego':tipoFuego,'capacidad': capacidad,'cantidad': cantidad,'tipoRecipiente': tipoRecipiente, 'sistemaSupresion': sistemaSupresion, 'sistemaSupresionObservaciones': sistemaSupresionObservaciones, 'idAsignacion': $("#idAsignacion").val()});



            var formData=new FormData(document.getElementById("formularioTemporal"));
            formData.append('datos', JSON.stringify(arrayTemporal.datos));
            $.ajax(
                {
                    url: "<?php echo $site_url.( 'CrudAnalisisRiesgo/insertarArrayExtintor/');?>"+$("#idAsignacion").val(),
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data)
                    {
                        array.datosExtintores.push({'idExtintor': data,'tipoFuego':tipoFuego,'capacidad': capacidad,'cantidad': cantidad,'tipoRecipiente': tipoRecipiente, 'sistemaSupresion': sistemaSupresion, 'sistemaSupresionObservaciones': sistemaSupresionObservaciones, 'idAsignacion': $("#idAsignacion").val(), 'action': 0});
                        $("#listadoExtintores").append('<tr>'+
                            '<td>'+textoFuego+'</td>'+
                            '<td>'+capacidad+'</td>'+
                            '<td>'+cantidad+'</td>'+
                            '<td>'+textoRecipiente+'</td>'+
                            '<td>'+textoSistemaSupresion+'</td>'+
                            '<td>'+sistemaSupresionObservaciones+'</td>'+
                            '<td><button type="button" class="btn btn-default"  onclick="traerModalFotos('+data+')"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
                            '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                            '</tr>');
                        limpiacampos();
                        console.log(JSON.stringify(array.datosExtintores, null, 4));

                    }
                }
            );



        }
        else
        {
            swal({
                title: "Faltan datos",
                type: "warning",
                confirmButtonClass: "btn-danger",

            });
        }
    }
    function limpiacampos()
    {
        var vaciar="";
        $("#tipoFuego").val(vaciar);
        $("#tipoRecipiente").val(vaciar);
        $("#otroTipo").val(vaciar);
        $("#capacidad").val(vaciar);
        $("#cantidad").val(vaciar);
        $("#sistemaSupresion").val(vaciar);
        $("#sistemaSupresionObservaciones").val(vaciar);


    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();
        var indice =  $(this).closest('tr').index();
        if(array.datosExtintores[indice]['idExtintor'] == -1)
        {
            array.datosExtintores.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosExtintores[indice]['action']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array.datosExtintores, null, 4));

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

<form id="formularioTemporal"></form>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Extintores del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <!-- <form id="form" enctype="multipart/form-data" action="CrudAnalisisRiesgo/actualizarDatosGenerales/"> -->
                        <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                        <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">




                            <div class="panel-group full-body" id="accordion_2" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_2">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_2" aria-expanded="true" aria-controls="collapseOne_2">
                                                <i class="fa fa-fire-extinguisher"></i> Extintores
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_2">
                                        <div class="panel-body">
                                            <div class="row">

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tipo de fuego</b>
                                                            <select class="form-control" id="tipoFuego" name="tipoFuego" onChange="habilitarOtroTipo()" required>
                                                                <option value="1">ABC</option>
                                                                <option value="2">CO2</option>
                                                                <option value="3">H20</option>
                                                                <option value="4">K</option>
                                                                <option value="5">Otros tipos de extintor</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Otros tipos de extintor</b>
                                                            <input type="text" class="form-control" id="otroTipo" name="otroTipo" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Capacidad</b>
                                                            <input type="number" class="form-control" id="capacidad" name="capacidad"   required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group ">
                                                        <div class="form-line">
                                                            <b>Cantidad</b>
                                                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tipo de recipiente</b>
                                                            <select class="form-control" id="tipoRecipiente" name="tipoRecipiente" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Portatil</option>
                                                                <option value="2">Móvil</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Sistema de supresión en cocina</b>
                                                            <select class="form-control" id="sistemaSupresion" name="sistemaSupresion" required>
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
                                                            <b>Observaciones del sistema de supresión</b>
                                                            <input  type="text" class="form-control" id="sistemaSupresionObservaciones" name="sistemaSupresionObservaciones">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--<div class="col-sm-3">
                                                    <div class="form-group ">
                                                        <div class="form-line">
                                                            <b>Fecha de recarga</b>
                                                            <input type="date" class="form-control" id="fechaRecarga" name="fechaRecarga">
                                                        </div>
                                                    </div>
                                                </div>-->
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
                                                        <th>TIPO DE FUEGO</th>
                                                        <th>CAPACIDAD</th>
                                                        <th>CANTIDAD</th>
                                                        <th>TIPO DE RECIPIENTE</th>
                                                        <th>SISTEMA DE SUPRESIÓN EN COCINA</th>
                                                        <th>OBSERVACIONES DEL SISTEMA DE SUPRESIÓN</th>
                                                        <th>FOTOS</th>
                                                        <th>ELIMINAR</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="listadoExtintores">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="datoExtintor">
                            <?php
                            $dato=array('cumpleAltura'=> null, 'etiquetaCollarin' => null, 'cumpleDistribucion' => null, 'equiposRecargados' => null, 'equiposDescargados' => null, 'equipoDanado' => null, 'fechaRecarga1' => null,'fechaRecarga2' => null,'fechaRecarga3' => null,'fechaRecarga4' => null,'fechaRecarga5' => null, 'observacionesGenerales' => null);
                            foreach($datoExtintor as $datoEx)
                            {
                                $dato=$datoEx;
                            }
                            ?>
                            <div class="panel-group full-body" id="accordion_2" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_2">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_2" aria-expanded="true" aria-controls="collapseOne_2">
                                                <i class="fa fa-fire-extinguisher"></i> Verificación
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_2">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Primer fecha de recarga</b>
                                                            <input class="form-control" id="fechaRecarga1" name="fechaRecarga1" type="date" value="<?=$dato['fechaRecarga1']?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Segunda fecha de recarga</b>
                                                            <input class="form-control" id="fechaRecarga2" name="fechaRecarga2" type="date" value="<?=$dato['fechaRecarga2']?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tercer fecha de recarga</b>
                                                            <input class="form-control" id="fechaRecarga3" name="fechaRecarga3" type="date" value="<?=$dato['fechaRecarga3']?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-sm-offset-2">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cuarta fecha de recarga</b>
                                                            <input class="form-control" id="fechaRecarga4" name="fechaRecarga4" type="date" value="<?=$dato['fechaRecarga4']?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Quinta fecha de recarga</b>
                                                            <input class="form-control" id="fechaRecarga5" name="fechaRecarga5" type="date" value="<?=$dato['fechaRecarga5']?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cumplen la altura de 1.5 metros conforme a la NOM-002-STPS-2010</b>
                                                            <select class="form-control" id="cumpleAltura" name="cumpleAltura" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Sí</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cumple la etiqueta y collarín requisitos del proveedor conforme la NOM-154-SCFI-2005</b>
                                                            <select class="form-control" id="etiquetaCollarin" name="etiquetaCollarin" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Sí</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cumple con la distribución, tipo y distancia de ubicación de los extintores en el inmueble</b>
                                                            <select class="form-control" id="cumpleDistribucion" name="cumpleDistribucion"  required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Sí</option>
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
                                                            <b>Cuenta con todos los equipos recargados vigentes</b>
                                                            <select class="form-control" id="equiposRecargados" name="equiposRecargados" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Sí</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Se encontraron equipos descargados</b>
                                                            <select class="form-control" id="equiposDescargados" name="equiposDescargados" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Sí</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Se encontraron equipos dañados</b>
                                                            <select class="form-control" id="equipoDanado" name="equipoDanado" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Sí</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Las bitácoras de revisión de extintores coinciden en inventario con los equipos colocados</b>
                                                            <select class="form-control" id="bitacoraCoincide" name="bitacoraCoincide" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Sí</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones generales</b>
                                                            <input type="text" class="form-control" id="observacionesGenerales" name="observacionesGenerales" value="<?=$dato['observacionesGenerales']?>">
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
        </div>


<!--Colocar modal con las fotoss dedl extintor modalFotos-->
<!-- Large modal -->
<div class="modal fade bd-example-modal-lg col-xs-12 col-sm-12 col-md-12 col-lg-12"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalFotos" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fotos de extintor</h5>
            </div>
            <div class="modal-body">
                <div id="contenidoModal">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script>
    function traerModalFotos(data)
    {
        $("#contenidoModal").empty();
        $.ajax(
            {
                url: "<?php echo $site_url.('CrudAnalisisRiesgo/getFotosExtintor/');?>"+data,
                type: 'post',
                dataType: 'json',
                success: function (result)
                {

                    $("#contenidoModal").append('<div class="row"><div class="col-sm-4"><input type="file" id="fotoExtintor1" name="fotoExtintor1[]" data-min-file-count="1"></div><div class="col-sm-4"><input type="file" id="fotoExtintor2" name="fotoExtintor2[]" data-min-file-count="1"></div><div class="col-sm-4"><input type="file" id="fotoExtintor3" name="fotoExtintor3[]" data-min-file-count="1"></div></div><div class="row"><div class="col-sm-4"><input type="file" id="fotoExtintor4" name="fotoExtintor4[]" data-min-file-count="1"></div><div class="col-sm-4"><input type="file" id="fotoExtintor5" name="fotoExtintor5[]" data-min-file-count="1"></div><div class="col-sm-4"><input type="file" id="fotoExtintor6" name="fotoExtintor6[]" data-min-file-count="1"></div></div><div class="row"><div class="col-sm-4 col-sm-offset-2"><input type="file" id="fotoExtintor7" name="fotoExtintor7[]" data-min-file-count="1"></div><div class="col-sm-4"><input type="file" id="fotoExtintor8" name="fotoExtintor8[]" data-min-file-count="1"></div></div>');

                    var fotos=result[0];
                    for(key in fotos)
                    {
                        console.log(key+"/"+result[0][key]);
                        crearFileInput(key, result[0][key], data)
                    }
                    $("#modalFotos").modal();
                }
            }
        );

    }
    function crearFileInput(nombreCampo, valorCampo, data)
    {

        imagen='';
        if(valorCampo)
        {

            imagen="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/"+nombreCampo+"/"+valorCampo+"' class='file-preview-image'>";
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneralTabla/"+nombreCampo+"/FotoExtintor/"+data+"/idExtintor",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png'],
            'initialPreview' : [imagen]
        }).on('change', function (event, data, previewId, index) {

            $("#"+nombreCampo).fileinput("upload");

        }).on('fileclear', function (event) {
            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenArreglo/"+nombreCampo+"/FotoExtintor/"+data+"/idExtintor";
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
    }
</script>


<script type="text/javascript">
    function habilitarOtroTipo()
    {
        var booleano=false;
        if($("#tipoFuego").val()==5)
        {
            booleano=true;
        }
        $("#otroTipo").prop('disabled', !booleano);
        $("#otroTipo").prop('required', booleano);

    }

    function sactualizarColindancia() {
        arregloJson=JSON.stringify(array);
        arre = JSON.parse(arregloJson);

        var idAsignacion = $("#idAsignacion").val();

        formData=new FormData(document.getElementById("datoExtintor"));
        formData.append('idAsignacion', idAsignacion);
        formData.append('arreglo', arre);
        var url= "<?php echo $site_url.( 'CrudAnalisisRiesgo/actualizarExtintor/');?>";
        $.ajax({

            url : url,
            type: "post",
            data: formData,
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                swal({
                        title: "Éxito",
                        text: "Se han registrado los extintores",
                        type: "success",

                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",

                    },
                    function(){
                        window.location.reload();
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
            url : "<?php echo $site_url.('CrudAnalisisRiesgo/getArrayExtintor')?>/" + idAsignacion,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i = 0; i < data.length; i++) {
                        var idExtintor=data[i]['idExtintor'];
                        var tipoFuego= data[i]['tipoFuego'];
                        var capacidad= data[i]['capacidad'];
                        var cantidad= data[i]['cantidad'];
                        var tipoRecipiente= data[i]['tipoRecipiente'];
                        var sistemaSupresion=data[i]['sistemaSupresion'];
                        var sistemaSupresionObservaciones=data[i]['sistemaSupresionObservaciones'];
                        var textoFuego, textoRecipiente;


                        if(tipoRecipiente==1)
                        {
                            textoRecipiente="Portatil";
                        }
                        else
                            textoRecipiente="Móvil";
                        if(tipoFuego==1)
                        {
                            textoFuego="ABC";
                        }
                        else if(tipoFuego==2)
                        {
                            textoFuego="CO2";

                        }
                        else  if(tipoFuego==3)
                        {
                            textoFuego="H20";
                        }
                        else if(tipoFuego==4)
                        {
                            textoFuego="K";

                        }
                        else if(tipoFuego==5)
                        {
                            textoFuego="SAS";

                        }
                        else
                            textoFuego=tipoFuego;

                        var idAsignacion= data[i]['idAsignacion'];


                        array.datosExtintores.push({'idExtintor':idExtintor,'tipoFuego':tipoFuego,'capacidad': capacidad,'cantidad': cantidad,'tipoRecipiente': tipoRecipiente, 'sistemaSupresion': sistemaSupresion, 'sistemaSupresionObservaciones': sistemaSupresionObservaciones,'idAsignacion':idAsignacion, 'action': 0});
                        if(sistemaSupresion==1)
                        {
                            sistemaSupresion="Si";
                        }
                        else if(sistemaSupresion==2)
                        {
                            sistemaSupresion="No";
                        }
                        else
                            sistemaSupresion="N/A";
                        console.log(JSON.stringify(array.datosExtintores, null, 4));
                        $("#listadoExtintores").append('<tr>'+
                            '<td>'+textoFuego+'</td>'+
                            '<td>'+capacidad+'</td>'+
                            '<td>'+cantidad+'</td>'+
                            '<td>'+textoRecipiente+'</td>'+
                            '<td>'+sistemaSupresion+'</td>'+
                            '<td>'+sistemaSupresionObservaciones+'</td>'+
                            '<td><button type="button" class="btn btn-default" onClick="traerModalFotos('+idExtintor+')"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
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
        $("#cumpleAltura").val(<?=$dato['cumpleAltura']?>);
        $("#etiquetaCollarin").val(<?=$dato['etiquetaCollarin']?>);
        $("#cumpleDistribucion").val(<?=$dato['cumpleDistribucion']?>);
        $("#equiposRecargados").val(<?=$dato['equiposRecargados']?>);
        $("#equiposDescargados").val(<?=$dato['equiposDescargados']?>);
        $("#equipoDanado").val(<?=$dato['equipoDanado']?>);
        $("#bitacoraCoincide").val(<?=$dato['bitacoraCoincide']?>);
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