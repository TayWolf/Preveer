<?php
include "header.php";
?>


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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    var array = {
        'datosRevisionInstalacion': []
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
                        <h2>Revisión de instalaciones del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <form id="formularioInsercion"></form>
                        <form id="form" enctype="multipart/form-data">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php print $idAsignacion; ?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
                                <input type="hidden" name="idInstalacionesHidraulicas" id="idInstalacionesHidraulicas" value="<?php /*echo $row['idInstalacionesHidraulicas'];*/?>">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                                <i class="material-icons">assignment</i> Revisión de Instalaciones
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">
                                            <div class="row">

                                                <?php
                                                $row = array('idRevisionInstalaciones'=>"", 'idCatalogoRevisionÍndice'=>"", 'estadoInstalacion'=>"",
                                                    'cantidadInstalacion'=>"", 'ubicacion'=>"", 'observaciones'=>"", 'cantidadInstalacion'=>"", 'idAsignacion'=>"");

                                                foreach ($existencia as $row2)
                                                {
                                                    $row = $row2;
                                                }

                                                ?>

                                                <!--<input type="hidden" name="idCatalogoRevision" id="idCatalogoRevision" value="">-->
                                                <div class="col-12">
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Instalación</b>
                                                                <select type="number" class="form-control" id="idCatalogoRevision" name="idCatalogoRevision'" min="0" value="" required>
                                                                    <option value="">Seleccione una opción</option>
                                                                    <?php
                                                                    foreach ($catalogoRevision AS $option){
                                                                        print('<option value="'.$option['idCatalogoRevision'].'">'.$option['nombre'].'</option>');
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Estado</b>
                                                                <select type="number" class="form-control" id="estadoInstalacion" name="estadoInstalacion" min="0" value="" required>
                                                                    <option value="">Seleccione una opción</option>
                                                                    <option value="1">Si</option>
                                                                    <option value="2">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Cantidad</b>
                                                                <input type="number" class="form-control" id="cantidadInstalacion" name="cantidadInstalacion" min="1" value="" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Ubicación</b>
                                                                <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Observaciones</b>
                                                                <input rows="2" cols="2" type="text" class="form-control" id="observaciones" name="observaciones" value="" >
                                                            </div>
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
                        </form>
                                                <div class="body table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th hidden></th>
                                                            <th hidden></th>
                                                            <th hidden></th>
                                                            <th>INSTALACIÓN</th>
                                                            <th>ESTADO</th>
                                                            <th>CANTIDAD</th>
                                                            <th>UBICACIÓN</th>
                                                            <th>OBSERVACIONES</th>
                                                            <th>FOTO</th>
                                                            <th>ELIMINAR</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="listaRevisionInstalaciones">

                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="panel-body">
                            <div class="row text-center">
                                <div class="col-sm-12 col-md-offset-5">
                                    <div class="form-line">
                                        <input type="submit" onclick="registrarDatosRevisionIn();" class="btn bg-red waves-effect waves-light"  value="Guardar">
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
            <div class="col-md-4 col-md-offset-4">
                <b>Foto Instalación</b>
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

    function registrarDatosRevisionIn()
    {
        accion = "actualizarRevisionInstalaciones/";
        var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/';?>" + accion;
        var formData = new FormData(document.getElementById("form"));
        formData.append('datosRevisionInstalaciones', (JSON.stringify(array.datosRevisionInstalacion)));

        console.log(JSON.stringify(array.datosRevisionInstalacion));

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
                        location.href = 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formRevisionInstalaciones/' + $("#idAsignacion").val();
                    });
            });
    }

    $("#form").on("submit", function(e){
        e.preventDefault();
        AgregarRevisionInstalacion();
    });

    function AgregarRevisionInstalacion() {
        var idAsigns = $("#idAsignacion").val();
        var idCatalogoRevision = $("#idCatalogoRevision").val();
        var nombreInstalacion = $('#idCatalogoRevision option:selected').text();
        var estadoInstalacion = $("#estadoInstalacion").val();
        var nombreEstadoInstalacion = $("#estadoInstalacion").val();
        var cantidadInstalacion = $("#cantidadInstalacion").val();
        var ubicacion = $("#ubicacion").val();
        var observaciones = $("#observaciones").val();
        var arreglo = {'datos': []};
        arreglo.datos.push({
            'idRevisionInstalaciones': '-1',
            'idCatalogoRevision': idCatalogoRevision,
            'estadoInstalacion': estadoInstalacion,
            'cantidadInstalacion': cantidadInstalacion,
            'ubicacion': ubicacion,
            'action': 1,
            'observaciones': observaciones
        });
        var formData = new FormData(document.getElementById('formularioInsercion'));
        formData.append('datos', JSON.stringify(arreglo.datos));
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/insertarArregloRevisionInstalaciones/" + idAsigns,
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    array.datosRevisionInstalacion.push({
                        'idRevisionInstalaciones': data,
                        'idCatalogoRevision': idCatalogoRevision,
                        'estadoInstalacion': estadoInstalacion,
                        'cantidadInstalacion': cantidadInstalacion,
                        'ubicacion': ubicacion,
                        'action': 0,
                        'observaciones': observaciones
                    });
                    if (nombreEstadoInstalacion == 1) {
                        nombreEstadoInstalacion = "Si";
                    }
                    else
                        nombreEstadoInstalacion = "No";
                    $("#listaRevisionInstalaciones").append('<tr>' +
                        '<td>' + nombreInstalacion + '</td>' +
                        '<td>' + nombreEstadoInstalacion + '</td>' +
                        '<td>' + cantidadInstalacion + '</td>' +
                        '<td>' + ubicacion + '</td>' +
                        '<td>' + observaciones + '</td>' +
                        '<td><button onclick="traerFotoUnica2(' + data + ')" data-toggle="modal" data-target="#myModalImagenInstalacion" type="button" class="btn btn-default"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>' +
                        '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>' +
                        '</tr>');
                    console.log(JSON.stringify(array.datosRevisionInstalacion, null, 4));
                }
            }
        );


        limpiarFormulario();
    }
     function traerFotoUnica2(llavePrimaria)
     {
         $("#ConteniFoto").html("");
         $("#ConteniFoto").append("<input type='file' class='file' id='fotoInstalacion' name='fotoInstalacion[]' data-min-file-count='1' />")

         $.ajax({
             url : "<?php echo site_url('CrudAnalisisRiesgo/retornoFotoPK')?>/"+llavePrimaria+"/RevisionInstalaciones/idRevisionInstalaciones/",
             type: "GET",
             dataType: "JSON",
             success: function(data)
             {

                 if (data.length>0)
                 {
                     for (i=0; i< data.length; i++) {
                         var fot=data[i]["fotoInstalacion"];
                         if (fot!=null)
                         {
                             var codig="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoInstalacion/"+fot+"' class='file-preview-image' >";
                         }
                         var idControl=data[i]["idRevisionInstalaciones"];
                         // alert(fot)
                         $("#fotoInstalacion").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
                             'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneralTabla/fotoInstalacion/RevisionInstalaciones/"+llavePrimaria+"/idRevisionInstalaciones",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
                             ,


                             initialPreview: [codig
                             ]


                         }).on('change', function(event, data, previewId, index)
                         {
                             $("#fotoInstalacion").fileinput("upload");

                         }).on('fileclear', function (event) {
                             // alert(idAsi)
                             url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenServidorInstala/"+idControl;
                             $.ajax({
                                 url: url,
                                 type: "post",
                                 dataType: "html"
                             }).done(function (res) {});


                         });

                     }
                 }
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
                 alert(errorThrown);
                 alert(jqXHR);
                 alert(textStatus);
             }
         });

     }

    function limpiarFormulario()
    {
        $("#idCatalogoRevision").val("");
        $("#estadoInstalacion").val("");
        $("#cantidadInstalacion").val("");
        $("#ubicacion").val("");
        $("#observaciones").val("");
    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();

        var indice =  $(this).closest('tr').index();

        if(array.datosRevisionInstalacion[indice]['idRevisionInstalaciones'] == -1)
        {
            array.datosRevisionInstalacion.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosRevisionInstalacion[indice]['action']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array.datosRevisionInstalacion, null, 4));

    });

