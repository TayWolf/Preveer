<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
  window.onload=inicio;
    function inicio()
    {
     $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerEstados')?>/",
            type: "get",
            dataType: "json",
            success: function(data)
            {
              for(var i=0; i<data.length; i++)
              {
                $("#estado").append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']))
              }
            }
          });
    }
    function obtenerMunicipios()
    {
      $("#colonia").empty();
      $("#codigoPostal").val("");
      var idEstado=$("#estado").val();
           $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerMunicipios')?>/"+idEstado,
            type: "get",
            dataType: "json",
            success: function(data)
            {
              $("#municipio").empty();
              for(var i=0; i<data.length; i++)
              {
                $("#municipio").append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']))
              }
            }
          });

    }
    function obtenerColonias()
    {
      $("#codigoPostal").val("");
      var idMunicipio=$("#municipio").val();
           $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerColonias')?>/"+idMunicipio,
            type: "get",
            dataType: "json",
            success: function(data)
            {
              $("#colonia").empty();
              for(var i=0; i<data.length; i++)
              {
                $("#colonia").append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']))
              }
            }
          });
    }
    function obtenerCodigoPostal()
    {
      var idColonia=$("#colonia").val();
           $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerCodigoPostal')?>/"+idColonia,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                $("#codigoPostal").val(data[0]["cp"]);
            }
          });
    }
    function habilitarAtencionClientes()
    {
        $("#horarioAtencionInicio").prop('disabled', $("#aplicaHorarioAtencion").is(":checked"));
        $("#horarioAtencionFin").prop('disabled', $('#aplicaHorarioAtencion').is(':checked'));

    }

	$(function(){
		$("#form").on("submit", function(e){
		var url;
		
		url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/altaCentroTrabajo';?>";
		e.preventDefault();
		var f = $(this);

		var formData = new FormData(document.getElementById("form"));
		var idFormato = $("#idFormato").val();
		var idInmueble = $("#idInmueble").val(); 
		var nombreCentro = $("#nombreCentro").val();
		var parametros = {idFormato:idFormato, idInmueble:idInmueble, nombreCentro:nombreCentro}
      
			$.ajax({
				url : "<?php echo site_url('CrudCentrosTrabajo/obtenerDatosVerificiar')?>/",
				data:parametros,
				type: "post",
				dataType: "JSON",
				success: function(data)
				{
				   if(data==null){
					   $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/assets/img/loading.gif"/>');
					   $.ajax({
							  url: url,
							  type: "post",
							  dataType: "html",
							  data: formData,
							  cache: false,
							  contentType: false,
							  processData: false
						}).done(function(res){
							
							if(res==1){
								swal({
									title: "HECHO",
									text: "El centro de trabajo se ha registrado exitosamente.",
									type: "success",
									showCancelButton: false,
									confirmButtonClass: "btn-danger",
									confirmButtonText: "Aceptar",
									closeOnConfirm: false
								},
								
								function(){
									window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo")
								
								});

							  
								$('#cargando').fadeIn(1000).html(data);
							
							}
						   
						   if(res==2){
								swal("HECHO", "Centro de trabajo registrado", "success")
							}
						   
						});
					   
				   }else{
						swal({
							  title: "Aviso",
							  text: "Ya existe este centro de trabajo, ¿Desea registrarlo nuevamente?",
							  type: "warning",
							  showCancelButton: true,
							  confirmButtonClass: "btn-danger",
							  confirmButtonText: "Si, registrar",
							  closeOnConfirm: false
						},
						
						function(){
							$('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/assets/img/loading.gif"/>');
							$.ajax({
							  url: url,
							  type: "post",
							  dataType: "html",
							  data: formData,
							  cache: false,
							  contentType: false,
							  processData: false
						}).done(function(res){
							
							if(res==1){
								swal({
									title: "HECHO",
									text: "El centro de trabajo se ha registrado exitosamente.",
									type: "success",
									showCancelButton: false,
									confirmButtonClass: "btn-danger",
									confirmButtonText: "Aceptar",
									closeOnConfirm: false
								},
								
								function(){
									window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo")
								$('#cargando').fadeIn(1000).html(data);
								});

							  
								
							
							}
						   
						   if(res==2){
								swal("HECHO", "Centro de trabajo registrado", "success")
							}
						   
						});
						});
					}
				},
				
				error: function (jqXHR, textStatus, errorThrown)
				{
						alert('Error get data from ajax');
				}
			}); 
		});
	});

    function iniciarMap(){

var boton=document.getElementById('obtener');

boton.addEventListener('click', obtener, false);

}
function obtener(){navigator.geolocation.getCurrentPosition(mostrar, gestionarErrores);}
  function mostrar(posicion){
    var ubicacion=document.getElementById('localizacion');
    var datos='';
    datos+='Latitud: '+posicion.coords.latitude+'<br>';
    datos+='Longitud: '+posicion.coords.longitude+'<br>';
    datos+='Exactitud: '+posicion.coords.accuracy+' metros.<br>';

    $("#latitud").val(posicion.coords.latitude);
    $("#longitud").val(posicion.coords.longitude);
    $("#Metros").val(posicion.coords.accuracy+" metros.");
  }

