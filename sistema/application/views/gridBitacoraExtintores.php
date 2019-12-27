<?php
include "header.php";
?>


<style type="text/css">
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
        /*display:  !important;*/
    }
    .centrado>tr>td>div>div
    {
        vertical-align: middle !important;
        align: center !important;
        text-align: center !important;
        /*display:  !important;*/
    }
    .centrado>tr>td>input
    {
        text-align: center !important;
    }

</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                        <h2>Bitácora extintores</h2>
                    </div>
                    <div class="body">
                        <form id="formDatosBitacora"></form>
                        <form id="form">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
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
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Extintor en su lugar</b>
                                                            <select class="form-control" id="lugarCorrecto" name="lugarCorrecto" required>
                                                                <?php if($areasUbicacion):?>
                                                                <?php foreach($areasUbicacion as $row):?>
                                                                <option value="<?=$row['idArea']?>"><?=$row['descripcion']?></option>
                                                                <?endforeach; ?>
                                                                <?php endif;?>

                                                                <!-- <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option> -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Libre de obstrucción</b>
                                                            <select class="form-control" id="libreObstruccion" name="libreObstruccion" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Señalamiento correcto y en buen estado</b>
                                                            <select class="form-control" id="senialamientoCorrecto" name="senialamientoCorrecto" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha recarga</b>
                                                            <input type="date" class="form-control" id="fechaRecarga" name="fechaRecarga" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Peso(Kg/L)</b>
                                                            <input type="number" class="form-control" id="peso" name="peso" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Unidad móvil / portatil</b>
                                                            <select class="form-control" id="unidadPortacion" name="unidadPortacion" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Manómetro con presión y buen estado</b>
                                                            <select class="form-control" id="manometro" name="manometro" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cuenta con seguro</b>
                                                            <select class="form-control" id="seguro" name="seguro" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cuenta con collarín</b>
                                                            <select class="form-control" id="collarin" name="collarin" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cuenta con  holograma</b>
                                                            <select class="form-control" id="holograma" name="holograma" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Manguera</b>
                                                            <select class="form-control" id="manguera" name="manguera" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Boquilla</b>
                                                            <select class="form-control" id="boquilla" name="boquilla" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Palanca</b>
                                                            <select class="form-control" id="palanca" name="palanca" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Limpieza</b>
                                                            <select class="form-control" id="limpieza" name="limpieza" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Gabinete</b>
                                                            <select class="form-control" id="gabinete" name="gabinete" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Soporte</b>
                                                            <select class="form-control" id="soporte" name="soporte" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Altura 1.50m</b>
                                                            <select class="form-control" id="altura" name="altura" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cilindro sin corrosión y sin golpes</b>
                                                            <select class="form-control" id="cilindro" name="cilindro" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                                <option value="3">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha fabricación</b>
                                                            <input type="date" class="form-control" id="fechaFabricacion" name="fechaFabricacion" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Ultima prueba hidrostática</b>
                                                            <input type="date" class="form-control" id="pruebaHidrostatica" name="pruebaHidrostatica" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Agente extinguidor</b>
                                                            <select class="form-control" id="agente" name="agente" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Agua</option>
                                                                <option value="2">PQS</option>
                                                                <option value="3">CO2</option>
                                                                <option value="4">Espuma mecánica</option>
                                                                <option value="5">Agentes especiales</option>
                                                                <option value="6">Quimico húmedo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tipo de fuego</b>
                                                            <select class="form-control" id="tipoFuego" name="tipoFuego" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">ABC</option>
                                                                <option value="2">BC</option>
                                                                <option value="3">D</option>
                                                                <option value="4">K</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <textarea type="text" class="form-control" id="observaciones" name="observaciones" min="0" > </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <div class="row text-center">
                                                    <div class="col-sm-12 col-md-12 col-lg-12 col-md-offset-5">
                                                        <div class="form-line">
                                                            <input type="submit" value="Agregar" class="btn bg-red" id="agregar-in">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="body table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Lugar</th>
                                                        <th>Obstrucción</th>
                                                        <th>Señalamiento</th>
                                                        <th>Fecha recarga</th>
                                                        <th>Peso</th>
                                                        <th>Unidad</th>
                                                        <th>Manómetro</th>
                                                        <th>Seguro</th>
                                                        <th>Collarín</th>
                                                        <th>Holograma</th>
                                                        <th>Manguera</th>
                                                        <th>Boquilla</th>
                                                        <th>Palanca</th>
                                                        <th>Limpieza</th>
                                                        <th>Gabinete</th>
                                                        <th>Soporte</th>
                                                        <th>Altura</th>
                                                        <th>Cilindro</th>
                                                        <th>Fecha fabricación</th>
                                                        <th>Prueba hidrostática</th>
                                                        <th>Agente</th>
                                                        <th>Tipo Fuego</th>
                                                        <th>Observaciones</th>
                                                        <th>Oportunidades de mejora</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="lista">

                                                    </tbody>

                                                </table>
                                            </div>
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
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total de extintores colocados</b>
                                                            <input type="number" class="form-control" name="cantidadColocados" id="cantidadColocados" value="<?=$resultadosBitacora[0]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total de extintores de reserva</b>
                                                            <input type="number" class="form-control" name="cantidadReserva" id="cantidadReserva" value="<?=$resultadosBitacora[1]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total de extintores en mantenimiento/recarga</b>
                                                            <input type="text" class="form-control" name="cantidadMantenimiento" id="cantidadMantenimiento" value="<?=$resultadosBitacora[2]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Bloqueados-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores bloqueado</b>
                                                            <input type="number" class="form-control" name="cantidadBloqueados" id="cantidadBloqueados" value="<?=$resultadosBitacora[3]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintores bloqueados</b>
                                                            <input type="number" class="form-control" name="numeroBloqueados" id="numeroBloqueados" value="<?=$resultadosBitacora[3]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesBloqueados" id="observacionesBloqueados" value="<?=$resultadosBitacora[3]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Limpieza-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores que requieren limpieza</b>
                                                            <input type="number" class="form-control" name="cantidadLimpieza" id="cantidadLimpieza" value="<?=$resultadosBitacora[4]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintores que requieren limpieza</b>
                                                            <input type="number" class="form-control" name="numeroLimpieza" id="numeroLimpieza" value="<?=$resultadosBitacora[4]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesLimpieza" id="observacionesLimpieza" value="<?=$resultadosBitacora[4]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Recarga-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores que requieren recarga</b>
                                                            <input type="number" class="form-control" name="cantidadRecarga" id="cantidadRecarga" value="<?=$resultadosBitacora[5]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintores que requiere recarga</b>
                                                            <input type="number" class="form-control" name="numeroRecarga" id="numeroRecarga" value="<?=$resultadosBitacora[5]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesRecarga" id="observacionesRecarga" value="<?=$resultadosBitacora[5]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Sobrecarga-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores que marcan sobrecarga</b>
                                                            <input type="number" class="form-control" name="cantidadSobrecarga" id="cantidadSobrecarga" value="<?=$resultadosBitacora[6]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintores que marcan sobrecarga</b>
                                                            <input type="number" class="form-control" name="numeroSobrecarga" id="numeroSobrecarga" value="<?=$resultadosBitacora[6]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesSobrecarga" id="observacionesSobrecarga" value="<?=$resultadosBitacora[6]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Daño-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores con algún daño físico (corrosión, golpes, perdida de pintura)</b>
                                                            <input type="number" class="form-control" name="cantidadDano" id="cantidadDano" value="<?=$resultadosBitacora[7]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintores con algún daño físico (corrosión, golpes, perdida de pintura)</b>
                                                            <input type="number" class="form-control" name="numeroDano" id="numeroDano" value="<?=$resultadosBitacora[7]['numero']?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesDano" id="observacionesDano" value="<?=$resultadosBitacora[7]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Boquilla-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores que tienen boquilla, palanca y/o manguera en malas condiciones</b>
                                                            <input type="number" class="form-control" name="cantidadBoquilla" id="cantidadBoquilla" value="<?=$resultadosBitacora[8]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintor que tiene la boquilla, palanca y/o manguera en malas condiciones</b>
                                                            <input type="number" class="form-control" name="numeroBoquilla" id="numeroBoquilla"value="<?=$resultadosBitacora[8]['numero']?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesBoquilla" id="observacionesBoquilla" value="<?=$resultadosBitacora[8]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Etiqueta-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores sin etiqueta de servicio de mantenimiento</b>
                                                            <input type="number" class="form-control" name="cantidadEtiqueta" id="cantidadEtiqueta" value="<?=$resultadosBitacora[9]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintor sin etiqueta de servicio de mantenimiento</b>
                                                            <input type="number" class="form-control" name="numeroEtiqueta" id="numeroEtiqueta" value="<?=$resultadosBitacora[9]['numero']?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesEtiqueta" id="observacionesEtiqueta" value="<?=$resultadosBitacora[9]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Señalamiento-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores sin señalamiento</b>
                                                            <input type="number" class="form-control" name="cantidadSenalamiento" id="cantidadSenalamiento" value="<?=$resultadosBitacora[10]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintor sin señalamiento</b>
                                                            <input type="number" class="form-control" name="numeroSenalamiento" id="numeroSenalamiento" value="<?=$resultadosBitacora[10]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesSenalamiento" id="observacionesSenalamiento" value="<?=$resultadosBitacora[10]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Altura-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores a una altura mayor a 1.5 metros</b>
                                                            <input type="number" class="form-control" name="cantidadAltura" id="cantidadAltura" value="<?=$resultadosBitacora[11]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintor a una altura mayor a 1.5 metros</b>
                                                            <input type="number" class="form-control" name="numeroAltura" id="numeroAltura" value="<?=$resultadosBitacora[11]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesAltura" id="observacionesAltura" value="<?=$resultadosBitacora[11]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Suelo-->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de extintores en contacto con el suelo</b>
                                                            <input type="number" class="form-control" name="cantidadSuelo" id="cantidadSuelo" value="<?=$resultadosBitacora[12]['cantidad']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de extintor en contacto con el suelo</b>
                                                            <input type="number" class="form-control" name="numeroSuelo" id="numeroSuelo" value="<?=$resultadosBitacora[12]['numero']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <input type="text" class="form-control" name="observacionesSuelo" id="observacionesSuelo" value="<?=$resultadosBitacora[12]['observaciones']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Comentarios y/o observaciones</b>
                                                            <textarea class="form-control" name="observacionesGenerales" id="observacionesGenerales" ><?=$resultadosBitacora[13]['observaciones']?></textarea>
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
                        <div class="row text-center">
                            <div class="col-sm-12 col-md-offset-5">
                                <div class="form-line">
                                    <input type="submit" onclick="registrarDatos();" class="btn bg-red waves-effect waves-light"  value="Guardar">
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
                Oportunidades de mejora del extintor
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
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraExtintor1\" name=\"fotoOportunidadMejoraExtintor1[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraExtintor2\" name=\"fotoOportunidadMejoraExtintor2[]\" >\n" +
            "                        </div>\n" +
            "                        <div class=\"col-md-4\">\n" +
            "                            <input type=\"file\" id=\"fotoOportunidadMejoraExtintor3\" name=\"fotoOportunidadMejoraExtintor3[]\" >\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                    <div class=\"row\">\n" +
            "                        <div class=\"col-md-6 col-md-offset-3\">\n" +
            "                            <div class=\"form-group\">\n" +
            "                                <div class=\"form-line\">\n" +
            "                                    <b>Oportunidad de mejora</b>\n" +
            "                                    <textarea class=\"form-control\" id=\"oportunidadMejoraExtintor\" name=\"oportunidadMejoraExtintor\" onblur=\"subirOportunidadMejora()\"></textarea>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>");
        llavePrimariaActual=llavePrimaria;
        var nombreTabla='OportunidadMejoraExtintor';
        var campoLlave='idBitacora';
        $.ajax(
            {
                url: "<?=site_url("CrudBitacoras/getOportunidadMejora/")?>"+llavePrimaria+"/"+nombreTabla,
                dataType: 'json',
                processData: false,
                cache: false,
                contentType: false,
                success: function (data)
                {
                    var nombreCampo = data[0];

                    for (var key in nombreCampo)
                    {
                        if(key.includes("foto"))
                            crearFileInputTabla(key, data[0][key],nombreTabla, llavePrimaria, campoLlave);
                        else if(key.includes("oportunidad"))
                        {
                            $("#"+key).val(data[0][key]);
                        }
                    }
                }
            }
        );
        $("#modalFoto").modal();
    }
    function crearFileInputTabla(nombreCampo, valorCampo, tabla, llavePrimaria, campoLlave )
    {

        imagen='';
        if(valorCampo)
        {

            imagen="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoBitacoras/"+nombreCampo+"/"+valorCampo+"' class='file-preview-image'>";
        }
        $('#'+nombreCampo).fileinput({
            'resizeImage': true,
            'maxImageWidth': 300,
            'maxImageHeight': 300,
            'resizePreference': 'width',
            'showUploadedThumbs': false,
            'showCaption': false,
            'showCancel': false,
            'showRemove': false,
            'showUpload': false,
            'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/subirFotoGeneralTabla/"+nombreCampo+"/"+tabla+"/"+llavePrimaria+"/"+campoLlave+"",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png'],
            'initialPreview' : [imagen]
        }).on('change', function (event, data, previewId, index) {

            $("#"+nombreCampo).fileinput("upload");

        }).on('fileclear', function (event) {
            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/eliminarImagenArreglo/"+nombreCampo+"/"+tabla+"/"+llavePrimaria+"/"+campoLlave;
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
    }
    function subirOportunidadMejora()
    {

        var oportunidad=$("#oportunidadMejoraExtintor").val();
        oportunidad=oportunidad.replace(" ", "%20");
        oportunidad=oportunidad.replace("/", "%30");
        $.ajax(
            {
                url: "<?=site_url('CrudBitacoras/subirOportunidadMejora/')?>"+oportunidad+"/"+llavePrimariaActual+"/OportunidadMejoraExtintor/oportunidadMejoraExtintor",
                dataType: 'html',
                processData: false,
                contentType: false,
                cache: false,
                type: 'post',
                success: function (data)
                {
                    $("#modalFoto").modal("hide");
                }
            }
        );
    }



    function registrarDatos()
    {

        accion = "actualizarBitacora003/"+$("#idAsignacion").val();
        var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/';?>" + accion;
        var formData=new FormData(document.getElementById("form"));
        formData.append('datosBitacora', (JSON.stringify(array.datosBitacora)));

        console.log(JSON.stringify(array.datosBitacora));
        $.ajax({
            url: url,
            type: "post",
            dataType: "html",
            data: formData,
            cache : false,
            contentType: false,
            processData: false

        }).done(function (res) {
            console.log(res);
            swal({
                    title: "Éxito",
                    text: "Se ha registrado la bitacora",
                    type: "success",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                },
                function () {
                    location.href = 'https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/bitacora003/' + $("#idAsignacion").val();
                });
        });

    }


    $("#form").on("submit", function(e){
        e.preventDefault();
        AgregarDatosBitacora();
    });


    function AgregarDatosBitacora()
    {
        var lugarCorrecto = $("#lugarCorrecto").val();
        var libreObstruccion = $("#libreObstruccion").val();
        var senialamientoCorrecto = $("#senialamientoCorrecto").val();
        var fechaRecarga = $("#fechaRecarga").val();
        var peso = $('#peso').val();
        var unidadPortacion = $('#unidadPortacion').val();
        var manometro = $('#manometro').val();
        var seguro = $('#seguro').val();
        var collarin = $('#collarin').val();
        var holograma = $('#holograma').val();
        var manguera = $('#manguera').val();
        var boquilla = $('#boquilla').val();
        var palanca = $('#palanca').val();
        var limpieza = $('#limpieza').val();
        var gabinete = $('#gabinete').val();
        var soporte = $('#soporte').val();
        var altura = $('#altura').val();
        var cilindro = $('#cilindro').val();
        var fechaFabricacion = $('#fechaFabricacion').val();
        var pruebaHidrostatica = $('#pruebaHidrostatica').val();
        var agente = $('#agente').val();
        var tipoFuego = $('#tipoFuego').val();
        var observaciones = $('#observaciones').val();

        //array.datosBitacora.push({'idBitacora': '-1', 'lugarCorrecto': lugarCorrecto ,'libreObstruccion': libreObstruccion, 'senialamientoCorrecto': senialamientoCorrecto, 'fechaRecarga': fechaRecarga,'peso': peso,'unidadPortacion':unidadPortacion,'manometro':manometro, 'seguro': seguro , 'collarin':collarin,'holograma':holograma,'manguera':manguera, 'boquilla' : boquilla,'palanca' : palanca,'limpieza' : limpieza,'gabinete' : gabinete  ,'soporte' : soporte , 'altura' : altura , 'cilindro' : cilindro ,'fechaFabricacion' : fechaFabricacion , 'pruebaHidrostatica' : pruebaHidrostatica ,'agente' : agente, 'tipoFuego' : tipoFuego , 'action' : 1, 'observaciones': observaciones});


        var arregloTemporal={'datos':[]};
        arregloTemporal.datos.push({'lugarCorrecto': lugarCorrecto ,'libreObstruccion': libreObstruccion, 'senialamientoCorrecto': senialamientoCorrecto, 'fechaRecarga': fechaRecarga,'peso': peso,'unidadPortacion':unidadPortacion,'manometro':manometro, 'seguro': seguro , 'collarin':collarin,'holograma':holograma,'manguera':manguera, 'boquilla' : boquilla,'palanca' : palanca,'limpieza' : limpieza,'gabinete' : gabinete  ,'soporte' : soporte , 'altura' : altura , 'cilindro' : cilindro ,'fechaFabricacion' : fechaFabricacion , 'pruebaHidrostatica' : pruebaHidrostatica ,'agente' : agente, 'tipoFuego' : tipoFuego , 'observaciones': observaciones});

        var formData=new FormData(document.getElementById("formDatosBitacora"));
        formData.append('datos', (JSON.stringify(arregloTemporal.datos)));


        //console.log(JSON.stringify(array.datosBitacora, null, 4));

        $.ajax(
            {
                url: "<?=site_url('CrudBitacoras/insertarArreglo/'.$idAsignacion.'/BitacoraExtintores');?>",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'html',
                type: 'post',
                success: function (llavePrimaria)
                {
                    console.log(llavePrimaria);
                    array.datosBitacora.push({'idBitacora': llavePrimaria, 'lugarCorrecto': lugarCorrecto ,'libreObstruccion': libreObstruccion, 'senialamientoCorrecto': senialamientoCorrecto, 'fechaRecarga': fechaRecarga,'peso': peso,'unidadPortacion':unidadPortacion,'manometro':manometro, 'seguro': seguro , 'collarin':collarin,'holograma':holograma,'manguera':manguera, 'boquilla' : boquilla,'palanca' : palanca,'limpieza' : limpieza,'gabinete' : gabinete  ,'soporte' : soporte , 'altura' : altura , 'cilindro' : cilindro ,'fechaFabricacion' : fechaFabricacion , 'pruebaHidrostatica' : pruebaHidrostatica ,'agente' : agente, 'tipoFuego' : tipoFuego , 'action' : 0, 'observaciones': observaciones});

                    $("#lista").append('<tr>'+
                        '<td>'+$("#lugarCorrecto option:selected").text()+'</td>'+
                        '<td>'+$("#libreObstruccion option:selected").text()+'</td>'+
                        '<td>'+$("#senialamientoCorrecto option:selected").text()+'</td>'+
                        '<td>'+$("#fechaRecarga").val()+'</td>'+
                        '<td>'+$("#peso").val()+'</td>'+
                        '<td>'+$("#unidadPortacion option:selected").text()+'</td>'+
                        '<td>'+$("#manometro option:selected").text()+'</td>'+
                        '<td>'+$("#seguro option:selected").text()+'</td>'+
                        '<td>'+$("#collarin option:selected").text()+'</td>'+
                        '<td>'+$("#holograma option:selected").text()+'</td>'+
                        '<td>'+$("#manguera option:selected").text()+'</td>'+
                        '<td>'+$("#boquilla option:selected").text()+'</td>'+
                        '<td>'+$("#palanca option:selected").text()+'</td>'+
                        '<td>'+$("#limpieza option:selected").text()+'</td>'+
                        '<td>'+$("#gabinete option:selected").text()+'</td>'+
                        '<td>'+$("#soporte option:selected").text()+'</td>'+
                        '<td>'+$("#altura option:selected").text()+'</td>'+
                        '<td>'+$("#cilindro option:selected").text()+'</td>'+
                        '<td>'+$("#fechaFabricacion").val()+'</td>'+
                        '<td>'+$("#pruebaHidrostatica").val()+'</td>'+
                        '<td>'+$("#agente option:selected").text()+'</td>'+
                        '<td>'+$("#tipoFuego option:selected").text()+'</td>'+
                        '<td>'+observaciones+'</td>'+
                        '<td><button type="button" class="btn btn-default" onClick="modalFotos('+llavePrimaria+')"><i class="fa fa-picture-o" aria-hidden="true"></i></button></td>'+
                        '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                        '</tr>');
                    console.log(JSON.stringify(array.datosBitacora, null, 4));
                    limpiarFormulario();
                }
            }
        );

    }

    function limpiarFormulario()
    {
    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();
        var indice =  $(this).closest('tr').index();
        if(array.datosBitacora[indice]['idBitacora'] == -1)
        {
            array.datosBitacora.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosBitacora[indice]['action']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array.datosBitacora, null, 4));

    });


