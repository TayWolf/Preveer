<?php $tipo=$this->session->userdata('tipoUser');?>

<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>

<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>

<section class="content">

    <div class="container-fluid">

        <div class="block-header">

            <a href='javascript:history.go(-1);'>

                <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>

                    <i class='material-icons'>arrow_back</i>

                </button>

            </a>

        </div>

        <div class="row clearfix">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="card">

                    <div class="header">

                        <h2>

                            Procedimiento de evacuación - <?=$nombreCentroTrabajo?>

                        </h2>

                    </div>

                    <div class="body">

                        <div class="row">

                            <!--INICIO DEL ACORDEON DE DATOS DEL CENTRO DE TRABAJO-->

                            <form id="formDatosCentro">

                                <input type="hidden" name="idCentroTrabajo" id="idCentroTrabajo" value="<?php echo $idCentroTrabajo;?>">

                                <div class="panel-group full-body" id="accordion_DatosCentro" role="tablist" aria-multiselectable="true">

                                    <div class="panel panel-col-lightgray">

                                        <div class="panel-heading" role="tab" id="headingOne_DatosCentro">

                                            <h4 class="panel-title">

                                                <a role="button" data-toggle="collapse" href="#collapseOne_DatosCentro" aria-expanded="true" aria-controls="collapseOne_DatosCentro">

                                                    <i class="material-icons">assignment</i> Datos del centro de trabajo

                                                </a>

                                            </h4>

                                        </div>

                                        <div id="collapseOne_DatosCentro" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_DatosCentro">

                                            <div class="panel-body">

                                                <div class="row body">

                                                    <div class="col-sm-12">

                                                        <div class="row clearfix">



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

                                                            <div class="col-sm-4">

                                                                <label for="razonSocial">Razón social</label>

                                                                <div class="form-group">

                                                                    <div class="form-line">

                                                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social" readonly/>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-sm-4">

                                                                <label for="email_address">Nombre de centro de trabajo</label>

                                                                <div class="form-group">

                                                                    <div class="form-line">

                                                                        <input type="text" class="form-control" id="nombreCentro" name="nombreCentro" placeholder="Nombre" readonly/>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-sm-3" style="display: none;">

                                                                <label for="email_address">IdDet</label>

                                                                <div class="form-group">

                                                                    <div class="form-line">

                                                                        <input type="text" class="form-control" id="idDet" name="idDet" placeholder="IdDet" readonly/>

                                                                    </div>

                                                                </div>

                                                            </div>



                                                        </div>

                                                        <div class="row clearfix">



                                                            <div class="col-md-4">

                                                                <label>Estado</label>

                                                                <div class="form-group form-float">

                                                                    <div class="form-line">

                                                                        <select id="estado" name="estado" style="width: 100%; border: none;color:#000;"  onChange="obtenerMunicipios();" required disabled>

                                                                        </select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-4">

                                                                <label>Municipio o Delegación</label>

                                                                <div class="form-group form-float">

                                                                    <div class="form-line">

                                                                        <select id="municipio" name="municipio" style="width: 100%; border: none;color:#000;"  onChange="obtenerColonias();" required disabled>

                                                                            <option value="" disabled >Seleccione el municipio</option>

                                                                        </select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-4">

                                                                <label>Colonia</label>

                                                                <div class="form-group form-float">

                                                                    <div class="form-line">

                                                                        <select id="colonia" name="colonia" style="width: 100%; border: none;color:#000;" onChange="obtenerCodigoPostal();" required disabled>

                                                                            <option value="" disabled>Seleccione la colonia</option>

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



                                                            <div class="col-sm-3">

                                                                <label for="codigoPostal">Código Postal</label>

                                                                <div class="form-group">

                                                                    <div class="form-line">

                                                                        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Código Postal" readonly />

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

                                                            <div class="col-sm-4">

                                                                <label for="giroInmueble">Giro completo</label>

                                                                <div class="form-group">

                                                                    <div class="form-line">

                                                                        <input type="text" class="form-control" id="giroInmueble" name="giroInmueble" placeholder="Giro del inmueble" readonly />

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>







                                                        <div class="row">

                                                            <div class="col-sm-4 col-sm-offset-4 " align="center">

                                                                <label for="atendioVisita">Nombre de quien atendió la visita</label>

                                                                <div class="form-group">

                                                                    <div class="form-line">

                                                                        <input type="text" class="form-control" id="atendioVisita" name="atendioVisita" onchange="cambiarNombre()" placeholder="Nombre de la persona quien atendió la visita"/>

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

                            </form>



                            <div class="col-sm-12">

                                <div class="form-group">

                                    <div class="form-line">

                                        <b>Objetivo</b>

                                        <textarea readonly class="form-control">Verificar la operatividad del procedimiento de evacuación general que realiza actualmente el inmueble y que elementos tiene disponibles, así como las actividades de los brigadistas para poder desarrollar la evaluación y propuestas de mejora</textarea>

                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-12 table-responsive">

                                <table class="table table-hover">

                                    <thead>

                                    <tr>

                                        <th style="display:none;">ID</th>

                                        <th>#</th>

                                        <th>Paso</th>

                                        <th>Proceso</th>

                                        <th>Equipo y material actual</th>

                                        <th>Procedimiento de brigadistas / Responsable de la actividad</th>

                                    </tr>

                                    </thead>

                                    <tbody>

                                    <?php

                                    $contador=1;

                                    foreach ($procesos as $proceso)

                                    {

                                        print "<tr>".

                                            "<td style='display: none;'>".$proceso['id_proceso']."</td>".

                                            "<td>".$contador++."</td>".

                                            "<td>".$proceso['paso']."</td>".

                                            "<td>".$proceso['proceso']."</td>".

                                            "<td id='valorEquipo".$proceso['id_proceso']."'></td>".

                                            "<td id='valorProcedimiento".$proceso['id_proceso']."'></td></tr>";

                                    }

                                    ?>

                                    </tbody>

                                </table>

                            </div>

                            <form id="otroForm"></form>

                            <form id="procedimiento">

                                <div class="col-sm-12">

                                    <div class="form-group">

                                        <div class="form-line">

                                            <b>Recomendaciones</b>

                                            <textarea class="form-control" id="recomendaciones"><?=$recomendaciones?></textarea>

                                        </div>

                                    </div>

                                </div>

                                <div class='col-lg-6 col-md-6 col-sm-6 '>

                                    <div class='form-group'style="text-align: center;">

                                        <div class='form-line'>

                                            <input type="text" style="text-align: center;" name=""  class='form-control' value="<?php echo $nombreUsuarioVisita?> "   readonly>

                                        </div>

                                        Nombre y firma de quien realizó la visita

                                    </div>

                                </div>

                                <div class='col-lg-6 col-md-6 col-sm-6 '>

                                    <div class='form-group'style="text-align: center;">

                                        <div class='form-line' >

                                            <input type="text" style="text-align: center;" name="firmaAtendioVisita" id="firmaAtendioVisita" class='form-control' value="<?php echo $datosCentroTrabajo['nombreAtendioVisita'];?>" readonly>

                                        </div>

                                        Nombre y firma de quien atendió la visita

                                    </div>

                                </div>

                                <div class="row " >

                                    <div align="center" class="col-md-1 col-sm-offset-5">

                                        <input type="submit" value="Guardar" class="btn bg-red waves-effect waves-light">

                                    </div>

                            </form>

                            <div id="hayDatos" style="display: none">

                                    <div align="center" class="col-md-1">

                                        <button form="otroForm" class="btn bg-red waves-effect waves-light" onclick="popUpImprimir(<?=$idAsignacion?>);">Imprimir</button>

                                    </div>

                                    <div align="center" class="col-md-1">

                                        <button form="otroForm" class="btn bg-red waves-effect waves-light" data-toggle="modal" data-target="#correoModal" id="btn-enviar" >Enviar correo</button>

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

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                <button type="button" class="btn btn-primary" onclick="enviarCorreoPDF(<?=$idAsignacion?>,<?=$datosCentroTrabajo['idCentroTrabajo']?>)">Enviar</button>

            </div>

        </div>

    </div>

