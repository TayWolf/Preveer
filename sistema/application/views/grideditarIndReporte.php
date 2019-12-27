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
            url : "<?php echo site_url('CrudIndicadorReporte/getDatosIndiucador')?>/" + idInd,
            type: "get",
            dataType: "json",
            success: function(data)
            {
               
           // alert("resultado "+data)
            $("#nombreIndicador").val(data.nombreIndicador);
            $("#tipo").val(data.tipo);
            $("#numeroCorrecciones").val(data.numeroCorrecciones);
            $("#required").val(data.required);
           
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
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorReporte/modificarDatos/';?>";
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
                <a href="<?=site_url('CrudIndicadorReporte');?>">
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
                                
                            Modificar Reporte de SSHL
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
                                <h2 class="card-inside-title text-center">Descripcion de Reporte </h2>
                                <input type="hidden" id="idIndicador" name="idIndicador" value="<?php echo $idIndicador ?>">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <label>Nombre del indicador</label>
                                                <input type="text" class="form-control" id="nombreIndicador" name="nombreIndicador" />

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                 <label>tipo Indicador</label>
                                                <!--TODO: AGREGAR MÁS tipoS-->
                                                <select class="form-control" style="font-family: 'FontAwesome', Arial;" id="tipo" name="tipo" required="">
                                                    <option value="">Seleccione una oprción</option>
                                                    <option value="1">Opcion Multiple</option>
                                                    <option value="2">Campo Abierto</option>
                                                    <option value="3">Formato de fecha</option>
                                                    <option value="4">Indicador vacio</option>
                                                    <option value="5">Caja de texto grande</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>Requerido</label>
                                                <!--TODO: AGREGAR MÁS tipoS-->
                                                <select class="form-control" style="font-family: 'FontAwesome', Arial;" id="required" name="required" required >
                                                    <option value="">Seleccione una oprción</option>
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