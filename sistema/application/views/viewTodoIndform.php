<?php
include "header.php";
?>

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
                                Indicadores de Formulario

                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">chrome_reader_mode</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorFormulario/formAltaIndicador">Registrar Indicador formulario</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tabla-indicadores">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre de indicador</th>    
                                    <th>Tipo Inventario</th>
                                    <th>Modificar</th>
                                    <th>Ponderador</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conte=1;
                                $nombreL="";
                                foreach ($listaIndicador as $row) {

                                    $idIndicador=$row["idIndicador"];
                                    $nombreIndicador=$row["nombreIndicador"];
                                    $tipoIndicador=$row['tipoIndicador'];

                                    $ponderaciones="";
                                    if($tipoIndicador==1)
                                        $ponderaciones="<a href='https://cointic.com.mx/preveer/sistema/index.php//CrudIndicadorFormulario/listaPonderador/$idIndicador'><i class='fa fa-sitemap'></i></a>";
                                    else
                                        $ponderaciones= "<a style='color: rgba(184,31,38,0.30);'> <i class='fa fa-sitemap'></i></a>";

                                    echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$nombreIndicador</td>
                                                <td>$nombreL</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorFormulario/formEditarIndicador/$idIndicador'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td>
                                                    $ponderaciones
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteindicador($idIndicador);'><i class='fa fa-trash'></i></a></td>
                                            </tr>";
                                    $conte++;
                                    $nombreL="";
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
    <script type="text/javascript">
        function confirmaDeleteindicador(id)
        {
            //alert ("id"+id);
            swal({
                    title: "Aviso",
                    text: "¿Desea borrar este Indicador?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function(){
                    location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorFormulario/deleteindicador/"+id;
                });

        }
    </script>

    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $('#tabla-indicadores').dataTable();
        }
    </script>

<?php
include "footer.php";
?>