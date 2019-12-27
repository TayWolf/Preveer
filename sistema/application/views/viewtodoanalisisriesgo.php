<?php 
  include "header.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
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
              location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/deleteCentroTrabajo/"+id; 
            });
          
       }
    </script>
    <section class="content">
        <div class="container-fluid">
        <div class="block-header">
        <?php $tipo=$this->session->userdata('tipoUser');
         $areaUse=$this->session->userdata('area');
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
                                Centros de trabajo
                            </h2>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover formatos-reg">
                                <thead>
                                    <tr>
                                         <?php
                                         $encabezado="";
                                         if ( $areaUse=="2" || $tipo=="1") {

                                          $botonEncabezado="<th>#</th><th>Formato</th><th>Norma</th>";
                                          $botonEncabezadoDos="";
                                        }else{
                                           $botonEncabezado="";
                                           $botonEncabezadoDos="";
                                             $encabezado= "
                                        <th>Centro de trabajo</th>
                                        <th>Datos Generales</th>
                                        <th>Colindancia</th>
                                        <th>Instalaciones Hidraulicas</th>
                                        <th>Instalaciones Eléctricas</th>
                                        <th>Revisión de instalaciones</th>
                                        <th>Materiales peligrosos</th>
                                        <th>Residuos peligrosos</th>
                                        <th>Equipo Dieléctrico</th>
                                        <th>Equipo Bombero</th>
                                        <th>Primeros Auxilios</th>
                                        <th>Red contra incendios</th>
                                        <th>Alertamiento</th>
                                        <th>Extintores</th>";

                                        }
                                        echo "$encabezado $botonEncabezado
                                               $botonEncabezadoDos"; ?>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $conte=1;
                                    foreach ($listAnalisisRiesgo as $row) {
                                        $idCentroTrabajo=$row["idAsignacion"];
                                        $nombre=$row["nombre"];

                                        $idOti=$row["idOti"];
                                        $idSubservicio=$row["idSubservicio"];


                                        if ( $areaUse=="2" || $tipo=="1" )
                                        {
                                            $nombreFormato=$row["nombreFormato"];

                                          $botonCuerpo=" <tr><td>".$idOti."</td><td>$nombreFormato</td><td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalistaNormas/normasOti/$idOti' ><i class='material-icons'>library_books</i></a></td>";
                                          $botonCuerpoDos=" </tr>";
                                            $html="$botonCuerpo $botonCuerpoDos";
                                        }else{
                                           $botonCuerpo="";
                                           $botonCuerpoDos="";
                                            $html="
                                            <tr><td>$nombre</td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formDatosGenerales/$idCentroTrabajo'><i class='fa fa-file-text'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formColindancia/$idCentroTrabajo'><i class='material-icons'>place</i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formInstalacionesHidraulicas/$idCentroTrabajo'><i class='fa fa-wrench'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formInstalacionesElectricas/$idCentroTrabajo'><i class='material-icons'>ev_station</i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formRevisionInstalaciones/$idCentroTrabajo'><i class='material-icons'>check_box</i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formMaterialesPeligrosos/$idCentroTrabajo'><i class='fa fa-warning'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formResiduosPeligrosos/$idCentroTrabajo'><i class='fa fa-exclamation-circle'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formEquipoDielectrico/$idCentroTrabajo'><i class='fa fa-universal-access'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formEquipoBombero/$idCentroTrabajo'><i class='fa fa fa-fire'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formPrimerosAuxilios/$idCentroTrabajo'><i class='fa fa-medkit'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/Crudhidrantes/formHidrantes/$idCentroTrabajo'><i class='fa fa-tint'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formSensores/$idCentroTrabajo'><i class='fa fa-eye'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo/formExtintores/$idCentroTrabajo'><i class='fa fa-fire-extinguisher'></i></a></td>
                                                $botonCuerpo
                                                $botonCuerpoDos
                                               
                                            </tr>";

                                        }
                                        echo $html;

                                            
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
<script>
    $(document).ready(function () {
        $("table").dataTable({
            "order": [[ 0, "desc" ]]
        });
    })
</script>
    <?php 
  include "footer.php";
?>
<!-- <?php 
  //include "footer.php";
 ?> -->