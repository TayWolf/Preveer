<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudCheklist extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("checklist"); //cargamos el modelo de User

    }


    public function verificacionControlcalidad($idAsignacion,$idOti,$idSubservicio)//no borrar
    {

        $data = ['idAsignacion' => $idAsignacion,'idOti'=>$idOti,'idSubservicio'=>$idSubservicio];
        $data['idCentroTrabajo']=$this->checklist->getIdCentroTrabajo($idAsignacion)["idCentroTrabajo"];
        $data['doctosEdo'] = $this->checklist->getDoctosEstado($idAsignacion,$idSubservicio);
        $data['ponderadores']=$this->checklist->getPonderadores();
        $data['evaluaciones']=$this->checklist->cargarEvaluaciones($idAsignacion, $data['idCentroTrabajo']);
        $this->load->view('gridchecklist',$data);
    }



    function guardarDocto($tot, $porcentaje=null, $valido=1)// no borrar
    {
        $uno=0;
        $x=array();

        $idAsigna = $this->input->post('idAsigna');
        $idCentroTrabajo= $this->input->post('idCentroTrabajo');
        $idSubservicio= $this->input->post('idSubservicio');
        $this->checklist->borrarDatosPuenteEntrega($idAsigna,$idCentroTrabajo);
        for ($i=0; $i < $tot ; $i++)
        {
            $idDocume = $this->input->post('documento'.$i);
            $ponderador=$this->input->post('idident'.$i);
            $comenta = $this->input->post('comet'.$i);

            if ($ponderador != "")
            {
                $getPorcetajeVal=$this->checklist->getPorcetajeValor($idSubservicio,$idCentroTrabajo);
                $data2 = array(
                    'idDocumentoSTPS' =>$idDocume ,
                    'idPonderador' => $ponderador,
                    'idAsignacion' => $idAsigna,
                    'idCentroTrabajo' => $idCentroTrabajo,
                    'comentario' => $comenta);
                $this->checklist->insertaDatosPuenteEntrega($data2);


            }

        }
        if($valido==1)
            $valido=null;
        $data=array('porcentajeValor' => $getPorcetajeVal, 'normaInvalida' => $valido);
        $this->checklist->actualizarPorcentaje($idAsigna, $data, $valido);



    }

    public function listCentroTrabajo($idOti)// no borrar
    {
        $data = ['idOti' => $idOti];
        $data['cenTra'] = $this->checklist->getListadoInmueblesOti($idOti);
        $data['isVisita'] = $this->checklist->checkVisitas($idOti);
        $data['isVisitaDocs'] = $this->checklist->checkVisitasDocs($idOti);
        $this->load->view('gridlistacentrotrabajo', $data);
    }


    public function coordinador($id)// no borrar
    {
        $index = 1;
        $data['page'] = $this->checklist->data_pagination("/CrudOti/coordinador/", $this->checklist->getTotalRowAllData(), 3);
        $data['listOti'] = $this->checklist->getDatosCoor($index, $id); //Trae la lista de Otis dadas de alta en el sistema
        $data['cooridnadores'] = $this->checklist->getListadoAnalistas(); //Valida si ya se asigno algún coordinador a la OTI
        $this->load->view('viewtodooti',$data);
    }


}

?>