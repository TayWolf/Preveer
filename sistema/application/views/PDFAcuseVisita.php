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

$html=  '
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


$html="<h4 align=\"center\">ACUSE DE VISITA DE INSPECCIÓN. NÚMERO DE INSPECCIÓN $numeroInspeccion</h4>";
$pdf->writeHTML($html, true, false, true, false, '');

$html = '<h4>Instalaciones eléctricas</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';



foreach($instalacion1 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            if($rowAc['idPonderador'] == 1){
                $ponderador = "Si";
            }else if($rowAc['idPonderador'] == 2){
                $ponderador = "No";
            }
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}

$html .= "</tbody></table>";


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$html = '<h4>Riesgos estructurales</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion2 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            if($rowAc['idPonderador'] == 1){
                $ponderador = "Si";
            }else if($rowAc['idPonderador'] == 2){
                $ponderador = "No";
            }
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}

$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$html = '<h4>Instalaciones de gas</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion3 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            if($rowAc['idPonderador'] == 1){
                $ponderador = "Si";
            }else if($rowAc['idPonderador'] == 2){
                $ponderador = "No";
            }
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}

$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$html = '<h4>Instalaciones Hidrosanitarias</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion4 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            if($rowAc['idPonderador'] == 1){
                $ponderador = "Si";
            }else if($rowAc['idPonderador'] == 2){
                $ponderador = "No";
            }
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}

$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// add a page

$html = '<h4>Contenido del botiquín</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
                <th>Cantidad</th>
              </tr>
            </thead>
            <tbody>';

for($i=0; $i<sizeof($instalacion5);$i++)
{
    $seEncuentra=0;
    foreach ($conteBotiquin as $contenido)
    {
        if(trim($contenido["nombreIndicador"])==trim($instalacion5[$i]["nombreIndicador"]))
        {
            $seEncuentra=1;
            break;
        }
    }
    if($seEncuentra==0)
        array_push($conteBotiquin, array('idIndicador'=>$instalacion5[$i]['idIndicador'], 'nombreIndicador' => $instalacion5[$i]['nombreIndicador'], 'tipoIndicador' => 3, 'idAcordeon' => 18, 'valor' => ""));

}


for($i=0; $i<sizeof($instalacion6);$i++)
{
    $seEncuentra=0;
    foreach ($conteBotiquin as $contenido)
    {
        if(trim($contenido["nombreIndicador"])==trim($instalacion6[$i]["nombreIndicador"]))
        {
            $seEncuentra=1;
            break;
        }
    }
    if($seEncuentra==0)
    {
        array_push($conteBotiquin, array('idIndicador'=>$instalacion6[$i]['idIndicador'],
            'nombreIndicador' => $instalacion6[$i]['nombreIndicador'],
            'tipoIndicador' => 3,
            'idAcordeon' => 18,
            'valor' => ""
        ));
    }
}


foreach($conteBotiquin as $row)
{


    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">' . $row["nombreIndicador"] . '</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">' . (($row["valor"])?"Si":"No") . '</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">' . $row["valor"] . '</td>
              </tr>';
}

$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$html = '<h4>Revisión por elementos no estructurales</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion7 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            if($rowAc['idPonderador'] == 1){
                $ponderador = "Si";
            }else if($rowAc['idPonderador'] == 2){
                $ponderador = "No";
            }
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}

$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$html = '<h4>Revisión por elementos no estructurales 2</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion11 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            if($rowAc['idPonderador'] == 1){
                $ponderador = "Si";
            }else if($rowAc['idPonderador'] == 2){
                $ponderador = "No";
            }
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}

$html .= "</tbody></table>";


// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$html = '<h4>Riesgo por deficiencia en los equipos de emergencia y las condiciones de seguridad...</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion8 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            if($rowAc['idPonderador'] == 1){
                $ponderador = "Si";
            }else if($rowAc['idPonderador'] == 2){
                $ponderador = "No";
            }
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}

$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$html = '<h4>Identificación de riesgos externos</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Distancia</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion9 as $rowIn)
{
    $distancia = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            $distancia = $rowAc['distancia'];
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$distancia.'</td>
              </tr>';
}

$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$html = '<h4>Datos adicionales</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion10 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            if($rowAc['idPonderador'] == 1){
                $ponderador = "Si";
            }else if($rowAc['idPonderador'] == 2){
                $ponderador = "No";
            }
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}

$html .= "</tbody></table>";

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$html = '<h4>Otros</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion13 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            $ponderador=$rowAc['texto'];
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}
$html .= "</tbody></table>";
$pdf->writeHTML($html, true, false, true, false, '');

$html = '<h4>Encuesta de satisfacción</h4>
         <table>
            <thead>
              <tr nobr="true"  style="background-color: #b82027; color: #fff; text-align: center">
                <th>Descripción</th>
                <th>Ponderador</th>
              </tr>
            </thead>
            <tbody>';


foreach($instalacion12 as $rowIn)
{
    $ponderador = "";
    foreach ($acuses as $rowAc)
    {
        if($rowAc['idIndicador'] == $rowIn['idIndicador'])
        {
            $ponderador=$rowAc['texto'];
        }
    }
    $html .= '<tr nobr="true" >
                <td style="border: 1px solid black; margin: 10px 10px;">'.$rowIn["nombreIndicador"].'</td>
                <td style="text-align: center; border: 1px solid black; margin: 10px 10px;">'.$ponderador.'</td>
              </tr>';
}

$html .= "</tbody></table>";
$pdf->writeHTML($html, true, false, true, false, '');


$html = "
<style>
.center{
  width: 216mm;
  
}
</style>
<div style=\"width: 216mm; border: 1px solid black \">";
if(!empty($foto["nombreFoto"]))
    $html.="<img src=\"".base_url('assets/img/fotoAnalisisRiesgo/fotosAcuseVisita/'.$foto['nombreFoto'])."\" class=\"center\" align=\"middle\"/>";
else
    $html.="<p align=\"center\">Sin evidencia fotográfica</p>";
$html.="</div>";

$pdf->writeHTML($html, true, false, true, false, '');

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
$pdf->Output('AcuseVisita.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>