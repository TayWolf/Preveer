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

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php $tipo=$this->session->userdata('tipoUser');
            if($tipo!='' && $_SESSION['idusuariobase'] != '')
            {
                if($tipo == 3){
                    echo "<a href='".site_url('CrudAnalisisRiesgo')."/".$this->session->userdata('idusuariobase')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } else{
                    echo "<a href='".site_url('CrudAnalisisRiesgo/')."'>
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
                        <h2>Lista del alertamiento del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <form id="form" enctype="multipart/form-data" >
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">

                            <?php
                            $contador=0;
                            $row;
                            foreach ($existencia as $row2)
                            {
                                $row=$row2;
                                $contador++;
                            }
                            ?>

                            <div class="panel-body">
                                <div class="panel-group full-body" id="accordion_humo" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_humo">
                                            <h4 class="panel-title">

                                                <a role="button" data-toggle="collapse" href="#collapseOne_humo" aria-expanded="true" aria-controls="collapseOne_humo">
                                                    <i class="material-icons">smoking_rooms</i> Sensor de humo
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_humo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_humo">
                                            <div class="panel-body">

                                                <div class="row">
                                                    <input type="hidden" name="idAlertamiento" value="<?php echo $row['idAlertamiento'];?>">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <br>
                                                            <input type="checkbox" name="aplicaSensorHumo" id="aplicaSensorHumo" onChange="aplicar('aplicaSensorHumo', 'sensorHumo')" class="filled-in" value="0" <?php if($row['sensorHumoAplica']==1) echo 'checked'?>>
                                                            <label for="aplicaSensorHumo">No aplica</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Cantidad de Sensores de humo</b>
                                                                <input type="number" class="form-control" id="sensorHumoCantidad" name="sensorHumoCantidad" min="0" value="<?php echo $row['sensorHumoCantidad']; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de humo faltantes</b>
                                                                <input type="number" class="form-control" id="sensorHumoFaltantes" name="sensorHumoFaltantes" value="<?php echo $row['sensorHumoFaltantes'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de humo averiados</b>
                                                                <input type="number" class="form-control" id="sensorHumoAveriados" name="sensorHumoAveriados" value="<?php echo $row['sensorHumoAveriados'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorHumoFoto1" name="sensorHumoFoto1[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorHumoFoto2" name="sensorHumoFoto2[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorHumoFoto3" name="sensorHumoFoto3[]" data-min-file-count="1">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" name="sensorHumoObservaciones" id="sensorHumoObservaciones" placeholder="Observaciones y/o comentarios"><?=$row['sensorHumoObservaciones']?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="panel-group full-body" id="accordion_temperatura" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_temperatura">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_temperatura" aria-expanded="true" aria-controls="collapseOne_temperatura">
                                                    <i class="fa fa-thermometer-full"></i> Sensor de temperatura
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_temperatura" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_temperatura">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <br>
                                                            <input type="checkbox" name="aplicaSensorTemperatura" id="aplicaSensorTemperatura" onChange="aplicar('aplicaSensorTemperatura', 'sensorTemperatura')" class="filled-in" value="0" <?php if($row['sensorTemperaturaAplica']==1) echo 'checked'?>>
                                                            <label for="aplicaSensorTemperatura">No aplica</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Cantidad de Sensores de temperatura</b>
                                                                <input type="number" class="form-control" id="sensorTemperaturaCantidad" name="sensorTemperaturaCantidad" min="0" value="<?php echo $row['sensorTemperaturaCantidad']; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de temperatura faltantes</b>
                                                                <input type="number" class="form-control" id="sensorTemperaturaFaltantes" name="sensorTemperaturaFaltantes" value="<?php echo $row['sensorTemperaturaFaltantes'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de temperatura averiados</b>
                                                                <input type="number" class="form-control" id="sensorTemperaturaAveriados" name="sensorTemperaturaAveriados" value="<?php echo $row['sensorTemperaturaAveriados'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorTemperaturaFoto1" name="sensorTemperaturaFoto1[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorTemperaturaFoto2" name="sensorTemperaturaFoto2[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorTemperaturaFoto3" name="sensorTemperaturaFoto3[]" data-min-file-count="1">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" name="sensorTemperaturaObservaciones" id="sensorTemperaturaObservaciones" placeholder="Observaciones y/o comentarios"><?=$row['sensorTemperaturaObservaciones']?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="panel-group full-body" id="accordion_tipo_haz" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_tipo_haz">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_tipo_haz" aria-expanded="true" aria-controls="collapseOne_tipo_haz">
                                                    <i class="material-icons">router</i> Sensor de tipo haz
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_tipo_haz" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_tipo_haz">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <br>
                                                            <input type="checkbox" name="aplicaSensorTipoHaz" id="aplicaSensorTipoHaz"  onChange="aplicar('aplicaSensorTipoHaz', 'sensorTipoHaz')" class="filled-in" value="0" <?php if($row['sensorTipoHazAplica']==1) echo 'checked'?>>
                                                            <label for="aplicaSensorTipoHaz">No aplica</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Cantidad de Sensores de tipo haz</b>
                                                                <input type="number" class="form-control" id="sensorTipoHazCantidad" name="sensorTipoHazCantidad" min="0" value="<?php echo $row['sensorTipoHazCantidad']; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de tipo haz faltantes</b>
                                                                <input type="number" class="form-control" id="sensorTipoHazFaltantes" name="sensorTipoHazFaltantes" value="<?php echo $row['sensorTipoHazFaltantes'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de tipo haz averiados</b>
                                                                <input type="number" class="form-control" id="sensorTipoHazAveriados" name="sensorTipoHazAveriados" value="<?php echo $row['sensorTipoHazAveriados'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorTipoHazFoto1" name="sensorTipoHazFoto1[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorTipoHazFoto2" name="sensorTipoHazFoto2[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorTipoHazFoto3" name="sensorTipoHazFoto3[]" data-min-file-count="1">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" name="sensorTipoHazObservaciones" id="sensorTipoHazObservaciones" placeholder="Observaciones y/o comentarios"><?=$row['sensorTipoHazObservaciones']?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="panel-group full-body" id="accordion_hidrogeno" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_hidrogeno">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_hidrogeno" aria-expanded="true" aria-controls="collapseOne_hidrogeno">
                                                    <i class="material-icons">bubble_chart</i> Sensor de hidrogeno
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_hidrogeno" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_hidrogeno">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <br>
                                                            <input type="checkbox" name="aplicaSensorHidrogeno" id="aplicaSensorHidrogeno" onChange="aplicar('aplicaSensorHidrogeno', 'sensorHidrogeno')" class="filled-in" value="0" <?php if($row['sensorHidrogenoAplica']==1) echo 'checked'?>>
                                                            <label for="aplicaSensorHidrogeno">No aplica</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Cantidad de Sensores de hidrogeno</b>
                                                                <input type="number" class="form-control" id="sensorHidrogenoCantidad" name="sensorHidrogenoCantidad" min="0" value="<?php echo $row['sensorHidrogenoCantidad']; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de hidrogeno faltantes</b>
                                                                <input type="number" class="form-control" id="sensorHidrogenoFaltantes" name="sensorHidrogenoFaltantes" value="<?php echo $row['sensorHidrogenoFaltantes'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de hidrogeno averiados</b>
                                                                <input type="number" class="form-control" id="sensorHidrogenoAveriados" name="sensorHidrogenoAveriados" value="<?php echo $row['sensorHidrogenoAveriados'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorHidrogenoFoto1" name="sensorHidrogenoFoto1[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorHidrogenoFoto2" name="sensorHidrogenoFoto2[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorHidrogenoFoto3" name="sensorHidrogenoFoto3[]" data-min-file-count="1">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" name="sensorHidrogenoObservaciones" id="sensorHidrogenoObservaciones" placeholder="Observaciones y/o comentarios"><?=$row['sensorHidrogenoObservaciones']?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="panel-group full-body" id="accordion_infrarrojo" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_infrarrojo">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_infrarrojo" aria-expanded="true" aria-controls="collapseOne_infrarrojo">
                                                    <i class="material-icons">settings_input_antenna</i> Sensor de infrarrojo
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_infrarrojo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_infrarrojo">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <br>
                                                            <input type="checkbox" name="aplicaSensorInfrarrojo" id="aplicaSensorInfrarrojo" onChange="aplicar('aplicaSensorInfrarrojo', 'sensorInfrarrojo')" class="filled-in" value="0" <?php if($row['sensorInfrarrojoAplica']==1) echo 'checked'?>>
                                                            <label for="aplicaSensorInfrarrojo">No aplica</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Cantidad de Sensores de infrarrojo</b>
                                                                <input type="number" class="form-control" id="sensorInfrarrojoCantidad" name="sensorInfrarrojoCantidad" min="0" value="<?php echo $row['sensorInfrarrojoCantidad']; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de infrarrojo faltantes</b>
                                                                <input type="number" class="form-control" id="sensorInfrarrojoFaltantes" name="sensorInfrarrojoFaltantes" value="<?php echo $row['sensorInfrarrojoFaltantes'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Sensores de infrarrojo averiados</b>
                                                                <input type="number" class="form-control" id="sensorInfrarrojoAveriados" name="sensorInfrarrojoAveriados" value="<?php echo $row['sensorInfrarrojoAveriados'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorInfrarrojoFoto1" name="sensorInfrarrojoFoto1[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorInfrarrojoFoto2" name="sensorInfrarrojoFoto2[]" data-min-file-count="1">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="file" id="sensorInfrarrojoFoto3" name="sensorInfrarrojoFoto3[]" data-min-file-count="1">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" name="sensorInfrarrojoObservaciones" id="sensorInfrarrojoObservaciones" placeholder="Observaciones y/o comentarios"><?=$row['sensorInfrarrojoObservaciones']?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="panel-group full-body" id="accordion_adicionales" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_adicionales">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_adicionales" aria-expanded="true" aria-controls="collapseOne_adicionales">
                                                    <i class="material-icons">assignment</i> Equipos de respuesta brigadistas
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_adicionales" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_adicionales">
                                            <div class="panel-body">
                                                <!--<div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Cantidad de pulsadores manuales</b>
                                                                <input type="number" class="form-control" id="pulsadorManual" name="pulsadorManual" min="0" value="<?php echo $row['pulsadorManual']; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Cantidad de alarmas luminosas</b>
                                                                <input type="number" class="form-control" id="alarmaLuminosa" name="alarmaLuminosa" value="<?php echo $row['alarmaLuminosa'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Cantidad de megáfonos</b>
                                                                <input type="number" class="form-control" id="megafono" name="megafono" value="<?php echo $row['megafono'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Otros</b>
                                                                <input type="number" class="form-control" id="otro" name="otro" value="<?php echo $row['observacionesIncendio'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="table table-responsive">
                                                            <?php
                                                            $rowBrigada=array('gafetes' => null, 'brazaletes' => null, 'chalecos' => null, 'colores' => null, 'observaciones'=>null);
                                                            foreach ($Brigadista as $brigada)
                                                            {
                                                                $rowBrigada=$brigada;
                                                            }
                                                            ?>
                                                            <h5>IDENTIFICACIÓN DE BRIGADISTAS</h5>
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>Tipo</th>
                                                                    <th>Cantidad</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>Gafetes</td>
                                                                    <td><input type="number" class="form-control" name="gafetes" id="gafetes" min="0" value="<?=$rowBrigada['gafetes']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Brazaletes</td>
                                                                    <td><input type="number" class="form-control" name="brazaletes" id="brazaletes" min="0" value="<?=$rowBrigada['brazaletes']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Chalecos</td>
                                                                    <td><input type="number" class="form-control" name="chalecos" id="chalecos" min="0" value="<?=$rowBrigada['chalecos']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Colores y condiciones</td>
                                                                    <td><input type="text" class="form-control" name="colores" id="colores" value="<?=$rowBrigada['colores']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Observaciones</td>
                                                                    <td><input type="text" class="form-control" name="observacionesBrigadista" id="observacionesBrigadista" value="<?=$rowBrigada['observaciones']?>"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="btn btn-primary btn-file" data-toggle="modal" data-target="#modalFotosBrigadistas">
                                                                <i class="glyphicon glyphicon-folder-open"></i><span class="hidden-xs">  Fotos</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="table table-responsive">
                                                            <h5>ALERTAMIENTO INCENDIOS</h5>
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>Tipo</th>
                                                                    <th>Cantidad</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>Pulsador manual</td>
                                                                    <td><input type="number" class="form-control" name="pulsadorManual" id="pulsadorManual" min="0" value="<?php echo $row['pulsadorManual']; ?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alarma luminosa</td>
                                                                    <td><input type="number" class="form-control" name="alarmaLuminosa" id="alarmaLuminosa" min="0" value="<?php echo $row['alarmaLuminosa'];?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Observaciones</td>
                                                                    <td><input type="text" class="form-control" name="observacionesIncendio" id="observacionesIncendio" value="<?php echo $row['observacionesIncendio'];?>"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="btn btn-primary btn-file" data-toggle="modal" data-target="#modalFotosIncendio">
                                                                <i class="glyphicon glyphicon-folder-open"></i><span class="hidden-xs">  Fotos</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="table table-responsive">
                                                            <h5>EVACUACIÓN</h5>
                                                            <?php
                                                            $evaluacionAlertamiento=array('lamparaEmergencia' => null, 'salidaEmergencia' => null, 'puntoReunion' => null, 'radio' => null, 'silbato' =>null, 'observacionesEvaluacion' =>null);
                                                            foreach ($Evaluacion as $r)
                                                            {
                                                                $evaluacionAlertamiento=$r;
                                                            }

                                                            ?>
                                                            <table class="table table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th>Tipo</th>
                                                                    <th>Cantidad</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>Megafono</td>
                                                                    <td><input type="number" class="form-control" name="megafono" id="megafono" min="0" value="<?=$row['megafono']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Lámparas de emergencia</td>
                                                                    <td><input type="number" class="form-control" name="lamparaEmergencia" id="lamparaEmergencia" value="<?=$evaluacionAlertamiento['lamparaEmergencia']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Salidas de emergencia</td>
                                                                    <td><input type="number" class="form-control" name="salidaEmergencia" id="salidaEmergencia" value="<?=$evaluacionAlertamiento['salidaEmergencia']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Puntos de reunión</td>
                                                                    <td><input type="number" class="form-control" name="puntoReunion" id="puntoReunion" value="<?=$evaluacionAlertamiento['puntoReunion']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Radios</td>
                                                                    <td><input type="number" class="form-control" name="radio" id="radio" value="<?=$evaluacionAlertamiento['radio']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Silbatos</td>
                                                                    <td><input type="number" class="form-control" name="silbato" id="silbato" value="<?=$evaluacionAlertamiento['silbato']?>"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Otros</td>
                                                                    <td><input type="text" class="form-control" name="otro" id="otro" value="<?=$row['otro']?>"></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                            <div class="btn btn-primary btn-file" data-toggle="modal" data-target="#modalFotosEvaluacion">
                                                                <i class="glyphicon glyphicon-folder-open"></i><span class="hidden-xs">  Fotos </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-offset-5">
                                <div class="form-line">
                                    <input type="submit" class="btn bg-red waves-effect waves-light" value="Guardar">
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</section>
<!-- Large modal -->
<div class="modal fade bd-example-modal-lg col-xs-12 col-sm-12 col-md-12 col-lg-12"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalFotosBrigadistas" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fotos de identificación de brigadistas</h5>
            </div>
            <div class="modal-body">
                <div id="contenidoModalBrigadista">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="file" name="fotoIdentificacionBrigadista1[]" id="fotoIdentificacionBrigadista1" data-min-file-count="1">
                        </div>
                        <div class="col-sm-6">
                            <input type="file" name="fotoIdentificacionBrigadista2[]" id="fotoIdentificacionBrigadista2" data-min-file-count="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="file" name="fotoIdentificacionBrigadista3[]" id="fotoIdentificacionBrigadista3" data-min-file-count="1">
                        </div>
                        <div class="col-sm-6">
                            <input type="file" name="fotoIdentificacionBrigadista4[]" id="fotoIdentificacionBrigadista4" data-min-file-count="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Large modal -->
<div class="modal fade bd-example-modal-lg col-xs-12 col-sm-12 col-md-12 col-lg-12"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalFotosIncendio" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fotos de alertamiento de incendios</h5>
            </div>
            <div class="modal-body">
                <div id="contenidoModalIncendio">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="file" name="fotoAlertamientoIncendio1[]" id="fotoAlertamientoIncendio1" data-min-file-count="1">
                        </div>
                        <div class="col-sm-6">
                            <input type="file" name="fotoAlertamientoIncendio2[]" id="fotoAlertamientoIncendio2" data-min-file-count="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="file" name="fotoAlertamientoIncendio3[]" id="fotoAlertamientoIncendio3" data-min-file-count="1">
                        </div>
                        <div class="col-sm-6">
                            <input type="file" name="fotoAlertamientoIncendio4[]" id="fotoAlertamientoIncendio4" data-min-file-count="1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- Large modal -->
<div class="modal fade bd-example-modal-lg col-xs-12 col-sm-12 col-md-12 col-lg-12"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="modalFotosEvaluacion" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Fotos de evacuación</h5>
            </div>
            <div class="modal-body">
                <div id="contenidoModalEvaluacion">
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="file" name="fotoEvaluacionAlertamiento1[]" id="fotoEvaluacionAlertamiento1" data-min-file-count="1">
                        </div>
                        <div class="col-sm-4">
                            <input type="file" name="fotoEvaluacionAlertamiento2[]" id="fotoEvaluacionAlertamiento2" data-min-file-count="1">
                        </div>
                        <div class="col-sm-4">
                            <input type="file" name="fotoEvaluacionAlertamiento5[]" id="fotoEvaluacionAlertamiento5" data-min-file-count="1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <input type="file" name="fotoEvaluacionAlertamiento3[]" id="fotoEvaluacionAlertamiento3" data-min-file-count="1">
                        </div>
                        <div class="col-sm-4">
                            <input type="file" name="fotoEvaluacionAlertamiento4[]" id="fotoEvaluacionAlertamiento4" data-min-file-count="1">
                        </div>
                        <div class="col-sm-4">
                            <input type="file" name="fotoEvaluacionAlertamiento6[]" id="fotoEvaluacionAlertamiento6" data-min-file-count="1">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function aplicar(id, nombreSensores)
    {

        $("#"+nombreSensores+"Cantidad").prop('disabled', $("#"+id).is(':checked'));
        $("#"+nombreSensores+"Faltantes").prop('disabled', $("#"+id).is(':checked'));
        $("#"+nombreSensores+"Averiados").prop('disabled', $("#"+id).is(':checked'));
    }
</script>

<script type="text/javascript">

    $(function(){
        $("#form").on("submit", function(e){
            var url;
            var accion=<?php echo $contador;?>;
            accion="actualizarSensores/";

            $("#aplicaSensorHumo").is(":checked")?$("#aplicaSensorHumo").val(1) :$("#aplicaSensorHumo").val(0);
            $("#aplicaSensorHidrogeno").is(":checked")?$("#aplicaSensorHidrogeno").val(1) :$("#aplicaSensorHidrogeno").val(0);
            $("#aplicaSensorInfrarrojo").is(":checked")?$("#aplicaSensorInfrarrojo").val(1) :$("#aplicaSensorInfrarrojo").val(0);
            $("#aplicaSensorTemperatura").is(":checked")?$("#aplicaSensorTemperatura").val(1) :$("#aplicaSensorTemperatura").val(0);
            $("#aplicaSensorTipoHaz").is(":checked")?$("#aplicaSensorTipoHaz").val(1) :$("#aplicaSensorTipoHaz").val(0);

            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/';?>"+accion;
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

                    swal({
                            title: "Éxito",
                            text: "Se han registrado los sensores",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){

                            location.href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formSensores/'+$("#idAsignacion").val();
                        });

                });

        });
    });


