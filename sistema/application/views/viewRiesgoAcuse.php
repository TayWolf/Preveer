<?php
include "header.php";
?>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header"style="margin-top:15px;">
                <h2>
                CONFIGURACIÓN DE ACUSE DE ENTREGA 

                </h2>
            </div>
            <!-- Counter Examples -->
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudRiesgoAcuse')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">assignment</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">Riesgo</div>
                            </div>
                        </div>
                    </a>
                </div>
          

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudPrioridadMejora')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">chrome_reader_mode</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">Prioridad mejorada</div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudPrioridadIntervencion')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">chrome_reader_mode</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">Prioridad de Intervención</div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudPasosEvacuacion')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">chrome_reader_mode</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">Pasos de Evacuación</div>
                            </div>
                        </div>
                    </a>
                </div>


              <!-- #END# Chart Samples -->



            </div>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudProcesosEvacuacion')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">chrome_reader_mode</i>
                            </div>
                            <div class="content">
                                <div class="text" style="margin-top: 0px;">Procesos de Evacuación</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    </section>




<?php
include "footer.php";
?>