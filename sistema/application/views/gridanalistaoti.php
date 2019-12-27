<?php
include "header.php";
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- DataTable -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript">
        $(function(){
            $("#form").on("submit",function(e){
                var qq = $('#form').serialize()

                var url;
                var total = $("#tot").val();
                $('#cargando').html('<img src="https://cointic.com.mx/IntraNet/Admin/assets/images/loading.gif"/>');

                url = "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudOti/AsignaAnalistaInmueble/';?>"+total;
//alert(url)
                e.preventDefault();
                var f = $(this);
                var formData = new FormData(document.getElementById("form"));
                //alert(total)
                $.ajax({
                    url: url,
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                    .done(function(res){
                        //alert(res)
                        swal({
                                title: "HECHO",
                                text: "Asignación exitosa.",
                                type: "success",

                                confirmButtonText: "Aceptar",
                                closeOnConfirm: false
                            },
                            function(){
                                location.reload();
                            });


                    });

            });
        });
    </script>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <!-- <h2>NORMAL TABLES</h2> -->
            </div>
            <div class="search-bar">
                <div class="search-icon">
                    <i class="material-icons">search</i>
                </div>
                <input type="text" placeholder="Buscar...">
                <div class="close-search">
                    <i class="material-icons">close</i>
                </div>
            </div>

            <div class="block-header">
                <?php $tipo=$this->session->userdata('tipoUser');
                if($tipo!='' && $_SESSION['idusuariobase'] != '')
                {

                    if($tipo == 3){
                        echo "<a href='".site_url('CrudOti/coordinador')."'>
                        <button type='button' class='btn btn-default btn-circle-lg waves-effect waves-circle waves-float'>
                            <i class='material-icons'>arrow_back</i>
                        </button>
                        </a>";
                    } else{
                        echo "<a href='javascript:history.back()'>
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
                                Analistas asignados a la OTI

                            </h2>

                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">person_add</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a data-toggle='modal' data-target='#myModalAltaAnalista'>Asignar analista</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tabla-analsistas">
                                <thead>
                                <tr>
                                    <?php echo "<input type='hidden' id='idOtiCaja' name='idOtiCaja' value='$idOti'>"; ?>


                                    <th>Nombre</th>
                                    <th>Servicio / Norma</th>
                                    <th>Centro de trabajo</th>
                                    <th>Dirección</th>
                                    <th>Tipo</th>

                                    <th>Eliminar</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                foreach ($analistaOti as $row) {
                                    $idUsuario=$row["idUsuario"];
                                    $NombreUser=$row["nombre"];
                                    $nombreInmueble=$row["centroTrabajo"];
                                    $direccionInmueble=$row["direccion"];
                                    $idAsignacion=$row["idAsignacion"];
                                    $idAnalistaOti=$row["idAnalistaOti"];
                                    $nombreProyecto=$row["nombreProyecto"];
                                    $subservicio=$row["subservicio"];
                                    $idOti=$row["idOti"];
                                    $tipoan=$row['tipo'];

                                    if($tipoan == 0){
                                        $ta = 'Pendiente';
                                    } elseif($tipoan == 1){
                                        $ta = 'Responsable';
                                    } else{
                                        $ta = 'Apoyo';
                                    }

                                    echo "<tr>
                                                
                                                <td>$NombreUser</td>
                                                <td>
                                                    $nombreProyecto / $subservicio                                             
                                                </td>
                                                <td>
                                                    $nombreInmueble                                                  
                                                </td>
                                                
                                                <td>
                                                $direccionInmueble
                                                </td>
                                                <td>
                                                 $ta 
                                                </td>
                                                <td><a href='#' onclick='confirmaDeleteUser($idAnalistaOti,$idOti);'><i class='fa fa-trash'></i></a>
                                                </td>
                                            </tr>";

                                }

                                ?>
                                </tbody>
                            </table>

                            <!--  <div align="center">
                               <div>
                                  <nav>
                                      <?php echo $page; ?>
                                  </nav>
                               </div>
                            </div> -->

                        </div>
                    </div>



                </div>

            </div>
        </div>
    </section>
    <!-- inicio ventana modal asignar analista -->
    <form method="post" action="" id="form"   enctype="multipart/form-data">


        <div class="modal fade" id="myModalAltaAnalista" role="dialog">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Por favor seleccione un analistas para asignar la Oti <p id="nombreTitul"></p></h4>
                    </div>

                    <div class="modal-body">
                        <input type='hidden' id='idOti' name='idOti' value='<?php print $idOti; ?>'>
                        <div align="center" class="row">
                            <div class="col-md-6">
                                <div class="form-group form-float" style="margin-top: 13px;">
                                    <label for="AnalistaId">Analistas</label>
                                    <div class="form-line">
                                        <select id="analistaId" name="analistaId" onchange="getTotal()" style="width: 100%; border: none;" required>
                                            <option value="">Seleccione un analista</option>
                                            <?php foreach ($analistas as $row) {
                                                $idAnalista=$row["idUsuario"];
                                                $nombreAnalista=$row["nombre"];
                                                echo " <option value='$idAnalista'>$nombreAnalista</option>";
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-sm-4">
                    <div class="form-group"  style="margin-top: 13px;">
                    <label for="Tt">Selecciona un centro de trabajo  </label>
                        <div class="form-line">
                             <select id="asignacion" name="asignacion" onchange="getTotal()" style="width: 100%; border: none;" required>
                                <option value="">Selecciones un centro de trabajo</option>
                                <?php foreach ($asignacion as $row) {
                                $idAsignacion=$row["idAsignacion"];
                                $nombreInmueble=$row["nombre"];
                                echo " <option value='$idAsignacion'>$nombreInmueble</option>";
                            } ?>
                            </select>
                        </div>
                    </div>
                </div> -->
                            <div class="col-md-6">
                                <div class="form-group form-float" style="margin-top: 13px;">
                                    <label for="AnalistaId">Tipo de analista</label>
                                    <div class="form-line">
                                        <select name="analistatipo" id="analistatipo" style="width: 100%; border: none;">
                                            <option value="">Seleccione una opción</option>
                                            <option value="1">Responsable</option>
                                            <option value="2">Apoyo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Centro de trabajo</th>
                                    <th>Servicio</th>
                                    <th>Norma/Subservicio</th>
                                    <th>Seleccionar</th>

                                </tr>
                                </thead>
                                <tbody id="listadoCentro">
                                <?php
                                $contador=1;
                                foreach ($asignacion as $row) {
                                    $idAsignacion=$row["idAsignacion"];
                                    $nombreInmueble=$row["nombre"];
                                    $servicio=$row["servicio"];
                                    $subservicio=$row["subservicio"];
                                    echo "<tr><td>$nombreInmueble</td>
                                                <td>$servicio</td>
                                                <td>$subservicio</td>
                                                <td><input type='checkbox' id='Cent$idAsignacion'  name='Cent$contador' value='$idAsignacion' class='filled-in'><label for='Cent$idAsignacion'></label>
                                                </td>
                                            </tr>";
                                    $contador++;

                                }
                                foreach ($totaRegi as $rowT) {
                                    $total=$rowT["total"];
                                }
                                echo "<input type='hidden' name='tot' id='tot' value='$idAsignacion'>"; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div align="center">
                        <input type="submit" class="btn bg-red waves-effect waves-light" value="Asignar">
                    </div>

                    <div class="modal-footer">


                        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>

        </div>
    </form>

    <!-- fin ventana modal -->

    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $('#tabla-analsistas').dataTable();
        }
    </script>

    <script type="text/javascript">
        function confirmaDeleteUser(id,idOti)
        {
            //alert ("id"+id);
            

            swal({
                    title: "Aviso",
                    text: "¿Desea borrar el usuario?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                    url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/eliminarAsignaOtiSSH/" + id+"/"+idOti,
                    type: "get",
                    dataType: "html",
                    success: function(data)
                    {
                        location.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
                    //location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudOti/eliminarAsignaOti/"+id+"/"+idOti;
                });

        }

        //obtener total de otis asignadas en proceso al análista
        function getTotal()
        {
            var idUser=$("#analistaId").val();
            if (idUser!="") {
                $.ajax({
                    url : "<?php echo site_url('CrudOti/getTotalInmueblesAnalista/')?>/" + idUser,
                    type: "get",
                    dataType: "json",
                    success: function(data)
                    {
                        $("#TotalOtisUs").val(data.total);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }
        }


        /*function AsignarAnalista()
        {
         var idAsignacion=$("#asignacion").val();
         var  idAnalista=$("#analistaId").val();
         var  oti=$("#idOtiCaja").val();
         var tipo=$("#analistatipo").val();
         //alert("oti"+oti);
         if (idAnalista!="") {
                 $.ajax({
                     url : "<?php echo site_url('CrudOti/AsignaAnalistaInmueble/')?>/"+idAsignacion+"/"+idAnalista+"/"+oti+"/"+tipo,
                    type: "post",
                    dataType: "html",
                    success: function(data)

                    {
                    //   alert(data);
                      swal({
                          title: "HECHO",
                          text: "Asignación exitosa.",
                          type: "success",

                          confirmButtonText: "Aceptar",
                          closeOnConfirm: false
                        },
                        function(){
                          location.reload();
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }
                });
            }else{
                swal("AVISO", "Seleccione un analista", "error")
            }
       }*/


    </script>

<?php
include "footer.php";
?>