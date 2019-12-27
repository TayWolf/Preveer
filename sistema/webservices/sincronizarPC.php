<?php
$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
$conexion->query("SET CHARACTER SET utf8");
switch ($_POST['action'])
{
    case "sincronizarFormularioAsignacion":
        ini_set("display_errors", 1);

        $arregloNuevasKeys=array();
        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)
        {
            $array=json_decode($_REQUEST['registro'.$i], true);

            $idFormularioAsignacionTemporal=$array[0];
            $idFormulario=$array[1];
            $idAsignacion=$array[2];
            $buscarFormAsignacion=$conexion->query("SELECT idFormularioAsignacion 
                FROM FormularioAsignacion 
                WHERE idFormulario=$idFormulario AND idAsignacion=$idAsignacion")
                ->fetchAll(PDO::FETCH_ASSOC);
            if(sizeof($buscarFormAsignacion)>0)
            {
                $arregloNuevasKeys[$i] =(array($idFormularioAsignacionTemporal, $buscarFormAsignacion[0]['idFormularioAsignacion']));
            }
            else
            {
                $conexion->query("INSERT INTO FormularioAsignacion (idFormulario, idAsignacion) VALUES ($idFormulario, $idAsignacion)");
                $arregloNuevasKeys[$i]= (array($idFormularioAsignacionTemporal, $conexion->lastInsertId()));

            }

        }
        echo json_encode($arregloNuevasKeys);
        break;
    case "sincronizarFormularioTablaAcordeon":
        $arregloNuevasKeys=array();
        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)
        {
            $array=json_decode($_REQUEST['registro'.$i], true);

            $idFormularioTablaAcordeonTemporal=$array[0];
            $idAcordeon=$array[1];
            $idFormularioAsignacion=$array[2];

            $insertarFormAsignacion=$conexion->query("INSERT INTO FormularioTablaAcordeon (idAcordeon, idFormularioAsignacion) VALUES ('$idAcordeon', '$idFormularioAsignacion')");
            $insertarFormAsignacion->execute();
            $arregloNuevasKeys[$i]=array($idFormularioTablaAcordeonTemporal, $conexion->lastInsertId());


        }
        echo json_encode($arregloNuevasKeys);
        break;
    case "sincronizarFormularioAlmacenamiento":
        //BORRA LOS REGISTROS ANTERIORES
        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)
        {
            $array = json_decode($_REQUEST['registro' . $i], true);
            $idFormularioAsignacion = $array[3];
            $conexion->query("DELETE FROM FormularioAlmacenamiento WHERE idFormularioAsignacion='$idFormularioAsignacion '");

        }
        //INSERTA LOS NUEVOS REGISTROS
        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)
        {
            $array=json_decode($_REQUEST['registro'.$i], true);
            $idIndicador=$array[0];
            $valor=$array[1];
            $idAcordeon=$array[2];
            $idFormularioAsignacion=$array[3];
            $conexion->query("INSERT INTO FormularioAlmacenamiento 
             (idIndicador, valor, idAcordeon, idFormularioAsignacion) VALUES ('$idIndicador', '$valor', '$idAcordeon','$idFormularioAsignacion')");
            echo json_encode(array($idIndicador, $valor, $idAcordeon, $idFormularioAsignacion));

        }
        break;
    case "sincronizarFormularioAlmacenamientoAcordeon":
        //INSERTA LOS NUEVOS REGISTROS
        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)
        {
            $array=json_decode($_REQUEST['registro'.$i], true);
            $idFormularioTablaAcordeon=$array[0];
            $idIndicador=$array[1];
            $valor=$array[2];
            $conexion->query("INSERT INTO FormularioAlmacenamientoAcordeon 
             (idFormularioTablaAcordeon, idIndicador, valor) VALUES ('$idFormularioTablaAcordeon', '$idIndicador', '$valor')");
            echo json_encode(array($idFormularioTablaAcordeon, $idIndicador, $valor, $conexion->lastInsertId()));

        }
        break;
    case "sincronizarFormularioFotos":
        //INSERTA LOS NUEVOS REGISTROS
        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)
        {
            $array=json_decode($_REQUEST['registro'.$i], true);
            $idFormularioAsignacion=empty($array[0])?'':$array[0];
            $foto=$array[1];
            $idIndicador=empty($array[2])?'':$array[2];
            $idAcordeon=empty($array[3])?'':$array[3];
            $idFormularioTablaAcordeon=empty($array[4])?'':$array[4];
            $numeroFoto=empty($array[5])?'':$array[5];

            if(!file_exists("../assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/") && !is_dir("../assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/"))
            {
                mkdir("../assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/");
            }

            $nombre=md5(uniqid()) . ".jpeg";
            $target = "../assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/" . $nombre;
            $imagenFinal= fopen($target, 'wb');
            $row=null;
            if(empty($idFormularioTablaAcordeon))
            {
                $row = $conexion->query("SELECT idFormularioFoto, foto FROM FormularioFotos 
                WHERE idFormularioAsignacion='$idFormularioAsignacion' AND idIndicador='$idIndicador' AND idAcordeon='$idAcordeon'")->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                $row = $conexion->query("SELECT idFormularioFoto, foto FROM FormularioFotos 
                WHERE idFormularioAsignacion='$idFormularioAsignacion' AND idFormularioTablaAcordeon='$idFormularioTablaAcordeon' AND numeroFotoTabla='$numeroFoto'")->fetchAll(PDO::FETCH_ASSOC);
            }
            if (!empty($row))
            {
                $conexion->query("DELETE FROM FormularioFotos WHERE idFormularioFoto='" . $row[0]['idFormularioFoto'] . "'");
                unlink("../assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion" . $row[0]['foto']);
            }
            if(empty($idFormularioTablaAcordeon))
            {
                $conexion->query("INSERT INTO FormularioFotos 
             (idFormularioAsignacion, foto, idIndicador, idAcordeon) 
             VALUES ('$idFormularioAsignacion', '$nombre', '$idIndicador','$idAcordeon')");
            }
            else
            {
                $conexion->query("INSERT INTO FormularioFotos 
             (idFormularioAsignacion, foto, idFormularioTablaAcordeon, numeroFotoTabla) 
             VALUES ('$idFormularioAsignacion', '$nombre','$idFormularioTablaAcordeon','$numeroFoto')");
            }
            $data = base64_decode($foto);
            echo json_encode(array($idFormularioAsignacion, $nombre, $idIndicador, $idAcordeon,$idFormularioTablaAcordeon,$numeroFoto, file_put_contents($nombre, $data),rename($nombre, $target)));
        }
        break;
}
$conexion=null;
?>