
    <section class="content">
        <div class="container-fluid">
            <div class="block-header" style="margin-top:15px;">
                <h2>Centros de trabajo registrados</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <?php 
                foreach ($centrosDeTrabajo as $row) {
                    $nomCentroTranbajo=$row["nombre"];
                    $idCebtroTrabajo=$row["idCentroTrabajo"];
                    echo "
                    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                        <a href='https://cointic.com.mx/preveer/Cliente/index.php/Crudnormasgrales/obtenerNormasDeCentro/$idCebtroTrabajo'>
                        <div class='info-box bg-orange hover-zoom-effect'>
                            <div class='icon'>
                                <i class='material-icons'>account_box</i>
                            </div>
                            <div class='content'>
                                <div class='text'>$nomCentroTranbajo</div>
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
