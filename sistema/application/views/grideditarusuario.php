<?php 
  include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
<script type="text/javascript">
   window.onload = inicio;
    function inicio(){
        var idu = $("#idUser").val();
        //alert ("ejemplo"+idu);
          $.ajax({
        url : "<?php echo site_url('Crudusuarios/obtenerDatos')?>/" + idu,
        type: "get",
        dataType: "JSON",
        success: function(data)
        {
           
            
        $("#nickUser").val(data.nickName);
/*        $("#foto").val(data.Foto);*/
        //$("#tipo").val(data.tipo);
        $("#passwordUser").val(data.password);


        $("#rfcUser").val(data.rfcUser);
        $("#curpTrabajador").val(data.curpUser);
        $("#idArea").val(data.areaUser);
        $("#numeroOficin").val(data.telefonoOficina);
        $("#contaEmerge").val(data.ContactoEmergencia);
        $("#padeciUser").val(data.padecimientoUser);

        $("#DireccionUser").val(data.direccion);
        $("#telefonoUser").val(data.telefono);
        $("#correoUser").val(data.correo);
        $("#nombreUser").val(data.nombre);
        $("#tipoUser").val(data.tipo);
        $("#fotoBase").val(data.foto);

        var ruta="";
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
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudusuarios/modificarDatos/';?>";
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("form"));
    var nickUser=$("#nickUser").val();
    var correoUser=$("#correoUser").val();
    var idUser=$("#idUser").val();
    var parametros={nickUser:nickUser,correoUser:correoUser,idUser:idUser}

    $.ajax({
        url : "<?php echo site_url('Crudusuarios/verificarDatosEditados')?>/",
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
                 

                swal({
                      title: "Éxito",
                      text: "Datos modificados",
                      type: "success",
                     
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false
                    },
                    function(){
                      window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/Crudusuarios")
                    });
                 //$('#cargando').fadeIn(1000).html(data);
                  
                 
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
                                
                                Modifique los datos deseados
                            </h2>
                            
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                
                                <input type="hidden" id="idUser" name="idUser" value="<?php $idUser=$_REQUEST['id']; echo $idUser; ?>">
                                <input type="hidden" id="fotoBase" name="fotoBase">
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="nickUser">Nick de usuario</label>
                                                <input type="text" class="form-control" id="nickUser" name="nickUser" placeholder="Nick del Usuario" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="passwordUser">Password</label>
                                                <input type="password" id="passwordUser" name="passwordUser" class="form-control" placeholder="Password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="rfcUser">RFC</label>
                                                <input type="text" id="rfcUser" name="rfcUser" class="form-control" placeholder="RFC del trabajador" maxlength="13"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="curpTrabajador">CURP</label>
                                                <input type="text" id="curpTrabajador" name="curpTrabajador" class="form-control" placeholder="CURP del trabajador" maxlength="18"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="DireccionUser">Dirección</label>
                                                <input type="text" class="form-control" id="DireccionUser" name="DireccionUser" placeholder="Direccción del Usuario" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="telefonoUser">Teléfono</label>
                                                <input type="text" id="telefonoUser" name="telefonoUser" class="form-control" placeholder="Teléfono del usuario" onkeypress="return aceptNum(event)" onpaste="return false;"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="correoUser">Correo</label>
                                                <input type="email" id="correoUser" name="correoUser" class="form-control" placeholder="Correo del usuario" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="nombreUser">Nombre completo</label>
                                                <input type="text" class="form-control" id="nombreUser" name="nombreUser" placeholder="Nombre del Usuario" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                         <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                            <label for="tipoUser">Tipo de usuario</label>
                                               <select id="tipoUser" name="tipoUser" style="width: 100%; border: none;">
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
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="numeroOficin">Teléfono oficina</label>
                                                <input type="text" class="form-control" id="numeroOficin" name="numeroOficin" placeholder="Número de oficina" onkeypress="return aceptNum(event)" onpaste="return false;"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="contaEmerge">Contacto de emergencia</label>
                                                <input type="text" class="form-control" id="contaEmerge" name="contaEmerge" placeholder="Contacto en caso de emergencia" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="padeciUser">Padecimientos</label>
                                                <input type="text" class="form-control" id="padeciUser" name="padeciUser" placeholder="Padecimientos" />
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                    <div class="row">
                                        <div class="col-sm-4 col-md-offset-5">
                                            <div class="form-line">
                                                <input type="submit" class="btn bg-red waves-effect waves-light" value="Modificar">
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