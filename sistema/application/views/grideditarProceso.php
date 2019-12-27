<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
       


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

                     swal("HECHO", "Proceso modificado.", "success")
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
                            <!--  <input type="hidden" id="idTramite" name="idTramite" value="<?=$idProceso?>"> -->
                            <input type="hidden" id="idProceso" name="idProceso" value="<?php echo $idProceso ?>">
                            <div class="col-sm-12 col-md-6">
                                <div  class="form-group">
                                    <div class="form-line">
                                        <b>Nombre del proceso de evacuación  </b>
                                        <input id="proceso" name="proceso" type="text" class="form-control" value="<?=$datosProceso['proceso']?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div  class="form-group">
                                    <div class="form-line">
                                        <b>Paso de evacuación al que pertenece</b>
                                        <select name="idPaso" id="idPaso" class="form-control" required>
                                            <option value="">Seleccione el paso de evacuacion</option>
                                                <?php 
                                                    for($posicion = 0; $posicion < sizeof($listaPasos); $posicion ++)
                                                    {
                                                        $idPaso=$listaPasos[$posicion]['id_paso'];
                                                        $nomPaso=$listaPasos[$posicion]['paso'];
                                                        if($datosProceso['id_paso']==$idPaso)
                                                        echo '<option value=\''.$idPaso.'\' selected>'.$nomPaso.'</option>';
                                                        else 
                                                        echo '<option value=\''.$idPaso.'\' >'.$nomPaso.'</option>';
                                                    }
                                                ?>
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