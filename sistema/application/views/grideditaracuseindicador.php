<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">

        $(function(){
            $("#form").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAcuses/editarAcuseIndicador/';?>";
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
                <a href="javascript:history.go(-1)">
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
                                Modifique los datos deseados
                            </h2>

                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">

                                <input type="hidden" id="idIndicador" name="idIndicador" value="<?php print $datosAcuse->idIndicador ?>">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nombreIndicador">Nombre del indicador</label>
                                                <input type="text" class="form-control" id="nombreIndicador" name="nombreIndicador" value="<?php print $datosAcuse->nombreIndicador ?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="idGrupoIndicador">Grupo Indicador</label>
                                                <select type="number" class="form-control" id="idGrupoIndicador" name="idGrupoIndicador" min="0" required>
                                                    <option value="">Seleccione una opción</option>
                                                    <?php
                                                    foreach ($grupoIndicador AS $option)
                                                    {

                                                    ?>
                                                        <option <?php if($option['idGrupoIndicador'] == $datosAcuse->idGrupoIndicador){ print 'selected'; } ?> value="<?php print $option['idGrupoIndicador'] ?>"><?php print $option['nombreGrupo'] ?></option>;
                                                    <?
                                                    }
                                                    ?>
                                                </select>
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