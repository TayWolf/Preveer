<?php
include "header.php";
?>


    <section class="content">
        <div class="container-fluid">   
            <div class="block-header"style="margin-top:15px;">
                <h2>
                    PONDERADOR

                </h2>
            </div>
            <!-- Counter Examples -->
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudIndicadorInfra')?>">
                        <div class="info-box bg-orange hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">assignment_turned_in</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">INDICADOR INFRAESTRUCTURA
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudPonderadorInfra')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">assignment_ind</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">PONDERADOR INFRAESTRUCTURA</div>
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