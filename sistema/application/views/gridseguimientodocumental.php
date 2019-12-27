<?php
include "header.php";
?>

<!-- DataTable -->

<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.5/css/fixedColumns.bootstrap.min.css"/>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>
<script type="text/javascript">


    function traerEstado(){

        $.ajax({
            type: "post",
            url : "<?php echo site_url('CrudSeguimiento/obtenerEstado/')?>",

            dataType: "json",
            success: function(data)
            {

                if (data.length>0)
                {
                    for (i=0; i<data.length; i++)
                    {
                        $("#nombreEstado").append("<option value='"+(data[i]["id_Estado"])+"'>"+(data[i]["nombreEstado"])+"</option>");
                    }


                }
            }
        });

    }
</script>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href="<?=site_url('menus');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header" style="border-bottom: 1px solid rgba(204, 204, 204, 0);padding-bottom: 0px;">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>
                                    Seguimiento documental
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">assignment</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" onclick="fnExcelReport();">Exportar excel</a></li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-float" >
                                    <div class="form-line">
                                        <label for="idCliente">Cliente</label>
                                        <select class="form-control" id="idCliente" name="idCliente" onchange="cargarServicios();" >
                                            <option value="">Seleccione una opción</option>
                                            <?php
                                            foreach ($clientes as $cliente)
                                            {
                                                $idCliente=$cliente['idCliente'];
                                                $nombreCliente=$cliente['nombreCliente'];
                                                echo "<option value='$idCliente'>$nombreCliente</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float" >
                                    <div class="form-line">
                                        <label for="servicio">Servicio</label>
                                        <select class="form-control" id="servicio" name="servicio" onchange="cargarSubservicios();" >
                                            <option value="">Seleccione una opción</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float" >
                                    <div class="form-line">
                                        <label for="subservicio">Subservicio</label>
                                        <select class="form-control" id="subservicio" name="subservicio">
                                            <option value="">Seleccione una opción</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-float" >
                                    <div class="form-line">
                                        <label for="tipoBusqueda">Tipo de busqueda</label>
                                        <select class="form-control" id="tipoBusqueda" name="tipoBusqueda" onchange="filtroBusqueda()" style="width: 100%; border: none;" >
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Por fecha de visita</option>
                                            <option value="2">Por fecha recolección de doctos.</option>
                                            <option value="3">Por fecha OM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <label for="rfcUser">Fecha inicial</label>
                                        <input type="date" oninput="filtroBusqueda()" id="fInicial" name="fInicial" class="form-control"  />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <label for="fFinal">Fecha Final</label>
                                        <input type="date" oninput="filtroBusqueda()" id="fFinal" name="fFinal" class="form-control"  />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">


                            <div class="col-md-offset-3 col-md-3">

                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <label for="nombreEstado">Estado</label>
                                        <select id="nombreEstado" name="nombreEstado" class="form-control" onChange="cambiarEstado()">
                                            <option value="">Seleccionar Estado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" style="margin-bottom: 0px;">
                                    <div class="form-line">
                                        <label for="nombreMunicipio">Municipio </label>
                                        <select id="nombreMunicipio" name="nombreMunicipio" class="form-control" onchange="filtroBusqueda();">
                                            <option value="">Seleccione un municipio</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4" align="center">
                                <button onclick="cargarSeguimientoDocumental();" class="btn bg-red ">Actualizar</button>
                            </div>
                        </div>
                        <div class="row table-responsive" id="contenedorTabla">
                            <table class="table table-hover" id="tabla-otis" >
                                <thead>
                                <tr>

                                </tr>
                                </thead>
                                <tbody id="resul">

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <table style="display: none;" id="tablaExcel"></table>
    <div class="modal fade" id="myModalAnalistasAsignados" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Analistas asignados</h4>
                </div>
                <div class="modal-body">
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Fecha de visita</th>
                                <th>Nombre del analista</th>
                            </tr>
                            </thead>
                            <tbody id="datosAnalistasFechas">

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
</section>
<script>

    var porcentajesAsignacion;
    var porcentajes;
    let serverResponse;
    function establecerCumplimiento(columna, idAsignacion, cumplimiento)
    {

        if(porcentajesAsignacion[idAsignacion])
        {

            if(porcentajesAsignacion[idAsignacion][columna])
            {

                porcentajesAsignacion[idAsignacion][columna].cumple=cumplimiento;

            }
        }
    }
</script>
<script type="text/javascript">


    window.onload=inicio;
    let tableData;
    let currentPage;
    function inicio()
    {
        currentPage=0;
        traerEstado();
    }
    let urlFinal="";


    function getporcentajeValor()
    {

        let tipoBusqueda=$("#tipoBusqueda").val();
        let fIni=$("#fInicial").val();
        let fFinal=$("#fFinal").val();
        let municipio=$("#nombreMunicipio").val();
        let estado=$("#nombreEstado").val();

        urlFinal="<?=site_url('CrudSeguimiento/getConsultaTablaSeguimiento/')?>";
        urlFinal+=(fIni)?fIni:"1800-01-01";
        urlFinal+="/";
        urlFinal+=(fFinal)?fFinal:"2032-12-31";
        urlFinal+="/";
        urlFinal+=(municipio)?municipio:"0";
        urlFinal+="/";
        urlFinal+=(estado)?estado:"0";
        urlFinal+="/";
        urlFinal+=(tipoBusqueda)?tipoBusqueda:"0";
        let columnasAutorizadas;
        $.ajax({
            url: urlFinal,
            dataType:'JSON',
            data: {idCliente: $("#idCliente").val(), idServicioSubservicio: $("#subservicio").val()},
            type: 'POST',
            success: function (JSONReturn) {

                serverResponse=JSONReturn;

                let data=serverResponse[0];
                columnasAutorizadas=serverResponse[1];
                porcentajes=serverResponse[2];
                //const porcentajeOriginal=serverResponse[2];
                $("#contenedorTabla").html(' ' +
                    '<table class="table table-hover" id="tabla-otis" >' +
                    '   <thead>' +
                    '   <tr>' +
                    '   <th nombreColumna="" autorizado="true" style="display: none">Asignacion</th>' +
                    '   <th nombreColumna="Det" autorizado="true">Det</th>' +
                    '   <th nombreColumna="Nombre" autorizado="true">Nombre</th>' +
                    '   <th nombreColumna="Formato" autorizado="true">Formato</th>' +
                    '   <th nombreColumna="Municipio" autorizado="true">Municipio</th>' +
                    '   <th nombreColumna="Estado" autorizado="true">Estado</th>' +
                    '   <th nombreColumna="Ejecutiva de cuenta" >Ejecutiva de cuenta</th>' +
                    '   <th nombreColumna="Tipo de trámite" >Tipo de trámite</th>' +
                    '   <th nombreColumna="Inicio de operaciones (OTI)" >Inicio de operaciones (OTI)</th>' +
                    '   <th nombreColumna="Fecha de envío de oportunidad de mejora" >Fecha de envío de oportunidad de mejora </th>' +
                    '   <th nombreColumna="Reporte de visita (OM) %" >Reporte de visita (OM) % </th>' +
                    '   <th nombreColumna="Fecha de visita" >Fecha de visita</th>' +
                    '   <th nombreColumna="No. total de visitas">No. total de visitas</th>' +
                    '   <th nombreColumna="Recolección de información">Recolección de información</th>' +
                    '   <th nombreColumna="Capacitación" >Capacitación</th>' +
                    '   <th nombreColumna="Analistas">Analistas</th>' +
                    '   <th nombreColumna="%C.Visitas">% C. Visitas</th>' +
                    '   <th nombreColumna="Analistas2">Analistas2</th>' +
                    '   <th nombreColumna="% Estatus">% Estatus</th>' +
                    '   <th nombreColumna="% documental">% documental</th>' +
                    '   <th nombreColumna="% C. OM.">% C. OM.</th>' +
                    '   <th nombreColumna="Analista El.">Analista El.</th>' +
                    '   <th nombreColumna="F. U. Actualización">F. U. Actualización</th>' +
                    '   <th nombreColumna="E./Programa %">E./Programa %</th>' +
                    '   <th nombreColumna="Entrega/Muni.">Entrega/Muni.</th>' +
                    '   <th nombreColumna="T./Entrega">T./Entrega</th>' +
                    '   <th nombreColumna="No. Visitas">No. Visitas</th>' +
                    '   <th nombreColumna="Vencimiento municipal">Vencimiento municipal</th>' +
                    '   <th nombreColumna="%Vo.Bo.Mun. Obtenido">%Vo.Bo.Mun. Obtenido</th>' +
                    '   <th nombreColumna="Programación de entrega">Programación de entrega</th>' +
                    '   <th nombreColumna="%Entrega PEPC Municipal">%Entrega PEPC Municipal</th>' +
                    '   <th nombreColumna="Vencimiento estatal">Vencimiento estatal</th>' +
                    '   <th nombreColumna="%Vo.Bo. Est. Obtenido">%Vo.Bo. Est. Obtenido </th>' +
                    '   <th nombreColumna="Entrega para actualización estatal">Entrega para actualización estatal</th>' +
                    '   <th nombreColumna="Tipo de entrega (2)">Tipo de entrega (2)</th>' +
                    '   <th nombreColumna="%Entrega PEPC Estatal">%Entrega PEPC Estatal</th>' +
                    '   <th nombreColumna="Entrega copia tienda">Entrega copia tienda </th>' +
                    '   <th nombreColumna="Fecha de entrega prichos">Fecha de entrega prichos</th>' +
                    '   <th nombreColumna="% Entrega Prichos">% Entrega Prichos</th>' +
                    '   <th nombreColumna="Fecha de entrega anexo navideño">Fecha de entrega anexo navideño</th>' +
                    '   <th nombreColumna="% Entrega anexo navideño">% Entrega anexo navideño</th>' +
                    '   <th nombreColumna="Preventiva">Preventiva</th>' +
                    '   <th nombreColumna="% Avance 3">% Avance 3</th>' +



                    //PLAN DE EMERGENCIA
                    '   <th nombreColumna="Elaboracion del plan de emergencia" >Elaboración del plan de emergencia</th>' +
                    '   <th nombreColumna="Cumplimiento PPC%" >Cumplimiento PPC%</th>' +
                    '   <th nombreColumna="Integración del plan de emergencia" >Integración del plan de emergencia</th>' +
                    '   <th nombreColumna="Cumplimiento de integración" >Cumplimiento de integración</th>' +
                    '   <th nombreColumna="Fecha de ingreso a trámite" >Fecha de ingreso a trámite</th>' +
                    '   <th nombreColumna="Responsable del ingreso a trámite" >Responsable del ingreso a trámite</th>' +
                    '   <th nombreColumna="Cumplimiento ingreso trámite %" >Cumplimiento ingreso trámite %</th>' +
                    '   <th nombreColumna="Entrega copia cliente" >Entrega copia cliente</th>' +
                    '   <th nombreColumna="Seguimiento a trámite" >Seguimiento a trámite</th>' +
                    '   <th nombreColumna="No. de seguimientos realizados a trámite" >No. de seguimientos realizados a trámite</th>' +
                    '   <th nombreColumna="Responsable del seguimiento a trámite" >Responsable del seguimiento a trámite</th>' +
                    '   <th nombreColumna="Cumplimiento del seguimiento a trámite %" >Cumplimiento del seguimiento a trámite %</th>' +
                    '   <th nombreColumna="Obtención de Vo.Bo." >Obtención de Vo.Bo.</th>' +
                    '   <th nombreColumna="Cumplimiento Vo.Bo." >Cumplimiento Vo.Bo.</th>' +

                    //FIN DE PLAN DE EMERGENCIA

                    //ARV
                    '   <th nombreColumna="Reunión plan de trabajo interno">Reunión plan de trabajo interno</th>' +
                    '   <th nombreColumna="Cumplimiento plan de trabajo interno %">Cumplimiento plan de trabajo interno %</th>' +
                    '   <th nombreColumna="Presentación esquema de arv">Presentación esquema de arv</th>' +
                    '   <th nombreColumna="Presentación esquema de arv %">Presentación esquema de arv %</th>' +
                    '   <th nombreColumna="inspección físicaARV">Inspección física</th>' +
                    '   <th nombreColumna="Cumplimiento inspección física %">Cumplimiento inspección física %</th>' +
                    '   <th nombreColumna="Recolección de información ARV">Recolección de información </th>' +
                    '   <th nombreColumna="Recolección de información %">Recolección de información %</th>' +
                    '   <th nombreColumna="Elaboración arv">Elaboración arv</th>' +
                    '   <th nombreColumna="Elaboración arv %">Elaboración arv %</th>' +
                    '   <th nombreColumna="Revisión interna de calidad">Revisión interna de calidad</th>' +
                    '   <th nombreColumna="Revisión interna de calidad %">Revisión interna de calidad %</th>' +
                    '   <th nombreColumna="Integración física carpeta">Integración física carpeta</th>' +
                    '   <th nombreColumna="Integración física carpeta%">Integración física carpeta %</th>' +
                    '   <th nombreColumna="Presentación al cliente/autoridad">Presentación al cliente/autoridad</th>' +
                    '   <th nombreColumna="Entrega al cliente %">Entrega al cliente %</th>' +
                    '   <th nombreColumna="Entrega al cliente">Entrega al cliente</th>' +
                    '   <th nombreColumna="Fecha de seguimiento realizado" >Fecha de seguimiento realizado</th>' +
                    '   <th nombreColumna="No. De segimiento s realizados">No. de seguimientos realizados</th>' +
                    '   <th nombreColumna="Responsable de seguimiento">Responsable de seguimiento</th>' +
                    '   <th nombreColumna="Seguimiento %">Seguimiento %</th>' +
                    '   <th nombreColumna="Obtención visto bueno">Obtención visto bueno</th>' +
                    '   <th nombreColumna="Obtención visto bueno %" >Obtención visto bueno %</th>' +
                    //FIN DE ARV
                    //SEG VISITA
                    '   <th nombreColumna="Visita Seguimiento">Seguimiento</th>' +
                    '   <th nombreColumna="Visita Seguimiento%" >Seguimiento %</th>' +
                    //FIN DE SEG VISITA
                    //SEG PLAN CONT
                    '   <th nombreColumna="Plan Cont Reunión plan de trabajo interno">Reunión plan de trabajo interno</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento plan de trabajo interno %" >Cumplimiento plan de trabajo interno %</th>' +
                    '   <th nombreColumna="Plan Cont Recolección de información" >Recolección de información</th>' +
                    '   <th nombreColumna="Plan Cont Recolección de información %" >Recolección de información %</th>' +
                    '   <th nombreColumna="Plan Cont Inspección física" >Inspección física</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento inspección física %" >Cumplimiento inspección física %</th>' +
                    '   <th nombreColumna="Plan Cont Reporte OM" >Reporte OM</th>' +
                    '   <th nombreColumna="Plan Cont Reporte OM %" >Reporte OM %</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento plan continuidad" >Cumplimiento plan continuidad</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento plan continuidad %" >Cumplimiento plan continuidad %</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento de integración" >Cumplimiento de integración</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento de integración %" >Cumplimiento de integración %</th>' +
                    '   <th nombreColumna="Plan Cont Revisión interna de calidad" >Revisión interna de calidad</th>' +
                    '   <th nombreColumna="Plan Cont Revisión interna de calidad %" >Revisión interna de calidad %</th>' +
                    '   <th nombreColumna="Plan Cont Presentación al cliente/autoridad" >Presentación al cliente/autoridad</th>' +
                    '   <th nombreColumna="Plan Cont Presentación %" >Presentación %</th>' +
                    //FIN DE SEG PLAN CONT
                    //SEG SIMU
                    '   <th nombreColumna="SIMU Reunión plan de trabajo interno" >Reunión plan de trabajo interno</th>' +
                    '   <th nombreColumna="SIMU Cumplimiento plan de trabajo interno %" >Cumplimiento plan de trabajo interno %</th>' +
                    '   <th nombreColumna="SIMU Presentación plan de trabajo" >Presentación plan de trabajo</th>' +
                    '   <th nombreColumna="SIMU Presentación plan de trabajo %" >Presentación plan de trabajo %</th>' +
                    '   <th nombreColumna="SIMU Recolección de información" >Recolección de información</th>' +
                    '   <th nombreColumna="SIMU Recolección de información %" >Recolección de información %</th>' +
                    '   <th nombreColumna="SIMU Reunión programación con cliente" >Reunión programación con cliente</th>' +
                    '   <th nombreColumna="SIMU Reunión programación con cliente %" >Reunión programación con cliente %</th>' +
                    '   <th nombreColumna="SIMU Programación y logística interna" >Programación y logística interna</th>' +
                    '   <th nombreColumna="SIMU Programación y logística interna %" >Programación y logística interna %</th>' +
                    '   <th nombreColumna="SIMU Elaboración de simulacro" >Elaboración de simulacro</th>' +
                    '   <th nombreColumna="SIMU Elaboración de simulacro %" >Elaboración de simulacro %</th>' +
                    '   <th nombreColumna="SIMU Revisión de calidad interna" >Revisión de calidad interna</th>' +
                    '   <th nombreColumna="SIMU Revisión de calidad interna %" >Revisión de calidad interna %</th>' +
                    '   <th nombreColumna="SIMU Entrega reporte y evidencias" >Entrega reporte y evidencias</th>' +
                    '   <th nombreColumna="SIMU Entrega reporte y evidencias%" >Entrega reporte y evidencias%</th>' +
                    //FIN DE SEG SIMU
                    //SEG MOD3D
                    '   <th nombreColumna="MOD3D Reunión plan de trabajo interno" >Reunión plan de trabajo interno</th>' +
                    '   <th nombreColumna="MOD3D Cumplimiento plan de trabajo interno %" >Cumplimiento plan de trabajo interno %</th>' +
                    '   <th nombreColumna="MOD3D Recolección de información" >Recolección de información</th>' +
                    '   <th nombreColumna="MOD3D Recolección de información%" >Recolección de información %</th>' +
                    '   <th nombreColumna="MOD3D Visita de inspección" >Visita de inspección</th>' +
                    '   <th nombreColumna="MOD3D Visita de inspección %" >Visita de inspección %</th>' +
                    '   <th nombreColumna="MOD3D Confirmación planos" >Confirmación planos</th>' +
                    '   <th nombreColumna="MOD3D Confirmación de planos %" >MOD3D Confirmación planos %</th>' +
                    '   <th nombreColumna="MOD3D Elaboración planos 3d" >MOD3D Elaboración planos 3D</th>' +
                    '   <th nombreColumna="MOD3D Elaboración planos 3d %" >MOD3D Elaboración planos 3D %</th>' +
                    '   <th nombreColumna="MOD3D Simulación" >MOD3D Simulación</th>' +
                    '   <th nombreColumna="MOD3D Simulación %" >MOD3D Simulación %</th>' +
                    '   <th nombreColumna="MOD3D Revisión técnica" >MOD3D Revisión técnica</th>' +
                    '   <th nombreColumna="MOD3D Revisión técnica %" >MOD3D Revisión técnica %</th>' +
                    '   <th nombreColumna="MOD3D Entrega resultados y video" >MOD3D Entrega resultados y video</th>' +
                    '   <th nombreColumna="MOD3D Entrega resultados y video %" >MOD3D Entrega resultados y video %</th>' +
                    '   <th nombreColumna="MOD3D Redacción informe" >MOD3D Redacción informe</th>' +
                    '   <th nombreColumna="MOD3D Redacción informe %" >MOD3D Redacción informe %</th>' +
                    '   <th nombreColumna="MOD3D Formulación conclusiones" >MOD3D Formulación conclusiones</th>' +
                    '   <th nombreColumna="MOD3D Formulación conclusiones %" >MOD3D Formulación conclusiones %</th>' +
                    '   <th nombreColumna="MOD3D Revisión de calidad interna" >MOD3D Revisión de calidad interna</th>' +
                    '   <th nombreColumna="MOD3D Revisión de calidad interna %" >MOD3D Revisión de calidad interna %</th>' +
                    '   <th nombreColumna="MOD3D Entrega cliente" >MOD3D Entrega cliente</th>' +
                    '   <th nombreColumna="MOD3D Entrega cliente %" >MOD3D Entrega cliente %</th>' +

                    //FIN DE SEG MOD3D
                    //SEG COPIAS
                    '   <th nombreColumna="Copias Fecha de entrega requerida" >Fecha de entrega requerida</th>' +
                    '   <th nombreColumna="Copias No. Carpetas solicitadas" >No. Carpetas solicitadas</th>' +
                    '   <th nombreColumna="Copias Fecha de entrega al cliente" >Fecha de entrega al cliente</th>' +
                    '   <th nombreColumna="Copias Cumplimiento de entrega %" >Cumplimiento de entrega %</th>' +
                    '   <th nombreColumna="Copias Revisión de calidad" >Revisión de calidad</th>' +
                    '   <th nombreColumna="Copias Revisión de calidad %" >Revisión de calidad %</th>' +
                    //FIN DE SEG COPIAS
                    //SEG PLANOS
                    '   <th nombreColumna="Planos Cumplimiento de visita" >Cumplimiento de visita</th>' +
                    '   <th nombreColumna="Planos Cumplimiento de visita %" >Cumplimiento de visita %</th>' +
                    '   <th nombreColumna="Planos Elaboración de plano" >Elaboración de plano</th>' +
                    '   <th nombreColumna="Planos Elaboración de plano %" >Elaboración de plano %</th>' +
                    '   <th nombreColumna="Planos Revisión de calidad interna" >Revisión de calidad interna</th>' +
                    '   <th nombreColumna="Planos Revisión de calidad interna %" >Revisión de calidad interna %</th>' +
                    '   <th nombreColumna="Planos Entrega cliente interno/ externo" >Entrega cliente interno/externo</th>' +
                    '   <th nombreColumna="Planos Entrega cliente interno/ externo%" >Entrega cliente interno/externo %</th>' +
                    //FIN DE SEG PLANOS
                    //SEG PPC MUN
                    '   <th nombreColumna="PPC MUN Integración del programa" >PPC MUN Integración del programa</th>' +
                    '   <th nombreColumna="PPC MUN Cumplimiento de integración %" >PPC MUN Cumplimiento de integración %</th>' +
                    '   <th nombreColumna="PPC MUN Fecha de ingreso municipal/alcaldía" >PPC MUN Fecha de ingreso municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN Responsable del ingreso municipal/alcaldía" >PPC MUN Responsable del ingreso municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN Cumplimiento ingreso municipal/alcaldía %" >PPC MUN Cumplimiento ingreso municipal/alcaldía %</th>' +
                    '   <th nombreColumna="PPC MUN Entrega copia cliente" >PPC MUN Entrega copia cliente</th>' +
                    '   <th nombreColumna="PPC MUN Seguimiento a trámite municipal/alcaldía" >PPC MUN Seguimiento a trámite municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN No. De seguimientos realizados municipal/alcaldía" >PPC MUN No. de seguimientos realizados municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN Responsable del seguimiento municipal/alcaldía" >PPC MUN Responsable del seguimiento municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN Cumplimiento del seguimiento municipal %" >PPC MUN Cumplimiento del seguimiento municipal %</th>' +
                    '   <th nombreColumna="PPC MUN Respuesta a preventiva municipal" >PPC MUN Respuesta a preventiva municipal</th>' +
                    '   <th nombreColumna="PPC MUN Responsable respuesta preventiva municipal" >PPC MUN Responsable respuesta preventiva municipal</th>' +
                    '   <th nombreColumna="PPC MUN Respuesta autoridad trámite municipal %" >PPC MUN Respuesta autoridad trámite municipal %</th>' +
                    '   <th nombreColumna="PPC MUN Seguimiento preventiva municipal" >PPC MUN Seguimiento preventiva municipal</th>' +
                    '   <th nombreColumna="PPC MUN No. de veces de seguimiento municipal" >PPC MUN No. de veces de seguimiento municipal</th>' +
                    //FIN DE PPC MUN
                    //SEG PPC EST
                    '   <th nombreColumna="PPC EST Integración del programa" >PPC EST Integración del programa</th>' +
                    '   <th nombreColumna="PPC EST Cumplimiento de integración %" >PPC EST Cumplimiento de integración %</th>' +
                    '   <th nombreColumna="PPC EST Fecha de ingreso estatal" >PPC EST Fecha de ingreso estatal</th>' +
                    '   <th nombreColumna="PPC EST Responsable del ingreso estatal" >PPC EST Responsable del ingreso estatal</th>' +
                    '   <th nombreColumna="PPC EST Cumplimiento ingreso estatal %" >PPC EST Cumplimiento ingreso estatal %</th>' +
                    '   <th nombreColumna="PPC EST Entrega copia cliente" >PPC EST Entrega copia cliente</th>' +
                    '   <th nombreColumna="PPC EST Seguimiento a trámite estatal" >PPC EST Seguimiento a trámite estatal</th>' +
                    '   <th nombreColumna="PPC EST No. De seguimientos realizados estatal" >PPC EST No. De seguimientos realizados estatal</th>' +
                    '   <th nombreColumna="PPC EST Responsable del seguimiento estatal" >PPC EST Responsable del seguimiento estatal</th>' +
                    '   <th nombreColumna="PPC EST Cumplimiento del seguimiento estatal %" >PPC EST Cumplimiento del seguimiento estatal %</th>' +
                    '   <th nombreColumna="PPC EST Respuesta a preventiva estatal" >PPC EST Respuesta a preventiva estatal</th>' +
                    '   <th nombreColumna="PPC EST Responsable respuesta preventiva estatal" >PPC EST Responsable respuesta preventiva estatal</th>' +
                    '   <th nombreColumna="PPC EST Respuesta  autoridad trámite estatal %" >PPC EST Respuesta  autoridad trámite estatal %</th>' +
                    '   <th nombreColumna="PPC EST Seguimiento preventivo estatal" >PPC EST Seguimiento preventivo estatal</th>' +
                    '   <th nombreColumna="PPC EST No. De veces de seguimiento estatal" >PPC EST No. De veces de seguimiento estatal</th>' +
                    //FIN DE PPC EST

                    //SUMA DE PORCENTAJES
                    '   <th nombreColumna="Observaciones">Observaciones</th>' +
                    '   <th nombreColumna="% Cumplimiento municipal">% Cumplimiento municipal</th>' +
                    '   <th nombreColumna="% Cumplimiento estatal">% Cumplimiento estatal</th>' +
                    '   <th nombreColumna="Sumatoria PPC MUN">Sumatoria PPC MUN</th>'+
                    '   <th nombreColumna="Sumatoria PPC EST">Sumatoria PPC EST</th>'+
                    '   <th nombreColumna="Cumplimiento proceso plan de emergencia" >Cumplimiento proceso plan de emergencia</th>' +
                    '   <th nombreColumna="Sumatoria ARV">Sumatoria ARV</th>'+
                    '   <th nombreColumna="Sumatoria Plan Cont">Sumatoria Plan Cont</th>'+
                    '   <th nombreColumna="Sumatoria SIMU">Sumatoria SIMU</th>'+
                    '   <th nombreColumna="Sumatoria MOD3D">Sumatoria MOD3D</th>'+
                    '   <th nombreColumna="Sumatoria Copias">Sumatoria Copias</th>'+
                    '   <th nombreColumna="Sumatoria Visita">Sumatoria Visita</th>'+
                    '   <th nombreColumna="Sumatoria Planos">Sumatoria Planos</th>'+
                    //FIN DE SUMA DE PORCENTAJES

                    '   </tr>' +
                    '   </thead>' +
                    '   <tbody id="resul"></tbody>' +
                    '   <tfoot>' +
                    '   <tr>' +
                    '   <th nombreColumna="" autorizado="true" style="display: none">Asignacion</th>' +
                    '   <th nombreColumna="Det" autorizado="true">Det</th>' +
                    '   <th nombreColumna="Nombre" autorizado="true">Nombre</th>' +
                    '   <th nombreColumna="Formato" autorizado="true">Formato</th>' +
                    '   <th nombreColumna="Municipio" autorizado="true">Municipio</th>' +
                    '   <th nombreColumna="Estado" autorizado="true">Estado</th>' +
                    '   <th nombreColumna="Ejecutiva de cuenta" >Ejecutiva de cuenta</th>' +
                    '   <th nombreColumna="Tipo de trámite" >Tipo de trámite</th>' +
                    '   <th nombreColumna="Inicio de operaciones (OTI)" >Inicio de operaciones (OTI)</th>' +
                    '   <th nombreColumna="Fecha de envío de oportunidad de mejora" >Fecha de envío de oportunidad de mejora</th>' +
                    '   <th nombreColumna="Reporte de visita (OM) %" >Reporte de visita (OM) %</th>' +
                    '   <th nombreColumna="Fecha de visita" >Fecha de visita</th>' +
                    '   <th nombreColumna="No. total de visitas" >No. total de visitas</th>' +
                    '   <th nombreColumna="Recolección de información" >Recolección de información</th>' +
                    '   <th nombreColumna="Capacitación" >Capacitación</th>' +
                    '   <th nombreColumna="Analistas">Analistas</th>' +
                    '   <th nombreColumna="%C.Visitas">% C. Visitas</th>' +
                    '   <th nombreColumna="Analistas2">Analistas2</th>' +
                    '   <th nombreColumna="% Estatus">% Estatus</th>' +
                    '   <th nombreColumna="% documental">% documental</th>' +
                    '   <th nombreColumna="% C. OM.">% C. OM.</th>' +
                    '   <th nombreColumna="Analista El.">Analista El.</th>' +
                    '   <th nombreColumna="F. U. Actualización">F. U. Actualización</th>' +
                    '   <th nombreColumna="E./Programa %">E./Programa %</th>' +
                    '   <th nombreColumna="Entrega/Muni.">Entrega/Muni.</th>' +
                    '   <th nombreColumna="T./Entrega">T./Entrega</th>' +
                    '   <th nombreColumna="No. Visitas">No. Visitas</th>' +
                    '   <th nombreColumna="Vencimiento municipal">Vencimiento municipal</th>' +
                    '   <th nombreColumna="%Vo.Bo.Mun. Obtenido">%Vo.Bo.Mun. Obtenido</th>' +
                    '   <th nombreColumna="Programación de entrega">Programación de entrega</th>' +
                    '   <th nombreColumna="%Entrega PEPC Municipal">%Entrega PEPC Municipal</th>' +
                    '   <th nombreColumna="Vencimiento estatal">Vencimiento estatal</th>' +
                    '   <th nombreColumna="%Vo.Bo. Est. Obtenido">%Vo.Bo. Est. Obtenido </th>' +
                    '   <th nombreColumna="Entrega para actualización estatal">Entrega para actualización estatal</th>' +
                    '   <th nombreColumna="Tipo de entrega (2)">Tipo de entrega (2)</th>' +
                    '   <th nombreColumna="%Entrega PEPC Estatal">%Entrega PEPC Estatal</th>' +
                    '   <th nombreColumna="Entrega copia tienda">Entrega copia tienda </th>' +
                    '   <th nombreColumna="Fecha de entrega prichos">Fecha de entrega prichos</th>' +
                    '   <th nombreColumna="% Entrega Prichos">% Entrega Prichos</th>' +
                    '   <th nombreColumna="Fecha de entrega anexo navideño">Fecha de entrega anexo navideño</th>' +
                    '   <th nombreColumna="% Entrega anexo navideño">% Entrega anexo navideño</th>' +
                    '   <th nombreColumna="Preventiva">Preventiva</th>' +
                    '   <th nombreColumna="% Avance 3">% Avance 3</th>' +



                    //PLAN DE EMERGENCIA
                    '   <th nombreColumna="Elaboracion del plan de emergencia">Elaboración del plan de emergencia</th>' +
                    '   <th nombreColumna="Cumplimiento PPC%">Cumplimiento PPC%</th>' +
                    '   <th nombreColumna="Integración del plan de emergencia">Integración del plan de emergencia</th>' +
                    '   <th nombreColumna="Cumplimiento de integración">Cumplimiento de integración</th>' +
                    '   <th nombreColumna="Fecha de ingreso a trámite">Fecha de ingreso a trámite</th>' +
                    '   <th nombreColumna="Responsable del ingreso a trámite">Responsable del ingreso a trámite</th>' +
                    '   <th nombreColumna="Cumplimiento ingreso trámite %">Cumplimiento ingreso trámite %</th>' +
                    '   <th nombreColumna="Entrega copia cliente">Entrega copia cliente</th>' +
                    '   <th nombreColumna="Seguimiento a trámite">Seguimiento a trámite</th>' +
                    '   <th nombreColumna="No. de seguimientos realizados a trámite">No. de seguimientos realizados a trámite</th>' +
                    '   <th nombreColumna="Responsable del seguimiento a trámite">Responsable del seguimiento a trámite</th>' +
                    '   <th nombreColumna="Cumplimiento del seguimiento a trámite %">Cumplimiento del seguimiento a trámite %</th>' +
                    '   <th nombreColumna="Obtención de Vo.Bo.">Obtención de Vo.Bo.</th>' +
                    '   <th nombreColumna="Cumplimiento Vo.Bo.">Cumplimiento Vo.Bo.</th>' +

                    //FIN DE PLAN DE EMERGENCIA

                    //ARV
                    '   <th nombreColumna="Reunión plan de trabajo interno">Reunión plan de trabajo interno</th>' +
                    '   <th nombreColumna="Cumplimiento plan de trabajo interno %">Cumplimiento plan de trabajo interno %</th>' +
                    '   <th nombreColumna="Presentación esquema de arv">Presentación esquema de arv</th>' +
                    '   <th nombreColumna="Presentación esquema de arv %">Presentación esquema de arv %</th>' +
                    '   <th nombreColumna="inspección físicaARV">Inspección física</th>' +
                    '   <th nombreColumna="Cumplimiento inspección física %">Cumplimiento inspección física %</th>' +
                    '   <th nombreColumna="Recolección de información ARV">Recolección de información </th>' +
                    '   <th nombreColumna="Recolección de información %">Recolección de información %</th>' +
                    '   <th nombreColumna="Elaboración arv">Elaboración arv</th>' +
                    '   <th nombreColumna="Elaboración arv %">Elaboración arv %</th>' +
                    '   <th nombreColumna="Revisión interna de calidad">Revisión interna de calidad</th>' +
                    '   <th nombreColumna="Revisión interna de calidad %">Revisión interna de calidad %</th>' +
                    '   <th nombreColumna="Integración física carpeta">Integración física carpeta</th>' +
                    '   <th nombreColumna="Integración física carpeta%">Integración física carpeta %</th>' +
                    '   <th nombreColumna="Presentación al cliente/autoridad">Presentación al cliente/autoridad</th>' +
                    '   <th nombreColumna="Entrega al cliente %">Entrega al cliente %</th>' +
                    '   <th nombreColumna="Entrega al cliente">Entrega al cliente</th>' +
                    '   <th nombreColumna="Fecha de seguimiento realizado" >Fecha de seguimiento realizado</th>' +
                    '   <th nombreColumna="No. De segimiento s realizados">No. de seguimientos realizados</th>' +
                    '   <th nombreColumna="Responsable de seguimiento">Responsable de seguimiento</th>' +
                    '   <th nombreColumna="Seguimiento %">Seguimiento %</th>' +
                    '   <th nombreColumna="Obtención visto bueno">Obtención visto bueno</th>' +
                    '   <th nombreColumna="Obtención visto bueno %" >Obtención visto bueno %</th>' +
                    //FIN DE ARV
                    //SEG VISITA
                    '   <th nombreColumna="Visita Seguimiento">Seguimiento</th>' +
                    '   <th nombreColumna="Visita Seguimiento%" >Seguimiento %</th>' +
                    //FIN DE SEG VISITA
                    //SEG PLAN CONT
                    '   <th nombreColumna="Plan Cont Reunión plan de trabajo interno">Reunión plan de trabajo interno</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento plan de trabajo interno %" >Cumplimiento plan de trabajo interno %</th>' +
                    '   <th nombreColumna="Plan Cont Recolección de información" >Recolección de información</th>' +
                    '   <th nombreColumna="Plan Cont Recolección de información %" >Recolección de información %</th>' +
                    '   <th nombreColumna="Plan Cont Inspección física" >Inspección física</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento inspección física %" >Cumplimiento inspección física %</th>' +
                    '   <th nombreColumna="Plan Cont Reporte OM" >Reporte OM</th>' +
                    '   <th nombreColumna="Plan Cont Reporte OM %" >Reporte OM %</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento plan continuidad" >Cumplimiento plan continuidad</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento plan continuidad %" >Cumplimiento plan continuidad %</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento de integración" >Cumplimiento de integración</th>' +
                    '   <th nombreColumna="Plan Cont Cumplimiento de integración %" >Cumplimiento de integración %</th>' +
                    '   <th nombreColumna="Plan Cont Revisión interna de calidad" >Revisión interna de calidad</th>' +
                    '   <th nombreColumna="Plan Cont Revisión interna de calidad %" >Revisión interna de calidad %</th>' +
                    '   <th nombreColumna="Plan Cont Presentación al cliente/autoridad" >Presentación al cliente/autoridad</th>' +
                    '   <th nombreColumna="Plan Cont Presentación %" >Presentación %</th>' +
                    //FIN DE SEG PLAN CONT
                    //SEG SIMU
                    '   <th nombreColumna="SIMU Reunión plan de trabajo interno" >Reunión plan de trabajo interno</th>' +
                    '   <th nombreColumna="SIMU Cumplimiento plan de trabajo interno %" >Cumplimiento plan de trabajo interno %</th>' +
                    '   <th nombreColumna="SIMU Presentación plan de trabajo" >Presentación plan de trabajo</th>' +
                    '   <th nombreColumna="SIMU Presentación plan de trabajo %" >Presentación plan de trabajo %</th>' +
                    '   <th nombreColumna="SIMU Recolección de información" >Recolección de información</th>' +
                    '   <th nombreColumna="SIMU Recolección de información %" >Recolección de información %</th>' +
                    '   <th nombreColumna="SIMU Reunión programación con cliente" >Reunión programación con cliente</th>' +
                    '   <th nombreColumna="SIMU Reunión programación con cliente %" >Reunión programación con cliente %</th>' +
                    '   <th nombreColumna="SIMU Programación y logística interna" >Programación y logística interna</th>' +
                    '   <th nombreColumna="SIMU Programación y logística interna %" >Programación y logística interna %</th>' +
                    '   <th nombreColumna="SIMU Elaboración de simulacro" >Elaboración de simulacro</th>' +
                    '   <th nombreColumna="SIMU Elaboración de simulacro %" >Elaboración de simulacro %</th>' +
                    '   <th nombreColumna="SIMU Revisión de calidad interna" >Revisión de calidad interna</th>' +
                    '   <th nombreColumna="SIMU Revisión de calidad interna %" >Revisión de calidad interna %</th>' +
                    '   <th nombreColumna="SIMU Entrega reporte y evidencias" >Entrega reporte y evidencias</th>' +
                    '   <th nombreColumna="SIMU Entrega reporte y evidencias%" >Entrega reporte y evidencias%</th>' +
                    //FIN DE SEG SIMU
                    //SEG MOD3D
                    '   <th nombreColumna="MOD3D Reunión plan de trabajo interno" >Reunión plan de trabajo interno</th>' +
                    '   <th nombreColumna="MOD3D Cumplimiento plan de trabajo interno %" >Cumplimiento plan de trabajo interno %</th>' +
                    '   <th nombreColumna="MOD3D Recolección de información" >Recolección de información</th>' +
                    '   <th nombreColumna="MOD3D Recolección de información%" >Recolección de información %</th>' +
                    '   <th nombreColumna="MOD3D Visita de inspección" >Visita de inspección</th>' +
                    '   <th nombreColumna="MOD3D Visita de inspección %" >Visita de inspección %</th>' +
                    '   <th nombreColumna="MOD3D Confirmación planos" >Confirmación planos</th>' +
                    '   <th nombreColumna="MOD3D Confirmación de planos %" >MOD3D Confirmación planos %</th>' +
                    '   <th nombreColumna="MOD3D Elaboración planos 3d" >MOD3D Elaboración planos 3D</th>' +
                    '   <th nombreColumna="MOD3D Elaboración planos 3d %" >MOD3D Elaboración planos 3D %</th>' +
                    '   <th nombreColumna="MOD3D Simulación" >MOD3D Simulación</th>' +
                    '   <th nombreColumna="MOD3D Simulación %" >MOD3D Simulación %</th>' +
                    '   <th nombreColumna="MOD3D Revisión técnica" >MOD3D Revisión técnica</th>' +
                    '   <th nombreColumna="MOD3D Revisión técnica %" >MOD3D Revisión técnica %</th>' +
                    '   <th nombreColumna="MOD3D Entrega resultados y video" >MOD3D Entrega resultados y video</th>' +
                    '   <th nombreColumna="MOD3D Entrega resultados y video %" >MOD3D Entrega resultados y video %</th>' +
                    '   <th nombreColumna="MOD3D Redacción informe" >MOD3D Redacción informe</th>' +
                    '   <th nombreColumna="MOD3D Redacción informe %" >MOD3D Redacción informe %</th>' +
                    '   <th nombreColumna="MOD3D Formulación conclusiones" >MOD3D Formulación conclusiones</th>' +
                    '   <th nombreColumna="MOD3D Formulación conclusiones %" >MOD3D Formulación conclusiones %</th>' +
                    '   <th nombreColumna="MOD3D Revisión de calidad interna" >MOD3D Revisión de calidad interna</th>' +
                    '   <th nombreColumna="MOD3D Revisión de calidad interna %" >MOD3D Revisión de calidad interna %</th>' +
                    '   <th nombreColumna="MOD3D Entrega cliente" >MOD3D Entrega cliente</th>' +
                    '   <th nombreColumna="MOD3D Entrega cliente %" >MOD3D Entrega cliente %</th>' +

                    //FIN DE SEG MOD3D
                    //SEG COPIAS
                    '   <th nombreColumna="Copias Fecha de entrega requerida" >Fecha de entrega requerida</th>' +
                    '   <th nombreColumna="Copias No. Carpetas solicitadas" >No. carpetas solicitadas</th>' +
                    '   <th nombreColumna="Copias Fecha de entrega al cliente" >Fecha de entrega al cliente</th>' +
                    '   <th nombreColumna="Copias Cumplimiento de entrega %" >Cumplimiento de entrega %</th>' +
                    '   <th nombreColumna="Copias Revisión de calidad" >Revisión de calidad</th>' +
                    '   <th nombreColumna="Copias Revisión de calidad %" >Revisión de calidad %</th>' +
                    //FIN DE SEG COPIAS
                    //SEG PLANOS
                    '   <th nombreColumna="Planos Cumplimiento de visita" >Cumplimiento de visita</th>' +
                    '   <th nombreColumna="Planos Cumplimiento de visita %" >Cumplimiento de visita %</th>' +
                    '   <th nombreColumna="Planos Elaboración de plano" >Elaboración de plano</th>' +
                    '   <th nombreColumna="Planos Elaboración de plano %" >Elaboración de plano %</th>' +
                    '   <th nombreColumna="Planos Revisión de calidad interna" >Revisión de calidad interna</th>' +
                    '   <th nombreColumna="Planos Revisión de calidad interna %" >Revisión de calidad interna %</th>' +
                    '   <th nombreColumna="Planos Entrega cliente interno/ externo" >Entrega cliente interno/externo</th>' +
                    '   <th nombreColumna="Planos Entrega cliente interno/ externo%" >Entrega cliente interno/externo %</th>' +
                    //FIN DE SEG PLANOS
                    //SEG PPC MUN
                    '   <th nombreColumna="PPC MUN Integración del programa" >PPC MUN Integración del programa</th>' +
                    '   <th nombreColumna="PPC MUN Cumplimiento de integración %" >PPC MUN Cumplimiento de integración %</th>' +
                    '   <th nombreColumna="PPC MUN Fecha de ingreso municipal/alcaldía" >PPC MUN Fecha de ingreso municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN Responsable del ingreso municipal/alcaldía" >PPC MUN Responsable del ingreso municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN Cumplimiento ingreso municipal/alcaldía %" >PPC MUN Cumplimiento ingreso municipal/alcaldía %</th>' +
                    '   <th nombreColumna="PPC MUN Entrega copia cliente" >PPC MUN Entrega copia cliente</th>' +
                    '   <th nombreColumna="PPC MUN Seguimiento a trámite municipal/alcaldía" >PPC MUN Seguimiento a trámite municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN No. De seguimientos realizados municipal/alcaldía" >PPC MUN No. de seguimientos realizados municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN Responsable del seguimiento municipal/alcaldía" >PPC MUN Responsable del seguimiento municipal/alcaldía</th>' +
                    '   <th nombreColumna="PPC MUN Cumplimiento del seguimiento municipal %" >PPC MUN Cumplimiento del seguimiento municipal %</th>' +
                    '   <th nombreColumna="PPC MUN Respuesta a preventiva municipal" >PPC MUN Respuesta a preventiva municipal</th>' +
                    '   <th nombreColumna="PPC MUN Responsable respuesta preventiva municipal" >PPC MUN Responsable respuesta preventiva municipal</th>' +
                    '   <th nombreColumna="PPC MUN Respuesta autoridad trámite municipal %" >PPC MUN Respuesta autoridad trámite municipal %</th>' +
                    '   <th nombreColumna="PPC MUN Seguimiento preventiva municipal" >PPC MUN Seguimiento preventiva municipal</th>' +
                    '   <th nombreColumna="PPC MUN No. de veces de seguimiento municipal" >PPC MUN No. de veces de seguimiento municipal</th>' +
                    //FIN DE PPC MUN
                    //SEG PPC EST
                    '   <th nombreColumna="PPC EST Integración del programa" >PPC EST Integración del programa</th>' +
                    '   <th nombreColumna="PPC EST Cumplimiento de integración %" >PPC EST Cumplimiento de integración %</th>' +
                    '   <th nombreColumna="PPC EST Fecha de ingreso estatal" >PPC EST Fecha de ingreso estatal</th>' +
                    '   <th nombreColumna="PPC EST Responsable del ingreso estatal" >PPC EST Responsable del ingreso estatal</th>' +
                    '   <th nombreColumna="PPC EST Cumplimiento ingreso estatal %" >PPC EST Cumplimiento ingreso estatal %</th>' +
                    '   <th nombreColumna="PPC EST Entrega copia cliente" >PPC EST Entrega copia cliente</th>' +
                    '   <th nombreColumna="PPC EST Seguimiento a trámite estatal" >PPC EST Seguimiento a trámite estatal</th>' +
                    '   <th nombreColumna="PPC EST No. De seguimientos realizados estatal" >PPC EST No. De seguimientos realizados estatal</th>' +
                    '   <th nombreColumna="PPC EST Responsable del seguimiento estatal" >PPC EST Responsable del seguimiento estatal</th>' +
                    '   <th nombreColumna="PPC EST Cumplimiento del seguimiento estatal %" >PPC EST Cumplimiento del seguimiento estatal %</th>' +
                    '   <th nombreColumna="PPC EST Respuesta a preventiva estatal" >PPC EST Respuesta a preventiva estatal</th>' +
                    '   <th nombreColumna="PPC EST Responsable respuesta preventiva estatal" >PPC EST Responsable respuesta preventiva estatal</th>' +
                    '   <th nombreColumna="PPC EST Respuesta  autoridad trámite estatal %" >PPC EST Respuesta  autoridad trámite estatal %</th>' +
                    '   <th nombreColumna="PPC EST Seguimiento preventivo estatal" >PPC EST Seguimiento preventivo estatal</th>' +
                    '   <th nombreColumna="PPC EST No. De veces de seguimiento estatal" >PPC EST No. De veces de seguimiento estatal</th>' +
                    //FIN DE PPC EST

                    //SUMA DE PORCENTAJES
                    '   <th nombreColumna="Observaciones">Observaciones</th>' +
                    '   <th nombreColumna="% Cumplimiento municipal">% Cumplimiento municipal</th>' +
                    '   <th nombreColumna="% Cumplimiento estatal">% Cumplimiento estatal</th>' +
                    '   <th nombreColumna="Sumatoria PPC MUN">Sumatoria PPC MUN</th>'+
                    '   <th nombreColumna="Sumatoria PPC EST">Sumatoria PPC EST</th>'+
                    '   <th nombreColumna="Cumplimiento proceso plan de emergencia">Cumplimiento proceso plan de emergencia</th>' +
                    '   <th nombreColumna="Sumatoria ARV">Sumatoria ARV</th>'+
                    '   <th nombreColumna="Sumatoria Plan Cont">Sumatoria Plan Cont</th>'+
                    '   <th nombreColumna="Sumatoria SIMU">Sumatoria SIMU</th>'+
                    '   <th nombreColumna="Sumatoria MOD3D">Sumatoria MOD3D</th>'+
                    '   <th nombreColumna="Sumatoria Copias">Sumatoria Copias</th>'+
                    '   <th nombreColumna="Sumatoria Visita">Sumatoria Visita</th>'+
                    '   <th nombreColumna="Sumatoria Planos">Sumatoria Planos</th>'+
                    //FIN DE SUMA DE PORCENTAJES

                    '   </tr>' +
                    '   </tfoot>' +
                    '</table>');

                porcentajesAsignacion={};

                for (let i = 0; i < data.length; i++)
                {
                    let idAsignacion=parseInt(data[i]['idAsignacion']);
                    porcentajesAsignacion[idAsignacion]=serverResponse[2];
                    porcentajesAsignacion[idAsignacion]=JSON.parse(JSON.stringify(serverResponse[2]));


                    $("#resul").append(' ' +
                        '<tr>'+
                        '<td nombreColumna="" autorizado="true" style="display: none">'+data[i]['idAsignacion']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['idDet']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['nombre']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['razonSocial']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['nombreMunicipio']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['nombreEstado']+'</td>'+
                        '<td nombreColumna="Ejecutiva de cuenta" >'+data[i]['nomContacto']+'</td>'+
                        '<td nombreColumna="Tipo de trámite" >'+data[i]['nombreTramite']+'</td>'+
                        '<td nombreColumna="Inicio de operaciones (OTI)" >'+data[i]['fechaSolicitud']+'</td>'+
                        '<td nombreColumna="Fecha de envío de oportunidad de mejora" >'+((data[i]['FechaEnvioCorreoOM'])?data[i]['FechaEnvioCorreoOM']:"")+'</td>'+
                        '<td nombreColumna="Reporte de visita (OM) %"  id="reporteVisitaOM'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Fecha de visita" >'+((data[i]['fechaVisitaNormal'])?data[i]['fechaVisitaNormal']:"")+'</td>'+
                        '<td nombreColumna="No. total de visitas" >'+((data[i]['numeroVisitasTotales'])?data[i]['numeroVisitasTotales']:"")+'</td>'+
                        '<td nombreColumna="Recolección de información"  id="recoleccion'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Capacitación">'+((data[i]['capacitacion']=='1')?'Si':((data[i]['capacitacion']=='2')?'No':'N/A'))+'</td>'+
                        '<td nombreColumna="Analistas"><a href="#" data-toggle="modal" onclick="traerListaAnalistasForm('+idAsignacion+')" data-target="#myModalAnalistasAsignados"><i class="fa fa-users"></i></a></td>'+
                        '<td nombreColumna="%C.Visitas" id="cumpliento'+idAsignacion+'">0 %</td>'+
                        '<td nombreColumna="Analistas2"><a href="#" data-toggle="modal" onclick="traerListaAnalistas('+idAsignacion+')" data-target="#myModalAnalistasAsignados"><i class="fa fa-users"></i></a></td>'+
                        '<td nombreColumna="% Estatus" style="background:#b04632;color:#fff;" id="cumplientoEstatus'+idAsignacion+'">0%</td>'+
                        '<td nombreColumna="% documental" style="background:#b04632;color:#fff;" id="cumplientodocumental'+idAsignacion+'">0%</td>'+
                        '<td nombreColumna="% C. OM." id="cumplientoOM'+idAsignacion+'">0%</td>'+
                        '<td nombreColumna="Analista El." id="anaistaE'+idAsignacion+'"></td>'+
                        '<td nombreColumna="F. U. Actualización" id="fUltima'+idAsignacion+'"></td>'+
                        '<td nombreColumna="E./Programa %" id="elaboProgram'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Entrega/Muni." id="entregaMunic'+idAsignacion+'"></td>'+
                        '<td nombreColumna="T./Entrega" id="tipoEntre'+idAsignacion+'"></td>'+
                        '<td nombreColumna="No. Visitas" id="nVisitas'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Vencimiento municipal" id="vencimientoMunicipal'+idAsignacion+'"></td>'+
                        '<td nombreColumna="%Vo.Bo.Mun. Obtenido" id="VoBoMunObtenido'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Programación de entrega" id="programacionEntrega'+idAsignacion+'"></td>'+
                        '<td nombreColumna="%Entrega PEPC Municipal" id="entregaPEPCMunicipal'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Vencimiento estatal" id="vencimientoEstatal'+idAsignacion+'"></td>'+
                        '<td nombreColumna="%Vo.Bo. Est. Obtenido" id="VoBoEstObtenido'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Entrega para actualización estatal" id="entregaActualizacionEstatal'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Tipo de entrega (2)" id="tipoEntrega2'+idAsignacion+'"></td>'+
                        '<td nombreColumna="%Entrega PEPC Estatal" id="entregaPEPCEstatal'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Entrega copia tienda" id="entregaCopiaTienda'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Fecha de entrega prichos" id="fechaEntregaPrichos'+idAsignacion+'"></td>'+
                        '<td nombreColumna="% Entrega Prichos" id="porcentajeEntregaPrichos'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Fecha de entrega anexo navideño" id="fechaEntregaNavideno'+idAsignacion+'"></td>'+
                        '<td nombreColumna="% Entrega anexo navideño" id="porcentajeEntregaNavideno'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Preventiva" id="preventiva'+idAsignacion+'"></td>'+
                        '<td nombreColumna="% Avance 3" id="porcentajeAvance3'+idAsignacion+'"></td>'+



                        //PLAN DE EMERGENCIA
                        '<td nombreColumna="Elaboracion del plan de emergencia" id="elaboracionPlanEmergencia'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Cumplimiento PPC%" id="cumplimientoPPC'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Integración del plan de emergencia" id="integracionPlanEmergencia'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Cumplimiento de integración" id="cumplimientoIntegracion'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Fecha de ingreso a trámite" id="fechaIngresoTramite'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Responsable del ingreso a trámite" id="responsableIngresoTramite'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Cumplimiento ingreso trámite %" id="cumplimientoIngresoTramite'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Entrega copia cliente" id="entregaCopiaClientePE'+idAsignacion+'" >'+((data[i]["entregaCopiaClientePE"])?data[i]["entregaCopiaClientePE"]:"")+'</td>' +
                        '<td nombreColumna="Seguimiento a trámite" id="seguimientoTramite'+idAsignacion+'" >'+((data[i]["seguimientoTramite"])?data[i]["seguimientoTramite"]:"")+'</td>' +
                        '<td nombreColumna="No. de seguimientos realizados a trámite" id="seguimientosRealizadosATramite'+idAsignacion+'" >'+((data[i]["seguimientosRealizadosATramite"])?data[i]["seguimientosRealizadosATramite"]:"0")+'</td>' +
                        '<td nombreColumna="Responsable del seguimiento a trámite" id="'+idAsignacion+'" >'+((data[i]["responsableSeguimientoTramite"])?data[i]["responsableSeguimientoTramite"]:"")+'</td>' +
                        '<td nombreColumna="Cumplimiento del seguimiento a trámite %" id="PECumplimientoSeguimientoTramite'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Obtención de Vo.Bo." id="obtencionVoBoPlanEmergencia'+idAsignacion+'">'+((data[i]["obtencionVoBoPlanEmergencia"])?data[i]["obtencionVoBoPlanEmergencia"]:"")+'</td>' +
                        '<td nombreColumna="Cumplimiento Vo.Bo." id="cumplimientoVoBoPlanEmergencia'+idAsignacion+'"></td>' +

                        //FIN DE PLAN DE EMERGENCIA

                        //ARV
                        '<td nombreColumna="Reunión plan de trabajo interno" id="reunionPlanTrabajoInterno'+idAsignacion+'" >'+((data[i]["reunionPlanTrabajoInterno"])?data[i]["reunionPlanTrabajoInterno"]:"")+'</td>' +
                        '<td nombreColumna="Cumplimiento plan de trabajo interno %" id="cumplimientoPlanTrabajoInternoARV'+idAsignacion+'" >% menos de un menos de la fecha anterior</td>' +
                        '<td nombreColumna="Presentación esquema de arv" id="presentacionEsquemaArv'+idAsignacion+'" >'+((data[i]["presentacionEsquemaArv"])?data[i]["presentacionEsquemaArv"]:"")+'</td>' +
                        '<td nombreColumna="Presentación esquema de arv %" id="presentacionEsquemaARVPorcentaje'+idAsignacion+'" >% si el campo anterior tiene fecha</td>' +
                        '<td nombreColumna="inspección físicaARV" id="cumplimientoInspeccionFisica'+idAsignacion+'" >'+((data[i]["cumplimientoInspeccionFisica"])?data[i]["cumplimientoInspeccionFisica"]:"")+'</td>' +
                        '<td nombreColumna="Cumplimiento inspección física %" id="cumplimientoInspeccionFisicaPorcentaje'+idAsignacion+'" >% si el campo anterior tiene fecha</td>' +
                        '<td nombreColumna="Recolección de información ARV" id="recoleccionInformacionARV'+idAsignacion+'">'+((data[i]["recoleccionInformacionARV"])?data[i]["recoleccionInformacionARV"]:"")+'</td>' +
                        '<td nombreColumna="Recolección de información %" id="recoleccionInformacion'+idAsignacion+'" >% si el campo anterior tiene fecha</td>' +
                        '<td nombreColumna="Elaboración arv" id="elaboracionARV'+idAsignacion+'" >'+((data[i]["elaboracionARV"])?data[i]["elaboracionARV"]:"")+'</td>' +
                        '<td nombreColumna="Elaboración arv %" id="elaboracionARVPorcentaje'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Revisión interna de calidad" id="revisionInternaCalidad'+idAsignacion+'" >'+((data[i]["revisionInternaCalidad"])?data[i]["revisionInternaCalidad"]:"")+'</td>' +
                        '<td nombreColumna="Revisión interna de calidad %" id="revisionInternaCalidadPorcentaje'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Integración física carpeta" id="integracionFisicaCarpeta'+idAsignacion+'" >'+((data[i]["integracionFisicaCarpeta"])?data[i]["integracionFisicaCarpeta"]:"")+'</td>' +
                        '<td nombreColumna="Integración física carpeta%" id="integracionFisicaCarpetaPorcentaje'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Presentación al cliente/autoridad" id="presentacionClienteAutoridad'+idAsignacion+'" >'+((data[i]["presentacionClienteAutoridad"])?data[i]["presentacionClienteAutoridad"]:"")+'</td>' +
                        '<td nombreColumna="Entrega al cliente %" id="entregaClienteARVPorcentaje'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Entrega al cliente" id="entregaClienteARV'+idAsignacion+'" >'+((data[i]["entregaClienteARV"])?data[i]["entregaClienteARV"]:"")+'</td>' +
                        '<td nombreColumna="Fecha de seguimiento realizado" id="fechaSeguimientoRealizadoARV'+idAsignacion+'" >'+((data[i]["fechaSeguimientoRealizadoARV"])?data[i]["fechaSeguimientoRealizadoARV"]:"")+'</td>' +
                        '<td nombreColumna="No. De segimiento s realizados" id="seguimientosRealizadosARV'+idAsignacion+'" >'+((data[i]["noSeguimientosRealizadosARV"])?data[i]["noSeguimientosRealizadosARV"]:"0")+'</td>' +
                        '<td nombreColumna="Responsable de seguimiento" id="responsableSeguimiento'+idAsignacion+'" >'+((data[i]["responsableSeguimientoARV"])?data[i]["responsableSeguimientoARV"]:"")+'</td>' +
                        '<td nombreColumna="Seguimiento %" id="seguimientoRealizadoARVPorcentaje'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Obtención visto bueno" id="obtencionVistoBuenoARV'+idAsignacion+'" >'+((data[i]["obtencionVistoBuenoARV"])?data[i]["obtencionVistoBuenoARV"]:"")+'</td>' +
                        '<td nombreColumna="Obtención visto bueno %" id="obtencionVistoBuenoARVPorcentaje'+idAsignacion+'" ></td>' +
                        //FIN DE ARV
                        //SEG VISITA
                        '<td nombreColumna="Visita Seguimiento" id="seguimientoSEGVisita'+idAsignacion+'">'+((data[i]["fechaSeguimientoSEGVisita"])?data[i]["fechaSeguimientoSEGVisita"]:"")+'</td>' +
                        '<td nombreColumna="Visita Seguimiento%" id="seguimientoSEGVisitaPorcentaje'+idAsignacion+'" ></td>' +
                        //FIN DE SEG VISITA
                        //SEG PLAN CONT
                        '<td id="planContReunionPlanTrabajoInterno'+idAsignacion+'" nombreColumna="Plan Cont Reunión plan de trabajo interno">'+((data[i]['planContReunionPlanTrabajoInterno'])?data[i]['planContReunionPlanTrabajoInterno']:"")+'</td>' +
                        '<td id="planContReunionPlanTrabajoInternoPorcentaje'+idAsignacion+'" nombreColumna="Plan Cont Cumplimiento plan de trabajo interno %" ></td>' +
                        '<td id="planContRecoleccionInformacion'+idAsignacion+'" nombreColumna="Plan Cont Recolección de información" >'+((data[i]['planContRecoleccionInformacion'])?data[i]['planContRecoleccionInformacion']:"")+'</td>' +
                        '<td id="planContRecoleccionInformacionPorcentaje'+idAsignacion+'" nombreColumna="Plan Cont Recolección de información %" ></td>' +
                        '<td id="planContInspeccionFisica'+idAsignacion+'" nombreColumna="Plan Cont Inspección física" >'+((data[i]['planContInspeccionFisica'])?data[i]['planContInspeccionFisica']:"")+'</td>' +
                        '<td id="planContInspeccionFisicaPorcentaje'+idAsignacion+'" nombreColumna="Plan Cont Cumplimiento inspección física %" ></td>' +
                        '<td id="planContReporteOM'+idAsignacion+'" nombreColumna="Plan Cont Reporte OM" >'+((data[i]['planContReporteOM'])?data[i]['planContReporteOM']:"")+'</td>' +
                        '<td id="planContReporteOMPorcentaje'+idAsignacion+'" nombreColumna="Plan Cont Reporte OM %" ></td>' +
                        '<td id="planContCumplimientoPlanContinuidad'+idAsignacion+'" nombreColumna="Plan Cont Cumplimiento plan continuidad" >'+((data[i]['planContCumplimientoPlanContinuidad'])?data[i]['planContCumplimientoPlanContinuidad']:"")+'</td>' +
                        '<td id="planContCumplimientoPlanContinuidadPorcentaje'+idAsignacion+'" nombreColumna="Plan Cont Cumplimiento plan continuidad %" ></td>' +
                        '<td id="planContCumplimientoIntegracion'+idAsignacion+'" nombreColumna="Plan Cont Cumplimiento de integración" >'+((data[i]['planContCumplimientoIntegracion'])?data[i]['planContCumplimientoIntegracion']:"")+'</td>' +
                        '<td id="planContCumplimientoIntegracionPorcentaje'+idAsignacion+'" nombreColumna="Plan Cont Cumplimiento de integración %" ></td>' +
                        '<td id="planContRevisionInternaCalidad'+idAsignacion+'" nombreColumna="Plan Cont Revisión interna de calidad" >'+((data[i]['planContRevisionInternaCalidad'])?data[i]['planContRevisionInternaCalidad']:"")+'</td>' +
                        '<td id="planContRevisionInternaCalidadPorcentaje'+idAsignacion+'" nombreColumna="Plan Cont Revisión interna de calidad %" ></td>' +
                        '<td id="planContPresentacionClienteAutoridad'+idAsignacion+'" nombreColumna="Plan Cont Presentación al cliente/autoridad" >'+((data[i]['planContPresentacionClienteAutoridad'])?data[i]['planContPresentacionClienteAutoridad']:"")+'</td>' +
                        '<td id="planContPresentacionClienteAutoridadPorcentaje'+idAsignacion+'" nombreColumna="Plan Cont Presentación %" ></td>' +
                        //FIN DE SEG PLAN CONT
                        //SEG SIMU
                        '<td id="simuReunionPlanTrabajoInterno'+idAsignacion+'" nombreColumna="SIMU Reunión plan de trabajo interno" >'+((data[i]['simuReunionPlanTrabajoInterno'])?data[i]['simuReunionPlanTrabajoInterno']:"")+'</td>' +
                        '<td id="simuReunionPlanTrabajoInternoPorcentaje'+idAsignacion+'" nombreColumna="SIMU Cumplimiento plan de trabajo interno %" ></td>' +
                        '<td id="simuPresentacionPlanTrabajo'+idAsignacion+'" nombreColumna="SIMU Presentación plan de trabajo" >'+((data[i]['simuPresentacionPlanTrabajo'])?data[i]['simuPresentacionPlanTrabajo']:"")+'</td>' +
                        '<td id="simuPresentacionPlanTrabajoPorcentaje'+idAsignacion+'" nombreColumna="SIMU Presentación plan de trabajo %" ></td>' +
                        '<td id="simuRecoleccionInformacion'+idAsignacion+'" nombreColumna="SIMU Recolección de información" >'+((data[i]['simuRecoleccionInformacion'])?data[i]['simuRecoleccionInformacion']:"")+'</td>' +
                        '<td id="simuRecoleccionInformacionPorcentaje'+idAsignacion+'" nombreColumna="SIMU Recolección de información %" ></td>' +
                        '<td id="simuReunionProgramacionCliente'+idAsignacion+'" nombreColumna="SIMU Reunión programación con cliente" >'+((data[i]['simuReunionProgramacionCliente'])?data[i]['simuReunionProgramacionCliente']:"")+'</td>' +
                        '<td id="simuReunionProgramacionClientePorcentaje'+idAsignacion+'" nombreColumna="SIMU Reunión programación con cliente %" ></td>' +
                        '<td id="simuProgramacionLogisticaInterna'+idAsignacion+'" nombreColumna="SIMU Programación y logística interna" >'+((data[i]['simuProgramacionLogisticaInterna'])?data[i]['simuProgramacionLogisticaInterna']:"")+'</td>' +
                        '<td id="simuProgramacionLogisticaInternaPorcentaje'+idAsignacion+'" nombreColumna="SIMU Programación y logística interna %" ></td>' +
                        '<td id="simuElaboracionSimulacro'+idAsignacion+'" nombreColumna="SIMU Elaboración de simulacro" >'+((data[i]['simuElaboracionSimulacro'])?data[i]['simuElaboracionSimulacro']:"")+'</td>' +
                        '<td id="simuElaboracionSimulacroPorcentaje'+idAsignacion+'" nombreColumna="SIMU Elaboración de simulacro %" ></td>' +
                        '<td id="simuRevisionCalidadInterna'+idAsignacion+'" nombreColumna="SIMU Revisión de calidad interna" >'+((data[i]['simuRevisionCalidadInterna'])?data[i]['simuRevisionCalidadInterna']:"")+'</td>' +
                        '<td id="simuRevisionCalidadInternaPorcentaje'+idAsignacion+'" nombreColumna="SIMU Revisión de calidad interna %" ></td>' +
                        '<td id="simuEntregaReporteEvidencias'+idAsignacion+'" nombreColumna="SIMU Entrega reporte y evidencias" >'+((data[i]['simuEntregaReporteEvidencias'])?data[i]['simuEntregaReporteEvidencias']:"")+'</td>' +
                        '<td id="simuEntregaReporteEvidenciasPorcentaje'+idAsignacion+'" nombreColumna="SIMU Entrega reporte y evidencias%" ></td>' +
                        //FIN DE SEG SIMU
                        //SEG MOD3D
                        '<td id="mod3dReunionPlanTrabajoInterno'+idAsignacion+'" nombreColumna="MOD3D Reunión plan de trabajo interno" >'+((data[i]['mod3dReunionPlanTrabajoInterno'])?data[i]['mod3dReunionPlanTrabajoInterno']:"")+'</td>' +
                        '<td id="mod3dReunionPlanTrabajoInternoPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Cumplimiento plan de trabajo interno %" ></td>' +
                        '<td id="mod3dRecoleccionInformacion'+idAsignacion+'" nombreColumna="MOD3D Recolección de información" >'+((data[i]['mod3dRecoleccionInformacion'])?data[i]['mod3dRecoleccionInformacion']:"")+'</td>' +
                        '<td id="mod3dRecoleccionInformacionPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Recolección de información%" ></td>' +
                        '<td id="mod3dVisitaInspeccion'+idAsignacion+'" nombreColumna="MOD3D Visita de inspección" >'+((data[i]['mod3dVisitaInspeccion'])?data[i]['mod3dVisitaInspeccion']:"")+'</td>' +
                        '<td id="mod3dVisitaInspeccionPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Visita de inspección %" ></td>' +
                        '<td id="mod3dConfirmacionPlanos'+idAsignacion+'" nombreColumna="MOD3D Confirmación planos" >'+((data[i]['mod3dConfirmacionPlanos'])?data[i]['mod3dConfirmacionPlanos']:"")+'</td>' +
                        '<td id="mod3dConfirmacionPlanosPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Confirmación de planos %" ></td>' +
                        '<td id="mod3dElaboracionPlanos'+idAsignacion+'" nombreColumna="MOD3D Elaboración planos 3d" >'+((data[i]['mod3dElaboracionPlanos'])?data[i]['mod3dElaboracionPlanos']:"")+'</td>' +
                        '<td id="mod3dElaboracionPlanosPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Elaboración planos 3d %" ></td>' +
                        '<td id="mod3dSimulacion'+idAsignacion+'" nombreColumna="MOD3D Simulación" >'+((data[i]['mod3dSimulacion'])?data[i]['mod3dSimulacion']:"")+'</td>' +
                        '<td id="mod3dSimulacionPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Simulación %" ></td>' +
                        '<td id="mod3dRevisionTecnica'+idAsignacion+'" nombreColumna="MOD3D Revisión técnica" >'+((data[i]['mod3dRevisionTecnica'])?data[i]['mod3dRevisionTecnica']:"")+'</td>' +
                        '<td id="mod3dRevisionTecnicaPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Revisión técnica %" ></td>' +
                        '<td id="mod3dEntregaResultadosVideo'+idAsignacion+'" nombreColumna="MOD3D Entrega resultados y video" >'+((data[i]['mod3dEntregaResultadosVideo'])?data[i]['mod3dEntregaResultadosVideo']:"")+'</td>' +
                        '<td id="mod3dEntregaResultadosVideoPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Entrega resultados y video %" ></td>' +
                        '<td id="mod3dRedaccionInforme'+idAsignacion+'" nombreColumna="MOD3D Redacción informe" >'+((data[i]['mod3dRedaccionInforme'])?data[i]['mod3dRedaccionInforme']:"")+'</td>' +
                        '<td id="mod3dRedaccionInformePorcentaje'+idAsignacion+'" nombreColumna="MOD3D Redacción informe %" ></td>' +
                        '<td id="mod3dFormulacionConclusiones'+idAsignacion+'" nombreColumna="MOD3D Formulación conclusiones" >'+((data[i]['mod3dFormulacionConclusiones'])?data[i]['mod3dFormulacionConclusiones']:"")+'</td>' +
                        '<td id="mod3dFormulacionConclusionesPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Formulación conclusiones %" ></td>' +
                        '<td id="mod3dRevisionCalidadInterna'+idAsignacion+'" nombreColumna="MOD3D Revisión de calidad interna" >'+((data[i]['mod3dRevisionCalidadInterna'])?data[i]['mod3dRevisionCalidadInterna']:"")+'</td>' +
                        '<td id="mod3dRevisionCalidadInternaPorcentaje'+idAsignacion+'" nombreColumna="MOD3D Revisión de calidad interna %" ></td>' +
                        '<td id="mod3dEntregaCliente'+idAsignacion+'" nombreColumna="MOD3D Entrega cliente" >'+((data[i]['mod3dEntregaCliente'])?data[i]['mod3dEntregaCliente']:"")+'</td>' +
                        '<td id="mod3dEntregaClientePorcentaje'+idAsignacion+'" nombreColumna="MOD3D Entrega cliente %" ></td>' +
                        //FIN DE SEG MOD3D
                        //SEG COPIAS
                        '<td id="copiasFechaEntrega'+idAsignacion+'" nombreColumna="Copias Fecha de entrega requerida">'+((data[i]['fechaEntrega'])?data[i]['fechaEntrega']:"")+'</td>' +
                        '<td id="copiasCarpetasSolicitadas'+idAsignacion+'" nombreColumna="Copias No. Carpetas solicitadas">'+((data[i]['copiasCarpetasSolicitadas'])?data[i]['copiasCarpetasSolicitadas']:"")+'</td>' +
                        '<td id="copiasFechaEntregaCliente'+idAsignacion+'" nombreColumna="Copias Fecha de entrega al cliente">'+((data[i]['copiasFechaEntregaCliente'])?data[i]['copiasFechaEntregaCliente']:"")+'</td>' +
                        '<td id="copiasCumplimientoEntrega'+idAsignacion+'" nombreColumna="Copias Cumplimiento de entrega %"></td>' +
                        '<td id="copiasRevisionCalidad'+idAsignacion+'" nombreColumna="Copias Revisión de calidad">'+((data[i]['copiasRevisionCalidad'])?data[i]['copiasRevisionCalidad']:"")+'</td>' +
                        '<td id="copiasRevisionCalidadPorcentaje'+idAsignacion+'" nombreColumna="Copias Revisión de calidad %"></td>' +
                        //FIN DE SEG COPIAS
                        //SEG PLANOS
                        '<td id="planosCumplimientoVisita'+idAsignacion+'" nombreColumna="Planos Cumplimiento de visita">'+((data[i]['planosCumplimientoVisita'])?data[i]['planosCumplimientoVisita']:"")+'</td>' +
                        '<td id="planosCumplimientoVisitaPorcentaje'+idAsignacion+'" nombreColumna="Planos Cumplimiento de visita %"></td>' +
                        '<td id="planosElaboracionPlano'+idAsignacion+'" nombreColumna="Planos Elaboración de plano">'+((data[i]['planosElaboracionPlano'])?data[i]['planosElaboracionPlano']:"")+'</td>' +
                        '<td id="planosElaboracionPlanoPorcentaje'+idAsignacion+'" nombreColumna="Planos Elaboración de plano %"></td>' +
                        '<td id="planosRevisionCalidadInterna'+idAsignacion+'" nombreColumna="Planos Revisión de calidad interna">'+((data[i]['planosRevisionCalidadInterna'])?data[i]['planosRevisionCalidadInterna']:"")+'</td>' +
                        '<td id="planosRevisionCalidadInternaPorcentaje'+idAsignacion+'" nombreColumna="Planos Revisión de calidad interna %"></td>' +
                        '<td id="planosEntregaCliente'+idAsignacion+'" nombreColumna="Planos Entrega cliente interno/ externo">'+((data[i]['planosEntregaCliente'])?data[i]['planosEntregaCliente']:"")+'</td>' +
                        '<td id="planosEntregaClientePorcentaje'+idAsignacion+'" nombreColumna="Planos Entrega cliente interno/ externo%"></td>' +
                        //FIN DE SEG PLANOS
                        //SEG PPC MUN
                        '<td id="munIntegracionPrograma'+idAsignacion+'" nombreColumna="PPC MUN Integración del programa" >'+((data[i]['munIntegracionPrograma'])?data[i]['munIntegracionPrograma']:"")+'</td>' +
                        '<td id="munCumplimientoIntegracion'+idAsignacion+'" nombreColumna="PPC MUN Cumplimiento de integración %" ></td>' +
                        '<td id="munFechaIngresoMunicipal'+idAsignacion+'" nombreColumna="PPC MUN Fecha de ingreso municipal/alcaldía" >'+((data[i]['munFechaIngresoMunicipal'])?data[i]['munFechaIngresoMunicipal']:"")+'</td>' +
                        '<td id="munResponsableIngresoMunicipal'+idAsignacion+'" nombreColumna="PPC MUN Responsable del ingreso municipal/alcaldía" >'+((data[i]['munResponsableIngresoMunicipal'])?data[i]['munResponsableIngresoMunicipal']:"")+'</td>' +
                        '<td id="munCumplimientoIngresoMunicipal'+idAsignacion+'" nombreColumna="PPC MUN Cumplimiento ingreso municipal/alcaldía %" ></td>' +
                        '<td id="munEntregaCopiaCliente'+idAsignacion+'" nombreColumna="PPC MUN Entrega copia cliente" >'+((data[i]['munEntregaCopiaCliente'])?data[i]['munEntregaCopiaCliente']:"")+'</td>' +
                        '<td id="munSeguimientoTramiteMunicipal'+idAsignacion+'" nombreColumna="PPC MUN Seguimiento a trámite municipal/alcaldía" >'+((data[i]['munSeguimientoTramiteMunicipal'])?data[i]['munSeguimientoTramiteMunicipal']:"")+'</td>' +
                        '<td id="munSeguimientosRealizadosTramite'+idAsignacion+'" nombreColumna="PPC MUN No. De seguimientos realizados municipal/alcaldía" >'+(data[i]['noSeguimientoTramiteMunicipal'])+'</td>' +
                        '<td id="munResponsableSeguimientoMunicipal'+idAsignacion+'" nombreColumna="PPC MUN Responsable del seguimiento municipal/alcaldía" >'+((data[i]['munResponsableSeguimientoMunicipal'])?data[i]['munResponsableSeguimientoMunicipal']:"")+'</td>' +
                        '<td id="munCumplimientoSeguimientoMunicipal'+idAsignacion+'" nombreColumna="PPC MUN Cumplimiento del seguimiento municipal %" ></td>' +
                        '<td id="munRespuestaPreventiva'+idAsignacion+'" nombreColumna="PPC MUN Respuesta a preventiva municipal">'+((data[i]['munRespuestaPreventiva'])?data[i]['munRespuestaPreventiva']:"")+'</td>' +
                        '<td id="munResponsableRespuestaPreventiva'+idAsignacion+'" nombreColumna="PPC MUN Responsable respuesta preventiva municipal" >'+((data[i]['munResponsableRespuestaPreventiva'])?data[i]['munResponsableRespuestaPreventiva']:"")+'</td>' +
                        '<td id="munRespuestaAutoridadTramite'+idAsignacion+'" nombreColumna="PPC MUN Respuesta autoridad trámite municipal %" ></td>' +
                        '<td id="munSeguimientoPreventivaMunicipal'+idAsignacion+'" nombreColumna="PPC MUN Seguimiento preventiva municipal" >'+((data[i]['munSeguimientoPreventivaMunicipal'])?data[i]['munSeguimientoPreventivaMunicipal']:"")+'</td>' +
                        '<td id="munSeguimientosMunicipales'+idAsignacion+'" nombreColumna="PPC MUN No. de veces de seguimiento municipal" >'+(data[i]['noSeguimientoPreventivaMunicipal'])+'</td>' +
                        //FIN DE PPC MUN
                        //SEG PPC EST
                        '<td id="estIntegracionPrograma'+idAsignacion+'" nombreColumna="PPC EST Integración del programa" >'+((data[i]['estIntegracionPrograma'])?data[i]['estIntegracionPrograma']:"")+'</td>' +
                        '<td id="estCumplimientoIntegracion'+idAsignacion+'" nombreColumna="PPC EST Cumplimiento de integración %" ></td>' +
                        '<td id="estFechaIngresoEstatal'+idAsignacion+'" nombreColumna="PPC EST Fecha de ingreso estatal" >'+((data[i]['estFechaIngresoEstatal'])?data[i]['estFechaIngresoEstatal']:"")+'</td>' +
                        '<td id="estResponsableIngresoEstatal'+idAsignacion+'" nombreColumna="PPC EST Responsable del ingreso estatal" >'+((data[i]['estResponsableIngresoEstatal'])?data[i]['estResponsableIngresoEstatal']:"")+'</td>' +
                        '<td id="estCumplimientoIngresoEstatal'+idAsignacion+'" nombreColumna="PPC EST Cumplimiento ingreso estatal %" ></td>' +
                        '<td id="estEntregaCopiaCliente'+idAsignacion+'" nombreColumna="PPC EST Entrega copia cliente" >'+((data[i]['estEntregaCopiaCliente'])?data[i]['estEntregaCopiaCliente']:"")+'</td>' +
                        '<td id="estSeguimientoTramiteEstatal'+idAsignacion+'" nombreColumna="PPC EST Seguimiento a trámite estatal" >'+((data[i]['estSeguimientoTramiteEstatal'])?data[i]['estSeguimientoTramiteEstatal']:"")+'</td>' +
                        '<td id="estSeguimientosRealizadosTramite'+idAsignacion+'" nombreColumna="PPC EST No. De seguimientos realizados estatal" >'+(data[i]['noSeguimientoTramiteEstatal'])+'</td>' +
                        '<td id="estResponsableSeguimientoEstatal'+idAsignacion+'" nombreColumna="PPC EST Responsable del seguimiento estatal" >'+((data[i]['estResponsableSeguimientoEstatal'])?data[i]['estResponsableSeguimientoEstatal']:"")+'</td>' +
                        '<td id="estCumplimientoSeguimientoEstatal'+idAsignacion+'" nombreColumna="PPC EST Cumplimiento del seguimiento estatal %" ></td>' +
                        '<td id="estRespuestaPreventiva'+idAsignacion+'" nombreColumna="PPC EST Respuesta a preventiva estatal">'+((data[i]['estRespuestaPreventiva'])?data[i]['estRespuestaPreventiva']:"")+'</td>' +
                        '<td id="estResponsableRespuestaPreventiva'+idAsignacion+'" nombreColumna="PPC EST Responsable respuesta preventiva estatal" >'+((data[i]['estResponsableRespuestaPreventiva'])?data[i]['estResponsableRespuestaPreventiva']:"")+'</td>' +
                        '<td id="estRespuestaAutoridadTramite'+idAsignacion+'" nombreColumna="PPC EST Respuesta  autoridad trámite estatal %" ></td>' +
                        '<td id="estSeguimientoPreventivaEstatal'+idAsignacion+'" nombreColumna="PPC EST Seguimiento preventivo estatal" >'+((data[i]['estSeguimientoPreventivaEstatal'])?data[i]['estSeguimientoPreventivaEstatal']:"")+'</td>' +
                        '<td id="estSeguimientosEstatales'+idAsignacion+'" nombreColumna="PPC EST No. De veces de seguimiento estatal" >'+(data[i]['estSeguimientosEstatales'])+'</td>' +
                        //FIN DE PPC EST
                            //SUMATORIAS
                        '<td nombreColumna="Observaciones" id="observaciones'+idAsignacion+'"></td>'+
                        '<td nombreColumna="% Cumplimiento municipal" class="porcentajeFinal'+idAsignacion+'" id="porcentajeCumplimientoMunicipal'+idAsignacion+'"></td>'+
                        '<td nombreColumna="% Cumplimiento estatal" class="porcentajeFinal'+idAsignacion+'" id="porcentajeCumplimientoEstatal'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Sumatoria PPC MUN" class="porcentajeFinal'+idAsignacion+'" id="SumatoriaPPCMUN'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Sumatoria PPC EST" class="porcentajeFinal'+idAsignacion+'" id="SumatoriaPPCEST'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Cumplimiento proceso plan de emergencia" class="porcentajeFinal'+idAsignacion+'" id="cumplimientoProcesoPlanEmergencia'+idAsignacion+'" ></td>' +
                        '<td nombreColumna="Sumatoria ARV" class="porcentajeFinal'+idAsignacion+'" id="SumatoriaARV'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Sumatoria Plan Cont" class="porcentajeFinal'+idAsignacion+'" id="SumatoriaPlanCont'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Sumatoria SIMU" class="porcentajeFinal'+idAsignacion+'" id="SumatoriaSIMU'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Sumatoria MOD3D" class="porcentajeFinal'+idAsignacion+'" id="SumatoriaMOD3D'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Sumatoria Copias" class="porcentajeFinal'+idAsignacion+'" id="SumatoriaCopias'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Sumatoria Visita" class="porcentajeFinal'+idAsignacion+'" id="SumatoriaVisita'+idAsignacion+'"></td>'+
                        '<td nombreColumna="Sumatoria Planos" class="porcentajeFinal'+idAsignacion+'" id="SumatoriaPlanos'+idAsignacion+'"></td>'+
                        '</tr>');


                    var cVisitas=data[i]['CVisitas'];
                    $("#cumpliento"+idAsignacion).html(cVisitas+' %');

                    $("#cumplientoOM"+idAsignacion).html(cVisitas+' %');


                    $("#entregaMunic"+idAsignacion).html(data[i]['fechaEntrega']);
                    $("#recoleccion"+idAsignacion).html(data[i]['fechaAgenda']);
                    var porcentajedoctal=data[i]['porcentajeHistorico'];
                    if (porcentajedoctal<=80)
                    {
                        porcentajedoctal="0 %";
                        //#b04632 rojo
                        $("#cumplientodocumental"+idAsignacion).attr('style','background:#b04632;color:#fff;');
                    }
                    if (porcentajedoctal>80)
                    {

                        porcentajedoctal="20%";
                        //#5aac44;
                        $("#cumplientodocumental"+idAsignacion).attr('style','background:#e8c14c;');
                    }
                    if (data[i]['porcentajeHistorico']>=0 && data[i]['porcentajeHistorico']<=20)
                    {
                        $("#cumplientoEstatus"+idAsignacion).attr('style','background:#b04632;color:#fff;');
                    }
                    if (data[i]['porcentajeHistorico']>20 && data[i]['porcentajeHistorico']<=50)
                    {
                        $("#cumplientoEstatus"+idAsignacion).attr('style','background:#badf90;');
                    }
                    if (data[i]['porcentajeHistorico']>50 && data[i]['porcentajeHistorico']<=75)
                    {
                        $("#cumplientoEstatus"+idAsignacion).attr('style','background:#74c41a;color:#fff;');
                    }
                    if (data[i]['porcentajeHistorico']>75 )
                    {
                        $("#cumplientoEstatus"+idAsignacion).attr('style','background:#548220;color:#fff;');
                    }
                    $("#cumplientoEstatus"+idAsignacion).html(data[i]['porcentajeHistorico']);
                    $("#cumplientodocumental"+idAsignacion).html(porcentajedoctal);



                    var fechaP=data[i]['fechaGuardadoOM'];
                    $("#anaistaE"+idAsignacion).html(data[i]['nombreGuardadoOM']);
                    $("#fUltima"+idAsignacion).html(fechaP);

                    var anioActualP = new Date();
                    anioActualP = anioActualP.getFullYear()+'-01-01';
                    fechaP = new Date(fechaP).getTime();
                    anioActualP = new Date(anioActualP).getTime();
                    var porcentaP;
                    if (fechaP>=anioActualP)
                    {
                        porcentaP="20 %";

                    }
                    else
                    {
                        porcentaP="10 %";

                    }
                    $("#elaboProgram"+idAsignacion).append(porcentaP);
                    $("#tipoEntre"+idAsignacion).append(data[i]["entregables"]);

                    $("#nVisitas"+idAsignacion).append(data[i]["numeroVisitas"]);
                    $("#vencimientoMunicipal"+idAsignacion).append(data[i]["vencimientoMunicipal"]);
                    $("#vencimientoEstatal"+idAsignacion).append(data[i]["vencimientoEstatal"]);
                    /*Visto bueno municipal obtenido*/
                    var fechaAceptacionOTI=data[i]['fechaAceptacion'];
                    var fechaHoy=data[i]['fechaHoy'];
                    fechaAceptacionOTI=new Date(fechaAceptacionOTI).getTime();
                    fechaHoy=new Date(fechaHoy).getTime();
                    if(fechaHoy>fechaAceptacionOTI)
                    {

                        $("#VoBoMunObtenido"+idAsignacion).html("20%");

                        $("#VoBoEstObtenido"+idAsignacion).html("20%");

                    }
                    else
                    {
                        $("#VoBoMunObtenido"+idAsignacion).html("0%");
                        $("#VoBoEstObtenido"+idAsignacion).html("0%");
                    }
                    //fin del voBoMunicipal obtenido

                    $("#programacionEntrega"+idAsignacion).html(data[i]['fechaAceptacion']);

                    //entregaPEPCMunicipal
                    var entregaMunicipal=data[i]["vencimientoMunicipal"];
                    var anioEntregaMunicipal=new Date(entregaMunicipal).getFullYear();
                    fechaHoy=data[i]['fechaHoy'];
                    fechaHoy=new Date(fechaHoy).getFullYear();
                    if(fechaHoy==anioEntregaMunicipal)
                    {
                        $("#entregaPEPCMunicipal"+idAsignacion).html("10%");

                    }
                    else
                    {
                        $("#entregaPEPCMunicipal"+idAsignacion).html("0%");
                    }
                    //fin de entregaPEPCMunicipal


                    //reporteVisitaOM
                    var fechaReporte=data[i]["FechaEnvioCorreoOM"];
                    var anioFechaReporte=new Date(fechaReporte);
                    fechaHoy=data[i]['fechaHoy'];
                    fechaHoy=new Date(fechaHoy);
                    var numeroDias=Math.round((fechaHoy-anioFechaReporte)/(1000*60*60*24))

                    if(numeroDias<=365)
                    {
                        $("#reporteVisitaOM"+idAsignacion).html("10%");
                    }
                    else
                    {
                        $("#reporteVisitaOM"+idAsignacion).html("0%");
                    }
                    //FIN reporteVisitaOM







                    $("#entregaActualizacionEstatal"+idAsignacion).html(data[i]['entregaActualizacionEstatal']);
                    $("#tipoEntrega2"+idAsignacion).html(data[i]['tipoEntrega']);
                    $("#entregaCopiaTienda"+idAsignacion).html(data[i]['entregaCopiaTienda']);

                    //%entregaPEPCEstatal
                    if(new Date(data[i]['entregaActualizacionEstatal']).getFullYear()==new Date(data[i]['fechaHoy']).getFullYear())
                    {
                        $("#entregaPEPCEstatal"+idAsignacion).html("10%");

                    }
                    else
                    {
                        $("#entregaPEPCEstatal"+idAsignacion).html("0%");
                    }
                    //fin de %entregaPEPCEstatal

                    $("#fechaEntregaPrichos"+idAsignacion).html(data[i]['fechaEntregaPrichos']);

                    //%entregaPrichos
                    if(data[i]['fechaEntregaPrichos'])
                    {
                        $("#porcentajeEntregaPrichos"+idAsignacion).html("10%");

                    }
                    else
                    {
                        $("#porcentajeEntregaPrichos"+idAsignacion).html("0%");
                    }
                    //fin de %entregaPrichos

                    $("#fechaEntregaNavideno"+idAsignacion).html(data[i]['fechaAnexoNavideno']);

                    //% Entrega navideño
                    if(data[i]['fechaAnexoNavideno'])
                    {
                        $("#porcentajeEntregaNavideno"+idAsignacion).html("10%");

                    }
                    else
                    {
                        $("#porcentajeEntregaNavideno"+idAsignacion).html("0%");
                    }
                    //fin de entrega navideño

                    $("#preventiva"+idAsignacion).html(data[i]['preventiva']);
                    if(data[i]['preventiva'])
                    {
                        $("#porcentajeAvance3"+idAsignacion).html("5%");

                    }
                    else
                    {
                        $("#porcentajeAvance3"+idAsignacion).html("0%");
                    }
                    $("#observaciones"+idAsignacion).html(data[i]['observaciones']);




                    /*  ======================================================================================================================
                        ======================================================================================================================
                        ====================================================PLAN DE EMERGENCIA================================================
                        ======================================================================================================================
                        ======================================================================================================================*/

                    //elaboracionPlanEmergencia
                    $("#elaboracionPlanEmergencia"+idAsignacion).html(data[i]['elaboracionPlanEmergencia']);
                    var fechaElaboracion=new Date(data[i]["elaboracionPlanEmergencia"]);
                    fechaHoy=new Date(data[i]['fechaHoy']);
                    var numeroDias=calcularDiasEntreFechas(fechaHoy, fechaElaboracion);

                    if(numeroDias<=365)
                    {
                        $("#cumplimientoPPC"+idAsignacion).html(((porcentajes['Cumplimiento PPC%'])?(porcentajes['Cumplimiento PPC%']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Cumplimiento PPC%', idAsignacion, true);
                        //establecerCumplimiento(porcentajesAsignacion[idAsignacion]['Cumplimiento PPC%'], true);

                    }
                    else
                    {
                        $("#cumplimientoPPC"+idAsignacion).html("0%");
                    }


                    //FIN elaboracionPlanEmergencia
                    //integracionPlanEmergencia
                    $("#integracionPlanEmergencia"+idAsignacion).html(data[i]['integracionPlanEmergencia']);
                    var fechaElaboracion=new Date(data[i]["integracionPlanEmergencia"]);
                    fechaHoy=new Date(data[i]['fechaHoy']);
                    var numeroDias=calcularDiasEntreFechas(fechaHoy, fechaElaboracion);

                    if(numeroDias<=365)
                    {
                        $("#cumplimientoIntegracion"+idAsignacion).html(((porcentajes['Cumplimiento de integración'])?(porcentajes['Cumplimiento de integración']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Cumplimiento de integración', idAsignacion, true);

                    }
                    else
                    {
                        $("#cumplimientoIntegracion"+idAsignacion).html("0%");
                    }
                    //FIN integracionPlanEmergencia
                    //Fecha y responsable de ingreso a tramite PE
                    $("#fechaIngresoTramite"+idAsignacion).html(data[i]['fechaIngresoTramite']);
                    $("#responsableIngresoTramite"+idAsignacion).html(data[i]['responsableIngresoTramite']);
                    //FIN DE Fecha y responsable de ingreso a tramite PE

                    //integracionPlanEmergencia
                    var fecha2=new Date(data[i]["fechaIngresoTramite"]);
                    var fecha1=new Date(data[i]['fechaHoy']);
                    var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);

                    if(numeroDias<=365)
                    {
                        $("#cumplimientoIngresoTramite"+idAsignacion).html(((porcentajes['Cumplimiento ingreso trámite %'])?(porcentajes['Cumplimiento ingreso trámite %']['valorPorcentaje']):"0")+"%");

                        establecerCumplimiento('Cumplimiento ingreso trámite %', idAsignacion, true);
                    }
                    else
                    {
                        $("#cumplimientoIngresoTramite"+idAsignacion).html("0%");
                    }
                    //FIN integracionPlanEmergencia
                    /*//seguimientoTramite
                    var fecha2=new Date(data[i]["seguimientoTramite"]);
                    var fecha1=new Date(data[i]['fechaHoy']);
                    var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);

                    if(numeroDias<=365)
                    {
                        $("#cumplimientoIngresoTramite"+idAsignacion).html(((porcentajes['Cumplimiento ingreso trámite %'])?(porcentajes['Cumplimiento ingreso trámite %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Cumplimiento ingreso trámite %', idAsignacion, true);
                    }
                    else
                    {
                        $("#cumplimientoIngresoTramite"+idAsignacion).html("0%");
                    }
                    //FIN seguimientoTramite*/
                    if(data[i]["seguimientoTramite"])
                    {
                        var fecha2=new Date(data[i]["seguimientoTramite"]);
                        var fecha1=new Date(data[i]['fechaHoy']);
                        var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);

                        if(numeroDias<=31) {
                            $("#PECumplimientoSeguimientoTramite"+idAsignacion).html(((porcentajes['Cumplimiento del seguimiento a trámite %'])?(porcentajes['Cumplimiento del seguimiento a trámite %']['valorPorcentaje']):"0")+"%");

                            establecerCumplimiento('Cumplimiento del seguimiento a trámite %', idAsignacion, true);
                        }
                        else
                        {
                            $("#PECumplimientoSeguimientoTramite"+idAsignacion).html("0%");
                        }
                    }
                    else
                    {
                        $("#PECumplimientoSeguimientoTramite"+idAsignacion).html("0%");
                    }
                    //cumplimientoVoBoPlanEmergencia
                    var fecha2=new Date(data[i]["obtencionVoBoPlanEmergencia"]);
                    var fecha1=new Date(data[i]['fechaHoy']);
                    var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);

                    if(numeroDias<=365)
                    {
                        $("#cumplimientoVoBoPlanEmergencia"+idAsignacion).html(((porcentajes['Cumplimiento Vo.Bo.'])?(porcentajes['Cumplimiento Vo.Bo.']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Cumplimiento Vo.Bo.', idAsignacion, true);
                    }
                    else
                    {
                        $("#cumplimientoVoBoPlanEmergencia"+idAsignacion).html("0%");
                    }
                    //FIN cumplimientoVoBoPlanEmergencia

                    /*  ======================================================================================================================
                        ======================================================================================================================
                        ========================================================ARV===========================================================
                        ======================================================================================================================
                        ======================================================================================================================*/
                    //cumplimientoPlanTrabajoInternoARV
                    var fecha2=new Date(data[i]["fechaSolicitud"]);
                    var fecha1=new Date(data[i]['reunionPlanTrabajoInterno']);
                    var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);

                    if(numeroDias<=31)
                    {
                        $("#cumplimientoPlanTrabajoInternoARV"+idAsignacion).html(((porcentajes['Cumplimiento plan de trabajo interno %'])?(porcentajes['Cumplimiento plan de trabajo interno %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Cumplimiento plan de trabajo interno %', idAsignacion, true);
                    }
                    else
                    {
                        $("#cumplimientoPlanTrabajoInternoARV"+idAsignacion).html("0%");
                    }
                    //FIN cumplimientoPlanTrabajoInternoARV

                    if(data[i]["presentacionEsquemaArv"]){
                        $("#presentacionEsquemaARVPorcentaje"+idAsignacion).html(((porcentajes['Presentación esquema de arv %'])?(porcentajes['Presentación esquema de arv %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Presentación esquema de arv %', idAsignacion, true);
                    }
                    else
                    {
                        $("#presentacionEsquemaARVPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]["cumplimientoInspeccionFisica"]){
                        $("#cumplimientoInspeccionFisicaPorcentaje"+idAsignacion).html(((porcentajes['Cumplimiento inspección física %'])?(porcentajes['Cumplimiento inspección física %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Cumplimiento inspección física %', idAsignacion, true);
                    }
                    else
                    {
                        $("#cumplimientoInspeccionFisicaPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]["recoleccionInformacionARV"]){
                        $("#recoleccionInformacion"+idAsignacion).html(((porcentajes['Recolección de información %'])?(porcentajes['Recolección de información %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Recolección de información %', idAsignacion, true);
                    }
                    else
                    {
                        $("#recoleccionInformacion"+idAsignacion).html("0%");
                    }
                    if(data[i]["elaboracionARV"]){
                        $("#elaboracionARVPorcentaje"+idAsignacion).html(((porcentajes['Elaboración arv %'])?(porcentajes['Elaboración arv %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Elaboración arv %', idAsignacion, true);
                    }
                    else
                    {
                        $("#elaboracionARVPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]["revisionInternaCalidad"]){
                        $("#revisionInternaCalidadPorcentaje"+idAsignacion).html(((porcentajes['Revisión interna de calidad %'])?(porcentajes['Revisión interna de calidad %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Revisión interna de calidad %', idAsignacion, true);
                    }
                    else
                    {
                        $("#revisionInternaCalidadPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]["revisionInternaCalidad"]){
                        $("#revisionInternaCalidadPorcentaje"+idAsignacion).html(((porcentajes['Revisión interna de calidad %'])?(porcentajes['Revisión interna de calidad %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Revisión interna de calidad %', idAsignacion, true);
                    }
                    else
                    {
                        $("#revisionInternaCalidadPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]["integracionFisicaCarpeta"]){
                        $("#integracionFisicaCarpetaPorcentaje"+idAsignacion).html(((porcentajes['Integración física carpeta%'])?(porcentajes['Integración física carpeta%']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Integración física carpeta%', idAsignacion, true);
                    }
                    else
                    {
                        $("#integracionFisicaCarpetaPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]["entregaClienteARV"]){
                        $("#entregaClienteARVPorcentaje"+idAsignacion).html(((porcentajes['Entrega al cliente %'])?(porcentajes['Entrega al cliente %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Entrega al cliente %', idAsignacion, true);
                    }
                    else
                    {
                        $("#entregaClienteARVPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]["obtencionVistoBuenoARV"]){
                        $("#obtencionVistoBuenoARVPorcentaje"+idAsignacion).html(((porcentajes['Obtención visto bueno %'])?(porcentajes['Obtención visto bueno %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Obtención visto bueno %', idAsignacion, true);
                    }
                    else
                    {
                        $("#obtencionVistoBuenoARVPorcentaje"+idAsignacion).html("0%");
                    }

                    if(data[i]["fechaSeguimientoRealizadoARV"]){
                        $("#seguimientoRealizadoARVPorcentaje"+idAsignacion).html(((porcentajes['Seguimiento %'])?(porcentajes['Seguimiento %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Seguimiento %', idAsignacion, true);
                    }
                    else
                    {
                        $("#seguimientoRealizadoARVPorcentaje"+idAsignacion).html("0%");

                    }

                    /*  ======================================================================================================================
                        ======================================================================================================================
                        ========================================================SEG VISITA====================================================
                        ======================================================================================================================
                        ======================================================================================================================*/
                    if(data[i]["fechaSeguimientoSEGVisita"])
                    {

                        $("#seguimientoSEGVisitaPorcentaje"+idAsignacion).html(((porcentajes['Visita Seguimiento%'])?(porcentajes['Visita Seguimiento%']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Visita Seguimiento%', idAsignacion, true);
                    }
                    else
                    {
                        $("#seguimientoSEGVisitaPorcentaje"+idAsignacion).html("0%");
                    }

                    /*  ======================================================================================================================
                        ======================================================================================================================
                        ========================================================SEG PLAN CONT=================================================
                        ======================================================================================================================
                        ======================================================================================================================*/
                    if(data[i]['planContReunionPlanTrabajoInterno']){
                        $("#planContReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Cumplimiento plan de trabajo interno %'])?(porcentajes['Plan Cont Cumplimiento plan de trabajo interno %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('Plan Cont Cumplimiento plan de trabajo interno %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planContReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['planContRecoleccionInformacion']){
                        $("#planContRecoleccionInformacionPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Recolección de información %'])?(porcentajes['Plan Cont Recolección de información %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('Plan Cont Recolección de información %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planContRecoleccionInformacionPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['planContInspeccionFisica']){
                        $("#planContInspeccionFisicaPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Cumplimiento inspección física %'])?(porcentajes['Plan Cont Cumplimiento inspección física %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('Plan Cont Cumplimiento inspección física %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planContInspeccionFisicaPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['planContReporteOM']){
                        $("#planContReporteOMPorcentaje"+idAsignacion).html((((porcentajes['Plan Cont Reporte OM %'])?(porcentajes['Plan Cont Reporte OM %']['valorPorcentaje']):"0"))+"%")
                        establecerCumplimiento('Plan Cont Reporte OM %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planContReporteOMPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['planContCumplimientoPlanContinuidad']){
                        $("#planContCumplimientoPlanContinuidadPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Cumplimiento plan continuidad %'])?(porcentajes['Plan Cont Cumplimiento plan continuidad %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('Plan Cont Cumplimiento plan continuidad %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planContCumplimientoPlanContinuidadPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['planContCumplimientoIntegracion']){
                        $("#planContCumplimientoIntegracionPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Cumplimiento de integración %'])?(porcentajes['Plan Cont Cumplimiento de integración %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('Plan Cont Cumplimiento de integración %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planContCumplimientoIntegracionPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['planContRevisionInternaCalidad']){
                        $("#planContRevisionInternaCalidadPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Revisión interna de calidad %'])?(porcentajes['Plan Cont Revisión interna de calidad %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('Plan Cont Revisión interna de calidad %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planContRevisionInternaCalidadPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['planContPresentacionClienteAutoridad']){
                        $("#planContPresentacionClienteAutoridadPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Presentación %'])?(porcentajes['Plan Cont Presentación %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('Plan Cont Presentación %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planContPresentacionClienteAutoridadPorcentaje"+idAsignacion).html("0%")
                    }


                    /*  ======================================================================================================================
                        ======================================================================================================================
                        ========================================================SEG SIMU======================================================
                        ======================================================================================================================
                        ======================================================================================================================*/
                    //simuReunionPlanTrabajoInternoPorcentaje
                    var fecha1=new Date(data[i]["simuReunionPlanTrabajoInterno"]);
                    var fecha2=new Date(data[i]['fechaSolicitud']);
                    var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                    if(numeroDias<=31 && data[i]["simuReunionPlanTrabajoInterno"])
                    {

                        $("#simuReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html(((porcentajes['SIMU Cumplimiento plan de trabajo interno %'])?(porcentajes['SIMU Cumplimiento plan de trabajo interno %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('SIMU Cumplimiento plan de trabajo interno %', idAsignacion, true);
                    }

                    else
                    {
                        $("#simuReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html("0%")
                    }
                    //FIN simuReunionPlanTrabajoInternoPorcentaje

                    //simuPresentacionPlanTrabajoPorcentaje
                    var fecha1=new Date(data[i]["simuPresentacionPlanTrabajo"]);
                    var fecha2=new Date(data[i]['simuReunionPlanTrabajoInterno']);
                    var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                    if(numeroDias<=31 && data[i]["simuPresentacionPlanTrabajo"] && data[i]['simuReunionPlanTrabajoInterno'])
                    {
                        $("#simuPresentacionPlanTrabajoPorcentaje"+idAsignacion).html(((porcentajes['SIMU Presentación plan de trabajo %'])?(porcentajes['SIMU Presentación plan de trabajo %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('SIMU Presentación plan de trabajo %', idAsignacion, true);
                    }

                    else
                    {
                        $("#simuPresentacionPlanTrabajoPorcentaje"+idAsignacion).html("0%")
                    }
                    //FIN simuPresentacionPlanTrabajoPorcentaje
                    if(data[i]['simuRecoleccionInformacion']){
                        $("#simuRecoleccionInformacionPorcentaje"+idAsignacion).html(((porcentajes['SIMU Recolección de información %'])?(porcentajes['SIMU Recolección de información %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('SIMU Recolección de información %', idAsignacion, true);
                    }
                    else
                    {
                        $("#simuRecoleccionInformacionPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['simuReunionProgramacionCliente']){
                        $("#simuReunionProgramacionClientePorcentaje"+idAsignacion).html(((porcentajes['SIMU Reunión programación con cliente %'])?(porcentajes['SIMU Reunión programación con cliente %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('SIMU Reunión programación con cliente %', idAsignacion, true);
                    }
                    else
                    {
                        $("#simuReunionProgramacionClientePorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['simuProgramacionLogisticaInterna']){
                        $("#simuProgramacionLogisticaInternaPorcentaje"+idAsignacion).html(((porcentajes['SIMU Programación y logística interna %'])?(porcentajes['SIMU Programación y logística interna %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('SIMU Programación y logística interna %', idAsignacion, true);
                    }
                    else
                    {
                        $("#simuProgramacionLogisticaInternaPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['simuElaboracionSimulacro']){
                        $("#simuElaboracionSimulacroPorcentaje"+idAsignacion).html(((porcentajes['SIMU Elaboración de simulacro %'])?(porcentajes['SIMU Elaboración de simulacro %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('SIMU Elaboración de simulacro %', idAsignacion, true);
                    }
                    else
                    {
                        $("#simuElaboracionSimulacroPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['simuRevisionCalidadInterna']){
                        $("#simuRevisionCalidadInternaPorcentaje"+idAsignacion).html(((porcentajes['SIMU Revisión de calidad interna %'])?(porcentajes['SIMU Revisión de calidad interna %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('SIMU Revisión de calidad interna %', idAsignacion, true);
                    }
                    else
                    {
                        $("#simuRevisionCalidadInternaPorcentaje"+idAsignacion).html("0%")
                    }
                    if(data[i]['simuEntregaReporteEvidencias']){
                        $("#simuEntregaReporteEvidenciasPorcentaje"+idAsignacion).html(((porcentajes['SIMU Entrega reporte y evidencias%'])?(porcentajes['SIMU Entrega reporte y evidencias%']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('SIMU Entrega reporte y evidencias%', idAsignacion, true);
                    }
                    else
                    {
                        $("#simuEntregaReporteEvidenciasPorcentaje"+idAsignacion).html("0%")
                    }
                    /*  ======================================================================================================================
                        ======================================================================================================================
                        =======================================================SEG MOD3D======================================================
                        ======================================================================================================================
                        ======================================================================================================================*/

                    //mod3dReunionPlanTrabajoInterno
                    var fecha1=new Date(data[i]["mod3dReunionPlanTrabajoInterno"]);
                    var fecha2=new Date(data[i]['fechaSolicitud']);
                    var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                    if(numeroDias<=31 && data[i]["mod3dReunionPlanTrabajoInterno"])
                    {
                        $("#mod3dReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Cumplimiento plan de trabajo interno %'])?(porcentajes['MOD3D Cumplimiento plan de trabajo interno %']['valorPorcentaje']):"0")+"%")
                        establecerCumplimiento('MOD3D Cumplimiento plan de trabajo interno %', idAsignacion, true);
                    }

                    else
                    {
                        $("#mod3dReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html("0%")
                    }

                    if(data[i]["mod3dReunionPlanTrabajoInterno"])
                    {
                        if(data[i]['mod3dRecoleccionInformacion'])
                        {
                            fecha1=new Date(data[i]["mod3dRecoleccionInformacion"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#mod3dRecoleccionInformacionPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Recolección de información%'])?(porcentajes['MOD3D Recolección de información%']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Recolección de información%', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dRecoleccionInformacionPorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dRecoleccionInformacionPorcentaje"+idAsignacion).html("0%");
                        }
                        if(data[i]['mod3dVisitaInspeccion'])
                        {
                            fecha1=new Date(data[i]["mod3dVisitaInspeccion"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#mod3dVisitaInspeccionPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Visita de inspección %'])?(porcentajes['MOD3D Visita de inspección %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Visita de inspección %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dVisitaInspeccionPorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dVisitaInspeccionPorcentaje"+idAsignacion).html("0%");
                        }
                        if(data[i]['mod3dConfirmacionPlanos'])
                        {
                            fecha1=new Date(data[i]["mod3dConfirmacionPlanos"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#mod3dConfirmacionPlanosPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Confirmación de planos %'])?(porcentajes['MOD3D Confirmación de planos %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Confirmación de planos %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dConfirmacionPlanosPorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dConfirmacionPlanosPorcentaje"+idAsignacion).html("0%");
                        }
                        if(data[i]['mod3dElaboracionPlanos'])
                        {
                            fecha1=new Date(data[i]["mod3dElaboracionPlanos"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31){
                                $("#mod3dElaboracionPlanosPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Elaboración planos 3d %'])?(porcentajes['MOD3D Elaboración planos 3d %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Elaboración planos 3d %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dElaboracionPlanosPorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dElaboracionPlanosPorcentaje"+idAsignacion).html("0%");
                        }
                        if(data[i]['mod3dSimulacion'])
                        {
                            fecha1=new Date(data[i]["mod3dSimulacion"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#mod3dSimulacionPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Simulación %'])?(porcentajes['MOD3D Simulación %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Simulación %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dSimulacionPorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dSimulacionPorcentaje"+idAsignacion).html("0%");
                        }
                        if(data[i]['mod3dRevisionTecnica'])
                        {
                            fecha1=new Date(data[i]["mod3dRevisionTecnica"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#mod3dRevisionTecnicaPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Revisión técnica %'])?(porcentajes['MOD3D Revisión técnica %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Revisión técnica %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dRevisionTecnicaPorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dRevisionTecnicaPorcentaje"+idAsignacion).html("0%");
                        }
                        if(data[i]['mod3dEntregaResultadosVideo'])
                        {
                            fecha1=new Date(data[i]["mod3dEntregaResultadosVideo"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#mod3dEntregaResultadosVideoPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Entrega resultados y video %'])?(porcentajes['MOD3D Entrega resultados y video %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Entrega resultados y video %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dEntregaResultadosVideoPorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dEntregaResultadosVideoPorcentaje"+idAsignacion).html("0%");
                        }
                        if(data[i]['mod3dRedaccionInforme'])
                        {
                            fecha1=new Date(data[i]["mod3dRedaccionInforme"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#mod3dRedaccionInformePorcentaje"+idAsignacion).html(((porcentajes['MOD3D Redacción informe %'])?(porcentajes['MOD3D Redacción informe %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Redacción informe %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dRedaccionInformePorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dRedaccionInformePorcentaje"+idAsignacion).html("0%");
                        }
                        if(data[i]['mod3dFormulacionConclusiones'])
                        {
                            fecha1=new Date(data[i]["mod3dFormulacionConclusiones"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=45)
                            {
                                $("#mod3dFormulacionConclusionesPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Formulación conclusiones %'])?(porcentajes['MOD3D Formulación conclusiones %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Formulación conclusiones %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dFormulacionConclusionesPorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dFormulacionConclusionesPorcentaje"+idAsignacion).html("0%");
                        }

                        if(data[i]['mod3dRevisionCalidadInterna'])
                        {
                            fecha1=new Date(data[i]["mod3dRevisionCalidadInterna"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=45)
                            {
                                $("#mod3dRevisionCalidadInternaPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Revisión de calidad interna %'])?(porcentajes['MOD3D Revisión de calidad interna %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Revisión de calidad interna %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dRevisionCalidadInternaPorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dRevisionCalidadInternaPorcentaje"+idAsignacion).html("0%");
                        }

                        if(data[i]['mod3dEntregaCliente'])
                        {
                            fecha1=new Date(data[i]["mod3dEntregaCliente"]);
                            fecha2=new Date(data[i]['mod3dReunionPlanTrabajoInterno']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=45)
                            {
                                $("#mod3dEntregaClientePorcentaje"+idAsignacion).html(((porcentajes['MOD3D Entrega cliente %'])?(porcentajes['MOD3D Entrega cliente %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Entrega cliente %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dEntregaClientePorcentaje"+idAsignacion).html("0%");
                            }
                        }
                        else
                        {
                            $("#mod3dEntregaClientePorcentaje"+idAsignacion).html("0%");
                        }

                    }
                    else
                    {

                        $("#mod3dRecoleccionInformacionPorcentaje"+idAsignacion).html("0%");
                        $("#mod3dVisitaInspeccionPorcentaje"+idAsignacion).html("0%");
                        $("#mod3dConfirmacionPlanosPorcentaje"+idAsignacion).html("0%");
                        $("#mod3dElaboracionPlanosPorcentaje"+idAsignacion).html("0%");
                        $("#mod3dSimulacionPorcentaje"+idAsignacion).html("0%");
                        $("#mod3dRevisionTecnicaPorcentaje"+idAsignacion).html("0%");
                        $("#mod3dEntregaResultadosVideoPorcentaje"+idAsignacion).html("0%");
                        $("#mod3dRedaccionInformePorcentaje"+idAsignacion).html("0%");
                        $("#mod3dFormulacionConclusionesPorcentaje"+idAsignacion).html("0%");
                        $("#mod3dRevisionCalidadInternaPorcentaje"+idAsignacion).html("0%");
                    }
                    //FIN mod3dReunionPlanTrabajoInterno
                    /*  ======================================================================================================================
                        ======================================================================================================================
                        ====================================================SEG COPIAS========================================================
                        ======================================================================================================================
                        ======================================================================================================================*/
                    if(data[i]['copiasFechaEntregaCliente'])
                    {
                        fecha1=new Date(data[i]["fechaEntrega"]);
                        fecha2=new Date(data[i]['copiasFechaEntregaCliente']);
                        numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                        if(numeroDias>=0)
                        {
                            $("#copiasCumplimientoEntrega"+idAsignacion).html(((porcentajes['Copias Cumplimiento de entrega %'])?(porcentajes['Copias Cumplimiento de entrega %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Copias Cumplimiento de entrega %', idAsignacion, true);
                        }
                        else
                        {
                            $("#copiasCumplimientoEntrega"+idAsignacion).html("0%");
                        }
                    }
                    else
                    {
                        $("#copiasCumplimientoEntrega"+idAsignacion).html("0%");
                    }
                    if(data[i]['copiasRevisionCalidad'])
                    {
                        $("#copiasRevisionCalidadPorcentaje"+idAsignacion).html(((porcentajes['Copias Revisión de calidad %'])?(porcentajes['Copias Revisión de calidad %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Copias Revisión de calidad %', idAsignacion, true);
                    }
                    else
                    {
                        $("#copiasRevisionCalidadPorcentaje"+idAsignacion).html("0%");
                    }

                    /*  ======================================================================================================================
                        ======================================================================================================================
                        ====================================================SEG PLANOS========================================================
                        ======================================================================================================================
                        ======================================================================================================================*/
                    if(data[i]['planosCumplimientoVisita'])
                    {

                        $("#planosCumplimientoVisitaPorcentaje"+idAsignacion).html(((porcentajes['Planos Cumplimiento de visita %'])?(porcentajes['Planos Cumplimiento de visita %']['valorPorcentaje']):"0")+ "%");
                        establecerCumplimiento('Planos Cumplimiento de visita %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planosCumplimientoVisitaPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]['planosElaboracionPlano'])
                    {
                        $("#planosElaboracionPlanoPorcentaje"+idAsignacion).html(((porcentajes['Planos Elaboración de plano %'])?(porcentajes['Planos Elaboración de plano %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Planos Elaboración de plano %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planosElaboracionPlanoPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]['planosRevisionCalidadInterna'])
                    {
                        $("#planosRevisionCalidadInternaPorcentaje"+idAsignacion).html(((porcentajes['Planos Revisión de calidad interna %'])?(porcentajes['Planos Revisión de calidad interna %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Planos Revisión de calidad interna %', idAsignacion, true);
                    }
                    else
                    {
                        $("#planosRevisionCalidadInternaPorcentaje"+idAsignacion).html("0%");
                    }
                    if(data[i]['planosEntregaCliente'])
                    {


                        $("#planosEntregaClientePorcentaje"+idAsignacion).html(((porcentajes['Planos Entrega cliente interno/ externo%'])?(porcentajes['Planos Entrega cliente interno/ externo%']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('Planos Entrega cliente interno/ externo%', idAsignacion, true);
                    }
                    else
                    {
                        $("#planosEntregaClientePorcentaje"+idAsignacion).html("0%");
                    }


                    /*  ======================================================================================================================
                        ======================================================================================================================
                        ====================================================SEG PPC MUN=======================================================
                        ======================================================================================================================
                        ======================================================================================================================*/
                    if(data[i]['munIntegracionPrograma'])
                    {
                        fecha1=new Date(data[i]["fechaHoy"]);
                        fecha2=new Date(data[i]['munIntegracionPrograma']);
                        numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                        if(numeroDias>=365)
                        {
                            $("#munCumplimientoIntegracion"+idAsignacion).html("0%");
                        }
                        else
                        {
                            $("#munCumplimientoIntegracion"+idAsignacion).html(((porcentajes['PPC MUN Cumplimiento de integración %'])?(porcentajes['PPC MUN Cumplimiento de integración %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('PPC MUN Cumplimiento de integración %', idAsignacion, true);
                        }
                    }
                    else
                    {
                        $("#munCumplimientoIntegracion"+idAsignacion).html("0%");
                    }
                    if(data[i]['munFechaIngresoMunicipal'])
                    {
                        fecha1=new Date(data[i]["fechaHoy"]);
                        fecha2=new Date(data[i]['munFechaIngresoMunicipal']);
                        numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                        if(numeroDias>=365)
                        {
                            $("#munCumplimientoIngresoMunicipal"+idAsignacion).html("0%");
                        }
                        else
                        {
                            $("#munCumplimientoIngresoMunicipal"+idAsignacion).html(((porcentajes['PPC MUN Cumplimiento ingreso municipal/alcaldía %'])?(porcentajes['PPC MUN Cumplimiento ingreso municipal/alcaldía %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('PPC MUN Cumplimiento ingreso municipal/alcaldía %', idAsignacion, true);
                        }
                    }
                    else
                    {
                        $("#munCumplimientoIngresoMunicipal"+idAsignacion).html("0%");
                    }

                    if(data[i]['munSeguimientoTramiteMunicipal'])
                    {
                        fecha1=new Date(data[i]["fechaHoy"]);
                        fecha2=new Date(data[i]['munSeguimientoTramiteMunicipal']);
                        numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                        if(numeroDias<=31)
                        {
                            $("#munCumplimientoSeguimientoMunicipal"+idAsignacion).html(((porcentajes['PPC MUN Cumplimiento del seguimiento municipal %'])?(porcentajes['PPC MUN Cumplimiento del seguimiento municipal %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('PPC MUN Cumplimiento del seguimiento municipal %', idAsignacion, true);

                        }
                        else
                        {
                            $("#munCumplimientoSeguimientoMunicipal"+idAsignacion).html("0%");
                        }
                    }
                    else
                    {
                        $("#munCumplimientoSeguimientoMunicipal"+idAsignacion).html("0%");
                    }
                    if(data[i]['munRespuestaPreventiva'])
                    {
                        $("#munRespuestaAutoridadTramite"+idAsignacion).html(((porcentajes['PPC MUN Respuesta autoridad trámite municipal %'])?(porcentajes['PPC MUN Respuesta autoridad trámite municipal %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('PPC MUN Respuesta autoridad trámite municipal %', idAsignacion, true);
                    }
                    else
                    {
                        $("#munRespuestaAutoridadTramite"+idAsignacion).html("0%");
                    }


                    /*  ======================================================================================================================
                        ======================================================================================================================
                        ====================================================SEG PPC EST=======================================================
                        ======================================================================================================================
                        ======================================================================================================================*/
                    if(data[i]['estIntegracionPrograma'])
                    {
                        fecha1=new Date(data[i]["fechaHoy"]);
                        fecha2=new Date(data[i]['estIntegracionPrograma']);
                        numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                        if(numeroDias>=365)
                        {
                            $("#estCumplimientoIntegracion"+idAsignacion).html("0%");
                        }
                        else
                        {
                            $("#estCumplimientoIntegracion"+idAsignacion).html(((porcentajes['PPC EST Cumplimiento de integración %'])?(porcentajes['PPC EST Cumplimiento de integración %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('PPC EST Cumplimiento de integración %', idAsignacion, true);
                        }
                    }
                    else
                    {
                        $("#estCumplimientoIntegracion"+idAsignacion).html("0%");
                    }
                    if(data[i]['estFechaIngresoEstatal'])
                    {
                        fecha1=new Date(data[i]["fechaHoy"]);
                        fecha2=new Date(data[i]['estFechaIngresoEstatal']);
                        numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                        if(numeroDias>=365)
                        {
                            $("#estCumplimientoIngresoEstatal"+idAsignacion).html("0%");
                        }
                        else
                        {
                            $("#estCumplimientoIngresoEstatal"+idAsignacion).html(((porcentajes['PPC EST Cumplimiento ingreso estatal %'])?(porcentajes['PPC EST Cumplimiento ingreso estatal %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('PPC EST Cumplimiento ingreso estatal %', idAsignacion, true);
                        }
                    }
                    else
                    {
                        $("#estCumplimientoIngresoEstatal"+idAsignacion).html("0%");
                    }

                    if(data[i]['estSeguimientoTramiteEstatal'])
                    {
                        fecha1=new Date(data[i]["fechaHoy"]);
                        fecha2=new Date(data[i]['estSeguimientoTramiteEstatal']);
                        numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                        if(numeroDias<=31)
                        {
                            $("#estCumplimientoSeguimientoEstatal"+idAsignacion).html(((porcentajes['PPC EST Cumplimiento del seguimiento estatal %'])?(porcentajes['PPC EST Cumplimiento del seguimiento estatal %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('PPC EST Cumplimiento del seguimiento estatal %', idAsignacion, true);

                        }
                        else
                        {
                            $("#estCumplimientoSeguimientoEstatal"+idAsignacion).html("0%");
                        }
                    }
                    else
                    {
                        $("#estCumplimientoSeguimientoEstatal"+idAsignacion).html("0%");
                    }
                    if(data[i]['estRespuestaPreventiva'])
                    {
                        $("#estRespuestaAutoridadTramite"+idAsignacion).html(((porcentajes['PPC EST Respuesta  autoridad trámite estatal %'])?(porcentajes['PPC EST Respuesta  autoridad trámite estatal %']['valorPorcentaje']):"0")+"%");
                        establecerCumplimiento('PPC EST Respuesta  autoridad trámite estatal %', idAsignacion, true);
                    }
                    else
                    {
                        $("#estRespuestaAutoridadTramite"+idAsignacion).html("0%");
                    }
                    calcularPorcentajeFinal(idAsignacion);
                }


            },
            complete: function () {
                $("#tablaExcel").html($("#tabla-otis").html());
                $("#tabla-otis").Tabledit
                ({
                    url: '<?=site_url('CrudSeguimiento/editarSeguimientoDocumental/')?>',
                    editButton: false,
                    restoreButton: false,
                    deleteButton: false,
                    columns:{
                        identifier: [0, 'idAsignacion'],
                        editable: [

                            [$("#tabla-otis thead tr [nombreColumna='Vencimiento municipal']").index(), 'vencimientoMunicipal'],
                            [$("#tabla-otis thead tr [nombreColumna='Vencimiento estatal']").index(), 'vencimientoEstatal'],
                            [$("#tabla-otis thead tr [nombreColumna='Entrega para actualización estatal']").index(), 'entregaActualizacionEstatal'],
                            [$("#tabla-otis thead tr [nombreColumna='Tipo de entrega (2)']").index(), 'tipoEntrega'],
                            [$("#tabla-otis thead tr [nombreColumna='Entrega copia tienda']").index(), 'entregaCopiaTienda'],
                            [$("#tabla-otis thead tr [nombreColumna='Fecha de entrega prichos']").index(), 'fechaEntregaPrichos'],
                            [$("#tabla-otis thead tr [nombreColumna='Fecha de entrega anexo navideño']").index(), 'fechaAnexoNavideno'],
                            [$("#tabla-otis thead tr [nombreColumna='Preventiva']").index(), 'preventiva'],
                            [$("#tabla-otis thead tr [nombreColumna='Observaciones']").index(), 'observaciones'],

                            [$("#tabla-otis thead tr [nombreColumna='Elaboracion del plan de emergencia']").index(),    'elaboracionPlanEmergencia'],
                            [$("#tabla-otis thead tr [nombreColumna='Integración del plan de emergencia']").index(),    'integracionPlanEmergencia'],
                            [$("#tabla-otis thead tr [nombreColumna='Fecha de ingreso a trámite']").index(),            'fechaIngresoTramite'],
                            [$("#tabla-otis thead tr [nombreColumna='Responsable del ingreso a trámite']").index(),     'responsableIngresoTramite'],
                            [$("#tabla-otis thead tr [nombreColumna='Entrega copia cliente']").index(),                 'entregaCopiaClientePE'],
                            [$("#tabla-otis thead tr [nombreColumna='Seguimiento a trámite']").index(),                 'seguimientoTramite'],
                            [$("#tabla-otis thead tr [nombreColumna='Responsable del seguimiento a trámite']").index(), 'responsableSeguimientoTramite'],
                            [$("#tabla-otis thead tr [nombreColumna='Obtención de Vo\\.Bo\\.']").index(),               'obtencionVoBoPlanEmergencia'],

                            [$("#tabla-otis thead tr [nombreColumna='Reunión plan de trabajo interno']").index(),       'reunionPlanTrabajoInterno'],
                            [$("#tabla-otis thead tr [nombreColumna='Presentación esquema de arv']").index(),           'presentacionEsquemaArv'],
                            [$("#tabla-otis thead tr [nombreColumna='inspección físicaARV']").index(),          'cumplimientoInspeccionFisica'],
                            [$("#tabla-otis thead tr [nombreColumna='Recolección de información ARV']").index(),        'recoleccionInformacionARV'],
                            [$("#tabla-otis thead tr [nombreColumna='Elaboración arv']").index(),                       'elaboracionARV'],
                            [$("#tabla-otis thead tr [nombreColumna='Revisión interna de calidad']").index(),           'revisionInternaCalidad'],
                            [$("#tabla-otis thead tr [nombreColumna='Integración física carpeta']").index(),            'integracionFisicaCarpeta'],
                            [$("#tabla-otis thead tr [nombreColumna='Presentación al cliente\\/autoridad']").index(),   'presentacionClienteAutoridad'],
                            [$("#tabla-otis thead tr [nombreColumna='Entrega al cliente']").index(),                    'entregaClienteARV'],
                            [$("#tabla-otis thead tr [nombreColumna='Fecha de seguimiento realizado']").index(),        'fechaSeguimientoRealizadoARV'],
                            [$("#tabla-otis thead tr [nombreColumna='Responsable de seguimiento']").index(),            'responsableSeguimientoARV'],
                            [$("#tabla-otis thead tr [nombreColumna='Obtención visto bueno']").index(),                 'obtencionVistoBuenoARV'],

                            [$("#tabla-otis thead tr [nombreColumna='Visita Seguimiento']").index(),                    'fechaSeguimientoSEGVisita'],


                            [$("#tabla-otis thead tr [nombreColumna='Plan Cont Reunión plan de trabajo interno']").index(),     'planContReunionPlanTrabajoInterno'],
                            [$("#tabla-otis thead tr [nombreColumna='Plan Cont Recolección de información']").index(),          'planContRecoleccionInformacion'],
                            [$("#tabla-otis thead tr [nombreColumna='Plan Cont Inspección física']").index(),                   'planContInspeccionFisica'],
                            [$("#tabla-otis thead tr [nombreColumna='Plan Cont Reporte OM']").index(),                          'planContReporteOM'],
                            [$("#tabla-otis thead tr [nombreColumna='Plan Cont Cumplimiento plan continuidad']").index(),       'planContCumplimientoPlanContinuidad'],
                            [$("#tabla-otis thead tr [nombreColumna='Plan Cont Cumplimiento de integración']").index(),         'planContCumplimientoIntegracion'],
                            [$("#tabla-otis thead tr [nombreColumna='Plan Cont Revisión interna de calidad']").index(),         'planContRevisionInternaCalidad'],
                            [$("#tabla-otis thead tr [nombreColumna='Plan Cont Presentación al cliente\\/autoridad']").index(), 'planContPresentacionClienteAutoridad'],


                            [$("#tabla-otis thead tr [nombreColumna='SIMU Reunión plan de trabajo interno']").index(),        'simuReunionPlanTrabajoInterno'],
                            [$("#tabla-otis thead tr [nombreColumna='SIMU Presentación plan de trabajo']").index(),        'simuPresentacionPlanTrabajo'],
                            [$("#tabla-otis thead tr [nombreColumna='SIMU Recolección de información']").index(),        'simuRecoleccionInformacion'],
                            [$("#tabla-otis thead tr [nombreColumna='SIMU Reunión programación con cliente']").index(),        'simuReunionProgramacionCliente'],
                            [$("#tabla-otis thead tr [nombreColumna='SIMU Programación y logística interna']").index(),        'simuProgramacionLogisticaInterna'],
                            [$("#tabla-otis thead tr [nombreColumna='SIMU Elaboración de simulacro']").index(),        'simuElaboracionSimulacro'],
                            [$("#tabla-otis thead tr [nombreColumna='SIMU Revisión de calidad interna']").index(),        'simuRevisionCalidadInterna'],
                            [$("#tabla-otis thead tr [nombreColumna='SIMU Entrega reporte y evidencias']").index(),        'simuEntregaReporteEvidencias'],



                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Reunión plan de trabajo interno']").index(), 'mod3dReunionPlanTrabajoInterno'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Recolección de información']").index(), 'mod3dRecoleccionInformacion'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Visita de inspección']").index(), 'mod3dVisitaInspeccion'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Confirmación planos']").index(), 'mod3dConfirmacionPlanos'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Elaboración planos 3d']").index(), 'mod3dElaboracionPlanos'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Simulación']").index(), 'mod3dSimulacion'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Revisión técnica']").index(), 'mod3dRevisionTecnica'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Entrega resultados y video']").index(), 'mod3dEntregaResultadosVideo'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Redacción informe']").index(), 'mod3dRedaccionInforme'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Formulación conclusiones']").index(), 'mod3dFormulacionConclusiones'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Revisión de calidad interna']").index(), 'mod3dRevisionCalidadInterna'],
                            [$("#tabla-otis thead tr [nombreColumna='MOD3D Entrega cliente']").index(), 'mod3dEntregaCliente'],


                            [$("#tabla-otis thead tr [nombreColumna='Copias No\\. Carpetas solicitadas']").index(), 'copiasCarpetasSolicitadas'],
                            [$("#tabla-otis thead tr [nombreColumna='Copias Fecha de entrega al cliente']").index(), 'copiasFechaEntregaCliente'],
                            [$("#tabla-otis thead tr [nombreColumna='Copias Revisión de calidad']").index(), 'copiasRevisionCalidad'],

                            [$("#tabla-otis thead tr [nombreColumna='Planos Cumplimiento de visita']").index(), 'planosCumplimientoVisita'],
                            [$("#tabla-otis thead tr [nombreColumna='Planos Elaboración de plano']").index(), 'planosElaboracionPlano'],
                            [$("#tabla-otis thead tr [nombreColumna='Planos Revisión de calidad interna']").index(), 'planosRevisionCalidadInterna'],
                            [$("#tabla-otis thead tr [nombreColumna='Planos Entrega cliente interno\\/ externo']").index(), 'planosEntregaCliente'],


                            [$("#tabla-otis thead tr [nombreColumna='PPC MUN Integración del programa']").index(), 'munIntegracionPrograma'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC MUN Fecha de ingreso municipal\\/alcaldía']").index(), 'munFechaIngresoMunicipal'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC MUN Responsable del ingreso municipal\\/alcaldía']").index(), 'munResponsableIngresoMunicipal'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC MUN Entrega copia cliente']").index(), 'munEntregaCopiaCliente'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC MUN Seguimiento a trámite municipal\\/alcaldía']").index(), 'munSeguimientoTramiteMunicipal'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC MUN Responsable del seguimiento municipal\\/alcaldía']").index(), 'munResponsableSeguimientoMunicipal'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC MUN Respuesta a preventiva municipal']").index(), 'munRespuestaPreventiva'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC MUN Responsable respuesta preventiva municipal']").index(), 'munResponsableRespuestaPreventiva'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC MUN Seguimiento preventiva municipal']").index(), 'munSeguimientoPreventivaMunicipal'],




                            [$("#tabla-otis thead tr [nombreColumna='PPC EST Integración del programa']").index(), 'estIntegracionPrograma'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC EST Fecha de ingreso estatal']").index(), 'estFechaIngresoEstatal'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC EST Responsable del ingreso estatal']").index(), 'estResponsableIngresoEstatal'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC EST Entrega copia cliente']").index(), 'estEntregaCopiaCliente'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC EST Seguimiento a trámite estatal']").index(), 'estSeguimientoTramiteEstatal'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC EST Responsable del seguimiento estatal']").index(), 'estResponsableSeguimientoEstatal'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC EST Respuesta a preventiva estatal']").index(), 'estRespuestaPreventiva'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC EST Responsable respuesta preventiva estatal']").index(), 'estResponsableRespuestaPreventiva'],
                            [$("#tabla-otis thead tr [nombreColumna='PPC EST Seguimiento preventivo estatal']").index(), 'estSeguimientoPreventivaEstatal'],


                        ]
                    }, onDraw: function() {


                        //Selecciona todos los inputs de la columna X y les aplica un tipo date
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Vencimiento municipal']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Vencimiento estatal']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Entrega para actualización estatal']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Entrega copia tienda']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Fecha de entrega prichos']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Fecha de entrega anexo navideño']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Preventiva']").index()+1)+') input').attr("type", "date");


                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Elaboracion del plan de emergencia']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Integración del plan de emergencia']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Fecha de ingreso a trámite']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Entrega copia cliente']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Seguimiento a trámite']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Obtención de Vo\\.Bo\\.']").index()+1)+') input').attr("type", "date");

                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Reunión plan de trabajo interno']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Presentación esquema de arv']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='inspección físicaARV']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Recolección de información ARV']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Elaboración arv']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Revisión interna de calidad']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Integración física carpeta']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Presentación al cliente\\/autoridad']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Entrega al cliente']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Fecha de seguimiento realizado']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Obtención visto bueno']").index()+1)+') input').attr("type", "date");

                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Visita Seguimiento']").index()+1)+') input').attr("type", "date");

                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Plan Cont Reunión plan de trabajo interno']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Plan Cont Recolección de información']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Plan Cont Inspección física']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Plan Cont Reporte OM']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Plan Cont Cumplimiento plan continuidad']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Plan Cont Cumplimiento de integración']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Plan Cont Revisión interna de calidad']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Plan Cont Presentación al cliente\\/autoridad']").index()+1)+') input').attr("type", "date");

                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='SIMU Reunión plan de trabajo interno']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='SIMU Presentación plan de trabajo']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='SIMU Recolección de información']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='SIMU Reunión programación con cliente']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='SIMU Programación y logística interna']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='SIMU Elaboración de simulacro']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='SIMU Revisión de calidad interna']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='SIMU Entrega reporte y evidencias']").index()+1)+') input').attr("type", "date");

                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Reunión plan de trabajo interno']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Recolección de información']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Visita de inspección']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Confirmación planos']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Elaboración planos 3d']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Simulación']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Revisión técnica']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Entrega resultados y video']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Redacción informe']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Formulación conclusiones']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Revisión de calidad interna']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='MOD3D Entrega cliente']").index()+1)+') input').attr("type", "date");

                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Copias No\\. Carpetas solicitadas']").index()+1)+') input').attr("type", "number");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Copias Fecha de entrega al cliente']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Copias Revisión de calidad']").index()+1)+') input').attr("type", "date");

                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Planos Cumplimiento de visita']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Planos Elaboración de plano']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Planos Revisión de calidad interna']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='Planos Entrega cliente interno\\/ externo']").index()+1)+') input').attr("type", "date");

                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC MUN Integración del programa']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC MUN Fecha de ingreso municipal\\/alcaldía']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC MUN Entrega copia cliente']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC MUN Seguimiento a trámite municipal\\/alcaldía']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC MUN Respuesta a preventiva municipal']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC MUN Seguimiento preventiva municipal']").index()+1)+') input').attr("type", "date");

                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC EST Integración del programa']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC EST Fecha de ingreso estatal']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC EST Entrega copia cliente']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC EST Seguimiento a trámite estatal']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC EST Respuesta a preventiva estatal']").index()+1)+') input').attr("type", "date");
                        $('table tr td:nth-child('+($("#tabla-otis thead tr [nombreColumna='PPC EST Seguimiento preventivo estatal']").index()+1)+') input').attr("type", "date");




                    },
                    onSuccess: function (data, textStatus, jqXHR)
                    {
                        console.log("Actualizado");
                        console.table(data);
                        var idAsignacion=data['idAsignacion'];
                        if(data['preventiva'])
                        {
                            if(data['preventiva'])
                            {
                                $("#porcentajeAvance3"+data['idAsignacion']).html("5%");
                            }
                            else
                            {
                                $("#porcentajeAvance3"+data['idAsignacion']).html("0%");
                            }
                        }
                        if(data['entregaActualizacionEstatal'])
                        {
                            if(new Date(data['entregaActualizacionEstatal']).getFullYear()==new Date().getFullYear())
                            {
                                $("#entregaPEPCEstatal"+data['idAsignacion']).html(((porcentajes['Planos Cumplimiento de visita %'])?(porcentajes['Planos Cumplimiento de visita %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('Planos Cumplimiento de visita %', idAsignacion, true);

                            }
                            else
                            {
                                $("#entregaPEPCEstatal"+data['idAsignacion']).html("0%");
                                establecerCumplimiento('Planos Cumplimiento de visita %', idAsignacion, false);
                            }
                        }
                        if(data['fechaEntregaPrichos'])
                        {
                            if(data['fechaEntregaPrichos'])
                            {
                                $("#porcentajeEntregaPrichos"+data['idAsignacion']).html(((porcentajes['Planos Cumplimiento de visita %'])?(porcentajes['Planos Cumplimiento de visita %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('Planos Cumplimiento de visita %', idAsignacion, true);


                            }
                            else
                            {
                                $("#porcentajeEntregaPrichos"+data['idAsignacion']).html("0%");
                                establecerCumplimiento('Planos Cumplimiento de visita %', idAsignacion, false);
                            }
                        }
                        if(data['fechaAnexoNavideno'])
                        {
                            $("#porcentajeEntregaNavideno"+data['idAsignacion']).html(((porcentajes['Planos Cumplimiento de visita %'])?(porcentajes['Planos Cumplimiento de visita %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Planos Cumplimiento de visita %', idAsignacion, true);

                        }
                        else
                        {
                            $("#porcentajeEntregaNavideno"+data['idAsignacion']).html("0%");
                            establecerCumplimiento('Planos Cumplimiento de visita %', idAsignacion, false);
                        }
                        if(data['elaboracionPlanEmergencia'])
                        {
                            var fechaElaboracion=new Date(data["elaboracionPlanEmergencia"]);
                            var fechaHoy=new Date();
                            var numeroDias=calcularDiasEntreFechas(fechaHoy, fechaElaboracion);

                            if(numeroDias<=365)
                            {
                                $("#cumplimientoPPC"+data['idAsignacion']).html(((porcentajes['Cumplimiento PPC%'])?(porcentajes['Cumplimiento PPC%']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('Cumplimiento PPC%', idAsignacion, true);
                            }
                            else
                            {
                                $("#cumplimientoPPC"+data['idAsignacion']).html("0%");
                                establecerCumplimiento('Cumplimiento PPC%', idAsignacion, false);
                            }

                        }
                        if(data['integracionPlanEmergencia'])
                        {
                            var fechaElaboracion=new Date(data["integracionPlanEmergencia"]);
                            var fechaHoy=new Date();
                            var numeroDias=calcularDiasEntreFechas(fechaHoy, fechaElaboracion);

                            if(numeroDias<=365)
                            {
                                $("#cumplimientoIntegracion"+data['idAsignacion']).html(((porcentajes['Cumplimiento de integración'])?(porcentajes['Cumplimiento de integración']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('Cumplimiento de integración', idAsignacion, true);
                            }
                            else
                            {
                                $("#cumplimientoIntegracion"+data['idAsignacion']).html("0%");
                                establecerCumplimiento('Cumplimiento de integración', idAsignacion, false);
                            }

                        }
                        if(data['fechaIngresoTramite'])
                        {
                            var fecha1=new Date();
                            var fecha2=new Date(data["fechaIngresoTramite"]);
                            var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);

                            if(numeroDias<=365)
                            {
                                $("#cumplimientoIngresoTramite"+data['idAsignacion']).html(((porcentajes['Cumplimiento ingreso trámite %'])?(porcentajes['Cumplimiento ingreso trámite %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('Cumplimiento ingreso trámite %', idAsignacion, true);
                            }
                            else
                            {
                                $("#cumplimientoIngresoTramite"+data['idAsignacion']).html("0%");
                                establecerCumplimiento('Cumplimiento ingreso trámite %', idAsignacion, false);
                            }
                        }
                        if(data['seguimientoTramite'])
                        {
                            var modificacion=parseInt($("#seguimientosRealizadosATramite"+data['idAsignacion']).html());
                            $("#seguimientosRealizadosATramite"+data['idAsignacion']).html(++modificacion);
                        }
                        if(data["seguimientoTramite"]) {
                            var fecha2 = new Date(data["seguimientoTramite"]);
                            var fecha1 = new Date();
                            var numeroDias = calcularDiasEntreFechas(fecha1, fecha2);

                            if (numeroDias <= 31) {
                                $("#PECumplimientoSeguimientoTramite" + data['idAsignacion']).html(((porcentajes['Cumplimiento del seguimiento a trámite %'])?(porcentajes['Cumplimiento del seguimiento a trámite %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('Cumplimiento del seguimiento a trámite %', idAsignacion, true);
                            }
                            else
                            {
                                $("#PECumplimientoSeguimientoTramite" + data['idAsignacion']).html("0%");
                                establecerCumplimiento('Cumplimiento del seguimiento a trámite %', idAsignacion, false);
                            }
                        }
                        if(data['obtencionVoBoPlanEmergencia'])
                        {
                            var fecha1=new Date();
                            var fecha2=new Date(data["obtencionVoBoPlanEmergencia"]);
                            var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);

                            if(numeroDias<=365)
                            {
                                $("#cumplimientoVoBoPlanEmergencia"+data['idAsignacion']).html(((porcentajes['Cumplimiento Vo.Bo.'])?(porcentajes['Cumplimiento Vo.Bo.']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('Cumplimiento Vo.Bo.', idAsignacion, true);
                            }
                            else
                            {
                                $("#cumplimientoVoBoPlanEmergencia"+data['idAsignacion']).html("0%");
                                establecerCumplimiento('Cumplimiento Vo.Bo.', idAsignacion, false);
                            }
                        }
                        if(data["reunionPlanTrabajoInterno"]){
                            $("#cumplimientoPlanTrabajoInternoARV"+idAsignacion).html(((porcentajes['Cumplimiento plan de trabajo interno %'])?(porcentajes['Cumplimiento plan de trabajo interno %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Cumplimiento plan de trabajo interno %', idAsignacion, true);
                        }
                        if(data["presentacionEsquemaArv"]){
                            $("#presentacionEsquemaARVPorcentaje"+idAsignacion).html(((porcentajes['Presentación esquema de arv %'])?(porcentajes['Presentación esquema de arv %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Presentación esquema de arv %', idAsignacion, true);
                        }
                        if(data["cumplimientoInspeccionFisica"]){
                            $("#cumplimientoInspeccionFisicaPorcentaje"+idAsignacion).html(((porcentajes['Cumplimiento inspección física %'])?(porcentajes['Cumplimiento inspección física %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Cumplimiento inspección física %', idAsignacion, true);
                        }
                        if(data["recoleccionInformacionARV"]){
                            $("#recoleccionInformacion"+idAsignacion).html(((porcentajes['Recolección de información %'])?(porcentajes['Recolección de información %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Recolección de información %', idAsignacion, true);
                        }
                        if(data["elaboracionARV"]){
                            $("#elaboracionARVPorcentaje"+idAsignacion).html(((porcentajes['Elaboración arv %'])?(porcentajes['Elaboración arv %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Elaboración arv %', idAsignacion, true);
                        }
                        if(data["revisionInternaCalidad"]){
                            $("#revisionInternaCalidadPorcentaje"+idAsignacion).html(((porcentajes['Revisión interna de calidad %'])?(porcentajes['Revisión interna de calidad %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Revisión interna de calidad %', idAsignacion, true);
                        }
                        if(data["integracionFisicaCarpeta"]){
                            $("#integracionFisicaCarpetaPorcentaje"+idAsignacion).html(((porcentajes['Integración física carpeta%'])?(porcentajes['Integración física carpeta%']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Integración física carpeta%', idAsignacion, true);
                        }
                        if(data["entregaClienteARV"]){
                            $("#entregaClienteARVPorcentaje"+idAsignacion).html(((porcentajes['Entrega al cliente %'])?(porcentajes['Entrega al cliente %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Entrega al cliente %', idAsignacion, true);
                        }
                        if(data["obtencionVistoBuenoARV"]){
                            $("#obtencionVistoBuenoARVPorcentaje"+idAsignacion).html(((porcentajes['Obtención visto bueno %'])?(porcentajes['Obtención visto bueno %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Obtención visto bueno %', idAsignacion, true);
                        }
                        if(data["fechaSeguimientoRealizadoARV"]){
                            $("#seguimientoRealizadoARVPorcentaje"+idAsignacion).html(((porcentajes['Seguimiento %'])?(porcentajes['Seguimiento %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Seguimiento %', idAsignacion, true);
                            var modificacion=parseInt($("#seguimientosRealizadosARV"+data['idAsignacion']).html());
                            $("#seguimientosRealizadosARV"+data['idAsignacion']).html(++modificacion);
                        }
                        if(data["fechaSeguimientoSEGVisita"])
                        {
                            $("#seguimientoSEGVisitaPorcentaje"+idAsignacion).html(((porcentajes['Visita Seguimiento%'])?(porcentajes['Visita Seguimiento%']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Visita Seguimiento%', idAsignacion, true);
                        }
                        if(data['planContReunionPlanTrabajoInterno']){
                            $("#planContReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Cumplimiento plan de trabajo interno %'])?(porcentajes['Plan Cont Cumplimiento plan de trabajo interno %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('Plan Cont Cumplimiento plan de trabajo interno %', idAsignacion, true);
                        }
                        if(data['planContRecoleccionInformacion']){
                            $("#planContRecoleccionInformacionPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Recolección de información %'])?(porcentajes['Plan Cont Recolección de información %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('Plan Cont Recolección de información %', idAsignacion, true);
                        }
                        if(data['planContInspeccionFisica']){
                            $("#planContInspeccionFisicaPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Cumplimiento inspección física %'])?(porcentajes['Plan Cont Cumplimiento inspección física %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('Plan Cont Cumplimiento inspección física %', idAsignacion, true);
                        }
                        if(data['planContReporteOM']){
                            $("#planContReporteOMPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Reporte OM %'])?(porcentajes['Plan Cont Reporte OM %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('Plan Cont Reporte OM %', idAsignacion, true);
                        }
                        if(data['planContCumplimientoPlanContinuidad']){
                            $("#planContCumplimientoPlanContinuidadPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Cumplimiento plan continuidad %'])?(porcentajes['Plan Cont Cumplimiento plan continuidad %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('Plan Cont Cumplimiento plan continuidad %', idAsignacion, true);
                        }
                        if(data['planContCumplimientoIntegracion']){
                            $("#planContCumplimientoIntegracionPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Cumplimiento de integración %'])?(porcentajes['Plan Cont Cumplimiento de integración %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('Plan Cont Cumplimiento de integración %', idAsignacion, true);
                        }
                        if(data['planContRevisionInternaCalidad']){
                            $("#planContRevisionInternaCalidadPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Revisión interna de calidad %'])?(porcentajes['Plan Cont Revisión interna de calidad %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('Plan Cont Revisión interna de calidad %', idAsignacion, true);
                        }
                        if(data['planContPresentacionClienteAutoridad']){
                            $("#planContPresentacionClienteAutoridadPorcentaje"+idAsignacion).html(((porcentajes['Plan Cont Presentación %'])?(porcentajes['Plan Cont Presentación %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('Plan Cont Presentación %', idAsignacion, true);
                        }
                        if(data['simuReunionPlanTrabajoInterno'])
                        {
                            var fecha1=new Date(data["simuReunionPlanTrabajoInterno"]);
                            var fecha2=new Date(data['fechaSolicitud']);
                            var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && data["simuReunionPlanTrabajoInterno"] && data['fechaSolicitud'])
                            {
                                $("#simuReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html(((porcentajes['SIMU Cumplimiento plan de trabajo interno %'])?(porcentajes['SIMU Cumplimiento plan de trabajo interno %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('SIMU Cumplimiento plan de trabajo interno %', idAsignacion, true);
                            }
                            else
                            {
                                $("#simuReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('SIMU Cumplimiento plan de trabajo interno %', idAsignacion, false);
                            }
                        }
                        //simuPresentacionPlanTrabajoPorcentaje
                        if(data["simuPresentacionPlanTrabajo"])
                        {
                            var fecha1=new Date(data["simuPresentacionPlanTrabajo"]);
                            var otraFecha=$($('#simuReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val();
                            var fecha2=new Date(otraFecha);


                            var numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && data["simuPresentacionPlanTrabajo"] && otraFecha)
                            {
                                $("#simuPresentacionPlanTrabajoPorcentaje"+idAsignacion).html(((porcentajes['SIMU Presentación plan de trabajo %'])?(porcentajes['SIMU Presentación plan de trabajo %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('SIMU Presentación plan de trabajo %', idAsignacion, true);
                            }
                            else
                            {
                                $("#simuPresentacionPlanTrabajoPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('SIMU Presentación plan de trabajo %', idAsignacion, false);
                            }
                        }
                        //FIN simuPresentacionPlanTrabajoPorcentaje
                        if(data['simuRecoleccionInformacion']){
                            $("#simuRecoleccionInformacionPorcentaje"+idAsignacion).html(((porcentajes['SIMU Recolección de información %'])?(porcentajes['SIMU Recolección de información %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('SIMU Recolección de información %', idAsignacion, true);
                        }
                        if(data['simuReunionProgramacionCliente']){
                            $("#simuReunionProgramacionClientePorcentaje"+idAsignacion).html(((porcentajes['SIMU Reunión programación con cliente %'])?(porcentajes['SIMU Reunión programación con cliente %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('SIMU Reunión programación con cliente %', idAsignacion, true);
                        }
                        if(data['simuProgramacionLogisticaInterna']){
                            $("#simuProgramacionLogisticaInternaPorcentaje"+idAsignacion).html(((porcentajes['SIMU Programación y logística interna %'])?(porcentajes['SIMU Programación y logística interna %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('SIMU Programación y logística interna %', idAsignacion, true);
                        }
                        if(data['simuElaboracionSimulacro']){
                            $("#simuElaboracionSimulacroPorcentaje"+idAsignacion).html(((porcentajes['SIMU Elaboración de simulacro %'])?(porcentajes['SIMU Elaboración de simulacro %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('SIMU Elaboración de simulacro %', idAsignacion, true);
                        }
                        if(data['simuRevisionCalidadInterna']){
                            $("#simuRevisionCalidadInternaPorcentaje"+idAsignacion).html(((porcentajes['SIMU Revisión de calidad interna %'])?(porcentajes['SIMU Revisión de calidad interna %']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('SIMU Revisión de calidad interna %', idAsignacion, true);
                        }
                        if(data['simuEntregaReporteEvidencias']){
                            $("#simuEntregaReporteEvidenciasPorcentaje"+idAsignacion).html(((porcentajes['SIMU Entrega reporte y evidencias%'])?(porcentajes['SIMU Entrega reporte y evidencias%']['valorPorcentaje']):"0")+"%")
                            establecerCumplimiento('SIMU Entrega reporte y evidencias%', idAsignacion, true);
                        }
                        //MOD3d

                        if(data['mod3dRecoleccionInformacion'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val();
                            fecha1=new Date(data["mod3dRecoleccionInformacion"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && otraFecha)
                            {
                                $("#mod3dRecoleccionInformacionPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Recolección de información%'])?(porcentajes['MOD3D Recolección de información%']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Recolección de información%', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dRecoleccionInformacionPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Recolección de información%', idAsignacion, false);
                            }
                        }
                        if(data['mod3dVisitaInspeccion'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val();
                            fecha1=new Date(data["mod3dVisitaInspeccion"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && otraFecha)
                            {
                                $("#mod3dVisitaInspeccionPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Visita de inspección %'])?(porcentajes['MOD3D Visita de inspección %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Visita de inspección %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dVisitaInspeccionPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Visita de inspección %', idAsignacion, false);
                            }
                        }
                        if(data['mod3dConfirmacionPlanos'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val()
                            fecha1=new Date(data["mod3dConfirmacionPlanos"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && otraFecha)
                            {
                                $("#mod3dConfirmacionPlanosPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Confirmación de planos %'])?(porcentajes['MOD3D Confirmación de planos %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Confirmación de planos %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dConfirmacionPlanosPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Confirmación de planos %', idAsignacion, false);
                            }
                        }
                        if(data['mod3dElaboracionPlanos'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val()
                            fecha1=new Date(data["mod3dElaboracionPlanos"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && otraFecha)
                            {
                                $("#mod3dElaboracionPlanosPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Elaboración planos 3d %'])?(porcentajes['MOD3D Elaboración planos 3d %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Elaboración planos 3d %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dElaboracionPlanosPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Elaboración planos 3d %', idAsignacion, false);
                            }
                        }
                        if(data['mod3dSimulacion'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val()
                            fecha1=new Date(data["mod3dSimulacion"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && otraFecha)
                            {
                                $("#mod3dSimulacionPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Simulación %'])?(porcentajes['MOD3D Simulación %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Simulación %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dSimulacionPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Simulación %', idAsignacion, false);
                            }
                        }
                        if(data['mod3dRevisionTecnica'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val()
                            fecha1=new Date(data["mod3dRevisionTecnica"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && otraFecha)
                            {
                                $("#mod3dRevisionTecnicaPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Revisión técnica %'])?(porcentajes['MOD3D Revisión técnica %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Revisión técnica %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dRevisionTecnicaPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Revisión técnica %', idAsignacion, false);
                            }
                        }
                        if(data['mod3dEntregaResultadosVideo'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val()
                            fecha1=new Date(data["mod3dEntregaResultadosVideo"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && otraFecha)
                            {
                                $("#mod3dEntregaResultadosVideoPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Entrega resultados y video %'])?(porcentajes['MOD3D Entrega resultados y video %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Entrega resultados y video %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dEntregaResultadosVideoPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Entrega resultados y video %', idAsignacion, false);
                            }
                        }
                        if(data['mod3dRedaccionInforme'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val()
                            fecha1=new Date(data["mod3dRedaccionInforme"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31 && otraFecha)
                            {
                                $("#mod3dRedaccionInformePorcentaje"+idAsignacion).html(((porcentajes['MOD3D Redacción informe %'])?(porcentajes['MOD3D Redacción informe %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Redacción informe %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dRedaccionInformePorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Redacción informe %', idAsignacion, false);

                            }
                        }
                        if(data['mod3dFormulacionConclusiones'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val()
                            fecha1=new Date(data["mod3dFormulacionConclusiones"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=45 && otraFecha)
                            {
                                $("#mod3dFormulacionConclusionesPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Formulación conclusiones %'])?(porcentajes['MOD3D Formulación conclusiones %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Formulación conclusiones %', idAsignacion, true);
                            }

                            else
                            {
                                $("#mod3dFormulacionConclusionesPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Formulación conclusiones %', idAsignacion, false);

                            }
                        }
                        if(data['mod3dRevisionCalidadInterna'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val()
                            fecha1=new Date(data["mod3dRevisionCalidadInterna"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=45 && otraFecha)
                            {
                                $("#mod3dRevisionCalidadInternaPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Revisión de calidad interna %'])?(porcentajes['MOD3D Revisión de calidad interna %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Revisión de calidad interna %', idAsignacion, true);
                            }
                            else
                            {
                                $("#mod3dRevisionCalidadInternaPorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Revisión de calidad interna %', idAsignacion, false);
                            }
                        }
                        if(data['mod3dEntregaCliente'])
                        {
                            otraFecha=$($('#mod3dReunionPlanTrabajoInterno'+idAsignacion).children()[1]).val()
                            fecha1=new Date(data["mod3dEntregaCliente"]);
                            fecha2=new Date(otraFecha);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=45&& otraFecha)
                            {
                                $("#mod3dEntregaClientePorcentaje"+idAsignacion).html(((porcentajes['MOD3D Entrega cliente %'])?(porcentajes['MOD3D Entrega cliente %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('MOD3D Entrega cliente %', idAsignacion, true);
                            }
                            else
                            {
                                $("#mod3dEntregaClientePorcentaje"+idAsignacion).html("0%");
                                establecerCumplimiento('MOD3D Entrega cliente %', idAsignacion, false);

                            }
                        }
                        if(data['mod3dReunionPlanTrabajoInterno'])
                        {

                            fecha1=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                            fecha2=new Date(data['fechaSolicitud']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#mod3dReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Cumplimiento plan de trabajo interno %'])?(porcentajes['MOD3D Cumplimiento plan de trabajo interno %']['valorPorcentaje']):"0")+"%")
                                establecerCumplimiento('MOD3D Cumplimiento plan de trabajo interno %', idAsignacion, true);
                            }
                            else
                            {
                                $("#mod3dReunionPlanTrabajoInternoPorcentaje"+idAsignacion).html("0%")
                                establecerCumplimiento('MOD3D Cumplimiento plan de trabajo interno %', idAsignacion, false);

                            }


                            if($($('#mod3dRecoleccionInformacion'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dRecoleccionInformacion'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=31 )
                                {
                                    $("#mod3dRecoleccionInformacionPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Recolección de información%'])?(porcentajes['MOD3D Recolección de información%']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Recolección de información%', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dRecoleccionInformacionPorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Recolección de información%', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dVisitaInspeccion'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dVisitaInspeccion'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=31)
                                {
                                    $("#mod3dVisitaInspeccionPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Visita de inspección %'])?(porcentajes['MOD3D Visita de inspección %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Visita de inspección %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dVisitaInspeccionPorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Visita de inspección %', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dConfirmacionPlanos'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dConfirmacionPlanos'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=31)
                                {
                                    $("#mod3dConfirmacionPlanosPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Confirmación de planos %'])?(porcentajes['MOD3D Confirmación de planos %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Confirmación de planos %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dConfirmacionPlanosPorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Confirmación de planos %', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dElaboracionPlanos'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dElaboracionPlanos'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=31)
                                {
                                    $("#mod3dElaboracionPlanosPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Elaboración planos 3d %'])?(porcentajes['MOD3D Elaboración planos 3d %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Elaboración planos 3d %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dElaboracionPlanosPorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Elaboración planos 3d %', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dSimulacion'+idAsignacion).children()[1]).val())
                            {

                                fecha1=new Date($($('#mod3dSimulacion'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=31)
                                {
                                    $("#mod3dSimulacionPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Simulación %'])?(porcentajes['MOD3D Simulación %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Simulación %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dSimulacionPorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Simulación %', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dRevisionTecnica'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dRevisionTecnica'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=31 )
                                {
                                    $("#mod3dRevisionTecnicaPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Revisión técnica %'])?(porcentajes['MOD3D Revisión técnica %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Revisión técnica %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dRevisionTecnicaPorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Revisión técnica %', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dEntregaResultadosVideo'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dEntregaResultadosVideo'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=31 )
                                {
                                    $("#mod3dEntregaResultadosVideoPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Entrega resultados y video %'])?(porcentajes['MOD3D Entrega resultados y video %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Entrega resultados y video %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dEntregaResultadosVideoPorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Entrega resultados y video %', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dRedaccionInforme'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dRedaccionInforme'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=31 )
                                {
                                    $("#mod3dRedaccionInformePorcentaje"+idAsignacion).html(((porcentajes['MOD3D Redacción informe %'])?(porcentajes['MOD3D Redacción informe %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Redacción informe %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dRedaccionInformePorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Redacción informe %', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dFormulacionConclusiones'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dFormulacionConclusiones'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=45 )
                                {
                                    $("#mod3dFormulacionConclusionesPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Formulación conclusiones %'])?(porcentajes['MOD3D Formulación conclusiones %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Formulación conclusiones %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dFormulacionConclusionesPorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Formulación conclusiones %', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dRevisionCalidadInterna'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dRevisionCalidadInterna'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=45 )
                                {
                                    $("#mod3dRevisionCalidadInternaPorcentaje"+idAsignacion).html(((porcentajes['MOD3D Revisión de calidad interna %'])?(porcentajes['MOD3D Revisión de calidad interna %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Revisión de calidad interna %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dRevisionCalidadInternaPorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Revisión de calidad interna %', idAsignacion, false);

                                }
                            }
                            if($($('#mod3dEntregaCliente'+idAsignacion).children()[1]).val())
                            {
                                fecha1=new Date($($('#mod3dEntregaCliente'+idAsignacion).children()[1]).val());
                                fecha2=new Date(data["mod3dReunionPlanTrabajoInterno"]);
                                numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                                if(numeroDias<=45)
                                {
                                    $("#mod3dEntregaClientePorcentaje"+idAsignacion).html(((porcentajes['MOD3D Entrega cliente %'])?(porcentajes['MOD3D Entrega cliente %']['valorPorcentaje']):"0")+"%");
                                    establecerCumplimiento('MOD3D Entrega cliente %', idAsignacion, true);
                                }
                                else
                                {
                                    $("#mod3dEntregaClientePorcentaje"+idAsignacion).html("0%");
                                    establecerCumplimiento('MOD3D Entrega cliente %', idAsignacion, false);
                                }
                            }
                        }
                        if(data['copiasRevisionCalidad'])
                        {
                            $("#copiasRevisionCalidadPorcentaje"+idAsignacion).html(((porcentajes['Copias Cumplimiento de entrega %'])?(porcentajes['Copias Cumplimiento de entrega %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Copias Cumplimiento de entrega %', idAsignacion, true);
                        }
                        if(data['copiasFechaEntregaCliente'])
                        {
                            fecha1=new Date($('#copiasFechaEntrega'+idAsignacion).html());

                            fecha2=new Date(data['copiasFechaEntregaCliente']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias>=0)
                            {
                                $("#copiasCumplimientoEntrega"+idAsignacion).html(((porcentajes['Copias Revisión de calidad %'])?(porcentajes['Copias Revisión de calidad %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('Copias Revisión de calidad %', idAsignacion, true);
                            }
                            else
                            {
                                $("#copiasCumplimientoEntrega"+idAsignacion).html("0%");
                                establecerCumplimiento('Copias Revisión de calidad %', idAsignacion, false);
                            }
                        }
                        if(data['planosCumplimientoVisita'])
                        {
                            $("#planosCumplimientoVisitaPorcentaje"+idAsignacion).html(((porcentajes['Planos Cumplimiento de visita %'])?(porcentajes['Planos Cumplimiento de visita %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Planos Cumplimiento de visita %', idAsignacion, true);
                        }
                        if(data['planosElaboracionPlano'])
                        {
                            $("#planosElaboracionPlanoPorcentaje"+idAsignacion).html(((porcentajes['Planos Elaboración de plano %'])?(porcentajes['Planos Elaboración de plano %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Planos Elaboración de plano %', idAsignacion, true);
                        }
                        if(data['planosRevisionCalidadInterna'])
                        {
                            $("#planosRevisionCalidadInternaPorcentaje"+idAsignacion).html(((porcentajes['Planos Revisión de calidad interna %'])?(porcentajes['Planos Revisión de calidad interna %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Planos Revisión de calidad interna %', idAsignacion, true);
                        }
                        if(data['planosEntregaCliente'])
                        {
                            $("#planosEntregaClientePorcentaje"+idAsignacion).html(((porcentajes['Planos Entrega cliente interno/ externo%'])?(porcentajes['Planos Entrega cliente interno/ externo%']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('Planos Entrega cliente interno/ externo%', idAsignacion, true);
                        }
                        if(data['munIntegracionPrograma'])
                        {
                            fecha1=new Date();
                            fecha2=new Date(data['munIntegracionPrograma']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias>=365)
                            {
                                $("#munCumplimientoIntegracion"+idAsignacion).html("0%");
                                establecerCumplimiento('PPC MUN Cumplimiento de integración %', idAsignacion, false);
                            }
                            else
                            {
                                $("#munCumplimientoIntegracion"+idAsignacion).html(((porcentajes['PPC MUN Cumplimiento de integración %'])?(porcentajes['PPC MUN Cumplimiento de integración %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('PPC MUN Cumplimiento de integración %', idAsignacion, true);
                            }
                        }
                        if(data['munFechaIngresoMunicipal'])
                        {
                            fecha1=new Date();
                            fecha2=new Date(data['munFechaIngresoMunicipal']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias>=365)
                            {
                                $("#munCumplimientoIngresoMunicipal"+idAsignacion).html("0%");
                                establecerCumplimiento('PPC MUN Cumplimiento ingreso municipal/alcaldía %', idAsignacion, false);
                            }
                            else
                            {
                                $("#munCumplimientoIngresoMunicipal"+idAsignacion).html(((porcentajes['PPC MUN Cumplimiento ingreso municipal/alcaldía %'])?(porcentajes['PPC MUN Cumplimiento ingreso municipal/alcaldía %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('PPC MUN Cumplimiento ingreso municipal/alcaldía %', idAsignacion, true);
                            }
                        }
                        if(data['munSeguimientoTramiteMunicipal'])
                        {
                            fecha1=new Date();
                            fecha2=new Date(data['munSeguimientoTramiteMunicipal']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#munCumplimientoSeguimientoMunicipal"+idAsignacion).html(((porcentajes['PPC MUN Cumplimiento del seguimiento municipal %'])?(porcentajes['PPC MUN Cumplimiento del seguimiento municipal %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('PPC MUN Cumplimiento del seguimiento municipal %', idAsignacion, true);

                            }
                            else
                            {
                                $("#munCumplimientoSeguimientoMunicipal"+idAsignacion).html("0%");
                                establecerCumplimiento('PPC MUN Cumplimiento del seguimiento municipal %', idAsignacion, false);
                            }
                            $("#munSeguimientosRealizadosTramite"+idAsignacion).html(parseInt($("#munSeguimientosRealizadosTramite"+idAsignacion).html())+1);
                        }
                        if(data['munRespuestaPreventiva'])
                        {
                            $("#munRespuestaAutoridadTramite"+idAsignacion).html(((porcentajes['PPC MUN Respuesta autoridad trámite municipal %'])?(porcentajes['PPC MUN Respuesta autoridad trámite municipal %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('PPC MUN Respuesta autoridad trámite municipal %', idAsignacion, true);
                        }
                        if(data['munSeguimientoPreventivaMunicipal'])
                        {
                            $("#munSeguimientosMunicipales"+idAsignacion).html(parseInt($("#munSeguimientosMunicipales"+idAsignacion).html())+1);
                        }



                        if(data['estIntegracionPrograma'])
                        {
                            fecha1=new Date();
                            fecha2=new Date(data['estIntegracionPrograma']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias>=365)
                            {
                                $("#estCumplimientoIntegracion"+idAsignacion).html("0%");
                                establecerCumplimiento('PPC EST Cumplimiento de integración %', idAsignacion, false);
                            }
                            else
                            {
                                $("#estCumplimientoIntegracion"+idAsignacion).html(((porcentajes['PPC EST Cumplimiento de integración %'])?(porcentajes['PPC EST Cumplimiento de integración %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('PPC EST Cumplimiento de integración %', idAsignacion, true);
                            }
                        }
                        if(data['estFechaIngresoEstatal'])
                        {
                            fecha1=new Date();
                            fecha2=new Date(data['estFechaIngresoEstatal']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias>=365)
                            {
                                $("#estCumplimientoIngresoEstatal"+idAsignacion).html("0%");
                                establecerCumplimiento('PPC EST Cumplimiento ingreso estatal %', idAsignacion, false);
                            }
                            else
                            {
                                $("#estCumplimientoIngresoEstatal"+idAsignacion).html(((porcentajes['PPC EST Cumplimiento ingreso estatal %'])?(porcentajes['PPC EST Cumplimiento ingreso estatal %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('PPC EST Cumplimiento ingreso estatal %', idAsignacion, true);
                            }
                        }
                        if(data['estSeguimientoTramiteEstatal'])
                        {
                            fecha1=new Date();
                            fecha2=new Date(data['estSeguimientoTramiteEstatal']);
                            numeroDias=calcularDiasEntreFechas(fecha1, fecha2);
                            if(numeroDias<=31)
                            {
                                $("#estCumplimientoSeguimientoEstatal"+idAsignacion).html(((porcentajes['PPC EST Cumplimiento del seguimiento estatal %'])?(porcentajes['PPC EST Cumplimiento del seguimiento estatal %']['valorPorcentaje']):"0")+"%");
                                establecerCumplimiento('PPC EST Cumplimiento del seguimiento estatal %', idAsignacion, true);

                            }
                            else
                            {
                                $("#estCumplimientoSeguimientoEstatal"+idAsignacion).html("0%");
                                establecerCumplimiento('PPC EST Cumplimiento del seguimiento estatal %', idAsignacion, false);

                            }
                            $("#estSeguimientosRealizadosTramite"+idAsignacion).html(parseInt($("#estSeguimientosRealizadosTramite"+idAsignacion).html())+1);
                        }
                        if(data['estRespuestaPreventiva'])
                        {
                            $("#estRespuestaAutoridadTramite"+idAsignacion).html(((porcentajes['PPC EST Respuesta  autoridad trámite estatal %'])?(porcentajes['PPC EST Respuesta  autoridad trámite estatal %']['valorPorcentaje']):"0")+"%");
                            establecerCumplimiento('PPC EST Respuesta  autoridad trámite estatal %', idAsignacion, true);
                        }
                        if(data['estSeguimientoPreventivaEstatal'])
                        {
                            $("#estSeguimientosEstatales"+idAsignacion).html(parseInt($("#estSeguimientosEstatales"+idAsignacion).html())+1);
                        }
                        calcularPorcentajeFinal(idAsignacion);
                    }
                });
                for(var x=0; x<columnasAutorizadas.length; x++)
                {
                    $("th[nombreColumna='"+columnasAutorizadas[x]['columna']+"'],td[nombreColumna='"+columnasAutorizadas[x]['columna']+"']").attr("autorizado", true);
                }
                $("th").not("th[autorizado='true']").remove();
                $("td").not("td[autorizado='true']").remove();
                $('#tabla-otis thead tr').clone(true).appendTo( '#tabla-otis thead' );
                $('#tabla-otis thead tr:eq(1) th').each( function (i) {
                    var title = $(this).text();
                    if(i>2) {
                        $(this).html('<input type="text" placeholder="Busqueda" />');

                        $('input', this).on('keyup change', function () {
                            if (tableData.column(i).search() !== this.value) {
                                tableData
                                    .column(i)
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    }
                } );


                tableData=$('#tabla-otis').DataTable({
                    "scrollY": "400",
                    "order": [[ 0, "desc" ]],
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                    },
                    "fixedHeader": true,
                    "fixedColumns": {
                        "leftColumns": 3
                    },
                    "scrollX": true

                });

                $('#tabla-otis').on( 'page.dt', function () {

                    var info = tableData.page.info();
                    currentPage=info.page;
                    //console.log("Current: "+currentPage);
                }).on( 'draw.dt', function () {
                    tableData.page(currentPage);
                    //console.log("Estableciendo la pagina a "+currentPage);
                    $("#tabla-otis").show();
                });




            }

        });

    }

    //modal de la columna analistas
    function traerListaAnalistasForm(idA)
    {
        // alert(idA)
        $("#datosAnalistasFechas").html('');
        $.ajax({
            url : "<?php echo site_url('CrudSeguimiento/obtenerDatosAnalistaForm/')?>/" + idA,
            type: "post",
            dataType: "json",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i=0; i<data.length; i++) {

                        $("#datosAnalistasFechas").append('<tr><td>'+data[i]['fechaCaptura']+'</td><td>'+data[i]['nombre']+'</td></tr>');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

    }
    //modal de la columna analistas2
    function traerListaAnalistas(idA)
    {
        $("#datosAnalistasFechas").html('');
        $.ajax({
            url : "<?php echo site_url('CrudSeguimiento/obtenerDatosAnalista/')?>/" + idA,
            type: "post",
            dataType: "json",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i=0; i<data.length; i++) {

                        $("#datosAnalistasFechas").append('<tr><td>'+data[i]['fecha']+'</td><td>'+data[i]['nombre']+'</td></tr>');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function filtroBusqueda()
    {

        getporcentajeValor();


    }

    function fnExcelReport()
    {
        var tab_text="<meta http-equiv=\"content-type\" content=\"application/vnd.ms-excel; charset=UTF-8\"/><table border='2px'><tr bgcolor='#87AFC6'>";
        var textRange; var j=0;
        tab = document.getElementById('tablaExcel'); // id of table

        for(j = 0 ; j < tab.rows.length ; j++)
        {
            tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
            //tab_text=tab_text+"</tr>";
        }

        tab_text=tab_text+"</table>";
        //tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        //tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
        tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        {
            txtArea1.document.open("txt/html","replace");
            txtArea1.document.write(tab_text);
            txtArea1.document.close();
            txtArea1.focus();
            sa=txtArea1.document.execCommand("SaveAs",true,"SeguimientoDocumental.xls");
        }
        else                 //other browser not tested on IE 11
            sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

        return (sa);
    }

    function cargarServicios()
    {
        $("#servicio").empty();
        $("#subservicio").empty();
        if($("#idCliente").val())
        {

            $.ajax({
                url: '<?=site_url('CrudSeguimiento/cargarServicios/')?>',
                type: 'POST',
                data: {idCliente: $("#idCliente").val()},
                dataType: 'JSON',
                success:function (data)
                {
                    $("#servicio").append("<option value=''>Seleccione una opción</option>");
                    $("#subservicio").append("<option value=''>Seleccione una opción</option>");
                    for(var i=0; i<data.length;i++)
                    {
                        $("#servicio").append("<option value='"+data[i]['idProyecto']+"'>"+data[i]['nombreProyecto']+"</option>");
                    }
                }
            });
        }
    }
    function cargarSubservicios()
    {
        $("#subservicio").empty();
        $.ajax({
            url: '<?=site_url('CrudSeguimiento/cargarSubservicios/')?>',
            type: 'POST',
            data: {idCliente: $("#idCliente").val(), idServicio: $("#servicio").val()},
            dataType: 'JSON',
            success:function (data)
            {
                $("#subservicio").append("<option value=''>Seleccione una opción</option>");
                for(var i=0; i<data.length;i++)
                {
                    $("#subservicio").append("<option value='"+data[i]['idServicioSubservicio']+"'>"+data[i]['nombre']+"</option>");
                }
            }
        });
    }
    function cargarSeguimientoDocumental()
    {
        $("#contenedorTabla").empty();
        var idCliente=$("#idCliente").val();
        var idServicio=$("#servicio").val();
        var idSubservicio=$("#subservicio").val();
        if(idCliente&&idServicio&&idSubservicio)
        {
            getporcentajeValor();
        }

    }

    function calcularPorcentajeFinal(idAsignacion)
    {
        //resetea los porcentajes de una fila
        $('.porcentajeFinal'+idAsignacion).html("0%");

        $.each(porcentajesAsignacion[idAsignacion], function (index,value)
        {
            if(value['cumple'])
            {
                let porcentaje=parseFloat(value['valorPorcentaje']);
                let columnaFinal=value['subservicio'];
                let porcentajeActual=$("[class='porcentajeFinal"+idAsignacion+"'][nombreColumna='"+columnaFinal+"']").html();
                if(!porcentajeActual)
                    porcentajeActual="0";
                porcentajeActual=parseFloat(porcentajeActual.replace("%", ''));
                porcentajeActual+=porcentaje;
                $("[class='porcentajeFinal"+idAsignacion+"'][nombreColumna='"+columnaFinal+"']").html(porcentajeActual+"%");

            }
        });

    }

    function cambiarEstado()
    {
        /*
            1. Obtener el nuevo estado que selecciono el usuario
            2. Con ese estado, realizar una peticion al controlador
            3. La peticion debe traer los municipios del estado que seleccione
            4. Mostrar esos municipios
        */

        //1
        //$("#identificador").val()
        var idEstado= $("#nombreEstado").val();

        $("#nombreMunicipio").html("<option value=''>Seleccione una opción</option>");
        //2
        $.ajax({
            url: '<?=site_url("CrudSeguimiento/obtenerMunicipios/")?>'+idEstado,
            type: 'POST',
            dataType: 'JSON',
            success: function(data)
            {
                //4.

                for(var i = 0; i<data.length; i++)
                {

                    $("#nombreMunicipio").append("<option value='"+data[i]["idMunicipio"]+"' >"+data[i]["nombreMunicipio"]+"</option>");
                }
                filtroBusqueda();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                filtroBusqueda();
            }


        });

    }
    function calcularDiasEntreFechas(Fecha1, Fecha2) {
        //La fecha 1 debe ser mayor
        return Math.round((Fecha1-Fecha2)/(1000*60*60*24));
    }
</script>

<iframe id="txtArea1" style="display:none"></iframe>

<!-- /Boton flotante -->


<!-- Jquery Core Js -->
<!--JQuery UI-->
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!--Datatable-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>

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
<!--<script src="<?/*=base_url('assets/js/mfb.js.js')*/?>"></script>
-->


<!--JS PARA EDITAR IMAGENES AUTOMATICAMENTE -->
<link href="<?=base_url('assets/css/fileinput.min.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/js/piexif.min.js')?>"></script>
<script src="<?=base_url('assets/js/sortable.min.js')?>"></script>
<script src="<?=base_url('assets/js/purify.min.js')?>"></script>
<script src="<?=base_url('assets/js/fileinput.min.js')?>"></script>
<script src="<?=base_url('assets/js/es.js')?>"></script>






</body>

</html>