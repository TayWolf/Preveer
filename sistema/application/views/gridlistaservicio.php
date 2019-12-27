<?php
include "header.php";
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
    <!-- DataTable -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" rel="stylesheet" type="text/css">


    <script type="text/javascript">

        $(function(){
            $("#form").on("submit", function(e){
                var qq = $('#form').serialize()
                //var formData = new FormData(document.getElementById("form"));
                // alert("datos"+qq);
                var url;
                var total = $("#tot").val();
                //$('#cargando').html('<img src="https://cointic.com.mx/IntraNet/Admin/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudproyectos/altaPuente/';?>"+total;;
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

                        Swal.fire({
                            title: "ÉXITO",
                            text: "Subservicios agregados correctamente.",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",
                        }).then((result) => {
                          if (result.value) {
                            location.reload();
                          }
                        })
                    });
            });
        });
    </script>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="<?=site_url('Crudproyectos');?>">
                    <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Subservicios registrados para el servicio <?=$proyecto['nombreProyecto']?>
                            </h2>

                        </div>
                        <div class="body table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subservicio</th>
                                    <th>Entregables</th>
                                    <th>Seguimiento documental</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conte=1;
                                foreach ($listaSubse as $row) {
                                    $idControl=$row["idControl"];
                                    $nombreSubser=$row["nombre"];

                                    echo "  <tr>
                                            <td>$conte</td>
                                            <td>$nombreSubser</td>
                                            <td><a href='#' onclick='establecerEntregables($idControl);'><i class='fa fa-files-o'></i></a></td>
                                            <td><a href='#' onclick='establecerSeguimientoDocumental($idControl);'><i class='material-icons'>all_inbox</i></a></td>
                                            <td><a href='#' onclick='confirmaDeletePuente($idControl);'><i class='fa fa-trash'></i></a></td>
                                        </tr>";
                                    $conte++;
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-4 col-md-offset-5">
                                    <input type="submit" data-toggle="modal" data-target="#myModalListaSubservicio" class="btn bg-red waves-effect waves-light" value="Agregar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form method="post" action="" id="form"   enctype="multipart/form-data">
        <div class="modal fade" id="myModalListaSubservicio" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Seleccione los subservicios </h4>
                        <input type="hidden" id="idServicio" name="idServicio" value="<?=$idProyecto?>">
                    </div>
                    <div class="modal-body">
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tabla-servicio">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subservicio</th>
                                    <th>Seleccionar</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contee=1;
                                foreach ($listaSubs as $row) {
                                    $idSubservicio=$row["idSubservicio"];
                                    $nombreSubs=$row["nombre"];

                                    echo "
                                            <tr>
                                                <td>$contee</td>
                                                <td>$nombreSubs</td>
                                                <td>
                                                    <input type='hidden' id='idservicio' name='idservicio' value='$idProyecto'>
                                                    <input type='checkbox' class='filled-in' name='idSS$idSubservicio' id='idSS$idSubservicio' value='$idSubservicio'>
                                                    <label for='idSS$idSubservicio'></label>
                                                </td>
                                            </tr>";
                                    $contee++;
                                }
                                //echo "<input type='hidden' id='tot' name='tot' value='$idSubservicio'>";
                                ?>
                                </tbody>
                            </table>
                            <input type='hidden' id='tot' name='tot' value='<?php echo $idSubservicio; ?>'>
                        </div>
                    </div>
                    <div class="row">
                        <div align="center">
                            <input type="submit" class="btn bg-red waves-effect waves-light" value="Aceptar">
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </form>
    <div id="modalEntregables" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Entregables del subservicio</h4>
                </div>
                <div class="modal-body">
                    <p>Al definir estos entregables, cuando se levante una OTI con el subservicio seleccionado los tomará de manera predeterminada.</p>
                    <form id="formularioEntregablesSubservicio">
                        <input type="hidden" name="idControl" id="idControl">
                        <input type="hidden" name="numeroEntregables" id="numeroEntregables">
                        <table class="table table-responsive table-hover">
                            <thead>
                            <tr>
                                <th>Seleccionar</th>
                                <th>Entregable</th>
                                <th>Cantidad</th>
                                <th>Nota</th>
                            </tr>
                            </thead>
                            <tbody id="entregablesSubservicio">

                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="formularioEntregablesSubservicio" class="btn bg-red" onclick="subirEntregablesSubservicio()">Guardar</button>
                </div>
            </div>

        </div>
    </div>
    <div id="modalSeguimientoDocumental" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg ">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Columnas del seguimiento documental</h4>
                </div>
                <div class="modal-body col-12">
                    <form id="formularioSeguimientoDocumental">
                        <b>Cliente</b>
                        <input id="servicioSubservicio" name="servicioSubservicio" type="hidden"/>
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
                            <div class="col-12 col-md-12 " style="padding-top: 20px;">
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxGeneral" name="cboxGeneral" id="cboxGeneral" onchange="activar('General', this)"><label for="cboxGeneral">Seleccionar General</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxPPC" name="cboxPPC" id="cboxPPC" onchange="activar('PPC', this)"><label for="cboxPPC">Seleccionar PPC</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxPPCMUN" name="cboxPPCMUN" id="cboxPPCMUN" onchange="activar('PPC MUN', this)"><label for="cboxPPCMUN">Seleccionar PPC MUN</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxPPCEST" name="cboxPPCEST" id="cboxPPCEST" onchange="activar('PPC EST', this)"><label for="cboxPPCEST">Seleccionar PPC EST</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxPE" name="cboxPE" id="cboxPE" onchange="activar('PE', this)"><label for="cboxPE">Seleccionar PE</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxARV" name="cboxARV" id="cboxARV" onchange="activar('ARV', this)"><label for="cboxARV">Seleccionar ARV</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxPlanCont" name="cboxPlanCont" id="cboxPlanCont" onchange="activar('Plan Cont', this)"><label for="cboxPlanCont">Seleccionar Plan Cont</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxSIMU" name="cboxSIMU" id="cboxSIMU" onchange="activar('SIMU', this)"><label for="cboxSIMU">Seleccionar SIMU</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxMOD3D" name="cboxMOD3D" id="cboxMOD3D" onchange="activar('MOD3D', this)"><label for="cboxMOD3D">Seleccionar MOD3D</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxCopias" name="cboxCopias" id="cboxCopias" onchange="activar('Copias', this)"><label for="cboxCopias">Seleccionar Copias</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxVisita" name="cboxVisita" id="cboxVisita" onchange="activar('Visita', this)"><label for="cboxVisita">Seleccionar Visita</label>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input type="checkbox" class="cboxPlanos" name="cboxPlanos" id="cboxPlanos" onchange="activar('Planos', this)"><label for="cboxPlanos">Seleccionar Planos</label>
                                </div>

                                <input type="hidden" name="idControlSeguimiento" id="idControlSeguimiento">
                                <table class="table table-responsive table-hover " id="listadoColumnas" >
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>SEG</th>
                                        <th>Columna</th>
                                        <th>Porcentaje/valor</th>
                                        <th>E/M</th>
                                    </tr>
                                    </thead>
                                    <tbody id="columnasSeguimientoDocumental">
                                    <tr>
                                        <td><input type="checkbox"  class="General"  name="cboxColumna44" id="cboxColumna44" value="Ejecutiva de cuenta"><label for="cboxColumna44"></label></td>
                                        <td>General</td>
                                        <td>Ejecutiva de cuenta</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="General"  name="cboxColumna45" id="cboxColumna45" value="Tipo de trámite"><label for="cboxColumna45"></label></td>
                                        <td>General</td>
                                        <td>Tipo de trámite</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="General"  name="cboxColumna46" id="cboxColumna46" value="Inicio de operaciones (oti)"><label for="cboxColumna46"></label></td>
                                        <td>General</td>
                                        <td>Inicio de operaciones (oti)</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="General"  name="cboxColumna47" id="cboxColumna47" value="Fecha de envío oportunidad de mejora"><label for="cboxColumna47"></label></td>
                                        <td>General</td>
                                        <td>Fecha de envío oportunidad de mejora</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="General"  name="cboxColumna48" id="cboxColumna48" value="Reporte de visita (om) %"><label for="cboxColumna48"></label></td>
                                        <td>General</td>
                                        <td>Reporte de visita (om) %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna48" id="numberPorcentaColumna48" ><label for="numberPorcentaColumna48"></label></td><td>
                                            <select  id="nombreServicio48" name="nombreServicio48" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="General"  name="cboxColumna49" id="cboxColumna49" value="Fecha de visita"><label for="cboxColumna49"></label></td>
                                        <td>General</td>
                                        <td>Fecha de visita</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="General"  name="cboxColumna50" id="cboxColumna50" value="No. total de visitas"><label for="cboxColumna50"></label></td>
                                        <td>General</td>
                                        <td>No. total de visitas</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="General"  name="cboxColumna51" id="cboxColumna51" value="Recolección de información"><label for="cboxColumna51"></label></td>
                                        <td>General</td>
                                        <td>Recolección de información</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="General"  name="cboxColumna52" id="cboxColumna52" value="Capacitación"><label for="cboxColumna52"></label></td>
                                        <td>General</td>
                                        <td>Capacitación</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <!-- SEGUIMIENTO DOCUMENTAL GENERAL RECIENTEMENTE AGREGADOS -->
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="General"  name="cboxColumna53" id="cboxColumna53" value="Fecha de envío  oportunidad de mejora">
                                            <label for="cboxColumna53"></label>
                                        </td>
                                        <td>General</td>
                                        <td>Fecha de envío  oportunidad de mejora</td>
                                        <td></td>
										<td></td>
                                    </tr>
<!-- 
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="General"  name="cboxColumna54" id="cboxColumna54" value="Reporte de visita (om) %">
                                            <label for="cboxColumna54"></label>
                                        </td>
                                        <td>General</td>
                                        <td>Reporte de visita (om) %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna54" id="numberPorcentaColumna54" ><label for="numberPorcentaColumna54"></label></td><td>
                                            <select  id="nombreServicio54" name="nombreServicio54" >
                                                <option value="">N/A</option>
                                                
                                                
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr> -->
                                    <!-- FIN DE LOS AGREGADOS GENERAL -->
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna28" id="cboxColumna28" value="Analistas"><label for="cboxColumna28"></label></td>
                                        <td>PPC</td>
                                        <td>Analistas</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna0" id="cboxColumna0" value="%C.Visitas"><label for="cboxColumna0"></label></td>
                                        <td>PPC</td>
                                        <td>%C.Visitas</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna1" id="cboxColumna1" value="% Estatus"><label for="cboxColumna1"> </label></td>
                                        <td>PPC</td><td>% Estatus</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna2" id="cboxColumna2" value="% documental"><label for="cboxColumna2"> </label></td>
                                        <td>PPC</td><td>% documental</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna3" id="cboxColumna3" value="% C. OM."><label for="cboxColumna3"> </label></td>
                                        <td>PPC</td><td>% C. OM.</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna4" id="cboxColumna4" value="Analista El."><label for="cboxColumna4"> </label></td>
                                        <td>PPC</td><td>Analista El.</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna5" id="cboxColumna5" value="F. U. Actualización"><label for="cboxColumna5"> </label></td>
                                        <td>PPC</td><td>F. U. Actualización</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna6" id="cboxColumna6" value="E./Programa %"><label for="cboxColumna6"> </label></td>
                                        <td>PPC</td><td>E./Programa %</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna7" id="cboxColumna7" value="Entrega/Muni."><label for="cboxColumna7"> </label></td>
                                        <td>PPC</td><td>Entrega/Muni.</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna8" id="cboxColumna8" value="T./Entrega"><label for="cboxColumna8"> </label></td>
                                        <td>PPC</td><td>T./Entrega</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna9" id="cboxColumna9" value="No. Visitas"><label for="cboxColumna9"> </label></td>
                                        <td>PPC</td><td>No. Visitas</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna10" id="cboxColumna10" value="Vencimiento municipal"><label for="cboxColumna10"> </label></td>
                                        <td>PPC</td><td>Vencimiento municipal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna11" id="cboxColumna11" value="%Vo.Bo.Mun. Obtenido"><label for="cboxColumna11"> </label></td>
                                        <td>PPC</td><td>% Vo.Bo.Mun. Obtenido</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna12" id="cboxColumna12" value="Programación de entrega"><label for="cboxColumna12"> </label></td>
                                        <td>PPC</td><td>Programación de entrega</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna13" id="cboxColumna13" value="%Entrega PEPC Municipal"><label for="cboxColumna13"> </label></td>
                                        <td>PPC</td><td>%Entrega PEPC Municipal</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna14" id="cboxColumna14" value="Vencimiento estatal"><label for="cboxColumna14"> </label></td>
                                        <td>PPC</td><td>Vencimiento estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna15" id="cboxColumna15" value="%Vo.Bo. Est. Obtenido"><label for="cboxColumna15"> </label></td>
                                        <td>PPC</td><td>%Vo.Bo.Est. Obtenido</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna16" id="cboxColumna16" value="Entrega para actualización estatal"><label for="cboxColumna16"> </label></td>
                                        <td>PPC</td><td>Entrega para actualización estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna17" id="cboxColumna17" value="Tipo de entrega (2)"><label for="cboxColumna17"> </label></td>
                                        <td>PPC</td><td>Tipo de entrega (2)</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna18" id="cboxColumna18" value="%Entrega PEPC Estatal"><label for="cboxColumna18"> </label></td>
                                        <td>PPC</td><td>%Entrega PEPC Estatal</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna19" id="cboxColumna19" value="Entrega copia tienda"><label for="cboxColumna19"> </label></td>
                                        <td>PPC</td><td>Entrega copia tienda</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna20" id="cboxColumna20" value="Fecha de entrega prichos"><label for="cboxColumna20"> </label></td>
                                        <td>PPC</td><td>Fecha de entrega prichos</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna21" id="cboxColumna21" value="% Entrega Prichos"><label for="cboxColumna21"> </label></td>
                                        <td>PPC</td><td>%Entrega prichos</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna22" id="cboxColumna22" value="Fecha de entrega anexo navideño"><label for="cboxColumna22"> </label></td>
                                        <td>PPC</td><td>Fecha de entrega anexo navideño</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna23" id="cboxColumna23" value="% Entrega anexo navideño"><label for="cboxColumna23"> </label></td>
                                        <td>PPC</td><td>% Entrega anexo navideño</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC"  name="cboxColumna180" id="cboxColumna180" value="Preventiva">
                                            <label for="cboxColumna180"> </label>
                                        </td>
                                        <td>PPC</td><td>Preventiva</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna24" id="cboxColumna24" value="% Avance 3"><label for="cboxColumna24"> </label></td>
                                        <td>PPC</td><td>% Avance 3</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna25" id="cboxColumna25" value="Observaciones"><label for="cboxColumna25"> </label></td>
                                        <td>PPC</td><td>Observaciones</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna26" id="cboxColumna26" value="% Cumplimiento municipal"><label for="cboxColumna26"> </label></td>
                                        <td>PPC</td><td>% Cumplimiento municipal</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC"  name="cboxColumna27" id="cboxColumna27" value="% Cumplimiento estatal"><label for="cboxColumna27"> </label></td>
                                        <td>PPC</td><td>% Cumplimiento estatal</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna150" id="cboxColumna150" value="PPC MUN Integración del programa"><label for="cboxColumna150"> </label></td>
                                        <td>PPC MUN</td><td>Integración del programa</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna151" id="cboxColumna151" value="PPC MUN Cumplimiento de integración %"><label for="cboxColumna151"> </label></td>
                                        <td>PPC MUN</td><td>Cumplimiento de integración %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna151" id="numberPorcentaColumna151" ><label for="numberPorcentaColumna151"></label></td><td>
                                            <select  id="nombreServicio151" name="nombreServicio151" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna152" id="cboxColumna152" value="PPC MUN Fecha de ingreso municipal/alcaldía"><label for="cboxColumna152"> </label></td>
                                        <td>PPC MUN</td><td>Fecha de ingreso municipal/alcaldía</td>
                                        <td></td>
										<td></td>
                                    </tr>


                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna153" id="cboxColumna153" value="PPC MUN Responsable del ingreso municipal/alcaldía"><label for="cboxColumna153"> </label></td>
                                        <td>PPC MUN</td><td>Responsable del ingreso municipal/alcaldía</td>
                                        <td></td>
										<td></td>
                                    </tr>


                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna154" id="cboxColumna154" value="PPC MUN Cumplimiento ingreso municipal/alcaldía %"><label for="cboxColumna154"> </label></td>
                                        <td>PPC MUN</td><td>Cumplimiento ingreso municipal/alcaldía %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna154" id="numberPorcentaColumna154" ><label for="numberPorcentaColumna154"></label></td><td>
                                            <select  id="nombreServicio154" name="nombreServicio154" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna155" id="cboxColumna155" value="PPC MUN Entrega copia cliente"><label for="cboxColumna155"> </label></td>
                                        <td>PPC MUN</td><td>Entrega copia cliente</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna156" id="cboxColumna156" value="PPC MUN Seguimiento a trámite municipal/alcaldía"><label for="cboxColumna156"> </label></td>
                                        <td>PPC MUN</td><td>Seguimiento a trámite municipal/alcaldía</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna157" id="cboxColumna157" value="PPC MUN No. De seguimientos realizados municipal/alcaldía"><label for="cboxColumna157"> </label></td>
                                        <td>PPC MUN</td><td>No. de seguimientos realizados municipal/alcaldía</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna158" id="cboxColumna158" value="PPC MUN Responsable del seguimiento municipal/alcaldía"><label for="cboxColumna158"> </label></td>
                                        <td>PPC MUN</td><td>Responsable del seguimiento municipal/alcaldía</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna159" id="cboxColumna159" value="PPC MUN Cumplimiento del seguimiento municipal %"><label for="cboxColumna159"> </label></td>
                                        <td>PPC MUN</td><td>Cumplimiento del seguimiento municipal %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna159" id="numberPorcentaColumna159" ><label for="numberPorcentaColumna159"></label></td><td>
                                            <select  id="nombreServicio159" name="nombreServicio159" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna164" id="cboxColumna164" value="PPC MUN Respuesta a preventiva municipal"><label for="cboxColumna164"> </label></td>
                                        <td>PPC MUN</td><td>Respuesta a preventiva municipal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna160" id="cboxColumna160" value="PPC MUN Responsable respuesta preventiva municipal"><label for="cboxColumna160"> </label></td>
                                        <td>PPC MUN</td><td>Responsable respuesta preventiva municipal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna161" id="cboxColumna161" value="PPC MUN Respuesta autoridad trámite municipal %"><label for="cboxColumna161"> </label></td>
                                        <td>PPC MUN</td><td>Respuesta autoridad trámite municipal %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna161" id="numberPorcentaColumna161" ><label for="numberPorcentaColumna161"></label></td><td>
                                            <select  id="nombreServicio161" name="nombreServicio161" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna162" id="cboxColumna162" value="PPC MUN Seguimiento preventiva municipal"><label for="cboxColumna162"> </label></td>
                                        <td>PPC MUN</td><td>Seguimiento preventiva municipal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PPC MUN"  name="cboxColumna163" id="cboxColumna163" value="PPC MUN No. de veces de seguimiento municipal"><label for="cboxColumna163"> </label></td>
                                        <td>PPC MUN</td><td>No. de veces de seguimiento municipal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC MUN"  name="cboxColumna189" id="cboxColumna189" value="Sumatoria PPC MUN">
                                            <label for="cboxColumna189"> </label>
                                        </td>
                                        <td>PPC MUN</td><td>Sumatoria PPC MUN</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <!-- REGISTROS DE PPC EST -->
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna165" id="cboxColumna165" value="PPC EST Integración del programa">
                                            <label for="cboxColumna165"> </label>
                                        </td>
                                        <td>PPC EST</td><td>Integración del programa</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna166" id="cboxColumna166" value="PPC EST Cumplimiento de integración %">
                                            <label for="cboxColumna166"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Cumplimiento de integración %</td>
                                        <td>
                                            <input type="number" class="" name="numberPorcentaColumna166" id="numberPorcentaColumna166" >
                                            <label for="numberPorcentaColumna166"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio166" name="nombreServicio166" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna167" id="cboxColumna167" value="PPC EST Fecha de ingreso estatal">
                                            <label for="cboxColumna167"> </label>
                                        </td>
                                        <td>PPC EST</td><td>Fecha de ingreso estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna168" id="cboxColumna168" value="PPC EST Responsable del ingreso estatal">
                                            <label for="cboxColumna168"> </label>
                                        </td>
                                        <td>PPC EST</td><td>Responsable del ingreso estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna169" id="cboxColumna169" value="PPC EST Cumplimiento ingreso estatal %">
                                            <label for="cboxColumna169"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Cumplimiento ingreso estatal %</td>
                                        <td>
                                            <input type="number" class="" name="numberPorcentaColumna169" id="numberPorcentaColumna169" >
                                            <label for="numberPorcentaColumna169"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio169" name="nombreServicio169" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna170" id="cboxColumna170" value="PPC EST Entrega copia cliente">
                                            <label for="cboxColumna170"> </label>
                                        </td>
                                        <td>PPC EST</td><td>Entrega copia cliente</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna171" id="cboxColumna171" value="PPC EST Seguimiento a trámite estatal">
                                            <label for="cboxColumna171"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Seguimiento a trámite estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna172" id="cboxColumna172" value="PPC EST No. De seguimientos realizados estatal">
                                            <label for="cboxColumna172"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>No. De seguimientos realizados estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna173" id="cboxColumna173" value="PPC EST Responsable del seguimiento estatal">
                                            <label for="cboxColumna173"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Responsable del seguimiento estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna174" id="cboxColumna174" value="PPC EST Cumplimiento del seguimiento estatal %">
                                            <label for="cboxColumna174"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Cumplimiento del seguimiento estatal %</td>
                                        <td>
                                            <input type="number" class="" name="numberPorcentaColumna174" id="numberPorcentaColumna174" >
                                            <label for="numberPorcentaColumna174"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio174" name="nombreServicio174" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna175" id="cboxColumna175" value="PPC EST Respuesta a preventiva estatal">
                                            <label for="cboxColumna175"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Respuesta a preventiva estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna176" id="cboxColumna176" value="PPC EST Responsable respuesta preventiva estatal">
                                            <label for="cboxColumna176"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Responsable respuesta preventiva estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna177" id="cboxColumna177" value="PPC EST Respuesta  autoridad trámite estatal %">
                                            <label for="cboxColumna177"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Respuesta  autoridad trámite estatal %</td>
                                        <td>
                                            <input type="number" class="" name="numberPorcentaColumna177" id="numberPorcentaColumna177" >
                                            <label for="numberPorcentaColumna177"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio177" name="nombreServicio177" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna178" id="cboxColumna178" value="PPC EST Seguimiento preventivo estatal">
                                            <label for="cboxColumna178"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Seguimiento preventiva estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna179" id="cboxColumna179" value="PPC EST No. De veces de seguimiento estatal">
                                            <label for="cboxColumna179"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>No. De veces de seguimiento estatal</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PPC EST"  name="cboxColumna188" id="cboxColumna188" value="Sumatoria PPC EST">
                                            <label for="cboxColumna188"> </label>
                                        </td>
                                        <td>PPC EST</td>
                                        <td>Sumatoria PPC EST</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <!--FIN DE PPC, INICIO DE PLAN DE EMERGENCIA (PE)-->
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna29" id="cboxColumna29" value="Elaboracion del plan de emergencia"><label for="cboxColumna29"> </label></td>
                                        <td>PE</td><td>Elaboración del plan de emergencia</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna30" id="cboxColumna30" value="Cumplimiento PPC%"><label for="cboxColumna30"> </label></td>
                                        <td>PE</td><td>Cumplimiento PPC%</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna30" id="numberPorcentaColumna30" ><label for="numberPorcentaColumna30"></label></td><td>
                                            <select  id="nombreServicio30" name="nombreServicio30" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna31" id="cboxColumna31" value="Integración del plan de emergencia"><label for="cboxColumna31"> </label></td>
                                        <td>PE</td><td>Integración del plan de emergencia</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna32" id="cboxColumna32" value="Cumplimiento de integración"><label for="cboxColumna32"> </label></td>
                                        <td>PE</td><td>Cumplimiento de integración</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna32" id="numberPorcentaColumna32" ><label for="numberPorcentaColumna32"></label></td><td>
                                            <select  id="nombreServicio32" name="nombreServicio32" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna33" id="cboxColumna33" value="Fecha de ingreso a trámite"><label for="cboxColumna33"> </label></td>
                                        <td>PE</td><td>Fecha de ingreso a trámite</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna34" id="cboxColumna34" value="Responsable del ingreso a trámite"><label for="cboxColumna34"> </label></td>
                                        <td>PE</td><td>Responsable del ingreso a trámite</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna35" id="cboxColumna35" value="Cumplimiento ingreso trámite %"><label for="cboxColumna35"> </label></td>
                                        <td>PE</td><td>Cumplimiento ingreso trámite %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna35" id="numberPorcentaColumna35" ><label for="numberPorcentaColumna35"></label></td><td>
                                            <select  id="nombreServicio35" name="nombreServicio35" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna36" id="cboxColumna36" value="Entrega copia cliente"><label for="cboxColumna36"> </label></td>
                                        <td>PE</td><td>Entrega copia cliente</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna37" id="cboxColumna37" value="Seguimiento a trámite"><label for="cboxColumna37"> </label></td>
                                        <td>PE</td><td>Seguimiento a trámite</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna38" id="cboxColumna38" value="No. de seguimientos realizados a trámite"><label for="cboxColumna38"> </label></td>
                                        <td>PE</td><td>No. de seguimientos realizados a trámite</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna39" id="cboxColumna39" value="Responsable del seguimiento a trámite"><label for="cboxColumna39"> </label></td>
                                        <td>PE</td><td>Responsable del seguimiento a trámite</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna40" id="cboxColumna40" value="Cumplimiento del seguimiento a trámite %"><label for="cboxColumna40"> </label></td>
                                        <td>PE</td><td>Cumplimiento del seguimiento a trámite %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna40" id="numberPorcentaColumna40" ><label for="numberPorcentaColumna40"></label></td><td>
                                            <select  id="nombreServicio40" name="nombreServicio40" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna41" id="cboxColumna41" value="Obtención de Vo.Bo."><label for="cboxColumna41"> </label></td>
                                        <td>PE</td><td>Obtención de Vo.Bo.</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox"  class="PE"  name="cboxColumna42" id="cboxColumna42" value="Cumplimiento Vo.Bo."><label for="cboxColumna42"> </label></td>
                                        <td>PE</td><td>Cumplimiento Vo.Bo.</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna42" id="numberPorcentaColumna42" ><label for="numberPorcentaColumna42"></label></td><td>
                                            <select  id="nombreServicio42" name="nombreServicio42">
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="PE"  name="cboxColumna43" id="cboxColumna43" value="Cumplimiento proceso plan de emergencia">
                                            <label for="cboxColumna43"></label>
                                        </td>
                                        <td>PE</td><td>Cumplimiento proceso plan de emergencia</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <!-- SEGUIMIENTO DOCUMENTAL ARV NUEVOS REGISTROS -->
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna55" id="cboxColumna55" value="Reunión plan de trabajo interno">
                                            <label for="cboxColumna55"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Reunión plan de trabajo interno</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna56" id="cboxColumna56" value="Cumplimiento plan de trabajo interno %">
                                            <label for="cboxColumna56"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Cumplimiento plan de trabajo interno %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna56" id="numberPorcentaColumna56" >
                                            <label for="numberPorcentaColumna56"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio56" name="nombreServicio56" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna57" id="cboxColumna57" value="Presentación esquema de arv">
                                            <label for="cboxColumna57"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Presentación esquema de arv</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna58" id="cboxColumna58" value="Presentación esquema de arv %">
                                            <label for="cboxColumna58"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Presentación esquema de arv %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna58" id="numberPorcentaColumna58" >
                                            <label for="numberPorcentaColumna58"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio58" name="nombreServicio58" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna148" id="cboxColumna148" value="inspección físicaARV">
                                            <label for="cboxColumna148"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Inspección física</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna59" id="cboxColumna59" value="Cumplimiento inspección física %">
                                            <label for="cboxColumna59"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Cumplimiento inspección física %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna59" id="numberPorcentaColumna59" >
                                            <label for="numberPorcentaColumna59"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio59" name="nombreServicio59" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna149" id="cboxColumna149" value="Recolección de información ARV">
                                            <label for="cboxColumna149"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Recolección de información</td>
                                        <td></td>
										<td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna60" id="cboxColumna60" value="Recolección de información %">
                                            <label for="cboxColumna60"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Recolección de información %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna60" id="numberPorcentaColumna60" >
                                            <label for="numberPorcentaColumna60"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio60" name="nombreServicio60" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna61" id="cboxColumna61" value="Elaboración arv">
                                            <label for="cboxColumna61"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Elaboración arv</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna62" id="cboxColumna62" value="Elaboración arv %">
                                            <label for="cboxColumna62"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Elaboración arv %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna62" id="numberPorcentaColumna62" >
                                            <label for="numberPorcentaColumna62"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio62" name="nombreServicio62" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna63" id="cboxColumna63" value="Revisión interna de calidad">
                                            <label for="cboxColumna63"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Revisión interna de calidad</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna64" id="cboxColumna64" value="Revisión interna de calidad %">
                                            <label for="cboxColumna64"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Revisión interna de calidad %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna64" id="numberPorcentaColumna64" >
                                            <label for="numberPorcentaColumna64"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio64" name="nombreServicio64" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna65" id="cboxColumna65" value="Integración física carpeta">
                                            <label for="cboxColumna65"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Integración física carpeta</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna66" id="cboxColumna66" value="Integración física carpeta%">
                                            <label for="cboxColumna66"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Integración física carpeta%</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna66" id="numberPorcentaColumna66" >
                                            <label for="numberPorcentaColumna66"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio66" name="nombreServicio66" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna67" id="cboxColumna67" value="Presentación al cliente/autoridad">
                                            <label for="cboxColumna67"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Presentación al cliente/autoridad</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna68" id="cboxColumna68" value="Entrega al cliente %">
                                            <label for="cboxColumna68"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Entrega al cliente %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna68" id="numberPorcentaColumna68" >
                                            <label for="numberPorcentaColumna68"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio68" name="nombreServicio68" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna69" id="cboxColumna69" value="Entrega al cliente">
                                            <label for="cboxColumna69"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Entrega al cliente</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna147" id="cboxColumna147" value="Fecha de seguimiento realizado">
                                            <label for="cboxColumna147"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Fecha de seguimiento realizado</td>
                                        <td></td>
										<td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna70" id="cboxColumna70" value="No. De segimiento s realizados">
                                            <label for="cboxColumna70"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>No. de seguimientos realizados</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna71" id="cboxColumna71" value="Responsable de seguimiento">
                                            <label for="cboxColumna71"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Responsable de seguimiento</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna72" id="cboxColumna72" value="Seguimiento %">
                                            <label for="cboxColumna72"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Seguimiento %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna72" id="numberPorcentaColumna72" >
                                            <label for="numberPorcentaColumna72"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio72" name="nombreServicio72" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna73" id="cboxColumna73" value="Obtención visto bueno">
                                            <label for="cboxColumna73"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Obtención visto bueno</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna74" id="cboxColumna74" value="Obtención visto bueno %">
                                            <label for="cboxColumna74"></label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Obtención visto bueno %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna74" id="numberPorcentaColumna74" >
                                            <label for="numberPorcentaColumna74"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio74" name="nombreServicio74" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="ARV"  name="cboxColumna181" id="cboxColumna181" value="Sumatoria ARV">
                                            <label for="cboxColumna181"> </label>
                                        </td>
                                        <td>ARV</td>
                                        <td>Sumatoria ARV</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- FIN DE LOS REGISTROS ARV NUEVOS -->

                                    <!-- SEGUMIENTO DOCUMENTAL REGISTROS DE PLAN CONT -->
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna75" id="cboxColumna75" value="Plan Cont Reunión plan de trabajo interno">
                                            <label for="cboxColumna75"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Reunión plan de trabajo interno</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna76" id="cboxColumna76" value="Plan Cont Cumplimiento plan de trabajo interno %">
                                            <label for="cboxColumna76"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Cumplimiento plan de trabajo interno %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna76" id="numberPorcentaColumna76" >
                                            <label for="numberPorcentaColumna76"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio76" name="nombreServicio76" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna77" id="cboxColumna77" value="Plan Cont Recolección de información">
                                            <label for="cboxColumna77"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Recolección de información </td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna78" id="cboxColumna78" value="Plan Cont Recolección de información %">
                                            <label for="cboxColumna78"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Recolección de información %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna78" id="numberPorcentaColumna78" >
                                            <label for="numberPorcentaColumna78"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio78" name="nombreServicio78" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna79" id="cboxColumna79" value="Plan Cont Inspección física">
                                            <label for="cboxColumna79"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Inspección física</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna80" id="cboxColumna80" value="Plan Cont Cumplimiento inspección física %">
                                            <label for="cboxColumna80"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Cumplimiento inspección física %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna80" id="numberPorcentaColumna80" >
                                            <label for="numberPorcentaColumna80"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio80" name="nombreServicio80" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna81" id="cboxColumna81" value="Plan Cont Reporte OM">
                                            <label for="cboxColumna81"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Reporte OM</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna82" id="cboxColumna82" value="Plan Cont Reporte OM %">
                                            <label for="cboxColumna82"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Reporte OM %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna82" id="numberPorcentaColumna82" >
                                            <label for="numberPorcentaColumna82"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio82" name="nombreServicio82" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna83" id="cboxColumna83" value="Plan Cont Cumplimiento plan continuidad">
                                            <label for="cboxColumna83"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Cumplimiento plan continuidad</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna84" id="cboxColumna84" value="Plan Cont Cumplimiento plan continuidad %">
                                            <label for="cboxColumna84"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Cumplimiento plan continuidad %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna84" id="numberPorcentaColumna84" >
                                            <label for="numberPorcentaColumna84"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio84" name="nombreServicio84" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna85" id="cboxColumna85" value="Plan Cont Cumplimiento de integración">
                                            <label for="cboxColumna85"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Cumplimiento de integración</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna86" id="cboxColumna86" value="Plan Cont Cumplimiento de integración %">
                                            <label for="cboxColumna86"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Cumplimiento de integración %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna86" id="numberPorcentaColumna86" >
                                            <label for="numberPorcentaColumna86"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio86" name="nombreServicio86" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna87" id="cboxColumna87" value="Plan Cont Revisión interna de calidad">
                                            <label for="cboxColumna87"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Revisión interna de calidad</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna88" id="cboxColumna88" value="Plan Cont Revisión interna de calidad %">
                                            <label for="cboxColumna88"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Revisión interna de calidad %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna88" id="numberPorcentaColumna88" >
                                            <label for="numberPorcentaColumna88"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio88" name="nombreServicio88" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna89" id="cboxColumna89" value="Plan Cont Presentación al cliente/autoridad">
                                            <label for="cboxColumna89"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Presentación al cliente/autoridad</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna90" id="cboxColumna90" value="Plan Cont Presentación %">
                                            <label for="cboxColumna90"></label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Presentación %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna90" id="numberPorcentaColumna90" >
                                            <label for="numberPorcentaColumna90"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio90" name="nombreServicio90" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Plan Cont"  name="cboxColumna182" id="cboxColumna182" value="Sumatoria Plan Cont">
                                            <label for="cboxColumna182"> </label>
                                        </td>
                                        <td>Plan Cont</td>
                                        <td>Sumatoria Plan Cont</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- FIN DE REGSITROS PLAN CONT -->

                                    <!-- SEGUIMIENTO DOCUMENTAL REGISTROS SIMU -->
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna91" id="cboxColumna91" value="SIMU Reunión plan de trabajo interno">
                                            <label for="cboxColumna91"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Reunión plan de trabajo interno</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna92" id="cboxColumna92" value="SIMU Cumplimiento plan de trabajo interno %">
                                            <label for="cboxColumna92"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Cumplimiento plan de trabajo interno %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna92" id="numberPorcentaColumna92" >
                                            <label for="numberPorcentaColumna92"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio92" name="nombreServicio92" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna93" id="cboxColumna93" value="SIMU Presentación plan de trabajo">
                                            <label for="cboxColumna93"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Presentación plan de trabajo</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna94" id="cboxColumna94" value="SIMU Presentación plan de trabajo %">
                                            <label for="cboxColumna94"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Presentación plan de trabajo %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna94" id="numberPorcentaColumna94" >
                                            <label for="numberPorcentaColumna94"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio94" name="nombreServicio94" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna95" id="cboxColumna95" value="SIMU Recolección de información">
                                            <label for="cboxColumna95"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Recolección de información</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna96" id="cboxColumna96" value="SIMU Recolección de información %">
                                            <label for="cboxColumna96"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Recolección de información %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna96" id="numberPorcentaColumna96" >
                                            <label for="numberPorcentaColumna96"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio96" name="nombreServicio96" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna97" id="cboxColumna97" value="SIMU Reunión programación con cliente">
                                            <label for="cboxColumna97"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Reunión programación con cliente</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna98" id="cboxColumna98" value="SIMU Reunión programación con cliente %">
                                            <label for="cboxColumna98"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Reunión programación con cliente %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna98" id="numberPorcentaColumna98" >
                                            <label for="numberPorcentaColumna98"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio98" name="nombreServicio98" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna99" id="cboxColumna99" value="SIMU Programación y logística interna">
                                            <label for="cboxColumna99"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Programación y logística interna</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna100" id="cboxColumna100" value="SIMU Programación y logística interna %">
                                            <label for="cboxColumna100"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Programación y logística interna %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna100" id="numberPorcentaColumna100" >
                                            <label for="numberPorcentaColumna100"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio100" name="nombreServicio100" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna101" id="cboxColumna101" value="SIMU Elaboración de simulacro">
                                            <label for="cboxColumna101"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Elaboración de simulacro</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna102" id="cboxColumna102" value="SIMU Elaboración de simulacro %">
                                            <label for="cboxColumna102"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Elaboración de simulacro %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna102" id="numberPorcentaColumna102" >
                                            <label for="numberPorcentaColumna102"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio102" name="nombreServicio102" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna103" id="cboxColumna103" value="SIMU Revisión de calidad interna">
                                            <label for="cboxColumna103"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Revisión de calidad interna</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna104" id="cboxColumna104" value="SIMU Revisión de calidad interna %">
                                            <label for="cboxColumna104"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Revisión de calidad interna %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna104" id="numberPorcentaColumna104" >
                                            <label for="numberPorcentaColumna104"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio104" name="nombreServicio104" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna105" id="cboxColumna105" value="SIMU Entrega reporte y evidencias">
                                            <label for="cboxColumna105"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Entrega reporte y evidencias</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna106" id="cboxColumna106" value="SIMU Entrega reporte y evidencias%">
                                            <label for="cboxColumna106"></label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Entrega reporte y evidencias%</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna106" id="numberPorcentaColumna106" >
                                            <label for="numberPorcentaColumna106"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio106" name="nombreServicio106" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="SIMU"  name="cboxColumna183" id="cboxColumna183" value="Sumatoria SIMU">
                                            <label for="cboxColumna183"> </label>
                                        </td>
                                        <td>SIMU</td>
                                        <td>Sumatoria SIMU</td>
                                        <td></td>
                                        <td></td>
                                            
                                    </tr>
                                    <!-- FIN DE REGISTROS SIMU -->

                                    <!-- SEGUIMIENTO DOCUMENTAL REGISTROS MOD3D -->
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna107" id="cboxColumna107" value="MOD3D Reunión plan de trabajo interno">
                                            <label for="cboxColumna107"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Reunión plan de trabajo interno</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna108" id="cboxColumna108" value="MOD3D Cumplimiento plan de trabajo interno %">
                                            <label for="cboxColumna108"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Cumplimiento plan de trabajo interno %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna108" id="numberPorcentaColumna108" >
                                            <label for="numberPorcentaColumna108"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio108" name="nombreServicio108" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna109" id="cboxColumna109" value="MOD3D Recolección de información">
                                            <label for="cboxColumna109"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Recolección de información</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna110" id="cboxColumna110" value="MOD3D Recolección de información%">
                                            <label for="cboxColumna110"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Recolección de información%</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna110" id="numberPorcentaColumna110" >
                                            <label for="numberPorcentaColumna110"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio110" name="nombreServicio110" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna111" id="cboxColumna111" value="MOD3D Visita de inspección">
                                            <label for="cboxColumna111"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Visita de inspección</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna112" id="cboxColumna112" value="MOD3D Visita de inspección %">
                                            <label for="cboxColumna112"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Visita de inspección %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna112" id="numberPorcentaColumna112" >
                                            <label for="numberPorcentaColumna112"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio112" name="nombreServicio112" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna113" id="cboxColumna113" value="MOD3D Confirmación planos">
                                            <label for="cboxColumna113"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Confirmación planos</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna114" id="cboxColumna114" value="MOD3D Confirmación de planos %">
                                            <label for="cboxColumna114"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Confirmación de planos %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna114" id="numberPorcentaColumna114" >
                                            <label for="numberPorcentaColumna114"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio114" name="nombreServicio114" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna115" id="cboxColumna115" value="MOD3D Elaboración planos 3d">
                                            <label for="cboxColumna115"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Elaboración planos 3d</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna116" id="cboxColumna116" value="MOD3D Elaboración planos 3d %">
                                            <label for="cboxColumna116"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Elaboración planos 3d %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna116" id="numberPorcentaColumna116" >
                                            <label for="numberPorcentaColumna116"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio116" name="nombreServicio116" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna117" id="cboxColumna117" value="MOD3D Simulación">
                                            <label for="cboxColumna117"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Simulación</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna118" id="cboxColumna118" value="MOD3D Simulación %">
                                            <label for="cboxColumna118"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Simulación %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna118" id="numberPorcentaColumna118" >
                                            <label for="numberPorcentaColumna118"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio118" name="nombreServicio118" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna119" id="cboxColumna119" value="MOD3D Revisión técnica">
                                            <label for="cboxColumna119"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Revisión técnica</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna120" id="cboxColumna120" value="MOD3D Revisión técnica %">
                                            <label for="cboxColumna120"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Revisión técnica %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna120" id="numberPorcentaColumna120" >
                                            <label for="numberPorcentaColumna120"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio120" name="nombreServicio120" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna121" id="cboxColumna121" value="MOD3D Entrega resultados y video">
                                            <label for="cboxColumna121"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Entrega resultados y video</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna122" id="cboxColumna122" value="MOD3D Entrega resultados y video %">
                                            <label for="cboxColumna122"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Entrega resultados y video %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna122" id="numberPorcentaColumna122" >
                                            <label for="numberPorcentaColumna122"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio122" name="nombreServicio122" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna123" id="cboxColumna123" value="MOD3D Redacción informe">
                                            <label for="cboxColumna123"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Redacción informe</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna124" id="cboxColumna124" value="MOD3D Redacción informe %">
                                            <label for="cboxColumna124"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Redacción informe %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna124" id="numberPorcentaColumna124" >
                                            <label for="numberPorcentaColumna124"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio124" name="nombreServicio124" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna125" id="cboxColumna125" value="MOD3D Formulación conclusiones">
                                            <label for="cboxColumna125"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Formulación conclusiones</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna126" id="cboxColumna126" value="MOD3D Formulación conclusiones %">
                                            <label for="cboxColumna126"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Formulación conclusiones %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna126" id="numberPorcentaColumna126" >
                                            <label for="numberPorcentaColumna126"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio126" name="nombreServicio126" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna127" id="cboxColumna127" value="MOD3D Revisión de calidad interna">
                                            <label for="cboxColumna127"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Revisión de calidad interna</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna128" id="cboxColumna128" value="MOD3D Revisión de calidad interna %">
                                            <label for="cboxColumna128"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Revisión de calidad interna %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna128" id="numberPorcentaColumna128" >
                                            <label for="numberPorcentaColumna128"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio128" name="nombreServicio128" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna129" id="cboxColumna129" value="MOD3D Entrega cliente">
                                            <label for="cboxColumna129"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Entrega cliente</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna130" id="cboxColumna130" value="MOD3D Entrega cliente %">
                                            <label for="cboxColumna130"></label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Entrega cliente %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna130" id="numberPorcentaColumna130" >
                                            <label for="numberPorcentaColumna130"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio130" name="nombreServicio130" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="MOD3D"  name="cboxColumna184" id="cboxColumna184" value="Sumatoria MOD3D">
                                            <label for="cboxColumna184"> </label>
                                        </td>
                                        <td>MOD3D</td>
                                        <td>Sumatoria MOD3D</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- FIN DE REGISTROS MOD3D -->

                                    <!-- SEGUIMIENTO DOCUMENTAL REGISTROS COPIAS -->
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Copias"  name="cboxColumna131" id="cboxColumna131" value="Copias Fecha de entrega requerida">
                                            <label for="cboxColumna131"></label>
                                        </td>
                                        <td>Copias</td>
                                        <td>Fecha de entrega requerida</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Copias"  name="cboxColumna132" id="cboxColumna132" value="Copias No. Carpetas solicitadas">
                                            <label for="cboxColumna132"></label>
                                        </td>
                                        <td>Copias</td>
                                        <td>No. Carpetas solicitadas</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Copias"  name="cboxColumna133" id="cboxColumna133" value="Copias Fecha de entrega al cliente">
                                            <label for="cboxColumna133"></label>
                                        </td>
                                        <td>Copias</td>
                                        <td>Fecha de entrega al cliente</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Copias"  name="cboxColumna134" id="cboxColumna134" value="Copias Cumplimiento de entrega %">
                                            <label for="cboxColumna134"></label>
                                        </td>
                                        <td>Copias</td>
                                        <td>Cumplimiento de entrega %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna134" id="numberPorcentaColumna134" >
                                            <label for="numberPorcentaColumna134"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio134" name="nombreServicio134" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Copias"  name="cboxColumna135" id="cboxColumna135" value="Copias Revisión de calidad">
                                            <label for="cboxColumna135"></label>
                                        </td>
                                        <td>Copias</td>
                                        <td>Revisión de calidad</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Copias"  name="cboxColumna136" id="cboxColumna136" value="Copias Revisión de calidad %">
                                            <label for="cboxColumna136"></label>
                                        </td>
                                        <td>Copias</td>
                                        <td>Revisión de calidad %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna136" id="numberPorcentaColumna136" >
                                            <label for="numberPorcentaColumna136"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio136" name="nombreServicio136" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Copias"  name="cboxColumna185" id="cboxColumna185" value="Sumatoria Copias">
                                            <label for="cboxColumna185"> </label>
                                        </td>
                                        <td>Copias</td>
                                        <td>Sumatoria Copias</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- FIN DE REGISTROS COPIAS -->

                                    <!-- SEGUIMIENTO DOCUMENTAL REGISTROS DE VISITA -->
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Visita"  name="cboxColumna137" id="cboxColumna137" value="Visita Seguimiento">
                                            <label for="cboxColumna137"></label>
                                        </td>
                                        <td>Visita</td>
                                        <td>Seguimiento</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Visita"  name="cboxColumna138" id="cboxColumna138" value="Visita Seguimiento%">
                                            <label for="cboxColumna138"></label>
                                        </td>
                                        <td>Visita</td>
                                        <td>Seguimiento%</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna138" id="numberPorcentaColumna138" >
                                            <label for="numberPorcentaColumna138"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio138" name="nombreServicio138" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Visita"  name="cboxColumna186" id="cboxColumna186" value="Sumatoria Visita">
                                            <label for="cboxColumna186"> </label>
                                        </td>
                                        <td>Visita</td>
                                        <td>Sumatoria Visita</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <!-- FIN DE REGISTROS DE VISITA -->

                                    <!-- SEGUIMIENTO DOCUMENTAL REGISTROS PLANOS -->
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Planos"  name="cboxColumna139" id="cboxColumna139" value="Planos Cumplimiento de visita">
                                            <label for="cboxColumna139"></label>
                                        </td>
                                        <td>Planos</td>
                                        <td>Cumplimiento de visita</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Planos"  name="cboxColumna140" id="cboxColumna140" value="Planos Cumplimiento de visita %">
                                            <label for="cboxColumna140"></label>
                                        </td>
                                        <td>Planos</td>
                                        <td>Cumplimiento de visita %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna140" id="numberPorcentaColumna140" >
                                            <label for="numberPorcentaColumna140"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio140" name="nombreServicio140" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Planos"  name="cboxColumna141" id="cboxColumna141" value="Planos Elaboración de plano">
                                            <label for="cboxColumna141"></label>
                                        </td>
                                        <td>Planos</td>
                                        <td>Elaboración de plano</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Planos"  name="cboxColumna142" id="cboxColumna142" value="Planos Elaboración de plano %">
                                            <label for="cboxColumna142"></label>
                                        </td>
                                        <td>Planos</td>
                                        <td>Elaboración de plano %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna142" id="numberPorcentaColumna142" >
                                            <label for="numberPorcentaColumna142"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio142" name="nombreServicio142" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Planos"  name="cboxColumna143" id="cboxColumna143" value="Planos Revisión de calidad interna">
                                            <label for="cboxColumna143"></label>
                                        </td>
                                        <td>Planos</td>
                                        <td>Revisión de calidad interna</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Planos"  name="cboxColumna144" id="cboxColumna144" value="Planos Revisión de calidad interna %">
                                            <label for="cboxColumna144"></label>
                                        </td>
                                        <td>Planos</td>
                                        <td>Revisión de calidad interna %</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna144" id="numberPorcentaColumna144" >
                                            <label for="numberPorcentaColumna144"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio144" name="nombreServicio144" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Planos"  name="cboxColumna145" id="cboxColumna145" value="Planos Entrega cliente interno/ externo">
                                            <label for="cboxColumna145"></label>
                                        </td>
                                        <td>Planos</td>
                                        <td>Entrega cliente interno/ externo</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Planos"  name="cboxColumna146" id="cboxColumna146" value="Planos Entrega cliente interno/ externo%">
                                            <label for="cboxColumna146"></label>
                                        </td>
                                        <td>Planos</td>
                                        <td>Entrega cliente interno/ externo%</td>
                                        <td><input type="number" class="" name="numberPorcentaColumna146" id="numberPorcentaColumna146" >
                                            <label for="numberPorcentaColumna146"></label>
                                        </td>
                                        <td>
                                            <select  id="nombreServicio146" name="nombreServicio146" >
                                                <option value="">N/A</option>
                                                <option value="Cumplimiento proceso plan de emergencia">Cumplimiento de proceso plan de emergencia</option>
                                                <option value="Sumatoria PPC MUN">Sumatoria PPC MUN</option>
                                                <option value="Sumatoria PPC EST">Sumatoria PPC EST</option>
                                                <option value="Sumatoria ARV">Sumatoria ARV</option>
                                                <option value="Sumatoria Plan Cont">Sumatoria Plan Cont</option>
                                                <option value="Sumatoria SIMU">Sumatoria SIMU</option>
                                                <option value="Sumatoria MOD3D">Sumatoria MOD3D</option>
                                                <option value="Sumatoria Copias">Sumatoria Copias</option>
                                                <option value="Sumatoria Visita">Sumatoria Visita</option>
                                                <option value="Sumatoria Planos">Sumatoria Planos</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="checkbox"  class="Planos"  name="cboxColumna187" id="cboxColumna187" value="Sumatoria Planos">
                                            <label for="cboxColumna187"> </label>
                                        </td>
                                        <td>Planos</td>
                                        <td>Sumatoria Planos</td>
                                        <td></td>
                                        <td></td>
                                            
                                    </tr>
                                    <!-- FIN DE REGISTROS PLANOS -->

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
        window.addEventListener("load", function(event) {
            $('#tabla-servicio').dataTable();
            $('#listadoColumnas').dataTable({
                ordering:false,
                pageLength: 200,
                pagingType: "simple"
            });
        });
        $("#formularioSeguimientoDocumental").submit(function (e) {
            e.preventDefault();
            deshabilitarFormulario(true);
            var formData=new FormData(document.getElementById("formularioSeguimientoDocumental"));

            console.log($('#formularioSeguimientoDocumental').serialize());
            $.ajax({
                url: '<?=site_url('Crudproyectos/altaSeguimientoCliente')?>',
                processData: false,
                contentType: false,
                dataType: 'HTML',
                type: 'POST',
                data: formData,
                success: function (data) {
                    Swal.fire('Exito!', 'Las columnas del seguimiento documental han sido guardadas', 'success');
                    deshabilitarFormulario(false);

                }
            });
        });
        $("#formularioEntregablesSubservicio").submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?=site_url('Crudproyectos/insertEntregablesSubservicio/')?>',
                type: 'POST',
                data: new FormData(document.getElementById("formularioEntregablesSubservicio")),
                processData: false,
                contentType: false,
                dataType: 'HTML',
                success: function (data)
                {
                    Swal.fire("Exito!", "Se ligaron los entregables con el subservicio", "success");
                    $("#modalEntregables").modal('hide');
                }
            });

        });
    </script>
    <script type="text/javascript">
        function cambiarCliente()
        {
            var idCliente=$("#idCliente").val();
            var servicioSubservicio=$("#servicioSubservicio").val();
            $("#formularioSeguimientoDocumental").trigger("reset");
            $("#idCliente").val(idCliente);
            $("#servicioSubservicio").val(servicioSubservicio);
            
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
                            var idInput=$(":checkbox[value='"+data[i]['columna']+"']").attr("id");
                             var res = idInput.substr(11);

                             $("#numberPorcentaColumna"+res).val(data[i]['valorPorcentaje']);
                             $("#nombreServicio"+res).val(data[i]['subservicio']);
                        }

                    }, complete:function()
                    {
                        var obj = 
                        {
                          "General"  : "cboxGeneral", "PPC"   : "cboxPPC",    "PPC MUN"  : "cboxPPCMUN",   "PPC EST"  : "cboxPPCEST",   
                          "PE"       : "cboxPE",      "ARV"   : "cboxARV",    "Plan Cont": "cboxPlanCont", "SIMU"     : "cboxSIMU",   
                          "MOD3D"    : "cboxMOD3D",   "Copias": "cboxCopias", "Visita"   : "cboxVisita",   "Planos"   : "cboxPlanos"
                        };
                        $.each( obj, function( key, value ) 
                        {
                            $('[class="'+ key+'"]').change(function(){
                                if(!$(this).prop("checked"))
                                {
                                    $('#'+ value).prop('checked', false);
                                }
                            });
                            if(!$('[class="'+ key+'"]').prop('checked'))
                                return false;
                                $('#'+ value).prop('checked', true);
                        });

                        /*$('.General').each(function(index) {
                            if(!$(this).prop('checked'))
                                return false;
                            $('#cboxGeneral').prop('checked', true);
                        });*/
                    }
                });
            }
        }
        function confirmaDeletePuente(idCon)
        {
            var idCon=idCon;
            var idServicio=$("#idServicio").val();
            Swal.fire({
                    title: 'Ingrese su contraseña actual',
                    input: 'text',
                    inputAttributes:
                        {
                            autocapitalize: 'off'
                        },
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonText: 'Aceptar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => 
                    {
                        return fetch(`//api.github.com/users/${login}`)
                        .then(response => 
                        {
                            if (!response.ok) 
                            {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => 
                        {
                            Swal.showValidationMessage(
                                `Ingrese Contraseña`
                            )
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.value) {
                        var parametros={
                            "password" : result.value.login }
                        $.ajax({
                            url : "<?=base_url('index.php/Crudproyectos/verificarContrasena/')?>",
                            type: "POST",
                            data:parametros,
                            dataType: "HTML",
                            success: function(data)
                            {
                                if (data.length>0)
                                {

                                   Swal.fire({
                                        title: "AVISO",
                                        text: "¿Desea borrar el registro?",
                                        type: "warning",
                                        showCancelButton: true,
                                        confirmButtonClass: "btn-danger",
                                        confirmButtonText: "Borrar"
                                    }).then((confirmacion) => {
                                        if (confirmacion.value) 
                                        location.href="https://cointic.com.mx/preveer/sistema/index.php/Crudproyectos/deletePuente/"+idCon+"/"+idServicio;
                                    });
                                }
                                else
                                    Swal.fire('ERROR','Contraseña incorrecta','error');
                            }
                        });
                    }
                });
                $(".swal2-input").attr("type", "password");
        }
        function establecerSeguimientoDocumental(idControl)
        {
            $("#servicioSubservicio").val(idControl);
            cambiarCliente();
            $("#modalSeguimientoDocumental").modal('show');
        }
        function establecerEntregables(idControl)
        {
            $("#idControl").val(idControl);
            $("#entregablesSubservicio").empty();
            $.ajax({
                url: '<?=site_url('Crudproyectos/getListaEntregables/')?>'+idControl,
                dataType: 'JSON',
                success: function (data)
                {
                    var checked;
                    var disabled;
                    var i=0;
                    for(i; i<data.length; i++)
                    {
                        checked=(data[i]['idEntregableSubservicio'])?"checked": "";
                        disabled=(data[i]['idEntregableSubservicio'])?"": "disabled='disabled'";
                        $("#entregablesSubservicio").append(' ' +
                            '<tr>' +
                            '   <td><input '+checked+' type="checkbox" name="cboxEntregable'+i+'" id="cboxEntregable'+data[i]['idEntregable']+'" onchange="habilitarEntregables('+data[i]['idEntregable']+')"><label for="cboxEntregable'+data[i]['idEntregable']+'"></label></td>' +
                            '   <td><b>'+data[i]['nombreEntregable']+'</b></td>' +
                            '   <td><input '+disabled+' min="1" type="number" id="cantidadEntregable'+data[i]['idEntregable']+'" name="cantidadEntregable'+i+'" value="'+((data[i]['cantidad'])?data[i]['cantidad']:"")+'"></td>' +
                            '   <td><input '+disabled+' type="text" id="notaEntregable'+data[i]['idEntregable']+'" name="notaEntregable'+i+'" value="'+((data[i]['nota'])?data[i]['nota']:"")+'"></td>' +
                            '   <input '+disabled+' type="hidden" name="entregable'+i+'" id="entregable'+data[i]['idEntregable']+'" value="'+((data[i]['idEntregable'])?data[i]['idEntregable']:"")+'">' +
                            '</tr>');

                    }
                    $("#numeroEntregables").val(i);
                    $("#modalEntregables").modal('show');
                }
            });
        }
        function habilitarEntregables(idEntregable)
        {
            $("#cantidadEntregable"+idEntregable).prop("disabled", !$("#cboxEntregable"+idEntregable).prop("checked"));
            $("#cantidadEntregable"+idEntregable).prop("required", $("#cboxEntregable"+idEntregable).prop("checked"));
            $("#notaEntregable"+idEntregable).prop("disabled", !$("#cboxEntregable"+idEntregable).prop("checked"));
            $("#entregable"+idEntregable).prop("disabled", !$("#cboxEntregable"+idEntregable).prop("checked"));

        }


        function activar(grupo, checkboxSeleccionado)
        {
            $('#columnasSeguimientoDocumental').children().each(function( index ) 
            {
                var hijos= $(this).children();
                if ($(hijos[1]).html() == grupo)
                {
                    var elementosCheckbox = $(hijos[0]).children();
                    $(elementosCheckbox[0]).prop('checked',$(checkboxSeleccionado).prop('checked'));
                }
            });
            // Comprobar cuando cambia un checkbox
            $('input[type=checkbox]').on('change', function() {
                if ($(this).is(':checked') ) {
                    console.log("Checkbox " + $(this).prop("#cboxGeneral") +  " (" + $(this).val() + ") => Seleccionado");
                } else {
                    console.log("Checkbox " + $(this).prop("#cboxGeneral") +  " (" + $(this).val() + ") => Deseleccionado");
                }
            });
            /*$(".allCbox").each(function( index ) 
            {
                if($('.cboxGeneral').prop('checked')) 
                {
                   $(".cboxGeneral:checked").prop( "checked", true);
                }
                else 
                {
                   $(".cboxGeneral:checked").prop( "checked", false);
                }
            });*/
        }

        function deshabilitarFormulario(bool)
        {
            $('#columnasSeguimientoDocumental').children().each(function( index ) {
                var hijos= $(this).children();

                var elementosCheckbox = $(hijos[0]).children();
                var elementosPorcentajes = $(hijos[3]).children();
                var elementosSelect = $(hijos[4]).children();

                if (!$(elementosCheckbox[0]).prop('checked') && bool)
                {
                    $(elementosCheckbox[0]).prop('disabled',true);
                    $(elementosPorcentajes[0]).prop('disabled',true);
                    $(elementosSelect[0]).prop('disabled',true);
                }
                else
                {
                    $(elementosCheckbox[0]).prop('disabled',false);
                    $(elementosPorcentajes[0]).prop('disabled',false);
                    $(elementosSelect[0]).prop('disabled',false);
                }

            });
        }

    </script>

<?php
include "footer.php";
?>