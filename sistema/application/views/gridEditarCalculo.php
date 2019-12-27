<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#form").on("submit", function(e)
            {
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/modificarDatos/';?>";
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

                        swal({
                                title: "HECHO",
                                text: "El cálculo ha sido editado exitosamente.",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false
                            },
                            function(){
                                window.history.back();
                            });

                    });

            });
        });
    </script>

    <section class="content">
        <div class="container-fuid">
            <div class="block-header">
                <a href="javascript:history.back();">
                    <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Ingrese  los siguientes datos</h2>
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                <h2 class="card-inside-title text-center">Descripción del cálculo</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del cálculo" required />
                                                <input type="hidden" id="idCalculo" name="idCalculo" value="<?=$idCalculo?>" required />
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

<script>
    $(document).ready(
        function()
        {
            $.ajax({
                url: '<?=site_url('CrudCalculos/obtenerDatos/').$idCalculo?>',
                datatype: 'html',
                contentType: false,
                cache: false,
                processData: false,
                success: function (res)
                {
                    $("#descripcion").val(res);
                }
                });
        }
    );
</script>

<?php
include "footer.php";
?>