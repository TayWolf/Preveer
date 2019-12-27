
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<section class="content">

    <div class="container-fluid">

        <div class="block-header">

            <?php $tipo=$this->session->userdata('tipoUser');

            if($tipo!='' && $_SESSION['idusuariobase'] != '')

            {

                if($tipo == 3){

                    echo "<a href='".site_url('menus')."/".$this->session->userdata('idusuariobase')."'>

                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>

                            <i class='material-icons'>arrow_back</i>

                        </button>

                        </a>";

                } else{

                    echo "<a href='".site_url('menus/')."'>

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



                    <div class="body">



                        <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?=$idAsignacion;?>" readonly>

                        <input type="hidden" name="idReporte" id="idReporte" value="<?=$idReporte?>" readonly>

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
                                                            <!-- <img style="width:70%" src="https://cointic.com.mx/preveer/Cliente/assets/img/avatarsinimagen.jpg"> -->
                                                            <div id="evidenciaFotografica<?=$conclusion?>">

                                                            </div>
                                                            <!-- <input type="file" id="evidenciaFotografica<?=$conclusion?>" name="evidenciaFotografica<?=$conclusion?>[]" data-min-file-count="0"> -->

                                                        </div>

                                                        <div class='col-sm-offset-1 col-sm-6'>

                                                            <div class='form-group'>

                                                                <div class="form-line">

                                                                    <b>Corrección/Conclusión</b>

                                                                    <textarea class="form-control" id="correccion<?=$conclusion?>" name="correccion<?=$conclusion?>" readonly></textarea>

                                                                    <input type="hidden" name="idCorreccion<?=$conclusion?>" id="idCorreccion<?=$conclusion?>" readonly>

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



                                                    echo "<input type='hidden' name='idIndicador$contadorIndicadores' value='".$indicadores[$i]['idIndicadorReporte']."' readonly>";

                                                    if($indicadores[$i]['tipo']==1)

                                                    {

                                                        ?>

                                                        <div class='col-sm-4'>

                                                            <div class='form-group'>

                                                                <div class='form-line'>

                                                                    <b><?= $indicadores[$i]['nombreIndicador'] ?></b>

                                                                    <select disabled name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>>

                                                                    </select>

                                                                    <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>" readonly>

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

                                                                    <input type="text" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  readonly class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>>

                                                                    <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" readonly value="<?=$apartado['idApartadoReporte']?>">

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

                                                                    <input type="date" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>" readonly  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>>

                                                                    <input type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>" readonly>

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
                                                                    <textarea readonly style="height: 81px;" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>" class="form-control"></textarea>
                                                                    <!-- <input type="text" name="indicador<?=$contadorIndicadores?>" id="indicador<?=$indicadores[$i]['idIndicadorReporte']?>"  class="form-control select<?=$indicadores[$i]['idIndicadorReporte'].'-'.$apartado['idApartadoReporte']?>" <?=$requerido?>> -->

                                                                    <input readonly type="hidden" name="apartado_indicador<?=$contadorIndicadores++?>" value="<?=$apartado['idApartadoReporte']?>">

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





                    </div>



                </div>

            </div>

        </div>





        <script>

            function crearFileInput(nombreCampo, valorCampo, numeroConclusion, idCorreccion, textoCorreccion)

            {

                imagen='';

                if(valorCampo)

                {
                    //alert("entra "+nombreCampo)
                    imagen="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoReportes/evidenciaFotografica"+valorCampo+"' class='file-preview-image'>";
                    //alert("entra "+imagen)
                    $("#"+nombreCampo).append(imagen);
                }

                $("#correccion"+numeroConclusion).val(textoCorreccion);

                $("#idCorreccion"+numeroConclusion).val(idCorreccion);

            }

            var arregloCorrecciones;

            //Carga los ponderadores

            $(document).ready(function ()

            {



                $.ajax(

                    {

                        url: '<?=site_url('Crudfichasgrales/obtenerCorrecciones/').$ReporteAsignacion[0]['idReporteAsignacion']?>',

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

                        url: '<?=site_url('Crudfichasgrales/obtenerPonderadoresReporte/').$idReporte?>',

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

                                    url: '<?=site_url('Crudfichasgrales/cargarResultados/').$ReporteAsignacion[0]['idReporteAsignacion']?>',

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

        </script>

