<?php
include "header.php";
?>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <style>
        .listaDesordenada{display:table; width:100%; padding:10px;}
        .itemListaDesordenada {display:table-row; }
        .itemListaDesordenada span{display:table-cell; text-align:left;}
    </style>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- DataTable -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <?php $tipo=$this->session->userdata('tipoUser');
                if($tipo!='' && $_SESSION['idusuariobase'] != '')
                {
                    if($tipo == 1){
                        echo "<a href='".site_url('Indicadores')."'>
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
                                Formulario

                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">book</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudAutoad/formAltaFormulario">Registrar Formulario</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tabla-formularios">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre de Formulario</th>
                                    <th>Modificar</th>
                                    <th>Acordeon</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conte=1;

                                foreach ($listaformulario as $row) {
                                    $idControl=$row["idControl"];
                                    $nombreFormulario=$row["nombreFormulario"];


                                    echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$nombreFormulario</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAutoad/formEditarFormulario/$idControl'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                      <td>
                                                    <a onclick='mostrarModalIndicadores($idControl)'><i class='fa fa-sitemap'></i></a>
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteFormulario($idControl);'><i class='fa fa-trash'></i></a></td>
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
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalSortable">
        <div class="modal-dialog modal-lg">
            <div class="col-sm-12">
                <div class="modal-content">
                    <form id="formIndicadores">
                        <div class="modal-header">
                            <h5>Seleccione los acordeones del formulario</h5>
                        </div>
                        <div class="row">
                            <div class="modal-body" id="indicadoresBitacora">
                                <input type="hidden" id="idSeleccionado" name="idSeleccionado">
                                <div class="col-sm-offset-3 col-sm-6" >
                                    <ul style="list-style: none" class="listaDesordenada" id="sortable">
                                        <?php
                                        $contador=0;
                                        ?>
                                    </ul>
                                </div>
                                <input type="hidden" name="totalIndicadores" id="totalIndicadores" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="modal-footer">
                                <div class="col-sm-offset-4 col-sm-3">
                                    <button type="button" onclick="guardarIndicadores()" class="btn bg-red waves-effect waves-light">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function mostrarModalIndicadores(llavePrimaria)
        {
            contador=0;
            existentes=[];
            $("#idSeleccionado").val(llavePrimaria);
            $.ajax(
                {
                    url: "<?=site_url('CrudAutoad/obtenerAcordeones')?>/"+llavePrimaria,
                    dataType: 'json',
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function (data)
                    {
                        $("#sortable").empty();
                        for(i=0; i<data.length; i++)
                        {
                            existentes[data[i]['idAcordeon']]=1;
                            $("#sortable").append("" +
                                "<li class='itemListaDesordenada' id='item"+data[i]['idAcordeon']+"'>" +
                                "<span class='first'><label>"+data[i]['nombreAcordeon']+"</label></span>\n" +
                                "<span class='second'><input type='checkbox' id='acordeon"+data[i]['idAcordeon']+"' name='acordeon"+contador+"' value='"+data[i]['idAcordeon']+"' checked> <label for='acordeon"+data[i]['idAcordeon']+"'>Activo</label></span>\n" +
                                "<input type='hidden' name='lugar"+contador+"' id='lugar"+data[i]['idAcordeon']+"'>" +
                                "</li>");
                            contador++;
                        }

                    },
                    complete: function () {
                        $.ajax(
                            {
                                url: "<?=site_url('CrudAutoad/obtenerAcordeonesRestantes')?>/"+llavePrimaria,
                                dataType: 'json',
                                processData: false,
                                cache: false,
                                contentType: false,
                                success: function (data)
                                {

                                    for(i=0; i<data.length; i++)
                                    {
                                        if(!existentes[data[i]['idAcordeon']])
                                        {
                                            $("#sortable").append("" +
                                                "<li class='itemListaDesordenada' id='item"+data[i]['idAcordeon']+"'>" +
                                                "<span class='first'><label>"+data[i]['nombreAcordeon']+"</label></span>\n" +
                                                "<span class='second'><input type='checkbox' id='acordeon"+data[i]['idAcordeon']+"' name='acordeon"+contador+"' value='"+data[i]['idAcordeon']+"'> <label for='acordeon"+data[i]['idAcordeon']+"'>Activo</label></span>\n" +
                                                "<input type='hidden' name='lugar"+contador+"' id='lugar"+data[i]['idAcordeon']+"'>" +
                                                "</li>");
                                            contador++;
                                        }

                                    }

                                },
                                complete: function () {
                                    $("#totalIndicadores").val(contador);
                                    $("#modalSortable").modal();
                                }

                            }
                        );
                    }

                }
            );


        }
        function guardarIndicadores()
        {

            arregloOrdenado=$("#sortable").sortable("toArray");
            for(i=0; i<arregloOrdenado.length; i++)
            {
                var numero=arregloOrdenado[i].split("m")[1];
                $("#lugar"+numero).val(i);
            }

            var formData=$("#formIndicadores").serialize();


            $.ajax(
                {
                    url: "<?=site_url('CrudAutoad/altaAcordeones')?>/"+$("#idSeleccionado").val(),
                    data: formData,
                    processData: false,
                    cache: false,
                    type: 'POST',
                    dataType: 'JSON'
                }
            );
            swal('Exito', 'Se han guardado los acordeones del formulario' , 'success');
        }

        function confirmaDeleteFormulario(id)
        {
            //alert ("id"+id);
            swal({
                    title: "Aviso",
                    text: "¿Desea borrar este Ponderador?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function(){
                    location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudAutoad/deleteFormulario/"+id;
                });

        }
    </script>

    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $('#tabla-formularios').dataTable();
            $( "#sortable" ).sortable();
        }
    </script>

<?php
include "footer.php";
?>