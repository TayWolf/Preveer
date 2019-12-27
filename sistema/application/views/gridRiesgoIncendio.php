<style>
    .vcenter {
        display: inline-block;
        vertical-align: middle;
        float: none;
    }

</style>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">

        </div>

        <div class="block-header">
            <a href='javascript:history.go(-1);'>
                <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                    <i class='material-icons'>arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header">
                                <h2>
                                    Grado de riesgo de incendio - <?=$nombreCentroTrabajo?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="body ">
                        <div class="row">
                            <!--Inicio de datos de centro de trabajo-->
                            <form id="formDatosCentro">
                                <input type="hidden" name="idCentroTrabajo" id="idCentroTrabajo" value="<?php echo $idCentroTrabajo;?>">
                                <div class="panel-group full-body" id="accordion_DatosCentro" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_DatosCentro">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_DatosCentro" aria-expanded="true" aria-controls="collapseOne_DatosCentro">
                                                    <i class="material-icons">assignment</i> Datos del centro de trabajo
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_DatosCentro" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_DatosCentro">
                                            <div class="panel-body">
                                                <div class="row body">
                                                    <div class="col-sm-12">
                                                        <div class="row clearfix">

                                                            <div class="col-sm-4">
                                                                <label for="Formato">Cliente</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <select class="form-control" id="idFormato" name="idFormato" style="width: 100%; border: none;color:#000;" required >
                                                                            <option value="0"  >Seleccione cliente</option>
                                                                            <?php
                                                                            foreach ($formato as $row) {
                                                                                $idFormat=$row["idFormato"];
                                                                                $nombreFormat=$row["nombre"];

                                                                                echo "<option value='$idFormat'>$nombreFormat</option>";
                                                                            }
                                                                            ?>

                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3" style="display: none;">
                                                                <label for="Tipo de inmueble">Tipo de inmueble</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <select class="form-control" id="inmueble" name="inmueble" style="width: 100%; border: none;color:#000;" required >
                                                                            <option value="0" >Seleccione inmueble</option>
                                                                            <?php
                                                                            foreach ($inmueble as $row) {
                                                                                $idIn=$row["idInmueble"];
                                                                                $nombreIn=$row["nombreInmueble"];

                                                                                echo "<option value='$idIn'>$nombreIn</option>";
                                                                            }
                                                                            ?>

                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="razonSocial">Razón social</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="email_address">Nombre de centro de trabajo</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="nombreCentro" name="nombreCentro" placeholder="Nombre" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3" style="display: none;">
                                                                <label for="email_address">IdDet</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="idDet" name="idDet" placeholder="IdDet" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row clearfix">

                                                            <div class="col-md-4">
                                                                <label>Estado</label>
                                                                <div class="form-group form-float">
                                                                    <div class="form-line">
                                                                        <select id="estado" name="estado" style="width: 100%; border: none;color:#000;"  onChange="obtenerMunicipios();" required >
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Municipio o Delegación</label>
                                                                <div class="form-group form-float">
                                                                    <div class="form-line">
                                                                        <select id="municipio" name="municipio" style="width: 100%; border: none;color:#000;"  onChange="obtenerColonias();" required >
                                                                            <option value=""  >Seleccione el municipio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Colonia</label>
                                                                <div class="form-group form-float">
                                                                    <div class="form-line">
                                                                        <select id="colonia" name="colonia" style="width: 100%; border: none;color:#000;" onChange="obtenerCodigoPostal();" required >
                                                                            <option value="" >Seleccione la colonia</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-sm-3">
                                                                <label for="calle">Calle</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="numExterior">Número Exterior</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="number" class="form-control" id="numExterior" name="numExterior" placeholder="Número Exterior" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="numInterior">Número Interior</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="numInterior" name="numInterior" placeholder="Número Interior"  />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="codigoPostal">Código Postal</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Código Postal"  />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-sm-3">
                                                                <label for="email_address">Nombre de contacto</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="nomContacto" name="nomContacto" placeholder="Nombre de contacto" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="email_address">Puesto de contacto</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="puestoContacto" name="puestoContacto" placeholder="Puesto de contacto" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="email_address">Teléfono de contacto</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="telContacto" name="telContacto" placeholder="Teléfono de contacto"  />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="email_address">Correo de contacto</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="correoContacto" name="correoContacto" placeholder="Correo de contacto"  />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="email_address">Teléfono del inmueble</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="tel" class="form-control" id="telefonoInmueble" name="telefonoInmueble" placeholder="Teléfono del inmueble"  />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="email_address">Correo del inmueble</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="email" class="form-control" id="correoInmueble" name="correoInmueble" placeholder="Correo del inmueble"  />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="giroInmueble">Giro completo</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="giroInmueble" name="giroInmueble" placeholder="Giro del inmueble"  />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-sm-4 col-sm-offset-4 " align="center">
                                                                <label for="atendioVisita">Nombre de quien atendió la visita</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="atendioVisita" name="atendioVisita" onchange="cambiarNombre()" placeholder="Nombre de la persona quien atendió la visita"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4 col-sm-offset-4" align="center">
                                                                <input type="submit" class="btn bg-red" value="Guardar">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!--fin de datos de centro de trabajo-->

                            <!--Inicio del grado de riesgo de incendio-->
                            <div class="panel-group full-body" >
                                <div class="panel panel-col-lightgray">
                                    <div class="panel-heading" role="tab" id="headingOne_Formula">
                                        <h4 class="panel-title">
                                            <a >
                                                <i class="material-icons">assignment</i> Cálculo de riesgo de incendio por inventario
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne_Formula" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_Formula">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2 col-xs-12 align-center" style="background-color: #e8e8e8">

                                                    <div class="col-sm-3 col-xs-6 padding-0 margin-0" style="margin-bottom: 0 !important; display:flex;justify-content:center;align-items:center;"  >
                                                        <div class="col-sm-10 align-center m-l-0 m-r-0 m-b-0 padding-0 m-t-20 tooltipFormula" title="Gases inflamables">
                                                            <b><label id="GAS_INF">[GAS_INF]</label> lts</b><br>
                                                            <span style="line-height: 1px !important;">______________</span><br>
                                                            <b>3,000 lts</b>
                                                        </div>
                                                        <div class="col-sm-2 align-center  padding-0 " style="margin: 0 !important;">
                                                            <i class="fa fa-plus" aria-hidden="true" style="color: #990000"></i>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-3 col-xs-6 padding-0 margin-0 " style="margin-bottom: 0 !important; display:flex;justify-content:center;align-items:center;">
                                                        <div class="col-sm-10 align-center m-l-0 m-r-0 m-b-0 padding-0 m-t-20 tooltipFormula" title="Líquidos inflamables">
                                                            <b><label id="LIQ_INF">[LIQ_INF]</label> lts</b><br>
                                                            <span style="line-height: 1px !important;">______________</span><br>
                                                            <b>1,400 lts</b>
                                                        </div>
                                                        <div class="col-sm-2  align-center  padding-0 " style="margin: 0 !important;">
                                                            <i class="fa fa-plus" aria-hidden="true" style="color: #990000"></i>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-xs-6 padding-0 margin-0 " style="margin-bottom: 0 !important; display:flex;justify-content:center;align-items:center;">
                                                        <div class="col-sm-10 align-center m-l-0 m-r-0 m-b-0 padding-0 m-t-20 tooltipFormula" title="Líquidos combustibles">
                                                            <b><label id="LIQ_COMB">[LIQ_COMB]</label> lts</b><br>
                                                            <span style="line-height: 1px !important;">______________</span><br>
                                                            <b>2,000 lts</b>
                                                        </div>
                                                        <div class="col-sm-2 align-center  padding-0 " style="margin: 0 !important;">
                                                            <i class="fa fa-plus" aria-hidden="true" style="color: #990000"></i>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-xs-6 padding-0 margin-0 " style="margin-bottom: 0 !important; display:flex;justify-content:center;align-items:center;">
                                                        <div class="col-sm-10 align-center m-l-0 m-r-0 m-b-0 padding-0 m-t-20 tooltipFormula" title="Sólidos combustibles">
                                                            <b><label id="SOL_COMB">[SOL_COMB]</label> kg</b><br>
                                                            <span style="line-height: 1px !important;">______________</span><br>
                                                            <b>15,000 kg</b>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xs-4 col-xs-offset-4 " >
                                                        <div class="col-xs-8 col-xs-offset-2" style="background-color: #afafaf; display:flex; justify-content:center; align-items:center; margin-bottom: 0 !important; padding: 0 !important;">
                                                            <div class="col-sm-12 padding-0 margin-0 align-center" style="justify-content:center; align-items:center; margin-bottom: 0 !important;">
                                                                <b class="col-sm-6 " style="color: #000000; padding: 0 !important; margin-bottom: 0 !important;">GRADO = <label id="gradoRiesgoIncendio">1</label></b><b class="col-sm-6" style="color: #b71e24; padding: 0 !important; margin-bottom: 0 !important;" id="tipoRiesgoInc">RIESGO</b>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-12">

                                                            <div class="col-sm-12 " style="margin-bottom: 0 !important;">
                                                                <h4 style="text-transform: uppercase">Clasificación según área de construcción</h4>
                                                            </div>


                                                            <div class="col-sm-6">

                                                                <div class="col-sm-12" style="background-color: #e8e8e8">
                                                                    <p>Área construida menor a 3,000 m<sup>2</sup> = Riesgo ordinario</p>
                                                                    <p>Área construida igual o mayor a 3,000 m<sup>2</sup> = Riesgo alto</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="col-sm-12" style="background-color: #e8e8e8">
                                                                    <p>Área construida <label id="areaConstruida">[EXT_CONST]</label>m<sup>2</sup></p>
                                                                    <p>Nivel de riesgo: <b style="color: #b71e24" id="nivelRiesgo">[RIESGO_CONS]</b></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!--INICIO DE LOS ACORDEONES INTERNOS-->
                                                    <div class="col-sm-6">
                                                        <div class="panel-group full-body" id="accordion_Detalle" role="tablist" aria-multiselectable="true">
                                                            <div class="panel panel-col-lightgray">
                                                                <div class="panel-heading" role="tab" id="headingOne_Detalle">
                                                                    <h4 class="panel-title">
                                                                        <a role="button" data-toggle="collapse" href="#collapseOne_Detalle" aria-expanded="true" aria-controls="collapseOne_Detalle">
                                                                            <i class="material-icons">assignment</i> Detalles
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseOne_Detalle" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_Detalle">
                                                                    <div class="panel-body">
                                                                        <div class="row body">
                                                                            <!--Inicio de los detalles-->
                                                                            <?php
                                                                            foreach ($indicadores as $indicadorIncendio)
                                                                            {

                                                                                $indicadorIncendio['abreviatura']=str_replace(array("[", "]"), "", $indicadorIncendio['abreviatura']);
                                                                                ?>
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <div class="form-line">
                                                                                            <label for="indicador<?=$indicadorIncendio['idIndicador']?>-<?=$indicadorIncendio['idAcordeon']?>"><a target="_blank" style="cursor: pointer; color: #585858" href="<?= site_url('CrudVisitaAnalisis/verAnalisisRiesgo/'.$idAsignacion.'/'.$indicadorIncendio['idFormulario'])?>"><?=$indicadorIncendio['nombreIndicador']." [".$indicadorIncendio['abreviatura']?>]</a></label>
                                                                                            <input class="form-control input-Detalle <?=$indicadorIncendio['abreviatura']?>" placeholder="<?=$indicadorIncendio['nombreIndicador']?>" id="indicador<?=$indicadorIncendio['idIndicador']?>-<?=$indicadorIncendio['idAcordeon']?>" readonly type="number"/>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <!--fin de los detalles-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--SEPARACION DE ACORDEONES-->
                                                    <div class="col-sm-6">
                                                        <div class="panel-group full-body" id="accordion_Detalle2" role="tablist" aria-multiselectable="true">
                                                            <div class="panel panel-col-lightgray">
                                                                <div class="panel-heading" role="tab" id="headingOne_Detalle2">
                                                                    <h4 class="panel-title">
                                                                        <a role="button" data-toggle="collapse" href="#collapseOne_Detalle2" aria-expanded="true" aria-controls="collapseOne_Detalle2">
                                                                            <i class="material-icons">assignment</i> Tablas
                                                                        </a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseOne_Detalle2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_Detalle2">
                                                                    <div class="panel-body">
                                                                        <div class="row body">
                                                                            <!--Inicio de las tablas-->
                                                                            <?php
                                                                            if(!empty($indicadoresTablas))
                                                                            {
                                                                                $ultimaTabla=0;
                                                                                for($i=0; $i<sizeof($indicadoresTablas); $i++)
                                                                                {
                                                                                    $arregloIndicadoresEncabezado=array();
                                                                                    if($indicadoresTablas[$i]['idAcordeon']!=$ultimaTabla)
                                                                                    {
                                                                                        $ultimaTabla=$indicadoresTablas[$i]['idAcordeon'];
                                                                                        $abreviatura=$indicadoresTablas[$i]['abreviatura'];
                                                                                        $abreviatura=str_replace(array("[", "]"), "", $abreviatura);
                                                                                        $idFormulario=$indicadoresTablas[$i]['idFormulario'];
                                                                                        $htmlTabla="
                                                                                        <div class='row'><h4><a target='_blank' href='". site_url('CrudVisitaAnalisis/verAnalisisRiesgo/'.$idAsignacion.'/'.$idFormulario)."' style='cursor: pointer'>".$indicadoresTablas[$i]['nombreAcordeon']." [$abreviatura]</a></h4>
                                                                                        <table class='table table-responsive'><thead><tr>";
                                                                                        $contadorTh=0;
                                                                                        for($j=$i; ($j<sizeof($indicadoresTablas))&&($ultimaTabla==$indicadoresTablas[$j]['idAcordeon']);$j++)
                                                                                        {
                                                                                            $arregloIndicadoresEncabezado[$contadorTh] = $indicadoresTablas[$j]['idIndicador'];
                                                                                            $htmlTabla.="<th>".$indicadoresTablas[$j]['nombreIndicador']."</th>";

                                                                                            $contadorTh++;
                                                                                        }
                                                                                        $htmlTabla.="<th style='text-align: right'>Total</th></tr></thead><tbody class='tabla$ultimaTabla tabla$abreviatura'>";
                                                                                        print $htmlTabla;
                                                                                        //Imprime el contenido de la tabla
                                                                                        $iteradorTabla=0;
                                                                                        //SI SE NECESITA DOCUMENTACION, VER EL ARCHIVO: gridBitacoraAdministrable
                                                                                        $numeroRegistros=sizeof($tablas);
                                                                                        while($iteradorTabla<sizeof($tablas))
                                                                                        {
                                                                                            if($tablas[$iteradorTabla]['idAcordeon']==$ultimaTabla)
                                                                                            {
                                                                                                $x=$iteradorTabla;
                                                                                                $fila=array();
                                                                                                $ultimoAlmacenamiento=$tablas[$x]['idFormularioTablaAcordeon'];
                                                                                                $j=0;
                                                                                                while($ultimoAlmacenamiento==$tablas[$x]['idFormularioTablaAcordeon'])
                                                                                                {
                                                                                                    $fila[$j++] = $tablas[$x];
                                                                                                    $ultimoAlmacenamiento = $tablas[$x++]['idFormularioTablaAcordeon'];
                                                                                                    if ($x >= $numeroRegistros)
                                                                                                        break;
                                                                                                }

                                                                                                echo "<tr>";

                                                                                                //obtiene la diferencia entre los registros de la tabla y sus encabezados
                                                                                                $diferencia = sizeof($arregloIndicadoresEncabezado) - sizeof($fila);
                                                                                                for ($k = 0; $k < sizeof($fila); $k++)
                                                                                                {
                                                                                                    //por cada uno de los encabezados
                                                                                                    for($l=$k; $l < sizeof($arregloIndicadoresEncabezado); $l++ )
                                                                                                    {
                                                                                                        //si el encabezado coincide con el dato de la fila
                                                                                                        if ($fila[$k]['idIndicador'] == $arregloIndicadoresEncabezado[$l])
                                                                                                        {
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
                                                                                                    while($diferencia>0)
                                                                                                    {
                                                                                                        echo "<td></td>";
                                                                                                        $diferencia--;
                                                                                                    }
                                                                                                    echo "<td style='text-align: right'></td></tr>";
                                                                                                }
                                                                                                $iteradorTabla=$x;
                                                                                            }
                                                                                            else
                                                                                                $iteradorTabla++;
                                                                                        }
                                                                                        //Fin de imprimir datos de tablas

                                                                                        print "</tbody></table></div>";
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <!--Fin de las tablas-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--FIN DE LOS ACORDEONES INTERNOS-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Fin del grado de riesgo de incendio-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function cargarDatosCentroTrabajo(){


        $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerEstados')?>/",
            type: "get",
            dataType: "json",
            success: function(data)
            {
                for(var i=0; i<data.length; i++)
                {
                    $("#estado").append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']))
                }
            },complete:function(){
                var idc = $("#idCentroTrabajo").val();
                $.ajax({
                    url : "<?php echo site_url('CrudCentrosTrabajo/obtenerDatos')?>/" + idc,
                    type: "get",
                    dataType: "JSON",
                    success: function(data)
                    {
                        $("#estado").val(data.id_Estado);
                        var idEstado=data.id_Estado;
                        $.ajax({
                            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerMunicipios')?>/"+idEstado,
                            type: "get",
                            dataType: "json",
                            success: function(municipio)
                            {
                                $("#municipio").empty();
                                for(var i=0; i<municipio.length; i++)
                                {
                                    $("#municipio").append(new Option(municipio[i]['nombreMunicipio'],municipio[i]['idMunicipio']))
                                }
                                $("#municipio").val(data.idMunicipio);
                                $.ajax({
                                    url : "<?php echo site_url('CrudCentrosTrabajo/obtenerColonias')?>/"+data.idMunicipio,
                                    type: "get",
                                    dataType: "json",
                                    success: function(colonias)
                                    {
                                        $("#colonia").empty();
                                        for(var i=0; i<colonias.length; i++)
                                        {
                                            $("#colonia").append(new Option(colonias[i]['nombreRegion'],colonias[i]['idRegiones']))
                                        }
                                        $("#colonia").val(data.idColonia);

                                        obtenerCodigoPostal();
                                    }
                                });

                            }
                        });
                        $("#calle").val(data.calle);
                        $("#numInterior").val(data.numeroInterior);
                        $("#numExterior").val(data.numeroExterior);
                        $("#idFormato").val(data.idFormato);
                        $("#inmueble").val(data.idInmueble);
                        $("#nombreCentro").val(data.nombre);
                        $("#idDet").val(data.idDet);
                        $("#nomContacto").val(data.nomContacto);
                        $("#puestoContacto").val(data.puestoContacto);
                        $("#telContacto").val(data.telContacto);
                        $("#correoContacto").val(data.email);
                        $("#correoInmueble").val(data.correoInmueble);
                        $("#telefonoInmueble").val(data.telefonoInmueble);

                        $("#horarioFuncionamientoInicio").val(data.horarioFuncionamientoInicio);
                        $("#horarioFuncionamientoFin").val(data.horarioFuncionamientoFin);

                        $("#horarioAtencionInicio").val(data.horarioAtencionInicio);
                        $("#horarioAtencionFin").val(data.horarioAtencionFin);
                        $("#giroInmueble").val(data.giroInmueble);

                        $("#latitud").val(data.latitud);
                        $("#longitud").val(data.longitud);
                        $("#Metros").val(data.metros);
                        $("#razonSocial").val(data.razonSocial);



                        if(data.aplicaHorarioAtencion==1)
                        {
                            $("#aplicaHorarioAtencion").prop("checked", true);
                        }
                        var ruta="";

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }
        });
        $.ajax({
            url: '<?=site_url('CrudCentrosTrabajo/getNombreAtendioVisita/'.$idAsignacion)?>',
            dataType: 'JSON',
            success: function(data)
            {
                $("#atendioVisita").val(data.nombreAtendioVisita);
            }
        })
    }
    window.onload=function () {
        $(".tooltipFormula").tooltip();
        cargarDatosCentroTrabajo();
        llenarInputDetalles();
        $("#formDatosCentro").on("submit", function(e){
            var url;
            $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
            url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/modificarDatos/';?>";
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formDatosCentro"));

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
                    swal("HECHO", "Datos modificados.", "success");
                });

            $.ajax({
                url: '<?=site_url('CrudCentrosTrabajo/cambiarNombreAtendioVisita/'.$idAsignacion)?>',
                type: "post",
                data: {nombre: $("#atendioVisita").val()},
            });


        });
    }

    function obtenerMunicipios()
    {
        $("#colonia").empty();
        $("#codigoPostal").val("");
        var idEstado=$("#estado").val();
        $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerMunicipios')?>/"+idEstado,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                $("#municipio").empty();
                for(let i=0; i<data.length; i++)
                {
                    $("#municipio").append(new Option(data[i]['nombreMunicipio'],data[i]['idMunicipio']))
                }
            }
        });

    }
    function obtenerColonias()
    {
        $("#codigoPostal").val("");
        var idMunicipio=$("#municipio").val();
        $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerColonias')?>/"+idMunicipio,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                $("#colonia").empty();
                for(var i=0; i<data.length; i++)
                {
                    $("#colonia").append(new Option(data[i]['nombreRegion'],data[i]['idRegiones']))
                }
            }
        });
    }
    function obtenerCodigoPostal()
    {
        var idColonia=$("#colonia").val();
        $.ajax({
            url : "<?php echo site_url('CrudCentrosTrabajo/obtenerCodigoPostal')?>/"+idColonia,
            type: "get",
            dataType: "json",
            success: function(data)
            {
                $("#codigoPostal").val(data[0]["cp"]);
            }
        });
    }