</script>
<script>
    window.onload = cargaDatosTabla;

    function cargaDatosTabla(){
        <?php
        foreach ($revisionCatalogoInstalaciones as $row) {
            if($row["idCatalogoRevision"] != ''){
                $idAsignacion = $row["idAsignacion"];
                $idRevisionInstalaciones = $row["idRevisionInstalaciones"];
                $idCatalogoRevision = $row["idCatalogoRevision"];
                $nombreCatalogoRevision = $row["nombre"];
                $estadoI=$row["estadoInstalacion"];
                if( $row["estadoInstalacion"] == 1 ){ $estadoInstalacion = 'Si'; }
                else{ $estadoInstalacion = 'No'; };
                $cantidadInstalacion = $row["cantidadInstalacion"];
                $ubicacion = $row["ubicacion"];
                $observaciones = $row["observaciones"];

                print "array.datosRevisionInstalacion.push({'idRevisionInstalaciones' : $idRevisionInstalaciones, 'idCatalogoRevision' : $idCatalogoRevision, 'estadoInstalacion' : '$estadoInstalacion', 'cantidadInstalacion' : $cantidadInstalacion, 'ubicacion' : '$ubicacion', 'action' : 0, 'observaciones' : '$observaciones'}); \n";

                print "$('#listaRevisionInstalaciones').append(
                     '<tr><td hidden>$idRevisionInstalaciones</td><td hidden>$idCatalogoRevision</td><td>$nombreCatalogoRevision</td><td>$estadoInstalacion</td><td>$cantidadInstalacion</td><td>$ubicacion</td><td>$observaciones</td><td><button onclick=\"traerFotoUnica2($idRevisionInstalaciones)\" type=\"button\" class=\"btn btn-default\"><i data-toggle=\"modal\" data-target=\"#myModalImagenInstalacion\" class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";

            }
        }
        print("console.log(JSON.stringify(array.datosRevisionInstalacion, null, 4));");
        ?>
    }

</script>





<?php
include "footer.php";
?>
