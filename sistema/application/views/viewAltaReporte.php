<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#form").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudReporteSSHL/altaReporte/';?>";
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
                                text: "La ficha se ha registrado exitosamente.",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false
                            },
                            function(){
                                window.history.back();
                                //window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudReporteSSHL")
                            });

                    });

            });
        });
    </script>

    <section class="content">
        <div class="container-fuid">
            <div class="block-header">
                <a href="<?=site_url('CrudReporteSSHL');?>">
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
                                Ingrese  los siguientes datos
                            </h2>
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                <h2 class="card-inside-title text-center">Descripcion del indicador </h2>
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Nombre de la ficha</label>
                                                <input type="text" class="form-control" id="nombreReportes" name="nombreReportes"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Icono</label>
                                                <select class="form-control" style="font-family: 'FontAwesome', Arial;" id="icono" name="icono" required="">
                                                    <option value="">Seleccione un ícono</option>
                                                    <option value="fa fa-address-book"></option>
                                                    <option value="fa fa-barcode"></option>
                                                    <option value="fa fa-fire"></option>
                                                    <option value="fa fa-bolt"></option>
                                                    <option value="fa fa-fire-extinguisher"></option>
                                                    <option value="fa fa-eye"></option>
                                                    <option value="fa fa-eye-slash"></option>
                                                    <option value="fa fa-assistive-listening-systems"></option>
                                                    <option value="fa fa-low-vision"></option>
                                                    <option value="fa fa-question-circle-o"></option>
                                                    <option value="fa fa-tty"></option>
                                                    <option value="fa fa-wheelchair"></option>
                                                    <option value="fa fa-universal-access"></option>
                                                    <option value="fa fa-car"></option>
                                                    <option value="fa fa-ambulance"></option>
                                                    <option value="fa fa-bus"></option>
                                                    <option value="fa fa-bus"></option>
                                                    <option value="fa fa-file"></option>
                                                    <option value="fa fa-cog"></option>
                                                    <option value="fa fa-free-code-camp"></option>
                                                    <option value="fa fa-lightbulb-o"></option>
                                                    <option value="fa fa-wrench"></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Número Correcciones</label>
                                                <!--TODO: AGREGAR MÁS ICONOS-->
                                                <select class="form-control" style="font-family: 'FontAwesome', Arial;" id="numeroCorrecciones" name="numeroCorrecciones" required >
                                                    <option value="">Seleccione una opción</option>
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>

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