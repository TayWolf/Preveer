<?php
include "header.php";
?>

<script type="text/javascript">
    var array = {
        'datosGas': []
    };
    var array2 = {
        'datosSustanciasQuimicas': []
    };
</script>

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
                        <h2>Lista de materiales peligrosos del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <form id="form2">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">

                                <?php
                                $contador=0;
                                $row=array('idMaterialPeligroso'=>"", 'fechaVisita'=> '',
                                    'dictamen'=>'', 'ano'=>'', 'isometrico'=>'','areaEquipo'=>'','ubicacValculacierre'=>'', 'ubicacionGas'=>'', 'fotoTanqueGas'=>'', 'cantDiesel'=>'', 'ubicaDiesel'=>'',
                                    'diqueContencionDiesel'=>'', 'cantGasolina'=>'', 'ubicaGasolina'=>'', 'diqueContencionGasolina'=>'','idAsignacion' => '' );
                                foreach ($existencia as $row2)
                                {
                                    $row=$row2;
                                    $contador++;
                                }
                                ?>

                                 <?php
                              
                                $arraySustancias=array('idSustanciaQuimica'=>"", 'nombreSustancia   '=> '',
                                    'cantidadReporte'=>'', 'sitioAlmacenamiento'=>'', 'usoSustancia'=>'','hojaSeguridad'=>'','fotoSustancia1'=>'', 'fotoSustancia2'=>'', 'fotoSustancia3'=>'', 'fotoSustancia4'=>'', 'fotoSustancia5'=>'','idAsignacion' => '');
                                
                                foreach ($existenciaSustancias as $arraySustancias)
                                {
                                    $row3=$arraySustancias;
                                }

                                ?>

                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_18" aria-expanded="true" aria-controls="collapseOne_18">
                                                <i class="material-icons">assignment</i> Visitas
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">

                                            <div class="row">
                                                <input type="hidden" name="idDatosGenerales" value="<?php echo $row['idMaterialPeligroso'];?>">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de revisión</b>
                                                            <input type="date" class="form-control" id="fechaVisita" name="fechaVisita"  required value="<?php echo $row['fechaVisita']; ?>" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group text-center">
                                                        <br><input class="form-control" type="checkbox" id="noAplicaGas" value="NoAplica" name="noAplicaGas" <?php if($row["noAplicaGas"] == 1) print 'checked' ?>><label for="noAplicaGas">No aplica</label><br>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tipo de gas</b>
                                                            <select class="form-control" id="tipoDeGas" name="tipoDeGas" onchange="visualInfo()" <?php if($row["noAplicaGas"] == 1) print 'disabled' ?> required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Gas LP</option>
                                                                <option value="2">Gas Natural</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de tanques</b>
                                                            <input type="number" class="form-control" id="NoTanques" name="NoTanques" min="1" <?php if($row["noAplicaGas"] == 1) print 'disabled' ?> required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Capacidad (Lts)</b>
                                                            <input type="number" class="form-control" id="Capacidad" name="Capacidad" min="0" <?php if($row["noAplicaGas"] == 1) print 'disabled' ?> required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="visualLp" style="display: none">

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Año de fabricación del tanque</b>
                                                                <input type="number" class="form-control" id="anoDeFabricacion" name="anoDeFabricacion" min="1900" max="2018" <?php if($row["noAplicaGas"] == 1) print 'disabled' ?> />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Ubicación tanque</b>
                                                                <input type="text" class="form-control" id="Ubicacion" name="Ubicacion" placeholder="Ubicación del tanque" <?php if($row["noAplicaGas"] == 1) print 'disabled' ?> />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>¿Cuenta con señalización y rotulación?</b>
                                                                <select class="form-control" id="seRotu" name="seRotu" <?php if($row["noAplicaGas"] == 1) print 'disabled' ?>>
                                                                    <option value="">Seleccione una opción</option>
                                                                    <option value="1" >Si</option>
                                                                    <option value="2" >No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Observaciones</b>
                                                                <textarea class="form-control" id="observaGas" name="observaGas" <?php if($row["noAplicaGas"] == 1) print 'disabled' ?>> </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div id="visualNatural" style="display: none">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Ubicación de válvula de entrada</b>
                                                                <input type="text" class="form-control" id="UbicacionTanq" name="UbicacionTanq" placeholder="Ubicación de válvula de entrada" <?php if($row["noAplicaGas"] == 1) print 'disabled' ?>/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2 col-md-offset-5">
                                                    <div class="form-line">
                                                        <input type="submit" class="btn bg-red waves-effect waves-light" id="agregarTanque" value="Agregar" <?php if($row["noAplicaGas"] == 1) print 'disabled' ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="body table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>CANTIDAD</th>
                                                        <th>GAS</th>
                                                        <th>CAPACIDAD</th>
                                                        <th>UBICACIÓN</th>
                                                        <th>AÑO/FA.</th>
                                                        <th>SEÑ./ROT.</th>
                                                        <th>OBSERVACIONES</th>
                                                        <th>FOTO</th>
                                                        <th>ELIMINAR</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="listaInstalacionesGas">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form id="form" enctype="multipart/form-data" action="">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_18">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">
                                                <i class="material-icons">assignment</i> Datos
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19">
                                        <div class="panel-body">


                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>¿Cuenta con dictamen?</b>
                                                            <select class="form-control" id="dictamen" name="dictamen"  >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['dictamen']==1) echo "selected" ?>>Si</option>
                                                                <option value="2" <?php if($row['dictamen']==2) echo "selected" ?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Año del dictamen</b>
                                                            <input type="hidden" name="idAsignaciond" id="idAsignaciond" value="<?php echo $idAsignacion; ?>">
                                                            <input type="number" class="form-control" id="ano" name="ano" min="1900" value="<?php echo $row['ano']; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>¿Cuenta con diagrama isométrico?</b>
                                                            <select class="form-control" id="isometrico" name="isometrico" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['isometrico']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['isometrico']==2) echo "selected"?>>No</option>
                                                                <option value="3" <?php if($row['isometrico']==3) echo "selected"?>>N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="row">


                                                 <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de diesel (Lts)</b>
                                                            <input type="number" class="form-control" id="cantDiesel" name="cantDiesel" min="0" value="<?php echo $row['cantDiesel']; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>-->
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Áreas y equipos de uso de gas en las instalaciones</b>
                                                            <input type="text" class="form-control" id="areaEquipo" name="areaEquipo" value="<?php echo $row['areaEquipo']; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Ubicación de valvulas de cierre</b>
                                                            <input type="text" class="form-control" id="ubicacValculacierre" name="ubicacValculacierre" value="<?php echo $row['ubicacValculacierre']; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--<div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>¿Cuenta con dique de contención?</b>
                                                            <select class="form-control" id="diqueContencionDiesel" name="diqueContencionDiesel" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['diqueContencionDiesel']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['diqueContencionDiesel']==2) echo "selected"?>>No</option>
                                                                <option value="3" <?php if($row['diqueContencionDiesel']==3) echo "selected"?>>N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Ubicación de gas</b>
                                                            <textarea type="text" class="form-control" id="ubicacionGas" name="ubicacionGas"><?php echo $row['ubicacionGas']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones de instalación de gas</b>
                                                            <textarea  type="text" class="form-control" id="observacionesInstalacionGas" name="observacionesInstalacionGas"><?php echo $row['observacionesInstalacionGas']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row" >
                                                 <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                                                <div class="col-sm-4 col-md-4 col-md-offset-4 col-sm-offset-4">
                                                    <b>Foto del tanque de gas</b>
                                                    <input type="file" class="file" id="fotoTanqueGas" name="fotoTanqueGas[]" data-min-file-count="1"  />
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-group full-body" id="accordion_20" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_20">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_20" aria-expanded="true" aria-controls="collapseOne_20">
                                                <i class="material-icons">assignment</i> Diesel
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_20" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_20">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad  de diesel (Lts)</b>
                                                            <input type="number" class="form-control" id="cantGasolina" name="cantGasolina" min="0" value="<?php echo $row['cantGasolina']; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>¿Cuenta con dique de contención?</b>
                                                            <select class="form-control" id="diqueContencionGasolina" name="diqueContencionGasolina" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['diqueContencionGasolina']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['diqueContencionGasolina']==2) echo "selected"?>>No</option>
                                                                <option value="3" <?php if($row['diqueContencionGasolina']==3) echo "selected"?>>N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Ubicación de tanques de diesel</b>
                                                            <textarea type="text" class="form-control" id="ubicaGasolina" name="ubicaGasolina"><?php echo $row['ubicaGasolina']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones de instalación de diesel</b>
                                                            <textarea  type="text" class="form-control" id="observacionesInstalacionDiesel" name="observacionesInstalacionDiesel"><?php echo $row['observacionesInstalacionDiesel']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form id="form3" enctype="multipart/form-data" action="">
                            <div class="panel-group full-body" id="accordion_21" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_21">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" href="#collapseOne_21" aria-expanded="true" aria-controls="collapseOne_21">
                                                <i class="material-icons">assignment</i> Sustancias químicas
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_21" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_21">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Sustancia química</b>
                                                            <input type="text" class="form-control" id="sustanciaQuimica" name="sustanciaQuimica"  required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Cantidad de reporte</b>
                                                            <input type="text" class="form-control" id="cantidadReporte" name="cantidadReporte" min="1" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Sitio de almacenamiento</b>
                                                            <input type="text" class="form-control" id="sitioAlmacenamiento" name="sitioAlmacenamiento"  required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Uso de sustancia</b>
                                                            <input type="text" class="form-control" id="usoSustancia" name="usoSustancia" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Hoja de seguridad</b>
                                                            <select class="form-control" id="hojaSeguridad" name="hojaSeguridad" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Si</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2 col-md-offset-5">
                                                <div class="form-line">
                                                    <input type="submit" onclick="AgregarsustanciaQuimica()" class="btn bg-red waves-effect waves-light"  value="Agregar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="body table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>SUSTANCIA QUÍMICA</th>
                                                    <th>CANTIDAD DE REPORTE</th>
                                                    <th>SITIO DE ALMACENAMIENTO</th>
                                                    <th>USO</th>
                                                    <th>HOJA DE SEGURIDAD</th>
                                                    <!-- <th>FOTOS</th> -->
                                                    <th>ELIMINAR</th>
                                                </tr>
                                                </thead>
                                                <tbody id="listaSustanciasQuimicas">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--Fotos sustancias quimicas-->
                        <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">
                        <div class="row" align="center">
			            	<div class="col-sm-4 col-md-4">
                                                    <b>Foto 1</b>
                                                    <input type="file" class="file" id="fotoSustancia1" name="fotoSustancia1[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto 2</b>
                                                    <input type="file" class="file" id="fotoSustancia2" name="fotoSustancia2[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-4 col-md-4">
                                                    <b>Foto 3</b>
                                                    <input type="file" class="file" id="fotoSustancia3" name="fotoSustancia3[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <b>Foto 4</b>
                                                    <input type="file" class="file" id="fotoSustancia4" name="fotoSustancia4[]" data-min-file-count="1" />
                                                </div>
                                                <div class="col-sm-6 col-md-6">
                                                    <b>Foto 5</b>
                                                    <input type="file" class="file" id="fotoSustancia5" name="fotoSustancia5[]" data-min-file-count="1" />
                                                </div>     
			            </div>
                        </div>


                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4 col-md-offset-5">
                                        <div class="form-line">
                                            <input type="button" onclick="registrarDatosSustanciasQuimicas();" class="btn bg-red waves-effect waves-light" value="Guardar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form id="insercionSustanciaQuimica"></form>

                        

                    </div>
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
                    <div class="col-md-4 ">
                        <b>Foto Uno</b>
                        <div id="ConteniFoto">

                        </div>

                    </div>
                    <div class="col-md-4 ">
                        <b>Foto Dos</b>
                        <div id="ConteniFotoDos">

                        </div>

                    </div>
                    <div class="col-md-4 ">
                        <b>Foto Tres</b>
                        <div id="ConteniFotoTres">

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



