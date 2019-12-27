<?php $idUsuarioBase=$this->session->userdata('idCliente'); ?>
<style>
    html, body{
        height: 100%;
    }
</style>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <link href="<?=base_url('assets/morris/morris.css')?>" rel="stylesheet" type="text/css">
  <script src="<?=base_url('assets/morris/morris.min.js')?>"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<div class="col-xs-12">

    <section class="content h-100">
            <div class="container-fluid h-100">
                <div class="block-header">
                    <h2>
                        Reportes de seguimiento para <?=$nombreCliente["nombreCliente"]?>
                    </h2>
                </div>
                <div class="row clearfix">
                    <div class="col-xs-12 ">
                        <div class="card">
                            <div class="header">
                                <h2>Busqueda</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                                <label for="tipoUser">Estado</label>
                                                <select id="estadoI" name="estadoI" onchange="obtenerMunicipios()" style="width: 100%; border: none;" required>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                                <label for="tipoUser">Municipio</label>
                                                <select id="municipio" name="municipio" onchange="getCentros();" style="width: 100%; border: none;" required>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group form-float" style="margin-top: 13px;">
                                            <div class="form-line">
                                                <label for="tipoUser">Centro de Trabajo</label>
                                                <select id="cTrabajo" name="cTrabajo" onchange="getNormasCentro()" style="width: 100%; border: none;" required>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 h-100" align="center">
                                        <button style="width: 100%" class="btn-danger" onclick="window.location.href='Crudnormasgrales/normasGrales';">Normas</button>
                                    </div>
                                    <div class="col-lg-2 h-100" align="center">
                                        <button style="width: 100%" class="btn-danger" onclick="window.location.href='Crudnormasgrales/normasPorCentroGeneral';">Normas por centro</button>
                                    </div>
                                    <div class="col-lg-2 h-100" align="center">
                                        <button style="width: 100%" class="btn-danger" onclick="window.location.href='Crudnormasgrales/bitacorasGrales';">Bitácoras</button>
                                    </div>
                                    <div class="col-lg-2 h-100" align="center">
                                        <button style="width: 100%" class="btn-danger" onclick="window.location.href='Crudfichasgrales/fichascentroGrales';">Fichas por centro</button>
                                    </div>
                                    <div class="col-lg-2 h-100" align="center">
                                        <button style="width: 100%" class="btn-danger" onclick="window.location.href='CrudOportunidadMejora/oportunidades';">Oportunidades de mejora</button>
                                    </div>
                                    <div class="col-lg-2 h-100" align="center">
                                        <button style="width: 100%" class="btn-danger" onclick="window.location.href='CrudCronograma/';">Cronograma</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-xs-12" >
                        <div class="card">
                            <div class="header">
                                <h2>Cumplimiento por normativa</h2>
                            </div>
                            <div class="body" >
                                <div class="row">
                                    <div class="col-sm-offset-2 col-sm-8" id="graficaTr">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-xs-12 col-md-6 col-lg-6" >
                        <div class="card">
                            <div class="header">
                                <h2>Cumplimiento de las normativas a través del tiempo</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nombreUser">Periodo Inicial</label>
                                                <input type="date" class="form-control" id="pInicial" name="pInicial" onchange="filtrar()" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nombreUser">Periodo Final</label>
                                                <input type="date" class="form-control" id="pFinal" name="pFinal" onchange="filtrar()"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" id="graficaTiempo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 col-lg-6" >
                        <div class="card">
                            <div class="header">
                                <h2>Horas trabajadas por los analistas</h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nombreUser">Periodo Inicial</label>
                                                <input type="date" class="form-control" id="pInicialHora" name="pInicialHora" onchange="filtrarHora()" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="nombreUser">Periodo Final</label>
                                                <input type="date" class="form-control" id="pFinalHora" name="pFinalHora" onchange="filtrarHora()"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" id="graficaHorasTrabajadas">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </section>

