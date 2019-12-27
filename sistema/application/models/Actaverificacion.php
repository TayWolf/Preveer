<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actaverificacion extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM Usuario")->row_array();
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
        return $this->db->query("SELECT Logeo.*, Areas.nombreArea as areaUser FROM Logeo JOIN Usuario ON Logeo.idUsuario = Usuario.idUsuario JOIN Areas ON Areas.idArea=Usuario.areaUser")->result_array();
    }
    function retornarFotoPK($llavePrimaria, $tabla, $campoPK)
    {
        return $this->db->query("SELECT * FROM $tabla WHERE $campoPK = $llavePrimaria")->result_array();
    }

    function verificarExistenciaActa($idAsignacion)
    {
        return $this->db->query("SELECT actaVerificacion.*, Formato.razonSocial, Formato.rfc,
                                  CONCAT(CentrosDeTrabajo.calle, ' # ', CentrosDeTrabajo.numeroExterior, ', Colonia ', regiones.nombreRegion, '. ',
                                         municipios.nombreMunicipio, ', ', estados.nombreEstado, '.') as domicilioFiscal, CONCAT('C.P. ', regiones.cp) as CP
                                FROM actaVerificacion
                                  JOIN asignaInmueble ON actaVerificacion.idAsignacion = asignaInmueble.idAsignacion
                                  join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo
                                  JOIN Formato on Formato.idFormato = CentrosDeTrabajo.idFormato
                                  JOIN regiones ON CentrosDeTrabajo.idColonia = regiones.idRegiones
                                  JOIN municipios ON regiones.municipio = municipios.idMunicipio
                                  JOIN estados ON municipios.estado = estados.id_Estado
                                WHERE asignaInmueble.idAsignacion = $idAsignacion;")->result_array();
    }

    function getCatalogoActa()
    {
        return $this->db->query("SELECT CatalogoHidraulica.* FROM CatalogoHidraulica")->result_array();
    }

    function nuevaExistenciaActa($idAsignacion)
    {
        $data=Array(
            'idAsignacion' => $idAsignacion,
            'ciudadEstado'=> null,
            'hora'=> null,
            'registroPatronal'=>null,
            'descripcionEmpresa'=>null,
            'nEmpleado'=>null,
            'CP'=>null,
            'horaDos'=>null,
            'reprePatronCor'=>null,
            'reprePatroSecrer'=>null,
            'reprePatronVocal'=>null,
            'repreTrabaVocal'=>null,
            'reprePatronVocalDos'=>null,
            'RepreTrabaVocalDos'=>null

        );
        $this->db->insert('actaVerificacion', $data);
    }

    function actualizarDatosActa($datosActa, $idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('actaVerificacion', $datosActa);
    }

    function insertaDatosAcPuente($datosActaP)
    {
        $this->db->insert('actaPuente', $datosActaP);
        return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
    }

    function getTipoPuente($idAsignacion)
    {
        return $this->db->query("SELECT * FROM actaPuente where idAsignacion= $idAsignacion")->result_array();
    }

    function getTipoPuenteEvi($idAsignacion)
    {
        return $this->db->query("SELECT * FROM actaPuenteEvi where idAsignacion= $idAsignacion")->result_array();
    }

    function getTipoPuenteInca($idAsignacion)
    {
        return $this->db->query("SELECT * FROM actaIncaPuente where idAsignacion= $idAsignacion")->result_array();
    }

    
    function getDatosCentroTrabajoWord($idAsignacion)
       {
           return $this->db->query("SELECT CentrosDeTrabajo.*, regiones.nombreRegion, municipios.nombreMunicipio, estados.nombreEstado, Formato.razonSocial, Formato.foto, U.nombre as nombreUsuario  FROM CentrosDeTrabajo JOIN asignaInmueble ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN Formato on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia JOIN municipios ON municipios.idMunicipio=regiones.municipio JOIN estados on municipios.estado = estados.id_Estado JOIN AnalistaOti O on asignaInmueble.idAsignacion = O.idAsignacion JOIN Usuario U on O.idUsuario = U.idUsuario WHERE asignaInmueble.idAsignacion=$idAsignacion")->row_array();
       }

    function borrarDatosTiposP($idP)
    {
        $this->db->where('idPuente', $idP);
        $this->db->delete('actaPuente');
    }
    function borrarDatosTiposPD($idP)
    {
        $this->db->where('idPuentE', $idP);
        $this->db->delete('actaPuenteEvi');
    }
    function borrarDatosTiposPDD($idP)
    {
        $this->db->where('idPuen', $idP);
        $this->db->delete('actaIncaPuente');
    }

    function actualizarDatosTipoPuente($datosPuente, $idPuente)
    {
        $this->db->where('idPuente', $idPuente);
        $this->db->update('actaPuente', $datosPuente);
    }

    function actualizarDatosTipoPuenteD($datosPuente, $idPuente)
    {
        $this->db->where('idPuentE', $idPuente);
        $this->db->update('actaPuenteEvi', $datosPuente);
    }
    function actualizarDatosTipoPuenteDD($datosPuente, $idPuente)
    {
        $this->db->where('idPuen', $idPuente);
        $this->db->update('actaIncaPuente', $datosPuente);
    }

    //otro
    function insertaDatosAcPuenteEv($datosActaP)
    {
        $this->db->insert('actaPuenteEvi', $datosActaP);
        return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
    }
    //ultimo
    function insertaDatosAcPuenteInca($datosActaP)
    {
        $this->db->insert('actaIncaPuente', $datosActaP);
        return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
    }

    function actualizarImagenGeneralTabla($campoLlave, $llavePrimaria, $data, $tabla)
    {
        $this->db->where("$campoLlave", $llavePrimaria);
        $this->db->update("$tabla", $data);
    }

    function getNombreImagenTabla($campo, $tabla, $llavePrimaria, $nombreLlave)
    {
        return $this->db->query("SELECT $campo FROM $tabla WHERE $nombreLlave=$llavePrimaria")->result_array();
    }
    function deleteImagenTabla($borrar, $tabla, $llavePrimaria, $campoLlave)
    {
        $this->db->where("$campoLlave", $llavePrimaria);
        $this->db->update("$tabla", $borrar);
    }
    function getDatosGra($idAsignacion)
    {
        return $this->db->query("SELECT actaVerificacion.*,Formato.razonSocial,Formato.rfc,Formato.domicilioFiscal FROM actaVerificacion 
                                 JOIN asignaInmueble on asignaInmueble.idAsignacion=actaVerificacion.idAsignacion 
                                 JOIN CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo 
                                 JOIN Formato on Formato.idFormato=CentrosDeTrabajo.idFormato 
                                 WHERE actaVerificacion.idAsignacion =$idAsignacion")->result_array();
    }

    function getDatosTu($idAsignacion)
    {
        return $this->db->query("SELECT * FROM `actaPuente`WHERE idAsignacion =$idAsignacion")->result_array();
    }

    function getDatosEvi($idAsignacion)
    {
        return $this->db->query("SELECT * FROM `actaPuenteEvi`WHERE idAsignacion =$idAsignacion")->result_array();
    }

    function getDatosiNCA($idAsignacion)
    {
        return $this->db->query("SELECT * FROM `actaIncaPuente`WHERE idAsignacion =$idAsignacion")->result_array();
    }
}