<?php
include "header.php";
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href="https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras">
                <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                    <i class='material-icons'>arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Calculos del indicador <?=$nombreIndicador[0]['nombreIndicador']?> registrados </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a style="align-items: center;" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">tune</i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/formAltaCalculo/<?=$idIndicador?>">Registrar cálculo para el indicador</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="tabla">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Condiciones</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            foreach ($listCalculos as $row) {
                                $idCalculo=$row["idIndicadorCalculo"];
                                $NombreCalculo=$row["descripcion"];
                                if($tipoIndicador[0]['tipoIndicador']!=4)
                                    $condicion="<a href='https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/verCondiciones/$idCalculo/$idIndicador'><i class=\"fa fa-question-circle-o\" aria-hidden=\"true\"></i></a>";
                                else
                                    $condicion="<a href='#'><i class=\"fa fa-question-circle-o\" aria-hidden=\"true\"></i></a>";

                                echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$NombreCalculo</td>
                                                <td>$condicion</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/formEditarCalculo/$idCalculo/$idIndicador'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteCalculo($idCalculo);'><i class='fa fa-trash'></i></a></td>
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
    function confirmaDeleteCalculo(id)
    {
        swal({
                title: "Aviso",
                text: "¿Desea borrar este cálculo?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/deleteCalculo/"+id+"/<?=$idIndicador?>";
            });
    }
</script>
<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->