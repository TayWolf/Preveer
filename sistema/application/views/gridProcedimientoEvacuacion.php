<?php $tipo=$this->session->userdata('tipoUser');?>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>
<section class="content">
    <div class="container-fluid">
        <?php
        if(!$desdeMovil)
        {
            ?>
            <div class="block-header">
                <?php $tipo=$this->session->userdata('tipoUser');
                if($tipo!='' && $_SESSION['idusuariobase'] != '')
                {
                    if($tipo == 4){
                        echo "<a href='".site_url('menus')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    }
                }

                ?>
            </div>
            <?php
        }
        ?>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Centros de trabajos</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Centro de trabajo</th>
                                <th>Servicio</th>
                                <th>Subservicio</th>
                                <th>Procedimiento de evacuación</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $contador=1;
                            foreach ($cenTra as $row) {
                                $nombreCent=$row["nombre"];
                                $idCentroTrabajo=$row["idCentroTrabajo"];
                                $idAsignacion=$row["idAsignacion"];
                                $servicio = $row["servicio"];
                                $subservicio = $row["subservicio"];
                                $idOti = $row["idOti"];
                                $porcentaje=$row["porcentajeValor"];

                                    echo "
                                            <tr>
                                                <td>$contador</td>
                                                <td>$nombreCent (OTI $idOti)</td>
                                                <td>$servicio</td>
                                                <td>$subservicio</td> 
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudProcedimientoEvacuacion/procedimiento/$idAsignacion'><i class='material-icons'>transfer_within_a_station</i></a></td>
                                            </tr>";
                                $contador++;
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


