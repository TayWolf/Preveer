<?php
include "header.php";
?>

<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.tabledit.js"></script>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
    var array = {
        'datosTipopuntos': []//
    };
    var arrayE = {
        'datosTipopuntosE': []
    };
     var arrayI = {
        'datosTipopuntosI': []
    };

     $("#form2").on("submit", function(e){
        e.preventDefault();
        AgregarPuntos();
    });
 var conta=1;
function AgregarPuntos()
    {
      
        var puntoRevi = $("#puntoRevi").val();
        var areaRe = $("#areaRe").val();
        var puntNom = $("#puntNom").val();
        var idAsigns = $("#idAsignacion").val();
        var arreglo = {'datos': []};
       // alert("modofoques " +puntoRevi)

        arreglo.datos.push({'idPuente': '-1', 'puntoRevi': puntoRevi ,'areaRe': areaRe, 'puntNom': puntNom, 'action' : 1});
        //console.log(JSON.stringify(array.datosTipopuntos, null, 4));

        var formData = new FormData(document.getElementById('formularioInsercion'));
        formData.append('datos', JSON.stringify(arreglo.datos));
       
        //empieza codigo insercion 
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/insertarArregloActas/" + idAsigns,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    array.datosTipopuntos.push({//
                        'idPuente': data,
                        'puntoRevi': puntoRevi ,
                        'areaRe': areaRe ,
                        'puntNom': puntNom,
                       
                        'action' : 0});


                    $("#listapuntosRebic").append('<tr>'+
                         '<td>'+conta+'</td>'+
                        '<td>'+puntoRevi+'</td>'+
                        '<td>'+areaRe+'</td>'+
                        '<td>'+puntNom+'</td>'+
                       
                        
                        '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                        '</tr>');

                    limpiarFormulario();
                     conta++;
                }
            }
        );

        //'<td><button onclick="traerFotoUnicaH('+data+' )"  data-toggle="modal" data-target="#myModalImagenInstalacion" type="button" class="btn btn-default"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
        // finaliza codigo insercion
    }

     function limpiarFormulario()
    {
        $("#puntoRevi").val("");
        $("#areaRe").val("");
        $("#puntNom").val("");
    }
 window.onload = cargaDatosTabla;

 function cargaDatosTabla(){

        <?php
        $cont=1;
        foreach ($tiposPuente as $row) {
            $idPuente = $row["idPuente"];         
            $puntosRevisar = preg_replace( "/\r|\n/", " '+' ", $row["puntosRevisar"]);

            $AreaB = preg_replace( "/\r|\n/", " '+' ", $row["Area"] );
             $puntosNorm = preg_replace( "/\r|\n/", " '+' ", $row["puntosNorm"] );

            $idAsignacion = $row["idAsignacion"];


            print "array.datosTipopuntos.push({'idPuente' : $idPuente,'puntoRevi' : '$puntosRevisar','areaRe' : '$AreaB','puntNom' : '$puntosNorm', 'action' : 0}); \n";//


            print "$('#listapuntosRebic').append(
                     '<tr><td hidden>$idPuente</td><td>$cont</td><td>$puntosRevisar</td><td>$AreaB</td><td >$puntosNorm</td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
                     $cont++;
        }
        print("console.log(JSON.stringify(array.datosTipopuntos, null, 4));");//
        //Otra tabla
        foreach ($tiposPuenteEvi as $row) {
            $idPuentE = $row["idPuentE"];         
            $condicionesEv = preg_replace( "/\r|\n/", " '+' ", $row["condicionesEv"]);

            $areaEvi = preg_replace( "/\r|\n/", " '+' ", $row["areaEvi"] );
            $recomenEvi = preg_replace( "/\r|\n/", " '+' ", $row["recomenEvi"] );
            $nombreEspEvi = preg_replace( "/\r|\n/", " '+' ", $row["nombreEspEvi"] );
            $fechaAvisEvi = preg_replace( "/\r|\n/", " '+' ", $row["fechaAvisEvi"] );
            $fechaFevi = preg_replace( "/\r|\n/", " '+' ", $row["fechaFevi"] );

            $idAsignacion = $row["idAsignacion"];


            print "arrayE.datosTipopuntosE.push({'idPuentE' : $idPuentE,'condicionesEv' : '$condicionesEv','areaEvi' : '$areaEvi','recomEvid' : '$recomenEvi','responsableEvi' : '$nombreEspEvi','fechaAviEvi' : '$fechaAvisEvi','fechaFevid' : '$fechaFevi', 'actionD' : 0}); \n";


            print "$('#listapuntosEvidencia').append(
                     '<tr><td hidden>$idPuentE</td><td>$cont</td><td><button onclick=\"traerFotoUnicaH($idPuentE)\" type=\"button\" class=\"btn btn-default\"><i data-toggle=\"modal\" data-target=\"#myModalImagenInstalacion\" class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td>$condicionesEv</td><td>$areaEvi</td><td >$recomenEvi</td><td>$nombreEspEvi</td><td>$fechaAvisEvi</td><td>$fechaFevi</td><td><button type=\"button\" class=\"btn btn-defaultBorrarD\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
                     $cont++;
        }

        foreach ($tiposPuenteInca as $row) {
            $idPuen = $row["idPuen"];         
            $TipoInca = preg_replace( "/\r|\n/", " '+' ", $row["TipoInca"]);

            $noInc = preg_replace( "/\r|\n/", " '+' ", $row["noInc"] );
            $areaInca = preg_replace( "/\r|\n/", " '+' ", $row["areaInca"] );
            $FechaHora = preg_replace( "/\r|\n/", " '+' ", $row["FechaHora"] );
            $actoInca = preg_replace( "/\r|\n/", " '+' ", $row["actoInca"] );
            $condicionesPeli = preg_replace( "/\r|\n/", " '+' ", $row["condicionesPeli"] );

            $idAsignacion = $row["idAsignacion"];


            print "arrayI.datosTipopuntosI.push({'idPuen' : $idPuen,'TipoInca' : '$TipoInca','noInc' : '$noInc','areaInca' : '$areaInca','FechaHora' : '$FechaHora','actoInca' : '$actoInca','condicionesPeli' : '$condicionesPeli', 'actionT' : 0}); \n";


            print "$('#listadoIncap').append(
                     '<tr><td hidden>$idPuen</td><td>$cont</td><td>$TipoInca</td><td>$noInc</td><td >$areaInca</td><td>$FechaHora</td><td>$actoInca</td><td>$condicionesPeli</td><td><button type=\"button\" class=\"btn btn-defaultBorrarT\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
                     $cont++;
        }

        ?>
    }

    //Otra tabla
    function AgregarEvidencia()
    {
      
        var condicionesEv = $("#condicionesEv").val();
        var areaEvi = $("#areaEvi").val();
        var recomEvid = $("#recomEvid").val();
        var responsableEvi = $("#responsableEvi").val();
        var fechaAviEvi = $("#fechaAviEvi").val();
        var fechaFevid = $("#fechaFevid").val();

        var idAsigns = $("#idAsignacion").val();
        var arregloE = {'datosE': []};
       // alert("modofoques " +puntoRevi)

        arregloE.datosE.push({'idPuentE': '-1', 'condicionesEv': condicionesEv ,'areaEvi': areaEvi, 'recomEvid': recomEvid,'responsableEvi': responsableEvi,'fechaAviEvi': fechaAviEvi,'fechaFevid': fechaFevid, 'actionD' : 1});
        //console.log(JSON.stringify(array.datosTipopuntos, null, 4));

        var formData = new FormData(document.getElementById('formularioInsercionEvi'));
        formData.append('datosE', JSON.stringify(arregloE.datosE));
       
        //empieza codigo insercion 
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/insertarArregloActasEv/" + idAsigns,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    arrayE.datosTipopuntosE.push({
                        'idPuentE': data,
                        'condicionesEv': condicionesEv ,
                        'areaEvi': areaEvi ,
                        'recomEvid': recomEvid,
                        'responsableEvi':responsableEvi,
                        'fechaAviEvi':fechaAviEvi,
                       'fechaFevid':fechaFevid,
                        'actionD' : 0});


                    $("#listapuntosEvidencia").append('<tr>'+
                         '<td>'+conta+'</td>'+
                         '<td><button onclick="traerFotoUnicaH('+data+' )"  data-toggle="modal" data-target="#myModalImagenInstalaci" type="button" class="btn btn-default"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
                        '<td>'+condicionesEv+'</td>'+
                        '<td>'+areaEvi+'</td>'+
                        '<td>'+recomEvid+'</td>'+
                         '<td>'+responsableEvi+'</td>'+
                          '<td>'+fechaAviEvi+'</td>'+
                          '<td>'+fechaFevid+'</td>'+
                        '<td><button type="button" class="btn btn-defaultBorrarD"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                        '</tr>');

                    limpiarFormulario();
                     conta++;
                }
            }
        );

        
    }
    //Fin tabla
    //ultima tabla
    function AgregarIncap()
    {
      
        var tipoIncap = $("#tipoIncap").val();
        var noInca = $("#noInca").val();
        var areaInca = $("#areaInca").val();
        var FehInca = $("#FehInca").val();
        var actpInseIn = $("#actpInseIn").val();
        var condicionInca = $("#condicionInca").val();

        var idAsigns = $("#idAsignacion").val();
        var arregloI = {'datosI': []};
       // alert("modofoques " +puntoRevi)

        arregloI.datosI.push({'idPuen': '-1', 'tipoIncap': tipoIncap ,'noInca': noInca, 'areaInca': areaInca,'FehInca': FehInca,'actpInseIn': actpInseIn,'condicionInca': condicionInca, 'actionT' : 1});
        //console.log(JSON.stringify(array.datosTipopuntos, null, 4));

        var formData = new FormData(document.getElementById('formularioInsercionInca'));
        formData.append('datosI', JSON.stringify(arregloI.datosI));
       
        //empieza codigo insercion 
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/insertarArregloActasInca/" + idAsigns,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    arrayI.datosTipopuntosI.push({
                        'idPuen': data,
                        'tipoIncap': tipoIncap,
                        'noInca': noInca,
                        'areaInca': areaInca,
                        'FehInca':FehInca,
                        'actpInseIn':actpInseIn,
                       'condicionInca':condicionInca,
                        'actionT' : 0});


                    $("#listadoIncap").append('<tr>'+
                         '<td>'+conta+'</td>'+
                         
                        '<td>'+tipoIncap+'</td>'+
                        '<td>'+noInca+'</td>'+
                        '<td>'+areaInca+'</td>'+
                         '<td>'+FehInca+'</td>'+
                          '<td>'+actpInseIn+'</td>'+
                          '<td>'+condicionInca+'</td>'+
                        '<td><button type="button" class="btn btn-defaultBorrarT"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                        '</tr>');

                    limpiarFormulario();
                     conta++;
                }
            }
        );

        
    }
    //fin ultima