<!-- MODAL DE SUSTANCIAS QUÍMICAS -->
<div class="modal fade" id="myModalSustanciasQuimicias" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Imagenes</h4>
            </div>
            <div class="modal-body">
                <div class="row" align="center">
                    <b>Fotos de Sustancias Quimicas</b>
                    <div id="ConteniFoto">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>
<!-- MODAL DE SUSTANCIAS QUÍMICAS -->

<script type="text/javascript">

    /*
    * NO APLICA - TANQUES
    * */

    $("#noAplicaGas").click(function(){

        var value = $("#noAplicaGas").is(':checked');

        $("#tipoDeGas").prop('disabled', value);
        $("#NoTanques").prop('disabled', value);
        $("#Capacidad").prop('disabled', value);
        $("#anoDeFabricacion").prop('disabled', value);
        $("#Ubicacion").prop('disabled', value);
        $("#seRotu").prop('disabled', value);
        $("#observaGas").prop('disabled', value);
        $("#UbicacionTanq").prop('disabled', value);
        $("#agregarTanque").prop('disabled', value);

    });

    /*
    * NO APLICA - TANQUES
    * */


    $(window).on('load', function()
    {

        $('#fotoTanqueGas').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoTanqueGas/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoTanqueGas"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . base_url('assets/img/fotoAnalisisRiesgo/fotoTanqueGas/') . $row['fotoTanqueGas'] . "\' class='file-preview-image' alt=\'" . $row['fotoTanqueGas'] . "\' title=\'" . $row['fotoTanqueGas'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoTanqueGas").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoTanqueGas';
                $tabla = 'MaterialPeligroso';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

    });

    function visualInfo()
    {
        var tipoDeGas=$("#tipoDeGas").val();
        if (tipoDeGas==1)
        {
            $("#visualLp").show();
            $("#visualNatural").hide();
            $("#UbicacionTanq").val('');
            $("#NoTanques").val('1');

        }
        if (tipoDeGas==2)
        {
            $("#visualNatural").show();
            $("#visualLp").hide();
            $("#Capacidad").val('');
            $("#NoTanques").val('1');
            $("#anoDeFabricacion").val('');
            $("#Ubicacion").val('');
            $("#senRotu").val('');
            $("#areasRemodeladas").val('');
        }
    }

    $("#form2").on("submit", function(e){
        e.preventDefault();
        AgregarGases();
    });

    function AgregarGases()
    {
        var tipoDeGas = $("#tipoDeGas").val();
        if (tipoDeGas==1)
        {
            var nombreGas="Gas LP";
            var Ubicacion = $("#Ubicacion").val();
        }
        if (tipoDeGas==2)
        {
            var nombreGas="Gas Natural";
            var Ubicacion = $("#UbicacionTanq").val();
        }
        var NoTanques = $("#NoTanques").val();
        var Capacidad = $("#Capacidad").val();
        var anoDeFabricacion = $("#anoDeFabricacion").val();

        var seRotu = $("#seRotu").val();
        if (seRotu==1)
        {
            var sen="SI";
        }
        if (seRotu==2)
        {
            var sen="NO";
        }
        if (seRotu=="")
        {
            var sen="";
        }
        var observaGas = $("#observaGas").val();
//alert(seRotu)
        //  var UbicacionTanq = $("#UbicacionTanq").val();
        var idAsigns = $("#idAsignacion").val();

        array.datosGas.push({'idPuente': '-1', 'tipoDeGas': tipoDeGas ,'NoTanques':NoTanques,'Capacidad': Capacidad,'anoDeFabricacion': anoDeFabricacion,'seRotu':seRotu,'observaGas':observaGas, 'action' : 1, 'Ubicacion': Ubicacion});
        console.log(JSON.stringify(array.datosGas, null, 4));

        $("#listaInstalacionesGas").append('<tr>'+
            '<td>'+NoTanques+'</td>'+
            '<td>'+nombreGas+'</td>'+
            '<td>'+Capacidad+'</td>'+
            '<td>'+Ubicacion+'</td>'+
            '<td>'+anoDeFabricacion+'</td>'+
            '<td>'+sen+'</td>'+
            '<td>'+observaGas+'</td>'+
            '<td><i onclick="traerFotoUnica('+idAsigns+','+tipoDeGas+','+Capacidad+' )"  data-toggle="modal" data-target="#myModalImagenInstalacion" class="fa fa-picture-o" aria-hidden="true"></i></td>'+
            '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
            '</tr>');

        limpiarFormulario();
    }

    function limpiarFormulario()
    {
        $("#Capacidad").val('');
        $("#NoTanques").val('1');
        $("#anoDeFabricacion").val('');
        $("#Ubicacion").val('');
        $("#seRotu").val('');
        $("#areasRemodeladas").val('');
        $("#UbicacionTanq").val('');
    }

    window.onload = cargaDatosTabla;

    function cargaDatosTabla(){

        <?php
        foreach ($GasPuente as $row) {
            $idPuente = $row["idPuente"];
            $tipoGas = $row["tipoGas"];
            $noTanque = $row["noTanque"];
            $capacidadGas = $row["capacidadGas"];
            $anioFabricacion = $row["anioFabricacion"];

            if ($tipoGas==1)
            {
                $nombreGas="Gas LP";

            }
            if ($tipoGas==2)
            {
                $nombreGas="Gas Natural";

            }

            $ubicacionGas = $row["ubicacionGas"];
            $senalizacion = $row["senalizacion"];
            if ($senalizacion==1)
            {
                $sen="SI";
            }
            if ($senalizacion==2)
            {
                $sen="NO";
            }else{
                $sen="";
            }
            $observacionesGas = $row["observacionesGas"];
            $fotoGas = $row["fotoGas"];
            $idAsignacion = $row["idAsignacion"];

            print "array.datosGas.push({'idPuente' : $idPuente,'tipoDeGas' : '$tipoGas', 'NoTanques' : $noTanque,'Capacidad':$capacidadGas, 'anoDeFabricacion' : '$anioFabricacion','seRotu':'$senalizacion','observaGas':'$observacionesGas', 'action' : 0,'Ubicacion':'$ubicacionGas'}); \n";




            print "$('#listaInstalacionesGas').append(
                     '<tr><td>$noTanque</td><td>$nombreGas</td><td>$capacidadGas</td><td>$ubicacionGas</td><td>$anioFabricacion</td><td>$sen</td><td>$observacionesGas</td><td><button onclick=\"traerFotoUnica($idAsignacion,$tipoGas,$capacidadGas)\" type=\"button\" class=\"btn btn-default\"><i data-toggle=\"modal\" data-target=\"#myModalImagenInstalacion\" class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";


        }
        print("console.log(JSON.stringify(array.datosGas, null, 4));");
        ?>
    }


    function traerFotoUnica(idAsi,tipoG,Capac)
    {
        $("#ConteniFoto").html("");
        $("#ConteniFoto").append("<input type='file' class='file' id='fotoTanqueDieselUno' name='fotoTanqueDieselUno[]' data-min-file-count='1' />")

        $("#ConteniFotoDos").html("");
        $("#ConteniFotoDos").append("<input type='file' class='file' id='fotoTanqueDieselDos' name='fotoTanqueDieselDos[]' data-min-file-count='1' />")


        $("#ConteniFotoTres").html("");
        $("#ConteniFotoTres").append("<input type='file' class='file' id='fotoTanqueDieselTres' name='fotoTanqueDieselTres[]' data-min-file-count='1' />")

        $.ajax({
            url : "<?php echo site_url('CrudAnalisisRiesgo/retornoFotoGas/')?>/" + idAsi+"/"+tipoG+"/"+Capac,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                var fot=null;
                var codig=null;

                var fotD=null;
                var codigD=null;

                var fotT=null;
                var codigT=null;

                if (data.length>0)
                {
                    for (i=0; i< data.length; i++) {
                        var fot=data[i]["fotoGas"];
                        if (fot!=null)
                        {
                            //alert("entra "+fot)
                            codig="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoTanqueGas/"+fot+"' class='file-preview-image' >";
                        }
                        fotD=data[i]["fotoGasDos"];
                        if (fotD!=null)
                        {
                            var codigD="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoTanqueGas/"+fotD+"' class='file-preview-image' >";
                        }

                        var fotT=data[i]["fotoGasTres"];
                        if (fotT!=null)
                        {
                            var codigT="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoTanqueGas/"+fotT+"' class='file-preview-image' >";
                        }
                    }
                }
                //var idControl=data[i]["idRevisionInstalaciones"];
                // alert(fot)
                $("#fotoTanqueDieselUno").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
                    'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoGas/<?php echo $idAsignacion;?>/"+tipoG+"/"+Capac +"/",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png'],initialPreview: [codig]

                }).on('change', function(event, data, previewId, index)
                {
                    $("#fotoTanqueDieselUno").fileinput("upload");

                }).on('fileclear', function (event) {
                    // alert(idAsi) idAsi,capac,cantid
                    url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenServidorGas/"+idAsi+"/"+tipoG+"/"+Capac;
                    $.ajax({
                        url: url,
                        type: "post",
                        dataType: "html"
                    }).done(function (res) {});
                });
                //Dos
                $("#fotoTanqueDieselDos").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
                    'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoGasD/<?php echo $idAsignacion;?>/"+tipoG+"/"+Capac+"/",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
                    ,
                    initialPreview: [codigD
                    ]
                }).on('change', function(event, data, previewId, index)
                {
                    $("#fotoTanqueDieselDos").fileinput("upload");
                }).on('fileclear', function (event) {
                    // alert(idAsi) idAsi,capac,cantid
                    url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenServidorGasD/"+idAsi+"/"+tipoG+"/"+Capac;
                    $.ajax({
                        url: url,
                        type: "post",
                        dataType: "html"
                    }).done(function (res) {});
                });
                //Tres
                $("#fotoTanqueDieselTres").fileinput({'showUploadedThumbs': false, 'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
                    'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirfotoGasT/<?php echo $idAsignacion;?>/"+tipoG+"/"+Capac+"/",'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']
                    ,
                    initialPreview: [codigT
                    ]
                }).on('change', function(event, data, previewId, index)
                {
                    $("#fotoTanqueDieselTres").fileinput("upload");
                }).on('fileclear', function (event) {
                    // alert(idAsi) idAsi,capac,cantid
                    url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenServidorGasT/"+idAsi+"/"+tipoG+"/"+Capac;
                    $.ajax({
                        url: url,
                        type: "post",
                        dataType: "html"
                    }).done(function (res) {});
                });


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    $(document).on('click', '.btn-defaultBorrar', function (event) {
        event.preventDefault();

        var indice =  $(this).closest('tr').index();

        if(array.datosGas[indice]['idPuente'] == -1)
        {
            array.datosGas.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array.datosGas[indice]['action']=3;
            $(this).closest('tr').hide();
        }

        console.log(JSON.stringify(array.datosGas, null, 4));

    });
