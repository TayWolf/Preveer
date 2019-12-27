<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload=inicio;
        function inicio(){
            var idu = $("#idApartadoReporte").val();
            $.ajax({
                url : "<?php echo site_url('CrudApartadoReporte/obtenerDatos')?>/" + idu,
                type: "get",
                dataType: "JSON",
                success: function(data)
                {
                    $("#nombre").val(data.nombre);
                    $("#descripcion").val(data.descripcion);
                }
            });
        }
        $(function()
        {
            $("#form").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudApartadoReporte/modificarDatos/';?>";
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
                <a href="<?=site_url('CrudApartadoReporte');?>">
                    <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Modificar apartado</h2>
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                <input type="hidden" id="idApartadoReporte" name="idApartadoReporte" value="<?=$idApartadoReporte?>">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Nombre del apartado</b>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del apartado" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Descripción del apartado</b>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del apartado" />
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