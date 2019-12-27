<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CentrosTrabajo extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM CentrosDeTrabajo")->row_array();
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
        $perpage = 20; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        return $this->db->query("SELECT CentrosDeTrabajo.*, Formato.nombre as nombreFormato FROM CentrosDeTrabajo JOIN Formato on CentrosDeTrabajo.idFormato = Formato.idFormato")->result_array();
    }

    function insertaDatos($data)
    {
        $this->db->insert('CentrosDeTrabajo', $data);

    }
	
	function obtenerCentro($idFormato,$idInmueble,$nombreCentro)
	{
		 return $this->db->query("SELECT * FROM `CentrosDeTrabajo` WHERE `nombre`= '$nombreCentro' AND `idFormato` = $idFormato AND `idInmueble` = $idInmueble")->row();
		
	}


    function obtenerFicha ($idCentroTrabajo){
        // return $this->db->query("SELECT * from Formato where idFormato=$idFormato ")->row();
        return $this->db->query("SELECT CentrosDeTrabajo.*, municipios.nombreMunicipio, municipios.idMunicipio, estados.nombreEstado, estados.id_Estado, regiones.nombreRegion, LPAD(regiones.cp, 5, 0) as cp, Formato.razonSocial FROM CentrosDeTrabajo LEFT JOIN regiones  on CentrosDeTrabajo.idColonia = regiones.idRegiones LEFT JOIN municipios on regiones.municipio = municipios.idMunicipio LEFT JOIN estados on municipios.estado = estados.id_Estado LEFT JOIN Formato on CentrosDeTrabajo.idFormato = Formato.idFormato WHERE idColonia = idRegiones AND regiones.municipio = municipios.idMunicipio AND municipios.estado = estados.id_Estado AND idCentroTrabajo = $idCentroTrabajo")->row();
    }


    function obtenerFichaPDF($idCentroTrabajo){
        return $this->db->query("SELECT CentrosDeTrabajo.* FROM CentrosDeTrabajo, municipios, estados, regiones WHERE idColonia=idRegiones AND regiones.municipio=municipios.idMunicipio AND municipios.estado=estados.id_Estado AND idCentroTrabajo=$idCentroTrabajo")->result_array();
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

    function modificaDatos($data,$idCentroTrabajo)
    {
        $this->db->where('idCentroTrabajo', $idCentroTrabajo);
        $this->db->update('CentrosDeTrabajo', $data);

    }
    function modificaFormato($data,$idFormato)
    {
        $this->db->where('idFormato', $idFormato);
        $this->db->update('Formato', $data);

    }



    function borrarDatos($idCentroTrabajo)
    {
        $this->db->where('idCentroTrabajo', $idCentroTrabajo);
        $this->db->delete('CentrosDeTrabajo');
    }

    function formatoGet ()
    {
        return $this->db->query("SELECT * from Formato")->result_array();
    }
    function inmuebleGet()
    {
        return $this->db->query("SELECT * from inmuebles")->result_array();
    }
    function getEstados()
    {
        return $this->db->query("SELECT * FROM estados")->result_array();
    }
    function getMunicipios($idEstado)
    {
        return $this->db->query("SELECT * FROM municipios WHERE estado=".$idEstado)->result_array();
    }
    function getRegiones($idMunicipio)
    {
        return $this->db->query("SELECT * FROM regiones WHERE municipio= $idMunicipio ORDER BY `regiones`.`nombreRegion` ASC")->result_array();
    }

    function getCodigoPostal($idColonia)
    {
        return $this->db->query("SELECT LPAD(cp, 5, 0) as cp FROM regiones WHERE idRegiones=".$idColonia)->result_array();
    }
    function getNombreAtendioVisita($idAsignacion)
    {
        return $this->db->query("SELECT nombreAtendioVisita FROM asignaInmueble WHERE idAsignacion=$idAsignacion")->row_array();
    }
    function cambiarNombreAtendioVisita($data, $idAsignacion)
    {
        $this->db->where("idAsignacion" ,$idAsignacion);
        $this->db->update("asignaInmueble", $data);
    }
    function buscarInmueble($tipoInmueble)
    {
        $this->db->select("idInmueble");
        $this->db->from("inmuebles");
        $this->db->like("nombreInmueble", $tipoInmueble, 'both');
        $idArray=$this->db->get()->row_array();
        return $idArray['idInmueble'];
    }

    function buscarFormato($formato)
    {
        $this->db->select("idFormato");
        $this->db->from("Formato");
        $this->db->like("CONCAT(nombre, ' (',razonSocial,')')", $formato, 'both');
        $idArray=$this->db->get()->row_array();
        return $idArray['idFormato'];
    }

    function getExistente($idFormato,$idinmueble,$nombreCentro)
    {
        $this->db->select("idCentroTrabajo");
        $this->db->from("CentrosDeTrabajo");
        $this->db->where("nombre",$nombreCentro);
        $this->db->where("idInmueble",$idinmueble);
        $this->db->where("idFormato",$idFormato);

       // $this->db->like("CONCAT(nombre, ' (',razonSocial,')')", $formato, 'both');
        $idArray=$this->db->get()->row_array();
        return $idArray['idCentroTrabajo'];
    }
    function buscarColonia($codigoPostal, $nombreColonia)
    {
        $this->db->select("idRegiones, nombreRegion");
        $this->db->from("regiones");
        $this->db->where("cp",$codigoPostal);
        $array=$this->db->get()->result_array();
        $distancia=9999999999;
        $idArray=array('idRegiones' => null);

        for ($x=0; $x<sizeof($array); $x++)
        {
            $distancia2=levenshtein($array[$x]['nombreRegion'], $nombreColonia, 1, 2, 1);
            if($distancia2<$distancia && $distancia2>=0)
            {
                $distancia=$distancia2;
                $idArray=$array[$x];
            }
        }
        return $idArray['idRegiones'];
    }





}