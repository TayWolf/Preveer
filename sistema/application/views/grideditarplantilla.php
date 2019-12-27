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
                url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/editarPantilla/';?>";
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
                                showCancelButton: true,
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false
                            },
                            function(){
                                location.reload();
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
                        $("#idFormato").val(IDform);
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

                        $("#idCentro").val(IDCent);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#idCenn").hide();//  alert('Error get data from ajax');
                }
            });

        }

        function getCentrotrabajoBD()
        {
            $("#idCentro").html('');
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getCentro/')?>" + IDform,
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

                        $("#idCentro").val(IDCent);
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
                                <h2> Datos registrados de la plantilla</h2>
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
                                            <input type="hidden" form="form" name="idPlantilla" id="idPlantilla" value="<?php echo $plantilla; ?>">
                                            <input type="hidden" form="form" name="totalCont" id="totalCont">
                                            <input type="hidden" form="form" name="totalContText" id="totalContText">
                                            <input type="hidden" form="form" name="totalContAcuse" id="totalContAcuse">
                                            <input type="text" form="form" class="form-control" id="nombrePlantilla" name="nombrePlantilla" placeholder="Ingrese el nombre de la plantilla"  required />
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
                                            <input id="plantillaFile" name="plantillaFile" form="form" type="file" class="form-control"  />
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2">
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
                $('#etiqueta0').val('');
                var recorreo =$("#totalCont").val();
                for (var i = 1; i < recorreo; i++) {
                    $("#quitar"+i).html('');
                }
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
            getFomrulariosCarga(conT);
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

        var IDform="";
        var IDCent="";
        window.onload=cargaDatosGrales;
        function cargaDatosGrales()
        {
            var idPlantilla=$("#idPlantilla").val();
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/obtenerDatos/')?>/" + idPlantilla,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {

                    $("#nombrePlantilla").val(data.nombrePlantilla);
                    $("#idEdo").val(data.idEstado);
                    $("#idCliente").val(data.idCliente);


                    //$("#nombrePlantilla").val(data.tieneFoto);
                    if (data.tieneFoto==1)
                    {
                        $("#cuentaFot").val('1');
                        $("#cuentaFoto").attr("checked","");
                        visualSection();
                        getTotalEtiquetas()
                    }
                    if (data.tieneFoto==0)
                    {
                        $("#cuentaFot").val('0');
                    }

                    if (data.tieneTexto==1)
                    {
                        $("#cuentaTexto").val('1');
                        $("#cuentaTexto").attr("checked","");
                        visualSectionTex();
                        getTotalEtiquetasTexto()
                    }

                    if (data.tieneAcuse==0)
                    {
                        $("#cuentaAcuse").val('0');
                    }
                    if (data.tieneAcuse==1)
                    {
                        $("#cuentaAcuse").val('1');
                        $("#cuentaAcuse").attr("checked","");
                        visualSectionAcuse();
                        getTotalEtiquetasAcuse();
                    }

                    if (data.tieneTexto==0)
                    {
                        $("#cuentaTexto").val('0');
                    }

                    if (data.idFormato!=null)
                    {
                        $("#formm").show();
                        getFormato()
                        IDform=data.idFormato;

                    }

                    if (data.idCentroTrabajo!=null)
                    {
                        $("#idCenn").show();
                        getCentrotrabajoBD()
                        IDCent=data.idCentroTrabajo;

                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
        function getTotalEtiquetas()
        {
            var idPlantilla=$("#idPlantilla").val();
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/obtenerDatosTotalesPuente/')?>/" + idPlantilla,
                type: "GET",
                dataType: "json",
                success: function(data)
                {
                    if (data.total==1)
                    {
                        pintarEtiquetas();
                    }

                    for (i = con; i < data.total; i++) {

                        $("#arrayBotones").append('<div id="quitar'+i+'"><div class="col-sm-3" >'+
                            '<div class="form-group">'+
                            '<div class="form-line">'+
                            '<label for="nickUser">Nombre de la etiqueta</label>'+
                            '<input type="text" class="form-control" id="etiqueta'+i+'" name="etiqueta'+i+'" placeholder="Ingrese el nombre de la etiqueta" form="form" required />'+

                            '</div>'+
                            '<span class="input-group-addon" style="background-color: #fff;border: 1px solid #fff;"><i class="fa fa-trash" style="cursor: pointer;" onclick="quitarEtiqueta('+i+')"></i></span>'+
                            '</div>'+
                            '</div></div>');
                        con++;
                        pintarEtiquetas()
                    }
                    $("#totalCont").val(data.total);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        ///
        function getTotalEtiquetasTexto()
        {
            var idPlantilla=$("#idPlantilla").val();
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/obtenerDatosTotalesPuenteText/')?>/" + idPlantilla,
                type: "GET",
                dataType: "json",
                success: function(data)
                {
                    if (data.total==1)
                    {
                        getFomrularios(0);
                    }

                    for (i = conT; i < data.total; i++) {

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
                        conT++;

                        getFomrularios(i);

                        // getIndicador(i);


                    }
                    $("#totalContText").val(data.total);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function getTotalEtiquetasAcuse()
        {
            var idPlantilla=$("#idPlantilla").val();
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/obtenerDatosPlantillaAcuse/')?>/" + idPlantilla,
                type: "GET",
                dataType: "json",
                success: function(data)
                {
                    if (data.total==1)
                    {
                        getGruposAcuse(0);
                    }

                    for (i = conAcuse; i < data.total; i++) {

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
                            '<select id="idGrupo'+conAcuse+'" name="idGrupo'+conAcuse+'" form="form" onchange="getIndicadorAcuse('+conAcuse+')" style="width: 100%; border: none;" >'+
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
                        conAcuse++;

                        getAcusesCarga(i);

                    }
                    $("#totalContAcuse").val(data.total);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }



        function pintarEtiquetas()
        {
            var idPlantilla=$("#idPlantilla").val();
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/obtenerEtiquetasValores/')?>/" + idPlantilla,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    if (data.length>0)
                    {
                        for (x=0; x< data.length; x++) {
                            //alert("d")
                            $("#etiqueta"+x).val(data[x]['nombreEtiqueta']);
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

        }

        function pintarEtiquetasText(xxi)
        {
            var idPlantilla=$("#idPlantilla").val();
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/obtenerEtiquetasValoresText/')?>/" + idPlantilla,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    if (data.length>0)
                    {
                        for (x=0; x< data.length; x++) {


                            $("#etiquetaTX"+x).val(data[x]['nombreEtiqueta']);
                            $("#idFormm"+x).val(data[x]['idFormulario']);

                            //$("#idAcord"+x).val(data[x]['idAcordeon']);
                            //$("#indicad"+x).val(data[x]['idIndicador']);

                            getAcordeones(x,data[x]['idAcordeon'],data[x]['idIndicador']);
                        }

                    }
                },

                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

        }
        function pintarEtiquetasAcuse(xxi)
        {
            var idPlantilla=$("#idPlantilla").val();
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/obtenerEtiquetasValoresAcuse/')?>/" + idPlantilla,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    if (data.length>0)
                    {
                        for (x=0; x< data.length; x++) {


                            $("#etiquetaAcuse"+x).val(data[x]['nombreEtiqueta']);
                            $("#idGrupo"+x).val(data[x]['idGrupo']);
                            getIndicadorAcuseCarga(x,data[x]['idIndicadorAcuse']);
                        }

                    }
                },

                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });

        }




        function getAcordeones(i,idA,idI){
            var idFormm=$("#idFormm"+i).val();

            $("#idAcord"+i).html('');
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getCordeones/')?>" + idFormm,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    $("#idAcord"+i).html('');
                    $("#idAcord"+i).append('<option value ="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (ie=0; ie< data.length; ie++) {
                            $("#idAcord"+i).append(new Option(data[ie]['nombreAcordeon'],data[ie]['idAcordeon']));
                        }
                        if (idA)
                        {
                            $("#idAcord"+i).val(idA)
                            getIndicador(i,idI)
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

        function getIndicadorAcuseCarga(i,indicadorAcuse)
        {
            var idFormm=$("#idGrupo"+i).val();

            $("#idIndicadorAcuse"+i).html('');
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getIndicadorAcuse/')?>" + idFormm,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    $("#idIndicadorAcuse"+i).html('');
                    $("#idIndicadorAcuse"+i).append('<option value="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (ie=0; ie< data.length; ie++) {
                            $("#idIndicadorAcuse"+i).append(new Option(data[ie]['nombreIndicador'],data[ie]['idIndicador']));
                        }
                        if (indicadorAcuse)
                        {
                            $("#idIndicadorAcuse"+i).val(indicadorAcuse);
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#idIndicadorAcuse"+i).append('<option value ="">Seleccione una opción</option>');
                }
            });
        }


        function getIndicador(x,idI)
        {
            var idAcord=$("#idAcord"+x).val();
            $("#indicad"+x).html('');
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getIndocador/')?>" + idAcord,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {
                    $("#indicad"+x).html('');
                    $("#indicad"+x).append('<option value ="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (ie=0; ie< data.length; ie++) {
                            $("#indicad"+x).append(new Option(data[ie]['nombreIndicador'],data[ie]['idIndicador']));
                        }
                        if (idI)
                        {
                            $("#indicad"+x).val(idI);
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

                },complete:function(){
                    pintarEtiquetasText(xx)
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    //$("#formm").hide(); //alert('Error get data from ajax');
                    $("#idFormm"+xx).append('<option value ="">Seleccione una opción</option>');
                }
            });

        }
        function getFomrulariosCarga(xx){
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

        function getAcusesCarga(xx)
        {
            $.ajax({
                url : "<?php echo site_url('CrudPlantillas/getGruposAcuse/')?>" ,
                type: "post",
                dataType: "JSON",
                success: function(data)
                {

                    $("#idGrupo"+xx).append('<option value="">Seleccione una opción</option>');
                    if (data.length>0)
                    {
                        for (ie=0; ie< data.length; ie++) {
                            $("#idGrupo"+xx).append(new Option(data[ie]['nombreGrupo'],data[ie]['idGrupoIndicador']));
                        }
                    }

                },complete:function(){
                    pintarEtiquetasAcuse(xx)
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#idGrupo"+xx).append('<option value ="">Seleccione una opción</option>');
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