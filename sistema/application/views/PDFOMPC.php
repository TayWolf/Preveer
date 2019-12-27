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
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
              <th colspan="2" style="text-align: center; border: 1px solid black; margin: 10px 10px;"><b>Datos del centro de trabajo</b></th>
              </tr>
            </thead>
            <tbody>';

$html .= '  <tr nobr="true" >
            <td colspan="2" style="border: 1px solid black; margin: 5px 5px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;<b>Cliente: </b>'.$datosCentroTrabajo['nombreFormato'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Razón social:</b> '.$datosCentroTrabajo['razonSocial'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Número de sucursal: </b>'.$datosCentroTrabajo['numeroSucursal'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Nombre de la sucursal: </b>'.$datosCentroTrabajo['nombreSucursal'].'</td>
            </tr>
            <tr nobr="true" >
            <td colspan="2" style="border: 1px solid black; margin: 1px 1px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;<b>A.E.P.*: </b>'.$datosCentroTrabajo['aep'].'&nbsp;&nbsp;&nbsp;&nbsp; <b>Número de visita: </b>'.$datosCentroTrabajo['numeroVisita'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Atendió visita: </b>'.$datosCentroTrabajo['nombreAtendioVisita'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Realizó visita:</b> '.$datosCentroTrabajo['nombreRealizo'].'</td>
            </tr>
            <tr nobr="true" >
            <td colspan="2" style="border: 1px solid black; margin: 1px 1px;text-align: left;">&nbsp;&nbsp;&nbsp; <b>Dirección</b><br>&nbsp;&nbsp;&nbsp;<b> Estado: </b>'.$datosCentroTrabajo['nombreEstado'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Municipio/Delegacion: </b>'.$datosCentroTrabajo['nombreMunicipio'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Colonia: </b>'.$datosCentroTrabajo['nombreRegion'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Código Postal: </b>'.$datosCentroTrabajo['codigoPostal'].'<br>&nbsp;&nbsp;&nbsp;<b> Calle: </b>'.$datosCentroTrabajo['calle'].'&nbsp;&nbsp;&nbsp;&nbsp; <b>No. Exterior: </b>'.$datosCentroTrabajo['numexterior'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> No. Interior:</b> '.$datosCentroTrabajo['numinterior'].'</td>
            </tr>
            <tr nobr="true" >
            <td colspan="2" style="border: 1px solid black; margin: 1px 1px;text-align: left;">&nbsp;&nbsp;&nbsp; <b>Contacto</b><br>&nbsp;&nbsp;&nbsp;<b> Nombre:</b> '.$datosCentroTrabajo['nomContacto'].'&nbsp;&nbsp;&nbsp;&nbsp; <b>Puesto: </b>'.$datosCentroTrabajo['puestoContacto'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Teléfono:</b> '.$datosCentroTrabajo['telContacto'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Correo:</b> '.$datosCentroTrabajo['email'].'</td>
            </tr>
            <tr nobr="true" >
            <td colspan="2" style="border: 1px solid black; margin: 1px 1px;text-align: left;">&nbsp;&nbsp;&nbsp;<b> Teléfono de inmueble:</b> '.$datosCentroTrabajo['telefonoInmueble'].'&nbsp;&nbsp;&nbsp;&nbsp;<b> Correo del inmueble:</b> '.$datosCentroTrabajo['correoInmueble'].'</td>
            </tr>';

$html .= "</tbody></table>";

$pdf->writeHTML($html, true, false, true, false, '');


$html = '
        <br>
        <br>
        
        <table>
        <thead>
        <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
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
            <tr nobr=\"true\" >
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

$html = '
        <br>
        <br>
        
        <table>
        <thead>
        <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
            <th style="border: 1px solid black; padding: 0px; margin: 0px">Recomendaciones de procedimiendo de evacuación</th>
            
        </tr>
        </thead>
        <tbody>';
        $recomendacion="";
       foreach ($recomendacionesPE as $vall)
        {
            $recomendacion=$vall["recomendaciones"];
        }

         $html.="
            <tr nobr=\"true\" >
            <td style=\"border: 1px solid black; text-align: center\">$recomendacion</td>
           
            </tr>";



$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('OMPC.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>