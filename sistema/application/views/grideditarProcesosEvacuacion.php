<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload=CargarDatos;

        function CargarDatos(){
            var idInd=$("#idProceso").val();
            // alert("entra "+idInd)
            $.ajax({
                url : "<?php echo site_url('CrudProcesosEvacuacion/getDatosproceso')?>/" + idInd,
                type: "get",
                dataType: "json",
                success: function(data)
                {

                     console.table(data);
                    $("#proceso").val(data.proceso);
                    $("#idPaso").val(data.paso);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }


        $(function(){
            $("#contenido").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudProcesosEvacuacion/modificarDatos/';?>";
                e.preventDefault();
                var f = $(this);
                var formData = new FormData(document.getElementById("contenido"));

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

                     swal({
                        title: "HECHO",
                        text: "El proceso de evaluación se ha modificado exitosamente.",
                        type: "success",
                        ///showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",
                        closeOnConfirm: false
                    },
                        function()
                        {
                            window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudProcesosEvacuacion")
                        }
                    );
                });
        });
    </script>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href="<?=site_url('CrudProcesosEvacuacion');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Modificar procesos de evacuación</h2>
                    </div>
                    <div class="body">
                        <form method="post" action="" id="contenido" enctype="multipart/form-data">
                            <!--  <input type="hidden" id="idTramite" name="idTramite" value="<?=$idTramite?>"> -->
                            <input type="hidden" id="idProceso" name="idProceso" value="<?php echo $idProceso ?>">
                            <div class="col-sm-12 col-md-6">
                                <div  class="form-group">
                                    <div class="form-line">
                                        <b>Nombre del proceso de evacuación  </b>
                                        <input id="prceso" name="proceso" type="text" class="form-control"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div  class="form-group">
                                    <div class="form-line">
                                        <b>Paso de evacuación al que pertenece</b>
                                        <select name="idPaso" id="idPaso" required>
                                            <option value="0">Seleccione el paso de evacuacion</option>
                                            <option value="1">Paso 1</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12" style="display: flex; align-items: center; justify-content: center;">
                                    <div class="form-line">
                                        <input type="submit" class="btn bg-red waves-effect waves-light" value="Modificar">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
include "footer.php";
?>