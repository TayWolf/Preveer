<?php if(!empty($permisos))
{

    ?>

    <!-- START WRAPPER -->
    <div class="wrapper">

        <section id="content">
            <!--breadcrumbs start-->
            <div id="breadcrumbs-wrapper">
                <!-- Search for small screen -->
                <div class="header-search-wrapper grey lighten-2 hide-on-large-only">
                    <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">
                </div>

            </div>
            <!--breadcrumbs end-->
            <!--start container-->
            <div class="container">

                <div class="divider"></div>
                <!--editableTable-->
                <div id="editableTable" class="section">
                    <div class="row">
                        <div class="col s12">
                            <h4 class="header">Usuarios registrados</h4>
                        </div>

                        <?php
                        if($permisos['alta'])
                        {
                            ?>

                            <div align="center">
                                <a class='dropdown-trigger btn' href="#" onclick="loadUrl('Crudusuarios/altaUsuarios')" data-target='dropdown1'>Nuevo Usuario</a>
                            </div>

                            <?php
                        }
                        ?>

                        <div class="col s12">
                            <table id="mainTable" class="responsive-table display dataTable">
                                <thead>
                                <tr>
                                    <th style="display: none;">ID</th>
                                    <th>Nombre Usuario</th>
                                    <th>NickName</th>
                                    <th>Contraseña</th>
                                    <th>Correo</th>
                                    <th>Área</th>
                                    <th>Tipo</th>
                                    <?php
                                    if($permisos['editar'])
                                    {
                                        ?>
                                        <th>Empresas</th>
                                        <th>Tipos de contrato</th>
                                        <?php
                                    }
                                    if($permisos['eliminar'])
                                    {
                                        ?>
                                        <th>Eliminar</th>
                                        <?php
                                    }?>


                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador=1;
                                foreach ($Usuario as $row) {
                                    $idUser=$row["idUser"];
                                    $nombreUser=$row["nombreUser"];
                                    $nickName=$row["nickName"];
                                    $passwordUser=$row["passwordUser"];
                                    $nombreArea=$row["nombreArea"];
                                    $nombreTipo=$row["nombreTipo"];
                                    $correoDestino=$row["correoDestino"];

                                    $clase=($contador%2==0)?'odd':'even';
                                    echo "<tr  class='$clase' role='row'>
                                <td id='indice".$row['idUser']."' style='display:none'>$idUser</td>
                                <td>$nombreUser</td>
                                <td>$nickName</td>
                                <td>$passwordUser</td>
                                <td>$correoDestino</td>
                                <td>$nombreArea</td>
                                <td>$nombreTipo</td>";
                                    if($permisos['editar'])
                                    {
                                        echo"<td><a href='#' onclick='editarEmpresas(".$row['idUser'].")'>Empresas</a></td>
                                <td><a href='#' onclick='editarTipos(".$row['idUser'].")'>Tipos de contratos</a></td>";
                                    }

                                    if($permisos['eliminar'])
                                        echo"<td><a href='#' onclick='borrar(".$row['idUser'].", this)'>Eliminar</a></td>";
                                    echo"</tr>";
                                    $contador++;
                                }
                                ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="divider"></div>

                </div>

            </div>
            <!--end container-->
        </section>

    </div>
    <!-- END WRAPPER -->
    <input type="hidden" id="usuarioSeleccionado">
    <!-- Modal Structure -->␊
    <div id="modalEmpresas" class="modal bottom-sheet">
        <div class="modal-content">

            <h4>Empresas a las que pertenece el usuario</h4>
            <div class="col s12" id="contenidoEmpresas">
                <?php
                foreach ($empresas as $empresa)
                {
                    echo "<div class='col s12'><input type=\"checkbox\" onChange='cambiarStatusEmpresaUsuario(".$empresa['idEmpresaInterna'].")' id=\"cboxEmpresa".$empresa['idEmpresaInterna']."\" value=\"".$empresa['idEmpresaInterna']."\"><label for=\"cboxEmpresa".$empresa['idEmpresaInterna']."\">".$empresa['nombreEmpresa']."</label></div>";
                }
                ?>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">Hecho</a>
        </div>␊
    </div>
    <!-- Modal Structure -->␊
    <div id="modalTiposContratos" class="modal bottom-sheet">
        <div class="modal-content">
            <h4>Tipos de contrato que maneja el usuario</h4>
            <div class="col s12" id="contenidoTiposContrato">
                <?php
                foreach ($tiposContrato as $tipo)
                {
                    echo "<div class='col s6'><input type=\"checkbox\" onChange='cambiarStatusTiposContrato(".$tipo['idTipoC'].")' id=\"cboxContrato".$tipo['idTipoC']."\" value=\"".$tipo['idTipoC']."\"><label for=\"cboxContrato".$tipo['idTipoC']."\">".$tipo['nombreTipo']."</label></div>";
                }
                ?>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="modal-action modal-close waves-effect waves-green btn-flat">Hecho</a>
        </div>␊
    </div>

    <!--  <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquerymo.min.js"></script>
 <script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.tabledit.js"></script>
     <script src="https://cointic.com.mx/CDI/Panel/content/plugins/jquery-datatable/jquery.dataTables.js"></script> -->
    <script type="text/javascript">
        var tabla;
        $(document).ready( function ()
        {

            tabla=$("#mainTable").DataTable({
                language: {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
            $('.modal').modal();
        } );
        var areaUs = <?php print json_encode($areaUs); ?>;
        var are = '{ "0" : "Seleccione una opción...", ';
        areaUs.forEach(function (element) {
            are += '"'+element.idArea+'": "'+element.nombreArea+'",';
        });
        var lastIndex = are.lastIndexOf(",");
        var JSONArea = are.substring(0,lastIndex)+"}";

        var TipoU = <?php print json_encode($TipoU); ?>;
        var tip = '{ "0" : "Seleccione una opción...", ';
        TipoU.forEach(function (element) {
            tip += '"'+element.idTipo+'": "'+element.nombreTipo+'",';
        });
        var lastIndexT = tip.lastIndexOf(",");
        var JSONTip = tip.substring(0,lastIndexT)+"}";

        <?php
        if(($permisos['editar']))
        {
        ?>

        $('#mainTable').Tabledit({
            url: '<?=base_url()?>index.php/Crudusuarios/editaDatos/',
            editButton: false,
            deleteButton:false,
            columns: {
                identifier: [0, 'idUser'],
                editable: [[1, 'nombrUs'],[2, 'nickN'],[3, 'password'],[4, 'correoD'],[5, 'idAre',JSONArea],[6, 'idTip',JSONTip]]
            }
        })

        function establecerUsuarioSeleccionado(idUser)
        {
            $( "input[type='checkbox']" ).prop({
                checked: false
            });

            $("#usuarioSeleccionado").val(idUser);
            console.log("limpiar");
        }
        function editarEmpresas(idUser)
        {
            establecerUsuarioSeleccionado(idUser);
            $.ajax({
                url: '<?=base_url('index.php/Crudusuarios/cargarEmpresasUsuario/')?>'+idUser,
                dataType: 'JSON',
                success: function (data)
                {
                    for(i=0; i<data.length; i++)
                    {
                        $("#cboxEmpresa"+data[i]['idEmpresaInterna']).prop({
                            checked: true
                        });
                    }
                },
                complete: function () {
                    $('#modalEmpresas').modal('open');
                }
            });

        }
        function editarTipos(idUser)
        {
            establecerUsuarioSeleccionado(idUser);
            $.ajax({
                url: '<?=base_url('index.php/Crudusuarios/cargarTiposContrato/')?>'+idUser,
                dataType: 'JSON',
                success: function (data)
                {
                    for(i=0; i<data.length; i++)
                    {
                        $("#cboxContrato"+data[i]['idTipoContrato']).prop({
                            checked: true
                        });
                    }
                },
                complete: function () {
                    $('#modalTiposContratos').modal('open');
                }
            });
        }
        function cambiarStatusEmpresaUsuario(idEmpresa)
        {
            if($("#cboxEmpresa"+idEmpresa).prop("checked"))
                $.ajax({url: '<?=base_url('index.php/Crudusuarios/asignarEmpresaUsuario')?>/'+idEmpresa+'/'+$("#usuarioSeleccionado").val()});
            else
                $.ajax({url: '<?=base_url('index.php/Crudusuarios/eliminarEmpresaUsuario')?>/'+idEmpresa+'/'+$("#usuarioSeleccionado").val()});
        }

        function cambiarStatusTiposContrato(idtipo)
        {
            if($("#cboxContrato"+idtipo).prop("checked"))
                $.ajax({url: '<?=base_url('index.php/Crudusuarios/asignarTiposContrato')?>/'+idtipo+'/'+$("#usuarioSeleccionado").val()});
            else
                $.ajax({url: '<?=base_url('index.php/Crudusuarios/eliminarTiposContrato')?>/'+idtipo+'/'+$("#usuarioSeleccionado").val()});
        }

        <?php
        }
        if(($permisos['eliminar']))
        {
        ?>
        function borrar(identificador, elemento)
        {
            Swal({
                title: 'Eliminar este registro?',
                text: "No se podran revertir los cambios!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, borralo!'
            }).then((result) => {
                if (result.value)
                {
                    $.post('<?=base_url('index.php/Crudusuarios/borrarUser')?>',
                        {id: identificador},
                        function(response)
                        {
                            //console.log("dato "+response);
                            tabla.row($(elemento).closest('tr')).remove().draw();
                            //location.reload();
                            Swal(
                                'Borrado!',
                                'El registro fue eliminado',
                                'success'
                            );
                        }
                    );
                }
            })
        }
        <?php
        }?>
    </script>

    <?php
}
?>