<?php
//$idUsuarioBase = $_SESSION['idCliente'];
$idUsuarioBase=$this->session->userdata('idCliente');
$nombreCliente=$this->session->userdata('nombreCliente');
if ($idUsuarioBase == "") {
    header("location: https://cointic.com.mx/preveer/Cliente/");
}
//echo "datos ".$idUsuarioBase;
?>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header" style="margin-top:15px;">
                <h2>Normas registradas</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <?php 
                foreach ($normasTotales as $row) {
                    $nombNor=$row["nombreNorma"];
                    $idNorma=$row["idSubservicio"];
                    echo "
                    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
                        <a href='https://cointic.com.mx/preveer/Cliente/index.php/Crudnormasgrales/normasGralescentro/$idNorma'>
                        <div class='info-box bg-orange hover-zoom-effect'>
                            <div class='icon'>
                                <i class='material-icons'>account_box</i>
                            </div>
                            <div class='content'>
                                <div class='text'>$nombNor</div>
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