</div>
<script type="text/javascript">
    window.onload=geDEdo;
    function geDEdo()
    {
        $("#estadoI").html("");
        $.ajax({
            url : "<?php echo site_url('Menus/getEdos/')?>",
            type: "post",
            dataType: "json",
            success: function(data)
            {

                //$("#estadoI").append('<option value ="">Seleccione estado</option>');
                $("#estadoI").append('<option value ="">Todos</option>');
                if (data.length>0)
                {
                    for (i=0; i< data.length; i++) {
                        $("#estadoI").append(new Option(data[i]['nombreEstado'],data[i]['id_Estado']));
                    }
                }
                //getCentros();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }, complete: function () {
                getGraficasNacionales();
            }
        });
    }
    function limpiarCanvas()
    {
        $("#popChart").remove();
        $("#grafica1").remove();
        $("#graficaHoras").remove();
        $("#graficaTr").append("<canvas id=\"popChart\" ></canvas>");
        $("#graficaTiempo").append("<canvas id=\"grafica1\" ></canvas>");
        $("#graficaHorasTrabajadas").append("<canvas id=\"graficaHoras\" ></canvas>");
        $("#pInicial").val("");
        $("#pFinal").val("");
        $("#pInicialHora").val("");
        $("#pFinalHora").val("");
    }
    function limpiarCanvasTiempo()
    {
        console.log("Limpiando el canvas de normativas a través del tiempo...")
        $("#grafica1").remove();
        $("#graficaTiempo").append("<canvas id=\"grafica1\" ></canvas>");
    }
    function limpiarCanvasHora()
    {
        console.log("Limpiando el canvas de horas trabajadas...")
        $("#graficaHoras").remove();
        $("#graficaHorasTrabajadas").append("<canvas id=\"graficaHoras\" ></canvas>");
    }
    function getGraficasNacionales()
    {
        limpiarCanvas();
        $.ajax({
            url: '<?=site_url('Menus/getGraficasNacionales/')?>',
            type: 'POST',
            dataType: 'JSON',
            success: function (response)
            {
                if(response)
                {
                    crearGrafica(response, $("#popChart"), 0);
                }
            }
        });
        $.ajax({
            url: '<?=site_url('Menus/getGraficasNacionalesHora/')?>',
            type: 'POST',
            dataType: 'JSON',
            success: function (response)
            {
                if(response)
                {
                    console.table(response[0].data)
                    crearGraficaHoras(response, $("#graficaHoras"), 0);
                }
            }
        });
        $.ajax({
            url: '<?=site_url('Menus/getGraficasNacionalesTiempo/')?>',
            type: 'POST',
            dataType: 'JSON',
            success: function (response)
            {
                if(response)
                {

                    var name = [];
                    var marks = [];
                    for(k=0; k<response.length; k++)
                    {
                        data = response[k];
                        console.table(data);
                        if(data.length>0)
                        {
                            var porcentajeFinal = 0;
                            var tamano=parseFloat(data.length);
                            for (j = 0; j < tamano; j++)
                            {
                                if (data[j]['porcentajeValor']!=null)
                                    porcentajeFinal += parseFloat(data[j]['porcentajeValor']);

                            }


                            name.push(data[0].nombreNorma);
                            console.log(porcentajeFinal+" - "+tamano);
                            marks.push(porcentajeFinal / tamano);
                        }
                    }

                    var chartdata =
                        {
                            labels: name,
                            datasets: [
                                {
                                    label: 'Cumplimiento general de las normas en el tiempo',
                                    backgroundColor: '#49e2ff',
                                    borderColor: '#46d5f1',
                                    hoverBackgroundColor: '#CCCCCC',
                                    hoverBorderColor: '#666666',
                                    data: marks
                                }
                            ]
                        };
                    var graphTarget = $("#grafica1");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        suggestedMin: 0,
                                        suggestedMax: 100
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        autoSkip: false,
                                        maxRotation: 60,
                                        minRotation: 60
                                    }
                                }]
                            }
                        }

                    });
                }
            }
        });

    }
    function getCentros()
    {
        $("#cTrabajo").empty();
        var estadoI=$("#estadoI").val();
        var municipio=$("#municipio").val();
        limpiarCanvas();
        //SI TODOS ESTA SELECCIONADO: MANDA A TRAER EL PORCENTAJE GLOBAL POR ESTADO
        if(!municipio)
        {
            $.ajax({
                url: '<?=site_url('Menus/getGraficasEstado/')?>'+estadoI,
                type: 'POST',
                dataType: 'JSON',
                success: function (response)
                {

                    if(response)
                    {
                        crearGrafica(response,$("#popChart"), 0);
                    }
                }
            });
            $.ajax({
                url: '<?=site_url('Menus/getGraficasEstatalesHora/')?>'+estadoI,
                type: 'POST',
                dataType: 'JSON',
                success: function (response)
                {

                    if(response)
                    {
                        crearGraficaHoras(response,$("#graficaHoras"), 0);
                    }
                }
            });
            $.ajax({
                url: '<?=site_url('Menus/getGraficasEstadoTiempo/')?>'+estadoI,
                type: 'POST',
                dataType: 'JSON',
                success: function (response)
                {
                    if(response)
                    {

                        var name = [];
                        var marks = [];
                        for(k=0; k<response.length; k++)
                        {
                            data = response[k];
                            console.table(data);
                            if(data.length>0)
                            {
                                var porcentajeFinal = 0;
                                var tamano=parseFloat(data.length);
                                for (j = 0; j < tamano; j++)
                                    if (data[j]['porcentajeValor']!=null)
                                        porcentajeFinal += parseFloat(data[j]['porcentajeValor']);

                                name.push(data[0].nombreNorma);
                                console.log(porcentajeFinal+" - "+tamano);
                                marks.push(porcentajeFinal / tamano);
                            }
                        }

                        var chartdata =
                            {
                                labels: name,
                                datasets: [
                                    {
                                        label: 'Cumplimiento general de las normas en el tiempo',
                                        backgroundColor: '#49e2ff',
                                        borderColor: '#46d5f1',
                                        hoverBackgroundColor: '#CCCCCC',
                                        hoverBorderColor: '#666666',
                                        data: marks
                                    }
                                ]
                            };
                        var graphTarget = $("#grafica1");

                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata,
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            suggestedMin: 0,
                                            suggestedMax: 100
                                        }
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            autoSkip: false,
                                            maxRotation: 60,
                                            minRotation: 60
                                        }
                                    }]
                                }
                            }

                        });
                    }
                }
            });

        }
        else
        {
            $("#cTrabajo").html("");
            $.ajax({
                url: "<?php echo site_url('Menus/getCentros/')?>" + estadoI + "/" + municipio,
                type: "post",
                dataType: "json",
                success: function (data) {
                    //alert(data)
                    $("#cTrabajo").append('<option value ="">Todos</option>');
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            // $("#cTrabajo").append(data[i]['idCentroTrabajo']+' - '+data[i]['nombre']+' oti '+data[i]['idOti']+' normas: <p id="normas'+data[i]['idCentroTrabajo']+'"></p>'+'</br>');
                            $("#cTrabajo").append(new Option(data[i]['nombre'], data[i]['idCentroTrabajo']));

                            //getNormasCentro(data[i]['idCentroTrabajo'])
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    getGraficasNacionales();
                }
            });
            $.ajax({
                url: '<?=site_url('Menus/getGraficasMunicipio/')?>'+municipio,
                type: 'POST',
                dataType: 'JSON',
                success: function (response)
                {

                    if(response)
                    {
                        crearGrafica(response, $("#popChart"), 0);
                    }
                }
            });

            $.ajax({
                url: '<?=site_url('Menus/getGraficasMunicipalesHora/')?>'+municipio,
                type: 'POST',
                dataType: 'JSON',
                success: function (response)
                {

                    if(response)
                    {
                        crearGraficaHoras(response,$("#graficaHoras"), 0);
                    }
                }
            });
            $.ajax({
                url: '<?=site_url('Menus/getGraficasMunicipioTiempo/')?>'+municipio,
                type: 'POST',
                dataType: 'JSON',
                success: function (response)
                {
                    if(response)
                    {

                        var name = [];
                        var marks = [];
                        for(k=0; k<response.length; k++)
                        {
                            data = response[k];
                            console.table(data);
                            if(data.length>0)
                            {
                                var porcentajeFinal = 0;
                                var tamano=parseFloat(data.length);
                                for (j = 0; j < tamano; j++)
                                    if (data[j]['porcentajeValor']!=null)
                                        porcentajeFinal += parseFloat(data[j]['porcentajeValor']);

                                name.push(data[0].nombreNorma);
                                console.log(porcentajeFinal+" - "+tamano);
                                marks.push(porcentajeFinal / tamano);
                            }
                        }

                        var chartdata =
                            {
                                labels: name,
                                datasets: [
                                    {
                                        label: 'Cumplimiento general de las normas en el tiempo',
                                        backgroundColor: '#49e2ff',
                                        borderColor: '#46d5f1',
                                        hoverBackgroundColor: '#CCCCCC',
                                        hoverBorderColor: '#666666',
                                        data: marks
                                    }
                                ]
                            };
                        var graphTarget = $("#grafica1");

                        var barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata,
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            suggestedMin: 0,
                                            suggestedMax: 100
                                        }
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            autoSkip: false,
                                            maxRotation: 60,
                                            minRotation: 60
                                        }
                                    }]
                                }
                            }

                        });




                    }
                }
            });
        }
    }


