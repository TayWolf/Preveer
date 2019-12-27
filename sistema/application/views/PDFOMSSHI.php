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
$pdf->SetFont('dejavusans', '', 9);

// add a page
$pdf->AddPage('L', 'A4');


$html = '<h4>OPORTUNIDAD DE MEJORA</h4>

        <table>
            <thead>
            <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th style="border: 1px solid black;">CRITERIOS</th>
                <th style="border: 1px solid black;">RIESGO</th>
                <th style="border: 1px solid black;">PERIODO DE CORRECCIÓN</th>
                <th style="border: 1px solid black;">PRIORIDAD DE INTERVENCIÓN</th>
            </tr>
            </thead>
            <tbody>
            <tr nobr="true" >
                <td style="border: 1px solid black; text-align: center">NO SE REQUIERE ACCIÓN ESPECIFICA, SE PUEDE GENERAR A TRAVÉS DE UN CALENDARIO DE MANTENIMIENTO CORRECTIVO Y PREVENTIVO REALIZANDO COMPROBACIONES PERIÓDICAS A ASEGURAR QUE SE MANTIENE LA EFICACIA DE LAS MEDIDAS DE CONTROL CON LAS QUE SE CUENTAN ACTUALMENTE.</td>
                <td style="border: 1px solid black; text-align: center">TOLERABLE (TO)</td>
                <td style="border: 1px solid black; text-align: center background-color: #ffeb3b;">16-30 Días</td>
                <td style="border: 1px solid black; text-align: center; background-color: #8bc34a;">MEDIANO PLAZO</td>
            </tr> 
            <tr nobr="true" >  
                <td style="border: 1px solid black; text-align: center">ACTIVIDAD IMPORTANTE PARA CUMPLIMIENTO NORMATIVO, DEBEN TOMARSE MEDIDAS PARA REDUCIR EL RIESGO, DEBEN IMPLANTARSE EN UN PERIODO DETERMINADO, NO DEBE COMENZARSE LA TAREA HASTA QUE SE HAYAN APLICADO MEDIDAS PARA REDUCIR LAS POSIBILIDADES O LAS CONSECUENCIAS DEL RIESGO.</td>
                <td style="border: 1px solid black; text-align: center">IMPORTANTE (I)</td>
                <td style="border: 1px solid black; text-align: center; background-color: #ffeb3b;">6-15 Días</td>
                <td style="border: 1px solid black; text-align: center; background-color: #ffeb3b;">CORTO PLAZO </td>
            </tr>
            <tr nobr="true" > 
                <td style="border: 1px solid black; text-align: center">NO DEBE COMENZAR, NI CONTINUAR EL TRABAJO. SI NO ES POSIBLE REDUCIR EL RIESGO, DEBE PROHIBIRSE LA TAREA. SE REQUIERE EVIDENCIA FOTOGRÁFICA DE LA MEJORA REALIZADA.</td>
                <td style="border: 1px solid black; text-align: center">INTOLERABLE (IN)</td>
                <td style="border: 1px solid black; text-align: center; background-color: #ffeb3b;">0 Días </td>
                <td style="border: 1px solid black; text-align: center; background-color: #f44336;">INMEDIATO</td>
            </tr>
            </tbody>
        </table>

        <br>
        <br>
        <br>
        
        <table>
        <thead>
        <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
            <th style="padding: 0px; margin: 0px">#</th>
            <th>Área/Sección</th>
            <th>Fa. Riesgo</th>
            <th>Foto que genera la OP.</th>
            <th>Oportunidad de mejoramiento</th>
            <th>Prioridad intervención</th>
            <th>Recomendación</th>
            <th>Responsable</th>
            <th>F. ejecución</th>
            <th>F. verificación</th>
            <th>Foto correción OM</th>
            <th>Seguimiento </th>
        </tr>
        </thead>
        <tbody>';
        $count=1;
