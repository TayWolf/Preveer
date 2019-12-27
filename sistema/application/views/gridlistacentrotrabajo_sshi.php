<?php 
  include "header.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  var array=
  {'datos':[]};
</script>
    <section class="content">
        <div class="container-fluid">
        <div class="block-header">
        <?php $tipo=$this->session->userdata('tipoUser');
       
                if($tipo!='' && $_SESSION['idusuariobase'] != '')
		        {
                    if($tipo == 3){
                      //echo "<a href='".site_url('CrudOti/coordinador')."'>
                      echo "<a href='javascript:history.back(1)'>  
                        
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    } else{
                        //echo "<a href='".site_url('CrudOti/Otish')."'>
                         echo "<a href='javascript:history.back(1)'>  
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    }
                }           
            
            ?>
        </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Centros de trabajos de la OTI 
                                
                            </h2>
                            
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Centro de trabajo</th>
                                        <th>Servicio</th>
                                        <th>Subservicio</th>
                                        <!-- <th>Normas</th> -->

                                        <!-- <th>Datos complementarios</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $contador=1;
                                      foreach ($cenTra as $row) {
                                        $nombreCent=$row["nombre"];
                                        $idAsignacion=$row["idAsignacion"];
                                        $servicio = $row["servicio"];
                                        $subservicio = $row["subservicio"];
                                        $idOti = $row["idOti"];
                                        $porcentaje=$row["porcentajeValor"];
                                        $idSubservicio=$row["idsubser"];
                                       
                                        if($isVisita > 0){
                                          $icn = "<a  data-toggle='modal' data-target='#myModalfechaini' onclick='identi($idAsignacion)'><i class='fa fa-calendar-check-o' style='color:green'></i></a>";
                                        }else{
                                          $icn = "<a data-toggle='modal' data-target='#myModalfechaini' onclick='identi($idAsignacion)'><i class='fa fa-calendar-check-o'></i></a>";
                                        }

                                        if($isVisitaDocs > 0){
                                          $icnDoc = "<a data-toggle='modal' data-target='#myModalfechadoctos' onclick='identiDoct($idAsignacion)'><i class='fa fa-eye' style='color:green'></i></a>";
                                        }else{
                                          $icnDoc = "<a data-toggle='modal' data-target='#myModalfechadoctos' onclick='identiDoct($idAsignacion)'><i class='fa fa-eye'></i></a>";
                                        }
                                       echo "
                                            <tr>
                                                <td>$contador</td>
                                                <td>$nombreCent</td>
                                                <td>$servicio</td>
                                                <td>$subservicio</td>
                                               
                                                <!--<td><a href='https://cointic.com.mx/preveer/sistema/index.php/Crudcheklist/verificacionControlcalidad/$idAsignacion/$idOti/$idSubservicio' ><i class='material-icons'>library_books</i></a></td>-->
                                               
                                                
                                            </tr>";
                                            $contador++;
                                       }      
                                     ?>
                                </tbody>
                            </table>
                        </div>
                                    <div align="center">
                                        <div  id="resultadoGeneral" >
                                            <div class="paginacion">
                                                <!--<ul class="pagination"><?php echo $page; ?></ul>-->
                                            </div>
                                        </div>
                                    </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="myModalfechaini" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Por favor indique la fecha de visita. <p id="nombreTitul"></p></h4>
            </div>
            <div id="tablaListadoHistorial" style="display: none;">
                <div align="center">
                  <h5>Historial de visitas</h5>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Fechas de visita</th>
                        </tr>
                      </thead>
                      <tbody id="listadoVis">
                        
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-body">
             <div align="center" class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="Tt">Próxima fecha de visita s </label>
                            <input type="date" id="fechaVisit" name="fechaVisit" class="form-control">
                            <input type="hidden" id="idIdentif" name="idIdentif">
                             <input type="hidden" id="fechaActual" name="fechaActual" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="form-line">
                      <label for="coments">Comentario</label>
                      <input type="text" class="form-control" id="coments" name="coments" placeholder="Comentario fecha de visita" required>
                    </div>
                  </div>
                </div>
             </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                 <div align="center">
                   <input type="submit"  onclick="AgendarCita()" class="btn bg-red waves-effect waves-light" value="Agendar"> 
                  
                </div>
              </div>
              <!-- <div class="col-sm-6">
                  <div align="center">
                     <button onclick="confirmaEntrega();" class="btn bg-red waves-effect waves-light">Entregar Proyecto</button>
                  </div>
              </div> -->
            </div>
           
            <div class="modal-footer">
                
               
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="myModalfechadoctos" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Por favor indique la fecha de revisión de documentos.</h4>
            </div>
            <div id="tablaListadoHistorialDoc" style="display: none;">
                <div align="center">
                  <h5>Historial de visitas</h5>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Fechas de revisión</th>
                          <th scope="col">Comentario</th>
                        </tr>
                      </thead>
                      <tbody id="listadoVisDoctos">
                        
                      </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-body">
             <div align="center" class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="Tt">Próxima fecha de revisión de documentos </label>
                            <input type="date" id="fechaVisitDoctos" name="fechaVisitDoctos" class="form-control" />
                            <input type="hidden" id="idIdentifDoctos" name="idIdentifDoctos">
                             <input type="hidden" id="fechaActualDoctos" name="fechaActualDoctos" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="form-line">
                      <label for="comentdocs">Comentario</label>
                      <input type="text" class="form-control" id="comentdocs" name="comentdocs" placeholder="Comentario fecha de visita" required>
                    </div>
                  </div>
                </div>
             </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                 <div align="center">
                   <input type="submit"  onclick="AgendarCitaDoctos()" class="btn bg-red waves-effect waves-light" value="Agendar"> 
                  
                </div>
              </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="myModalEntregables" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Por favor indique los entregables del centro de trabajo.</h4>
            </div>
            <div class="modal-body">
             <div align="center" class="row">
              <form action="#" id="formEntregable">
                <input type="hidden" id="entregableID" name="entregableID" required>
                <input type="hidden" id="contadorEntregables" name="contadorEntregables" required>
                <div class="col-sm-12">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Seleccionar</th>
                          <th scope="col">Entregable</th>
                          <th scope="col">Cantidad</th>
                          <th scope="col">Nota</th>
                        </tr>
                      </thead>
                      <tbody id="listaEntregables">
                        
                      </tbody>
                    </table>
                </div>
             </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                 <div align="center">
                  <?php 
                    if ($tipo!=4) {
                      echo "<input type='submit' class='btn bg-red waves-effect waves-light' value='Guardar cambios'>";
                    }else
                    {
                      echo "";
                    }
                   ?>
                   
                </div>
              </div>
            </div>
            <div class="modal-footer">
            </form>
            </div>

          </div>
        </div>
      </div>

      <script type="text/javascript">
        function  identi(id)
        {
          var id=id;
          $("#listadoVis").html("");
          $("#idIdentif").val(id);
            $.ajax({
                url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/getHistorialVi/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    if (data.length>0) 
                    {
                      $("#tablaListadoHistorial").show();
                      var ii=1;
                        for (i=0; i<data.length; i++)
                        {
                           
                            $("#listadoVis").append('<tr><th scope="row">'+ii+'</th><td>'+data[i]['fechaAgenda']+'</td><td>'+data[i]['comentario']+'</td></tr>');
                           
                            ii++;
                        }
                    }else{
                      $("#tablaListadoHistorial").hide();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }


function  identiDoct(id)
        {
          var id=id;
          $("#listadoVisDoctos").html("");
          $("#idIdentifDoctos").val(id);
            $.ajax({
                url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/getHistorialDoc/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    if (data.length>0) 
                    {
                      $("#tablaListadoHistorialDoc").show();
                      var ii=1;
                        for (i=0; i<data.length; i++)
                        {
                           
                            $("#listadoVisDoctos").append('<tr><th scope="row">'+ii+'</th><td>'+data[i]['fechaAgenda']+'</td><td>'+data[i]['comentario']+'</td></tr>');
                           
                            ii++;
                        }
                    }else{
                      $("#tablaListadoHistorialDoc").hide();
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        /*function confirmaEntrega()
        {
          var idI=$("#idIdentif").val();
          var fechaActual=$("#fechaActual").val();
          swal({
              title: "¿Desea finalizar visitas?",
              text: "Si acepta esta opción no podrá agendar mas visitas para este centro de trabajo.",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Finalizar visitas",
              closeOnConfirm: false
            },
            function(){
               var url;
                  url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/cerrarVisita/"+idI+"/"+fechaActual;
                  $.ajax({
                    url : url,
                      type: "POST",
                      dataType: "HTML",
                  success: function(data)
                    {
                      swal('ÉXITO', 'OTI cerrado', 'success');
                      $('#myModalfechaini').modal('hide');
                    }          
                  }); 
            });
           
        }*/
        function AgendarCita()
        {
          var fechaVisita=$("#fechaVisit").val();
          var idIdentif=$("#idIdentif").val();
          var comentario = $("#coments").val();
          var parametro={"fechaVisita":fechaVisita,"idIdentif":idIdentif,"coments":comentario}
          var url;
                url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/AgendarVisita/";
                $.ajax({
                  url : url,
                    type: "POST",
                    data: parametro,
                    dataType: "HTML",
                success: function(data)
                  {
                    swal('AGENDADO', 'Visita agendada', 'success');
                    $('#myModalfechaini').modal('hide');
                  }          
                }); 
        }
        function AgendarCitaDoctos()
        {
          var fechaVisitadoc=$("#fechaVisitDoctos").val();
          var idIdentifdoc=$("#idIdentifDoctos").val();
          var coment = $('#comentdocs').val();
           var parametro={"fechaVisitadoc":fechaVisitadoc,"idIdentifdoc":idIdentifdoc,"comentdocs":coment}
          var url;
                url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/AgendarVisitaDoctos/";
                $.ajax({
                  url : url,
                    type: "POST",
                    data: parametro,
                    dataType: "HTML",
                success: function(data)
                  {
                    swal('AGENDADO', 'Visita agendada', 'success');
                    $('#myModalfechadoctos').modal('hide');
                  }          
                }); 
        }
        function asignaEntregables(idAsignaInmueble)
        {
          var habilitado='<?=($this->session->userdata('idusuariobase')==1 || $this->session->userdata('idusuariobase')==4)? "" : "disabled" ?>';
            $("#entregableID").val(idAsignaInmueble);
          $("#contadorEntregables").val(0);
          array={'datos':[]};
          $.ajax(
            {
              url: "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/obtenerListadoEntregables/",
              type: 'GET',
              dataType: 'JSON',
              success: function(data)
              {
                $("#listaEntregables").empty();
                for(i=0; i<data.length; i++)
                {
                    
                  $("#listaEntregables").append(
                      "<tr><td><input type='hidden' name='identificador"+i+"' value='"+data[i]['idEntregable']+"'><input onChange='habilitarEntregable("+data[i]['idEntregable']+")' type='checkbox' name='entregableCheck"+i+"' id='entregableCheck"+data[i]['idEntregable']+"' "+habilitado+"><label for='entregableCheck"+data[i]['idEntregable']+"'></td><td>"+data[i]['nombreEntregable']+"</td><td><input type='number' name='entregableCantidad"+i+"' id='entregableCantidad"+data[i]['idEntregable']+"' min='1' disabled></td><td><input type='text' name='entregableNota"+i+"' id='entregableNota"+data[i]['idEntregable']+"' disabled></td></tr>"
                    );

                }
                $("#contadorEntregables").val(data.length);
                var parametro={"idAsignaInmueble": idAsignaInmueble};
                $.ajax(
                  {
                    url: "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/obtenerEntregablesCentroTrabajo/",
                    type: 'POST',
                    data: parametro,
                    dataType: 'JSON',
                    success: function(data)
                    {
                      //SELECT * FROM entregableInmueble WHERE idAsignacion=idAsignaInmueble
                        for(i=0; i<data.length;i++)
                        {

                          $("#entregableCheck"+data[i]['idEntregable']).prop('checked', true);
                          habilitarEntregable(data[i]['idEntregable']);
                          $("#entregableCantidad"+data[i]['idEntregable']).val(data[i]['cantidad']);
                          $("#entregableNota"+data[i]['idEntregable']).val(data[i]['nota']);

                          
                        }

                        $("#myModalEntregables").modal('show');
                        
                    }
                  });
              }
            });






        }
        function habilitarEntregable(idEntregable)
        {
          var habilitado=$("#entregableCheck"+idEntregable).is(':checked');

            $("#entregableCantidad"+idEntregable).prop('required',habilitado);
            $("#entregableCantidad"+idEntregable).prop('disabled',!habilitado);
            $("#entregableNota"+idEntregable).prop('disabled',!habilitado);
            if(habilitado)
            {
              $("#entregableCheck"+idEntregable).val(idEntregable);
            }
            else
            {
              $("#entregableCheck"+idEntregable).val(0);

            }
            
            if($("#entregableCantidad"+idEntregable).val()=="")
              $("#entregableCantidad"+idEntregable).val(1);


        }

$("#formEntregable").submit(function(event)
  {
    var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudOti/altaEntregables/';?>"+$("#contadorEntregables").val();

    var f = $(this);
    var formData = new FormData(document.getElementById("formEntregable"));
    
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
              
                    swal("HECHO", "Entregables modificados.", "success")                
                });

    });

      </script>
<script type="text/javascript">
    window.onload=function ()
    {

        var cantidad=<?php echo $contador;?>;

        for(i=1; i<=cantidad; i++)
        {
            colorear(i);
        }
    }
    function colorear(identificador)
    {
        

        if($("#porcentaje"+identificador).html()<25)
        {
            $("#porcentaje"+identificador).css("color", "red");
        }
        else if($("#porcentaje"+identificador).html()<50)
        {
            $("#porcentaje"+identificador).css("color", "darkorange");
        }
        else if($("#porcentaje"+identificador).html()<75)
        {
            $("#porcentaje"+identificador).css("color", "gold");
        }
        else if($("#porcentaje"+identificador).html()<100)
        {
            $("#porcentaje"+identificador).css("color", "green");
        }
        //hacerCuenta();
    }
</script>
    <?php 
  include "footer.php";
?>
<!-- <?php 
  //include "footer.php";
 ?> -->