</script>

<script type="text/javascript">
    //CODIGO QUE MANDA A TRAER TODOS LOS MUNICIPIOS
    function obtenerMunicipios()
    {

        var idEstado=$("#estadoI").val();
        if(!idEstado)
        {
            getGraficasNacionales();
        }
        else {
            $.ajax({
                url: "<?php echo site_url('Menus/obtenerMunicipios')?>/" + idEstado,
                type: "get",
                dataType: "json",
                success: function (data) {
                    $("#municipio").empty();
                    $("#municipio").append('<option value ="">Todos</option>');
                    for (var i = 0; i < data.length; i++) {
                        $("#municipio").append(new Option(data[i]['nombreMunicipio'], data[i]['idMunicipio']))
                    }
                    getCentros();
                }
            });
            $.ajax({
                url: '<?=site_url('Menus/getGraficasEstado/')?>'+idEstado,
                type: 'POST',
                dataType: 'JSON',
                success: function (response)
                {
                    limpiarCanvas();

                    if(response)
                    {
                        crearGrafica(response, $("#popChart"), 0);
                    }
                }
            });
        }

    }


    //CODIGO PARA TRAER LAS GRAFICAS DEL CENTRO DE TRABAJO
    function getNormasCentro()
    {
        limpiarCanvas();
        var idCen=$("#cTrabajo").val();
        if(!idCen)
        {
            getCentros();
            return;
        }
        $("#graph").html("");
        $.ajax({
            url : "<?php echo site_url('Menus/getNormarArreglo/')?>"+idCen,
            type: "post",
            dataType: "JSON",
            success: function(data)
            {

                if (data.length>0)
                {
                    var name = [];
                    var marks = [];
                    for (var i in data) {
                        name.push(data[i].nombreNorma);
                        marks.push(data[i].porcentajeValor);
                    }
                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Cumplimiento por normativa',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                fill: false,
                                data: marks
                            }
                        ]
                    };
                    var graphTarget = $("#popChart");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        suggestedMin: 0,
                                        suggestedMax: 100
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        autoSkip: false,
                                        maxRotation: 80,
                                        minRotation: 80
                                    }
                                }]
                            }
                        }
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                getCentros();
            }
        });
        $.ajax({
            url: '<?=site_url('Menus/getGraficasCentroTrabajoHora/')?>'+idCen,
            type: 'POST',
            dataType: 'JSON',
            success: function (response)
            {

                if(response)
                {
                    crearGraficaHoras(response,$("#graficaHoras"), 0);
                }
            }
        });
        $.ajax({
            url : "<?php echo site_url('Menus/getNormarArregloTiempo/')?>"+idCen,
            type: "post",
            dataType: "JSON",
            success: function(response)
            {
                console.table(response);
                var name = [];
                var marks = [];
                for(k=0; k<response.length; k++)
                {
                    data = response[k];
                    if(data.length>0)
                    {
                        var porcentajeFinal = 0;
                        var tamano=parseFloat(data.length);
                        for (j = 0; j < tamano; j++)
                            if (data[j]['porcentajeValor']!=null)
                                porcentajeFinal += parseFloat(data[j]['porcentajeValor']);

                        name.push(data[0].nombreNorma);
                        marks.push(porcentajeFinal / tamano);
                    }
                }

                var chartdata =
                    {
                        labels: name,
                        datasets: [
                            {
                                label: 'Cumplimiento general de las normas en el tiempo',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };
                var graphTarget = $("#grafica1");

                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMin: 0,
                                    suggestedMax: 100
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 60,
                                    minRotation: 60
                                }
                            }]
                        }
                    }

                });

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                getCentros();
            }
        });
    }
    function crearGrafica(response, elemento, numeroGrafica)
    {
        var name = [];
        var marks = [];
        data=response[numeroGrafica]['data'];
        for (var i in data)
        {

            if(data[i].nombreNorma!=null) {
                name.push(data[i].nombreNorma.split("\n"));
                marks.push(Math.round(data[i].porcentajeValor * 100) / 100);
            }
        }
        var chartdata = {
            labels: name,
            datasets: [
                {
                    label: response[numeroGrafica]['label'],
                    backgroundColor: '#49e2ff',
                    borderColor: '#46d5f1',
                    hoverBackgroundColor: '#CCCCCC',
                    hoverBorderColor: '#666666',
                    data: marks
                }
            ]
        };
        var graphTarget = elemento;

        var barGraph = new Chart(graphTarget, {
            type: 'line',
            data: chartdata,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 100
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 80,
                            minRotation: 80
                        }
                    }]
                }
            }

        });
    }
    function crearGraficaHoras(response, elemento, numeroGrafica)
    {
        var name = [];
        var marks = [];
        var oportunidades=[];
        var valorFinal, valorOportunidadMejoraFinal;
        data=response[0]['data'];
        for (var i in data)
        {
            name.push(data[i].fechaVisita.split("\n"));
            valorFinal=0;
            valorOportunidadMejoraFinal=0;
            if(data[i].valor1)
            {
                valorFinal+=parseFloat(data[i].valor1);
                //Divide entre 3 horas que ya tiene el valor 1, y la multiplica por 2 horas
                valorOportunidadMejoraFinal+=(parseFloat(data[i].valor1)/3)*2;
            }
            if(data[i].valor2)
                valorFinal+=parseFloat(data[i].valor2);
            marks.push(valorFinal);
            oportunidades.push(valorOportunidadMejoraFinal);




        }
        var chartdata =
            {
                labels: name,
                datasets: [
                    {
                        label: 'Horas trabajadas por los analistas',
                        backgroundColor: '#49e2ff',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: marks
                    },
                    {
                        label: 'Horas de oportunidades de mejora',
                        backgroundColor: '#ffe249',
                        borderColor: '#f1d546',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: oportunidades
                    }
                ]
            };


        var graphTarget = elemento;

        var barGraph = new Chart(graphTarget, {
            type: 'bar',
            data: chartdata,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 0
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }]
                }
            }

        });
    }


    function filtrar()
    {
        var periodoInicial = $("#pInicial").val();
        var periodoFinal = $("#pFinal").val();
        var centroSeleccionado = $("#cTrabajo").val();
        var municipioSeleccionado = $("#municipio").val();
        var estadoSeleccionado = $("#estadoI").val();
        var liga = ""
        if (centroSeleccionado)
            liga = "<?=site_url('Menus/getNormarArregloTiempo/')?>" + centroSeleccionado;
        else if (municipioSeleccionado)

            liga = "<?=site_url('Menus/getGraficasMunicipioTiempo/')?>" + municipioSeleccionado;
        else if (estadoSeleccionado)
            liga = "<?=site_url('Menus/getGraficasEstadoTiempo/')?>" + estadoSeleccionado;

        else
            liga = "<?=site_url('Menus/getGraficasNacionalesTiempo')?>";
        if (periodoInicial && periodoFinal)
            liga += "/" + periodoInicial + "/" + periodoFinal;
        else if (periodoInicial)
            liga += "/" + periodoInicial + "/";
        else if (periodoFinal)
            liga += "/1000-01-01/" + periodoFinal;
        console.log(liga);
        limpiarCanvasTiempo();
        $.ajax({
            url: liga,
            type: "post",
            dataType: "JSON",
            success: function (response)
            {
                console.table(response);
                var name = [];
                var marks = [];
                for (k = 0; k < response.length; k++)
                {
                    data = response[k];
                    if (data.length > 0)
                    {
                        var porcentajeFinal = 0;
                        var tamano = parseFloat(data.length);
                        for (j = 0; j < tamano; j++)
                            if (data[j]['porcentajeValor']!=null)
                                porcentajeFinal += parseFloat(data[j]['porcentajeValor']);

                        name.push(data[0].nombreNorma);
                        marks.push(porcentajeFinal / tamano);
                        console.log(porcentajeFinal+" - "+tamano);
                    }
                }

                var chartdata =
                    {
                        labels: name,
                        datasets: [
                            {
                                label: 'Cumplimiento general de las normas en el tiempo',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };
                var graphTarget = $("#grafica1");

                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMin: 0,
                                    suggestedMax: 100
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 60,
                                    minRotation: 60
                                }
                            }]
                        }
                    }

                });

            }
        });
    }
    function filtrarHora()
    {
        var periodoInicial = $("#pInicialHora").val();
        var periodoFinal = $("#pFinalHora").val();
        var centroSeleccionado = $("#cTrabajo").val();
        var municipioSeleccionado = $("#municipio").val();
        var estadoSeleccionado = $("#estadoI").val();
        var liga = ""
        if (centroSeleccionado)
            liga = "<?=site_url('Menus/getGraficasCentroTrabajoHora/')?>" + centroSeleccionado;
        else if (municipioSeleccionado)

            liga = "<?=site_url('Menus/getGraficasMunicipalesHora/')?>" + municipioSeleccionado;
        else if (estadoSeleccionado)
            liga = "<?=site_url('Menus/getGraficasEstatalesHora/')?>" + estadoSeleccionado;

        else
            liga = "<?=site_url('Menus/getGraficasNacionalesHora')?>";
        if (periodoInicial && periodoFinal)
            liga += "/" + periodoInicial + "/" + periodoFinal;
        else if (periodoInicial)
            liga += "/" + periodoInicial + "/";
        else if (periodoFinal)
            liga += "/1000-01-01/" + periodoFinal;
        console.log(liga);
        limpiarCanvasHora();
        $.ajax({
            url: liga,
            type: "post",
            dataType: "JSON",
            success: function (response)
            {

                var name = [];
                var marks = [];
                var oportunidades=[];
                var valorFinal, valorOportunidadMejoraFinal;
                data=response[0]['data'];
                for (var i in data)
                {
                    name.push(data[i].fechaVisita.split("\n"));
                    valorFinal=0;
                    valorOportunidadMejoraFinal=0;
                    if(data[i].valor1)
                    {
                        valorFinal+=parseFloat(data[i].valor1);
                        //Divide entre 3 horas que ya tiene el valor 1, y la multiplica por 2 horas

                        valorOportunidadMejoraFinal+=(parseFloat(data[i].valor1)/3)*2;
                    }
                    if(data[i].valor2)
                        valorFinal+=parseFloat(data[i].valor2);
                    marks.push(valorFinal);
                    oportunidades.push(valorOportunidadMejoraFinal);




                }
                var chartdata =
                    {
                        labels: name,
                        datasets: [
                            {
                                label: 'Horas trabajadas por los analistas',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            },
                            {
                                label: 'Horas de oportunidades de mejora',
                                backgroundColor: '#ffe249',
                                borderColor: '#f1d546',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: oportunidades
                            }
                        ]
                    };
                var graphTarget = $("#graficaHoras");

                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMin: 0
                                }
                            }],
                            xAxes: [{
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 45,
                                    minRotation: 45
                                }
                            }]
                        }
                    }

                });

            }
        });
    }
</script>
