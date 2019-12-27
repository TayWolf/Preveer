<?php 
  include "header.php";
?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href="<?=site_url('CrudPasosEvacuacion');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Modificar Paso de Evacuación</h2>
                    </div>
                    <div class="body">
                        <form method="post" action="" id="contenido" enctype="multipart/form-data">
                            <input type="hidden" id="id_paso" name="id_paso" value="<?php echo $id_paso ?>">
                            <div class="row clearfix">
                                <div class="col-sm-12 col-md-6 col-md-offset-3" align="center">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <b>Paso de evacuación</b>
                                            <input type="text" class="form-control" id="paso" name="paso" placeholder="Nombre del paso de evacuación">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12" style="display: flex; align-items: center; justify-content: center;">
                                    <div class="form-line">
                                        <input type="submit" class="btn bg-red waves-effect waves-light" value="Modificar">
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
   window.onload=CargarDatos;
    function CargarDatos()
    {
        var idInd=$("#id_paso").val();
        // alert("entra "+idInd)
          $.ajax({
            url : "<?php echo site_url('CrudPasosEvacuacion/getDatosPasoEvacuacion')?>/" + idInd,
            type: "get",
            dataType: "json",
            success: function(data)
            {   
            // alert("resultado "+data)
            $("#paso").val(data.paso);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    $(function()
    {
        $("#contenido").on("submit", function(e)
        {
            var url;
            $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudPasosEvacuacion/modificarDatos/';?>";
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