<?php
include "header.php";
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <!-- <h2>NORMAL TABLES</h2> -->
        </div>
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="Buscar...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>

        <div class="block-header">
            <a href="<?=site_url('menus');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Indicadores de Acuses registrados
                        </h2>

                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">find_in_page</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudAcuses/formAltaAcuseIndicador" disabled>Registrar acuse</a></li>

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
                                <th>Grupo</th>
                                <th>Detalle</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            foreach ($listaAcuses as $row) {

                                $idIndicador = $row["idIndicador"];
                                $nombreIndicador = $row["nombreIndicador"];
                                $nombreGrupo  = $row["nombreGrupo"];
                                $idGrupoIndicador = $row['idGrupoIndicador'];

                                echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$nombreIndicador</td>
                                                <td>$nombreGrupo</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAcuses/formDetalleAcuseIndicador/$idIndicador' disabled><i class='fa fa-eye'></i></a>
                                                </td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAcuses/formEditarAcuseIndicador/$idIndicador'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteAcuse($idIndicador);'><i class='fa fa-trash'></i></a></td>
                                            </tr>";
                                $conte++;
                            }
                            ?>
                            </tbody>
                        </table>

                        <div align="center">
                            <div>
                                <nav>
                                    <?php echo $page; ?>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>



            </div>

        </div>
    </div>
</section>


<script type="text/javascript">
    function confirmaDeleteAcuse(id)
    {
        swal({
                title: "Aviso",
                text: "¿Desea borrar el Indicador?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudAcuses/eliminarAcuseIndicador/"+id;
            });

    }
</script>

<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->