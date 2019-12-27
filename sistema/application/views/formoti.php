<?php
include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquerymo.min.js"></script>
<!-- <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script> -->
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.tabledit.js"></script>


<script type="text/javascript">
    var esInicio=1;
    var inicioFormatos=1;
    var clienteSeleccionado=0;
    var formatoSeleccionado=0;
    var array = {
        'datosInmueble': []
    };
    var arregloJson;

    function iniciarMap(){

        var boton=document.getElementById('obtener');

        boton.addEventListener('click', obtener, false);

    }
    function obtener(){navigator.geolocation.getCurrentPosition(mostrar, gestionarErrores);}
    function mostrar(posicion){
        var ubicacion=document.getElementById('localizacion');
        var datos='';
        datos+='Latitud: '+posicion.coords.latitude+'<br>';
        datos+='Longitud: '+posicion.coords.longitude+'<br>';
        datos+='Exactitud: '+posicion.coords.accuracy+' metros.<br>';

        $("#latitud").val(posicion.coords.latitude);
        $("#longitud").val(posicion.coords.longitude);
        $("#Metros").val(posicion.coords.accuracy+" metros.");
    }

    function gestionarErrores(error){
        alert('Error: '+error.code+' '+error.message+ '\n\nPor favor compruebe que está conectado '+
            'a internet y habilite la opción permitir compartir ubicación física');
    }
    window.addEventListener('load', iniciarMap, false);
