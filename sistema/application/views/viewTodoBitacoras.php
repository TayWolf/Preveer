<?php
include "header.php";
?>
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.5/css/fixedColumns.bootstrap.min.css"/>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php $tipo=$this->session->userdata('tipoUser');
            if($tipo!='' && $_SESSION['idusuariobase'] != '')
            {
                if($tipo == 1){
                    echo "<a href='".site_url('Catalogos')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                } elseif($tipo == 2){
                    echo "<a href='".site_url('menus')."'>
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
                        <h2>
                            Bitácoras
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover formatos-reg">
                            <thead>
                            <tr>
                                <th>Centro de trabajo</th>
                                <?php
                                foreach ($bitacoras as $bitacora)
                                {
                                    $nombreBitacora = $bitacora['nombre'];
                                    echo "<th style=\"text-align: center\">$nombreBitacora</th>";
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            $contadorBitacoras=0;
                            foreach ($listBitacoras as $row)
                            {
                                $idAsignacion=$row["idAsignacion"];
                                $idCentroTrabajo=$row["idCentroTrabajo"];
                                $nombre=$row["nombre"];
                                echo "<tr><td>$nombre</td>";
                                foreach($bitacoras as $bitacora)
                                {
                                    $idBitacora= $bitacora['idBitacora'];
                                    $iconoBitacora = $bitacora['icono'];
                                    $encontrado=0;
                                    foreach ($bitacoraAsignacion as $bitAsignacion)
                                    {

                                        if($bitAsignacion['idBitacora']==$idBitacora&&$idAsignacion==$bitAsignacion['idAsignacion'])
                                        {

                                            echo "<td style=\"text-align: center\"><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoras/verBitacora/$idBitacora/$idAsignacion'><i class='$iconoBitacora'></i></a></td>";
                                            $encontrado=1;
                                            break;
                                        }
                                    }
                                    if(!$encontrado)
                                        echo "<td style=\"text-align: center\"><a href='#' style='color: #b81f2678'><i class='$iconoBitacora'></i></a></td>";
                                }
                                echo "</tr>";
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
<script>
    $(document).ready(function () {
        $("table").DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "ordering": false

        });
    });
</script>

<!--Datatable-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>
<?php
include "footer.php";
?>
