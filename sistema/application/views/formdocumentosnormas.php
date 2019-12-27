<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#form").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormas/altaDocumento/';?>";
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
                        //alert(res);

                        swal({
                                title: "HECHO",
                                text: "La Norma se ha registrado exitosamente.",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false
                            },
                            function(){
                                window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormas")
                            });

                    });

            });
        });
    </script>

<script>
    function traerNormas()
    {
        /*
        1. Obtener el valor de la subarea
        2. Con ese valor, hay que enviarlo al controlador para recuperar las normas de esa subarea
        3. LLenar el otro select con los campos recuperasdos
        * */

        //1.
        var subAreaSeleccionada=$("#idArea").val();
        //2.
        $.ajax({
            url: "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormas/traerNormas/';?>"+subAreaSeleccionada,
            type: "get",
            dataType: "JSON",
            success: function (data) //eN EL DATA RECUBE LOS VALORES DEL CONTROLADOR
            {
                //3.
                $("#idSubservicio").empty();
                $("#idSubservicio").append('<option value="">Seleccione una opción</option>');

                for(i=0;i<data.length;i++)
                {
                    $("#idSubservicio").append('<option value="'+data[i]['idSubservicio']+'">'+data[i]['nombre']+'</option>');
                }

            }

            });

    }
</script>

    <section class="content">
        <div class="container-fuid">
            <div class="block-header">
                <a href="<?=site_url('CrudDocumentosNormas');?>">
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
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Nombre del indicador</b>
                                                <input type="text" class="form-control" id="nombreDocumento" name="nombreDocumento" placeholder="Nombre del indicador" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Área</b>
                                                <select type="text" class="form-control" id="idArea" name="idArea" onchange="traerNormas();" required >
                                                    <option value="">Seleccione una opción</option>;

                                                    <?php
                                                    foreach ($listSubAreas as $row) {
                                                        $idSubArea=$row["idArea"];
                                                        $nombreSubArea=$row["nombreArea"];
                                                        if(strcmp($nombreSubArea,"PC")!=0)
                                                            echo "<option value='$idSubArea'>$nombreSubArea</option>";
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <b>Subservicio</b>
                                            <div class="form-line">
                                                <select id="idSubservicio" name="idSubservicio" class="form-control" required>
                                                    <option value="">Seleccione un subservicio</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <b>Tipo de verificación</b>
                                            <div class="form-line">
                                                <select class="form-control" id="tipo" name="tipo" required>
                                                    <option value="">Seleccione una opción</option>
                                                    <option value="1">Física</option>
                                                    <option value="2">Documental</option>
                                                    <option value="3">Entrevista</option>
                                                    <option value="4">Registral</option>
                                                    <option value="5">Documental y Física</option>
                                                    <option value="6">Entrevista y Física</option>
                                                    <option value="7">Documental, Entrevista y Física</option>
                                                    <option value="8">Documental y Entrevista</option>
                                                    <option value="9">Documental e Interrogatorio </option>
                                                    <option value="10">Documental y Registro </option>
                                                    <option value="11">Físico, Documental y Registro </option>
                                                    <option value="12">Documental y Registro </option>
                                                </select>
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