<?php
include "header.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript">
    function confirmaDeleteCentroTrabajo(id)
    {
        //alert ("id"+id);
        swal({
                title: "Aviso",
                text: "¿Desea borrar este centro de trabajo?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/deleteCentroTrabajo/"+id;
            });

    }
</script>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php $tipo=$this->session->userdata('tipoUser');
            $areaUse=$this->session->userdata('area');

            echo "<a href='javascript:history.go(-1)'>
                <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                    <i class='material-icons'>arrow_back</i>
                </button>
                </a>";



            ?>

        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Centros de trabajo de la Oti
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover formatos-reg">
                            <thead>
                            <tr>
                                <th>Centro de trabajo</th>

                                <?php
                                $encabezado="";
                                if ( $areaUse=="2" || $tipo=="1")
                                {
                                    $botonEncabezado="<th>Norma</th><th>CheckList</th>";
                                    echo "$encabezado $botonEncabezado";
                                }
                                ?>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            foreach ($listNormas as $row) {
                                $idCentroTrabajo=$row["idAsignacion"];
                                $nombre=$row["nombre"];
                                $idOti=$row["idOti"];
                                $idSubservicio=$row["idSubservicio"];
                                $nombreNorma=$row['nombreNorma'];
                                if ( $areaUse=="2" || $tipo=="1" )
                                {
                                    $botonCuerpo=" <tr><td>$nombre</td><td>$nombreNorma</td><td><a href='https://cointic.com.mx/preveer/sistema/index.php/Crudcheklist/verificacionControlcalidad/$idCentroTrabajo/$idOti/$idSubservicio' ><i class='material-icons'>library_books</i></a></td>";
                                    $html="$botonCuerpo";
                                    echo $html;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4" align="center">
                            <!--<button class="btn bg-red waves-effect waves-light" onclick="guardarCumplimiento(<?=$idOti?>)">Guardar cumplimiento de este mes</button>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $("table").dataTable({
            "order": [[ 1, "desc" ]]
        });
    });
    function guardarCumplimiento(idOti)
    {
        swal({
            title: '¿Estas seguro de guardar el cumplimiento de este mes?',
            text: "Se mostrarán estos cambios al cliente",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'Cancelar'
        }, function (isConfirm)
        {
            if(isConfirm)
            {
                //Código que guarda el cumplimiento
                $.ajax({
                    url:'<?=site_url('CrudAnalistaNormas/guardarCumplimiento/')?>'+idOti,
                    contentType: false,
                    processData: false,
                    dataType: 'HTML',
                    success: function (data)
                    {
                        swal('Exito!', 'Se guardó el cumplimiento de la OTI', 'success');
                    }
                });
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