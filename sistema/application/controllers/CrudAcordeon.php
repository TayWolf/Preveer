<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudAcordeon extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('ModeloAcordeon');
    }

    public function index($index=1)
    {
        $data['listaAcordeon'] = $this->ModeloAcordeon->getDatos($index);
        $this->load->view('viewtodoAcordeon',$data);
    }

    public function formAltaAcordeon()
    {
        $this->load->view('viewAcordeon');
        //$this->load->view('formindicador');
    }


    public function formEditarAcordeon($idAcordeon=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idAcordeon' => $idAcordeon];
        $this->load->view('grideditarAcordeon',$data);
    }



// 	function obtenerDatos($idu)
// 	{

//     	$prueba= $this->ModeloAcordeon->obtenerFicha($idu);
//     	echo json_encode ($prueba);
// 	}

    function modificarDatos(){


        $idAcordeon = $this->input->post('idAcordeon');
        $tablaRegistro = $this->input->post('tablaRegistro');
        $data=array(
            'nombreAcordeon'=>$this->input->post('nombreAcordeon'),
            'tablaRegistro'=>$tablaRegistro,
            'cantidadFotos'=>$this->input->post('cantidadFotos')

        );

        $this->ModeloAcordeon->modificaDatos($data,$idAcordeon);

    }



    function altaAcordeon()
    {
        $nombreAcordeon=$this->input->post('nombreAcordeon');
        $tablaRegistro=$this->input->post('tablaRegistro');
        $cantidadFotos=$this->input->post('cantidadFotos');

        $data=array(
            'nombreAcordeon'=>$nombreAcordeon,
            'tablaRegistro'=>$tablaRegistro,
            'cantidadFotos'=>$cantidadFotos
        );
        //echo "entra $indicador cantidadFotos $cantidadFotos";
        $this->ModeloAcordeon->insertaDatos($data);

    }


    function deleteAcordeon($idAcordeon){

        $this->ModeloAcordeon->borrarDatos($idAcordeon);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudAcordeon');

    }

    function getDatosAcordeon($idAcordeon){
        $Resultado= $this->ModeloAcordeon->obtenerResultado($idAcordeon);
        echo json_encode ($Resultado);

    }


    public function listaIndicador($idAcordeon)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idAcordeon' => $idAcordeon];
        $data['listadoIndicador'] = $this->ModeloAcordeon->getListadoindInf($idAcordeon);
        $data['listadoIndicadores'] = $this->ModeloAcordeon->getListaTododlistadoIndicador();
        $this->load->view('gridlistaAcordeon',$data);
    }

    function altaPuente()
    {
        $idAcordeon=$this->input->post('idAcordeon');
        $tot=$this->input->post('tot');


        for ($i=1; $i <= $tot ; $i++) {
            $idP= $this->input->post('idR'.$i);
            if ($idP != "") {
                //echo "entra idponde $idP";
                $data2 = array(
                    'idAcordeon' => $idAcordeon,
                    'idIndicador' => $idP
                );
                $this->ModeloAcordeon->insertaDatosPuente($data2);

            }
        }


    }
    function obtenerIndicadores($llavePrimaria, $tablaRegistro)
    {
        if($tablaRegistro==2)
            echo json_encode($this->ModeloAcordeon->obtenerIndicadoresAcordeon($llavePrimaria));
        else
            echo json_encode($this->ModeloAcordeon->obtenerIndicadoresAcordeon($llavePrimaria, "AND formIndicador.tipoIndicador!=4 AND formIndicador.tipoIndicador!=6 "));
    }
    public function obtenerIndicadoresRestantes($llavePrimaria, $tablaRegistro)
    {
        if($tablaRegistro==2)
            echo json_encode($this->ModeloAcordeon->obtenerIndicadoresRestantes(), true);
        else
            echo json_encode($this->ModeloAcordeon->obtenerIndicadoresRestantes("WHERE formIndicador.tipoIndicador!=4 AND formIndicador.tipoIndicador!=6 "));

    }
    function altaIndicadores($llavePrimaria)
    {
        $this->ModeloAcordeon->borrarIndicadores($llavePrimaria);
        $totalIndicadores=$this->input->post('totalIndicadores');
        for ($i=0; $i<$totalIndicadores; $i++)
        {
            if(isset($_POST['indicador'.$i]))
            {
                $arreglo=array('idAcordeon'=>$llavePrimaria, 'idIndicador' => $this->input->post('indicador'.$i),'posicion' => $this->input->post('lugar'.$i));
                $this->ModeloAcordeon->insertIndicador($arreglo);
                echo json_encode('ok');
            }
        }

    }
    function deletePuente($id,$idI){

        $this->ModeloAcordeon->borrarDatosindicabReq($id);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudAcordeon/listaIndicador/'.$idI);

    }

}

?>