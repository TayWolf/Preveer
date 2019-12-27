<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
   window.onload=CargarDatos;

    function CargarDatos(){
        var idInd=$("#idPonderador").val();
       // alert("entra "+idInd)
          $.ajax({
            url : "<?php echo site_url('CrudPonderadorForm/getDatosPonderador')?>/" + idInd,
            type: "get",
            dataType: "json",
            success: function(data)
            {
               
           // alert("resultado "+data)
            $("#nombrePonderador").val(data.nombrePonderador);
           
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    $(function(){
  $("#contenido").on("submit", function(e){
    var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudPonderadorForm/modificarDatos/';?>";
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("contenido"));
    
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
                 

                    swal("HECHO", "Datos modificados.", "success")
                 //$('#cargando').fadeIn(1000).html(data);
                  
                 
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
                <a href="<?=site_url('CrudPonderadorForm');?>">
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
                                Modificar Ponderador Infraestructura
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
                            <form method="post" action="" id="contenido" enctype="multipart/form-data">
                                <!-- <h2 class="card-inside-title text-center">Modifique los datos</h2> -->
                               <!--  <input type="hidden" id="idTramite" name="idTramite" value="<?=$idTramite?>"> -->
                               <input type="hidden" id="idPonderador" name="idPonderador" value="<?php echo $idPonderador ?>">
                                <div style="text-align: center" class="row ">
                                    <h2 class="card-inside-title text-center">Nombre de Ponderador </h2>
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div  class="form-group">
                                            <div class="form-line">
                                                <input id="nombrePonderador" name="nombrePonderador" type="text" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                
                                  
                                    <div style="text-align: left;" class="row">
                                        <div class="col-sm-4 col-md-offset-5">
                                            <div class="form-line">
                                                <input type="submit" class="btn bg-red waves-effect waves-light" value="Modificar">
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