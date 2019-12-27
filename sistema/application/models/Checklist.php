<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checklist extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }







    function getDatosCoor($no_page, $idCoor)// no borrar
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        return $this->db->query("SELECT Clientes.nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti WHERE Oti.idCoordinador = $idCoor GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC limit 10 offset $first")->result_array();
    }

    function getPorcetajeValor($idSubservicio,$idCentroTrabajo){
        $valorP= $this->db->query("select asignaInmueble.idOti,asignaInmueble.porcentajeValor from asignaInmueble JOIN serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto where asignaInmueble.idCentroTrabajo=$idCentroTrabajo and serviciosSubservicios.idSubservicio=$idSubservicio ORDER BY `asignaInmueble`.`idOti` DESC")->row_array();
        if (empty($valorP)) {
           return 0;
        }
        return $valorP['porcentajeValor'];
        
    }



    function getDoctosEstado($idAsignacion,$idSubsee)// no borrar
    {
        return $this->db->query("SELECT DocNormas.*, Subservicios.nombre FROM DocNormas, Subservicios WHERE idSubservicio=(SELECT Subservicios.idSubservicio FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia JOIN municipios ON regiones.municipio=municipios.idMunicipio JOIN estados ON municipios.estado=estados.id_Estado WHERE idAsignacion=$idAsignacion) AND DocNormas.idNorma=Subservicios.idSubservicio and DocNormas.idNorma=$idSubsee")->result_array();
    }
    function getPonderadores()// no borrar
    {
        return $this->db->query("SELECT * FROM ponderadoresIndicadores")->result_array();
    }
    function cargarEvaluaciones($idAsignacion, $idCentroTrabajo)//no borrar
    {
        return $this->db->query("SELECT IndicadoresValor.* FROM IndicadoresValor JOIN asignaInmueble a on IndicadoresValor.idAsignacion = a.idAsignacion JOIN CentrosDeTrabajo C2 on a.idCentroTrabajo = C2.idCentroTrabajo WHERE C2.idCentroTrabajo=$idCentroTrabajo")->result_array();
        //return $this->db->query("SELECT IndicadoresValor.* FROM IndicadoresValor WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function cargarResultadosPDF($idCentroTrabajo, $idSubservicio)
    {
        return $this->db->query("SELECT Norma.idDocSTPS, Norma.texto as nombreDocumento,Norma.tipo, IndicadoresVal.idPonderador, IndicadoresVal.comentario FROM DocNormas Norma LEFT JOIN (SELECT IndicadoresValor.* FROM IndicadoresValor INNER JOIN asignaInmueble a on IndicadoresValor.idAsignacion = a.idAsignacion INNER JOIN CentrosDeTrabajo C2 on a.idCentroTrabajo = C2.idCentroTrabajo INNER JOIN serviciosSubservicios ON a.idProyecto = serviciosSubservicios.idControl INNER JOIN Subservicios S on serviciosSubservicios.idSubservicio = S.idSubservicio WHERE C2.idCentroTrabajo = $idCentroTrabajo AND S.idSubservicio = $idSubservicio) IndicadoresVal ON IndicadoresVal.idDocumentoSTPS=Norma.idDocSTPS WHERE Norma.idNorma=$idSubservicio")->result_array();
    }








    function getTotalRowAllData()// no borrar
    {
        $query = $this->db->query("SELECT count(*) as row FROM Oti")->row_array();
        return $query['row'];
    }




    function insertaDatosPuenteEntrega($data)// no borrar
    {
        $this->db->insert('IndicadoresValor', $data);
        //echo json_encode($data);altaUser
    }



    //Obtenemos el listado de todos los analistas del sistema
    function getListadoAnalistas ()// no borrar
    {
        return $this->db->query("SELECT Usuario.idUsuario,Usuario.nombre FROM Usuario join Logeo on Logeo.idUsuario=Usuario.idUsuario WHERE Logeo.tipo=4")->result_array();
    }


    function getListadoInmueblesOti ($idOti)///no borrar
    {
        return $this->db->query("SELECT asignaInmueble.idAsignacion,asignaInmueble.idOti, CentrosDeTrabajo.nombre as nombre, Proyectos.nombreProyecto as servicio, Subservicios.nombre as subservicio, asignaInmueble.porcentajeValor FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Subservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio join Proyectos on serviciosSubservicios.idServicio=Proyectos.idProyecto WHERE asignaInmueble.idOti=$idOti")->result_array();
    }

    function actualizarPorcentaje($idAsignacion, $data, $valido)// no borrar
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('asignaInmueble', $data);

    }

    function borrarDatosPuenteEntrega($idAsignacion, $idCentroTrabajo)// no borrar
    {
        $this->db->query("DELETE FROM IndicadoresValor WHERE idAsignacion=$idAsignacion");
    }


    function data_pagination($url, $rows = 5, $uri = 3)// no brrar
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

    public function checkVisitas($idOti)// no borrar
    {
        return $this->db->query("SELECT VisitasInmueble.idVisita, VisitasInmueble.idAsignacion, VisitasInmueble.tipoVisita FROM VisitasInmueble JOIN asignaInmueble ON VisitasInmueble.idAsignacion = asignaInmueble.idAsignacion WHERE asignaInmueble.idOti=$idOti AND VisitasInmueble.tipoVisita = 1 AND VisitasInmueble.idAsignacion = asignaInmueble.idAsignacion ")->result_array();
    }

    public function checkVisitasDocs($idOti)// no borrar
    {
        return $this->db->query("SELECT VisitasInmueble.tipoVisita FROM VisitasInmueble JOIN asignaInmueble ON VisitasInmueble.idAsignacion = asignaInmueble.idAsignacion WHERE asignaInmueble.idOti=$idOti AND VisitasInmueble.tipoVisita = 2")->num_rows();
    }

    public function getIdCentroTrabajo($idAsignacion)
    {
        return $this->db->query("SELECT idCentroTrabajo FROM asignaInmueble WHERE idAsignacion=$idAsignacion")->row_array();
    }
}