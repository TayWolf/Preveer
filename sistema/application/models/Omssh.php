<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Omssh extends CI_Model
{
    public $variable;

    function __construct()
    {
        parent::__construct();
    }


    function getTotalRowAllData()
    {

        $query = $this->db->query("SELECT COUNT(DISTINCT(CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')'))) as row FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion")->row_array();
        return $query['row'];
    }

    function getDatosCentroTrabajo($idAsignacion)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.nombre as nombreSucursal,CentrosDeTrabajo.idDet as numeroSucursal FROM CentrosDeTrabajo join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo where asignaInmueble.idAsignacion=$idAsignacion")->row_array();
    }

    function borrarOMSS($idOm)
    {
        $this->db->where('idOMSSH', $idOm);
        $this->db->delete("OMSSH");
    }

    function idCentro($idAsignacion)
    {
        return $this->db->query("SELECT * FROM `asignaInmueble` WHERE `idAsignacion`=$idAsignacion")->result_array();
    }

     function getUser($idUse)
    {
        return $this->db->query("SELECT * FROM Usuario where idUsuario=$idUse")->row_array();
    }

    function data_pagination($url, $rows = 5, $uri = 3)
    {
        $this->load->library('pagination');
        $config['per_page'] = 10;
        $config['first_link'] = 'Primero';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Último';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['base_url'] = site_url($url);
        $config['total_rows'] = $rows;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = $uri;
        $config['num_links'] = 5;
        $config['attributes'] = array('class' => 'waves-effect');
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = '<i class="material-icons">chevron_right</i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '<i class="material-icons">chevron_left</i>';
        $config['cur_tag_open'] = '<li class=active><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        // untuk config class pagination yg lainnya optional (suka2 lu.. :D )

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    function getDatos($idUsuario,$tipoUsuario)
    {
        if($tipoUsuario==3)
            return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') AS nombre, asignaInmueble.idAsignacion FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE Oti.statusActiva=1 GROUP BY asignaInmueble.idOti, CentrosDeTrabajo.idCentroTrabajo ORDER BY Oti.idOti DESC;")->result_array();
        else
            return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') AS nombre, asignaInmueble.idAsignacion FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE AnalistaOti.idUsuario = $idUsuario AND Oti.statusActiva=1 GROUP BY asignaInmueble.idOti, CentrosDeTrabajo.idCentroTrabajo ORDER BY Oti.idOti DESC; ")->result_array();

    }
    function insertarOportunidadMejora($arreglo)
    {
        $this->db->insert('OMSSH', $arreglo);
        return $this->db->insert_id();
    }
    function getAreasUbicacion()
    {
        return $this->db->query("SELECT * FROM areaClubesSW")->result_array();
    }

    function obtenerProri()
    {
        return $this->db->query("SELECT * FROM prioridadIntervencion")->result_array();
    }

    function obtenerTabla($idCentro)
    {
        return $this->db->query("SELECT OMSSH.*, areaClubesSW.descripcion as area, prioridadIntervencion.nombre as nombrePrioridad, prioridadIntervencion.color as colorPrioridad FROM OMSSH LEFT JOIN areaClubesSW ON OMSSH.idArea=areaClubesSW.idArea LEFT join prioridadIntervencion on prioridadIntervencion.idPrioridad=OMSSH.idPrioridadIntervencion join asignaInmueble on asignaInmueble.idAsignacion=OMSSH.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo WHERE CentrosDeTrabajo.idCentroTrabajo=$idCentro")->result_array();
    }
    function getFotosOMSSHI($idOMSSH)
    {
        return $this->db->query("SELECT * FROM OMSSH WHERE idOMSSH=$idOMSSH")->result_array();
    }
    function getFotoBuena($idOMSSH)
    {
        return $this->db->query("SELECT OMSSH.fotoCorreccion0, OMSSH.fotoCorreccion1 FROM OMSSH WHERE idOMSSH=$idOMSSH")->result_array();
    }
    function getFotoMala($idOMSSH)
    {
        return $this->db->query("SELECT OMSSH.fotoMal0, OMSSH.fotoMal1 FROM OMSSH WHERE idOMSSH=$idOMSSH")->result_array();
    }
    function actualizarImagen($idOmssh, $data, $tabla)
    {
        $this->db->where('idOMSSH', $idOmssh);
        $this->db->update($tabla, $data);
    }
    function actualizarOMSSH($idOMSSH, $item)
    {
        $this->db->where('idOMSSH', $idOMSSH);
        $this->db->update('OMSSH', $item);
    }
    function borrarFoto($nombreCampo, $idOMSSH)
    {
        $row= $this->db->query("SELECT $nombreCampo FROM OMSSH WHERE idOMSSH=$idOMSSH")->row_array();
        $this->db->where('idOMSSH', $idOMSSH);
        $this->db->update('OMSSH', array("$nombreCampo" => ""));
        return $row["$nombreCampo"];
    }
    function obtenercoloresIntervencion()
    {
        return $this->db->query("SELECT * FROM prioridadIntervencion")->result_array();
    }
    function insertOportunidadMejoraBitacora($arreglo)
    {
        $this->db->insert('OMSSH', $arreglo);
        return $this->db->insert_id();
    }

    function guardarHistorico($data)
    {
        $this->db->insert('CumplimientoOMSSHTiempo', $data);
        return $this->db->insert_id();

    }


}