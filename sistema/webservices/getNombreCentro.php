<?php 
header('Content-Type: text/html; charset=iso-8859-1');
//header ('Content-Type: text/html; charset=UTF-8');
$idAs=$_REQUEST["idAs"];


$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
$i=0;

 $consulta=$conexion->query("SELECT CentrosDeTrabajo.*,Formato.nombre as nombreForma,Clientes.nombreCliente,regiones.nombreRegion,municipios.nombreMunicipio,estados.nombreEstado FROM CentrosDeTrabajo join asignaInmueble on CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato join Clientes on Formato.idCliente=Clientes.idCliente join regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia JOIN municipios on municipios.idMunicipio=regiones.municipio join estados on estados.id_Estado=municipios.estado WHERE asignaInmueble.idAsignacion=$idAs");
                    //$datos=array();
                    foreach ($consulta as $row)
                    {

                      $nombreCentro=$row["nombre"];
                      $idDet=$row["idDet"];
                      $nomContacto=$row["nomContacto"];
                      $puestoContacto=$row["puestoContacto"];
                      $telContacto=$row["telContacto"];
                      $email=$row["email"];
                      $calle=$row["calle"];
                      $numeroInterior=$row["numeroInterior"];
                      $numeroExterior=$row["numeroExterior"];
                      $nombreForma=$row["nombreForma"];
                      $nombreCliente=$row["nombreCliente"];
                      $nombreRegion=$row["nombreRegion"];
                      $nombreMunicipio=$row["nombreMunicipio"];
                      $nombreEstado=$row["nombreEstado"];
                
                  $arr[$i] = array('nombreCentro' => $nombreCentro,'idDet'=>$idDet,'nomContacto'=>$nomContacto,'puestoContacto' => $puestoContacto,'telContacto'=>$telContacto,'email'=>$email,'calle' => $calle,'numeroInterior'=>$numeroInterior,'numeroExterior'=>$numeroExterior,'nombreForma' => $nombreForma,'nombreCliente'=>utf8_encode($nombreCliente),'nombreRegion'=>utf8_encode($nombreRegion),'nombreMunicipio' => utf8_encode($nombreMunicipio),'nombreEstado'=>utf8_encode($nombreEstado));
                  $i++;
                  } 
          echo json_encode($arr);
 ?>