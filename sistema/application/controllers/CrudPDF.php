<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'assets/plugins/PHPMailer/src/PHPMailer.php';
include 'assets/plugins/PHPMailer/src/SMTP.php';
include 'assets/plugins/PHPMailer/src/Exception.php';

include 'assets/plugins/TCPDF-master/tcpdf.php';

class CrudPDF extends CI_Controller {

    private $pdf;
    private $mail;

    function __construct()
    {
        parent::__construct();

        $this->load->model("visitasAcuses");
        $this->load->model("centrosTrabajo");

        $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->mail = new PHPMailer(true);
    }
    public function checkList($idAsignacion)
    {
        $data['datosCentroTrabajo']= $this->visitasAcuses->getDatosCentroTrabajo($idAsignacion);
        for($i=1; $i<11; $i++)
            $data['instalacion'.$i]=$this->visitasAcuses->getInstalacion($i);

        $data['idAsignacion']=$idAsignacion;
        $data['doctosEdo'] = $this->visitasAcuses->getDoctosEstado($idAsignacion);
        $data['todoRespuesta']=$this->visitasAcuses->ResultadoCheck($idAsignacion);

        $arre=array();
         foreach ($data['todoRespuesta'] as $key) {
                $idDocumentos= $key['idDocumentos'];
                $arreglo=$this->visitasAcuses->ResultadoPonde($idDocumentos,$idAsignacion);
                $arreglo['nombreDocumento']=$key["nombreDocumento"];
                array_push($arre, $arreglo);
            }
            $data['tabla']=$arre;
        
        $data['pdf'] = $this->pdf;


        $this->load->view('PDFChecklist', $data);
    }
    public function checkListSSHI($idAsignacion,$idSubservicio)
    {
        $this->load->model("checklist");
        $data['datosCentroTrabajo']= $this->visitasAcuses->getDatosCentroTrabajo($idAsignacion);
        $data['idCentroTrabajo']=$this->checklist->getIdCentroTrabajo($idAsignacion)["idCentroTrabajo"];
        $data['tabla']=$this->checklist->cargarResultadosPDF($data['idCentroTrabajo'], $idSubservicio);
        $data['pdf'] = $this->pdf;
        $this->load->view('PDFChecklistSSHI', $data);
    }
    public function acuse($idAsignacion)
    {
        for($i=1; $i<14; $i++)
        $data['instalacion'.$i]=$this->visitasAcuses->getInstalacion($i);
        $data['idAsignacion']=$idAsignacion;
        $data['acuses']=$this->visitasAcuses->getAcuses($idAsignacion);
        $data['conteBotiquin']=$this->visitasAcuses->getInstalacionBotiquinAsignacion($idAsignacion);
        $data['pdf'] = $this->pdf;
        $data['nombreusuario']= $this->visitasAcuses->nombreUsuarioVisita($this->session->userdata('idusuariobase'));
        $data['datosCentroTrabajo']= $this->visitasAcuses->getDatosCentroTrabajo($idAsignacion);
        $data['numeroInspeccion']= $this->visitasAcuses->getNumeroInspeccion($idAsignacion);
        $data['foto']= $this->visitasAcuses->getFotoAcuseVisita($idAsignacion);
        $this->load->view('PDFAcuseVisita', $data);
    }

    public function ActaVerificacion($idAsignacion)
    {
        $data['pdf'] = $this->pdf;
        $data['datosGrales']=$this->visitasAcuses->getDatosGra($idAsignacion);
        $data['contenidoTableU']=$this->visitasAcuses->getDatosTu($idAsignacion);
        $data['contenidoTableE']=$this->visitasAcuses->getDatosEvi($idAsignacion);
         $data['contenidoTableI']=$this->visitasAcuses->getDatosiNCA($idAsignacion);
        $this->load->view('PDFactaverifica',$data);
    }

    public function procedimiento($idAsignacion)
    {
        $this->load->model("ProcedimientoEvacuacion");
        $data['idAsignacion']=$idAsignacion;
        $data['tabla']=$this->ProcedimientoEvacuacion->getTabla($idAsignacion);
        $data['recomendaciones']=$this->ProcedimientoEvacuacion->getRecomendaciones($idAsignacion);
        $data['idCentroTrabajo']=$this->ProcedimientoEvacuacion->getIdCentroTrabajo($idAsignacion);
        $data['datosCentroTrabajo']=$this->ProcedimientoEvacuacion->getDatosCentroTrabajo($idAsignacion);
        $data['pdf'] = $this->pdf;
        $data['nombreusuario']= $this->visitasAcuses->nombreUsuarioVisita($this->session->userdata('idusuariobase'));
        $this->load->view('PDFProcedimiento', $data);
    }


