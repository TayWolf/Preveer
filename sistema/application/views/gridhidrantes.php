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
                    echo "<a href='javascript:history.go(-1);'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } else{
                    echo "<a href='javascript:history.go(-1);'>
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
                        <h2>RED CONTRA INCENDIOS</h2>
                    </div>
                    <div class="body">
                        <form id="form" enctype="multipart/form-data" action="Crudhidrantes/actualizarDatosGenerales/">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">

                                <?php
                                $contador=0;

                                $row = Array(
                                    'idHidrante'=>'',
                                    'fechaVisita'=> '',
                                    'boquillaExterior15'=> '',
                                    'boquillaExterior30'=>'',
                                    'llaveExteroior15'=>'',
                                    'totalBoquillas'=>'',
                                    'llaveExteroior15'=>'',
                                    'llaveExterior30'=>'',
                                    'boquillaInterior15'=>'',
                                    'boquillaInterior30'=>'',
                                    'llaveInterior15'=>'',
                                    'llaveInterior30'=>'',
                                    'llaveInterior30'=>'',
                                    'totalLlaves'=>'',
                                    'siamesa'=>'',
                                    'ubicacionSiamesa'=>'',
                                    'fotoSiamesa'=>'',
                                    'fotoInterior'=>'',
                                    'fototExterior'=>'',
                                    'fotoRedIncendios4'=>'',
                                    'fotoRedIncendios5'=>'',
                                    'fotoRedIncendios6'=>'',
                                    'observacionesGral'=>'',
                                    'observacionesGrales'=>'',
                                    'idAsignac' => ''
                                );

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
                                                <i class="material-icons">assignment</i> Visitas
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_18" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_18">
                                        <div class="panel-body">
                                            <div class="row">
                                                <input type="hidden" name="idDatosGenerales" value="<?php echo $row['idHidrante'];?>">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de revisión</b>
                                                            <input type="date" class="form-control" id="fechaVisita" name="fechaVisita"  required value="<?php echo $row['fechaVisita']; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-col-lightgray">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_1">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_1" aria-expanded="true" aria-controls="collapseOne_1">
                                                    <i class="material-icons">assignment</i> Boquillas
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapseOne_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_1">
                                            <div class="panel-body">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Interior </b>
                                                            <input type="number" class="form-control sumaBoquillas" id="InterBoqui" name="InterBoqui" min="0" value="<?php echo $row['boquillaInterior15'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Exterior </b>
                                                            <input type="number" class="form-control sumaBoquillas" id="exteBoqui" name="exteBoqui" min="0" value="<?php echo $row['boquillaExterior15'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total</b>
                                                            <input type="number" class="form-control" id="totalBoquillas" name="totalBoquillas" min="0" value="<?php echo $row['totalBoquillas'];?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-col-lightgray">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_2">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_2" aria-expanded="true" aria-controls="collapseOne_2">
                                                    <i class="material-icons">assignment</i> Llave
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapseOne_2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_2">
                                            <div class="panel-body">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Interior </b>
                                                            <input type="number" class="form-control sumaLlaves" id="InterLave" name="InterLave" min="0" value="<?php echo $row['llaveInterior15'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Exterior </b>
                                                            <input type="number" class="form-control sumaLlaves" id="exteLave" name="exteLave" min="0" value="<?php echo $row['llaveExteroior15'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Total</b>
                                                            <input type="number" class="form-control" id="totalLlaves" name="totalLlaves" min="0" value="<?php echo $row['totalLlaves'];?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-col-lightgray">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_3">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_3" aria-expanded="true" aria-controls="collapseOne_3">
                                                    <i class="material-icons">assignment</i> Tomas Siamesas
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapseOne_3" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_3">
                                            <div class="panel-body">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Tomas Siamesas </b>
                                                            <input type="text" class="form-control" id="tomaSiamesas" name="tomaSiamesas" value="<?php echo $row['siamesa'];?>"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Ubicación </b>
                                                            <input type="text" class="form-control" id="ubicacionSiame" name="ubicacionSiame" value="<?php echo $row['ubicacionSiamesa'];?>"  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <textarea type="text" class="form-control" id="observacionesGral" name="observacionesGral" > <?php echo $row['observacionesGral'];?> </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" >
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 1</b>
                                                        <input type="file" class="file" id="fotoInterior" name="fotoInterior[]" data-min-file-count="1"  />
                                                    </div>
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 2</b>
                                                        <input type="file" class="file" id="fototExterior" name="fototExterior[]" data-min-file-count="1"  />
                                                    </div>
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 3</b>
                                                        <input type="file" class="file" id="fotoSiamesa" name="fotoSiamesa[]" data-min-file-count="1"  />
                                                    </div>
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 4</b>
                                                        <input type="file" class="file" id="fotoRedIncendios4" name="fotoRedIncendios4[]" data-min-file-count="1" />
                                                    </div>
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 5</b>
                                                        <input type="file" class="file" id="fotoRedIncendios5" name="fotoRedIncendios5[]" data-min-file-count="1"  />
                                                    </div>
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 6</b>
                                                        <input type="file" class="file" id="fotoRedIncendios6" name="fotoRedIncendios6[]" data-min-file-count="1"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-col-lightgray">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_4">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_4" aria-expanded="true" aria-controls="collapseOne_4">
                                                    <i class="material-icons">assignment</i> Cuarto Bombas
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapseOne_4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_4">
                                            <div class="panel-body">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>PRUEBA</th>
                                                    </tr>
                                                    </thead>
                                                </table>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 ">
                                                        <b>BOMBA JOCKEY</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <select class='form-control' name='bombaJockey' id='bombaJockey'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" id="obsBombaJockey" name="obsBombaJockey" placeholder="Capacidades / Observaciones"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 ">
                                                        <b>BOMBA COMB. INTERNA</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <select class='form-control' name='bombaInterna' id='bombaInterna'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" id="obsBombaInterna" name="obsBombaInterna" placeholder="Capacidades / Observaciones"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 ">
                                                        <b>BOMBA ELÉCTRICA</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <select class='form-control' name='bombaElectrica' id='bombaElectrica'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" id="obsBombaElectrica" name="obsBombaElectrica" placeholder="Capacidades / Observaciones"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 ">
                                                        <b>FUGA DE COMBUSTIBLE</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <select class='form-control' name='fugaCombustible' id='fugaCombustible'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" id="obsFugaCombustible" name="obsFugaCombustible" placeholder="Capacidades / Observaciones"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 ">
                                                        <b>FUGA DE AGUA</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <select class='form-control' name='fugaAgua' id='fugaAgua'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" id="obsFugaAgua" name="obsFugaAgua" placeholder="Capacidades / Observaciones"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 ">
                                                        <b>PRESIÓN DE PRUEBA</b>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <select class='form-control' name='presionPrueba' id='presionPrueba'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" id="obsPresionPrueba" name="obsPresionPrueba" placeholder="Capacidades / Observaciones"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                     <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea class="form-control" id="observaGrales" name="observaGrales" placeholder="Observaciones generales"><?php echo $row['observacionesGrales'];?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>CONDICIONES DE SEGURIDAD</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>EXTINTOR</b>
                                                                <select class='form-control' name='extintor' id='extintor'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>SEÑALIZACIÓN</b>
                                                                <select class='form-control' name='senializacion' id='senializacion'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>DET. DE HUMO</b>
                                                                <select class='form-control' name='detectorHumo' id='detectorHumo'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>DIQUE DE CONTENCIÓN</b>
                                                                <select class='form-control' name='diqueContencion' id='diqueContencion'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>TABLEROS IDENTIFICADOS</b>
                                                                <select class='form-control' name='tablerosIdentificados' id='tablerosIdentificados'>
                                                                    <option value="">Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>IDENTIFICACIÓN DEL TANQUE DE DIESEL</b>
                                                                <select class='form-control' name='tanqueDiselIndentificado' id='tanqueDiselIndentificado'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" >
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 1</b>
                                                        <input type="file" class="file" id="fotoCuartoBombas1" name="fotoCuartoBombas1[]" data-min-file-count="1"  />
                                                    </div>
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 2</b>
                                                        <input type="file" class="file" id="fotoCuartoBombas2" name="fotoCuartoBombas2[]" data-min-file-count="1"  />
                                                    </div>
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 3</b>
                                                        <input type="file" class="file" id="fotoCuartoBombas3" name="fotoCuartoBombas3[]" data-min-file-count="1"  />
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 offset-md-2">
                                                        <b>Foto 4</b>
                                                        <input type="file" class="file" id="fotoCuartoBombas4" name="fotoCuartoBombas4[]" data-min-file-count="1" />
                                                    </div>
                                                    <div  class="col-md-4 col-sm-12" >
                                                        <b>Foto 5</b>
                                                        <input type="file" class="file" id="fotoCuartoBombas5" name="fotoCuartoBombas5[]" data-min-file-count="1"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-4 col-md-offset-5">
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

