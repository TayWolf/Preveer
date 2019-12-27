<?php

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Preveer');
$pdf->SetTitle('Acuse de visita');

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
$html=  '<table>
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

$html="<style>

    table.tabla {
        border: 1px solid #000000;
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
    }
    th {
        border: 1px solid #000000;
    }
    td{
        border: 1px solid #000000; 
        text-align: center;
    }
    .res{
        text-align: left !important;
    }
</style>";
$html .= '<h4>Control documental ';
                            foreach ($doctosEdo as $row)
                            {
                                $estado=$row['nombreEstado'];
                                $html .=$estado;
                                break;
                            }
$html .= '</h4>
         <table class="tabla">
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Documento</th>
                <th>PT</th>
                <th>Comentarios / Observaciones</th>
              </tr>
            </thead>
            <tbody>';
$contador=0;
                                foreach ($tabla as $row) {
                                    $nombreDocumento=$row["nombreDocumento"];
                                    if(strlen($nombreDocumento)>128)
                                    {
                                        $nombreDocumento=substr($nombreDocumento, 0, 128)."...";
                                    }

                                    if(!isset($row['nombrePonderador']))
                                        $row['nombrePonderador']="";
                                    if(!isset($row['comentario']))
                                        $row['comentario']="";
                                    if(!isset($nombreDocumento))
                                        $nombreDocumento="";
                                    $html .= "
                                            <tr nobr=\"true\" >
                                                <td class='res' style='padding-bottom: 0px;order: 1px solid black; margin: 10px 10px;'>$nombreDocumento</td>
                                               <td align='center'  style='padding-bottom: 0px;'>".$row['nombrePonderador']." </td>
                                                 <td align='justify'  style='padding-bottom: 0px; '> ".$row['comentario']."</td>
                                            </tr>";                                            
                                    $contador++;
                                }



$html .= "</tbody></table>";


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('AcuseVisita.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>
