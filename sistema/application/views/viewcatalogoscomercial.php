<?php 
  include "header.php";
?>


<section class="content">
        <div class="container-fluid">
            <div class="block-header"style="margin-top:15px;">
                <h2>
                    CATÁLOGOS
                   
                </h2>
            </div>
            <!-- Counter Examples -->
            <div class="row clearfix">

           
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?=site_url('Crudclientes')?>">
                    <div class="info-box bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">CLIENTES</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?=site_url('CrudFormatos')?>">
                    <div class="info-box bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">store_mall_directory</i>
                        </div>
                        <div class="content">
                            <div class="text">FORMATOS</div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- #END# Chart Samples -->
        </div>
    </section>




<?php 
  include "footer.php";
?>