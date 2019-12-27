<?php
include "header.php";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!-- DataTable -->

<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <!-- <h2>NORMAL TABLES</h2> -->
        </div>
        <div class="search-bar">
            <div class="search-icon">
                <i class="material-icons">search</i>
            </div>
            <input type="text" placeholder="Buscar...">
            <div class="close-search">
                <i class="material-icons">close</i>
            </div>
        </div>

        <div class="block-header">
            <a href="<?=site_url('menus');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header">
                                <h2>
                                    PROGRAMACIÓN DE INSPECCIONES PLANEADAS 
                                </h2>
                                
                            </div>

                        </div>
                    </div>
                    <div class="body table-responsive">
                        <table id="todosUsrs" class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Analista</th>
                                <th>Centro de trabajo</th>
                                <th></th>
                                
                            </tr>
                            </thead>
                            <tbody id="listadoVisita">
                           
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <Button onClick="descargar();">Descargar</Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    window.onload=funcionesVisita;
    var terminado=false;
    var registros=0;
    var encabezados=0;
    var numeroTotal=0;
    function funcionesVisita()
    {

        $.ajax({
            url : "https://cointic.com.mx/preveer/Cliente/index.php/CrudCronograma/getVisi/",
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                numeroTotal=data.length;
                registros=data.length;
                if (data.length>0)
                {

                    var ii=1;
                    for (i=0; i<data.length; i++)
                    {

                        $("#listadoVisita").append('<tr id="listaFech'+ii+'"><td>'+ii+'</td><td>'+data[i]['nombreUser']+'</td><td>'+data[i]['nombreUnidad']+'('+data[i]['nombre']+')</td></tr>');
                        conteFecha(ii,data[i]['idUsuario'],data[i]['idCentroTrabajo'])
                        ii++;
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            },
            complete:function()
            {


            }
        });
    }

    function conteFecha(id,idUser,idCen)
    {
        //alert(idUser + " " +idCen)
        $.ajax({
            url : "https://cointic.com.mx/preveer/Cliente/index.php/CrudCronograma/getFecha/"+idUser+"/"+idCen,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                registros--;
                var encabezadosFecha=data.length;
                if(encabezados<encabezadosFecha)
                    encabezados=encabezadosFecha;
                if (data.length>0)
                {

                    var ii=1;
                    for (i=0; i<data.length; i++)
                    {

                        var stat =data[i]['status'];
                        var colosExa="btn btn-light"
                        if (stat==1)
                        {
                            //rojo
                            colosExa="background-color:#d51414; color:#fff;";

                        }
                        if (stat==2)
                        {
                            //verde
                            colosExa="background-color:#4caf50; color: #000;";

                        }

                        if (stat==3)
                        {
                            //amarillo
                            colosExa="background-color:#ffc46c";

                        }

                        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        var f= new Date(data[i]['fechaVisita']);

                        f.setDate(f.getDate()+1);

                        var fech=f.getDate() + " de " + meses[f.getMonth()];
                        $("#listaFech"+id).append('<td style="'+colosExa+'">'+fech+'</td>');
                        ii++;


                    }
                }
                if(registros==0)
                {
                    tr = document.getElementById('todosUsrs').tHead.children[0];
                    for(i=encabezados; i>0; i--)
                    {
                        th = document.createElement('th');
                        th.innerHTML = "Fecha";
                        tr.appendChild(th);
                    }
                    for(numeroTotal; numeroTotal>0; numeroTotal--)
                    {
                        numeroTds=$("#listaFech"+numeroTotal).children('td').length-3;
                        //$("", $("td:first")).length
                        console.log(numeroTds);
                        for(numeroTds;numeroTds<encabezados; numeroTds++)
                            $("#listaFech"+numeroTotal).append("<td></td>");
                    }
                    $("#todosUsrs").DataTable();
                    $('select').addClass("form-control");
                    $('input').addClass("form-control");
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

</script>


<?php
include "footer.php";
?>