    public function OMPC($idAsignacion)
    {
        $data['idAsignacion'] = $idAsignacion;
        $data['datosCentroTrabajo']=$this->visitasAcuses->getDatosCentroTrabajo($idAsignacion);
        $data['riesgo_acuse'] = $this->visitasAcuses->getRiesgoAcuse();
        $data['prioridad_mejora'] = $this->visitasAcuses->getPrioridadMejora();
        $formularios=$this->visitasAcuses->getFormularios();
        $i=0;
        foreach ($formularios as $formulario)
        {
            //obtiene el id del formulario con asignacion
            $formularioAsignacion=$this->visitasAcuses->getFormularioAsignacion($idAsignacion, $formulario['idControl']);
            //obtiene las observaciones de cada uno de los formularios
            $observacionesRestantes=$this->visitasAcuses->getObservaciones($formularioAsignacion[0]['idFormularioAsignacion']);
            foreach ($observacionesRestantes as $observacionRestante)
            {
                $arregloInsercionObservacion=array('idFormularioAsignacion' => $observacionRestante['idFormularioAsignacion'], 'idIndicador'=> $observacionRestante['idIndicador']);
                $this->visitasAcuses->insertarOMPC($arregloInsercionObservacion);
            }
            $datosOMPC[$i++]=$this->visitasAcuses->getOMPCPDF($formularioAsignacion[0]['idFormularioAsignacion']);

        }
        $data['OMPC']=$datosOMPC;
        $data['cantidadRegistros']=$i;
        $data['pdf'] = $this->pdf;
        $data['recomendacionesPE'] = $this->visitasAcuses->getRecomendacione($idAsignacion);
        $this->load->view('PDFOMPC',$data);
    }

    public function OMSSHI($idAsignacion, $totalOportunidades, $totalSoluciones)
    {
        $data['idAsignacion'] = $idAsignacion;
        $data['totalOportunidades'] = $totalOportunidades;
        $data['totalSoluciones'] = $totalSoluciones;
         $idCen=$this->visitasAcuses->idCentroTraba($idAsignacion);  
            foreach ($idCen as $key) {
                $idCentroTrabajo= $key['idCentroTrabajo'];
            }
            $data['idCentroTrabajo'] = $idCentroTrabajo;
            ///echo "dato $idCentroTrabajo idAsignacion $idAsignacion";
        $data['DatosGrales'] = $this->visitasAcuses->datosTablasshiPDF($idCentroTrabajo);
        $data['pdf'] = $this->pdf;

        $this->load->view('PDFOMSSHI',$data);
    }

