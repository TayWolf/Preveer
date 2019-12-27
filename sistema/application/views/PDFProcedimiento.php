<?php

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Preveer');
$pdf->SetTitle('Procedimiento de evacuación');

$PDF_HEADER_LOGO="logo-preveer.png";

// set header data
$pdf->SetHeaderData($PDF_HEADER_LOGO, "50px", '', '');

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
    require_once(dirname(__FILE__).'/lang/spa.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage('L', 'A4');

$html=  '
<h4>Procedimiento de evacuación</h4>
<table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
              <th colspan="2" style="text-align: center; border: 1px solid black; margin: 10px 10px;"><b>Datos del centro de trabajo</b></th>
              </tr>
            </thead>
            <tbody>';

$html .= '  <tr nobr="true" >
            <td colspan="2" style="border: 1px solid black; margin: 5px 5px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;<b>Cliente: </b>'.$datosCentroTrabajo['nombreFormato'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Razón social:</b> '.$datosCentroTrabajo['razonSocial'].'<br>&nbsp;&nbsp;&nbsp;<b> Nombre del centro de trabajo: </b>'.$datosCentroTrabajo['nombreSucursal'].'</td>
            </tr>
            <tr nobr="true" >
            <td colspan="2" style="border: 1px solid black; margin: 1px 1px;text-align: left;">&nbsp;&nbsp;&nbsp; <b>Dirección</b><br>&nbsp;&nbsp;&nbsp;<b> Estado: </b>'.$datosCentroTrabajo['nombreEstado'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Municipio/Delegacion: </b>'.$datosCentroTrabajo['nombreMunicipio'].'<br>&nbsp;&nbsp;&nbsp;<b> Colonia: </b>'.$datosCentroTrabajo['nombreRegion'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Código Postal: </b>'.$datosCentroTrabajo['codigoPostal'].'<br>&nbsp;&nbsp;&nbsp;<b> Calle: </b>'.$datosCentroTrabajo['calle'].'&nbsp;&nbsp;&nbsp;&nbsp; <b>No. Exterior: </b>'.$datosCentroTrabajo['numexterior'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> No. Interior:</b> '.$datosCentroTrabajo['numinterior'].'</td>
            </tr>
            <tr nobr="true" >
            <td colspan="2" style="border: 1px solid black; margin: 1px 1px;text-align: left;">&nbsp;&nbsp;&nbsp; <b>Contacto</b><br>&nbsp;&nbsp;&nbsp;<b> Teléfono de inmueble:</b> '.$datosCentroTrabajo['telefonoInmueble'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Correo del inmueble:</b> '.$datosCentroTrabajo['correoInmueble'].'</td>
            </tr>';

$html .= "</tbody></table>";

$pdf->writeHTML($html, true, false, true, false, '');

//genera la tabla
$html="<table>
            <thead>
            <tr nobr=\"true\"  style=\"background-color: #b82027; color: #fff; text-align: center\">
                <th style=\" width:5% \">#</th>
                <th style=\" width:20%\">Paso</th>
                <th style=\" width:20%\">Proceso</th>
                <th style=\" width:25%\">Equipo y material actual</th>
                <th style=\" width:30%\">Procedimiento de brigadistas / Responsable de la actividad</th>
            </tr>
            </thead>
            <tbody>";
$contador=1;
foreach ($tabla as $dato)
{
    $html.="
            <tr nobr=\"true\"  style='border: 1px solid black;'>
                <td style=\" width:5%; border:  .1px solid black; text-align: center; \">".$contador++."</td>
                <td style=\" width:20%; border: .1px solid black; text-align: center; \">".$dato['paso']."</td>
                <td style=\" width:20%; border: .1px solid black; text-align: center; \">".$dato['proceso']."</td>
                <td style=\" width:25%; border: .1px solid black; \">".$dato['valorEquipo']."</td> 
                <td style=\" width:30%; border: .1px solid black; \">".$dato['valorProcedimiento']."</td>
            </tr>";
}

$html.="    </tbody>
        </table>";

$pdf->writeHTML($html, true, false, true, false, '');
//fin de generación de la tabla
//inicio de la generacion de las recomendaciones
$html="
<table>
    <thead>
        <tr nobr=\"true\" ><th><b>Recomendaciones</b></th></tr>
    </thead>
    <tbody>
        <tr nobr=\"true\" >
            <td>".$recomendaciones."</td>
        </tr>
    </tbody>
</table>";
$pdf->writeHTML($html, true, false, true, false, '');

//fin de generación de las recomendaciones





$html = '   <table>
            <br><br>
            <tbody>';
$html .= '<tr nobr="true" >
            <br><br>
            <td style=" margin: 40px 10px; text-align: center;">'.$nombreusuario.'</td>
            <td style=" margin: 40px 10px; border-left:30px solid white; text-align: center;">'.$datosCentroTrabajo["nombreAtendioVisita"].'</td>
          </tr>';
$html .= '<tr nobr="true" >
            <td style="border-top: 1px solid black; margin: 1px 1px;text-align: center;">Nombre y firma de quien realizó la visita</td>
            <td style="border-top: 1px solid black; border-left:30px solid white; margin: 1px 1px;text-align: center;">Nombre y firma de quien atendió la visita</td>
          </tr>';

$html .= "</tbody></table>"; 
$pdf->writeHTML($html, true, false, true, false, '');
//Close and output PDF document
$pdf->Output('ProcedimientoEvacuacion.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>