</script>


<script>
    window.onload = cargaDatosTabla;

    function cargaDatosTabla(){

        <?php

        foreach ($tablaBitacora as $row) {
            $idBitacora= $row['idBitacora'];
            $areaUbicacion = $row["lugarCorrecto"];
            $libreObstruccion = $row["libreObstruccion"];
            $senialamientoCorrecto = $row["senialamientoCorrecto"];
            $fechaRecarga = $row["fechaRecarga"];
            $peso = $row['peso'];
            $unidadPortacion = $row['unidadPortacion'];
            $manometro = $row['manometro'];
            $seguro = $row['seguro'];
            $collarin = $row['collarin'];
            $holograma = $row['holograma'];
            $manguera = $row['manguera'];
            $boquilla = $row['boquilla'];
            $palanca = $row['palanca'];
            $limpieza = $row['limpieza'];
            $gabinete = $row['gabinete'];
            $soporte = $row['soporte'];
            $altura = $row['altura'];
            $cilindro = $row['cilindro'];
            $fechaFabricacion = $row['fechaFabricacion'];
            $pruebaHidrostatica = $row['pruebaHidrostatica'];
            $agente = $row['agente'];
            $tipoFuego = $row['tipoFuego'];
            $observacion = $row['observaciones'];
            $idAsignacion = $row["idAsignacion"];

            print "array.datosBitacora.push({'idBitacora': '$idBitacora', 'lugarCorrecto': $areaUbicacion ,'libreObstruccion': $libreObstruccion, 'senialamientoCorrecto': $senialamientoCorrecto, 'fechaRecarga': '$fechaRecarga', 'peso': $peso,'unidadPortacion': $unidadPortacion, 'manometro': $manometro, 'seguro': $seguro, 'collarin': $collarin, 'manguera': $manguera, 'boquilla' : $boquilla,'palanca' : $palanca, 'limpieza' : $limpieza, 'action' : 0, 'gabinete' : $gabinete, 'soporte' : $soporte, 'altura' : $altura, 'cilindro' : $cilindro, 'fechaFabricacion' : '$fechaFabricacion', 'pruebaHidrostatica' : '$pruebaHidrostatica', 'agente' : $agente, 'tipoFuego' : $tipoFuego, 'observacion': '$observacion'}); \n";

            foreach ($areasUbicacion as $itemArea)
            {
                if($areaUbicacion==$itemArea['idArea'])
                {
                    $areaUbicacion=$itemArea['descripcion'];
                    break;
                }
            }

           // $lugarCorrecto= ($lugarCorrecto==1)? "Si":(($lugarCorrecto==2)? "No": "N/A");
            $libreObstruccion= ($libreObstruccion==1)? "Si":(($libreObstruccion==2)? "No": "N/A");
            $senialamientoCorrecto= ($senialamientoCorrecto==1)? "Si":(($senialamientoCorrecto==2)? "No": "N/A");
            $peso= ($peso==1)? "Si":(($peso==2)? "No": "N/A");
            $unidadPortacion= ($unidadPortacion==1)? "Si":(($unidadPortacion==2)? "No": "N/A");
            $manometro= ($manometro==1)? "Si":(($manometro==2)? "No": "N/A");
            $seguro= ($seguro==1)? "Si":(($seguro==2)? "No": "N/A");
            $collarin= ($collarin==1)? "Si":(($collarin==2)? "No": "N/A");
            $holograma= ($holograma==1)? "Si":(($holograma==2)? "No": "N/A");
            $manguera= ($manguera==1)? "Si":(($manguera==2)? "No": "N/A");
            $boquilla= ($boquilla==1)? "Si":(($boquilla==2)? "No": "N/A");
            $palanca= ($palanca==1)? "Si":(($palanca==2)? "No": "N/A");
            $limpieza= ($limpieza==1)? "Si":(($limpieza==2)? "No": "N/A");
            $gabinete= ($gabinete==1)? "Si":(($gabinete==2)? "No": "N/A");
            $soporte= ($soporte==1)? "Si":(($soporte==2)? "No": "N/A");
            $altura= ($altura==1)? "Si":(($altura==2)? "No": "N/A");
            $cilindro= ($cilindro==1)? "Si":(($cilindro==2)? "No": "N/A");
            switch($agente)
            {
                case 1:
                    $agente="Agua";
                    break;
                case 2:
                    $agente="PQS";
                    break;
                case 3:
                    $agente="CO2";
                    break;
                case 4:
                    $agente="Espuma mecánica";
                    break;
                case 5:
                    $agente="Agentes especiales";
                    break;
                case 6:
                    $agente="Químico húmedo";
                    break;

            }
            switch($tipoFuego)
            {
                case 1:
                    $tipoFuego="ABC";
                    break;
                case 2:
                    $tipoFuego="BC";
                    break;
                case 3:
                    $tipoFuego="D";
                    break;
                case 4:
                    $tipoFuego="K";
                    break;
            }

            print "$('#lista').append('<tr><td hidden>$idBitacora</td><td>$areaUbicacion</td><td>$libreObstruccion</td><td>$senialamientoCorrecto</td><td>$fechaRecarga</td><td>$peso</td><td>$unidadPortacion</td><td>$manometro</td><td>$seguro</td><td>$collarin</td><td>$holograma</td><td>$manguera</td><td>$boquilla</td><td>$palanca</td><td>$limpieza</td><td>$gabinete</td><td>$soporte</td><td>$altura</td><td>$cilindro</td><td>$fechaFabricacion</td><td>$pruebaHidrostatica</td><td>$agente</td><td>$tipoFuego</td><td>$observacion</td><td><button type=\"button\" class=\"btn btn-default\" onClick=\"modalFotos($idBitacora)\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
        }
        print("console.log(JSON.stringify(array.datosBitacora, null, 4));");
        ?>
    }

</script>


<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->