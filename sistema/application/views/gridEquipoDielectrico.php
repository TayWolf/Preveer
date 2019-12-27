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
                        <h2>Lista del equipo dieléctrico y trabajo en alturas del centro de trabajo</h2>
                    </div>
                    <div class="body">
                        <form id="form" enctype="multipart/form-data" >
                            <input type="hidden" name="idAsignacion" id="idAsignacion" value="<?php echo $idAsignacion;?>">

                            <?php
                            $contador=0;
                            $row=array('idEquipo'=>"", 'pertiga'=>"", 'casco'=>"",'googles'=>"",  'guantes'=>"",'guantesCarnazas'=>"", 'calzado'=>"",'tarimas'=>"",  'arnes'=>"",'lineaVida'=>"",'sistemaAnclaje'=>"",'fotoGrales'=>"",'fotoGralesD'=>"",'fotoGralesT'=>"",'fotoGralesC'=>"",'observacionesGrales'=>"",'idAsignacion'=>"");
                            foreach ($existencia as $row2)
                            {
                                $row=$row2;
                                $contador++;
                            }
                            ?>
                            

                             <div class="panel-body">
                                <div class="panel-group full-body" id="accordion_Centro_trabajo" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_Tabla">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_Tabla" aria-expanded="true" aria-controls="collapseOne_Tabla">
                                                    <i class="material-icons">assignment</i> Centro de Trabajo
                                                </a>
                                            </h4>
                                        </div>
                                    <div id="collapseOne_Tabla" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_Tabla">

                            <div class="panel-body">
                                <div class="row ">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="body table-responsive">
                                                <table class="table table-hover" id="tablaListado">
                                                    <thead>
                                                        <tr>
                                                            <th>EQUIPO</th>
                                                            <th>CANTIDAD</th>
                                                            <!-- <th>FOTO</th> -->
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Perdiga</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="text" id="cantPerti" name="cantPerti" class="form-control" placeholder="Cantidad" value="<?php echo $row['pertiga'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>

                                                           <!--  <td><button data-toggle="modal" data-target="#myModalFotografias" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Casco dieléctrico</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="text" id="cantCasco" name="cantCasco" class="form-control" placeholder="Cantidad" value="<?php echo $row['casco'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                           <!--  <td><button data-toggle="modal" data-target="#myModalFotografiasCasco" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Lente/google</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input  type="text" id="cantiLente" name="cantiLente" class="form-control" placeholder="Cantidad" value="<?php echo $row['googles'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasLente" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Guantes dieléctricos</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="text" id="cantGuante" name="cantGuante" class="form-control" placeholder="Cantidad" value="<?php echo $row['guantes'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasGuantes" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Guantes carnaza</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="text" id="cantCarn" name="cantCarn" class="form-control" placeholder="Cantidad" value="<?php echo $row['guantesCarnazas'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                           <!--  <td><button data-toggle="modal" data-target="#myModalFotografiasGuantesC" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Calzado dieléctrico</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="text" id="cantCalza" name="cantCalza" class="form-control" placeholder="Cantidad" value="<?php echo $row['calzado'];?>"/>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasCalzado" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Tarimas dieléctricas</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="text" id="cantTarim" name="cantTarim" class="form-control" placeholder="Cantidad" value="<?php echo $row['tarimas'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasTarimas" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Arnés</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="text" id="cantArn" name="cantArn" class="form-control" placeholder="Cantidad" value="<?php echo $row['arnes'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasArnes" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Línea de vida</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="text" id="cantLine" name="cantLine" class="form-control" placeholder="Cantidad" value="<?php echo $row['lineaVida'];?>" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasLineaVida" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
                                                        <tr>
                                                            <td>Sistema de anclaje</td>
                                                            <td>
                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="form-line">
                                                                        <input type="text" id="cantiSistema" name="cantiSistema" class="form-control" placeholder="Cantidad" value="<?php echo $row['sistemaAnclaje'];?>"/>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <!-- <td><button data-toggle="modal" data-target="#myModalFotografiasAnclajes" type="button" class="btn btn-default"><i class="fa fa-picture-o"></i></button></td> -->
                                                        </tr>
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


                                <div class="panel-group full-body" id="accordion_pertiga" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-col-lightgray">
                                        <div class="panel-heading" role="tab" id="headingOne_pertiga">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" href="#collapseOne_pertiga" aria-expanded="true" aria-controls="collapseOne_pertiga">
                                                    <i class="material-icons">assignment</i> Datos Generales
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne_pertiga" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_pertiga">
                                            <div class="panel-body">
                                                <div >
                                                    <input type="hidden" name="idEquipo" value="<?php echo $row['idEquipo'];?>">
                                                    <div class="col-sm-12">
                                                        <b>Observaciones</b>
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <textarea id="obserbacionesGrales" name="obserbacionesGrales" rows="4" class="form-control no-resize" placeholder="Observaciones Generales..."><?php echo $row['observacionesGrales']; ?> </textarea>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6 ">
                                                            <b>Foto Uno</b>
                                                            <input type="file" id="fotoGrales" name="fotoGrales[]" data-min-file-count="1">
                                                        </div>  
                                                        <div class="col-sm-6 col-md-6 ">
                                                            <b>Foto Dos</b>
                                                            <input type="file" id="fotoGralesD" name="fotoGralesD[]" data-min-file-count="1">
                                                        </div> 
                                                    </div>
                                                    <div class="row"> 
                                                        <div class="col-sm-6 col-md-6 ">
                                                            <b>Foto Tres</b>
                                                            <input type="file" id="fotoGralesT" name="fotoGralesT[]" data-min-file-count="1">
                                                        </div>  
                                                        <div class="col-sm-6 col-md-6 ">
                                                            <b>Foto Cuatro</b>
                                                            <input type="file" id="fotoGralesC" name="fotoGralesC[]" data-min-file-count="1">
                                                        </div>  
                                                    </div>
                                                    <!-- <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <b>Condiciones de la pertiga</b>
                                                                <input type="text" class="form-control" id="condicionesPertiga" name="condicionesPertiga" value="<?php echo $row['condicionesPertiga'];?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4 col-md-offset-4 col-sm-offset-4">
                                                        <b>Foto de la pertiga</b>
                                                        <input type="file" id="fotoPertiga" name="fotoPertiga[]" data-min-file-count="1">
                                                    </div> -->
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

  <!-- <div class="modal fade" id="myModalFotografiasAnclajes" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Foto del Anclaje</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6 col-md-6 ">
                    <b>Foto Uno</b>
                     <input type="file" id="fotoAnclaje" name="fotoAnclaje[]" data-min-file-count="1">
                </div>  
                <div class="col-sm-6 col-md-6 ">
                    <b>Foto Dos</b>
                     <input type="file" id="fotoAnclajeD" name="fotoAnclajeD[]" data-min-file-count="1">
                </div> 
            </div>
            <div class="row"> 
                <div class="col-sm-6 col-md-6 ">
                    <b>Foto Tres</b>
                     <input type="file" id="fotoAnclajeT" name="fotoAnclajeT[]" data-min-file-count="1">
                </div>  
                <div class="col-sm-6 col-md-6 ">
                    <b>Foto Cuatro</b>
                     <input type="file" id="fotoAnclajeC" name="fotoAnclajeC[]" data-min-file-count="1">
                </div>  
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div> -->

