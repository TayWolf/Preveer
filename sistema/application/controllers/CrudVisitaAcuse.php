<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CrudVisitaAcuse extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("visitasAcuses");
        $this->load->library("user_agent");

    }

    function verificarMovil()
    {
        return $this->agent->is_mobile();
    }

    function getAllFotos($idFormularioAsignacion)
    {
        echo json_encode($this->visitasAcuses->getAllFotos($idFormularioAsignacion));
    }

    function establecerFoto($idOMPC, $idFormularioFoto)
    {
        $this->visitasAcuses->establecerFoto($idOMPC, array('idFormularioFoto' => $idFormularioFoto));
    }

    public function oportunidadMejora($idAsignacion)
    {
        $data['formato'] = $this->visitasAcuses->getAllFormatos();
        $data['datosCentroTrabajo'] = $this->visitasAcuses->getDatosCentroTrabajo($idAsignacion);
        $data['nombreCentroTrabajo']=$this->visitasAcuses->getNombreCentroTrabajo($idAsignacion);
        $data['idAsignacion'] = $idAsignacion;
        $data['riesgo_acuse'] = $this->visitasAcuses->getRiesgoAcuse();
        $data['prioridad_mejora'] = $this->visitasAcuses->getPrioridadMejora();
        $formularios = $this->visitasAcuses->getFormularios();
        $i = 0;
        foreach ($formularios as $formulario) {

            //obtiene el id del formulario con asignacion
            $formularioAsignacion = $this->visitasAcuses->getFormularioAsignacion($idAsignacion, $formulario['idControl']);
            //obtiene las observaciones de cada uno de los formularios
            $observacionesRestantes = $this->visitasAcuses->getObservaciones($formularioAsignacion[0]['idFormularioAsignacion']);
            foreach ($observacionesRestantes as $observacionRestante) {
                $arregloInsercionObservacion = array('idFormularioAsignacion' => $observacionRestante['idFormularioAsignacion'], 'idIndicador' => $observacionRestante['idIndicador'], 'idAcordeon' => $observacionRestante['idAcordeon'], 'visual' => 1);
                $this->visitasAcuses->insertarOMPC($arregloInsercionObservacion);
            }
            $datosOMPC[$i++] = $this->visitasAcuses->getOMPC($formularioAsignacion[0]['idFormularioAsignacion']);
        }
        $data['OMPC'] = $datosOMPC;
        $data['cantidadRegistros'] = $i;
        $data['recomendacionesPE'] = $this->visitasAcuses->getRecomendacione($idAsignacion);
        $data['historicoOMPC'] = $this->visitasAcuses->getFechasHistoricoOMPC($idAsignacion);
        $data['desdeMovil']=$this->verificarMovil();
        if ($this->verificarMovil()) {
            $this->load->view('headerMovil');
            $this->load->view('gridOportunidadMejora', $data);
            $this->load->view('footerMovil');
        } else {
            $this->load->view('header');
            $this->load->view('gridOportunidadMejora', $data);
            $this->load->view('footer');
        }
    }

    function cambiarNombreAtendioVisita($idAsignacion)

    {

        $nuevoNombre = $this->input->post('nombreAtendio');

        $this->visitasAcuses->setNombreAtendioVisita($idAsignacion, array('nombreAtendioVisita' => $nuevoNombre));

    }

    function registrarHistoricoOportunidadMejora($idAsignacion)
    {
        $this->visitasAcuses->insertarHistoricoOportunidadMejora(array('idAsignacion' => $idAsignacion, 'fecha' => date("Y-m-d"), 'idUsuario' => $this->session->userdata('idusuariobase')));
    }


    public function acuse($idAsignacion)
    {
        $data['datosCentroTrabajo'] = $this->visitasAcuses->getDatosCentroTrabajo($idAsignacion);
        $data['idCentroTrabajo'] = $this->visitasAcuses->getNombreAtendioVisita($idAsignacion);

        $data['idCentroTrabajo'] = $this->visitasAcuses->getIdCentroTrabajo($idAsignacion);
        $data['nombreCentroTrabajo']=$this->visitasAcuses->getNombreCentroTrabajo($idAsignacion);
        $data['formato'] = $this->visitasAcuses->getAllFormatos();
        $data['nombreUsuarioVisita'] = $this->visitasAcuses->nombreUsuarioVisita($this->session->userdata('idusuariobase'));

        $arregloFormularioAsignacion = $this->visitasAcuses->getFormularioAsignacion($idAsignacion, 21);
        $data['idReporteAsignacion'] = $arregloFormularioAsignacion;
        $data['fotoEvidenciaFotografica']=$this->visitasAcuses->getFotoAcuseVisita($idAsignacion);

        for ($i = 1; $i < 14; $i++)
            $data['instalacion' . $i] = $this->visitasAcuses->getInstalacion($i);
        $data['idAsignacion'] = $idAsignacion;
        $data['acuses'] = $this->visitasAcuses->getAcuses($idAsignacion);

        $data['conteBotequin'] = $this->visitasAcuses->getInstalacionBotiquin();
        if ($this->verificarMovil()) {
            $this->load->view('headerMovil');
            $this->load->view('gridAcuseVisita', $data);
            $this->load->view('footerMovil');
        } else {
            $this->load->view('header');
            $this->load->view('gridAcuseVisita', $data);
            $this->load->view('footer');
        }


    }

    function verificarVisualPdf($idOm)
    {
        $prueba = $this->visitasAcuses->verificarVisual($idOm);
        echo json_encode($prueba);
    }

    function obtenerDatosGuardados($idFa)
    {
        $prueba = $this->visitasAcuses->obtenerDatosGuardados($idFa);
        echo json_encode($prueba);
    }

    function modificarStatusVisual($idOm, $Dato)
    {
        $array = array(
            'visual' => $Dato
        );
        $this->visitasAcuses->establecerFoto($idOm, $array);
    }

    public function registraroOportunidadMejora()
    {
        $identificadores = $this->input->post('identificadores');
        $idRiesgo = $this->input->post('idRiesgo');
        $op_mejoramiento = $this->input->post('oportunidad-mejoramiento');
        $fundamento_legal = $this->input->post('fundamento-legal');
        $estatus = $this->input->post('estatus');
        $idPrioridad = $this->input->post('idPrioridad');
        $recomendacionEdi = $this->input->post('recomendacionEdi');
        //echo "id $identificadores";

        $where = array(
            "idOMPC" => $identificadores
        );

        if (!empty($idRiesgo)) {
            $data = array(
                'idRiesgo' => $idRiesgo
            );
            $this->visitasAcuses->actualizarDatosOM($data, $where);

        } else if (!empty($op_mejoramiento)) {
            $data = array(
                'oportunidadMejoramiento' => $op_mejoramiento
            );
            $this->visitasAcuses->actualizarDatosOM($data, $where);
        } else if (!empty($recomendacionEdi)) {

            $idReturn = $this->visitasAcuses->getidOMPC($identificadores);
            foreach ($idReturn as $valD) {

                $data = array(
                    'valor' => $recomendacionEdi
                );
                $this->visitasAcuses->actualizarDatosTablaFA($data, $valD['idAcordeon'], $valD['idIndicador'], $valD['idFormularioAsignacion']);

            }


        } else if (!empty($fundamento_legal)) {
            $data = array(
                'fundamentoLegal' => $fundamento_legal
            );
            $this->visitasAcuses->actualizarDatosOM($data, $where);
        } else if (!empty($estatus)) {
            $data = array(
                'estatus' => $estatus
            );
            $this->visitasAcuses->actualizarDatosOM($data, $where);
            print json_encode(array("estatus", $estatus, $identificadores));
        } else if (!empty($idPrioridad)) {
            $data = array(
                'idPrioridad' => $idPrioridad
            );
            $this->visitasAcuses->actualizarDatosOM($data, $where);
            print json_encode(array("prioridad", $idPrioridad, $identificadores));
        }
    }


    public function guardarAcuse($idAsignacion, $contador1, $contador2, $contador3, $contador4, $contador5, $contador6, $contador7, $contador8, $contador9, $contador10, $contador11, $contador12, $contador13)
    {

        $this->visitasAcuses->borrarAcuse($idAsignacion);
        //INSTALACIONES ELECTRICAS
        for ($i = 0; $i < $contador1; $i++) {
            $idIndicador = $this->input->post("indicadorInstalacionesElectricas" . $i);
            $idPonderador = $this->input->post("ponderadorInstalacionesElectricas" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }

        }
        //RIESGOS ESTRUCTURALES
        for ($i = 0; $i < $contador2; $i++) {
            $idIndicador = $this->input->post("indicadorRiesgosEstructurales" . $i);
            $idPonderador = $this->input->post("ponderadorRiesgosEstructurales" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }
        //GAS
        for ($i = 0; $i < $contador3; $i++) {
            $idIndicador = $this->input->post("indicadorInstalacionesGas" . $i);
            $idPonderador = $this->input->post("ponderadorInstalacionesGas" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }
        //HIDROSANITARIAS
        for ($i = 0; $i < $contador4; $i++) {
            $idIndicador = $this->input->post("indicadorInstalacionesHidrosanitarias" . $i);
            $idPonderador = $this->input->post("ponderadorInstalacionesHidrosanitarias" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }
        //HUMEDO
        for ($i = 0; $i < $contador5; $i++) {
            $idIndicador = $this->input->post("indicadorMaterialHumedo" . $i);
            $idPonderador = $this->input->post("ponderadorMaterialHumedo" . $i);
            $cantidad = $this->input->post("cantidadMaterialHumedo" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'cantidad' => $cantidad,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }

        }
        //SECO
        for ($i = 0; $i < $contador6; $i++) {
            $idIndicador = $this->input->post("indicadorMaterialSeco" . $i);
            $idPonderador = $this->input->post("ponderadorMaterialSeco" . $i);
            $cantidad = $this->input->post("cantidadMaterialSeco" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'cantidad' => $cantidad,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }

        //NO ESTRUCTURALES
        for ($i = 0; $i < $contador7; $i++) {
            $idIndicador = $this->input->post("indicadorInstalacionesNoEstructurales" . $i);
            $idPonderador = $this->input->post("ponderadorInstalacionesNoEstructurales" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }
        //EQUIPOS DE EMERGENCIA
        for ($i = 0; $i < $contador8; $i++) {
            $idIndicador = $this->input->post("indicadorEquiposEmergencia" . $i);
            $idPonderador = $this->input->post("ponderadorEquiposEmergencia" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }
        //RIESGOS EXTERNOS
        for ($i = 0; $i < $contador9; $i++) {
            $idIndicador = $this->input->post("indicadorRiesgosExternos" . $i);
            $distancia = $this->input->post("distRiesgosExternos" . $i);
            if (!empty($distancia)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'distancia' => $distancia,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }
        //OTROS
        for ($i = 0; $i < $contador10; $i++) {
            $idIndicador = $this->input->post("indicadorDatos" . $i);
            $idPonderador = $this->input->post("ponderadorDatos" . $i);


            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }

        //NO ESTRUCTURALES 2
        for ($i = 0; $i < $contador11; $i++) {
            $idIndicador = $this->input->post("indicadorInstalacionesNoEstructurales2" . $i);
            $idPonderador = $this->input->post("ponderadorInstalacionesNoEstructurales2" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }

        for ($i = 0; $i < $contador12; $i++) {
            $idIndicador = $this->input->post("indicadorSatisfaccion" . $i);
            $idPonderador = $this->input->post("ponderadorSatisfaccion" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'texto' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }

        for ($i = 0; $i < $contador13; $i++) {
            $idIndicador = $this->input->post("indicadorOtros2" . $i);
            $idPonderador = $this->input->post("ponderadorOtros2" . $i);
            if (!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'texto' => $idPonderador,
                    'idAsignacion' => $idAsignacion
                );
                $this->visitasAcuses->insertarValoresAcuse($array);
            }
        }
        $this->visitasAcuses->guardarHistoricoAcuse(array('idAsignacion' => $idAsignacion, 'idUsuario' => $this->session->userdata("idusuariobase"), 'fecha' => date("Y-m-d")));
    }


// se quito por que no sabemos que hace, aparte no carga el modelo y esta "cargando vista"
// function obtenerDatosCentroTrabajo($idCentroTrabajo)
//    {
//        //Este sirve para obtener los datos del formato
//        $prueba= $this->gridAcuseVisita->obtenerDatosCentroTrabajo($idCentroTrabajo);
//        echo json_encode ($prueba);
//    }


    function subirFotoAcuseVisita($idAsignacion)
    {

        if (empty($_FILES["evidenciaFotografica"])) {
            echo json_encode(['error' => 'No hay imagen.']);
            return;
        }
        $images = $_FILES["evidenciaFotografica"];
        $success = null;
        $paths = [];
        $filenames = $images['name'];
        if (!file_exists("assets/img/fotoAnalisisRiesgo/fotosAcuseVisita/") && !is_dir("assets/img/fotoAnalisisRiesgo/fotosAcuseVisita/")) {
            mkdir("assets/img/fotoAnalisisRiesgo/fotosAcuseVisita/");
        }
        for ($i = 0; $i < count($filenames); $i++)
        {
            $ext = explode('.', basename($filenames));

            $nombre = DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);

            $target = "assets/img/fotoAnalisisRiesgo/fotosAcuseVisita/" . $nombre;

            if (move_uploaded_file($images['tmp_name'], $target))
            {
                $this->borrarFotoAcuseVisita($idAsignacion);
                $data = array('idAsignacion' => $idAsignacion, 'nombreFoto' => $nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->visitasAcuses->subirImagenAcuseVisita($data);
                $success = true;
                $paths[] = $target;
                break;
            } else {
                $success = false;
                break;
            }
        }

        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error' => 'Error al subir las imagenes. Por favor, contacte al administrador'];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error' => 'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function borrarFotoAcuseVisita($idAsignacion)
    {
        //Consultar el nombre de la foto
        $imagen = $this->visitasAcuses->borrarfotoAcuseVisita($idAsignacion);
        //hacer el unlink
        if (!empty($imagen))
            unlink("assets/img/fotoAnalisisRiesgo/fotosAcuseVisita/" . $imagen['nombreFoto']);
    }

    function guardarHistorialOMPC($idAsignacion)
    {
        $formularios = $this->visitasAcuses->getFormularios();
        $i = 0;
        foreach ($formularios as $formulario)
        {
            //obtiene el id del formulario con asignacion
            $formularioAsignacion = $this->visitasAcuses->getFormularioAsignacion($idAsignacion, $formulario['idControl']);
            $datosOMPC[$i++] = $this->visitasAcuses->getOMPC($formularioAsignacion[0]['idFormularioAsignacion']);
        }
        $this->visitasAcuses->insertarHistoricoOMPC(array(
            'idAsignacion' => $idAsignacion,
            'fecha' => date("Y-m-d H:i:s"),
            'idUsuario' => $this->session->userdata("idusuariobase"),
            'historial' => json_encode($datosOMPC)));

    }
    function descargarExcelHistorialPC($idHistorico)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $oportunidadMejora=$this->visitasAcuses->getHistorico($idHistorico);
        $OMPC=json_decode($oportunidadMejora['historial'], true);


        $sheet->setCellValue('A1', "Área/Sección");
        $sheet->setCellValue('B1', "Riesgo");
        $sheet->setCellValue('C1', "Recomendación");
        $sheet->setCellValue('D1', "Oportunidad de mejoramiento");
        $sheet->setCellValue('E1', "Fundamento legal");
        $sheet->setCellValue('F1', "Estatus");
        $sheet->setCellValue('G1', "Prioridad de mejora");
        $sheet->setCellValue('H1', "Imagen");
        $sheet->getStyle('A1:H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFA0A0A0');

        $count = 2;
        $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(80);
        foreach ($OMPC as $item)
        {
            foreach ($item as $val)
            {
                if(empty($val))
                    continue;

                $formularioAsignacion=$val['idFormularioAsignacion'];
                //$idFormularioAlmacenamiento=$val['idFormularioAlmacenamiento'];
                $idIndicador=$val['idIndicador'];
                $idAcordeon=$val['idAcordeon'];
                $area_seccion=$val['nombreFormulario'];
                $colorEstatus="FFFFFFFF";
                $estatus=0;
                $idOMPC = $val['idOMPC'];
                $fundamentoLegal = $val['fundamentoLegal'];
                $value = $val['valor'];
                $foto = $val['foto'];
                $verIndicador = $val['visual'];
                if ($verIndicador==1) {
                    $checked="checked";
                }else{
                    $checked="";
                }
                //echo "$idOMPC $checked </br>";
                $oportunidadMejoramiento = $val['oportunidadMejoramiento'];
                $nombreMejora = empty($val['nombrePM']) ? "" : $val['nombrePM'];
                $nombreRiesgo = empty($val['nombreRiesgo']) ? "" : $val['nombreRiesgo'];
                if($val['estatus'] != '')
                {
                    $estatus = ($val["estatus"] == 1) ? 0 : 1;
                    $colorEstatus = ($estatus == 0) ? "FFF44336" : "FF8BC34A";
                }
                $colorPM = empty($val['colorPM'])?"FFFFFF":$val['colorPM'];
                $colorPM='FF'.ltrim($colorPM, '#');

                $sheet->setCellValue('A'.$count, $area_seccion);
                $sheet->setCellValue('B'.$count, $nombreRiesgo);
                $sheet->setCellValue('C'.$count, $oportunidadMejoramiento);
                $sheet->setCellValue('D'.$count, $value);
                $sheet->setCellValue('E'.$count, $fundamentoLegal);
                $sheet->setCellValue('F'.$count, $estatus);

                $sheet->getStyle('F'.$count)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorEstatus);

                $sheet->setCellValue('G'.$count, $nombreMejora);
                $sheet->getStyle('G'.$count)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($colorPM);
                if(!empty($foto))
                {
                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                    $drawing->setName('Imagen');
                    $drawing->setDescription('Imagen');
                    $drawing->setPath('assets/img/fotoAnalisisRiesgo/'.$formularioAsignacion.'/'.$foto);
                    $drawing->setHeight(100);
                    $drawing->setCoordinates('H'.$count);
                    $drawing->setWorksheet($spreadsheet->getActiveSheet());
                }

                $count++;

            }
        }

        $sheet->getStyle('A1:H'.$sheet->getHighestRow())->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1:H'.$sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getSheetView()->setZoomScale(70);
        $writer = new Xlsx($spreadsheet);
        $writer->save('OportunidadMejora.xlsx');
        $this->load->helper('download');
        force_download('OportunidadMejora.xlsx', NULL);
    }

    function getCorreosEnviados($idAsignacion)
    {
        echo json_encode($this->visitasAcuses->getCorreosEnviados($idAsignacion));
    }
}
?>

