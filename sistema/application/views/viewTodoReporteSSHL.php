<?php
include "header.php";
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

    

    <style>
        .listaDesordenada{display:table; width:100%; padding:10px;}
        .itemListaDesordenada {display:table-row; }
        .itemListaDesordenada span{display:table-cell; text-align:left;
        .third{
            margin-left: 20px;
            margin-right: 20px;
        }
        }
    </style>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <?php $tipo=$this->session->userdata('tipoUser');
                if($tipo!='' && $_SESSION['idusuariobase'] != '')
                {
                    if($tipo == 1){
                        echo "<a href='".site_url('Reportes')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    } elseif($tipo == 2){
                        echo "<a href='".site_url('menus')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    }
                }

                ?>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Fichas SSHI

                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">assignment</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudReporteSSHL/formAltaReporte">Registrar Ficha SSHI</a>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tabla-reportes">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fichas SSHI</th>
                                    <th>Modificar</th>
                                    <th>Apartados</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conte=1;

                                foreach ($listaReporte as $row) {
                                    $idReporte=$row["idReporte"];
                                    $nombreReportes=$row["nombreReportes"];

                                    echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$nombreReportes</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudReporteSSHL/formEditarReporte/$idReporte'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                  <td>
                                                    <a href='#' onclick='mostrarModalApartadosReporte($idReporte)'><i class='fa fa-sitemap'></i></a>
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteReporte($idReporte);'><i class='fa fa-trash'></i></a></td>
                                            </tr>";
                                    $conte++;
                                }
                                ?>
                                </tbody>
                            </table>
                            <div align="center">
                                <div>
                                    <nav>
                                        <?php echo $page; ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalApartados">
        <div class="modal-dialog modal-lg">
            <div class="col-sm-12">
                <div class="modal-content">
                    <form id="formApartados">
                        <div class="modal-header">
                            <h5>Seleccione los apartados de la ficha</h5>
                        </div>
                        <div class="row">
                            <div class="modal-body" id="apartadosReporte">
                                <input type="hidden" id="idReporteSeleccionado" name="idReporteSeleccionado">
                                <div class="col-sm-offset-1 col-sm-10" >
                                    <ul style="list-style: none" class="listaDesordenada" id="sortable">
                                    </ul>
                                </div>
                                <input type="hidden" name="totalApartados" id="totalApartados" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-footer">
                                <div class="col-sm-offset-4 col-sm-3">
                                    <button type="button" onclick="guardarApartadosReporte()" class="btn bg-red waves-effect waves-light">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $( "#sortable" ).sortable();
        }
        function mostrarModalApartadosReporte(idReporte)
        {
            contador=0;
            existentes=[];
            $("#idReporteSeleccionado").val(idReporte);
            $.ajax(
                {
                    url: "<?=site_url('CrudReporteSSHL/obtenerApartadosReporte')?>/"+$("#idReporteSeleccionado").val(),
                    dataType: 'json',
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function (data)
                    {
                        var posicionPintada=false;
                        var posicionCorreccion=0;
                        $("#sortable").empty();
                        $.ajax(
                            {
                                url: "<?=site_url('CrudReporteSSHL/obtenerPosicionCorreccion/')?>"+$("#idReporteSeleccionado").val(),
                                dataType: 'html',
                                contentType: false,
                                success: function (res)
                                {
                                    posicionCorreccion=res;
                                },
                                complete: function ()
                                {
                                    for(i=0; i<data.length; i++)
                                    {
                                        if(posicionCorreccion==i)
                                        {
                                            posicionPintada=true;
                                            $("#sortable").append("" +
                                                "<li class='itemListaDesordenada' id='correccion'>" +
                                                "<span class='first'><label>CORRECCIONES</label></span>\n" +
                                                "<span class='third'><label>\"Apartado de los reportes\"</label></span>\n" +
                                                "<span class='second'><input type='checkbox' name='correccionCheck' id='correccionCheck'  checked>" +
                                                " <label >Activo</label></span>\n" +
                                                "<input type='hidden' name='lugarCorreccion' id='lugarCorreccion'>" +
                                                "</li>");

                                        }
                                        existentes[data[i]['idApartadoReporte']]=1;
                                        $("#sortable").append("" +
                                            "<li class='itemListaDesordenada' id='item"+data[i]['idApartadoReporte']+"'>" +
                                            "<span class='first'><label>"+data[i]['nombre']+":</label></span>\n" +
                                            "<span class='third'><label>\""+data[i]['descripcion']+"\"</label></span>\n" +
                                            "<span class='second'><input type='checkbox' id='apartado"+data[i]['idApartadoReporte']+"' name='apartado"+contador+"' value='"+data[i]['idApartadoReporte']+"' checked>" +
                                            " <label for='apartado"+data[i]['idApartadoReporte']+"'>Activo</label></span>\n" +
                                            "<input type='hidden' name='lugar"+contador+"' id='lugar"+data[i]['idApartadoReporte']+"'>" +
                                            "</li>");
                                        contador++;
                                    }
                                    if(!posicionPintada)
                                    {
                                        $("#sortable").append("" +
                                            "<li class='itemListaDesordenada' id='correccion'>" +
                                            "<span class='first'><label>CORRECCIONES</label></span>\n" +
                                            "<span class='third'><label>\"Apartado de los reportes\"</label></span>\n" +
                                            "<span class='second'><input type='checkbox' name='correccionCheck' id='correccionCheck' checked>" +
                                            " <label>Activo</label></span>\n" +
                                            "<input type='hidden' name='lugarCorreccion' id='lugarCorreccion'>" +
                                            "</li>");
                                    }
                                    $.ajax(
                                        {
                                            url: "<?=site_url('CrudReporteSSHL/obtenerApartadosReporteRestantes')?>/"+$("#idBitacoraSeleccionada").val(),
                                            dataType: 'json',
                                            processData: false,
                                            cache: false,
                                            contentType: false,
                                            success: function (data)
                                            {

                                                for(i=0; i<data.length; i++)
                                                {
                                                    if(!existentes[data[i]['idApartadoReporte']])
                                                    {
                                                        $("#sortable").append("" +
                                                            "<li class='itemListaDesordenada' id='item"+data[i]['idApartadoReporte']+"'>" +
                                                            "<span class='first'><label>"+data[i]['nombre']+":</label></span>\n" +
                                                            "<span class='third'><label>\""+data[i]['descripcion']+"\"</label></span>\n" +
                                                            "<span class='second'><input type='checkbox' id='apartado"+data[i]['idApartadoReporte']+"' name='apartado"+contador+"' value='"+data[i]['idApartadoReporte']+"'> <label for='apartado"+data[i]['idApartadoReporte']+"'>Activo</label></span>\n" +
                                                            "<input type='hidden' name='lugar"+contador+"' id='lugar"+data[i]['idApartadoReporte']+"'>" +
                                                            "</li>");
                                                        contador++;
                                                    }

                                                }

                                            },
                                            complete: function () {
                                                $("#totalApartados").val(contador);
                                                $("#modalApartados").modal();
                                                 $( "#sortable" ).sortable();
                                            }

                                        }
                                    );
                                }

                            }
                        );

                    }

                }
            );


        }
        function guardarApartadosReporte()
        {

            //arregloOrdenado=$("#sortable").sortable();
            arregloOrdenado=$("#sortable").sortable("toArray");
            console.table(arregloOrdenado);
            for(i=0; i<arregloOrdenado.length; i++)
            {
                if(arregloOrdenado[i]!="correccion")
                {
                    var numero = arregloOrdenado[i].split("m")[1];
                    $("#lugar" + numero).val(i);
                }
                else
                    $("#lugarCorreccion").val(i);

            }
            var formData=$("#formApartados").serialize();
            //alert($("#idReporteSeleccionado").val())
            $.ajax(
                {
                    url: "<?=site_url('CrudReporteSSHL/altaApartados')?>/"+$("#idReporteSeleccionado").val(),
                    data: formData,
                    processData: false,
                    cache: false,
                    type: 'POST',
                    dataType: 'JSON'
                }
            );
            swal('Exito', 'Se han guardado los indicadores de la bitacora' , 'success');
        }
        function confirmaDeleteReporte(id)
        {
            swal({
                    title: "Aviso",
                    text: "¿Desea borrar este Reporte SSHL?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function(){
                    location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudReporteSSHL/deleteReporte/"+id;
                });

        }
    </script>

    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $('#tabla-reportes').dataTable();
        }
    </script>


<?php
include "footer.php";
?>

