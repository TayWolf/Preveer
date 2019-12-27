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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PASOS EVACUACIÓN

                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">assignment_ind</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="https://cointic.com.mx/preveer/sistema/index.php/CrudPasosEvacuacion/formAltaPasos">Registrar Paso de Evacuación</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tabla-pasos">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre de paso de evacuación</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conte=1;

                                foreach ($listapasos as $row) {
                                    $id_paso=$row["id_paso"];
                                    $paso=$row["paso"];                           


                                    echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$paso</td>
                                              
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudPasosEvacuacion/formEditarPaso/$id_paso'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td><a href='#' onclick='confirmaDeletePaso($id_paso);'><i class='fa fa-trash'></i></a></td>
                                            </tr>";
                                    $conte++;
                                }
                                ?>
                                </tbody>
                            </table>
                            <div style="text-align: left;" class="row">
                                <div class="col-sm-4 col-md-offset-5">
                                    <div class="form-line">
                                        <button type="button" onClick="ordenarProcesos()" class="btn bg-red waves-effect waves-light" data-toggle="modal">Ordenar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Modal Structure -->
    <div id="modalOrdenacion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" class="modal">
        <div class="modal-dialog modal-lg">
            <div class="col-sm-12">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Arrastra y suelta para ordenar</h4>
                    </div> 
                    <div class="row">
                        <div class="modal-body" >
                    
                            <div id="statusPasos">
                                <ul id="listaOrdenacion" class="listaOrdenacion" style="cursor:pointer;">
                                    <?php

                                    $contador=0;
                                    foreach ($listapasos as $row)
                                 {


                                     $id_paso= $row['id_paso'];

                                     $paso=$row['paso'];

                                     print "<li class='ordenacion'><input id='item".$contador."' name='item".$contador."' type='hidden' value='".$id_paso."' >".$paso."</li>";
                                      $contador++;
                                    }

                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" onClick="guardarOrden()" class="btn btn-primary">Guardar</button>
                                   
                    </div>
                </div>
            </div>
        </div>
        
    </div>



    <script type="text/javascript">
        function guardarOrden()
        {
             /*
           1. Recorrer cada elemento
           2. Obtener el id de cada elemento
           2. Mandar a actualizar ese elemento en la base de datos
            */
           var array=[];
           $( ".ordenacion" ).each(function( index ) {
               //index es el orden
               array.push($(this).children("input").val());

           });

           $.ajax({
               url: '<?=base_url('index.php/CrudPasosEvacuacion/ordenarStatus')?>',
               data: {arreglo: array},
               type: 'POST',
               dataType: 'JSON',
           });
            setTimeout(function(){
                swal({
                    title: "EXITO!",
                    text: "Se ordenaron los pasos!",
                    type: "success"
                }, function(){
                    window.location="CrudPasosEvacuacion";
                });
            }, 1000);
        }
    
    function ordenarProcesos() 
    {
        $('#modalOrdenacion').modal('show')
    }

    $(function  () 
    {
        $("ul.listaOrdenacion").sortable();
    });

        
    </script>



    <script type="text/javascript">
        function confirmaDeletePaso(id)
        {
            //alert ("id"+id);
            swal({
                    title: "Aviso",
                    text: "¿Desea borrar esta paso de evacuación?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function(){
                    location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudPasosEvacuacion/deletePaso/"+id;
                });

        }
    </script>


    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $('#tabla-pasos').dataTable();
        }
    </script>

    

<?php
include "footer.php";
?>