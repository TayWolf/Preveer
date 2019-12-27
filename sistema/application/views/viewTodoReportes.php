<?php
if ($tiposs=$this->session->userdata('tipoUser')!= "") {
    include "header.php";
    ?>
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

    <script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <?php
                $tipo=$this->session->userdata('tipoUser');
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
                                Reportes
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover formatos-reg">
                                <thead>
                                <tr>
                                    <th>Centro de trabajo</th>
                                    <?php
                                    foreach ($reportes as $reporte)
                                    {
                                        $nombreReporte = $reporte['nombreReportes'];
                                        echo "<th style=\"text-align: center\">$nombreReporte</th>";
                                    }
                                    ?>
                                    <th>Acta de verificación ocular</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $conte=1;
                                $contadorReportes=0;
                                foreach ($datos as $row)
                                {
                                    $idAsignacion=$row["idAsignacion"];
                                    $idCentroTrabajo=$row["idCentroTrabajo"];
                                    $nombre=$row["nombre"];
                                    echo "<tr><td>$nombre</td>";

                                    foreach($reportes as $reporte)
                                    {
                                        $idReporte= $reporte['idReporte'];
                                        $iconoReportes = $reporte['icono'];

                                        echo "<td style=\"text-align: center\"><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudReportes/verReportes/$idReporte/$idAsignacion'><i class='$iconoReportes'></i></a></td>";

                                    }
                                    echo "<td style=\"text-align: center\"><a href='https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/formActaverificacion/$idAsignacion'><i class='fa fa-file-word-o'></i></a></td>
                                </tr>";

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
}else{
    header("location: https://cointic.com.mx/preveer/sistema/");
    die();
}
?>
<!-- <?php
//include "footer.php";
?> -->