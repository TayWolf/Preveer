<?php
include "header.php";
?>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header"style="margin-top:15px;">
                <h2>
                    CONFIGURACIÓN DE FORMULARIO

                </h2>
            </div>
            <!-- Counter Examples -->
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudIndicadorFormulario')?>">
                        <div class="info-box bg-orange hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">assignment_turned_in</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">INDICADOR FORMULARIO
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudPonderadorForm')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">assignment_ind</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">PONDERADOR FORMULARIO</div>
                            </div>
                        </div>
                    </a>
                </div>

                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudAutoad')?>">
                       <div class="info-box bg-orange hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">book</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">FORMULARIOS</div>
                            </div>
                        </div>
                    </a>
                </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudAcordeon')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">account_balance_wallet</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">ACORDEON</div>
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