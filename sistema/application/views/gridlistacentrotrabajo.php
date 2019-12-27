<?php
include "header.php";
?>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.min.js"></script>
<script src="https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-tabledit-1.2.3/jquery.tabledit.js"></script>

<script type="text/javascript">
    var array=
        {'datos':[]};
</script>
<section class="content">
    <div class="container-fluid">
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
                    echo "<a href='".site_url('CrudOti')."'>
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
                            Centros de trabajos de la OTI

                        </h2>
                        <input type="hidden" id="tipoUser" name="tipoUser" value="<?php echo $tipo; ?>">
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Centro de trabajo</th>
                                <th>Servicio</th>
                                <th>Subservicio</th>
                                <?php
                                if($tipo!=2)
                                {
                                    ?>
                                    <th>Visita inicial</th>
                                    <th>Revisión Doctos.</th>
                                    <th>Check list</th>
                                    <?php
                                }
                                ?>

                                <th>Entregables</th>
                                <?php
                                if($tipo!=2)
                                {
                                    ?>
                                    <th>Acuse de visita</th>
                                    <th>OM</th>
                                    <?php
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $contador=1;
                            foreach ($cenTra as $row) {
                                $nombreCent=$row["nombre"];
                                $idCentroTrabajo=$row["idCentroTrabajo"];
                                $idAsignacion=$row["idAsignacion"];
                                $servicio = $row["servicio"];
                                $subservicio = $row["subservicio"];
                                $idOti = $row["idOti"];
                                $porcentaje=$row["porcentajeValor"];

                                if($isVisita > 0){
                                    $icn = "<a  data-toggle='modal' data-target='#myModalfechaini' onclick='identi($idAsignacion)'><i class='fa fa-calendar-check-o' style='color:green'></i></a>";
                                }else{
                                    $icn = "<a data-toggle='modal' data-target='#myModalfechaini' onclick='identi($idAsignacion)'><i class='fa fa-calendar-check-o'></i></a>";
                                }

                                if($isVisitaDocs > 0){
                                    $icnDoc = "<a data-toggle='modal' data-target='#myModalfechadoctos' onclick='identiDoct($idAsignacion)'><i class='fa fa-eye' style='color:green'></i></a>";
                                }else{
                                    $icnDoc = "<a data-toggle='modal' data-target='#myModalfechadoctos' onclick='identiDoct($idAsignacion)'><i class='fa fa-eye'></i></a>";
                                }

                                if($tipo!=2)
                                    echo "
                                            <tr>
                                                <td>$contador</td>
                                                <td>$nombreCent</td>
                                                <td>$servicio</td>
                                                <td>$subservicio</td>
                                                <td>
                                                 $icn   
                                                </td>
                                                 <td>
                                                 $icnDoc
                                                </td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudOti/verificacionControlcalidad/$idAsignacion/$idOti' ><i class='fa fa-check-square-o'></i> </a>%<label id='porcentaje$contador'>$porcentaje</label></td>
                                                
                                                <td><a href='#' onClick='asignaEntregables($idAsignacion)'><i class='fa fa-files-o'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudVisitaAcuse/acuse/$idAsignacion/$idCentroTrabajo'><i class='fa fa-briefcase'></i></a></td>
                                                <td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudVisitaAcuse/oportunidadMejora/$idAsignacion'><i class='fa fa-check-circle-o' aria-hidden='true'></i></a></td>
                                                
                                            </tr>";
                                else
                                    echo "
                                            <tr>
                                                <td>$contador</td>
                                                <td>$nombreCent</td>
                                                <td>$servicio</td>
                                                <td>$subservicio</td>
                                                <td><a href='#' onClick='asignaEntregables($idAsignacion)'><i class='fa fa-files-o'></i></a></td>
                                            </tr>";
                                $contador++;
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
<div class="modal fade" id="myModalfechaini" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Por favor indique la fecha de visita. <p id="nombreTitul"></p></h4>
            </div>
            <div id="tablaListadoHistorial" style="display: none;">
                <div align="center">
                    <h5>Historial de visitas</h5>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fechas de visita</th>
                        </tr>
                        </thead>
                        <tbody id="listadoVis">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-body">
                <div align="center" class="row">
					
					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<form>
	
									<label for="Tt">Próxima fecha de visita </label>
									<input type="date" id="fechaVisit" name="fechaVisit" class="form-control" required />
									<input type="hidden" id="idIdentif" name="idIdentif">
									<input type="hidden" id="fechaActual" name="fechaActual" value="<?php echo date('Y-m-d'); ?>">
								
								</form>
	
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-line">
								<label for="coments">Comentario</label>
								<input type="text" class="form-control" id="coments" name="coments" placeholder="Comentario fecha de visita" required>
							</div>
						</div>
					</div>

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div align="center">
                        <input type="submit"  onclick="AgendarCita()" class="btn bg-red waves-effect waves-light" value="Agendar">

                    </div>
                </div>
                <!-- <div class="col-sm-6">
                    <div align="center">
                       <button onclick="confirmaEntrega();" class="btn bg-red waves-effect waves-light">Entregar Proyecto</button>
                    </div>
                </div> -->
            </div>

            <div class="modal-footer">


                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModalfechadoctos" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Por favor indique la fecha de revisión de documentos.</h4>
            </div>
            <div class="modal-body">
                <div align="center" class="row">
					
                    <div class="col-sm-12" id="tablaListadoHistorialDoc" style="display: none;">
                        <div align="center">
                            <h5>Historial de visitas</h5>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
						
                            <table class="table" id="tablaRevisionDocumentos">
                                <thead>
                                <tr>
                                    <th style="display: none;">ID</th>
                                    <th>#</th>
                                    <th>Fechas de revisión</th>
                                    <!--<th>Comentario</th>-->
                                </tr>
                                </thead>
                                <tbody id="listadoVisDoctos">

                                </tbody>
                            </table>
                        </div>
                    </div>
					
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="Tt">Próxima fecha de revisión de documentos </label>
                                <input type="date" id="fechaVisitDoctos" name="fechaVisitDoctos" class="form-control" />
                                <input type="hidden" id="idIdentifDoctos" name="idIdentifDoctos">
                                <input type="hidden" id="fechaActualDoctos" name="fechaActualDoctos" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="form-line">
                                <label for="comentdocs">Comentarios</label>
                                <input type="text" class="form-control" id="comentdocs" name="comentdocs" placeholder="Comentario fecha de visita" required>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div align="center">
                        <input type="submit"  onclick="AgendarCitaDoctos()" class="btn bg-red waves-effect waves-light" value="Agendar">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModalEntregables" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Por favor indique los entregables del centro de trabajo.</h4>
            </div>
            <div class="modal-body">
                <div align="center" class="row">
                    <form action="#" id="formEntregable">
                        <input type="hidden" id="entregableID" name="entregableID" required>
                        <input type="hidden" id="contadorEntregables" name="contadorEntregables" required>
                        <div class="col-sm-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Seleccionar</th>
                                    <th scope="col">Entregable</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Nota</th>
                                </tr>
                                </thead>
                                <tbody id="listaEntregables">

                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div align="center">
                        <?php
                        if ($tipo!=4) {
                            echo "<input type='submit' class='btn bg-red waves-effect waves-light' value='Guardar cambios'>";
                        }else
                        {
                            echo "";
                        }
                        ?>
                        <!-- <input type="submit" class="btn bg-red waves-effect waves-light" value="Guardar cambios"> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                </form>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    function  identi(id)
    {
        var id=id;
        $("#listadoVis").html("");
        $("#idIdentif").val(id);
        $.ajax({
            url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/getHistorialVi/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                if (data.length>0)
                {
                    $("#tablaListadoHistorial").show();
                    var ii=1;
                    for (i=0; i<data.length; i++)
                    {

                        $("#listadoVis").append('<tr><th scope="row">'+ii+'</th><td>'+data[i]['fechaAgenda']+'</td><td>'+data[i]['comentario']+'</td></tr>');

                        ii++;
                    }
                }else{
                    $("#tablaListadoHistorial").hide();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    function  identiDoct(id)
    {
        //id es idAsignacion
        var id=id;
		
        $("#listadoVisDoctos").html("");
        $("#idIdentifDoctos").val(id);
        $.ajax({
            url : "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/getHistorialDoc/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                if (data.length>0)
                {
                    $("#tablaListadoHistorialDoc").show();
                    
					for (i=0; i<data.length; i++){
						if(data[i]['comentario']==null){
							
							var comentarioaux='';

						}else {
							var comentarioaux=data[i]['comentario'];
						}		
						$("#listadoVisDoctos").append('<tr><th scope="row">'+(i+1)+'</th><td>'+data[i]['fechaAgenda']+'</td><td>'+comentarioaux+'</td></tr>');
                    }

                    <?php if($this->session->userdata('tipoUser')==5)
                    {?>
                    $('#tablaRevisionDocumentos').Tabledit({
                        url: '<?=site_url('CrudOti/cambiarFechaRevisionDocumentos/')?>',
                        editButton: false,
                        deleteButton: false,
                        columns: {
                            identifier: [0, 'id'],
                            editable: [[2, 'fecha'], [3, 'comentario']]
                        }
                    });
                    <?php
                    }?>
                }else{
                    
					$("#tablaListadoHistorialDoc").hide();
                }
            },
            complete: function ()
            {

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
        function verEdicionRevision(idVisita, elemento, noColumna)
        {
            var valor=$(elemento).html();
            //columna de fecha
            if(noColumna==2)
            {
                $(elemento).html('<input type="date" onchange="cambiarFechaVisita('+idVisita+', this)" value="'+valor+'" id="fechaVisita'+idVisita+'">');
            }
            //columna de comentario
            else if(noColumna==3)
            {
                $(elemento).html('<input type="text" onchange="cambiarVisita('+idVisita+', this)" value="'+valor+'" id="fechaVisita'+idVisita+'">');

            }
        }
    }

    /*function confirmaEntrega()
    {
      var idI=$("#idIdentif").val();
      var fechaActual=$("#fechaActual").val();
      swal({
          title: "¿Desea finalizar visitas?",
          text: "Si acepta esta opción no podrá agendar mas visitas para este centro de trabajo.",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Finalizar visitas",
          closeOnConfirm: false
        },
        function(){
           var url;
              url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/cerrarVisita/"+idI+"/"+fechaActual;
              $.ajax({
                url : url,
                  type: "POST",
                  dataType: "HTML",
              success: function(data)
                {
                  swal('ÉXITO', 'OTI cerrado', 'success');
                  $('#myModalfechaini').modal('hide');
                }
              });
        });

    }*/
    function AgendarCita()
    {
        var fechaVisita=$("#fechaVisit").val();
        var idIdentif=$("#idIdentif").val();
        var comentario = $("#coments").val();
		
		if(!fechaVisita)
		{
            swal('ERROR', 'La fecha de visita esta vacia', 'error');
			return;	
		}
			
        var parametro={"fechaVisita":fechaVisita,"idIdentif":idIdentif,"coments":comentario}
        var url;
        url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/AgendarVisita/";
        $.ajax({
            url : url,
            type: "POST",
            data: parametro,
            dataType: "HTML",
            success: function(data)
            {
                swal('AGENDADO', 'Visita agendada', 'success');
                $('#myModalfechaini').modal('hide');
            }
        });
		
    }
    function AgendarCitaDoctos()
    {
        var fechaVisitadoc=$("#fechaVisitDoctos").val();
        var idIdentifdoc=$("#idIdentifDoctos").val();
        var coment = $('#comentdocs').val();
		
		if(!fechaVisitadoc)
		{
            swal('Error', 'La fecha de visita esta vacia', 'error');
			return;	
		}
		
		var parametro={"fechaVisitadoc":fechaVisitadoc,"idIdentifdoc":idIdentifdoc,"comentdocs":coment}
		var url;
        url = "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/AgendarVisitaDoctos/";
        $.ajax({
            url : url,
            type: "POST",
            data: parametro,
            dataType: "HTML",
            success: function(data)
            {
				//limpiarContenido();
                swal('AGENDADO', 'Visita agendada', 'success');
                $('#myModalfechadoctos').modal('hide');
				var vacio='';
				$("#fechaVisitDoctos").val(vaciar);
				$("#comentdocs").val(vaciar);

            }
        });
		
    }
	

	
    function asignaEntregables(idAsignaInmueble)
    {
        var habilitado='<?=($this->session->userdata('idusuariobase')==1 || $this->session->userdata('idusuariobase')==4)? "" : "disabled" ?>';

        $("#entregableID").val(idAsignaInmueble);
        $("#contadorEntregables").val(0);
        array={'datos':[]};
        $.ajax(
            {
                url: "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/obtenerListadoEntregables/",
                type: 'GET',
                dataType: 'JSON',
                success: function(data)
                {
                    $("#listaEntregables").empty();
                    for(i=0; i<data.length; i++)
                    {
                        /*var tipoUser=$("#tipoUser").val();
                        var disables="disabled";
                        if (tipoUser==4) 
                        {
                            disables="";
                        }*/
                        $("#listaEntregables").append(
                            "<tr><td><input type='hidden' name='identificador"+i+"' value='"+data[i]['idEntregable']+"'><input onChange='habilitarEntregable("+data[i]['idEntregable']+")' type='checkbox' name='entregableCheck"+i+"' id='entregableCheck"+data[i]['idEntregable']+"' "+habilitado+"><label for='entregableCheck"+data[i]['idEntregable']+"'></td><td>"+data[i]['nombreEntregable']+"</td><td><input type='number' name='entregableCantidad"+i+"' id='entregableCantidad"+data[i]['idEntregable']+"' min='1' disabled></td><td><input type='text' name='entregableNota"+i+"' id='entregableNota"+data[i]['idEntregable']+"' disabled></td></tr>"
                        );

                    }
                    $("#contadorEntregables").val(data.length);
                    var parametro={"idAsignaInmueble": idAsignaInmueble};
                    $.ajax(
                        {
                            url: "https://cointic.com.mx/preveer/sistema/index.php/CrudOti/obtenerEntregablesCentroTrabajo/",
                            type: 'POST',
                            data: parametro,
                            dataType: 'JSON',
                            success: function(data)
                            {
                                //SELECT * FROM entregableInmueble WHERE idAsignacion=idAsignaInmueble
                                for(i=0; i<data.length;i++)
                                {

                                    $("#entregableCheck"+data[i]['idEntregable']).prop('checked', true);
                                    habilitarEntregable(data[i]['idEntregable']);
                                    $("#entregableCantidad"+data[i]['idEntregable']).val(data[i]['cantidad']);
                                    $("#entregableNota"+data[i]['idEntregable']).val(data[i]['nota']);
                                }
                                $("#myModalEntregables").modal('show');
                            }
                        });
                }
            });
    }
    function habilitarEntregable(idEntregable)
    {
        var habilitado=$("#entregableCheck"+idEntregable).is(':checked');

        $("#entregableCantidad"+idEntregable).prop('required',habilitado);
        $("#entregableCantidad"+idEntregable).prop('disabled',!habilitado);
        $("#entregableNota"+idEntregable).prop('disabled',!habilitado);
        if(habilitado)
        {
            $("#entregableCheck"+idEntregable).val(idEntregable);
        }
        else
        {
            $("#entregableCheck"+idEntregable).val(0);

        }

        if($("#entregableCantidad"+idEntregable).val()=="")
            $("#entregableCantidad"+idEntregable).val(1);


    }

    $("#formEntregable").submit(function(event)
    {
        event.preventDefault();
        var url;
        $('#cargando').html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>');
        url= "<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudOti/altaEntregables/';?>"+$("#contadorEntregables").val();

        var f = $(this);
        var formData = new FormData(document.getElementById("formEntregable"));

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

                swal("HECHO", "Entregables modificados.", "success")
            });
    });

</script>
<script type="text/javascript">
    window.onload=function ()
    {

        var cantidad=<?php echo $contador;?>;

        for(i=1; i<=cantidad; i++)
        {
            colorear(i);
        }
    }
    function colorear(identificador)
    {


        if($("#porcentaje"+identificador).html()<25)
        {
            $("#porcentaje"+identificador).css("color", "red");
        }
        else if($("#porcentaje"+identificador).html()<50)
        {
            $("#porcentaje"+identificador).css("color", "darkorange");
        }
        else if($("#porcentaje"+identificador).html()<75)
        {
            $("#porcentaje"+identificador).css("color", "gold");
        }
        else if($("#porcentaje"+identificador).html()<100)
        {
            $("#porcentaje"+identificador).css("color", "green");
        }
        //hacerCuenta();
    }
</script>


<ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
    <li class='mfb-component__wrap'>
        <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
        </a>
        <ul class='mfb-component__list'>
            <li>
                <a href="<?=site_url('Catalogos')?>" data-mfb-label='Catálogos' class='mfb-component__button--child'>
                    <i class='material-icons'>import_contacts</i>
                </a>
            </li>
            <li>
                <a href="<?=site_url('CrudOti')?>" data-mfb-label='OTI' class='mfb-component__button--child'>
                    <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>

            <li>
                <a href="<?=site_url('Crudusuarios')?>"
                   data-mfb-label='Usuarios' class='mfb-component__button--child'>
                    <i class='material-icons'>person_add</i>
                </a>
            </li>
        </ul>
    </li>
</ul>

<?php



if($tipo!='' && $_SESSION['idusuariobase'] != '')
{
    //$data['page'] = $this->usuarios->data_pagination("/Crudusuarios/index/",
    //$this->usuarios->getTotalRowAllData(), 3);
    // $data['listAreas'] = $this->areas->getDatos($index);
    if($tipo == 1){ //Menu flotante para administrador
        echo "
            
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('Catalogos')." data-mfb-label='Catálogos' class='mfb-component__button--child'>
                <i class='material-icons'>import_contacts</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>

            <li>
                <a href=".site_url('Crudusuarios')."
                data-mfb-label='Usuarios' class='mfb-component__button--child'>
                <i class='material-icons'>person_add</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>        
            ";

    } else if($tipo == 2){ //Menu flotante para comercial
        echo "
            
             <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudCentrosTrabajo')." data-mfb-label='Centros de trabajo' class='mfb-component__button--child'>
                <i class='material-icons'>group_work</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudFormatos')." data-mfb-label='Formatos' class='mfb-component__button--child'>
                <i class='material-icons'>store_mall_directory</i>
                </a>
            </li>
            <li>
                <a href=".site_url('Crudclientes')." data-mfb-label='Clientes' class='mfb-component__button--child'>
                <i class='material-icons'>account_box</i>
                </a>
            </li>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>       
            ";
    }  else if($tipo == 3){ //Menu flotante para coordinador
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti/coordinador')."/".$this->session->userdata('idusuariobase')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>   
           ";
    }

    else if($tipo == 4){ //Menu flotante para analista
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>              
           ";
    }

    else if($tipo == 5){ //Menu flotante para analista
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
        <li class='mfb-component__wrap'>
            <a href='#' class='mfb-component__button--main'>
            <i class='material-icons'>reorder</i>
            </a>
            <ul class='mfb-component__list'>
            <li>
                <a href=".site_url('CrudOti')." data-mfb-label='OTI' class='mfb-component__button--child'>
                <i class='material-icons'>playlist_add_check</i>
                </a>
            </li>
            </ul>
        </li>
        </ul>            
           ";
    }

    else if($tipo == 9){ //Menu flotante para Uisuario coordinador SSHI
        echo "
           
            <ul id='menu' class='mfb-component--br mfb-zoomin' data-mfb-toggle='hover'>
                <li class='mfb-component__wrap'>
                    <a href='#' class='mfb-component__button--main'>
                    <i class='material-icons'>reorder</i>
                    </a>
                    <ul class='mfb-component__list'>
                        <li>
                            <a href=".site_url('CrudOti/coordinador/')." data-mfb-label='OTI' class='mfb-component__button--child'>
                            <i class='material-icons'>playlist_add_check</i>
                            </a>
                        </li>
                        <li>
                            <a href=".site_url('CrudOti/coordinadorAnNoAsig/'.$this->session->userdata('idusuariobase'))." data-mfb-label='A cargo sin asignar' class='mfb-component__button--child'>
                            <i class='material-icons'>assignment_late</i>
                            </a>
                        </li>
                         <li>
                            <a href=".site_url('CrudOti/coordinadorAnAsig/'.$this->session->userdata('idusuariobase'))." data-mfb-label='A cargo asignadas' class='mfb-component__button--child'>
                            <i class='material-icons'>assignment_turned_in</i>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>            
           ";
    }


}

?>

<!-- /Boton flotante -->


<!-- Jquery Core Js -->
<!--JQuery UI-->
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<!--Datatable-->
<script src="<?=base_url('assets/js/jquery.dataTables.min.js')?>"></script>


<!-- Bootstrap Core Js -->
<script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.js')?>"></script>

<!-- Select Plugin Js -->
<!-- <script src="<?=base_url('assets/plugins/bootstrap-select/js/bootstrap-select.js')?>"></script> -->

<!-- Slimscroll Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-slimscroll/jquery.slimscroll.js')?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?=base_url('assets/plugins/node-waves/waves.js')?>"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-countto/jquery.countTo.js')?>"></script>

<!-- Morris Plugin Js -->
<script src="<?=base_url('assets/plugins/raphael/raphael.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/morrisjs/morris.js')?>"></script>

<!-- ChartJs -->
<script src="<?=base_url('assets/plugins/chartjs/Chart.bundle.js')?>"></script>

<!-- Flot Charts Plugin Js -->
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.resize.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.pie.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.categories.js')?>"></script>
<script src="<?=base_url('assets/plugins/flot-charts/jquery.flot.time.js')?>"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="<?=base_url('assets/plugins/jquery-sparkline/jquery.sparkline.js')?>"></script>

<!-- Custom Js -->
<script src="<?=base_url('assets/js/admin.js')?>"></script>

<script src="<?=base_url('assets/js/pages/index.js')?>"></script>



<!-- Demo Js -->
<script src="<?=base_url('assets/js/demo.js')?>"></script>
<script src="<?=base_url('assets/js/modernizr.touch.js')?>"></script>
<!--<script src="<?/*=base_url('assets/js/mfb.js.js')*/?>"></script>
-->


<!--JS PARA EDITAR IMAGENES AUTOMATICAMENTE -->
<link href="<?=base_url('assets/css/fileinput.min.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/js/piexif.min.js')?>"></script>
<script src="<?=base_url('assets/js/sortable.min.js')?>"></script>
<script src="<?=base_url('assets/js/purify.min.js')?>"></script>
<script src="<?=base_url('assets/js/fileinput.min.js')?>"></script>
<script src="<?=base_url('assets/js/es.js')?>"></script>



<script>

    var panel = document.getElementById('panel'),
        menu = document.getElementById('menu'),
        showcode = document.getElementById('showcode'),
        selectFx = document.getElementById('selections-fx'),
        selectPos = document.getElementById('selections-pos'),
        // demo defaults
        effect = 'mfb-zoomin',
        pos = 'mfb-component--br';

    //showcode.addEventListener('click', _toggleCode);
    //selectFx.addEventListener('change', switchEffect);
    //selectPos.addEventListener('change', switchPos);

    function _toggleCode() {
        panel.classList.toggle('viewCode');
    }

    function switchEffect(e){
        effect = this.options[this.selectedIndex].value;
        renderMenu();
    }

    function switchPos(e){
        pos = this.options[this.selectedIndex].value;
        renderMenu();
    }

    function renderMenu() {
        menu.style.display = 'none';
        // ?:-)
        setTimeout(function() {
            menu.style.display = 'block';
            menu.className = pos + effect;
        },1);
    }

</script>


</body>

</html>