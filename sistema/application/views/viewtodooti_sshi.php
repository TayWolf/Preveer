<?php
include "header.php";
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- DataTable -->
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cointic.com.mx/preveer/sistema/assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">


    <script type="text/javascript">
        function modificaEstado(idOti)
        {

            $('#status'+idOti).on('change', function(event) {
                if($(this).is(':checked'))
                {
                    var url;
                    url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/activarOti/"+idOti;
                    $.ajax({
                        url : url,
                        type: "POST",
                        data: {'idOti':idOti},
                        dataType: "HTML",
                        success: function(data)
                        {
                            swal('EXITO!', 'Oti Activada, El estado de la oti ha cambiado a activo', 'success');
                        }
                    });
                }


                else
                {

                    var url;
                    url= "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/desactivarOti/"+idOti;
                    $.ajax({
                        url : url,
                        type: "POST",
                        data: {'idOti':idOti},
                        dataType: "HTML",
                        success: function(data)
                        {
                            swal('EXITO!', 'Oti Desactivada, El estado de la oti ha cambiado a Inactivo', 'success');
                        }
                    });
                }
            });
        }
    </script>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <a href="<?=site_url('menus');?>">
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
                                OTI´S Registrados

                            </h2>
                            <?php $tipo=$this->session->userdata('tipoUser');
                            $areaUser=$this->session->userdata('area');
                            if($tipo!='' )
                            {
                                if($tipo == 1 || $tipo == 2){
                                    echo "<ul class='header-dropdown m-r--5'>
                        <li class='dropdown'>
                            <a href='javascript:void(0);' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>
                                <i class='material-icons'>playlist_add_check</i>
                            </a>
                            <ul class='dropdown-menu pull-right'>
                                <li><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/formAltaOti'>Registrar OTI</a></li>
                            </ul>
                        </li>
                    </ul>";
                                }
                            }

                            ?>

                        </div>
                        <div class="body table-responsive">
                            <table class="table table-hover" id="tabla-otis">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Formatos</th>
                                    <th>Detalle</th>
                                    <?php  if ($tipoUser==1||$tipoUser==5||$tipoUser==9) {
                                        echo "<th>Coordinador</th>";
                                        echo "<th>Analistas</th>";
                                        echo "<th>C/Trabajo</th>";
                                        echo "<th>Datos complementarios</th>";
										
                                    }
                                    elseif($tipoUser==2){
                                        echo "<th>C/Trabajo</th>";
                                        echo "<th>Datos complementarios</th>";
                                    }
                                    elseif ($tipoUser==3) {
                                        echo "<th>Analistas</th>";
                                        echo "<th>C/Trabajo</th>";
                                    } elseif($tipoUser==4){
                                        echo "<th>C/Trabajo</th>";
                                        if($areaUser==2)
                                            echo "<th>Datos complementarios</th>";
                                    }
                                    ?>
                                    <th>Estado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $conte=1;
                                foreach ($listOti as $row) {
                                    $idOti=$row["idOti"];
                                    $nombreCliente=$row["nombreCliente"];
                                    $centroTrabajo=$row["centroTrabajo"];
                                    $coordinador=$row["idCoordinador"];
                                    $analistas=$row["statusAnalista"];
                                    $estado=$row["statusActiva"];


                                    if ($tipoUser==1||$tipoUser==5||$tipoUser==9) { //valida que el usuario sea administrador
                                        $botonCentroT= "<td> <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/listCentroTrabajoSSHI/$idOti'><i class='fa fa-building-o' style='color:green'></i></a></td>";
                                        $analistasSSH="";
                                        if($tipoUser==1)
                                            $analistasSSH="SSH";
                                        if ($coordinador>0) //ponde en color verde el botón del coordinador en caso de que ya se haya aignado uno
                                        {
                                            $boton= "<td> <a onclick='identificaId($idOti)' data-toggle='modal' data-target='#myModalAsinacion'><i class='fa fa-sitemap' style='color:green'></i></a></td>";

                                            if($analistas>0)
                                            {
                                                $botoAnalista= "<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/cargarAnalistasOti$analistasSSH/$idOti'><i class='fa fa-user-circle-o' style='color:green'></i></a></td>";
                                            }
                                            else
                                            {
                                                $botoAnalista= "<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/cargarAnalistasOti$analistasSSH/$idOti'><i class='fa fa-user-circle-o' ></i></a></td>";
                                            }


                                        }
                                        else
                                        {
                                            $boton= "<td> <a onclick='identificaId($idOti)' data-toggle='modal' data-target='#myModalAsinacion'><i class='fa fa-sitemap'></i></a></td>";

                                            if($analistas>0)
                                            {
                                                $botoAnalista= "<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/cargarAnalistasOti$analistasSSH/$idOti'><i class='fa fa-user-circle-o' style='color:green'></i></a></td>";
                                            }
                                            else
                                            {
                                                $botoAnalista= "<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/cargarAnalistasOti$analistasSSH/$idOti'><i class='fa fa-user-circle-o' ></i></a></td>";
                                            }
                                        }

                                    }else{
                                        $boton= "";
                                        $botonCentroT= "";
                                        $botoAnalista ="";
                                    }
                                    if($tipoUser==2){
                                        $boton= "<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/listCentroTrabajoSSHI/$idOti'><i class='fa fa-building-o' style='color:green'></i></a></td>";
                                    }
                                    if ($tipoUser==3) {
                                        $botonCentroT= "<td> <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/listCentroTrabajo/$idOti'><i class='fa fa-building-o' style='color:green'></i></a></td>";
                                        if($analistas>0)
                                        {
                                            $boton= "<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/cargarAnalistasOti/$idOti'><i class='fa fa-user-circle-o' style='color:green'></i></a></td>";
                                        }
                                        else
                                        {
                                            $boton= "<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/cargarAnalistasOti/$idOti'><i class='fa fa-user-circle-o' ></i></a></td>";
                                        }
                                    } if($tipoUser == 4){
                                        $botonCentroT= "<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/listCentroTrabajo/$idOti'><i class='fa fa-building-o' style='color:green'></i></a></td>";
                                        if($areaUser==2)
                                            $botonCentroT= "<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/listCentroTrabajo/$idOti'><i class='fa fa-building-o' style='color:green'></i></a></td>
                                                    <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisssh/otrosDatos/$idOti' ><i class='material-icons'>playlist_add_check</i></a></td>";
                                    }
                                    $statusActiva="";
                                    if($estado==1)
                                    {
                                        $statusActiva="Checked";
                                    }
                                    echo "
                                            <tr>
                                                <td>$idOti</td>
                                                <td>$nombreCliente</td>
                                                <td>$centroTrabajo</td>
                                                <td>
                                                    <a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/formDetalleOti/$idOti/ssh'><i class='fa fa-eye'></i></a>
                                                </td>
                                                $boton
                                                
                                                $botoAnalista
                                                $botonCentroT
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisssh/otrosDatos/$idOti' ><i class='material-icons'>playlist_add_check</i></a></td>
                                                <td>
                                                    <div class='col-sm-3' style='margin-bottom:0px;'>
                                                        <div class='switch primary-switch'>
                                                            <label><input id='status$idOti' onclick='modificaEstado($idOti);' type='checkbox' $statusActiva><span class='lever switch-col-green'></span></label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>";
                                    //<td><a href='#' onclick='confirmaDeleteOti($idOti);'><i class='fa fa-trash'></i></a></td>

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
    <div class="modal fade" id="myModalAsinacion" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Por favor seleccione un coordinador para asignar la Oti <p id="nombreTitul"></p></h4>
                </div>
                <div class="modal-body">
                    <div align="center" class="row">
                        <div class="col-md-6">
                            <div class="form-group form-float" style="margin-top: 13px;">
                                <div class="form-line">
                                    <label for="cordinaId">Coordinadores</label>
                                    <input type="hidden" id="idIdentif" name="idIdentif">
                                    <select id="cordinaId" name="cordinaId" onchange="getTotal()" style="width: 100%; border: none;" required>
                                        <option value="">Seleccione un coordinador</option>
                                        <?php foreach ($cooridnadores as $row) {
                                            $idCord=$row["idUsuario"];
                                            $nombreCord=$row["nombre"];
                                            echo " <option value='$idCord'>$nombreCord</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="Tt">OTI asignados para este coordinador </label>
                                    <input type="text" id="TotalOtisUs" name="TotalOtisUs" class="form-control" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div align="center">
                    <input type="submit" onclick="AsignarCoord();" class="btn bg-red waves-effect waves-light" value="Asignar">
                </div>
                <div class="modal-footer">


                    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">


        function getTotal()
        {
            var idUser=$("#cordinaId").val();
            if (idUser!="") {
                $.ajax({
                    url : "<?php echo site_url('CrudOti/getTotal/')?>/" + idUser,
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
        function confirmaDeleteOti(id)
        {
            //alert ("id"+id);
            swal({
                    title: "Aviso",
                    text: "¿Desea borrar este registro?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false
                },
                function(){
                    swal("OPPS", "Estamos trabajando en este comando", "error")
                    //location.href="https://cointic.com.mx/preveer/sistema/index.php/CrudOti/deleteEntregable/"+id;
                });

        }
        function identificaId(idOti)
        {
            $("#idIdentif").val(idOti);
            asignaBase();
        }

        function AsignarCoord()
        {
            var idOt=$("#idIdentif").val();
            var  idCorde=$("#cordinaId").val();
            if (idCorde!="") {
                $.ajax({
                    url : "<?php echo site_url('CrudOti/modiFic/')?>/" + idOt+"/"+idCorde,
                    type: "post",
                    dataType: "html",
                    success: function(data)
                    {
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
                swal("AVISO", "Seleccione un coordinador", "error")
            }
        }


        function asignaBase()
        {
            var idOt=$("#idIdentif").val();
            $.ajax({
                url : "<?php echo site_url('CrudOti/obtenerDatos/')?>/" + idOt,
                type: "post",
                dataType: "json",
                success: function(data)
                {
                    if (data.length>0)
                    {
                        for (i=0; i<data.length; i++) {

                            $("#cordinaId").val(data[i]['idCoordinador']);
                            getTotal();
                        }
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

    </script>


    <script type="text/javascript">
        window.onload=inicio;
        function inicio()
        {
            $('#tabla-otis').dataTable({"order": [[ 0, "desc" ]]});
        }
    </script>


<?php
include "footer.php";
?>