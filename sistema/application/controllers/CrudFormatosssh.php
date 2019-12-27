<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudFormatosssh extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("formatosssh"); //cargamos el modelo de User

    }

    public function formatoArnes($ti,$idAsignacion)
    {
        //$data['cliente']= $this->formatosssh->clienteGet();
        $data = ['idAsignacion' => $idAsignacion,'ti' => $ti];
        //$data['grupoSshi']=$this->formatosssh->getGruposssh();
        //$data['IndicadoSShi']=$this->formatosssh->getIndicador();
        $this->load->view('gridformatoarnes',$data);
    }

    public function formatoEscaleras($tipoFormato,$idAsignacion,$idCentroTrabajo)
    {
        //$data = ['idAsignacion' => $idAsignacion,'ti' => $tipoFormato];
        $data['idAsignacion'] =$idAsignacion;
        $data['tipoFormato'] = $tipoFormato;
        $data['datosGenerales'] = $this->formatosssh->getDatosGeneralesEscalera($idAsignacion);
        $data['datosInspeccion'] = $this->formatosssh->getDatosInspeccion($idAsignacion, $idCentroTrabajo);
        $this->load->view('gridformatoescaleras', $data);
    }

    function getGrup($tipoF)
    {
        $prueba= $this->formatosssh->getGruposssh($tipoF);
        echo json_encode ($prueba);
    }
    function getIndicadores($idG)
    {
        $prueba= $this->formatosssh->getIndicador($idG);
        echo json_encode ($prueba);
    }

    function getPonderSshi()
    {
        $prueba= $this->formatosssh->getPondesshi();
        echo json_encode ($prueba);
    }

    function getDatosAc($idAsi,$idTip)
    {
        $prueba= $this->formatosssh->getDatos($idAsi,$idTip);
        echo json_encode ($prueba);
    }

    function getDatosEscaleras($idAsignacion, $idTipoFormato)
    {
        $prueba= $this->formatosssh->getDatosEscaleras($idAsignacion, $idTipoFormato);
        echo json_encode ($prueba);
    }

    public function guardarFormato($contador)
    {
        $idAsignacion=$this->input->post("idAsignacion");
        $tipo=$this->input->post("idTip");
        $this->formatosssh->borrarForm($idAsignacion, $tipo);
        for($i=0; $i<$contador; $i++)
        {
            $idIndicador=$this->input->post("idIni".$i);
            $idPonderador=$this->input->post("ponderadoresSSshi".$i);
            $stVal=$this->input->post("stVal".$i);
            $observaS=$this->input->post("observaS".$i);
            $idAsignacion=$this->input->post("idAsignacion");

            if(!empty($idPonderador)) {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'observaciones' => $observaS,
                    'idPonderador' => $idPonderador,
                    'st' => $stVal,
                    'idAsignacion' => $idAsignacion
                );

                $this->formatosssh->insertarValo($array);
                //print_r($array)."</br>";
            }

        }
    }

    public function guardarFormatoEscalera($contador)
    {
        $idAsignacion = $this->input->post("idAsignacion");

        $this->formatosssh->borrarDatosEscalera($idAsignacion);

        for ($i = 0; $i < $contador; $i++) {
            $idIndicador = $this->input->post("idIni" . $i);
            $optima = $this->input->post("optima" . $i);
            $remplazo = $this->input->post("remplazo" . $i);
            $observaciones = $this->input->post("observaciones" . $i);

            $array = array(
                'idIndicador' => $idIndicador,
                'optima' => $optima,
                'remplazo' => $remplazo,
                'observaciones' => $observaciones,
                'idAsignacion' => $idAsignacion
            );

            $this->formatosssh->insertarDatosEscalera($array);

        }


        $datosGenerales = json_decode($this->input->post("datosGenerales"));
        //print_r($datosGenerales);

        $idDatosGenerales = $datosGenerales[1]->value;
        $fechaEdicion = date('Y-m-d');

        $arregloTemporal = array();
        foreach ($datosGenerales as $item) {

            if(strcmp($item->name, "inspeccionB") == 0)
            {
                $arregloTemporal['inspeccionPor']  = $item->value;
            }
            else if(strcmp($item->name, "fechaInspeccion") == 0){
                $arregloTemporal['fechaInspeccion']  = $fechaEdicion;
            }
            else {
                $arregloTemporal[$item->name]  = $item->value;
            }
        }

        //print_r($arregloTemporal);

        $this->formatosssh->borrarDatosGeneralesEscalera($idDatosGenerales);
        $this->formatosssh->insertarDatosGeneralesEscalera($arregloTemporal, $idDatosGenerales);

    }


}

?>