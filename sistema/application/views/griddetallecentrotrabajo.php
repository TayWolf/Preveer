<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
   window.onload=inicio;
    function inicio(){
        var idc = $("#idCentroTrabajo").val();
          $.ajax({
        url : "<?php echo site_url('CrudCentrosTrabajo/obtenerDatos')?>/" + idc,
        type: "get",
        dataType: "JSON",
        success: function(data)
        {

                $("#idFormato").val(data.idFormato);
                $("#inmueble").val(data.idInmueble);
                $("#nombreCentro").val(data.nombre);
                $("#idDet").val(data.idDet);

                $("#calle").val(data.calle);
                $("#estado").val(data.nombreEstado);
                $("#municipio").val(data.nombreMunicipio);
                $("#colonia").val(data.nombreRegion);
                $("#codigoPostal").val(data.cp);
                $("#numExterior").val(data.numeroExterior);
                $("#numInterior").val(data.numeroInterior);

                $("#nomContacto").val(data.nomContacto);    
                $("#puestoContacto").val(data.puestoContacto);
                $("#telContacto").val(data.telContacto);
                $("#correoContacto").val(data.email);

                $("#correoInmueble").val(data.correoInmueble);
                $("#telefonoInmueble").val(data.telefonoInmueble);

                $("#horarioFuncionamientoInicio").val(data.horarioFuncionamientoInicio);
                $("#horarioFuncionamientoFin").val(data.horarioFuncionamientoFin);

                $("#horarioAtencionInicio").val(data.horarioAtencionInicio);
                $("#horarioAtencionFin").val(data.horarioAtencionFin);
                $("#giroInmueble").val(data.giroInmueble);

                $("#latitud").val(data.latitud);
                $("#longitud").val(data.longitud);
                $("#Metros").val(data.metros);


                if(data.aplicaHorarioAtencion==1)
                {
                    $("#aplicaHorarioAtencion").prop("checked", true);
                }


                
/*        $("#foto").val(data.Foto);*/
        //$("#tipo").val(data.tipo);
        

        var ruta="";

        /*if(data.Foto=="null")
        {
        ruta= "https://bnmcontadorespublicos.com.mx/nominas/Content/assets/images/user/images.jpg";
        }
        else
        {
        ruta= "https://bnmcontadorespublicos.com.mx/nominas/Content/assets/images/user/"+data.Foto+"";
        }
*/
              
                // alert (data.nombreProyecto);  
          //$('#imagen').html("<img src='"+ruta+"' width='100' height='100' >");


              
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
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/modificarDatos/';?>";
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
                  
                 
                });

    });
 });
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
                                Detalle del centro de trabajo
                            </h2>
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                               
                                <input type="hidden" id="idCentroTrabajo" name="idCentroTrabajo" value="<?=$idCentroTrabajo?>">
                                <!-- datos fiscales -->
                                <div class="row clearfix">                       
                                    <div class="col-sm-3">
                                        <label for="Formato">Formato</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select id="idFormato" name="idFormato" style="width: 100%; border: none;color:#000;" required disabled>
                                                   <option value="0">Seleccione formato</option>
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
                                        <label for="Tipo de inmueble">Tipo de inmueble</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <select id="inmueble" name="inmueble" style="width: 100%; border: none;color:#000;" required disabled>
                                                   <option value="0">Seleccione inmueble</option>
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
                                        <label for="email_address">Nombre de centro de trabajo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nombreCentro" name="nombreCentro" placeholder="Nombre" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="email_address">IdDet</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="idDet" name="idDet" placeholder="IdDet" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-4">
                                    <label>Estado</label>
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                          <input id="estado" name="estado" class="form-control" placeholder="Estado" disabled>
                                          </input>
                                        </div>
                                      </div>
                                  </div>
                                 <div class="col-md-4">
                                    <label>Municipio o Delegación</label>
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                          <input class="form-control" id="municipio" name="municipio" type="text" placeholder="Municipio o Delegación" disabled>
                                          </input>
                                        </div>
                                      </div>
                                  </div>
                                 <div class="col-md-4">
                                    <label>Colonia</label>
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                          <input class="form-control" id="colonia" name="colonia" type="text" placeholder="Colonia" disabled>
                                          </input>
                                        </div>
                                      </div>
                                  </div>                                                                   
                                </div>
                                <div class="row clearfix">
                                  <div class="col-sm-3">
                                        <label for="calle">Calle</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" disabled/>
                                            </div>
                                        </div>
                                  </div>

                                  <div class="col-sm-3">
                                        <label for="numExterior">Número Exterior</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" class="form-control" id="numExterior" name="numExterior" placeholder="Número Exterior" disabled/>
                                            </div>
                                        </div>
                                  </div>
                                  <div class="col-sm-3">
                                        <label for="numInterior">Número Interior</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="numInterior" name="numInterior" placeholder="Número Interior" disabled/>
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
                                        <label for="email_address">Nombre de contacto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="nomContacto" name="nomContacto" placeholder="Nombre de contacto" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <label for="email_address">Puesto de contacto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="puestoContacto" name="puestoContacto" placeholder="Puesto de contacto" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <label for="email_address">Teléfono de contacto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="telContacto" name="telContacto" placeholder="Teléfono de contacto" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="email_address">Correo de contacto</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="correoContacto" name="correoContacto" placeholder="Correo de contacto" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="email_address">Teléfono del inmueble</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="tel" class="form-control" id="telefonoInmueble" name="telefonoInmueble" placeholder="Teléfono del inmueble" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email_address">Correo del inmueble</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" class="form-control" id="correoInmueble" name="correoInmueble" placeholder="Correo del inmueble" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-1">
                                        <label for="email_address">Inicio de funcionamiento</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" id="horarioFuncionamientoInicio" name="horarioFuncionamientoInicio" placeholder="Horario" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="email_address">Fin de funcionamiento</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" id="horarioFuncionamientoFin" name="horarioFuncionamientoFin" placeholder="Horario" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="">¿Aplica atención a clientes?</label>
                                        <div class="form-group">
                                            <input type="checkbox" value="NoAplica" class="form-control" id="aplicaHorarioAtencion" disabled onChange="habilitarAtencionClientes();" name="aplicaHorarioAtencion" placeholder="Horario" ><label for="aplicaHorarioAtencion"> No Aplica</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="email_address">Inicio de atención a clientes</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" id="horarioAtencionInicio" name="horarioAtencionInicio" placeholder="Horario" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="email_address">Fin de atención a clientes</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="time" class="form-control" id="horarioAtencionFin" name="horarioAtencionFin" placeholder="Horario" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="giroInmueble">Giro completo</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="giroInmueble" name="giroInmueble" placeholder="Giro del inmueble" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <label for="latitud">Latitud</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud (Coordenadas)" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="longitud">Longitud</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud (Coordenadas)" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-3">
                                        <label for="longitud">Metros</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="Metros" name="Metros" placeholder="Metros (Coordenadas)" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                      
                                </div>
                         
                                <div class="row">
                                        <div class="col-sm-4 col-md-offset-5">
                                            <div class="form-line">
                                                <?php echo "<a href='https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/formEditarCentroTrabajo/$idCentroTrabajo'><input type='button' class='btn bg-black waves-effect waves-light' value='Editar información'></a>"; ?>
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