    public function enviarPDFAcuse($idAsignacion, $idCentroTrabajo)
    {
        $correoDestino = $this->input->post("correoAcuse");
        $arrayCentroTrabajo = $this->centrosTrabajo->obtenerFichaPDF($idCentroTrabajo);

        for($i=1; $i<14; $i++)
        $data['instalacion'.$i]=$this->visitasAcuses->getInstalacion($i);
        $data['idAsignacion']=$idAsignacion;
        $data['acuses']=$this->visitasAcuses->getAcuses($idAsignacion);
        $data['pdf'] = $this->pdf;
        $data['nombreusuario']= $this->visitasAcuses->nombreUsuarioVisita($this->session->userdata('idusuariobase'));
        $data['datosCentroTrabajo']= $this->visitasAcuses->getDatosCentroTrabajo($idAsignacion);
        $data['conteBotiquin']=$this->visitasAcuses->getInstalacionBotiquinAsignacion($idAsignacion);
        $archivoPDF = $this->load->view('PDFAcuseVisita', $data, true);

        try {
            //$this->mail->SMTPDebug = 2;                                   // Enable verbose debug output
            // $this->mail->isSMTP();                                          // Set mailer to use SMTP
            // $this->mail->Host = 'ssl://mail.cointic.com.mx';                // Specify main and backup SMTP servers
            // $this->mail->SMTPAuth = true;                                   // Enable SMTP authentication
            // $this->mail->Username = 'prueba@cointic.com.mx';                // SMTP username
            // $this->mail->Password = '5ugk5DBt^DHW';                              // SMTP password
            // $this->mail->SMTPSecure = 'ssl';                                // Enable TLS encryption, `ssl` also accepted
            // $this->mail->Port = 465;                                        // TCP port to connect to
             $this->load->library("email");
            //Recipients
            $this->mail->setFrom('ventas@cointic.com.mx', utf8_decode("Preveer PC"));
            $this->mail->addAddress($correoDestino, "COINTIC");             // Add a recipient // Name is optional

            $this->mail->AddStringAttachment($archivoPDF,'AcuseVisita'.date("Y-m-d h:i:s").'.pdf','base64');

            //Content
            $this->mail->isHTML(true);                                       // Set email format to HTML
            $this->mail->Subject = utf8_decode('Acuse de visita');
            $this->mail->Body   = utf8_decode($arrayCentroTrabajo[0]['nombre']);
            $this->mail->AltBody = 'Este es el cuerpo del texto sin formato para clientes de correo que no admiten formato HTML';

            $this->mail->send();

            print "Correo Enviado";

       }catch (Exception $e) {
           print $this->mail->ErrorInfo;
        }
    }
    public function enviarPDFProcedimiento($idAsignacion, $idCentroTrabajo)
    {
        $correoDestino = $this->input->post("correoAcuse");
        $this->load->model("ProcedimientoEvacuacion");
        $data['idAsignacion']=$idAsignacion;
        $data['tabla']=$this->ProcedimientoEvacuacion->getTabla($idAsignacion);
        $data['recomendaciones']=$this->ProcedimientoEvacuacion->getRecomendaciones($idAsignacion);
        $data['idCentroTrabajo']=$this->ProcedimientoEvacuacion->getIdCentroTrabajo($idAsignacion);
        $data['datosCentroTrabajo']=$this->ProcedimientoEvacuacion->getDatosCentroTrabajo($idAsignacion);
        $data['pdf'] = $this->pdf;
        $data['nombreusuario']= $this->visitasAcuses->nombreUsuarioVisita($this->session->userdata('idusuariobase'));
        $arrayCentroTrabajo = $this->centrosTrabajo->obtenerFichaPDF($idCentroTrabajo);
        $archivoPDF = $this->load->view('PDFProcedimiento', $data, true);

        try {
             $this->load->library("email");
            //Recipients
            $this->mail->setFrom('ventas@cointic.com.mx', utf8_decode("Preveer PC"));
            $this->mail->addAddress($correoDestino, "COINTIC");

            $this->mail->AddStringAttachment($archivoPDF,'ProcedimientoEvacuacion'.date("Y-m-d h:i:s").'.pdf','base64');

            $this->mail->isHTML(true);
            $this->mail->Subject = utf8_decode('Procedimiento de evacuación');
            $this->mail->Body   = utf8_decode($arrayCentroTrabajo[0]['nombre']);
            $this->mail->AltBody = 'Este es el cuerpo del texto sin formato para clientes de correo que no admiten formato HTML';

            $this->mail->send();

            print "Correo Enviado";

       }catch (Exception $e) {
           print $this->mail->ErrorInfo;
        }
    }

    public function enviarPDFCheck($idAsignacion, $idCentroTrabajo)
    {
        $data['datosCentroTrabajo']= $this->visitasAcuses->getDatosCentroTrabajo($idAsignacion);
        $correoDestino = $this->input->post("correoAcuse");
        $arrayCentroTrabajo = $this->centrosTrabajo->obtenerFichaPDF($idCentroTrabajo);

        for($i=1; $i<11; $i++)
        $data['instalacion'.$i]=$this->visitasAcuses->getInstalacion($i);
        $data['idAsignacion']=$idAsignacion;
        $data['doctosEdo'] = $this->visitasAcuses->getDoctosEstado($idAsignacion);
         $data['todoRespuesta']=$this->visitasAcuses->ResultadoCheck($idAsignacion);

        $arre=array();
         foreach ($data['todoRespuesta'] as $key) {
                $idDocumentos= $key['idDocumentos'];
                $arreglo=$this->visitasAcuses->ResultadoPonde($idDocumentos,$idAsignacion);
                $arreglo['nombreDocumento']=$key["nombreDocumento"];
                array_push($arre, $arreglo);
            }
            $data['tabla']=$arre;
        
        $data['pdf'] = $this->pdf;

        $archivoPDF = $this->load->view('PDFChecklist', $data, true);

        try {
            //$this->mail->SMTPDebug = 2;                                   // Enable verbose debug output
            // $this->mail->isSMTP();                                          // Set mailer to use SMTP
            // $this->mail->Host = 'ssl://mail.cointic.com.mx';                // Specify main and backup SMTP servers
            // $this->mail->SMTPAuth = true;                                   // Enable SMTP authentication
            // $this->mail->Username = 'prueba@cointic.com.mx';                // SMTP username
            // $this->mail->Password = '5ugk5DBt^DHW';                           // SMTP password
            // $this->mail->SMTPSecure = 'ssl';                                // Enable TLS encryption, `ssl` also accepted
            // $this->mail->Port = 465;                                        // TCP port to connect to

           
            $this->load->library("email");
            
           
            
            //Recipients
            $this->mail->setFrom('ventas@cointic.com.mx', utf8_decode("Preveer PC"));
            $this->mail->addAddress($correoDestino, "COINTIC");             // Add a recipient // Name is optional

            $this->mail->AddStringAttachment($archivoPDF,'CheckList'.date("Y-m-d h:i:s").'.pdf','base64');

            //Content
            $this->mail->isHTML(true);                                       // Set email format to HTML
            $this->mail->Subject = utf8_decode('Formato check');
            $this->mail->Body   = utf8_decode($arrayCentroTrabajo[0]['nombre']);
            $this->mail->AltBody = 'Este es el cuerpo del texto sin formato para clientes de correo que no admiten formato HTML';

            $this->mail->send();

            print "Correo Enviado";

        }catch (Exception $e) {
           print $this->mail->ErrorInfo;
        }
    }

