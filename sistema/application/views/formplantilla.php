<?php
include "header.php";
?>
<style>
    a{
        margin: 10px;
        cursor: pointer;
    }
</style>
    <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#form").on("submit", function(e){
                var url;
                $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/assets/img/loading.gif"/>');
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/altaPlantilla/';?>";
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
                                text: "Plantilla se ha registrado exitosamente.",
                                type: "success",
                                //showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false
                            },
                            function(){
                                window.location.assign("https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/formAltaplantilla")
                            });

                    });

            });
        });

        function getFormato()
        {
            var idCliente=$("#idCliente").val();
            $("#idFormato").html('');
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getFormatos/')?>" + idCliente,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    $("#formm").show();
                    $("#idFormato").append('<option value ="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (i=0; i< data.length; i++) {
                            $("#idFormato").append(new Option(data[i]['nombre'],data[i]['idFormato']));
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#formm").hide(); //alert('Error get data from ajax');
                }
            });
        }

        function getCentrotrabajo()
        {
            var idFormato=$("#idFormato").val();
            $("#idCentro").html('');
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getCentro/')?>" + idFormato,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    $("#idCenn").show();
                    $("#idCentro").append('<option value ="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (i=0; i< data.length; i++) {
                            $("#idCentro").append(new Option(data[i]['nombre'],data[i]['idCentroTrabajo']));
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#idCenn").hide();//  alert('Error get data from ajax');
                }
            });

        }
    </script>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="<?=site_url('CrudPlantillas');?>">
                    <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-md-10">
                                <h2>Ingrese los siguientes datos</h2>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mymodal2">Glosario de etiquetas</button>
                            </div>
                        </div>
                        <div class="body">
                            <form method="post" action="" id="form" enctype="multipart/form-data">
                            </form>
                            <div class="row clearfix">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="nickUser">Nombre de la plantilla</label>
                                            <input type="hidden" form="form" name="totalCont" id="totalCont">
                                            <input type="hidden" form="form" name="totalContText" id="totalContText">
                                            <input type="hidden" form="form" name="totalContAcuse" id="totalContAcuse">
                                            <input type="text" form="form" class="form-control" id="nombrePlantilla" name="nombrePlantilla" placeholder="Ingrese el nombre de la plantilla" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float" style="margin-top: 13px;">
                                        <div class="form-line">
                                            <label for="tipoUser">Estado</label>
                                            <select id="idEdo" name="idEdo" form="form" style="width: 100%; border: none;" required>
                                                <option value="">Seleccione Estado</option>
                                                <?php
                                                foreach ($edo as $row) {
                                                    $idEdo=$row["id_Estado"];
                                                    $nombreEstado=$row["nombreEstado"];
                                                    echo "<option value='$idEdo'>$nombreEstado</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float" style="margin-top: 13px;">
                                        <div class="form-line">
                                            <label for="tipoUser">Cliente</label>
                                            <select id="idCliente" name="idCliente" form="form" onchange="getFormato()" style="width: 100%; border: none;" >
                                                <option value="">Seleccione Cliente</option>
                                                <?php
                                                foreach ($client as $roww) {
                                                    $idCliente=$roww["idCliente"];
                                                    $nombreCliente=$roww["nombreCliente"];
                                                    echo "<option value='$idCliente'>$nombreCliente</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row clearfix">
                                <div id="formm" style="display: none">
                                    <div class="col-md-4">
                                        <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                                <label for="tipoUser">Formato</label>
                                                <select id="idFormato" name="idFormato" form="form" onchange="getCentrotrabajo();" style="width: 100%; border: none;" >

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="idCenn" style="display: none">
                                    <div class="col-md-4">
                                        <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                                <label for="tipoUser">Centro de trabajo</label>
                                                <select id="idCentro" name="idCentro" form="form" style="width: 100%; border: none;" >

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="foto">Plantilla</label>
                                            <input id="plantillaFile" name="plantillaFile" form="form" type="file" class="form-control" required />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="demo-checkbox">
                                        <input type="hidden" form="form" name="cuentaFot" id="cuentaFot" value="0">
                                        <input type="checkbox" name="cuentaFoto" id="cuentaFoto" form="form" onclick="visualSection()" />
                                        <label for="cuentaFoto">¿Cuenta con etiquetas de foto?</label>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="botonAgregaar" style="display: none">

                                    <button class="btn bg-red waves-effect waves-light" onclick="agregarBotonazos()" >Agregar etiqueta</button>

                                </div>
                            </div>
                            <div class="row clearfix" id="sectionEtiquetas" style="display: none">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="nickUser">Nombre de la etiqueta</label>
                                            <input type="text" class="form-control" id="etiqueta0" name="etiqueta0" placeholder="Ingrese el nombre de la etiqueta" form="form"  />
                                        </div>
                                    </div>
                                </div>
                                <div id="arrayBotones">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="demo-checkbox">

                                        <input type="checkbox" name="cuentaTexto" id="cuentaTexto" form="form" onclick="visualSectionTex()" value="0" />
                                        <label for="cuentaTexto">¿Cuenta con etiquetas de formularios?</label>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="botonAgregaarTexto" style="display: none">

                                    <button class="btn bg-red waves-effect waves-light" onclick="agregarBotonazosText()" >Agregar etiqueta Texto</button>

                                </div>
                            </div>
                            <div class="row clearfix" id="sectionEtiquetasText" style="display: none">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="nickUser">Nombre de la etiqueta</label>
                                            <input type="text" class="form-control" id="etiquetaTX0" name="etiquetaTX0" placeholder="Ingrese el nombre de la etiqueta" form="form"  />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-float" style="margin-top: 13px;">
                                        <div class="form-line">
                                            <label for="nickUser">Del formulario: </label>
                                            <select id="idFormm0" name="idFormm0" form="form" onchange="getAcordeones(0)"  style="width: 100%; border: none;" >
                                                <option value="">Seleccione una opción</option>
                                                <?php
                                                foreach ($formuDb as $keyFo) {
                                                    $nombreFormulario=$keyFo["nombreFormulario"];
                                                    $idControl=$keyFo["idControl"];
                                                    echo "<option value='$idControl'>$nombreFormulario</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float" style="margin-top: 13px;">
                                        <div class="form-line">
                                            <label for="nickUser">Del acordeón: </label>
                                            <select id="idAcord0" name="idAcord0" form="form" onchange="getIndicador(0)" style="width: 100%; border: none;" >

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float" style="margin-top: 13px;">
                                        <div class="form-line">
                                            <label for="nickUser">Indicador: </label>
                                            <select id="indicad0" name="indicad0" form="form"  style="width: 100%; border: none;" >

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="arrayBotonesTexto">

                            </div>
                            <!--Etiquetas del acuse-->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="demo-checkbox">
                                        <input type="checkbox" name="cuentaAcuse" id="cuentaAcuse" form="form" onclick="visualSectionAcuse()" value="0" />
                                        <label for="cuentaAcuse">¿Cuenta con etiquetas del acuse de vísita?</label>
                                    </div>
                                </div>
                                <div class="col-sm-3" id="botonAgregaarAcuse" style="display: none">
                                    <button class="btn bg-red waves-effect waves-light" onclick="agregarBotonazosAcuse()" >Agregar etiqueta de acuse</button>
                                </div>
                            </div>
                            <div class="row clearfix" id="sectionEtiquetasAcuse" style="display: none">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label>Nombre de la etiqueta</label>
                                            <input type="text" class="form-control" id="etiquetaAcuse0" name="etiquetaAcuse0" placeholder="Ingrese el nombre de la etiqueta" form="form"  />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group form-float" style="margin-top: 13px;">
                                        <div class="form-line">
                                            <label for="nickUser">Del grupo: </label>
                                            <select id="idGrupo0" name="idGrupo0" form="form" onchange="getIndicadorAcuse(0)"  style="width: 100%; border: none;" >
                                                <option value="">Seleccione una opción</option>
                                                <?php
                                                foreach ($gruposAcuseVisita as $grupo)
                                                {
                                                    $idGrupo=$grupo["idGrupoIndicador"];
                                                    $nombreGrupo=$grupo["nombreGrupo"];
                                                    echo "<option value='$idGrupo'>$nombreGrupo</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float" style="margin-top: 13px;">
                                        <div class="form-line">
                                            <label for="nickUser">Del indicador: </label>
                                            <select id="idIndicadorAcuse0" name="idIndicadorAcuse0" form="form" style="width: 100%; border: none;" >

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="arrayBotonesAcuse">

                            </div>

                            <!--Fin de las etiquetas del acuse-->




                            <div class="row">
                                <div class="col-sm-4 col-md-offset-5">
                                    <div class="form-line">
                                        <input type="submit" form="form" class="btn bg-red waves-effect waves-light" value="Aceptar">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-offset-5" id="cargando"></div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <script type="text/javascript">
        function visualSection()
        {
            if( $('#cuentaFoto').is(':checked') ) {
                $('#botonAgregaar').show();
                $('#sectionEtiquetas').show();
                $('#cuentaFot').val(1);
            }else{
                $('#botonAgregaar').hide();
                $('#sectionEtiquetas').hide();
                $('#cuentaFot').val(1);
            }
        }
        function visualSectionTex()
        {
            if( $('#cuentaTexto').is(':checked') ) {
                $('#botonAgregaarTexto').show();
                $('#sectionEtiquetasText').show();
                $('#cuentaTexto').val(1);
                $("#arrayBotonesTexto").show();
            }else{
                $('#botonAgregaarTexto').hide();
                $('#sectionEtiquetasText').hide();
                $('#cuentaTexto').val(0);
                $("#arrayBotonesTexto").hide();
            }
        }
        function visualSectionAcuse()
        {
            if( $('#cuentaAcuse').is(':checked') ) {
                $('#botonAgregaarAcuse').show();
                $('#sectionEtiquetasAcuse').show();
                $('#cuentaAcuse').val(1);
                $("#arrayBotonesAcuse").show();
            }else{
                $('#botonAgregaarAcuse').hide();
                $('#sectionEtiquetasAcuse').hide();
                $('#cuentaAcuse').val(0);
                $("#arrayBotonesAcuse").hide();
            }
        }
        var con=1;
        var conT=1;
        var conAcuse=1;
        function agregarBotonazos()
        {

            $("#arrayBotones").append('<div id="quitar'+con+'"><div class="col-sm-3" >'+
                '<div class="form-group">'+
                '<div class="form-line">'+
                '<label for="nickUser">Nombre de la etiqueta</label>'+
                '<input type="text" class="form-control" id="etiqueta'+con+'" name="etiqueta'+con+'" placeholder="Ingrese el nombre de la etiqueta" form="form" required />'+

                '</div>'+
                '<span class="input-group-addon" style="background-color: #fff;border: 1px solid #fff;"><i class="fa fa-trash" style="cursor: pointer;" onclick="quitarEtiqueta('+con+')"></i></span>'+
                '</div>'+
                '</div></div>');
            con++;
            $("#totalCont").val(con);
        }

        function agregarBotonazosText()
        {
            $("#arrayBotonesTexto").append('<div id="quitarText'+conT+'">'+
                '<div class="row clearfix">'+
                '<div class="col-sm-3">'+
                '<div class="form-group">'+
                '<div class="form-line">'+
                '<label for="nickUser">Nombre de la etiqueta</label>'+
                '<input type="text" class="form-control" id="etiquetaTX'+conT+'" name="etiquetaTX'+conT+'" placeholder="Ingrese el nombre de la etiqueta" form="form"  />'+
                '</div>'+
                '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                '<div class="form-group form-float" style="margin-top: 13px;">'+
                '<div class="form-line">'+
                '<label for="nickUser">Del formulario: </label>'+
                '<select id="idFormm'+conT+'" name="idFormm'+conT+'" form="form" onchange="getAcordeones('+conT+')"  style="width: 100%; border: none;" >'+
                '<option value="">Seleccione una opción</option>'+

                '</select>'+
                '</div>'+
                '</div>'+
                '</div> '+
                '<div class="col-md-3">'+
                '<div class="form-group form-float" style="margin-top: 13px;">'+
                '<div class="form-line">'+
                '<label for="nickUser">Del acordeón: </label>'+
                '<select id="idAcord'+conT+'" name="idAcord'+conT+'" form="form" onchange="getIndicador('+conT+')" style="width: 100%; border: none;" >'+

                '</select>'+
                '</div>'+
                '</div>'+
                '</div> '+
                '<div class="col-md-2">'+
                '<div class="form-group form-float" style="margin-top: 13px;">'+
                '<div class="form-line">'+
                '<label for="nickUser">Indicador: </label>'+
                '<select id="indicad'+conT+'" name="indicad'+conT+'" form="form"  style="width: 100%; border: none;" >'+

                '</select>'+
                '</div>'+
                '</div>'+
                '</div> '+
                '<div class="col-md-1">'+
                '<div class="form-group form-float" style="margin-top: 13px;">'+
                '<i class="fa fa-trash" style="cursor: pointer;" onclick="quitarEtiquetaText('+conT+')"></i>  '+
                '</div>'+
                '</div> '+
                '</div>'+
                '</div>');
            getFomrularios(conT);
            conT++;

            $("#totalContText").val(conT);
        }

        function agregarBotonazosAcuse()
        {
            $("#arrayBotonesAcuse").append('<div id="quitarAcuse'+conAcuse+'">'+
                '<div class="row clearfix">'+
                '<div class="col-sm-3">'+
                '<div class="form-group">'+
                '<div class="form-line">'+
                '<label>Nombre de la etiqueta</label>'+
                '<input type="text" class="form-control" id="etiquetaAcuse'+conAcuse+'" name="etiquetaAcuse'+conAcuse+'" placeholder="Ingrese el nombre de la etiqueta" form="form"  />'+
                '</div>'+
                '</div>'+
                '</div>'+

                '<div class="col-md-3">'+
                '<div class="form-group form-float" style="margin-top: 13px;">'+
                '<div class="form-line">'+
                '<label for="nickUser">Del grupo: </label>'+
                '<select id="idGrupo'+conAcuse+'" name="idGrupo'+conAcuse+'" form="form" onchange="getIndicadorAcuse('+conAcuse+')"  style="width: 100%; border: none;" >'+
                '<option value="">Seleccione una opción</option>'+
                '</select>'+
                '</div>'+
                '</div>'+
                '</div> '+
                '<div class="col-md-3">'+
                '<div class="form-group form-float" style="margin-top: 13px;">'+
                '<div class="form-line">'+
                '<label>Del indicador: </label>'+
                '<select id="idIndicadorAcuse'+conAcuse+'" name="idIndicadorAcuse'+conAcuse+'" form="form" style="width: 100%; border: none;" >'+

                '</select>'+
                '</div>'+
                '</div>'+
                '</div> '+
                '<div class="col-md-1">'+
                '<div class="form-group form-float" style="margin-top: 13px;">'+
                '<i class="fa fa-trash" style="cursor: pointer;" onclick="quitarEtiquetaAcuse('+conAcuse+')"></i>  '+
                '</div>'+
                '</div> '+
                '</div>'+
                '</div>');
            getGruposAcuse(conAcuse);
            conAcuse++;

            $("#totalContAcuse").val(conAcuse);
        }



        function quitarEtiqueta(con)
        {
            $("#quitar"+con).html('');
        }

        function quitarEtiquetaText(conT)
        {
            $("#quitarText"+conT).html('');
        }
        function quitarEtiquetaAcuse(conT)
        {
            $("#quitarAcuse"+conT).html('');
        }

        ///

        function getAcordeones(i){
            var idFormm=$("#idFormm"+i).val();
            $("#idAcord"+i).html('');
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getCordeones/')?>" + idFormm,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {

                    $("#idAcord"+i).append('<option value ="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (ie=0; ie< data.length; ie++) {
                            $("#idAcord"+i).append(new Option(data[ie]['nombreAcordeon'],data[ie]['idAcordeon']));
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //$("#formm").hide(); //alert('Error get data from ajax');
                    $("#idAcord"+i).append('<option value ="">Seleccione una opción</option>');
                }
            });
        }
        function getIndicador(x)
        {
            var idAcord=$("#idAcord"+x).val();
            $("#indicad"+x).html('');
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getIndocador/')?>" + idAcord,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {

                    $("#indicad"+x).append('<option value ="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (ie=0; ie< data.length; ie++) {
                            $("#indicad"+x).append(new Option(data[ie]['nombreIndicador'],data[ie]['idIndicador']));
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //$("#formm").hide(); //alert('Error get data from ajax');
                    $("#indicad"+x).append('<option value ="">Seleccione una opción</option>');
                }
            });
        }

        function getFomrularios(xx)
        {
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getForm/')?>" ,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {

                    $("#idFormm"+xx).append('<option value ="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (ie=0; ie< data.length; ie++) {
                            $("#idFormm"+xx).append(new Option(data[ie]['nombreFormulario'],data[ie]['idControl']));
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //$("#formm").hide(); //alert('Error get data from ajax');
                    $("#idFormm"+xx).append('<option value ="">Seleccione una opción</option>');
                }
            });

        }
        function getGruposAcuse(contadorAcuse)
        {
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getGruposAcuse/')?>" ,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {

                    $("#idGrupo"+contadorAcuse).append('<option value="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (ie=0; ie< data.length; ie++) {
                            $("#idGrupo"+contadorAcuse).append(new Option(data[ie]['nombreGrupo'],data[ie]['idGrupoIndicador']));
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#idGrupo"+contadorAcuse).append('<option value="">Seleccione una opción</option>');
                }
            });

        }
        function getIndicadorAcuse(x)
        {
            var idGrupo=$("#idGrupo"+x).val();
            $("#idIndicadorAcuse"+x).html('');
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getIndicadorAcuse/')?>" + idGrupo,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    $("#idIndicadorAcuse"+x).append('<option value="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (ie=0; ie< data.length; ie++)
                        {
                            $("#idIndicadorAcuse"+x).append(new Option(data[ie]['nombreIndicador'],data[ie]['idIndicador']));
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#idIndicadorAcuse"+x).append('<option value ="">Seleccione una opción</option>');
                }
            });
        }


    </script>
    <div class="modal fade" id="mymodal2" role="dialog">
        <style>
            .copyFrom {
                position: absolute;
                left: -9999px;
            }
        </style>
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Etiquetas</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <div class="row col-sm-12">
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Origen</th>
                                    <th>Etiqueta</th>
                                    <th>Botón</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr><td>Fecha</td><td class="target">${fechaHoy}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Fecha</td><td class="target">${año}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Fecha</td><td class="target">${mes}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Fecha</td><td class="target">${dia}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${nombreCentroTrabajo}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${idDet}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${responsableInmueble}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${nombreAtendioVisita}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${puestoResponsable}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${telefonoResponsable}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${emailCentroTrabajo}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${calleCentroTrabajo}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${numeroInteriorCentroTrabajo}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${numeroExteriorCentroTrabajo}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${telefonoInmueble}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${correoInmueble}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${horarioFuncionamientoInicio}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${horarioFuncionamientoFin}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${horarioAtencionInicio}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${horarioAtencionFin}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${giroInmueble}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${latitud}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${longitud}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${metrosCentroTrabajo}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Centro de trabajo</td><td class="target">${tipoInmuebleCentroTrabajo}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Clientes</td><td class="target">${nombreCliente}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Clientes</td><td class="target">${emailCliente}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Formato</td><td class="target">${razonSocial}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Formato</td><td class="target">${nombreFormato}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Formato</td><td class="target">${representanteLegal}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Formato</td><td class="target">${rfc}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Formato</td><td class="target">${comentarioRFC}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Formato</td><td class="target">${domicilioFiscal}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Formato</td><td class="target">${fotoFormato}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Colonia</td><td class="target">${nombreColonia}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Colonia</td><td class="target">${codigoPostal}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Municipio</td><td class="target">${nombreMunicipio}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Estado</td><td class="target">${nombreEstado}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Analista</td><td class="target">${nombreAnalista}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Analista</td><td class="target">${direccionAnalista}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Analista</td><td class="target">${correoAnalista}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Analista</td><td class="target">${telefonoAnalista}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Analista</td><td class="target">${rfcAnalista}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Analista</td><td class="target">${curpAnalista}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Analista</td><td class="target">${telefonoOficinaAnalista}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Analista</td><td class="target">${contactoEmergenciaAnalista}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Analista</td><td class="target">${padecimientoAnalista}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Formato</td><td class="target">${domicilioFiscal}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Procedimiento de evacuación - Tabla</td><td class="target">${Procedimiento}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Procedimiento de evacuación</td><td class="target">${paso}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Procedimiento de evacuación</td><td class="target">${proceso}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Procedimiento de evacuación</td><td class="target">${equipoMaterialActual}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>
                                <tr><td>Procedimiento de evacuación</td><td class="target">${ProcedimientoBrigadistas}</td><td align="center"><button onclick="copiar(this)" class="btn bg red"><i class="fa fa-clipboard" aria-hidden="true"></i></td></tr>

                                </tbody>
                            </table>
                            <input id="centroCopiado" class="copyFrom" tabindex="-1" aria-hidden="true">

                        </div>

                    </div>
                    <script>
                        $(document).ready(function () {
                            $("table").DataTable();
                        });
                        function copiar(boton) {
                            var target=$(boton).parent().parent().children(".target")[0];
                            $("#centroCopiado").val($(target).html());

                            var copyText = document.querySelector("#centroCopiado");
                            copyText.select();
                            document.execCommand("copy")

                        }
                    </script>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
<?php
include "footer.php";
?>