</script>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php $tipo = $this->session->userdata('tipoUser');
            if ($tipo != '' && $_SESSION['idusuariobase'] != '') {
                if ($tipo == 3) {
                    echo "<a href='" . site_url('CrudReportes') . "/" . $this->session->userdata('idusuariobase') . "'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } else {
                    echo "<a href='" . site_url('CrudReportes/') . "'>
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
                        <h2>Acta de verificación ocular en el centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <form id="formularioInsercion"></form>
                        <form id="formularioInsercionEvi"></form>
                        <form id="formularioInsercionInca"></form>
                        <?php
                        $contador = 0;
                        $row = array('idActa' => "", 'ciudadEstado' => "", 'hora' => "", 'fechaU' => "", 'registroPatronal' => "", 'descripcionEmpresa' => "", 'nEmpleado' => "", 'CP' => "", 'horaDos' => "", 'fechaDos' => "", 'idAsignacion' => "", 'razonSocial' => "", 'rfc' => "", 'domicilioFiscal' => "", 'reprePatronCor' => "", 'reprePatroSecrer' => "", 'reprePatronVocal' => "", 'repreTrabaVocal' => "", 'reprePatronVocalDos' => "", 'RepreTrabaVocalDos' => "");
                        foreach ($existencia as $row2) {
                            $row = $row2;
                            $contador++;
                        }
                        ?>
                        <div class="panel-body">
                            <form id="form" enctype="multipart/form-data">
                                <input type="hidden" name="idAsignacion" id="idAsignacion"
                                       value="<?php echo $idAsignacion; ?>">
                                <input type="hidden" name="idActa" id="idActa" value="<?php echo $row['idActa']; ?>">
                                <div class="row">
                                    <p style="text-align: justify;">

                                    En <input type="text" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: auto !important;" id="ciudMuni" name="ciudMuni" placeholder="Ciudad"
                                                                               value="<?php echo $row['ciudadEstado']; ?>">,
                                        siendo las <input
                                                type="text" id="horaU" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: auto !important;" name="horaU" value="<?php echo $row['hora']; ?>" placeholder="Hora">,
                                        del día <input type="text" name="fechaU" id="fechaU" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: auto !important;" placeholder="Fecha"
                                                       value="<?php echo $row['fechaU']; ?>">,
                                        se reunieron los integrantes de la Comisión de Seguridad e Higiene en el interior de las
                                        instalaciones de la empresa <input type="text" id="razonSocia" name="razonSocia" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: 40%!important;" placeholder="Razón social"
                                                                           value="<?php echo $row['razonSocial']; ?>">
                                        con Registro Federal de Contribuyentes <input type="text" id="rfcC" name="rfcC" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: auto !important;" placeholder="RFC"
                                                                                      value="<?php echo $row['rfc']; ?>">
                                        y Registro Patronal <input type="text" id="regiPatro" name="regiPatro" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: auto !important;" placeholder="Registro patronal"
                                                                   value="<?php echo $row['registroPatronal']; ?>">,
                                        cuya actividad consiste en <input type="text" id="descripcEmp" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: 30% !important;" placeholder="Descripción"
                                                                           name="descripcEmp"
                                                                          value="<?php echo $row['descripcionEmpresa']; ?>">
                                        y cuenta con una plantilla de <input type="text" id="nEmple" name="nEmple" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: auto !important;" placeholder="Plantilla de trabajadores"
                                                                             value="<?php echo $row['nEmpleado']; ?>">
                                        trabajadores, con domicilio en <input type="text" id="domiFisc" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: 60% !important;" placeholder="Domicilio"
                                                                               name="domiFisc"
                                                                              value="<?php echo $row['domicilioFiscal']; ?>">
                                        Y <input type="text" class="form-control" style="display: inline-block !important; padding: 0 !important; height: auto !important; width: auto !important;" id="cp" name="cp" value="<?php echo $row['CP']; ?>" placeholder="Código postal">
                                         a
                                        efecto de realizar el recorrido de verificación, conforme a lo dispuesto en los
                                        artículos 509, 510 y 540 de la Ley Federal del Trabajo; Artículo 45, I, II, III,
                                        IV, V, VI,VII,VII, IX, X del Reglamento Federal de Seguridad y Salud en el
                                        Trabajo, la NOM-19-STPS-2011. </p>
                                </div>
                            </form>
                            <!-- <form id="form2"  > -->
                            <div role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Puntos por revisar</b>
                                                        <input type="text" class="form-control" id="puntoRevi"
                                                               name="puntoRevi" min="1" value="" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Area</b>
                                                        <input type="text" class="form-control" id="areaRe"
                                                               name="areaRe" min="0" value="" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>PUNTOS DE LAS NOM’S </b>
                                                        <input type="text" class="form-control" id="puntNom"
                                                               name="puntNom" min="0" value="" required/>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="panel-body">
                                            <div class="row text-center">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                    <div class="form-line">
                                                        <input type="submit" onclick="AgregarPuntos()" value="Agregar"
                                                               class="btn bg-red" id="agregar-in">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="body table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Puntos por revisar</th>
                                                    <th>Área</th>
                                                    <th>PUNTOS DE LAS NOM’S</th>

                                                    <th>ELIMINAR</th>
                                                </tr>
                                                </thead>
                                                <tbody id="listapuntosRebic">

                                                </tbody>

                                            </table>
                                        </div>


                                    </div>

                                </div>
                            </div>
                            <!--  </form> -->
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <p>Cumpliendo con lo establecido en el reglamento de seguridad y salud en el
                                        trabajo, se realizó una inspección ocular dentro del centro de trabajo, para
                                        identificar la estructura del inmueble y realizar las recomendaciones
                                        pertinentes para reparar corregir estos puntos.</p>
                                </div>
                            </div>
                            <br>
                            <p>En la siguiente tabla se muestran los detalles del recorrido realizado</p>

                            <!--  <form id="form3"  > -->
                            <div role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-body">
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Condiciones inseguras detectadas</b>
                                                        <input type="text" class="form-control" id="condicionesEv"
                                                               name="condicionesEv" min="1" value="" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Área</b>
                                                        <input type="text" class="form-control" id="areaEvi"
                                                               name="areaEvi" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Recomendaciones para prevenir las condiciones inseguras
                                                            detectadas</b>
                                                        <input type="text" class="form-control" id="recomEvid"
                                                               name="recomEvid" value="" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Nombre del responsable</b>
                                                        <input type="text" class="form-control" id="responsableEvi"
                                                               name="responsableEvi" value="" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Fecha aviso de compromiso</b>
                                                        <input type="date" class="form-control" id="fechaAviEvi"
                                                               name="fechaAviEvi" min="0" value="" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>Fecha de finalización</b>
                                                        <input type="date" class="form-control" id="fechaFevid"
                                                               name="fechaFevid" value="" required/>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="panel-body">
                                                <div class="row text-center">
                                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                                        <div class="form-line">
                                                            <input type="submit" onclick="AgregarEvidencia()"
                                                                   value="Agregar" class="btn bg-red" id="agregar-in">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="body table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Evidencia</th>
                                                        <th>Condiciones inseguras detectadas</th>
                                                        <th>Área</th>
                                                        <th>Recomendaciones para prevenir las condiciones inseguras
                                                            detectadas
                                                        </th>
                                                        <th>Nombre del responsable</th>
                                                        <th>Fecha de aviso compromiso</th>
                                                        <th>Fecha de finalización</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="listapuntosEvidencia">

                                                    </tbody>

                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- </form> -->

                            <div class="body table-responsive col-sm-12">
                                <p><strong>REPORTE DE ACCIDENTES, INCIDENTES O ENFERMEDADES DE TRABAJO.</strong></p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Tipo de incapacidad</b>
                                                <select class="form-control" id="tipoIncap" name="tipoIncap">
                                                    <option value="">Seleccione una opción</option>
                                                    <option value="Accidentes">Accidentes</option>
                                                    <option value="Incidentes">Incidentes</option>
                                                    <option value="Enfermedades de trabajo">Enfermedades de trabajo
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>No.</b>
                                                <input type="number" class="form-control" id="noInca" name="noInca"
                                                       value="1" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Área</b>
                                                <input type="text" class="form-control" id="areaInca" name="areaInca"
                                                       value="" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Fecha y hora</b>
                                                <input type="text" class="form-control" id="FehInca" name="FehInca"
                                                       value="" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Acto Inseguro</b>
                                                <input type="text" class="form-control" id="actpInseIn"
                                                       name="actpInseIn" value="" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Condiciones Peligrosa</b>
                                                <input type="text" class="form-control" id="condicionInca"
                                                       name="condicionInca" value="" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="row text-center">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-line">
                                                <input type="submit" onclick="AgregarIncap()" value="Agregar"
                                                       class="btn bg-red" id="agregar-in">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tipo de incapacidad</th>
                                        <th scope="col">No.</th>
                                        <th scope="col">Área</th>
                                        <th scope="col">Fecha y hora</th>
                                        <th scope="col">Acto inseguro</th>
                                        <th scope="col">Condición peligrosa</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                    </thead>
                                    <tbody id="listadoIncap">

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <p>No existiendo otro asunto que tratar, se dio por terminada la presente, siendo las
                                    <input type="text" id="hodrDos" name="hodrDos"
                                           value="<?php echo $row['horaDos']; ?>" form="form"> horas del <input
                                            type="text" id="fechDos" name="fechDos"
                                            value="<?php echo $row['fechaDos']; ?>" form="form">, Firmando de
                                    conformidad al calce y margen los que en ella intervinieron.</p>
                            </div>


                            <div class=" col-md-offset-3 col-sm-3">
                                <div class="form-group">
                                    <div class="form-line" align="center">
                                        <input type="text" class="form-control" id="reprePatronCor"
                                               name="reprePatronCor" value="<?php echo $row['reprePatronCor']; ?>"
                                               form="form"/>
                                    </div>
                                    <p>Representante del Patrón (Coordinadora)</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line" align="center">
                                        <input type="text" class="form-control" id="reprePatroSecrer"
                                               name="reprePatroSecrer" value="<?php echo $row['reprePatroSecrer']; ?>"
                                               form="form"/>
                                    </div>
                                    <p>Representante del Patrón (Secretario)</p>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class=" col-md-offset-3 col-sm-3">
                                <div class="form-group">
                                    <div class="form-line" align="center">
                                        <input type="text" class="form-control" id="reprePatronVocal"
                                               name="reprePatronVocal" value="<?php echo $row['reprePatronVocal']; ?>"
                                               form="form"/>
                                    </div>
                                    <p>Representante del Patrón (Vocal)</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line" align="center">
                                        <input type="text" class="form-control" id="repreTrabaVocal"
                                               name="repreTrabaVocal" value="<?php echo $row['repreTrabaVocal']; ?>"
                                               form="form"/>
                                    </div>
                                    <p>Representante de los trabajadores (Vocal)</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-offset-3 col-sm-3">
                                <div class="form-group">
                                    <div class="form-line" align="center">
                                        <input type="text" class="form-control" id="reprePatronVocalDos"
                                               name="reprePatronVocalDos"
                                               value="<?php echo $row['reprePatronVocalDos']; ?>" form="form"/>
                                    </div>
                                    <p>Representante del Patrón (Vocal)</p>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-line" align="center">
                                        <input type="text" class="form-control" id="RepreTrabaVocalDos"
                                               name="RepreTrabaVocalDos"
                                               value="<?php echo $row['RepreTrabaVocalDos']; ?>" form="form"/>
                                    </div>
                                    <p>Representante de los trabajadores (Vocal)</p>
                                </div>
                            </div>
                        </div>


                        <!-- </div> -->


                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-2 col-md-offset-4">
                                    <div class="form-line">
                                        <input type="submit" onclick="registrarActaGral();"
                                               class="btn bg-red waves-effect waves-light" value="Guardar">
                                    </div>
                                </div>
                                <div class="col-sm-2 ">
                                    <div class="form-line">
                                        <input type="submit" onclick="popUpImprimir(<?= $idAsignacion ?>);"
                                               class="btn bg-red waves-effect waves-light" value="Imprimir">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<div class="modal fade" id="myModalImagenInstalacion" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Imagen de la evidencia</h4>
            </div>
            <div class="modal-body">
                <div class="row" align="center">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <b>Fotos </b>
                        <div id="ConteniFoto">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>
<script>
    $( "#suministro" ).change(function() {
        $( "#suministro option:selected" ).each(function() {
            //console.log($(this).val());
            if($(this).val() == 3){
                $("#sumOtro").removeAttr("disabled");
            }else{
                $("#sumOtro").val(" ");
                $("#sumOtro").attr("disabled", true);
            }
        });
    });
</script>

<script type="text/javascript">

    function registrarActaGral()
    {
            accion = "actualizardatosActa/";
            var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/';?>" + accion;
            var formData = new FormData(document.getElementById("form"));
            formData.append('datosPuenteActa', (JSON.stringify(array.datosTipopuntos)));//
            formData.append('datosPuenteActaU', (JSON.stringify(arrayE.datosTipopuntosE)));
            formData.append('datosPuenteActaD', (JSON.stringify(arrayI.datosTipopuntosI)));

            //console.log(JSON.stringify(array.datosTipopuntos));
            $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
                .done(function (res) {
                    console.log(res);
                    swal({
                            title: "Éxito",
                            text: "Se han registrado los datos",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",
                        },
                        function () {
                            location.href = 'https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/formActaverificacion/' + $("#idAsignacion").val();
                        });
                });
        
    }
   
    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();

        var indice =  $(this).closest('tr').index();

        if(array.datosTipopuntos[indice]['idPuente'] == -1)//
        {
            array.datosTipopuntos.splice(indice, 1);//
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosTipopuntos[indice]['action']=3;//
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array.datosTipopuntos, null, 4));//

    });
    //Dos
    $(document).on('click', '.btn-defaultBorrarD', function (event) {
        event.preventDefault();

        var indice =  $(this).closest('tr').index();

        if(arrayE.datosTipopuntosE[indice]['idPuentE'] == -1)
        {
            arrayE.datosTipopuntosE.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            arrayE.datosTipopuntosE[indice]['actionD']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(arrayE.datosTipopuntosE, null, 4));

    });
    //Tres
    $(document).on('click', '.btn-defaultBorrarT', function (event) {
        event.preventDefault();

        var indice =  $(this).closest('tr').index();

        if(arrayI.datosTipopuntosI[indice]['idPuen'] == -1)
        {
            arrayI.datosTipopuntosI.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            arrayI.datosTipopuntosI[indice]['actionT']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(arrayI.datosTipopuntosI, null, 4));

    });


