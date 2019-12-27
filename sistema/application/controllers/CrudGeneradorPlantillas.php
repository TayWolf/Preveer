<?php
use phpoffice\phpword\bootstrap;
class CrudGeneradorPlantillas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("GeneradorPlantillas");
    }
    function index()
    {
        $data['clientes']=$this->GeneradorPlantillas->cargarClientes();
        $data['formularios']=$this->GeneradorPlantillas->cargarFormularios();
        $this->load->view("viewGeneracionPlantilla", $data);
    }
    function cargarEstadosCliente($idCliente)
    {
        echo json_encode($this->GeneradorPlantillas->getEstadosCliente($idCliente));
    }
    function cargarFormatosCliente($idCliente)
    {
        echo json_encode($this->GeneradorPlantillas->getFormatosCliente($idCliente));
    }
    function cargarCentrosTrabajo($idCliente,$idEstado, $idFormato)
    {
        $condiciones="";
        if($idCliente)
            $condiciones.="AND Clientes.idCliente=$idCliente ";
        if($idEstado)
            $condiciones.="AND estados.id_Estado=$idEstado ";
        if($idFormato)
            $condiciones.="AND Formato.idFormato=$idFormato ";
        echo json_encode($this->GeneradorPlantillas->getCentrosTrabajo($condiciones));
    }
    function cargarPlantillas($idEstado, $idCentroTrabajo,$idFormato,$idCliente)
    {
        echo json_encode($this->GeneradorPlantillas->getPlantillas($idEstado, $idCentroTrabajo, $idFormato, $idCliente));
    }
    function getInfoPlantilla($idPlantilla)
    {
        $data[0]=$this->GeneradorPlantillas->getInfoPlantilla($idPlantilla);
        $data[1]=$this->GeneradorPlantillas->getInfoFotosPlantilla($idPlantilla);

        echo json_encode($data);
        //return $info;
    }
    function cargarFotosFormulario($idFormulario, $idAsignacion)
    {
        echo json_encode($this->GeneradorPlantillas->getFotosFormulario($idFormulario, $idAsignacion));
    }
    //este metodo solo reemplaza los datos, sin embargo, no descarga la plantilla
    function generarPlantilla()
    {
        $idPlantilla=$this->input->post("idPlantilla");
        $idAsignacion=$this->input->post("idAsignacion");
        //obtiene el archivo a leer
        $informacionPlantilla=$this->GeneradorPlantillas->getInfoPlantilla($idPlantilla);
        $nombreArchivoPlantilla=$informacionPlantilla['nombreArchivo'];
        $rutaArchivo="assets/img/plantillasPc/".$nombreArchivoPlantilla;
        $procesadorPlantillas= new \PhpOffice\PhpWord\TemplateProcessor($rutaArchivo);

        //obtiene las etiquetas a buscar y reemplazar en la plantilla
        $etiquetasTexto=$this->GeneradorPlantillas->getEtiquetasTexto($idPlantilla, $idAsignacion);
        foreach ($etiquetasTexto as $value)
        {
            $value['nombreEtiqueta']=ltrim($value['nombreEtiqueta']);
            $value['nombreEtiqueta']=rtrim($value['nombreEtiqueta']);
            $value['nombreEtiqueta']=ltrim($value['nombreEtiqueta'], "\${");
            $value['nombreEtiqueta']=rtrim($value['nombreEtiqueta'], "}");

            $procesadorPlantillas->setValue($value['nombreEtiqueta'], $value['valorEtiqueta']);
        }

        //obtiene las fotos que se reemplazaran:
        $fotos=$this->input->post("fotos");
        if(!empty($fotos))
        {
            foreach ($fotos as $foto)
            {
                //IF necesario porque la vista manda un null al principio del arreglo. No se sabe la razon de este comportamiento
                if (!empty($foto))
                {
                    $nombreEtiqueta = $foto['nombreEtiqueta'];
                    $nombreEtiqueta = ltrim($nombreEtiqueta);
                    $nombreEtiqueta = rtrim($nombreEtiqueta);
                    $nombreEtiqueta = ltrim($nombreEtiqueta, "\${");
                    $nombreEtiqueta = rtrim($nombreEtiqueta, "}");
                    $nombreFoto = ("assets/img/fotoAnalisisRiesgo/" . $foto['nombreFoto']);
                    //print($nombreEtiqueta." - ".$nombreFoto." \n");
                    //si se selecciono una foto y si el nombre de la etiqueta no es igual a "":
                    if (!empty($nombreEtiqueta) && !empty($nombreFoto)) {
                        $ancho = ($foto['ancho']) ? $foto['ancho'] : "0";
                        $alto = ($foto['alto']) ? $foto['alto'] : "0";
                        $procesadorPlantillas->setImageValue($nombreEtiqueta, array('path' => $nombreFoto, 'width' => $ancho . 'cm', 'height' => $alto . 'cm', 'ratio' => false));
                    }
                }
            }
        }

        //Glosario de etiquetas no autoadministrables
        //obtiene el glosario de etiquetas
        $datosCentroTrabajo=$this->GeneradorPlantillas->getDatosCentroTrabajo($idAsignacion);
        //por cada etiqueta del glosario, saca el valor de la etiqueta, además del indice de la etiqueta

        for($i=0; $i<sizeof($datosCentroTrabajo); $i++)
        {
            //cambia las etiquetas:

            /* Equivalente a:
             * $procesadorPlantillas->setValue("nombreCentroTrabajo" , "walmart vicente guerrero");
             * */
            $valor = current($datosCentroTrabajo);
            $etiquetaGlosario=ltrim(key($datosCentroTrabajo));
            $etiquetaGlosario=ltrim($etiquetaGlosario, "\${");
            $etiquetaGlosario=rtrim($etiquetaGlosario);
            $etiquetaGlosario=rtrim($etiquetaGlosario, "}");
            next($datosCentroTrabajo);

            if($etiquetaGlosario=="fotoFormato")
            {
                $procesadorPlantillas->setImageValue($etiquetaGlosario, 'assets/img/fotoFormato/'.$valor);
                continue;
            }
            $procesadorPlantillas->setValue($etiquetaGlosario, $valor);
        }
        //establece los dias, meses o años
        $procesadorPlantillas->setValue('dia', date("d"));
        $procesadorPlantillas->setValue('mes', date("m"));
        $procesadorPlantillas->setValue('año', date("Y"));
        $procesadorPlantillas->setValue('fechaHoy', date("Y-m-d"));
        //fin del glosario

        //Genera las tablas de la plantilla
        $tablasDisponibles=$this->GeneradorPlantillas->getTablasPlantilla($idPlantilla);
        foreach ($tablasDisponibles as $tablaDisponible)
        {


            $iteradorTabla=0;
            //SI SE NECESITA DOCUMENTACION, VER EL ARCHIVO: gridBitacoraAdministrable
            $tablas=$this->GeneradorPlantillas->getDatosTablaPlantilla($tablaDisponible['idPlantillaTabla'], $idAsignacion);
            $numeroRegistros=sizeof($tablas);

            $arregloFinal=array();
            while($iteradorTabla<sizeof($tablas))
            {
                $i=$iteradorTabla;#0
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
                $iteradorTabla=$i;
                array_push($arregloFinal, $fila);
                /*
                 * A este punto el arreglo fila queda mas o menos así y esta información se le pasa a un arreglo final en un indice X:
                 *
                 *  369	263	25	1231	4	147	${fecha}
                    370	263	26	asdas	4	147	${evento}
                    371	263	22	asdasd	4	147	${areaAfectada}
                    371	263	22	asdasd	4	147	${consecuencia}
                 * */

            }
            $nombreTabla=ltrim($tablaDisponible['nombreTabla']);
            $nombreTabla=ltrim($nombreTabla, "\${");
            $nombreTabla=rtrim($nombreTabla);
            $nombreTabla=rtrim($nombreTabla, "}");

            /*
             * clona X cantidad de veces una fila de la plantilla. Por ejemplo si hay 3 datos en el arreglo final, entonces habrá 3 filas en la plantilla
             * Es necesario contar con el nombre de la tabla para saber sobre cual tabla se va a ejecutar este código
            */
            $procesadorPlantillas->cloneRow($nombreTabla, sizeof($arregloFinal));
            $contador=1;
            foreach ($arregloFinal as $fila)
            {
                //cambia el nombre de la tabla por un indice
                $procesadorPlantillas->setValue($nombreTabla."#".$contador, $contador);
                foreach ($fila as $columna)
                {
                    //cambia los nombres de las columnas por el valor que deben tener
                    $nombreColumna=$columna['nombreColumna'];
                    $nombreColumna=ltrim($nombreColumna);
                    $nombreColumna=ltrim($nombreColumna, "\${");
                    $nombreColumna=rtrim($nombreColumna);
                    $nombreColumna=rtrim($nombreColumna, "}");
                    $procesadorPlantillas->setValue($nombreColumna."#".$contador, $columna['valor']);
                }
                $contador++;
            }


        }
        //Comienzo de la actualización de los datos del acuse de visita
        $etiquetasAcuse=$this->GeneradorPlantillas->getEtiquetasAcuse($idPlantilla);
        foreach ($etiquetasAcuse as $etiquetaAcuse)
        {
            $nombreEtiqueta=$etiquetaAcuse['nombreEtiqueta'];
            $nombreEtiqueta=ltrim($nombreEtiqueta);
            $nombreEtiqueta=ltrim($nombreEtiqueta, "\${");
            $nombreEtiqueta=rtrim($nombreEtiqueta);
            $nombreEtiqueta=rtrim($nombreEtiqueta, "}");
            $valores=$this->GeneradorPlantillas->getValoresAcuse($idAsignacion, $etiquetaAcuse['idIndicadorAcuse']);
            $valorEtiqueta="";
            if(!empty($valores['idPonderador']))
            {
                if($valores['idPonderador']==1)
                    $valorEtiqueta="Si";
                if($valores['idPonderador']==2)
                    $valorEtiqueta="No";
                if($valores['idPonderador']==3)
                    $valorEtiqueta="N/A";
            }
            else if(!empty($valores['distancia']))
            {
                $valorEtiqueta=$valores['distancia'];
            }
            else if(!empty($valores['cantidad']))
            {
                $valorEtiqueta=$valores['cantidad'];
            }
            else if(!empty($valores['texto']))
            {
                $valorEtiqueta=$valores['texto'];
            }



            $procesadorPlantillas->setValue($nombreEtiqueta, $valorEtiqueta);

        }

        //Fin de la actualización de los datos del acuse de visita

        //Comienzo de la tabla procedimiento de evacuacion
        $procedimientoEvacuacion=$this->GeneradorPlantillas->obtenerDatosProcedimientoEvacuacion($idAsignacion);
        $arreglo=$procesadorPlantillas->getVariables();
        if(in_array("Procedimiento", $arreglo))
        {
            $procesadorPlantillas->cloneRow("Procedimiento", sizeof($procedimientoEvacuacion));

            $contador=1;
            foreach ($procedimientoEvacuacion as $fila)
            {
                //cambia el nombre de la tabla por un indice
                $procesadorPlantillas->setValue("Procedimiento"."#".$contador, $contador);
                $procesadorPlantillas->setValue("paso#".$contador, $fila['paso']);
                $procesadorPlantillas->setValue("proceso#".$contador, $fila['proceso']);
                $procesadorPlantillas->setValue("equipoMaterialActual#".$contador, $fila['valorEquipo']);
                $procesadorPlantillas->setValue("ProcedimientoBrigadistas#".$contador, $fila['valorProcedimiento']);
                $contador++;
            }
        }


        //Fin de la tabla procedimiento de evacuacion

        //fin de la generación de las tablas de la plantilla
        $procesadorPlantillas->saveAs("assets/img/plantillasPcHechas/".$nombreArchivoPlantilla);
        echo json_encode($idPlantilla);


    }
    function descargaDocumento($idPlantilla)
    {
        $informacionPlantilla=$this->GeneradorPlantillas->getInfoPlantilla($idPlantilla);
        $nombreArchivoPlantilla=$informacionPlantilla['nombreArchivo'];
        $rutaArchivo="assets/img/plantillasPcHechas/".$nombreArchivoPlantilla;
        $this->load->helper("download");

        force_download($rutaArchivo, NULL);

    }
}