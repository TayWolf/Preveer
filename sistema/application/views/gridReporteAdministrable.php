<?php

include "header.php";

?>
<style>
    textarea {
        resize: none;
    }
</style>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



    <section class="content">

        <div class="container-fluid">

            <div class="block-header">

                <?php $tipo=$this->session->userdata('tipoUser');

                if($tipo!='' && $_SESSION['idusuariobase'] != '')

                {

                    if($tipo == 3){

                        echo "<a href='".site_url('CrudReportes')."/".$this->session->userdata('idusuariobase')."'>

                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>

                            <i class='material-icons'>arrow_back</i>

                        </button>

                        </a>";

                    } else{

                        echo "<a href='".site_url('CrudReportes/')."'>

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

                            <h2><?=$nombreReporte?></h2>

                        </div>

                        <form id="datosReporte" method="post">

                            <div class="body">



                                <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?=$idAsignacion;?>">

                                <input type="hidden" name="idReporte" id="idReporte" value="<?=$idReporte?>">

                                <?php

                                $contadorIndicadores=0;

                                $numeroApartado=0;

                                $correcionPintada=false;

                                foreach ($apartados as $apartado)

                                {

                                if($numeroApartado==$correccion[0]['posicionCorreccion']&&$correccion[0]['numeroCorrecciones']!=0)

                                {

                                ?>

                                <div class="panel-group full-body" id="accordion_correccion" role="tablist" aria-multiselectable="true">

                                    <div class="panel panel-col-lightgray">

                                        <div class="panel-heading" role="tab" id="headingOne_correccion">

                                            <h4 class="panel-title">

                                                <a style="text-align: center" role="button" data-toggle="collapse" href="#collapseOne_correccion" aria-expanded="true" aria-controls="collapseOne_correccion">

                                                    CORRECCIONES PARA APLICACIÓN

                                                </a>

                                            </h4>

                                        </div>

                                        <div id="collapseOne_correccion" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_correccion">

                                            <div class="panel-body">



                                                    <?php

                                                    for($conclusion=0; $conclusion<$correccion[0]['numeroCorrecciones']; $conclusion++)

                                                    {

                                                        //TODO: LA CONCLUSIÓN DEBE ABARCAR EL ALTO DEL ROW, FALTA QUE BORRE LAS IMAGENES, Y UN BOTON DE SUBIDA

                                                        ?>

                                                        <div class="row">

                                                            <div class="col-sm-offset-1 col-sm-4">

                                                                <label>Evidencia fotográfica</label>

                                                                <input type="file" id="evidenciaFotografica<?=$conclusion?>" name="evidenciaFotografica<?=$conclusion?>[]" data-min-file-count="0">

                                                            </div>

                                                            <div class='col-sm-offset-1 col-sm-6'>

                                                                <div class='form-group'>

                                                                    <div class="form-line">

                                                                        <b>Corrección/Conclusión</b>

                                                                        <textarea class="form-control" id="correccion<?=$conclusion?>" name="correccion<?=$conclusion?>"></textarea>

                                                                        <input type="hidden" name="idCorreccion<?=$conclusion?>" id="idCorreccion<?=$conclusion?>">

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>



                                                        <?php

                                                    }

                                                    ?>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                                    <?php



                                                    }



                                                    $indicadorInicio=$apartado['idApartadoReporte'];

                                                    ?>

                                                    <div class="panel-group full-body" id="accordion_<?=$apartado['idApartadoReporte']?>" role="tablist" aria-multiselectable="true">

                                                        <div class="panel panel-col-lightgray">

                                                            <div class="panel-heading" role="tab" id="headingOne_<?=$apartado['idApartadoReporte']?>">

                                                                <h4 class="panel-title">

                                                                    <a style="text-align: center" role="button" data-toggle="collapse" href="#collapseOne_<?=$apartado['idApartadoReporte']?>" aria-expanded="true" aria-controls="collapseOne_<?=$apartado['idApartadoReporte']?>">

                                                                        <?=$apartado['nombre']?>

                                                                    </a>

                                                                </h4>

                                                            </div>

                                                            <div id="collapseOne_<?=$apartado['idApartadoReporte']?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_<?=$apartado['idApartadoReporte']?>">

                                                                <div class="panel-body">



                                                                    <div class="row">

                                                                        <?php

                                                                        for ($i=$contadorIndicadores; $i<sizeof($indicadores) && $indicadorInicio==$indicadores[$i]['idApartadoReporte']; $i++)

                                                                        {

                                                                            //$requerido=($indicadores[$i]['required'])? "required" : "";

                                                                            $requerido="";



                                                                            echo "<input type='hidden' name='idIndicador$contadorIndicadores' value='".$indicadores[$i]['idIndicadorReporte']."'>";

                                                                            if($indicadores[$i]['tipo']==1)

                                                                            {

                                                                                ?>

                                                                                <div class='col-sm-4'>

                                                                                    <div class='form-group'>

                                                                                        <div class='form-line'>

                                                                                            <b><?= $indicadores[$i]['nombreIndicador'] ?></b>

                                                                                            <select name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>>

                                                                                            </select>

                                                                                            <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>">

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                <?php

                                                                            }

                                                                            else if($indicadores[$i]['tipo']==2)

                                                                            {

                                                                                ?>

                                                                                <div class='col-sm-4'>

                                                                                    <div class='form-group'>

                                                                                        <div class='form-line'>

                                                                                            <b><?= $indicadores[$i]['nombreIndicador'] ?></b>

                                                                                            <input type="text" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>>

                                                                                            <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>">

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                <?php

                                                                            }

                                                                            else if($indicadores[$i]['tipo']==3)

                                                                            {

                                                                                ?>

                                                                                <div class='col-sm-4'>

                                                                                    <div class='form-group'>

                                                                                        <div class='form-line'>

                                                                                            <b><?= $indicadores[$i]['nombreIndicador'] ?></b>

                                                                                            <input type="date" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>>

                                                                                            <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>">

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                <?php

                                                                            }
                                                                            else if($indicadores[$i]['tipo']==5)

                                                                            {
                                                                               
                                                                                ?>

                                                                                <div class='col-sm-4'>

                                                                                    <div class='form-group'>

                                                                                        <div class='form-line'>

                                                                                            <b><?= $indicadores[$i]['nombreIndicador'] ?></b>
                                                                                            <textarea style="height: 81px;" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>" class="form-control"></textarea>
                                                                                            <!-- <input type="text" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>> -->

                                                                                            <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>">

                                                                                        </div>

                                                                                    </div>

                                                                                </div>

                                                                                <?php

                                                                            }



                                                                        }

                                                                        ?>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <?php

                                                    $numeroApartado++;

                                                    }

                                                    ?>

                                                    <div class="row">

                                                        <div class="col-sm-offset-5 col-sm-2">

                                                            <input class="btn bg-red waves-effect waves-light" type="submit" value="Guardar">

                                                        </div>

                                                    </div>



                                                </div>

                        </form>

                    </div>

                </div>

            </div>





            <script>

                function crearFileInput(nombreCampo, valorCampo, numeroConclusion, idCorreccion, textoCorreccion)

                {

                    imagen='';

                    if(valorCampo)

                    {

                        imagen="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoReportes/evidenciaFotografica"+valorCampo+"' class='file-preview-image'>";

                    }

                    $("#correccion"+numeroConclusion).val(textoCorreccion);

                    $("#idCorreccion"+numeroConclusion).val(idCorreccion);



                    $('#'+nombreCampo).fileinput({

                        'showUploadedThumbs': false,

                        'showCaption': false,

                        'showCancel': false,

                        'showRemove': false,

                        'showUpload': false,

                        'uploadAsync': false,

                        'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudReportes/subirFotoGeneral/"+nombreCampo,

                        'uploadExtraData': {conclusion: $("#correccion"+numeroConclusion).val(), idReporteAsignacion: <?=$ReporteAsignacion[0]['idReporteAsignacion']?>, idReporteCorreccion: idCorreccion},

                        'language': 'es',

                        'maxFileCount': 1,

                        'allowedFileExtensions': ['jpg', 'gif', 'png'],

                        'initialPreview' : [imagen]

                    }).on('change', function (event, data, previewId, index) {





                    }).on('fileclear', function (event) {

                        url = "https://cointic.com.mx/preveer/sistema/index.php/CrudReportes/eliminarImagen/"+idCorreccion+"/"+nombreCampo;

                        $.ajax({

                            url: url,

                            type: "post",

                            dataType: "html"

                        }).done(function (res) { });





                    });

                }

var arregloCorrecciones;

                //Carga los ponderadores

                $(document).ready(function ()

                {



                    $.ajax(

                        {

                            url: '<?=site_url('CrudReportes/obtenerCorrecciones/').$ReporteAsignacion[0]['idReporteAsignacion']?>',

                            contentType: false,

                            dataType: 'json',

                            success: function (data)

                            {

                                arregloCorrecciones=data;

                                var restantes=0;

                                for(i=0; i<<?=$correccion[0]['numeroCorrecciones']?>; i++)

                                {

                                    //

                                    //nombre del fileinput, imagen, numero de correccion a subir, idCorreccion(BD)

                                    if(restantes<data.length)

                                        crearFileInput("evidenciaFotografica"+i, data[restantes]['evidenciaFotografica'], i, data[restantes]['idReporteCorreccion'], data[restantes++]['correccion']);

                                    else

                                        crearFileInput("evidenciaFotografica"+i, null, i, 0, "");

                                }

                            }

                        }

                    );





                    $.ajax(

                        {

                            url: '<?=site_url('CrudReportes/obtenerPonderadoresReporte/').$idReporte?>',

                            contentType: false,

                            dataType: 'JSON',

                            success: function(ponderadores)

                            {

                                for(i=0; i<ponderadores.length; i++)

                                {

                                    $(".select"+ponderadores[i]['idIndicador']+"-"+ponderadores[i]['idApartadoReporte']).append('<option value="'+ponderadores[i]['idPonderador']+'">'+ponderadores[i]['nombrePonderador']+'</option>');

                                }

                            },

                            complete: function()

                            {

                                $.ajax(

                                    {

                                        url: '<?=site_url('CrudReportes/cargarResultados/').$ReporteAsignacion[0]['idReporteAsignacion']?>',

                                        contentType: false,

                                        dataType: 'json',

                                        success: function (resultados)

                                        {



                                            for(i=0; i<resultados.length; i++)

                                            {

                                                $(".select"+resultados[i]['idIndicadorReporte']+"-"+resultados[i]['idApartadoReporte']).val(resultados[i]['valor']);

                                            }

                                        }

                                    }

                                );

                            }

                        }

                    );

                });



                //envia los resultados para que se almacenen

                $("#datosReporte").submit(function (e)

                    {



                        var restantes=0;

                        for(i=0; i<<?=$correccion[0]['numeroCorrecciones']?>; i++)

                        {



                            //nombre del fileinput, imagen, numero de correccion a subir, idCorreccion(BD)

                            if(restantes<arregloCorrecciones.length)

                            {

                                var extraData={conclusion: $("#correccion"+i).val(), idReporteAsignacion: <?=$ReporteAsignacion[0]['idReporteAsignacion']?>, idReporteCorreccion: arregloCorrecciones[restantes++]['idReporteCorreccion']};

                                $("#evidenciaFotografica"+i).fileinput('refresh', {'uploadExtraData': extraData});

                                $("#evidenciaFotografica"+i).fileinput("upload");



                            }

                            else

                            {

                                var extraData={conclusion: $("#correccion"+i).val(), idReporteAsignacion: <?=$ReporteAsignacion[0]['idReporteAsignacion']?>, idReporteCorreccion: 0};

                                $("#evidenciaFotografica"+i).fileinput('refresh', {'uploadExtraData': extraData});

                                $("#evidenciaFotografica"+i).fileinput("upload");

                            }



                        }





                        e.preventDefault();

                        var formData=new FormData(document.getElementById("datosReporte"));



                        $.ajax({

                            url: '<?=site_url('CrudReportes/actualizarReporte')?><?="/".$contadorIndicadores.'/'.$ReporteAsignacion[0]['idReporteAsignacion']."'"?>,

                            contentType: false,

                            data: formData,

                            type: 'post',

                            cache : false,

                            processData: false,

                            success: function (res)

                            {

                                swal({

                                    title: "Éxito",

                                    text: "Se ha guardado el reporte",

                                    type: "success",

                                    confirmButtonClass: "btn-danger",

                                    confirmButtonText: "Aceptar"

                                }, function(){

                                    location.reload();

                                });

                            }

                        });

                    }

                );

            </script>



<?php

include "footer.php";

?>