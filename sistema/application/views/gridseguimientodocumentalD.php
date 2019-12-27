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
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log('Error get data from ajax');
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
                                        <select class="form-control" id="idCliente" name="idCliente" onchange="cargarServicios();visualBoton();" form="formularioSeguimientoDocumental" >
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
                                        <select class="form-control" id="servicio" name="servicio" onchange="cargarSubservicios();visualBoton();" >
                                            <option value="">Seleccione una opción</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-float" >
                                    <div class="form-line">
                                        <label for="subservicio">Subservicio</label>
                                        <select class="form-control" id="subservicio" name="subservicio" onchange="visualBoton();">
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
                            <div class="col-md-offset-3 col-md-4" align="center">
                                <button onclick="cargarSeguimientoDocumental();" class="btn bg-red ">Actualizar</button>
                                <div class="col-md-offset-4 col-md-4" align="center" id="visualBColumna" style="display: none;">
                                    <input form="formularioSeguimientoDocumental" type="hidden" id="servicioSubservicio" name="servicioSubservicio">
                                    <button  class="btn bg-red " onclick="establecerSeguimientoDocumental();"> + Columnas</button>
                                   
                                </div>
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
<div id="modalSeguimientoDocumental" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Columnas del seguimiento documental</h4>
                </div>
                <div class="modal-body">
                    <form id="formularioSeguimientoDocumental">
                        <b>Cliente</b>
                            
                            <select class="form-control" id="idCliente" name="idCliente" onChange="cambiarCliente()">
                                <option value="">Seleccione un cliente</option>
                                <?php
                                foreach ($clientes as $cliente)
                                {
                                    echo "<option value='".$cliente['idCliente']."'>".$cliente['nombreCliente']."</option>";
                                }
                                ?>
                            </select>                 
                        
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1" style="padding-top: 20px;">

                                
                                <table class="table table-responsive table-hover " id="listadoColumnas" >
                                    <thead>
                                    <tr>
                                        <th>Seleccionar</th>
                                        <th>Columna</th>
                                        <th>Porcentaje/valor</th>
                                        <th>E/M</th>
                                    </tr>
                                    </thead>
                                    <tbody id="columnasSeguimientoDocumental">
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna28" id="cboxColumna28" value="Analistas"><label for="cboxColumna28"></label></td>
                                        <td>Analistas</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna28" id="numberPorcentaColumna28" ><label for="numberPorcentaColumna28"></label></td><td>
                                            <select class="form-control" id="nombreServicio28" name="nombreServicio28" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna0" id="cboxColumna0" value="%C.Visitas"><label for="cboxColumna0"></label></td>
                                        <td>%C.Visitas</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna0" id="numberPorcentaColumna0" ><label for="numberPorcentaColumna0"></label></td><td>
                                            <select class="form-control" id="nombreServicio0" name="nombreServicio0" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>

                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna1" id="cboxColumna1" value="% Estatus"><label for="cboxColumna1"> </label></td>
                                        <td>% Estatus</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna1" id="numberPorcentaColumna1" ><label for="numberPorcentaColumna1"></label></td><td>
                                            <select class="form-control" id="nombreServicio1" name="nombreServicio1" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna2" id="cboxColumna2" value="% documental"><label for="cboxColumna2"> </label></td>
                                        <td>% documental</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna2" id="numberPorcentaColumna2" ><label for="numberPorcentaColumna2"></label></td><td>
                                            <select class="form-control" id="nombreServicio2" name="nombreServicio2" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna3" id="cboxColumna3" value="% C. OM."><label for="cboxColumna3"> </label></td>
                                        <td>% C. OM.</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna3" id="numberPorcentaColumna3" ><label for="numberPorcentaColumna3"></label></td><td>
                                            <select class="form-control" id="nombreServicio3" name="nombreServicio3" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna4" id="cboxColumna4" value="Analista El."><label for="cboxColumna4"> </label></td>
                                        <td>Analista El.</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna4" id="numberPorcentaColumna4" ><label for="numberPorcentaColumna4"></label></td><td>
                                            <select class="form-control" id="nombreServicio4" name="nombreServicio4" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna5" id="cboxColumna5" value="F. U. Actualización"><label for="cboxColumna5"> </label></td>
                                        <td>F. U. Actualización</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna5" id="numberPorcentaColumna5" ><label for="numberPorcentaColumna5"></label></td><td>
                                            <select class="form-control" id="nombreServicio5" name="nombreServicio5" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna6" id="cboxColumna6" value="E./Programa %"><label for="cboxColumna6"> </label></td>
                                        <td>E./Programa %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna6" id="numberPorcentaColumna6" ><label for="numberPorcentaColumna6"></label></td><td>
                                            <select class="form-control" id="nombreServicio6" name="nombreServicio6" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna7" id="cboxColumna7" value="Entrega/Muni."><label for="cboxColumna7"> </label></td>
                                        <td>Entrega/Muni.</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna7" id="numberPorcentaColumna7" ><label for="numberPorcentaColumna7"></label></td><td>
                                            <select class="form-control" id="nombreServicio7" name="nombreServicio7" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna8" id="cboxColumna8" value="T./Entrega"><label for="cboxColumna8"> </label></td>
                                        <td>T./Entrega</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna8" id="numberPorcentaColumna8" ><label for="numberPorcentaColumna8"></label></td><td>
                                            <select class="form-control" id="nombreServicio8" name="nombreServicio8" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna9" id="cboxColumna9" value="No. Visitas"><label for="cboxColumna9"> </label></td>
                                        <td>No. Visitas</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna9" id="numberPorcentaColumna9" ><label for="numberPorcentaColumna9"></label></td><td>
                                            <select class="form-control" id="nombreServicio9" name="nombreServicio9" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna10" id="cboxColumna10" value="Vencimiento municipal"><label for="cboxColumna10"> </label></td>
                                        <td>Vencimiento municipal</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna10" id="numberPorcentaColumna10" ><label for="numberPorcentaColumna10"></label></td><td>
                                            <select class="form-control" id="nombreServicio10" name="nombreServicio10" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna11" id="cboxColumna11" value="%Vo.Bo.Mun. Obtenido"><label for="cboxColumna11"> </label></td>
                                        <td>% Vo.Bo.Mun. Obtenido</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna11" id="numberPorcentaColumna11" ><label for="numberPorcentaColumna11"></label></td><td>
                                            <select class="form-control" id="nombreServicio11" name="nombreServicio11" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna12" id="cboxColumna12" value="Programación de entrega"><label for="cboxColumna12"> </label></td>
                                        <td>Programación de entrega</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna12" id="numberPorcentaColumna12" ><label for="numberPorcentaColumna12"></label></td><td>
                                            <select class="form-control" id="nombreServicio12" name="nombreServicio12" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna13" id="cboxColumna13" value="%Entrega PEPC Municipal"><label for="cboxColumna13"> </label></td>
                                        <td>%Entrega PEPC Municipal</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna13" id="numberPorcentaColumna13" ><label for="numberPorcentaColumna13"></label></td><td>
                                            <select class="form-control" id="nombreServicio13" name="nombreServicio13" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>

                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna14" id="cboxColumna14" value="Vencimiento estatal"><label for="cboxColumna14"> </label></td>
                                        <td>Vencimiento estatal</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna14" id="numberPorcentaColumna14" ><label for="numberPorcentaColumna14"></label></td><td>
                                            <select class="form-control" id="nombreServicio14" name="nombreServicio14" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna15" id="cboxColumna15" value="%Vo.Bo. Est. Obtenido"><label for="cboxColumna15"> </label></td>
                                        <td>%Vo.Bo.Est. Obtenido</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna15" id="numberPorcentaColumna15" ><label for="numberPorcentaColumna15"></label></td><td>
                                            <select class="form-control" id="nombreServicio15" name="nombreServicio15" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna16" id="cboxColumna16" value="Entrega para actualización estatal"><label for="cboxColumna16"> </label></td>
                                        <td>Entrega para actualización estatal</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna16" id="numberPorcentaColumna16" ><label for="numberPorcentaColumna16"></label></td><td>
                                            <select class="form-control" id="nombreServicio16" name="nombreServicio16" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna17" id="cboxColumna17" value="Tipo de entrega (2)"><label for="cboxColumna17"> </label></td>
                                        <td>Tipo de entrega (2)</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna17" id="numberPorcentaColumna17" ><label for="numberPorcentaColumna17"></label></td><td>
                                            <select class="form-control" id="nombreServicio17" name="nombreServicio17" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna18" id="cboxColumna18" value="%Entrega PEPC Estatal"><label for="cboxColumna18"> </label></td>
                                        <td>%Entrega PEPC Estatal</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna18" id="numberPorcentaColumna18" ><label for="numberPorcentaColumna18"></label></td><td>
                                            <select class="form-control" id="nombreServicio18" name="nombreServicio18" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna19" id="cboxColumna19" value="Entrega copia tienda"><label for="cboxColumna19"> </label></td>
                                        <td>Entrega copia tienda</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna19" id="numberPorcentaColumna19" ><label for="numberPorcentaColumna19"></label></td><td>
                                            <select class="form-control" id="nombreServicio19" name="nombreServicio19" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna20" id="cboxColumna20" value="Fecha de entrega prichos"><label for="cboxColumna20"> </label></td>
                                        <td>Fecha de entrega prichos</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna20" id="numberPorcentaColumna20" ><label for="numberPorcentaColumna20"></label></td><td>
                                            <select class="form-control" id="nombreServicio20" name="nombreServicio20" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna21" id="cboxColumna21" value="% Entrega Prichos"><label for="cboxColumna21"> </label></td>
                                        <td>%Entrega prichos</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna21" id="numberPorcentaColumna21" ><label for="numberPorcentaColumna21"></label></td><td>
                                            <select class="form-control" id="nombreServicio21" name="nombreServicio21" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna22" id="cboxColumna22" value="Fecha de entrega anexo navideño"><label for="cboxColumna22"> </label></td>
                                        <td>Fecha de entrega anexo navideño</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna22" id="numberPorcentaColumna22" ><label for="numberPorcentaColumna22"></label></td><td>
                                            <select class="form-control" id="nombreServicio22" name="nombreServicio22"  >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna23" id="cboxColumna23" value="% Entrega anexo navideño"><label for="cboxColumna23"> </label></td>
                                        <td>% Entrega anexo navideño</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna23" id="numberPorcentaColumna23" ><label for="numberPorcentaColumna23"></label></td><td>
                                            <select class="form-control" id="nombreServicio23" name="nombreServicio23" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna24" id="cboxColumna24" value="% Avance 3"><label for="cboxColumna24"> </label></td>
                                        <td>% Avance 3</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna24" id="numberPorcentaColumna24" ><label for="numberPorcentaColumna24"></label></td><td>
                                            <select class="form-control" id="nombreServicio24" name="nombreServicio24" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna25" id="cboxColumna25" value="Observaciones"><label for="cboxColumna25"> </label></td>
                                        <td>Observaciones</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna25" id="numberPorcentaColumna25" ><label for="numberPorcentaColumna25"></label></td><td>
                                            <select class="form-control" id="nombreServicio25" name="nombreServicio25" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna26" id="cboxColumna26" value="% Cumplimiento municipal"><label for="cboxColumna26"> </label></td>
                                        <td>% Cumplimiento municipal</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna26" id="numberPorcentaColumna26" ><label for="numberPorcentaColumna26"></label></td><td>
                                            <select class="form-control" id="nombreServicio26" name="nombreServicio26" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="" name="cboxColumna27" id="cboxColumna27" value="% Cumplimiento estatal"><label for="cboxColumna27"> </label></td>
                                        <td>% Cumplimiento estatal</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna27" id="numberPorcentaColumna27" ><label for="numberPorcentaColumna27"></label></td><td>
                                            <select class="form-control" id="nombreServicio27" name="nombreServicio27" >
                                                <option value="">N/A</option>
                                                <option value="Estatal">Estatal</option>
                                                <option value="Municipal">Municipal</option>
                                                <option value="Cumplimiento de proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                            </select></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="formularioSeguimientoDocumental" class="btn bg-red" >Guardar</button>
                </div>
            </div>

        </div>
    </div>
