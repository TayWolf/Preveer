<?php
include "header.php";
//TODO:
//FALTA TIPO DE INGRESO->preguntar si va a tener crud
//
?>

<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquerymo.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.tabledit.js"></script>
<?php
include "datosmodalCentrotrabajo.php";
?>

<script type="text/javascript">

    var borrarTodo=0;
    var esInicio=1;
    var inicioFormatos=1;
    var clienteSeleccionado=0;
    var formatoSeleccionado=0;
    var array = {
        'datosInmueble': []
    };
    window.onload=inicioEdicion;
    function inicioEdicion()
    {

        inicio();
        var idu = $("#idOti").val();
        var esProteccionCivil=<?php echo (empty($ssh))? "1": "2";?>;
        $.ajax({
            url : "<?php echo site_url('CrudOti/obtenerDatos')?>/" + idu,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i = 0; i < data.length; i++) {

                        $("#fechaSol").val(data[i]['fechaSolicitud']);
                        $("#horaSoli").val(data[i]['horaSolicitud']);
                        $("#fechaAcep").val(data[i]['fechaAceptacion']);
                        $("#horaAcept").val(data[i]['horaAceptacion']);
                        $("#idCliente").val(data[i]['idCliente']);
                        $("#idFormatoSelect").val(data[i]['idFormato']);
                        $("#nombreServicio").val(data[i]['nombreProyecto']);
                        $("#nombreProy").val(data[i]['nombreSubservicio']);
                        $("#nombreInmue").val(data[i]['nombreInmueble']);
                        $("#nombreTram").val(data[i]['idTramite']);
                        getFormatos(2);
                        var idAsignacion=data[i]['idAsignacion'];
                        var idControl=data[i]['idProyecto'];
                        var idInmuebleModal=data[i]['idCentroTrabajo'];
                        var nombreCentroTrabajo=data[i]['nombreCentroTrabajo'];
                        var idTramite=data[i]['idTramite'];
                        var idProyecto=data[i]['idProyecto'];
                        var cometarioIn=data[i]['ComentarioDireccion'];
                        var fechaEntrega=data[i]['fechaEntrega'];
                        var comentariosEnt=data[i]['comentariosEntrega'];
                        var tipoIngre=data[i]['TipoIngreso'];
                        var capacitacioT=data[i]['capacitacion'];
                        var idServicio=data[i]['idServicio'];
                        var idSubservicio=data[i]['idSubservicio'];
                        var nombreServicio=data[i]['nombreProyecto'];
                        var nombreSubServicio=data[i]['nombreSubservicio'];

                        var idArea=data[i]['idArea']
                        if(esProteccionCivil==idArea)
                            arrreglodeTabla(idAsignacion,idInmuebleModal,nombreCentroTrabajo,idTramite,idControl, idServicio,idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                    }
                }


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
            }
        });

    }


    function obtenerDatosFormato(form, cambioCliente)
    {
        var idFormato;
        if(form!=undefined)
            idFormato=form;
        else
            idFormato=$("#idFormato").val();
        if(cambioCliente==1)
        {
            inicioFormatos=1;
        }

        if(inicioFormatos==1)
        {


            formatoSeleccionado=$("#idFormato").val();
            $.ajax(
                {
                    url : "<?php echo site_url('CrudOti/obtenerDatosCentroTrabajoPorFormato')?>/" + idFormato,
                    type: "get",
                    dataType: "JSON",
                    success: function(data)
                    {
                        $("#idInmuebleModal").html("");
                        $("#idInmuebleModal").append(new Option("Seleccione el centro de trabajo",""));
                        for(i=0; i<data.length; i++)
                        {
                            $("#idInmuebleModal").append(new Option(data[i]['nombre'],data[i]['idCentroTrabajo']));
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                    }
                });
            inicioFormatos=0;
        }
        else
        {
            swal({
                    title: '¿Esta seguro de cambiar de formato?',
                    text: "Se borraran todos los datos de la Oti",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, estoy seguro",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm)
                    {
                        borrarTodo=1;
                        array = {'datosInmueble': []};
                        $("#listaInmueble").html("");
                        $.ajax(
                            {
                                url : "<?php echo site_url('CrudOti/obtenerDatosCentroTrabajoPorFormato')?>/" + idFormato,
                                type: "get",
                                dataType: "JSON",
                                success: function(data)
                                {
                                    $("#idInmuebleModal").html("");
                                    $("#idInmuebleModal").append(new Option("Seleccione el centro de trabajo",""));
                                    for(i=0; i<data.length; i++)
                                    {
                                        $("#idInmuebleModal").append(new Option(data[i]['nombre'],data[i]['idCentroTrabajo']));
                                    }
                                }
                            });
                        formatoSeleccionado=$("#idFormato").val();

                    }
                    else
                    {
                        $("#idFormato").val(formatoSeleccionado);
                    }
                }
            );
        }

    }
    function getFormatos(cambioManual)
    {
        if(cambioManual==1)
        {
            inicioFormatos=1;
        }
        if(cambioManual==2)
        {
            esInicio=1;
        }
        if(esInicio==1)
        {
            $("#idFormato").html("");
            $("#idFormatoModal").html("");
            var idCliente=$("#idCliente").val();
            var form=$("#idFormatoSelect").val();
            if (idCliente!="")
            {
                $.ajax({
                    url : "<?php echo site_url('CrudOti/getForm')?>/" + idCliente,
                    type: "get",
                    dataType: "JSON",
                    success: function(data)
                    {
                        if (data.length>0)
                        {
                            for(i=0; i<data.length; i++)
                            {
                                $("#idFormato").append(new Option(data[i]['nombre'],data[i]['idFormato']));
                                $("#idFormatoModal").append(new Option(data[i]['nombre'],data[i]['idFormato']));
                            }
                            $("#idFormato").val(form);
                            clienteSeleccionado=$("#idCliente").val();
                            formatoSeleccionado=$("#idFormato").val();
                            obtenerDatosFormato(form, 1);

                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                    }
                });
            }

            esInicio=0
        }
        else
        {
            swal({
                    title: '¿Esta seguro de cambiar de cliente?',
                    text: "Se borraran todos los datos de la Oti",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Si, estoy seguro",
                    cancelButtonText: "Cancelar",
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm)
                    {
                        borrarTodo=1;
                        array = {'datosInmueble': []};
                        $("#listaInmueble").html("");
                        $("#idFormato").html("");
                        $("#idFormatoModal").html("");
                        var idCliente=$("#idCliente").val();
                        var form=$("#idFormatoSelect").val();
                        if (idCliente!="")
                        {
                            $.ajax({
                                url : "<?php echo site_url('CrudOti/getForm')?>/" + idCliente,
                                type: "get",
                                dataType: "JSON",
                                success: function(data)
                                {
                                    if (data.length>0)
                                    {
                                        for(i=0; i<data.length; i++)
                                        {
                                            $("#idFormato").append(new Option(data[i]['nombre'],data[i]['idFormato']));
                                            $("#idFormatoModal").append(new Option(data[i]['nombre'],data[i]['idFormato']));
                                        }

                                        clienteSeleccionado=$("#idCliente").val();
                                        formatoSeleccionado=$("#idFormato").val();
                                        obtenerDatosFormato(form, 1);
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {}
                            });
                        }

                    }
                    else
                    {
                        $("#idCliente").val(clienteSeleccionado);
                    }
                }
            );
        }
    }




    function obtenerDireccion()
    {
        var idCentroTrabajo=$("#idInmuebleModal").val();
		
        $.ajax({
            url:"<?php echo site_url('CrudCentrosTrabajo/obtenerDatos/'); ?>"+idCentroTrabajo,
            type: "get",
            dataType: "JSON",
            success:function(data)
            {
                $("#calle").val(data.calle);
                $("#numInterior").val(data.numeroInterior);
                $("#numExterior").val(data.numeroExterior);
                $("#estado").val(data.nombreEstado);
                $("#delegacion").val(data.nombreMunicipio);
                $("#colonia").val(data.nombreRegion);
                $("#codigoPostal").val(data.cp);

            }
        });

    }


</script>


<section class="content">
    <div class="container-fuid">
        <div class="block-header">
            <a href="https://cointic.com.mx/preveer/sistema/index.php/CrudOti<?php echo $ssh?>">
                <button type="button" class="btn  btn-circle-lg waves-effect waves-circle waves-float">
                    <i  style="color: #000;" class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Información de la OTI
                        </h2>

                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                <div class="panel-group full-body" id="accordion_19" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_19">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">
                                                    <i class="material-icons">perm_contact_calendar</i> Datos Generales
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input type="hidden" name="nombreServicio" id="nombreServicio">
                                                        <input type="hidden" name="nombreProy" id="nombreProy">
                                                        <input type="hidden" name="nombreInmue" id="nombreInmue">
                                                        <input type="hidden" name="nombreTram" id="nombreTram">
                                                        <input type="hidden" name="idFormatoSelect" id="idFormatoSelect">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="hidden" id="idOti" name="idOti" value="<?=$idOti?>">

                                                                <b>Fecha de captura</b>
                                                                <input type="date" class="form-control" id="fechaSol" name="fechaSol"  required  readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Hora de solicitud</b>
                                                                <input type="time" class="form-control" id="horaSoli" name="horaSoli"  required readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Fecha Aceptación</b>
                                                                <input type="date" class="form-control" id="fechaAcep" name="fechaAcep"  required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Hora Aceptación</b>
                                                                <input type="time" class="form-control" id="horaAcept" name="horaAcept"  required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float" style="margin-top: 13px;">
                                                            <b>Cliente</b>
                                                            <div class="form-line">
                                                                <select id="idCliente" name="idCliente" style="width: 100%; border: none;color:#000;" required onchange="getFormatos(1);">
                                                                    <option value="">Seleccione cliente</option>
                                                                    <?php
                                                                    foreach ($cliente as $row) {
                                                                        $idClien=$row["idCliente"];
                                                                        $nombreClient=$row["nombreCliente"];

                                                                        echo "<option value='$idClien'>$nombreClient</option>";
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float" style="margin-top: 13px;">

                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="#" data-toggle="modal" data-target="#myModalCliente">
                                                                    <div class="demo-google-material-icon"> <i class="material-icons">add_circle</i> <span class="icon-name">Registrar nuevo cliente</span> </div></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float" style="margin-top: 13px;">
                                                            <b>Formato</b>
                                                            <div class="form-line">
                                                                <select id="idFormato" name="idFormato" style="width: 100%; border: none;color:#000;" onchange="obtenerDatosFormato();" required>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float" style="margin-top: 13px;">

                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="#" data-toggle="modal" data-target="#myModalFormato">
                                                                    <div class="demo-google-material-icon"> <i class="material-icons">add_circle</i> <span class="icon-name">Registrar nuevo formato</span> </div></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--  <div class="row">
                                                     <div align="center">
                                                         <button type="button" class="btn bg-grey waves-effect">Siguientes</button>
                                                     </div>
                                                 </div> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingThree_19">
                                            <h4 class="panel-title">
                                                <a  role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="true" aria-controls="collapseThree_19">
                                                    <i class="material-icons">spellcheck</i> Centros de trabajo
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_19">
                                            <div class="panel-body">
                                                <div class="col-md-offset-5">
                                                    <a href="#" onClick="abrirModalCentrosTrabajo();" class="Salto"><i class="material-icons">thumb_up</i> Agregar centros de trabajo</a>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="body table-responsive">
                                                            <table class="table table-hover" id="tablaListado">
                                                                <thead>
                                                                <tr>
                                                                    <th>Centro de trabajo</th>
                                                                    <th>Comentarios</th>
                                                                    <th>Servicio</th>
                                                                    <th>Trámite</th>
                                                                    <th>Capacitación</th>
                                                                    <th>Entrega</th>
                                                                    <th>Comentarios</th>
                                                                    <th>T/Ingreso</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="listaInmueble" onclick="capacitacionTexto();">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div align="center">
                                            <button type="button" onclick="modificaDatos()" class="btn bg-grey waves-effect" style="margin-top: 10px;">Aceptar</button>
                                        </div>
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

<div class="modal fade" id="myModalCliente" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar Nuevo Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-sm-12 col-md-8 col-md-offset-2">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="nombreClienteM" name="nombreClienteM" placeholder="Nombre del cliente" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-md-offset-5">
                        <div class="form-line">
                            <input type="submit" onclick="altaCliente()" class="btn bg-black waves-effect waves-light" value="Guardar">
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


<div class="modal fade" id="myModalInmueble" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Seleccione los centros de trabajo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>Centro de trabajo</label>
                        <div class="form-group form-float" style="margin-top: 13px;">
                            <div class="form-line">
                                <select id="idInmuebleModal" name="idInmuebleModal" style="width: 100%; border: none;color:#000;" onChange="obtenerDireccion();" >
                                    <option value="">Seleccione centros de trabajo</option>
                                    <?php
                                    foreach ($inmueb as $row) {
                                        $idInmueble=$row["idInmueble"];
                                        $nombreInmueble=$row["nombreInmueble"];
                                        echo "
                          <option value='$idInmueble'>$nombreInmueble</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-float">
                            <b>Calle</b>
                            <div class="form-line">
                                <input type='text' id="calle" name="calle" placeholder='Calle' class='form-control' disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group form-float">
                            <b>Número Interior</b>
                            <div class="form-line">
                                <input type='text' id="numInterior" name="numInterior" placeholder='Número Interior' class='form-control' disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group form-float">
                            <b>Número Exterior</b>
                            <div class="form-line">
                                <input type='text' id="numExterior" name="numExterior" placeholder='Número Exterior' class='form-control' disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group form-float">

                            <b>Estado</b>
                            <div class="form-line">
                                <input type='text' id="estado" name="estado" placeholder='Estado' class='form-control' disabled>
								
							</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-float">
                            <b>Delegación</b>
                            <div class="form-line">
                                <input type='text' id="delegacion" name="delegacion" placeholder='Delegación' class='form-control' disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-float">
                            <b>Colonia</b>
                            <div class="form-line">
                                <input type='text' id="colonia" name="colonia" placeholder='Colonia' class='form-control' disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-float">
                            <b>Codigo Postal</b>
                            <div class="form-line">
                                <input type='text' id="codigoPostal" name="codigoPostal" placeholder='Codigo Postal' class='form-control' disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="form-group form-float" style="margin-top: 13px;">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <a href="#" onclick="ponerIdFormato()" >
                                    <div class="demo-google-material-icon">
                                        <i class="material-icons" >add_circle</i> <span class="icon-name">Registrar nuevo Centro</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: none;" id="myModalCentro">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title encabezado-modal">Registrar Nuevo Centro</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="form" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <label for="Formato">Formato</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select id="idFormatoModal" name="idFormatoModal" style="width: 100%; border: none;color:#000;" required>
                                                
												
												<option value="">Seleccione formato</option>
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
                                <div class="col-sm-3">
                                    <label for="Inmueble">Inmueble</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select id="idInmuebleModal" name="idInmuebleModal" style="width: 100%; border: none;color:#000;" required>
                                                <option value="">Seleccione inmueble</option>
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
                                <div class="col-sm-3">
                                    <label for="Nombre">Nombre del centro de trabajo</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="nombreCentroModal" name="nombreCentroModal" placeholder="Nombre" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="email_address">IdDet</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="idDetModal" name="idDetModal" placeholder="IdDet" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <label>Estado</label>
									
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <select id="estadoModal" name="estadoModal" style="width: 100%; border: none;color:#000;"  onChange="obtenerMunicipios();" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Municipio o Delegación</label>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <select id="municipioModal" name="municipioModal" style="width: 100%; border: none;color:#000;"  onChange="obtenerColonias();" required>
                                                <option value="">Seleccione el municipio</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Colonia</label>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <select id="coloniaModal" name="coloniaModal" style="width: 100%; border: none;color:#000;" onChange="obtenerCodigoPostal();" required>
                                                <option value="">Seleccione la colonia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <label for="calle">Calle</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="calleModal" name="calleModal" placeholder="Calle" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="numExterior">Número Exterior</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="numExteriorModal" name="numExteriorModal" placeholder="Número Exterior"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="numInterior">Número Interior</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="numInteriorModal" name="numInteriorModal" placeholder="Número Interior" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="codigoPostal">Código Postal</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="codigoPostalModal" name="codigoPostalModal" placeholder="Código Postal" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <label for="Nombre">Nombre de contacto</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="nomContactoModal" name="nomContactoModal" placeholder="Nombre de contacto" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="email_address">Puesto de contacto</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="puestoContactoModal" name="puestoContactoModal" placeholder="Puesto de contacto" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="email_address">Teléfono de contacto</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" class="form-control" id="telContactoModal" name="telContactoModal" placeholder="Teléfono de contacto" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="email_address">Correo de contacto</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="correoContactoModal" name="correoContactoModal" placeholder="Correo de contacto" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-offset-5">
                                    <div class="form-line">
                                        <input type="submit"  class="btn bg-red waves-effect waves-light" value="Guardar">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-offset-5" id="cargando"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-header">
                <h4 class="modal-title">Seleccione los datos</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group form-float">
                            <b>Comentarios del centro de trabajo</b>
                            <div class="form-line">
                                <input type='text' placeholder='Comentarios' name="cometarioIn" id="cometarioIn" class='form-control'>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group form-float" style="margin-top: 13px;">
                            <b>Área</b>
                            <div class="form-line">
                                <select id="idArea" name="idArea" style="width: 100%; border: none;color:#000;" onChange="obtenerServicio();" required>
                                    <option value="">Seleccione un área</option>
                                    <?php
                                    foreach ($areas as $row) {
                                        $idArea=$row["idArea"];
                                        $nombreArea=$row["nombreArea"];
                                        echo "<option value='$idArea'>$nombreArea</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-float" style="margin-top: 13px;">
                            <b>Servicio</b>
                            <div class="form-line">
                                <select id="idServicio" name="idServicio" style="width: 100%; border: none;color:#000;" onChange="obtenerSubServicio();" required>
                                    <option value="">Seleccione un servicio</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-float" style="margin-top: 13px;">
                            <b>Subservicio</b>
                            <div class="form-line">
                                <select id="idSubservicio" name="idSubservicio" style="width: 100%; border: none;color:#000;" required>
                                    <option value="">Seleccione un subservicio</option>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="areaSshOcul" style="display: block;">
                        <div class="col-md-6">
                            <div class="form-group form-float" style="margin-top: 13px;">
                                <b>Trámite</b>
                                <div class="form-line">
                                    <select id="idTramite" name="idTramite" style="width: 100%; border: none;color:#000;" required>
                                        <option value="">Seleccione trámite</option>
                                        <?php
                                        foreach ($tramite as $row) {
                                            $idTramite=$row["idTramite"];
                                            $nombreTramite=$row["nombreTramite"];
                                            echo "<option value='$idTramite'>$nombreTramite</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group form-float" style="margin-top: 13px;">
                                <b>Capacitación</b>
                                <div class="form-line">
                                    <select id="capacitacioT" name="capacitacioT" style="width: 100%; border: none;color:#000;" required>
                                        <option value="">Seleccione Opción</option>
                                        <option value="1">SI</option>
                                        <option value="2">NO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-float" style="margin-top: 13px;">
                                <b>Tipo ingreso</b>
                                <div class="form-line">
                                    <select id="tipoIngre" name="tipoIngre" style="width: 100%; border: none;color:#000;" required>
                                        <option value="">Seleccione Opción</option>
                                        <option value="1">Se realizará ingreso y gestión</option>
                                        <option value="2">El cliente realizará ingreso y gestión</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-float">
                            <b>Comentarios de entrega</b>
                            <div class="form-line">
                                <input type='text' placeholder='Comentarios' id="comentariosEnt" name="comentariosEnt" class='form-control'>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="form-group form-float" style="margin-top: 13px;">
                                <b>Fecha Entrega</b>
                                <div class="form-line">
                                    <input type="date" class="form-control" id="fechaEntrega" name="fechaEntrega"  required />
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="row">
                    <div id="bitacoras" style="text-align: -webkit-center;">
                        <?php
                        $contadorBitacoras=0;
                        foreach($bitacoras as $bitacora)
                        {
                            $idBitacora=$bitacora['idBitacora'];
                            $nombreBitacora=$bitacora['nombreBitacora'];
                            echo "<input class='form-control' type=\"checkbox\" id=\"cbox".$contadorBitacoras."\" value='".$idBitacora."'> <label for=\"cbox".$contadorBitacoras++."\">".$nombreBitacora."</label>";
                        }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-md-offset-5">
                        <div class="form-line">
                            <input type="button" onclick="AgregarArray()" class="btn bg-black waves-effect waves-light" value="Agregar">
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

<div class="modal fade" id="myModalFormato" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Registrar Nuevo Formato</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="Cliente">Cliente</label>
                        <div class="form-group">
                            <div class="form-line">
                                <select id="idClienteF" name="idClienteF" style="width: 100%; border: none;color:#000;" required>
                                    <option value="">Seleccione cliente</option>
                                    <?php
                                    foreach ($cliente as $row) {
                                        $idClien=$row["idCliente"];
                                        $nombreClient=$row["nombreCliente"];

                                        echo "<option value='$idClien'>$nombreClient</option>";
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="razonSocial">Razón Social</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón social" required />
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-4">
                        <label for="nombreFormato">Nombre del formato</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="nombreFormato" name="nombreFormato" placeholder="Nombre" required />
                            </div>

                        </div>

                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-sm-3">
                        <label for="rfc">RFC</label>
                        <div class="form-group">

                            <div class="form-line">
                                <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC" required />
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <label for="comenRFC">Comentarios RFC</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="comenRFC" name="comenRFC" placeholder="Comentarios RFC" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="domFiscal">Domicilio Fiscal</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control" id="domFiscal" name="domFiscal" placeholder="Domicilio Fiscal" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label for="foto">Logotipo</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input id="foto" name="foto" type="file" class="form-control"  />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-md-offset-5">
                        <div class="form-line">
                            <input type="submit" onclick="altaFormato()" class="btn bg-black waves-effect waves-light" value="Guardar">
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

<script type="text/javascript">


    function altaCliente()
    {
        var nombre=$("#nombreClienteM").val();
        var parametro={"nombre":nombre}
        $.ajax({
            url : "<?php echo site_url('CrudOti/altaClient')?>/",
            type: "post",
            data: parametro,
            dataType: "html",
            success: function(data)
            {
                window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudOti/formAltaOti")

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
            }
        });
    }
    function altaFormato()
    {
        var idclienteM = $("#idClienteF").val();
        var nombreFormato = $("#nombreFormato").val();
        var razonS = $("#razonSocial").val();
        var rfcF = $("#rfc").val();
        var comentariorfc = $("#comenRFC").val();
        var domicilioF = $("#domFiscal").val();

        var parametros = {'idClienteF':idclienteM,'nombreFormato':nombreFormato, 'razonSocial':razonS,'rfc':rfcF,'comenRFC':comentariorfc,
            'domFiscal':domicilioF}

        $.ajax({
            url : "<?php echo site_url('CrudFormatos/altaFormato')?>/",
            type: "post",
            data: parametros,
            dataType: "html",
            success: function(data)
            {
                window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudOti/formAltaOti")

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
            }
        });



    }



    var arregloJson;


    function AgregarArray()
    {
        var idServicio=$("#idServicio").val();
        var idSubservicio=$("#idSubservicio").val();
        var idInmuebleModal=$("#idInmuebleModal").val();//
        var idTramite=$("#idTramite").val();//
		
		
		
        if(idTramite==0)
        {
            idTramite="N/A";
        }
        var cometarioIn=$("#cometarioIn").val();//
        var fechaEntrega=$("#fechaEntrega").val();
        var comentariosEnt=$("#comentariosEnt").val();
        var tipoIngre=$("#tipoIngre").val();
        var capacitacioT=$("#capacitacioT").val();
        //      alert(idInmuebleModal);
        var idArea=$("#idArea").val();
		
		if(!fechaEntrega)
		{
            swal('ERROR', 'La fecha de entrega esta vacia', 'error');
			return;	
		}
		
        if (idArea==1)
         {
            if (idInmuebleModal!="" && idTramite!="" && idSubservicio!="") {
                $.ajax({
                    url:"<?php echo site_url('CrudOti/traerNombreInm/'); ?>"+idInmuebleModal,
                    type: "POST",
                    dataType: "JSON",
                    success:function(data) {
                        var nombreInm=data.nombre;
                        //  alert (nombreInm);
                        $("#nombreInmue").val(nombreInm);
                        llenadoDatos(idInmuebleModal,idTramite,idServicio, idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                    }
                });

                $.ajax({
                    url:"<?php echo site_url('CrudOti/traerNombreSubservicio/'); ?>"+idSubservicio,
                    type: "POST",
                    dataType: "JSON",
                    success:function(data) {
                        var nombreProye=data.nombre;
                        // alert(nombreProye);
                        $("#nombreProy").val(nombreProye);

                        $.ajax({
                            url: "<?php echo site_url('CrudOti/traerNombrePro/'); ?>"+idServicio,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data)
                            {
                                var nombreServicio=data.nombreProyecto;
                                // alert(nombreProye);
                                $("#nombreServicio").val(nombreServicio);
                            }
                        });


                        llenadoDatos(idInmuebleModal,idTramite,idServicio,idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                    }
                });

                $.ajax({
                    url:"<?php echo site_url('CrudOti/traerNombreTrami/'); ?>"+idTramite,
                    type: "POST",
                    dataType: "JSON",
                    success:function(data) {
                        var nombreTrami=data.nombreTramite;
                        // alert(nombreTrami);
                        $("#nombreTram").val(nombreTrami);
                        llenadoDatos(idInmuebleModal,idTramite,idServicio,idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                    }
                });
                //alert(nombreInm)
                swal({
                    type: 'success',
                    title: 'Información agregada',
                    showConfirmButton: false,
                    timer: 500
                });
            }else{
                swal("AVISO", "Seleccione centro de trabajo, subservicio y trámite", "warning")
            }
        }if (idArea!=1)
         {
            if (idInmuebleModal!="" && idSubservicio!="") {

                $.ajax({
                    url:"<?php echo site_url('CrudOti/traerNombreInm/'); ?>"+idInmuebleModal,
                    type: "POST",
                    dataType: "JSON",
                    success:function(data) {
                        var nombreInm=data.nombre;
                        //  alert (nombreInm);
                        // alert("entra 1 "+nombreInm)//listo
                        $("#nombreInmue").val(nombreInm);

                        llenadoDatos(idInmuebleModal,idTramite,idServicio, idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                    }
                });

                $.ajax({
                    url:"<?php echo site_url('CrudOti/traerNombreSubservicio/'); ?>"+idSubservicio,
                    type: "POST",
                    dataType: "JSON",
                    success:function(data) {
                        var nombreProye=data.nombre;
                        // alert(nombreProye);
                        // alert("entra 2 "+nombreProye)//listo
                        $("#nombreProy").val(nombreProye);




                        llenadoDatos(idInmuebleModal,idTramite,idServicio,idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                    }
                });

                $.ajax({
                    url: "<?php echo site_url('CrudOti/traerNombrePro/'); ?>"+idServicio,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        var nombreServicio=data.nombreProyecto;
                        // alert("nombreProye "+nombreServicio);//listo
                        $("#nombreServicio").val(nombreServicio);
                        llenadoDatos(idInmuebleModal,idTramite,idServicio,idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                    }
                });

                /*$.ajax({
                    url:"//<//?php // echo site_url('CrudOti/traerNombreTrami/'); ?>"+idTramite,
                    type: "POST",
                    dataType: "JSON",
                    success:function(data) {
                        var nombreTrami=data.nombreTramite;
                        // alert(nombreTrami);
                        //alert("entra 3 "+nombreTrami)//listo
                        $("#nombreTram").val(nombreTrami);
                        llenadoDatos(idInmuebleModal,idTramite,idServicio,idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                    }
                });*/

                swal({
                    type: 'success',
                    title: 'Información agregada',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else{
                swal("AVISO", "Seleccione centro de trabajo y subservicio", "warning")
            }
         }

    }

    function llenadoDatos(idInmuebleModal,idTramite,idServicio, idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT)
    {
        var idAsignacion=0;
        var idInmuebleModal=idInmuebleModal;
        var idTramite=idTramite;
        var idServicio=idServicio;
        var idSubservicio=idSubservicio;
        var cometarioIn=cometarioIn;
        var fechaEntrega=fechaEntrega;
        var comentariosEnt=comentariosEnt;
        var tipoIngre=tipoIngre;
        var tipoIngres=tipoIngre;
        var capacitacioT=capacitacioT;
        var valorCapacitacion=capacitacioT;
        var capacitacioTB=capacitacioT;
        if (tipoIngre==1)
        {
            tipoIngre="Se realizará ingreso y gestión";
        }
        if (tipoIngre==2)
        {
            tipoIngre="El cliente realizará ingreso y gestión";
        }
        if (capacitacioT==0)
        {
            capacitacioT="NO";
        }
        if (capacitacioT==1)
        {
            capacitacioT="SI";
        }
        if (capacitacioT==2)
        {
            capacitacioT="NO";
        }

        if(valorCapacitacion==0)
            valorCapacitacion=2;
        $("#muestraselectCapacitacion"+contadorArra).val(valorCapacitacion);

        var opciones;
        if(valorCapacitacion==1)
            opciones="<option value=\"1\" selected>SI</option><option value=\"2\">NO</option>";
        else
            opciones="<option value=\"1\">SI</option><option value=\"2\" selected>NO</option>";


        var nombreServicio=$("#nombreServicio").val();
        //nombreProy es el nombre del subservicio
        var nombreProy=$("#nombreProy").val();
        var nombreInmue=$("#nombreInmue").val();
        var nombreTram=$("#idTramite option:selected").text();


        if (nombreServicio!="" && nombreInmue!="")
        {
            var contadorArra=array.datosInmueble.length;
            var longitudArreglo=array.datosInmueble.push({'idAsignacion':idAsignacion,'identificador':contadorArra,'idInmuebleModal': idInmuebleModal,'cometarioIn': cometarioIn,'idControl': idSubservicio,'idTramite': idTramite,'capacitacioTB': capacitacioTB,'fechaEntrega': fechaEntrega,'comentariosEnt': comentariosEnt,'tipoIngre': tipoIngres, 'accion':1, <?php
                echo "'numeroBitacoras' : '$contadorBitacoras'";
                for($i=0; $i<$contadorBitacoras; $i++)
                {
                    echo ", 'Bitacora".$i."' : $('#cbox".$i."').prop('checked'), 'idBitacora".$i."': $('#cbox".$i."').val() ";
                }
                ?>});



            var funcionTramite='onclick=traerTramiteNombre('+contadorArra+')';
            if($("#idArea").val()==2)
            {
                nombreTram="N/A";
                tipoIngre="N/A";
                tipoIngres=0;
                idTramite=0;
                capacitacioT="N/A";
                valorCapacitacion=3;
                funcionTramite="";
            }


            //alert("capacitacioTB "+capacitacioTB)
            //console.log(JSON.stringify(array.datosInmueble, null, 4));

            $("#listaInmueble").append('<tr>'+
                '<td style="display:none;">'+contadorArra+'</td>'+

                '<td  id="nombreCentro'+contadorArra+'" onclick=traerCentroNombre('+contadorArra+');>'+nombreInmue+'</td>'+
                '<td id="muestraselectCentro'+contadorArra+'" style="display: none;">'+
                '<select class="form-control" onFocus="traerCentroNombre('+contadorArra+');" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')" id="selectCentro'+contadorArra+'" name="selectCentro'+contadorArra+'" > </select>'+
                '</td>'+

                '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')">'+cometarioIn+'</td>'+

                /*  '<input type="hidden" id="idInmue'+idInmuebleModal+'" name="idInmue'+idInmuebleModal+'"/>'+
                   '<input type="hidden" id="ComenUe'+idInmuebleModal+'" name="ComenUe'+idInmuebleModal+'"/>'+
                    '<input type="hidden" id="idProyE'+idInmuebleModal+'" name="idProyE'+idInmuebleModal+'"/>'+
                     '<input type="hidden" id="idTramie'+idInmuebleModal+'" name="idTramie'+idInmuebleModal+'"/>'+
                      '<input type="hidden" id="Capacie'+idInmuebleModal+'" name="Capacie'+idInmuebleModal+'"/>'+
                       '<input type="hidden" id="fechE'+idInmuebleModal+'" name="fechE'+idInmuebleModal+'"/>'+
                        '<input type="hidden" id="cometEe'+idInmuebleModal+'" name="cometEe'+idInmuebleModal+'"/>'+*/


                '<td id="nombreServicio'+contadorArra+'" onClick=traerSubservicioNombre('+contadorArra+','+idSubservicio+');>'+nombreServicio+'</td>'+
                '<td id="muestraselectServicio'+contadorArra+'" style="display: none;">'+
                '<select  class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')" id="selectService'+contadorArra+'" name="selectService'+contadorArra+'" > </select>'+
                '</td>'+


                '<select class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')" id="selectProyecto'+contadorArra+'" name="selectProyecto'+contadorArra+'" > </select>'+
                '</td>'+


                '<td id="nombreTramite'+contadorArra+'" '+funcionTramite+' >'+nombreTram+'</td>'+
                '<td id="muestraselectTramite'+contadorArra+'" style="display: none;">'+
                '<select class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')" id="selectTramite'+contadorArra+'" name="selectTramite'+contadorArra+'" > </select>'+
                '</td>'+
                '<td id="nombreCapacitacion'+contadorArra+'" onclick="traerCapacitacionNombre('+contadorArra+', '+valorCapacitacion+');" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')">'+capacitacioT+'</td>'+
                '<td id="muestraselectCapacitacion'+contadorArra+'" style="display: none;">'+
                '<select class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')" id="capaci'+contadorArra+'" name="capaci'+contadorArra+'" >'+opciones+'</select>'+
                '</td>'+
                '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')">'+fechaEntrega+'</td>'+
                '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')">'+comentariosEnt+'</td>'+
                '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idSubservicio+','+idTramite+','+tipoIngres+')">'+tipoIngre+'</td>'+
                '<td><center><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash"></i></button></center></td></tr>');



            $('#tablaListado').Tabledit({
                editButton: false,
                deleteButton:false,
                columns: {
                    identifier: [18, 'iduser'],
                    editable: [[3, 'Comentr'],[10, 'fecEn'],[11, 'comentE']]
                }
            });
            $("input[name*='fecEn']").attr("type",'date');
            limpiacampos();
        }
    }

    function limpiacampos()
    {
        var vaciar="";
        $("#nombreServicio").val(vaciar);
        $("#nombreProy").val(vaciar);
        $("#nombreTram").val(vaciar);
        $("#nombreInmue").val(vaciar);

        $("#cometarioIn").val(vaciar);

        $("#idTramite").val(vaciar);
        $("#capacitacioT").val(vaciar);

        $("#comentariosEnt").val(vaciar);
        $("#tipoIngre").val(vaciar);

    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();
        var indice=  $(this).closest('tr').index(); //para eliminar el registro de la tabla y en el crud
        /**
         Acciones:
         0. No pasa nada
         1. Se inserta
         2. Se actualiza
         3. Se elimina
         */

        //CUANDO IDASIGNACION ==0 ->Un elemento isnertado ercientemente se puede borrar, CUANDO accion==0, un elemento será eliminado


        if(array.datosInmueble[indice]['idAsignacion']=='-1')
        {
            array.datosInmueble.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosInmueble[indice]['accion']='3';
            $(this).closest('tr').hide();
        }
        //console.log(JSON.stringify(array.datosInmueble, null, 4));


    });

    function arrreglodeTabla(idAsignacion,idInmuebleModal,nombreCentroTrabajo,idTramite,idControl, idServicio,idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT)
    {
        var idAsignacion=idAsignacion;
        var nombreCentroTrabajo=nombreCentroTrabajo;
        var idInmuebleModal=idInmuebleModal;
        var idTramite=idTramite;
        var idControl=idControl;
        var idProyecto=idServicio;
        var idSubservicio=idSubservicio;
        var cometarioIn=cometarioIn;
        var fechaEntrega=fechaEntrega;
        var comentariosEnt=comentariosEnt;
        var tipoIngre=tipoIngre;
        var tipoIngres=tipoIngre;
        var capacitacioT=capacitacioT;
        var valorCapacitacion=capacitacioT;

        var capacitacioTB=capacitacioT;

        if (tipoIngre==1)
        {
            tipoIngre="Se realizará ingreso y gestión";
        }
        if (tipoIngre==2)
        {
            tipoIngre="El cliente realizará ingreso y gestión";
        }
        if (capacitacioT==0)
        {
            capacitacioT="N/A";
        }
        else if (capacitacioT==1)
        {
            capacitacioT="SI";
        }
        else if (capacitacioT==2)
        {
            capacitacioT="NO";
        }


        var opciones;
        if(valorCapacitacion==1)
            opciones="<option value=\"1\" selected>SI</option><option value=\"2\">NO</option>";
        else
            opciones="<option value=\"1\">SI</option><option value=\"2\" selected>NO</option>";

        var nombreServicio=$("#nombreServicio").val();
        var nombreProy=$("#nombreProy").val();
        var nombreInmue=$("#nombreInmue").val();
        var idTramite=$("#nombreTram").val();
        var contadorArra=array.datosInmueble.length;
        if (idTramite!=0)
         {
            $.ajax({
              url:"<?php echo site_url('CrudOti/traerNombreTrami/'); ?>"+idTramite,
              type: "POST",
              dataType: "JSON",
              success:function(data) {
                 var nombreTrami=data.nombreTramite;
               
                $("#listaInmueble").append('<tr>'+
            '<td style="display:none;">'+contadorArra+'</td>'+

            '<td id="nombreCentro'+contadorArra+'" onclick=traerCentroNombre('+contadorArra+');>'+nombreCentroTrabajo+'</td>'+
            '<td id="muestraselectCentro'+contadorArra+'" style="display: none;">'+
            '<select class="form-control" onFocus="traerCentroNombre('+contadorArra+');" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')" id="selectCentro'+contadorArra+'" name="selectCentro'+contadorArra+'" > </select>'+
            '</td>'+

            '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')">'+cometarioIn+'</td>'+

            '<td id="nombreServicio'+contadorArra+'" onClick=traerSubservicioNombre('+contadorArra+','+idControl+');>'+nombreServicio+'</td>'+
            '<td id="muestraselectServicio'+contadorArra+'" style="display: none;">'+
            '<select class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')" id="selectService'+contadorArra+'" name="selectService'+contadorArra+'" > </select>'+
            '</td>'+


            '<td id="nombreTramite'+contadorArra+'" onclick=traerTramiteNombre('+contadorArra+');  >'+nombreTrami+'</td>'+
            '<td id="muestraselectTramite'+contadorArra+'" style="display: none;">'+
            '<select class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')" id="selectTramite'+contadorArra+'" name="selectTramite'+contadorArra+'" > </select>'+
            '</td>'+


            '<td id="nombreCapacitacion'+contadorArra+'" onclick="traerCapacitacionNombre('+contadorArra+', '+valorCapacitacion+');">'+capacitacioT+'</td>'+
            '<td id="muestraselectCapacitacion'+contadorArra+'" style="display: none;">'+
            '<select class="form-control" class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')" id="capaci'+contadorArra+'" name="capaci'+contadorArra+'" >'+opciones+'</select>'+
            '</td>'+
            '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')">'+fechaEntrega+'</td>'+
            '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')">'+comentariosEnt+'</td>'+
            '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')">'+tipoIngre+'</td>'+
            '<td><center><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash"></i></button></center></td></tr>');
                  
              }
            });
         }else{
            //alert(nombreCentroTrabajo)
            var nombreTrami="N/A";
            var tipoIngre="N/A";
            $("#listaInmueble").append('<tr>'+
            '<td style="display:none;">'+contadorArra+'</td>'+

            '<td id="nombreCentro'+contadorArra+'" onclick=traerCentroNombre('+contadorArra+');>'+nombreCentroTrabajo+'</td>'+
            '<td id="muestraselectCentro'+contadorArra+'" style="display: none;">'+
            '<select class="form-control" onFocus="traerCentroNombre('+contadorArra+');" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')" id="selectCentro'+contadorArra+'" name="selectCentro'+contadorArra+'" > </select>'+
            '</td>'+
            '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')">'+cometarioIn+'</td>'+
            '<td id="nombreServicio'+contadorArra+'" onClick=traerSubservicioNombre('+contadorArra+','+idControl+');>'+nombreServicio+'</td>'+
            '<td id="muestraselectServicio'+contadorArra+'" style="display: none;">'+
            '<select class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')" id="selectService'+contadorArra+'" name="selectService'+contadorArra+'" > </select>'+
            '</td>'+
            '<td id="nombreTramite'+contadorArra+'">'+nombreTrami+'</td>'+
            '<td id="muestraselectTramite'+contadorArra+'" style="display: none;">'+
            '<select class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')" id="selectTramite'+contadorArra+'" name="selectTramite'+contadorArra+'" > </select>'+
            '</td>'+
            '<td id="nombreCapacitacion'+contadorArra+'" onclick="traerCapacitacionNombre('+contadorArra+','+valorCapacitacion+');">'+capacitacioT+'</td>'+
            '<td id="muestraselectCapacitacion'+contadorArra+'" style="display: none;">'+
            '<select class="form-control" onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')" id="capaci'+contadorArra+'" name="capaci'+contadorArra+'" >'+opciones+'</select>'+
            '</td>'+

            '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')">'+fechaEntrega+'</td>'+
            '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')">'+comentariosEnt+'</td>'+
            '<td onChange="actualizaArray('+idAsignacion+','+contadorArra+','+idInmuebleModal+','+idServicio+','+idControl+','+idTramite+','+tipoIngres+')">'+tipoIngre+'</td>'+
            '<td><center><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash"></i></button></center></td></tr>');
         }
        if(valorCapacitacion==0)
            valorCapacitacion="";
        $("#muestraselectCapacitacion"+contadorArra).val(valorCapacitacion);
        array.datosInmueble.push({'idAsignacion':idAsignacion,'identificador':contadorArra,'idInmuebleModal': idInmuebleModal,'cometarioIn': cometarioIn,'idControl': idControl,'idTramite': idTramite,'capacitacioTB': capacitacioTB,'fechaEntrega': fechaEntrega,'comentariosEnt': comentariosEnt,'tipoIngre': tipoIngres, 'accion':0});
        //console.log(JSON.stringify(array.datosInmueble, null, 4));
        

        $('#tablaListado').Tabledit({
            editButton: false,
            deleteButton:false,
            columns: {
                identifier: [18, 'iduser'],
                editable: [[3, 'Comentr'],[10, 'fecEn'],[11, 'comentE']]
            }
        });
        $("input[name*='fecEn']").attr("type",'date');

    }

    function modificaDatos()
    {
        var idu = $("#idOti").val();
        arregloJson=JSON.stringify(array);

        arre = JSON.parse(arregloJson);

       // console.log("idOti: "+idu);
        //console.log(JSON.stringify(arre, null, 4));

        var url= "<?php echo site_url('CrudOti/actualizarOti/');?>"+borrarTodo;

        var fechaSol = $("#fechaSol").val();
        var horaSoli = $("#horaSoli").val();
        var fechaAcep = $("#fechaAcep").val();
        var parametros = {
            "fechaSol":fechaSol,
            "horaSoli":horaSoli,
            "fechaAcep":fechaAcep,
            "idOti": idu,
            "arreglo" : arre };

        $.post({
            url : url,
            type: "POST",
            data: parametros,
            dataType: "HTML",
            success: function(data)
            {
               // console.log(data);
                swal({     title: "AVISO",
                        text: "La oti ha sido actualizada",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false
                    },
				
                    function(){
                       //window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudOti")
                       //window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudOti")
                        window.history.back(); 
						//wondows.history.forward();
                    });
            }});

    }

    function traerCentroNombre(idI)
    {
        $("#selectCentro"+id).empty();
        var idFormato=$("#idFormato").val();

        if(idFormato!=null)
        {
            var id=idI;
            $("#muestraselectCentro"+id).show();
            $("#nombreCentro"+id).hide();
            $.ajax({
                url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/obtenerDatosCentroTrabajoPorFormato/" + idFormato,
                type: "get",
                dataType: "JSON",
                success: function(data)
                {
                    $("#selectCentro"+id).empty();
                    if (data.length>0)
                    {

                        for (i=0; i<data.length; i++)
                        {
                            $("#selectCentro"+id).append(new Option(data[i]['nombre'],data[i]['idCentroTrabajo']));
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {

                }
            });
        }
        else
        {
            alert("Seleccione un formato primero");
        }
    }


    function traerSubservicioNombre(idP, idControl)
    {
        var idControl=idControl;
        var id=idP;
        $("#muestraselectServicio"+id).show();
        $("#nombreServicio"+id).hide();
        $.ajax({
            url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/todoServicio/"+idControl,
            type: "get",
            dataType: "JSON",
            success: function(data)
            {

                $("#selectService"+id).empty();


                if (data.length>0)
                {
                    for (i=0; i<data.length; i++)
                    {
                        $("#selectService"+id).append(new Option(data[i]['nombre'],data[i]['idControl']));
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
            }
        });
    }

    function traerTramiteNombre(idT)
    {
        var id=idT;
        $("#muestraselectTramite"+id).show();
        $("#nombreTramite"+id).hide();
        $.ajax({
            url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/todoTramite/",
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $("#selectTramite"+id).append(new Option("Seleccione una opción",""));
                if (data.length>0)
                {
                    for (i=0; i<data.length; i++)
                    {
                        $("#selectTramite"+id).append(new Option(data[i]['nombreTramite'],data[i]['idTramite']));
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
            }
        });
    }
    function traerCapacitacionNombre(idT, valorActual)
    {
        var id=idT;
        $("#muestraselectCapacitacion"+id).show();
        $("#nombreCapacitacion"+id).hide();
        $("#capaci"+idT).empty();
        if(valorActual==1)
            $("#capaci"+idT).append("<option value=\"1\" selected>SI</option><option value=\"2\">NO</option> ");
        else if(valorActual==2)
            $("#capaci"+idT).append("<option value=\"1\">SI</option><option value=\"2\" selected>NO</option> ");
        else if(valorActual==3||valorActual==0)
            $("#capaci"+idT).append("<option value='0'>N/A</option>");
    }

    function modificaDadddtos()
    {
        arregloJson=JSON.stringify(array);
        arre = JSON.parse(arregloJson);
        var url;
        var fechaSol = $("#fechaSol").val();
        var idOti = $("#idOti").val();
        var horaSoli = $("#horaSoli").val();
        var fechaAcep = $("#fechaAcep").val();
        var horaAcept = $("#horaAcept").val();
        var idCliente = $("#idCliente").val();
        var idFormato = $("#idFormato").val();
        url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudOti/modificaOtis/';?>";
        var parametros = {
            "fechaSol":fechaSol,
            "horaSoli":horaSoli,
            "fechaAcep":fechaAcep,
            "horaAcept":horaAcept,
            "idCliente":idCliente,
            "idFormato":idFormato,
            "idOti":idOti,
            "arreglo" : arre
        };
        $.ajax({
            url : url,
            type: "POST",
            data: parametros,
            dataType: "HTML",
            success: function(data)
            {
                alert(data)
                /*swal({
                  title: "HECHO",
                  text: "OTI registrado exitosamente.",
                  type: "success",
                  showCancelButton: false,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Aceptar",
                  closeOnConfirm: false
                },
                function(){
                  window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudOti")
                });*/
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
            }
        });
    }



    function actualizaArray(idAsignacion,idI,idC,idS,idSubS,idT,tipoIngres)
    {
        var idAsignacion=idAsignacion;
        var idS=idS;
        var identificador=idI;
        var idC=idC;
        var idSubS=idSubS;
        var idT=idT;
        idI++;
        var tipoIngres=tipoIngres;
        var selecI=$("#selectCentro"+identificador).val();
        var Comentr=$("#Comentr"+idI).val();
        var selectProyect=$("#selectService"+identificador).val();
        var selectTramite=$("#selectTramite"+identificador).val();

        var capaci=$("#capaci"+--idI).val();
        idI++;
        var fecEn=$("#fecEn"+idI).val();
        var comentE=$("#comentE"+idI).val();

        if (selecI==null)
        {
            selecI=idC;
        }else{
            selecI=selecI;
        }

        if (selectProyect==null)
        {
            selectProyect=idSubS;
        }else{
            selectProyect=selectProyect;
        }

        if (selectTramite==null)
        {
            selectTramite=idT;
        }else{
            selectTramite=selectTramite;
        }
        //alert(selecI+" > "+Comentr+" > "+selectProyect+" > "+selectTramite+" > "+capaci+" > "+fecEn+" > "+comentE+" > "+tipoIngres);
        //alert("capacitacioTB Editado"+capaci)
        if(idAsignacion==0)
        {
            array.datosInmueble.splice(identificador,1,{'idAsignacion':idAsignacion,'identificador':identificador,'idInmuebleModal': selecI,'cometarioIn': Comentr,'idControl': selectProyect,'idTramite': selectTramite,'capacitacioTB': capaci,'fechaEntrega': fecEn,'comentariosEnt': comentE,'tipoIngre': tipoIngres, 'accion': 1});
        }
        else
        {
            array.datosInmueble.splice(identificador,1,{'idAsignacion':idAsignacion,'identificador':identificador,'idInmuebleModal': selecI,'cometarioIn': Comentr,'idControl': selectProyect,'idTramite': selectTramite,'capacitacioTB': capaci,'fechaEntrega': fecEn,'comentariosEnt': comentE,'tipoIngre': tipoIngres, 'accion': 2});
        }

        //console.log(JSON.stringify(array.datosInmueble, null, 4));
    }

    function abrirModalCentrosTrabajo()
    {
        var formatoSeleccionado=$("#idFormato").val();

        if(formatoSeleccionado!=null)
            $('#myModalInmueble').modal('show');
        else
            alert("Seleccione un formato primero");

    }


    function obtenerDatosModificacionCentro(idSelect)
    {

    }
</script>
<script>
    function truncarTexto(selector, maxLength) {
        var element = document.querySelector(selector),
            truncated = element.innerText;

        if (truncated.length > maxLength) {
            truncated = truncated.substr(0,maxLength);
            if(truncated.includes("0")||truncated.includes("NO"))
            {
                truncated="NO";
            }
            else
                truncated="SI";

        }
        return truncated;
    }

    function capacitacionTexto()
    {

    }
</script>

<script type="text/javascript">
    function obtenerServicio()
    {
        $("#idServicio").empty();
        $("#idServicio").append('<option value="">Seleccione un servicio</option>');
        $("#idSubservicio").empty();
        $("#idSubservicio").append('<option value="">Seleccione un subservicio</option>');
        var areaSeleccionada=$("#idArea").val();
        if (areaSeleccionada!=1)
        {
            if(areaSeleccionada==2)
            {
                $("#bitacoras").show();
            }
            else
                $("#bitacoras").hide();
            $("#areaSshOcul").hide();

        }
        else
        {
            $("#bitacoras").hide();
            $("#areaSshOcul").show();

        }
        $.ajax({
            url:"<?php echo site_url('CrudOti/obtenerServicios/'); ?>"+areaSeleccionada,
            type: "get",
            dataType: "JSON",
            success: function(data)
            {


                if (data.length>0)
                {


                    for (i=0; i<data.length; i++)
                    {
                        $("#idServicio").append(new Option(data[i]['nombreProyecto'],data[i]['idProyecto']));
                    }
                }
            }
        });
    }
    function obtenerSubServicio()
    {
        $("#idSubservicio").empty();
        $("#idSubservicio").append('<option value="">Seleccione un subservicio</option>');
        var servicioSeleccionado=$("#idServicio").val();
        $.ajax({
            url:"<?php echo site_url('CrudOti/obtenerSubservicios/'); ?>"+servicioSeleccionado,
            type: "get",
            dataType: "JSON",
            success: function(data)
            {


                if (data.length>0)
                {

                    for (i=0; i<data.length; i++)
                    {
                        $("#idSubservicio").append(new Option(data[i]['nombre'],data[i]['idControl']));
                    }
                }
            }
        });
    }

</script>
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
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
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

