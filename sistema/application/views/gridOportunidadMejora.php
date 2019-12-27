<style>
    .imgSeleccionada{
        background-color: #d50f11;
        padding: 8px;
    }
</style>
    <!-- TablEdit -->
    <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
    <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>

    <!-- DataTable
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"> -->

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

            <?php /*print_r(json_decode($OMPC, true)); */?>


            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="header">
                                    <h2>
                                        Oportunidad de Mejora - <?=$nombreCentroTrabajo?>
                                    </h2>
                                    <?php
                                    if(!$desdeMovil)
                                    {
                                        ?>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">date_range</i>
                                                </a>
                                                <ul class="dropdown-menu pull-right">
                                                    <?php
                                                    foreach ($historicoOMPC as $historico)
                                                    {
                                                        echo "<li><a href=\"". site_url('CrudVisitaAcuse/descargarExcelHistorialPC/'.$historico['idHistorialExcelOMPC'])."\">".$historico['fecha']."</a></li>";
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        </ul>
                                        <?php
                                    }
                                    ?>

                                </div>

                            </div>
                        </div>
                        <div class="body table table-responsive">
                            <form id="form"></form>
                                <div >
                                    
                                    <div class="col-sm-12">
                                        <input type="hidden" id="idCentroTrabajo" value="<?=$datosCentroTrabajo['idCentroTrabajo']?>">
                                        <div class="row clearfix">

                                            <div class="col-sm-3" style="display: none;">
                                                <label for="Tipo de inmueble">Tipo de inmueble</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" id="inmueble" name="inmueble" style="width: 100%; border: none;color:#000;" required disabled>
                                                            <option value="0" disabled>Seleccione inmueble</option>
                                                            <?php
                                                            foreach ($inmueble as $row) {
                                                                $idIn=$row["idInmueble"];
                                                                $nombreIn=$row["nombreInmueble"];

                                                                echo "<option value='$idIn'>$nombreIn</option>";
                                                            }
                                                            ?>

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="razonSocial">Razón social</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="razonSocial">Número de sucursal</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="numeroSucursal" name="numeroSucursal" placeholder="Número Sucursal" value="<?=$datosCentroTrabajo['numeroSucursal']?>" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="email_address">Nombre de la sucursal</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="nombreCentro" name="nombreCentro" placeholder="Nombre" readonly/>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <b>A.E.P.*:</b>
                                                        <input type="text" class="form-control" id="aep" name="aep" value="<?=$datosCentroTrabajo['aep']?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="atendioVisita">Nombre de quien atendió la visita</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="atendioVisita" name="atendioVisita" onchange="cambiarNombreAtendioVisita()" value="<?=$datosCentroTrabajo['nombreAtendioVisita']?>" placeholder="Nombre de la persona quien atendió la visita"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" >
                                                <label for="realizoVisita">Nombre de quien realizó la visita</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="realizoVisita" name="realizoVisita"  value="<?=$datosCentroTrabajo['nombreRealizo']?>" readonly placeholder="Nombre de la persona quien realizó la visita"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" >
                                                <label for="numeroVisita">Número de visita</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="numeroVisita" name="numeroVisita"  value="<?=$datosCentroTrabajo['numeroVisita']?>" placeholder="Número de la visita" readonly/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="Formato">Cliente</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" id="idFormato" name="idFormato" style="width: 100%; border: none;color:#000;" required disabled>
                                                            <option value="0" disabled >Seleccione cliente</option>
                                                            <?php
                                                            foreach ($formato as $row) {
                                                                $idFormat=$row["idFormato"];
                                                                $nombreFormat=$row["nombre"];

                                                                echo "<option value='$idFormat'>$nombreFormat</option>";
                                                            }
                                                            ?>

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Estado</label>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select id="estado" class="form-control" name="estado" style="width: 100%; border: none;color:#000;"  onChange="obtenerMunicipios();" required disabled>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Municipio o Delegación</label>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select id="municipio" name="municipio" class="form-control" style="width: 100%; border: none;color:#000;"  onChange="obtenerColonias();" required disabled>
                                                            <option value="" disabled >Seleccione el municipio</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Colonia</label>
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <select id="colonia" class="form-control" name="colonia" style="width: 100%; border: none;color:#000;" onChange="obtenerCodigoPostal();" required disabled>
                                                            <option value="" disabled>Seleccione la colonia</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <label for="codigoPostal">Código Postal</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Código Postal" value="<?=$datosCentroTrabajo['codigoPostal']?>" readonly />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-6">
                                                <label for="calle">Calle</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" readonly/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="numExterior">Número Exterior</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="number" class="form-control" id="numExterior" name="numExterior" placeholder="Número Exterior" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="numInterior">Número Interior</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="numInterior" name="numInterior" placeholder="Número Interior" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-sm-3">
                                                <label for="email_address">Nombre de contacto</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="nomContacto" name="nomContacto" placeholder="Nombre de contacto" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="email_address">Puesto de contacto</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="puestoContacto" name="puestoContacto" placeholder="Puesto de contacto" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="email_address">Teléfono de contacto</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="telContacto" name="telContacto" placeholder="Teléfono de contacto" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="email_address">Correo de contacto</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="correoContacto" name="correoContacto" placeholder="Correo de contacto" readonly />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="email_address">Teléfono del inmueble</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="tel" class="form-control" id="telefonoInmueble" name="telefonoInmueble" placeholder="Teléfono del inmueble" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="email_address">Correo del inmueble</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="correoInmueble" name="correoInmueble" placeholder="Correo del inmueble" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                               
                                    </div>
                                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Objetivo:</b>
                                                <textarea readonly type="text" class="form-control" id="objetivo" name="objetivo" style="resize: none;">Crear, reforzar, mejorar e implementar las medidas de seguridad necesarias en el centro de trabajo para incrementar la productividad mediante la reducción de riesgos, atendiendo los requerimientos vigentes en materia de Protección Civil</textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <div class="row col-sm-12">
                                <div class="table-responsive">
                                    <table id="tabla-oportunidades" class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Mostrar</th>
                                            <th>#</th>
                                            <th>Área/Sección</th>
                                            <th>Riesgo</th>
                                            <th>Recomendación</th>
                                            <th>Oportunidad de mejoramiento</th>
                                            <th>Fundamento legal</th>
                                            <th>Est.</th>
                                            <th>Prioridad de Mejora</th>
                                            <th>Imagen</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        $x = 0;

                                        foreach ($OMPC as $item)
                                        {
                                            foreach ($item as $val)
                                            {
                                                if(empty($val))
                                                    continue;

                                                $formularioAsignacion=$val['idFormularioAsignacion'];
                                                //$idFormularioAlmacenamiento=$val['idFormularioAlmacenamiento'];
                                                $idIndicador=$val['idIndicador'];
                                                $idAcordeon=$val['idAcordeon'];
                                                $area_seccion=$val['nombreFormulario'];
                                                $colorEstatus="#FFFFFF";
                                                $estatus=0;
                                                $idOMPC = $val['idOMPC'];
                                                $fundamentoLegal = $val['fundamentoLegal'];
                                                $value = $val['valor'];
                                                $verIndicador = $val['visual'];
                                                if ($verIndicador==1) {
                                                    $checked="checked";
                                                }else{
                                                    $checked="";
                                                }
                                                //echo "$idOMPC $checked </br>";
                                                $oportunidadMejoramiento = $val['oportunidadMejoramiento'];
                                                $nombreMejora = empty($val['nombrePM']) ? "Seleccione una opción..." : $val['nombrePM'];
                                                $nombreRiesgo = empty($val['nombreRiesgo']) ? "Seleccione una opción..." : $val['nombreRiesgo'];
                                                if($val['estatus'] != '')
                                                {
                                                    $estatus = ($val["estatus"] == 1) ? 0 : 1;
                                                    $colorEstatus = ($estatus == 0) ? "#f44336" : "#8bc34a";
                                                }
                                                $colorPM = $val['colorPM'];
                                                ?>
                                                <tr>
                                                    <td style="display:none;"><?=$idOMPC?></td><!-- Identificador de Formulario y Observación  -->
                                                    <td>
                                                        <input type="checkbox" onclick="verificarVisual(<?=$idOMPC?>)" class="form-control" id="aplicaHorarioAtencion<?=$idOMPC?>"   name="aplicaHorarioAtencion<?=$idOMPC?>" <?php echo "$checked"; ?> placeholder="Horario" ><label for="aplicaHorarioAtencion<?=$idOMPC?>"></label>
                                                    </td>
                                                    <td><?=$count?></td>
                                                    <td><?=$area_seccion?></td>
                                                    <td><?=$nombreRiesgo?></td>
                                                    <td><?=$oportunidadMejoramiento?></td>
                                                    <td><?=$value?></td>
                                                    <td><?=$fundamentoLegal?></td>
                                                    <td id="estatus_<?=$idOMPC?>" style="background: <?=$colorEstatus?>"><?=$estatus?></td>
                                                    <td id="prioridad_<?=$idOMPC?>" style="background: <?=$colorPM?>"><?=$nombreMejora?></td>
                                                    <td><button type="button" class="btn btn-default" onclick="modalFotos(<?=$idOMPC.",".$formularioAsignacion?>)"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>
                                                    <td style="display:none;"><?=$idAcordeon?></td>
                                                </tr>

                                                <?php
                                                $count++;

                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Recomendaciones de Procedimiento de evacuación</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($recomendacionesPE as $vall)
                                        {
                                            $recomendaciones=$vall["recomendaciones"];
                                          echo "
                                            <tr>
                                                <td>$recomendaciones</td>
                                            </tr>";  
                                        }
                                            
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="row" align="center">
                                <div class="col-md-1 col-md-offset-5">
                                    <div class="form-line">
                                        <input  type="button" onclick="visualizarBotones();" class="btn bg-red waves-effect waves-light"  value="Guardar">
                                    </div>
                                </div>
                                <div id="areaBotones" style="display: none">
                                    <div class="col-md-1 ">
                                        <div class="form-line">
                                            <input onclick="popUpImprimir(<?=$idAsignacion?>);" type="button" class="btn bg-red waves-effect waves-light" id="btn-imprimir" value="Imprimir">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-line">
                                            <input  type="button" class="btn bg-red waves-effect waves-light" value="Enviar Correo" data-toggle="modal" data-target="#correoModal" id="btn-EnviarCorreo" hidden>
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

    <div class="modal fade" id="myModalImagenOP" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Imagen</h4>
                </div>
                <div class="modal-body">
                    <div class="row" align="center">
                        <div class="col-md-8 col-md-offset-2">
                            <b>Fotos</b>
                            <div id="ConteniFoto">

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
                                <input type="email" class="form-control" id="correo-acuse" name="correo-acuse" value="<?=$datosCentroTrabajo['correoInmueble']?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="verCorreos(<?=$idAsignacion?>)">Historial de correos</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="enviarCorreoPDF(<?=$idAsignacion?>,<?=$datosCentroTrabajo['idCentroTrabajo']?>)">Enviar</button>
            </div>
        </div>
    </div>
</div>
<div id="HistorialcorreoModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <input type="hidden" id="idHistorialCorreos" name="idHistorialCorreos">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="correoModalLabel">Correos enviados</h5>
                <p>La siguiente tabla muestra un historial de los correos enviados en OM's:</p>
          </div>
          <div class="modal-body">
            <div class="row clearfix">
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Correo</th>
                            <th>Usuario que envió</th>
                            <th>Fecha de envío</th>
                        </tr>
                        </thead>
                        <tbody id="tablaCorreos">

                        </tbody>
                    </table>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
    </div>
</div>

    <script>
        
        function verCorreos(idAsignacion)
        {
            $("#tablaCorreos").empty();
            $("#idHistorialCorreos").val(idAsignacion);
            $.ajax({
                url: '<?=base_url('index.php/CrudVisitaAcuse/getCorreosEnviados/')?>'+idAsignacion,
                dataType:'JSON',
                success: function (data)
                {
                    console.table(data);
                    var usuario;
                    for(var i=0; i<data.length; i++)
                    {
                        correo=(data[i]['Correo'])?data[i]['Correo']:"Ningún correo";
                        usuario=(data[i]['nickName'])?data[i]['nickName']:"Ningún usuario";
                        FechaEnvio=(data[i]['FechaEnvio'])?data[i]['FechaEnvio']:"Sin fecha";
                        $("#tablaCorreos").append(' ' +
                            '<tr>' +
                            '<td>'+(i+1)+'</td>' +
                            '<td>'+correo+'</td>' +
                            '<td>'+usuario+'</td>' +
                            '<td>'+FechaEnvio+'</td>' +
                            '</tr>');
                    }
                    $("#HistorialcorreoModal").modal('show');
                }
            });
        }

        function visualizarBotones()
        {
            //Manda a guardar un historial de aquelló que se guardó
            $.ajax({
                url: '<?=site_url('CrudVisitaAcuse/guardarHistorialOMPC/'.$idAsignacion)?>'
            });
            swal({
              title: "Datos guardados",
              type: "success",
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false
            },
            function(){
              $("#areaBotones").show();
               swal.close()
            });
            
        }
        function verificarVisual(idOm)
        {
            $.ajax({
                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudVisitaAcuse/verificarVisualPdf/"+idOm,
                    type: "POST",
                    //data: {correoAcuse: correoAcuse},
                    dataType: "json",
                    success: function(data)
                    {
                        modifcaStatus(idOm,data.visual)
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Error", "Ocurio un error inesperado", "warning");
                    }
                });
        }
        function  popUpImprimir(id)
        {
            window.open("https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/OMPC/"+id,"neo","width=900,height=600,menubar=si");
            $.ajax({
                url: '<?=site_url('CrudVisitaAcuse/registrarHistoricoOportunidadMejora/'.$idAsignacion)?>',
                contentType: false,
                processData: false,
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                }

            });
        }

        function modifcaStatus(idOm,Vis){
            
            if (Vis==1)
             {
                var Dato=0;
             }else{
                var Dato=1;
             }
             $.ajax({
                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudVisitaAcuse/modificarStatusVisual/"+idOm+"/"+Dato,
                    type: "POST",
                    //data: {correoAcuse: correoAcuse},
                    dataType: "HTML",
                    success: function(data)
                    {
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Error", "Ocurio un error inesperado", "warning");
                    }
                });

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
                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/enviarPDFOM/"+idAsignacion+"/"+idCentroTrabajo,
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

    
        /* OPCIONES PRIORIDAD MEJORA */
        var prioridad_mejora = <?php print json_encode($prioridad_mejora); ?>;
        var prioridades = '{ "0" : "Seleccione una opción...", ';
        prioridad_mejora.forEach(function (element) {
            prioridades += '"'+element.idPrioridad+'": "'+element.nombre+'",';
        });
        var lastIndex = prioridades.lastIndexOf(",");
        var JSONPrioridades = prioridades.substring(0,lastIndex)+"}";

        /* OPCIONES RIESGOS */
        var riesgo_acuse = <?php print json_encode($riesgo_acuse); ?>;
        var riesgos = '{ "0" : "Seleccione una opción...", ';
        riesgo_acuse.forEach(function (element) {
            riesgos += '"'+element.idRiesgo+'": "'+element.nombreRiesgo+'",';
        });
        var lastIndex = riesgos.lastIndexOf(",");
        var JSONRiesgos = riesgos.substring(0,lastIndex)+"}";

        $('#tabla-oportunidades').Tabledit({
            url: 'https://cointic.com.mx/preveer/sistema/index.php/CrudVisitaAcuse/registraroOportunidadMejora/',
            editButton: false,
            deleteButton: false,
            autoFocus: false,
            columns: {
                identifier: [0, 'identificadores'],
                editable: [[4, 'idRiesgo', JSONRiesgos], [5, 'oportunidad-mejoramiento'], [6, 'recomendacionEdi'], [7, 'fundamento-legal'],
                    [8, 'estatus', '{"0" : "Seleccione una opción...", "1": "0", "2": "1"}'], [9, 'idPrioridad', JSONPrioridades]]
            },
            onSuccess: function(data, textStatus, jqXHR) {
                cambiarColor(data[0], data[1], data[2]);
            }

        }).find('select[name="Service Type"]').attr('multiple', 'multiple');

        function cambiarColor(clave,valor, identificador)
        {
            if(clave == 'prioridad'){
                busquedaPrioridad(prioridad_mejora, valor, identificador);
            }else if(clave == 'estatus'){
                var color = valor.includes(1) ? "#f44336" : "#8bc34a";
                $("#estatus_"+identificador).css("background", color);
            }
        }

        function busquedaPrioridad(array, item, identificador){
            var low = 0;
            var high = array.length - 1;

            while(low <= high) {
                var middle = Math.floor((low + high)/2);
                var guess = array[middle].idPrioridad;
                var color = array[middle].color;
                if(guess == item){
                    $("#prioridad_"+identificador).css("background", color);
                }
                if(guess > item){
                    high = middle - 1;
                } else {
                    low = middle + 1;
                }
            }
        }

    </script>

    <script>
        function cambiarNombreAtendioVisita()
        {
            $.ajax(
                {
                    url: '<?=site_url('CrudCentrosTrabajo/cambiarNombreAtendioVisita/'.$idAsignacion)?>',
                    type: 'POST',
                    data: {nombre: $("#atendioVisita").val()}
                }
            );
        }
        function modalFotos(idOMPC, idFormularioAsignacion)
        {
            $("#ConteniFoto").empty();
            $("#ConteniFoto").append("<div class=\"col-md-12\">\n" +
                "                                <input type=\"file\" id=\"foto\" name=\"foto[]\">\n" +
                "                             </div>");
            $("#myModalImagenOP").modal();
            $.ajax({
                url: '<?=site_url('CrudVisitaAcuse/getAllFotos/')?>'+idFormularioAsignacion,
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success: function (data)
                {
                    fotos="";
                    for(i=0; i<data.length; i++)
                    {
                        estiloFoto="";
                        //console.log(data[i].fotoSeleccionada+" "+data[i].idFormularioFoto+" "+idOMPC+" "+data[i].idOMPC)
                        if(data[i].fotoSeleccionada==data[i].idFormularioFoto&&idOMPC==data[i].idOMPC)
                            estiloFoto="imgSeleccionada";
                        fotos+="<img  onClick='seleccionarImg("+idOMPC+", "+data[i].idFormularioFoto+", this)' src='<?=base_url('assets/img/fotoAnalisisRiesgo/')?>"+idFormularioAsignacion+"/"+data[i].foto+"' class='file-preview-image "+estiloFoto+"'>";
                    }
                    $("#foto").fileinput(
                        {
                            language: 'es',
                            showBrowse: false,
                            showRemove: false,
                            showUpload: false,
                            showClose: false,
                            showCaption: false,
                            showUploadedThumbs: false,
                            resizeImage: true,
                            maxImageWidth: 20,
                            maxImageHeight: 20,
                            resizePreference: 'width',
                            initialPreview: [fotos]
                        }
                    );
                }
            });

        }
        function seleccionarImg(idOMPC, idFormularioFoto, elementoImg)
        {
            $.ajax(
                {
                    url: '<?=site_url('CrudVisitaAcuse/establecerFoto/')?>'+idOMPC+"/"+idFormularioFoto,
                    processData: false,
                    contentType: false,
                    dataType: 'HTML',
                    success: function (data)
                    {
                        $(".imgSeleccionada").removeClass("imgSeleccionada");
                        $(elementoImg).addClass("imgSeleccionada");
                        swal('Buen trabajo!', 'La imagen se ha establecido como oportunidad de mejora', 'success');
                    }
                }
            );

        }

        function cambiarNombre()
        {
            $("#firmaAtendioVisita").val($("#atendioVisita").val());
            $.ajax({
                url: '<?php echo site_url("CrudCentrosTrabajo/cambiarNombreAtendioVisita/$idAsignacion") ?>',
                type: "POST",
                data: {
                    nombre: $("#firmaAtendioVisita").val()
                }
            })
           
        }

        function cargarDatosCentroTrabajo(){


            $.ajax({
                url : "<?php echo site_url('CrudCentrosTrabajo/obtenerEstados')?>/",
                type: "get",
                dataType: "json",
                success: function(data)
                {
                    for(var i=0; i<data.length; i++)
                    {
                        $("#estado").append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']))
                    }
                },complete:function(){
                    var idc = $("#idCentroTrabajo").val();
                    $.ajax({
                        url : "<?php echo site_url('CrudCentrosTrabajo/obtenerDatos')?>/" + idc,
                        type: "get",
                        dataType: "JSON",
                        success: function(data)
                        {
                            $("#estado").val(data.id_Estado);
                            var idEstado=data.id_Estado;
                            $.ajax({
                                url : "<?php echo site_url('CrudCentrosTrabajo/obtenerMunicipios')?>/"+idEstado,
                                type: "get",
                                dataType: "json",
                                success: function(municipio)
                                {
                                    $("#municipio").empty();
                                    for(var i=0; i<municipio.length; i++)
                                    {
                                        $("#municipio").append(new Option(municipio[i]['nombreMunicipio'],municipio[i]['idMunicipio']))
                                    }
                                    $("#municipio").val(data.idMunicipio);
                                    $.ajax({
                                        url : "<?php echo site_url('CrudCentrosTrabajo/obtenerColonias')?>/"+data.idMunicipio,
                                        type: "get",
                                        dataType: "json",
                                        success: function(colonias)
                                        {
                                            $("#colonia").empty();
                                            for(var i=0; i<colonias.length; i++)
                                            {
                                                $("#colonia").append(new Option(colonias[i]['nombreRegion'],colonias[i]['idRegiones']))
                                            }
                                            $("#colonia").val(data.idColonia);

                                            // obtenerCodigoPostal();
                                        }
                                    });

                                }
                            });
                            $("#calle").val(data.calle);
                            $("#numInterior").val(data.numeroInterior);
                            $("#numExterior").val(data.numeroExterior);
                            $("#idFormato").val(data.idFormato);
                            $("#inmueble").val(data.idInmueble);
                            $("#nombreCentro").val(data.nombre);
                            $("#idDet").val(data.idDet);
                            $("#nomContacto").val(data.nomContacto);
                            $("#puestoContacto").val(data.puestoContacto);
                            $("#telContacto").val(data.telContacto);
                            $("#correoContacto").val(data.email);
                            $("#correoInmueble").val(data.correoInmueble);
                            $("#telefonoInmueble").val(data.telefonoInmueble);

                            $("#horarioFuncionamientoInicio").val(data.horarioFuncionamientoInicio);
                            $("#horarioFuncionamientoFin").val(data.horarioFuncionamientoFin);

                            $("#horarioAtencionInicio").val(data.horarioAtencionInicio);
                            $("#horarioAtencionFin").val(data.horarioAtencionFin);
                            $("#giroInmueble").val(data.giroInmueble);

                            $("#razonSocial").val(data.razonSocial);



                            if(data.aplicaHorarioAtencion==1)
                            {
                                $("#aplicaHorarioAtencion").prop("checked", true);
                            }
                            var ruta="";

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });
                }
            });
            $.ajax({
                url: '<?=site_url('CrudCentrosTrabajo/getNombreAtendioVisita/'.$idAsignacion)?>',
                dataType: 'JSON',
                success: function(data)
                {
                    $("#atendioVisita").val(data.nombreAtendioVisita);
                    $("#firmaAtendioVisita").val(data.nombreAtendioVisita);
                }
            })


        }
    
        

        $(document).ready(function(){
            cargarDatosCentroTrabajo();
        });
    </script>
