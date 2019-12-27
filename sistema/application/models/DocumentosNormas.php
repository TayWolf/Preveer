<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DocumentosNormas extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM DocNormas")->row_array();
        return $query['row'];
    }

    function getFilterRowData($data)
    {
        $query = $this->db->query("SELECT count(*) AS row FROM DocNormas WHERE DocNormas.texto LIKE '%".$data."%'")->row_array();
        return $query['row'];
    }

    function data_pagination($url, $rows = 5, $uri = 3)
    {
        $this->load->library('pagination');
        $config['per_page']   = 20;
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


        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }


    function getDatos($no_page)
    {
        /*$perpage = 20; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }*/
        return $this->db->query("SELECT DocNormas.*, Areas.nombreArea, Subservicios.nombre FROM DocNormas JOIN Subservicios ON Subservicios.idSubservicio=DocNormas.idNorma JOIN serviciosSubservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio JOIN Proyectos ON Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Areas ON Areas.idArea=Proyectos.idArea GROUP BY idDocSTPS ")->result_array();
    }

    function getDatosRestantes()
    {
        $num_rows = $this->db->get("DocNormas")->num_rows();
        return $this->db->query("SELECT DocNormas.*, Areas.nombreArea, Subservicios.nombre FROM DocNormas JOIN Subservicios ON Subservicios.idSubservicio=DocNormas.idNorma JOIN serviciosSubservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio JOIN Proyectos ON Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Areas ON Areas.idArea=Proyectos.idArea GROUP BY idDocSTPS LIMIT 1001,$num_rows")->result_array();
    }

    function cuentaTodosDocumentos()
    {
        return $this->db->get('DocNormas')->num_rows();
    }

    function allDocumentos($limit,$start,$col,$dir)
    {
        $query=$this->db->select("DocNormas.*, Areas.nombreArea, Subservicios.nombre")
            ->from("DocNormas")
            ->join("Subservicios", "Subservicios.idSubservicio=DocNormas.idNorma")
            ->join("serviciosSubservicios", "serviciosSubservicios.idSubservicio=Subservicios.idSubservicio")
            ->join("Proyectos", "Proyectos.idProyecto=serviciosSubservicios.idServicio")
            ->join("Areas", "Areas.idArea=Proyectos.idArea")
            ->limit($limit,$start)
            ->group_by('idDocSTPS')
            ->order_by($col,$dir)
            ->get();

        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    function busquedaDocumentos($limit,$start,$search,$col,$dir)
    {
        $query = $this->db->select("DocNormas.*, Areas.nombreArea, Subservicios.nombre")
            ->from("DocNormas")
            ->join("Subservicios", "Subservicios.idSubservicio=DocNormas.idNorma")
            ->join("serviciosSubservicios", "serviciosSubservicios.idSubservicio=Subservicios.idSubservicio")
            ->join("Proyectos", "Proyectos.idProyecto=serviciosSubservicios.idServicio")
            ->join("Areas", "Areas.idArea=Proyectos.idArea")
            ->like('texto',$search)
            ->or_like('nombreArea',$search)
            ->or_like('nombre',$search)
            // ->or_like('precioPublico',$search)
            // ->or_like('Empresas.RFC',$search)
            ->limit($limit,$start)
            ->order_by($col,$dir)
            ->get();


        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

    function cuentaDocumentoFiltrados($search)
    {
        $query = $this
            ->db->select("DocNormas.*, Areas.nombreArea, Subservicios.nombre")
            ->from("DocNormas")
            ->join("Subservicios", "Subservicios.idSubservicio=DocNormas.idNorma")
            ->join("serviciosSubservicios", "serviciosSubservicios.idSubservicio=Subservicios.idSubservicio")
            ->join("Proyectos", "Proyectos.idProyecto=serviciosSubservicios.idServicio")
            ->join("Areas", "Areas.idArea=Proyectos.idArea")
            ->like('texto',$search)
            ->or_like('nombreArea',$search)
            ->or_like('nombre',$search)
            // ->or_like('precioPublico',$search)
            // ->or_like('Empresas.RFC',$search)
            ->get();

        return $query->num_rows();
    }


    function obtenerFicha($idDocSTPS)
    {
        return $this->db->query("SELECT DocNormas.*, Areas.idArea, Subservicios.idSubservicio FROM DocNormas JOIN Subservicios ON Subservicios.idSubservicio=DocNormas.idNorma JOIN serviciosSubservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio JOIN Proyectos ON Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Areas ON Areas.idArea=Proyectos.idArea WHERE idDocSTPS=$idDocSTPS GROUP BY idDocSTPS")->result_array();
    }


    function getSubAreas()
    {
        return $this->db->query("SELECT * FROM Areas")->result_array();

    }
    function getNormas($idSubArea)
    {
        return $this->db->query("SELECT Subservicios.* FROM Subservicios JOIN serviciosSubservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio JOIN Proyectos ON Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Areas ON Areas.idArea=Proyectos.idArea WHERE Areas.idArea=$idSubArea GROUP BY idSubservicio")->result_array();

    }


    function insertaDatos($data)
    {
        $this->db->insert('DocNormas', $data);

    }
/*    function insertaDatosPuent($data2)
    {
        $this->db->insert('Logeo', $data2);
    }*/

   /* function obtenerDocumento($idDocSTPS){ //ficha
        return $this->db->query("SELECT * from DocNormas where idDocSTPS=$idDocSTPS ")->row();
    }*/
     //Mostras los datos en el formulario de modificar en el crud
    function  obtenerDocumento($idDocSTPS)
    {
        return $this->db->query("SELECT DocNormas.texto,SubArea.nombreSubArea,SubArea.idSubArea,Normas.nomNorma,Normas.idNorma FROM DocNormas JOIN Normas ON DocNormas.idNorma=Normas.idNorma JOIN SubArea ON Normas.idSubArea=SubArea.idSubArea WHERE DocNormas.idDocSTPS=$idDocSTPS")->row();

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

    function modificaDatos($data,$idDocSTPS)
    {
        $this->db->where('idDocSTPS', $idDocSTPS);
        $this->db->update('DocNormas', $data);

    }

/*
    function modificaDatosPuente($data2,$idUser)
    {
        $this->db->where('idUsuario', $idUser);
        $this->db->update('Logeo', $data2);

    }*/

    function borrarDatos($idDocSTPS)
    {
        $this->db->where('idDocSTPS', $idDocSTPS);
        $this->db->delete('DocNormas');
    }
    //   function borrarDatospuente($id)
    // {
    //   $this->db->where('idUsuario', $id);
    //   $this->db->delete('Logeo');
    //   }




}