<?php 
  include "header.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

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
                                Indicadores de bitacoras registradas
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">line_style</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras/formAltaindicadorBitacora">Registrar Indicador</a></li>
                                        
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table id="tabla" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Indicador</th>
                                        <th>Tipo de campo</th>
                                        <th>Modificar</th>
                                        <th>Ponderadores</th>
                                        <th>Cálculos</th>
                                        <th>Contador</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $conte=1;
                                    foreach ($listaIndicador as $row) {
                                        $idIndicador=$row["idIndicador"];
                                        $nombreIndicador=$row["nombreIndicador"];
                                        $esContador=$row['esContador'];
                                        if($esContador)
                                            $nombreIndicador.=" - Contador";
                                        $tipoIndicador=$row["tipoIndicador"];
                                        $required=$row["required"];
                                        if ($tipoIndicador==2) {
                                            $tip="Campo Abierto";
                                             $funcion="onclick='mensajeAviso();'";
                                            $disabled="disabled";
                                        }
                                         if ($tipoIndicador==3) {
                                           $tip="Formato de fecha";
                                             $funcion="onclick='mensajeAviso();'";
                                              $disabled="disabled";
                                        }
                                         if ($tipoIndicador==1) {
                                            $disabled="";
                                             $funcion="";
                                             $tip="Opcion Multiple";
                                        }
                                        if ($tipoIndicador==4) {
                                            $disabled="disabled";
                                            $funcion="";
                                            $tip="Indicador vacio";
                                        }

                                        echo "
                                            <tr>
                                                <td>$conte</td>
                                                <td>$nombreIndicador</td>
                                                <td>$tip</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras/formEditarIndicadoresBitacora/$idIndicador'><i class='fa fa-pencil-square-o'></i></a>
                                                </td>
                                                <td class='$disabled'>
                                                    <a $funcion  href='https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras/ponderadorIndicador/$idIndicador'><i class='fa fa-sitemap'></i></a>
                                                </td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/index/$idIndicador'><i class=\"fa fa-sliders\" aria-hidden=\"true\"></i></a>
                                                </td>
                                                <td><a onClick='establecerContador($idIndicador, $esContador)' href='#'><i class=\"fa fa-plus-square-o\" aria-hidden=\"true\"></i></a></td>
                                                <td><a href='#' onclick='confirmaDeleteindicadorBitacora($idIndicador);'><i class='fa fa-trash'></i></a></td>
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
        window.onload=inicio;
        function inicio() {
            $("#tabla").DataTable();
        }
        function establecerContador(id, esContador)
        {
            var texto="¿Desea establecer este indicador como contador?";
            if(esContador==1)
                texto="¿Desea quitar este indicador como contador?";
            swal({
                    title: "Aviso",
                    text: texto,
                    type: "info",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function(){
                    location.href="<?=site_url('Crudindicadoresbitacoras/establecerComoContador/')?>"+id;
                });

        }
        function confirmaDeleteindicadorBitacora(id)
       {

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
              location.href="https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras/deleteindicadorBitacora/"+id;
            });
          
       }
       function mensajeAviso(){
        alert("son campos abiertos")
       }
    </script>
    <style type="text/css">
        .disabled {
     pointer-events: none; 
     cursor: default; 
     opacity: 0.6; 
}
    </style>
    <?php 
  include "footer.php";
?>
<!-- <?php 
  //include "footer.php";
 ?> -->