</script>

<script>
    $(document).ready(function ()
    {
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/obtenerFotosAlertamiento/<?=$idAsignacion?>",
                dataType: "JSON",
                success: function (data)
                {

                    var nombreCampo = data[0];

                    for (var key in nombreCampo)
                    {
                        crearFileInput(key, data[0][key]);
                    }

                    aplicar('aplicaSensorHumo', 'sensorHumo');
                    aplicar('aplicaSensorHidrogeno', 'sensorHidrogeno');
                    aplicar('aplicaSensorInfrarrojo', 'sensorInfrarrojo');
                    aplicar('aplicaSensorTemperatura', 'sensorTemperatura');
                    aplicar('aplicaSensorTipoHaz', 'sensorTipoHaz');




                }
            }
        );
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/obtenerFotosBrigadista/<?=$idAsignacion?>",
                dataType: "JSON",
                success: function (data)
                {

                    var nombreCampo = data[0];

                    for (var key in nombreCampo)
                    {
                        crearFileInput(key, data[0][key]);
                    }

                }
            }
        );
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/obtenerFotosBrigadista/<?=$idAsignacion?>",
                dataType: "JSON",
                success: function (data)
                {

                    var nombreCampo = data[0];

                    for (var key in nombreCampo)
                    {
                        crearFileInputTabla(key, data[0][key], 'IdentificacionBrigadista');
                    }

                }
            }
        );
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/obtenerFotosEvaluacionAlertamiento/<?=$idAsignacion?>",
                dataType: "JSON",
                success: function (data)
                {

                    var nombreCampo = data[0];

                    for (var key in nombreCampo)
                    {
                        crearFileInputTabla(key, data[0][key], 'EvaluacionAlertamiento');
                    }

                }
            }
        );


    });

    function crearFileInput(nombreCampo, valorCampo)
    {

        imagen='';
        if(valorCampo)
        {

            imagen="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/"+nombreCampo+"/"+valorCampo+"' class='file-preview-image'>";
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/"+nombreCampo+"/Alertamiento/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png'],
            'initialPreview' : [imagen]
        }).on('change', function (event, data, previewId, index) {

            $("#"+nombreCampo).fileinput("upload");

        }).on('fileclear', function (event) {
            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagen/"+nombreCampo+"/Alertamiento/<?=$idAsignacion?>";
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
    }
    function crearFileInputTabla(nombreCampo, valorCampo, tabla)
    {

        imagen='';
        if(valorCampo)
        {

            imagen="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/"+nombreCampo+"/"+valorCampo+"' class='file-preview-image'>";
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/"+nombreCampo+"/"+tabla+"/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png'],
            'initialPreview' : [imagen]
        }).on('change', function (event, data, previewId, index) {

            $("#"+nombreCampo).fileinput("upload");

        }).on('fileclear', function (event) {
            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagen/"+nombreCampo+"/"+tabla+"/<?=$idAsignacion?>";
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
    }
</script>


<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->