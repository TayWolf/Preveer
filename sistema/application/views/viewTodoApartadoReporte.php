<?php
include "header.php";
?>
    <!-- DataTable -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="<?=site_url('Reportes');?>">
                    <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                        <i class="material-icons">arrow_back</i>
                    </button>
                </a>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Apartados registrados</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">move_to_inbox</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudApartadoReporte/formAltaApartadoReporte">Registrar apartado</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tabla-apartados">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Indicadores del apartado</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conte=1;
                                foreach ($listApartadoReporte as $row) {
                                    $idApartadoReporte=$row["idApartadoReporte"];
                                    $NombreApartadoReporte=$row["nombre"];
                                    $DescripcionApartadoReporte=$row["descripcion"];

                                    echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$NombreApartadoReporte</td>
                                                <td>$DescripcionApartadoReporte</td>
                                                <td><a href='#' onclick='mostrarModalIndicadoresApartado($idApartadoReporte)'><i class='fa fa-sitemap'></i></a></td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudApartadoReporte/formEditarApartadoReporte/$idApartadoReporte'><i class='fa fa-pencil-square-o'></i></a>
                                                </td> 
                                                <td><a href='#' onclick='confirmaDeleteApartadoReporte($idApartadoReporte)'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a></td>                                               
                                            </tr>";
                                    $conte++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalIndicadores">
        <div class="modal-dialog modal-lg">
            <div class="col-sm-12">
                <div class="modal-content">
                    <form id="formIndicadores">
                        <div class="modal-header">
                            <h5>Seleccione los indicadores de la bitacora</h5>
                        </div>
                        <div class="container">
                            <div class="modal-body" id="indicadoresBitacora">
                                <input type="hidden" id="idApartadoSeleccionado" name="idApartadoSeleccionado">
                                <div class="row clearfix" >
                                    <ul style="list-style: none" class="listaDesordenada col-xs-12" id="sortable">
                                        <?php
                                        $contador=0;
                                        /* foreach($listaIndicadores as $indicador)
                                         {
                                             echo "
                                                 <li class='itemListaDesordenada' id='item".$indicador['idIndicador']."'>
                                                     <span class='first'><label>".$indicador['nombreIndicador']."</label></span>
                                                     <span class='second'><input type='checkbox' id='indicador".$indicador['idIndicador']."' name='indicador".$contador."' value='".$indicador['idIndicador']."'> <label for='indicador".$indicador['idIndicador']."'>Activo</label></span>
                                                     <input type='hidden' name='lugar".$contador."' id='lugar".$indicador['idIndicador']."'>
                                                 </li>";
                                             $contador++;
                                         }*/
                                        ?>
                                    </ul>
                                </div>
                                <input type="hidden" name="totalIndicadores" id="totalIndicadores" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-footer">
                                <div class="col-sm-offset-4 col-sm-3">
                                    <button type="button" onclick="guardarIndicadoresApartado()" class="btn bg-red waves-effect waves-light">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
        window.onload= inicio();
        function inicio()
        {
            $( "#sortable" ).sortable();
        }

        function mostrarModalIndicadoresApartado(idApartado)
        {
            contador=0;
            existentes=[];
            $("#idApartadoSeleccionado").val(idApartado);
            $.ajax(
                {
                    url: "<?=site_url('CrudApartadoReporte/obtenerIndicadoresApartado')?>/"+$("#idApartadoSeleccionado").val(),
                    dataType: 'json',
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function (data)
                    {
                        $("#sortable").empty();
                        for(i=0; i<data.length; i++)
                        {
                            existentes[data[i]['idIndicadorReporte']]=1;
                            $("#sortable").append("" +
                                "<div class='col-xs-12 col-md-7 col-md-offset-1'>"+
                                    "<li class='itemListaDesordenada' id='item"+data[i]['idIndicadorReporte']+"'>" +
                                    "<div class='col-xs-12 col-md-10'>"+
                                        "<span class='first'><label>"+data[i]['nombreIndicador']+"</label></span>\n" +
                                    "</div>"+
                                    "<div class='col-xs-12 col-md-2'>"+
                                        "<span class='second'><input type='checkbox' id='indicador"+data[i]['idIndicadorReporte']+"' name='indicador"+contador+"' value='"+data[i]['idIndicadorReporte']+"' checked> <label for='indicador"+data[i]['idIndicadorReporte']+"'>Activo</label></span>\n" +
                                    "</div>"+
                                    "<input type='hidden' name='lugar"+contador+"' id='lugar"+data[i]['idIndicadorReporte']+"'>" +
                                    "</li>"+
                                "</div>");
                            contador++;
                        }

                    },
                    complete: function () {
                        $.ajax(
                            {
                                url: "<?=site_url('CrudApartadoReporte/obtenerIndicadoresApartadoRestantes')?>/"+$("#idApartadoSeleccionado").val(),
                                dataType: 'json',
                                processData: false,
                                cache: false,
                                contentType: false,
                                success: function (data)
                                {
                                    for(i=0; i<data.length; i++)
                                    {
                                        if(!existentes[data[i]['idIndicador']])
                                        {
                                            $("#sortable").append("" +
                                                "<div class='col-sm-12 col-md-7 col-md-offset-1'>"+
                                                    "<li class='itemListaDesordenada' id='item"+data[i]['idIndicador']+"'>" +
                                                    "<div class='col-sm-12 col-md-10'>"+
                                                        "<span class='first'><label>"+data[i]['nombreIndicador']+"</label></span>\n" +
                                                    "</div>"+
                                                    "<div class='col-sm-12 col-md-2'>"+
                                                        "<span class='second'><input type='checkbox' id='indicador"+data[i]['idIndicador']+"' name='indicador"+contador+"' value='"+data[i]['idIndicador']+"'> <label for='indicador"+data[i]['idIndicador']+"'>Activo</label></span>\n" +
                                                    "</div>"+
                                                    "<input type='hidden' name='lugar"+contador+"' id='lugar"+data[i]['idIndicador']+"'>" +
                                                    "</li>"+
                                                "</div>");
                                            contador++;
                                        }
                                    }
                                },
                                complete: function () {
                                    $("#totalIndicadores").val(contador);
                                    $("#modalIndicadores").modal();
                                }

                            }
                        );
                    }

                }
            );


        }
        function guardarIndicadoresApartado()
        {   
            $( "#sortable" ).sortable();

            arregloOrdenado=$("#sortable").sortable("toArray");
            for(i=0; i<arregloOrdenado.length; i++)
            {
                var numero=arregloOrdenado[i].split("m")[1];
                $("#lugar"+numero).val(i);
            }

            var formData=$("#formIndicadores").serialize();
            console.log(formData);

            $.ajax(
                {
                    url: "<?=site_url('CrudApartadoReporte/altaIndicadores')?>/"+$("#idApartadoSeleccionado").val(),
                    data: formData,
                    processData: false,
                    cache: false,
                    type: 'POST',
                    dataType: 'JSON'
                }
            );
            swal('Exito', 'Se han guardado los indicadores de la bitacora' , 'success');
        }
        function confirmaDeleteApartadoReporte(id)
        {
            swal({
                    title: "Aviso",
                    text: "¿Desea borrar este apartado?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function()
                {
                    location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudApartadoReporte/deleteApartadoReporte/"+id;
                });

        }
    </script>

    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $('#tabla-apartados').dataTable();
        }
    </script>


<?php
include "footer.php";
?>