</div>

<!--Funciones para imprimir y enviar por PDF-->

<script>

    function  popUpImprimir(id)

    {

        window.open("https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/procedimiento/"+id,"neo","width=900,height=600,menubar=si");

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

                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/enviarPDFProcedimiento/"+idAsignacion+"/"+idCentroTrabajo,

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

</script>

<!--FIN de Funciones para imprimir y enviar por PDF-->



<script>

    $(document).ready(function () {

        $.ajax({

            url: '<?=site_url('CrudProcedimientoEvacuacion/traerDatos/'.$idAsignacion)?>',

            dataType: 'JSON',

            success:function (data)

            {

                if(data.length>0)

                {

                    for(var i=0; i<data.length; i++)

                    {

                        $("#valorEquipo"+data[i]['id_proceso']).html(data[i]['valorEquipo']);

                        $("#valorProcedimiento"+data[i]['id_proceso']).html(data[i]['valorProcedimiento']);

                    }

                }

                else

                {

                    $("#hayDatos").remove();

                }

            },complete: function () {

                $.noConflict();

                $('table').Tabledit({

                    url: '<?=site_url('CrudProcedimientoEvacuacion/guardarProcedimientoEvacuacion/'.$idAsignacion)?>',

                    editButton: false,

                    deleteButton: false,

                    hideIdentifier: true,

                    columns: {

                        identifier: [0, 'id_proceso'],

                        editable: [[4, 'equipo'], [5, 'procedimiento']]

                    }

                });

            }

        });

    });

    $("#otroForm").submit(function (e) {

        e.preventDefault();

    });

    $("#procedimiento").submit(function (e) {

        e.preventDefault();

       $.ajax({

           url: '<?=site_url('CrudProcedimientoEvacuacion/guardarRecomendaciones/'.$idAsignacion)?>',

           type: 'post',

           data: {recomendaciones: $("#recomendaciones").val()},

           dataType: 'HTML',

           success:function (data) {

               //swal('Exito!', 'Se guardó el procedimiento de evacuación', 'success');
               swal({
                      title: "Datos guardados",
                      //text: "Your will not be able to recover this imaginary file!",
                      type: "success",
                      
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false
                    },
                    function(){
                      $("#hayDatos").show();
                       swal.close()
                    });
           }

       });

    });

</script>

<!--CARGA LOS DATOS DEL CETNRO DE TRABAJO-->

<script>

    window.onload=cargarDatosCentroTrabajo;

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



                                        obtenerCodigoPostal();

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

    function obtenerCodigoPostal()

    {

        var idColonia=$("#colonia").val();

        $.ajax({

            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerCodigoPostal')?>/"+idColonia,

            type: "get",

            dataType: "json",

            success: function(data)

            {

                $("#codigoPostal").val(data[0]["cp"]);

            }

        });

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

</script>

<!--FIN CARGA LOS DATOS DEL CETNRO DE TRABAJO-->