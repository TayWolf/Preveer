<?php
include "header.php";
?>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php
            echo "<a href='".site_url('CrudAltaBitacora')."'>
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
                        <h2>Indicadores de bitacoras registradas</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">assignment_return</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudAltaBitacora/formAltaIndicadorInforme/<?=$idBitacora?>">Registrar indicador para el informe de la bitacora</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Indicador</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            foreach ($listaIndicadorInforme as $row) {
                                $idIndicador=$row["idIndicadorInforme"];
                                $nombreIndicador=$row["texto"];
                                $idBitacora=$row["idBitacora"];

                                echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$nombreIndicador</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAltaBitacora/formEditarIndicadorInforme/$idIndicador'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteindicadorBitacora($idIndicador);'><i class='fa fa-trash'></i></a></td>
                                            </tr>";
                                $conte++;
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function confirmaDeleteindicadorBitacora(id)
    {

        swal({
                title: "Aviso",
                text: "¿Desea borrar este indicador de informe?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudAltaBitacora/deleteIndicadorInforme/"+id+"/<?=$idBitacora?>";
            });

    }
</script>
<?php
include "footer.php";
?>