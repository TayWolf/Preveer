<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<style>
    th{
        text-align: center;
    }
</style>
<section class="content">
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Resumen de las oportunidades de mejora de <?=$datosCentroTrabajo['nombreSucursal']?></h2>
                    </div>
                    <div class="body">
                        <div class="row">
                            <?php
                            $graficaSolucion=array();
                            $graficaTotales=array();
                            $graficaLabel=array();
                            if(sizeof($tabla))
                            {
                                setlocale(LC_ALL,"es_ES");
                                $fechaActual=$tabla[0]['year'].$tabla[0]['month'];
                                $tablita=array();
                                for($i=0; $i<sizeof($tabla); $i++)
                                {
                                    //segmenta la tabla en pequeñas tablas agrupadas por año y mes
                                    $row=$tabla[$i];
                                    if($row['year'].$row['month']!=$fechaActual)
                                    {
                                        $fechaActual=$row['year'].$row['month'];
                                        $i--;
                                    }
                                    else
                                    {
                                        array_push($tablita, $row);
                                        if($i<sizeof($tabla)-1)
                                            continue;
                                    }
                                    $totalOportunidades=sizeof($tablita);
                                    $solucionesImplementadas=0;
                                    foreach ($tablita as $om)
                                    {
                                        if($om['fotoCorreccion0']||$om['fotoCorreccion1'])
                                        {
                                            $solucionesImplementadas++;
                                        }
                                    }
                                    $porcentajeOportunidadesSolucionadas=number_format((float)($solucionesImplementadas*100)/$totalOportunidades, 2, '.', '');
                                    $date=DateTime::createFromFormat('!m', $tablita[0]['month']);
                                    if($tablita[0]['month'])
                                    {

                                        array_push($graficaLabel, strftime("%B",$date->getTimestamp())." de ".$tablita[0]['year']);
                                        array_push($graficaSolucion, $solucionesImplementadas);
                                        array_push($graficaTotales, $totalOportunidades);
                                    }


                                    ?>
                                    <div class="col-sm-6">
                                        <div class="table table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th colspan="2"><?php

                                                        echo strftime("%B",$date->getTimestamp())." de ".$tablita[0]['year'];
                                                        ?>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="background-color: #b81f26; color: white;">RESULTADO DE INDICADOR DE MEJORAMIENTO</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>No. TOTAL DE OPORTUNIDADES DE MEJORA ENCONTRADAS</td>
                                                    <td><?=sizeof($tablita)?></td>
                                                </tr>
                                                <tr>
                                                    <td>No. TOTAL DE SOLUCIONES IMPLEMENTADAS</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr>
                                                    <td><b>% DE OPORTUNIDADES DE MEJORA SOLUCIONADAS</b></td>
                                                    <td>0</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="table table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th colspan="2">Seguimiento <?php
                                                        echo strftime("%B",$date->getTimestamp())." de ".$tablita[0]['year'];
                                                        ?></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" style="background-color: #b81f26; color: white;">RESULTADO DE INDICADOR DE MEJORAMIENTO</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>No. TOTAL DE OPORTUNIDADES DE MEJORA ENCONTRADAS</td>
                                                    <td><?=sizeof($tablita)?></td>
                                                </tr>
                                                <tr>
                                                    <td>No. TOTAL DE SOLUCIONES IMPLEMENTADAS</td>
                                                    <td><?=$solucionesImplementadas?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>% DE OPORTUNIDADES DE MEJORA SOLUCIONADAS</b></td>
                                                    <td><?=$porcentajeOportunidadesSolucionadas?></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <?php
                                    $tablita=array();
                                }

                            }
                            ?>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>Cumplimiento por normativa</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2" id="graficaTr">
                                        <canvas id="chart">
                                        </canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2>Detalles</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="table table-responsive">
                                        <table id="tabla-oportunidades" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Área / Sección</th>
                                                <th>Factor de riesgo</th>
                                                <th>Foto que genera la oportunidad de mejora</th>
                                                <th>Oportunidad de mejora</th>
                                                <th>Prioridad de intervención</th>
                                                <th>Recomendación</th>
                                                <th>Responsable</th>
                                                <th>Fecha de ejecución</th>
                                                <th>Fecha de verificación</th>
                                                <th>Foto corrección de la oportunidad de mejora</th>
                                                <th>Seguimiento (observaciones)</th>
                                                <th style="display: none">IDENTIFICADOR</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                            <?php
                                            $contador=1;
                                            $totalSoluciones = 0;
                                            foreach ($tablaOMSSH as $item)
                                            {
                                                if( $item['fotoCorreccion0'] != '' || $item['fotoCorreccion1'] != '' )
                                                {
                                                    $totalSoluciones++;
                                                }

                                                print "<tr><td>$contador</td><td>".$item['area']."</td><td>".$item['factorRiesgo']."</td><td><button type=\"button\" class=\"btn btn-default\" onclick=\"modalFotosMalas(".$item['idOMSSH'].")\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i>Visualizar</button></td><td>".$item['oportunidadMejora']."</td>
                                    <td style='background: ".$item['colorPrioridad'].";' id='color".$item['idOMSSH']."'>".$item['nombrePrioridad']."</td><td>".$item['recomendacion']."</td><td>".$item['responsable']."</td>
                                    <td>".$item['fechaEjecucion']."</td><td>".$item['fechaVerificacion']."</td><td><button type=\"button\" class=\"btn btn-default\" onclick=\"modalFotosBuenas(".$item['idOMSSH'].")\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i>Visualizar</button></td><td>".$item['seguimiento']."</td><td style='display: none;'>".$item['idOMSSH']."</td></tr>";
                                                $contador++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalFotoMala" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Imagen</h4>
            </div>
            <div class="modal-body">
                <div class="row" align="center">
                    <div class="col-md-8 col-md-offset-2">
                        <b>Fotos que genera la oportunidad de mejora</b>
                        <div id="ConteniFotoMala">
                            <div class="col-md-6">
                                <input type="file" id="fotoMal0" name="fotoMal0[]" data-min-file-count="1">
                            </div>
                            <div class="col-md-6">
                                <input type="file" id="fotoMal1" name="fotoMal1[]" data-min-file-count="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalFotoBuena" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Imagen</h4>
            </div>
            <div class="modal-body">
                <div class="row" align="center">
                    <div class="col-md-8 col-md-offset-2">
                        <b>Foto corrección de la oportunidad de mejora</b>
                        <div id="ConteniFotoBuena">
                            <div class="col-md-6">
                                <input type="file" id="fotoCorreccion0" name="fotoCorreccion0[]" data-min-file-count="1">
                            </div>
                            <div class="col-md-6">
                                <input type="file" id="fotoCorreccion1" name="fotoCorreccion1[]" data-min-file-count="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<script>
    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };
    window.onload=function ()
    {
        var ctx=document.getElementById("chart").getContext('2d');
        var config={
            type: 'bar',
            data: {
                labels: <?=json_encode($graficaLabel, true)?>,
                datasets: [
                    {
                        label: 'Total de oportunidades de mejora encontradas',
                        backgroundColor: window.chartColors.red,
                        borderColor: window.chartColors.red,
                        data: <?=json_encode($graficaTotales, true)?>,
                        fill: false
                    },
                    {
                        label: 'Soluciones implementadas',
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: <?=json_encode($graficaSolucion,true)?>,
                        fill: false
                    }
                ]

            }
        };
        var lineChart=new Chart(ctx, config);
    };
