<?php 
  include "header.php";
?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
    <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>
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
                                        <th>Agendar</th>
                                       
                                        <!-- <th>Normas</th> -->

                                        <!-- <th>Datos complementarios</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $contador=1;
                                      foreach ($cenTraCandela as $row) {
                                        $nombreCent=$row["nombre"];
                                        $idAsignacion=$row["idAsignacion"];
                                        $idOti = $row["idOti"];
                                        $idCentro=$row["idCentroTrabajo"];
                                       
                                      
                                       echo "
                                            <tr>
                                                <td>$contador</td>
                                                <td>$nombreCent</td>
                                                <td><a data-toggle='modal' data-target='#myModalfechaini' onclick='identi($idCentro,$idAsignacion)'><i class='fa fa-calendar-check-o' style='color:green'></i></a></td>
                                                
                                              
                                                
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
              <h4 class="modal-title">Inspecciones programadas. <p id="nombreTitul"></p></h4>
            </div>
            <div class="modal-body"  >
              <div id="tablaListadoHistorial">
                <div align="center">
                  <h5>Historial de visitas</h5>
                </div>
                <div class="col-md-12">
                    <table class="table" id="tablelistadoVisita">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Fechas de visita</th>
                          <th scope="col">Observaciones</th>
                          <th scope="col">Status</th>
                          <th scope="col">Eliminar</th>
                        </tr>
                      </thead>
                      <tbody id="listadoVis">
                       
                      </tbody>
                    </table>
                </div>
              </div>
             
             <div align="center" class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="Tt">Próxima fecha de visita </label>
                            <input type="date" id="fechaVisit" name="fechaVisit" class="form-control" />
                            <input type="hidden" id="idIdentif" name="idIdentif">
                            <input type="hidden" id="idAsig" name="idAsig">
                             <input type="hidden" id="fechaActual" name="fechaActual" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                </div>
                
                  <div class="col-md-6">
                    <div class="form-group form-float" style="margin-top: 13px;">
                      <div class="form-line">
                        <label for="cordinaId">Status</label>
                        
                          <select id="statVisita" name="statVisita"  style="width: 100%; border: none;" required>
                            <option value="">Selecciones status</option>
                            <option value="1">Inspección pospuesta</option>
                            <option value="2">Inspección realizada</option>
                            <option value="3">Inducción</option>
                          </select>
                      </div>
                    </div>
                  </div>
            </div>
            <div align="center" class="row">
              <div class="col-md-12">                
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
             
            </div>
           
            <div class="modal-footer">
             
            </div>
          </div>
        </div>
      </div>


     

      <script type="text/javascript">
        function  identi(id,idAsi)
        {
          var id=id;
          var idAsi=idAsi;
          $("#listadoVis").html("");
          $("#idIdentif").val(id);
          $("#idAsig").val(idAsi);
            $.ajax({
                url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/getHistorialViSSHI/"+id+"/"+idAsi,
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
                           
                            $("#listadoVis").append('<tr><td style="display:none">'+data[i]['idvisitas']+'</td><th scope="row">'+ii+'</th><td>'+data[i]['fechaVisita']+'</td><td>'+data[i]['observaciones']+'</td><td><select id="statVisita'+i+'" name="statVisita'+i+'" onchange="modfModal('+data[i]['idvisitas']+','+i+')"   style="width: 100%; border: none;" required><option value="">Selecciones status</option><option value="1">Inspección pospuesta</option><option value="2">Inspección realizada</option><option value="3">Inducción</option></select></td><td><a  onclick="eliminarVisita('+data[i]['idvisitas']+')"><i class="fa fa-trash-o" </i></a></td></tr>');
                            $("#statVisita"+i).val(data[i]['status'])
                            ii++;
                        }
                          $('#tablelistadoVisita').Tabledit({
                            url: 'https://cointic.com.mx/preveer/sistema/index.php/CrudOti/actualHistorialV/',
                            editButton: false,
                            deleteButton:false,
                            columns: {
                                identifier: [0, 'idVisi'],
                                editable: [[2, 'fechvv'],[3, 'observ']]
                            }
                        });
                        $("input[name*='fechvv']").attr("type",'date');
                         
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

        function modfModal(idVi,i)
        {
          var statusSelec=$("#statVisita"+i).val();
          //alert(statusSelec+"  "+idVi);
          var parametro={"statusSelec":statusSelec,"idVi":idVi}
          var url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/modificarAgenda/";
           $.ajax({
                  url : url,
                    type: "POST",
                    data: parametro,
                    dataType: "HTML",
                success: function(data)
                  {
                    swal('Bien', 'Estatus modificado', 'success');
                    
                  }          
                }); 
        }

       
        function AgendarCita()
        {
          var fechaVisita=$("#fechaVisit").val();
          var idIdentif=$("#idIdentif").val();
          var idAsig=$("#idAsig").val();
          var comentario = $("#coments").val();
          var statVisita = $("#statVisita").val();
          var parametro={"fechaVisita":fechaVisita,"idIdentif":idIdentif,"idAsig":idAsig,"coments":comentario,"statVisita":statVisita}
          var url;
                url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/AgendarVisitasshi/";
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

       function eliminarVisita(idVisita)
       {
        swal({
          title: "Aviso",
          text: "¿Esta seguro de eliminar la fecha registrada?",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false
        },
        function(){
          $.ajax({
                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/eliminarFecha/" + idVisita,
                    type: "get",
                    dataType: "html",
                    success: function(data)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
        });
       }
      
      </script>

<ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
    <li class='mfb-component__wrap'>
        <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
        </a>
        <ul class='mfb-component__list'>
            <li>
                <a href="<?=site_url('Catalogos')?>" data-mfb-label='Catálogos' class='mfb-component__button--child'>
                    <i class='material-icons'>import_contacts</i>
                </a>
            </li>
            <li>
                <a href="<?=site_url('CrudOti')?>" data-mfb-label='OTI' class='mfb-component__button--child'>
                    <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>

            <li>
                <a href="<?=site_url('Crudusuarios')?>"
                   data-mfb-label='Usuarios' class='mfb-component__button--child'>
                    <i class='material-icons'>person_add</i>
                </a>
            </li>
        </ul>
    </li>
</ul>

<?php

$tipo=$this->session->userdata('tipoUser');
if($tipo!='' && $_SESSION['idusuariobase'] != '')
{
    //$data['page'] = $this->usuarios->data_pagination("/Crudusuarios/index/",
    //$this->usuarios->getTotalRowAllData(), 3);
    // $data['listAreas'] = $this->areas->getDatos($index);
    if($tipo == 1){ //Menu flotante para administrador
        echo "
            
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('Catalogos')." data-mfb-label='Catálogos' class='mfb-component__button--child'>
                <i class='material-icons'>import_contacts</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>

            <li>
                <a href=".site_url('Crudusuarios')."
                data-mfb-label='Usuarios' class='mfb-component__button--child'>
                <i class='material-icons'>person_add</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>        
            ";

    } else if($tipo == 2){ //Menu flotante para comercial
        echo "
            
             <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudCentrosTrabajo')." data-mfb-label='Centros de trabajo' class='mfb-component__button--child'>
                <i class='material-icons'>group_work</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudFormatos')." data-mfb-label='Formatos' class='mfb-component__button--child'>
                <i class='material-icons'>store_mall_directory</i>
                </a>
            </li>
            <li>
                <a href=".site_url('Crudclientes')." data-mfb-label='Clientes' class='mfb-component__button--child'>
                <i class='material-icons'>account_box</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>       
            ";
    }  else if($tipo == 3){ //Menu flotante para coordinador
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti/coordinador')."/".$this->session->userdata('idusuariobase')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>   
           ";
    }

    else if($tipo == 4){ //Menu flotante para analista
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>              
           ";
    }

    else if($tipo == 5){ //Menu flotante para analista
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>            
           ";
    }

    else if($tipo == 9){ //Menu flotante para Uisuario coordinador SSHI
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
                <li class='mfb-component__wrap'>
                    <a href='#' class='mfb-component__button--main'>
                    <i class='material-icons'>reorder</i>
                    </a>
                    <ul class='mfb-component__list'>
                        <li>
                            <a href=".site_url('CrudOti/coordinador/')." data-mfb-label='OTI' class='mfb-component__button--child'>
                            <i class='material-icons'>playlist_add_check</i>
                            </a>
                        </li>
                        <li>
                            <a href=".site_url('CrudOti/coordinadorAnNoAsig/'.$this->session->userdata('idusuariobase'))." data-mfb-label='A cargo sin asignar' class='mfb-component__button--child'>
                            <i class='material-icons'>assignment_late</i>
                            </a>
                        </li>
                         <li>
                            <a href=".site_url('CrudOti/coordinadorAnAsig/'.$this->session->userdata('idusuariobase'))." data-mfb-label='A cargo asignadas' class='mfb-component__button--child'>
                            <i class='material-icons'>assignment_turned_in</i>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>            
           ";
    }


}

?>

<!-- /Boton flotante -->


<!-- Jquery Core Js -->
<!--JQuery UI-->
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!--Datatable-->
<script src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>


<!-- Bootstrap Core Js -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.js')?>"></script>

<!-- Select Plugin Js -->
<!-- <script src="<?=base_url('assets/plugins/bootstrap-select/js/bootstrap-select.js')?>"></script> -->

<!-- Slimscroll Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.js')?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?=base_url('assets/plugins/node-waves/waves.js')?>"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-countto/jquery.countTo.js')?>"></script>

<!-- Morris Plugin Js -->
<script src="<?=base_url('assets/plugins/raphael/raphael.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/morrisjs/morris.js')?>"></script>

<!-- ChartJs -->
<script src="<?=base_url('assets/plugins/chartjs/Chart.bundle.js')?>"></script>

<!-- Flot Charts Plugin Js -->
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.resize.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.pie.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.categories.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.time.js')?>"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-sparkline/jquery.sparkline.js')?>"></script>

<!-- Custom Js -->
<script src="<?=base_url('assets/js/admin.js')?>"></script>

<script src="<?=base_url('assets/js/pages/index.js')?>"></script>



<!-- Demo Js -->
<script src="<?=base_url('assets/js/demo.js')?>"></script>
<script src="<?=base_url('assets/js/modernizr.touch.js')?>"></script>
<!--<script src="<?/*=base_url('assets/js/mfb.js.js')*/?>"></script>
-->


<!--JS PARA EDITAR IMAGENES AUTOMATICAMENTE -->
<link href="<?=base_url('assets/css/fileinput.min.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/js/piexif.min.js')?>"></script>
<script src="<?=base_url('assets/js/sortable.min.js')?>"></script>
<script src="<?=base_url('assets/js/purify.min.js')?>"></script>
<script src="<?=base_url('assets/js/fileinput.min.js')?>"></script>
<script src="<?=base_url('assets/js/es.js')?>"></script>



<script>

    var panel = document.getElementById('panel'),
        menu = document.getElementById('menu'),
        showcode = document.getElementById('showcode'),
        selectFx = document.getElementById('selections-fx'),
        selectPos = document.getElementById('selections-pos'),
        // demo defaults
        effect = 'mfb-zoomin',
        pos = 'mfb-component--br';

    //showcode.addEventListener('click', _toggleCode);
    //selectFx.addEventListener('change', switchEffect);
    //selectPos.addEventListener('change', switchPos);

    function _toggleCode() {
        panel.classList.toggle('viewCode');
    }

    function switchEffect(e){
        effect = this.options[this.selectedIndex].value;
        renderMenu();
    }

    function switchPos(e){
        pos = this.options[this.selectedIndex].value;
        renderMenu();
    }

    function renderMenu() {
        menu.style.display = 'none';
        // ?:-)
        setTimeout(function() {
            menu.style.display = 'block';
            menu.className = pos + effect;
        },1);
    }

</script>


</body>

</html>