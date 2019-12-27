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
        background-color: red;
    }
    .incompleto>option
    {
        background-color: white;
    }

    .noAplica
    {
        background-color: grey;
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
                        });

                });

        });
    });
</script>
<script type="text/javascript">
    window.onload=function ()
    {
        var evaluacionesExistentes=<?php echo json_encode($evaluaciones);?>;

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
                    echo "<a href='javascript:history.go(-1)'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } else{
                    echo "<a href='javascript:history.go(-1)'>
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
                            Lista de indicadores para la norma
                            <?php
                            foreach ($doctosEdo as $row)
                            {
                            	$nombreNorma=$row['nombre'];
                                echo $row['nombre'];
                                break;
                            }?>

                        </h2>
                        <div class="container">
                            <div class="col-xs-12" style="display: flex;justify-content: flex-end;">Porcentaje: %<label id="porcentajeEvaluacion"></label></div>
                        </div>
                        <div class="row clearfix">
                            <div style="display: flex; padding: 10px" class="col-xs-6 col-sm-3 col-sm-offset-1">
                                <button class="btn btn-secondary btn-lg" type="button" style=" background: #92d050;"></button>
                                <span>Cumple</span>
                            </div>
                            <div style="display: flex; padding: 10px" class="col-xs-6 col-sm-4">
                                <button class="btn btn-secondary btn-lg" type="button" style=" background: red;"></button>
                                <span>No cumple</span>
                            </div>

                            <div style="display: flex; padding: 10px" class="col-xs-12 col-sm-4">
                                <button class="btn btn-secondary btn-lg" type="button" style=" background: grey;"></button>
                                <span>No aplica</span>
                            </div>
                        </div>
                    </div>
                    <div class="body table-responsive">
                        <form method="post" action="" id="form"   enctype="multipart/form-data">
                            <input type="hidden" id="idAsigna" name="idAsigna" value="<?=$idAsignacion?>">
                            <input type="hidden" id="idCentroTrabajo" name="idCentroTrabajo" value="<?=$idCentroTrabajo?>">
                            <input type="hidden" id="idOti" name="idOti" value="<?=$idOti?>">
                            <input type="hidden" id="idSubservicio" name="idSubservicio" value="<?=$idSubservicio?>">
                            <table class="table table-bordered table-hover">
                                <col width="500">
                                <col width="25">
                                <col width="275">
                                <thead>
                                <tr style="background-color:#fff;
                                    ">
                                    <th class="centrico">Indicador</th>
                                    <th class="centrico">Tipo de verificación</th>
                                    <th class="centrico">PT</th>
                                    <th class="centrico">Observaciones</th>
                                </tr>

                                </thead>
                                <thead>
                                <tr>
                                    <th colspan="4" class="centrico">Anexos de la norma  </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador=0;

                                foreach ($doctosEdo as $row) {

                                    $nombreDocumento=$row["texto"];
                                    // if(strlen($nombreDocumento)>128)
                                    // {
                                    //     $nombreDocumento=substr($nombreDocumento, 0, 128)."...";
                                    // }
                                    $idDocumentos=$row["idDocSTPS"];
                                    $tipoV = $row["tipo"];
                                    if($tipoV == 1){
                                        $tipoverificacion="Física";
                                    } elseif($tipoV == 2){
                                        $tipoverificacion="Documental";
                                    }elseif($tipoV == 3){
                                        $tipoverificacion="Entrevista";
                                    }elseif($tipoV == 4){
                                        $tipoverificacion="Registral";
                                    }elseif($tipoV == 5){
                                        $tipoverificacion="Documental y Física";
                                    }elseif($tipoV == 6){
                                        $tipoverificacion="Entrevista y Física";
                                    }elseif($tipoV == 7){
                                        $tipoverificacion="Documental, Entrevista y Física";
                                    }elseif($tipoV == 8){
                                        $tipoverificacion="Documental y Entrevista";
                                    }
                                     elseif($tipoV == 9){
                                        $tipoverificacion="Documental e Interrogatorio";
                                    }


                                    echo "
                                            <tr>
                                                <td style='padding-bottom: 0px;'><input type='hidden' name='documento$contador' value='$idDocumentos'><p>$nombreDocumento</p></td>
                                                <td style='padding-bottom: 0px;'>$tipoverificacion</td>
                                                <td style='padding-bottom: 0px; text-align: center'>
                                                    <select onChange='colorear($idDocumentos); hacerCuenta();' name='idident$contador' id='idident$idDocumentos' class='form-control'>
                                                        <option value=''>Seleccione un valor</option>
                                                        ";
                                    foreach ($ponderadores as $options)
                                    {
                                        echo "<option value='".$options['valorPond']."'>".$options['NombrePonde']."</option>";
                                    }
                                    echo"             </select>
                                                
                                                <label for='idident$contador' ></label>
                                                </td>
                                                <td style='padding-bottom: 0px;'>
                                                <div class='form-group' style='margin-bottom: 0px;'>
                                                    <div class='form-line'>
                                                        <input type='text' id='comet$idDocumentos' name='comet$contador' placeholder='Comentarios' class='form-control' />
                                                    </div>
                                                </div>
                                                </td>                                         
                                            </tr>";
                                    $contador++;
                                    //Este código es util para probar la formula
                                    //if($contador>3)
                                      // break;
                                }

                                echo "<input type='hidden' id='tot' name='tot' value='$contador'>";
                                echo "<input type='hidden' id='normaHi' name='normaHi' value='";echo $row['nombre']; echo "'>";
                                ?>
                                </tbody>


                            </table>
                            <div align="center" class="col-sm-12">
                                <div class="col-sm-offset-3 col-sm-2" align="center">
                                    <input type="submit"  class="btn bg-red waves-effect waves-light"  value="Aceptar">
                                </div>
                        </form>
                                <div class="col-sm-2 col-sm-offset-2" align="center">
                                    <button form="otroForm" onclick="popUpImprimir(<?=$idAsignacion.", ".$idSubservicio?>)" class="btn bg-red waves-effect waves-light" >PDF</button>
                                </div>

                            </div>


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
            $("#idident" + identificador).toggleClass("completo form-control");
        }
        else if($("#idident"+identificador).val()==2)
        {
            $("#idident" + identificador).toggleClass("incompleto form-control");
        }

        else if($("#idident"+identificador).val()==3)
        {
            $("#idident" + identificador).toggleClass("noAplica form-control");
        }
        else
            $("#idident" + identificador).toggleClass("form-control");
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
                    totalNoAplica++;
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
</script>
<script>
    function  popUpImprimir(idAsignacion, idSubservicio)
    {
        window.open("https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/checkListSSHI/"+idAsignacion+"/"+idSubservicio,"neo","width=900,height=600,menubar=si");
    }
</script>

<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->