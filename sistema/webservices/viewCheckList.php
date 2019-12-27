<?php

ini_set('error_reporting', E_ALL);

$usuario=$_REQUEST['usuario'];

$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");

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
            background-color: #ffff00;
        }
        .incompleto>option
        {
            background-color: white;
        }

        .noAplica
        {
            background-color: #c6efce;
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
                        LISTA DE VERIFICACIÓN DE CONTROL DE CALIDAD DEL PROGRAMA ESPECIFÍCO DE PROTECCIÓN CIVIL
                        <?php
                        $conexion->query("SET CHARACTER SET utf8");
                        $consulta=$conexion->query("SELECT DISTINCT estados.nombreEstado FROM 
                                                              Documentos, estados WHERE 
                                                              idEstado=(SELECT estados.id_estado FROM asignaInmueble
                                                              JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo 
                                                              JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia 
                                                              JOIN municipios ON regiones.municipio=municipios.idMunicipio 
                                                              JOIN estados ON municipios.estado=estados.id_Estado WHERE idAsignacion=".$_REQUEST['idAsignacion'].")
                                                              AND Documentos.idEstado=estados.id_Estado")->fetchAll(PDO::FETCH_OBJ);
                        print $consulta[0]->nombreEstado;
                        ?>
                    </h2>
                    <div align="right">Porcentaje: %<label id="porcentajeEvaluacion"></label></div>

                </div>

                <div class="body table-responsive">
                    <form method="post" action="" id="form" enctype="multipart/form-data">
                        <input type="hidden" id="idAsigna" name="idAsigna" value="<?php echo $_POST['idAsignacion'];?>">
                        <input type="hidden" id="idOti" name="idOti" value="<?php echo $_POST['idOti'];?>">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr style="background-color:#fff;
                                    ">
                                <th class="centrico">Documento</th>
                                <th class="centrico">PT</th>
                                <th class="centrico">Comentarios / Observaciones</th>
                            </tr>

                            </thead>
                            <thead>
                            <tr>
                                <th colspan="3" class="centrico">Anexos del registro de protección civil</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $contador=0;
                            $idAsignacion=$_POST['idAsignacion'];
                            $idOti=$_POST['idOti'];
                            $conexion->query("SET CHARACTER SET utf8");
                            $consulta=$conexion->query("SELECT Documentos.*, estados.nombreEstado FROM Documentos, estados WHERE 
                                                        idEstado=(SELECT estados.id_estado FROM asignaInmueble
                                                        JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo 
                                                        JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia 
                                                        JOIN municipios ON regiones.municipio=municipios.idMunicipio 
                                                        JOIN estados ON municipios.estado=estados.id_Estado WHERE idAsignacion=$idAsignacion) 
                                                        AND Documentos.idEstado=estados.id_Estado");

                            $contador=0;

                            foreach ($consulta as $row) {

                                $nombreDocumento=$row["nombreDocumento"];
                                /*if(strlen($nombreDocumento)>31)
                                {
                                    $nombreDocumento=substr($nombreDocumento, 0, 31)."...";
                                }*/
                                $idDocumentos=$row["idDocumentos"];
                                echo "
                                <tr>
                                    <td style='padding-bottom: 0px;'><input type='hidden' name='documento$contador' value='$idDocumentos'>$nombreDocumento</td>
                                    <td style='padding-bottom: 0px; text-align: center'>
                                        <select onChange='colorear($idDocumentos); hacerCuenta();' name='idident$contador' id='idident$idDocumentos'>
                                            <option value=''>Seleccione un valor</option>
                                                        ";
                                $ponderaciones=$conexion->query("SELECT * FROM ponderadorDocumento;");
                                foreach ($ponderaciones as $options)
                                {
                                    echo "<option value='".$options['idPonderador']."'>".$options['nombrePonderador']."</option>";
                                }
                                echo"
                                        </select>          
                                            <label for='idident$contador' ></label>
                                            </td>
                                            <td style='padding-bottom: 0px;'>
                                            <div class='form-group' style='margin-bottom: 0px;'>
                                                <div class='form-line'>
                                                    <input type='text' id='comet$idDocumentos' name='comet$contador' placeholder='Comentarios' class='form-control' >
                                                </div>
                                            </div>
                                            </td>                                         
                                        </tr>";
                                $contador++;
                            }

                            echo "<input type='hidden' id='tot' name='tot' value='$contador'>";
                            ?>
                            </tbody>


                        </table>
                        <div align="center">
                            <input type="submit"  class="btn bg-red waves-effect waves-light"  value="Aceptar">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>


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

            //url : "https://cointic.com.mx/CDI/Panel/index.php/Crudordencompra/agregaOrdenc/"+total;
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudOti/guardarDocto/';?>"+total+"/"+porcentajeAvanceGeneral;
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
                            text: "Se ha registrado la entrega de documentación",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){

                            location.href='https://cointic.com.mx/preveer/sistema/webservices/obtenerViewCheckList.php';
                        });

                });

        });
    });
</script>

<script type="text/javascript">
    var totalCompletos=0;
    var totalIncompletos=0;
    var totalNoAplica=0;
    var totalNoCuenta=0;



    function colorear(identificador)
    {
        $("#idident"+identificador).removeClass();
        if($("#idident"+identificador).val()==2)
        {
            $("#idident" + identificador).toggleClass("completo");
        }
        else if($("#idident"+identificador).val()==3)
        {
            $("#idident" + identificador).toggleClass("incompleto");
        }
        else if($("#idident"+identificador).val()==4)
        {
            $("#idident" + identificador).toggleClass("noCuenta");
        }
        else if($("#idident"+identificador).val()==5)
        {
            $("#idident" + identificador).toggleClass("noAplica");
        }
        //hacerCuenta();
    }

    function hacerCuenta()
    {
        totalCompletos=0;
        totalIncompletos=0;
        totalNoAplica=0;
        totalNoCuenta=0;
        for(i=0; i<<?php echo $contador;?>; i++)
        {

            switch ($('[name=idident'+i+']').val())
            {
                case "2":
                    totalCompletos++;

                    break;
                case "3":
                    totalIncompletos++;
                    break;
                case "5":
                    totalNoAplica++;
                    break;
                case "4":
                    totalNoCuenta++;
                    break;
                default:
                    totalNoCuenta++;
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
        else if(porcentajeAvanceGeneral<100)
        {
            $("#porcentajeEvaluacion").css("color", "green");
        }
        $("#porcentajeEvaluacion").html(porcentajeAvanceGeneral);


    }
</script>
<script type="text/javascript">
    window.onload=function ()
    {
        var evaluacionesExistentes=[<?php
            $eval=$conexion->query("SELECT * FROM documentoValor WHERE idAsignacion=$idAsignacion");

            foreach ($eval as $row)
                echo "{'idDocumentoValor' : ".$row['idDocumentoValor'].", 'idDocumento' : ".$row['idDocumento'].", 'idPonderador' : ".$row['idPonderador'].", 'idAsignacion' : ".$row['idAsignacion'].", 'comentario' : '".$row['comentario']."'},";
            ?>];
        console.log(evaluacionesExistentes);

        for(i=0; i<evaluacionesExistentes.length; i++)
        {

            $("#idident"+evaluacionesExistentes[i]['idDocumento']).val(evaluacionesExistentes[i]['idPonderador']);
            colorear(evaluacionesExistentes[i]['idDocumento']);
            $("#comet"+evaluacionesExistentes[i]['idDocumento']).val(evaluacionesExistentes[i]['comentario']);
        }
        hacerCuenta();
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
