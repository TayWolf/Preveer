<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DocumentosNormasArnes extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM indicadorSshi")->row_array();
        return $query['row'];
    }

    function data_pagination($url, $rows = 5, $uri = 3)
    {
        $this->load->library('pagination');
        $config['per_page']   = 10;
        $config['first_link'] = 'Primero';
        $config['last_link'] = 'Último';
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
        return $this->db->query("SELECT indicadorSshi.*,grupoSshi.nombreGrupo FROM `indicadorSshi` join grupoSshi on indicadorSshi.idGrupo=grupoSshi.idGrupo")->result_array();
    }
    function obtenerFicha($idDocSTPS)
    {
        return $this->db->query("SELECT indicadorSshi.*, Areas.idArea, Subservicios.idSubservicio FROM indicadorSshi JOIN Subservicios ON Subservicios.idSubservicio=DocNormas.idNorma JOIN serviciosSubservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio JOIN Proyectos ON Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Areas ON Areas.idArea=Proyectos.idArea WHERE idDocSTPS=$idDocSTPS GROUP BY idDocSTPS")->result_array();

    }


    function getSubAreas()
    {
        return $this->db->query("SELECT * FROM grupoSshi")->result_array();

    }
    function getNormas($idIndicador)
    {
        return $this->db->query("SELECT * from indicadorSshi where idIndicador = $idIndicador")->row();

    }


    function insertaDatos($data)
    {
        $this->db->insert('indicadorSshi', $data);

    }

     //Mostras los datos en el formulario de modificar en el crud
    function  obtenerDocumento($idDocSTPS)
    {
        return $this->db->query("SELECT indicadorSshi.texto,SubArea.nombreSubArea,SubArea.idSubArea,Normas.nomNorma,Normas.idNorma FROM indicadorSshi JOIN Normas ON indicadorSshi.idNorma=Normas.idNorma JOIN SubArea ON Normas.idSubArea=SubArea.idSubArea WHERE indicadorSshi.idDocSTPS=$idDocSTPS")->row();

    }

    /*function obtenerIdUser($nombreIden,$direccion)
    {
        /*$this -> db -> select('*');
      $this->db->from('Usuario');
      $this->db->where('nombre',$nombreIden);
       $this->db->where('direccion',$direccion);
      $query = $this->db->get();
      return $query->row();
        return $this->db->query("SELECT * from Usuario where nombre='$nombreIden' and direccion ='$direccion'; ")->result_array();



    }*/

    function modificaDatos($data,$idInci)
    {
        $this->db->where('idIndicador', $idInci);
        $this->db->update('indicadorSshi', $data);

    }

/*
    function modificaDatosPuente($data2,$idUser)
    {
        $this->db->where('idUsuario', $idUser);
        $this->db->update('Logeo', $data2);

    }*/

    function borrarDatos($idDocSTPS)
    {
        $this->db->where('idIndicador', $idDocSTPS);
        $this->db->delete('indicadorSshi');
    }
    //   function borrarDatospuente($id)
    // {
    //   $this->db->where('idUsuario', $id);
    //   $this->db->delete('Logeo');
    //   }




}