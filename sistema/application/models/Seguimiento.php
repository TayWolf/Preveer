<?php
class Seguimiento extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function getClientes()
    {
        //retorna solo los clientes que tienen asignaciones y que estan en la tabla ClienteSeguimiento
        //la tabla ClienteSeguimiento tiene los clientes que se configuraron desde Crudproyectos/altaSeguimientoCliente
        $this->db->select("Clientes.idCliente, Clientes.nombreCliente");
        $this->db->from("Clientes");
        $this->db->join("Formato", "Clientes.idCliente = Formato.idCliente");
        $this->db->join("CentrosDeTrabajo", "Formato.idFormato = CentrosDeTrabajo.idFormato");
        $this->db->join("asignaInmueble", "CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo");
        $this->db->join("serviciosSubservicios", "asignaInmueble.idProyecto = serviciosSubservicios.idControl");
        $this->db->join("Proyectos", "serviciosSubservicios.idServicio = Proyectos.idProyecto");
        $this->db->join("ClienteSeguimiento", "Clientes.idCliente = ClienteSeguimiento.idCliente");
        $this->db->where("Proyectos.idArea", 1);
        $this->db->group_by("Clientes.idCliente");
        return $this->db->get()->result_array();
    }
    function cargarServiciosCliente($idCliente)
    {

        //la tabla ClienteSeguimiento tiene los clientes que se configuraron desde Crudproyectos/altaSeguimientoCliente
        $this->db->select("Proyectos.idProyecto, Proyectos.nombreProyecto");
        $this->db->from("Proyectos");
        $this->db->join("serviciosSubservicios", "serviciosSubservicios.idServicio = Proyectos.idProyecto");
        $this->db->join("ClienteSeguimiento", "serviciosSubservicios.idControl= ClienteSeguimiento.idServicioSubservicio");
        $this->db->where("ClienteSeguimiento.idCliente", $idCliente);
        $this->db->group_by("Proyectos.idProyecto");
        return $this->db->get()->result_array();
    }
    function cargarSubserviciosCliente($idCliente, $idServicio)
    {

        //la tabla ClienteSeguimiento tiene los clientes que se configuraron desde Crudproyectos/altaSeguimientoCliente
        $this->db->select("ClienteSeguimiento.idServicioSubservicio, Subservicios.nombre");
        $this->db->from("ClienteSeguimiento");
        $this->db->join("serviciosSubservicios", "serviciosSubservicios.idControl = ClienteSeguimiento.idServicioSubservicio");
        $this->db->join("Subservicios", "Subservicios.idSubservicio = serviciosSubservicios.idSubservicio");
        $this->db->where("ClienteSeguimiento.idCliente", $idCliente);
        $this->db->where("serviciosSubservicios.idServicio", $idServicio);
        $this->db->group_by("ClienteSeguimiento.idServicioSubservicio");
        return $this->db->get()->result_array();
    }

    function getDatos($where="where Areas.idArea=1")
    {
        return $this->db->query("SELECT CentrosDeTrabajo.idDet,Formato.razonSocial,CentrosDeTrabajo.nombre,municipios.nombreMunicipio,estados.nombreEstado,asignaInmueble.idAsignacion  FROM `CentrosDeTrabajo` join Formato on CentrosDeTrabajo.idFormato = Formato.idFormato join regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio JOIN estados on estados.id_Estado=municipios.estado join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea $where")->result_array();
    }

    function listadoAnalistas($idAs)
    {
        return $this->db->query("SELECT HistoricoDocumental.fecha,Usuario.nombre FROM `HistoricoDocumental` join Usuario on Usuario.idUsuario=HistoricoDocumental.idUsuario WHERE HistoricoDocumental.idAsignacion=$idAs")->result_array();
    }

    function listadoAnalistasForm($idAs)
    {
        return $this->db->query("SELECT historicoFormulario.fechaCaptura,Usuario.nombre FROM `historicoFormulario` join Usuario on Usuario.idUsuario=historicoFormulario.idUser WHERE historicoFormulario.idAsignacion=$idAs")->result_array();
    }

    function valorPorcentaje()
    {
        return $this->db->query("SELECT HistoricoDocumental.fecha,Oti.fechaAceptacion,asignaInmueble.idAsignacion,asignaInmueble.fechaEntrega FROM HistoricoDocumental join asignaInmueble on asignaInmueble.idAsignacion=HistoricoDocumental.idAsignacion join Oti on Oti.idOti=asignaInmueble.idOti join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea where Areas.idArea=1")->result_array();
    }

    function getNvisitas()
    {
        return $this->db->query("SELECT formIndicador.nombreIndicador,FormularioAlmacenamiento.valor, FormularioAsignacion.idAsignacion FROM `FormularioAlmacenamiento` join FormularioAsignacion on FormularioAsignacion.idFormularioAsignacion=FormularioAlmacenamiento.idFormularioAsignacion JOIN formIndicador on formIndicador.idIndicador=FormularioAlmacenamiento.idIndicador where nombreIndicador = 'Número de visita'")->result_array();
    }

    function getTipos()
    {
        return $this->db->query("SELECT entregableInmueble.idAsignacion,Entregables.nombreEntregable FROM `entregableInmueble` join Entregables on Entregables.idEntregable=entregableInmueble.idEntregable")->result_array();
    }

    function valorPorcentajedocumental()
    {
        return $this->db->query("SELECT HistoricoDocumental.fecha,HistoricoDocumental.porcentajeHistorico,Oti.fechaAceptacion,asignaInmueble.idAsignacion FROM HistoricoDocumental join asignaInmueble on asignaInmueble.idAsignacion=HistoricoDocumental.idAsignacion join Oti on Oti.idOti=asignaInmueble.idOti join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea where Areas.idArea=1 ORDER BY `HistoricoDocumental`.`porcentajeHistorico` ASC")->result_array();
    }

    function recolectorFecha()
    {
        return $this->db->query("SELECT VisitasInmueble.fechaAgenda,Oti.fechaAceptacion,asignaInmueble.idAsignacion FROM VisitasInmueble join asignaInmueble on asignaInmueble.idAsignacion=VisitasInmueble.idAsignacion join Oti on Oti.idOti=asignaInmueble.idOti join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea where Areas.idArea=1 and VisitasInmueble.tipoVisita=2")->row();
    }

    function getResultadoOM(){
        return $this->db->query("SELECT Usuario.nombre as nombreUser,HistoricoOportunidadMejora.fecha,Oti.fechaAceptacion,asignaInmueble.idAsignacion FROM HistoricoOportunidadMejora join asignaInmueble on asignaInmueble.idAsignacion=HistoricoOportunidadMejora.idAsignacion join Oti on Oti.idOti=asignaInmueble.idOti join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea join Usuario on Usuario.idUsuario=HistoricoOportunidadMejora.idUsuario where Areas.idArea=1")->row();
    }

    function getResultado($fIni,$fFinal,$tipoBusqueda, $condicion)
    {

        if ($tipoBusqueda==2)
        {
            return $this->db->query("SELECT HistoricoDocumental2.idHistoricoDocumental, CentrosDeTrabajo.idDet, Formato.razonSocial, CentrosDeTrabajo.nombre, municipios.nombreMunicipio, estados.nombreEstado, HistoricoDocumental2.fecha, HistoricoDocumental2.porcentajeHistorico, Oti.fechaAceptacion, asignaInmueble.idAsignacion FROM (SELECT * FROM HistoricoDocumental ORDER BY HistoricoDocumental.idHistoricoDocumental DESC) as HistoricoDocumental2 join asignaInmueble on asignaInmueble.idAsignacion = HistoricoDocumental2.idAsignacion join Oti on Oti.idOti = asignaInmueble.idOti join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio join Areas on Areas.idArea = Proyectos.idArea join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo join Formato on Formato.idFormato = CentrosDeTrabajo.idFormato join regiones on regiones.idRegiones = CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio = regiones.municipio join estados on estados.id_Estado = municipios.estado $condicion and HistoricoDocumental2.fecha BETWEEN '$fIni' and '$fFinal' GROUP by HistoricoDocumental2.idAsignacion")->result_array();
        }
        else if ($tipoBusqueda==1||empty($tipoBusqueda)) {
            return $this->db->query("SELECT CentrosDeTrabajo.idDet,Formato.razonSocial,CentrosDeTrabajo.nombre,municipios.nombreMunicipio,estados.nombreEstado, historicoFormulario.fechaCaptura as fecha,Oti.fechaAceptacion,asignaInmueble.idAsignacion FROM ( SELECT * from historicoFormulario order by historicoFormulario.idControl desc ) as historicoFormulario join asignaInmueble on asignaInmueble.idAsignacion=historicoFormulario.idAsignacion join Oti on Oti.idOti=asignaInmueble.idOti join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato join regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio join estados on estados.id_Estado=municipios.estado $condicion and historicoFormulario.fechaCaptura BETWEEN '$fIni' and '$fFinal' GROUP by historicoFormulario.idAsignacion ")->result_array();
        }
        else if ($tipoBusqueda==3) {
            return $this->db->query("SELECT CentrosDeTrabajo.idDet,Formato.razonSocial,CentrosDeTrabajo.nombre,municipios.nombreMunicipio,estados.nombreEstado, Usuario.nombre as nombreUser,HistoricoOportunidadMejora.fecha,Oti.fechaAceptacion,asignaInmueble.idAsignacion FROM (select * from HistoricoOportunidadMejora ORDER by HistoricoOportunidadMejora.idHistorico DESC) as HistoricoOportunidadMejora join asignaInmueble on asignaInmueble.idAsignacion=HistoricoOportunidadMejora.idAsignacion join Oti on Oti.idOti=asignaInmueble.idOti join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea join Usuario on Usuario.idUsuario=HistoricoOportunidadMejora.idUsuario join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato join regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio join estados on estados.id_Estado=municipios.estado $condicion and HistoricoOportunidadMejora.fecha BETWEEN '$fIni' and '$fFinal' GROUP by HistoricoOportunidadMejora.idAsignacion ")->result_array();
        }

    }


    function getEstados()
    {
        return $this->db->query("SELECT estados.nombreEstado, estados.id_Estado  FROM `CentrosDeTrabajo` join regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio JOIN estados on estados.id_Estado=municipios.estado join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea where Areas.idArea=1 GROUP BY estados.id_Estado")->result_array();
    }
    function getMunicipios($idEstado)
    {
        //Obtiene los municipios del estado proporcionado
        return $this->db->query("SELECT municipios.idMunicipio, municipios.nombreMunicipio FROM CentrosDeTrabajo join regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio JOIN estados on estados.id_Estado=municipios.estado join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea WHERE estados.id_Estado=$idEstado AND Areas.idArea=1 GROUP BY municipios.idMunicipio")->result_array();
    }

    function getTablaSeguimiento($where="where Areas.idArea=1")
    {
        return $this->db->query("
SELECT
  CentrosDeTrabajo.idDet,
  Formato.razonSocial,
  CentrosDeTrabajo.nombre,
  municipios.nombreMunicipio,
  estados.nombreEstado,
  CentrosDeTrabajo.nomContacto,
  Tramites.nombreTramite,
  Oti.fechaSolicitud,
  asignaInmueble.idAsignacion,
  COALESCE(HistoricoDocumentales.CVisitas, 0) AS CVisitas,
  VisitaInmueble.fechaAgenda,
  VisitasNormales.fechaAgenda as fechaVisitaNormal,
  HistoricoDocumentales.fecha,
  COALESCE(Oti.fechaAceptacion, '1000-01-01') as fechaAceptacion,
  (COALESCE(HistoricoDocumentales.porcentajeHistorico, 0)) as porcentajeHistorico,
  HistorialOM.nombreUser as nombreGuardadoOM,
  HistorialOM.fecha as fechaGuardadoOM,
  CorreosEnviadosOM.FechaEnvio as FechaEnvioCorreoOM,
  GROUP_CONCAT(DISTINCT Entregables.nombreEntregable SEPARATOR ', ') as entregables,
  NumeroVisitas.valor as numeroVisitas,
  VisitasRealizadas.numeroVisitasTotales,
  asignaInmueble.capacitacion,
  asignaInmueble.idAsignacion,
  asignaInmueble.fechaEntrega,
  COALESCE(historicoFormulario.fechaCaptura, '1000-01-01') as fechaVisita,
  SeguimientoDocumental.vencimientoMunicipal,
  SeguimientoDocumental.vencimientoEstatal,
  SeguimientoDocumental.entregaActualizacionEstatal,
  SeguimientoDocumental.tipoEntrega,
  SeguimientoDocumental.entregaCopiaTienda,
  SeguimientoDocumental.fechaEntregaPrichos,
  SeguimientoDocumental.fechaAnexoNavideno,
  SeguimientoDocumental.preventiva,
  SeguimientoDocumental.observaciones,
  SeguimientoDocumental.elaboracionPlanEmergencia,
  SeguimientoDocumental.integracionPlanEmergencia,
  SeguimientoDocumental.fechaIngresoTramite,
  SeguimientoDocumental.responsableIngresoTramite,
  SeguimientoDocumental.seguimientoTramite,
  SeguimientoDocumental.entregaCopiaClientePE,
  SeguimientoDocumental.seguimientosRealizadosATramite,
  SeguimientoDocumental.responsableSeguimientoTramite,
  SeguimientoDocumental.reunionPlanTrabajoInterno,
  SeguimientoDocumental.presentacionEsquemaArv,
  SeguimientoDocumental.cumplimientoInspeccionFisica,
  SeguimientoDocumental.obtencionVoBoPlanEmergencia,
  SeguimientoDocumental.recoleccionInformacionARV,
  SeguimientoDocumental.elaboracionARV,
  SeguimientoDocumental.revisionInternaCalidad,
  SeguimientoDocumental.integracionFisicaCarpeta,
  SeguimientoDocumental.entregaClienteARV,
  SeguimientoDocumental.fechaSeguimientoRealizadoARV,
  SeguimientoDocumental.noSeguimientosRealizadosARV,
  SeguimientoDocumental.responsableSeguimientoARV,
  SeguimientoDocumental.obtencionVistoBuenoARV,
  SeguimientoDocumental.presentacionClienteAutoridad,
  SeguimientoDocumental.fechaSeguimientoSEGVisita,
  SeguimientoDocumental.planContReunionPlanTrabajoInterno,
  SeguimientoDocumental.planContRecoleccionInformacion,
  SeguimientoDocumental.planContInspeccionFisica,
  SeguimientoDocumental.planContReporteOM,
  SeguimientoDocumental.planContCumplimientoPlanContinuidad,
  SeguimientoDocumental.planContCumplimientoIntegracion,
  SeguimientoDocumental.planContRevisionInternaCalidad,
  SeguimientoDocumental.planContPresentacionClienteAutoridad,
  SeguimientoDocumental.simuReunionPlanTrabajoInterno,
  SeguimientoDocumental.simuPresentacionPlanTrabajo,
  SeguimientoDocumental.simuRecoleccionInformacion,
  SeguimientoDocumental.simuReunionProgramacionCliente,
  SeguimientoDocumental.simuProgramacionLogisticaInterna,
  SeguimientoDocumental.simuElaboracionSimulacro,
  SeguimientoDocumental.simuRevisionCalidadInterna,
  SeguimientoDocumental.simuEntregaReporteEvidencias,
  SeguimientoDocumental.mod3dReunionPlanTrabajoInterno, 
  SeguimientoDocumental.mod3dRecoleccionInformacion,
  SeguimientoDocumental.mod3dVisitaInspeccion,
  SeguimientoDocumental.mod3dConfirmacionPlanos,
  SeguimientoDocumental.mod3dElaboracionPlanos,
  SeguimientoDocumental.mod3dSimulacion,
  SeguimientoDocumental.mod3dRevisionTecnica,
  SeguimientoDocumental.mod3dEntregaResultadosVideo,
  SeguimientoDocumental.mod3dRedaccionInforme,
  SeguimientoDocumental.mod3dFormulacionConclusiones,
  SeguimientoDocumental.mod3dRevisionCalidadInterna,
  SeguimientoDocumental.mod3dEntregaCliente,
  SeguimientoDocumental.copiasCarpetasSolicitadas,
  SeguimientoDocumental.copiasFechaEntregaCliente,
  SeguimientoDocumental.copiasRevisionCalidad,
  SeguimientoDocumental.planosCumplimientoVisita,
  SeguimientoDocumental.planosElaboracionPlano,
  SeguimientoDocumental.planosRevisionCalidadInterna,
  SeguimientoDocumental.planosEntregaCliente,
  SeguimientoDocumental.munIntegracionPrograma,
  SeguimientoDocumental.munFechaIngresoMunicipal,
  SeguimientoDocumental.munResponsableIngresoMunicipal,
  SeguimientoDocumental.munRespuestaPreventiva ,
  SeguimientoDocumental.munEntregaCopiaCliente,
  SeguimientoDocumental.munSeguimientoTramiteMunicipal,
  SeguimientoDocumental.munResponsableSeguimientoMunicipal,
  SeguimientoDocumental.munResponsableRespuestaPreventiva,
  SeguimientoDocumental.munSeguimientoPreventivaMunicipal,
  SeguimientoDocumental.noSeguimientoTramiteMunicipal,
  SeguimientoDocumental.noSeguimientoPreventivaMunicipal,
  SeguimientoDocumental.estIntegracionPrograma,
  SeguimientoDocumental.estFechaIngresoEstatal,
  SeguimientoDocumental.estResponsableIngresoEstatal,
  SeguimientoDocumental.estEntregaCopiaCliente,
  SeguimientoDocumental.estSeguimientoTramiteEstatal,
  SeguimientoDocumental.estResponsableSeguimientoEstatal,
  SeguimientoDocumental.estResponsableRespuestaPreventiva,
  SeguimientoDocumental.estSeguimientoPreventivaEstatal,
  SeguimientoDocumental.estRespuestaPreventiva,
  SeguimientoDocumental.noSeguimientoTramiteEstatal,
  SeguimientoDocumental.estSeguimientosEstatales,
  CURDATE() as fechaHoy
FROM asignaInmueble
  JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo
  join Formato on CentrosDeTrabajo.idFormato = Formato.idFormato
  join Clientes on Clientes.idCliente=Formato.idCliente
  join regiones on regiones.idRegiones = CentrosDeTrabajo.idColonia
  join municipios on municipios.idMunicipio = regiones.municipio
  JOIN estados on estados.id_Estado = municipios.estado
  join Oti on Oti.idOti = asignaInmueble.idOti
  join Tramites on Tramites.idTramite = asignaInmueble.idTramite
  join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto
  join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio
  join Areas on Areas.idArea = Proyectos.idArea
  LEFT JOIN (
              SELECT CASE WHEN HistoricoDocumental.fecha>=CAST(CONCAT(YEAR(Oti.fechaAceptacion),'-01-01') as DATE) THEN 1 ELSE 0 END as CVisitas,
                HistoricoDocumental.idHistoricoDocumental,
                HistoricoDocumental.fecha,
                     COALESCE(HistoricoDocumental.porcentajeHistorico, 0) as porcentajeHistorico,
                a.idAsignacion
              FROM HistoricoDocumental
                JOIN asignaInmueble a on HistoricoDocumental.idAsignacion = a.idAsignacion
                JOIN serviciosSubservicios S2 on a.idProyecto = S2.idControl
                JOIN Proyectos P on S2.idServicio = P.idProyecto
                JOIN Oti on a.idOti = Oti.idOti
              WHERE P.idArea=1 ORDER BY HistoricoDocumental.idHistoricoDocumental DESC ) HistoricoDocumentales ON asignaInmueble.idAsignacion = HistoricoDocumentales.idAsignacion
  LEFT JOIN (SELECT
               VisitasInmueble.fechaAgenda,
               Oti.fechaAceptacion,
               asignaInmueble.idAsignacion
             FROM VisitasInmueble
               join asignaInmueble on asignaInmueble.idAsignacion = VisitasInmueble.idAsignacion
               join Oti on Oti.idOti = asignaInmueble.idOti
               join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto
               join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio
               join Areas on Areas.idArea = Proyectos.idArea
             where Areas.idArea = 1 and VisitasInmueble.tipoVisita = 2 ORDER BY VisitasInmueble.fechaAgenda DESC) VisitaInmueble ON VisitaInmueble.idAsignacion=asignaInmueble.idAsignacion
  LEFT JOIN (SELECT
               VisitasInmueble.fechaAgenda,
               Oti.fechaAceptacion,
               asignaInmueble.idAsignacion
             FROM VisitasInmueble
               join asignaInmueble on asignaInmueble.idAsignacion = VisitasInmueble.idAsignacion
               join Oti on Oti.idOti = asignaInmueble.idOti
               join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto
               join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio
               join Areas on Areas.idArea = Proyectos.idArea
             where Areas.idArea = 1 and VisitasInmueble.tipoVisita = 1 ORDER BY VisitasInmueble.fechaAgenda DESC) VisitasNormales ON VisitasNormales.idAsignacion=asignaInmueble.idAsignacion
  LEFT JOIN (SELECT
               Count(*) as numeroVisitasTotales, VisitasInmueble.idAsignacion
             FROM VisitasInmueble
               join asignaInmueble a on a.idAsignacion = VisitasInmueble.idAsignacion
               join Oti on Oti.idOti = a.idOti
               join serviciosSubservicios on serviciosSubservicios.idControl = a.idProyecto
               join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio
               join Areas on Areas.idArea = Proyectos.idArea
             where Areas.idArea = 1 GROUP BY VisitasInmueble.idAsignacion) VisitasRealizadas ON VisitasRealizadas.idAsignacion=asignaInmueble.idAsignacion
  LEFT JOIN (
              SELECT
                Usuario.nombre as nombreUser,
                HistoricoOportunidadMejora.fecha,
                Oti.fechaAceptacion,
                asignaInmueble.idAsignacion
              FROM HistoricoOportunidadMejora
                join asignaInmueble on asignaInmueble.idAsignacion = HistoricoOportunidadMejora.idAsignacion
                join Oti on Oti.idOti = asignaInmueble.idOti
                join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto
                join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio
                join Areas on Areas.idArea = Proyectos.idArea
                join Usuario on Usuario.idUsuario = HistoricoOportunidadMejora.idUsuario
              where Areas.idArea = 1  ORDER BY HistoricoOportunidadMejora.idHistorico DESC
            ) HistorialOM ON HistorialOM.idAsignacion=asignaInmueble.idAsignacion
  LEFT JOIN entregableInmueble ON asignaInmueble.idAsignacion = entregableInmueble.idAsignacion
  LEFT JOIN Entregables ON entregableInmueble.idEntregable = Entregables.idEntregable
  LEFT JOIN (SELECT
               formIndicador.nombreIndicador,
               FormularioAlmacenamiento.valor,
               FormularioAsignacion.idAsignacion
             FROM `FormularioAlmacenamiento`
               join FormularioAsignacion
                 on FormularioAsignacion.idFormularioAsignacion = FormularioAlmacenamiento.idFormularioAsignacion
               JOIN formIndicador on formIndicador.idIndicador = FormularioAlmacenamiento.idIndicador
             where nombreIndicador = 'Número de visita') NumeroVisitas ON NumeroVisitas.idAsignacion=asignaInmueble.idAsignacion
  LEFT JOIN historicoFormulario ON asignaInmueble.idAsignacion = historicoFormulario.idAsignacion
  LEFT JOIN SeguimientoDocumental ON asignaInmueble.idAsignacion = SeguimientoDocumental.idAsignacion
  LEFT JOIN (SELECT MAX(CorreoEnviado.FechaEnvio) as FechaEnvio, CorreoEnviado.idAsignacion FROM CorreoEnviado JOIN asignaInmueble ON asignaInmueble.idAsignacion = CorreoEnviado.idAsignacion GROUP BY asignaInmueble.idAsignacion ORDER BY CorreoEnviado.idCorreoEnviado, CorreoEnviado.FechaEnvio DESC) CorreosEnviadosOM ON CorreosEnviadosOM.idAsignacion=asignaInmueble.idAsignacion
$where
GROUP BY asignaInmueble.idAsignacion ORDER BY asignaInmueble.idAsignacion DESC;
        ")->result_array();
    }

    function getColumnasSeguimientoDocumental($idCliente, $idServicioSubservicio)
    {
        $this->db->select("ClienteSeguimiento.columna");
        $this->db->from("ClienteSeguimiento");
        $this->db->where("ClienteSeguimiento.idCliente", $idCliente);
        $this->db->where("ClienteSeguimiento.idServicioSubservicio", $idServicioSubservicio);
        return $this->db->get()->result_array();
    }
    function updateSeguimientoDocumental($idAsignacion, $data)
    {
        $this->db->where("idAsignacion", $idAsignacion);
        $this->db->update("SeguimientoDocumental", $data);
    }
    function validarExistencia($idAsignacion)
    {
        $existe=$this->db->get_where("SeguimientoDocumental", array('idAsignacion' => $idAsignacion))->result_array();
        if(!empty($existe))
            return;
        $this->db->insert("SeguimientoDocumental", array('idAsignacion' => $idAsignacion));
    }
    function getFechaSolicitudOTI($idAsignacion)
    {
        $this->db->select('fechaSolicitud');
        $this->db->from("Oti");
        $this->db->join("asignaInmueble", "asignaInmueble.idOti=Oti.idOti");
        $this->db->where("asignaInmueble.idAsignacion", $idAsignacion);
        $array=$this->db->get()->row_array();
        return $array['fechaSolicitud'];
    }
    function getPorcentajesSeguimientoDocumental($idCliente, $idServicioSubservicio)
    {
        $this->db->select('columna, valorPorcentaje, subservicio');
        $this->db->from("ClienteSeguimiento");
        $this->db->where("ClienteSeguimiento.idCliente", $idCliente);
        $this->db->where("ClienteSeguimiento.idServicioSubservicio", $idServicioSubservicio);
        return $this->db->get()->result_array();
    }


}