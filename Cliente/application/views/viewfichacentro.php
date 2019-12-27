<section class="content">
    <div class="container-fluid">
        <div class="block-header" style="margin-top:15px;">
            <h2>Ficha y acta registradas</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <?php
            foreach ($fichas as $row) {
                $nombreRep=$row["nombreReportes"];
                $idReporte=$row["idReporte"];
                $idAsignacion=$row["idAsignacion"];
                $idOti=$row["idOti"];
                echo "
                    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                        <a href='https://cointic.com.mx/preveer/Cliente/index.php/Crudfichasgrales/verReportes/$idReporte/$idAsignacion'>
                        <div class='info-box bg-orange hover-zoom-effect'>
                            <div class='icon'>
                                <i class='material-icons'>account_box</i>
                            </div>
                            <div class='content'>
                                <div class='text' style='font-size: 12px;'>$nombreRep (OTI $idOti)</div>
                            </div>
                        </div>
                    </a>
                    </div>";
            }
            foreach ($actaCentro as $key) {
                $idAsignacionAc=$key["idAsignacion"];
                $idOtiAc=$key["idOti"];

                echo "<div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                        <a href='#' onclick='popUpImprimir($idAsignacionAc);'>
                        <div class='info-box bg-orange hover-zoom-effect'>
                            <div class='icon'>
                                <i class='material-icons'>account_box</i>
                            </div>
                            <div class='content'>
                                <div class='text' style='font-size: 12px;'>Acta de verificación (OTI $idOtiAc )</div>
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
<script type="text/javascript">
    function  popUpImprimir(id)
    {
        window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/Crudactaverificacion/verActaVerificacion/"+id);
    }
</script>
