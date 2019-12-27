<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
  $("#form").on("submit", function(e){
    var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentos/altaDocumento/';?>";
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
                      text: "El documento se ha registrado exitosamente.",
                      type: "success",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false
                    },
                    function(){
                      window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentos")
                    });
                 
                });

    });
 });
</script>

<script type="text/javascript">
    window.onload=cargarEstados;

    function cargarEstados()
    {
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentos/obtenerEstados",
                type: 'GET',
                dataType: 'JSON',
                success: function(data)
                {
                    $("#estados").empty();
                    $("#estados").append(new Option("Seleccione un estado", ""));
                    for(i=0; i<data.length;i++)
                        $("#estados").append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']));
                }
            }
        );

    }
</script>

<section class="content">
<div class="container-fuid">
<div class="block-header">
                <a href="<?=site_url('CrudDocumentos');?>">
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
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <h2 class="card-inside-title">Estado</h2>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select type="select" class="form-control" id="estados" name="estados" required >
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="card-inside-title">Nombre del documento</h2>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nombreDocumento" name="nombreDocumento" placeholder="Nombre del documento" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    
                                    <div class="row">
                                        <div class="col-md-offset-5">
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