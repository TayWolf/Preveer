<?php
include "header.php";
?>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header"style="margin-top:15px;">
                <h2>
                REPORTES 

                </h2>
            </div>
            <!-- Counter Examples -->
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudReporteSSHL')?>">
                        <div class="info-box bg-orange hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">Fichas Registradas</div>
                            </div>
                        </div>
                    </a>
                </div>

                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudApartadoReporte')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">move_to_inbox</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">Apartado</div>
                            </div>
                        </div>
                    </a>
                </div>
          

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudIndicadorReporte')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">chrome_reader_mode</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">Indicador de Fichas</div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudPonderadorReporte')?>">
                        <div class="info-box bg-orange hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">dns</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">Ponderador Fichas</div>
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