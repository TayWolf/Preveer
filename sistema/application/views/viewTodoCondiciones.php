<?php
include "header.php";
?>
<?php
    $tipoIndicador=$tipoIndicador[0]['tipoIndicador'];
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href="javascript:history.go(-1)">
                <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                    <i class='material-icons'>arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Condiciones del cálculo <?=$nombreCalculo[0]['descripcion']?></h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a style="align-items: center;" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">tune</i></a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/formAltaCondicion/<?=$idCalculo?>/<?=$tipoIndicador?>">Registrar condición</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="tabla">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Condición</th>
                                <th>Valor de la condición</th>

                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;

                            foreach ($listaCondiciones as $row)
                            {
                                $idCondicion=$row["idIndicadorCalculoCondicion"];
                                $condicion=$row["condicion"];
                                if($condicion=="==")
                                    $condicion="Igual que";
                                else if($condicion==">=")
                                    $condicion="Mayor o igual que";
                                else if($condicion=="<=")
                                    $condicion="Menor o igual que";
                                else if($condicion==">")
                                    $condicion="Mayor que";
                                else if($condicion=="<")
                                    $condicion="Menor que";
                                else if($condicion=="includes")
                                    $condicion="Que incluya";

                                $valorCondicion=$row["valorCondicion"];
                                echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$condicion</td>
                                                <td>$valorCondicion</td>
                                                <td><a href='#' onclick='confirmaDeleteCalculo($idCondicion);'><i class='fa fa-trash'></i></a></td>
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
                text: "¿Desea borrar esta condición?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function()
            {
                location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/deleteCondicion/"+id+"/<?=$idCalculo?>/<?=$idIndicador?>";
            });
    }
</script>
<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->