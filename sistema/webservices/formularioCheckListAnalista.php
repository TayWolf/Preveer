<?php
$idUsuarioBase = $_REQUEST['idusuariobase'];
$tipoUser = $_REQUEST['tipoUser'];
$cambioPas = $_REQUEST['cambioPas'];
$idUsuarioBase = 9;
$tipoUser = 4;
$cambioPas = 1;

$idAsignacion=$_REQUEST['idAsignacion'];
$idOti=$_REQUEST['idOti'];
$idSubservicio=$_REQUEST['subservicio'];
$nombreNorma=$_REQUEST['nombreNorma'];
$idCentroTrabajo=$_REQUEST['idCentroTrabajo'];
$base_url="https://cointic.com.mx/preveer/sistema/";
$site_url="https://cointic.com.mx/preveer/sistema/index.php/";
$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
$conexion->query("SET CHARACTER SET utf8");

$idCentroTrabajo=$conexion->query("SELECT idCentroTrabajo FROM asignaInmueble WHERE idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC)[0]['idCentroTrabajo'];
$normaInvalida=$conexion->query("SELECT normaInvalida FROM asignaInmueble WHERE idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC)[0]['normaInvalida'];

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

    .completo
    {
        background-color: #92d050;
    }
    .completo>option
    {
        background-color: white;
    }

    .incompleto
    {
        background-color: red;
    }
    .incompleto>option
    {
        background-color: white;
    }

    .noAplica
    {
        background-color: grey;
    }
    .noAplica>option
    {
        background-color: white;
    }
    .noCuenta
    {
        background-color: #e6b8b7;
    }
    .noCuenta>option
    {
        background-color: white;
    }


</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    var porcentajeAvanceGeneral=0;
    $(function(){
        $("#form").on("submit", function(e){
            var qq = $('#form').serialize()
            //var formData = new FormData(document.getElementById("form"));
            // alert("datos"+qq);
            var url;
            var total = $("#tot").val();
            var idOti = $("#idOti").val();
            var normaHi = $("#normaHi").val();

            //url : "https://cointic.com.mx/CDI/Panel/index.php/Crudordencompra/agregaOrdenc/"+total;
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudcheklist/guardarDocto/';?>"+total+"/"+porcentajeAvanceGeneral+"/"+$("#selectInvalido").val();
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
                    console.log(res);
                    swal({
                            title: "Éxito",
                            text: "Se ha registrado lista de indicadores para la norma "+normaHi,
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){
                            location.reload();
                           // location.href='https://cointic.com.mx/preveer/sistema/index.php/Crudcheklist/verificacionControlcalidad/'+$("#idAsigna").val()+"/"+idOti;

                        });

                });

        });
    });
</script>
<script type="text/javascript">
    var normaInvalida=<?=($normaInvalida==3)?"3":"0"?>;
    window.onload=function ()
    {
        var evaluacionesExistentes=<?php
            $evaluaciones=$conexion->query("SELECT IndicadoresValor.* FROM IndicadoresValor JOIN asignaInmueble a on IndicadoresValor.idAsignacion = a.idAsignacion JOIN CentrosDeTrabajo C2 on a.idCentroTrabajo = C2.idCentroTrabajo WHERE C2.idCentroTrabajo=$idCentroTrabajo")->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($evaluaciones);?>;


        for(i=0; i<evaluacionesExistentes.length; i++)
        {
            //alert()
            $("#idident"+evaluacionesExistentes[i]['idDocumentoSTPS']).val(evaluacionesExistentes[i]['idPonderador']);
            colorear(evaluacionesExistentes[i]['idDocumentoSTPS']);
            $("#comet"+evaluacionesExistentes[i]['idDocumentoSTPS']).val(evaluacionesExistentes[i]['comentario']);
        }
        if(normaInvalida!=3)
            hacerCuenta();

    }
</script>

