<?php 
  include "header.php";
?>

<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
  $("#form").on("submit", function(e){

    //
        var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/assets/img/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudusuarios/altaUser/';?>";
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("form"));
    var nickUser=$("#nickUser").val();
    var correoUser=$("#correoUser").val();
    var parametros={nickUser:nickUser,correoUser:correoUser}
    $.ajax({
        url : "<?php echo site_url('Crudusuarios/verificarDatos')?>/",
        data:parametros,
        type: "post",
        dataType: "JSON",
        success: function(data)
        {
          if (data.cantidad>0)
           {
            swal("Error", "Nick de usuario o correo ya existe", "error");
           }else{
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
                  if(res==1)
                  {
                    swal({
                      title: "HECHO",
                      text: "El usuario se ha registrado exitosamente.",
                      type: "success",
                      showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false
                    },
                    function(){
                      window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/Crudusuarios")
                    });

                    
                 $('#cargando').fadeIn(1000).html(data);
                  
                 }
                 if(res==2)
                 {
                  swal("HECHO", "Usuario registrado, por favor cambie la fotografía.", "success")
                 }
                 
                });
           }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    //
    });
 });
</script>
    <section class="content">
        <div class="container-fluid">
        <div class="block-header">
                <a href="<?=site_url('Crudusuarios');?>">
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
                                
                                Ingrese los siguientes datos del usuario
                            </h2>
                            
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                              <!--   <h2 class="card-inside-title">Datos del Usuario </h2> -->
                                <div class="row clearfix">
									
									<!--<div class="col-sm-3">
										<label for="correoUser">Nick de usuario</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">account_circle</i>
											</span>
											<div class="form-line">
												<input type="text" class="form-control" id="nickUser" name="nickUser" placeholder="Nick del Usuario" required />
                                            </div>
										</div>
                                    </div>-->
								
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="nickUser">Nick de usuario</label>
                                                <input type="text" class="form-control" id="nickUser" name="nickUser" placeholder="Nick del Usuario" required />
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-3">
										<label for="correoUser">Password</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">lock</i>
											</span>
											<div class="form-line">
												<input type="password" id="passwordUser" name="passwordUser" class="form-control" placeholder="Password" required />
                                            </div>
										</div>
                                    </div>-->
									
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="passwordUser">Password</label>
                                                <input type="password" id="passwordUser" name="passwordUser" class="form-control" placeholder="Password" required />
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-3">
										<label for="correoUser">RFC</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">info</i>
											</span>
											<div class="form-line">
												<input type="text" id="rfcUser" name="rfcUser" class="form-control" placeholder="Ingrese su RFC" required maxlength="13"/>
                                            </div>
										</div>
                                    </div>-->
									
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="rfcUser">RFC</label>
                                                <input type="text" id="rfcUser" name="rfcUser" class="form-control" placeholder="Ingrese su RFC" required maxlength="13"/>
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-3">
										<label for="correoUser">CURP</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">info</i>
											</span>
											<div class="form-line">
												<input type="text" id="curpUser" name="curpUser" class="form-control" placeholder="Ingrese Curp" maxlength="18"/>
                                            </div>
										</div>
                                    </div>-->
									
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="curpUser">CURP</label>
                                                <input type="text" id="curpUser" name="curpUser" class="form-control" placeholder="Ingrese Curp" maxlength="18"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="DireccionUser">Dirección</label>
                                                <input type="text" class="form-control" id="DireccionUser" name="DireccionUser" placeholder="Direccción del Usuario" required/>
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-6">
										<label for="correoUser">Direccción</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">my_location</i>
											</span>
											<div class="form-line">
												<input type="text" class="form-control" id="DireccionUser" name="DireccionUser" placeholder="Direccción del Usuario" required/>
                                            </div>
										</div>
                                    </div>-->
									
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="telefonoUser">Teléfono</label>
                                                <input type="text" id="telefonoUser" name="telefonoUser" class="form-control" placeholder="Teléfono del Usuario" required onkeypress="return aceptNum(event)" onpaste="return false;"/>
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-3">
										<label for="correoUser">Teléfono</label>
										<div class="input-group">
											<span  class="input-group-addon">
												<i class="material-icons">call</i>
											</span>
											<div  class="form-line">
												<input type="text" id="telefonoUser" name="telefonoUser" class="form-control" placeholder="Teléfono del Usuario" required onkeypress="return aceptNum(event)"   onpaste="return false;"/>
											</div>
										</div>
                                    </div>-->
									
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="correoUser">Correo</label>
                                                <input type="text" id="correoUser" name="correoUser" class="form-control" placeholder="Correo del Usuario" required />
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-3">
										<b for="correoUser">Correo Electrónico</b>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">email</i>
											</span>
											<div class="form-line">
												<input type="text" id="correoUser" name="correoUser" class="form-control" data-inputmask="'mask': '{1,50}'" placeholder="Correo del Usuario" required />
											</div>
										</div>
                                    </div>-->
                                </div>

                                
                                <div class="row clearfix">
								
									<!--<div class="col-sm-3">
										<b for="correoUser">Nombre completo</b>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">perm_identity</i>
											</span>
											<div class="form-line">
												<input type="text" class="form-control" id="nombreUser" name="nombreUser" placeholder="Nombre completo del Usuario" required/>
                                            </div>
										</div>
                                    </div>-->
									
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="nombreUser">Nombre completo</label>
                                                <input type="text" class="form-control" id="nombreUser" name="nombreUser" placeholder="Nombre completo del Usuario" required/>
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-3">
										<label for="correoUser">Tipo de usuarios</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">recent_actors</i>
											</span>
											<div class="input-group" style="margin-top: 13px;">
											
												<div class="form-line">
													<select id="tipoUser" name="tipoUser" style="width: 100%; border: none;" required>
													<option value="">Seleccione Tipo</option>
													<option value="1">Administrador</option>
													<option value="2">Comercial</option>
													<option value="3">Coordinador</option>
													<option value="4">Análista de riesgo</option>
													<option value="5">Subgerente</option>
													<option value="6">Inside</option>
													<option value="7">Recursos Humanos</option>
													<option value="8">Cliente</option>
													<option value="9">Gerente</option>
													<option value="10">RRHH</option>
												</select> </div>
											</div>
										</div>
                                    </div>-->
									
                                    <div class="col-md-3">
                                        <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                            <label for="tipoUser">Tipo de usuario</label>
                                               <select id="tipoUser" name="tipoUser" style="width: 100%; border: none;" required>
                                                   <option value="">Seleccione Tipos</option>
                                                   <option value="1">Administrador</option>
                                                   <option value="2">Comercial</option>
                                                   <option value="3">Coordinador</option>
                                                   <option value="4">Análista de riesgo</option>
                                                   <option value="5">Subgerente</option>
                                                   <option value="6">Inside</option>
                                                   <option value="7">Recursos Humanos</option>
                                                   <option value="8">Cliente</option>
                                                   <option value="9">Gerente</option>
                                                   <option value="10">RRHH</option>
                                               </select>
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-3">
										<label for="idArea">Área</label>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">ballot</i>
											</span>
											<div class="input-group" style="margin-top: 13px;">
											<div class="form-line">
												
												<?php //if($areas): ?>
												<select id="idArea" name="idArea" style="width: 100%; border: none;" required>
													<option value="">Seleccione área</option>
													<?php //foreach($areas as $row): ?>
														<option value="<?//=$row['idArea']?>"><?//=$row['nombreArea']?></option>
													<?php //endforeach;?>   
												</select>
												<?php //endif;?>  
												</div>											
                                            </div>
										</div>
                                    </div>-->
									
                                    <div class="col-md-3">
                                        <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                            <label for="idArea">Área</label>
                                            <?php if($areas): ?>
                                               <select id="idArea" name="idArea" style="width: 100%; border: none;" required>
                                               <option value="">Seleccione área</option>
                                               <?php foreach($areas as $row): ?>
                                                   <option value="<?=$row['idArea']?>"><?=$row['nombreArea']?></option>
                                                <?php endforeach;?>   
                                               </select>
                                            <?php endif;?>   
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-3">
										<label for="correoUser">Foto</label>
										<div class="input-group">
											<span  class="input-group-addon">
												<i class="material-icons">add_photo_alternate</i>
											</span>
											<div  class="form-line">
												<input id="foto" name="foto" type="file" class="form-control"  />
                                            </div>
										</div>
                                    </div>-->
									
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
									<!--<div class="col-sm-4">
										<label for="correoUser">Teléfono oficina</label>
										<div class="input-group">
											<span  class="input-group-addon">
												<i class="material-icons">call</i>
											</span>
											<div  class="form-line">
												<input type="text" class="form-control" id="telefoOfici" name="telefoOfici" placeholder="Ingrese numero Oficina" onkeypress="return aceptNum(event)" onpaste="return false;"/>
                                            </div>
										</div>
                                    </div>-->
									
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="telefoOfici">Teléfono oficina</label>
                                                <input type="text" class="form-control" id="telefoOfici" name="telefoOfici" placeholder="Ingrese numero Oficina" onkeypress="return aceptNum(event)" onpaste="return false;"/>
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-4">
										<label for="correoUser">Contacto de emergencia</label>
										<div class="input-group">
											<span  class="input-group-addon">
												<i class="material-icons">contact_phone</i>
											</span>
											<div  class="form-line">
												<input type="text" class="form-control" id="contacEmergencia" name="contacEmergencia" placeholder="Contacto en caso de emergencia" required/>
                                            </div>
										</div>
                                    </div>-->
									
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="contacEmergencia">Contacto de emergencia</label>
                                                <input type="text" class="form-control" id="contacEmergencia" name="contacEmergencia" placeholder="Contacto en caso de emergencia" required/>
                                            </div>
                                        </div>
                                    </div>
									
									<!--<div class="col-sm-4">
										<b for="correoUser">Padecimientos</b>
										<div class="input-group">
											<span class="input-group-addon">
												<i class="material-icons">assignment</i>
											</span>
											<div class="form-line">
												<input type="text" class="form-control" id="padecimientoUser" name="padecimientoUser" placeholder="Padecimientos" required />
                                            </div>
										</div>
                                    </div>-->
									
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="padecimientoUser">Padecimientos</label>
                                                <input type="text" class="form-control" id="padecimientoUser" name="padecimientoUser" placeholder="Padecimientos" required />
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
                                    <div class="col-md-offset-5" id="cargando"></div>
                             </form>   
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </section>
   <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
   <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> 
    <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-inputmask/inputmask.min.js"></script>  
    <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-inputmask/jquery.inputmask.js"></script>  
      
    <script>
        var nav4 = window.Event ? true : false;
           function aceptNum(evt)
           {
               var key = nav4 ? evt.which : evt.keyCode;
               return (key <= 13 || (key>= 48 && key <= 57));
           }
		   
		$("#nickUser").inputmask("Regex", { regex: "[0123456789ñÑa-zA-Z ]*" });  
		$("#passwordUser").inputmask("Regex", { regex: "[0123456789ñÑa-zA-Z]*" });
		$("#rfcUser").inputmask("Regex", { regex: "[0123456789a-zA-Z]*" });
		$("#curpUser").inputmask("Regex", { regex: "[0123456789a-zA-Z]*" });
		//$("#curpUser").inputmask({"mask": "AAAA999999AAAAAA99"});
		$("#DireccionUser").inputmask("Regex", { regex: "[0123456789ñÑa-zA-Z.#/, ]*" });
		$("#telefonoUser").inputmask({"mask": "99-9999-9999"});
		$("#correoUser").inputmask('Regex', { regex: "[a-zA-Z0123456789-_.]+@[a-zA-Z]+\.[a-zA-Z]{5}+\.[a-zA-Z]{5}" });
		//$("#correoUser").inputmask({"mask": "[*]{10}@[\w][A]{10}.[A]{5}"})
		//$("#correoUser").inputmask({"mask": "[20{a-z}]@[10{a-z}]\.[3{a-z}]{2,4}"})
		//$("#correoUser").inputmask({"mask": "[]@9999.9999"});
		$("#nombreUser").inputmask("Regex", { regex: "[ñÑÁÉÍÓÚáéíóúa-zA-Z ]*" });
		$("#telefoOfici").inputmask({"mask": "99-9999-9999"});
		$("#contacEmergencia").inputmask("Regex", { regex: "[0123456789nÑa-zA-Z- ]*" });
		$("#padecimientoUser").inputmask("Regex", { regex: "[0123456789ñÑa-zA-Z., ]*" });
		
		
    </script> 
           
            <?php 
  include "footer.php";
?>