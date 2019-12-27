<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload=traerNormas;
        function traerNormas()
        {
            var idIndi=$("#idInci").val();
            $.ajax({
                url: "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormasArnes/traerNormas/';?>"+idIndi,
                type: "get",
                dataType: "json",
                success: function (data) //eN EL DATA RECUBE LOS VALORES DEL CONTROLADOR
                {
                    $("#nombreIndicador").val(data.nombreIndicador);
                    $("#idGrupo").val(data.idGrupo);
                    //alert(data.nombreIndicador)
                }
            });
        }
       
        $(function(){
            $("#form").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormasArnes/modificarDatos/';?>";
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
                <a href="<?=site_url('CrudDocumentosNormasArnes');?>">
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
                                Ingrese los siguientes datos
                            </h2>

                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                <input type="hidden" id="idInci" name="idInci" value="<?=$idIndicador?>">

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Nombre del indicador con</b>
                                                <input type="text" class="form-control" id="nombreIndicador" name="nombreIndicador" placeholder="Nombre del indicador " required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Grupo</b>
                                                <select type="text" class="form-control" id="idGrupo" name="idGrupo"  required >
                                                    <option value="">Seleccione una opción</option>;

                                                    <?php
                                                    foreach ($listSubAreas as $row) {
                                                        $idGrupo=$row["idGrupo"];
                                                        $nombreGrupo=$row["nombreGrupo"];
                                                        if(strcmp($nombreSubArea,"PC")!=0)
                                                            echo "<option value='$idGrupo'>$nombreGrupo</option>";
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 col-md-offset-5">
                                        <div class="form-line">
                                            <input type="submit" class="btn bg-red waves-effect waves-light" value="Aceptar">
                                        </div>
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