</script>

<script>

    function modalFotosMalas(idOMSSH)
    {

        $("#ConteniFotoMala").empty();
        $("#ConteniFotoMala").append("<div class=\"col-md-6\">\n" +
            "                                    <input type=\"file\" id=\"fotoMal0\" name=\"fotoMal0[]\" data-min-file-count=\"1\">\n" +
            "                                </div>\n" +
            "                                <div class=\"col-md-6\">\n" +
            "                                    <input type=\"file\" id=\"fotoMal1\" name=\"fotoMal1[]\" data-min-file-count=\"1\">\n" +
            "                                </div>");
        $.ajax(
            {
                url: '<?=('https://cointic.com.mx/preveer/sistema/index.php/CrudOMSSH/traerFotoMala/')?>'+idOMSSH,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (resultado)
                {

                    crearFileInputFotos(resultado[0]['fotoMal0'], idOMSSH, "fotoMal0");
                    crearFileInputFotos(resultado[0]['fotoMal1'], idOMSSH, "fotoMal1");

                },
                complete: function ()
                {
                    $("#modalFotoMala").modal();

                }
            }
        );


    }
    function modalFotosBuenas(idOMSSH)
    {
        $("#ConteniFotoBuena").empty();
        $("#ConteniFotoBuena").append("<div class=\"col-md-6\">\n" +
            "                                    <input type=\"file\" id=\"fotoCorreccion0\" name=\"fotoCorreccion0[]\" data-min-file-count=\"1\">\n" +
            "                                </div>\n" +
            "                                <div class=\"col-md-6\">\n" +
            "                                    <input type=\"file\" id=\"fotoCorreccion1\" name=\"fotoCorreccion1[]\" data-min-file-count=\"1\">\n" +
            "                                </div>");
        $.ajax(
            {
                url: '<?=('https://cointic.com.mx/preveer/sistema/index.php/CrudOMSSH/traerFotoBuena/')?>'+idOMSSH,
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success: function (resultado)
                {

                    crearFileInputFotos(resultado[0]['fotoCorreccion0'], idOMSSH, "fotoCorreccion0");
                    crearFileInputFotos(resultado[0]['fotoCorreccion1'], idOMSSH, "fotoCorreccion1");
                },
                complete: function ()
                {
                    $("#modalFotoBuena").modal();

                }
            }
        );


    }
    function crearFileInputFotos(valor,  llavePrimaria, nombreCampo)
    {

        var fot=valor;

        if (fot)
        {
            fot="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/"+nombreCampo+"/"+fot+"' class='file-preview-image' >";
        }
        else
        {
            fot="";
        }

        // alert(nombreCampo+"  "+fot)
        $("#" + nombreCampo).fileinput({
            'showUploadedThumbs': false,
            'showCaption': false,
            'showCancel': false,
            'showRemove': false,
            'showUpload': false,
            'uploadAsync': false,
            'showBrowse' : false,
            'showClose': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudOMSSH/subirFoto/" + nombreCampo + "/OMSSH/" + llavePrimaria,
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'jpeg', 'gif', 'png'],
            initialPreview: [fot]
        });
    }
</script>
