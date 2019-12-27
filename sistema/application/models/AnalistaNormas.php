<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnalistaNormas extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }


    function getTotalRowAllData($idOti)
    {
        $query = $this->db->query("SELECT count(*) as row FROM asignaInmueble WHERE asignaInmueble.idOti=$idOti")->row_array();
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


    function getDatosOti($no_page, $usuario, $idOti)
    {
        return $this->db->query("SELECT Subservicios.idSubservicio, Subservicios.nombre as nombreNorma, asignaInmueble.idProyecto, CentrosDeTrabajo.*, asignaInmueble.idAsignacion,asignaInmueble.idOti FROM CentrosDeTrabajo JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario=Usuario.idUsuario JOIN Logeo ON Usuario.idUsuario=Logeo.idUsuario join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio=serviciosSubservicios.idSubservicio WHERE asignaInmueble.idOti=$idOti AND Logeo.idUsuario=$usuario ")->result_array();
    }
    function getDatosCumplimiento($no_page, $usuario, $idOti)
    {
        return $this->db->query("SELECT Subservicios.idSubservicio, Subservicios.nombre as nombreNorma, asignaInmueble.idProyecto, CentrosDeTrabajo.idCentroTrabajo, asignaInmueble.idAsignacion,asignaInmueble.idProyecto, asignaInmueble.porcentajeValor FROM CentrosDeTrabajo JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario=Usuario.idUsuario JOIN Logeo ON Usuario.idUsuario=Logeo.idUsuario join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio=serviciosSubservicios.idSubservicio WHERE asignaInmueble.idOti=$idOti")->result_array();
    }

    function insertarRespaldoCumplimiento($respaldo)
    {
        $this->db->insert('CumplimientoTiempoNorma', $respaldo);
    }
    function borrarCumplimiento($idCumplimiento)
    {
        $this->db->where('idCumplimiento', $idCumplimiento);
        $this->db->delete("CumplimientoTiempoNorma");
    }
    function obtenerExistentes($idCentroTrabajo, $idProyecto, $year, $month)
    {
        return $this->db->query("SELECT * FROM CumplimientoTiempoNorma WHERE 
                                    idCentroTrabajo=$idCentroTrabajo AND idProyecto=$idProyecto 
                                    AND MONTH (fechaRespaldo)=$month AND YEAR (fechaRespaldo)=$year")->result_array();
    }
}