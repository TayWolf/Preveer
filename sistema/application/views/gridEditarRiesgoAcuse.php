<?php 
  include "header.php";
?>

<section class="content">
<div class="container-fluid">
<div class="block-header">
                <a href="<?=site_url('CrudRiesgoAcuse');?>">
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
                                
                                Modificar Acuse de Riesgo
                            </h2>
                        
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                <h2 class="card-inside-title text-center">Modifique el registro</h2>
                                <input type="hidden" id="idRiesgo" name="idRiesgo" value="<?=$idRiesgo?>">
                                <div class="row clearfix">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nombreRiesgo" name="nombreRiesgo" placeholder="Nombre del Riesgo" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-sm-4 col-md-offset-5">
                                            <div class="form-line">
                                                <input type="submit" class="btn bg-red waves-effect waves-light" value="Actualizar">
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

<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
   window.onload=inicio;
    function inicio()
   	{
        var idu = $("#idRiesgo").val();
         $.ajax({
	        url : "<?php echo site_url('CrudRiesgoAcuse/obtenerDatos')?>/" + idu,
	        type: "get",
	        dataType: "JSON",
	        success: function(data)
	        {
	        	$("#nombreRiesgo").val(data.nombreRiesgo);
	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error get data from ajax');
	        }
    	});
    }
    $(function(){
  	$("#form").on("submit", function(e){
    	var url;
    	$('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
    	url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudRiesgoAcuse/modificarDatos/';?>";
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
        .done(function(res)
        {
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
            
<?php 
  include "footer.php";
?>