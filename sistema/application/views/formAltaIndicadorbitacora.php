<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
  $("#form").on("submit", function(e){
    var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras/altaIndicadBitacora/';?>";
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
                      text: "El indicador ha sido registrado exitosamente.",
                      type: "success",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false
                    },
                    function(){
                        window.history.back();
                      //window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras")
                    });
                 
                });

    });
 });
</script>

<section class="content">
<div class="container-fuid">
<div class="block-header">
                <a href="<?=site_url('Crudindicadoresbitacoras');?>">
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
                                                <label>Nombre del indicador</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la bitacora" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Tipo Indicador</label>
                                                <!--TODO: AGREGAR MÁS ICONOS-->
                                                <select class="form-control" style="font-family: 'FontAwesome', Arial;" id="TipoCmpo" name="TipoCmpo" required >
                                                    <option value="">Seleccione una opción</option>
                                                    <option value="1">Opcion Multiple</option>
                                                    <option value="2">Campo Abierto</option>
                                                    <option value="3">Formato de fecha</option>
                                                    <option value="4">Indicador vacio</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>¿Es requerido?</label>
                                                <!--TODO: AGREGAR MÁS ICONOS-->
                                                <select class="form-control" style="font-family: 'FontAwesome', Arial;" id="reque" name="reque" required >
                                                    <option value="">Seleccione una opción</option>
                                                    <option value="1">Si</option>
                                                    <option value="2">No</option>
                                                   
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