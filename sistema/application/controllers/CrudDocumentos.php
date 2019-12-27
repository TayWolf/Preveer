<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudDocumentos extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("documentos"); //cargamos el modelo

    }

    public function index($index = 1)
    {
        $data['page'] = $this->documentos->data_pagination("/CrudDocumentos/index/",
        $this->documentos->getTotalRowAllData(), 3);
        $data['listDocumentos'] = $this->documentos->getDatos($index);
        $this->load->view('viewtododocumentos',$data);


    }

    public function formAltaDocumento()
    {
        $this->load->view('formdocumentos');
    }



    public function formEditarDocumento($idDocumento=null)

    {
        // $idDocumento=$_REQUEST['id'];
        $data = ['idDocumento' => $idDocumento];
        $this->load->view('grideditardocumento',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->documentos->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos(){


        $idDocumento = $this->input->post('idDocumento');
        $data = ['nombreDocumento' => $this->input->post('nombreDocumento'),
            'idEstado'=> $this->input->post('estados')];
        $this->documentos->modificaDatos($data,$idDocumento);

    }



    function altaDocumento()
    {
        $arreglo= array(
            'nombreDocumento' => $this->input->post('nombreDocumento'),
            'idEstado' => $this->input->post('estados')
        );
        $data = $arreglo;

        $this->documentos->insertaDatos($data);
    }


    function deleteDocumento($idDocumento){

        $this->documentos->borrarDatos($idDocumento);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentos');

    }

    public function obtenerEstados()
    {
        $data=$this->documentos->getEstados();
        echo json_encode($data);
    }



}

?>

