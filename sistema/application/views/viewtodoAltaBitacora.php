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
                    echo "<a href='".site_url('Catalogos')."'>
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
                            Bitacoras registradas
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">line_style</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudAltaBitacora/formAltaBitacora">Registrar bitacora</a></li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover" id="tabla-bitacoras">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Indicadores</th>
                                <th>Informes</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $conte=1;
                            foreach ($listAltaBitacora as $row) {
                                $idBitacora=$row["idBitacora"];
                                $nombre=$row["nombre"];
                                $icono=$row["icono"];

                                echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$nombre</td>
                                                <td><a onclick='mostrarModalIndicadoresBitacora($idBitacora)'><i class='$icono'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAltaBitacora/datosInforme/$idBitacora'><i class=\"fa fa-table\" aria-hidden=\"true\"></i></a></td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAltaBitacora/formEditarBitacora/$idBitacora'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteBitacora($idBitacora);'><i class='fa fa-trash'></i></a></td>
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
                    <div class="row">
                    <div class="modal-body" id="indicadoresBitacora">
                        <input type="hidden" id="idBitacoraSeleccionada" name="idBitacoraSeleccionada">
                            <div class="col-sm-offset-3 col-sm-6" >
                                <ul style="list-style: none" class="listaDesordenada" id="sortable">
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
                            <button type="button" onclick="guardarIndicadoresBitacora()" class="btn bg-red waves-effect waves-light">Guardar</button>
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
        $('#tabla-bitacoras').dataTable();
        $( "#sortable" ).sortable();
    }

    function mostrarModalIndicadoresBitacora(idBitacora)
    {
        contador=0;
        existentes=[];
        $("#idBitacoraSeleccionada").val(idBitacora);
        $.ajax(
            {
                url: "<?=site_url('CrudAltaBitacora/obtenerIndicadoresBitacora')?>/"+$("#idBitacoraSeleccionada").val(),
                dataType: 'json',
                processData: false,
                cache: false,
                contentType: false,
                success: function (data)
                {
                    $("#sortable").empty();
                    for(i=0; i<data.length; i++)
                    {
                        existentes[data[i]['idIndicador']]=1;
                        $("#sortable").append("" +
                            "<li class='itemListaDesordenada' id='item"+data[i]['idIndicador']+"'>" +
                            "<span class='first'><label>"+data[i]['nombreIndicador']+"</label></span>\n" +
                            "<span class='second'><input type='checkbox' id='indicador"+data[i]['idIndicador']+"' name='indicador"+contador+"' value='"+data[i]['idIndicador']+"' checked> <label for='indicador"+data[i]['idIndicador']+"'>Activo</label></span>\n" +
                            "<input type='hidden' name='lugar"+contador+"' id='lugar"+data[i]['idIndicador']+"'>" +
                            "</li>");
                        contador++;
                    }
                        //$("#indicador"+data[i]['idIndicador']).prop('checked', true);
                },
                complete: function () {
                    $.ajax(
                        {
                            url: "<?=site_url('CrudAltaBitacora/obtenerIndicadoresBitacoraRestantes')?>/"+$("#idBitacoraSeleccionada").val(),
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
                                            "<li class='itemListaDesordenada' id='item"+data[i]['idIndicador']+"'>" +
                                            "<span class='first'><label>"+data[i]['nombreIndicador']+"</label></span>\n" +
                                            "<span class='second'><input type='checkbox' id='indicador"+data[i]['idIndicador']+"' name='indicador"+contador+"' value='"+data[i]['idIndicador']+"'> <label for='indicador"+data[i]['idIndicador']+"'>Activo</label></span>\n" +
                                            "<input type='hidden' name='lugar"+contador+"' id='lugar"+data[i]['idIndicador']+"'>" +
                                            "</li>");
                                        contador++;
                                    }

                                }
                                //$("#indicador"+data[i]['idIndicador']).prop('checked', true);
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
    function guardarIndicadoresBitacora()
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
                url: "<?=site_url('CrudAltaBitacora/altaIndicadores')?>/"+$("#idBitacoraSeleccionada").val(),
                data: formData,
                processData: false,
                cache: false,
                type: 'POST',
                dataType: 'JSON'
            }
        );
        swal('Exito', 'Se han guardado los indicadores de la bitacora' , 'success');
    }

    function confirmaDeleteBitacora(id)
    {

        swal({
                title: "Aviso",
                text: "¿Desea borrar esta bitacora?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudAltaBitacora/deleteBitacora/"+id;
            });

    }
</script>

<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->