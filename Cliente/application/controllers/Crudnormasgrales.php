<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use phpoffice\phpword\bootstrap;


include '../sistema/assets/plugins/TCPDF-master/tcpdf.php';

class Crudnormasgrales extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("normativas"); //cargamos el modelo de User
        $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->load->library('user_agent');
    }


    public function normasGrales()//no borrar
    {
        $Cliente=$this->session->userdata('idCliente');
        $data['normasTotales'] = $this->normativas->getDatos($Cliente);

        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewnormasgrales',$data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewnormasgrales',$data);
            $this->load->view('footer');
        }

    }

    ///Botón normas generales x centro
    public function normasPorCentroGeneral()
    {
        $Cliente=$this->session->userdata('idCliente');//Cliente logeado
        $data['centrosDeTrabajo'] = $this->normativas->getCentrosDeTrabajo($Cliente); //Obtenemos los cebtros de traajo del cliente

        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewnormasgralesporcentro',$data); //Mostramos los datos en la vista
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewnormasgralesporcentro',$data); //Mostramos los datos en la vista
            $this->load->view('footer');
        }

    }

    public function obtenerNormasDeCentro($idCentroTrabajo)
    {
        $Cliente=$this->session->userdata('idCliente');//Cliente logeado
        $data['normasCentrosDeTrabajo'] = $this->normativas->getNormasPorCentro($Cliente,$idCentroTrabajo); //Obtenemos las normas del centro de trabajo seleccionado


        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewnormasgralesporcentrodetalle',$data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewnormasgralesporcentrodetalle',$data);
            $this->load->view('footer');
        }



    }


    public function normasGralescentro($idNorma)//no borrar
    {
        $Cliente=$this->session->userdata('idCliente');
        $data = ['idNorma' => $idNorma];
        $data['centroPornorma'] = $this->normativas->getcentroNorma($Cliente,$idNorma);
        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewnormasgralescentro',$data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewnormasgralescentro',$data);
            $this->load->view('footer');
        }

    }



    public function verificacionControlcalidad($idAsignacion,$idOti,$idSubservicio)//no borrar
    {
        $data = ['idAsignacion' => $idAsignacion,'idOti'=>$idOti,'idSubservicio'=>$idSubservicio];
        $data['doctosEdo'] = $this->normativas->getDoctosEstado($idAsignacion,$idSubservicio);
        $data['ponderadores']=$this->normativas->getPonderadores();
        $data['evaluaciones']=$this->normativas->cargarEvaluaciones($idAsignacion);

        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('gridchecklist',$data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('gridchecklist',$data);
            $this->load->view('footer');
        }
    }

    public function bitacorasGrales()//no borrar
    {
        $Cliente=$this->session->userdata('idCliente');
        $data['bitacorasTotales'] = $this->normativas->getDatosBitacoras($Cliente);


        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewbitacorasgrales',$data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewbitacorasgrales',$data);
            $this->load->view('footer');
        }
    }


    public function bitacorasGralescentro($idCentroTrabajo)//no borrar
    {
        $Cliente=$this->session->userdata('idCliente');
        $data = ['idCentroTrabajo' => $idCentroTrabajo];
        $data['bitacoras'] = $this->normativas->getcentroBitacora($Cliente,$idCentroTrabajo);


        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewbitacorascentro',$data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewbitacorascentro',$data);
            $this->load->view('footer');
        }
    }

    public function hitorialBitacora($idCentroTrabajo,$idBitacora)//no borrar
    {
        $Cliente=$this->session->userdata('idCliente');
        $data = ['idCentroTrabajo' => $idCentroTrabajo,'idBitacora' => $idBitacora];
        //$data['bitacoras'] = $this->normativas->getcentroBitacora($Cliente,$idCentroTrabajo);


        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewhistorialbitacora',$data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewhistorialbitacora',$data);
            $this->load->view('footer');
        }
    }

    function obtenerRespaldos($idCentroTrabajo, $idBitacora)
    {
        echo json_encode($this->normativas->obtenerRespaldos($idCentroTrabajo, $idBitacora));
    }

    function verPDFAnterior($idcen, $idBitacora, $idRespaldo)
    {
        $nombreBitac= $this->normativas->getnombreBitacor($idBitacora);
        $arrayRespaldo=$this->normativas->obtenerRespaldoBitacora($idRespaldo);
        $indicadores = $this->normativas->getIndica($idBitacora);
        $datosCentroTrabajo=$this->normativas->getDatosCentroTrabajoWord($idcen);
        $datosBitacora=json_decode($arrayRespaldo["datosBitacora"], true);
        $indicadorInforme=json_decode($arrayRespaldo["indicadorInforme"], true);
        $calculos=json_decode($arrayRespaldo["calculos"], true);
        $comentariosGenerales=json_decode($arrayRespaldo["comentariosGenerales"], true);

        //crea el nuevo documento
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES));

        $documentProtection = $phpWord->getSettings()->getDocumentProtection();
        $documentProtection->setEditing(\PhpOffice\PhpWord\SimpleType\DocProtect::READ_ONLY);
        $documentProtection->setPassword('myPassword');


        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        $sectionStyle = $section->getStyle();
        $sectionStyle->setOrientation($sectionStyle::ORIENTATION_LANDSCAPE);

        $encabezado = $section->addTable(array('width' => 100*59, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);


        $row = $encabezado->addRow();
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText("ELABORÓ", [], $cellHCentered);

        $row->addCell(1000, array('gridSpan' => 2,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText("GIR (SSHI)",[], $cellHCentered);

        $row->addCell(1000, array('gridSpan' => 10,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText(($nombreBitac[0]['nombre']),array('bold' => true), $cellHCentered);
        if($datosCentroTrabajo["foto"]!="null")
            $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart'))->addImage('../sistema/assets/img/fotoFormato/'.$datosCentroTrabajo["foto"], array('width' => 100, 'height' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        else
            $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart'));


        $row = $encabezado->addRow();
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText('FOLIO', [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 2,'vMerge' => 'restart'))->addText($datosCentroTrabajo["idDet"], [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText("FECHA DE INSPECCIÓN",[], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 6,'vMerge' => 'restart'))->addText(date("Y-m-d"), [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'continue'));

        $row = $encabezado->addRow();
        $row->addCell(1000, array('gridSpan' => 6, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText(' RAZÓN SOCIAL');
        $row->addCell(1000, array('gridSpan' => 10,'vMerge' => 'restart'))->addText($datosCentroTrabajo["razonSocial"], [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'continue'));

        $row = $encabezado->addRow(array('exactHeight' => 'exact'));
        $row->addCell(1000, array('gridSpan' => 6, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText(' CENTRO DE TRABAJO');
        $row->addCell(1000, array('gridSpan' => 10,'vMerge' => 'restart'))->addText($datosCentroTrabajo["nombre"], [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'continue'));

        $section->addTextBreak(1);

        //Inicio de la tabla bitacora
        $tablaBitacoraWord = $section->addTable(array('width' => 100*59, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
        $rowWord = $tablaBitacoraWord->addRow(3000,  array('exactHeight' => true));

        $arregloIndicadoresEncabezado=array();
        $contadorTh=0;
        //idContador sirve para obtener el indicador sobre el que se va a calcular el numero. Ejemplo: Numero de extintores= 3,4,5,7
        $idContador=0;
        $nospace = array('spaceafter' => 0);
        $rowWord->addCell(1000, array('vMerge' => 'restart', 'bgColor' => 'D9D9D9', 'valign'=>'center' ))->addText("No.", array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER), $cellHCentered);

        foreach ($indicadores as $row)
        {
            $id=$row['idIndicador'];
            $nombreIn=$row['nombreIndicador'];
            $tipo=$row['tipoIndicador'];
            $esContador=$row['esContador'];
            if($esContador)
                $idContador=$id;
            if($tipo!=4) {
                $arregloIndicadoresEncabezado[$contadorTh] = $id;
                $rowWord->addCell(1000, array('vMerge' => 'restart', 'bgColor' => 'D9D9D9','textDirection'=>\PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR, 'valign'=>'center' ))->addText("$nombreIn", array('bold'=>true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER), array('spaceafter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $contadorTh++;
            }
        }
        $contadorRegistros=1;
        $numeroRegistros=sizeof($datosBitacora);
        $arregloCondiciones=array();
        $i=0;
        //Recorre todos los datos de la bitacora
        while($i<$numeroRegistros)
        {
            $valorNumerico=0;
            $ultimoAlmacenamiento=$datosBitacora[$i]['idAlmacenamiento'];
            $fila=array();
            $j=0;
            //De la consulta, obtiene toda una fila de datos para mostrarlos en la tabla
            while($ultimoAlmacenamiento==$datosBitacora[$i]['idAlmacenamiento'])
            {
                if($datosBitacora[$i]['tipoIndicador']!=4)
                {
                    if($idContador==$datosBitacora[$i]['idIndicador'])
                    {
                        $valorNumerico=$datosBitacora[$i]['valor'];
                    }
                    $fila[$j++] = $datosBitacora[$i];
                    $ultimoAlmacenamiento = $datosBitacora[$i++]['idAlmacenamiento'];
                    if ($i >= $numeroRegistros)
                        break;
                }
            }
            //crea el tr y le pone un numero
            $nuevoRowWord=$tablaBitacoraWord->addRow();
            $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center' ))->addText("$contadorRegistros",[], $cellHCentered);
            //obtiene la diferencia entre los registros de la tabla y sus encabezados
            $diferencia = sizeof($arregloIndicadoresEncabezado) - sizeof($fila);
            //por cada uno de los datos de la fila
            for ($k = 0; $k < sizeof($fila); $k++)
            {
                //por cada uno de los encabezados
                for($l=$k; $l < sizeof($arregloIndicadoresEncabezado); $l++ )
                {
                    //si el encabezado coincide con el dato de la fila
                    if ($fila[$k]['idIndicador'] == $arregloIndicadoresEncabezado[$l])
                    {
                        $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center'))->addText($fila[$k]['valor'],[], $cellHCentered);
                        $k++;
                        if($k>=sizeof($fila))
                            break;
                    }
                    else
                    {
                        $diferencia--;
                        $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center'))->addText("");
                    }
                }

            }
            while($diferencia>0)
            {
                $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center'))->addText("");
                $diferencia--;
            }
            $contadorRegistros++;
        }
        //fin tabla bitacora
        $section->addTextBreak(1);

        //inicio calculo informe
        $tablaInformeWord= $section->addTable(array('width' => 100*59, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 6, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9', 'valign'=>'center' ))->addText("INFORME", array('bold' => true), $cellHCentered);
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center' ))->addText("Total de colocados");
        $rowWord->addCell(1000, array('gridSpan' => 4,'valign'=>'center' ))->addText($contadorRegistros-1, null,$cellHCentered);

        foreach ($indicadorInforme as $informe)
        {
            $rowWord=$tablaInformeWord->addRow();

            $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center' ))->addText($informe['texto']);
            $rowWord->addCell(1000, array('gridSpan' => 4,'valign'=>'center' ))->addText($informe['valor'],null ,$cellHCentered);
        }
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center' ))->addText("");
        $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center','bgColor' => 'D9D9D9', 'valign'=>'center'))->addText("Cantidad", [], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center','bgColor' => 'D9D9D9', 'valign'=>'center'))->addText("Número",[], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center','bgColor' => 'D9D9D9', 'valign'=>'center'))->addText("Observaciones",[], $cellHCentered);

        foreach($calculos as $calculo)
        {
            $rowWord=$tablaInformeWord->addRow();
            $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center'))->addText($calculo['descripcion']);
            $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center'))->addText($calculo['cantidad'], [], $cellHCentered);
            $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center'))->addText($calculo['numero'], [], $cellHCentered);
            $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center'))->addText($calculo['observaciones'], [], $cellHCentered);
        }
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 6,'valign'=>'center'))->addText("COMENTARIOS Y OBSERVACIONES:\n".$comentariosGenerales['comentarios'], array('bold' =>true));


        $rowWord = $tablaInformeWord->addRow(2000,  array('exactHeight' => true));

        $lugarFecha=$rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'bottom', 'vMerge' => 'continue' ));
        $lugarFecha->addText($datosCentroTrabajo["calle"]." No. ".$datosCentroTrabajo["numeroExterior"].", ".$datosCentroTrabajo["nombreRegion"].", ".$datosCentroTrabajo["nombreMunicipio"].", ".$datosCentroTrabajo["nombreEstado"], array('bold' => true), $cellHCentered);
        $lugarFecha->addText(date("Y-m-d"), array('bold' => true), $cellHCentered);
        $lugarFecha->addText("LUGAR Y FECHA", array('bold' =>true), $cellHCentered);

        $nombreRealizaInspeccion=$rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'bottom', 'vMerge' => 'continue'));

        $nombreRealizaInspeccion->addText($datosCentroTrabajo["nombreUsuario"], array('bold' =>true), $cellHCentered);
        $nombreRealizaInspeccion->addText("NOMBRE Y FIRMA DE QUIEN REALIZA LA INSPECCIÓN", array('bold' =>true), $cellHCentered);

        $nombreResponsable=$rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'bottom', 'vMerge' => 'continue' ));
        $nombreResponsable->addText("", array('bold' =>true), $cellHCentered);
        $nombreResponsable->addText("NOMBRE Y FIRMA DE RESPONSABLE DEL INMUEBLE\n", array('bold' =>true), $cellHCentered);
        //fin calculo informe


        //FIN TABLA DE CONTROL DE CAMBIOS
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Bitacora.docx');
        $this->load->helper('download');
        force_download('Bitacora.docx', NULL);



        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        // $objWriter->save('Bitacora.html');
        // $file = file_get_contents('Bitacora.html');
        // $pdf = $this->pdf;
        // $pdf->AddPage('L');
        // $pdf->writeHTML($file, true, false, true, false, '');
        // $pdf->Output('Bitacora.pdf', 'I');


    }

    function convertirPDF()
    {
        //require_once '/vendor/phpoffice/phpword/src/PhpWord/IOFactory.php';
        \PhpOffice\PhpWord\Settings::loadConfig();
        \PhpOffice\PhpWord\Settings::setPdfRendererName(\PhpOffice\PhpWord\Settings::PDF_RENDERER_TCPDF);
        \PhpOffice\PhpWord\Settings::setPdfRendererPath(base_url('/vendor/tecnick.com/tcpdf') );

        //$phpWord  =  \PhpOffice\PhpWord\IOFactory::load( ' Bitacora.docx ' );

        $phpWord = \PhpOffice\PhpWord\IOFactory::load("Bitacora.docx");
        $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
        $pdfWriter->save("Bitacora.pdf");

        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        // $objWriter->save('Bitacora.docx');
        $this->load->helper('download');
        force_download('Bitacora.pdf', NULL);
    }



}

?>