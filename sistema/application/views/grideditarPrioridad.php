<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload=CargarDatos;

        function CargarDatos(){
            var idInd=$("#idPrioridad").val();
            // alert("entra "+idInd)
            $.ajax({
                url : "<?php echo site_url('CrudPrioridadMejora/getDatosprioridad')?>/" + idInd,
                type: "get",
                dataType: "json",
                success: function(data)
                {

                     console.table(data);
                    $("#nombre").val(data.nombre);
                    $("#color").val(data.color);

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
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudPrioridadMejora/modificarDatos/';?>";
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


                        swal("HECHO", "Datos modificados.", "success")
                        //$('#cargando').fadeIn(1000).html(data);


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
            <a href="<?=site_url('CrudPrioridadMejora');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Modificar prioridad mejora</h2>
                    </div>
                    <div class="body">
                        <form method="post" action="" id="contenido" enctype="multipart/form-data">
                            <!--  <input type="hidden" id="idTramite" name="idTramite" value="<?=$idTramite?>"> -->
                            <input type="hidden" id="idPrioridad" name="idPrioridad" value="<?php echo $idPrioridad ?>">
                            <div class="col-sm-6">
                                <div  class="form-group">
                                    <div class="form-line">
                                        <b>Nombre de Priodidad de Mejora  </b>
                                        <input id="nombre" name="nombre" type="text" class="form-control"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div  class="form-group">
                                    <div class="form-line">
                                        <b>Color de Priodidad de Mejora</b>
                                        <input id="color" name="color" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-offset-5">
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