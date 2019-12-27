<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudDocumentosNormasArnes extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("DocumentosNormasArnes"); //cargamos el modelo
    }

    public function index($index = 1)
    {
        $data['page'] = $this->DocumentosNormasArnes->data_pagination("/CrudDocumentosNormasArnes/index/",
        $this->DocumentosNormasArnes->getTotalRowAllData(), 3);
        $data['listDocumentosNormas'] = $this->DocumentosNormasArnes->getDatos($index);
        $this->load->view('viewtododocumentosnormasarnes',$data);


    }

    public function formAltaDocumentoNormas()
    {
        $data['listaGru'] = $this->DocumentosNormasArnes->getSubAreas();
        $this->load->view('formdocumentosnormasarnes', $data);
    }


    public function formEditarDocumentoNormas($idIndicador=null)

    {
        // $idDocumento=$_REQUEST['id'];
        $data = ['idIndicador' => $idIndicador];
        //$data ['datos'] =  $this->DocumentosNormasArnes->obtenerFicha($idIndicador);
        $data['listSubAreas'] = $this->DocumentosNormasArnes->getSubAreas();
        $this->load->view('grideditardocumentonormasarnes',$data);
    }


    function modificarDatos()
    {
        $idInci = $this->input->post('idInci');
        $data = [
            'nombreIndicador' => $this->input->post('nombreIndicador'),
            'idGrupo' => $this->input->post('idGrupo')
        ];
        $this->DocumentosNormasArnes->modificaDatos($data,$idInci);

    }



    function altaDocumento()//pendiente
    {
        $arreglo= array(
            'nombreIndicador' => $this->input->post('nombreIndicador'),
            'idGrupo' => $this->input->post('idGrupo')
        );
        $data = $arreglo;

        $this->DocumentosNormasArnes->insertaDatos($data);
    }




    function deleteDocumentoNormas($idDocSTPS){

        $this->DocumentosNormasArnes->borrarDatos($idDocSTPS);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormasArnes');

    }


    public function traerNormas($idIndic)
    {
        $normas=$this->DocumentosNormasArnes->getNormas($idIndic);
        echo json_encode($normas);

    }



}

?>

