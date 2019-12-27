<?php
include "header.php";
?>
<style>
    .fotoSeleccionada{
        background-color: #d50f11;
        padding: 8px;
    }
</style>
<script>
    //para que el coordinador de PC seleccione las fotos que iran en el formulario
    var arregloFotos;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<section class="content">
    <div class="container-fluid">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h4>Generador de plantillas</h4>
                        </div>
                        <div class="body">
                            <form id="formularioPlantilla">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Cliente</b>
                                                <select class="form-control" id="idCliente" onchange="cargarEstados(); cargarFormatos(); cargarCentrosTrabajo();" name="idCliente" required>
                                                    <option value="">Seleccione un cliente</option>
                                                    <?php
                                                    foreach ($clientes as $cliente)
                                                    {
                                                        print "<option value='".$cliente['idCliente']."'>".$cliente['nombreCliente']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Estado</b>
                                                <select class="form-control" id="idEstado" onchange="cargarCentrosTrabajo();" name="idEstado" required>
                                                    <option value="">Seleccione un estado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Formato</b>
                                                <select class="form-control" id="idFormato" onchange="cargarCentrosTrabajo()" name="idFormato">
                                                    <option value="">Seleccione un formato</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Centro de trabajo</b>
                                                <select class="form-control" id="idCentroTrabajo" onchange="cargarPlantillas()" name="idCentroTrabajo" required>
                                                    <option value="">Seleccione un centro de trabajo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Plantilla</b>
                                                <select class="form-control" id="idPlantilla" name="idPlantilla" required>
                                                    <option value="">Seleccione una plantilla</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" align="center">
                                        <input type="submit" class="btn bg-red" value="Generar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>



<!--modal de pasos-->




<form class="modal multi-step" id="modalFotos">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="modalFotosEncabezados">

            </div>


            <div class="modal-footer" id="modalFotosFooter">

            </div>
        </div>
    </div>
</form>

<!--fin del modal de pasos-->





<script>
    function cargarEstados() {
        $("#idEstado").empty();
        var idClienteSeleccionado=$("#idCliente").val();
        $.ajax({
            url: '<?=site_url('CrudGeneradorPlantillas/cargarEstadosCliente/')?>'+idClienteSeleccionado,
            dataType: 'JSON',
            success: function (estados)
            {
                $("#idEstado").append("<option value='' selected>Seleccione un estado</option>");
                for(i=0; i<estados.length; i++)
                {
                    $("#idEstado").append("<option value='"+estados[i]['id_Estado']+"'>"+estados[i]['nombreEstado']+"</option>");

                }
            }
        });
    }
    function cargarFormatos()
    {
        $("#idFormato").empty();
        var idClienteSeleccionado=$("#idCliente").val();
        $.ajax({
            url: '<?=site_url('CrudGeneradorPlantillas/cargarFormatosCliente/')?>'+idClienteSeleccionado,
            dataType: 'JSON',
            success: function (formatos)
            {
                $("#idFormato").append("<option value='' selected>Seleccione un formato</option>");
                for(i=0; i<formatos.length; i++)
                {
                    $("#idFormato").append("<option value='"+formatos[i]['idFormato']+"'>"+formatos[i]['nombre']+"</option>");

                }
            }
        });
    }
    var ajaxCentrosTrabajo;
    function cargarCentrosTrabajo() {
        $("#idCentroTrabajo").empty();
        //aborta la petición anterior para evitar información equivocada
        if(ajaxCentrosTrabajo)
        {
            ajaxCentrosTrabajo.abort();
        }
        var cliente=($("#idCliente").val())?$("#idCliente").val():0;
        var formato=($("#idFormato").val())?$("#idFormato").val():0;
        var estado=($("#idEstado").val())?$("#idEstado").val():0;

        ajaxCentrosTrabajo=$.ajax({
            url: '<?=site_url('CrudGeneradorPlantillas/cargarCentrosTrabajo/')?>'+cliente+"/"+estado+"/"+formato,
            dataType: 'JSON',
            success: function (centros)
            {
                $("#idCentroTrabajo").append("<option value='' selected>Seleccione un centro de trabajo</option>");
                for(i=0; i<centros.length; i++)
                {
                    //se le coloca el idAsignacion para saber de que formulario saldrá la información a generar
                    $("#idCentroTrabajo").append("<option value='"+centros[i]['idAsignacion']+"'>"+centros[i]['nombre']+"</option>");

                }
            }
        });

    }

    function cargarPlantillas()
    {
        $("#idPlantilla").empty();
        var estado=($("#idEstado").val())?$("#idEstado").val():0;
        var cliente=($("#idCliente").val())?$("#idCliente").val():0;
        var formato=($("#idFormato").val())?$("#idFormato").val():0;
        var centro=($("#idCentroTrabajo").val())?$("#idCentroTrabajo").val():0;

        $.ajax({
            url: '<?=site_url('CrudGeneradorPlantillas/cargarPlantillas/')?>'+estado+"/"+centro+"/"+formato+"/"+cliente,
            dataType: 'JSON',
            success: function (plantillas)
            {
                $("#idPlantilla").append("<option value='' selected>Seleccione una plantilla</option>");
                for(i=0; i<plantillas.length; i++)
                {
                    $("#idPlantilla").append("<option value='"+plantillas[i]['idPlantilla']+"'>"+plantillas[i]['nombrePlantilla']+"</option>");
                }
            }
        });

    }
    $("#formularioPlantilla").submit(function (e)
    {

       e.preventDefault();
       /*
            verifica si la plantilla tiene fotos
        */
        $.ajax({
            url: '<?=site_url('CrudGeneradorPlantillas/getInfoPlantilla/')?>'+$("#idPlantilla").val(),
            dataType: 'JSON',
            success: function (informacionPlantilla)
            {
                arregloFotos=[];
                if(informacionPlantilla[0]['tieneFoto']==1)
                {

                    $("#modalFotosEncabezados").empty();
                    $("#modalFotosFooter").empty();
                    $(".modal-body").remove();
                    //abre el modal de selección de las fotos
                    var etiquetasFotos=informacionPlantilla[1];
                    var html="";

                    for(i=0; i<etiquetasFotos.length; i++)
                    {
                        arregloFotos[(i+1)]={ancho: "7",alto: "5", nombreEtiqueta:"", nombreFoto: ""};
                        //genera los encabezados
                        $("#modalFotosEncabezados").append("<h4 class=\"modal-title step-"+(i+1)+"\" data-step=\""+(i+1)+"\">Seleccione una foto para la etiqueta: "+etiquetasFotos[i]['nombreEtiqueta']+"</h4>");
                        //genera los pasos
                        html+= " " +
                            "<div class=\"modal-body step-"+(i+1)+"\" data-step=\""+(i+1)+"\">" +
                                "<div class='row col-sm-12'>" +
                                    "<div class='col-sm-6'>" +
                                        "<b>Formulario</b>" +
                                        "<input type='hidden' id='etiqueta"+(i+1)+"' name='etiqueta"+(i+1)+"' value='"+etiquetasFotos[i]['idControl']+"'>" +
                                        "<input type='hidden' id='nombreEtiqueta"+(i+1)+"' name='nombreEtiqueta"+(i+1)+"' value='"+etiquetasFotos[i]['nombreEtiqueta']+"'>" +
                                        "<select class='form-control' id='selectFormulario"+(i+1)+"' name='selectFormulario"+(i+1)+"' onChange='cargarFotosFormulario("+(i+1)+")'>" +
                                            "<option value=''>Seleccione un formulario</option> <?php foreach ($formularios as $formulario) print "<option value='".$formulario['idControl']."'>".$formulario['nombreFormulario']."</option> ";?>" +
                                        "</select>" +
                                    "</div>"+
                                "</div>" +
                                "<div class='row'>" +
                                    "<div class='col-sm-12' id='contenidoModalFotos"+(i+1)+"'>" +
                                    "</div>" +
                                    "<div class='row col-sm-offset-3 col-sm-6'>" +
                                        "<div class='col-sm-6'>" +
                                            "<b>Ancho (cm)</b><input class='form-control' onInput='establecerAncho("+(i+1)+")' type='number' id='anchoContenidoModalFotos"+(i+1)+"'>" +
                                        "</div>" +
                                        "<div class='col-sm-6'>" +
                                            "<b>Alto (cm)</b><input class='form-control' onInput='establecerAlto("+(i+1)+")' type='number' id='altoContenidoModalFotos"+(i+1)+"'>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>"+
                            "</div>";
                        //genera los botones del footer del modal


                        if(i==(etiquetasFotos.length-1))
                        {
                            $("#modalFotosFooter").append("<button type=\"button\" class=\"btn btn-primary step step-"+(i+1)+"\" data-step=\""+(i+1)+"\" onclick=\"sendEvent('#modalFotos', "+(i)+")\">Anterior</button>");
                            $("#modalFotosFooter").append("<button type=\"button\" class=\"btn btn-primary step step-"+(i+1)+"\" data-step=\""+(i+1)+"\" onclick=\"generarPlantilla()\">Generar plantilla</button>");
                        }
                        else if(i==0)
                        {
                            $("#modalFotosFooter").append("<button type=\"button\" class=\"btn btn-primary step step-"+(i+1)+"\" data-step=\""+(i+1)+"\" onclick=\"sendEvent('#modalFotos', "+(i+2)+")\">Siguiente</button>");

                        }
                        else
                        {
                            $("#modalFotosFooter").append("<button type=\"button\" class=\"btn btn-primary step step-"+(i+1)+"\" data-step=\""+(i+1)+"\" onclick=\"sendEvent('#modalFotos', "+(i)+")\">Anterior</button>");
                            $("#modalFotosFooter").append("<button type=\"button\" class=\"btn btn-primary step step-"+(i+1)+"\" data-step=\""+(i+1)+"\" onclick=\"sendEvent('#modalFotos', "+(i+2)+")\">Siguiente</button>");
                        }


                    }
                    $("#modalFotosEncabezados").after(html);
                    crearModalPasos();
                    $("#modalFotos").modal('show');
                }
                else
                {
                    //mandar a generar la plantilla
                    generarPlantilla();
                }
            }
        });
    });
    //cambia los pasos del modal
    sendEvent = function(sel, step) {
        $(sel).trigger('next.m.' + step);
    }
    //numeroPasoModal contiene el paso en el que el usuario quiere cargar fotos
    function cargarFotosFormulario(numeroPasoModal) {

        $("#contenidoModalFotos"+numeroPasoModal).empty();
        var idFormulario=$("#selectFormulario"+numeroPasoModal).val();
        var idAsignacion=$("#idCentroTrabajo").val();
        $.ajax({
            url: '<?=site_url('CrudGeneradorPlantillas/cargarFotosFormulario/')?>'+idFormulario+"/"+idAsignacion,
            dataType: 'JSON',
            success: function (fotos)
            {
                for(i=0;i<fotos.length; i++)
                {

                    if(i%3==0)
                    {
                        $("#contenidoModalFotos"+numeroPasoModal).append("<div class='row' style='padding: 20px;'>");
                    }
                    $("#contenidoModalFotos"+numeroPasoModal).append(" " +
                        "<div class='col-sm-4' align='center'>" +
                        "<img style='max-width:100%; max-height:140px' class='fotos"+numeroPasoModal+"' src='<?=base_url('assets/img/fotoAnalisisRiesgo/')?>"+fotos[i]['idFormularioAsignacion']+"/"+fotos[i]['foto']+"' onClick='establecerFoto("+numeroPasoModal+", \""+fotos[i]['idFormularioAsignacion']+fotos[i]['foto']+"\", this)'>" +
                        "</div>");


                }
            }
        });

    }
    function establecerFoto(numeroPaso, nombreFoto, elementoSeleccionado)
    {
        $(".fotos"+numeroPaso).removeClass("fotoSeleccionada");
        $(elementoSeleccionado).addClass("fotoSeleccionada");
        var idEtiqueta=$("#etiqueta"+numeroPaso).val();
        var nombreEtiqueta=$("#nombreEtiqueta"+numeroPaso).val();
        arregloFotos[numeroPaso].nombreEtiqueta=nombreEtiqueta;
        arregloFotos[numeroPaso].nombreFoto=nombreFoto;
        console.log(arregloFotos[numeroPaso])
    }
    function establecerAncho(numeroPaso)
    {
        arregloFotos[numeroPaso].ancho=$("#anchoContenidoModalFotos"+numeroPaso).val();
        console.log(arregloFotos[numeroPaso])
    }
    function establecerAlto(numeroPaso)
    {
        arregloFotos[numeroPaso].alto=$("#altoContenidoModalFotos"+numeroPaso).val();
        console.log(arregloFotos[numeroPaso])
    }
    function generarPlantilla()
    {

        console.log(JSON.stringify(arregloFotos));
        /*var params="?";
        var contador=0;
        arregloFotos.forEach(function (e) {
            params+="nombreEtiqueta"+(contador)+"="+encodeURIComponent(e.nombreEtiqueta)+"&nombreFoto"+(contador)+"="+encodeURIComponent(e.nombreFoto)+"&";
            contador++;
        });
        params+="contador="+contador;*/

        //console.log(params);
        //window.location="<?=site_url('CrudGeneradorPlantillas/generarPlantilla/')?>"+params;

        $.ajax({
            url: '<?=site_url('CrudGeneradorPlantillas/generarPlantilla/')?>',
            type: 'POST',
            dataType: 'JSON',
            data: {fotos: arregloFotos, idAsignacion: $("#idCentroTrabajo").val(), idPlantilla: $("#idPlantilla").val()},
            success: function (data)
            {
                //data es el nombre de la plantilla a descargar
                console.log(data);
                window.location="<?=site_url('CrudGeneradorPlantillas/descargaDocumento/')?>"+data;
            }

        });
    }

</script>
<!--multi-step-modal-->
<script>
    function crearModalPasos() {
        +function($) {
            'use strict';

            var modals = $('.modal.multi-step');

            modals.each(function(idx, modal) {
                var $modal = $(modal);
                var $bodies = $modal.find('div.modal-body');
                var total_num_steps = $bodies.length;
                var $progress = $modal.find('.m-progress');
                var $progress_bar = $modal.find('.m-progress-bar');
                var $progress_stats = $modal.find('.m-progress-stats');
                var $progress_current = $modal.find('.m-progress-current');
                var $progress_total = $modal.find('.m-progress-total');
                var $progress_complete  = $modal.find('.m-progress-complete');
                var reset_on_close = $modal.attr('reset-on-close') === 'true';

                function reset() {
                    $modal.find('.step').hide();
                    $modal.find('[data-step]').hide();
                }

                function completeSteps() {
                    $progress_stats.hide();
                    $progress_complete.show();
                    $modal.find('.progress-text').animate({
                        top: '-2em'
                    });
                    $modal.find('.complete-indicator').animate({
                        top: '-2em'
                    });
                    $progress_bar.addClass('completed');
                }

                function getPercentComplete(current_step, total_steps) {
                    return Math.min(current_step / total_steps * 100, 100) + '%';
                }

                function updateProgress(current, total) {
                    $progress_bar.animate({
                        width: getPercentComplete(current, total)
                    });
                    if (current - 1 >= total_num_steps) {
                        completeSteps();
                    } else {
                        $progress_current.text(current);
                    }

                    $progress.find('[data-progress]').each(function() {
                        var dp = $(this);
                        if (dp.data().progress <= current - 1) {
                            dp.addClass('completed');
                        } else {
                            dp.removeClass('completed');
                        }
                    });
                }

                function goToStep(step) {
                    reset();
                    var to_show = $modal.find('.step-' + step);
                    if (to_show.length === 0) {
                        // at the last step, nothing else to show
                        return;
                    }
                    to_show.show();
                    var current = parseInt(step, 10);
                    updateProgress(current, total_num_steps);
                    findFirstFocusableInput(to_show).focus();
                }

                function findFirstFocusableInput(parent) {
                    var candidates = [parent.find('input'), parent.find('select'),
                            parent.find('textarea'),parent.find('button')],
                        winner = parent;
                    $.each(candidates, function() {
                        if (this.length > 0) {
                            winner = this[0];
                            return false;
                        }
                    });
                    return $(winner);
                }

                function bindEventsToModal($modal) {
                    var data_steps = [];
                    $('[data-step]').each(function() {
                        var step = $(this).data().step;
                        if (step && $.inArray(step, data_steps) === -1) {
                            data_steps.push(step);
                        }
                    });

                    $.each(data_steps, function(i, v) {
                        $modal.on('next.m.' + v, {step: v}, function(e) {
                            goToStep(e.data.step);
                        });
                    });
                }

                function initialize() {
                    reset();
                    updateProgress(1, total_num_steps);
                    $modal.find('.step-1').show();
                    $progress_complete.hide();
                    $progress_total.text(total_num_steps);
                    bindEventsToModal($modal, total_num_steps);
                    $modal.data({
                        total_num_steps: $bodies.length,
                    });
                    if (reset_on_close){
                        //Bootstrap 2.3.2
                        $modal.on('hidden', function () {
                            reset();
                            $modal.find('.step-1').show();
                        })
                        //Bootstrap 3
                        $modal.on('hidden.bs.modal', function () {
                            reset();
                            $modal.find('.step-1').show();
                        })
                    }
                }

                initialize();
            })
        }(jQuery);

    }
</script>




<?php
include "footer.php";
?>
