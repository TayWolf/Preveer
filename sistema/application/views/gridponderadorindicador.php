<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">

   $(function(){
  $("#form").on("submit", function(e){
    var qq = $('#form').serialize()
    //var formData = new FormData(document.getElementById("form"));
  // alert("datos"+qq);
    var url;
    var total = $("#tot").val();
    //$('#cargando').html('<img src="https://cointic.com.mx/IntraNet/Admin/assets/images/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras/altaPuente/';?>"+total;;
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
                  
                   swal({
                      title: "ÉXITO",
                      text: "Ponderadores agregados correctamente.",
                      type: "success",
                     
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Aceptar",
                      
                    },
                    function(){
                      location.reload();
                    });
                });
    });
 });
</script>
    <section class="content">
        <div class="container-fluid">
        <div class="block-header">
                <a href="<?=site_url('Crudindicadoresbitacoras');?>">
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
                                Proyectos registrados
                                
                            </h2>
                            
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ponderador</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $conte=1;
                                    foreach ($listaPonde as $row) {
                                        $idPonderador=$row["idBitacoraPonderador"];
                                        $nombrePonderador=$row["texto"];
                                        $idPuente=$row["idPuente"];
                                       echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$nombrePonderador</td>
                                                
                                                <td><a href='#' onclick='confirmaDeletePuente($idPuente);'><i class='fa fa-trash'></i></a></td>
                                            </tr>";
                                            $conte++;
                                   }
                                     ?>
                                </tbody>
                            </table>
                            <div class="row">
                              <div class="col-sm-4 col-md-offset-5">
                                <input type="submit" data-toggle="modal" data-target="#myModalListaPonder" class="btn bg-red waves-effect waves-light" value="Agregar">
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <form method="post" action="" id="form"   enctype="multipart/form-data">
    <div class="modal fade" id="myModalListaPonder" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Seleccione los subservicios </h4>
             <input type="hidden" id="idIndicador" name="idIndicador" value="<?=$idIndicador?>">
          </div>
          <div class="modal-body">
                        <div class="body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ponderador</th>
                                        <th>Seleccionar</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $contee=1;
                                    foreach ($listaSubs as $row) {
                                        $idBitacoraPonderador=$row["idBitacoraPonderador"];
                                        $texto=$row["texto"];

                                       echo "
                                            <tr>
                                                <td>$contee</td>
                                                <td>$texto</td>
                                                <td>
                                                    <input type='hidden' id='idIndicador' name='idIndicador' value='$idIndicador'>
                                                    <input type='checkbox' class='filled-in' name='idSS$idBitacoraPonderador' id='idSS$idBitacoraPonderador' value='$idBitacoraPonderador'>
                                                    <label for='idSS$idBitacoraPonderador'></label>
                                                </td>
                                            </tr>";
                                            $contee++;
                                    }
                                     echo "<input type='hidden' id='tot' name='tot' value='$idBitacoraPonderador'>";
                                     ?>
                                </tbody>
                            </table>
                            
                        </div>
          </div>
          <div class="row">
            <div align="center">
              <input type="submit" class="btn bg-red waves-effect waves-light" value="Aceptar">
            </div>
          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>
  </form> 
  <script type="text/javascript">
    function confirmaDeletePuente(idCon)
    {
      var idCon=idCon;
      var idIndicador=$("#idIndicador").val();
      swal({
        title: "AVISO",
        text: "¿Desea borrar el registro?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Borrar",
        closeOnConfirm: false
      },
      function(){
        location.href="https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras/deletePuente/"+idCon+"/"+idIndicador;
      });
    }
  </script> 
    <?php 
  include "footer.php";
?>
<!-- <?php 
  //include "footer.php";
 ?> -->