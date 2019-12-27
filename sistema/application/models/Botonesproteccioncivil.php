<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Botonesproteccioncivil extends CI_Model{
    public $variable;
	function __construct(){
		parent::__construct();
	}

	function getListadoInmueblesOti ($usuario)
    {
            return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, 
											asignaInmueble.idAsignacion, 
											asignaInmueble.idOti, 
											CentrosDeTrabajo.nombre    
											
											as nombre, Proyectos.nombreProyecto   
											as servicio, Subservicios.idSubservicio 
											as idsubser, Subservicios.nombre        
											as subservicio, asignaInmueble.porcentajeValor 
											
											FROM asignaInmueble 
											
											JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo 
											JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl 
											JOIN Subservicios ON serviciosSubservicios.idSubservicio = Subservicios.idSubservicio 
											join Proyectos on serviciosSubservicios.idServicio = Proyectos.idProyecto 
											
											join AnalistaOti on AnalistaOti.idAsignacion = asignaInmueble.idAsignacion 
											JOIN Oti ON asignaInmueble.idOti = Oti.idOti 
											
											where Proyectos.idArea = 1 
											
											AND AnalistaOti.idUsuario = ".$this->session->userdata('idusuariobase')." 
											
											AND Oti.statusActiva=1 GROUP BY asignaInmueble.idAsignacion;")->result_array();
    }
	
	function getListadoInmueblesOti2 ($usuario)
    {
            return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, 
											asignaInmueble.idAsignacion, 
											asignaInmueble.idOti, 
											CentrosDeTrabajo.nombre    
											
											as nombre, Proyectos.nombreProyecto   
											as servicio, Subservicios.idSubservicio 
											as idsubser, Subservicios.nombre        
											as subservicio, asignaInmueble.porcentajeValor 
											
											FROM asignaInmueble 
											
											JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo 
											JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl 
											JOIN Subservicios ON serviciosSubservicios.idSubservicio = Subservicios.idSubservicio 
											join Proyectos on serviciosSubservicios.idServicio = Proyectos.idProyecto 
											
											join AnalistaOti on AnalistaOti.idAsignacion = asignaInmueble.idAsignacion 
											JOIN Oti ON asignaInmueble.idOti = Oti.idOti where Proyectos.idArea=1 ")->result_array();
    }

    function cuentaTodosOtis()
    {
       return $this->db->query("SELECT COUNT(Oti.idOti) as totalPc	FROM asignaInmueble 
											
											JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo 
											JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl 
											JOIN Subservicios ON serviciosSubservicios.idSubservicio = Subservicios.idSubservicio 
											join Proyectos on serviciosSubservicios.idServicio = Proyectos.idProyecto 
											
											join AnalistaOti on AnalistaOti.idAsignacion = asignaInmueble.idAsignacion 
											JOIN Oti ON asignaInmueble.idOti = Oti.idOti where Proyectos.idArea=1 ")->result_array();
    }

    function allRi($limit,$start,$col,$dir)
    {
    	$uno=1;
        $query=$this->db->select("CentrosDeTrabajo.idCentroTrabajo, 
											asignaInmueble.idAsignacion, 
											asignaInmueble.idOti, 
											CentrosDeTrabajo.nombre    
											
											as nombre, Proyectos.nombreProyecto   
											as servicio, Subservicios.idSubservicio 
											as idsubser, Subservicios.nombre        
											as subservicio, asignaInmueble.porcentajeValor")
            ->from("asignaInmueble")
            ->join("CentrosDeTrabajo", "asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo ")
            ->join("serviciosSubservicios", "asignaInmueble.idProyecto = serviciosSubservicios.idControl")
            ->join("Subservicios", "serviciosSubservicios.idSubservicio = Subservicios.idSubservicio ")
            ->join("Proyectos", "serviciosSubservicios.idServicio = Proyectos.idProyecto ")
            ->join("AnalistaOti", "AnalistaOti.idAsignacion = asignaInmueble.idAsignacion")
            ->join("Oti", "asignaInmueble.idOti = Oti.idOti")
            ->where("Proyectos.idArea", $uno)
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

    function busquedaOtis($limit,$start,$search,$col,$dir)
    {
       $uno=1;
        $query=$this->db->select("CentrosDeTrabajo.idCentroTrabajo, 
											asignaInmueble.idAsignacion, 
											asignaInmueble.idOti, 
											CentrosDeTrabajo.nombre    
											
											as nombre, Proyectos.nombreProyecto   
											as servicio, Subservicios.idSubservicio 
											as idsubser, Subservicios.nombre        
											as subservicio, asignaInmueble.porcentajeValor")
            ->from("asignaInmueble")
            ->join("CentrosDeTrabajo", "asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo ")
            ->join("serviciosSubservicios", "asignaInmueble.idProyecto = serviciosSubservicios.idControl")
            ->join("Subservicios", "serviciosSubservicios.idSubservicio = Subservicios.idSubservicio ")
            ->join("Proyectos", "serviciosSubservicios.idServicio = Proyectos.idProyecto ")
            ->join("AnalistaOti", "AnalistaOti.idAsignacion = asignaInmueble.idAsignacion")
            ->join("Oti", "asignaInmueble.idOti = Oti.idOti")
            ->where("Proyectos.idArea", $uno)
            //->like('correoPaci',$search)
            ->or_like('nombre',$search)
            ->or_like('nombreProyecto',$search)
            ->or_like('subservicio',$search)
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

    function cuentaPacientesFiltrados($search)
    {
        $query=$this->db->select("CentrosDeTrabajo.idCentroTrabajo, 
											asignaInmueble.idAsignacion, 
											asignaInmueble.idOti, 
											CentrosDeTrabajo.nombre    
											
											as nombre, Proyectos.nombreProyecto   
											as servicio, Subservicios.idSubservicio 
											as idsubser, Subservicios.nombre        
											as subservicio, asignaInmueble.porcentajeValor")
            ->from("asignaInmueble")
            ->join("CentrosDeTrabajo", "asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo ")
            ->join("serviciosSubservicios", "asignaInmueble.idProyecto = serviciosSubservicios.idControl")
            ->join("Subservicios", "serviciosSubservicios.idSubservicio = Subservicios.idSubservicio ")
            ->join("Proyectos", "serviciosSubservicios.idServicio = Proyectos.idProyecto ")
            ->join("AnalistaOti", "AnalistaOti.idAsignacion = asignaInmueble.idAsignacion")
            ->join("Oti", "asignaInmueble.idOti = Oti.idOti")
            ->where("Proyectos.idArea", $uno)
            //->like('correoPaci',$search)
            ->or_like('nombre',$search)
            ->or_like('nombreProyecto',$search)
            ->or_like('subservicio',$search)
            ->limit($limit,$start)
            ->order_by($col,$dir)
            ->get();

        return $query->num_rows();
    }
   

}