</script>

<script>

    function traerFotoUnicaH(llavePrimaria)
    {
        $("#ConteniFoto").html("");


        $("#ConteniFoto").append("<div class=\"row\"><div class=\"col-md-offset-3 col-md-6\"><input type='file' class='file' id='fotoEvidencia' name='fotoEvidencia' data-min-file-count='1' /></div>");
        //alert(idAsi+"/"+idT+"/"+capac+"/"+cantid)
        $.ajax({
            url : "<?php echo site_url('Crudactaverificacion/retornoFotoPK')?>/" + llavePrimaria+"/actaPuenteEvi/idPuente/",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
                if (data.length>0)
                {
                    for (i=0; i< data.length; i++)
                    {
                        //for(j=1;j<=4; j++)
                        //{

                            var fot=data[i]["fotoEvidencia"];
                             //alert("fot "+fot)
                            crearFileInputFotos(fot,  llavePrimaria);

                        //}

                        //
                    }
                    $("#myModalImagenInstalacion").modal({show: true});
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });



    }
    function crearFileInputFotos(valor,  llavePrimaria)
    {
        var fot=valor;
         
        if (fot!="null")
        {
       // alert(fot)
            var codig="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoEvidencia/"+fot+"' class='file-preview-image' >";
        }

        var idControl=data[i]["idPuentE"];
        // alert(idControl)
        $("#fotoEvidencia").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/subirFotoGeneralTabla/fotoEvidencia/actaPuenteEvi/"+llavePrimaria+"/idPuentE",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png'],
            initialPreview: [codig]


        }).on('change', function(event, data, previewId, index)
        {
            $("#fotoEvidencia").fileinput("upload");

        }).on('fileclear', function (event) {
            // aun sin programar
            url = "https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/eliminarImagenArreglo/fotoEvidencia/actaPuenteEvi/"+llavePrimaria+"/idPuentE/";
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });
    }

