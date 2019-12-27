<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeloReporteSSHL extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM  Reportes_SSHL")->row_array();
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

        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        return $this->db->query("SELECT * FROM  Reportes_SSHL")->result_array();
    }


    function insertaDatos($arreglo)
    {
        $this->db->insert(' Reportes_SSHL',$arreglo);
    }

    function obtenerFicha ($idReporte){
        return $this->db->query("SELECT * from  Reportes_SSHL where idReporte=idReporte ")->row();
    }

    function obtenerResultado($idIndi)
    {

        return $this->db->query("select * from  Reportes_SSHL where idReporte=$idIndi")->row();

    }

    function modificaDatos($arreglo,$idReporte)
    {
        $this->db->where('idReporte', $idReporte);
        $this->db->update(' Reportes_SSHL', $arreglo);

    }


    function borrarDatos($idReporte)
    {
        $this->db->where('idReporte', $idReporte);
        $this->db->delete(' Reportes_SSHL');
    }



    function getListadoApartado($idReporte)
    {
        return $this->db->query("select  Reporte_ApartadoReporte.posicion,ApartadoReporte.nombre FROM  Reporte_ApartadoReporte join ApartadoReporte on  Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte where  Reporte_ApartadoReporte.idReporte=$idReporte")->result_array();
    }

    function getListaTodolistaApartado()
    {
        return $this->db->query("SELECT * FROM `ApartadoReporte`")->result_array();
    }

    function insertaDatosPuente($data2)
    {

        $this->db->insert(' Reporte_ApartadoReporte',$data2);
    }


    function borrarDatosindicabReq($id)
    {
        $this->db->where('posicion', $id);
        $this->db->delete(' Reporte_ApartadoReporte');
    }
    function obtenerApartadosReporte($idReporte)
    {
        return $this->db->query("SELECT Reporte_ApartadoReporte.*, ApartadoReporte.nombre, ApartadoReporte.descripcion  FROM Reporte_ApartadoReporte JOIN ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte WHERE Reporte_ApartadoReporte.idReporte=$idReporte ORDER BY Reporte_ApartadoReporte.posicion")->result_array();
    }
    function obtenerApartadosReporteRestantes()
    {
        return $this->db->query("SELECT ApartadoReporte.* FROM ApartadoReporte")->result_array();
    }
    function borrarApartados($idReporte)
    {
        $this->db->where('idReporte', $idReporte);
        $this->db->delete('Reporte_ApartadoReporte');
    }
    function insertApartado($data)
    {
        $this->db->insert('Reporte_ApartadoReporte',$data);
    }
    function obtenerPosicionCorreccion($idReporte)
    {
        $arreglo=$this->db->query("SELECT posicionCorreccion FROM Reportes_SSHL WHERE idReporte=$idReporte")->result_array();
        return $arreglo[0]['posicionCorreccion'];
    }
    function guardarPosicion($idReporte, $posicion)
    {
        $this->db->where('idReporte', $idReporte);
        $this->db->update(' Reportes_SSHL', $posicion);
    }
}