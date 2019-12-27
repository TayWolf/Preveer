<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
   window.onload=CargarDatos;

    function CargarDatos(){
        var idInd=$("#idIndicador").val();
       // alert("entra "+idInd)
          $.ajax({
            url : "<?php echo site_url('CrudIndicadorInfra/getDatosIndiucador')?>/" + idInd,
            type: "get",
            dataType: "json",
            success: function(data)
            {
               
           // alert("resultado "+data)
            $("#nombreIndicador").val(data.nombreIndicador);
            $("#nombreFotos").val(data.nombreFotos)   ;  
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
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorInfra/modificarDatos/';?>";
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
    var nav4 = window.Event ? true : false;
    function aceptNum(evt)
    {
      var key = nav4 ? evt.which : evt.keyCode;
      return (key <= 13 || (key>= 48 && key <= 57));
    }
</script>

<section class="content">
<div class="container-fluid">
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
                            <h2>Modificar Indicador Infraestructura</h2>
                        </div>
                        <div class="body">
                            <form method="post" action="" id="contenido" enctype="multipart/form-data">
                               <!--  <input type="hidden" id="idTramite" name="idTramite" value="<?=$idTramite?>"> -->
                               <input type="hidden" id="idIndicador" name="idIndicador" value="<?php echo $idIndicador ?>">
                               <div class="container">
                                    <div class="row ">
                                        <div class="col-sm-12 col-md-6">
                                            <label >Indicador</label>
                                            <div  class="form-group">
                                                <div class="form-line">
                                                    <input id="nombreIndicador"  name="nombreIndicador" type="text" class="form-control" placeholder="Nombre del indicador">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label >Foto(s)</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input id="nombreFotos" name="nombreFotos" type="text" class="form-control" placeholder="Cantidad de fotos" onkeypress="return aceptNum(event)" onpaste="return false;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
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