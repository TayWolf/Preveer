<?php

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Preveer');
$pdf->SetTitle('Acta de verificación ocular');

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
$pdf->AddPage();
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
$html='<body>
                                                <div class="row">
                                                   <p>En '.$ciudadEst.' , siendo las '.$horaU.', del día '.$fechaU.'  , se reunieron los integrantes de la Comisión de Seguridad e Higiene en el interior de las instalaciones de la empresa '.$razonSocial.' con Registro Federal de Contribuyentes '.$rfcR.'  y Registro Patronal '.$registroPatronal.' , cuya actividad consiste en '.$descripcionEmpresa.' y cuenta con una plantilla de '.$nEmpleado.' trabajadores, con domicilio en '.$domicilioFiscal.'  Y '.$CPU.' a efecto de realizar el recorrido de verificación, conforme a lo dispuesto en los artículos 509, 510 y 540 de la Ley Federal del Trabajo; Artículo 45, I, II, III, IV, V, VI,VII,VII, IX, X del Reglamento Federal de Seguridad y Salud en el Trabajo,  la NOM-19-STPS-2011. </p>
                                                   <p style="text-align: center;"><strong>Puntos por revisar</strong></p>
                                                </div>
                                                
                                                    <table class="table">
                                                        <thead class="thead-dark">
                                                            <tr  style="background-color: rgb(166,166,166); color: #000;text-align: center" >
                                                                <th style="border: 1px solid black;" >No.</th>
                                                                <th style="border: 1px solid black;">Puntos por revisar</th>
                                                                <th style="border: 1px solid black;">Área</th>
                                                                <th style="border: 1px solid black;">PUNTOS DE LAS NOM’S</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                        $tU=1;
                                                        foreach ($contenidoTableU as $row) {
                                                            $puntosRevisar=$row["puntosRevisar"];
                                                            $AreaTu=$row["Area"];
                                                            $puntosNorm=$row["puntosNorm"];
                                                            $html .='
                                                            <tr>
                                                                <td style="border: 1px solid black; margin: 10px 10px; text-align: center">'.$tU.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$puntosRevisar.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$AreaTu.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$puntosNorm.'</td>
                                                            </tr>';
                                                            $tU++;
                                                        }
                                                         

                                            $html .= '</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

 $html = '
        <p>Cumpliendo con lo establecido en el reglamento de seguridad y salud en el trabajo, se realizó una inspección ocular dentro del centro de trabajo, para identificar la estructura del inmueble y realizar las recomendaciones pertinentes para reparar corregir estos puntos.</p>
        <p>En la siguiente tabla se muestran los detalles del recorrido realizado</p><br>
        ';

$pdf->writeHTML($html, true, false, true, false, '');


$html='
                                               
                                                    <table class="table">
                                                        <thead class="thead-dark">
                                                            <tr  style="background-color: rgb(166,166,166); color: #000;text-align: center" >
                                                                <th style="border: 1px solid black;" >No.</th>
                                                                <th style="border: 1px solid black;">Evidencia</th>
                                                                <th style="border: 1px solid black;">Condiciones inseguras detectadas</th>
                                                                <th style="border: 1px solid black;">Área</th>
                                                                <th style="border: 1px solid black;">Recomendaciones para prevenir las condiciones inseguras detectadas</th>
                                                                <th style="border: 1px solid black;">Nombre del resposable</th>
                                                                <th style="border: 1px solid black;">Fecha aviso compromiso</th>
                                                                <th style="border: 1px solid black;">Fecha de finalización</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                        $tUw=1;
                                                        foreach ($contenidoTableE as $rowE) {
                                                            $condicionesEv=$rowE["condicionesEv"];
                                                            $areaEvi=$rowE["areaEvi"];
                                                            $recomenEvi=$rowE["recomenEvi"];
                                                            $nombreEspEvi=$rowE["nombreEspEvi"];
                                                            $fechaAvisEvi=$rowE["fechaAvisEvi"];
                                                            $fechaFevi=$rowE["fechaFevi"];
                                                            $fotoEvidencia=$rowE["fotoEvidencia"];
                                                            $html .='
                                                            <tr>
                                                                <td style="border: 1px solid black; margin: 10px 10px; text-align: center">'.$tUw.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;"><img src="https://cointic.com.mx/preveer/sistema/assets/img/fotoEvidencia/'.$fotoEvidencia.'"  width="85px" height="95px"/></td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$condicionesEv.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$areaEvi.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$recomenEvi.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$nombreEspEvi.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$fechaAvisEvi.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$fechaFevi.'</td>
                                                            </tr>';
                                                            $tUw++;
                                                        }
                                                         

                                            $html .= '</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$html = '
        <p>Reporte de accidentes, incidentes o enfermedades de trabajo fija</p><br>
        ';

