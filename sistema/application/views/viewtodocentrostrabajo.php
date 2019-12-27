<?php
include "header.php";
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- DataTable -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript">
        function confirmaDeleteCentroTrabajo(id)
        {
            //alert ("id"+id);
            swal({
                    title: "Aviso",
                    text: "¿Desea borrar este centro de trabajo?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function(){
                    location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/deleteCentroTrabajo/"+id;
                });

        }
    </script>
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
                                Centros de trabajo registrados
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">store_mall_directory</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/formAltaCentroTrabajo">Registrar centro de trabajo</a></li>
                                        <li><a onclick="abrirModalRegistroMasivo()">Registro masivo (Excel)</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover formatos-reg" id="tabla-centros">
                                <thead>
                                <tr>
                                    <th>Centro de trabajo</th>
                                    <th>Detalle</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conte=1;
                                foreach ($listCentrosTrabajo as $row) {
                                    $idCentroTrabajo=$row["idCentroTrabajo"];
                                    $nombre=$row["nombre"];
                                    $nombreFormato=$row["nombreFormato"];

                                    echo "
                                            <tr>
                                                <td>$nombre ($nombreFormato)</td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/formDetalleCentroTrabajo/$idCentroTrabajo'><i class='fa fa-eye'></i></a></td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/formEditarCentroTrabajo/$idCentroTrabajo'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteCentroTrabajo($idCentroTrabajo);'><i class='fa fa-trash'></i></a></td>
                                            </tr>";

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
    <div id="modalRegistroMasivo" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Registro masivo de centros de trabajo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            Instrucciones:
                            <ol>

                                <li>Asegurate que el archivo excel que subirás tenga las siguientes columnas:<br>
                                    <ol type="A" >
                                        <li>Formato<sup>1</sup> *</li>
                                        <li>Tipo de inmueble<sup>2</sup> *</li>
                                        <li>Nombre del centro de trabajo *</li>
                                        <li>IdDet </li>
                                        <li>Colonia o localidad *</li>
                                        <li>Código postal *</li>
                                        <li>Calle *</li>
                                        <li>Número exterior *</li>
                                        <li>Número interior</li>
                                        <li>Nombre de contacto</li>
                                        <li>Puesto de contacto</li>
                                        <li>Teléfono de contacto</li>
                                        <li>Correo de contacto</li>
                                        <li>Teléfono del inmueble</li>
                                        <li>Correo del inmueble</li>
                                        <li>Giro del inmueble</li>
                                        <li>Latitud (coordenadas)</li>
                                        <li>Longitud (coordenadas)</li>
                                        <li>Metros (coordenadas)</li>

                                    </ol>
                                </li>
                                <li>Escoge el archivo y haz clic en subir!</li>
                            </ol>
                            <sup>1</sup>: <a href="<?=site_url('CrudFormatos')?>">Escoge uno de estos formatos</a><br>
                            <sup>2</sup>: <a href="<?=site_url('Crudinmueble')?>">Escoge uno de estos inmuebles</a><br>
                            NOTA: Los campos marcados con un asterisco son obligatorios

                        </div>
                    </div>
                    <form id="formRegistroMasivo" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <b>Archivo de excel</b>
                                <input  type="file" name="excel" id="excel" >
                            </div>
                        </div>
                        <div class="spinner-border" role="status" style="display: none" id="loaderExcel">
                            <span class="sr-only">Cargando...<br>Esto puede tardar algunos minutos...</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="subirExcel(this);" class="btn bg-red">Subir!</button>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $('#tabla-centros').dataTable();
        }
        function abrirModalRegistroMasivo()
        {
            $("#modalRegistroMasivo").modal();
        }
        function subirExcel(elemento)
        {
           
            $("#loaderExcel").show();
            var formulario=new FormData(document.getElementById("formRegistroMasivo"));
            var archivExc=$("#excel").val();
            var extension=archivExc.split('.').pop();
            if (extension=="xlsx" || extension=="xlsm" || extension=="xls" )
             {
                 $(elemento).prop("disabled", "disabled");
               $.ajax({
                    url: '<?=site_url('CrudCentrosTrabajo/altaMasivaCentrosTrabajo')?>',
                    type: 'POST',
                    data: formulario,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function (data)
                    {
                        
                        $("#loaderExcel").toggle();
                        $(elemento).prop("disabled", false);
                        if(data.length==0)
                            swal("Exito!", "Se dieron de alta los centros de trabajo", "success");
                        else
                        {
                            var errores="";
                            for(var i=0; i<data.length; i++)
                            {
                                errores+=data[i]+",";
                            }
                            errores=errores.substring(0, errores.length-1);
                            swal("Error", "Tiendas registradas, Por favor verificar las columna's: "+errores, "error");
                        }

                    }
                }); 
             }else{
                swal("Error", "Archivo no valido", "error")
             }

            
        }
    </script>
<?php
include "footer.php";
?>