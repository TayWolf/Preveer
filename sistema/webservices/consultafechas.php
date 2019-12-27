<?php 
$id=$_REQUEST["id"];


$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
$i=0;
 $consulta=$conexion->query("SELECT * FROM `VisitasInmueble` WHERE `idAsignacion`=$id and `tipoVisita` = 1");
                    //$datos=array();
                    foreach ($consulta as $row)
                    {

                      $idVisita=$row["idVisita"];
                      $fechaAgenda=$row["fechaAgenda"];
                       $comentario=$row["comentario"];
                      $arr[$i] = array('idVisita' => $idVisita,'fechaAgenda'=>$fechaAgenda,'comentario'=>$comentario);

 		$i++;

                  }
          echo json_encode($arr);
 ?>