<?php
include "header.php";
?>
<!-- DataTable -->
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.5/css/fixedColumns.bootstrap.min.css"/>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
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
                            Oportunidades de mejora
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover formatos-reg" id="tablaOMSSH">
                            <thead>
                            <tr>
                                <th>Centro de trabajo</th>
                                <th>Oportunidad de mejora</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            $contadorBitacoras=0;

                            foreach ($listCT as $row)
                            {
                                print "<tr><td>".$row['nombre']."</td><td><a href='".site_url('CrudOMSSH/')."verOMSSH/".$row['idAsignacion']."'><i class=\"material-icons\">check_circle</i></a></td></tr>";
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
<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->