<script type="text/javascript">

    

    $(function(){
        $("#form").on("submit", function(e){
            var url;
            var accion=<?php echo $contador;?>;
            accion="actualizarEquipoDielectrico/";
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
                            text: "Se han registrado los equipos dieléctricos",
                            type: "success",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Aceptar",

                        },
                        function(){

                            location.href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formEquipoDielectrico/'+$("#idAsignacion").val();
                        });

                });

        });
    });


</script>


<script type="text/javascript">


    $(window).on('load', function()
    {
       

        /*FOTO PARA GUANTES CARNAZA*/


       
        
        /*FOTO PARA ANCLAJE*/

        //Grales
        $('#fotoGrales').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoGrales/equipoDielectico/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoGrales"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . base_url('assets/img/fotoAnalisisRiesgo/fotoGrales/') . $row['fotoGrales'] . "\' class='file-preview-image' alt=\'" . $row['fotoGrales'] . "\' title=\'" . $row['fotoGrales'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoGrales").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoGrales';
                $tabla = 'equipoDielectico';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //DOS
        $('#fotoGralesD').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoGralesD/equipoDielectico/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoGralesD"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . base_url('assets/img/fotoAnalisisRiesgo/fotoGralesD/') . $row['fotoGralesD'] . "\' class='file-preview-image' alt=\'" . $row['fotoGralesD'] . "\' title=\'" . $row['fotoGralesD'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoGralesD").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoGralesD';
                $tabla = 'equipoDielectico';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //DOS
        //TRES
        $('#fotoGralesT').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoGralesT/equipoDielectico/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoGralesT"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . base_url('assets/img/fotoAnalisisRiesgo/fotoGralesT/') . $row['fotoGralesT'] . "\' class='file-preview-image' alt=\'" . $row['fotoGralesT'] . "\' title=\'" . $row['fotoGralesT'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoGralesT").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoGralesT';
                $tabla = 'equipoDielectico';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //TRES
        //CUATRO
        $('#fotoGralesC').fileinput({
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
            'uploadUrl': "https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/subirFotoGeneral/fotoGralesC/equipoDielectico/<?php echo $idAsignacion;?>",
            'language': 'es',
            'maxFileCount': 1,
            'allowedFileExtensions': ['jpg', 'gif', 'png']

            <?php
            if ($row["fotoGralesC"] != NULL) {
                echo ",
                initialPreview: [
                \"<img src=\'" . base_url('assets/img/fotoAnalisisRiesgo/fotoGralesC/') . $row['fotoGralesC'] . "\' class='file-preview-image' alt=\'" . $row['fotoGralesC'] . "\' title=\'" . $row['fotoGralesC'] . "\'>\"]";
            }
            ?>
        }).on('change', function (event, data, previewId, index) {

            $("#fotoGralesC").fileinput("upload");

        }).on('fileclear', function (event) {
            url = '<?php
                $campo = 'fotoGralesC';
                $tabla = 'equipoDielectico';

                echo base_url("index.php/CrudAnalisisRiesgo/eliminarImagen/$campo/$tabla/$idAsignacion");

                ?>';
            $.ajax({
                url: url,
                type: "post",
                dataType: "html"
            }).done(function (res) { });


        });
        //CUATRO

    });




</script>




<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->