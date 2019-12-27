<!-- Boton flotante -->

<ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
    <li class='mfb-component__wrap'>
        <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
        </a>
        <ul class='mfb-component__list'>
            <li>
                <a href="<?=site_url('Catalogos')?>" data-mfb-label='Catálogos' class='mfb-component__button--child'>
                    <i class='material-icons'>import_contacts</i>
                </a>
            </li>
            <li>
                <a href="<?=site_url('CrudOti')?>" data-mfb-label='OTI' class='mfb-component__button--child'>
                    <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>

            <li>
                <a href="<?=site_url('Crudusuarios')?>"
                   data-mfb-label='Usuarios' class='mfb-component__button--child'>
                    <i class='material-icons'>person_add</i>
                </a>
            </li>
        </ul>
    </li>
</ul>

<?php

$tipo=$this->session->userdata('tipoUser');
if($tipo!='' && $_SESSION['idusuariobase'] != '')
{
    //$data['page'] = $this->usuarios->data_pagination("/Crudusuarios/index/",
    //$this->usuarios->getTotalRowAllData(), 3);
    // $data['listAreas'] = $this->areas->getDatos($index);
    if($tipo == 1){ //Menu flotante para administrador
        echo "
            
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('Catalogos')." data-mfb-label='Catálogos' class='mfb-component__button--child'>
                <i class='material-icons'>import_contacts</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>

            <li>
                <a href=".site_url('Crudusuarios')."
                data-mfb-label='Usuarios' class='mfb-component__button--child'>
                <i class='material-icons'>person_add</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>        
            ";

    } else if($tipo == 2){ //Menu flotante para comercial
        echo "
            
             <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudCentrosTrabajo')." data-mfb-label='Centros de trabajo' class='mfb-component__button--child'>
                <i class='material-icons'>group_work</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudFormatos')." data-mfb-label='Formatos' class='mfb-component__button--child'>
                <i class='material-icons'>store_mall_directory</i>
                </a>
            </li>
            <li>
                <a href=".site_url('Crudclientes')." data-mfb-label='Clientes' class='mfb-component__button--child'>
                <i class='material-icons'>account_box</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>       
            ";
    }  else if($tipo == 3){ //Menu flotante para coordinador
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti/coordinador')."/".$this->session->userdata('idusuariobase')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>   
           ";
    }

    else if($tipo == 4){ //Menu flotante para analista
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>              
           ";
    }

    else if($tipo == 5){ //Menu flotante para analista
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>            
           ";
    }

    else if($tipo == 9){ //Menu flotante para Uisuario coordinador SSHI
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
                <li class='mfb-component__wrap'>
                    <a href='#' class='mfb-component__button--main'>
                    <i class='material-icons'>reorder</i>
                    </a>
                    <ul class='mfb-component__list'>
                        <li>
                            <a href=".site_url('CrudOti/coordinador/')." data-mfb-label='OTI' class='mfb-component__button--child'>
                            <i class='material-icons'>playlist_add_check</i>
                            </a>
                        </li>
                        <li>
                            <a href=".site_url('CrudOti/coordinadorAnNoAsig/'.$this->session->userdata('idusuariobase'))." data-mfb-label='A cargo sin asignar' class='mfb-component__button--child'>
                            <i class='material-icons'>assignment_late</i>
                            </a>
                        </li>
                         <li>
                            <a href=".site_url('CrudOti/coordinadorAnAsig/'.$this->session->userdata('idusuariobase'))." data-mfb-label='A cargo asignadas' class='mfb-component__button--child'>
                            <i class='material-icons'>assignment_turned_in</i>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>            
           ";
    }


}

?>

<!-- /Boton flotante -->


<!-- Jquery Core Js -->
<script src="<?=base_url('assets/plugins/jquery/jquery.min.js')?>"></script>

<!--JQuery UI-->
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!--Datatable-->
<script src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>


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
<!--<script src="<?=base_url('assets/js/piexif.min.js')?>"></script>-->
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
