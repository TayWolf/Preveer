<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudProyectos extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("proyectos"); //cargamos el modelo de User
    }

    public function index($index = 1)
    {
        $data['page'] = $this->proyectos->data_pagination("/Crudproyectos/index/",
            $this->proyectos->getTotalRowAllData(), 3);
        $data['listProyectos'] = $this->proyectos->getDatos($index);
        $this->load->view('viewtodoproyectos',$data);


    }

    public function formAltaProyecto()
    {
        $data['areas'] = $this->proyectos->getListadoAreas(); //obtener las areas registradas en la Base de Datos
        $this->load->view('formproyecto',$data);
    }




    public function formEditarProyecto($idProyecto=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idProyecto' => $idProyecto];
        $data['areas'] = $this->proyectos->getListadoAreas();
        $this->load->view('grideditarproyecto',$data);
    }

    public function listaSubservicio($idProyecto=null)
    {
        // $idArea=$_REQUEST['id'];
        $data = ['idProyecto' => $idProyecto];
        $data['proyecto'] =$this->proyectos->getProyecto($idProyecto);
        $data['listaSubse'] = $this->proyectos->getListadoSubserv($idProyecto);
        $data['listaSubs'] = $this->proyectos->getListasubservicio();
        $data['clientes'] = $this->proyectos->getClientes();
        $this->load->view('gridlistaservicio',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->proyectos->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos(){


        $idProyecto = $this->input->post('idProyecto');

        $data = array(
            'nombreProyecto'=>$this->input->post('nombreProyecto'),
            'idArea'=>$this->input->post('area')
        );
        //echo "datos ".$idProyecto;
        $this->proyectos->modificaDatos($data,$idProyecto);

    }

    function altaPuente($tot)
    {

        for ($i=1; $i <= $tot ; $i++) {
            $idub = $this->input->post('idSS'.$i);
            $idSer = $this->input->post('idservicio');

            if ($idub != "") {
                $data2 = array(
                    'idServicio' =>$idSer,
                    'idSubservicio' => $idub
                );
                $this->proyectos->insertaDatosPuente($data2);

            }
        }
    }



    function altaProyecto()
    {

        //Creao un arreglo con la misma estructura de la tabla a insertar
        $data = array(
            'idArea'=>$this->input->post('area'),
            'nombreProyecto'=>$this->input->post('nombreProyecto')
        );

        $this->proyectos->insertaDatos($data);
    }


    function deleteProyecto($idProyecto){

        $this->proyectos->borrarDatos($idProyecto);

        redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudproyectos');

    }

    function deletePuente($idContr,$idServicio){

        $this->proyectos->borrarDatosPuente($idContr);

        redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudproyectos/listaSubservicio/'.$idServicio);

    }
    function getListaEntregables($idServicioSubservicio)
    {
        echo json_encode($this->proyectos->getListaEntregables($idServicioSubservicio));
    }

    function insertEntregablesSubservicio()
    {

        $numeroEntregables=$this->input->post("numeroEntregables");
        //id primaria de serviciosSubservicio
        $idControl=$this->input->post("idControl");
        $this->proyectos->deleteListaEntregablesSubservicio($idControl);
        for($i=0; $i<$numeroEntregables; $i++)
        {
            $idEntregable=$this->input->post("entregable".$i);
            $cantidad=$this->input->post("cantidadEntregable".$i);
            $nota=$this->input->post("notaEntregable".$i);
            if(!empty($idEntregable))
                $this->proyectos->insertEntregablesSubservicio(array(
                    'idEntregable' => $idEntregable,
                    'idServicioSubservicio ' => $idControl,
                    'cantidad' => $cantidad,
                    'nota' => $nota
                ));
        }
        echo "1";
    }
    //Funcion que trae las columnas del seguimiento documental de un cliente
    function getColumnasCliente()
    {
        $idCliente=$this->input->post("idCliente");
        $servicioSubservicio=$this->input->post("servicioSubservicio");
        echo json_encode($this->proyectos->getColumnasCliente($idCliente, $servicioSubservicio));
    }
    //da de alta las colummnas del seguimiento documental para un X cliente
    function altaSeguimientoCliente()
    {
        //echo json_encode($_POST);
        $idCliente=$this->input->post("idCliente");
        $servicioSubservicio=$this->input->post("servicioSubservicio");

        $this->proyectos->deleteSeguimientoCliente($idCliente, $servicioSubservicio);
        //recorre las columnas, son 150 en total
        for($i=0;$i<200; $i++)
        {
            $columna=$this->input->post("cboxColumna".$i);
            if($columna)
            {
                $numberPorcentaColumna=$this->input->post("numberPorcentaColumna".$i);
                if(empty($numberPorcentaColumna))
                    $numberPorcentaColumna=0;
                $nombreServicio=$this->input->post("nombreServicio".$i);

                $this->proyectos->altaSeguimientoCliente(array(
                    'idCliente' => $idCliente,
                    'idServicioSubservicio' => $servicioSubservicio,
                    'columna' => $columna,
                    'valorPorcentaje' => $numberPorcentaColumna,
                    'subservicio' => $nombreServicio
                ));
            }
        }
    }

    function verificarContrasena()
    {
        $password = $this->input->post("password");
        $iduser = $this->session->userdata("idUsuario");
        echo $this->proyectos->verificarPassword($iduser, $password);
    }
}

?>