<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <h2>
                                Lista de indicadores para la norma <?=$nombreNorma?>
                            </h2>
                            <div align="right">Porcentaje: %<label id="porcentajeEvaluacion"></label></div>
                            <div align="center">
                                <div style="display: inline; padding: 10px">
                                    <button class="btn btn-secondary btn-lg" type="button" style=" background: #92d050;"></button>
                                    <span>Cumple</span>
                                </div>
                                <div style="display: inline; padding: 10px">
                                    <button class="btn btn-secondary btn-lg" type="button" style=" background: red;"></button>
                                    <span>No cumple</span>
                                </div>

                                <div style="display: inline; padding: 10px">
                                    <button class="btn btn-secondary btn-lg" type="button" style=" background: grey;"></button>
                                    <span>No aplica</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4 col-xs-6" align="center">
                                <b>¿Invalidar esta norma?</b>
                                    <select class="form-control" onchange="invalidar(this)" id="selectInvalido">
                                        <option value="1">
                                            Seleccione una opción
                                        </option>
                                        <option value="3" <?php if($normaInvalida==3) echo "selected";?>>
                                            Esta norma no aplica
                                        </option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="body table-responsive">
                        <form method="post" action="" id="form"   enctype="multipart/form-data">
                            <input type="hidden" id="idAsigna" name="idAsigna" value="<?=$idAsignacion?>">
                            <input type="hidden" id="idCentroTrabajo" name="idCentroTrabajo" value="<?=$idCentroTrabajo?>">
                            <input type="hidden" id="idOti" name="idOti" value="<?=$idOti?>">
                            <input type="hidden" id="idSubservicio" name="idSubservicio" value="<?=$idSubservicio?>">
                            <table class="table table-bordered table-hover">
                                <col width="500">
                                <col width="25">
                                <col width="275">
                                <thead>
                                <tr style="background-color:#fff;
                                    ">
                                    <th class="centrico">Indicador</th>
                                    <th class="centrico">Tipo de verificación</th>
                                    <th class="centrico">PT</th>
                                    <th class="centrico">Observaciones</th>
                                </tr>

                                </thead>
                                <thead>
                                <tr>
                                    <th colspan="4" class="centrico">Anexos de la norma  </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php


                                $doctosEdo=$conexion->query("SELECT DocNormas.*, Subservicios.nombre FROM DocNormas, Subservicios WHERE idSubservicio=(SELECT Subservicios.idSubservicio FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia JOIN municipios ON regiones.municipio=municipios.idMunicipio JOIN estados ON municipios.estado=estados.id_Estado WHERE idAsignacion=$idAsignacion) AND DocNormas.idNorma=Subservicios.idSubservicio and DocNormas.idNorma=$idSubservicio")->fetchAll(PDO::FETCH_ASSOC);

                                $contador=0;
                                foreach ($doctosEdo as $row) {

                                    $nombreDocumento=$row["texto"];
                                    // if(strlen($nombreDocumento)>128)
                                    // {
                                    //     $nombreDocumento=substr($nombreDocumento, 0, 128)."...";
                                    // }
                                    $idDocumentos=$row["idDocSTPS"];
                                    $tipoV = $row["tipo"];
                                    if($tipoV == 1){
                                        $tipoverificacion="Física";
                                    } elseif($tipoV == 2){
                                        $tipoverificacion="Documental";
                                    }elseif($tipoV == 3){
                                        $tipoverificacion="Entrevista";
                                    }elseif($tipoV == 4){
                                        $tipoverificacion="Registral";
                                    }elseif($tipoV == 5){
                                        $tipoverificacion="Documental y Física";
                                    }elseif($tipoV == 6){
                                        $tipoverificacion="Entrevista y Física";
                                    }elseif($tipoV == 7){
                                        $tipoverificacion="Documental, Entrevista y Física";
                                    }elseif($tipoV == 8){
                                        $tipoverificacion="Documental y Entrevista";
                                    }
                                     elseif($tipoV == 9){
                                        $tipoverificacion="Documental e Interrogatorio";
                                    }


                                    echo "
                                            <tr>
                                                <td style='padding-bottom: 0px;'><input type='hidden' name='documento$contador' value='$idDocumentos'><p>$nombreDocumento</p></td>
                                                <td style='padding-bottom: 0px;'>$tipoverificacion</td>
                                                <td style='padding-bottom: 0px; text-align: center'>
                                                    <select onChange='colorear($idDocumentos); hacerCuenta();' name='idident$contador' id='idident$idDocumentos'>
                                                        <option value=''>Seleccione un valor</option>
                                                        ";
                                    $ponderadores=$conexion->query("SELECT * FROM ponderadoresIndicadores")->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($ponderadores as $options)
                                    {
                                        echo "<option value='".$options['valorPond']."'>".$options['NombrePonde']."</option>";
                                    }
                                    echo"             </select>
                                                
                                                <label for='idident$contador' ></label>
                                                </td>
                                                <td style='padding-bottom: 0px;'>
                                                <div class='form-group' style='margin-bottom: 0px;'>
                                                    <div class='form-line'>
                                                        <input type='text' id='comet$idDocumentos' name='comet$contador' placeholder='Comentarios' class='form-control' />
                                                    </div>
                                                </div>
                                                </td>                                         
                                            </tr>";
                                    $contador++;
                                }
                               
                                echo "<input type='hidden' id='tot' name='tot' value='$contador'>";
                                echo "<input type='hidden' id='normaHi' name='normaHi' value='";echo $row['nombre']; echo "'>";
                                ?>
                                </tbody>


                            </table>
                            <div align="center">
                                <input type="submit"  class="btn bg-red waves-effect waves-light"  value="Aceptar">
                            </div>
                        </form>
                    </div>

                    <div align="center">
                        <div  id="resultadoGeneral" >
                            <div class="paginacion">
                                <!--<ul class="pagination"><?php echo $page; ?></ul>-->
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
<script>
    function invalidar(elemento)
    {
        $("select").removeClass();
        if($(elemento).val()==3)
        {
            $('select').val(3);
            $('select').toggleClass("form-control noAplica");
            porcentajeAvanceGeneral=null;

        }
        else
        {
            $('select').val("");
            porcentajeAvanceGeneral=0;
            $('select').toggleClass("form-control");
        }
        $("#porcentajeEvaluacion").html(porcentajeAvanceGeneral);

    }