</script>
<?php
include "datosmodalCentrotrabajo.php";
?>
<script type="text/javascript">
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
            <!-- <a href="<?=site_url('CrudOti');?>"> -->
            <button type="button" class="btn btn-circle-lg waves-effect waves-circle waves-float" style="background-color:white;color:black;" onclick="window.history.back();">
                <i class="material-icons">arrow_back</i>
            </button>
            <!-- </a> -->
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Alta OTI
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
                                                    <i class="material-icons">assignment</i> Datos Generales
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-3 ">
                                                        <input type="hidden" name="nombreServicio" id="nombreServicio">
                                                        <input type="hidden" name="nombreProy" id="nombreProy">
                                                        <input type="hidden" name="nombreInmue" id="nombreInmue">
                                                        <input type="hidden" name="nombreTram" id="nombreTram">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <?php $hoy = date("Y-m-d");  $hora = date("H:i");    ?>
                                                                <b>Fecha de captura</b>
                                                                <input type="date" class="form-control" id="fechaSol" name="fechaSol"  required value="<?php echo $hoy; ?>" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3"  >
                                                        <div class="form-group" style="display: none;">
                                                            <div class="form-line">
                                                                <b>Hora de captura</b>
                                                                <input type="time" class="form-control" id="horaSoli" name="horaSoli"  required value="<?php echo $hora; ?>" readonly/>
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
                                                    <div class="col-sm-3" >
                                                        <!--   <div class="form-group">
                                                              <div class="form-line">
                                                                <b>Hora Aceptación</b>
                                                                  <input type="time" class="form-control" id="horaAcept" name="horaAcept"   />
                                                              </div>
                                                          </div> -->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group form-float" style="margin-top: 13px;">
                                                            <b>Cliente</b>
                                                            <div class="form-line">
                                                                <select id="idCliente" name="idCliente" style="width: 100%; border: none;color:#000;" required onchange="getFormatos();">
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

                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingThree_19">
                                            <h4 class="panel-title">
                                                <a  role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="false" aria-controls="collapseThree_19">
                                                    <i class="material-icons">store_mall_directory</i> Datos del formato
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapseThree_19" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_19">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label for="razón social">Razón social</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" id="razonSocial1" name="razonSocial1" placeholder="Razón social del centro de trabajo" disabled/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="rfc">RFC</label>
                                                        <div class="form-group">
                                                            <div class="form-line">

                                                                <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC del centro de trabajo" disabled/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="email_address">Domicilio Fiscal</label>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" class="form-control" id="domFiscal" name="domFiscal" placeholder="Domicilio Fiscal del centro de trabajo" disabled/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingThree_19">
                                            <h4 class="panel-title">
                                                <a  role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="true" aria-controls="collapseThree_19">
                                                    <i class="material-icons">home</i> Centros de Trabajo
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_19">
                                            <div class="panel-body">
                                                <div class="col-md-offset-5">
                                                    <a class="Salto" style="cursor: pointer;" onClick="abrirModalCentrosTrabajo(); limpiarContenidoCt()"><i class="material-icons">thumb_up</i> Agregar centros de trabajo</a>
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
                                                                <tbody id="listaInmueble">

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
                                            <button type="button" onclick="altaOtiGral()" class="btn bg-grey waves-effect" style="margin-top: 10px;">Registrar</button>
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
                <h4 class="modal-title encabezado-modal">Registrar Nuevo Cliente</h4>
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
                                        echo "<option value='$idInmueble'>$nombreInmueble</option>";
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
                                    <div class="demo-google-material-icon" onClick = "limpiarContenidoCt()">
                                        <i class="material-icons" >add_circle</i> <span class="icon-name">Nuevo Centro de Trabajo</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="display: none;" id="myModalCentro">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title encabezado-modal">Registrar Nuevo Centro de Trabajo</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="form" enctype="multipart/form-data">
                            <div class="row clearfix">
                                <div class="col-sm-12 col-md-6">
                                    <label for="Nombre">Nombre del centro de trabajo</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="nombreCentroModal" name="nombreCentroModal" placeholder="Nombre" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="email_address">IdDet</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="idDetModal" name="idDetModal" placeholder="IdDet" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
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
                                <div class="col-sm-12 col-md-6">
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
                                            <input type="number" class="form-control" id="numExteriorModal" name="numExteriorModal" placeholder="Número Exterior"  required/>
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
                            <input type="button" onclick="AgregarArray()" class="btn bg-red waves-effect waves-light" value="Agregar">
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
                <h4 class="modal-title encabezado-modal">Registrar Nuevo Formato</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="formModal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="idClienteModal">Cliente</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <select id="idClienteModal" name="idClienteModal" style="width: 100%; border: none;color:#000;" required>
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
                            <label for="razonSocialModal">Razón Social</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="razSol" class="form-control" id="razonSocialModal" name="razonSocialModal" placeholder="Razón social" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+" title="Solo letras y numeros" required />
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-3">
                            <label for="nombreFormatoModal">Nombre del formato</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="nombreFormatoModal" name="nombreFormatoModal" placeholder="Nombre" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+" title="Solo letras y numeros" required /> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label for="rfcModal">RFC</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="rfcModal" name="rfcModal" placeholder="RFC" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+" title="Solo letras y numeros" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <label for="comenRFCModal">Comentarios RFC</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="comenRFCModal" name="comenRFCModal" placeholder="Comentarios RFC" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+" title="Solo letras y numeros" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="domFiscalModal">Domicilio Fiscal</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="domFiscalModal" name="domFiscalModal" placeholder="Domicilio Fiscal" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+" title="Solo letras y numeros" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombreRepresentanteModal">Nombre Representante</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input id="nombreRepresentanteModal" name="nombreRepresentanteModal" placeholder="Nombre Representante" type="text" class="form-control" pattern="[0-9a-zA-ZñÑáéíóúÁÉÍÓÚüÜ\s]+" title="Solo letras y numeros" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="file" name="fotoModal" id="fotoModal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-offset-5">
                            <div class="form-line">
                                <input type="submit" class="btn bg-red waves-effect waves-light"  value="Guardar"> 	
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

	/* function onlyText(string){//solo letras y numeros
		var out = '';
		//Se añaden las letras validas
		var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ1234567890áéíóúÁÉÍÓÚ';//Caracteres validos
	
		for (var i=0; i<string.length; i++)
			if (filtro.indexOf(string.charAt(i)) != -1) 
				out += string.charAt(i);
		return out;
	} */
	
	
	function limpiarContenidoCt(){
		$("#form").trigger("reset");
		$("#estadoModal").trigger("change");
		
	}
	
	function aceptarNeuvoFormato(){	
	

		swal({
                title: "Aviso",
                text: "Formato nuevo agregado",
                type: "success",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudOti/formAltaOti";
				limpiarContenidoCt();
				
		})

	}
	
    function abrirModalCentrosTrabajo()
    {
        var formatoSeleccionado=$("#idFormato").val();

        if(formatoSeleccionado!=null)
            $('#myModalInmueble').modal('show');
        else
            alert("Seleccione un formato primero");

    }

    function obtenerDatosFormato(form, cambioCliente)
    {
        var idFormato;
        if(form!=undefined)
            idFormato=form;
        else
            idFormato=$("#idFormato").val();

        if(inicioFormatos==1 || cambioCliente==1)
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
                        alert('Error get data from ajax');
                    }
                });
            inicioFormatos=0;
            if(cambioCliente==1)
            {
                inicioFormatos=1;
            }
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
        $.ajax(
            {
                url : "<?php echo site_url('CrudOti/obtenerDatosCentroTrabajo')?>/" + idFormato,
                type: "get",
                dataType: "JSON",
                success: function(data)
                {
                    $("#razonSocial1").val(data[0]["razonSocial"]);
                    $("#rfc").val(data[0]["rfc"]);
                    $("#domFiscal").val(data[0]["domicilioFiscal"]);
                }
            });


    }
    function getFormatos()
    {
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
                        alert('Error get data from ajax');
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
                                        $("#idFormato").val(form);
                                        clienteSeleccionado=$("#idCliente").val();
                                        formatoSeleccionado=$("#idFormato").val();
                                        obtenerDatosFormato(form, 1);
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown)
                                {
                                    alert('Error get data from ajax');
                                }
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
                alert('Error get data from ajax');
            }
        });
    }

    $("#formModal").on("submit", function(e){
        /*var idclienteM = $("#idClienteF").val();
        var nombreFormato = $("#nombreFormato").val();
        var razonS = $("#razonSocial").val();
        var rfcF = $("#rfcModal").val();
        var comentariorfc = $("#comenRFC").val();
        var domicilioF = $("#domFiscalModal").val();
        var foto = $("#foto").val();
        var nombreRepresentante= $("#nombreRepresentante").val();

        var parametros = {'idClienteF':idclienteM,'nombreRepresentante':nombreRepresentante,'nombreFormato':nombreFormato, 'razonSocial':razonS,'rfc':rfcF,'comenRFC':comentariorfc,
            'domFiscal':domicilioF}*/

        e.preventDefault();

        var formData = new FormData(document.getElementById("formModal"));

        $.ajax({
            url : "<?php echo site_url('CrudFormatos/altaFormatoModal')?>/",
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                console.log(data);
				aceptarNeuvoFormato();
                //window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudOti/formAltaOti")

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    });



    function AgregarArray()
    {
        var idServicio=$("#idServicio").val();
        var idSubservicio=$("#idSubservicio").val();
        var idInmuebleModal=$("#idInmuebleModal").val();//
        var idTramite=$("#idTramite").val();//
        var cometarioIn=$("#cometarioIn").val();//
        var fechaEntrega=$("#fechaEntrega").val();
        var comentariosEnt=$("#comentariosEnt").val();
        var tipoIngre=$("#tipoIngre").val();
        var capacitacioT=$("#capacitacioT").val();
        var idArea=$("#idArea").val();
        //      alert(idInmuebleModal);
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

                $.ajax({
                    url:"<?php echo site_url('CrudOti/traerNombreTrami/'); ?>"+idTramite,
                    type: "POST",
                    dataType: "JSON",
                    success:function(data) {
                        var nombreTrami=data.nombreTramite;
                        // alert(nombreTrami);
                        //alert("entra 3 "+nombreTrami)//listo
                        $("#nombreTram").val(nombreTrami);
                        llenadoDatos(idInmuebleModal,idTramite,idServicio,idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                    }
                });
                //alert(nombreInm)
                swal({
                    type: 'success',
                    title: 'Información agregada',
                    showConfirmButton: false,
                    timer: 700
                });
            }else{
                swal("AVISO", "Seleccione centro de trabajo, subservicio y trámite", "warning")
            }
        }if (idArea!=1)
    {

        if (idInmuebleModal!="" && idSubservicio!="")
        {

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
                url:"<?php echo site_url('CrudOti/traerNombreTrami/'); ?>"+idTramite,
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
                timer: 500
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
            console.log(JSON.stringify(array.datosInmueble, null, 4));

            var capacitacion;
            var tramite;


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


                '<td id="nombreTramite'+contadorArra+'" '+funcionTramite+'>'+nombreTram+'</td>'+
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

    //

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
        $(this).closest('tr').remove();
        array.datosInmueble.splice(indice, 1);
        if(array.datosInmueble.length > 0)
        {
            for(i=0; i<array.datosInmueble.length; i++)
            {
                jQuery.each(array.datosInmueble[i], function(i,val)
                {
                    // alert("valor"+val+"indice"+i);
                });
            }
        }
    });

    function altaOtiGral()
    {
        arregloJson=JSON.stringify(array);

        arre = JSON.parse(arregloJson);

        //   console.log(JSON.stringify(array.datosInmueble, null, 4));

        console.log(JSON.stringify(arre, null, 4));
        var url;
        var fechaSol = $("#fechaSol").val();
        var horaSoli = $("#horaSoli").val();
        var fechaAcep = $("#fechaAcep").val();
        //  var horaAcept = $("#horaAcept").val();
        var idCliente = $("#idCliente").val();
        var idFormato = $("#idFormato").val();

        url= "<?php echo site_url('CrudOti/altaOti/');?>";
        var parametros = {
            "fechaSol":fechaSol,
            "horaSoli":horaSoli,
            "fechaAcep":fechaAcep,
            // "horaAcept":horaAcept,
            "idCliente":idCliente,
            "idFormato":idFormato,
            "arreglo" : arre,
        };
        if(idCliente != "" && idFormato != ""){
            $.ajax({
                url : url,
                type: "POST",
                data: parametros,
                dataType: "HTML",
                success: function(data)
                {
                    swal({
                            title: "HECHO",
                            text: "OTI registrado exitosamente.",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false
                        },
                        function(){
                            // window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudOti")
                            window.history.back();
                        });
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                }
            });
        } else{
            swal({
                    title: "Advertencia",
                    text: "Es necesario seleccionar un cliente y formato",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                }/*,
                function(){
                    window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudOti/formAltaOti")
                }*/);
        }
    }

    function traerCentroNombre(idI)
    {
        var id=idI;
        $("#muestraselectCentro"+id).show();
        $("#nombreCentro"+id).hide();
        $.ajax({
            url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/todoCentro/",
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                $("#selectCentro"+id).append(new Option("Seleccione una opción",""));
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
                alert('Error get data from ajax');
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
        else
            $("#capaci"+idT).append("<option value='0'>N/A</option>");

    }var valorCapacitacion=capacitacioT;

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
                alert('Error get data from ajax');
            }
        });
    }

    /*

    function traerProyectoNombre(idP)
        {
                var id=idP;
                $("#muestraselectProyecto"+id).show();
                $("#nombreProyecto"+id).hide();
                 $.ajax({
                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/todoProyecto/",
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                      $("#selectProyecto"+id).append(new Option("Seleccione una opción",""));
                        if (data.length>0)
                        {
                            for (i=0; i<data.length; i++)
                            {
                                $("#selectProyecto"+id).append(new Option(data[i]['nombreProyecto'],data[i]['idProyecto']));
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }
    */
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
                alert('Error get data from ajax');
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

        console.log(JSON.stringify(array.datosInmueble, null, 4));
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
                    alert('Error get data from ajax');
                }
            });
        }
        else
        {
            alert("Seleccione un formato primero");
        }
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
    $(document).ready(
        function()
        {
            $("#bitacoras").hide();
            $("#areaSshOcul").hide();
        }
    );

</script>

<style type="text/css">
    @-webkit-keyframes glowing {
        50% { color: #fff;  }
    }

    .Salto {
        -webkit-animation: glowing 1500ms infinite;/**/
    }
</style>
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
                <a href=".site_url('Catalogos')." data-mfb-label='Catálogos' class='mfb-component__button--child'>
                <i class='material-icons'>import_contacts</i>
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

