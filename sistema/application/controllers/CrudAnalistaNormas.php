<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudAnalistaNormas extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("analistaNormas"); //cargamos el modelo

    }

    public function index($index = 1)
    {

    }
    public function normasOti($idOti, $index=1)
    {
        $usuario=$this->session->userdata('idusuariobase');
        $areaUse=$this->session->userdata('area');
        $data['idOti']=$idOti;
        if($areaUse==2)
        {
            $data['listNormas'] = $this->analistaNormas->getDatosOti($index, $usuario, $idOti);
        }
        else
            $data['listNormas'] = null;
        $this->load->view('viewTodoNormasOti',$data);

    }
    function guardarCumplimiento($idOti)
    {
        $usuario=$this->session->userdata('idusuariobase');
        $array=$this->analistaNormas->getDatosCumplimiento(0, $usuario, $idOti);
        foreach ($array as $row)
        {
            //NOVIEMBRE
            //$existeCumplimiento=$this->analistaNormas->obtenerExistentes($row['idCentroTrabajo'],$row['idProyecto'], '2018', '11');
            //DICIEMBRE
            //$existeCumplimiento=$this->analistaNormas->obtenerExistentes($row['idCentroTrabajo'],$row['idProyecto'], '2019', '02');
            //Ultimo mes
            $existeCumplimiento=$this->analistaNormas->obtenerExistentes($row['idCentroTrabajo'], $row['idProyecto'], date('Y'), date('m'));

            if(!empty($existeCumplimiento))
            {
                foreach ($existeCumplimiento as $cumplimiento)
                    $this->analistaNormas->borrarCumplimiento($cumplimiento['idCumplimiento']);
            }
            //
            //Linea que sirve para cambiar fechas en caso de algún error

            //NOVIEMBRE
            //$respaldo=array('idAsignacion' => $row['idAsignacion'], 'idCentroTrabajo' => $row['idCentroTrabajo'], 'idProyecto' => $row['idProyecto'],'porcentajeValor'=>$row['porcentajeValor'], 'fechaRespaldo' => '2018-11-28');
            //DICIEMBRE
            //$respaldo=array('idAsignacion' => $row['idAsignacion'], 'idCentroTrabajo' => $row['idCentroTrabajo'], 'idProyecto' => $row['idProyecto'],'porcentajeValor'=>$row['porcentajeValor'], 'fechaRespaldo' => '2018-12-28');
            //Ultimo mes
            $respaldo=array('idAsignacion' => $row['idAsignacion'], 'idCentroTrabajo' => $row['idCentroTrabajo'], 'idProyecto' => $row['idProyecto'],'porcentajeValor'=>$row['porcentajeValor'], 'fechaRespaldo' => date('Y-m-d'));
            $this->analistaNormas->insertarRespaldoCumplimiento($respaldo);

            //muestra lo que se guardó
            echo json_encode($respaldo);
        }

    }

}//Class


?>