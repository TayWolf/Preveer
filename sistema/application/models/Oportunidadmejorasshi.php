<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oportunidadmejorasshi extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM asignaInmueble")->row_array();
        return $query['row'];
    }

    function data_pagination($url, $rows = 5, $uri = 3)
    {
        $this->load->library('pagination');
        $config['per_page']   = 10;
        $config['first_link'] = 'Primero';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Último';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
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
        $config['cur_tag_open']='<li class=active><a>';
        $config['cur_tag_close']='</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open']='<ul class="pagination">';
        $config['full_tag_close']='</ul>';

        // untuk config class pagination yg lainnya optional (suka2 lu.. :D )

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }


    function getDatos($no_page, $usuario)
    {
        $perpage = 20; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') AS nombre, asignaInmueble.idAsignacion FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion WHERE AnalistaOti.idUsuario = $usuario GROUP BY asignaInmueble.idOti, CentrosDeTrabajo.idCentroTrabajo limit 20 offset $first")->result_array();
    }

    function cargarTabla($tabla,$idAsignacion)
    {
        return $this->db->query("SELECT $tabla.* FROM $tabla WHERE idAsignacion=$idAsignacion")->result_array();
    }
    function cargarTablaPuente($tablaPuente, $tabla,$llavePrimaria,$idAsignacion)
    {
        return $this->db->query("SELECT $tablaPuente.* FROM $tablaPuente JOIN $tabla ON $tablaPuente.$llavePrimaria=$tabla.idBitacora WHERE $tabla.idAsignacion=$idAsignacion")->result_array();
    }
    function getInfoBitacora($idAsignacion, $tabla)
    {
        $consulta=$this->db->query("SELECT * FROM $tabla WHERE idAsignacion=$idAsignacion")->result_array();
        if(empty($consulta))
        {
            $this->db->insert($tabla, array('idAsignacion' => $idAsignacion));
            return $this->getInfoBitacora($idAsignacion, $tabla);
        }
            return $consulta;

    }

    function insertarDatosBitacora($dataPuente, $tabla)
    {
        $this->db->insert($tabla, $dataPuente);
    }
    function actualizarDatosBitacora($dataPuente, $idBitacora,$tabla)
    {
        $this->db->where('idBitacora', $idBitacora);
        $this->db->update($tabla, $dataPuente);
    }
    function borrarDatosBitacora($idBitacora, $tabla)
    {
        $this->db->where('idBitacora', $idBitacora);
        $this->db->delete($tabla);
    }

    function insertarResultado($tabla, $arreglo)
{
    foreach ($arreglo as $item)
    {
        $this->db->insert($tabla, $item);
    }
}
function eliminarResultado($idAsignacion, $tabla)
{
    $this->db->where('idAsignacion', $idAsignacion);
    $this->db->delete($tabla);
}
}