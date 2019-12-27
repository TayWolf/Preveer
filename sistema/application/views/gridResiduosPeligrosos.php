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
    var array2 = {
        'datosResiduosPeligrosos': []
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
                        <h2>Residuos Peligrosos del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <form id="form2" enctype="multipart/form-data">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php print $idAsignacion; ?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">

                                <?php
                                $contador=0;
                                $row=array('idInstalacionesHidraulicas'=>"", 'suministro'=>"", 'sumOtro'=>"", 'tuberia'=>"", 'idAsignacion'=>"", );
                                /* foreach ($existencia as $row2)
                                 {
                                     $row=$row2;
                                     $contador++;
                                 }*/
                                ?>
                                <input type="hidden" name="idInstalacionesHidraulicas" id="idInstalacionesHidraulicas" value="<?php /*echo $row['idInstalacionesHidraulicas'];*/?>">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                                <i class="material-icons">assignment</i> Residuos Peligrosos
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tipo de almacen</b>
                                                            <input type="text" class="form-control" id="tipoAlmacen" name="tipoAlmacen" value="" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad</b>
                                                            <input type="number" class="form-control" id="cantidadMaterial" name="cantidadMaterial" min="1" value="" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Ubicación</b>
                                                            <input type="text" class="form-control" id="ubicacionMaterial" name="ubicacionMaterial" value="" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Materiales comunes</b>
                                                            <input type="text" class="form-control" id="materialesComunes" name="materialesComunes" value="" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" id="observaciones" name="observaciones" value="" required/>
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
                                                            <th hidden></th>
                                                            <th>TIPO ALMACEN</th>
                                                            <th>CANTIDAD REPORTADA (PROMEDIO)</th>
                                                            <th>UBICACIÓN</th>
                                                            <th>MATERIALES COMUNES</th>
                                                            <th>OBSERVACIONES</th>
                                                            <th>FOTOS</th>
                                                            <th>ELIMINAR</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="listaResiduosPeligrosos">

                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form id="insercion"></form>
                        <div class="panel-body">
                            <div class="row text-center">
                                <div class="col-sm-12 col-md-offset-5">
                                    <div class="form-line">
                                        <input type="submit" onclick="registrarDatosResiduosPeligrosos();" class="btn bg-red waves-effect waves-light"  value="Guardar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</section>

<div class="modal fade" id="myModalFotosResiduos" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Imagenes</h4>
            </div>
            <div class="modal-body">
                <div class="row" align="center">
                        <b>Fotos de Residuos Peligrosos</b>
                        <div id="ConteniFoto">

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
    function traerModalFoto(id)
    {

        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/obtenerFotosResiduos/"+id,
                type: 'post',
                dataType: 'json',
                cache : false,
                contentType: false,
                processData: false
            }
        ).done(function (data)
        {

            //FOR PARA LLENAR EL MODAL CON BOTONES DE TIPO FILE
            $("#ConteniFoto").html("");

            $("#ConteniFoto").html('<div class="row"><div class="col-sm-4"><input type=\'file\' class=\'file\' id=\'fotoResiduos1\' name=\'fotoResiduos1[]\' data-min-file-count=\'1\' /></div>'
            +'<div class="col-sm-4"><input type=\'file\' class=\'file\' id=\'fotoResiduos2\' name=\'fotoResiduos2[]\' data-min-file-count=\'1\' /></div>'
            +'<div class="col-sm-4"><input type=\'file\' class=\'file\' id=\'fotoResiduos3\' name=\'fotoResiduos3[]\' data-min-file-count=\'1\' /></div></div>'
            +'<div class="row"><div class="col-sm-4 col-sm-offset-2"><input type=\'file\' class=\'file\' id=\'fotoResiduos4\' name=\'fotoResiduos4[]\' data-min-file-count=\'1\' /></div>'
            +'<div class="col-sm-4"><input type=\'file\' class=\'file\' id=\'fotoResiduos5\' name=\'fotoResiduos5[]\' data-min-file-count=\'1\' /></div></div>');

            //FOR PARA HACER QUE LOS BOTONES SE VUELVAN FILEINPUTS
                for(i=1;i<=5;i++)
                {

                    var codig=null;
                    var nombreFoto = data[0]['fotoResiduos' + i];

                    if(nombreFoto!=null) {

                        codig = "<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoResiduos" + i + "/" + nombreFoto + "' class='file-preview-image'>";

                    }
                    crearFileInput(i, id, codig);
                }

            $("#myModalFotosResiduos").modal();

        });
    }
    function crearFileInput(i, id, codig)
    {
        $("#fotoResiduos" + i).fileinput({
            'showUploadedThumbs': true,
            'showCaption': false,
            'showCancel': false,
            'showRemove': false,
            'showUpload': false,
            'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneralTabla/fotoResiduos"+i+"/ResiduosPeligrosos/"+id+"/idResiduosPeligrosos/",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png'],
            initialPreview: [codig]
        }).on('change', function (event, data, previewId, index) {
            $("#fotoResiduos" + i).fileinput("upload");

        }).on('fileclear', function (event) {
            // alert(idAsi)
            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenArreglo/fotoResiduos" + i + "/ResiduosPeligrosos/" + id + "/idResiduosPeligrosos";
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {
            });


        });
    }
