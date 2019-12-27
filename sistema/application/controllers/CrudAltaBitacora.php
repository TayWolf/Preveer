<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudAltaBitacora extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("AltaBitacora"); //cargamos el modelo de User
    }

    public function index($index = 1)
    {
        $data['page'] = $this->AltaBitacora->data_pagination("/CrudAltaBitacora/index/",
            $this->AltaBitacora->getTotalRowAllData(), 3);
        $data['listAltaBitacora'] = $this->AltaBitacora->getDatos($index);
        $this->load->view('viewtodoAltaBitacora',$data);
    }
    public function datosInforme($idBitacora)
    {
        $data['idBitacora']=$idBitacora;
        $data['listaIndicadorInforme']=$this->AltaBitacora->getListaIndicadorInforme($idBitacora);
        $this->load->view('viewTodoDatosInforme', $data);
    }


    public function formAltaBitacora()
    {
        $this->load->view('formAltaBitacora');
    }
    public function formAltaIndicadorInforme($idBitacora)
    {
        $data['idBitacora']=$idBitacora;
        $this->load->view('formAltaIndicadorInforme', $data);
    }

    public function formEditarBitacora($idBitacora)
    {
        $data = ['idBitacora' => $idBitacora];
        $this->load->view('gridEditarBitacora',$data);
    }
    function formEditarIndicadorInforme($idIndicador)
    {
        $data['idIndicador']=$idIndicador;
        $data['datos']=$this->AltaBitacora->getDatosIndicadorInforme($idIndicador);
        $this->load->view('gridEditarIndicadorInforme', $data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->AltaBitacora->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos()
    {
        $idBitacora = $this->input->post('idBitacora');
        $data = ['nombre' => $this->input->post('nombre'),'icono' => $this->input->post('icono')];
        $this->AltaBitacora->modificaDatos($data,$idBitacora);
    }

    function editarIndicadorInforme()
    {
        $datos=array('texto'=>$this->input->post('texto'));
        $idIndicadorInforme=$this->input->post('idIndicador');
        $this->AltaBitacora->modificarIndicadorInforme($datos, $idIndicadorInforme);
    }

    function altaBitacora()
    {
        $data = ['nombre' => $this->input->post('nombre'),'icono' => $this->input->post('icono')];
        $this->AltaBitacora->insertaDatos($data);
    }
    function altaIndicadorInforme()
    {
        $datos=array('idBitacora' => $this->input->post('idBitacora'), 'texto'=>$this->input->post('texto'));
        $this->AltaBitacora->insertarIndicadorInforme($datos);
    }


    function deleteBitacora($idBitacora){

        $this->AltaBitacora->borrarDatos($idBitacora);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudAltaBitacora');

    }
    function obtenerIndicadoresBitacora($idBitacora)
    {
        echo json_encode($this->AltaBitacora->obtenerIndicadoresBitacora($idBitacora), true);
    }
    public function obtenerIndicadoresBitacoraRestantes($idBitacora)
    {
        echo json_encode($this->AltaBitacora->obtenerIndicadoresBitacoraRestantes(), true);
    }
    function altaIndicadores($idBitacora)
    {
        $this->AltaBitacora->borrarIndicadores($idBitacora);
        $totalIndicadores=$this->input->post('totalIndicadores');
        for ($i=0; $i<$totalIndicadores; $i++)
        {
            if(isset($_POST['indicador'.$i]))
            {
                $arreglo=array('idBitacora'=>$idBitacora, 'idIndicador' => $this->input->post('indicador'.$i),'posicion' => $this->input->post('lugar'.$i));
                $this->AltaBitacora->insertIndicador($arreglo);
                echo json_encode('ok');
            }
        }

    }
    function deleteIndicadorInforme($idIndicador, $idBitacora)
    {
        $this->AltaBitacora->deleteIndicadorInforme($idIndicador);
        $this->datosInforme($idBitacora);
    }


}

?>