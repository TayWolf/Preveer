<?php

ini_set('error_reporting', E_ALL);

$usuario=$_REQUEST['usuario'];

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
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquerymo.min.js"></script>
    <!-- <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script> -->
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.tabledit.js"></script>

</head>
<body class="theme-red">
<div class="overlay"></div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Por favor actualice su contraseña</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="newContra" name="newContra" class="form-control" placeholder="Nueva contraseña" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="contraDos" name="contraDos" class="form-control" placeholder="Verificar contraseña" required />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" >Aceptar</button>
            </div>
        </div>

    </div>
</div>
<section >
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        REVISIÓN DE DOCUMENTOS
                    </h2>

                </div>
                <div class="body table-responsive">
                    <table class="table table-hover" >
                        <thead>
                        <tr>

                            <th>Centro de trabajo</th>
                            <th>Check List</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
                        $conexion->query("SET CHARACTER SET utf8");
                        $consulta=$conexion->query("SELECT asignaInmueble.idAsignacion, asignaInmueble.idOti, CentrosDeTrabajo.nombre as nombre, Proyectos.nombreProyecto as servicio, Subservicios.nombre as subservicio, asignaInmueble.porcentajeValor FROM AnalistaOti JOIN asignaInmueble ON AnalistaOti.idAsignacion=asignaInmueble.idAsignacion JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Subservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio JOIN Proyectos on serviciosSubservicios.idServicio=Proyectos.idProyecto WHERE AnalistaOti.idUsuario=$usuario");
                        //$datos=array();
                        $contador=0;
                        foreach ($consulta as $row)
                        {
                            $contador++;
                            $idAsignacion=$row["idAsignacion"];
                            $idOti=$row["idOti"];
                            $nombreCentro=$row["nombre"];
                            $servicio=$row["servicio"];
                            $subservicio=$row["subservicio"];
                            $porcentajeValor=$row["porcentajeValor"];

                                echo "
                                     <tr>
                                        
                                        <td><a href='#' data-toggle='modal' data-target='#myModalinformativo' onclick='getDatoCentro(\"$nombreCentro\",\"$servicio\",\"$subservicio\");'>$nombreCentro</a></td>
                                        <td>
                                            <a href='javascript:formSubmit($idOti, $idAsignacion, \"$nombreCentro\");'><i class='fa fa-calendar-check-o'></i> <label id='porcentaje$contador'>$porcentajeValor</label></a>
                                        </td>
                                    </tr>";


                        }

                        ?>
                        </tbody>
                    </table>
                    <form id="#formulario" action="viewCheckList.php" method="POST">
                        <input name="idOti" id="idOti" type="hidden">
                        <input name="idAsignacion" id="idAsignacion" type="hidden">
                        <input name="centro" id="centro" type="hidden">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="myModalinformativo" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Información del centro de trabajo </h4>
            </div>
            <div class="modal-body">
                <div class="body table-responsive">
                    <table class="table table-hover" >
                        <thead>
                        <tr>
                            <th>Centro de trabajo</th>
                            <th>Servicio</th>
                            <th>Subservicio</th>
                        </tr>
                        </thead>
                        <tbody id="infCentr">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getDatoCentro(centroTrabajo, servicio, subservicio)
    {

        $("#infCentr").html("");

        $("#infCentr").append('<tr><td>'+centroTrabajo+'</td><td>'+servicio+'</td><td>'+subservicio+'</td></tr>');


    }

    function formSubmit(idOti, idAsignacion, nombreCentro)
    {
        $("#idOti").val(idOti);
        $("#idAsignacion").val(idAsignacion);
        $("#centro").val(nombreCentro);
        document.forms[0].submit();
    }

</script>

<script type="text/javascript">
    window.onload=function ()
    {

        var cantidad=<?php echo $contador;?>;

        for(i=1; i<=cantidad; i++)
        {
            colorear(i);
        }
    }
    function colorear(identificador)
    {


        if($("#porcentaje"+identificador).html()<25)
        {
            $("#porcentaje"+identificador).css("color", "red");
        }
        else if($("#porcentaje"+identificador).html()<50)
        {
            $("#porcentaje"+identificador).css("color", "darkorange");
        }
        else if($("#porcentaje"+identificador).html()<75)
        {
            $("#porcentaje"+identificador).css("color", "gold");
        }
        else if($("#porcentaje"+identificador).html()<100)
        {
            $("#porcentaje"+identificador).css("color", "green");
        }

    }
</script>


<!-- Bootstrap Core Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<!-- <script src="<?=base_url('assets/plugins/bootstrap-select/js/bootstrap-select.js')?>"></script> -->

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
<script src="https://cointic.com.mx/preveer/sistema/assets/js/mfb.js.js"></script>
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
