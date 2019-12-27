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
<?php
foreach ($datosCentroTrabajo as $rew) {
    $idCentroTrabajo=$rew["idCentroTrabajo"];
    $correoInmueble=$rew["correoInmueble"];
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    var hayCambios=0;
    function setCambios(value)
    {
        hayCambios=value;
        if(typeof Android !== "undefined")
        {
            if(value==1)
                Android.setCambios(true);
            else
                Android.setCambios(false);

        }
    }
    function confirmarSalida()
    {
        if(hayCambios==1)
        {
            if(confirm("¿Guardar los cambios antes de salir?"))
            {
                $("#form").submit();
            }
            else
            {
                setCambios(0);
                window.history.back();
            }

        }
        else
        {
            window.history.back();
        }

    }
    window.onunload=function(){
        if(hayCambios==1)
        {
            return "¿Guardar los cambios antes de salir?";
        }

    };
    window.onbeforeunload = function(){
        if(hayCambios==1)
        {
            return "¿Guardar los cambios antes de salir?";
        }

    };
    var porcentajeAvanceGeneral=0;
    $(function(){
        $("#form").on("submit", function(e){
            var qq = $('#form').serialize();
            var url;
            var total = $("#tot").val();
            var idOti = $("#idOti").val();

            //url : "https://cointic.com.mx/CDI/Panel/index.php/Crudordencompra/agregaOrdenc/"+total;
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudOti/guardarDocto/';?>"+total+"/"+porcentajeAvanceGeneral;
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("form"));
            swal({
                title: "Estas a punto de subir la documentación",
                text: "¿Continuar?",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                //showLoaderOnConfirm: true
            }, function () {

                $.ajax({
                    url: url,
                    type: "post",
                    dataType: "html",
                    async: false,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res){
                    //console.log(res);
                    setCambios(0);
                    if(typeof lastname !== "undefined"){
                        Android.setCambios(false);
                    }

                    location.href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/verificacionControlcalidad/'+$("#idAsigna").val()+"/"+idOti;
                    // swal({
                    //       title: "Éxito",
                    //       text: "Se ha registrado la entrega de documentación",
                    //       type: "success",
                    //       showCancelButton: true,
                    //       closeOnConfirm: false,
                    //       showLoaderOnConfirm: true
                    //     }, function () {
                    //       setTimeout(function () {
                    //          swal("Éxito");
                    //         location.href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/verificacionControlcalidad/'+$("#idAsigna").val()+"/"+idOti;
                    //       }, 2000);
                    //     });

                 
                });
            });


        });
    });


