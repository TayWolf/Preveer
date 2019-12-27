<?php
include "header.php";
?>
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
                            Biblioteca virtual de SSH
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover formatos-reg">
                            <thead>
                            <tr>
                                <th>Centro de trabajo</th>
                                <th style="text-align: center">Arnés</th>
                                <th style="text-align: center">Andamios</th>
                                <th style="text-align: center">escaleras</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            foreach ($listBitacoras as $row) {
                                $idAsignacion=$row["idAsignacion"];
                                $idCentroTrabajo=$row["idCentroTrabajo"];
                                $nombre=$row["nombre"];
                                echo "
                                            <tr>
                                                <td>$nombre</td>
                                                <td style=\"text-align: center\"><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/formatoArnes/1/$idAsignacion'><i class='material-icons'>accessibility</i></a></td>
                                                <td style=\"text-align: center\"><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/formatoArnes/2/$idAsignacion'><i class='material-icons'>border_top</i></a></td>
                                                <td style=\"text-align: center\"><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudFormatosssh/formatoEscaleras/3/$idAsignacion/$idCentroTrabajo'><i class='material-icons'>vertical_split</i></a></td>
                                           
                                            </tr>";

                            }
                            ?>
                            </tbody>
                        </table>
                        <div align="center">
                            <div>
                                <nav>
                                    <?php echo $page; ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->