<?php
include "header.php";
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- DataTable -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

    <style>
      #listaOrdenacion { list-style-type: none; margin: 0; padding: 0; width: 100%; }
      #listaOrdenacion li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.2em; height: 18px; }
      #listaOrdenacion li span { position: absolute; margin-left: -1.3em; }
     </style>


    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <?php $tipo=$this->session->userdata('tipoUser');
                if($tipo!='' && $_SESSION['idusuariobase'] != '')
                {
                    if($tipo == 1){
                        echo "<a href='".site_url('RiesgoAcuse')."'>
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
                <div class="block-header">
                <a href="<?=site_url('Menus');?>">
                <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float">
                    <i class="material-icons">arrow_back</i>
                </button>
                </a>
        </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header">
                            <h2>
                                PLANTILLAS

                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">assignment</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/formAltaplantilla">Registrar plantillas</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tabla-pasos">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Formato</th>
                                    <th>Centro de Trabajo</th>
                                    <th>Plantilla</th>
                                    <th>Estado</th>
                                    <th>Tablas</th>
                                    <th style='text-align: center'>Descargar</th>
                                    <th style='text-align: center'>Modificar</th>
                                    <th style='text-align: center'>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conte=1;

                                foreach ($listaplantilla as $row) {
                                    $idPlantilla=$row["idPlantilla"];
                                    $idCliente=$row["nombreCliente"];
                                    $idFormato=$row["nombreFormato"];
                                    $idCentroTrabajo=$row["nombreCentroDeTrabajo"];
                                    $nombrePlantilla=$row["nombrePlantilla"];
                                    $nombreArchivo=$row["nombreArchivo"];
                                    $idEstado=$row["nombreEstado"];


                                    //https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/tablas/$idPlantilla
                                    echo "
                                            <tr>
                                                <td>$idPlantilla</td>
                                                <td>$idCliente</td>
                                                <td>$idFormato</td>
                                                <td>$idCentroTrabajo</td>
                                                <td>$nombrePlantilla</td>
                                                <td>$idEstado</td>
                                                <td style='text-align: center'><a style='cursor:pointer' onclick='buscarRegistroTabla($idPlantilla);'><i class='fa fa-table'></i></a>
                                                </td>
                                                <td style='text-align: center'><a download href='".base_url('assets/img/plantillasPc/').$nombreArchivo."'><i class='fa fa-download'></i></a>
                                                </td>                                              
                                                <td style='text-align: center'><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/editarPlantillaRegistrada/$idPlantilla'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td style='text-align: center'><a href='#' onclick='confirmaDeletePlantilla($idPlantilla);'><i class='fa fa-trash'></i></a></td>
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

  


    <script type="text/javascript">
        function confirmaDeletePlantilla(id)
        {
            //alert ("id"+id);
            swal({
                    title: "Aviso",
                    text: "¿Desea borrar esta plantilla?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function(){
                    location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/deletePlantilla/"+id;
                });

        }
    </script>


    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $('#tabla-pasos').dataTable();
        }


        function buscarRegistroTabla(idPl){
       
          $.ajax({
                url : "<?php echo site_url('CrudPlantillas/buscarIdt/')?>" + idPl,
                type: "GET",
                dataType: "json",
              
                success: function(data)
                {
                   
                  if (data.length>0)
                    {
                      //alert("si hay "+data);
                      tablaPlantillaEditar(idPl);
                    }else
                    {
                      //alert("no hay "+data);
                      tablaPlantillaAlta(idPl);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
    }

function tablaPlantillaAlta(idP) 
       {
        location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/tablas/"+idP;
       }

       function tablaPlantillaEditar(idP) 
       {
        location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas/tablasEditar/"+idP;
       }
    </script>

<?php
include "footer.php";
?>