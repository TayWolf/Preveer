<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload=inicio;
        function inicio(){
            var idu = $("#idBitacora").val();
            $.ajax({
                url : "<?php echo site_url('CrudAltaBitacora/obtenerDatos')?>/" + idu,
                type: "get",
                dataType: "JSON",
                success: function(data)
                {
                    $("#nombre").val(data.nombre);
                    $("#icono").val(data.icono);
                }
            });
        }
        $(function(){
            $("#form").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAltaBitacora/modificarDatos/';?>";
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

                        swal("HECHO", "Datos modificados.", "success")

                    },
                    function(){
                        window.history.back();
                    });

            });
        });
    </script>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="<?=site_url('CrudAltaBitacora');?>">
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
                                Modificar bitacora
                            </h2>
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                <h2 class="card-inside-title text-center">Ingrese el nuevo nombre de la bitacora </h2>
                                <input type="hidden" id="idBitacora" name="idBitacora" value="<?=$idBitacora?>">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Nombre de la bitacora</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la bitacora" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Icono</label>
                                                <!--TODO: AGREGAR MÁS ICONOS-->
                                                <select class="form-control" style="font-family: 'FontAwesome', Arial;" id="icono" name="icono" required >
                                                    <option value="">Seleccione un ícono</option>
                                                    <option value="fa fa-address-book">&#xf2b9;</option>
                                                    <option value="fa fa-barcode">&#xf02a;</option>
                                                    <option value="fa fa-fire">&#xf06d;</option>
                                                    <option value="fa fa-bolt">&#xf0e7;</option>
                                                    <option value="fa fa-fire-extinguisher">&#xf134;</option>
                                                    <option value="fa fa-eye">&#xf06e;</option>
                                                    <option value="fa fa-eye-slash">&#xf070;</option>
                                                    <option value="fa fa-assistive-listening-systems">&#xf2a2;</option>
                                                    <option value="fa fa-low-vision">&#xf2a8;</option>
                                                    <option value="fa fa-question-circle-o">&#xf29c;</option>
                                                    <option value="fa fa-tty">&#xf1e4;</option>
                                                    <option value="fa fa-wheelchair">&#xf193;</option>
                                                    <option value="fa fa-universal-access">&#xf29a;</option>
                                                    <option value="fa fa-car">&#xf1b9;</option>
                                                    <option value="fa fa-ambulance">&#xf0f9;</option>
                                                    <option value="fa fa-bus">&#xf207;</option>
                                                    <option value="fa fa-bus">&#xf207;</option>
                                                    <option value="fa fa-file">&#xf15b;</option>
                                                    <option value="fa fa-cog">&#xf013;</option>
                                                    <option value="fa fa-free-code-camp">&#xf2c5;</option>
                                                    <option value="fa fa-lightbulb-o">&#xf0eb;</option>
                                                    <option value="fa fa-wrench">&#xf0ad;</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-md-offset-5">
                                        <div class="form-line">
                                            <input type="submit" class="btn bg-red waves-effect waves-light" value="Actualizar">
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