foreach ($DatosGrales as $row) {
    
    $factorRiesgo=$row['factorRiesgo'];
    $fotoMal0=$row['fotoMal0'];
    $fotoMal1=$row['fotoMal1'];
    $oportunidadMejora=$row['oportunidadMejora'];
    $recomendacion=$row['recomendacion'];
    $responsable=$row['responsable'];
    $fechaEjecucion=$row['fechaEjecucion'];
    $fechaVerificacion=$row['fechaVerificacion'];
    $fotoCorrecionC=$row['fotoCorreccion0'];
    $fotoCorrecion1=$row['fotoCorreccion1'];
    $seguimiento=$row['seguimiento'];
    $nombreP=$row['nombre'];
    $areaNombre=$row['descripcion'];
    $colorStyle=$row['color'];

    $idPrioridadIntervencion=$row['idPrioridadIntervencion'];
    

    // if ($fotoMal0!="" && $fotoMal1!="") {
    //     $fotU="<td><img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/fotoMal0//a284977a7f30c8bee56ad9bbae0d1330.jpg' alt='Smiley face' height='42px' width='42px'>
    //     <img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/fotoMal0//a284977a7f30c8bee56ad9bbae0d1330.jpg'  height='42px' width='42px'></td>";
    // }else if ($fotoMal0!="" || $fotoMal1!="") {
    //    $fotU="<td><img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/fotoMal0//a284977a7f30c8bee56ad9bbae0d1330.jpg' height='42px' width='42px'></td>";
    // }else{
    //     $fotU="<td>s</td>";
    // }
    // $fotU="<td style='border: 1px solid black; margin: 10px 10px;'><img src='https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/fotoMal0//a284977a7f30c8bee56ad9bbae0d1330.jpg' />
    //     </td>";
     
           $fotU='<td style="border: 1px solid black; margin: 10px 10px;"><img src="https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/fotoMal0/'.$fotoMal0.'"  width="75px" height="85px"/></td>';

            $fotD='<td style="border: 1px solid black; margin: 10px 10px;"><img src="https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/fotoCorreccion0/'.$fotoCorrecionC.'"  width="75px" height="85px"/></td>';
    

    $html    .= '<tr nobr="true" >
                    <td style="border: 1px solid black; text-align: center;">'.$count.'</td>
                    <td style="border: 1px solid black; text-align: center;">'.$areaNombre.'</td>
                    <td style="border: 1px solid black; text-align: center;">'.$factorRiesgo.'</td>
                   
                    <td style="border: 1px solid black; margin: 10px 10px;"><img src="https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/fotoMal0/'.$fotoMal0.'"  width="75px" height="85px"/></td>
                    <td style="border: 1px solid black; text-align: center;">'.$oportunidadMejora.'</td>
                    <td style="border: 1px solid black; text-align: center;background-color:'.$colorStyle.'">'.$nombreP.'</td>
                    <td style="border: 1px solid black; margin: 10px 10px;">'.$recomendacion.'</td>
                    <td style="border: 1px solid black; margin: 10px 10px;">'.$responsable.'</td>
                    <td style="border: 1px solid black; text-align: center;">'.$fechaEjecucion.'</td>
                    <td style="border: 1px solid black; text-align: center;">'.$fechaVerificacion.'</td>
                    <td style="border: 1px solid black; margin: 10px 10px;"><img src="https://cointic.com.mx/preveer/sistema/assets/img/fotoOMSSH/fotoCorreccion0/'.$fotoCorrecionC.'"  width="75px" height="85px"/></td>
                    <td style="border: 1px solid black; text-align: center;">'.$seguimiento.'</td>
                    
                 </tr>';
                 $count++;
}

$html .= '</tbody></table>

            <br>
            <br>

            <table>
                <thead>
                <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                    <th style="border: 1px solid black;">No. TOTAL DE OPORTUNIDADES DE MEJORA ENCONTRADAS</th>
                    <th style="border: 1px solid black;">No. TOTAL DE SOLUCIONES IMPLEMENTADAS</th>
                    <th style="border: 1px solid black;">% DE OPORTUNIDADES DE MEJORA SOLUCIONADAS</th>
                </tr>
                </thead>
                <tbody>
                <tr nobr="true" >
                    <td style="border: 1px solid black; text-align: center">'.$totalOportunidades.'</td>
                    <td style="border: 1px solid black; text-align: center">'.$totalSoluciones.'</td>
                    <td style="border: 1px solid black; text-align: center">'.($totalSoluciones*100)/$totalOportunidades.'</td>
                </tr>
                </tbody>
            </table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('omSSHI.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>