</script>

<!-- Boton flotante -->

<ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
    <li class='mfb-component__wrap'>
        <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
        </a>
        <ul class='mfb-component__list'>
            <li>
                <a href="<?=site_url('Catalogos')?>" data-mfb-label='Catálogos' class='mfb-component__button--child'>
                    <i class='material-icons'>import_contacts</i>
                </a>
            </li>
            <li>
                <a href="<?=site_url('CrudOti')?>" data-mfb-label='OTI' class='mfb-component__button--child'>
                    <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>

            <li>
                <a href="<?=site_url('Crudusuarios')?>"
                   data-mfb-label='Usuarios' class='mfb-component__button--child'>
                    <i class='material-icons'>person_add</i>
                </a>
            </li>
        </ul>
    </li>
</ul>

<?php

$tipo=$this->session->userdata('tipoUser');
if($tipo!='' && $_SESSION['idusuariobase'] != '')
{
    //$data['page'] = $this->usuarios->data_pagination("/Crudusuarios/index/",
    //$this->usuarios->getTotalRowAllData(), 3);
    // $data['listAreas'] = $this->areas->getDatos($index);
    if($tipo == 1){ //Menu flotante para administrador
        echo "
            
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('Catalogos')." data-mfb-label='Catálogos' class='mfb-component__button--child'>
                <i class='material-icons'>import_contacts</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>

            <li>
                <a href=".site_url('Crudusuarios')."
                data-mfb-label='Usuarios' class='mfb-component__button--child'>
                <i class='material-icons'>person_add</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>        
            ";

    } else if($tipo == 2){ //Menu flotante para comercial
        echo "
            
             <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudCentrosTrabajo')." data-mfb-label='Centros de trabajo' class='mfb-component__button--child'>
                <i class='material-icons'>group_work</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudFormatos')." data-mfb-label='Formatos' class='mfb-component__button--child'>
                <i class='material-icons'>store_mall_directory</i>
                </a>
            </li>
            <li>
                <a href=".site_url('Crudclientes')." data-mfb-label='Clientes' class='mfb-component__button--child'>
                <i class='material-icons'>account_box</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>       
            ";
    }  else if($tipo == 3){ //Menu flotante para coordinador
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti/coordinador')."/".$this->session->userdata('idusuariobase')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>   
           ";
    }

    else if($tipo == 4){ //Menu flotante para analista
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>              
           ";
    }

    else if($tipo == 5){ //Menu flotante para analista
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>            
           ";
    }


}
?>


