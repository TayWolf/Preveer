<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }

    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM Proyectos")->row_array();
        return $query['row'];
    }

    function data_pagination($url, $rows = 5, $uri = 3)
    {
        $this->load->library('pagination');
        $config['per_page']   = 10;
        $config['base_url']   = site_url($url);
        $config['total_rows']   = $rows;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment']   = $uri;
        $config['num_links']   = 5;
        $config['attributes'] = array('class' => 'waves-effect');
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link']   = '<i class="material-icons">chevron_right</i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link']   = '<i class="material-icons">chevron_left</i>';
        $config['cur_tag_open']='<li><a>';
        $config['cur_tag_close']='</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open']='<ul class="pagination">';
        $config['full_tag_close']='</ul>';

        // untuk config class pagination yg lainnya optional (suka2 lu.. :D )

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    function getDatos($no_page)
    {
        return $this->db->query("SELECT * FROM Proyectos")->result_array();
    }

    function insertaDatos($data)
    {
        $this->db->insert('Proyectos', $data);
        //echo json_encode($data);altaUser
    }

    function insertaDatosPuente($data)
    {
        $this->db->insert('serviciosSubservicios', $data);
        //echo json_encode($data);altaUser
    }
    // function insertaDatosPuent($data2)
    // {
    // 	$this->db->insert('Logeo', $data2);
    // }

    function obtenerFicha ($idProyecto){
        return $this->db->query("SELECT * from Proyectos where idProyecto=$idProyecto ")->row();
    }

    function obtenerIdUser($nombreIden,$direccion)
    {
        /*$this -> db -> select('*');
        $this->db->from('Usuario');
        $this->db->where('nombre',$nombreIden);
         $this->db->where('direccion',$direccion);
        $query = $this->db->get();
        return $query->row();*/
        return $this->db->query("SELECT * from Usuario where nombre='$nombreIden' and direccion ='$direccion'; ")->result_array();



    }

    function modificaDatos($data,$idProyecto)
    {
        $this->db->where('idProyecto', $idProyecto);
        $this->db->update('Proyectos', $data);

    }


    function getListadoSubserv($Servicio)
    {
        return $this->db->query("select Subservicios.nombre,serviciosSubservicios.idControl from Subservicios join serviciosSubservicios on serviciosSubservicios.idSubservicio=Subservicios.idSubservicio where serviciosSubservicios.idServicio=$Servicio")->result_array();
    }

    // function modificaDatosPuente($data2,$idUser)
    // {
    //   $this->db->where('idUsuario', $idUser);
    //   $this->db->update('Logeo', $data2);

    //   }

    function borrarDatos($idProyecto)
    {
        $this->db->where('idProyecto', $idProyecto);
        $this->db->delete('Proyectos');
    }

    function borrarDatosPuente($idCon)
    {
        $this->db->where('idControl', $idCon);
        $this->db->delete('serviciosSubservicios');
    }

    function getListasubservicio()
    {
        return $this->db->query("SELECT * FROM Subservicios")->result_array();
    }

    function getListadoAreas()
    {
        return $this->db->query("SELECT Areas.idArea,Areas.nombreArea FROM Areas")->result_array();
    }
    function getProyecto($idProyecto)
    {
        return $this->db->query("SELECT * FROM Proyectos WHERE idProyecto=$idProyecto")->row_array();
    }
    function getListaEntregables($idServicioSubservicio)
    {
        return $this->db->query("SELECT Entregables.*, E.idEntregableSubservicio, E.idServicioSubservicio, E.cantidad, E.nota FROM Entregables LEFT JOIN (SELECT * FROM EntregablesSubservicio WHERE idServicioSubservicio=$idServicioSubservicio) E ON E.idEntregable=Entregables.idEntregable")->result_array();
    }
    function deleteListaEntregablesSubservicio($idControl)
    {
        $this->db->where("idServicioSubservicio", $idControl);
        $this->db->delete("EntregablesSubservicio");
    }
    function insertEntregablesSubservicio($data)
    {
        $this->db->insert('EntregablesSubservicio', $data);
    }

    function getClientes()
    {
        return $this->db->get("Clientes")->result_array();
    }
    function getColumnasCliente($idCliente, $idServicioSubservicio)
    {
        $this->db->select("*");
        $this->db->from("ClienteSeguimiento");
        $this->db->where("idCliente",$idCliente);
        $this->db->where("idServicioSubservicio",$idServicioSubservicio);
        return $this->db->get()->result_array();
    }
    function deleteSeguimientoCliente($idCliente, $servicioSubservicio)
    {
        $this->db->where("idCliente",$idCliente);
        $this->db->where("idServicioSubservicio",$servicioSubservicio);
        $this->db->delete("ClienteSeguimiento");
    }
    function altaSeguimientoCliente($data)
    {
        $this->db->insert("ClienteSeguimiento", $data);
    }

    function verificarPassword($iduser, $password)
    {
        $this->db->select("Logeo.password");
        $this->db->from("Logeo");
        $this->db->where("Logeo.idUsuario", $iduser);
        $rowPassword = $this->db->get()->row_array();
        if(!empty($rowPassword))
        {
            $passUser = $rowPassword['password'];
            if($passUser===$password)
            {
                return 1;
            }
        }
        return 0;
    }
}