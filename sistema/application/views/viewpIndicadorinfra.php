<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
  $("#formulario").on("submit", function(e){
    var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorInfra/altaIndicador/';?>";
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
                          text: "El proyecto se ha registrado exitosamente.",
                          type: "success",
                          ///showCancelButton: true,
                          confirmButtonClass: "btn-danger",
                          confirmButtonText: "Aceptar",
                          closeOnConfirm: false
                        },
                        function(){
                          window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorInfra")
                        });
                 }
            });

     });
 });

    var nav4 = window.Event ? true : false;
    function aceptNum(evt)
    {
      var key = nav4 ? evt.which : evt.keyCode;
      return (key <= 13 || (key>= 48 && key <= 57));
    }
</script>

<section class="content">
<div class="container-fuid">
<div class="block-header">
                <a href="<?=site_url('CrudIndicadorInfra');?>">
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
                            <form method="post" action="" id="formulario" enctype="multipart/form-data" >
                              <div class="container">
                                <div class="row">
                                    <div  class="col-sm-12 col-md-6">
                                        <label >Indicador</label>
                                        <div  class="form-group">
                                            <div class="form-line">
                                                <input id="nombreIndicador" name="nombreIndicador" type="text" class="form-control" placeholder="Nombre del indicador" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label>Foto(s)</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="nombreFotos" name="nombreFotos" type="text" class="form-control" placeholder="Cantidad de fotos"  onkeypress="return aceptNum(event)" onpaste="return false;">
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