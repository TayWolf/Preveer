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
                        <h2>Lista de datos generales del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <form id="form" enctype="multipart/form-data">
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">
                            <div class="panel-group full-body" id="accordion_18" role="tablist" aria-multiselectable="true">

                                <?php
                                $contador=0;
                                $row=array('idDatosGenerales'=>"", 'fechaVisita'=>"", 'numVisita'=>"", 'licenciaFuncionamiento'=>"", 'fachada'=>"",
                                    'numPersonalInterno'=>"", 'numPersonalExterno'=>"", 'aforo'=>"", 'fechaConstruccion'=>"", 'fechaInicioOperaciones'=>"",
                                    'areasRemodeladas'=>"", 'metrosConstruccion'=>"", 'metrosTerreno'=>"", 'usoDelInmueble'=>"", 'vidrioTemplado'=>"",
                                    'peliculaAntiAsalto'=>"", 'docRespaldo'=>"", 'retardante'=>"", 'alertaSismo'=>"", 'fotoVidrio'=>"", 'fotoPelicula'=>"", 'idAsignacion'=>"", );
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
                                                <input type="hidden" name="idDatosGenerales" value="<?php echo $row['idDatosGenerales'];?>">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de Visita</b>
                                                            <input type="date" class="form-control" id="fechaVisita" name="fechaVisita"  required value="<?php echo $row['fechaVisita']; ?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"  >
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de visita</b>
                                                            <input type="number" class="form-control" id="numVisita" name="numVisita" min="0" value="<?php echo $row['numVisita'];?>" required />
                                                        </div>
                                                    </div>
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
                                                            <b>Número de personal interno</b>
                                                            <input type="number" class="form-control" id="numPersonalInterno" name="numPersonalInterno"   value="<?php echo $row['numPersonalInterno'];?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Número de personal externo</b>
                                                            <input type="number" class="form-control" id="numPersonalExterno" name="numPersonalExterno" min="0" value="<?php echo $row['numPersonalExterno'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Aforo</b>
                                                            <input type="number" class="form-control" id="aforo" name="aforo" min="0" value="<?php echo $row['aforo'];?>" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de construcción</b>
                                                            <input type="date" class="form-control" id="fechaConstruccion" name="fechaConstruccion" value="<?php echo $row['fechaConstruccion'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Fecha de inicio de operaciones</b>
                                                            <input type="date" class="form-control" id="fechaInicioOperaciones" name="fechaInicioOperaciones" value="<?php echo $row['fechaInicioOperaciones'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Metros de construcción</b>
                                                            <input type="number" class="form-control" id="metrosConstruccion" name="metrosConstruccion"   value="<?php echo $row['metrosConstruccion'];?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Metros de terreno</b>
                                                            <input type="number" class="form-control" id="metrosTerreno" name="metrosTerreno" min="0" value="<?php echo $row['metrosTerreno'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Documento de respaldo</b>
                                                            <select type="number" class="form-control" id="docRespaldo" name="docRespaldo" min="0" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['docRespaldo']==2) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['docRespaldo']==3) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Areas remodeladas</b>
                                                            <textarea class="form-control" id="areasRemodeladas" name="areasRemodeladas"><?php echo $row['areasRemodeladas'];?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group ">
                                                        <div class="form-line">
                                                            <b>Uso para el que el inmueble fue creado</b>
                                                            <textarea class="form-control" id="usoDelInmueble" name="usoDelInmueble"><?php echo $row['usoDelInmueble'];?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Vidrio Templado</b>
                                                            <select class="form-control" id="vidrioTemplado" name="vidrioTemplado" >
                                                                <option value="" >Seleccione una opción</option>
                                                                <option value="1" <?php if($row['vidrioTemplado']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['vidrioTemplado']==2) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Pelicula antiasalto</b>
                                                            <select class="form-control" id="peliculaAntiAsalto" name="peliculaAntiAsalto" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['peliculaAntiAsalto']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['peliculaAntiAsalto']==2) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Retardante</b>
                                                            <select class="form-control" id="retardante" name="retardante" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['retardante']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['retardante']==2) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Alerta sísmica</b>
                                                            <select class="form-control" id="alertaSismo" name="alertaSismo" >
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1" <?php if($row['alertaSismo']==1) echo "selected"?>>Si</option>
                                                                <option value="2" <?php if($row['alertaSismo']==2) echo "selected"?>>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6">

                                                    <b>Licencia de funcionamiento</b>

                                                    <input type="file" class="" id="licenciaFuncionamiento" name="licenciaFuncionamiento" />
                                                    <div class="col-md-12">

                                                    </div>
                                                    <?php
                                                    $fotoLicencia=$row['licenciaFuncionamiento'];
                                                    $fotoFachada=$row['fachada'];
                                                    $fotoVidrio=$row['fotoVidrio'];
                                                    $fotoPelicula=$row['fotoPelicula'];

                                                    $imgLice="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/$fotoLicencia'  width='150' height='150'>";
                                                    $imgfacha="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/$fotoFachada'  width='150' height='150'>";
                                                    $imgVidrio="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/$fotoVidrio'  width='150' height='150'>";
                                                    $imgPelicu="<img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoAnalisisRiesgo/$fotoPelicula'  width='150' height='150'>";
                                                    if ($contador!=0)
                                                    {
                                                        if ($fotoLicencia!="")
                                                        {
                                                            echo "$imgLice";
                                                        }

                                                    }
                                                    if ($contador==0)
                                                    {

                                                    }

                                                    ?>

                                                </div>

                                                    <div class="col-sm-6 col-md-6">
                                                        <b>Fachada</b>
                                                        <input type="file" class="" id="fachada" name="fachada" />
                                                        <div class="col-md-12">
                                                            <?php
                                                            if ($contador!=0)
                                                            {
                                                                if ($fotoFachada!=""){
                                                                    echo "$imgfacha";
                                                                }

                                                            }
                                                            if ($contador==0)
                                                            {

                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">


                                                <div class="col-sm-6 col-md-6">

                                                    <b>Foto de vidrio</b>
                                                    <input type="file" class="" id="fotoVidrio" name="fotoVidrio" />
                                                    <div class="col-md-12">
                                                        <?php
                                                        if ($contador!=0)
                                                        {
                                                            if ($fotoVidrio!=""){
                                                                echo "$imgVidrio";
                                                            }

                                                        }
                                                        if ($contador==0)
                                                        {

                                                        }
                                                        ?>
                                                    </div>

                                                </div>

                                                <div class="col-sm-6 col-md-6">

                                                    <b>Foto de pelicula</b>
                                                    <input type="file" class="" id="fotoPelicula" name="fotoPelicula" />
                                                    <div class="col-md-12">
                                                        <?php
                                                        if ($contador!=0)
                                                        {
                                                            if ($fotoPelicula!="")
                                                            {
                                                                echo "$imgPelicu";
                                                            }

                                                        }
                                                        if ($contador==0)
                                                        {

                                                        }
                                                        ?>
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
                                            <input type="submit" class="btn bg-red waves-effect waves-light"  value="Guardar">
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


    $(function(){
        $("#form").on("submit", function(e){
            var url;
            var accion=<?php echo $contador;?>;
            if(accion==0)
                accion="insertarDatosGenerales/";
            else
                accion="actualizarDatosGenerales/";

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
                            text: "Se han registrado los datos generales",
                            type: "success",

                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){

                            location.href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formDatosGenerales/'+$("#idAsignacion").val();
                        });

                });

        });
    });


</script>





<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->