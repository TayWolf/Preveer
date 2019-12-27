<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use phpoffice\phpword\bootstrap;
class CrudActaverificacion extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("actaverificacion"); //cargamos el modelo de User
        
    }

    // public function index($index = 1)
    // {
    //     $data['listaUser'] = $this->actaverificacion->getDatos($index);
    //     $this->load->view('gridactaverificacion',$data);
    // }

    public function formActaverificacion($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
         $data['existencia']=$this->actaverificacion->verificarExistenciaActa($idAsignacion);
         $data['catalogo']=$this->actaverificacion->getCatalogoActa();

         $contador=0;
         foreach ($data['existencia'] as $row)
         {
             $contador++;
        }
        if($contador==0)
        {
            $this->actaverificacion->nuevaExistenciaActa($idAsignacion);
            $data['existencia']=$this->actaverificacion->verificarExistenciaActa($idAsignacion);
        }
        $data['tiposPuente']=$this->actaverificacion->getTipoPuente($idAsignacion);
        $data['tiposPuenteEvi']=$this->actaverificacion->getTipoPuenteEvi($idAsignacion);
         $data['tiposPuenteInca']=$this->actaverificacion->getTipoPuenteInca($idAsignacion);
        $this->load->view('gridactaverificacion', $data);
    }

    public function actualizardatosActa()
    {
        
        $ciudMuni = $this->input->post('ciudMuni');
        $horaU = $this->input->post('horaU');
        $fechaU = $this->input->post('fechaU');
        $razonSocia = $this->input->post('razonSocia');
        $rfcC = $this->input->post('rfcC');
        $regiPatro = $this->input->post('regiPatro');
        $descripcEmp = $this->input->post('descripcEmp');
        $nEmple = $this->input->post('nEmple');
        $domiFisc = $this->input->post('domiFisc');
        $cp = $this->input->post('cp');
        $idAsignacion = $this->input->post('idAsignacion');
        $hodrDos= $this->input->post('hodrDos');
        $fechDos= $this->input->post('fechDos');
        $idActa= $this->input->post('idActa');

       $reprePatronCor= $this->input->post('reprePatronCor');
       $reprePatroSecrer= $this->input->post('reprePatroSecrer');
       $reprePatronVocal= $this->input->post('reprePatronVocal');
       $repreTrabaVocal= $this->input->post('repreTrabaVocal');
       $reprePatronVocalDos= $this->input->post('reprePatronVocalDos');
       $RepreTrabaVocalDos= $this->input->post('RepreTrabaVocalDos');


        $datosActa=Array(
            'ciudadEstado'=>$ciudMuni,
            'hora'=>$horaU,
            'fechaU'=>$fechaU,
            'registroPatronal'=>$regiPatro,
            'descripcionEmpresa'=>$descripcEmp,
            'nEmpleado'=>$nEmple,
            'CP'=>$cp,
            'horaDos'=>$hodrDos,
            'fechaDos'=>$fechDos,
            'reprePatronCor'=>$reprePatronCor,
            'reprePatroSecrer'=>$reprePatroSecrer,
            'reprePatronVocal'=>$reprePatronVocal,
            'repreTrabaVocal'=>$repreTrabaVocal,
            'reprePatronVocalDos'=>$reprePatronVocalDos,
            'RepreTrabaVocalDos'=>$RepreTrabaVocalDos
        );
        //uno
        $this->actaverificacion->actualizarDatosActa($datosActa, $idAsignacion);
       // echo "entra ";
        $datosPuenteActa = json_decode($this->input->post('datosPuenteActa'));
        foreach ($datosPuenteActa as $key => $value2)
        {
            $accion=$value2->action;
             $idPuente = $value2->idPuente;
            if($accion == 1)
            {
              // echo "entra uno inserta";
              $dataPuente = array(
                  'puntosRevisar' => $value2->puntoRevi,
                  'idAsignacion' => $idAsignacion,
                  'Area' => $value2->areaRe,
                  'puntosNorm' => $value2->puntNom
                  );
          
                $this->actaverificacion->borrarDatosTiposP($idPuente);
                $this->actaverificacion->insertaDatosAcPuente($dataPuente);
            }
            //UPDATE
            else if($accion == 2)
            {
              // echo "entra dos modif";
                $idPuente = $value2['idPuente'];
                $dataPuente = array(
                  'puntosRevisar' => $value2->puntoRevi,
                  'idAsignacion' => $idAsignacion,
                  'Area' => $value2->areaRe,
                  'puntosNorm' => $value2->puntNom
                  );
                $this->actaverificacion->actualizarDatosTipoPuente($dataPuente, $idPuente);
            }
            //DELETE
            else if($accion == 3)
            {
              // echo "entra uno elimina";
                $idPuente = $value2->idPuente;
                $this->actaverificacion->borrarDatosTiposP($idPuente);
            }
        }
        //dos
        
        $datosPuenteActaU = json_decode($this->input->post('datosPuenteActaU'));
        foreach ($datosPuenteActaU as $keye => $valuee2)
        {
            $accionD=$valuee2->actionD;
             $idPuentE = $valuee2->idPuentE;
            if($accionD == 1)
            {
               //echo "entra dos inserta";
              $dataPuente = array(
                  'condicionesEv' => $valuee2->condicionesEv,
                  'idAsignacion' => $idAsignacion,
                  'areaEvi' => $valuee2->areaEvi,
                  'recomenEvi' => $valuee2->recomEvid,
                  'nombreEspEvi' => $valuee2->responsableEvi,
                  'fechaAvisEvi' => $valuee2->fechaAviEvi,
                  'fechaFevi' => $valuee2->fechaFevid,
                  'fotoEvidencia' => "null"
                  );
          
                $this->actaverificacion->borrarDatosTiposPD($idPuentE);
                $this->actaverificacion->insertaDatosAcPuenteEv($dataPuente);
            }
            //UPDATE
            else if($accionD == 2)
            {
              // echo "entra dos modifica";
                $idPuentE = $valuee2['idPuentE'];
                $dataPuente = array(
                  'condicionesEv' => $valuee2->condicionesEv,
                  'idAsignacion' => $idAsignacion,
                  'areaEvi' => $valuee2->areaEvi,
                  'recomenEvi' => $valuee2->recomEvid,
                  'nombreEspEvi' => $valuee2->responsableEvi,
                  'fechaAvisEvi' => $valuee2->fechaAviEvi,
                  'fechaFevi' => $valuee2->fechaFevid
                  );
                $this->actaverificacion->actualizarDatosTipoPuenteD($dataPuente, $idPuentE);
            }
            //DELETE
            else if($accionD == 3)
            {
              // echo "entra dos elimina";
            
                $idPuentE = $valuee2->idPuentE;
                $this->actaverificacion->borrarDatosTiposPD($idPuentE);
            }
        }
        //tres
        
        $datosPuenteActaDD = json_decode($this->input->post('datosPuenteActaD'));
        foreach ($datosPuenteActaDD as $keyD => $valueDD2)
        {
            $accionT=$valueDD2->actionT;
             $idPuen = $valueDD2->idPuen;
            if($accionT == 1)
            {
              // echo "entra tres inserta";
              $dataPuente = array(
                  'TipoInca' => $valueDD2->tipoIncap,
                  'idAsignacion' => $idAsignacion,
                  'noInc' => $valueDD2->noInca,
                  'areaInca' => $valueDD2->areaInca,
                  'FechaHora' => $valueDD2->FehInca,
                  'actoInca' => $valueDD2->actpInseIn,
                  'condicionesPeli' => $valueDD2->condicionInca
                  );
          
                $this->actaverificacion->borrarDatosTiposPDD($idPuen);
                $this->actaverificacion->insertaDatosAcPuenteInca($dataPuente);
            }
            //UPDATE
            else if($accionT == 2)
            {
              // echo "entra tres modifica";
                $idPuen = $valueDD2['idPuen'];
                $dataPuente = array(
                  'TipoInca' => $valueDD2->tipoIncap,
                  'idAsignacion' => $idAsignacion,
                  'noInc' => $valueDD2->noInca,
                  'areaInca' => $valueDD2->areaInca,
                  'FechaHora' => $valueDD2->FehInca,
                  'actoInca' => $valueDD2->actpInseIn,
                  'condicionesPeli' => $valueDD2->condicionInca
                  );
                $this->actaverificacion->actualizarDatosTipoPuenteDD($dataPuente, $idPuen);
            }
            //DELETE
            else if($accionT == 3)
            {
             // echo "entra tres elimina";
                $idPuen = $valueDD2->idPuen;
                $this->actaverificacion->borrarDatosTiposPDD($idPuen);
            }
        }
    }

    function insertarArregloActas($idAsignacion)
{
  $datosActaP = json_decode($this->input->post('datos'));

  foreach ($datosActaP as $key => $value2)
  {
      //INSERT
     $array = array(
        'puntosRevisar' => $value2->puntoRevi,
        'idAsignacion' => $idAsignacion,
        'Area' => $value2->areaRe,
        'puntosNorm' => $value2->puntNom
        );
          
      $idPrimaria = $this->actaverificacion->insertaDatosAcPuente($array);
      foreach ($idPrimaria as $key3 =>$val)
          echo($val['LAST_INSERT_ID()']);
  }
}

