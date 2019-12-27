<?php

ini_set('error_reporting', E_ALL);

$usuario=$_REQUEST['usuario'];

//echo $usuario;



//echo json_encode($datos);

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
                        Visitas sin asignar

                    </h2>

                </div>
                <div class="body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Centro de trabajo</th>
                            <th>Visita inicial</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");

                        $consulta2=$conexion->query("SELECT asignaInmueble.idAsignacion, CentrosDeTrabajo.nombre FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion NOT IN (SELECT VisitasInmueble.idAsignacion FROM VisitasInmueble WHERE VisitasInmueble.tipoVisita=1) and AnalistaOti.idUsuario=$usuario");
                        $contador=1;
                        foreach ($consulta2 as $row)
                        {
                            $nombreCentro=$row["nombre"];
                            $idAsignacion=$row["idAsignacion"];

                            echo "
                             <tr>
                                <td>".$contador++."</td>
                                <td><a href='#' data-toggle='modal' data-target='#myModalinformativo' onclick='getDatoCentro($idAsignacion)'>$nombreCentro</a></td>
                                <td>
                                    <a data-toggle='modal' data-target='#myModalfechaini' onclick='identi($idAsignacion)'><i class='fa fa-calendar-check-o'></i></a>
                                </td>
                            </tr>";
                        }


                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myModalfechaini" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Por favor indique la fecha de visita. <p id="nombreTitul"></p></h4>
            </div>

            <div class="modal-body">
                <div align="center" class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="Tt">Próxima fecha de visita </label>
                                <input type="date" id="fechaVisit" name="fechaVisit" class="form-control" />
                                <input type="hidden" id="idIdentif" name="idIdentif">
                                <input type="hidden" id="fechaActual" name="fechaActual" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="coments">Comentario</label>
                                <input type="text" class="form-control" id="coments" name="coments" placeholder="Comentario fecha de visita" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div align="center">
                        <input type="submit"  onclick="AgendarCita()" class="btn bg-red waves-effect waves-light" value="Agendar">

                    </div>
                </div>

            </div>

            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
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
                            <th>idDet</th>
                            <th>Centro de trabajo</th>
                            <th>Calle</th>
                            <th>N.I</th>
                            <th>N.E</th>
                            <th>Col.</th>


                        </tr>
                        </thead>
                        <tbody id="infCentr">

                        </tbody>
                        <thead>
                        <tr>
                            <th>Municipio</th>
                            <th>Estado</th>
                            <th>Contacto</th>
                            <th>Puesto</th>
                            <th>Tel.</th>
                            <th>Email</th>


                        </tr>
                        </thead>
                        <tbody id="infCentrC">

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
    function getDatoCentro(idAs)
    {
        var idAs=idAs;
        $("#infCentr").html("");
        $("#infCentrC").html("");
        var parametro={"idAs":idAs}
        $.ajax({
            url : "getNombreCentro.php",
            type: "POST",
            data: parametro,
            dataType: "JSON",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i=0; i<data.length; i++)
                    {
                        //alert(data[i]['nombreEstado'])
                        $("#infCentr").append('<tr><td>'+data[i]['idDet']+'</td><td>'+data[i]['nombreCentro']+'</td><td>'+data[i]['calle']+'</td><td>'+data[i]['numeroInterior']+'</td><td>'+data[i]['numeroExterior']+'</td><td>'+data[i]['nombreRegion']+'</td></tr>');

                        $("#infCentrC").append('<tr><td>'+data[i]['nombreMunicipio']+'</td><td>'+data[i]['nombreEstado']+'</td><td>'+data[i]['nomContacto']+'</td><td>'+data[i]['puestoContacto']+'</td><td>'+data[i]['telContacto']+'</td><td>'+data[i]['email']+'</td><</tr>');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    }

    function  identi(id)
    {
        var id=id;
        //$("#listadoVis").html("");
        $("#idIdentif").val(id);

    }

    function AgendarCita()
    {
        var fechaVisita=$("#fechaVisit").val();
        var idIdentif=$("#idIdentif").val();
        var comentario = $("#coments").val();
        var parametro={"fechaVisita":fechaVisita,"idIdentif":idIdentif,"coments":comentario}
        var url;
        //alert(fechaVisita+comentario+idIdentif)
        if (fechaVisita!="") {
            $.ajax({
                url : "insertaFechasvisita.php",
                type: "POST",
                data: parametro,
                dataType: "HTML",
                success: function(data)
                {

                    swal({
                            title: "AGENDADO",
                            text: "Visita agendada",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){
                            location.reload();
                        });
                    // $('#myModalfechaini').modal('hide');
                }
            });
        }else{
            swal("AVISO", "Selecciones una fecha", "error")
        }
    }
</script>

<!-- /Boton flotante -->


<!-- Jquery Core Js -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery/jquery.min.js"></script>

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