</script>




<!--- SCRIPT SUSTANCIAS QUÍMICAS  -->

<script type="application/javascript">
    $("#form3").on("submit", function(e){
        e.preventDefault();
        AgregarsustanciaQuimica();
    });

    function AgregarsustanciaQuimica()
    {

        var sustanciaQuimica = $("#sustanciaQuimica").val();
        var cantidadReporte = $('#cantidadReporte').val();
        var sitioAlmacenamiento = $("#sitioAlmacenamiento").val();
        var usoSustancia = $("#usoSustancia").val();
        var hojaSeguridad = $("#hojaSeguridad").val();

        var arregloInsercion= {
            'arreglo': []
        };

        arregloInsercion.arreglo.push({'sustanciaQuimica':sustanciaQuimica, 'cantidadReporte':cantidadReporte, 'sitioAlmacenamiento':sitioAlmacenamiento,'usoSustancia':usoSustancia, 'hojaSeguridad':hojaSeguridad});
        var formData=new FormData(document.getElementById('insercionSustanciaQuimica'));
        formData.append('datosSustanciaQuimica', (JSON.stringify(arregloInsercion.arreglo)));
        //console.log(JSON.stringify(arregloInsercion.arreglo));
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/insertarSustanciaQuimica/"+$("#idAsignacion").val(),
                type: "post",
                dataType: "html",
                data: formData,
                cache : false,
                contentType: false,
                processData: false
            }
        ).done(function(data)
        {

            array2.datosSustanciasQuimicas.push({'idSustanciaQuimica': data,'sustanciaQuimica': sustanciaQuimica, 'cantidadReporte': cantidadReporte ,'sitioAlmacenamiento': sitioAlmacenamiento,'usoSustancia': usoSustancia, 'action' : 0, 'hojaSeguridad':hojaSeguridad});
            $("#listaSustanciasQuimicas").append('<tr>'+
                '<td>'+sustanciaQuimica+'</td>'+
                '<td>'+cantidadReporte+'</td>'+
                '<td>'+sitioAlmacenamiento+'</td>'+
                '<td>'+usoSustancia+'</td>'+
                '<td>'+hojaSeguridad+'</td>'+
                '<td><button type="button" class="btn btn-defaultBorrar2"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
                '</tr>');
            console.log(JSON.stringify(array2.datosSustanciasQuimicas,null,4));

        });

        limpiarFormularioSustancias();
    }

    function limpiarFormularioSustancias()
    {
        $("#sustanciaQuimica").val("");
        $("#cantidadReporte").val("");
        $("#sitioAlmacenamiento").val("");
        $("#usoSustancia").val("");
        $("#hojaSeguridad").val("");
    }

    $(document).on('click', '.btn-defaultBorrar2', function (event) {
        event.preventDefault();

        var indice =  $(this).closest('tr').index();

        if(array2.datosSustanciasQuimicas[indice]['idSustanciaQuimica'] == -1)
        {
            array2.datosSustanciasQuimicas.splice(indice, 1);
            $(this).closest('tr').remove();
        }
        else
        {
            array2.datosSustanciasQuimicas[indice]['action'] = 3;
            $(this).closest('tr').hide();
        }
        console.log(JSON.stringify(array2.datosSustanciasQuimicas, null, 4));
    });


    function registrarDatosSustanciasQuimicas()
    {

        var url;
        var accion=<?php echo $contador;?>;
        accion="actualizarMaterialesPeligrosos/";

        url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/';?>"+accion;
        var f = $(this);
        var formData = new FormData(document.getElementById("form"));
        formData.append('datosGas', (JSON.stringify(array.datosGas)));
        formData.append('datosSustanciasQuimicas', (JSON.stringify(array2.datosSustanciasQuimicas)));

        $("#noAplicaGas").is(':checked') ? $("#noAplicaGas").val('1') : $("#noAplicaGas").val('0');
        formData.append('noAplicaGas', $('#noAplicaGas').val());

        $.post({
            url: url,
            type: "post",
            dataType: "html",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data)
            {
                console.log(data);
                swal({
                        title: "Éxito",
                        text: "Se han registrado los datos generales",
                        type: "success",

                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Aceptar",

                    },
                    function(){

                        location.href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/';
                    });
            }
        });
    }

    function traerModalFoto(id)
    {
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/obtenerFotosSustancias/"+id,
                type: 'post',
                dataType: 'json',
                cache : false,
                contentType: false,
                processData: false
            }
        ).done(function (data)
        {

            //FOR PARA LLENAR EL MODAL CON BOTONES DE TIPO FILE
            $("#ConteniFoto").html("");

            $("#ConteniFoto").html('<div class="row"><div class="col-sm-4"><input type=\'file\' class=\'file\' id=\'fotoSustancia1\' name=\'fotoSustancia1[]\' data-min-file-count=\'1\' /></div>'
                +'<div class="col-sm-4"><input type=\'file\' class=\'file\' id=\'fotoSustancia2\' name=\'fotoSustancia2[]\' data-min-file-count=\'1\' /></div>'
                +'<div class="col-sm-4"><input type=\'file\' class=\'file\' id=\'fotoSustancia3\' name=\'fotoSustancia3[]\' data-min-file-count=\'1\' /></div></div>'
                +'<div class="row"><div class="col-sm-4 col-sm-offset-2"><input type=\'file\' class=\'file\' id=\'fotoSustancia4\' name=\'fotoSustancia4[]\' data-min-file-count=\'1\' /></div>'
                +'<div class="col-sm-4"><input type=\'file\' class=\'file\' id=\'fotoSustancia5\' name=\'fotoSustancia5[]\' data-min-file-count=\'1\' /></div></div>');

            //FOR PARA HACER QUE LOS BOTONES SE VUELVAN FILEINPUTS
            for(i=1;i<=5;i++)
            {

                var codig=null;
                var nombreFoto = data[0]['fotoSustancias' + i];

                if(nombreFoto!=null) {

                    codig = "<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/fotoSustancias" + i + "/" + nombreFoto + "' class='file-preview-image'>";

                }
                crearFileInput(i, id, codig);
            }

            $("#myModalSustanciasQuimicias").modal();

        });
    }

    function crearFileInput(i, id, codig)
    {
        $("#fotoSustancias" + i).fileinput({
            'showUploadedThumbs': true,
            'showCaption': false,
            'showCancel': false,
            'showRemove': false,
            'showUpload': false,
            'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneralTabla/fotoSustancias"+i+"/SustanciasQuimicas/"+id+"/idSustanciaQuimica/",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png'],
            initialPreview: [codig]
        }).on('change', function (event, data, previewId, index) {
            $("#fotoSustancias" + i).fileinput("upload");

        }).on('fileclear', function (event) {
            // alert(idAsi)
            url = "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/eliminarImagenArreglo/fotoSustancias" + i + "/SustanciasQuimicas/" + id + "/idSustanciaQuimica";
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {
            });
        });
    }

    window.onload = cargaDatosSustanciasQuimicas;

    function cargaDatosSustanciasQuimicas()
    {
        <?php
        foreach ($existenciaSustancias as $row3) {
            $idSustanciasQuimica = $row3["idSustanciaQuimica"];
            $nombreSustancia = $row3["nombreSustancia"];
            $cantidadReporte = (empty($row3["cantidadReporte"])) ? 0 : $row3["cantidadReporte"];
            $sitioAlmacenamiento = $row3["sitioAlmacenamiento"];
            $usoSustancia = $row3["usoSustancia"];
            $hojaSeguridad = $row3["hojaSeguridad"];

            print "array2.datosSustanciasQuimicas.push({'idSustanciaQuimica' : $idSustanciasQuimica, 'nombreSustancia' : '$nombreSustancia', 'cantidadReporte' : '$cantidadReporte', 'sitioAlmacenamiento' : '$sitioAlmacenamiento', 'action' : 0, 'usoSustancia' : '$usoSustancia', 'hojaSeguridad':'$hojaSeguridad'}); \n";

            print "$('#listaSustanciasQuimicas').append(
                     '<tr><td hidden>$idSustanciasQuimica</td><td>$nombreSustancia</td><td>$cantidadReporte</td><td>$sitioAlmacenamiento</td><td>$usoSustancia</td><td>$hojaSeguridad</td><td><button type=\"button\" class=\"btn btn-defaultBorrar2\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";
        }
        print("console.log(JSON.stringify(array2.datosSustanciasQuimicas, null, 4));");
        ?>
    }

