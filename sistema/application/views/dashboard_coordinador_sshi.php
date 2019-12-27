

    <section class="content">
        <div class="container-fluid">
            <div class="block-header" style="margin-top:15px;">
                <h2>PANEL DE ADMINISTRACIÓN</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                   
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="<?=site_url('CrudOti/coordinador')?>/">
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
                <a href="<?=site_url('CrudOti/coordinadorAnNoAsig')?>/<?=$this->session->userdata('idusuariobase')?>">

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
                <a href="<?=site_url('CrudOti/coordinadorAnAsig')?>/<?=$this->session->userdata('idusuariobase')?>">
                <div class="info-box bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">assignment_turned_in</i>
                        </div>
                        <div class="content">
                            <div class="text" style=" font-size: 13px; margin-top: 11px;">A CARGO ASIGNADS</div>
                            <div class="number " ><?=$totalOtisAsignada?></div>
                        </div>
                    </div>
                    </a>
                </div>

                asdasd
                
            </div>
            <!-- #END# Widgets -->
           
        </div>
    </section>

   