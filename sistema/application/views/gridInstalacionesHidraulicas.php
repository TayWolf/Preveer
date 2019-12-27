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
        'datosTipoInHidraulica': []
    };
</script>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php $tipo=$this->session->userdata('tipoUser');
            if($tipo!='' && $_SESSION['idusuariobase'] != '')
            {
                if($tipo == 3){
                    echo "<a href='".site_url('CrudAnalisisRiesgo')."/".$this->session->userdata('idusuariobase')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } else{
                    echo "<a href='".site_url('CrudAnalisisRiesgo/')."'>
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
                        <h2>Instalaciones hidraulicas del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <form id="formularioInsercion"></form>
                        <form id="form" enctype="multipart/form-data">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">

                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">

                                <?php
                                $contador=0;
                                $row=array('idInstalacionesHidraulicas'=>"", 'suministro'=>"", 'sumOtro'=>"", 'tuberia'=>"", 'observacionesDatos'=>"", 'idAsignacion'=>"", );
                                foreach ($existencia as $row2)
                                {
                                    $row=$row2;
                                    $contador++;
                                }
                                ?>
                                <input type="hidden" name="idInstalacionesHidraulicas" id="idInstalacionesHidraulicas" value="<?php echo $row['idInstalacionesHidraulicas'];?>">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                                <i class="material-icons">assignment</i> Datos
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Sumistro</b>
                                                            <input type="hidden" id="idCa" name="idCa" value="<?php echo $row['idInstalacionesHidraulicas'];?>">
                                                            <select type="number" class="form-control" id="suministro" name="suministro" min="0" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['suministro'] == 1) echo "selected"?>>Red municipal</option>
                                                                <option value="2" <?php if($row['suministro'] == 2) echo "selected"?>>Pipa</option>
                                                                <option value="3" <?php if($row['suministro'] == 3) echo "selected"?>>Otro</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Otro suministro</b>
                                                            <input type="text" class="form-control" id="sumOtro" name="sumOtro" min="0" value="<?php echo $row['sumOtro'];?>" required <?php if($row['suministro'] != 3) echo "disabled"?>/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tuberia</b>
                                                            <select type="number" class="form-control" id="tuberia" name="tuberia" min="0" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['tuberia'] == 1) echo "selected"?>>Cobre</option>
                                                                <option value="2" <?php if($row['tuberia'] == 2) echo "selected"?>>Galvanizada</option>
                                                                <option value="3" <?php if($row['tuberia'] == 3) echo "selected"?>>Sin Información</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" id="observacionesDatos" name="observacionesDatos" value="<?php echo $row['observacionesDatos'];?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form id="form2"  >
                            <div class="panel-group full-body" id="accordion_19" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_19">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">
                                                <i class="material-icons">assignment</i> Instalaciones hidráulicas
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Instalación</b>
                                                            <select type="number" class="form-control" id="instalacion" name="instalacion" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <?php
                                                                foreach ($catalogo AS $option){
                                                                    print('<option value="'.$option['idCatalogoHidraulica'].'">'.$option['nombre'].'</option>');
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad</b>
                                                            <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" value="" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Capacidad (lts)</b>
                                                            <input type="number" class="form-control" id="capacidad" name="capacidad" min="0" value="" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Capacidad Bomba</b>
                                                            <input type="number" class="form-control" id="capacidadBomba" name="capacidadBomba" min="0" value="" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Ubicación</b>
                                                            <textarea type="text" class="form-control" id="ubicacion" name="ubicacion"> </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <textarea type="text" class="form-control" id="observaciones" name="observaciones" min="0" > </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row text-center">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 col-md-offset-5">
                                                            <div class="form-line">
                                                                <input type="submit" value="Agregar" class="btn bg-red" id="agregar-in">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="body table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>INSTALACIÓN</th>
                                                            <th>CANTIDAD</th>
                                                            <th>CAPACIDAD</th>
                                                            <th>CAPACIDAD BOMBA</th>
                                                            <th>UBICACIÓN</th>
                                                            <th>OBSERVACIONES</th>
                                                            <th>FOTOS</th>
                                                            <th>ELIMINAR</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="listaInstalacionesHidraulicas">

                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="panel-body">
                            <div class="row text-center">
                                <div class="col-sm-12 col-md-offset-5">
                                    <div class="form-line">
                                        <input type="submit" onclick="registrarDatosHidraulica();" class="btn bg-red waves-effect waves-light"  value="Guardar">
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
                <h4 class="modal-title">Imagen de la instalación</h4>
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

    function registrarDatosHidraulica()
    {
        if($('#suministro option:selected').val() != '') {

            accion = "actualizarInstalacionHidraulica/";
            var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/';?>" + accion;
            var formData = new FormData(document.getElementById("form"));
            formData.append('datosPuenteHidraulica', (JSON.stringify(array.datosTipoInHidraulica)));

            console.log(JSON.stringify(array.datosTipoInHidraulica));
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
                            text: "Se han registrado los datos generales",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",
                        },
                        function () {
                            location.href = 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formInstalacionesHidraulicas/' + $("#idAsignacion").val();
                        });
                });
        }else{
            $( "#suministro" ).focus();
        }
    }


    $("#form2").on("submit", function(e){
        e.preventDefault();
        AgregarTipoInsHidraulica();
    });


    function AgregarTipoInsHidraulica()
    {
        //alert("entra")
        var catalogo = $("#idCa").val();
        var instalacion = $("#instalacion").val();
        var capacidad = $("#capacidad").val();
        var capacidadBomba = $("#capacidadBomba").val();
        var cantidad = $("#cantidad").val();
        var ubicacion = $("#ubicacion").val();
        var observaciones = $("#observaciones").val();
        var nombreInstalacion = $('#instalacion option:selected').text();
        var idAsigns = $("#idAsignacion").val();
        var arreglo = {'datos': []};


        arreglo.datos.push({'idHidraulicaCatalogo': '-1', 'instalacion': instalacion ,'capacidad': capacidad, 'capacidadBomba': capacidadBomba, 'cantidad': cantidad, 'catalogo': catalogo,'ubicacion': ubicacion, 'action' : 1, 'observaciones': observaciones});
        //console.log(JSON.stringify(array.datosTipoInHidraulica, null, 4));

        var formData = new FormData(document.getElementById('formularioInsercion'));
        formData.append('datos', JSON.stringify(arreglo.datos));

        //empieza codigo insercion 
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/insertarArregloInstalacionesHidraulicas/" + idAsigns,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    array.datosTipoInHidraulica.push({
                        'idHidraulicaCatalogo': data,
                        'instalacion': instalacion ,
                        'catalogo': catalogo ,
                        'capacidad': capacidad,
                        'capacidadBomba': capacidadBomba,
                        'cantidad': cantidad,
                        'ubicacion': ubicacion,
                        'action' : 0,
                        'observaciones': observaciones});


                    $("#listaInstalacionesHidraulicas").append('<tr>'+
                        '<td>'+$("#instalacion option:selected").text()+'</td>'+
                        '<td>'+cantidad+'</td>'+
                        '<td>'+capacidad+'</td>'+
                        '<td>'+capacidadBomba+'</td>'+
                        '<td>'+ubicacion+'</td>'+
                        '<td>'+observaciones+'</td>'+
                        '<td><button onclick="traerFotoUnicaH('+data+' )"  data-toggle="modal" data-target="#myModalImagenInstalacion" type="button" class="btn btn-default"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
                        '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                        '</tr>');

                    limpiarFormulario();
                }
            }
        );
        // finaliza codigo insercion
    }

    function limpiarFormulario()
    {
        $("#instalacion").val("");
        $("#capacidad").val("");
        $("#capacidadBomba").val("");
        $("#cantidad").val("");
        $("#ubicacion").val("");
        $("#observaciones").val("");
    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();

        var indice =  $(this).closest('tr').index();

        if(array.datosTipoInHidraulica[indice]['idHidraulicaCatalogo'] == -1)
        {
            array.datosTipoInHidraulica.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosTipoInHidraulica[indice]['action']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array.datosTipoInHidraulica, null, 4));

    });


