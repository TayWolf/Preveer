<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudAutoad extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('ModelAutoad');
    }

    public function index($index=1)
    {
        $data['listaformulario'] = $this->ModelAutoad->getDatos($index);
        $this->load->view('viewTodoAutoadform',$data);
    }

    public function formAltaFormulario()
    {
        $this->load->view('viewAutoadForm');
        //$this->load->view('formPonderador');
    }


    public function formEditarFormulario($idControl=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idControl' => $idControl];
        $this->load->view('grideditarAutoadForm',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->ModelAutoad->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos(){


        $idControl = $this->input->post('idControl');
        $data=array(
            'nombreFormulario'=>$this->input->post('nombreFormulario'),
            'icono'=>$this->input->post('icono')
        );

        $this->ModelAutoad->modificaDatos($data,$idControl);

    }



    function altaFormulario()
    {
        $formulario=$this->input->post('nombreFormulario');
         $icono=$this->input->post('icono');

        $data=array(
            'nombreFormulario'=>$formulario,
            'icono'=>$icono);

        //echo "entra $Ponderador cantidadFotos $cantidadFotos";
        $this->ModelAutoad->insertaDatos($data);

    }


    function deleteFormulario($idControl){

        $this->ModelAutoad->borrarDatos($idControl);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudAutoad');

    }

    function getDatosFormulario($idControl){
        $Resultado= $this->ModelAutoad->obtenerResultado($idControl);
        echo json_encode ($Resultado);

    }

    public function listaAcordeon($idControl)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idControl' => $idControl];
        $data['listadoAcordeon'] = $this->ModelAutoad->getListadoindInf($idControl);
        $data['listadoAcordeones'] = $this->ModelAutoad->getListaTodolistaAcordeon();
        $this->load->view('gridlistaFormAutoad',$data);
    }

    function altaPuente()
    {
        $idControl=$this->input->post('idControl');
        $tot=$this->input->post('tot');


        for ($i=1; $i <= $tot ; $i++) {
            $idP= $this->input->post('idR'.$i);
            if ($idP != "") {

                $data2 = array(
                    'idControl' => $idControl,
                    'idAcordeon' => $idP
                );
                $this->ModelAutoad->insertaDatosPuente($data2);

            }
        }
    }
    function obtenerAcordeones($llavePrimaria)
    {
        echo json_encode($this->ModelAutoad->obtenerAcordeones($llavePrimaria));
    }
    public function obtenerAcordeonesRestantes($llavePrimaria)
    {
        echo json_encode($this->ModelAutoad->obtenerAcordeonesRestantes(), true);
    }
    function altaAcordeones($llavePrimaria)
    {
        $this->ModelAutoad->borrarAcordeones($llavePrimaria);
        $totalIndicadores=$this->input->post('totalIndicadores');
        for ($i=0; $i<$totalIndicadores; $i++)
        {
            if(isset($_POST['acordeon'.$i]))
            {
                $arreglo=array('idControl'=>$llavePrimaria, 'idAcordeon' => $this->input->post('acordeon'.$i),'posicion' => $this->input->post('lugar'.$i));
                $this->ModelAutoad->insertAcordeon($arreglo);
                echo json_encode('ok');
            }
        }

    }


    function deletePuente($id,$idI){

        $this->ModelAutoad->borrarDatosindicabReq($id);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudAutoad/listaAcordeon/'.$idI);

    }





}

?>