<!-- /Boton flotante -->


<!-- Jquery Core Js -->

<!-- Bootstrap Core Js -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.js')?>"></script>

<!-- Select Plugin Js -->
<!-- <script src="<?=base_url('assets/plugins/bootstrap-select/js/bootstrap-select.js')?>"></script> -->

<!-- Slimscroll Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.js')?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?=base_url('assets/plugins/node-waves/waves.js')?>"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-countto/jquery.countTo.js')?>"></script>

<!-- Morris Plugin Js -->
<script src="<?=base_url('assets/plugins/raphael/raphael.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/morrisjs/morris.js')?>"></script>

<!-- ChartJs -->
<script src="<?=base_url('assets/plugins/chartjs/Chart.bundle.js')?>"></script>

<!-- Flot Charts Plugin Js -->
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.resize.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.pie.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.categories.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.time.js')?>"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-sparkline/jquery.sparkline.js')?>"></script>

<!-- Custom Js -->
<script src="<?=base_url('assets/js/admin.js')?>"></script>

<script src="<?=base_url('assets/js/pages/index.js')?>"></script>


<!-- Demo Js -->
<script src="<?=base_url('assets/js/demo.js')?>"></script>
<script src="<?=base_url('assets/js/modernizr.touch.js')?>"></script>
<script src="<?=base_url('assets/js/mfb.js.js')?>"></script>



<!--JS PARA EDITAR IMAGENES AUTOMATICAMENTE -->
<link href="<?=base_url('assets/css/fileinput.min.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/js/piexif.min.js')?>"></script>
<script src="<?=base_url('assets/js/sortable.min.js')?>"></script>
<script src="<?=base_url('assets/js/purify.min.js')?>"></script>
<script src="<?=base_url('assets/js/fileinput.min.js')?>"></script>
<script src="<?=base_url('assets/js/es.js')?>"></script>



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

    function  popUpImprimir(id)
        {
            window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/verActaVerificacion/"+id);
        }

</script>


</body>

</html>
<!--
<?php
//include "footer.php";
?>

-->
