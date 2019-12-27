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
                        <h2>Acuse de visita - <?=$nombreCentroTrabajo?></h2>
                    </div>

                    <!--INICIO DEL ACORDEON DE DATOS DEL CENTRO DE TRABAJO-->
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
                                                                        <select class="form-control" id="idFormato" name="idFormato" style="width: 100%; border: none;color:#000;" required disabled>
                                                                            <option value="0" disabled >Seleccione cliente</option>
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
                                                                        <select class="form-control" id="inmueble" name="inmueble" style="width: 100%; border: none;color:#000;" required disabled>
                                                                            <option value="0" disabled>Seleccione inmueble</option>
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
                                                                        <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="email_address">Nombre de centro de trabajo</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="nombreCentro" name="nombreCentro" placeholder="Nombre" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3" style="display: none;">
                                                                <label for="email_address">IdDet</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="idDet" name="idDet" placeholder="IdDet" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row clearfix">

                                                            <div class="col-md-4">
                                                                <label>Estado</label>
                                                                <div class="form-group form-float">
                                                                    <div class="form-line">
                                                                        <select id="estado" name="estado" style="width: 100%; border: none;color:#000;"  onChange="obtenerMunicipios();" required disabled>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Municipio o Delegación</label>
                                                                <div class="form-group form-float">
                                                                    <div class="form-line">
                                                                        <select id="municipio" name="municipio" style="width: 100%; border: none;color:#000;"  onChange="obtenerColonias();" required disabled>
                                                                            <option value="" disabled >Seleccione el municipio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Colonia</label>
                                                                <div class="form-group form-float">
                                                                    <div class="form-line">
                                                                        <select id="colonia" name="colonia" style="width: 100%; border: none;color:#000;" onChange="obtenerCodigoPostal();" required disabled>
                                                                            <option value="" disabled>Seleccione la colonia</option>
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
                                                                        <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="numExterior">Número Exterior</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="number" class="form-control" id="numExterior" name="numExterior" placeholder="Número Exterior" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="numInterior">Número Interior</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="numInterior" name="numInterior" placeholder="Número Interior" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <label for="codigoPostal">Código Postal</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="codigoPostal" name="codigoPostal" placeholder="Código Postal" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-sm-3">
                                                                <label for="email_address">Nombre de contacto</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="nomContacto" name="nomContacto" placeholder="Nombre de contacto" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="email_address">Puesto de contacto</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="puestoContacto" name="puestoContacto" placeholder="Puesto de contacto" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="email_address">Teléfono de contacto</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="telContacto" name="telContacto" placeholder="Teléfono de contacto" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <label for="email_address">Correo de contacto</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="correoContacto" name="correoContacto" placeholder="Correo de contacto" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="email_address">Teléfono del inmueble</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="tel" class="form-control" id="telefonoInmueble" name="telefonoInmueble" placeholder="Teléfono del inmueble" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="email_address">Correo del inmueble</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="email" class="form-control" id="correoInmueble" name="correoInmueble" placeholder="Correo del inmueble" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="giroInmueble">Giro completo</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" id="giroInmueble" name="giroInmueble" placeholder="Giro del inmueble" readonly />
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
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                          <form id="form">
                          <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">                      

                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_instalacionesElectricas" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_instalacionesElectricas">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_instalacionesElectricas" aria-expanded="true" aria-controls="collapseOne_instalacionesElectricas">
                                                        <i class="material-icons">assignment</i> Instalaciones electricas
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_instalacionesElectricas" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_instalacionesElectricas">
                                                <div class="panel-body">
                                                    <div class="col-sm-12">
                                                        <h5>NOTA: Colocar si en caso de ser deficiente. Colocar no en caso de cumplimiento.</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Ponderador</b>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $contadorTotal=0;
                                                    $contador1=0;
                                                    foreach($instalacion1 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorInstalacionesElectricas$contador1'  value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorInstalacionesElectricas$contador1' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador1++;
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_riesgosEstructurales" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_riesgosEstructurales">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_riesgosEstructurales" aria-expanded="true" aria-controls="collapseOne_riesgosEstructurales">
                                                        <i class="material-icons">assignment</i> Riesgos estructurales
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_riesgosEstructurales" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_riesgosEstructurales">
                                                <div class="panel-body">
                                                    <div class="col-sm-12">
                                                        <h5>NOTA: Colocar si en caso de ser deficiente. Colocar no en caso de cumplimiento.</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Ponderador</b>
                                                        </div>

                                                    </div>

                                                    <?php
                                                    $contador2=0;
                                                    foreach($instalacion2 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorRiesgosEstructurales$contador2' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorRiesgosEstructurales$contador2' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador2++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_instalacionesGas" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_instalacionesGas">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_instalacionesGas" aria-expanded="true" aria-controls="collapseOne_instalacionesGas">
                                                        <i class="material-icons">assignment</i> Instalaciones de gas
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_instalacionesGas" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_instalacionesGas">
                                                <div class="panel-body">
                                                    <div class="col-sm-12">
                                                        <h5>NOTA: Colocar si en caso de ser deficiente. Colocar no en caso de cumplimiento.</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Ponderador</b>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $contador3=0;
                                                    foreach($instalacion3 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorInstalacionesGas$contador3' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorInstalacionesGas$contador3' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador3++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_instalacionesHidroSanitarias" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_instalacionesHidroSanitarias">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_instalacionesHidroSanitarias" aria-expanded="true" aria-controls="collapseOne_instalacionesHidroSanitarias">
                                                        <i class="material-icons">assignment</i> Instalaciones Hidrosanitarias
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_instalacionesHidroSanitarias" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_instalacionesHidroSanitarias">
                                                <div class="panel-body">
                                                    <div class="col-sm-12">
                                                        <h5>NOTA: Colocar si en caso de ser deficiente. Colocar no en caso de cumplimiento.</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Ponderador</b>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $contador4=0;
                                                    foreach($instalacion4 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorInstalacionesHidrosanitarias$contador4' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorInstalacionesHidrosanitarias$contador4' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador4++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_contenidoBotiquin" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_contenidoBotiquin">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_contenidoBotiquin" aria-expanded="true" aria-controls="collapseOne_contenidoBotiquin">
                                                        <i class="material-icons">assignment</i> Contenido del botiquín
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_contenidoBotiquin" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_contenidoBotiquin">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                                            <b>Ponderador</b>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                                            <b>Cantidad</b>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $contador6=0;
                                                    foreach($conteBotequin as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];
                                                        echo "
                                                        <div class='row'>
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorMaterialSeco$contador6' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorMaterialSeco$contador6' id='selectBotiquin$llavePrimaria' disabled>
                                                                   <option value='2'>No</option>
                                                                   <option value='1'>Si</option>
                                                                   
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class='col-md-4 col-sm-4 col-xs-4'>
                                                                <div class='form-group'>
                                                                    <div class='form-line'>
                                                                        <input class='form-control' type='text' name='cantidadMaterialSeco$contador6' id='cantidadBotiquin$llavePrimaria' readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador6++;
                                                    }
                                                    ?>
                                                    
                                                    <?php
                                                    $contador5=0;
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_elementosNoEstructurales" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_elementosNoEstructurales">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_elementosNoEstructurales" aria-expanded="true" aria-controls="collapseOne_elementosNoEstructurales">
                                                        <i class="material-icons">assignment</i> Revisión por elementos no estructurales
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_elementosNoEstructurales" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_elementosNoEstructurales">
                                                <div class="panel-body">
                                                    <div class="col-sm-12">
                                                        <h5>NOTA: Colocar si en caso de ser deficiente. Colocar no en caso de cumplimiento.</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Ponderador</b>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $contador7=0;
                                                    foreach($instalacion7 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorInstalacionesNoEstructurales$contador7' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorInstalacionesNoEstructurales$contador7' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador7++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_elementosNoEstructurales2" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_elementosNoEstructurales2">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_elementosNoEstructurales2" aria-expanded="true" aria-controls="collapseOne_elementosNoEstructurales2">
                                                        <i class="material-icons">assignment</i> Revisión por elementos no estructurales 2
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_elementosNoEstructurales2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_elementosNoEstructurales2">
                                                <div class="panel-body">
                                                    <div class="col-sm-12">
                                                        <h5>NOTA: Colocar si en caso de ser deficiente. Colocar no en caso de cumplimiento.</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Ponderador</b>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $contador11=0;
                                                    foreach($instalacion11 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorInstalacionesNoEstructurales2$contador11' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorInstalacionesNoEstructurales2$contador11' id='select$llavePrimaria'>
                                                                   <option value=''>Seleccione una opción</option>
                                                                   <option value='1'>Si</option>
                                                                   <option value='2'>No</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador11++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_Otros" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_Otros">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_Otros" aria-expanded="true" aria-controls="collapseOne_Otros">
                                                        <i class="material-icons">assignment</i> Datos adicionales
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_Otros" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_Otros">
                                                <div class="panel-body">
                                                    <div class="col-sm-12">
                                                        <h5>NOTA: Colocar si en caso de ser deficiente. Colocar no en caso de cumplimiento.</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Ponderador</b>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $contador10=0;
                                                    foreach($instalacion10 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorDatos$contador10' value='".$row['idIndicador']."'>
                                                                   <select class='form-control' name='ponderadorDatos$contador10' id='select$llavePrimaria'>
                                                                    <option value=''>Seleccione una opción</option>
                                                                    <option value='1'>Si</option>
                                                                    <option value='2'>No</option>
                                                                    <option value='3'>N/A</option>
                                                                   </select>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador10++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_equiposEmergencia" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_equiposEmergencia">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_equiposEmergencia" aria-expanded="true" aria-controls="collapseOne_equiposEmergencia">
                                                        <i class="material-icons">assignment</i> Riesgo por deficiencia en los equipos de emergencia y las condiciones de seguridad...
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_equiposEmergencia" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_equiposEmergencia">
                                                <div class="panel-body">
                                                    <div class="col-sm-12">
                                                        <h5>NOTA: Colocar si en caso de ser deficiente. Colocar no en caso de cumplimiento.</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Ponderador</b>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $contador8=0;
                                                    foreach($instalacion8 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                    <div class='form-line'>
                                                                        <input type='hidden' name='indicadorEquiposEmergencia$contador8' value='".$row['idIndicador']."'>
                                                                       <select class='form-control' name='ponderadorEquiposEmergencia$contador8' id='select$llavePrimaria'>
                                                                           <option value=''>Seleccione una opción</option>
                                                                           <option value='1'>Si</option>
                                                                           <option value='2'>No</option>
                                                                       </select>
                                                                    </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador8++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_riesgosExternos" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_riesgosExternos">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_riesgosExternos" aria-expanded="true" aria-controls="collapseOne_riesgosExternos">
                                                        <i class="material-icons">assignment</i> Identificación de riesgos externos
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_riesgosExternos" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_riesgosExternos">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Descripción</b>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 ">
                                                            <b>Dist.</b>
                                                        </div>

                                                    </div>
                                                    <?php
                                                    $contador9=0;
                                                    foreach($instalacion9 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorRiesgosExternos$contador9' value='".$row['idIndicador']."'>
                                                                   <input type='number' class='form-control' name='distRiesgosExternos$contador9' id='dist$llavePrimaria'>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador9++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_Otros2" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_Otros2">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_Otros2" aria-expanded="true" aria-controls="collapseOne_Otros2">
                                                        <i class="material-icons">assignment</i> Otros
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_Otros2" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_Otros2">
                                                <div class="panel-body">
                                                    <div class="row">

                                                    </div>
                                                    <?php
                                                    $contador13=0;
                                                    foreach($instalacion13 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-md-6 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorOtros2$contador13' value='".$row['idIndicador']."'>
                                                                   <input class='form-control' name='ponderadorOtros2$contador13' id='texto$llavePrimaria'>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador13++;
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel-group full-body" id="accordion_satisfaccion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-col-lightgray">
                                            <div class="panel-heading" role="tab" id="headingOne_satisfaccion">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_satisfaccion" aria-expanded="true" aria-controls="collapseOne_satisfaccion">
                                                        <i class="material-icons">assignment</i> Encuesta de satisfacción
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_satisfaccion" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_satisfaccion">
                                                <div class="panel-body">
                                                    <div class="row">

                                                    </div>
                                                    <?php
                                                    $contador12=0;
                                                    foreach($instalacion12 as $row)
                                                    {
                                                        $llavePrimaria=$row['idIndicador'];

                                                        echo "
                                                            <div class='col-lg-3 col-md-3 col-sm-6 '>
                                                            
                                                                ".$row["nombreIndicador"]."
                                                            </div>";
                                                        echo "
                                                            <div class='col-lg-3 col-md-3 col-sm-6 '>
                                                                <div class='form-group'>
                                                                <div class='form-line'>
                                                                    <input type='hidden' name='indicadorSatisfaccion$contador12' value='".$row['idIndicador']."'>
                                                                   <input class='form-control' name='ponderadorSatisfaccion$contador12' id='texto$llavePrimaria'>
                                                                </div>
                                                                </div>
                                                            </div>";
                                                        $contadorTotal++;
                                                        $contador12++;
                                                    }
                                                    ?>
                                                    <div class='col-lg-6 col-md-6 col-sm-6 '>
                                                        <div class='form-group'style="text-align: center;">
                                                            <div class='form-line'>
                                                                <input type="text" style="text-align: center;" name=""  class='form-control' value="<?php echo $nombreUsuarioVisita?> "   readonly>
                                                            </div>
                                                                Nombre y firma de quien realizó la visita
                                                        </div>
                                                    </div>
                                                    <div class='col-lg-6 col-md-6 col-sm-6 '>
                                                        <div class='form-group'style="text-align: center;">
                                                            <div class='form-line' >
                                                                <input type="text" style="text-align: center;" name="firmaAtendioVisita" id="firmaAtendioVisita" class='form-control' value="<?php echo $datosCentroTrabajo['nombreAtendioVisita'];?>" readonly>
                                                            </div>
                                                                Nombre y firma de quien atendió la visita 
                                                        </div>
                                                    </div>
                                                    <div class='col-lg-6 col-lg-offset-3'>
                                                        <div class='form-group'style="text-align: center;">
                                                            <div class='form-line' >
                                                                <label for="evidenciaFotografica">Evidencia fotográfica</label>
                                                                <input type="file" data-min-file-count='1' name="evidenciaFotografica" id="evidenciaFotografica">
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
                                    <div class="col-md-1 col-md-offset-5">
                                        <div class="form-line">
                                            <input type="submit"  class="btn bg-red waves-effect waves-light"  value="Guardar">

                                        </div>
                                    </div>
                                        
                                    <div id="areaBotones" style="display: none">
                                        <div class="col-md-1 ">
                                            <div class="form-line">
                                                <input onclick="popUpImprimir(<?=$idAsignacion?>);" type="button" class="btn bg-red waves-effect waves-light" value="Imprimir" id="btn-imprimir" hidden>
                                            </div>
                                        </div> 
                                        <div class="col-md-1 ">
                                            <div class="form-line">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#correoModal" id="btn-enviar" hidden>
                                                    Enviar correo
                                                </button>  
                                            </div>
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

<!-- Modal -->
<div class="modal fade" id="correoModal" tabindex="-1" role="dialog" aria-labelledby="correoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="correoModalLabel">Enviar correo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="correo-acuse">Correo electrónico</label>
                                <input type="email" class="form-control" id="correo-acuse" name="correo-acuse" value="<?=$datosCentroTrabajo['correoInmueble']?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="enviarCorreoPDF(<?=$idAsignacion?>,<?=$datosCentroTrabajo['idCentroTrabajo']?>)">Enviar</button>
            </div>
        </div>
    </div>
</div>

<script>

    function  popUpImprimir(id)
    {
        window.open("https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/acuse/"+id,"neo","width=900,height=600,menubar=si");
    }

    function enviarCorreoPDF(idAsignacion, idCentroTrabajo)
    {
        var correoAcuse = document.getElementById("correo-acuse").value;
        swal({
                title: "Aviso",
                text: "¿Desea enviar el correo electrónico?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function(){
                $.ajax({
                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudPDF/enviarPDFAcuse/"+idAsignacion+"/"+idCentroTrabajo,
                    type: "POST",
                    data: {correoAcuse: correoAcuse},
                    dataType: "HTML",
                    success: function(data)
                    {
                        swal("Hecho", "Correo enviado con éxito", "success");
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal("Error", "Ocurio un error inesperado", "warning");
                    }
                });
            });
    }

    $(document).ready(function ()
    {
        $("#evidenciaFotografica").fileinput(
            {
                'showUploadedThumbs': false,
                'showCaption': false,
                'showCancel': false,
                'showRemove':false,
                'showUpload':false,
                'uploadAsync': false,
                'uploadUrl': '<?=site_url("/CrudVisitaAcuse/subirFotoAcuseVisita/".$idAsignacion)?>',
                'language': 'es',
                'maxFileCount': 1,
                'allowedFileExtensions' : ['jpg','jpeg', 'gif', 'png'],
                'initialPreview' : ["<?php if(!empty($fotoEvidenciaFotografica['nombreFoto'])) echo "<img class='file-preview-image' src='".base_url('assets/img/fotoAnalisisRiesgo/fotosAcuseVisita/'.$fotoEvidenciaFotografica['nombreFoto'])."' />"; else echo "";?>"]
            }).on('change', function (event, data, previewId, index) {
                $("#evidenciaFotografica").fileinput("upload");
            }).on('fileclear', function (event)
            {
                $.ajax(
                    {
                        url: '<?=site_url("CrudVisitaAcuse/borrarfotoAcuseVisita/".$idAsignacion)?>',
                        contentType: false,
                        processData: false
                    }
                );
            });
        <?php
        foreach ($acuses as $row)
        {
            if(!empty($row['idPonderador']))
            {

                echo "$('#select".$row['idIndicador']."').val(".$row['idPonderador'].");\n";
                if(!empty($row['cantidad']))
                {
                    echo "$('#cantidad".$row['idIndicador']."').val(".$row['cantidad'].");\n";
                }
            }
            else if(!empty($row['distancia']))
            {
                echo "$('#dist".$row['idIndicador']."').val(".$row['distancia'].");\n";
            }
            else if(!empty($row['texto']))
            {
                echo "var texto='".rawurlencode($row['texto'])."';";
                echo "$('#texto".$row['idIndicador']."').val(decodeURIComponent(texto));\n";
            }

        }
        ?>
    });

    window.onload=cargarvaloresbotiquin;
    function cargarvaloresbotiquin()
    {

        $.ajax(
                            {
                                url: '<?=site_url('CrudVisitaAcuse/obtenerDatosGuardados/').$idReporteAsignacion[0]['idFormularioAsignacion']?>',
                                contentType: false,
                                processData: false,
                                dataType: 'JSON',
                                success: function (data)
                                {
                                    console.table(data);
                                    for(i=0; i<data.length; i++)
                                    {
                                        if(data[i].valor)
                                        {
                                           
                                             $("#cantidadBotiquin"+data[i].idIndicador).val(data[i].valor);
                                             $("#selectBotiquin"+data[i].idIndicador).val(1);
                                            // $("."+data[i].idIndicador+"-"+data[i].idAcordeon).prop("checked", true);
                                        }else{

                                        }

                                    }
                                }
                            })
    }


    function cambiarNombre()
    {
        $("#firmaAtendioVisita").val($("#atendioVisita").val());
        $.ajax({
            url: '<?php echo site_url("CrudCentrosTrabajo/cambiarNombreAtendioVisita/$idAsignacion") ?>',
            type: "POST",
            data: {
                nombre: $("#firmaAtendioVisita").val()
            }
        })
       
    }
</script>

<script>
    $("#form").submit(function (e)
    {
        e.preventDefault();

        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudVisitaAcuse/guardarAcuse/<?php echo $idAsignacion."/".$contador1."/".$contador2."/".$contador3."/".$contador4."/".$contador5."/".$contador6."/".$contador7."/".$contador8."/".$contador9."/".$contador10."/".$contador11."/".$contador12."/".$contador13?>",
                data: $("#form").serialize(),
                type: 'post',
                success: function (data)
                {
                    //swal("Bien hecho", "Acuse de visita guardado", "success");
                    swal({
                      title: "Datos guardados",
                      //text: "Your will not be able to recover this imaginary file!",
                      type: "success",
                      
                      confirmButtonClass: "btn-danger",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false
                    },
                    function(){
                      $("#areaBotones").show();
                       swal.close()
                    });
                }
            }
        );
    });    
</script>

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
                    $("#firmaAtendioVisita").val(data.nombreAtendioVisita);
                }
            })


        }
        $(document).ready(function ()
        {
            if($("#idCentroTrabajo").val())
                cargarDatosCentroTrabajo();
            $.ajax(
                {
                    url: '<?=site_url('CrudVisitaAnalisis/getPonderadores/')?>'+$("#idFormulario").val(),
                    contentType: false,
                    processData: false,
                    dataType: 'JSON',
                    success: function (data)
                    {
                        console.table(data);
                        for(i=0; i<data.length; i++)
                        {
                            $("."+data[i].idIndicador+"-"+data[i].idAcordeon).append("<option value='"+data[i].nombrePonderador+"'>"+data[i].nombrePonderador+"</option>");
                        }
                    },
                    complete: function ()
                    {
                        $.ajax(
                            {
                                url: '<?=site_url('CrudVisitaAnalisis/obtenerDatosGuardados/').$idReporteAsignacion[0]['idFormularioAsignacion']?>',
                                contentType: false,
                                processData: false,
                                dataType: 'JSON',
                                success: function (data)
                                {
                                    console.table(data);
                                    for(i=0; i<data.length; i++)
                                    {
                                        if(data[i].valor)
                                        {
                                            $("."+data[i].idIndicador+"-"+data[i].idAcordeon).val(data[i].valor);
                                            $("."+data[i].idIndicador+"-"+data[i].idAcordeon).prop("checked", true);
                                        }

                                    }
                                }
                            }
                        );
                    }
                }
            );
            for(i=0; i<arregloFileInput.length;i++)
            {

                crearFileInput(arregloFileInput[i][0],arregloFileInput[i][1]);
            }

        });

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