</script>
<script type="text/javascript">
    window.onload=function ()
    {

        var evaluacionesExistentes=<?php echo json_encode($evaluaciones);?>;
        console.log(evaluacionesExistentes);

        for(i=0; i<evaluacionesExistentes.length; i++)
        {

            $("#idident"+evaluacionesExistentes[i]['idDocumento']).val(evaluacionesExistentes[i]['idPonderador']);
            colorear(evaluacionesExistentes[i]['idDocumento']);
            $("#comet"+evaluacionesExistentes[i]['idDocumento']).val(evaluacionesExistentes[i]['comentario']);
            $("#fechaCptura"+evaluacionesExistentes[i]['idDocumento']).val(evaluacionesExistentes[i]['fechaCaptura']);
        }
        hacerCuenta();
        pintarIconos()
        setCambios(0);
    }
    function pintarIconos()
    {
        $.ajax({
            url : "<?php echo site_url('CrudOti/pintarIcon/'.$idAsignacion)?>" ,
            type: "post",
            dataType: "JSON",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i=0; i< data.length; i++) {
                        //alert("#icono"+i+"-"+data[i]['idDocumento'])
                        $("#icono"+data[i]['idDocumento']).append('<div class="demo-google-material-icon" align="center"><a href="https://cointic.com.mx/preveer/sistema/assets/doctosPcCheck/'+data[i]['nombreDocto']+'" download="'+data[i]['nombreDocto']+'" title="Descargar documento"><i class="material-icons">cloud_download</i> <span class="icon-name"></span></div>');
                        $("#nombreDcotoTemporal"+data[i]['idDocumento']).val(data[i]['nombreDocto']);
                    }

                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
</script>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href='#' onClick="confirmarSalida()">
                <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                    <i class='material-icons'>arrow_back</i>
                </button>
            </a>

        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Lista de verificación de control de calidad del programa especifíco de protección civil
                            <?php
                            foreach ($doctosEdo as $row)
                            {
                                echo $row['nombreEstado'];
                                break;
                            }?> del Centro de trabajo
                            <?php
                            foreach ($datosCentroTrabajo as $row)
                            {
                                echo $row['nombre'];
                                break;
                            }?>

                        </h2>
                        <div class="container">
                            <div align="right">Porcentaje: %<label id="porcentajeEvaluacion"></label></div>
                        </div>
                        <div class="row clearfix">
                            <div style="display: flex; padding: 10px" class="col-sm-6 col-md-2 col-md-offset-1">
                                <button class="btn btn-secondary btn-lg" type="button" style=" background: #92d050;"></button>
                                <span>Documento completo</span>
                            </div>
                            <div style="display: flex; padding: 10px" class="col-sm-6 col-md-3">
                                <button class="btn btn-secondary btn-lg" type="button" style=" background: #ffff00;"></button>
                                <span>Documento incompleto</span>
                            </div>
                            <div style="display: flex; padding: 10px" class="col-sm-6 col-md-3">
                                <button class="btn btn-secondary btn-lg" type="button" style=" background: #e6b8b7;"></button>
                                <span>Documento no valido/no cuenta</span>
                            </div>
                            <div style="display: flex; padding: 10px" class="col-sm-6 col-md-3">
                                <button class="btn btn-secondary btn-lg" type="button" style=" background: #c6efce;"></button>
                                <span>No aplica</span>
                            </div>
                        </div>
                    </div>
                    <div class="body table-responsive">
                        <form method="post" action="" id="form"   enctype="multipart/form-data">
                            <input type="hidden" id="idAsigna" name="idAsigna" value="<?=$idAsignacion?>">
                            <input type="hidden" id="idOti" name="idOti" value="<?=$idOti?>">
                            <table class="table table-bordered table-hover">
                                <col width="15">
                                <col width="500">
                                <col width="25">
                                <col width="25">
                                <col width="25">
                                <thead>
                                <tr style="background-color:#fff;
                                    ">
                                    <th class="centrico">Descargar</th>
                                    <th class="centrico">Indicador</th>
                                    <th class="centrico">PT</th>
                                    <th class="centrico">Fecha</th>
                                    <th class="centrico">Documento</th>
                                    <th class="centrico">Comentarios / Observaciones</th>
                                </tr>

                                </thead>
                                <thead>
                                <tr>
                                    <th colspan="6" class="centrico">Anexos del registro de protección civil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador=0;

                                foreach ($doctosEdo as $row) {

                                    $nombreDocumento=$row["nombreDocumento"];
                                    if(strlen($nombreDocumento)>128)
                                    {
                                        $nombreDocumento=substr($nombreDocumento, 0, 128)."...";
                                    }
                                    $idDocumentos=$row["idDocumentos"];

                                    echo "
                                            <tr>
                                            <td id='icono$idDocumentos' style='padding-bottom: 0px;'></td><td style='padding-bottom: 0px;'><input type='hidden' name='documento$contador' value='$idDocumentos'>$nombreDocumento</td>
                                                <td style='padding-bottom: 0px; text-align: center'>
                                                    <select onChange='colorear($idDocumentos); hacerCuenta(); setCambios(1);' name='idident$contador' id='idident$idDocumentos'>
                                                        <option value=''>Seleccione un valor</option>
                                                        ";
                                    foreach ($ponderadores as $options)
                                    {
                                        echo "<option value='".$options['idPonderador']."'>".$options['nombrePonderador']."</option>";
                                    }
                                    echo"             </select>
                                                
                                                <label for='idident$contador' ></label>
                                                </td>
                                                <td style='padding-bottom: 0px;'><input class='form-control' type='date' id='fechaCptura$idDocumentos' name='fechaCptura$contador' onChange='setCambios(1);'></td>
                                                <td style='padding-bottom: 0px;'><input type='file' name='archivoAdjunto$contador' id='archivoAdjunto$idDocumentos' onChange='setCambios(1);'></td>
                                                <td style='padding-bottom: 0px;'>
                                                <div class='form-group' style='margin-bottom: 0px;'>
                                                    <div class='form-line'>
                                                        <input type='text' id='comet$idDocumentos' name='comet$contador' placeholder='Comentarios' class='form-control' onChange='setCambios(1);' >
                                                    </div>
                                                </div>
                                                </td>                                         
                                            </tr>
                                            <input type='hidden' id='nombreDcotoTemporal$idDocumentos' name='nombreDcotoTemporal$contador'>";
                                    $contador++;
                                }

                                echo "<input type='hidden' id='tot' name='tot' value='$contador'>";
                                ?>
                                </tbody>


                            </table>
                            <div align="center">
                                <input type="submit"  class="btn bg-red waves-effect waves-light"  value="Guardar">
                                <?php
                                if($hayDatosGuardados)
                                {
                                    ?>
                                    <input onclick="popUpImprimir(<?= $idAsignacion ?>);" type="button"
                                           class="btn bg-red waves-effect waves-light" value="Imprimir"
                                           id="btn-imprimir" hidden>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#correoModal" id="btn-enviar" hidden>Enviar correo</button>
                                    <a class="btn btn-primary" href="<?=site_url('CrudOti/descargarArchivos/'.$idAsignacion)?>">Descargar archivos</a>
                                    <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="correoModal" tabindex="-1" role="dialog" aria-labelledby="correoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="correoModalLabel">Enviar correo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="correo-acuse">Correo electrónico</label>
                                    <input type="email" class="form-control" id="correo-acuse" name="correo-acuse" value="<?=$correoInmueble?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="enviarCorreoPDF(<?=$idAsignacion?>,<?=$idCentroTrabajo?>)">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</section>

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

    function  popUpImprimir(id)
    {
        window.open("https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/checkList/"+id,"neo","width=900,height=600,menubar=si");
    }

    function enviarCorreoPDF(idAsignacion, idCentroTrabajo)
    {
        var correoAcuse = document.getElementById("correo-acuse").value;
        swal({
                title: "Aviso",
                text: "¿Desea enviar el correo electrónico?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function(){
                $.ajax({
                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/enviarPDFCheck/"+idAsignacion+"/"+idCentroTrabajo,
                    type: "POST",
                    data: {correoAcuse: correoAcuse},
                    dataType: "HTML",
                    success: function(data)
                    {
                        swal("Hecho", "Correo enviado con éxito", "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Error", "Ocurio un error inesperado", "warning");
                    }
                });
            });
    }
</script>
