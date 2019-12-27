<?php
include "header.php";
?>
<!-- jQuery -->
<!--<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<!-- DataTable -->
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://cointic.com.mx/preveer/sistema/assets/js/jquery.dataTables.min.js" type="application/javascript"></script>


<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <a href="<?=site_url('Catalogos');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
            </a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Indicadores registrados
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">folder</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormas/formAltaDocumentoNormas">Registrar indicador</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="body table-responsive">
                        <table class="table table-hover" id="tablaDocumentos">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre del indicador</th>
                                <th>Area</th>
                                <th>Subservicio</th>
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                            </thead>
                           <!--  <tbody id="filasTabla">
                            <?php
                            $conte=1;
                            foreach ($listDocumentosNormas as $row) {
                                $idDocSTPS=$row["idDocSTPS"];
                                $nomNorma=$row["nombre"];
                                $nombreSubArea=$row["nombreArea"];
                                $texto=$row["texto"];

                                echo "
                                    <tr>
                                        <td>$conte</td>
                                        <td>$texto</td>
                                        <td>$nombreSubArea</td>
                                        <td>$nomNorma</td>
                                        <td>
                                            <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormas/formEditarDocumentoNormas/$idDocSTPS'><i class='fa fa-pencil-square-o'></i></a>
                                        </td>
                                        <td>
                                            <a href='#' onclick='confirmaDeleteDocumento($idDocSTPS);'><i class='fa fa-trash'></i></a>
                                        </td>
                                    </tr>";
                                $conte++;
                            }
                            ?>
                            </tbody> -->
                        </table>

                        <div align="center">
                            <div>
                                <nav>

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function confirmaDeleteDocumento(id)
    {
        //alert ("id"+id);
        swal({
                title: "Aviso",
                text: "¿Desea borrar este indicador?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Aceptar",
                closeOnConfirm: false
            },
            function(){
                location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormas/deleteDocumentoNormas/"+id;
            });

    }
</script>
<script>

    window.onload = cargarDatosTabla;

    function cargarDatosTabla(){
        // $('#tablaDocumentos').dataTable( {
        //     "search": {
        //         "smart": false
        //     }
        // });
      $('#tablaDocumentos').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax":{
                    "url": "<?php echo base_url('index.php/CrudDocumentosNormas/getListadoDocumentos/') ?>",
                    "dataType": "json",
                    "type": "POST",
                    "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
                    "complete": function () {
                        
                    }
                },

                "columns": [
                    { "data": "idDocSTPS" },
                    { "data": "texto" },
                    { "data": "nombreArea" },
                    { "data": "nombre" },
                    { "data": "Modificar" },
                    { "data": "Eliminar" }
                ],
                "language":{
                    "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
                }
    });
        

    }

</script>

<?php
include "footer.php";
?>
<!-- <?php
//include "footer.php";
?> -->