<?php
        /*
         * Este archivo se encuentra minificado para que cargue más rapido en celulares.
         * Si necesitas editar este archivo, busca el archivo verFormilarioAutoadministrableOriginal y realiza tus cambios
         * Despues, minifica el nuevo archivo (https://kangax.github.io/html-minifier/) y coloca tus cambios aquí
         */

$idUsuarioBase = $_REQUEST['idusuariobase'];
$tipoUser = $_REQUEST['tipoUser'];
$cambioPas = $_REQUEST['cambioPas'];
$idUsuarioBase = 9;
$idAsignacion=$_REQUEST['idAsignacion'];
$idFormulario=$_REQUEST['idControl'];
$nombreBitacora=$_REQUEST['nombre'];
$base_url="https://cointic.com.mx/preveer/sistema/";
$site_url="https://cointic.com.mx/preveer/sistema/index.php/";
if ($idUsuarioBase == "")
    header("location: https://cointic.com.mx/preveer/sistema/");
?><!doctypehtml><meta charset=UTF-8><meta content="IE=Edge"http-equiv=X-UA-Compatible><meta content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no"name=viewport><title>Sistema | Preveer</title><link href=https://cointic.com.mx/preveer/sistema/assets/img/favicon.png rel=icon type=image/png><link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext"rel=stylesheet><link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel=stylesheet><link href=https://cointic.com.mx/preveer/sistema/assets/plugins/bootstrap/css/bootstrap.css rel=stylesheet><link href=https://cointic.com.mx/preveer/sistema/assets/plugins/node-waves/waves.css rel=stylesheet><link href=https://cointic.com.mx/preveer/sistema/assets/plugins/animate-css/animate.css rel=stylesheet><link href=https://cointic.com.mx/preveer/sistema/assets/plugins/morrisjs/morris.css rel=stylesheet><link href=https://cointic.com.mx/preveer/sistema/assets/css/style.css rel=stylesheet><link href=https://cointic.com.mx/preveer/sistema/assets/css/themes/all-themes.css rel=stylesheet><link href=https://cointic.com.mx/preveer/sistema/assets/css/personalizado.css rel=stylesheet><link href=https://cointic.com.mx/preveer/sistema/assets/css/mfb.css rel=stylesheet><link href=https://cointic.com.mx/preveer/sistema/assets/css/font-awesome.min.css rel=stylesheet><script src=https://cointic.com.mx/preveer/sistema/assets/sweetalert-master/dist/sweetalert.min.js></script><link href=https://cointic.com.mx/preveer/sistema/assets/sweetalert-master/dist/sweetalert.css rel=stylesheet><body class=theme-red><div class=page-loader-wrapper><div class=loader><div class=preloader><div class="pl-red spinner-layer"><div class="circle-clipper left"><div class=circle></div></div><div class="circle-clipper right"><div class=circle></div></div></div></div><p>Cargando...</div></div><div class=overlay></div><style>.centrico{text-align:center}.centrado>tr>td{vertical-align:middle!important;align:center!important;text-align:center!important}.centrado>tr>td>div>div{vertical-align:middle!important;align:center!important;text-align:center!important}.centrado>tr>td>input{text-align:center!important}</style><script src=https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js></script><?php
$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
$conexion->query("SET CHARACTER SET utf8");
$idCentroTrabajo=$conexion->query("SELECT idCentroTrabajo FROM asignaInmueble WHERE idAsignacion=$idAsignacion")->fetchAll(PDO::FETCH_ASSOC);
$idCentroTrabajo=$idCentroTrabajo[0]['idCentroTrabajo'];
$arregloFormularioAsignacion=$conexion->query("SELECT idFormularioAsignacion FROM FormularioAsignacion WHERE idAsignacion=$idAsignacion AND idFormulario=$idFormulario")->fetchAll(PDO::FETCH_ASSOC);
if(empty($arregloFormularioAsignacion))
{
    $conexion->query("INSERT INTO FormularioAsignacion (idFormulario, idAsignacion) VALUES ('$idFormulario', '$idAsignacion')");
    $arregloFormularioAsignacion=$conexion->query("SELECT idFormularioAsignacion FROM FormularioAsignacion WHERE idAsignacion=$idAsignacion AND idFormulario=$idFormulario")->fetchAll(PDO::FETCH_ASSOC);
}
$idFormularioAsignacion=$arregloFormularioAsignacion[0]['idFormularioAsignacion'];
$idReporteAsignacion=$arregloFormularioAsignacion;
$tablas=$conexion->query("SELECT FormularioAlmacenamientoAcordeon.*, FormularioTablaAcordeon.idAcordeon, FormularioTablaAcordeon.idFormularioAsignacion FROM FormularioAlmacenamientoAcordeon JOIN FormularioTablaAcordeon ON FormularioTablaAcordeon.idFormularioTablaAcordeon= FormularioAlmacenamientoAcordeon.idFormularioTablaAcordeon JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador=FormularioAlmacenamientoAcordeon.idIndicador AND AcordeonIndicador.idAcordeon=FormularioTablaAcordeon.idAcordeon WHERE idFormularioAsignacion=$idFormularioAsignacion ORDER BY idAcordeon, idFormularioTablaAcordeon, AcordeonIndicador.posicion")->fetchAll(PDO::FETCH_ASSOC);
$fotos=$conexion->query("SELECT * FROM FormularioFotos WHERE idFormularioAsignacion=$idFormularioAsignacion")->fetchAll(PDO::FETCH_ASSOC);
$nombreFormulario=$conexion->query("SELECT nombreFormulario FROM Aut WHERE idControl=$idFormulario")->fetchAll(PDO::FETCH_ASSOC);
$acordeones=$conexion->query("SELECT Acordeon.* FROM Acordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$idFormulario ORDER BY FormularioAcordeon.posicion")->fetchAll(PDO::FETCH_ASSOC);
$indicadores=$conexion->query("SELECT formIndicador.*, Acordeon.idAcordeon FROM formIndicador JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador=formIndicador.idIndicador JOIN Acordeon on Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$idFormulario ORDER BY AcordeonIndicador.posicion")->fetchAll(PDO::FETCH_ASSOC);
$nombreFormulario=$conexion->query("SELECT nombreFormulario FROM Aut WHERE idControl=$idFormulario")->fetchAll(PDO::FETCH_ASSOC);
$nombreFormulario=$nombreFormulario[0]['nombreFormulario'];
//echo $data['nombreFormulario']."==Datos Generales||$idFormulario==12";
if($nombreFormulario=="Datos Generales"||$idFormulario==12)
{
    $inmueble=$conexion->query("SELECT * FROM inmuebles")->fetchAll(PDO::FETCH_ASSOC);
    $formato=$conexion->query("SELECT * FROM Formato")->fetchAll(PDO::FETCH_ASSOC);
}
?><div class="row clearfix"><div class="col-md-12 col-lg-12 col-sm-12 col-xs-12"style=padding-right:0!important><div class=card style=margin-bottom:0!important><div class=header><h2><?php foreach ($nombreFormulario as $key ) {
                        echo $key['nombreFormulario'];
                    } ?></h2></div><div class=body><?php
                //Si es el formulario de datos generales, imprime los datos del centro de trabajo
                if($tituloFormulario=="Datos Generales"||$idFormulario==12)
                {
                    ?><form id=formDatosCentro><input id=idCentroTrabajo name=idCentroTrabajo type=hidden value="<?php echo $idCentroTrabajo;?>"><div class="full-body panel-group"id=accordion_DatosCentro role=tablist aria-multiselectable=true><div class="panel panel-col-lightgray"><div class=panel-heading id=headingOne_DatosCentro role=tab><h4 class=panel-title><a aria-controls=collapseOne_DatosCentro aria-expanded=true data-toggle=collapse href=#collapseOne_DatosCentro role=button><i class=material-icons>assignment</i> Datos del centro de trabajo</a></h4></div><div class="collapse in panel-collapse"id=collapseOne_DatosCentro role=tabpanel aria-labelledby=headingOne_DatosCentro><div class=panel-body><div class=row><div class=col-sm-4><label for=Formato>Cliente</label><div class=form-group><div class=form-line><select id=idFormato name=idFormato required style=width:100%;border:none;color:#000 class=form-control><option value=0>Seleccione cliente</option><?php
                                                        foreach ($formato as $row) {
                                                            $idFormat=$row["idFormato"];
                                                            $nombreFormat=$row["nombre"];

                                                            echo "<option value='$idFormat'>$nombreFormat</option>";
                                                        }
                                                        ?></select></div></div></div><div class=col-sm-3 style=display:none><label for="Tipo de inmueble">Tipo de inmueble</label><div class=form-group><div class=form-line><select id=inmueble name=inmueble required style=width:100%;border:none;color:#000 class=form-control><option value=0>Seleccione inmueble</option><?php
                                                        foreach ($inmueble as $row) {
                                                            $idIn=$row["idInmueble"];
                                                            $nombreIn=$row["nombreInmueble"];

                                                            echo "<option value='$idIn'>$nombreIn</option>";
                                                        }
                                                        ?></select></div></div></div><div class=col-sm-4><label for=razonSocial>Razón social</label><div class=form-group><div class=form-line><input class=form-control id=razonSocial name=razonSocial placeholder="Razón Social"></div></div></div><div class=col-sm-4><label for=email_address>Nombre de centro de trabajo</label><div class=form-group><div class=form-line><input class=form-control id=nombreCentro name=nombreCentro placeholder=Nombre></div></div></div><div class=col-sm-3 style=display:none><label for=email_address>IdDet</label><div class=form-group><div class=form-line><input class=form-control id=idDet name=idDet placeholder=IdDet></div></div></div><div class=col-md-4><label>Estado</label><div class="form-group form-float"><div class=form-line><select id=estado name=estado required style=width:100%;border:none;color:#000 onchange=obtenerMunicipios()></select></div></div></div><div class=col-md-4><label>Municipio o Delegación</label><div class="form-group form-float"><div class=form-line><select id=municipio name=municipio required style=width:100%;border:none;color:#000 onchange=obtenerColonias()><option value="">Seleccione el municipio</select></div></div></div><div class=col-md-4><label>Colonia</label><div class="form-group form-float"><div class=form-line><select id=colonia name=colonia required style=width:100%;border:none;color:#000 onchange=obtenerCodigoPostal()><option value="">Seleccione la colonia</select></div></div></div><div class=col-sm-3><label for=calle>Calle</label><div class=form-group><div class=form-line><input class=form-control id=calle name=calle placeholder=Calle></div></div></div><div class=col-sm-3><label for=numExterior>Número Exterior</label><div class=form-group><div class=form-line><input class=form-control id=numExterior name=numExterior placeholder="Número Exterior"type=number></div></div></div><div class=col-sm-3><label for=numInterior>Número Interior</label><div class=form-group><div class=form-line><input class=form-control id=numInterior name=numInterior placeholder="Número Interior"></div></div></div><div class=col-sm-3><label for=codigoPostal>Código Postal</label><div class=form-group><div class=form-line><input class=form-control id=codigoPostal name=codigoPostal placeholder="Código Postal"></div></div></div><div class=col-sm-3><label for=email_address>Nombre de contacto</label><div class=form-group><div class=form-line><input class=form-control id=nomContacto name=nomContacto placeholder="Nombre de contacto"></div></div></div><div class=col-sm-3><label for=email_address>Puesto de contacto</label><div class=form-group><div class=form-line><input class=form-control id=puestoContacto name=puestoContacto placeholder="Puesto de contacto"></div></div></div><div class=col-sm-3><label for=email_address>Teléfono de contacto</label><div class=form-group><div class=form-line><input class=form-control id=telContacto name=telContacto placeholder="Teléfono de contacto"></div></div></div><div class=col-sm-3><label for=email_address>Correo de contacto</label><div class=form-group><div class=form-line><input class=form-control id=correoContacto name=correoContacto placeholder="Correo de contacto"></div></div></div><div class=col-sm-4><label for=email_address>Teléfono del inmueble</label><div class=form-group><div class=form-line><input class=form-control id=telefonoInmueble name=telefonoInmueble placeholder="Teléfono del inmueble"type=tel></div></div></div><div class=col-sm-4><label for=email_address>Correo del inmueble</label><div class=form-group><div class=form-line><input class=form-control id=correoInmueble name=correoInmueble placeholder="Correo del inmueble"type=email></div></div></div><div class=col-sm-4><label for=giroInmueble>Giro completo</label><div class=form-group><div class=form-line><input class=form-control id=giroInmueble name=giroInmueble placeholder="Giro del inmueble"></div></div></div><div class="col-sm-2 col-sm-offset-1"><label for=email_address>Inicio de funcionamiento</label><div class=form-group><div class=form-line><input class=form-control id=horarioFuncionamientoInicio name=horarioFuncionamientoInicio placeholder=Horario type=time></div></div></div><div class=col-sm-2><label for=email_address>Fin de funcionamiento</label><div class=form-group><div class=form-line><input class=form-control id=horarioFuncionamientoFin name=horarioFuncionamientoFin placeholder=Horario type=time></div></div></div><div class=col-sm-2><label for="">¿Aplica atención a clientes?</label><div class=form-group><input class=form-control id=aplicaHorarioAtencion name=aplicaHorarioAtencion placeholder=Horario type=checkbox onchange=habilitarAtencionClientes() value=NoAplica><label for=aplicaHorarioAtencion>No Aplica</label></div></div><div class=col-sm-2><label for=email_address>Inicio de atención a clientes</label><div class=form-group><div class=form-line><input class=form-control id=horarioAtencionInicio name=horarioAtencionInicio placeholder=Horario type=time></div></div></div><div class=col-sm-2><label for=email_address>Fin de atención a clientes</label><div class=form-group><div class=form-line><input class=form-control id=horarioAtencionFin name=horarioAtencionFin placeholder=Horario type=time></div></div></div><div class=col-sm-3><label for=latitud>Latitud</label><div class=form-group><div class=form-line><input class=form-control id=latitud name=latitud placeholder="Latitud (Coordenadas)"></div></div></div><div class=col-sm-3><label for=longitud>Longitud</label><div class=form-group><div class=form-line><input class=form-control id=longitud name=longitud placeholder="Longitud (Coordenadas)"></div></div></div><div class=col-sm-3><label for=longitud>Metros</label><div class=form-group><div class=form-line><input class=form-control id=Metros name=Metros placeholder="Metros (Coordenadas)"></div></div></div><div class=col-sm-3 align=center><div class=form-line><input class="btn bg-black waves-effect waves-light"id=obtener type=button value="Obtener mi ubicación"></div></div><div class="col-sm-4 col-sm-offset-4"align=center><label for=atendioVisita>Nombre de quien atendió la visita</label><div class=form-group><div class=form-line><input class=form-control id=atendioVisita name=atendioVisita placeholder="Nombre de la persona quien atendió la visita"></div></div></div><div class=row><div class="col-sm-4 col-sm-offset-4"align=center><input class="btn bg-red"type=submit></div></div></div></div></div></div></div></form><?php
                }
                foreach ($acordeones as $acordeon)
                {
                    if($acordeon['tablaRegistro']==1)
                    {
                        echo "<form id='formTabla".$acordeon['idAcordeon']."' name='formTabla".$acordeon['idAcordeon']."'></form>";
                    }
                }
                ?><form id=form name=form><input id=idAsignacion name=idAsignacion type=hidden value="<?php echo $idAsignacion;?>"> <input id=idFormulario name=idFormulario type=hidden value="<?php echo $idFormulario;?>"></form><?php
                $recorridoTabla=0;
                $contadorIndicador=0;
                $contadorIndicadorParaAcordeon=0;
                $arregloFileInput=array();
                foreach ($acordeones as $acordeon)
                {
                    ?><div class="full-body panel-group"id="accordion_<?=$acordeon['idAcordeon']?>"role=tablist aria-multiselectable=true><div class="panel panel-col-lightgray"><div class=panel-heading id="headingOne_<?=$acordeon['idAcordeon']?>"role=tab><h4 class=panel-title><a aria-controls="collapseOne_<?=$acordeon['idAcordeon']?>"aria-expanded=true data-toggle=collapse href="#collapseOne_<?=$acordeon['idAcordeon']?>"role=button><i class=material-icons>assignment</i><?=$acordeon['nombreAcordeon']?></a></h4></div><div class="collapse in panel-collapse"id="collapseOne_<?=$acordeon['idAcordeon']?>"role=tabpanel aria-labelledby="headingOne_<?=$acordeon['idAcordeon']?>"><div class=panel-body><div class=row><?php
                                    if($acordeon['tablaRegistro']==2)
                                        foreach ($indicadores as $indicador)
                                        {
                                            $nombreIn=$indicador['nombreIndicador'];
                                            $tipoIndicador=$indicador['tipoIndicador'];
                                            $idIndicador=$indicador['idIndicador'];
                                            $idAcordeon=$indicador['idAcordeon'];
                                            if($idAcordeon==$acordeon['idAcordeon'])
                                            {
                                                $formularioAlQuePertenece='form="form"';
                                                $finCamp="";
                                                switch ($tipoIndicador) {
                                                    case 1:
                                                        $camp = " <select class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece required>";
                                                        $finCamp = "</select>";
                                                        break;
                                                    case 2:
                                                    case 7:
                                                        $camp = " <input type='text' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece>";
                                                        break;
                                                    case 3:
                                                        $camp = " <input type='number' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece>";
                                                        break;
                                                    case 4:
                                                        $camp = " <input type='checkbox' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece value='1'><label for=\"idIndic$idIndicador\">$nombreIn</label>";
                                                        break;
                                                    case 5:
                                                        $camp = " <input type='date' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndic$contadorIndicador' $formularioAlQuePertenece>";
                                                        break;
                                                    case 6:
                                                        array_push($arregloFileInput, array($idIndicador, $idAcordeon));
                                                        $camp = "<input type='file' class='$idIndicador-$idAcordeon' name='$idIndicador-" . $idAcordeon . "[]' data-min-file-count='1' $formularioAlQuePertenece>";
                                                        break;
                                                }
                                                switch ($tipoIndicador)
                                                {
                                                    case 4:
                                                        echo " 
                                                                        <div class='col-sm-6'><div class='form-group'>
<input type='hidden' name='idIndicador$contadorIndicador' value='$idIndicador' $formularioAlQuePertenece><input type='hidden' name='idAcordeonPerteneciente$contadorIndicador' value='$idAcordeon' $formularioAlQuePertenece><b>$nombreIn</b><br><br>$camp $finCamp</div></div>";
                                                        break;
                                                    default:
                                                        echo " <div class='col-sm-6'><div class='form-group'><div class='form-line'><input type='hidden' name='idIndicador$contadorIndicador' value='$idIndicador' $formularioAlQuePertenece><input type='hidden' name='idAcordeonPerteneciente$contadorIndicador' value='$idAcordeon' $formularioAlQuePertenece><b>$nombreIn</b>$camp $finCamp</div></div></div>";
                                                }
                                                $contadorIndicador++;
                                            }
                                        }
                                    if($acordeon['tablaRegistro']==1)
                                    {
                                        foreach ($indicadores as $indicador)
                                        {
                                            $nombreIn=$indicador['nombreIndicador'];
                                            $tipoIndicador=$indicador['tipoIndicador'];
                                            $idIndicador=$indicador['idIndicador'];
                                            $idAcordeon=$indicador['idAcordeon'];

                                            if($idAcordeon==$acordeon['idAcordeon'])
                                            {
                                                $formularioAlQuePertenece='form="formTabla'.$acordeon['idAcordeon'].'"';
                                                $finCamp="";
                                                switch ($tipoIndicador) {
                                                    case 1:
                                                        $camp = " <select class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece required>";
                                                        $finCamp = "</select>";
                                                        break;
                                                    case 2:
                                                    case 7:
                                                        $camp = " <input type='text' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece>";
                                                        break;
                                                    case 3:
                                                        $camp = " <input type='number' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece>";
                                                        break;
                                                    case 4:
                                                        $camp = " <input type='checkbox' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece>";
                                                        break;
                                                    case 5:
                                                        $camp = " <input type='date' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon$contadorIndicadorParaAcordeon' $formularioAlQuePertenece>";
                                                        break;
                                                    case 6:
                                                        array_push($arregloFileInput, array($idIndicador, $idAcordeon));
                                                        $camp = " <input type='file' class='form-control $idIndicador-$idAcordeon' id='idIndic$idIndicador' name='idIndicAcordeon" . $contadorIndicadorParaAcordeon . "[]' data-min-file-count='1' $formularioAlQuePertenece>";
                                                        break;
                                                }
                                                echo " <div class='col-sm-6'><div class='form-group'><div class='form-line'><input type='hidden' name='idAcordeonIndicador$contadorIndicadorParaAcordeon' value='$idIndicador' $formularioAlQuePertenece><b>$nombreIn</b>$camp $finCamp</div></div></div>";
                                                $contadorIndicadorParaAcordeon++;
                                            }
                                        }

                                        ?><div class=col-xs-12><div class="col-xs-4 col-xs-offset-4"align=center><input class="btn bg-red"type=submit form="formTabla<?=$acordeon['idAcordeon']?>"><script>$("#formTabla<?=$acordeon['idAcordeon']?>").on("submit",function(a){a.preventDefault(),formdata=new FormData(document.getElementById("formTabla<?=$acordeon['idAcordeon']?>")),$.ajax({url:"<?=$site_url.('CrudVisitaAnalisis/subirFilaTabla/'.$acordeon['idAcordeon']."/".$contadorIndicadorParaAcordeon."/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>",contentType:!1,data:formdata,processData:!1,type:"POST",dataType:"html",success:function(a){var e="<tr id='fila"+a+"'>";<?php
                                                        foreach ($indicadores as $indicador)
                                                        {
                                                            $idIndicador=$indicador['idIndicador'];
                                                            $idAcordeon=$indicador['idAcordeon'];
                                                            if($idAcordeon==$acordeon['idAcordeon'])
                                                            {
                                                                echo "fila+=\"<td>\"+$('.$idIndicador-$idAcordeon').val()+\"</td>\";\n";
                                                            }
                                                        }
                                                        $contadorIndicadorParaAcordeon=0;
                                                        ?>,<?php
                                                        $salida='<td><button onClick=\"mostrarFotos(\''.$acordeon['nombreAcordeon'].'\',"+data+",'.$acordeon['cantidadFotos'].')\" type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td>';
                                                        ?>,e+='<?php if($acordeon['cantidadFotos']) echo $salida;?><td><button id="eliminar'+a+"\" onClick='borrarFila("+a+')\' type="button" class="btn btn-defaultBorrar"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>',$("#tableBody<?=$acordeon['idAcordeon']?>").append(e)}})})</script></div></div><div class=row><div class="table col-xs-10 table-responsive"><table class="table table-hover"><thead><tr><?php
                                                    $arregloIndicadoresEncabezado=array();
                                                    $contadorTh=0;
                                                    foreach ($indicadores as $indicador)
                                                    {
                                                        $idAcordeon=$indicador['idAcordeon'];
                                                        if($idAcordeon==$acordeon['idAcordeon'])
                                                        {
                                                            $nombreIn = $indicador['nombreIndicador'];
                                                            echo "<th>$nombreIn</th>";
                                                            $arregloIndicadoresEncabezado[$contadorTh] = $indicador['idIndicador'];
                                                            $contadorTh++;
                                                            $contadorIndicador++;
                                                        }
                                                    }
                                                    if($acordeon['cantidadFotos'])
                                                    {
                                                        echo "<th>Fotos</th>";
                                                    }
                                                    ?><th>Eliminar<tbody id="tableBody<?=$acordeon['idAcordeon']?>"><?php

                                                $iteradorTabla=0;
                                                //SI SE NECESITA DOCUMENTACION, VER EL ARCHIVO: gridBitacoraAdministrable
                                                $numeroRegistros=sizeof($tablas);
                                                while($iteradorTabla<sizeof($tablas))
                                                {
                                                    if($tablas[$iteradorTabla]['idAcordeon']==$acordeon['idAcordeon'])
                                                    {
                                                        $i=$iteradorTabla;
                                                        $fila=array();
                                                        $ultimoAlmacenamiento=$tablas[$i]['idFormularioTablaAcordeon'];
                                                        $j=0;
                                                        while($ultimoAlmacenamiento==$tablas[$i]['idFormularioTablaAcordeon'])
                                                        {
                                                            $fila[$j++] = $tablas[$i];
                                                            $ultimoAlmacenamiento = $tablas[$i++]['idFormularioTablaAcordeon'];
                                                            if ($i >= $numeroRegistros)
                                                                break;
                                                        }

                                                        echo "<tr>";

                                                        //obtiene la diferencia entre los registros de la tabla y sus encabezados
                                                        $diferencia = sizeof($arregloIndicadoresEncabezado) - sizeof($fila);
                                                        for ($k = 0; $k < sizeof($fila); $k++)
                                                        {
                                                            //por cada uno de los encabezados
                                                            for($l=$k; $l < sizeof($arregloIndicadoresEncabezado); $l++ )
                                                            {
                                                                //si el encabezado coincide con el dato de la fila
                                                                if ($fila[$k]['idIndicador'] == $arregloIndicadoresEncabezado[$l])
                                                                {
                                                                    echo "<td>" . $fila[$k]['valor'] . "</td>";
                                                                    $k++;
                                                                    if($k>=sizeof($fila))
                                                                        break;
                                                                }
                                                                else
                                                                {
                                                                    $diferencia--;
                                                                    echo "<td></td>";
                                                                }
                                                            }
                                                            while($diferencia>0)
                                                            {
                                                                echo "<td></td>";
                                                                $diferencia--;
                                                            }
                                                            if($acordeon['cantidadFotos'])
                                                                echo "<td><button id='fotos".$ultimoAlmacenamiento."' onClick=\"mostrarFotos('".$acordeon['nombreAcordeon']."',".$ultimoAlmacenamiento.",".$acordeon['cantidadFotos'].")\" type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-picture-o\" aria-hidden=\"true\"></i></button></td>";
                                                            echo "<td><button id='eliminar".$ultimoAlmacenamiento."' onClick='borrarFila(".$ultimoAlmacenamiento.")' type=\"button\" class=\"btn btn-defaultBorrar\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></button></td></tr>";

                                                        }
                                                        $iteradorTabla=$i;
                                                    }
                                                    else
                                                        $iteradorTabla++;
                                                }
                                                ?></table></div></div><?php
                                    }
                                    ?></div></div></div></div></div><?php
                }
                ?><div class=row><div class="col-xs-4 col-xs-offset-4"align=center><input class="btn bg-red"type=submit form=form></div></div></div></div></div><div class="fade modal"id=modalFotos role=dialog><div class="modal-dialog modal-lg"><div class=modal-content><div class=modal-header><button class=close data-dismiss=modal type=button>×</button><h4 class=modal-title id=tituloModalFotos></h4></div><div class=modal-body><div class=col-md-12 id=contenidoModalFotos></div></div><div class=modal-footer><button class="btn btn-default"data-dismiss=modal type=button>Cerrar</button></div></div></div></div><script>function mostrarFotos(o,t,e){for($("#contenidoModalFotos").empty(),$("#tituloModalFotos").text("Fotos sobre "+o),i=0;i<e;i++)$("#contenidoModalFotos").append('<div class="col-md-6">\n                            <input type="file" id="fotoModal'+i+'" name="fotoModal'+i+'[]" data-min-file-count="1"/>\n                        </div>');$.ajax({url:"<?=$site_url.('CrudVisitaAnalisis/obtenerFotosFila/')?>"+t,contentType:!1,processData:!1,dataType:"JSON",success:function(o){for(arrayAgregados=[],j=0;j<e;j++)for(i=0;i<o.length;i++)o[i].numeroFotoTabla==j&&(crearFileInputModal(t,j,o[i].foto),arrayAgregados.push(j));var a=!1;for(i=0;i<e;i++){for(j=0;j<arrayAgregados.length;j++)arrayAgregados[j]==i&&(a=!0);a||crearFileInputModal(t,i,""),a=!1}},complete:function(){$("#modalFotos").modal()}})}</script><script>function crearFileInput(i,t){for(foto="",j=0;j<arregloFotos.length;j++)arregloFotos[j].idIndicador==i&&arregloFotos[j].idAcordeon==t&&(foto="<img class='file-preview-image' src='<?=$base_url.("assets/img/fotoAnalisisRiesgo/".$idReporteAsignacion[0]['idFormularioAsignacion']."/")?>"+arregloFotos[j].foto+"'/>",console.log(foto));$("."+i+"-"+t).fileinput({showUploadedThumbs:!1,showCaption:!1,showCancel:!1,showRemove:!1,showUpload:!1,uploadAsync:!1,uploadUrl:"<?=$site_url.("CrudVisitaAnalisis/subirFoto/".$idFormulario."/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>/"+i+"/"+t,language:"es",maxFileCount:1,allowedFileExtensions:["jpg","gif","png"],initialPreview:[foto]}).on("change",function(o,e,a,n){$("."+i+"-"+t).fileinput("upload")}).on("fileclear",function(o){$.ajax({url:"<?=$site_url.("CrudVisitaAnalisis/borrarFoto/$idFormulario/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>/"+i+"/"+t,contentType:!1,processData:!1})})}function crearFileInputModal(e,i,o){foto="",o&&(foto="<img class='file-preview-image' src='<?=$base_url.("assets/img/fotoAnalisisRiesgo/".$idReporteAsignacion[0]['idFormularioAsignacion']."/")?>"+o+"'/>"),$("#fotoModal"+i).fileinput({showUploadedThumbs:!1,showCaption:!1,showCancel:!1,showRemove:!1,showUpload:!1,uploadAsync:!1,uploadUrl:"<?=$site_url.("CrudVisitaAnalisis/subirFotoFila/".$idFormulario."/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>/"+e+"/"+i,language:"es",maxFileCount:1,allowedFileExtensions:["jpg","gif","png"],initialPreview:[foto]}).on("change",function(o,e,a,n){$("#fotoModal"+i).fileinput("upload")}).on("fileclear",function(o){$.ajax({url:"<?=$site_url.("CrudVisitaAnalisis/borrarFotoModal/$idFormulario/".$idReporteAsignacion[0]['idFormularioAsignacion'])?>/"+e+"/"+i,contentType:!1,processData:!1})})}function borrarFila(e){swal({title:"¡Precaución!",text:"¿Está seguro de eliminar este registro?",type:"warning",showCancelButton:!0,confirmButtonText:"Si, quiero eliminarlo"},function(o){o&&$.ajax({url:"<?=$site_url.("CrudVisitaAnalisis/eliminarFilaTabla/")?>"+e,contentType:!1,complete:function(){var o=$("#eliminar"+e);$(o).closest("tr").hide()}})})}function obtenerMunicipios(){$("#colonia").empty(),$("#codigoPostal").val("");var o=$("#estado").val();$.ajax({url:"<?php echo $site_url.('CrudCentrosTrabajo/obtenerMunicipios')?>/"+o,type:"get",dataType:"json",success:function(o){$("#municipio").empty();for(var e=0;e<o.length;e++)$("#municipio").append(new Option(o[e].nombreMunicipio,o[e].idMunicipio))}})}function obtenerColonias(){$("#codigoPostal").val("");var o=$("#municipio").val();$.ajax({url:"<?php echo $site_url.('CrudCentrosTrabajo/obtenerColonias')?>/"+o,type:"get",dataType:"json",success:function(o){$("#colonia").empty();for(var e=0;e<o.length;e++)$("#colonia").append(new Option(o[e].nombreRegion,o[e].idRegiones))}})}function obtenerCodigoPostal(){var o=$("#colonia").val();$.ajax({url:"<?php echo $site_url.('CrudCentrosTrabajo/obtenerCodigoPostal')?>/"+o,type:"get",dataType:"json",success:function(o){$("#codigoPostal").val(o[0].cp)}})}function habilitarAtencionClientes(){$("#horarioAtencionInicio").prop("disabled",$("#aplicaHorarioAtencion").is(":checked")),$("#horarioAtencionFin").prop("disabled",$("#aplicaHorarioAtencion").is(":checked"))}function iniciarMap(){document.getElementById("obtener").addEventListener("click",obtener,!1)}function obtener(){navigator.geolocation.getCurrentPosition(mostrar,gestionarErrores)}function mostrar(o){document.getElementById("localizacion");o.coords.latitude,o.coords.longitude,o.coords.accuracy,$("#latitud").val(o.coords.latitude),$("#longitud").val(o.coords.longitude),$("#Metros").val(o.coords.accuracy+" metros.")}function gestionarErrores(o){alert("Error: "+o.code+" "+o.message+"\n\nPor favor compruebe que está conectado a internet y habilite la opción permitir compartir ubicación física")}function cargarDatosCentroTrabajo(){$.ajax({url:"<?php echo $site_url.('CrudCentrosTrabajo/obtenerEstados')?>/",type:"get",dataType:"json",success:function(o){for(var e=0;e<o.length;e++)$("#estado").append(new Option(o[e].nombreEstado,o[e].id_Estado))},complete:function(){var o=$("#idCentroTrabajo").val();$.ajax({url:"<?php echo $site_url.('CrudCentrosTrabajo/obtenerDatos')?>/"+o,type:"get",dataType:"JSON",success:function(a){$("#estado").val(a.id_Estado);var o=a.id_Estado;$.ajax({url:"<?php echo $site_url.('CrudCentrosTrabajo/obtenerMunicipios')?>/"+o,type:"get",dataType:"json",success:function(o){$("#municipio").empty();for(var e=0;e<o.length;e++)$("#municipio").append(new Option(o[e].nombreMunicipio,o[e].idMunicipio));$("#municipio").val(a.idMunicipio),$.ajax({url:"<?php echo $site_url.('CrudCentrosTrabajo/obtenerColonias')?>/"+a.idMunicipio,type:"get",dataType:"json",success:function(o){$("#colonia").empty();for(var e=0;e<o.length;e++)$("#colonia").append(new Option(o[e].nombreRegion,o[e].idRegiones));$("#colonia").val(a.idColonia),obtenerCodigoPostal()}})}}),$("#calle").val(a.calle),$("#numInterior").val(a.numeroInterior),$("#numExterior").val(a.numeroExterior),$("#idFormato").val(a.idFormato),$("#inmueble").val(a.idInmueble),$("#nombreCentro").val(a.nombre),$("#idDet").val(a.idDet),$("#nomContacto").val(a.nomContacto),$("#puestoContacto").val(a.puestoContacto),$("#telContacto").val(a.telContacto),$("#correoContacto").val(a.email),$("#correoInmueble").val(a.correoInmueble),$("#telefonoInmueble").val(a.telefonoInmueble),$("#horarioFuncionamientoInicio").val(a.horarioFuncionamientoInicio),$("#horarioFuncionamientoFin").val(a.horarioFuncionamientoFin),$("#horarioAtencionInicio").val(a.horarioAtencionInicio),$("#horarioAtencionFin").val(a.horarioAtencionFin),$("#giroInmueble").val(a.giroInmueble),$("#latitud").val(a.latitud),$("#longitud").val(a.longitud),$("#Metros").val(a.metros),$("#razonSocial").val(a.razonSocial),1==a.aplicaHorarioAtencion&&$("#aplicaHorarioAtencion").prop("checked",!0)},error:function(o,e,a){alert("Error get data from ajax")}})}}),$.ajax({url:"<?=$site_url.('CrudCentrosTrabajo/getNombreAtendioVisita/'.$idAsignacion)?>",dataType:"JSON",success:function(o){$("#atendioVisita").val(o.nombreAtendioVisita)}})}arregloFileInput=<?=json_encode($arregloFileInput)?>,arregloFotos=<?=json_encode($fotos)?>,$(document).ready(function(){for($("#idCentroTrabajo").val()&&cargarDatosCentroTrabajo(),$.ajax({url:"<?=$site_url.('CrudVisitaAnalisis/getPonderadores/')?>"+$("#idFormulario").val(),contentType:!1,processData:!1,dataType:"JSON",success:function(o){for(console.table(o),i=0;i<o.length;i++)$("."+o[i].idIndicador+"-"+o[i].idAcordeon).append("<option value='"+o[i].nombrePonderador+"'>"+o[i].nombrePonderador+"</option>")},complete:function(){$.ajax({url:"<?=$site_url.('CrudVisitaAnalisis/obtenerDatosGuardados/').$idReporteAsignacion[0]['idFormularioAsignacion']?>",contentType:!1,processData:!1,dataType:"JSON",success:function(o){for(console.table(o),i=0;i<o.length;i++)o[i].valor&&($("."+o[i].idIndicador+"-"+o[i].idAcordeon).val(o[i].valor),$("."+o[i].idIndicador+"-"+o[i].idAcordeon).prop("checked",!0))}})}}),i=0;i<arregloFileInput.length;i++)crearFileInput(arregloFileInput[i][0],arregloFileInput[i][1])}),$("#form").on("submit",function(o){var e=new FormData(document.getElementById("form"));o.preventDefault(),$.ajax({url:"<?=$site_url.("CrudVisitaAnalisis/subirAnalisisRiesgo/".$idReporteAsignacion[0]['idFormularioAsignacion']."/".$contadorIndicador)?>",processData:!1,contentType:!1,data:e,type:"POST",dataType:"html",success:function(o){swal("Bien!","El analisis de riesgo ha sido guardado!","success")}})}),$("#formDatosCentro").on("submit",function(o){$("#cargando").html('<img src="https://cointic.com.mx/preveer/sistema/Content/assets/images/loading.gif"/>'),o.preventDefault();$(this);var e=new FormData(document.getElementById("formDatosCentro"));$.ajax({url:"<?php echo 'https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo/modificarDatos/';?>",type:"post",dataType:"html",data:e,cache:!1,contentType:!1,processData:!1}).done(function(o){swal("HECHO","Datos modificados.","success")}),$.ajax({url:"<?=$site_url.('CrudCentrosTrabajo/cambiarNombreAtendioVisita/'.$idAsignacion)?>",type:"post",data:{nombre:$("#atendioVisita").val()}})}),window.addEventListener("load",iniciarMap,!1)</script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/jquery/jquery.min.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/bootstrap/js/bootstrap.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-slimscroll/jquery.slimscroll.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/node-waves/waves.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-countto/jquery.countTo.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/raphael/raphael.min.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/morrisjs/morris.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/chartjs/Chart.bundle.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.resize.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.pie.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.categories.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/flot-charts/jquery.flot.time.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/plugins/jquery-sparkline/jquery.sparkline.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/admin.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/pages/index.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/demo.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/modernizr.touch.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/mfb.js.js')?>"></script><link href="<?=('https://cointic.com.mx/preveer/sistema/assets/css/fileinput.min.css')?>"rel=stylesheet><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/sortable.min.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/purify.min.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/fileinput.min.js')?>"></script><script src="<?=('https://cointic.com.mx/preveer/sistema/assets/js/es.js')?>"></script>