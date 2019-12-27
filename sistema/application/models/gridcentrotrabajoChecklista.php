<?php
$tipo=$this->session->userdata('tipoUser');
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>

<script type="text/javascript">
    var array=
        {'datos':[]};
</script>
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
                        <h2>
                            Centros de trabajos de la OTI

                        </h2>

                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Centro de trabajo</th>
                                <th>Servicio</th>
                                <th>Subservicio</th>
                                <th>Check list</th>
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

                                            
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/verificacionControlcalidad/$idAsignacion/$idOti' ><i class='fa fa-check-square-o'></i> </a>%<label id='porcentaje$contador'>$porcentaje</label></td>
                                                
                                                
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

<script type="text/javascript">
    window.onload=function ()
    {

        var cantidad=<?php echo $contador;?>;

        for(i=1; i<=cantidad; i++)
        {
            colorear(i);
        }
    }
    function colorear(identificador)
    {


        if($("#porcentaje"+identificador).html()<25)
        {
            $("#porcentaje"+identificador).css("color", "red");
        }
        else if($("#porcentaje"+identificador).html()<50)
        {
            $("#porcentaje"+identificador).css("color", "darkorange");
        }
        else if($("#porcentaje"+identificador).html()<75)
        {
            $("#porcentaje"+identificador).css("color", "gold");
        }
        else if($("#porcentaje"+identificador).html()<100)
        {
            $("#porcentaje"+identificador).css("color", "green");
        }
        //hacerCuenta();
    }
</script>