//otra
function insertarArregloActasEv($idAsignacion)
{
  $datosActaP = json_decode($this->input->post('datosE'));

  foreach ($datosActaP as $key => $value2)
  {
      //INSERT
     $array = array(
        'condicionesEv' => $value2->condicionesEv,
        'idAsignacion' => $idAsignacion,
        'areaEvi' => $value2->areaEvi,
        'recomenEvi' => $value2->recomEvid,
        'nombreEspEvi' => $value2->responsableEvi,
        'fechaAvisEvi' => $value2->fechaAviEvi,
        'fechaFevi' => $value2->fechaFevid,
        'fotoEvidencia' => "null"
        );
          
      $idPrimaria = $this->actaverificacion->insertaDatosAcPuenteEv($array);
      foreach ($idPrimaria as $key3 =>$val)
          echo($val['LAST_INSERT_ID()']);
  }
}
//ultima
function insertarArregloActasInca($idAsignacion)
{
  $datosActaInca = json_decode($this->input->post('datosI'));

  foreach ($datosActaInca as $key => $value2)
  {
      //INSERT
     $array = array(
        'TipoInca' => $value2->tipoIncap,
        'noInc' => $value2->noInca,
        'areaInca' => $value2->areaInca,
        'FechaHora' => $value2->FehInca,
        'actoInca' => $value2->actpInseIn,
        'condicionesPeli' => $value2->condicionInca,
        'idAsignacion' => $idAsignacion
        );
          
      $idPrimaria = $this->actaverificacion->insertaDatosAcPuenteInca($array);
      foreach ($idPrimaria as $key3 =>$val)
          echo($val['LAST_INSERT_ID()']);
  }
}
   
   function retornoFotoPK($idLlavePrimaria, $tabla, $campo)
{
  echo json_encode( $this->actaverificacion->retornarFotoPK($idLlavePrimaria, $tabla, $campo));
}


    
function subirFotoGeneralTabla($campo, $tabla, $llavePrimaria, $campoLlave)
    {
        if (empty($_FILES[$campo])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES[$campo];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        if(!file_exists("assets/img/fotoEvidencia/") && !is_dir("assets/img/fotoEvidencia/"))
        {
            mkdir("assets/img/fotoEvidencia/");
        }
        //for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoEvidencia/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'], $target)) {
                $data=Array("$campo"=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->actaverificacion->actualizarImagenGeneralTabla($campoLlave, $llavePrimaria, $data, $tabla);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;

            }
        //}
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function eliminarImagenArreglo($campo, $tabla, $llavePrimaria, $campoLlave)
    {
        //Comunicar con el modelo para sacar el nombre de la imagen
        $data=$this->actaverificacion->getNombreImagenTabla($campo, $tabla, $llavePrimaria, $campoLlave);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => "null");
        $this->actaverificacion->deleteImagenTabla($borrar, $tabla, $llavePrimaria, $campoLlave);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row[$campo];
            unlink("assets/img/fotoEvidencia/$nombreImagen");
            echo "OK";
        }

    }
    function verActaVerificacion($idAsignacion)
    {

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES));

        $datosGrales=$this->actaverificacion->getDatosGra($idAsignacion);
        $contenidoTableU=$this->actaverificacion->getDatosTu($idAsignacion);
        $contenidoTableE=$this->actaverificacion->getDatosEvi($idAsignacion);
        $contenidoTableI=$this->actaverificacion->getDatosiNCA($idAsignacion);
        $datosCentroTrabajo=$this->actaverificacion->getDatosCentroTrabajoWord($idAsignacion);
        $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);
        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        $sectionStyle = $section->getStyle();
        $sectionStyle->setOrientation($sectionStyle::ORIENTATION_LANDSCAPE);
        $header = $section->addHeader();


        $tablaEncabezado=$header->addTable(array('width' => 100*52, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $rowEncabezado=$tablaEncabezado->addRow();


if($datosCentroTrabajo["foto"]!="null")
            $rowEncabezado->addCell(500, array('gridSpan' => 4,'vMerge' => 'restart', 'vAlign'=> 'center'))->addImage('assets/img/fotoFormato/'.$datosCentroTrabajo["foto"], array('width' => 100, 'height' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        else
            $rowEncabezado->addCell(500, array('gridSpan' => 4,'vMerge' => 'restart'));

        $rowEncabezado->addCell(2000, array('gridSpan' => 16, 'vMerge' => 'restart', 'vAlign'=> 'center'))->addText($datosCentroTrabajo["razonSocial"], ['name' => 'Calibri', 'size' => 9,'bold' => true], $cellHCentered);
        $rowEncabezado=$tablaEncabezado->addRow();
        $rowEncabezado->addCell(500, array('gridSpan' => 4,'vMerge' => 'continue'));
        $rowEncabezado->addCell(2000, array('gridSpan' => 12,'vAlign'=> 'center', 'bgColor' => '808080'))->addText("NOMBRE DEL DOCUMENTO", ['name' => 'Calibri', 'size' => 9, 'color' => 'FFFFFF'], $cellHCentered);
        $rowEncabezado->addCell(500, array('gridSpan' => 4,'vAlign'=> 'center', 'bgColor' => '808080'))->addText("CÓDIGO", ['name' => 'Calibri', 'size' => 9, 'color' => 'FFFFFF'], $cellHCentered);
        $rowEncabezado=$tablaEncabezado->addRow();
        $rowEncabezado->addCell(500, array('gridSpan' => 4, 'vMerge' => 'continue'));
        $celda=$rowEncabezado->addCell(2000, array('gridSpan' => 12,'vAlign'=> 'center'));
        $celda->addText("ACTA DE VERIFICACIÓN OCULAR EN EL CENTRO DE TRABAJO", ['name' => 'Calibri', 'size' => 9, 'bold' => true, 'underline' => 'single'], $cellHCentered);
        $celda->addText( "ACTA 1/ ".date("Y"), ['name' => 'Calibri', 'size' => 9, 'bold' => true], $cellHCentered);
        $rowEncabezado->addCell(500, array('gridSpan' => 4, 'vAlign'=> 'center'))->addText("Seguridad, Salud e Higiene Industrial", ['name' => 'Calibri', 'size' => 9], $cellHCentered);

        $rowEncabezado=$tablaEncabezado->addRow();
        $rowEncabezado->addCell(500, array('gridSpan' => 4, 'vAlign'=> 'center', 'bgColor' => '808080'))->addText("FECHA DE RECORRIDO", ['name' => 'Calibri', 'size' => 9, 'color' => 'FFFFFF'], $cellHCentered);
        $rowEncabezado->addCell(2000, array('gridSpan' => 12, 'vAlign'=> 'center'))->addText("(TEMA)", ['name' => 'Calibri', 'size' => 9, 'bold' => true], $cellHCentered);
        $rowEncabezado->addCell(200, array('gridSpan' => 1, 'bgColor' => '808080'))->addText("ELABORÓ", ['name' => 'Calibri', 'size' => 9, 'color' => 'FFFFFF'], $cellHCentered);
        $rowEncabezado->addCell(300, array('gridSpan' => 3, 'vMerge' => 'restart', 'vAlign'=> 'center',  'bgColor' => '808080'))->addText("PÁGINA", ['name' => 'Calibri', 'size' => 9, 'color' => 'FFFFFF'], $cellHCentered);

        $rowEncabezado=$tablaEncabezado->addRow();
        setlocale(LC_ALL,"es_ES");
        $fecha= date("d/m/Y");

        $date = DateTime::createFromFormat("d/m/Y", $fecha);

        $rowEncabezado->addCell(500, array('gridSpan' => 4, 'vMerge' => 'restart'))->addText(strftime("%B",$date->getTimestamp())." ".date("Y"), ['name' => 'Calibri', 'size' => 9], $cellHCentered);
        $rowEncabezado->addCell(2000, array('gridSpan' => 12, 'vMerge' => 'continue', 'vAlign'=> 'center'));
        $rowEncabezado->addCell(200, array('gridSpan' => 1, 'vMerge' => 'restart'))->addText("SSHI", ['name' => 'Calibri', 'size' => 9], $cellHCentered);
        $rowEncabezado->addCell(300, array('gridSpan' => 3, 'vMerge' => 'restart'))->addPreserveText('{PAGE} DE {NUMPAGES}', ['name' => 'Calibri', 'size' => 9], $cellHCentered);
        $header->addTextBreak(1);
        foreach($datosGrales as $rowIn)
        {
            $ciudadEst=$rowIn['ciudadEstado'];
            $horaU=$rowIn['hora'];
            $fechaU=$rowIn['fechaU'];
            $registroPatronal=$rowIn['registroPatronal'];
            $descripcionEmpresa=$rowIn['descripcionEmpresa'];
            $nEmpleado=$rowIn['nEmpleado'];
            $CPU=$rowIn['CP'];
            $razonSocial=$rowIn['razonSocial'];
            $rfcR=$rowIn['rfc'];
            $domicilioFiscal=$rowIn['domicilioFiscal'];

            $fechaDos=$rowIn['fechaDos'];
            $reprePatronCor=$rowIn['reprePatronCor'];
            $reprePatroSecrer=$rowIn['reprePatroSecrer'];
            $reprePatronVocal=$rowIn['reprePatronVocal'];
            $repreTrabaVocal=$rowIn['repreTrabaVocal'];
            $reprePatronVocalDos=$rowIn['reprePatronVocalDos'];
            $RepreTrabaVocalDos=$rowIn['RepreTrabaVocalDos'];
            $horaDos=$rowIn['horaDos'];
        }
        $section->addTextBreak(1);
        $section->addText('En '.$ciudadEst.', siendo las '.$horaU.', del día '.$fechaU.', se reunieron los integrantes de la Comisión de Seguridad e Higiene en el interior de las instalaciones de la empresa '.$razonSocial.' con Registro Federal de Contribuyentes '.$rfcR.'  y Registro Patronal '.$registroPatronal.' , cuya actividad consiste en '.$descripcionEmpresa.' y cuenta con una plantilla de '.$nEmpleado.' trabajadores, con domicilio en '.$domicilioFiscal.'  Y '.$CPU.' a efecto de realizar el recorrido de verificación, conforme a lo dispuesto en los artículos 509, 510 y 540 de la Ley Federal del Trabajo; Artículo 45, I, II, III, IV, V, VI,VII,VII, IX, X del Reglamento Federal de Seguridad y Salud en el Trabajo,  la NOM-19-STPS-2011.', [], array('align' => 'both'));

        $section->addTextBreak(1);
        $section->addText("PUNTOS POR REVISAR", ['bold' => true], array('align' => 'center'));
        $section->addTextBreak(1);

        $tablaEncabezado=$section->addTable(array('width' => 100*52, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $row=$tablaEncabezado->addRow();
        $row->addCell(200, array('gridSpan' => 1,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("NO.", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(800, array('gridSpan' => 4,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("PUNTOS POR REVISAR", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(600, array('gridSpan' => 3,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("ÁREA", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(1000, array('gridSpan' => 5,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("PUNTOS DE LAS NOM'S", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $tU=1;
        if(!empty($contenidoTableU))
            foreach ($contenidoTableU as $row)
            {
                $rowWord=$tablaEncabezado->addRow();
                $puntosRevisar=$row["puntosRevisar"];
                $AreaTu=$row["Area"];
                $puntosNorm=$row["puntosNorm"];
                $rowWord->addCell(200, array('gridSpan' => 1,'vAlign'=> 'center'))->addText($tU++, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(800, array('gridSpan' => 4,'vAlign'=> 'center'))->addText($puntosRevisar, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(600, array('gridSpan' => 3,'vAlign'=> 'center'))->addText($AreaTu, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(1000, array('gridSpan' => 5,'vAlign'=> 'center'))->addText($puntosNorm, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            }
            else
            {
                $rowWord=$tablaEncabezado->addRow();
                $rowWord->addCell(200, array('gridSpan' => 1,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(800, array('gridSpan' => 4,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(600, array('gridSpan' => 3,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(1000, array('gridSpan' => 5,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $section->addText("Sin reportes", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            }
        $section->addTextBreak(1);
        $section->addText("Cumpliendo con lo establecido en el reglamento de seguridad y salud en el trabajo, se realizó una inspección ocular dentro del centro de trabajo, para identificar la estructura del inmueble y realizar las recomendaciones pertinentes para reparar corregir estos puntos.", [], array('align' => 'both'));
        $section->addTextBreak(1);
        $section->addText("En la siguiente tabla se muestran los detalles del recorrido realizado", [], array('align' => 'left'));
        $tablaRecorrido=$section->addTable(array('width' => 100*52, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $row=$tablaRecorrido->addRow();
        $row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("NO.", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(500, array('gridSpan' => 5,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("EVIDENCIA", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("CONDICIONES INSEGURAS DETECTADAS", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("ÁREA", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(600, array('gridSpan' => 6,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("RECOMENDADACIONES PARA PREVENIR LAS CONDICIONES INSEGURAS DETECTADAS", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("NOMBRE DEL RESPONSABLE", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("FECHA DE AVISO COMPROMISO", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("FECHA DE FINALIZACIÓN", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        $tUw=1;
        if(!empty($contenidoTableE))
            foreach ($contenidoTableE as $rowE)
        {
            $rowWord = $tablaRecorrido->addRow();
            $condicionesEv = $rowE["condicionesEv"];
            $areaEvi = $rowE["areaEvi"];
            $recomenEvi = $rowE["recomenEvi"];
            $nombreEspEvi = $rowE["nombreEspEvi"];
            $fechaAvisEvi = $rowE["fechaAvisEvi"];
            $fechaFevi = $rowE["fechaFevi"];
            $fotoEvidencia = $rowE["fotoEvidencia"];
            $rowWord->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'))->addText($tUw++, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            if(!empty($fotoEvidencia)&&$fotoEvidencia!="null")
                $rowWord->addCell(500, array('gridSpan' => 5,'vAlign'=> 'center'))->addImage('assets/img/fotoEvidencia/'.$rowE["fotoEvidencia"], array('width' => 100, 'height' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            else
                $rowWord->addCell(500, array('gridSpan' => 5,'vAlign'=> 'center'));

            $rowWord->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText($condicionesEv, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $rowWord->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText($areaEvi, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $rowWord->addCell(600, array('gridSpan' => 6,'vAlign'=> 'center'))->addText($recomenEvi, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $rowWord->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText($nombreEspEvi, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $rowWord->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText($fechaAvisEvi, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $rowWord->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText($fechaFevi, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $tUw++;
        }
            else
            {
                $rowWord = $tablaRecorrido->addRow();
                $rowWord->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'));
                $rowWord->addCell(500, array('gridSpan' => 5,'vAlign'=> 'center'));
                $rowWord->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(600, array('gridSpan' => 6,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $section->addText("Sin reportes", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            }
        $section->addTextBreak(1);
        $section->addText("REPORTE DE ACCIDENTES, INCIDENTES O ENFERMEDADES DE TRABAJO.", ['bold' => true], []);
        $section->addTextBreak(1);

        $tablaReporte=$section->addTable(array('width' => 100*52, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $row=$tablaReporte->addRow();
        $row->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("Tipo de incapacidad", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("NO.", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("ÁREA", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("FECHA Y HORA", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("ACTO INSEGURO", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center', 'bgColor' => 'd9d9d9'))->addText("CONDICIÓN PELIGROSA", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        if(!empty($contenidoTableI))
            foreach ($contenidoTableI as $rowI)
        {
            $TipoInca=$rowI["TipoInca"];
            $noInc=$rowI["noInc"];
            $areaInca=$rowI["areaInca"];
            $FechaHora=$rowI["FechaHora"];
            $actoInca=$rowI["actoInca"];
            $condicionesPeli=$rowI["condicionesPeli"];

            $row=$tablaReporte->addRow();
            $row->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText($TipoInca, ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'))->addText($noInc, ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText($areaInca, ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText($FechaHora, ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText($actoInca, ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText($condicionesPeli, ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        }
        else
        {
            $row=$tablaReporte->addRow();
            $row->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(200, array('gridSpan' => 2,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $row->addCell(300, array('gridSpan' => 3,'vAlign'=> 'center'))->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
            $section->addText("Sin reportes", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        }
        $section->addText("No existiendo otro asunto que tratar, se dio por terminada la presente, siendo las $horaDos horas del día $fechaDos del presente año, Firmando de conformidad al calce y margen los que en ella intervinieron.");
        $section->addText("Firmas Autógrafas.");

        $tablaFirmas=$section->addTable(array('width' => 100*52, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
        $row=$tablaFirmas->addRow();
        $celdaFirma=$row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'));
        $celdaFirma->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("______________________________", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText($reprePatronCor, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("Representante del Patrón (Coordinadora)", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        $celdaFirma=$row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'));
        $celdaFirma->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("______________________________", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText($reprePatroSecrer, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("Representante de los trabajadores (Secretario)", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        $row=$tablaFirmas->addRow();
        $celdaFirma=$row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'));
        $celdaFirma->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("______________________________", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText($reprePatronVocal, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("Representante del Patrón (Vocal)", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        $celdaFirma=$row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'));
        $celdaFirma->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("______________________________", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText($repreTrabaVocal, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("Representante de los trabajadores (Vocal)", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        $row=$tablaFirmas->addRow();


        $celdaFirma=$row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'));
        $celdaFirma->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("______________________________", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText($RepreTrabaVocalDos, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("Representante del Patrón (Vocal)", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        $celdaFirma=$row->addCell(100, array('gridSpan' => 1,'vAlign'=> 'center'));
        $celdaFirma->addText("", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("______________________________", ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText($reprePatronVocalDos, ['name' => 'Calibri', 'size' => 11, 'color' => '000000'], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $celdaFirma->addText("Representante de los trabajadores (Vocal)", ['name' => 'Calibri', 'size' => 11, 'color' => '000000', 'bold' => true], array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('ActaVerificacion.docx');
        $this->load->helper('download');
        force_download('ActaVerificacion.docx', NULL);

    }

        

    }

?>