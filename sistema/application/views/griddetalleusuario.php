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
        //$("#fotoBase").val(data.foto);
        //Insertar la foto en su div correspondiente
        
        if(data.foto!="null")
        {
            
            var href="https://cointic.com.mx/preveer/sistema/assets/img/fotoUser/"+data.foto;   
            
        }
        else
        {
            var href="https://cointic.com.mx/preveer/sistema/assets/img/fotoUser/avatarperfil.jpg";
            
        }
        
        

        $("#divFoto").html($("<img>").attr("src", href).attr("width",120).attr("height",174));
        
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
                                
                                Datos actuales del usuario
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">mode_edit</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <?php 

                                                $idUser=$_REQUEST['id'];
                                                
                                                echo "<a href='https://cointic.com.mx/preveer/sistema/index.php/Crudusuarios/formEditarUsuario?id=$idUser'>Editar información</a>"; ?>

                                            <!-- <a href="https://cointic.com.mx/preveer/sistema/index.php/Crudusuarios/formAltaUsuario">Editar información</a> -->
                                        </li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                

                                <input type="hidden" id="idUser" name="idUser" value="<?php  echo $idUser; ?>">
                                <input type="hidden" id="fotoBase" name="fotoBase">
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="nickUser">Nick de usuario</label>
                                                <input type="text" class="form-control" id="nickUser" name="nickUser" placeholder="Nick del Usuario" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="passwordUser">Password</label>
                                                <input type="password" id="passwordUser" name="passwordUser" class="form-control" placeholder="Password" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="rfcUser">RFC</label>
                                                <input type="text" id="rfcUser" name="rfcUser" class="form-control" placeholder="RFC del trabajador" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="curpTrabajador">CURP</label>
                                                <input type="text" id="curpTrabajador" name="curpTrabajador" class="form-control" placeholder="CURP del trabajador" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="DireccionUser">Dirección</label>
                                                <input type="text" class="form-control" id="DireccionUser" name="DireccionUser" placeholder="Direccción del Usuario" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="telefonoUser">Teléfono</label>
                                                <input type="text" id="telefonoUser" name="telefonoUser" class="form-control" placeholder="Teléfono del usuario" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="correoUser">Correo</label>
                                                <input type="text" id="correoUser" name="correoUser" class="form-control" placeholder="Correo del usuario" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="nombreUser">Nombre completo</label>
                                                <input type="text" class="form-control" id="nombreUser" name="nombreUser" placeholder="Nombre del Usuario" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                         <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                            <label for="tipoUser">Tipo de usuario</label>
                                               <select id="tipoUser" name="tipoUser" style="width: 100%; border: none;" disabled>
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
                                               <select id="idArea" name="idArea" disabled style="width: 100%; border: none;" required>
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
                                            <label for="numeroOficin">Teléfono oficina</label>
                                                <input type="text" class="form-control" id="numeroOficin" name="numeroOficin" placeholder="Número de oficina" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>   
                                <div class="row">
                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="contaEmerge">Contacto de emergencia</label>
                                                <input type="text" class="form-control" id="contaEmerge" name="contaEmerge" placeholder="Contacto en caso de emergencia" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <label for="padeciUser">Padecimientos</label>
                                                <input type="text" class="form-control" id="padeciUser" name="padeciUser" placeholder="Padecimientos" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="col-sm-4">
                                        
                                            
                                                <label for="foto">Foto</label>
                                                <center><div id="divFoto"></center>
                                                    
                                                </div>
                                            
                                        
                                    </div>
                                </div> <!-- 
                                    <div class="row">
                                        <div class="col-sm-4 col-md-offset-5">
                                            <div class="form-line">
                                                <?php echo "<a href='https://cointic.com.mx/preveer/sistema/index.php/Crudusuarios/formEditarUsuario?id=$idUser'><input type='button' class='btn bg-red waves-effect waves-light' value='Editar información'></a>";?>
                                                
                                            </div>
                                        </div>
                                    </div> -->
                                
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