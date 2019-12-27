<?php
include "header.php";
?>
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/3.2.5/css/fixedColumns.bootstrap.min.css"/>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <?php $tipo=$this->session->userdata('tipoUser');
            if($tipo!='' && $_SESSION['idusuariobase'] != '')
            {
                if($tipo == 2 || $tipo == 4){
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
                            Análisis de riesgos
                        </h2>
                    </div>
                    <div class="body table-responsive">
                        <table id="example" class="display">
                            <thead>
                            <tr>
                                <th>Centro de trabajo</th>
                                <?php
                                foreach ($formularios as $formulario)
                                {
                                    $nombreForm = $formulario['nombreFormulario'];
                                    echo "<th style=\"text-align: center\">$nombreForm</th>";
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            $contadorBitacoras=0;
                            foreach ($visitas as $visita)
                            {
                                echo "<tr><td>".$visita['nombre']."</td>";
                                foreach ($formularios as $formulario)
                                {
                                    echo "<td style=\"text-align: center\"><a href='".site_url('CrudVisitaAnalisis/verAnalisisRiesgo/').$visita['idAsignacion']."/".$formulario['idControl']."'><i class='".$formulario['icono']."'></i></a> </td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Centro de trabajo</th>
                                <?php
                                foreach ($formularios as $formulario)
                                {
                                    $nombreForm = $formulario['nombreFormulario'];
                                    echo "<th style=\"text-align: center\">$nombreForm</th>";
                                }
                                ?>
                            </tr>
                            </tfoot>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        var table=$("#example").DataTable({
            "scrollY": "400",
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            },
            "orderCellsTop": true,
            "scrollX": true,
            "fixedColumns": {
                "leftColumns": 1
            }
        });
    });
</script>




<!-- /Boton flotante -->


<!-- Jquery Core Js -->
<!--JQuery UI-->
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!--Datatable-->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js "></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.js')?>"></script>

<!-- Select Plugin Js -->
<!-- <script src="<?=base_url('assets/plugins/bootstrap-select/js/bootstrap-select.js')?>"></script> -->

<!-- Slimscroll Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.js')?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?=base_url('assets/plugins/node-waves/waves.js')?>"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-countto/jquery.countTo.js')?>"></script>

<!-- Morris Plugin Js -->
<script src="<?=base_url('assets/plugins/raphael/raphael.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/morrisjs/morris.js')?>"></script>

<!-- ChartJs -->
<script src="<?=base_url('assets/plugins/chartjs/Chart.bundle.js')?>"></script>

<!-- Flot Charts Plugin Js -->
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.resize.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.pie.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.categories.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.time.js')?>"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-sparkline/jquery.sparkline.js')?>"></script>

<!-- Custom Js -->
<script src="<?=base_url('assets/js/admin.js')?>"></script>

<script src="<?=base_url('assets/js/pages/index.js')?>"></script>



<!-- Demo Js -->
<script src="<?=base_url('assets/js/demo.js')?>"></script>
<script src="<?=base_url('assets/js/modernizr.touch.js')?>"></script>
<!--<script src="<?/*=base_url('assets/js/mfb.js.js')*/?>"></script>
-->


<!--JS PARA EDITAR IMAGENES AUTOMATICAMENTE -->
<link href="<?=base_url('assets/css/fileinput.min.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/js/piexif.min.js')?>"></script>
<script src="<?=base_url('assets/js/sortable.min.js')?>"></script>
<script src="<?=base_url('assets/js/purify.min.js')?>"></script>
<script src="<?=base_url('assets/js/fileinput.min.js')?>"></script>
<script src="<?=base_url('assets/js/es.js')?>"></script>



<script>

    var panel = document.getElementById('panel'),
        menu = document.getElementById('menu'),
        showcode = document.getElementById('showcode'),
        selectFx = document.getElementById('selections-fx'),
        selectPos = document.getElementById('selections-pos'),
        // demo defaults
        effect = 'mfb-zoomin',
        pos = 'mfb-component--br';

    //showcode.addEventListener('click', _toggleCode);
    //selectFx.addEventListener('change', switchEffect);
    //selectPos.addEventListener('change', switchPos);

    function _toggleCode() {
        panel.classList.toggle('viewCode');
    }

    function switchEffect(e){
        effect = this.options[this.selectedIndex].value;
        renderMenu();
    }

    function switchPos(e){
        pos = this.options[this.selectedIndex].value;
        renderMenu();
    }

    function renderMenu() {
        menu.style.display = 'none';
        // ?:-)
        setTimeout(function() {
            menu.style.display = 'block';
            menu.className = pos + effect;
        },1);
    }

</script>


</body>

</html>