</script>


<script type="text/javascript">

    $("#form2").on("submit", function(e){
        e.preventDefault();
        AgregarResiduosPeligrosos();
    });

    function AgregarResiduosPeligrosos()
    {

        var tipoAlmacen = $("#tipoAlmacen").val();
        var cantidadMaterial = $('#cantidadMaterial').val();
        var ubicacionMaterial = $("#ubicacionMaterial").val();
        var materialesComunes = $("#materialesComunes").val();
        var observaciones = $("#observaciones").val();
        var arregloInsercion= {
            'arreglo': []
        };
        arregloInsercion.arreglo.push({'tipoAlmacen':tipoAlmacen, 'cantidadMaterial':cantidadMaterial, 'ubicacionMaterial':ubicacionMaterial,'materialesComunes':materialesComunes, 'observaciones':observaciones});
        var formData=new FormData(document.getElementById('insercion'));
        formData.append('datos', (JSON.stringify(arregloInsercion.arreglo)));
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/insertarArregloResiduosPeligrosos/"+$("#idAsignacion").val(),
                type: "post",
                dataType: "html",
                data: formData,
                cache : false,
                contentType: false,
                processData: false
            }
        ).done(function(data)
        {
            array2.datosResiduosPeligrosos.push({'idResiduosPeligrosos': data,'tipoAlmacen': tipoAlmacen, 'cantidadMaterial': cantidadMaterial ,'ubicacionMaterial': ubicacionMaterial,'materialesComunes': materialesComunes, 'action' : 0, 'observaciones':observaciones});
            $("#listaResiduosPeligrosos").append('<tr>'+
                '<td>'+tipoAlmacen+'</td>'+
                '<td>'+cantidadMaterial+'</td>'+
                '<td>'+ubicacionMaterial+'</td>'+
                '<td>'+materialesComunes+'</td>'+
                '<td>'+observaciones+'</td>'+
                '<td><i onclick="traerModalFoto('+data+')" class="fa fa-picture-o" aria-hidden="true"></i></td>'+
                '<td><button type="button" class="btn btn-defaultBorrar2"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                '</tr>');
            console.log(JSON.stringify(array2.datosResiduosPeligrosos,null,4));

        });


        limpiarFormularioResiduos();
    }

    function limpiarFormularioResiduos()
    {
        $("#tipoAlmacen").val("");
        $("#cantidadMaterial").val("");
        $("#ubicacionMaterial").val("");
        $("#materialesComunes").val("");
        $("#observaciones").val("");
    }

    $(document).on('click', '.btn-defaultBorrar2', function (event) {
        event.preventDefault();

        var indice =  $(this).closest('tr').index();

        if(array2.datosResiduosPeligrosos[indice]['idResiduosPeligrosos'] == -1)
        {
            array2.datosResiduosPeligrosos.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array2.datosResiduosPeligrosos[indice]['action']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array2.datosResiduosPeligrosos, null, 4));

    });


    function registrarDatosResiduosPeligrosos()
    {
        accion = "actualizarResiduosPeligrosos/";
        var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/';?>" + accion;
        var formData = new FormData(document.getElementById("form2"));
        formData.append('datosResiduosPeligrosos', (JSON.stringify(array2.datosResiduosPeligrosos)));

        console.log(JSON.stringify(array2.datosResiduosPeligrosos));

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
                        location.href = 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formResiduosPeligrosos/' + $("#idAsignacion").val();
                    });
            });
    }




</script>
<script>
    window.onload = cargaDatosTabla;

    function cargaDatosTabla(){
        <?php
        foreach ($existencia as $row) {
            if($row["tipoAlmacen"] != ''){
                $idResiduosPeligrosos = $row["idResiduosPeligrosos"];
                $tipoAlmacen = $row["tipoAlmacen"];
                $cantidad = $row["cantidad"];
                $ubicacion = $row["ubicacion"];
                $materialesComunes = $row["materialesComunes"];
                $observaciones = $row["observaciones"];

                print "array2.datosResiduosPeligrosos.push({'idResiduosPeligrosos' : $idResiduosPeligrosos, 'tipoAlmacen' : '$tipoAlmacen', 'cantidad' : $cantidad, 'ubicacion' : '$ubicacion', 'action' : 0, 'materialesComunes' : '$materialesComunes', 'observaciones':'$observaciones'}); \n";

                print "$('#listaResiduosPeligrosos').append(
                     '<tr><td hidden>$idResiduosPeligrosos</td><td>$tipoAlmacen</td><td>$cantidad</td><td>$ubicacion</td><td>$materialesComunes</td><td>$observaciones</td><td><i onclick=\"traerModalFoto(".$idResiduosPeligrosos.")\" class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></td><td><button type=\"button\" class=\"btn btn-defaultBorrar2\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";

            }
        }
        print("console.log(JSON.stringify(array2.datosResiduosPeligrosos, null, 4));");
        ?>
    }

</script>



<?php
include "footer.php";
?>
