<?php
include "header.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" xmlns="http://www.w3.org/1999/html"></script>

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

<script type="text/javascript">
    var array = {
        'datosTanques': []
    };
</script>


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
                        <h2>INSTALACIONES ELÉCTRICAS</h2>
                    </div>
                    <div class="body">
                        <form id="form" enctype="multipart/form-data" action="">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">

                                <?php
                                $contador=0;
                                $row=array('idInstalacionesElectricas'=>"", 'fechaVisita'=>"",'acometida'=>"", 'tipoAcometida'=>"", 'observacionesAcometida'=>"", 'transformador'=>"",
                                    'subEstacion'=>"", 'observacionesSubEstacion'=>"", 'plantaEmergencia'=>"",'capPlantaEmergencia'=>"", 'almDieseIPE'=>"", 'senalPlantaEmergencia'=>"", 'observacionPlantaEmergencia'=>"");
                                foreach ($existencia as $row2)
                                {
                                    $row=$row2;
                                    $contador++;
                                }
                                ?>

                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                                <i class="material-icons">date_range</i> Visitas
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">
                                            <div class="row">
                                                <input type="hidden" id="idInstalacion"name="idInstalacion" value="<?php echo $row['idInstalacionesElectricas'];?>">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de Visita</b>
                                                            <input type="date" class="form-control" id="fechaVisita" name="fechaVisita" value="<?php echo $row['fechaVisita']; ?>" readonly required />
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-group full-body" id="accordion_2" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_2">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_2" aria-expanded="true" aria-controls="collapseOne_2">
                                                <i class="material-icons">assignment</i> Subestación
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_2">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group text-center">
                                                        <br><input class="form-control" type="checkbox" id="noAplicaSubestacion" value="NoAplica" name="noAplicaSubestacion" <?php if($row["noAplicaSubestacion"] == 1) print 'checked' ?>><label for="noAplicaSubestacion">No aplica</label><br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Subestación</b>
                                                            <input type="number" class="form-control" id="subestacion" name="subestacion"  placeholder="Capacidad KV" value="<?php echo $row['subEstacion']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones Subestación</b>
                                                            <input type="text" class="form-control" id="observaSubestacion" name="observaSubestacion" value="<?php echo $row['observacionesSubEstacion']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <b>Foto Señalizacion y equipos de seguridad</b>
                                                    <input type="file" class="file" id="fotoSenaSubEstacion" name="fotoSenaSubEstacion[]" data-min-file-count="1"  />
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <b>Foto 1</b>
                                                    <input type="file" class="file" id="fotoSubEstacion1" name="fotoSubEstacion1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <b>Foto 2</b>
                                                    <input type="file" class="file" id="fotoSubEstacion2" name="fotoSubEstacion2[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <b>Foto 3</b>
                                                    <input type="file" class="file" id="fotoSubEstacion3" name="fotoSubEstacion3[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <b>Foto 4</b>
                                                    <input type="file" class="file" id="fotoSubEstacion4" name="fotoSubEstacion4[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <b>Foto 5</b>
                                                    <input type="file" class="file" id="fotoSubEstacion5" name="fotoSubEstacion5[]" data-min-file-count="1" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-group full-body" id="accordion_19" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_19">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">
                                                <i class="material-icons">assignment</i> Datos Acometida
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Acometida:</b>
                                                                    <input type="text" class="form-control" id="acometidaCpa" name="acometidaCpa" placeholder="Capacidad" value="<?php echo $row['acometida']; ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Tipo Acometida</b>
                                                                    <select  class="form-control" id="tipoAcome" name="tipoAcome" >
                                                                        <option value="">Seleccione una opción</option>
                                                                        <option value="1" <?php if($row['tipoAcometida']==1) echo "selected"?>>Área</option>
                                                                        <option value="2" <?php if($row['tipoAcometida']==2) echo "selected"?>>Terrestre</option>
                                                                        <option value="3" <?php if($row['tipoAcometida']==3) echo "selected"?>>N/A</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Observaciones Acometida</b>
                                                                    <textarea class="form-control" id="observaAcome" name="observaAcome"><?php echo $row['observacionesAcometida']; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="col-md-12 col-sm-12">
                                                        <b>Foto Acometida</b>
                                                        <input type="file" class="file" id="fotoAcometida" name="fotoAcometida[]" data-min-file-count="1"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-group full-body" id="accordion_1" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_1">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1">
                                                <i class="material-icons">assignment</i> Transformador
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group text-center">
                                                        <br><input class="form-control" type="checkbox" id="noAplicaTransformador" value="NoAplica" name="noAplicaTransformador" <?php if($row["noAplicaTransformador"] == 1) print 'checked' ?>><label for="noAplicaTransformador">No aplica</label><br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Capacidad</b>
                                                            <input type="number" class="form-control" id="transformadorCan" name="transformadorCan" value="<?php echo $row['transformador']; ?>"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Unidad de medida</b>
                                                            <select  class="form-control" id="unidadTransformador" name="unidadTransformador">
                                                                <option value="">Seleccione una opción</option>
                                                                <option <?php if($row['unidadTransformador'] == 1) print 'selected' ?> value="1">KW</option>
                                                                <option <?php if($row['unidadTransformador'] == 2) print 'selected' ?>  value="2">KVA</option>
                                                                <option <?php if($row['unidadTransformador'] == 3) print 'selected' ?> value="3">Volts</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea placeholder="Observaciones del transformador" class="form-control" id="observacionesTransformador" name="observacionesTransformador" /><?php echo $row['observacionesTransformador']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto 1</b>
                                                    <input type="file" class="file" id="fotoTransformador1" name="fotoTransformador1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto 2</b>
                                                    <input type="file" class="file" id="fotoTransformador2" name="fotoTransformador2[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto 3</b>
                                                    <input type="file" class="file" id="fotoTransformador3" name="fotoTransformador3[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                                                    <b>Foto 4</b>
                                                    <input type="file" class="file" id="fotoTransformador4" name="fotoTransformador4[]" data-min-file-count="1" />
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-group full-body" id="accordion_3" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_3">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_3" aria-expanded="true" aria-controls="collapseOne_3">
                                                <i class="material-icons">assignment</i> Datos Plantas emergencia
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_3">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group text-center">
                                                                <br><input class="form-control" type="checkbox" id="noAplicaPlantaEmerg" value="NoAplica" name="noAplicaPlantaEmerg" <?php if($row["noAplicaPlantaEmerg"] == 1) print 'checked' ?>><label for="noAplicaPlantaEmerg">No aplica</label><br>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Planta Emergencia</b>
                                                                    <select  class="form-control" id="plantaEm" name="plantaEm" >
                                                                        <option value="">Seleccione una opción</option>
                                                                        <option value="1" <?php if($row['plantaEmergencia']==1) echo "selected"?>>Cuenta</option>
                                                                        <option value="2" <?php if($row['plantaEmergencia']==2) echo "selected"?>>No cuenta</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Cantidad</b>
                                                                    <input type="number" class="form-control" id="cantidadPlantas" name="cantidadPlantas" value="<?php echo $row['cantPlantaEmergencia']; ?>"  placeholder="KV" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Capacidad P/E</b>
                                                                    <input type="number" class="form-control" id="capacidadPlanta" name="capacidadPlanta" value="<?php echo $row['capPlantaEmergencia']; ?>"  placeholder="KV" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <b>Unidad de medida</b>
                                                                    <select  class="form-control" id="unidadPlantaEmergencia" name="unidadPlantaEmergencia" >
                                                                        <option value="">Seleccione una opción</option>
                                                                        <option value="1" <?php if($row['unidadPlantaEmergencia'] == 1) echo "selected"?>>KW</option>
                                                                        <option value="2" <?php if($row['unidadPlantaEmergencia'] == 2) echo "selected"?>>KV</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto 1</b>
                                                    <input type="file" class="file" id="fotoPlantaEmergencia1" name="fotoPlantaEmergencia1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto 2</b>
                                                    <input type="file" class="file" id="fotoPlantaEmergencia2" name="fotoPlantaEmergencia2[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto 3</b>
                                                    <input type="file" class="file" id="fotoPlantaEmergencia3" name="fotoPlantaEmergencia3[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-md-offset-2 col-sm-offset-2">
                                                    <b>Foto 4</b>
                                                    <input type="file" class="file" id="fotoPlantaEmergencia4" name="fotoPlantaEmergencia4[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto 5</b>
                                                    <input type="file" class="file" id="fotoPlantaEmergencia5" name="fotoPlantaEmergencia5[]" data-min-file-count="1" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form id="form2">
                            <div class="panel-group full-body" id="accordion_4" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_4">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_4" aria-expanded="true" aria-controls="collapseOne_4">
                                                <i class="material-icons">assignment</i> Datos Plantas emergencia tanques
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_4">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Ubicación</b>
                                                            <input type="text" class="form-control" id="UbicacionTanque" name="UbicacionTanque"   placeholder="Ubicación de tanque" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad </b>
                                                            <input type="number" class="form-control" id="cantidadTanq" name="cantidadTanq"   placeholder="Cantidad de tanques"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Almacenamiento Diesel PE</b>
                                                            <input type="number" class="form-control" id="capacidadDi" name="capacidadDi"   placeholder="KV"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--   -->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones Planta Emergencia</b>
                                                            <textarea class="form-control" id="observaPlanta" name="observaPlanta"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-offset-5">
                                                    <div class="form-line">
                                                        <input type="submit" class="btn bg-red waves-effect waves-light"  value="Agregar">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="body table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>

                                                        <th>CANTIDAD</th>
                                                        <th>UBICACIÓN</th>
                                                        <th>CAPACIDAD</th>
                                                        <th>OBSERVACIONES</th>
                                                        <th>FOTOS</th>
                                                        <th>ELIMINAR</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="listaInstalacionesTantes">

                                                    </tbody>

                                                </table>
                                            </div>
                                            <!--  <div class="row">
                                                 <div class="col-md-4">
                                                      <div class="col-md-12 col-sm-12">
                                                         <b>Foto tanque diesel 1</b>
                                                         <input type="file" class="file" id="fotoTanqueDieselUno" name="fotoTanqueDieselUno[]" data-min-file-count="1"  />
                                                     </div>
                                                 </div>
                                                 <div class="col-md-4">
                                                      <div class="col-md-12 col-sm-12">
                                                         <b>Foto tanque diesel 2</b>
                                                         <input type="file" class="file" id="fotoTanqueDieselDos" name="fotoTanqueDieselDos[]" data-min-file-count="1"  />
                                                     </div>
                                                 </div>
                                                 <div class="col-md-4">
                                                      <div class="col-md-12 col-sm-12">
                                                         <b>Foto planta emergencia</b>
                                                         <input type="file" class="file" id="senalPlantaEmergencia" name="senalPlantaEmergencia[]" data-min-file-count="1"  />
                                                     </div>
                                                 </div>
                                             </div> -->
                                        </div>
                                        <div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4 col-md-offset-5">
                                <div class="form-line">
                                    <input type="submit" onclick="registrarFotoTanque();" class="btn bg-red waves-effect waves-light" value="Guardar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </form>  -->
                </div>
            </div>
        </div>
    </div>


