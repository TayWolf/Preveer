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
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/altaCondicion/';?>";
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
                                text: "La condición del cálculo se ha sido registrado exitosamente.",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Aceptar"
                            },
                            function(){

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
                            <h2>Ingrese los siguientes datos</h2>
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                <input type="hidden" name="idIndicadorCalculo" id="idIndicadorCalculo" value="<?=$idCalculo?>" required>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Condición</b>
                                                <?php
                                                echo "<select class='form-control' id='condicion' name='condicion' required>";
                                                if($tipoIndicador==1)
                                                {
                                                    echo "<option value='=='>Igual que</option>";
                                                }
                                                else if($tipoIndicador==2)
                                                {
                                                    echo "<option value='includes'>Que incluya</option>";
                                                }
                                                else if($tipoIndicador==3)
                                                {
                                                    echo "<option value='>'>Mayor que</option>";
                                                    echo "<option value='>='>Mayor o igual que</option>";
                                                    echo "<option value='<'>Menor que</option>";
                                                    echo "<option value='<='>Menor o igual que</option>";
                                                    echo "<option value='=='>Igual que</option>";
                                                }
                                                echo "</select>";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Valor de la condición</b>
                                                <?php
                                                if($tipoIndicador==1)
                                                {
                                                    echo "<select class='form-control' id='valorCondicion' name='valorCondicion' required>";
                                                    foreach ($listaOpciones as $row)
                                                    {
                                                        echo "<option value='".$row['texto']."'>".$row['texto']."</option>";
                                                    }
                                                    echo "</select>";
                                                }
                                                else if($tipoIndicador==2)
                                                {
                                                    echo "<input class='form-control' type='text' id='valorCondicion' name='valorCondicion' required>";
                                                }
                                                else if($tipoIndicador==3)
                                                {
                                                    echo "<input class='form-control' type='date' id='valorCondicion' name='valorCondicion' required>";
                                                }
                                                ?>
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