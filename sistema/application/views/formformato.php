<?php 
  include "header.php";
?>
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
            <h2>Ingrese los siguientes datos</h2>
          </div>
          <div class="body">
            <form method="post" action="" id="form" enctype="multipart/form-data">
              <div class="row clearfix">
                <div class="col-sm-3">
                  <label for="Cliente">Cliente</label>
                  <div class="form-group">
                    <div class="form-line">
                      <select id="idClienteF" name="idClienteF" style="width: 100%; border: none;color:#000;" required>
                        <option value="">Seleccione cliente</option>
                          <?php 
                            foreach ($cliente as $row) 
                            {
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
                  <label for="razón social" >Razón social</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón social del formato" required />
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <label for="rfc">Nombre</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" class="form-control" id="nombreFormato" name="nombreFormato" placeholder="Nombre del formato" required />
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <label for="rfc">Nombre del representante legal</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" class="form-control" id="nombreRepresentante" name="nombreRepresentante" placeholder="Nombre del representante legal" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-sm-3">
                  <label for="rfc">RFC</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" class="form-control" id="rfc" name="rfc" placeholder="RFC del formato" required />
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <label for="email_address">Comentarios RFC</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" class="form-control" id="comenRFC" name="comenRFC" placeholder="Comentarios sobre el RFC del formato" />
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <label for="email_address">Domicilio Fiscal</label>
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" class="form-control" id="domFiscal" name="domFiscal" placeholder="Domicilio Fiscal del formato" required />
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
              <div class="row">
                <div class="col-sm-12" style="display: flex; justify-content: center;">
                  <div class="form-line">
                    <input type="submit" class="btn bg-red waves-effect waves-light" value="Aceptar">
                  </div>
                </div>
              </div>
              <div class="col-md-offset-6" id="cargando"></div>
            </form>   
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
  $(function()
  {
    $("#form").on("submit", function(e)
    {
      var url;
      $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/assets/img/loading.gif"/>');
      url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudFormatos/altaFormato/';?>";
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
        if(res==1)
        {
          swal({
            title: "HECHO",
            text: "El formato se ha registrado exitosamente.",
            type: "success",
            showCancelButton: false,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Aceptar",
            closeOnConfirm: false
          },
          function(){
            window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudFormatos")
          });
          //$('#cargando').fadeIn(1000).html(data);        
        }
        if(res==2)
        {
          swal("HECHO", "Formato registrado, por favor cambie la fotografía.", "success")
        }
      });
    });
  });
</script>    
<?php 
  include "footer.php";
?>