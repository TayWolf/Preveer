<?php
include "header.php";
?>
<style type="text/css">
    .centrico{
        text-align: center;
    }

    .completo
    {
        background-color: #92d050;
    }
    .completo>option
    {
        background-color: white;
    }

    .incompleto
    {
        background-color: #ffff00;
    }
    .incompleto>option
    {
        background-color: white;
    }

    .noAplica
    {
        background-color: #c6efce;
    }
    .noAplica>option
    {
        background-color: white;
    }
    .noCuenta
    {
        background-color: #e6b8b7;
    }
    .noCuenta>option
    {
        background-color: white;
    }


</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    var array = {
             'datosBitacora': []
            };
   var arregloJson;
    var porcentajeAvanceGeneral=0;
    $(function(){
        $("#form").on("submit", function(e){
            var qq = $('#form').serialize()
            //var formData = new FormData(document.getElementById("form"));
            // alert("datos"+qq);
            var url;
            var total = $("#tot").val();
            var idOti = $("#idOti").val();
             var normaHi = $("#normaHi").val();

            //url : "https://cointic.com.mx/CDI/Panel/index.php/Crudordencompra/agregaOrdenc/"+total;
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudcheklist/guardarDocto/';?>"+total+"/"+porcentajeAvanceGeneral;
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
                    console.log(res);
                    swal({
                            title: "Éxito",
                            text: "Se ha registrado lista de indicadores para la norma "+normaHi,
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){
                            location.reload();
                           // location.href='https://cointic.com.mx/preveer/sistema/index.php/Crudcheklist/verificacionControlcalidad/'+$("#idAsigna").val()+"/"+idOti;

                        });

                });

        });
    });
</script>
<script type="text/javascript">
    window.onload=function ()
    {
        var evaluacionesExistentes=<?php echo json_encode($evaluaciones);?>;
        //console.log(evaluacionesExistentes);

        for(i=0; i<evaluacionesExistentes.length; i++)
        {
            //alert()
            $("#idident"+evaluacionesExistentes[i]['idDocumentoSTPS']).val(evaluacionesExistentes[i]['idPonderador']);
            colorear(evaluacionesExistentes[i]['idDocumentoSTPS']);
            $("#comet"+evaluacionesExistentes[i]['idDocumentoSTPS']).val(evaluacionesExistentes[i]['comentario']);
        }
        hacerCuenta();
    }
</script>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php $tipo=$this->session->userdata('tipoUser');
            if($tipo!='' && $_SESSION['idusuariobase'] != '')
            {
                if($tipo == 3){
                    echo "<a href='".site_url('CrudOti/coordinador')."/".$this->session->userdata('idusuariobase')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } else{
                   /*echo "<a href='".site_url('CrudOti/listCentroTrabajo/'.$idOti)."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";*/
                }
            }

            ?>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            HIDRANTES
                        </h2>
                        
                    </div>
                    <div class="body table-responsive">
                        <!-- <form method="post" action="" id="form"   enctype="multipart/form-data"> -->
                            <input type="hidden" id="idAsigna" name="idAsigna" value="<?=$idAsignacion?>">
                            
                            <table class="table table-bordered table-hover">
                                
                                <thead>
                                <tr>
                                    <th colspan="4" class="centrico">Bitácora de revisión mensual de hidrantes</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ubicación</td>
                                        <td><input type="text" id="ubics" name="ubics" class="form-control" placeholder="Ingrese ubicación"></td>
                                    </tr>
                                    <tr>
                                        <td>Cuenta con numeración</td>
                                        <td>
                                            <select class="form-control" id="snNumeracion" name="snNumeracion">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Obtruido</td>
                                         <td>
                                            <select class="form-control" id="snObtruido" name="snObtruido">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Señalamiento</td>
                                         <td>
                                            <select class="form-control" id="snsenalamiento" name="snsenalamiento">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Edo. Gabinete</td>
                                         <td>
                                            <select class="form-control" id="snGabinete" name="snGabinete">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Manómetro</td>
                                         <td>
                                            <select class="form-control" id="snManometro" name="snManometro">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Manguera</td>
                                         <td>
                                            <select class="form-control" id="snManguera" name="snManguera">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Válvula</td>
                                         <td>
                                            <select class="form-control" id="snValvula" name="snValvula">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cople de válvula</td>
                                         <td>
                                            <select class="form-control" id="snValvulaCople" name="snValvulaCople">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cristales o micas del gabinete/bolsa en buen estado</td>
                                         <td>
                                            <select class="form-control" id="snCristales" name="snCristales">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sistema de cierre</td>
                                         <td>
                                            <select class="form-control" id="snCierre" name="snCierre">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                     
                                    <tr>
                                        <td>Identificación de seguridad para operación</td>
                                         <td>
                                            <select class="form-control" id="snOperacion" name="snOperacion">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dobles de manguera</td>
                                         <td>
                                            <select class="form-control" id="snDoblemanguera" name="snDoblemanguera">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>LLave de acomple</td>
                                         <td>
                                            <select class="form-control" id="snAcople" name="snAcople">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hacha de pico</td>
                                         <td>
                                            <select class="form-control" id="snPico" name="snPico">
                                                <option value="">Selecione una opción</option>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                                <option value="3">N/A</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Observaciones</td>
                                        <td><input type="text" class="form-control" id="observacionesHidrante" name="observacionesHidrante"></td>
                                    </tr>
                                </tbody>
                                

                            </table>
                            <div class="row">
                                     <div align="center">
                                        <button class="btn bg-red waves-effect waves-light" onclick="agregarReBitacora()">Agregar</button>
                                    </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr style="background-color:#fff;
                                    ">
                                    <th class="centrico">Parametros</th>
                                    <th class="centrico">Aceptado</th>
                                    <th class="centrico">Observaciones</th>
                                    <th class="centrico">Eliminar</th>
                                </tr>

                                </thead>
                            </table>
                            <div align="center">
                                <input type="submit"  class="btn bg-red waves-effect waves-light"  value="Aceptar">
                            </div>
                       <!--  </form> -->
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

