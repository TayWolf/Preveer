<?php
include "header.php";
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.tabledit.js"></script>
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <!-- <h2>NORMAL TABLES</h2> -->
        </div>
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="Buscar...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>

        <div class="block-header">
            <a href="<?=site_url('Catalogos');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header">
                                <h2>
                                    Regiones registradas
                                </h2>
                                <ul class="header-dropdown m-r--5">
                                    <li class="dropdown">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="material-icons">add</i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" data-toggle="modal" data-target="#myModalregion" >Registrar región</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="body table-responsive">
                        <table id="tablaRegion" class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Region</th>
                                <th>Edo</th>
                                <th>Municipio</th>
                                <th>CP</th>
								<th>Eliminar</th>

                            </tr>
                            </thead>
                            
                        </table>



                    </div>
                </div>



            </div>

        </div>
    </div>
</section>

<div class="modal fade" id="myModalregion" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registre nueva region</h4>
        </div>
        <div class="modal-body">
          <div class="row">
			
			<div class="col-sm-3">
				<div class="form-group">
					<div class="form-line">
						<label for="DireccionUser">Nombre de la colonia</label>
						<input type="text" class="form-control" id="nombreColonia" name="nombreColonia" placeholder="Nombre de la colonia" required/>
					</div>
				</div>
			</div>
			
		  <div class="col-md-3">
				<div class="form-group form-float" style="margin-top: 13px;">
					<div class="form-line">
						<label for="tipoUser">Estados</label>
						<select id="idEstado" name="idEstado" onchange="getMunicipios();" style="width: 100%; border: none;" required>
							<option value="">Seleccione estado</option>
								<?php			
									foreach ($consultaEdo as $rowedo) {
                                
										$id_Estado = $rowedo["id_Estado"];
										$nombreEstado = $rowedo["nombreEstado"];
										
										echo "<option value='$id_Estado'>$nombreEstado</option>";
									}
								?>
						   
                        </select>
                    </div>
                </div>
            </div>
			<div id="visualMunicipio" style="display:none">
				<div class="col-md-3">
					<div class="form-group form-float" style="margin-top: 13px;">
						<div class="form-line">
							<label for="tipoUser">Municipio</label>
							<select id="idMunicipios" name="idMunicipios" onchange="getCodigopostal();" style="width: 100%; border: none;" required>
								
							</select>
						</div>
					</div>
				</div>
			</div>
			
			<div id="visualCodigopostal" style="display:none">
			<div class="col-md-3">
				<div class="form-group form-float" style="margin-top: 13px;">
					<div class="form-line">
						<label for="tipoUser">Codigo postal</label>
						<select id="idCodigopostal" name="idCodigopostal" style="width: 100%; border: none;" required>
							
                        </select>
                    </div>
                </div>
            </div>
			</div>
		  </div>
		  
			<div class="row">
				<div class="col-sm-4 col-md-offset-5">
					<div class="form-line">
						<input type="submit" class="btn bg-red waves-effect waves-light" value="Aceptar" onclick="guardarColonia()">
					</div>
				</div>
			</div>
									
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
<script type="text/javascript">
    function confirmaDeleteRegion(id)
    {
        //alert ("id"+id);
        swal({
                title: "Aviso",
                text: "¿Desea borrar esta colonia?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/Crudregiones/deleteColonia/"+id;
            });

    }
	
	function getMunicipios(){
		
		var id_Estado = $("#idEstado").val();
		
		if(id_Estado!=""){
			
			$("#visualMunicipio").show();
		$.ajax({
                url : "<?php echo site_url('Crudregiones/getMunicipio/')?>" + id_Estado,
                type: "POST",
                dataType: "json",
              
                success: function(data)
                {
                  $('#idMunicipios').empty();
				  
                  if (data.length>0)
                    {
						$("#idMunicipios").append('<option value="">Seleccione un municipio</option>')
						for(i=0;i<=data.length;i++){
						
						
							$("#idMunicipios").append('<option value="'+data[i]['idMunicipio']+'">'+data[i]['nombreMunicipio']+'</option>')
						}
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
		}else{
			
			$("#visualMunicipio").hide();
			$("#visualCodigopostal").hide();
			
		}
	}
	
	function getCodigopostal(){
		var id_municipios = $("#idMunicipios").val();
		
		if(id_municipios!=""){
			
			$("#visualCodigopostal").show();
		$.ajax({
                url : "<?php echo site_url('Crudregiones/getCodigopostal/')?>" + id_municipios,
                type: "POST",
                dataType: "json",
              
                success: function(data)
                {
                  $('#idCodigopostal').empty();
				  
                  if (data.length>0)
                    {
						$("#idCodigopostal").append('<option value="">Seleccione un codigo postal</option>')
						for(i=0;i<=data.length;i++){
						
						
							$("#idCodigopostal").append('<option value="'+data[i]['cp']+'">'+data[i]['cp']+'</option>')
						}
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
			}else{
			
			$("#visualCodigopostal").hide();
			
		}
	}
	
	 function guardarColonia(){
		var id_municipios = $("#idMunicipios").val();
		var id_codigopostal = $("#idCodigopostal").val();
		var nombre_colonia = $("#nombreColonia").val();
		
		var parametros={id_municipios:id_municipios,
						id_codigopostal:id_codigopostal,
						nombre_colonia:nombre_colonia}
		$.ajax({
                url : "<?php echo site_url('Crudregiones/altaColonia/')?>" ,
				data: parametros,
                type: "POST",
                dataType: "HTML",
              
                success: function(data)
                {
					swal({
					  title: "Éxito",
					  text: "La colonia se ha registrado.",
					  type: "success",
					  confirmButtonClass: "btn-danger",
					  confirmButtonText: "Aceptar",
					  closeOnConfirm: false
					},
					function(){
					  location.reload();
					});
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
	
	} 
</script>

<script type="text/javascript">
         $(document).ready(function () {
       // alert("entra")
    $('#tablaRegion').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
                    "url": "<?php echo base_url('index.php/Crudregiones/getListaregiones/') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
                    "complete": function () {
                            
                         $('#tablaRegion').Tabledit({
                            url: 'Crudregiones/modificarDatos/',
                            //eventType: 'dblclick',
                            editButton: false,
                            deleteButton:false,
                            columns: {
                                identifier: [0, 'idR'],
                                editable: [[1, 'nombreRegion']]
                            },
                               onSuccess: function (data, textStatus, jqXHR)
                               {
                                if (data==2)
                                 {
                                    swal("ERROR", "Registros oficiales no pueden ser editados.", "error")
                                 }
                               }
                           
                          }); 
                       
                    }
                },
				 
                "columns": [
                    { "data": "idRegiones" },
                    { "data": "nombreRegion" },
                    { "data": "Edo" },
                    { "data": "municipio" },
                    { "data": "cp" },
					{ "data": "Eliminar" }
                ],
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                }
    });

});

         function traerCategoria(idR)
    {        
            var id=idR;
            var idEdo=$("#idee"+idR).val();

            $("#muestraselectcategoria"+id).show();
            $("#selectcategoria"+id).show();
            $("#nombreCategoria"+id).hide();
             $.ajax({
                url : "<?php echo site_url('Crudregiones/getMunicipio/')?>"+idEdo ,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //alert(data);
                    if (data.length>0) 
                    {
                        $("#selectcategoria"+id).html('');
                        $("#selectcategoria"+id).append('<option value="">Seleccione un municipio</option>');
                        for (i=0; i<data.length; i++)
                        {
                            $("#selectcategoria"+id).append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']));
                        }
                         $("#selectcategoria"+id).val($("#idMM"+id).val());
                    }
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

 function traerCodigos(idR)
    {        
            var id=idR;
            var idMun=$("#idMM"+idR).val();

            $("#muestraselectcp"+id).show();
            $("#selectcp"+id).show();
            $("#numberCodigo"+id).hide();
             $.ajax({
                url : "<?php echo site_url('Crudregiones/getCodigopostal/')?>"+idMun ,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //alert(data);
                    if (data.length>0) 
                    {
                        $("#selectcp"+id).html('');
                        $("#selectcp"+id).append('<option value="">Seleccione un C.P.</option>');
                        for (i=0; i<data.length; i++)
                        {
                            $("#selectcp"+id).append(new Option(data[i]['cp'],data[i]['cp']));
                        }
                         $("#selectcp"+id).val($("#idCP"+id).val());
                    }
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function traerEdos(idR)
    {        
            var id=idR;
            $("#muestraselectEdo"+id).show();
            $("#selectEdo"+id).show();
            $("#nombreEstado"+id).hide();
             $.ajax({
                url : "<?php echo site_url('Crudregiones/traerEdo/')?>" ,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    //alert(data);
                    if (data.length>0) 
                    {
                        for (i=0; i<data.length; i++)
                        {
                            $("#selectEdo"+id).append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']));
                        }
                        $("#selectEdo"+id).val($("#idee"+id).val());
                    }
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function cambiarIdEdo(idR)
        {
            $("#idee"+idR).val($("#selectEdo"+idR).val())
        }

        function cambiarIdMuni(idR)
        {
            $("#idMM"+idR).val($("#selectcategoria"+idR).val())
        }

        function modificarDatosCate(id){
             
             var id = id;
             var idcategoria = $("#selectcategoria"+id).val();
             
              //alert (idcategoria);
             var parametros = {"idcategoria":idcategoria,"id":id}
              //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
             $.ajax({
                url : "<?php echo site_url('Crudregiones/Modific/')?>" ,
                type: "post",
                data: parametros,
                dataType: "HTML",
                  success: function(data)
                    {
                        if (data==2)
                         {
                            swal("ERROR", "Registros oficiales no pueden ser editados.", "error")
                         }
                    },
                  error: function (jqXHR, textStatus, errorThrown)
                    {
                      // alert('ERROR AL GUARDAR ESTADO');
                    }
                });
            }

        function modificarDatosCp(id){
             
             var id = id;
             var idSel = $("#selectcp"+id).val();
             
              //alert (idcategoria);
             var parametros = {"idSel":idSel,"id":id}
              //alert("idEstado: "+idestado+"idciudad: "+idciudad+"idcolonia "+idcolonia);
             $.ajax({
                url : "<?php echo site_url('Crudregiones/ModificP/')?>" ,
                type: "post",
                data: parametros,
                dataType: "HTML",
                  success: function(data)
                    {
                        if (data==2)
                         {
                            swal("ERROR", "Registros oficiales no pueden ser editados.", "error")
                         }
                    },
                  error: function (jqXHR, textStatus, errorThrown)
                    {
                      // alert('ERROR AL GUARDAR ESTADO');
                    }
                });
            }
</script>


<?php
//include "footer.php";
?>
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
<!--<script src="<?=base_url('assets/js/piexif.min.js')?>"></script>-->
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
