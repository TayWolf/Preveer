<?php
include "header.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!-- DataTable -->
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href="<?=site_url('Catalogos');?>">
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
                            Trámites registrados

                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">description</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="https://cointic.com.mx/preveer/sistema/index.php/Crudtramites/formAltaTramite">Registrar trámite</a></li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="tabla-tramites">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            foreach ($listTramites as $row) {
                                $idTramite=$row["idTramite"];
                                $NombreTramite=$row["nombreTramite"];

                                echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$NombreTramite</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/Crudtramites/formEditarTramite/$idTramite'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteTramite($idTramite);'><i class='fa fa-trash'></i></a></td>
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
    function confirmaDeleteTramite(id)
    {
        //alert ("id"+id);
        swal({
                title: "Aviso",
                text: "¿Desea borrar estra trámite?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/Crudtramites/deleteTramite/"+id;
            });

    }
</script>

<script type="text/javascript">
    window.onload=inicio;
    function inicio()
    {
        $('#tabla-tramites').dataTable();
    }
</script>


<?php
include "footer.php";
?>