</section>
<div class="modal fade" id="myModalImagenInstalacion" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Imagen de Tanques</h4>
            </div>
            <div class="modal-body">
                <div class="row" align="center">
                    <div class="col-md-4 col-md-offset-2">
                        <b>Foto Tanque Uno</b>
                        <div id="ConteniFoto">

                        </div>

                    </div>
                    <div class="col-md-4 ">
                        <b>Foto Tanque Dos</b>
                        <div id="ConteniFotoDos">

                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function sactualizarColindancia() {
        arregloJson=JSON.stringify(array);
        arre = JSON.parse(arregloJson);

        var idAsignacion = $("#idAsignacion").val();
        var idColindancia = $("#idColindancia").val();
        //alert("id asiga"+idAsignacion+" idColindancia"+idColindancia)
        var fechaVisita = $("#fechaVisita").val();
        var calleNorte = $("#calleNorte").val();
        var localNorte = $("#localNorte").val();
        var calleSur = $("#calleSur").val();
        var localSur = $("#localSur").val();
        var calleOriente = $("#calleOriente").val();
        var localOriente = $("#localOriente").val();
        var callePoniente = $("#callePoniente").val();
        var localPoniente = $("#localPoniente").val();

        var areaMetros = $("#areaMetros").val();
        var numberCajo = $("#numberCajo").val();
        var numberCajoincapa = $("#numberCajoincapa").val();
        var tipoEsta = $("#tipoEsta").val();


        var parametros = {
            "idAsignacion":idAsignacion,
            "idColindancia":idColindancia,
            "fechaVisita":fechaVisita,
            "calleNorte":calleNorte,
            "localNorte":localNorte,
            "calleSur":calleSur,
            "localSur":localSur,
            "calleOriente":calleOriente,
            "localOriente":localOriente,
            "callePoniente":callePoniente,
            "localPoniente":localPoniente,
            "areaMetros":areaMetros,
            "numberCajo":numberCajo,
            "numberCajoincapa":numberCajoincapa,
            "tipoEsta":tipoEsta,

            "arreglo" : arre,
        };
        var url= "<?php echo site_url( 'CrudAnalisisRiesgo/actualizarColindancia/');?>";
        $.ajax({

            url : url,
            type: "POST",
            data: parametros,
            dataType: "HTML",
            success: function(data)
            {
                swal({
                        title: "Éxito",
                        text: "Se han registrado colindancia",
                        type: "success",

                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",

                    },
                    function(){
                        window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/")
                    });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });

    }



    /*$(function(){
        $("#form").on("submit", function(e){
            var url;
            var accion=<?php echo $contador;?>;


                accion="actualizarInstalacionElectrica/";

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
                            text: "Se han registrado Instalación electrica",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){

                            location.href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formInstalacionesElectricas/'+$("#idAsignacion").val();
                        });

                });

        });
    });*/


    $("#noAplicaPlantaEmerg").click(function(){
        var value = $("#noAplicaPlantaEmerg").is(':checked');

        for(i = 1; i <= 5; i++) {
            $("#fotoPlantaEmergencia"+i).prop('disabled', value);
            $("#fotoPlantaEmergencia"+i).attr('disabled') ? $("#fotoPlantaEmergencia"+i).parent().addClass('disabled') : $("#fotoPlantaEmergencia"+i).parent().removeAttr('disabled').removeClass('disabled');
        }
    });

    $("#noAplicaTransformador").click(function(){
        var value = $("#noAplicaTransformador").is(':checked');

        for(i = 1; i <= 5; i++){
            $("#fotoTransformador"+i).prop('disabled', value);
            $("#fotoTransformador"+i).attr('disabled') ? $("#fotoTransformador"+i).parent().addClass('disabled') :  $("#fotoTransformador"+i).parent().removeAttr('disabled').removeClass('disabled');
        }
    });

    $("#noAplicaSubestacion").click(function(){
        var value = $("#noAplicaSubestacion").is(':checked');

        $("#fotoSenaSubEstacion").prop('disabled', value);
        $("#fotoSenaSubEstacion").attr('disabled') ? $("#fotoSenaSubEstacion").parent().addClass('disabled') : $("#fotoSenaSubEstacion").parent().removeAttr('disabled').removeClass('disabled');

        for(i = 1; i <= 5; i++){
            $("#fotoSubEstacion"+i).prop('disabled', value);
            $("#fotoSubEstacion"+i).attr('disabled') ? $("#fotoSubEstacion"+i).parent().addClass('disabled') :  $("#fotoSubEstacion"+i).parent().removeAttr('disabled').removeClass('disabled');
        }
    });

    function registrarFotoTanque()
    {
        //  if($('#suministro option:selected').val() != '') {

        $("#noAplicaPlantaEmerg").is(':checked') ? $("#noAplicaPlantaEmerg").val('1') : $("#noAplicaPlantaEmerg").val('0');
        $("#noAplicaSubestacion").is(':checked') ? $("#noAplicaSubestacion").val('1') : $("#noAplicaSubestacion").val('0');
        $("#noAplicaTransformador").is(':checked') ? $("#noAplicaTransformador").val('1') : $("#noAplicaTransformador").val('0');

        accion = "actualizarInstalacionElectrica/";
        var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/';?>" + accion;
        var formData = new FormData(document.getElementById("form"));
        formData.append('datosPuenteFoto', (JSON.stringify(array.datosTanques)));

        console.log(JSON.stringify(array.datosTanques));
        $.ajax({
            url: url,
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
            .done(function (res) {
                console.log(res);
                swal({
                        title: "Éxito",
                        text: "Se han registrado Instalación electrica",
                        type: "success",

                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",
                    },
                    function () {
                        location.href = 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formInstalacionesElectricas/' + $("#idAsignacion").val();
                    });
            });
        /*}else{
            $( "#suministro" ).focus();
        }*/
    }
</script>
<!--TODO: colocar estos js en el servidor-->




<script type="text/javascript">

    $(window).on('load', function()
    {

        $("#fotoAcometida").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoAcometida/<?php echo $idAsignacion;?>",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoAcometida"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/Acometida/').$row['fotoAcometida']."\' class='file-preview-image' alt=\'".$row['fotoAcometida']."\' title=\'".$row['fotoAcometida']."\'>\"]";
            }
            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoAcometida").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoAcometida';
                $tabla = 'InstalacionesElectricas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoTransformador1").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoTransformador1/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoTransformador1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoTransformador1/').$row['fotoTransformador1']."\' class='file-preview-image' alt=\'".$row['fotoTransformador1']."\' title=\'".$row['fotoTransformador1']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoTransformador1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoTransformador1';
                $tabla = 'InstalacionesElectricas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });

        $("#fotoTransformador2").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoTransformador2/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoTransformador2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoTransformador2/').$row['fotoTransformador2']."\' class='file-preview-image' alt=\'".$row['fotoTransformador2']."\' title=\'".$row['fotoTransformador2']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoTransformador2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoTransformador2';
                $tabla = 'InstalacionesElectricas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });


        $("#fotoTransformador3").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoTransformador3/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoTransformador3"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoTransformador3/').$row['fotoTransformador3']."\' class='file-preview-image' alt=\'".$row['fotoTransformador3']."\' title=\'".$row['fotoTransformador3']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoTransformador3").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoTransformador3';
                $tabla = 'InstalacionesElectricas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });


        $("#fotoTransformador4").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoTransformador4/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoTransformador4"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoTransformador4/').$row['fotoTransformador4']."\' class='file-preview-image' alt=\'".$row['fotoTransformador4']."\' title=\'".$row['fotoTransformador4']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoTransformador4").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoTransformador4';
                $tabla = 'InstalacionesElectricas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });


        $("#fotoSenaSubEstacion").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotosubestacion/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoSenaSubEstacion"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSubestacion/').$row['fotoSenaSubEstacion']."\' class='file-preview-image' alt=\'".$row['fotoSenaSubEstacion']."\' title=\'".$row['fotoSenaSubEstacion']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSenaSubEstacion").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSenaSubEstacion';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoSubestacion';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoSubEstacion1").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoSubEstacion1/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoSubEstacion1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSubEstacion1/').$row['fotoSubEstacion1']."\' class='file-preview-image' alt=\'".$row['fotoSubEstacion1']."\' title=\'".$row['fotoSubEstacion1']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSubEstacion1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSubEstacion1';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoSubestacion';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        $("#fotoSubEstacion2").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoSubEstacion2/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoSubEstacion2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSubEstacion2/').$row['fotoSubEstacion2']."\' class='file-preview-image' alt=\'".$row['fotoSubEstacion2']."\' title=\'".$row['fotoSubEstacion2']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSubEstacion2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSubEstacion2';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoSubestacion';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoSubEstacion3").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoSubEstacion3/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoSubEstacion3"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSubEstacion3/').$row['fotoSubEstacion3']."\' class='file-preview-image' alt=\'".$row['fotoSubEstacion3']."\' title=\'".$row['fotoSubEstacion3']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSubEstacion3").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSubEstacion3';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoSubestacion';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoSubEstacion4").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoSubEstacion4/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoSubEstacion4"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSubEstacion4/').$row['fotoSubEstacion4']."\' class='file-preview-image' alt=\'".$row['fotoSubEstacion4']."\' title=\'".$row['fotoSubEstacion4']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSubEstacion4").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSubEstacion4';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoSubestacion';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        $("#fotoSubEstacion5").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoSubEstacion5/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoSubEstacion5"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSubEstacion5/').$row['fotoSubEstacion5']."\' class='file-preview-image' alt=\'".$row['fotoSubEstacion5']."\' title=\'".$row['fotoSubEstacion5']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSubEstacion5").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSubEstacion5';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoSubestacion';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        $("#fotoPlantaEmergencia1").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPlantaEmergencia1/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoPlantaEmergencia1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoPlantaEmergencia1/').$row['fotoPlantaEmergencia1']."\' class='file-preview-image' alt=\'".$row['fotoPlantaEmergencia1']."\' title=\'".$row['fotoPlantaEmergencia1']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPlantaEmergencia1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPlantaEmergencia1';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoPlanta';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });




        $("#fotoPlantaEmergencia2").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPlantaEmergencia2/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoPlantaEmergencia2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoPlantaEmergencia2/').$row['fotoPlantaEmergencia2']."\' class='file-preview-image' alt=\'".$row['fotoPlantaEmergencia2']."\' title=\'".$row['fotoPlantaEmergencia2']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPlantaEmergencia2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPlantaEmergencia2';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoPlanta';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });


        $("#fotoPlantaEmergencia3").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPlantaEmergencia3/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoPlantaEmergencia3"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoPlantaEmergencia3/').$row['fotoPlantaEmergencia3']."\' class='file-preview-image' alt=\'".$row['fotoPlantaEmergencia3']."\' title=\'".$row['fotoPlantaEmergencia3']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPlantaEmergencia3").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPlantaEmergencia3';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoPlanta';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });


        $("#fotoPlantaEmergencia4").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPlantaEmergencia4/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoPlantaEmergencia4"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoPlantaEmergencia4/').$row['fotoPlantaEmergencia4']."\' class='file-preview-image' alt=\'".$row['fotoPlantaEmergencia4']."\' title=\'".$row['fotoPlantaEmergencia4']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPlantaEmergencia4").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPlantaEmergencia4';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoPlanta';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });


        $("#fotoPlantaEmergencia5").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoPlantaEmergencia5/InstalacionesElectricas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoPlantaEmergencia5"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoPlantaEmergencia5/').$row['fotoPlantaEmergencia5']."\' class='file-preview-image' alt=\'".$row['fotoPlantaEmergencia5']."\' title=\'".$row['fotoPlantaEmergencia5']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoPlantaEmergencia5").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoPlantaEmergencia5';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoPlanta';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });




        /* $("#fotoTanqueDieselUno").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoPlantatanque/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
        if($row["fotoTanqueDieselUno"]!=NULL)
        {
            echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/').$row['fotoTanqueDieselUno']."\' class='file-preview-image' alt=\'".$row['fotoTanqueDieselUno']."\' title=\'".$row['fotoTanqueDieselUno']."\'>\"]";
        }

        ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoTanqueDieselUno").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
        $campo = 'fotoTanqueDieselUno';
        $tabla = 'InstalacionesElectricas';
        $carpeta = 'fotoPlantaTanque';

        echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

        ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        $("#fotoTanqueDieselDos").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoPlantatanqueDos/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
        if($row["fotoTanqueDieselDos"]!=NULL)
        {
            echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/').$row['fotoTanqueDieselDos']."\' class='file-preview-image' alt=\'".$row['fotoTanqueDieselDos']."\' title=\'".$row['fotoTanqueDieselDos']."\'>\"]";
        }

        ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoTanqueDieselDos").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
        $campo = 'fotoTanqueDieselDos';
        $tabla = 'InstalacionesElectricas';
        $carpeta = 'fotoPlantaTanque';

        echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

        ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });*/

        $("#senalPlantaEmergencia").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoPlantatanqueTres/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["senalPlantaEmergencia"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/').$row['senalPlantaEmergencia']."\' class='file-preview-image' alt=\'".$row['senalPlantaEmergencia']."\' title=\'".$row['senalPlantaEmergencia']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#senalPlantaEmergencia").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'senalPlantaEmergencia';
                $tabla = 'InstalacionesElectricas';
                $carpeta = 'fotoPlantaTanque';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenCarpeta/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });


        /*
        * INICIO DESHABILITAR IMG
        * */

        var noAplicaTransformador = "<? if($row['noAplicaTransformador'] == 1) print 1; ?>";

        for(i = 1; i <= 5; i++){
            if(noAplicaTransformador == "1"){
                $("#fotoTransformador"+i).prop('disabled', true);
                $("#fotoTransformador"+i).attr('disabled') ? $("#fotoTransformador"+i).parent().addClass('disabled') :  $("#fotoTransformador"+i).parent().removeAttr('disabled').removeClass('disabled');
            }else{
                $("#fotoTransformador"+i).prop('disabled', false);
                $("#fotoTransformador"+i).attr('disabled') ? $("#fotoTransformador"+i).parent().addClass('disabled') :  $("#fotoTransformador"+i).parent().removeAttr('disabled').removeClass('disabled');
            }
        }

        var noAplicaPlantaEmerg = "<? if($row['noAplicaPlantaEmerg'] == 1) print 1; ?>";

        for(i = 1; i <= 5; i++){
            if(noAplicaPlantaEmerg == "1"){
                $("#fotoPlantaEmergencia"+i).prop('disabled', true);
                $("#fotoPlantaEmergencia"+i).attr('disabled') ? $("#fotoPlantaEmergencia"+i).parent().addClass('disabled') :  $("#fotoPlantaEmergencia"+i).parent().removeAttr('disabled').removeClass('disabled');
            }else{
                $("#fotoPlantaEmergencia"+i).prop('disabled', false);
                $("#fotoPlantaEmergencia"+i).attr('disabled') ? $("#fotoPlantaEmergencia"+i).parent().addClass('disabled') :  $("#fotoPlantaEmergencia"+i).parent().removeAttr('disabled').removeClass('disabled');
            }
        }

        var noAplicaSubestacion = "<? if($row['noAplicaSubestacion'] == 1) print 1; ?>";



        for(i = 1; i <= 5; i++){
            if(noAplicaSubestacion == "1"){
                $("#fotoSenaSubEstacion").prop('disabled', true);
                $("#fotoSenaSubEstacion").attr('disabled') ? $("#fotoSenaSubEstacion").parent().addClass('disabled') : $("#fotoSenaSubEstacion").parent().removeAttr('disabled').removeClass('disabled');

                $("#fotoSubEstacion"+i).prop('disabled', true);
                $("#fotoSubEstacion"+i).attr('disabled') ? $("#fotoSubEstacion"+i).parent().addClass('disabled') :  $("#fotoSubEstacion"+i).parent().removeAttr('disabled').removeClass('disabled');

            }else{
                $("#fotoSenaSubEstacion").prop('disabled', false);
                $("#fotoSenaSubEstacion").attr('disabled') ? $("#fotoSenaSubEstacion").parent().addClass('disabled') : $("#fotoSenaSubEstacion").parent().removeAttr('disabled').removeClass('disabled');

                $("#fotoSubEstacion"+i).prop('disabled', false);
                $("#fotoSubEstacion"+i).attr('disabled') ? $("#fotoSubEstacion"+i).parent().addClass('disabled') :  $("#fotoSubEstacion"+i).parent().removeAttr('disabled').removeClass('disabled');
            }
        }


        /*
        * FIN DESHABILITAR IMG
        * */


    });


    $("#form2").on("submit", function(e){
        e.preventDefault();
        AgregarTanques();
    });

    function AgregarTanques()
    {
        var UbicacionTanque = $("#UbicacionTanque").val();
        var capacidadDi = $("#capacidadDi").val();
        var observaPlanta = $("#observaPlanta").val();
        var cantidadTanq = $("#cantidadTanq").val();
        var idAsigns = $("#idAsignacion").val();

        array.datosTanques.push({'idControl': '-1', 'UbicacionTanque': UbicacionTanque ,'cantidadTanq':cantidadTanq,'capacidadDi': capacidadDi,'observaPlanta': observaPlanta, 'action' : 1, 'cantidadTanq': cantidadTanq});
        console.log(JSON.stringify(array.datosTanques, null, 4));

        $("#listaInstalacionesTantes").append('<tr>'+
            '<td>'+cantidadTanq+'</td>'+
            '<td>'+UbicacionTanque+'</td>'+
            '<td>'+capacidadDi+'</td>'+
            '<td>'+observaPlanta+'</td>'+
            '<td><i onclick="traerFotoUnica('+idAsigns+','+capacidadDi+','+cantidadTanq+' )"  data-toggle="modal" data-target="#myModalImagenInstalacion" class="fa fa-picture-o" aria-hidden="true"></i></td>'+
            '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
            '</tr>');

        limpiarFormulario();
    }
    function limpiarFormulario()
    {
        $("#UbicacionTanque").val("");
        $("#capacidadDi").val("");
        $("#observaPlanta").val("");
        $("#cantidadTanq").val("");
    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();

        var indice =  $(this).closest('tr').index();

        if(array.datosTanques[indice]['idControl'] == -1)
        {
            array.datosTanques.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosTanques[indice]['action']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array.datosTanques, null, 4));

    });

    window.onload = cargaDatosTabla;

    function cargaDatosTabla(){
        <?php
        foreach ($tanquePuente as $row) {
            $idControl = $row["idControl"];
            $UbicacionTanque = $row["UbicacionTanque"];
            $CantidadTanque = $row["cantidadTanque"];
            $CapacidadTanque = $row["CapacidadTanque"];
            $observacionesTanque = $row["observacionesTanque"];
            $idAsignacion = $row["idAsignacion"];

            print "array.datosTanques.push({'idControl' : $idControl,'UbicacionTanque' : '$UbicacionTanque', 'cantidadTanq' : $CantidadTanque,'capacidadDi':$CapacidadTanque, 'observacionesTanque' : '$observacionesTanque', 'action' : 0}); \n";


            print "$('#listaInstalacionesTantes').append(
                     '<tr><td>$CantidadTanque</td><td>$UbicacionTanque</td><td>$CapacidadTanque</td><td>$observacionesTanque</td><td><button onclick=\"traerFotoUnica($idAsignacion,$CapacidadTanque,$CantidadTanque)\" type=\"button\" class=\"btn btn-default\"><i data-toggle=\"modal\" data-target=\"#myModalImagenInstalacion\" class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";


        }
        print("console.log(JSON.stringify(array.datosTanques, null, 4));");
        ?>
    }

    function traerFotoUnica(idAsi,capac,cantid)
    {
        $("#ConteniFoto").html("");
        $("#ConteniFoto").append("<input type='file' class='file' id='fotoTanqueDieselUno' name='fotoTanqueDieselUno[]' data-min-file-count='1' />")

        $("#ConteniFotoDos").html("");
        $("#ConteniFotoDos").append("<input type='file' class='file' id='fotoTanqueDieselDos' name='fotoTanqueDieselDos[]' data-min-file-count='1' />")

        $.ajax({
            url : "<?php echo site_url('CrudAnalisisRiesgo/retornoFotoTanque/')?>/" + idAsi+"/"+capac+"/"+cantid,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                if (data.length>0)
                {
                    for (i=0; i< data.length; i++) {
                        var fot=data[i]["fotoTanqueU"];
                        if (fot!=null)
                        {
                            var codig="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/"+fot+"' class='file-preview-image' >";
                        }
                        var fotD=data[i]["fotoTanqueD"];
                        if (fotD!=null)
                        {
                            var codigD="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/"+fotD+"' class='file-preview-image' >";
                        }
                        var idControl=data[i]["idRevisionInstalaciones"];
                        // alert(fot)
                        $("#fotoTanqueDieselUno").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
                            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoPlantatanque/<?php echo $idAsignacion;?>/"+capac+"/"+cantid+"/",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
                            ,


                            initialPreview: [codig
                            ]


                        }).on('change', function(event, data, previewId, index)
                        {
                            $("#fotoTanqueDieselUno").fileinput("upload");

                        }).on('fileclear', function (event) {
                            // alert(idAsi) idAsi,capac,cantid
                            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenServidorTanque/"+idAsi+"/"+capac+"/"+cantid;
                            $.ajax({
                                url: url,
                                type: "post",
                                dataType: "html"
                            }).done(function (res) {});
                        });

                        //

                        $("#fotoTanqueDieselDos").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
                            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoPlantatanqueDos/<?php echo $idAsignacion;?>/"+capac+"/"+cantid+"/",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
                            ,
                            initialPreview: [codigD
                            ]
                        }).on('change', function(event, data, previewId, index)
                        {
                            $("#fotoTanqueDieselDos").fileinput("upload");
                        }).on('fileclear', function (event) {
                            // alert(idAsi) idAsi,capac,cantid
                            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenServidorTanqueD/"+idAsi+"/"+capac+"/"+cantid;
                            $.ajax({
                                url: url,
                                type: "post",
                                dataType: "html"
                            }).done(function (res) {});


                        });

                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });



    }
</script>

<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->