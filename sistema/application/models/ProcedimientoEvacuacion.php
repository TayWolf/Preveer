<?php



class ProcedimientoEvacuacion extends CI_Model

{

    function getProcesosProcedimientoEvacuacion()

    {

        return $this->db->query("SELECT ProcesosEvacuacion.id_proceso, ProcesosEvacuacion.proceso, PasosEvacuacion.paso, PasosEvacuacion.ordenPaso FROM ProcesosEvacuacion JOIN PasosEvacuacion ON ProcesosEvacuacion.id_paso = PasosEvacuacion.id_paso ORDER BY PasosEvacuacion.ordenPaso asc, ProcesosEvacuacion.orden asc")->result_array();

    }

    function traerDatosProcedimiento($idAsignacion)

    {

        return $this->db->query("SELECT * FROM DatosProcedimientoEvacuacion WHERE idAsignacion = $idAsignacion")->result_array();

    }

    function insertarExistencia($idAsignacion, $idProceso,$data)

    {

        if(empty($this->db->get_where('DatosProcedimientoEvacuacion', array('idAsignacion' => $idAsignacion, 'id_proceso' => $idProceso))->row_array()))

            $this->db->insert('DatosProcedimientoEvacuacion', $data);

    }

    function insertarExistenciaRecomendaciones($idAsignacion, $data)

    {

        if(empty($this->db->get_where('ProcedimientoEvacuacion', array('idAsignacion' => $idAsignacion))->row_array()))

            $this->db->insert('ProcedimientoEvacuacion', $data);

        else

        {

            $this->db->where("idAsignacion", $idAsignacion);

            $this->db->update("ProcedimientoEvacuacion", $data);

        }

    }

    function updateProcedimientoEvacuacion($idAsignacion, $idProceso, $data)

    {

        $this->db->where("idAsignacion", $idAsignacion);

        $this->db->where("id_proceso", $idProceso);

        $this->db->update("DatosProcedimientoEvacuacion", $data);

    }

    function getRecomendaciones($idAsignacion)

    {

        $recomendacion=$this->db->query("SELECT recomendaciones FROM ProcedimientoEvacuacion WHERE idAsignacion=$idAsignacion")->row_array();

        return $recomendacion['recomendaciones'];

    }

    function getIdCentroTrabajo($idAsignacion)

    {

        $contenedor=$this->db->query("SELECT idCentroTrabajo FROM asignaInmueble WHERE idAsignacion=$idAsignacion")->row_array();

        return $contenedor['idCentroTrabajo'];

    }

    function getNombreCentroTrabajo($idAsignacion)
    {
        $arreglo=$this->db->query("SELECT CONCAT(CentrosDeTrabajo.nombre,' (OTI ',Oti.idOti,')') as nombre FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE asignaInmueble.idAsignacion=$idAsignacion")->row_array();
        return $arreglo['nombre'];
    }

    function getAllFormatos()

    {

        return $this->db->get("Formato")->result_array();

    }

    function nombreUsuarioVisita($idusuariobase){

        $resultado= $this->db->query ( " SELECT Usuario.idUsuario, Usuario.nombre as nombreUsuarioVisita FROM Usuario WHERE idUsuario=$idusuariobase " )->row_array();



        return $resultado['nombreUsuarioVisita'];



    }

    function getDatosCentroTrabajo($idAsignacion)

    {

        return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CentrosDeTrabajo.calle, CentrosDeTrabajo.numeroInterior as numinterior, CentrosDeTrabajo.numeroExterior as numexterior,  CentrosDeTrabajo.correoInmueble, CentrosDeTrabajo.idDet as numeroSucursal, CentrosDeTrabajo.nombre as nombreSucursal, CentrosDeTrabajo.giroInmueble as aep, Usuario.nombre as nombreRealizo, (SELECT COUNT(idAsignacion) FROM VisitasInmueble WHERE VisitasInmueble.idAsignacion=$idAsignacion AND tipoVisita=1) as numeroVisita, asignaInmueble.nombreAtendioVisita, Formato.nombre as nombreFormato, Formato.rfc, Formato.comentarioRFC, Formato.domicilioFiscal, Formato.razonSocial,regiones.nombreRegion,LPAD(regiones.cp, 5, 0) as codigoPostal, municipios.nombreMunicipio, estados.nombreEstado, CentrosDeTrabajo.correoInmueble, CentrosDeTrabajo.telefonoInmueble, CentrosDeTrabajo.nomContacto, CentrosDeTrabajo.puestoContacto, CentrosDeTrabajo.telContacto, CentrosDeTrabajo.email FROM asignaInmueble JOIN CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = 241 JOIN Usuario ON Usuario.idUsuario=AnalistaOti.idUsuario JOIN Formato ON CentrosDeTrabajo.idFormato=Formato.idFormato JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia JOIN municipios ON municipios.idMunicipio=regiones.municipio JOIN estados ON estados.id_Estado=municipios.estado where asignaInmueble.idAsignacion=$idAsignacion")->row_array();



    }



    function getTabla($idAsignacion)

    {

        return $this->db->query("SELECT PasosEvacuacion.paso, ProcesosEvacuacion.proceso, DatosProcedimientoEvacuacion.valorEquipo, DatosProcedimientoEvacuacion.valorProcedimiento FROM asignaInmueble JOIN DatosProcedimientoEvacuacion ON asignaInmueble.idAsignacion = DatosProcedimientoEvacuacion.idAsignacion JOIN ProcesosEvacuacion ON DatosProcedimientoEvacuacion.id_proceso = ProcesosEvacuacion.id_proceso JOIN PasosEvacuacion ON ProcesosEvacuacion.id_paso = PasosEvacuacion.id_paso WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();



    }



}