</script>

<script type="text/javascript">
    var totalCompletos=0;
    var totalIncompletos=0;
    var totalNoAplica=0;
    var totalNoCuenta=0;



    function colorear(identificador)
    {
        $("#idident"+identificador).removeClass();
        if($("#idident"+identificador).val()==1)
        {
            $("#idident" + identificador).toggleClass("completo form-control");
        }
        else if($("#idident"+identificador).val()==2)
        {
            $("#idident" + identificador).toggleClass("incompleto form-control");
        }

        else if($("#idident"+identificador).val()==3)
        {
            $("#idident" + identificador).toggleClass("noAplica form-control");
        }
        else
            $("#idident" + identificador).toggleClass("form-control");
        //hacerCuenta();
    }

    function hacerCuenta()
    {
        totalCompletos=0;
        totalIncompletos=0;
        totalNoAplica=0;
        for(i=0; i<<?php echo $contador;?>; i++)
        {

            switch ($('[name=idident'+i+']').val())
            {
                case "1":
                    totalCompletos++;
                    break;
                case "2":
                    totalIncompletos++;
                    break;
                case "3":
                    totalNoAplica++;
                    break;
                default:
                    totalIncompletos++;
                    break;
            }

        }

        if(<?php echo $contador?>-totalNoAplica!=0)
            porcentajeAvanceGeneral=(totalCompletos/(<?php echo $contador;?> - totalNoAplica))*100;
        porcentajeAvanceGeneral=Math.round(porcentajeAvanceGeneral * 100) / 100;
        if(porcentajeAvanceGeneral<25)
        {
            $("#porcentajeEvaluacion").css("color", "red");
        }
        else if(porcentajeAvanceGeneral<50)
        {
            $("#porcentajeEvaluacion").css("color", "darkorange");
        }
        else if(porcentajeAvanceGeneral<75)
        {
            $("#porcentajeEvaluacion").css("color","gold");
        }
        else if(porcentajeAvanceGeneral<=100)
        {
            $("#porcentajeEvaluacion").css("color", "green");
        }
        $("#porcentajeEvaluacion").html(porcentajeAvanceGeneral);


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