<script type="text/javascript">



    $('.sumaBoquillas').keyup(function() {
        var totalBoquillas = 0
        $(".sumaBoquillas").each(
            function(index, value) {
                if ( $.isNumeric( $(this).val() ) ){
                    totalBoquillas += eval($(this).val());
                }
            }
        );
        $("#totalBoquillas").val(totalBoquillas);
    });


    $('.sumaLlaves').keyup(function() {
        var totalLlaves = 0;
        $(".sumaLlaves").each(
            function(index, value) {
                if ( $.isNumeric( $(this).val() ) ){
                    totalLlaves += eval($(this).val());
                }
            }
        );
        $("#totalLlaves").val(totalLlaves);
    });



    $( document ).ready(function() {

        data = <?php print json_encode($cuartoBombas); ?>;

        //console.log(data);

        var nombreCampo = data[0];
        for (var key in nombreCampo) {
            //console.log(key, data[0][key]);
            if(!key.includes("foto")){
                $("#"+key).val(data[0][key]);
            }
        }

    });


    $(function(){
        $("#form").on("submit", function(e){
            var url;
            var accion=<?php echo $contador;?>;
            accion="actualizarHidrantes/";

            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/';?>"+accion;
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
                            text: "Se han registrado los datos generales",
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


    $(window).on('load', function()
    {

        /*
    * FOTOS CUARTO BOMBAS
    * */

        $("#fotoCuartoBombas1").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirFotoGeneral/fotoCuartoBombas1/cuartoBombas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($cuartoBombas[0]["fotoCuartoBombas1"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoCuartoBombas1/').$cuartoBombas[0]['fotoCuartoBombas1']."\' class='file-preview-image' alt=\'".$cuartoBombas[0]['fotoCuartoBombas1']."\' title=\'".$cuartoBombas[0]['fotoCuartoBombas1']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoCuartoBombas1").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCuartoBombas1';
                $tabla = 'cuartoBombas';
                $carpeta = 'fotoCuartoBombas1';

                echo base_url("index.php/Crudhidrantes/eliminarImagen/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });


        $("#fotoCuartoBombas2").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirFotoGeneral/fotoCuartoBombas2/cuartoBombas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($cuartoBombas[0]["fotoCuartoBombas2"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoCuartoBombas2/').$cuartoBombas[0]['fotoCuartoBombas2']."\' class='file-preview-image' alt=\'".$cuartoBombas[0]['fotoCuartoBombas2']."\' title=\'".$cuartoBombas[0]['fotoCuartoBombas2']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoCuartoBombas2").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCuartoBombas2';
                $tabla = 'cuartoBombas';
                $carpeta = 'fotoCuartoBombas2';

                echo base_url("index.php/Crudhidrantes/eliminarImagen/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });

        $("#fotoCuartoBombas3").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirFotoGeneral/fotoCuartoBombas3/cuartoBombas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($cuartoBombas[0]["fotoCuartoBombas3"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoCuartoBombas3/').$cuartoBombas[0]['fotoCuartoBombas3']."\' class='file-preview-image' alt=\'".$cuartoBombas[0]['fotoCuartoBombas3']."\' title=\'".$cuartoBombas[0]['fotoCuartoBombas3']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoCuartoBombas3").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCuartoBombas3';
                $tabla = 'cuartoBombas';
                $carpeta = 'fotoCuartoBombas3';

                echo base_url("index.php/Crudhidrantes/eliminarImagen/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });

        $("#fotoCuartoBombas4").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirFotoGeneral/fotoCuartoBombas4/cuartoBombas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($cuartoBombas[0]["fotoCuartoBombas4"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoCuartoBombas4/').$cuartoBombas[0]['fotoCuartoBombas4']."\' class='file-preview-image' alt=\'".$cuartoBombas[0]['fotoCuartoBombas4']."\' title=\'".$cuartoBombas[0]['fotoCuartoBombas4']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoCuartoBombas4").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCuartoBombas4';
                $tabla = 'cuartoBombas';
                $carpeta = 'fotoCuartoBombas4';

                echo base_url("index.php/Crudhidrantes/eliminarImagen/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });


        $("#fotoCuartoBombas5").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirFotoGeneral/fotoCuartoBombas5/cuartoBombas/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($cuartoBombas[0]["fotoCuartoBombas5"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoCuartoBombas5/').$cuartoBombas[0]['fotoCuartoBombas5']."\' class='file-preview-image' alt=\'".$cuartoBombas[0]['fotoCuartoBombas5']."\' title=\'".$cuartoBombas[0]['fotoCuartoBombas5']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoCuartoBombas5").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoCuartoBombas5';
                $tabla = 'cuartoBombas';
                $carpeta = 'fotoCuartoBombas5';

                echo base_url("index.php/Crudhidrantes/eliminarImagen/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });


        /*
        * FOTOS CUARTO BOMBAS
        * */


        /*
   * FOTO RED CONTRA INCENDIOS 4
   * */

        $("#fotoRedIncendios4").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirFotoGeneral/fotoRedIncendios4/Hidrantes/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoRedIncendios4"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoRedIncendios4/').$row['fotoRedIncendios4']."\' class='file-preview-image' alt=\'".$row['fotoRedIncendios4']."\' title=\'".$row['fotoRedIncendios4']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoRedIncendios4").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoRedIncendios4';
                $tabla = 'Hidrantes';
                $carpeta = 'fotoRedIncendios4';

                echo base_url("index.php/Crudhidrantes/eliminarImagen/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });

        /*
        * FOTO RED CONTRA INCENDIOS 4
        * */


        /*
        * FOTO RED CONTRA INCENDIOS 5
        * */

        $("#fotoRedIncendios5").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirFotoGeneral/fotoRedIncendios5/Hidrantes/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoRedIncendios5"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoRedIncendios5/').$row['fotoRedIncendios5']."\' class='file-preview-image' alt=\'".$row['fotoRedIncendios5']."\' title=\'".$row['fotoRedIncendios5']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoRedIncendios5").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoRedIncendios5';
                $tabla = 'Hidrantes';
                $carpeta = 'fotoRedIncendios5';

                echo base_url("index.php/Crudhidrantes/eliminarImagen/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });

        /*
        * FOTO RED CONTRA INCENDIOS 5
        * */


        /*
        * FOTO RED CONTRA INCENDIOS 6
        * */

        $("#fotoRedIncendios6").fileinput({'showCaption': false, 'showCancel': false,'showRemove':false,'showUpload':false, 'uploadAsync': false,
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirFotoGeneral/fotoRedIncendios6/Hidrantes/<?php echo $idAsignacion;?>", 'language': 'es', 'maxFileCount': 1, 'allowedFileExtensions' : ['jpg', 'gif', 'png']

            <?php
            if($row["fotoRedIncendios6"]!=NULL)
            {
                echo ",
                initialPreview: [
                \"<img src=\'".base_url('assets/img/fotoAnalisisRiesgo/fotoRedIncendios6/').$row['fotoRedIncendios6']."\' class='file-preview-image' alt=\'".$row['fotoRedIncendios6']."\' title=\'".$row['fotoRedIncendios6']."\'>\"]";
            }

            ?>
        }).on('change', function(event, data, previewId, index)
        {

            $("#fotoRedIncendios6").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoRedIncendios6';
                $tabla = 'Hidrantes';
                $carpeta = 'fotoRedIncendios6';

                echo base_url("index.php/Crudhidrantes/eliminarImagen/$campo/$tabla/$idAsignacion/$carpeta");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});
        });

        /*
        * FOTO RED CONTRA INCENDIOS 6
        * */




        $('#fotoInterior').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirfotoInter/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoInterior"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . base_url('assets/img/fotoAnalisisRiesgo/fotoInterior/') . $row['fotoInterior'] . "\' class='file-preview-image' alt=\'" . $row['fotoInterior'] . "\' title=\'" . $row['fotoInterior'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoInterior").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoInterior';
                $tabla = 'Hidrantes';

                echo base_url("index.php/Crudhidrantes/eliminarImagenes/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        //
        $('#fototExterior').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirfotoExte/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fototExterior"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . base_url('assets/img/fotoAnalisisRiesgo/fototExterior/') . $row['fototExterior'] . "\' class='file-preview-image' alt=\'" . $row['fototExterior'] . "\' title=\'" . $row['fototExterior'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fototExterior").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fototExterior';
                $tabla = 'Hidrantes';

                echo base_url("index.php/Crudhidrantes/eliminarImagenes/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

        ////
        $('#fotoSiamesa').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/subirfotoSiamesa/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoSiamesa"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . base_url('assets/img/fotoAnalisisRiesgo/fotoSiamesa/') . $row['fotoSiamesa'] . "\' class='file-preview-image' alt=\'" . $row['fotoSiamesa'] . "\' title=\'" . $row['fotoSiamesa'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoSiamesa").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoSiamesa';
                $tabla = 'Hidrantes';

                echo base_url("index.php/Crudhidrantes/eliminarImagenes/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) {});


        });

    });



</script>




<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->