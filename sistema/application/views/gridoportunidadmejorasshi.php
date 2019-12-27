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
                    echo "<a href='".site_url('CrudOportunidamejorasshi')."/".$this->session->userdata('idusuariobase')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } else{
                    echo "<a href='".site_url('CrudOportunidamejorasshi/')."'>
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
                        <h2>Bitácora de detectores de humos</h2>
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
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Área de ubicación</b>
                                                            <select class="form-control" id="areaUbicacion" name="areaUbicacion" required>
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
                                                            <b>En el plano</b>
                                                            <select class="form-control" id="enElPlano" name="enElPlano" required>
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
                                                            <b>Tipo de sensor</b>
                                                            <select class="form-control" id="tipoSensor" name="tipoSensor" required>
                                                                <option value="">Seleccione una opción</option>
                                                                <option value="1">Humo</option>
                                                                <option value="2">Calor</option>
                                                                <option value="3">Gases de combustión</option>
                                                                <option value="4">Flama</option>
                                                                <option value="5">Otros</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
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
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Indicador luminoso funcionando</b>
                                                            <select class="form-control" id="indicadorLuminoso" name="indicadorLuminoso" required>
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
                                                            <b>Cuenta con baterias</b>
                                                            <select class="form-control" id="carga" name="carga" required>
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
                                                            <b>Activación indicada en el tablero</b>
                                                            <select class="form-control" id="activacionTablero" name="activacionTablero" required>
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
                                                            <b>En buen estado</b>
                                                            <select class="form-control" id="enBuenEstado" name="enBuenEstado" required>
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
                                                            <b>Limpio</b>
                                                            <select class="form-control" id="limpio" name="limpio" required>
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
                                                            <b>Revisar que no se encuentren insectos</b>
                                                            <select class="form-control" id="insectos" name="insectos" required>
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
                                                            <b>Equipo fijo y correcto en su ubicación</b>
                                                            <select class="form-control" id="equipoFijo" name="equipoFijo" required>
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
                                                            <b>Mes de mantenimiento</b>
                                                            <select class="form-control" id="mesMantenimiento" name="mesMantenimiento" required>
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
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <b>Observaciones</b>
                                                            <textarea type="text" class="form-control" id="observaciones" name="observaciones" min="0" ></textarea>
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
                                                        <th>No.</th>
                                                        <th>Área de ubicación</th>
                                                        <th>En el plano</th>
                                                        <th>Tipo de sensor</th>
                                                        <th>Libre de obstrucción</th>
                                                        <th>Indicador luminoso funcionando</th>
                                                        <th>Cuenta con baterias</th>
                                                        <th>Activación indicada en el tablero</th>
                                                        <th>En buen estado</th>
                                                        <th>Limpio</th>
                                                        <th>Revisar que no se encuentren insectos</th>
                                                        <th>Equipo fijo y correcto en su ubicación</th>
                                                        <th>Mes de mantenimiento</th>
                                                        <th>Observaciones</th>
                                                        <th>Eliminar</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="lista">

                                                    </tbody>

                                                </table>
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

<script type="text/javascript">

    function registrarDatos()
    {

        accion = "actualizarBitacora001/"+$("#idAsignacion").val();
        var url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudOportunidamejorasshi/';?>" + accion;
        var formData=new FormData(document.getElementById("formDatosBitacora"));
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
                    location.href = 'https://cointic.com.mx/preveer/sistema/index.php/CrudOportunidamejorasshi/bitacora001/' + $("#idAsignacion").val();
                });
        });

    }


    $("#form").on("submit", function(e){
        e.preventDefault();
        AgregarDatosBitacora();
    });


    function AgregarDatosBitacora()
    {
        var areaUbicacion = $("#areaUbicacion").val();
        var enElPlano = $("#enElPlano").val();
        var tipoSensor = $("#tipoSensor").val();
        var libreObstruccion = $("#libreObstruccion").val();
        var indicadorLuminoso = $("#indicadorLuminoso").val();
        var carga = $("#carga").val();
        var activacionTablero = $('#activacionTablero').val();
        var enBuenEstado = $('#enBuenEstado').val();
        var limpio = $('#limpio').val();
        var insectos = $('#insectos').val();
        var equipoFijo = $('#equipoFijo').val();
        var mesMantenimiento = $('#mesMantenimiento').val();
        var observaciones = $('#observaciones').val();

        array.datosBitacora.push({'idBitacora': '-1', 'areaUbicacion': areaUbicacion ,'enElPlano': enElPlano,'tipoSensor': tipoSensor,'libreObstruccion': libreObstruccion,'indicadorLuminoso': indicadorLuminoso,'carga': carga,'activacionTablero':activacionTablero,'enBuenEstado':enBuenEstado,'limpio':limpio,'insectos':insectos,'equipoFijo':equipoFijo,'mesMantenimiento':mesMantenimiento, 'action' : 1, 'observaciones': observaciones});
        console.log(JSON.stringify(array.datosBitacora, null, 4));

        $("#lista").append('<tr>'+
        '<td>'+array.datosBitacora.length+'</td>'+
            '<td style="font-weight: normal !important;">'+$("#areaUbicacion option:selected").text()+'</td>'+
            '<td style="font-weight: normal !important;">'+$("#enElPlano option:selected").text()+'</td>'+
            '<td>'+$("#tipoSensor option:selected").text()+'</td>'+
            '<td>'+$("#libreObstruccion option:selected").text()+'</td>'+
            '<td>'+$("#indicadorLuminoso option:selected").text()+'</td>'+
            '<td>'+$("#carga option:selected").text()+'</td>'+
            '<td>'+$("#activacionTablero option:selected").text()+'</td>'+
            '<td>'+$("#enBuenEstado option:selected").text()+'</td>'+
            '<td>'+$("#limpio option:selected").text()+'</td>'+
            '<td>'+$("#insectos option:selected").text()+'</td>'+
            '<td>'+$("#equipoFijo option:selected").text()+'</td>'+
            '<td>'+$("#mesMantenimiento option:selected").text()+'</td>'+
            '<td>'+observaciones+'</td>'+
            '<td><button type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>'+
            '</tr>');

        limpiarFormulario();
    }

    function limpiarFormulario()
    {
        $("#areaUbicacion").val("");
        $("#enElPlano").val("");
        $("#tipoSensor").val("");
        $("#libreObstruccion").val("");
        $("#indicadorLuminoso").val("");
        $("#carga").val("");
        $('#activacionTablero').val("");
        $('#enBuenEstado').val("");
        $('#limpio').val("");
        $('#insectos').val("");
        $('#equipoFijo').val("");
        $('#mesMantenimiento').val("");
        $('#observaciones').val("");
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
        $contBitacora =1;
        foreach ($tablaBitacora as $row) {
            $idBitacora = $row["idBitacora"];
            $areaUbicacion = $row["areaUbicacion"];
            $enElPlano = $row["enElPlano"];
            $tipoSensor = $row["tipoSensor"];
            $libreObstruccion = $row["libreObstruccion"];
            $indicadorLuminoso = $row["indicadorLuminoso"];
            $cargaBien = $row["cargaBien"];
            $activacionTablero = $row["activacionTablero"];
            $enBuenEstado = $row["enBuenEstado"];
            $limpio = $row["limpio"];
            $insectos = $row["insectos"];
            $equipoFijo = $row["equipoFijo"];
            $mesMantenimiento = $row["mesMantenimiento"];
            $observaciones = $row["observaciones"];
            $idAsignacion = $row["idAsignacion"];

            print "array.datosBitacora.push({'idBitacora': $idBitacora, 'areaUbicacion': $areaUbicacion, 'enElPlano': $enElPlano, 'tipoSensor': $tipoSensor, 'libreObstruccion': $libreObstruccion, 'indicadorLuminoso': $indicadorLuminoso,'carga': $cargaBien,'activacionTablero': $activacionTablero, 'enBuenEstado': $enBuenEstado,'limpio': $limpio,'insectos': $insectos, 'equipoFijo':$equipoFijo,'mesMantenimiento': $mesMantenimiento, 'action' : 0, 'observaciones': '$observaciones'}); \n";

            $areaUbicacion= ($areaUbicacion==1)? "Si":(($areaUbicacion==2)? "No": "N/A");
            $enElPlano= ($enElPlano==1)? "Si":(($enElPlano==2)? "No": "N/A");
            $tipoSensor= ($tipoSensor==1)? "Humo":(($tipoSensor==2)? "Calor":($tipoSensor==3)? "Gases de combustión":($tipoSensor==4)? "Flama": "Otros");
            $libreObstruccion= ($libreObstruccion==1)? "Si":(($libreObstruccion==2)? "No": "N/A");
            $indicadorLuminoso= ($indicadorLuminoso==1)? "Si":(($indicadorLuminoso==2)? "No": "N/A");
            $cargaBien= ($cargaBien==1)? "Si":(($cargaBien==2)? "No": "N/A");
            $activacionTablero= ($activacionTablero==1)? "Si":(($activacionTablero==2)? "No": "N/A");
            $enBuenEstado= ($enBuenEstado==1)? "Si":(($enBuenEstado==2)? "No": "N/A");
            $limpio= ($limpio==1)? "Si":(($limpio==2)? "No": "N/A");
            $insectos= ($insectos==1)? "Si":(($insectos==2)? "No": "N/A");
            $equipoFijo= ($equipoFijo==1)? "Si":(($equipoFijo==2)? "No": "N/A");
            $mesMantenimiento= ($mesMantenimiento==1)? "Si":(($mesMantenimiento==2)? "No": "N/A");
            $insectos= ($insectos==1)? "Si":(($insectos==2)? "No": "N/A");
            print "$('#lista').append(
                     '<tr><td hidden>$idBitacora</td><td>$contBitacora</td><td>$areaUbicacion</td><td>$enElPlano</td><td>$tipoSensor</td><td>$libreObstruccion</td><td>$indicadorLuminoso</td><td>$cargaBien</td><td>$activacionTablero</td><td>$enBuenEstado</td><td>$limpio</td><td>$insectos</td><td>$equipoFijo</td><td>$mesMantenimiento</td><td>$observaciones</td><td><button type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>'); \n";

                     $contBitacora++;
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