<?php

$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");

$conexion->query("SET CHARACTER SET utf8");

switch ($_POST['action'])

{

    case "sincronizarAlmacenamientoBitacora":

        $arregloNuevasKeys=array();

        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)

        {

            $array=json_decode($_REQUEST['registro'.$i], true);





            $idAlmacenamientoTemporal=$array[0];

            $idBitacora=$array[1];

            $idAsignacion=$array[2];

            $insertarAlmacenamientoBitacora=$conexion->query("INSERT INTO AlmacenamientoBitacora (idBitacora, idAsignacion) VALUES ('$idBitacora', '$idAsignacion')");

            $arregloNuevasKeys[$i]= (array($idAlmacenamientoTemporal, $conexion->lastInsertId()));



        }

        echo json_encode($arregloNuevasKeys);

        break;

    case "sincronizarDatosBitacora":

        $arregloNuevasKeys=array();

        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)

        {

            $array=json_decode($_REQUEST['registro'.$i], true);

            $idIndicador=$array[0];

            $idAlmacenamiento=$array[1];

            $valor=$array[2];

            $insertarDatoBitacora=$conexion->query("INSERT INTO DatosBitacora (idIndicador, idAlmacenamiento, valor) VALUES ('$idIndicador', '$idAlmacenamiento', '$valor')");

            $arregloNuevasKeys[$i]=array($conexion->lastInsertId());

        }

        echo json_encode($arregloNuevasKeys);

        break;



    //case "sincronizarOportunidadMejoraBitacora":
        case "prueba":

        //INSERTA LOS NUEVOS REGISTROS

        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)

        {

            $array=json_decode($_REQUEST['registro'.$i], true);

            $idAlmacenamiento=$array[0];

            $foto=array();

            $foto[0]=null;

            $foto[1]=$array[1];

            $foto[2]=$array[2];

            $foto[3]=$array[3];

            $oportunidadMejora=$array[4];

if (!empty($foto[1]) || !empty($foto[2]) || !empty($foto[3]) || !empty($oportunidadMejora) ) {

             $conexion->query("INSERT INTO OportunidadMejoraBitacora(idAlmacenamiento, oportunidadMejora) VALUES ('$idAlmacenamiento', '$oportunidadMejora')");

             $idOportunidadMejora=$conexion->lastInsertId();

            $insertar=true;


            for ($i = 1; $i < 4; $i++)

            {

                if(!empty($foto[$i]))

                {

                    $nombre = md5(uniqid()) . ".jpeg";

                    $target = "../assets/img/fotoBitacoras/fotoOportunidadMejora$i/" . $nombre;

                    if(!file_exists("../assets/img/fotoBitacoras/fotoOportunidadMejora$i/") && !is_dir("../assets/img/fotoBitacoras/fotoOportunidadMejora$i/"))

                    {

                        mkdir("../assets/img/fotoBitacoras/fotoOportunidadMejora$i/");

                    }

                    $imagenFinal = fopen($target, 'wb');

                    $conexion->query("UPDATE OportunidadMejoraBitacora SET fotoOportunidadMejora$i = '$nombre' WHERE idOportunidadMejora=$idOportunidadMejora;");

                    $data = base64_decode($foto[$i]);

                    echo json_encode(array($idOportunidadMejora, $idAlmacenamiento, file_put_contents($nombre, $data), rename($nombre, $target)));

                }

            }

        }
    }

        break;



    case "sincronizarOportunidadMejoraOSSH":

        //INSERTA LOS NUEVOS REGISTROS

        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)

        {

            $array=json_decode($_REQUEST['registro'.$i], true);

            $idAsignacion=$array[0];

            $idArea=$array[1];

            $factorRiesgo=$array[2];

            $fotoMal0=$array[3];

            $nombreFotoMal0="";

            $fotoMal1=$array[4];

            $nombreFotoMal1="";

            $oportunidadMejora=$array[5];

            $idPrioridadIntervencion=$array[6];

            $recomendacion=$array[7];

            $responsable=$array[8];

            $fechaEjecucion=$array[9];

            $fechaVerificacion=$array[10];

            $fotoCorreccion0=$array[11];

            $nombreFotoCorreccion0="";

            $fotoCorreccion1=$array[12];

            $nombreFotoCorreccion1="";

            $seguimiento=$array[13];



            if(!empty($fotoMal0))

            {

                $nombreFotoMal0 = md5(uniqid()) . ".jpeg";

                $target = "../assets/img/fotoOMSSH/fotoMal0/" . $nombreFotoMal0;

                if(!file_exists("../assets/img/fotoOMSSH/fotoMal0/") && !is_dir("../assets/img/fotoOMSSH/fotoMal0/"))

                {

                    mkdir("../assets/img/fotoOMSSH/fotomal0/");

                }

                $imagenFinal = fopen($target, 'wb');



                $data = base64_decode($fotoMal0);

                file_put_contents($nombreFotoMal0, $data);

                rename($nombreFotoMal0, $target);

            }

            if(!empty($fotoMal1))

            {

                $nombreFotoMal1 = md5(uniqid()) . ".jpeg";

                $target = "../assets/img/fotoOMSSH/fotoMal0/" . $nombreFotoMal1;

                if(!file_exists("../assets/img/fotoOMSSH/fotoMal1/") && !is_dir("../assets/img/fotoOMSSH/fotoMal1/"))

                {

                    mkdir("../assets/img/fotoOMSSH/fotomal1/");

                }

                $imagenFinal = fopen($target, 'wb');



                $data = base64_decode($fotoMal1);

                file_put_contents($nombreFotoMal1, $data);

                rename($nombreFotoMal1, $target);

            }

            if(!empty($fotoCorreccion0))

            {

                $nombreFotoCorreccion0= md5(uniqid()) . ".jpeg";

                $target = "../assets/img/fotoOMSSH/fotoCorreccion0/" . $nombreFotoCorreccion0;

                if(!file_exists("../assets/img/fotoOMSSH/fotoCorreccion0/") && !is_dir("../assets/img/fotoOMSSH/fotoCorreccion0/"))

                {

                    mkdir("../assets/img/fotoOMSSH/fotoCorreccion0/");

                }

                $imagenFinal = fopen($target, 'wb');



                $data = base64_decode($fotoCorreccion0);

                file_put_contents($nombreFotoCorreccion0, $data);

                rename($nombreFotoCorreccion0, $target);

            }

            if(!empty($fotoCorreccion1))

            {

                $nombreFotoCorreccion1= md5(uniqid()) . ".jpeg";

                $target = "../assets/img/fotoOMSSH/fotoCorreccion1/" . $nombreFotoCorreccion1;

                if(!file_exists("../assets/img/fotoOMSSH/fotoCorreccion1/") && !is_dir("../assets/img/fotoOMSSH/fotoCorreccion1/"))

                {

                    mkdir("../assets/img/fotoOMSSH/fotoCorreccion1/");

                }

                $imagenFinal = fopen($target, 'wb');

                $data = base64_decode($fotoCorreccion1);

                file_put_contents($nombreFotoCorreccion1, $data);

                rename($nombreFotoCorreccion1, $target);

            }



            $conexion->query("INSERT INTO OMSSH(idAsignacion, idArea,factorRiesgo,fotoMal0,fotoMal1,oportunidadMejora,idPrioridadIntervencion,recomendacion,responsable,fechaEjecucion,fechaVerificacion,fotoCorreccion0,fotoCorreccion1, seguimiento) VALUES ('$idAsignacion', '$idArea', '$factorRiesgo', '$nombreFotoMal0', '$nombreFotoMal1', '$oportunidadMejora','$idPrioridadIntervencion', '$recomendacion', '$responsable', '$fechaEjecucion', '$fechaVerificacion', '$nombreFotoCorreccion0', '$nombreFotoCorreccion1', '$seguimiento')");

            $idOMSSH=$conexion->lastInsertId();

            echo json_encode($idOMSSH);





        }

        break;

    case "sincronizarHoras":

        $registrosInsertados=array();

        for ($i=0; $i<$_REQUEST['numeroRegistro']; $i++)

        {

            $array=json_decode($_REQUEST['registro'.$i], true);





            $idCentroTrabajo=$array[0];

            $fechaInicio=$array[1];

            $fechaFin=$array[2];

            $idUsuario=$array[3];

            $insertar=$conexion->query("INSERT INTO HorasTrabajadas (idCentroTrabajo, fechaInicio, fechaFin, idUsuario) VALUES ('$idCentroTrabajo', '$fechaInicio', '$fechaFin', '$idUsuario');");

            $registrosInsertados[$i]= (array($conexion->lastInsertId()));



        }

        echo json_encode($registrosInsertados);

        break;

}

$conexion=null;

?>