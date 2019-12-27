<?php

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Preveer');
$pdf->SetTitle('OMPC');

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

$html = '<h4 align="center">OPORTUNIDADES DE MEJORA</h4>';
$pdf->writeHTML($html, true, false, true, false, '');
$html=  '<table>
            <thead>
              <tr style="background-color: #b82027; color: #fff; text-align: center">
              <th colspan="2" style="text-align: center; border: 1px solid black; margin: 10px 10px;"><b>Datos del centro de trabajo</b></th>
              </tr>
            </thead>
            <tbody>';

$html .= '  <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: left;">Cliente: '.$datosCentroTrabajo['nombreFormato'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Razón social</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['razonSocial'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Número de sucursal</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['numeroSucursal'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Nombre de la sucursal</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['nombreSucursal'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">A.E.P.*</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['aep'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Nombre de quien atendió la visita</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['nombreAtendioVisita'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Nombre de quien realizó la visita</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['nombreRealizo'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Número de visita</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['numeroVisita'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Estado </td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['nombreEstado'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Municipio ó Delegacion</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['nombreMunicipio'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Colonia</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['nombreRegion'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Código Postal</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['codigoPostal'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Calle</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['calle'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">No. Exterior</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['numexterior'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">No. Interior</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['numinterior'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Nombre de Contacto</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['nomContacto'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Puesto de Contacto</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['puestoContacto'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Teléfono de Contacto</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['telContacto'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Correo de Contacto</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['email'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Teléfono de inmueble</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['telefonoInmueble'].'</td>
            </tr>
            <tr>
            <td style="border: 1px solid black; margin: 1px 1px;text-align: center;">Correo del inmueble</td>
            <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$datosCentroTrabajo['correoInmueble'].'</td>
            </tr>';

$html .= "</tbody></table>";

$pdf->writeHTML($html, true, false, true, false, '');


$html = '
        <br>
        <br>
        
        <table>
        <thead>
        <tr style="background-color: #b82027; color: #fff; text-align: center">
            <th style="border: 1px solid black; padding: 0px; margin: 0px">#</th>
            <th style="border: 1px solid black;">Área/Sección</th>
            <th style="border: 1px solid black;">Riesgo</th>
            <th style="border: 1px solid black;">Oportunidad de mejoramiento</th>
            <th style="border: 1px solid black;">Recomendación</th>
            <th style="border: 1px solid black;">Fundamento legal</th>
            <th style="border: 1px solid black;">Est.</th>
            <th style="border: 1px solid black;">Prioridad de Mejora.</th>
            <th style="border: 1px solid black;">Evidencia fotográfica.</th>
        </tr>
        </thead>
        <tbody>';

$count = 1;
$x = 0;

foreach ($OMPC as $item)
{
    foreach ($item as $val)
    {
        if(empty($val))
            continue;

        $formularioAsignacion=$val['idFormularioAsignacion'];
        $idIndicador=$val['idIndicador'];
        $area_seccion=$val['nombreFormulario'];
        $idOMPC = $val['idOMPC'];
        $fundamentoLegal = $val['fundamentoLegal'];
        $colorEstatus="#FFFFFF";
        $value = $val['valor'];
        $foto= (empty($val['foto']))?"": "<img src=\"". base_url('assets/img/fotoAnalisisRiesgo/'.$formularioAsignacion.$val['foto'])."\"/>";
        $estatus='';

        $oportunidadMejoramiento = $val['oportunidadMejoramiento'];
        $nombreMejora = empty($val['nombrePM']) ? "Seleccione una opción..." : $val['nombrePM'];
        $nombreRiesgo = empty($val['nombreRiesgo']) ? "Seleccione una opción..." : $val['nombreRiesgo'];
        if($val['estatus'] != '')
        {
            $estatus = ($val["estatus"] == 1) ? 0 : 1;
            $colorEstatus = ($estatus == 0) ? "#f44336" : "#8bc34a";
        }
        $colorPM = $val['colorPM'];
         $html.="
            <tr>
            <td style=\"border: 1px solid black; text-align: center\">$count</td>
            <td style=\"border: 1px solid black; text-align: center\">$area_seccion</td>
            <td style=\"border: 1px solid black; text-align: center\">$nombreRiesgo</td>
            <td style=\"border: 1px solid black; text-align: center\">$oportunidadMejoramiento</td>
            <td style=\"border: 1px solid black; text-align: center\">$value</td>
            <td style=\"border: 1px solid black; text-align: center\">$fundamentoLegal</td>
            <td style=\"border: 1px solid black; text-align: center; background-color: $colorEstatus\">$estatus</td>
            <td style=\"border: 1px solid black; text-align: center; background-color: $colorPM\">$nombreMejora</td>
            <td style=\"border: 1px solid black; margin-bottom: 0px !important; padding: 0px !important;\">$foto</td>
            </tr>";


        $count++;

    }
}
$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('OMPC.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>