$pdf->writeHTML($html, true, false, true, false, '');
//Close and output PDF document

$html='
                                               
                                                    <table class="table">
                                                        <thead class="thead-dark">
                                                            <tr  style="background-color: rgb(166,166,166); color: #000;text-align: center" >
                                                                <th style="border: 1px solid black;" >Tipo de incapacidad</th>
                                                                <th style="border: 1px solid black;">No.</th>
                                                                <th style="border: 1px solid black;">Área</th>
                                                                <th style="border: 1px solid black;">Fecha y Hora</th>
                                                                <th style="border: 1px solid black;">Acto inseguro</th>
                                                                <th style="border: 1px solid black;">Condición peligrosa</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                        
                                                        foreach ($contenidoTableI as $rowI) {
                                                            $TipoInca=$rowI["TipoInca"];
                                                            $noInc=$rowI["noInc"];
                                                            $areaInca=$rowI["areaInca"];
                                                            $FechaHora=$rowI["FechaHora"];
                                                            $actoInca=$rowI["actoInca"];
                                                            $condicionesPeli=$rowI["condicionesPeli"];
                                                            
                                                            $html .='
                                                            <tr>
                                                                
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$TipoInca.'</td>

                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$noInc.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$areaInca.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$FechaHora.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$actoInca.'</td>
                                                               <td style="border: 1px solid black; margin: 10px 10px;">'.$condicionesPeli.'</td>
                                                               
                                                            </tr>';
                                                            
                                                        }
                                                         

                                            $html .= '</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$html = '
        <p>No existiendo otro asunto que tratar, se dio por terminada la presente, siendo las '.$horaDos.' horas del '.$fechaDos.', Firmando de conformidad al calce y margen los que en ella intervinieron.

</p><br>
        ';
$pdf->writeHTML($html, true, false, true, false, '');

$html = '<div class="row">
            <div class="col-md-6" align="center" >
                <div class="form-group" >
                    <div class="form-line" >
                        _______________________________________
                    </div> 
                       '.$reprePatronCor.'<br>
                    Representante del Patrón (Coordinadora)
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group" align="center" >
                    <div class="form-line" >
                       _____________________________________________
                    </div>  
                    '.$reprePatroSecrer.' <br> 
                    Representante de los trabajadores (Secretario)
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" align="center" >
                <div class="form-group" >
                    <div class="form-line" >
                        _______________________________________
                    </div> 
                       '.$reprePatronVocal.'<br>
                    Representante del Patrón (Vocal)
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group" align="center" >
                    <div class="form-line" >
                       _____________________________________________
                    </div>  
                    '.$repreTrabaVocal.' <br> 
                    Representante de los trabajadores (Vocal)
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" align="center" >
                <div class="form-group" >
                    <div class="form-line" >
                        _______________________________________
                    </div> 
                       '.$reprePatronVocalDos.'<br>
                    Representante del Patrón (Vocal
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group" align="center" >
                    <div class="form-line" >
                       _____________________________________________
                    </div>  
                    '.$RepreTrabaVocalDos.' <br> 
                    Representante de los trabajadores (Vocal)
                </div>
            </div>
        </div></body>';
    
   

$pdf->writeHTML($html, true, false, true, false, '');

$pdf->Output('acta-Verificacion.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>