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
                            Subservicios registrados

                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">work</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="https://cointic.com.mx/preveer/sistema/index.php/Crudsubservicios/formAltaSubservicio">Registrar subservicio</a></li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="table-subservicios">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Modificar</th>
                                <!--<th>Requerimientos</th>-->
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            foreach ($listSubServicios as $row) {
                                $idSubServ=$row["idSubservicio"];
                                $NombreSubserv=$row["nombre"];

                                echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$NombreSubserv</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/Crudsubservicios/formEditarSubservicio/$idSubServ'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <!--<td><a href='".site_url('Crudsubservicios/listaRequerimientos')."/".$idSubServ."'><i class='fa fa-sitemap'></i></a></td>-->
                                                <td><a href='#' onclick='confirmaDeleteSubserv($idSubServ);'><i class='fa fa-trash'></i></a></td>
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
    window.onload=inicio;
    function inicio()
    {
        $('#table-subservicios').dataTable();
    }
</script>
<script type="text/javascript">
    function confirmaDeleteSubserv(id)
    {


        /*alert ("id"+id);
        swal({
                title: "Aviso",
                text: "¿Desea borrar este subservicio?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/Crudsubservicios/deleteSubservicio/"+id;
            });*/

        $.post({
            url: "https://cointic.com.mx/preveer/sistema/index.php/Crudsubservicios/deleteSubservicio"+id,
            type: "post",
            dataType: "html",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                swal('Éxito', 'Subservicio eliminado correctamente', 'success');
                location.href="https://cointic.com.mx/preveer/sistema/index.php/Crudsubservicios/";
            },
            error: function(data){
                swal('Error', 'El subservicio no puede ser eliminado por que pertenece a un proyecto', 'warning');
            }
        })


    }
</script>
<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->