</script>

<script>
    window.onload = cargaDatosTabla;

    function cargaDatosTabla(){
        <?php
        foreach ($hidraulicaPuente as $row) {
            $idHidraulicaCatalogo = $row["idHidraulicaCatalogo"];
            $idInstalacion = $row["idInstalacion"];
            $nombreCatalogoHidraulica = $row["nombre"];
            $idCatalogo = $row["idCatalogo"];
            $cantidad = $row["cantidad"];
            $capacidad = $row["capacidad"];
            $capacidadBomba = $row["capacidadBomba"];
            $ubicacion = preg_replace( "/\r|\n/", " '+' ", $row["ubicacion"]);
            $observaciones = preg_replace( "/\r|\n/", " '+' ", $row["observaciones"] );

            $idAsignacion = $row["idAsignacion"];


            print "array.datosTipoInHidraulica.push({'idHidraulicaCatalogo' : $idHidraulicaCatalogo,'instalacion' : $idInstalacion, 'capacidad' : $capacidad, 'capacidadBomba' : $capacidadBomba, 'cantidad' : $cantidad, 'ubicacion' : '$ubicacion', 'action' : 0, 'observaciones' : '$observaciones'}); \n";

            print "$('#listaInstalacionesHidraulicas').append(
                     '<tr><td hidden>$idHidraulicaCatalogo</td><td hidden>$idInstalacion</td><td>$nombreCatalogoHidraulica</td><td hidden>$idCatalogo</td><td>$cantidad</td><td>$capacidad</td><td>$capacidadBomba</td><td>$ubicacion</td><td>$observaciones</td><td><button onclick=\"traerFotoUnicaH($idHidraulicaCatalogo)\" type=\"button\" class=\"btn btn-default\"><i data-toggle=\"modal\" data-target=\"#myModalImagenInstalacion\" class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
        }
        print("console.log(JSON.stringify(array.datosTipoInHidraulica, null, 4));");
        ?>
    }

    function traerFotoUnicaH(llavePrimaria)
    {
        $("#ConteniFoto").html("");


        $("#ConteniFoto").append("<div class=\"row\"><div class=\"col-sm-6 col-md-6\"><input type='file' class='file' id='foto1' name='foto1[]' data-min-file-count='1' /></div><div class=\"col-sm-6 col-md-6\"><input type='file' class='file' id='foto2' name='foto2[]' data-min-file-count='1' /></div></div><div class=\"row\"><div class=\"col-sm-6 col-md-6\"><input type='file' class='file' id='foto3' name='foto3[]' data-min-file-count='1' /></div><div class=\"col-sm-6 col-md-6\"><input type='file' class='file' id='foto4' name='foto4[]' data-min-file-count='1' /></div></div>");
        //alert(idAsi+"/"+idT+"/"+capac+"/"+cantid)
        $.ajax({
            url : "<?php echo site_url('CrudAnalisisRiesgo/retornoFotoPK')?>/" + llavePrimaria+"/HidraulicaCatalogoPuente/idHidraulicaCatalogo/",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                //alert("fot")
                if (data.length>0)
                {
                    for (i=0; i< data.length; i++)
                    {
                        for(j=1;j<=4; j++)
                        {

                            var fot=data[i]["foto"+j];
                            crearFileInputFotos(fot, j, llavePrimaria);

                        }

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
    function crearFileInputFotos(valor, j, llavePrimaria)
    {
        var fot=valor;
        // alert(fot)
        if (fot!=null)
        {

            var codig="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/foto"+j+"/"+fot+"' class='file-preview-image' >";
        }

        var idControl=data[i]["idHidraulicaCatalogo"];
        // alert(idControl)
        $("#foto"+j).fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneralTabla/foto"+j+"/HidraulicaCatalogoPuente/"+llavePrimaria+"/idHidraulicaCatalogo",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png'],
            initialPreview: [codig]


        }).on('change', function(event, data, previewId, index)
        {
            $("#foto"+j).fileinput("upload");

        }).on('fileclear', function (event) {
            // aun sin programar
            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenArreglo/foto"+j+"/HidraulicaCatalogoPuente/"+llavePrimaria+"/idHidraulicaCatalogo/";
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

</script>


</body>

</html>
<!--
<?php
//include "footer.php";
?>

-->
