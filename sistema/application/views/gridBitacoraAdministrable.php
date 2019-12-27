<?php
include "header.php";
?>


<style type="text/css">
    div {
        line-height: 20px;
    }
    .data {
        width: 100px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .data:hover{
        overflow: visible;
        white-space: normal;
        width: auto;
        position: absolute;
        background-color:#FFF;
    }
    .data:hover+div {
        margin-top:20px;
    }
    .centrico{
        text-align: center;

    }
    .centrado
    {
    }
    .centrado>tr
    {
    }
    .centrado>tr>td
    {
        vertical-align: middle !important;
        align: center !important;
        text-align: center !important;
    }
    .centrado>tr>td>div>div
    {
        vertical-align: middle !important;
        align: center !important;
        text-align: center !important;
    }
    .centrado>tr>td>input
    {
        text-align: center !important;
    }

</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>

<script>
    var array = {
        'datosBitacora': []
    };
</script>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php $tipo=$this->session->userdata('tipoUser');
            if($tipo!='' && $_SESSION['idusuariobase'] != '')
            {
                if($tipo == 3){
                    echo "<a href='".site_url('CrudBitacoras')."/".$this->session->userdata('idusuariobase')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } else{
                    echo "<a href='".site_url('CrudBitacoras/')."'>
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
                        <h2><?php foreach ($nombreBitac as $key ) {
                                $nombreBitacora=$key['nombre']; echo "$nombreBitacora";
                            } ?></h2>
                    </div>
                    <div class="body">
                        <form id="formDatosBitacora"></form>
                        <form id="form"></form>
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>" form="form">
                            <input type="hidden" name="idBitacora" id="idBitacora" value="<?php echo $idBitacora;?>" form="form">
                            <input type="hidden" name="idcent" id="idcent" value="<?php echo $idCentroTrabajo;?>" form="form">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                                <i class="material-icons">assignment</i> Bitácora
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">
                                            <div class="row">
                                                <?php
                                                $contad=0;
                                                foreach ($indicadores as $row)
                                                {
                                                    $nombreIn=$row['nombreIndicador'];
                                                    $tipoIndicador=$row['tipoIndicador'];
                                                    $idIndicador=$row['idIndicador'];
                                                    if ($tipoIndicador==1)
                                                    {
                                                        $camp=" <select class='form-control' id='idIndic$idIndicador' name='idIndic$idIndicador' required form=\'form\'>";
                                                        $finCamp="</select>";
                                                    }
                                                    else if ($tipoIndicador==2)
                                                    {
                                                        $camp=" <input type='text' class='form-control' id='abiert$idIndicador' name='abiert$idIndicador' form=\'form\'>";
                                                        $finCamp="";
                                                    }
                                                    else if ($tipoIndicador==3)
                                                    {
                                                        $camp=" <input type='date' class='form-control' id='fech$idIndicador' name='fech$idIndicador' form=\'form\'>";
                                                        $finCamp="";
                                                    }
                                                    if($tipoIndicador!=4)
                                                    {
                                                        echo " 
                                                    <div class='col-sm-4'>
                                                        <div class='form-group'>
                                                            <div class='form-line'>
                                                                <b>$nombreIn</b>
                                                               $camp";

                                                        echo "$finCamp
                                                            </div>
                                                        </div>
                                                    </div>";
                                                        $contad++;
                                                    }
                                                }
                                                ?>
                                            </div>


                                            <div class="panel-body">
                                                <div class="row text-center">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 ">
                                                        <div class="form-line">
                                                            <input type="submit" value="Agregar" class="btn bg-red" id="agregar-in" form="form">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="body table-responsive">
                                                <table class="table table-hover" id="tablaBitacora">
                                                    <thead>
                                                    <tr>
                                                        <th style="display: none;">IDENTIFICADOR</th>
                                                        <th>#</th>
                                                        <?php
                                                        $arregloIndicadoresEncabezado=array();
                                                        $contadorTh=0;
                                                        //idContador sirve para obtener el indicador sobre el que se va a calcular el numero. Ejemplo: Numero de extintores= 3,4,5,7
                                                        $idContador=0;
                                                        foreach ($indicadores as $row)
                                                        {
                                                            $id=$row['idIndicador'];
                                                            $nombreIn=$row['nombreIndicador'];
                                                            $tipo=$row['tipoIndicador'];
                                                            $esContador=$row['esContador'];
                                                            if($esContador)
                                                                $idContador=$id;
                                                            if($tipo!=4) {
                                                                $arregloIndicadoresEncabezado[$contadorTh] = $id;
                                                                echo "<th>$nombreIn <input type='hidden' id='tablaIndicador$id' name='tablaIndicador$contadorTh' value='$id' </th>";
                                                                $contadorTh++;
                                                            }
                                                        }

                                                        ?>
                                                        <th>Oportunidades de mejora</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="lista">
                                                    <?php
                                                    $contadorRegistros=1;
                                                    $numeroRegistros=sizeof($datosBitacora);
                                                    $arregloCondiciones=array();
                                                    $i=0;
                                                    //Recorre todos los datos de la bitacora
                                                    while($i<$numeroRegistros)
                                                    {
                                                        $valorNumerico=0;
                                                        $ultimoAlmacenamiento=$datosBitacora[$i]['idAlmacenamiento'];
                                                        $fila=array();
                                                        $j=0;
                                                        //De la consulta, obtiene toda una fila de datos para mostrarlos en la tabla
                                                        while($ultimoAlmacenamiento==$datosBitacora[$i]['idAlmacenamiento'])
                                                        {
                                                            if($datosBitacora[$i]['tipoIndicador']!=4)
                                                            {
                                                                if($idContador==$datosBitacora[$i]['idIndicador'])
                                                                {
                                                                    $valorNumerico=$datosBitacora[$i]['valor'];
                                                                }
                                                                $fila[$j++] = $datosBitacora[$i];
                                                                $ultimoAlmacenamiento = $datosBitacora[$i++]['idAlmacenamiento'];
                                                                if ($i >= $numeroRegistros)
                                                                    break;
                                                            }
                                                        }
                                                        //crea el tr y le pone un numero
                                                        echo "<tr><td style='display: none;'>$ultimoAlmacenamiento</td><td>$contadorRegistros</td>";
                                                        //obtiene la diferencia entre los registros de la tabla y sus encabezados
                                                        $diferencia = sizeof($arregloIndicadoresEncabezado) - sizeof($fila);
                                                        //por cada uno de los datos de la fila
                                                        for ($k = 0; $k < sizeof($fila); $k++)
                                                        {
                                                            //por cada uno de los encabezados
                                                            for($l=$k; $l < sizeof($arregloIndicadoresEncabezado); $l++ )
                                                            {
                                                                //si el encabezado coincide con el dato de la fila
                                                                if ($fila[$k]['idIndicador'] == $arregloIndicadoresEncabezado[$l])
                                                                {
                                                                    $arregloIndicesCondiciones=array();
                                                                    //valorDescripcion guarda los calculos encontrados
                                                                    $valorDescripcion=array();
                                                                    //Evalua la condicion para despues saber si se tomará en cuenta para hacer el calculo de los totales
                                                                    foreach ($condiciones as $condicion)
                                                                    {
                                                                        if($condicion['idIndicador']==$fila[$k]['idIndicador'])
                                                                        {
                                                                            $operadorCondicion=$condicion['condicion'];
                                                                            $expresion=false;
                                                                            if($operadorCondicion!="includes")
                                                                                $expresion=eval("return '".$fila[$k]['valor']."' ".$condicion['condicion']." '".$condicion['valorCondicion']."';");
                                                                            else
                                                                                $expresion=eval("return strpos('".$fila[$k]['valor']."', '".$condicion['valorCondicion']."');");

                                                                            if(empty($arregloIndicesCondiciones[$condicion['idIndicadorCalculo']]))
                                                                                $arregloIndicesCondiciones[$condicion['idIndicadorCalculo']]=array();

                                                                            array_push($arregloIndicesCondiciones[$condicion['idIndicadorCalculo']], $expresion);
                                                                            if(empty($valorDescripcion[$condicion['idIndicadorCalculo']]))
                                                                                $valorDescripcion[$condicion['idIndicadorCalculo']]=$condicion['idIndicadorCalculo'];

                                                                        }
                                                                    }
                                                                    //si el tipo de indicador es select o abierto
                                                                    if($fila[$k]['tipoIndicador']==1||$fila[$k]['tipoIndicador']==2)
                                                                    {
                                                                        //por cada uno de los calculos, recorrerlos y evaluarlos en forma de OR
                                                                        foreach($valorDescripcion as $valor)
                                                                        {
                                                                            $seTomaEnCuenta = false;
                                                                            for ($indice = 0; $indice < sizeof($arregloIndicesCondiciones[$valor]); $indice++)
                                                                            {
                                                                                if ($arregloIndicesCondiciones[$valor][$indice]) {
                                                                                    $seTomaEnCuenta = true;
                                                                                    break;
                                                                                }
                                                                            }

                                                                            if ($seTomaEnCuenta) {
                                                                                if (empty($arregloCondiciones['cantidad' . $valor])) {
                                                                                    $arregloCondiciones['cantidad' . $valor] = 1;

                                                                                    $arregloCondiciones['numero' . $valor] = "" . $valorNumerico;
                                                                                } else {
                                                                                    $arregloCondiciones['cantidad' . $valor] += 1;

                                                                                    $arregloCondiciones['numero' . $valor] .= "," . $valorNumerico;
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    //si el tipo de indicador es fecha
                                                                    else if($fila[$k]['tipoIndicador']==3)
                                                                    {
                                                                        //evalua los calculos en forma de  AND
                                                                        foreach($valorDescripcion as $valor)
                                                                        {
                                                                            $seTomaEnCuenta = false;
                                                                            for ($indice = 0; $indice < sizeof($arregloIndicesCondiciones[$valor]); $indice++) {
                                                                                if ($arregloIndicesCondiciones[$valor][$indice])
                                                                                {
                                                                                    $seTomaEnCuenta = true;
                                                                                } else {

                                                                                    $seTomaEnCuenta = false;
                                                                                    break;
                                                                                }
                                                                            }
                                                                            if ($seTomaEnCuenta) {
                                                                                if (empty($arregloCondiciones['cantidad' . $valor])) {
                                                                                    $arregloCondiciones['cantidad' . $valor] = 1;
                                                                                    $arregloCondiciones['numero' . $valor] = "" . $valorNumerico;
                                                                                } else {
                                                                                    $arregloCondiciones['cantidad' . $valor] += 1;
                                                                                    $arregloCondiciones['numero' . $valor] .= "," . $valorNumerico;
                                                                                }
                                                                            }
                                                                        }
                                                                    }


                                                                    echo "<td>" . $fila[$k]['valor'] . "</td>";
                                                                    $k++;
                                                                    if($k>=sizeof($fila))
                                                                        break;
                                                                }
                                                                else
                                                                {
                                                                    $diferencia--;
                                                                    echo "<td></td>";
                                                                }
                                                            }

                                                        }
                                                        while($diferencia>0)
                                                        {
                                                            echo "<td></td>";
                                                            $diferencia--;
                                                        }

                                                        echo "<td><button type='button' class='btn btn-default' onClick='modalFotos(" .$ultimoAlmacenamiento. ")'><i class='fa fa-picture-o' aria-hidden='true'></i></button></td>
                                                                        <td><button type='button' class='btn btn-defaultBorrar' onclick='eliminarRegistro(" . $ultimoAlmacenamiento . ")' id='eliminar" . $ultimoAlmacenamiento. "'><i class='fa fa-trash-o' aria-hidden='true'></i></button></td></tr>";
                                                        $contadorRegistros++;
                                                    }
                                                    ?>

                                                    </tbody>

                                                </table>

                                            </div>

                                        <form id="formularioInforme">
                                            <?php
                                            if(empty($resultadosBitacora))
                                            {
                                                $resultadosBitacora=array(
                                                    array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null),
                                                    array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null),
                                                    array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null)
                                                );
                                                for($i=0; $i<11; $i++)
                                                {
                                                    array_push($resultadosBitacora,array('idResultadoProteccion'=>null,'idResultado'=>null,'idAsignacion' =>null,'cantidad' => null, 'numero' =>null, 'observaciones' => null));
                                                }
                                            }

                                            ?>

                                            <!--Totales-->

                                            <div class="row">
                                                <br>
                                                <div class="col-sm-6 col-xs-6 col-md-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total colocados</b>
                                                            <input type="number" class="form-control" name="cantidadColocados" id="cantidadColocados" value="<?=$contadorRegistros-1?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                <?php
                                                $contadorIndicadorInforme=0;
                                                foreach ($indicadorInforme as $informe)
                                                {
                                                    if ($contadorIndicadorInforme==3) {
                                                            echo '<div class="row">';
                                                             $contadorIndicadorInforme=1;   
                                                        }
                                                    if(strlen($informe['texto'])<57){
                                                        
                                                    echo "<div class=\"col-sm-6 col-xs-6 col-md-4\">
                                                            <div class=\"form-group\">
                                                                <div class=\"form-line\">
                                                                    <b>".$informe['texto']."</b>
                                                                    <input type=\"text\" class=\"form-control\" name=\"indicadorInforme".$contadorIndicadorInforme."\" id=\"indicadorInforme".$informe['idIndicadorInforme']."\">
                                                                    <input type=\"hidden\" class=\"form-control\" name=\"idIndicadorInforme".$contadorIndicadorInforme."\" value=\"".$informe['idIndicadorInforme']."\">
                                                                </div>
                                                            </div>
                                                        </div>";

                                                    }else{

                                                        echo "<div class=\"col-sm-6 col-xs-6 col-md-4\">
                                                            <div class=\"form-group\">
                                                                <div class=\"form-line\">
                                                                    <b style='font-size: 10px'>".$informe['texto']."</b>
                                                                    <input type=\"text\" class=\"form-control\" name=\"indicadorInforme".$contadorIndicadorInforme."\" id=\"indicadorInforme".$informe['idIndicadorInforme']."\">
                                                                    <input type=\"hidden\" class=\"form-control\" name=\"idIndicadorInforme".$contadorIndicadorInforme."\" value=\"".$informe['idIndicadorInforme']."\">
                                                                </div>
                                                            </div>
                                                        </div>";
                                                      }  
                                                    $contadorIndicadorInforme++;
                                                }
                                                $contadorCalculoInforme=0;
                                                ?>

                                           <!--  </div> -->
                                            <!--Bloqueados-->
                                            <?php
                                            $agregados=array();
                                            foreach ($condiciones as $row)
                                            {
                                                if(empty($arregloCondiciones['cantidad'.$row['idIndicadorCalculo']]))
                                                {
                                                    $arregloCondiciones['cantidad'.$row['idIndicadorCalculo']]="0";
                                                    $arregloCondiciones['numero'.$row['idIndicadorCalculo']]="";
                                                }
                                                $busqueda=array_search($row['idIndicadorCalculo'],$agregados);

                                                if($busqueda===false)
                                                {
                                                    $disabled=($row['condicion']=="null")? "" : "readonly";
                                                    array_push($agregados, $row['idIndicadorCalculo']);
                                                    echo "<div class='row'>
                                                        <div class='col-sm-4'>
                                                            <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <b>Cantidad " . $row['descripcion'] . "</b>
                                                                    <input type='number' class='form-control' id='cantidad" . $row['idIndicadorCalculo'] . "' name='cantidad" . $contadorCalculoInforme. "' min='0' value='" . $arregloCondiciones['cantidad' . $row['idIndicadorCalculo']] . "' $disabled>
                                                                    <input type='hidden' class='form-control' name='calculo" . $contadorCalculoInforme. "' value='" . $row['idIndicadorCalculo']. "'>
                                                                </div>    
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-4'>
                                                            <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <b>Números " . $row['descripcion'] . "</b>
                                                                    <input type='text' class='form-control' id='numero" . $row['idIndicadorCalculo'] . "' name='numero" .$contadorCalculoInforme . "' value='" . $arregloCondiciones['numero' . $row['idIndicadorCalculo']] . "' $disabled>
                                                                </div>    
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-4'>
                                                            <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <b>Observaciones de " . $row['descripcion'] . "</b>
                                                                    <input type='text' class='form-control' id='observaciones" . $row['idIndicadorCalculo'] . "' name='observaciones" . $contadorCalculoInforme. "'>
                                                                </div>    
                                                            </div>
                                                        </div>                                                        
                                                    </div>";
                                                    $contadorCalculoInforme++;
                                                }
                                            }

                                            ?>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Comentarios y/o observaciones generales</b>
                                                            <textarea class="form-control" name="observacionesGenerales" id="observacionesGenerales" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                  </form>   
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-3" >
                                <b>Ver bitacoras anteriores</b>
                                <select class="form-control" id="bitacorasAnteriores" onchange="verBitacoraAnterior(<?=$idAsignacion.",".$idBitacora?>)">
                                    <option value="">Seleccione un respaldo</option>
                                </select>
                            </div>
                        
                   
                        
                            <div class="col-xs-3" align="center">
                                <div class="form-line">
                                    <input type="submit" form="formularioInforme" class="btn bg-red waves-effect waves-light"  value="Guardar">
                                </div>
                            </div>
                            
                            <div class="col-xs-3 " align="center">
                                <div class="form-line">
                                    <Button class="btn bg-red waves-effect waves-light" onclick="imprimirCambios()">Respaldar historico</Button>
                                </div>
                            </div>
                            <div class="col-xs-3 " align="center">
                                <div class="form-line">
                                    <Button class="btn bg-red waves-effect waves-light" onclick="visualPdf()">Imprimir</Button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</section>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalFoto" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                Oportunidades de mejora
            </div>
            <div class="modal-body" id="contenidoModal">
                <div class="row">
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraExtintor1" name="fotoOportunidadMejoraExtintor1[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraExtintor2" name="fotoOportunidadMejoraExtintor2[]" >
                    </div>
                    <div class="col-md-4">
                        <input type="file" id="fotoOportunidadMejoraExtintor3" name="fotoOportunidadMejoraExtintor3[]" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <div class="form-line">
                                <b>Oportunidad de mejora</b>
                                <textarea class="form-control" id="oportunidadMejoraExtintor" name="oportunidadMejoraExtintor" onblur="subirOportunidadMejora()"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="subirOportunidadMejora()">Subir oportunidad de mejora</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var llavePrimariaActual;
    function modalFotos(llavePrimaria)
    {
        $("#contenidoModal").empty();
        $("#contenidoModal").append("<div class=\"row\">\n" +
            "                        <div class=\"col-md-offset-2 col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoMal0\" name=\"fotoMal0[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoMal1\" name=\"fotoMal1[]\" >\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row\">\n" +
            "                        <div class=\"col-md-6 col-md-offset-3\">\n" +
            "                            <div class=\"form-group\">\n" +
            "                                <div class=\"form-line\">\n" +
            "                                    <b>Oportunidad de mejora</b>\n" +
            "                                    <textarea class=\"form-control\" id=\"oportunidadMejora\" name=\"oportunidadMejora\"></textarea>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>");
        llavePrimariaActual=llavePrimaria;
        var nombreTabla='OportunidadMejoraBitacora';
        var campoLlave='idAlmacenamiento';
        crearFileInputTabla("fotoMal0", "", "", "");
        crearFileInputTabla("fotoMal1", "", "", "");

        $("#modalFoto").modal();
    }
    function crearFileInputTabla(nombreCampo, valorCampo)
    {

        imagen='';
        if(valorCampo)
        {

            imagen="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoBitacoras/"+nombreCampo+"/"+valorCampo+"' class='file-preview-image'>";
        }
        $('#'+nombreCampo).fileinput({
            'resizeImage': false,
            'showUploadedThumbs': false,
            'showCaption': false,
            'showCancel': false,
            'showRemove': false,
            'showUpload': false,
            'uploadAsync': false,
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg','jpeg', 'gif', 'png'],
            'initialPreview' : [imagen]
        });
    }
    function subirOportunidadMejora()
    {

        var oportunidad=$("#oportunidadMejora").val();
        oportunidad=oportunidad.replace(" ", "%20");
        oportunidad=oportunidad.replace("/", "%30");
        $.ajax(
            {
                url: "<?=site_url('CrudOMSSH/subirOportunidadMejora/')?>"+llavePrimariaActual+"/"+oportunidad+"/"+<?=$idAsignacion?>,
                dataType: 'html',
                processData: false,
                contentType: false,
                cache: false,
                type: 'post',
                success: function (data)
                {
                    //data es el id que retorno la tabla OMSSH
                    $("#fotoMal0").fileinput('refresh',
                        {
                            uploadUrl:
                            "https://cointic.com.mx/preveer/sistema/index.php/CrudOMSSH/subirFoto/fotoMal0/OMSSH/"+data
                        });
                    $("#fotoMal1").fileinput('refresh',
                        {
                            uploadUrl:
                            "https://cointic.com.mx/preveer/sistema/index.php/CrudOMSSH/subirFoto/fotoMal1/OMSSH/"+data
                        });

                    $("#modalFoto").modal("hide");
                    $("#fotoMal0").fileinput('upload');
                    $("#fotoMal1").fileinput('upload');
                    console.log("OK");
                }
            }
        );
    }

    function imprimirCambios()
    {
        swal({
            title: '¡Atención!',
            text: '¿Está seguro de imprimir los cambios?',
            type: 'info',
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: false,
        }, function (isConfirm)
        {
            if(isConfirm)
            {

                //TODO: GUARDAR UNA COPIA EN UNA TABLA
                var idcent=$("#idcent").val();
                //1. Guardar los cambios del formulario
                cantidadCalculoInforme=<?=$contadorCalculoInforme?>;
                cantidadIndicadorInforme=<?=$contadorIndicadorInforme?>;
                accion = "registrarInformeBitacora/"+$("#idAsignacion").val()+"/"+$("#idBitacora").val()+"/"+cantidadIndicadorInforme+"/"+cantidadCalculoInforme;
                var url = "<?=site_url('CrudBitacoras/')?>" + accion;
                var formData=new FormData(document.getElementById("formularioInforme"));
                $.ajax({
                    url: url,
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache : false,
                    contentType: false,
                    processData: false,
                    success: function (data)
                    {
                        //2. Respaldar los datos de la base de datos.
                        $.ajax({
                            url: '<?=site_url('CrudBitacoras/respaldarBitacora/')?>'+$("#idAsignacion").val()+"/"+$("#idBitacora").val()+"/"+idcent,
                            dataType: 'html',
                            cache: false,
                            processData: false,
                            contentType: false,
                            success: function (data)
                            {
                                swal({
                                    title: "Éxito",
                                    text: "Se ha guardado el historial de la bitacora",
                                    type: "success",
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Ver formato"
                                }, function()
                                {
                                    //TODO: ABRIR EL PDF DE LA BITACORA ACTUAL
                                    //3. Ver el pdf
                                    visualPdf()
                                });
                            }
                        });


                    }
                })


            }
        });
    }

    function visualPdf()
    {
        var idcent=$("#idcent").val();
        window.open("<?=site_url('CrudBitacoras/verPDF/')?>"+idcent+"/"+$("#idBitacora").val());
    }

    $("#formularioInforme").on("submit", function(e){
        e.preventDefault();
        cantidadCalculoInforme=<?=$contadorCalculoInforme?>;
        cantidadIndicadorInforme=<?=$contadorIndicadorInforme?>;
        accion = "registrarInformeBitacora/"+$("#idAsignacion").val()+"/"+$("#idBitacora").val()+"/"+cantidadIndicadorInforme+"/"+cantidadCalculoInforme;
        var url = "<?=site_url('CrudBitacoras/')?>" + accion;
        var formData=new FormData(document.getElementById("formularioInforme"));

        $.ajax({
            url: url,
            type: "post",
            dataType: "html",
            data: formData,
            cache : false,
            contentType: false,
            processData: false

        }).done(function (res)
        {
            swal({
                title: "Éxito",
                text: "Se ha registrado la bitacora",
                type: "success",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar"
            }, function(){
                location.reload();
            });
        });
    });
    //ultimo valor numerico hace referencia al contador de la fila. El contador es el numero del calculo. Ejemplo: numero de bloqueados
    var ultimoValorNumerico=0;
    var arregloTemporal={'datos':[]};
    var consecutivo=<?=(empty($contadorRegistros))? "0" : $contadorRegistros?>;
    $("#form").on("submit", function(e){
        e.preventDefault();
        console.log("contar sobre: "+<?=$idContador?>);
        //AgregarDatosBitacora();
        getTodoSelec()

    });

    function getTodoSelec(){
        arregloTemporal={'datos':[]};
        var tableRow='<td>'+consecutivo+'</td>';
        var idBitacora = $("#idBitacora").val();
        $.ajax({
            url : "<?php echo site_url('CrudBitacoras/traerIdind')?>/" + idBitacora,
            type: "post",
            dataType: "json",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i=0; i< data.length; i++){
                        tableRow+=AgregarDatosBitacora(data[i]['idIndicador']);

                        //alert(data[i]['idIndicador'])
                    }

                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }, complete: function()
            {

                console.table(arregloTemporal.datos);

                var formData=new FormData(document.getElementById("formDatosBitacora"));
                formData.append('datos', (JSON.stringify(arregloTemporal.datos)));
                $.ajax(
                    {
                        url: "<?=site_url('CrudBitacoras/insertarArregloAutoadministrable/' . $idAsignacion . '/' . $idBitacora);?>",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: 'html',
                        type: 'post',
                        success: function (llavePrimaria)
                        {
                            tableRow="<tr><td style='display: none;'>"+llavePrimaria+"</td>"+tableRow;
                            tableRow += '<td><button type="button" class="btn btn-default" onClick="modalFotos('+llavePrimaria+')"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
                                '<td><button type="button" class="btn btn-defaultBorrar" onclick="eliminarRegistro('+llavePrimaria+')" id="eliminar'+llavePrimaria+'" ><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>';
                            $("#lista").append(tableRow);


                        },
                        complete: function()
                        {
                            $.ajax(
                                {
                                    url: "<?=site_url('CrudBitacoras/getCondicionesBitacora/'.$idBitacora);?>",
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    dataType: 'json',
                                    type: 'post',
                                    success: function (condicion)
                                    {


                                        for(i=0; i<arregloTemporal.datos.length; i++)
                                        {
                                            if(arregloTemporal.datos[i])
                                            {
                                                arregloIndicesCondiciones=[];
                                                valorDescripcion=[];
                                                //console.log("Trabajando sobre el indicador: "+i);
                                                //el codigo es el mismo que el de php de arriba
                                                for(j=0; j<condicion.length; j++)
                                                {

                                                    if(condicion[j]['idIndicador']==i)
                                                    {
                                                        //console.log("Indicador "+i+" encontrado en la condicion");
                                                        operadorCondicion=condicion[j]['condicion'];
                                                        expresion=false;

                                                        if(operadorCondicion!="includes")
                                                            expresion=eval("(function(){ " +
                                                                "if("+condicion[j]['tipoIndicador']+"!=3)" +
                                                                " return '"+arregloTemporal.datos[i].toLowerCase().trim()+"' "+condicion[j]['condicion']+" '"+condicion[j]['valorCondicion'].toLowerCase().trim()+"'; " +
                                                                "else{" +
                                                                "var d = new Date('"+arregloTemporal.datos[i]+"');" +
                                                                "var d2 = new Date('"+condicion[j]['valorCondicion']+"');" +
                                                                "n = d.getTime()"+condicion[j]['condicion']+"d2.getTime();" +
                                                                "return n;}}())");
                                                        else
                                                            expresion=eval("(function(){var str='"+arregloTemporal.datos[i].toLowerCase().trim()+"'; return str.includes('"+condicion[j]['valorCondicion'].toLowerCase().trim()+"';}())");

                                                        if(!arregloIndicesCondiciones[condicion[j]['idIndicadorCalculo']])
                                                            arregloIndicesCondiciones[condicion[j]['idIndicadorCalculo']]=[];

                                                        arregloIndicesCondiciones[condicion[j]['idIndicadorCalculo']].push(expresion);
                                                            valorDescripcion[condicion[j]['idIndicadorCalculo']]=condicion[j]['idIndicadorCalculo'];


                                                    }
                                                }
                                                tipoIndicador= ($("#idIndic"+i).prop("tagName"))? 1 : (($("#abiert"+i).prop("tagName")) ? 2 : 3) ;
                                                //console.log("Trabajando sobre el tipoIndicador"+tipoIndicador+" del indicador: "+i );

                                                if(tipoIndicador==1 || tipoIndicador==2)
                                                {
                                                    valorDescripcion.forEach(function(valor)
                                                    {
                                                        //console.log("el valor es: "+valor);
                                                        seTomaEnCuenta=false;
                                                        for(indice=0; indice<arregloIndicesCondiciones[valor].length; indice++)
                                                        {
                                                            if(arregloIndicesCondiciones[valor][indice])
                                                            {
                                                                seTomaEnCuenta=true;
                                                                break;
                                                            }
                                                        }
                                                        //console.log("Se tomaen cuenta: "+seTomaEnCuenta);
                                                        if(seTomaEnCuenta)
                                                        {
                                                            //SUMAR
                                                            cantidadIndicador=$("#cantidad"+valor).val();
                                                            if(cantidadIndicador)
                                                            {
                                                                $("#cantidad"+valor).val(parseInt(cantidadIndicador)+1);
                                                                $("#numero"+valor).val($("#numero"+valor).val()+","+ultimoValorNumerico);
                                                            }
                                                            else
                                                            {
                                                                $("#cantidad"+valor).val(1);
                                                                $("#numero"+valor).val(ultimoValorNumerico);
                                                            }
                                                        }
                                                    });

                                                }
                                                else if(tipoIndicador==3)
                                                {
                                                    valorDescripcion.forEach(function(valor)
                                                    {
                                                        seTomaEnCuenta=false;
                                                        for(indice=0; indice<arregloIndicesCondiciones[valor].length; indice++)
                                                        {
                                                            if(arregloIndicesCondiciones[valor][indice])
                                                            {
                                                                seTomaEnCuenta=true;
                                                            }
                                                            else
                                                            {
                                                                seTomaEnCuenta=false;
                                                                break;
                                                            }
                                                        }
                                                        //console.log("Se toma en cuenta: "+seTomaEnCuenta);
                                                        if(seTomaEnCuenta)
                                                        {
                                                            //SUMAR
                                                            cantidadIndicador=$("#cantidad"+valor).val();
                                                            if(cantidadIndicador)
                                                            {
                                                                $("#cantidad"+valor).val(parseInt(cantidadIndicador)+1);
                                                                $("#numero"+valor).val($("#numero"+valor).val()+","+ultimoValorNumerico);
                                                            }
                                                            else
                                                            {
                                                                $("#cantidad"+valor).val(1);
                                                                $("#numero"+valor).val(ultimoValorNumerico);
                                                            }
                                                        }
                                                    });

                                                }
                                            }
                                        }
                                        arregloTemporal.datos=[];

                                        $("#cantidadColocados").val(consecutivo);
                                        consecutivo++;

                                    }
                                }
                            );
                        }
                    }
                );

            }
        });
    }

    function AgregarDatosBitacora(idInd)
    {

        var abiert = $("#abiert"+idInd).length;
        var idIndic = $("#idIndic"+idInd).length;
        var fech = $("#fech"+idInd).length;

        if(abiert)
        {
            arregloTemporal.datos[idInd]=$("#abiert"+idInd).val();
            if(idInd==<?=$idContador?>)
            {
                ultimoValorNumerico=arregloTemporal.datos[idInd];
                console.log("ultimo valor numerico: "+ultimoValorNumerico);
            }
            return '<td>'+$("#abiert"+idInd).val()+'</td>';
        }
        else if (idIndic)
        {
            arregloTemporal.datos[idInd]=$("#idIndic"+idInd+" option:selected").text();
            if(idInd==<?=$idContador?>)
            {
                ultimoValorNumerico=arregloTemporal.datos[idInd];
                console.log("ultimo valor numerico: "+ultimoValorNumerico);
            }
            return '<td>'+$("#idIndic"+idInd+" option:selected").text()+'</td>';
        }
        else if(fech)
        {
            arregloTemporal.datos[idInd]=$("#fech"+idInd).val();
            if(idInd==<?=$idContador?>)
            {
                ultimoValorNumerico=arregloTemporal.datos[idInd];
                console.log("ultimo valor numerico: "+ultimoValorNumerico);
            }
            return '<td>'+$("#fech"+idInd).val()+'</td>';
        }
        //guarda el valor del numero que se mostrara en: numero de bloqueados, requieren recarga, etc.





        // var arregloTemporal={'datos':[]};
        // arregloTemporal.datos.push({'lugarCorrecto': lugarCorrecto ,'libreObstruccion': libreObstruccion, 'senialamientoCorrecto': senialamientoCorrecto, 'fechaRecarga': fechaRecarga,'peso': peso,'unidadPortacion':unidadPortacion,'manometro':manometro, 'seguro': seguro , 'collarin':collarin,'holograma':holograma,'manguera':manguera, 'boquilla' : boquilla,'palanca' : palanca,'limpieza' : limpieza,'gabinete' : gabinete  ,'soporte' : soporte , 'altura' : altura , 'cilindro' : cilindro ,'fechaFabricacion' : fechaFabricacion , 'pruebaHidrostatica' : pruebaHidrostatica ,'agente' : agente, 'tipoFuego' : tipoFuego , 'observaciones': observaciones});

        // var formData=new FormData(document.getElementById("formDatosBitacora"));
        // formData.append('datos', (JSON.stringify(arregloTemporal.datos)));

        // $.ajax(
        //     {
        //         url: "<?=site_url('CrudBitacoras/insertarArreglo/'.$idAsignacion.'/BitacoraExtintores');?>",
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //         dataType: 'html',
        //         type: 'post',
        //         success: function (llavePrimaria)
        //         {
        //             console.log(llavePrimaria);
        //             array.datosBitacora.push({'idBitacora': llavePrimaria, 'lugarCorrecto': lugarCorrecto ,'libreObstruccion': libreObstruccion, 'senialamientoCorrecto': senialamientoCorrecto, 'fechaRecarga': fechaRecarga,'peso': peso,'unidadPortacion':unidadPortacion,'manometro':manometro, 'seguro': seguro , 'collarin':collarin,'holograma':holograma,'manguera':manguera, 'boquilla' : boquilla,'palanca' : palanca,'limpieza' : limpieza,'gabinete' : gabinete  ,'soporte' : soporte , 'altura' : altura , 'cilindro' : cilindro ,'fechaFabricacion' : fechaFabricacion , 'pruebaHidrostatica' : pruebaHidrostatica ,'agente' : agente, 'tipoFuego' : tipoFuego , 'action' : 0, 'observaciones': observaciones});

        //             $("#lista").append('<tr>'+
        //                 '<td>'+$("#lugarCorrecto option:selected").text()+'</td>'+
        //                 '<td>'+$("#libreObstruccion option:selected").text()+'</td>'+
        //                 '<td>'+$("#senialamientoCorrecto option:selected").text()+'</td>'+
        //                 '<td>'+$("#fechaRecarga").val()+'</td>'+
        //                 '<td>'+$("#peso").val()+'</td>'+
        //                 '<td>'+$("#unidadPortacion option:selected").text()+'</td>'+
        //                 '<td>'+$("#manometro option:selected").text()+'</td>'+
        //                 '<td>'+$("#seguro option:selected").text()+'</td>'+
        //                 '<td>'+$("#collarin option:selected").text()+'</td>'+
        //                 '<td>'+$("#holograma option:selected").text()+'</td>'+
        //                 '<td>'+$("#manguera option:selected").text()+'</td>'+
        //                 '<td>'+$("#boquilla option:selected").text()+'</td>'+
        //                 '<td>'+$("#palanca option:selected").text()+'</td>'+
        //                 '<td>'+$("#limpieza option:selected").text()+'</td>'+
        //                 '<td>'+$("#gabinete option:selected").text()+'</td>'+
        //                 '<td>'+$("#soporte option:selected").text()+'</td>'+
        //                 '<td>'+$("#altura option:selected").text()+'</td>'+
        //                 '<td>'+$("#cilindro option:selected").text()+'</td>'+
        //                 '<td>'+$("#fechaFabricacion").val()+'</td>'+
        //                 '<td>'+$("#pruebaHidrostatica").val()+'</td>'+
        //                 '<td>'+$("#agente option:selected").text()+'</td>'+
        //                 '<td>'+$("#tipoFuego option:selected").text()+'</td>'+
        //                 '<td>'+observaciones+'</td>'+
        //                 '<td><button type="button" class="btn btn-default" onClick="modalFotos('+llavePrimaria+')"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
        //                 '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
        //                 '</tr>');
        //             console.log(JSON.stringify(array.datosBitacora, null, 4));
        //             limpiarFormulario();
        //         }
        //     }
        // );

    }

    function limpiarFormulario()
    {
        swal();
    }

    function eliminarRegistro(llavePrimaria)
    {
        swal({
            title: '¡Precaución!',
            text: '¿Está seguro de eliminar este registro?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: "Si, quiero eliminarlo"
        }, function (isConfirm)
        {
            if(isConfirm)
            {

                $.ajax(
                    {
                        url: '<?=site_url("CrudBitacoras/eliminarAlmacenamiento/")?>'+llavePrimaria,
                        contentType: false,
                        complete: function ()
                        {
                            var btnEliminar=$("#eliminar"+llavePrimaria);
                            $(btnEliminar).closest('tr').hide();
                        }
                    }
                );


            }
        });




    }

    //SE COMENTO ESTE CODIGO PARA EVITAR CREAR EL ARREGLO DINAMICO
    // $(document).on('click', '.btn-defaultBorrar', function (event) {
    //     event.preventDefault();
    //     var indice =  $(this).closest('tr').index();
    //     if(array.datosBitacora[indice]['idBitacora'] == -1)
    //     {
    //         array.datosBitacora.splice(indice, 1);
    //         $(this).closest('tr').remove();
    //     }
    //     else
    //     {
    //         array.datosBitacora[indice]['action']=3;
    //         $(this).closest('tr').hide();
    //     }
    //
    //     console.log(JSON.stringify(array.datosBitacora, null, 4));
    //
    // });


</script>


<script>
    $(document).ready(function()
    {
        informeBitacora=null;
        //obtiene los respaldos que existen de esa bitacora
        $.ajax({
            url: '<?=site_url("CrudBitacoras/obtenerRespaldos/$idAsignacion/$idBitacora")?>',
            contentType: false,
            dataType: 'JSON',
            processData: false,
            success: function (response)
            {

                for(i=0; i<response.length; i++)
                {

                    $("#bitacorasAnteriores").append("<option value='"+response[i]['idBitacoraRespaldo']+"'>"+response[i]['fecha']+"</option>");
                }
            }
        });
        $.ajax(
            {
                url: '<?=site_url('CrudBitacoras/getInformeBitacora/' . $idAsignacion . "/" . $idBitacora)?>',
                contentType: false,
                dataType: 'json',
                success: function (data)
                {
                    $("#observacionesGenerales").val(data[0]['comentarios']);
                    informeBitacora=data[0]['idInformeBitacora'];
                },
                complete: function()
                {
                    $.ajax(
                        {
                            url: '<?=site_url('CrudBitacoras/getDatoInformeBitacora/')?>'+informeBitacora,
                            contentType: false,
                            dataType: 'json',
                            success: function (data)
                            {
                                for(i=0; i<data.length; i++)
                                {
                                    $("#indicadorInforme"+data[i]['idIndicadorBitacora']).val(data[i]['valor']);
                                }
                            }
                        });
                    $.ajax(
                        {
                            url: '<?=site_url('CrudBitacoras/getCalculoInforme/')?>'+informeBitacora,
                            contentType: false,
                            dataType: 'json',
                            success: function (data)
                            {
                                for(i=0; i<data.length; i++)
                                {
                                    tipoIndicador=data[i]['tipoIndicador'];
                                    $("#observaciones"+data[i]['idCalculo']).val(data[i]['observaciones']);
                                    if(tipoIndicador==4)
                                    {
                                        $("#numero"+data[i]['idCalculo']).val(data[i]['numero']);
                                        $("#cantidad"+data[i]['idCalculo']).val(data[i]['cantidad']);

                                    }
                                }
                            }
                        });
                }
            });

    });
    $('#tablaBitacora').Tabledit({
        url: '<?=site_url('/CrudBitacoras/editarFilaBitacora/'.$contadorTh)?>',
        editButton: false,
        deleteButton: false,
        autoFocus: false,
        columns: {
            identifier: [0, 'identificador'],
            editable: [<?php
                    $tableEditContador=2;
                foreach ($indicadores as $row)
                {
                    $id=$row['idIndicador'];
                    $tipo=$row['tipoIndicador'];
                    //selects
                    if($tipo==1)
                    {
                        $json="{";
                        foreach ($ponderador[$id] as $value)
                        {
                            foreach ($value as $ponderacion)
                            {
                                $json .= "\"" . $ponderacion['texto'] . "\":\"" . $ponderacion['texto'] . "\",";
                            }
                        }
                        $json=rtrim($json, ",")."}";
                        echo "[$tableEditContador, '$id', '$json'],";
                        $tableEditContador++;
                    }
                    //textos y fechas
                    else if($tipo!=4)
                    {
                        echo "[$tableEditContador, '$id'],";
                        $tableEditContador++;
                    }
                }
                ?>]

        }
    });

    window.onload=traerPonde;
    function traerPonde()
    {
        var idu = $("#idBitacora").val();
        $.ajax({
            url : "<?php echo site_url('CrudBitacoras/obtenerPonde')?>/" + idu,
            type: "post",
            dataType: "json",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i=0; i< data.length; i++){
                        pintatPonde(data[i]['idIndicador']);
                        //alert(data[i]['idIndicador'])
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log('Error get data from ajax');
            }
        });


    }

    function pintatPonde(idIn){
        $.ajax({
            url : "<?php echo site_url('CrudBitacoras/obtenerPondeIndica')?>/" + idIn,
            type: "post",
            dataType: "json",
            success: function(data)
            {
                $("#idIndic"+idIn).append('<option value ="">Seleccione una opción</option>');
                if (data.length>0)
                {
                    for (i=0; i< data.length; i++){
                        $("#idIndic"+idIn).append(new Option(data[i]['texto'],data[i]['idBitacoraPonderador']));
                        //alert(data[i]['idIndicador'])
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log('Error get data from ajax');
            }
        });
    }
    function verBitacoraAnterior(idAsignacion, idBitacora)
    {
        var idcen=$("#idcent").val();
        var respaldo=$("#bitacorasAnteriores").val();
        if(respaldo)
            window.open("<?=site_url('CrudBitacoras/verPDFAnterior/')?>"+idcen+"/"+idBitacora+"/"+respaldo);
    }
</script>

<?php
include "footer.php";
?>
