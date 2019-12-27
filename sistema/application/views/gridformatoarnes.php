<?php
include "header.php";
?>



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
                                '<div class="col-md-1 col-sm-1">'+
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

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php $tipo=$this->session->userdata('tipoUser');
            if($tipo!='' && $_SESSION['idusuariobase'] != '')
            {
                if($tipo == 3){
                    echo "<a href='javascript:history.go(-1);'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } else{
                    echo "<a href='javascript:history.go(-1);'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                }
            }

            ?>
        </div>
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


</section>
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

<?php
include "footer.php";
?>
