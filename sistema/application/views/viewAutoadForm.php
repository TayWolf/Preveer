<?php 
  include "header.php";
?>

<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
  $("#formulario").on("submit", function(e){
    var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAutoad/altaFormulario/';?>";
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
                          text: "El Formulario se ha registrado exitosamente.",
                          type: "success",
                          ///showCancelButton: true,
                          confirmButtonClass: "btn-danger",
                          confirmButtonText: "Aceptar",
                          closeOnConfirm: false
                        },
                        function(){
                          window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudAutoad")
                        });
                 }
            });

     });
 });


</script>

<section class="content">
<div class="container-fuid">
<div class="block-header">
                <a href="<?=site_url('CrudAutoad');?>">
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
                               <!-- <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                                                           </ul> -->
                        </div>

                             <div class="body">
                            <form method="post" action="" id="formulario" enctype="multipart/form-data" >                     
                               
                                        
                                        <!-- <h2 class="card-inside-title text-center">Nombre del formulario </h2> -->
                                    <div class="col-sm-6 ">
                                        <div  class="form-group">
                                            <div class="form-line">
                                              <label>Nombre del formulario</label>
                                                <input id="nombreFormulario" name="nombreFormulario" type="text" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Icono</label>
                                                <!--TODO: AGREGAR MÁS ICONOS-->
                                                <select class="form-control" style="font-family: 'FontAwesome', Arial;" id="icono" name="icono" required >
                                                    <option value="">Seleccione un ícono</option>
                                                    <option value="fa fa-file-text">&#xf15c;</option>
                                                    <option value="fas fa-map-marker">&#xf041;</option>
                                                    <option value="fa fa-wrench">&#xf0ad;</option>
                                                    <option value="fa fa-check">&#xf14a;</option>
                                                    <option value="fa fa-warning">&#xf071;</option>
                                                    <option value="fa fa-exclamation-circle">&#xf06a;</option>
                                                    <option value="fa fa-universal-access">&#xf29a;</option>
                                                    <option value="fa fa-fire">&#xf06d;</option>
                                                    <option value="fa fa-medkit">&#xf0fa;</option>
                                                    <option value="fa fa-tint">&#xf043;</option>
                                                    <option value="fa fa-fire-extinguisher">&#xf134;</option>
                                                    <option value="fa fa-eye">&#xf06e;</option>
                                                    <option value="fa fa-tty">&#xf1e4;</option>
                                                    <option value="fa fa-wheelchair">&#xf193;</option>
                                                    <option value="fa fa-universal-access">&#xf29a;</option>
                                                    <option value="fa fa-car">&#xf1b9;</option>
                                                    <option value="fa fa-ambulance">&#xf0f9;</option>
                                                    <option value="fa fa-bus">&#xf207;</option>
                                                    <option value="fa fa-bus">&#xf207;</option>
                                                    <option value="fa fa-file">&#xf15b;</option>
                                                    <option value="fa fa-cog">&#xf013;</option>
                                                    <option value="fa fa-free-code-camp">&#xf2c5;</option>
                                                    <option value="fa fa-lightbulb-o">&#xf0eb;</option>
                                                    <option value="fa fa-bolt">&#xf0e7;</option>
                                                </select>
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