function gestionarErrores(error){
  alert('Error: '+error.code+' '+error.message+ '\n\nPor favor compruebe que está conectado '+
  'a internet y habilite la opción permitir compartir ubicación física');
  }
  window.addEventListener('load', iniciarMap, false);

  var nav4 = window.Event ? true : false;
   function aceptNum(evt)
   {
       var key = nav4 ? evt.which : evt.keyCode;
       return (key <= 13 || (key>= 48 && key <= 57));
   }
</script>
    <section class="content">
        <div class="container-fluid">
        <div class="block-header">
                <a href="<?=site_url('CrudCentrosTrabajo');?>">
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
                                Ingrese los siguientes datos
                            </h2>
                            
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <label for="Formato">Formato</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                    <select id="idFormato" name="idFormato" style="width: 100%; border: none;color:#000;" required>
                                                         <option value="">Seleccione formato</option>
                                                         <?php 
                                                         foreach ($formato as $row) {
                                                           $idFormat=$row["idFormato"];
                                                           $nombreFormat=$row["nombre"];

                                                           echo "<option value='$idFormat'>$nombreFormat</option>";
                                                         }
                                                          ?>
                                                         
                                                     </select>
                                                 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="Inmueble">Inmueble</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                    <select id="idInmueble" name="idInmueble" style="width: 100%; border: none;color:#000;" required>
                                                         <option value="">Seleccione inmueble</option>
                                                         <?php 
                                                         foreach ($inmueble as $row) {
                                                           $idIn=$row["idInmueble"];
                                                           $nombreIn=$row["nombreInmueble"];

                                                           echo "<option value='$idIn'>$nombreIn</option>";
                                                         }
                                                          ?>
                                                         
                                                     </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="Nombre">Nombre del centro de trabajo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nombreCentro" name="nombreCentro" placeholder="Nombre" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="email_address">IdDet</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="idDet" name="idDet" placeholder="IdDet" required />
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                                <div class="row clearfix">
                                 <div class="col-md-4">
                                    <label>Estado</label>
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                          <select id="estado" name="estado" style="width: 100%; border: none;color:#000;"  onChange="obtenerMunicipios();" required>
                                          </select>
                                        </div>
                                      </div>
                                  </div>
                                 <div class="col-md-4">
                                    <label>Municipio o Delegación</label>
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                          <select id="municipio" name="municipio" style="width: 100%; border: none;color:#000;"  onChange="obtenerColonias();" required>
                                            <option value="">Seleccione el municipio</option>
                                          </select>
                                        </div>
                                      </div>
                                  </div>
                                 <div class="col-md-4">
                                    <label>Colonia</label>
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                          <select id="colonia" name="colonia" style="width: 100%; border: none;color:#000;" onChange="obtenerCodigoPostal();" required>
                                            <option value="">Seleccione la colonia</option>
                                          </select>
                                        </div>
                                      </div>
                                  </div>                                                                   
                                </div>
                                <div class="row clearfix">
                                  <div class="col-sm-3">
                                        <label for="calle">Calle</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" required/>
                                            </div>
                                        </div>
                                  </div>

                                  <div class="col-sm-3">
                                        <label for="numExterior">Número Exterior</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="numExterior" name="numExterior" placeholder="Número Exterior"  onkeypress="return aceptNum(event)" onpaste="return false;"/>
                                            </div>
                                        </div>
                                  </div>
                                  <div class="col-sm-3">
                                        <label for="numInterior">Número Interior</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="numInterior" name="numInterior" placeholder="Número Interior" onkeypress="return aceptNum(event)" onpaste="return false;"/>
                                            </div>
                                        </div>
                                  </div>

                                  <div class="col-sm-3">
                                        <label for="codigoPostal">Código Postal</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Código Postal" disabled/>
                                            </div>
                                        </div>
                                  </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <label for="Nombre">Nombre de contacto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nomContacto" name="nomContacto" placeholder="Nombre de contacto" required/>
                                            </div>
                                        </div>
                                    </div>


                                     <div class="col-sm-3">
                                        <label for="email_address">Puesto de contacto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="puestoContacto" name="puestoContacto" placeholder="Puesto de contacto" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="email_address">Teléfono de contacto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="tel" class="form-control" id="telContacto" name="telContacto" placeholder="Teléfono de contacto" onkeypress="return aceptNum(event)" onpaste="return false;"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="email_address">Correo de contacto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" class="form-control" id="correoContacto" name="correoContacto" placeholder="Correo de contacto" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="email_address">Teléfono del inmueble</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="tel" class="form-control" id="telefonoInmueble" name="telefonoInmueble" placeholder="Teléfono del inmueble" required onkeypress="return aceptNum(event)" onpaste="return false;"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email_address">Correo del inmueble</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" class="form-control" id="correoInmueble" name="correoInmueble" placeholder="Correo del inmueble" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-1">
                                        <label for="email_address">Inicio de funcionamiento</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" id="horarioFuncionamientoInicio" name="horarioFuncionamientoInicio" placeholder="Horario" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="email_address">Fin de funcionamiento</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" id="horarioFuncionamientoFin" name="horarioFuncionamientoFin" placeholder="Horario" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="">¿Aplica atención a clientes?</label>
                                        <div class="form-group">
                                               <input type="checkbox" value="NoAplica" class="form-control" id="aplicaHorarioAtencion" onChange="habilitarAtencionClientes();" name="aplicaHorarioAtencion" placeholder="Horario" ><label for="aplicaHorarioAtencion"> No Aplica</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="email_address">Inicio de atención a clientes</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" id="horarioAtencionInicio" name="horarioAtencionInicio" placeholder="Horario" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="email_address">Fin de atención a clientes</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" id="horarioAtencionFin" name="horarioAtencionFin" placeholder="Horario" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="giroInmueble">Giro completo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="giroInmueble" name="giroInmueble" placeholder="Giro del inmueble" required/>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-2">
                                        <label for="latitud">Latitud</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud (Coordenadas)" readonly required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="longitud">Longitud</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud (Coordenadas)" readonly required/>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-2">
                                        <label for="longitud">Metros</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="Metros" name="Metros" placeholder="Metros (Coordenadas)" readonly required/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                      <div class="col-sm-2">
                                        <div class="form-line">
                                          <input type="button" id="obtener" class="btn bg-black waves-effect waves-light"value="Obtener mi ubicación">
                                         
                                        </div>
                                      </div>
                                </div>
                                    <div class="row">
                                        <div class="col-sm-4 col-md-offset-5">
                                            <div class="form-line">
                                                <input type="submit" class="btn bg-red waves-effect waves-light" value="Registrar">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-offset-5" id="cargando"></div>
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