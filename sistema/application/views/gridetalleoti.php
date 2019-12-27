<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload=inicio;
        function inicio(){
            var esProteccionCivil=<?php echo (empty($ssh))? "1": "2";?>;
            var idu = $("#idOti").val();
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
                            getFormatos();
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
                                arrreglodeTabla(idInmuebleModal,nombreCentroTrabajo,idTramite,idControl, idServicio,idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT);
                        }
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                }
            });
        }
        $(function(){
            $("#form").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudOti/modificarDatos/';?>";
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
                        //alert(res);
                        swal("HECHO", "Datos modificados.", "success")
                        //$('#cargando').fadeIn(1000).html(data);
                    });

            });
        });
    </script>


    <section class="content">
        <div class="container-fuid">
            <div class="block-header">
                <?php $tipo=$this->session->userdata('tipoUser');
                if($tipo!='' && $_SESSION['idusuariobase'] != '')
                {
                    if($tipo == 3){
                      //  echo "<a href='".site_url('CrudOti/coordinador')."'>
                        echo "<a href='javascript:history.back(1)'>  
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    } else{
                        //echo "<a href='".site_url('CrudOti'.$ssh)."'>
                        echo "<a href='javascript:history.back(1)'>  
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
                                                        <div class="col-sm-3 ">
                                                            <input type="hidden" name="nombreServicio" id="nombreServicio">
                                                            <input type="hidden" name="nombreProy" id="nombreProy">
                                                            <input type="hidden" name="nombreInmue" id="nombreInmue">
                                                            <input type="hidden" name="nombreTram" id="nombreTram">
                                                            <input type="hidden" name="idFormatoSelect" id="idFormatoSelect">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="hidden" id="idOti" name="idOti" value="<?=$idOti?>">

                                                                    <b>Fecha de solicitud</b>
                                                                    <input type="date" class="form-control" id="fechaSol" name="fechaSol"  required  disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3" >
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Hora de solicitud</b>
                                                                    <input type="time" class="form-control" id="horaSoli" name="horaSoli"  required disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Fecha Aceptación</b>
                                                                    <input type="date" class="form-control" id="fechaAcep" name="fechaAcep"  required disabled />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3" >
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Hora Aceptación</b>
                                                                    <input type="time" class="form-control" id="horaAcept" name="horaAcept"  required disabled />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <div class="form-group form-float" style="margin-top: 13px;">
                                                                <b>Cliente</b>
                                                                <div class="form-line">
                                                                    <select id="idCliente" name="idCliente" style="width: 100%; border: none;color:#000;" required onchange="getFormatos();" disabled>
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
                                                                    <select id="idFormato" name="idFormato" style="width: 100%; border: none;color:#000;" readonly disabled>

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
                                                    <a role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="true" aria-controls="collapseThree_19">
                                                        <i class="material-icons">spellcheck</i> Centros de trabajo
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_19">
                                                <div class="panel-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="body table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Centro de trabajo</th>
                                                                        <th>Comentarios</th>
                                                                        <th>Servicio</th>
                                                                        <th>Subservicio</th>
                                                                        <th>Trámite</th>
                                                                        <th>Capacitación</th>
                                                                        <th>Entrega</th>
                                                                        <th>Comentarios</th>
                                                                        <th>T/Ingreso</th>

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

                                        <?php if($this->session->userdata('tipoUser')==1)
                                        {
                                            ?>
                                            <div class="row">
                                                <div align="center">
                                                    <button type="button" onclick="abrirEditador();"
                                                            class="btn bg-grey waves-effect" style="margin-top: 10px;">
                                                        Deseo modificar
                                                    </button>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
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
                                <input type="submit" onclick="altaCliente()" class="btn bg-black waves-effect waves-light" value="Aceptar">
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
                    <h4 class="modal-title">Seleccione los inmuebles</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-float" style="margin-top: 13px;">
                                <b>Inmueble</b>
                                <div class="form-line">
                                    <select id="idInmuebleModal" name="idInmuebleModal" style="width: 100%; border: none;color:#000;"  >
                                        <option value="">Seleccione Inmueble</option>
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <b>Comentarios de inmueble</b>
                                <div class="form-line">
                                    <input type='text' placeholder='Comentarios' name="cometarioIn" id="cometarioIn" class='form-control'>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-float" style="margin-top: 13px;">
                                <b>Proyecto</b>
                                <div class="form-line">
                                    <select id="idProyecto" name="idProyecto" style="width: 100%; border: none;color:#000;" required>
                                        <option value="">Seleccione Proyecto</option>
                                        <?php
                                        foreach ($proyecto as $row) {
                                            $idProyecto=$row["idProyecto"];
                                            $nombreProyecto=$row["nombreProyecto"];
                                            echo "<option value='$idProyecto'>$nombreProyecto</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                        <div class="col-md-6">
                            <div class="form-group form-float">
                                <b>Comentarios de entrega</b>
                                <div class="form-line">
                                    <input type='text' placeholder='Comentarios' id="comentariosEnt" name="comentariosEnt" class='form-control'>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
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
                                <input type="submit" onclick="altaFormato()" class="btn bg-black waves-effect waves-light" value="Aceptar">
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
        function getFormatos()
        {
            $("#idFormato").html("");
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
                            }
                            $("#idFormato").val(form);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                    }
                });
            }else{
                $("#idFormato").html("");
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

        var array = {
            'datosInmueble': []
        };
        var arregloJson;

        function AgregarArray()
        {
            var idInmuebleModal=$("#idInmuebleModal").val();//
            var idTramite=$("#idTramite").val();//
            var idProyecto=$("#idProyecto").val();//

            var cometarioIn=$("#cometarioIn").val();//
            var fechaEntrega=$("#fechaEntrega").val();
            var comentariosEnt=$("#comentariosEnt").val();
            var tipoIngre=$("#tipoIngre").val();
            var capacitacioT=$("#capacitacioT").val();

            var idArea=$("#idArea").val();
            if (idArea==1)
            {
                if (idInmuebleModal!="" && idTramite!="" && idProyecto!="") {
                    $.ajax({
                        url:"<?php echo site_url('CrudOti/traerNombreInm/'); ?>"+idInmuebleModal,
                        type: "POST",
                        dataType: "JSON",
                        success:function(data) {
                            var nombreInm=data.nombreInmueble;
                            //alert(nombreInm)
                            $("#nombreInmue").val(nombreInm);
                            llenadoDatos(idInmuebleModal,idTramite,idProyecto,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT)
                        }
                    });

                    $.ajax({
                        url:"<?php echo site_url('CrudOti/traerNombrePro/'); ?>"+idProyecto,
                        type: "POST",
                        dataType: "JSON",
                        success:function(data) {
                            var nombreProye=data.nombreProyecto;
                            //alert(nombreProye)
                            $("#nombreProy").val(nombreProye);
                            llenadoDatos(idInmuebleModal,idTramite,idProyecto,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT)
                        }
                    });

                    /* $.ajax({
                       url:"<?php echo site_url('CrudOti/traerNombreTrami/'); ?>"+idTramite,
              type: "POST",
              dataType: "JSON",
              success:function(data) {
                 var nombreTrami=data.nombreTramite;
                 //alert(nombreProye)
                 $("#nombreTram").val(nombreTrami);
               llenadoDatos(idInmuebleModal,idTramite,idProyecto,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT)
              }
            });*/
                    //alert(nombreInm)
                }else{
                    swal("AVISO", "Seleccione inmueble, proyecto y trámite", "warning")
                }
            }if (idArea==2)
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

            }else{
                swal("AVISO", "Seleccione centro de trabajo y subservicio", "warning")
            }
        }

        }
        function llenadoDatos(idInmuebleModal,idTramite,idProyecto,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT)
        {
            var idInmuebleModal=idInmuebleModal;
            var idTramite=idTramite;
            var idProyecto=idProyecto;
            var cometarioIn=cometarioIn;
            var fechaEntrega=fechaEntrega;
            var comentariosEnt=comentariosEnt;
            var tipoIngre=tipoIngre;
            var capacitacioT=capacitacioT;
            var capacitacioTB=capacitacioT;

            if (tipoIngre==1)
            {
                tipoIngre="Se realizará ingreso y gestión";
            }
            if (tipoIngre==2)
            {
                tipoIngre="El cliente realizará ingreso y gestión";
            }
            if (capacitacioT==1)
            {
                capacitacioT="SI";
            }
            if (capacitacioT==2 || capacitacioT==0)
            {
                capacitacioT="NO";
            }
            var nombreProy=$("#nombreProy").val();
            var nombreInmue=$("#nombreInmue").val();
            var nombreTram=$("#nombreTram").val();
            if (nombreProy!="" && nombreInmue!="" && nombreTram!="") {

                array.datosInmueble.push({'idInmuebleModal': idInmuebleModal,'cometarioIn': cometarioIn,'idProyecto': idProyecto,'idTramite': idTramite,'capacitacioTB': capacitacioTB,'fechaEntrega': fechaEntrega,'comentariosEnt': comentariosEnt,'tipoIngre': tipoIngre});
                $("#listaInmueble").append('<tr><td>'+nombreInmue+'</td><td>'+cometarioIn+'</td><td>'+nombreProy+'</td><td>'+nombreTram+'</td><td>'+capacitacioT+'</td><td>'+fechaEntrega+'</td><td>'+comentariosEnt+'</td><td>'+tipoIngre+'</td></tr>');
                limpiacampos()
            }
        }
        function limpiacampos()
        {
            var vaciar="";
            $("#nombreProy").val(vaciar);
            $("#nombreTram").val(vaciar);
            $("#nombreInmue").val(vaciar);

            $("#idInmuebleModal").val(vaciar);
            $("#cometarioIn").val(vaciar);
            $("#idProyecto").val(vaciar);
            $("#idTramite").val(vaciar);
            $("#capacitacioT").val(vaciar);
            $("#fechaEntrega").val(vaciar);
            $("#comentariosEnt").val(vaciar);
            $("#tipoIngre").val(vaciar);

        }


        function arrreglodeTabla(idInmuebleModal,nombreCentroTrabajo,idTramite,idControl, idServicio, idSubservicio,cometarioIn,fechaEntrega,comentariosEnt,tipoIngre,capacitacioT)
        {

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
            var capacitacioT=capacitacioT;

            var capacitacioTB=capacitacioT;

            if (tipoIngre==1)
            {
                tipoIngre="Se realizará ingreso y gestión";
            }
            if (tipoIngre==2)
            {
                tipoIngre="El cliente realizará ingreso y gestión";
            }
            if (capacitacioT==1)
            {
                capacitacioT="SI";
            }
            if (capacitacioT==2||capacitacioT==0)
            {
                capacitacioT="NO";
            }
            var nombreServicio=$("#nombreServicio").val();
            var nombreProy=$("#nombreProy").val();
            var nombreInmue=$("#nombreInmue").val();
            var idTrami=$("#nombreTram").val();
            if (idTrami!=0) {
                $.ajax({
                    url:"<?php echo site_url('CrudOti/traerNombreTrami/'); ?>"+idTrami,
                    type: "POST",
                    dataType: "JSON",
                    success:function(data) {
                        var nombreTrami=data.nombreTramite;

                        //$("#nombreTram").val(nombreTrami);
                        $("#listaInmueble").append('<tr><td>'+nombreCentroTrabajo+'</td><td>'+cometarioIn+'</td><td>'+nombreServicio+'</td><td>'+nombreProy+'</td><td>'+nombreTrami+'</td><td>'+capacitacioT+'</td><td>'+fechaEntrega+'</td><td>'+comentariosEnt+'</td><td>'+tipoIngre+'</td></tr>');
                    }
                });
            }else{
                var nombreTrami="N/A";
                var tipoIngre="N/A";

                $("#listaInmueble").append('<tr><td>'+nombreCentroTrabajo+'</td><td>'+cometarioIn+'</td><td>'+nombreServicio+'</td><td>'+nombreProy+'</td><td>'+nombreTrami+'</td><td>'+capacitacioT+'</td><td>'+fechaEntrega+'</td><td>'+comentariosEnt+'</td><td>'+tipoIngre+'</td></tr>');
            }
            //alert("nombreTrami")
            array.datosInmueble.push({'idInmuebleModal': idInmuebleModal,'cometarioIn': cometarioIn,'idControl': idControl,'idTramite': idTramite,'capacitacioTB': capacitacioTB,'fechaEntrega': fechaEntrega,'comentariosEnt': comentariosEnt,'tipoIngre': tipoIngre});


            //limpiacampos()
        }

        function abrirEditador()
        {
            var PC='<?php echo empty($ssh) ? "" : "ssh"?>';
            var idu = $("#idOti").val();
            window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudOti/formEditarO/"+idu+"/"+PC)
        }
    </script>
<?php
include "footer.php";
?>