<script type="text/javascript">
    var totalCompletos=0;
    var totalIncompletos=0;
    var totalNoAplica=0;
    var totalNoCuenta=0;



    function colorear(identificador)
    {
        $("#idident"+identificador).removeClass();
        if($("#idident"+identificador).val()==1)
        {
            $("#idident" + identificador).toggleClass("completo");
        }
        else if($("#idident"+identificador).val()==2)
        {
            $("#idident" + identificador).toggleClass("incompleto");
        }
       
        else if($("#idident"+identificador).val()==3)
        {
            $("#idident" + identificador).toggleClass("noAplica");
        }
        //hacerCuenta();
    }

    function hacerCuenta()
    {
        totalCompletos=0;
        totalIncompletos=0;
        totalNoAplica=0;
        for(i=0; i<<?php echo $contador;?>; i++)
        {

            switch ($('[name=idident'+i+']').val())
            {
                case "1":
                    totalCompletos++;
                    break;
                case "2":
                    totalIncompletos++;
                    break;
                case "3":
                    totalCompletos++;
                    break;
                default:
                    totalIncompletos++;
                    break;
            }

        }

        if(<?php echo $contador?>-totalNoAplica!=0)
            porcentajeAvanceGeneral=(totalCompletos/(<?php echo $contador;?> - totalNoAplica))*100;
        porcentajeAvanceGeneral=Math.round(porcentajeAvanceGeneral * 100) / 100;
        if(porcentajeAvanceGeneral<25)
        {
            $("#porcentajeEvaluacion").css("color", "red");
        }
        else if(porcentajeAvanceGeneral<50)
        {
            $("#porcentajeEvaluacion").css("color", "darkorange");
        }
        else if(porcentajeAvanceGeneral<75)
        {
            $("#porcentajeEvaluacion").css("color","gold");
        }
        else if(porcentajeAvanceGeneral<=100)
        {
            $("#porcentajeEvaluacion").css("color", "green");
        }
        $("#porcentajeEvaluacion").html(porcentajeAvanceGeneral);


    }

    function agregarReBitacora()
   {
        var snNumeracion=$("#snNumeracion").val();
        var ubics=$("#ubics").val();
        var snObtruido=$("#snObtruido").val();
        var snsenalamiento=$("#snsenalamiento").val();
        var snGabinete=$("#snGabinete").val();
        var snManometro=$("#snManometro").val();
        var snManguera=$("#snManguera").val();
        var snValvula=$("#snValvula").val();
        var snValvulaCople=$("#snValvulaCople").val();
        var snCristales=$("#snCristales").val();
        var snCierre=$("#snCierre").val();
        var snOperacion=$("#snOperacion").val();
        var snDoblemanguera=$("#snDoblemanguera").val();
        var snAcople=$("#snAcople").val();
        var snPico=$("#snPico").val();
        var observacionesHidrante=$("#observacionesHidrante").val();

if (snNumeracion==1){
    var snNumeracion="SI";
}
if (var snNumeracion==2){
    var snNumeracion="NO";
}
if (var snNumeracion==3){
    var snNumeracion="N/A";
}
if (ubics==1){ubics="SI";}if (ubics==2){ubics="NO";}if (ubics==3){ubics="N/A";}
if (snObtruido==1){snObtruido="SI";}if (snObtruido==2){snObtruido="NO";}if (snObtruido==3){snObtruido="N/A";}
if (snsenalamiento==1){snsenalamiento="SI";}if (snsenalamiento==2){snsenalamiento="NO";}if (snsenalamiento==3){snsenalamiento="N/A";}
    if (snGabinete==1){snGabinete="SI";}if (snGabinete==2){snGabinete="NO";}if (snGabinete==3){snGabinete="N/A";}
    if (snManometro==1){snManometro="SI";}if (snManometro==2){snManometro="NO";}if (snManometro==3){snManometro="N/A";}
    if (snManguera==1){snManguera="SI";}if (snManguera==2){snManguera="NO";}if (snManguera==3){snManguera="N/A";}
    if (snValvula==1){snValvula="SI";}if (snValvula==2){snValvula="NO";}if (snValvula==3){snValvula="N/A";}
    if (snValvulaCople==1){snValvulaCople="SI";}if (snValvulaCople==2){snValvulaCople="NO";}if (snValvulaCople==3){snValvulaCople="N/A";}
    if (snCristales==1){snCristales="SI";}if (snCristales==2){snCristales="NO";}if (snCristales==3){snCristales="N/A";}
    if (snCierre==1){snCierre="SI";}if (snCierre==2){snCierre="NO";}if (snCierre==3){snCierre="N/A";}
    if (snOperacion==1){snOperacion="SI";}if (snOperacion==2){snOperacion="NO";}if (snOperacion==3){snOperacion="N/A";}
    if (snDoblemanguera==1){snDoblemanguera="SI";}if (snDoblemanguera==2){snDoblemanguera="NO";}if (snDoblemanguera==3){snNumeracion="N/A";}
     if (snAcople==1){snAcople="SI";}if (snAcople==2){snAcople="NO";}if (snAcople==3){snAcople="N/A";}
     if (snPico==1){snPico="SI";}if (snPico==2){snPico="NO";}if (snPico==3){snPico="N/A";}


       // var idColindancia=$("#idColindancia").val();
        if (snNumeracion!="" && ubics!="" && snObtruido!="" && snsenalamiento!="" && snGabinete!="" && snManometro!=""&& snManguera!=""&& snValvula!=""&& snValvulaCople!=""&& snCristales!=""&& snCierre!=""&& snOperacion!=""&& snDoblemanguera!=""&& snAcople!=""&& snPico!="")
         {
             array.datosBitacora.push({'snNumeracion':snNumeracion,'ubics': ubics,'snObtruido': snObtruido,'snsenalamiento': snsenalamiento,'snGabinete':snGabinete,'snManometro':snManometro,'snManguera':snManguera,'snValvula':snValvula,'snValvulaCople':snValvulaCople,'snCristales':snCristales,'snCierre':snCierre,'snOperacion':snOperacion,'snDoblemanguera':snDoblemanguera,'snAcople':snAcople,'snPico':snPico,'observacionesHidrante':observacionesHidrante});

             $("#listadoAntecendente").append('<tr>'+
                                                  '<td>'+ubics+'</td>'+
                                                  '<td>'+snNumeracion+'</td>'+
                                                  '<td>'+snObtruido+'</td>'+
                                                  '<td>'+snsenalamiento+'</td>'+
                                                  '<td>'+snGabinete+'</td>'+
                                                  '<td>'+snManometro+'</td>'+
                                                  '<td>'+snManguera+'</td>'+
                                                  '<td>'+snValvula+'</td>'+
                                                  '<td>'+snValvulaCople+'</td>'+
                                                  '<td>'+snCristales+'</td>'+
                                                  '<td>'+snCierre+'</td>'+
                                                  '<td>'+snOperacion+'</td>'+
                                                  '<td>'+snDoblemanguera+'</td>'+
                                                  '<td>'+snAcople+'</td>'+
                                                  '<td>'+snPico+'</td>'+
                                                  '<td>'+observacionesHidrante+'</td>'+
                                                  '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                                              '</tr>');
             //limpiacampos();
         }else{
            alert("aler")
         }
   }
</script>

<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->