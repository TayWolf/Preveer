<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudCalculos extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("Calculos"); //cargamos el modelo de User

    }
    public function index($idIndicador)
    {
        $data['idIndicador']=$idIndicador;
        $data['nombreIndicador']=$this->Calculos->getNombreIndicador($idIndicador);
        $data['tipoIndicador']=$this->Calculos->getTipoIndicador($idIndicador);
        $data['listCalculos'] = $this->Calculos->getDatos($idIndicador);
        $this->load->view('viewTodoCalculos',$data);
    }
    public function formAltaCalculo($idIndicador)
    {
        $data['idIndicador']=$idIndicador;

        $this->load->view('formAltaCalculo', $data);
    }
    public function formAltaCondicion($idCalculo, $tipoIndicador)
    {
        $data['idCalculo']=$idCalculo;
        $data['tipoIndicador']=$tipoIndicador;
        $data['listaOpciones']=$this->Calculos->getListaOpcionesIndicador($idCalculo);
        $this->load->view('formAltaCondicion', $data);
    }

    public function formEditarCalculo($idCalculo, $idIndicador)
    {

        $data['idCalculo']=$idCalculo;
        $data['idIndicador']=$idIndicador;
        $this->load->view('gridEditarCalculo',$data);
    }
    function obtenerDatos($idCalculo)
    {
        $prueba= $this->Calculos->obtenerFicha($idCalculo);
        foreach ($prueba as $p)
            echo $p;
    }
    function modificarDatos()
    {
        $idCalculo = $this->input->post('idCalculo');
        $data = ['descripcion' => $this->input->post('descripcion')];
        $this->Calculos->modificaDatos($data,$idCalculo);
    }
    function altaCalculo()
    {
        $data = ['idIndicador'=> $this->input->post('idIndicador'),'descripcion' => $this->input->post('descripcion')];
        $idCalculo=$this->Calculos->insertaDatos($data);
        $tipoIndicador=$this->Calculos->getTipoIndicador($this->input->post('idIndicador'))[0]['tipoIndicador'];
        if($tipoIndicador==4)
        {
            $data = ['idIndicadorCalculo'=> $idCalculo, 'condicion' => "null",'valorCondicion' => "null"];
            $this->Calculos->insertaCondicion($data);
        }
    }
    function altaCondicion()
    {
        $data = ['idIndicadorCalculo'=> $this->input->post('idIndicadorCalculo'),'condicion' => $this->input->post('condicion'),'valorCondicion' => $this->input->post('valorCondicion')];
        $this->Calculos->insertaCondicion($data);
    }

    function deleteCalculo($idCalculo,$idIndicador)
    {
        $this->Calculos->borrarDatos($idCalculo);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/index/'.$idIndicador);
    }
    function deleteCondicion($idCondicion,$idCalculo,$idIndicador)
    {
        $this->Calculos->borrarCondicion($idCondicion);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudCalculos/verCondiciones/'.$idCalculo."/".$idIndicador);
    }
    function verCondiciones($idCalculo, $idIndicador)
    {
        $data['idIndicador']=$idIndicador;
        $data['idCalculo']=$idCalculo;
        $data['nombreCalculo']=$this->Calculos->getNombreCalculo($idCalculo);
        $data['tipoIndicador']=$this->Calculos->getTipoIndicador($idIndicador);
        $data['listaCondiciones']=$this->Calculos->getListaCondiciones($idCalculo);
        $this->load->view('viewTodoCondiciones',$data);
    }
}

?>