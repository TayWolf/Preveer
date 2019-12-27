

<section class="content">
    <div class="container-fluid">
        <div class="block-header" style="margin-top:15px;">
            <h2>PANEL DE ADMINISTRACIÓN</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <?php $areaUser=$this->session->userdata('area'); ?>
                <a href="<?php echo ($areaUser==1)?site_url('CrudOti'):site_url('CrudOti').'/Otish'?>">
                    <div class="info-box bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">OTI</div>
                            <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <?php $areaUser=$this->session->userdata('area'); ?>
                <a href="<?php echo ($areaUser==1)?site_url('CrudOti/subgerenteAnalista'):site_url('CrudOti').'/subgerenteAnalista'?>">
                    <div class="info-box bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">assignment_turned_in</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size: 13px; margin-top:11px;">OTI'S ASIGNADAS</div>
                            <div class="number " ><?=$totalOtisAsignada?></div>
                            <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <?php $areaUser=$this->session->userdata('area'); ?>
                <a href="<?php echo ($areaUser==1)?site_url('CrudOti/subgerenteNoAnalista'):site_url('CrudOti').'/subgerenteNoAnalista'?>">
                    <div class="info-box bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">assignment_late</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size: 13px; margin-top:11px;">OTI'S SIN ASIGNAR</div>
                            <div class="number " ><?=$totalOtisNoAsignada?></div>
                            <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                        </div>
                    </div>
                </a>
            </div>
            <?php
                    if($areaUser==1)
                    {
                    ?>
            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <a href="<?=site_url('CrudSeguimiento/')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">all_inbox</i>
                            </div>
                            <div class="content">
                                <div class="text" style=" font-size: 13px; margin-top: 11px;">SEGUIMIENTO DOCUMENTAL</div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                        }
                        ?>
            </div>
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?php $areaUser=$this->session->userdata('area'); ?>
                    <a href="<?=site_url('CrudPlantillas/')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">description</i>
                            </div>
                            <div class="content">
                                <div class="text" style="font-size: 13px; margin-top:11px;">PLANTILLAS</div>
                                <!--div class="number " ><?=$totalOtisNoAsignada?></div>-->
                                <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <?php $areaUser=$this->session->userdata('area'); ?>
                    <a href="<?=site_url('CrudGeneradorPlantillas/')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">library_books</i>
                            </div>
                            <div class="content">
                                <div class="text" style="font-size: 13px; margin-top:11px;">GENERADOR DE PLANTILLAS</div>
                                <!--div class="number " ><?=$totalOtisNoAsignada?></div>-->
                                <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                            </div>
                        </div>
                    </a>
                </div>
				<?php
                    if($areaUser==1)
                    {
                    ?>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<?php $areaUser=$this->session->userdata('area'); ?>
                    <a href="<?=site_url('Crudbotonespc/listCentroTrabajoRiesgo')?>">
                        <div class="info-box bg-cyan hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">whatshot</i>
                            </div>
                            <div class="content">
                                <div class="text" style="font-size: 13px; margin-top:11px;">CALCULO DE RIESGO DE INCENDIO</div>
                                <!--div class="number " ><?=$totalOtisNoAsignada?></div>-->
                                <!-- <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div> -->
                            </div>
                        </div>
                    </a>
                </div>
				<?php
                        }
                        ?>
            </div>
                
            </div>


        <!-- #END# Widgets -->

    </div>
</section>

   