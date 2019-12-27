<?php
include "header.php";
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- DataTable -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

    <style>
      #listaOrdenacion { list-style-type: none; margin: 0; padding: 0; width: 100%; }
      #listaOrdenacion li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.2em; height: 18px; }
      #listaOrdenacion li span { position: absolute; margin-left: -1.3em; }
     </style>
<script type="text/javascript">

    $(function(){
  $("#form").on("submit", function(e){
    var url;
    $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/assets/img/loading.gif"/>');
    url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/altaTablaPlantilla/';?>";
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
                    swal({
                      title: "HECHO",
                      text: "Tabla se ha registrado exitosamente.",
                      type: "success",
                      //showCancelButton: true,
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false
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
                <?php $tipo=$this->session->userdata('tipoUser');
                if($tipo!='' && $_SESSION['idusuariobase'] != '')
                {
                    if($tipo == 1){
                        echo "<a href='".site_url('RiesgoAcuse')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    } elseif($tipo == 2){
                        echo "<a href='".site_url('menus')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    }
                }

                ?>
            </div>
            <form id="form" method="post"></form>
            <div class="row clearfix">
                <div class="block-header">
                <a href="<?=site_url('CrudPlantillas');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
                </a>
        </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header">
                            <h2>Indique si esta plantilla cuenta con registro de tablas</h2>
                            <input type="hidden" form="form"  id="idPlantilla" name="idPlantilla" value="<?php echo $plantilla; ?>" />
                            <input type="hidden" form="form"  id="cantidadTablas" name="cantidadTablas" />
                        </div>
                        <div class="body table-responsive">
                            <button type="button" onclick="agregarTable()" class="btn btn-danger waves-effect">
                                    <i class="material-icons">add_circle</i>
                                    <span>Agregar Tabla</span>
                                </button>
                        </div>
                       
                    </div>
                    <div id="listadoTables">
                        
                    </div>
                    <div class="row" align="center">
                        <input type="submit" class="btn btn-danger waves-effect" form="form" value="Aceptar">  
                    </div>
                </div>
            </div>
        </div>
    </section>
<script type="text/javascript">
   
    
    function getAcordeones(i){
        var idFormm=$("#idFormm"+i).val();
        var esInicio=$("#cambioFomrulario"+i).val();
        if (esInicio==1)
         {
            $("#idAcord"+i).html('');
         $.ajax({
                        url : "<?php echo site_url('CrudPlantillas/getCordeonesUni/')?>" + idFormm,
                        type: "post",
                        dataType: "JSON",
                        success: function(data)
                        {
                            $("#idAcord"+i).html('');
                           $("#idAcord"+i).append('<option value ="">Seleccione una opción</option>');
                            if (data.length>0)
                             {
                                for (ie=0; ie< data.length; ie++) {
                                  $("#idAcord"+i).append(new Option(data[ie]['nombreAcordeon'],data[ie]['idAcordeon']));
                                    }   
                                $("#formularioSeleccionado"+i).val($("#idFormm"+i).val());
                                $("#cambioAcordeon"+i).val("1");
                            }
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                           //$("#formm").hide(); //alert('Error get data from ajax');
                           $("#idAcord"+i).append('<option value ="">Seleccione una opción</option>');
                        }
                    });
         $("#cambioFomrulario"+i).val("0");

         }else{
             swal({
              title: "Aviso!",
              text: "¡Si cambia el tipo de formulario, se perdera los datos cargados!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Si cambiar",
              closeOnConfirm: false
            },
            function(isConfirm){
                if (isConfirm)
                    {
                        //$("#nombreColumna").val('');
                      //$("#indicad").val('');
                      $("#indicadorColumna"+i).html('');
                      //$("#idAcord"+i).html('');
                 $.ajax({
                        url : "<?php echo site_url('CrudPlantillas/getCordeones/')?>" + idFormm,
                        type: "post",
                        dataType: "JSON",
                        success: function(data)
                        {
                            $("#idAcord"+i).html('');
                           $("#idAcord"+i).append('<option value ="">Seleccione una opción</option>');
                            if (data.length>0)
                             {
                                for (ie=0; ie< data.length; ie++) {
                                  $("#idAcord"+i).append(new Option(data[ie]['nombreAcordeon'],data[ie]['idAcordeon']));
                                    }   
                                  $("#formularioSeleccionado"+i).val($("#idFormm"+i).val());
                                   $("#cambioAcordeon"+i).val("1");
                            }
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                           //$("#formm").hide(); //alert('Error get data from ajax');
                           $("#idAcord"+i).append('<option value ="">Seleccione una opción</option>');
                        }
                    });
                       swal.close()
                   }else{
                    $("#idFormm"+i).val($("#formularioSeleccionado"+i).val());
                   
                   }
              
            });
           
         }
                    
        } 
var con=0;


function getIndicador(x)
    {
     var cambioAcordeon=$("#cambioAcordeon"+x).val();
      var idAcord=$("#idAcord"+x).val();
      if (cambioAcordeon==1) {
                $("#AcordeonSeleccionado"+con).val($("#idAcord"+con).val());    
                $("#cambioAcordeon"+x).val("0");
        }else{
            swal({
              title: "Aviso!",
              text: "¡Si cambia el tipo de acordeon, se perdera los datos cargados!",
              type: "warning",
              showCancelButton: true,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Si cambiar",
              closeOnConfirm: false
            },
            function(isConfirm){
                if (isConfirm)
                    {
                        $("#indicadorColumna"+x).html('');
                    $("#AcordeonSeleccionado"+x).val($("#idAcord"+x).val());  
                       swal.close()
                   }else{
                   $("#idAcord"+con).val($("#AcordeonSeleccionado"+con).val());
                    
                   }
              
            });

        }
      
    }

function agregarColumna(x)
{
   var conIndicador=$("#contadorIndicador"+x).val();
   var idAcord=$("#idAcord"+x).val();
   $("#indicadorColumna"+x).append('<div class="row" id="rowColumna'+conIndicador+'-'+x+'">'+
                               '<div class="col-md-6">'+
                                   '<div class="form-group">'+
                                        '<div class="form-line">'+
                                            '<label for="nickUser">Nombre de la columna</label>'+
                                                '<input type="text" form="form" class="form-control" id="tabla'+x+'NombreColumna'+conIndicador+'" name="tabla'+x+'NombreColumna'+conIndicador+'" placeholder="Ingrese el nombre de la columna"  required />'+
                                        '</div>'+
                                    '</div>'+  
                               '</div>'+
                               '<div class="col-md-4">'+
                                        '<div class="form-group form-float" style="margin-top: 13px;">'+
                                                '<div class="form-line">'+
                                                '<label for="nickUser">Indicador: </label>'+
                                                   '<select id="tabla'+x+'indicad'+conIndicador+'" name="tabla'+x+'indicad'+conIndicador+'" form="form"  style="width: 100%; border: none;" required >'+
                                                       
                                                   '</select>'+
                                                '</div>'+
                                         '</div>'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                        '<span class="input-group-addon" style="background-color: #fff;border: 1px solid #fff;"><i class="fa fa-trash" style="cursor: pointer;" onclick="quitarColumna('+conIndicador+','+x+')"></i></span>'+
                                '</div>'+
                           '</div>');

   $.ajax({
                        url : "<?php echo site_url('CrudPlantillas/getIndocador/')?>" + idAcord,
                        type: "post",
                        dataType: "JSON",
                        success: function(data)
                        {
                            
                           $("#tabla"+x+"indicad"+conIndicador).append('<option value ="">Seleccione una opción</option>');
                            if (data.length>0)
                             {

                                for (ie=0; ie< data.length; ie++) {
                                
                                  $("#tabla"+x+"indicad"+conIndicador).append(new Option(data[ie]['nombreIndicador'],data[ie]['idIndicador']));
                                    }   
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                           //$("#formm").hide(); //alert('Error get data from ajax');
                           $("#tabla"+x+"indicad"+conIndicador).append('<option value ="">Seleccione una opción</option>');
                        }
                    });

    $("#contadorIndicador"+x).val(parseInt($("#contadorIndicador"+x).val())+1);
   // getIndicador();
}

function quitarColumna(i,x){
$("#rowColumna"+i+"-"+x).html('');
}
var conTabla=0;

function agregarTable()
{
$("#listadoTables").append('<div id="listadTa'+conTabla+'">'+
                            '<div class="card" >'+
                            '<div class="row" align="right">'+
                                  '<div class="col-md-12" >'+
                                      '<button type="button" onclick="quitarTable('+conTabla+')" class="btn btn-danger waves-effect">'+
                                            '<i class="material-icons">delete_forever</i>'+
                                            '<span>Quitar Tabla</span>'+
                                        '</button>'+
                                  '</div>'+

                              '</div>'+
                        '<div class="body table-responsive">'+
                           '<div class="row">'+
                               '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<div class="form-line">'+
                                            '<label for="nickUser">Nombre de la tabla</label>'+
                                                '<input type="text" form="form" class="form-control" id="nombreTabla'+conTabla+'" name="nombreTabla'+conTabla+'" placeholder="Ingrese el nombre de la tabla"  required />'+
                                        '</div>'+
                                    '</div> '+  
                               '</div>'+
                               '<div class="col-md-4">'+
                                        '<div class="form-group form-float" style="margin-top: 13px;">'+
                                            '<div class="form-line">'+
                                            '<label for="tipoUser">Formulario</label>'+
                                            
                                            '<input type="hidden" form="form"  id="contadorIndicador'+conTabla+'" name="contadorIndicador'+conTabla+'" value="0" />'+
                                                '<input type="hidden"  id="cambioFomrulario'+conTabla+'" name="cambioFomrulario'+conTabla+'" value="1" />'+
                                                '<input type="hidden"   id="cambioAcordeon'+conTabla+'" name="cambioAcordeon'+conTabla+'" value="1" />'+
                                                '<input type="hidden"  id="formularioSeleccionado'+conTabla+'" name="formularioSeleccionado'+conTabla+'" />'+
                                                '<input type="hidden" form="form"  id="AcordeonSeleccionado'+conTabla+'" name="AcordeonSeleccionado'+conTabla+'" />'+
                                               '<select id="idFormm'+conTabla+'" name="idFormm'+conTabla+'" form="form" onchange="getAcordeones('+conTabla+')" style="width: 100%; border: none;" required>'+
                                                   '<option value="">Seleccione una opción</option>'+
                                                       
                                               '</select>'+
                                            '</div>'+
                                        '</div>'+
                                '</div>'+
                                '<div class="col-md-3">'+
                                    '<div class="form-group form-float" style="margin-top: 13px;">'+
                                        '<div class="form-line">'+
                                            '<label for="nickUser">Del acordeón: </label>'+
                                            '<select id="idAcord'+conTabla+'" name="idAcord'+conTabla+'" form="form" onchange="getIndicador('+conTabla+')" style="width: 100%; border: none;" required>'+
                                            '</select>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                
                           '</div>'+
                            '<div class="row">'+
                                '<div class="col-md-6">'+
                                    '<h4>Columnas</h4>'+
                               '</div>'+
                               '<div class="col-md-6">'+
                                    '<button onclick="agregarColumna('+conTabla+')" type="button" class="btn btn-danger waves-effect">'+
                                        '<i class="material-icons">add_circle</i>'+
                                        '<span>Agregar Columna</span>'+
                                    '</button>'+
                               '</div> '+
                            '</div> '+   
                          
                           
                           '<div id="indicadorColumna'+conTabla+'">'+
                           '</div>'+
                        '</div>'+
                    '</div>'+
                    '</div>');
getFomrulariosCarga(conTabla)
conTabla++
$("#cantidadTablas").val(conTabla);
}

function quitarTable(i)
{
    $("#listadTa"+i).html('');
}

function getFomrulariosCarga(xx){
       $.ajax({
                        url : "<?php echo site_url('CrudPlantillas/getForm/')?>" ,
                        type: "post",
                        dataType: "JSON",
                        success: function(data)
                        {
                            
                           $("#idFormm"+xx).append('<option value ="">Seleccione una opción</option>');
                            if (data.length>0)
                             {
                                for (ie=0; ie< data.length; ie++) {
                                  $("#idFormm"+xx).append(new Option(data[ie]['nombreFormulario'],data[ie]['idControl']));
                                    }         
                            }

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                           //$("#formm").hide(); //alert('Error get data from ajax');
                           $("#idFormm"+xx).append('<option value ="">Seleccione una opción</option>');
                        }
                    });
    }




</script>
<?php
include "footer.php";
?>