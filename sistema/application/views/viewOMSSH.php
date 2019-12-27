<?php
include "header.php";
?>
    <!-- TablEdit -->
    <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
    <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>



    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <!-- <h2>NORMAL TABLES</h2> -->
            </div>
            <div class="search-bar">
                <div class="search-icon">
                    <i class="material-icons">search</i>
                </div>
                <input type="text" placeholder="Buscar...">
                <div class="close-search">
                    <i class="material-icons">close</i>
                </div>
            </div>

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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="header">
                                    <h2>
                                        Oportunidad de Mejora
                                    </h2>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-group full-body" id="accordion_19" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-col-lightgray">
                                <div class="panel-heading" role="tab" id="headingThree_19">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="true" aria-controls="collapseThree_19">
                                            <i class="material-icons">spellcheck</i> Datos generales
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_19">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>No. de sucursal</b>
                                                        <input type="text" class="form-control" id="idDet" name="idDet" value="<?=$datosCentroTrabajo['numeroSucursal']?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Nombre sucursal</b>
                                                        <input type="text" class="form-control" id="idDet" name="idDet" value="<?=$datosCentroTrabajo['nombreSucursal']?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="body">
                            <div class="row">
                                <form id="form_om">
                                    <input type="hidden"  id="idAsignacion" name="idAsignacion" value="<?=$idAsignacion?>">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Área de ubicación</b>
                                                <select class="form-control" id="areaUbicacion" name="areaUbicacion" required="">
                                                    <?php
                                                    foreach ($areasUbicacion as $area)
                                                    {
                                                        print "<option value='".$area['idArea']."'>".$area['descripcion']."</option>";
                                                    }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Factor de riesgo</b>
                                                <input class="form-control" id="factorRiesgo" name="factorRiesgo" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Oportunidad de mejora</b>
                                                <input class="form-control" id="oportunidadMejora" name="oportunidadMejora" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Prioridad de intervención</b>
                                                <select class="form-control" id="prioridadIntervencion" name="prioridadIntervencion" required="">
                                                    <!-- <option value="1">PRUEBA</option> -->
                                                    <?php 
                                                        foreach ($getPrioritario as $roe) {
                                                           $idPrioridad=$roe["idPrioridad"];
                                                           $nombrePrior=$roe["nombre"];
                                                           $colorPrio=$roe["color"];
                                                           echo "<option value='$idPrioridad'>$nombrePrior</option>";
                                                        }
                                                     ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Recomendación</b>
                                                <input class="form-control" id="recomendacion" name="recomendacion" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Responsable</b>
                                                <input class="form-control" id="responsable" name="responsable" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Fecha de ejecución</b>
                                                <input type="date" class="form-control" id="fechaEjecucion" name="fechaEjecucion" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Fecha de verificación</b>
                                                <input type="date" class="form-control" id="fechaVerificacion" name="fechaVerificacion" required="">
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Seguimiento (observaciones)</b>
                                                <input class="form-control" id="seguimiento" name="seguimiento">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-6 col-sm-4">
                                        <input type="submit" class="btn bg-red waves-effect waves-light"  required="">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="body table table-responsive">
                        <table id="tabla-oportunidades" class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Área / Sección</th>
                                <th>Factor de riesgo</th>
                                <th>Foto que genera la oportunidad de mejora</th>
                                <th>Oportunidad de mejora</th>
                                <th>Prioridad de intervención</th>
                                <th>Recomendación</th>
                                <th>Responsable</th>
                                <th>Fecha de ejecución</th>
                                <th>Fecha de verificación</th>
                                <th>Foto corrección de la oportunidad de mejora</th>
                                <th>Seguimiento (observaciones)</th>
                                <th>Eliminar</th>
                                <th style="display: none">IDENTIFICADOR</th>
                            </tr>
                            </thead>
                            <tbody id="tableBody">
                            <?php
                            $contador=1;
                            $totalSoluciones = 0;
                            foreach ($tabla as $item)
                            {
                                if( $item['fotoCorreccion0'] != '' || $item['fotoCorreccion1'] != '' )
                                {
                                    $totalSoluciones++;
                                }

                                print "<tr><td>$contador</td><td>".$item['area']."</td><td>".$item['factorRiesgo']."</td><td><button type=\"button\" class=\"btn btn-default\" onclick=\"modalFotosMalas(".$item['idOMSSH'].")\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td>".$item['oportunidadMejora']."</td>
                                    <td style='background: ".$item['colorPrioridad'].";' id='color".$item['idOMSSH']."'>".$item['nombrePrioridad']."</td><td>".$item['recomendacion']."</td><td>".$item['responsable']."</td>
                                    <td>".$item['fechaEjecucion']."</td><td>".$item['fechaVerificacion']."</td><td><button type=\"button\" class=\"btn btn-default\" onclick=\"modalFotosBuenas(".$item['idOMSSH'].")\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td>".$item['seguimiento']."</td><td style='display: none;'>".$item['idOMSSH']."</td><td><a href='#' onclick='confirmaDeleteOM(".$item['idOMSSH'].");'>Eliminar</a></td></tr>";
                                $contador++;
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php if(!empty($tabla)){ ?>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <b>No. TOTAL DE OPORTUNIDADES DE MEJORA ENCONTRADAS</b>
                                        <input type="number" class="form-control" id="totalOportunidades" name="totalOportunidades" value="<?=count($tabla)?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <b>No. TOTAL DE SOLUCIONES IMPLEMENTADAS</b>
                                        <input type="number" class="form-control" id="totalSoluciones" name="totalSoluciones" value="<?=$totalSoluciones?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <div class="form-line">
                                        <b>% DE OPORTUNIDADES DE MEJORA SOLUCIONADAS</b>
                                        <input type="text" class="form-control" id="porcentajeSolucionadas" name="porcentajeSolucionadas" value="<?=($totalSoluciones*100)/count($tabla)?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-3" align="center">
                                <input onclick="popUpImprimir(<?=$idAsignacion?>);" type="button" class="btn bg-red waves-effect waves-light" id="btn-imprimir" value="Imprimir">
                            </div>
                            <div class="col-md-3" align="center">
                                <input onclick="guardarHistorico(<?=$idAsignacion?>);" type="button" class="btn bg-red waves-effect waves-light" id="btn-imprimir" value="Guardar seguimiento mensual">
                            </div>

                        </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="modalFotoMala" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Imagen</h4>
                </div>
                <div class="modal-body">
                    <div class="row" align="center">
                        <div class="col-md-8 col-md-offset-2">
                            <b>Fotos que genera la oportunidad de mejora</b>
                            <div id="ConteniFotoMala">
                                <div class="col-md-6">
                                    <input type="file" id="fotoMal0" name="fotoMal0[]" data-min-file-count="1">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" id="fotoMal1" name="fotoMal1[]" data-min-file-count="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalFotoBuena" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Imagen</h4>
                </div>
                <div class="modal-body">
                    <div class="row" align="center">
                        <div class="col-md-8 col-md-offset-2">
                            <b>Foto corrección de la oportunidad de mejora</b>
                            <div id="ConteniFotoBuena">
                                <div class="col-md-6">
                                    <input type="file" id="fotoCorreccion0" name="fotoCorreccion0[]" data-min-file-count="1">
                                </div>
                                <div class="col-md-6">
                                    <input type="file" id="fotoCorreccion1" name="fotoCorreccion1[]" data-min-file-count="1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        
        /*function calcularPorcentajeSoluciones(element)
        {
            var totalSoluciones = parseInt(element.value);
            var totalOportunidades = document.getElementById("totalOportunidades").value;
            var porcentajeSolucionadas = document.getElementById("porcentajeSolucionadas");
            var btnImprimir = document.getElementById("btn-imprimir");

            if(  Number.isInteger(totalSoluciones) && totalSoluciones <= totalOportunidades){
                porcentajeSolucionadas.value = (totalSoluciones*100) / totalOportunidades;
             
            }else{
                porcentajeSolucionadas.value = "";
            }

        }*/

        function modalFotosMalas(idOMSSH)
        {

            $("#ConteniFotoMala").empty();
            $("#ConteniFotoMala").append("<div class=\"col-md-6\">\n" +
                "                                    <input type=\"file\" id=\"fotoMal0\" name=\"fotoMal0[]\" data-min-file-count=\"1\">\n" +
                "                                </div>\n" +
                "                                <div class=\"col-md-6\">\n" +
                "                                    <input type=\"file\" id=\"fotoMal1\" name=\"fotoMal1[]\" data-min-file-count=\"1\">\n" +
                "                                </div>");
            $.ajax(
                {
                    url: '<?=site_url('CrudOMSSH/traerFotoMala/')?>'+idOMSSH,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (resultado)
                    {
                        
                        crearFileInputFotos(resultado[0]['fotoMal0'], idOMSSH, "fotoMal0");
                        crearFileInputFotos(resultado[0]['fotoMal1'], idOMSSH, "fotoMal1");

                    },
                    complete: function ()
                    {
                        $("#modalFotoMala").modal();

                    }
                }
            );


        }
        function modalFotosBuenas(idOMSSH)
        {
            $("#ConteniFotoBuena").empty();
            $("#ConteniFotoBuena").append("<div class=\"col-md-6\">\n" +
                "                                    <input type=\"file\" id=\"fotoCorreccion0\" name=\"fotoCorreccion0[]\" data-min-file-count=\"1\">\n" +
                "                                </div>\n" +
                "                                <div class=\"col-md-6\">\n" +
                "                                    <input type=\"file\" id=\"fotoCorreccion1\" name=\"fotoCorreccion1[]\" data-min-file-count=\"1\">\n" +
                "                                </div>");
            $.ajax(
                {
                    url: '<?=site_url('CrudOMSSH/traerFotoBuena/')?>'+idOMSSH,
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',
                    success: function (resultado)
                    {

                        crearFileInputFotos(resultado[0]['fotoCorreccion0'], idOMSSH, "fotoCorreccion0");
                        crearFileInputFotos(resultado[0]['fotoCorreccion1'], idOMSSH, "fotoCorreccion1");
                    },
                    complete: function ()
                    {
                        $("#modalFotoBuena").modal();

                    }
                }
            );


        }
        function crearFileInputFotos(valor,  llavePrimaria, nombreCampo)
        {
            
            var fot=valor;

            if (fot)
            {
                fot="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/"+nombreCampo+"/"+fot+"' class='file-preview-image' >";
            }else{
                fot="";
            }

           // alert(nombreCampo+"  "+fot)
            $("#"+nombreCampo).fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
                'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudOMSSH/subirFoto/"+nombreCampo+"/OMSSH/"+llavePrimaria,'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg','jpeg', 'gif', 'png'],
                initialPreview: [fot]
            }).on('change', function(event, data, previewId, index)
            {
                $("#"+nombreCampo).fileinput("upload");
            }).on('fileclear', function (event) {
                    url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOMSSH/borrarFoto/"+nombreCampo+"/"+llavePrimaria;
                    $.ajax({
                        url: url,
                        type: "post",
                        dataType: "html"
                    }).done(function (res) {});
            });
        }
    </script>

    <script>
        var dataAreas = <?php print json_encode($areasUbicacion); ?>;
        var prioridades = "{";
        dataAreas.forEach(function (element) {
            prioridades += '"'+element.idArea+'": "'+element.descripcion+'",';
        });
        var lastIndex = prioridades.lastIndexOf(",");
        var JSONAreas= prioridades.substring(0,lastIndex)+"}";
        ///////////////////////////////////////////////////////////////////////
        var dataPrioritarios = <?php print json_encode($getPrioritario); ?>;
        var prioridadesT = "{";
         dataPrioritarios.forEach(function (element) {
            prioridadesT += '"'+element.idPrioridad+'": "'+element.nombre+'",';
        });
        var lastIndex = prioridadesT.lastIndexOf(",");
        var JSONTipodpriori= prioridadesT.substring(0,lastIndex)+"}";

        $('#tabla-oportunidades').Tabledit({
            url: 'https://cointic.com.mx/preveer/sistema/index.php/CrudOMSSH/actualizarOMSSH/',
            editButton: false,
            deleteButton: false,
            autoFocus: false,
            columns: {
                identifier: [12, 'identificador'],
                editable: [[1, 'areaTabla', JSONAreas], [2, 'factorRiesgoTabla'], [4, 'oportunidadMejoraTabla'], [5, 'prioridadIntervencionTabla', JSONTipodpriori], [6, 'recomendacionTabla'],[7, 'responsableTabla'], [8, 'fechaEjecucionTabla'], [9, 'fechaVerificacionTabla'], [11, 'seguimientoTabla']]
            },
            onSuccess: function(data, textStatus, jqXHR) {
                console.log(data);
                cambiarColor(data[1],data[0]);
            }
        });

        var coloresIntervencion=<?php print_r($coloresIntervencion);?>;
        var contador=<?=$contador?>;
        $("#form_om").on('submit', function (e)
        {
            e.preventDefault();
            formData=new FormData(document.getElementById("form_om"));
            $.ajax(
                {
                    url: '<?=site_url('CrudOMSSH/agregarOportunidadMejora/')?>',
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    data: formData,
                    dataType: 'JSON',
                    success: function (response)
                    {
                        var data = response[0];
                        var fechaVerificacion = response[1];

                        colorTd="#FFFFFF";
                        colorSeleccionado=$("#prioridadIntervencion").val();
                        for(i=0; i<coloresIntervencion.length; i++)
                        {
                            if(colorSeleccionado==coloresIntervencion[i].idPrioridad)
                            {
                                colorTd=coloresIntervencion[i].color;
                            }
                        }
                        $("#tableBody").append("<tr><td>"+contador+"</td><td>"+$("#areaUbicacion option:selected").text()+"</td>"+
                            "<td>"+$("#factorRiesgo").val()+"</td><td><button type=\"button\" class=\"btn btn-default\" onclick=\"modalFotosMalas("+data+")\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td>"+$("#oportunidadMejora").val()+"</td>" +
                            "<td id='color"+data+"' style='background: "+colorTd+";'>"+$("#prioridadIntervencion option:selected").text()+"</td><td>"+$("#recomendacion").val()+"</td>" +
                            "<td>"+$("#responsable").val()+"</td><td>"+$("#fechaEjecucion").val()+"</td><td>"+fechaVerificacion+"</td>" +
                            "<td><button type=\"button\" class=\"btn btn-default\" onclick=\"modalFotosBuenas("+data+")\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td>"+$("#seguimiento").val()+"</td><td style='display: none;'>"+data+"</td></tr>");
                        contador++;

                        var totalOportunidades = document.getElementById("totalOportunidades").value += 1;

                    }
                }
            );
        });

        function  popUpImprimir(id)
        {
            var totalOportunidades = document.getElementById("totalOportunidades").value;
            var totalSoluciones = document.getElementById("totalSoluciones").value;

            window.open("https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/OMSSHI/"+id+"/"+totalOportunidades+"/"+totalSoluciones,"neo","width=900,height=600,menubar=si");
        }


    </script>
    <script>
        function cambiarColor(idOmssh, idColor)
        {
            console.log(idOmssh, idColor);
            for(i=0; i<coloresIntervencion.length; i++)
            {
                if(coloresIntervencion[i].idPrioridad==idColor)
                {
                    $("#color"+idOmssh).css("background-color", coloresIntervencion[i].color);
                    break;
                }

            }

        }

    </script>
<script>

    function confirmaDeleteOM(idOM)
    {
        swal({
            title: 'AVISO',
            text: "¿Estas seguro de eliminar oportunidad de mejora?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }, function (isConfirm)
        {
            if(isConfirm)
            {
                $.ajax({
                    url: '<?=site_url('CrudOMSSH/borrarOM/')?>' + idOM,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: 'HTML',
                    success: function (response) {
                        location.reload();
                        //swal('Exito!', 'Oportunidad de mejora eliminada', 'success');
                    }
                });
            }
        });

    }

    function guardarHistorico(idAsignacion)
    {

        swal({
            title: '¿Estas seguro de guardar el seguimiento de este mes?',
            text: "Se mostrarán estos cambios al cliente",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'Cancelar'
        }, function (isConfirm)
        {
            if(isConfirm)
            {
                $.ajax({
                    url: '<?=site_url('CrudOMSSH/guardarHistorico/')?>' + idAsignacion,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    dataType: 'HTML',
                    success: function (response) {
                        swal('Exito!', 'El seguimiento de este mes fue guardado', 'success');
                    }
                });
            }
        });
    }
</script>

<?php
include "footer.php";
?>