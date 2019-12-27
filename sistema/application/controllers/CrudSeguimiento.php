<?php
class CrudSeguimiento extends CI_Controller
{
    public function __construct()

    {
        parent::__construct();

        $this->load->model("Seguimiento");
    }

    function index()
    {
        $data['listadoFormatos'] = $this->Seguimiento->getDatos();
        $data['clientes']=$this->Seguimiento->getClientes();
        $this->load->view('gridseguimientodocumental',$data);
    }

    function pruebaIndex()
    {
        $data['listadoFormatos'] = $this->Seguimiento->getDatos();
        $data['clientes']=$this->Seguimiento->getClientes();
        $this->load->view('gridseguimientodocumentalD',$data);
    }

    function obtenerDatosAnalista($idAs)
    {
        $prueba = $this->Seguimiento->listadoAnalistas($idAs);
        echo json_encode ($prueba);
        //echo json_encode("hola");
    }

    function obtenerDatosAnalistaForm($idAs)
    {
        $prueba = $this->Seguimiento->listadoAnalistasForm($idAs);
        echo json_encode ($prueba);
        //echo json_encode("hola");
    }

    function obtenerPorcentaje()
    {
        $prueba = $this->Seguimiento->valorPorcentaje();
        echo json_encode ($prueba);
    }

    function getTipoDoct()
    {
        $prueba = $this->Seguimiento->getTipos();
        echo json_encode ($prueba);
    }

    function getObtenerfechaVisitas()
    {
        $prueba = $this->Seguimiento->getNvisitas();
        echo json_encode ($prueba);
    }

    function obtenerporcentajeDoctal()
    {
        $prueba = $this->Seguimiento->valorPorcentajedocumental();
        echo json_encode ($prueba);
    }
    function obtenerFechaRecolector()
    {
        $prueba = $this->Seguimiento->recolectorFecha();
        echo json_encode ($prueba);
    }

    function obteneranalistaOM()
    {
        $prueba = $this->Seguimiento->getResultadoOM();
        echo json_encode ($prueba);
    }

    function obtenerResultado($fIni,$fFinal,$municipio, $estado, $tipoBusqueda)
    {
        //declara la condicion de donde vamos a partir
        $condicionWhere="where Areas.idArea=1 ";
        //filtro de municipio
        if(!empty($municipio))
        {
            $condicionWhere.="AND municipios.idMunicipio=$municipio ";
        }
        //filtro de estado
        if(!empty($estado))
        {
            $condicionWhere.="AND estados.id_Estado=$estado ";
        }
        if(empty($tipoBusqueda))
            echo json_encode($this->Seguimiento->getDatos($condicionWhere));
        else
            echo json_encode ($this->Seguimiento->getResultado($fIni,$fFinal,$tipoBusqueda, $condicionWhere));

    }


    function obtenerEstado()
    {
        echo json_encode ($this->Seguimiento->getEstados());
    }
    function obtenerMunicipios($idEstado=null)
    {
        //3. Responde los municipios de un estado
        if(!empty($idEstado))
            echo json_encode($this->Seguimiento->getMunicipios($idEstado));

    }

    function filtrarSeguimientoDocumental($idEstado)
    {

        echo json_encode($this->Seguimiento->filtrarSeguimientoDocumental($idEstado));

    }
    function getConsultaTablaSeguimiento($fIni="1000-01-01",$fFinal="2032-12-31",$municipio, $estado, $tipoBusqueda)
    {
        $idCliente=$this->input->post("idCliente");
        $idServicioSubservicio=$this->input->post("idServicioSubservicio");

        //declara la condicion de donde vamos a partir
        $condicionWhere="where Areas.idArea=1 AND Clientes.idCliente=$idCliente AND serviciosSubservicios.idControl=$idServicioSubservicio ";
        //filtro de municipio
        if(!empty($municipio))
        {
            $condicionWhere.="AND municipios.idMunicipio=$municipio ";
        }
        //filtro de estado
        if(!empty($estado))
        {
            $condicionWhere.="AND estados.id_Estado=$estado ";
        }
        if($tipoBusqueda==1)
        {
            $condicionWhere.="AND COALESCE(historicoFormulario.fechaCaptura, '1000-01-01') BETWEEN '$fIni' AND '$fFinal' ";
        }
        else if($tipoBusqueda==2)
        {
            $condicionWhere.="AND COALESCE(HistoricoDocumentales.fecha , '1000-01-01') BETWEEN '$fIni' AND '$fFinal' ";
        }
        else if($tipoBusqueda==3)
        {
            $condicionWhere.="AND COALESCE(HistorialOM.fecha, '1000-01-01') BETWEEN '$fIni' AND '$fFinal' ";
        }
        $jsonReturn[0]=$this->Seguimiento->getTablaSeguimiento($condicionWhere);
        $jsonReturn[1]=$this->Seguimiento->getColumnasSeguimientoDocumental($idCliente, $idServicioSubservicio);
        $arregloPorcentajes=$this->Seguimiento->getPorcentajesSeguimientoDocumental($idCliente, $idServicioSubservicio);
        $jsonReturn[2]=array();
        foreach ($arregloPorcentajes as $porcentaje)
        {
            $nombreColumna=$porcentaje['columna'];
            unset($porcentaje['columna']);

            if(!empty($porcentaje['subservicio']))
            {
                $porcentaje['cumple']=false;
                $jsonReturn[2][$nombreColumna]=$porcentaje;
            }


        }

        echo json_encode($jsonReturn, true);
    }
    function editarSeguimientoDocumental()
    {
        $idAsignacion=$this->input->post("idAsignacion");
        //Es necesario que los indices del tabledit sean iguales que las columnas en la base de datos.
        //quita los indices que no se deben actualizar en la base de datos
        unset($_POST['action']);
        $_POST['fechaSolicitud']=$this->Seguimiento->getFechaSolicitudOTI($idAsignacion);
        echo json_encode($_POST);
        unset($_POST['idAsignacion']);
        unset($_POST['fechaSolicitud']);
        $this->Seguimiento->validarExistencia($idAsignacion);
        $this->Seguimiento->updateSeguimientoDocumental($idAsignacion, $_POST);

    }
    function cargarServicios()
    {
        $idCliente=$this->input->post("idCliente");
        echo json_encode($this->Seguimiento->cargarServiciosCliente($idCliente));
    }
    function cargarSubservicios()
    {
        $idCliente=$this->input->post("idCliente");
        $idServicio=$this->input->post("idServicio");
        echo json_encode($this->Seguimiento->cargarSubserviciosCliente($idCliente, $idServicio));
    }


}