<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudReporteSSHL extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('ModeloReporteSSHL');
    }

    public function index($index=1)
    {
        //Carga la paginacion
        $data['page'] = $this->ModeloReporteSSHL->data_pagination("/CrudReporteSSHL/index/",
            $this->ModeloReporteSSHL->getTotalRowAllData(), 3);
        $data['listaReporte'] = $this->ModeloReporteSSHL->getDatos($index);
        $this->load->view('viewTodoReporteSSHL',$data);
    }

    public function formAltaReporte()
    {
        $this->load->view('viewAltaReporte');
        //$this->load->view('formindicador');
    }


    public function formEditarReporte($idReporte=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idReporte' => $idReporte];
        $this->load->view('grideditarReporteSSHL',$data);
    }



// 	function obtenerDatos($idu)
// 	{

//     	$prueba= $this->ModeloReporteSSHL->obtenerFicha($idu);
//     	echo json_encode ($prueba);
// 	}

    function modificarDatos(){


        $idReporte=$this->input->post('idReporte');
        $data=array(
            'nombreReportes'=>$this->input->post('nombreReportes'),
            'icono'=>$this->input->post('icono'),
            'numeroCorrecciones'=>$this->input->post('numeroCorrecciones')
        );

        $this->ModeloReporteSSHL->modificaDatos($data,$idReporte);

    }



    function altaReporte()
    {
        $nombreReportes=$this->input->post('nombreReportes');
        $icono=$this->input->post('icono');
        $numeroCorrecciones=$this->input->post('numeroCorrecciones');
        $posicionCorreccion=$this->input->post('posicionCorreccion');

        $data=array(
            'nombreReportes'=>$nombreReportes,
            'icono'=>$icono,
            'numeroCorrecciones'=>$numeroCorrecciones,
            'posicionCorreccion'=>0);
        //echo "entra $indicador cantidadFotos $cantidadFotos";
        $this->ModeloReporteSSHL->insertaDatos($data);

    }


    function deleteReporte($idReporte){

        $this->ModeloReporteSSHL->borrarDatos($idReporte);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudReporteSSHL');

    }

    function getDatosReporte($idReporte){
        $Resultado= $this->ModeloReporteSSHL->obtenerResultado($idReporte);
        echo json_encode ($Resultado);

    }

    public function listaApartado($idReporte)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idReporte' => $idReporte];
        $data['listadoApartado'] = $this->ModeloReporteSSHL->getListadoApartado($idReporte);
        $data['listadoApartadores'] = $this->ModeloReporteSSHL->getListaTodolistaApartado();
        $this->load->view('gridlistaApartados',$data);
    }

    function altaPuente()
    {
        $idReporte=$this->input->post('idReporte');
        $tot=$this->input->post('tot');


        for ($i=1; $i <= $tot ; $i++) {
            $idP= $this->input->post('idR'.$i);
            if ($idP != "") {
                //echo "entra idponde $idP";
                $data2 = array(
                    'idReporte' => $idReporte,
                    'idApartadoReporte' => $idP
                );
                $this->ModeloReporteSSHL->insertaDatosPuente($data2);

            }
        }


    }
    function altaApartados($idReporte)
    {
        $this->ModeloReporteSSHL->borrarApartados($idReporte);
        $totalApartados=$this->input->post('totalApartados');
        for ($i=0; $i<$totalApartados; $i++)
        {
            if(isset($_POST['apartado'.$i]))
            {
                $arreglo=array('idReporte'=>$idReporte, 'idApartadoReporte' => $this->input->post('apartado'.$i),'posicion' => $this->input->post('lugar'.$i));
                $this->ModeloReporteSSHL->insertApartado($arreglo);
                echo json_encode('ok');
            }
        }
        $arregloPosicion=array('posicionCorreccion' => $this->input->post('lugarCorreccion'));
        $this->ModeloReporteSSHL->guardarPosicion($idReporte, $arregloPosicion);

    }

    function deletePuente($id,$idI){

        $this->ModeloReporteSSHL->borrarDatosindicabReq($id);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudReporteSSHL/listaApartado/'.$idI);

    }
    function obtenerApartadosReporte($idReporte)
    {
        echo json_encode($this->ModeloReporteSSHL->obtenerApartadosReporte($idReporte), true);
    }
    public function obtenerApartadosReporteRestantes()
    {
        echo json_encode($this->ModeloReporteSSHL->obtenerApartadosReporteRestantes(), true);
    }
    function obtenerPosicionCorreccion($idReporte)
    {
        echo $this->ModeloReporteSSHL->obtenerPosicionCorreccion($idReporte);
    }

}

?>