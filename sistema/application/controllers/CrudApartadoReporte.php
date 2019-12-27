<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudApartadoReporte extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("ApartadoReporte"); //cargamos el modelo de User
    }
    public function index($index = 1)
    {
        $data['page'] = $this->ApartadoReporte->data_pagination("/CrudApartadoReporte/index/",
            $this->ApartadoReporte->getTotalRowAllData(), 3);
        $data['listApartadoReporte'] = $this->ApartadoReporte->getDatos($index);
        $this->load->view('viewTodoApartadoReporte',$data);
    }
    public function formAltaApartadoReporte()
    {
        $this->load->view('formApartadoReporte');
    }
    public function formEditarApartadoReporte($idApartadoReporte)
    {
        $data = ['idApartadoReporte' => $idApartadoReporte];
        $this->load->view('gridEditarApartadoReporte',$data);
    }
    function obtenerDatos($idu)
    {
        $prueba= $this->ApartadoReporte->obtenerFicha($idu);
        echo json_encode ($prueba);
    }
    function modificarDatos()
    {
        $idApartadoReporte = $this->input->post('idApartadoReporte');
        $data = ['nombre' => $this->input->post('nombre'),'descripcion' => $this->input->post('descripcion')];
        $this->ApartadoReporte->modificaDatos($data,$idApartadoReporte);
    }
    function altaApartadoReporte()
    {
        $data = ['nombre' => $this->input->post('nombre'), 'descripcion' => $this->input->post('descripcion'),];
        $this->ApartadoReporte->insertaDatos($data);
    }
    function deleteApartadoReporte($idApartadoReporte)
    {
        $this->ApartadoReporte->borrarDatos($idApartadoReporte);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudApartadoReporte');
    }
    function obtenerIndicadoresApartado($idApartado)
    {
        echo json_encode($this->ApartadoReporte->obtenerIndicadoresApartado($idApartado), true);
    }
    public function obtenerIndicadoresApartadoRestantes()
    {
        echo json_encode($this->ApartadoReporte->obtenerIndicadoresApartadoRestantes(), true);
    }
    function altaIndicadores($idApartado)
    {
        $this->ApartadoReporte->borrarIndicadores($idApartado);
        $totalIndicadores=$this->input->post('totalIndicadores');
        for ($i=0; $i<$totalIndicadores; $i++)
        {
            if(isset($_POST['indicador'.$i]))
            {
                $arreglo=array('idApartadoReporte'=>$idApartado, 'idIndicadorReporte' => $this->input->post('indicador'.$i),'posicion' => $this->input->post('lugar'.$i));
                $this->ApartadoReporte->insertIndicador($arreglo);
                echo json_encode('ok');
            }
        }

    }
}

?>