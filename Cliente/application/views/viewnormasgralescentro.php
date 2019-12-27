
    <section class="content">
        <div class="container-fluid">
            <div class="block-header" style="margin-top:15px;">
                <h2>Normas registradas</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <?php 
                foreach ($centroPornorma as $row) {
                    $nombCentro=$row["nombre"];
                    $idCentroTrabajo=$row["idCentroTrabajo"];
                    $idOti=$row["idOti"];
                    $idAsignacion=$row["idAsignacion"];
                    $idSubservicio=$row["idSubservicio"];
                    $porcentajeValor=$row["porcentajeValor"];
                    if ($porcentajeValor=="") {
                        $porcentajeValor="0";
                    }
                    echo "
                    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                        <a href='https://cointic.com.mx/preveer/Cliente/index.php/Crudnormasgrales/verificacionControlcalidad/$idAsignacion/$idOti/$idSubservicio'>
                            <div class='info-box bg-orange hover-zoom-effect'>
                                <div class='icon'>
                                    <i class='material-icons'>account_box</i>
                                </div>
                                <div class='content'>
                                    <div class='text'>$nombCentro $porcentajeValor %</div>
                                </div>
                            </div>
                        </a>
                    </div>";
                }
                 ?>
                
            </div>
            <!-- #END# Widgets -->
           
        </div>
    </section>
