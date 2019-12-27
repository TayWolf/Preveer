    <section class="content">
        <div class="container-fluid">
            <div class="block-header" style="margin-top:15px;">
                <h2>Centros de trabajo registrados</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <?php 
                foreach ($normasCentrosDeTrabajo as $row) {
                    $nombNor=$row["nombreNorma"];
                    $idNorma=$row["idSubservicio"];
                     $idOti=$row["idOti"];
                    $idAsignacion=$row["idAsignacion"];
                     $porcentajeValor=$row["porcentajeValor"];
                     if($porcentajeValor=="")
                     {
                      $porcentajeValor=0;  
                     }



                    echo "
                    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                        <a href='https://cointic.com.mx/preveer/Cliente/index.php/Crudnormasgrales/verificacionControlcalidad/$idAsignacion/$idOti/$idNorma'>
                        <div class='info-box bg-orange hover-zoom-effect'>
                            <div class='icon'>
                                <i class='material-icons'>account_box</i>
                            </div>
                            <div class='content'>
                                <div class='text'>$nombNor  </br> $porcentajeValor %</div>
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
