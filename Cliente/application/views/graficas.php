<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <link href="<?=base_url('assets/morris/morris.css')?>" rel="stylesheet" type="text/css">
  <script src="<?=base_url('assets/morris/morris.min.js')?>"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <title>Graficas</title>
  <?php $idUsuarioBase=$this->session->userdata('idCliente'); ?>
    <script type="text/javascript">
        window.onload=geDEdo;
        function geDEdo()
             {
                    $("#EdoD").html("");
                  $.ajax({
                        url : "<?php echo site_url('Menus/getEdos/')?>",
                        type: "post",
                        dataType: "json",
                        success: function(data)
                        {
                            
                           // $("#idPac").append('<option value ="">Seleccione una Pagadora</option>');
                            if (data.length>0)
                             {
                                for (i=0; i< data.length; i++) { 
                                  $("#EdoD").append(data[i]['nombreEstado']+'</br>');
                                }   
                             }
                             getCentros();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });
             }
function getCentros()
{
    $("#centD").html("");
    $.ajax({
                        url : "<?php echo site_url('Menus/getCentros/')?>",
                        type: "post",
                        dataType: "json",
                        success: function(data)
                        {
                            //alert(data)
                           // $("#idPac").append('<option value ="">Seleccione una Pagadora</option>');
                            if (data.length>0)
                             {
                                for (i=0; i< data.length; i++) { 
                                  //fecha
                                   var x = data[i]['fechaSolicitud'];
                                    let date = new Date(x);
                                    let options = {
                                      //weekday: 'long',
                                      year: 'numeric',
                                      month: 'long'
                                      //day: 'numeric'
                                    };
                                    //alert(date.toLocaleDateString('es-MX', options))
                                  //fin fecha

                                  $("#centD").append(data[i]['idCentroTrabajo']+' - '+data[i]['nombre']+' oti '+data[i]['idOti']+'Mes '+date.toLocaleDateString('es-MX', options)+'  normas: <p id="normas'+data[i]['idCentroTrabajo']+'"></p>'+'</br>');
                                  getNormasCentro(data[i]['idCentroTrabajo'])
                                }   
                             }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });
}

function getNormasCentro(idCen)
{
  // alert(idCen)
    $.ajax({
                        url : "<?php echo site_url('Menus/getNormar/')?>"+idCen,
                        type: "post",
                        dataType: "json",
                        success: function(data)
                        {
                            //alert(data)
                           // $("#idPac").append('<option value ="">Seleccione una Pagadora</option>');
                            if (data.length>0)
                             {
                                for (i=0; i< data.length; i++) { 
                                  $("#normas"+idCen).append(' '+data[i]['nombre']+' <strong id="porcentaj'+data[i]['idSubservicio']+"-"+idCen+'"></strong></br>');
                                  porcentajeDatos(data[i]['idSubservicio'],idCen)
                                }   
                             }
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error get data from ajax');
                        }
                    });
}

function porcentajeDatos(idSub,idCen)
{
  $.ajax({
        url : "<?php echo site_url('Menus/getPorcen/')?>"+idSub+"/"+idCen,
        type: "post",
        dataType: "json",
        success: function(data)
            {
                if (data.length>0)
                    {
                        for (i=0; i< data.length; i++) { 
                            $("#porcentaj"+idSub+"-"+idCen).append(data[i]['porcentajeValor']+" %");
                        }   
                    }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                 alert('Error get data from ajax');
            }
        });  
}
    </script>
</head>
<body>
  <div class="container">
    <h1>Graficas</h1>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <h2>graficas de linea</h2>
        <hr>
        <div id="myfirstchart"></div>
      </div>
      <div class="col-md-6">
        <h2>graficas de área</h2>
        <hr>
      </div>
    </div>
    <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Datos</h2>
                            <button onclick="diferenciadorFe();">clikc</button>
                        </div>
                        <div class="body">
                            estados <p id="EdoD"></p><br>
                            Centros de trabajo  <p id="centD"></p><br>
                           
                        </div>
                    </div>
                </div>
            </div>
  </div>
</body>
<script type="text/javascript">
  function diferenciadorFe()
  {
     f1 = "2007/02/03";
  f2 = "2007/06/04";
  
  aF1 = f1.split("/");
  aF2 = f2.split("/");
  
  numMeses = aF2[0]*12 + aF2[1] - (aF1[0]*12 + aF1[1]);
  if (aF2[2]<aF1[2]){
    numMeses = numMeses - 1;
  }
  alert(numMeses);
  }
</script>
<script type="text/javascript">
  new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 5 },
    { year: '2011', value: 5 },
    { year: '2012', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
</script>
</html>