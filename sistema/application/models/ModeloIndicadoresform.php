<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class ModeloIndicadoresform extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        function getTotalRowAllData()
        {
            $query = $this->db->query("SELECT count(*) as row FROM formIndicador")->row_array();
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
            if($no_page == 1)
            {
                $first = 0;
                $last  = $perpage; 
            }
            else
            {
                $first = ($no_page - 1) * $perpage;
                $last  = $first + ($perpage -1);
            }
            return $this->db->query("SELECT * FROM formIndicador")->result_array();
        }

        function insertaDatos($arreglo)
        {
            $this->db->insert('formIndicador',$arreglo);
            return $this->db->insert_id();
        }

        function insertaDatosAbPC($arreglo)
        {
            $this->db->insert('abreviaturaIndicador',$arreglo);
            return $this->db->insert_id();
        }

        function insertaDatosMultiplicador($arreglo)
        {
            $this->db->insert('multiplicadorIndicador',$arreglo);
        }

        function obtenerFicha ($idIndicador)
        {
            return $this->db->query("SELECT * from formIndicador WHERE idIndicador=$idIndicador")->row();
        }

        function obtenerResultado($idIndi)
        { 
            $this->db->select('formIndicador.*, abreviaturaIndicador.*, multiplicadorIndicador.*');
            $this->db->from('formIndicador');
            $this->db->join('abreviaturaIndicador','formIndicador.idIndicador=abreviaturaIndicador.idIndicador','left');
            $this->db->join('abreviaturaPc','abreviaturaPc.idAbreviaturaPc=abreviaturaIndicador.idAbreviaturaPc','left');
            $this->db->join('multiplicadorIndicador','multiplicadorIndicador.idIndicador=formIndicador.idIndicador','left');
            $this->db->where('formIndicador.idIndicador',$idIndi);
            
            $resultado = $this->db->get();
            return $resultado->row_array();
        }

        function modificarDatos($arreglo,$idIndicador)
        { 
            $this->db->where('idIndicador', $idIndicador);
            $this->db->update('formIndicador', $arreglo); 
        }

        function modificarDatosAbPC($arreglo,$idIndicador)
        { 
            $this->db->where('idIndicador', $idIndicador);
            $this->db->update('abreviaturaIndicador', $arreglo); 
        }

        function modificaDatosMultiplicador($arreglo,$idIndicador)
        { 
            $this->db->where('idIndicador', $idIndicador);
            $this->db->update('multiplicadorIndicador', $arreglo); 
        }

        function verificarExistenciaAbreviatura($idIndicador)
        {
            $this->db->select('*');
            $this->db->from('abreviaturaIndicador');
            $this->db->where('idIndicador',$idIndicador);

            $resultado = $this->db->get();
            return $resultado->num_rows();
        }

        function verificarExistenciaMultiplicador($idIndicador)
        {
            $this->db->select('*');
            $this->db->from('multiplicadorIndicador');
            $this->db->where('idIndicador',$idIndicador);

            $resultado = $this->db->get();
            return $resultado->num_rows();
        }

        /*function modificaDatosPuente($data2,$idUser)
        { 
          $this->db->where('idUsuario', $idUser);
          $this->db->update('Logeo', $data2); 
        }*/

        function borrarDatos($idIndicador)
        { 
            $this->db->where('idIndicador', $idIndicador);
            $this->db->delete('formIndicador'); 
        }

        function eliminarAbreviaturaIndicador($idIndicador)
        { 
            $this->db->where('idIndicador', $idIndicador);
            $this->db->delete('abreviaturaIndicador'); 
        }

        function eliminarMultiplicadorIndicador($idIndicador)
        { 
            $this->db->where('idIndicador', $idIndicador);
            $this->db->delete('multiplicadorIndicador'); 
        }

        /*function borrarDatospuente($id)
        { 
            $this->db->where('idUsuario', $id);
            $this->db->delete('Logeo'); 
        }*/

        function getListadoPondInf($indicador)
        {
            return $this->db->query("SELECT formPondInd.idControl,formPonderador.nombrePonderador FROM formPondInd JOIN formPonderador ON formPondInd.idPonderador=formPonderador.idPonderador WHERE formPondInd.idIndicador=$indicador")->result_array();
        }

        function getListaTododlistadoponderador()
        {
            return $this->db->query("SELECT * FROM formPonderador")->result_array();
        }

        function insertaDatosPuente($data2)
        {
            $this->db->insert('formPondInd',$data2);
        }

        function borrarDatosindicabReq($id)
        {
            $this->db->where('idControl', $id);
            $this->db->delete('formPondInd');
        }

        function get_abreviaturaPc()
        {
            $this->db->select('*');
            $this->db->from('abreviaturaPc');
            
            $resultado = $this->db->get();
            return $resultado->result_array();
        }

        function get_abreviaturaIndicador()
        {
            $this->db->select('abreviaturaIndicador.IdAbIndicador, formIndicador.nombreIndicador');
            $this->db->from('abreviaturaIndicador');
            $this->db->join('formIndicador','formIndicador.idIndicador=abreviaturaIndicador.idIndicador');
            
            $resultado = $this->db->get();
            return $resultado->result_array();
        }
    }
?>