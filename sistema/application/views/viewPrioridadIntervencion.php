<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
  $("#formulario").on("submit", function(e){
    var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudPrioridadIntervencion/altaPrioridad/';?>";
    e.preventDefault();
    var f = $(this);
   // var formulario = $("#formulario").serialize();
     var formulario = new FormData(document.getElementById("formulario"));
    //alert(formulario);
    $.ajax({
                url: url,
                type: "post",
                dataType: "html",
                data: formulario,
                cache: false,
                contentType: false,
                 processData: false,
                 success: function(res)
                 {
                  //  alert(res);
                        swal({
                          title: "HECHO",
                          text: "La prioridad de intervención se ha registrado exitosamente.",
                          type: "success",
                          ///showCancelButton: true,
                          confirmButtonClass: "btn-danger",
                          confirmButtonText: "Aceptar",
                          closeOnConfirm: false
                        },
                        function(){
                          window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudPrioridadIntervencion")
                        });
                 }
            });

     });
 });


</script>

<section class="content">
<div class="container-fuid">
<div class="block-header">
                <a href="<?=site_url('CrudPrioridadIntervencion');?>">
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
                            <form method="post" action="" id="formulario" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Priodidad de Intervencion </b>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la prioridad de intervención">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <b>Color</b>
                                                <input type="text" class="form-control" id="color" name="color" placeholder="Color de la prioridad">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="text-align: left;" class="row">
                                        <div class="col-sm-4 col-md-offset-5">
                                            <div class="form-line">
                                                <input type="submit" class="btn bg-red waves-effect waves-light" value="Aceptar">
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