</script>
<script>
    function llenarInputDetalles()
    {
        $(".input-Detalle").empty();
        $.ajax({
            url: '<?=site_url('CrudRiesgoIncendio/getInformacionDetalle/')?>'+<?=$idAsignacion?>,
            dataType:'JSON',
            success: function (data)
            {
                for(let i=0; i<data.length; i++)
                {
                    $("#indicador"+data[i]['idIndicador']+"-"+data[i]['idAcordeon']).val(data[i]['resultado']);
                }
            },
            complete: function () {

                        let gasInf=sumarAbreviatura("GAS_INF");
                        let liqInf=sumarAbreviatura("LIQ_INF");
                        let liqComb=sumarAbreviatura("LIQ_COMB");
                        let solComb=sumarAbreviatura("SOL_COMB");
                        calcularGradoRiesgoIncendio(gasInf, liqInf, liqComb, solComb);

            }
        });
        $.ajax({
            url: '<?=site_url('CrudRiesgoIncendio/getExtensionConstruccion/').$idAsignacion?>',
            dataType: 'HTML',
            success: function (data)
            {
                $("#areaConstruida").html(data);
                if(parseFloat(data)>=3000)
                {
                    $("#nivelRiesgo").html("Riesgo alto");
                }
                else
                {
                    $("#nivelRiesgo").html("Riesgo ordinario");
                }
            }
        });

    }
    function sumarAbreviatura(abreviatura)
    {
        /*La abreviatura se pasa sin corchetes porque los selectores de jquery no soportan corchetes. Para usar corchetes se deben escapar con \\[ ó \\]*/
        let valor=parseFloat(0);
        $("."+abreviatura+":input").each(function (index)
        {

            if(!isNaN($(this).val())&&$(this).val())
            {
                valor+=parseFloat($(this).val());
            }


        });
        $(".tabla"+abreviatura).each(function (index)
        {
            $.each($(this).children(), function (index, value) {
/*
                if(!isNaN($($(this).children()[2]).html())&&$($(this).children()[2]).html())
                {

                    valor+=parseFloat($($(this).children()[2]).html());
                }
                */
                //Por cada columna, tomar la ultima y las demás multiplicarlas. ME QUEDE AQUÏ
                let total=1;
                $.each($(this).children(), function (index, value) {
                    let val=parseFloat($(this).html());
                    if(!isNaN(val))
                        total*=val;

                });
                $(this).children().last().html(total);
                valor+=total;

            });
        });
        console.log(abreviatura+" = "+valor);

        if(isNaN(valor))
        {
            $("#"+abreviatura).html("0");
            return 0;
        }
        $("#"+abreviatura).html(valor);
        return valor;



    }

    function calcularGradoRiesgoIncendio(gasInf, liqInf, liqComb, solComb)
    {
        /*
        * gasInf: Gases inflamables
        * liqInf: Liquidos inflamables
        * liqComb: Liquidos combustibles
        * solComb: Solidos combustibles
        * */
        gasInf=parseFloat(gasInf);
        liqInf=parseFloat(liqInf);
        liqComb=parseFloat(liqComb);
        solComb=parseFloat(solComb);

        let resultado=(gasInf/3000)+(liqInf/1400)+(liqComb/2000)+(solComb/15000);
        resultado=resultado.toFixed(3);
        $("#gradoRiesgoIncendio").html(resultado);
        if(resultado>=1)
        {
            $("#tipoRiesgoInc").html("RIESGO ALTO");
        }
        else
        {
            $("#tipoRiesgoInc").html("RIESGO ORDINARIO");
        }
    }
</script>