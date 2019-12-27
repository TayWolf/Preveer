

<section class="content">
    <div class="container-fluid">
        <div class="block-header" style="margin-top:15px;">
            <h2>PANEL DE ADMINISTRACIÓN</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?=site_url('CrudOti/coordinador')?>">
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

            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                <a href="<?=site_url('CrudOti/coordinadorAnNoAsig')?>">

                    <div class="info-box bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">assignment_late</i>
                        </div>
                        <div class="content">
                            <div class="text" style="font-size: 13px; margin-top:11px;">A CARGO SIN ASIGNAR</div>
                            <div class="number " ><?=$totalOtisNoAsignada?></div>
                        </div>
                    </div>

                </a>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                <a href="<?=site_url('CrudOti/coordinadorAnAsig')?>">
                    <div class="info-box bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">assignment_turned_in</i>
                        </div>
                        <div class="content">
                            <div class="text" style=" font-size: 13px; margin-top: 11px;">A CARGO ASIGNADAS</div>
                            <div class="number " ><?=$totalOtisAsignada?></div>
                        </div>
                    </div>
                </a>
            </div>

            <?php
            $area=$this->session->userdata('area');//Recibimos el tipo d ela variable de sessión de correo
            if($area==2)
            {
                ?>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <a href="<?=site_url('CrudOMSSH/')?>">
                        <div class="info-box bg-orange hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">assignment_turned_in</i>
                            </div>
                            <div class="content">
                                <div class="text" style=" font-size: 13px; margin-top: 11px;">OPORTUNIDADES DE MEJORA</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                    <a href="<?=site_url('Crudcronograma/')?>">
                        <div class="info-box bg-orange hover-zoom-effect">
                            <div class="icon">
                                <i class="material-icons">assignment_turned_in</i>
                            </div>
                            <div class="content">
                                <div class="text" style=" font-size: 13px; margin-top: 11px;">CRONOGRAMA DE INSPECCIONES</div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>


        </div>
        <!-- #END# Widgets -->

    </div>
</section>

   