<script type="text/javascript">
    window.onload=inicio;
    var tableData;
    var currentPage;
    function inicio()
    {
        currentPage=0;
        traerEstado();
        //getporcentajeValor();
    }
    var urlFinal="";
    function getporcentajeValor()
    {
        var tipoBusqueda=$("#tipoBusqueda").val();
        var fIni=$("#fInicial").val();
        var fFinal=$("#fFinal").val();
        var municipio=$("#nombreMunicipio").val();
        var estado=$("#nombreEstado").val();

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
        var columnasAutorizadas;
        $.ajax({
            url: urlFinal,
            dataType:'JSON',
            data: {idCliente: $("#idCliente").val(), idServicioSubservicio: $("#subservicio").val()},
            type: 'POST',
            success: function (JSONReturn) {

                var data=JSONReturn[0];
                columnasAutorizadas=JSONReturn[1];
                $("#contenedorTabla").html(' ' +
                    '<table class="table table-hover" id="tabla-otis" >' +
                    '   <thead>' +
                    '   <tr>' +
                    '   <th nombreColumna="" autorizado="true" style="display: none">Asignacion</th>' +
                    '   <th nombreColumna="" autorizado="true">Det</th>' +
                    '   <th nombreColumna="" autorizado="true">Nombre</th>' +
                    '   <th nombreColumna="" autorizado="true">Formato</th>' +
                    '   <th nombreColumna="" autorizado="true">Municipio</th>' +
                    '   <th nombreColumna="" autorizado="true">Estado</th>' +
                    '   <th nombreColumna="" autorizado="true">Ejecutiva de cuenta</th>' +
                    '   <th nombreColumna="" autorizado="true">Tipo de trámite</th>' +
                    '   <th nombreColumna="" autorizado="true">Inicio de operaciones (OTI)</th>' +
                    '   <th nombreColumna="" autorizado="true">Fecha de envío de oportunidad de mejora PENDIENTE</th>' +
                    '   <th nombreColumna="" autorizado="true">Reporte de visita (OM) % PENDIENTE</th>' +
                    '   <th nombreColumna="" autorizado="true">Fecha de visita</th>' +
                    '   <th nombreColumna="" autorizado="true">No. total de visitas</th>' +
                    '   <th nombreColumna="" autorizado="true">Recolección de información</th>' +
                    '   <th nombreColumna="" autorizado="true">Capacitación</th>' +
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
                    '   <th nombreColumna="Observaciones">Observaciones</th>' +
                    '   <th nombreColumna="% Cumplimiento municipal">% Cumplimiento municipal</th>' +
                    '   <th nombreColumna="% Cumplimiento estatal">% Cumplimiento estatal</th>' +
                    '   </tr>' +
                    '   </thead>' +
                    '   <tbody id="resul"></tbody>' +
                    '   <tfoot>' +
                    '   <tr>' +
                    '   <th nombreColumna="" autorizado="true" style="display: none">Asignacion</th>' +
                    '   <th nombreColumna="" autorizado="true">Det</th>' +
                    '   <th nombreColumna="" autorizado="true">Nombre</th>' +
                    '   <th nombreColumna="" autorizado="true">Formato</th>' +
                    '   <th nombreColumna="" autorizado="true">Municipio</th>' +
                    '   <th nombreColumna="" autorizado="true">Estado</th>' +
                    '   <th nombreColumna="" autorizado="true">Ejecutiva de cuenta</th>' +
                    '   <th nombreColumna="" autorizado="true">Tipo de trámite</th>' +
                    '   <th nombreColumna="" autorizado="true">Inicio de operaciones (OTI)</th>' +
                    '   <th nombreColumna="" autorizado="true">Fecha de envío de oportunidad de mejora PENDIENTE</th>' +
                    '   <th nombreColumna="" autorizado="true">Reporte de visita (OM) % PENDIENTE</th>' +
                    '   <th nombreColumna="" autorizado="true">Fecha de visita</th>' +
                    '   <th nombreColumna="" autorizado="true">No. total de visitas</th>' +
                    '   <th nombreColumna="" autorizado="true">Recolección de información documental</th>' +
                    '   <th nombreColumna="" autorizado="true">Capacitación</th>' +
                    '   <th nombreColumna="">Analistas</th>' +
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
                    '   <th nombreColumna="Observaciones">Observaciones</th>' +
                    '   <th nombreColumna="% Cumplimiento municipal">% Cumplimiento municipal</th>' +
                    '   <th nombreColumna="% Cumplimiento estatal">% Cumplimiento estatal</th>' +
                    '   </tr>' +
                    '   </tfoot>' +
                    '</table>');
                for (var i = 0; i < data.length; i++)
                {
                    var cumplimientoMunicipal=0;
                    var cumplimientoEstatal=0;
                    var idAsignacion=data[i]['idAsignacion'];

                    $("#resul").append(' ' +
                        '<tr>'+
                        '<td nombreColumna="" autorizado="true" style="display: none">'+data[i]['idAsignacion']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['idDet']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['nombre']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['razonSocial']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['nombreMunicipio']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['nombreEstado']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['nomContacto']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['nombreTramite']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['fechaSolicitud']+'</td>'+
                        '<td nombreColumna="" autorizado="true">Fecha de envío de oportunidad de mejora PENDIENTE</td>'+
                        '<td nombreColumna="" autorizado="true">Reporte de visita (OM) % PENDIENTE</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['fechaVisitaNormal']+'</td>'+
                        '<td nombreColumna="" autorizado="true">'+data[i]['numeroVisitasTotales']+'</td>'+
                        '<td nombreColumna="" autorizado="true" id="recoleccion'+idAsignacion+'"></td>'+
                        '<td nombreColumna="" autorizado="true">'+((data[i]['capacitacion']=='1')?'Si':((data[i]['capacitacion']=='2')?'No':'N/A'))+'</td>'+
                        '<td nombreColumna="Analistas"><a href="#" data-toggle="modal" onclick="traerListaAnalistasForm('+idAsignacion+')" data-target="#myModalAnalistasAsignados"><i class="fa fa-users"></i></a></td>'+
                        '<td nombreColumna="%C.Visitas" id="cumpliento'+idAsignacion+'">0 %</td>'+
                        '<td nombreColumna="Analistas2"><a href="#" data-toggle="modal" onclick="traerListaAnalistas('+idAsignacion+')" data-target="#myModalAnalistasAsignados"><i class="fa fa-users"></i></a></td>'+
                        '<td nombreColumna="% Estatus" style="background:#b04632;color:#fff;" id="cumplientoEstatus'+idAsignacion+'">0 %</td>'+
                        '<td nombreColumna="% documental" style="background:#b04632;color:#fff;" id="cumplientodocumental'+idAsignacion+'">0 %</td>'+
                        '<td nombreColumna="% C. OM." id="cumplientoOM'+idAsignacion+'">0 %</td>'+
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
                        '<td nombreColumna="Observaciones" id="observaciones'+idAsignacion+'"></td>'+
                        '<td nombreColumna="% Cumplimiento municipal" id="porcentajeCumplimientoMunicipal'+idAsignacion+'"></td>'+
                        '<td nombreColumna="% Cumplimiento estatal" id="porcentajeCumplimientoEstatal'+idAsignacion+'"></td>'+
                        '</tr>');

                    var cVisitas=data[i]['CVisitas'];
                    $("#cumpliento"+idAsignacion).html(cVisitas+' %');
                    cumplimientoMunicipal+=parseInt(cVisitas);
                    $("#cumplientoOM"+idAsignacion).html(cVisitas+' %');
                    cumplimientoMunicipal+=parseInt(cVisitas);

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
                        cumplimientoMunicipal+=parseInt(20);
                        porcentajedoctal="20 %";
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
                        cumplimientoMunicipal+=parseInt(20);
                    }
                    else
                    {
                        porcentaP="10 %";
                        cumplimientoMunicipal+=parseInt(10);
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
                        cumplimientoMunicipal+=parseInt(20);
                        cumplimientoEstatal+=parseInt(20);
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
                        cumplimientoMunicipal+=parseInt(10);
                    }
                    else
                    {
                        $("#entregaPEPCMunicipal"+idAsignacion).html("0%");
                    }
                    //fin de entregaPEPCMunicipal

                    $("#entregaActualizacionEstatal"+idAsignacion).html(data[i]['entregaActualizacionEstatal']);
                    $("#tipoEntrega2"+idAsignacion).html(data[i]['tipoEntrega']);
                    $("#entregaCopiaTienda"+idAsignacion).html(data[i]['entregaCopiaTienda']);

                    //%entregaPEPCEstatal
                    if(new Date(data[i]['entregaActualizacionEstatal']).getFullYear()==new Date(data[i]['fechaHoy']).getFullYear())
                    {
                        $("#entregaPEPCEstatal"+idAsignacion).html("10%");
                        cumplimientoEstatal+=10;
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
                        cumplimientoEstatal+=10;
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
                        cumplimientoEstatal+=10;
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
                        cumplimientoEstatal+=5;
                    }
                    else
                    {
                        $("#porcentajeAvance3"+idAsignacion).html("0%");
                    }
                    $("#observaciones"+idAsignacion).html(data[i]['observaciones']);

                    $("#porcentajeCumplimientoMunicipal"+idAsignacion).html("Falta definir cuales columnas son municipales, el calculo es de "+cumplimientoMunicipal);
                    $("#porcentajeCumplimientoEstatal"+idAsignacion).html("Falta definir cuales columnas son estatales, el calculo es de "+cumplimientoEstatal);
                }
//                console.table(columnasAutorizadas);

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
                        editable: [[18, 'vencimientoMunicipal'],[22, 'vencimientoEstatal'],[24, 'entregaActualizacionEstatal'],[25, 'tipoEntrega'],[27, 'entregaCopiaTienda'],[28, 'fechaEntregaPrichos'],[30, 'fechaAnexoNavideno'],[32, 'preventiva'],[34, 'observaciones']]
                    }, onDraw: function() {
                        //Selecciona todos los inputs de la columna X y les aplica un tipo date
                        $('table tr td:nth-child(19) input').attr("type", "date");
                        $('table tr td:nth-child(23) input').attr("type", "date");
                        //$('table tr td:nth-child(19) input').attr("onChange", "updateDataTable()");
                        $('table tr td:nth-child(25) input').attr("type", "date");
                        //$('table tr td:nth-child(25) input').attr("onChange", "updateDataTable()");
                        $('table tr td:nth-child(28) input').attr("type", "date");
                        $('table tr td:nth-child(29) input').attr("type", "date");
                        //$('table tr td:nth-child(29) input').attr("onChange", "updateDataTable()");
                        $('table tr td:nth-child(31) input').attr("type", "date");
                        //$('table tr td:nth-child(31) input').attr("onChange", "updateDataTable()");
                        $('table tr td:nth-child(33) input').attr("type", "date");
                        //$('table tr td:nth-child(33) input').attr("onChange", "updateDataTable()");


                    },
                    onSuccess: function (data, textStatus, jqXHR)
                    {
                        console.log("Actualizado");
                        console.table(data);
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
                                $("#entregaPEPCEstatal"+data['idAsignacion']).html("10%");

                            }
                            else
                            {
                                $("#entregaPEPCEstatal"+data['idAsignacion']).html("0%");
                            }
                        }
                        if(data['fechaEntregaPrichos'])
                        {
                            if(data['fechaEntregaPrichos'])
                            {
                                $("#porcentajeEntregaPrichos"+data['idAsignacion']).html("10%");

                            }
                            else
                            {
                                $("#porcentajeEntregaPrichos"+data['idAsignacion']).html("0%");
                            }
                        }
                        if(data['fechaAnexoNavideno'])
                        {
                            $("#porcentajeEntregaNavideno"+data['idAsignacion']).html("10%");
                        }
                        else
                        {
                            $("#porcentajeEntregaNavideno"+data['idAsignacion']).html("0%");
                        }


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
                    console.log("Current: "+currentPage);
                }).on( 'draw.dt', function () {
                    tableData.page(currentPage);
                    console.log("Estableciendo la pagina a "+currentPage);
                    $("#tabla-otis").show();
                });




            }

        });

    }

    $("#formularioSeguimientoDocumental").submit(function (e) {
            e.preventDefault();
            var formData=new FormData(document.getElementById("formularioSeguimientoDocumental"));
            $.ajax({
                url: '<?=site_url('Crudproyectos/altaSeguimientoCliente')?>',
                processData: false,
                contentType: false,
                dataType: 'HTML',
                type: 'POST',
                data: formData,
                success: function (data) {
                    swal('Exito!', 'Las columnas del seguimiento documental han sido guardadas', 'success');
                }
            });
        });

    function updateDataTable()
    {
        console.log("Ejecutando la actualizacion...");
        //tableData.draw();

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

    function establecerSeguimientoDocumental()
        {
            $("#servicioSubservicio").val($("#subservicio").val());
            cambiarCliente();
            $("#modalSeguimientoDocumental").modal('show');
        }

    function cambiarCliente()
        {
            var idCliente=$("#idCliente").val();
            var servicioSubservicio=$("#servicioSubservicio").val();
            $(":checkbox").prop("checked", false);
            if(idCliente)
            {
                $.ajax({
                    url: '<?=site_url('Crudproyectos/getColumnasCliente')?>',
                    type: 'POST',
                    data: {idCliente: idCliente, servicioSubservicio: servicioSubservicio},
                    dataType: 'JSON',
                    success: function (data)
                    {

                        for(var i=0; i<data.length; i++)
                        {
                            $(":checkbox[value='"+data[i]['columna']+"']").prop("checked", true);
                            var idInput=$("input[value='"+data[i]['columna']+"']").attr("id");
                           
                            var res = idInput.substr(11);
                            $("#numberPorcentaColumna"+res).val(data[i]['valorPorcentaje']);
                            $("#nombreServicio"+res).val(data[i]['subservicio']);
                        }

                    }
                });
            }
        }
</script>
<script>
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
</script>

<script type="text/javascript">
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
        //alert($("#idCliente").val()+" - "+$("#servicio").val())
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

    function visualBoton()
    {
        //alert($("#idCliente").val()+" - "+$("#servicio").val()+" -- "+$("#subservicio").val())
        if ($("#idCliente").val()!=null && $("#servicio").val()!=null && $("#subservicio").val()!=null)
         {
            $("#visualBColumna").show();
         }else{
            $("#visualBColumna").hide();
         }
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