     public function enviarPDFOM($idAsignacion, $idCentroTrabajo)
    {
        $idUsuario = $this->session->userdata('idusuariobase');
        $correoDestino = $this->input->post("correoAcuse");
        $arrayCentroTrabajo = $this->centrosTrabajo->obtenerFichaPDF($idCentroTrabajo);
        $idCorreo = $this->insertCorreoEnviado($idAsignacion, $idUsuario);

        $data['idAsignacion'] = $idAsignacion;
        $data['datosCentroTrabajo']=$this->visitasAcuses->getDatosCentroTrabajo($idAsignacion);
        $data['riesgo_acuse'] = $this->visitasAcuses->getRiesgoAcuse();
        $data['prioridad_mejora'] = $this->visitasAcuses->getPrioridadMejora();
        $formularios=$this->visitasAcuses->getFormularios();
        $i=0;
        foreach ($formularios as $formulario)
        {
            //obtiene el id del formulario con asignacion
            $formularioAsignacion=$this->visitasAcuses->getFormularioAsignacion($idAsignacion, $formulario['idControl']);
            //obtiene las observaciones de cada uno de los formularios
            $observacionesRestantes=$this->visitasAcuses->getObservaciones($formularioAsignacion[0]['idFormularioAsignacion']);
            foreach ($observacionesRestantes as $observacionRestante)
            {
                $arregloInsercionObservacion=array('idFormularioAsignacion' => $observacionRestante['idFormularioAsignacion'], 'idIndicador'=> $observacionRestante['idIndicador']);
                $this->visitasAcuses->insertarOMPC($arregloInsercionObservacion);
            }
            $datosOMPC[$i++]=$this->visitasAcuses->getOMPCPDF($formularioAsignacion[0]['idFormularioAsignacion']);

        }
        $data['OMPC']=$datosOMPC;
        $data['cantidadRegistros']=$i;
        $data['pdf'] = $this->pdf;
        $data['recomendacionesPE'] = $this->visitasAcuses->getRecomendacione($idAsignacion);
        $archivoPDF = $this->load->view('PDFOMPC', $data, true);

        try {
            $this->load->library("email");
           //Recipients
            $this->mail->setFrom('ventas@cointic.com.mx', utf8_decode("Preveer PC"));
            $this->mail->addAddress($correoDestino, "COINTIC");             // Add a recipient // Name is optional
            $this->mail->AddStringAttachment($archivoPDF,'Oportunidad Mejora'.date("Y-m-d h:i:s").'.pdf','base64');
            //Content
            $this->mail->isHTML(true);                                       // Set email format to HTML
            $this->mail->Subject = utf8_decode('Formato OM');
            $this->mail->Body   = utf8_decode($arrayCentroTrabajo[0]['nombre']);
            $this->mail->AltBody = 'Este es el cuerpo del texto sin formato para clientes de correo que no admiten formato HTML';

            $this->mail->send();

            print "Correo Enviado";

        }catch (Exception $e) {
           print $this->mail->ErrorInfo;
        }
    }

    function insertCorreoEnviado($idAsignacion, $quienEnvia)
    {
        $mail = $this->input->post("correoAcuse");
        return $this->visitasAcuses->insertCorreoEnviado(array(
            'Correo' => $mail,
            'idLogeo' => $quienEnvia,
            'idAsignacion' => $idAsignacion,
            'FechaEnvio' => date("Y-m-d")
        ));
    }

}

?>