<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
  $("#form").on("submit", function(e){
    var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudproyectos/altaProyecto/';?>";
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
                      text: "El servicio se ha registrado exitosamente.",
                      type: "success",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false
                    },
                    function(){
                      window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/Crudproyectos")
                    });
                 
                });

    });
 });
</script>

<section class="content">
<div class="container-fuid">
<div class="block-header">
                <a href="<?=site_url('Crudproyectos');?>">
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
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                <h2 class="card-inside-title text-center">Descripción del servicio </h2>
                                <div class="row clearfix">
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nombreProyecto" name="nombreProyecto" placeholder="Nombre del servicio" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select id="area" name="area" onchange="getTotal()" style="width: 100%; border: none; padding-top: 15px;" required>
                                                    <option value="">Seleccione un área</option>
                                                       <?php foreach ($areas as $row) {
                                                            $idArea=$row["idArea"];
                                                            $nombre=$row["nombreArea"];
                                                            echo " <option value='$idArea'>$nombre</option>";
                                                        } ?>
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