</script>

<script type="text/javascript">
	$(window).on('load', function()
    {
        cargaDatosTabla();

	$("#fotoSustancia1").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoSusQuimicas/fotoSustancia1/SustanciasQuimicas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row3["fotoSustancia1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/').$row3['fotoSustancia1']."\' class='file-preview-image' alt=\'".$row3['fotoSustancia1']."\' title=\'".$row3['fotoSustancia1']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSustancia1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSustancia1';
                $tabla = 'SustanciasQuimicas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagenSusQ/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });
        // foto dos
        $("#fotoSustancia2").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoSusQuimicas/fotoSustancia2/SustanciasQuimicas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row3["fotoSustancia2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/').$row3['fotoSustancia2']."\' class='file-preview-image' alt=\'".$row3['fotoSustancia2']."\' title=\'".$row3['fotoSustancia2']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSustancia2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSustancia2';
                $tabla = 'SustanciasQuimicas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });
        //fin foto dos

        //foto tres
        $("#fotoSustancia3").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoSusQuimicas/fotoSustancia3/SustanciasQuimicas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row3["fotoSustancia3"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/').$row3['fotoSustancia3']."\' class='file-preview-image' alt=\'".$row3['fotoSustancia3']."\' title=\'".$row3['fotoSustancia3']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSustancia3").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSustancia3';
                $tabla = 'SustanciasQuimicas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });
        
        //foto cuatro
        $("#fotoSustancia4").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoSusQuimicas/fotoSustancia4/SustanciasQuimicas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row3["fotoSustancia4"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/').$row3['fotoSustancia4']."\' class='file-preview-image' alt=\'".$row3['fotoSustancia4']."\' title=\'".$row3['fotoSustancia4']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSustancia4").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSustancia4';
                $tabla = 'SustanciasQuimicas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });
        
        //foto cinco
        $("#fotoSustancia5").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoSusQuimicas/fotoSustancia5/SustanciasQuimicas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row3["fotoSustancia5"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/').$row3['fotoSustancia5']."\' class='file-preview-image' alt=\'".$row3['fotoSustancia5']."\' title=\'".$row3['fotoSustancia5']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoSustancia5").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSustancia5';
                $tabla = 'SustanciasQuimicas';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });

        });
</script>

<!--- SCRIPT SUSTANCIAS QUÍMICAS -->


<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->