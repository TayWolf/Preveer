<?php
$idUsuarioBase = $_REQUEST['idusuariobase'];
$tipoUser = $_REQUEST['tipoUser'];
$cambioPas = $_REQUEST['cambioPas'];
$idUsuarioBase = 9;
$tipoUser = 4;
$cambioPas = 1;
$idAsignacion=$_REQUEST['idAsignacion'];
$ti=$_REQUEST['ti'];
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
<script type="text/javascript">
    var ponderadores=[];
    var datos;
    var contador=0;
    function getDatos()
    {
        var idAsignacion=$("#idAsignacion").val();
        var idTip=$("#idTip").val();
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/getDatosAc/"+idAsignacion+"/"+idTip,
                type: 'POST',
                dataType: 'JSON',
                success: function(data)
                {
                    console.table(data);
                    console.table(datos);
                    //alert(contador)
                    if (data.length>0)
                    {
                        for(i=0; i<data.length;i++)
                        {

                            $("#ponderadoresSSshi"+data[i]["idIndicador"]).val(data[i]["idPonderador"]);

                            visualCampo(data[i]["idIndicador"])
                            $("#stVal"+data[i]["idIndicador"]).val(data[i]["st"]);
                            $("#observaS"+data[i]["idIndicador"]).val(data[i]["observaciones"]);
                        }
                    }
                }
            });
    }

    function pintadoDatos()
    {
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/getPonderSshi/",
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            var arre = [data[i]['idPonderador'], data[i]['nombrePonderador']];
                            ponderadores.push(arre);
                            console.table(arre);
                        }
                    }

                }, complete: function () {
                    var tipoF = $("#idTip").val();
                    $.ajax(
                        {
                            url: "https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/getGrup/" + tipoF,
                            type: 'POST',
                            dataType: 'JSON',
                            success: function (data) {
                                if (data.length > 0) {
                                    for (i = 0; i < data.length; i++) {
                                        if (data[i]['formato'] == 1) {
                                            var titu = "FORMATO DE REVISIÓN DE ARNÉS";
                                        }
                                        if (data[i]['formato'] == 2) {
                                            var titu = "FORMATO DE REVISIÓN DE ANDAMIOS";
                                        }
                                        $("#contenidoAcordion").append('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">' +
                                            '<div class="panel-group full-body" id="accordion_' + data[i]['idGrupo'] + '" role="tablist" aria-multiselectable="true">' +
                                            '<div class="panel panel-col-lightgray">' +
                                            '<div class="panel-heading" role="tab" id="headingOne_' + data[i]['idGrupo'] + '">' +
                                            '<h4 class="panel-title">' +
                                            '<a role="button" data-toggle="collapse" href="#collapseOne_' + data[i]['idGrupo'] + '" aria-expanded="true" aria-controls="collapseOne_' + data[i]['idGrupo'] + '">' +
                                            '<i class="material-icons">assignment</i>' + data[i]['nombreGrupo'] + '' +
                                            '</a>' +
                                            '</h4>' +
                                            '</div>' +
                                            '<div id="collapseOne_' + data[i]['idGrupo'] + '" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_' + data[i]['idGrupo'] + '">' +
                                            '<div id="conteniIndica' + data[i]['idGrupo'] + '" class="panel-body">' +

                                            '</div>' +
                                            '</div>' +
                                            '</div>' +
                                            '</div>' +
                                            '</div>');
                                        contenidoIn(data[i]['idGrupo']);
                                        //console.log("CREADO");
                                        //$("#entregableCheck"+data[i]['idEntregable']).prop('checked', true);
                                    }
                                    $("#tituloPrincipal").append(titu);
                                }
                            },
                            complete: function () {
                                getDatos();
                            }
                        });
                }
            });
    }
    function contenidoIn(idGrupo)
    {
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/getIndicadores/"+idGrupo,
                type: 'POST',
                dataType: 'JSON',
                success: function(data)
                {
                    datos=data;
                    if (data.length>0)
                    {
                        for(i=0; i<data.length;i++)
                        {
                            //Colocar name="nombreInputContador" id="nombreInputIdIndicador"

                            $("#conteniIndica"+idGrupo).append('<div class="col-md-6 col-sm-6 ">'+
                                '<input type="hidden" id="idIni'+data[i]['idIndicador']+'" name="idIni'+contador+'" value="'+data[i]['idIndicador']+'">'+
                                data[i]['nombreIndicador']+
                                '</div>'+
                                '<div class="col-md-2 col-sm-2">'+
                                '<div class="form-group">'+
                                '<div class="form-line">'+
                                '<select class="form-control" onchange="visualCampo('+data[i]['idIndicador']+')" name="ponderadoresSSshi'+contador+'" id="ponderadoresSSshi'+data[i]['idIndicador']+'">'+

                                '</select>'+
                                '</div>'+
                                '</div>'+
                                '</div>'+
                                '<div id="Contenid'+data[i]['idIndicador']+'"></div>'
                            );
                            contenidoPonde(data[i]['idIndicador'])
                            contador++;
                            for(j=0; j<ponderadores.length; j++)
                                $("#ponderadoresSSshi"+data[i]["idIndicador"]).append(new Option(ponderadores[j][1], ponderadores[j][0]));
                        }

                    }

                }
            });

    }

    function contenidoPonde(idIndicador){

        var tipoF=$("#idTip").val();
        if (tipoF==1)
        {
            $("#Contenid"+idIndicador).append('<div id="campoOculto'+idIndicador+'" style="display:none;">'+
                '<div class="col-sm-1">'+
                '<div class="form-group">'+
                '<div class="form-line">'+
                //'<label for="comentdocs">ST*</label>'+
                '<input type="text" class="form-control" id="stVal'+idIndicador+'" name="stVal'+contador+'" placeholder="Valor ST*" >'+
                '</div>'+
                '</div>'+
                '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                '<div class="form-group">'+
                '<div class="form-line">'+
                //'<b>Observaciones </b>'+
                '<textarea class="form-control" id="observaS'+idIndicador+'" name="observaS'+contador+'" placeholder="Observaciones"></textarea>'+
                '</div>'+
                '</div>'+
                '</div>');
        }
        if (tipoF==2)
        {

            $("#Contenid"+idIndicador).append('');
        }


    }
    function visualCampo(idIndicador)
    {
        var pond=$("#ponderadoresSSshi"+idIndicador).val();
        if (pond==3)
        {
            $("#campoOculto"+idIndicador).show();
        }else{
            $("#campoOculto"+idIndicador).hide();
        }
    }
</script>


<div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 id="tituloPrincipal"></h2>
                    </div>
                    <div class="body">
                        <form id="form">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <input type="hidden" name="idTip" id="idTip" value="<?php echo $ti;?>">
                            <div class="row">
                                <div id="contenidoAcordion">
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



<script>
    
</script>

<script>
    $("#form").submit(function (e)
    {
        e.preventDefault();
        //alert("estas seguro que quieres mandar "+contador)

swal({
  title: "Bien hecho",
  text: "Formato registrado" +contador,
  type: "success",
  //showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Aceptar",
  closeOnConfirm: false
},
function(){
    location.reload();
 // swal("Deleted!", "Your imaginary file has been deleted.", "success");
});
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/guardarFormato/"+contador,
                data: $("#form").serialize(),
                type: 'post',
                success: function (data)
                {
                    //
                }
            }
        );
    });

</script>
<script type="text/javascript">
    $( document ).ready(function() {
        pintadoDatos();

     });
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
