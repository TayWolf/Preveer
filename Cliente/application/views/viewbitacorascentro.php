
    <section class="content">
        <div class="container-fluid">
            <div class="block-header" style="margin-top:15px;">
                <h2>Bitacoras registradas</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <?php 
                foreach ($bitacoras as $row) {
                    $nombreBitacora=$row["nombre"];
                    $idBitacora=$row["idBitacora"];
                    $idAsignacion=$row["idAsignacion"];
                    echo "
                    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                        <a href='https://cointic.com.mx/preveer/Cliente/index.php/Crudnormasgrales/hitorialBitacora/$idCentroTrabajo/$idBitacora'>
                        <div class='info-box bg-orange hover-zoom-effect'>
                            <div class='icon'>
                                <i class='material-icons'>account_box</i>
                            </div>
                            <div class='content'>
                                <div class='text' style='font-size: 12px;'>$nombreBitacora</div>
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
