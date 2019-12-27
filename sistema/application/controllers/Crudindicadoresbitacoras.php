<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudIndicadoresbitacoras extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("indicadoresbitacoras"); //cargamos el modelo de User
    }

    public function index()
    {

        $data['listaIndicador'] = $this->indicadoresbitacoras->getDatos();
        $this->load->view('viewtodoindicadoresbitacoras',$data);
    }
    function establecerComoContador($idIndicador)
    {
        $esContador=$this->indicadoresbitacoras->obtenerContador($idIndicador)[0]['esContador'];
        if($esContador)
            $data=array('esContador'=> 0);
        else
            $data=array('esContador'=> 1);
        $this->indicadoresbitacoras->establecerContador($idIndicador,$data);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras');

    }

    public function formAltaindicadorBitacora()
    {
        $this->load->view('formAltaIndicadorbitacora');
    }

    public function formEditarIndicadoresBitacora($idIndicador)
    {
        $data = ['idIndicador' => $idIndicador];
        $this->load->view('gridEditarindicadorBitacora',$data);
    }

     public function ponderadorIndicador($idIndicador)
    {
        $data = ['idIndicador' => $idIndicador];
         $data['listaPonde'] = $this->indicadoresbitacoras->getListadoPond($idIndicador);
         $data['listaSubs'] = $this->indicadoresbitacoras->getListaPonder();
        $this->load->view('gridponderadorindicador',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->indicadoresbitacoras->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function altaPuente($tot)
    {
        
         for ($i=1; $i <= $tot ; $i++) { 
            $idub = $this->input->post('idSS'.$i);
            $idIndicador = $this->input->post('idIndicador');
          
            if ($idub != "") {
                $data2 = array(
                'idIndicador' =>$idIndicador,    
                'idPonderador' => $idub 
                );
                $this->indicadoresbitacoras->insertaDatosPuente($data2);
                
            }
        }
    }

    function modificarDatos()
    {
        $idIndicador = $this->input->post('idIndicador');
        $data = ['nombreIndicador' => $this->input->post('nombre'),'tipoIndicador' => $this->input->post('tipoInd'),'required' => $this->input->post('reque')];
        $this->indicadoresbitacoras->modificaDatos($data,$idIndicador);
    }


    function deletePuente($idContr,$idIndic){

        $this->indicadoresbitacoras->borrarDatosPuente($idContr);
        
        redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras/ponderadorIndicador/'.$idIndic);
        
    }

    function altaIndicadBitacora()
    {
         $TipoCmpo = $this->input->post('TipoCmpo');

         $data = ['nombreIndicador' => $this->input->post('nombre'),'tipoIndicador' => $this->input->post('TipoCmpo'),'required' => $this->input->post('reque')];
         $this->indicadoresbitacoras->insertaDatos($data);

         // if ($TipoCmpo==2) {
         //    $data = ['nombreIndicador' => $this->input->post('nombre'),'tipoIndicador' => $this->input->post('TipoCmpo'),'required' => $this->input->post('reque')];
         //     $this->indicadoresbitacoras->insertaDatosSegundatabla($data);
         // }
        
    }


    function deleteindicadorBitacora($indicado){

        $this->indicadoresbitacoras->borrarDatos($indicado);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudindicadoresbitacoras');

    }


}

?>