<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
   window.onload=inicio;
    function inicio(){
        var idu = $("#idFormato").val();
          $.ajax({
        url : "<?php echo site_url('CrudFormatos/obtenerDatos')?>/" + idu,
        type: "get",
        dataType: "JSON",
        success: function(data)
        {
           
                $("#razonSocial").val(data.razonSocial);    
                $("#rfc").val(data.rfc);
                $("#nombreFormato").val(data.nombre);
                $("#nombreRepresentante").val(data.nombreRepresentante);
                $("#comenRFC").val(data.comentarioRFC);
                $("#domFiscal").val(data.domicilioFiscal);
                $("#fotoBase").val(data.foto);
                $("#idCliente").val(data.idCliente);

              
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
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudFormatos/modificarDatos/';?>";
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
                <a href="<?=site_url('CrudFormatos');?>">
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
                                
                                Modificar Formato
                            </h2>
             <!--               <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <!-- <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul> --
                                </li>
                            </ul>-->
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                               
                                <input type="hidden" id="idFormato" name="idFormato" value="<?=$idFormato?>">
                                <input type="hidden" id="fotoBase" name="fotoBase">
                                <!-- datos fiscales -->
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <label for="Cliente">Cliente</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                    <select id="idCliente" name="idCliente" style="width: 100%; border: none;color:#000;" required>
                                                       <option value="0">Seleccione cliente</option>
                                                       <?php 
                                                       foreach ($cliente as $row) {
                                                         $idClien=$row["idCliente"];
                                                         $nombreClient=$row["nombreCliente"];

                                                         echo "<option value='$idClien'>$nombreClient</option>";
                                                       }
                                                        ?>
                                                           
                                                    </select>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="email_address">Razón social</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón social del centro de trabajo" />
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <label for="email_address">Nombre</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nombreFormato" name="nombreFormato" placeholder="Nombre del formato" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="rfc">Nombre del representante legal</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nombreRepresentante" name="nombreRepresentante" placeholder="Nombre del representante legal"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <label for="email_address">RFC</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC del centro de trabajo" />
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <label for="email_address">Comentarios RFC</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="comenRFC" name="comenRFC" placeholder="Comentarios sobre el RFC del centro de trabajo" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="email_address">Domicilio Fiscal</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="domFiscal" name="domFiscal" placeholder="Domicilio Fiscal del centro de trabajo" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="foto">Foto</label>
                                                <input id="foto" name="foto" type="file" class="form-control"  />
                                            </div>
                                        </div>
                                    </div>
                               
                                </div>

                                 <div class="row clearfix">

                                </div>

                         
                                <div class="row">
                                        <div class="col-sm-4 col-md-offset-5">
                                            <div class="form-line">
                                                <input type="submit" class="btn bg-black waves-effect waves-light" value="Actualizar">
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