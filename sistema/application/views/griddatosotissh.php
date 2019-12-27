<?php
include "header.php";
?>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#form").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/assets/img/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisssh/actualizarOtrosDatos/';?>";
                e.preventDefault();
                var f = $(this);
                var formData = new FormData(document.getElementById("form"));

                $.ajax({
                    url: url,
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                    .done(function(res){
                        //alert(res);
                        swal({
                                title: "HECHO",
                                text: "Datos Actualizados",
                                type: "success",
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false
                            },
                            function(){
                                location.reload();
                            });


                        // $('#cargando').fadeIn(1000).html(data);



                    });

            });
        });
    </script>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="javascript:history.go(-1);">
                    <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Ingrese los siguientes datos para la OTI SSHI
                            </h2>

                        </div>
                        <?php
                        $contador=0;
                        $row=array('personalFlotante'=>"", 'poblacionFija'=>"", 'aforo'=>"", 'turnoMatutino'=> "", 'turnoVepertino'=>"", 'turnoNocturno'=>"", 'turnoMixto'=>"", 'turnoOtros'=>"", 'horariosOperacion'=>"", 'lunes'=>"", 'martes'=>"", 'miercoles'=>"", 'jueves'=>"", 'viernes'=>"", 'extencionTerreno'=>"", 'superficieConstruida'=>"", 'nivelesConstruidos'=>"", 'nivelesOcupados'=>"", 'comentariosNiveles'=>"", 'inspeccionOrdinaria'=>"", 'inspeccionExtra'=>"", 'emplazamiento'=>"",'inspeccionComprobacion'=>"",'inspeccionAdiestramiento'=>"",'inspeccionCondicones'=>"",'otrosInpecciones'=>"",'comentariosSTPS'=>"");
                        foreach ($existencia as $row2)
                        {
                            $row=$row2;
                            $contador++;
                        }

                        if ($row['lunes']==1) { $lun="checked";}else{$lun="";}
                        if ($row['martes']==1) {$lunD="checked";}else{$lunD="";}
                        if ($row['miercoles']==1) {$lunT="checked";}else{$lunT="";}
                        if ($row['jueves']==1) {$lunC="checked";}else{$lunC="";}
                        if ($row['viernes']==1) {$lunCI="checked";}else{$lunCI="";}
                        if ($row['turnoMatutino']==1) {$lunS="checked";}else{$lunS="";}
                        if ($row['turnoVepertino']==1) {$lunSI="checked";}else{$lunSI="";}
                        if ($row['turnoNocturno']==1) {$lunO="checked";}else{$lunO="";}
                        if ($row['turnoMixto']==1) {$lunN="checked";}else{$lunN="";}
                        if ($row['inspeccionOrdinaria']==1) {$lunDI="checked";}else{$lunDI="";}
                        if ($row['inspeccionExtra']==1) {$lunON="checked";}else{$lunON="";}
                        if ($row['emplazamiento']==1) {$lunDO="checked";}else{$lunDO="";}
                        if ($row['inspeccionComprobacion']==1) {$lunTR="checked";}else{$lunTR="";}
                        if ($row['inspeccionAdiestramiento']==1) {$lunCA="checked";}else{$lunCA="";}
                        if ($row['inspeccionCondicones']==1) {$lunQ="checked";}else{$lunQ="";}
                        if ($row['corrosivos']==1) {$materialCorrosivo="checked";}else{$materialCorrosivo="";}
                        if ($row['reactivos']==1) {$materialReactivo="checked";}else{$materialReactivo="";}
                        if ($row['explosivos']==1) {$materialExplosivo="checked";}else{$materialExplosivo="";}
                        if ($row['inflamables']==1) {$materialInflamable="checked";}else{$materialInflamable="";}
                        if ($row['biologicos']==1) {$materialBiologico="checked";}else{$materialBiologico="";}
                        if ($row['toxicos']==1) {$materialToxico="checked";}else{$materialToxico="";}

                        ?>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nickUser">Personal Flotante</label>
                                                <input type="hidden" id="idAsignacion" name="idAsignacion" value="<?php echo $idAsignacion;?>">
                                                <input type="text" class="form-control" id="personaFlot" name="personaFlot" placeholder="Ingrese el dato" value="<?php echo $row['personalFlotante'];?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="passwordUser">Población Fija</label>
                                                <input type="text" id="poblacionFija" name="poblacionFija" class="form-control" placeholder="Ingrese el dato" value="<?php echo $row['personalFlotante'];?>" value="<?php echo $row['poblacionFija'];?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="rfcUser">Aforo</label>
                                                <input type="text" id="aforo" name="aforo" class="form-control" placeholder="Ingrese el dato" value="<?php echo $row['aforo'];?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label >Turno de operación</label>
                                        <div class="form-group">

                                            <input type="checkbox" name="matutino" id="matutino" <?php echo "$lunS"; ?> class="filled-in" vvalue="1">
                                            <label for="matutino">Matutino</label>

                                            <input type="checkbox" <?php echo "$lunSI"; ?> name="vepertino" id="vepertino" class="filled-in" value="1" >
                                            <label for="vepertino">Vespertino</label>

                                            <input type="checkbox" name="nocturno" id="nocturno" <?php echo "$lunO"; ?> class="filled-in" value="1">
                                            <label for="nocturno">Nocturno</label>

                                            <input type="checkbox" name="mixto" <?php echo "$lunN"; ?> id="mixto" class="filled-in" value="1"s>
                                            <label for="mixto">Mixto</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="DireccionUser">Horario de operación</label>
                                                <input type="text" class="form-control" id="operacionHorario" name="operacionHorario" placeholder="Ingrese el horario" value="<?php echo $row['horariosOperacion'];?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label >Días laborales</label>
                                        <div class="form-group">
                                            <input type="checkbox" name="lunes" id="lunes" class="filled-in" <?php echo "$lun"; ?> value="1">
                                            <label for="lunes">Lunes</label>

                                            <input type="checkbox" name="martes" id="martes" class="filled-in" <?php echo "$lunD"; ?> value="1">
                                            <label for="martes">Martes</label>

                                            <input type="checkbox" name="miercoles" id="miercoles" <?php echo "$lunT"; ?> class="filled-in" value="1">
                                            <label for="miercoles">Miécoles</label>

                                            <input type="checkbox" name="jueves" id="jueves" <?php echo "$lunC"; ?> class="filled-in" value="1">
                                            <label for="jueves">Jueves</label>

                                            <input type="checkbox" name="viernes" id="viernes" <?php echo "$lunCI"; ?> class="filled-in" value="1">
                                            <label for="viernes">Viernes</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="correoUser">Extensión del terreno (m²)</label>
                                                <input type="text" id="extTerreno" name="extTerreno" class="form-control" placeholder="Ingrese metros" value="<?php echo $row['extencionTerreno'];?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nombreUser">Superficie Construida (m²)</label>
                                                <input type="text" class="form-control" id="superficieContruida" name="superficieContruida" placeholder="Ingrese metros" value="<?php echo $row['superficieConstruida'];?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nombreUser">Niveles Construidos</label>
                                                <input type="number" class="form-control" id="nivelesConstruidos" name="nivelesConstruidos" placeholder="Ingrese cantidad" min="0" value="<?php echo $row['nivelesConstruidos'];?>" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nombreUser">Niveles Ocupados</label>
                                                <input type="number" class="form-control" id="nivelesOcupados" name="nivelesOcupados" placeholder="Ingrese cantidad" min="0" value="<?php echo $row['nivelesOcupados'];?>" required/>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line focused">
                                                <label class="form-label">Comentarios sobre niveles ocupados</label>
                                                <textarea name="comentariosNiveles" id="comentariosNiveles" cols="30" rows="5" class="form-control no-resize" placeholder="Especificar cuántos pisos son estacionamientos y/o sótanos de los niveles construidos del edificio." ><?php echo $row['comentariosNiveles'];?></textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-sm-6 col-sm-offset-1">
                                        <label >Situación ante la STPS</label>
                                        <div class="form-group">
                                            <input type="checkbox" name="inpeccOrdi" id="inpeccOrdi" <?php echo "$lunDI"; ?> class="filled-in" value="1">
                                            <label for="inpeccOrdi">Inpección ordinaria</label>
                                            <br>
                                            <input type="checkbox" name="inspeExtra" id="inspeExtra" <?php echo "$lunON"; ?> class="filled-in" value="1">
                                            <label for="inspeExtra">Inspección extraordinaria</label>
                                            <br>
                                            <input type="checkbox" name="emplazamie" id="emplazamie" <?php echo "$lunDO"; ?> class="filled-in" value="1">
                                            <label for="emplazamie">Emplazamiento</label>
                                            <br>
                                            <input type="checkbox" name="inpeccionCompr" id="inpeccionCompr" <?php echo "$lunTR"; ?> class="filled-in" value="1">
                                            <label for="inpeccionCompr">Inspección de comprobación</label>
                                            <br>
                                            <input type="checkbox" name="inpensAdiest" id="inpensAdiest" <?php echo "$lunCA"; ?> class="filled-in" value="1">
                                            <label for="inpensAdiest">Inspección de adiestramiento</label>
                                            <br>
                                            <input type="checkbox" name="inspecCondic" id="inspecCondic" <?php echo "$lunQ"; ?> class="filled-in" value="1">
                                            <label for="inspecCondic">Inspecciones en condiciones generales de trabajo</label>
                                            <br>
                                            <input type="checkbox" name="Otro" id="Otro" class="filled-in" >
                                            <label for="Otro">Otros</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-sm-5 ">
                                        <label >Manejo de materiales peligrosos</label>
                                        <div class="form-group">
                                            <input type="checkbox" name="corrosivos" id="corrosivos" class="filled-in" value="1" <?=$materialCorrosivo?>>
                                            <label for="corrosivos">Corrosivos</label>
                                            <br>
                                            <input type="checkbox" name="reactivos" id="reactivos" class="filled-in" value="1" <?=$materialReactivo?>>
                                            <label for="reactivos">Reactivos</label>
                                            <br>
                                            <input type="checkbox" name="explosivos" id="explosivos" class="filled-in" value="1" <?=$materialExplosivo?>>
                                            <label for="explosivos">Explosivos</label>
                                            <br>
                                            <input type="checkbox" name="toxicos" id="toxicos" class="filled-in" value="1" <?=$materialToxico?>>
                                            <label for="toxicos">Tóxicos</label>
                                            <br>
                                            <input type="checkbox" name="inflamables" id="inflamables" class="filled-in" value="1" <?=$materialInflamable?>>
                                            <label for="inflamables">Inflamables</label>
                                            <br>
                                            <input type="checkbox" name="biologicos" id="biologicos" class="filled-in" value="1" <?=$materialBiologico?>>
                                            <label for="biologicos">Biológicos infecciosos</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <textarea name="comentariosSTP" id="comentariosSTP" cols="30" rows="5" class="form-control no-resize"  ><?php echo $row['comentariosSTPS'];?></textarea>
                                                <label class="form-label">Comentarios sobre STPS</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-md-offset-5">
                                        <div class="form-line">
                                            <input type="submit" class="btn bg-red waves-effect waves-light" value="Aceptar">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-offset-5" id="cargando"></div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include "footer.php";
?>