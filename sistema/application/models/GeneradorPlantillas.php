<?php

class GeneradorPlantillas extends CI_Model
{

    function cargarClientes()
    {
        //retorna los clientes a los que Protección civil ha prestado servicios
        return $this->db->query("SELECT Clientes.* FROM Clientes JOIN Formato F on Clientes.idCliente = F.idCliente JOIN CentrosDeTrabajo Trabajo on F.idFormato = Trabajo.idFormato JOIN asignaInmueble a on Trabajo.idCentroTrabajo = a.idCentroTrabajo JOIN serviciosSubservicios ON a.idProyecto = serviciosSubservicios.idControl JOIN Proyectos P on serviciosSubservicios.idServicio = P.idProyecto WHERE P.idArea=1 GROUP BY Clientes.nombreCliente")->result_array();
    }
    function cargarFormularios()
    {
        return $this->db->get("Aut")->result_array();
    }
    function getEstadosCliente($idCliente)
    {
        //retorna los estados a los que Protección civil ha prestado servicios
        return $this->db->query("SELECT estados.* FROM estados JOIN municipios m on estados.id_Estado = m.estado JOIN regiones r on m.idMunicipio = r.municipio JOIN CentrosDeTrabajo Trabajo on r.idRegiones = Trabajo.idColonia JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN asignaInmueble a on Trabajo.idCentroTrabajo = a.idCentroTrabajo JOIN serviciosSubservicios S2 on a.idProyecto = S2.idControl JOIN Proyectos P on S2.idServicio = P.idProyecto WHERE P.idArea=1 AND C.idCliente=$idCliente GROUP BY estados.id_Estado")->result_array();
    }
    function getFormatosCliente($idCliente)
    {
        //retorna los formatos a los que Protección civil ha prestado servicios
        return $this->db->query("SELECT F.* FROM Formato F JOIN CentrosDeTrabajo Trabajo on F.idFormato=Trabajo.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN asignaInmueble a on Trabajo.idCentroTrabajo = a.idCentroTrabajo JOIN serviciosSubservicios S2 on a.idProyecto = S2.idControl JOIN Proyectos P on S2.idServicio = P.idProyecto WHERE P.idArea = 1 AND C.idCliente = $idCliente GROUP BY F.idFormato;")->result_array();
    }
    function getCentrosTrabajo($condiciones)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, a.idAsignacion, CONCAT(CentrosDeTrabajo.nombre, ' OTI(', a.idOti, ')') as nombre FROM CentrosDeTrabajo JOIN regiones r on CentrosDeTrabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN estados ON m.estado = estados.id_Estado JOIN Formato ON CentrosDeTrabajo.idFormato = Formato.idFormato JOIN Clientes ON Formato.idCliente = Clientes.idCliente JOIN asignaInmueble a on CentrosDeTrabajo.idCentroTrabajo = a.idCentroTrabajo JOIN serviciosSubservicios S2 on a.idProyecto = S2.idControl JOIN Proyectos P on S2.idServicio = P.idProyecto WHERE P.idArea = 1 $condiciones GROUP BY a.idOti, CentrosDeTrabajo.idCentroTrabajo;")->result_array();
    }
    function getPlantillas($idEstado, $idCentroTrabajo, $idFormato, $idCliente)
    {
        return $this->db->query("SELECT Plantilla.idPlantilla, Plantilla.nombrePlantilla FROM Plantilla WHERE idEstado=$idEstado AND (idCliente=$idCliente OR idFormato=$idFormato AND idCentroTrabajo=$idCentroTrabajo) GROUP BY idPlantilla;")->result_array();
    }
    function getInfoPlantilla($idPlantilla)
    {
        return $this->db->get_where("Plantilla", array("idPlantilla" => $idPlantilla))->row_array();
    }
    function getInfoFotosPlantilla($idPlantilla)
    {
        return $this->db->get_where("PlantillaFoto", array("idPlantilla" => $idPlantilla))->result_array();
    }
    function getFotosFormulario($idFormulario, $idAsignacion)
    {
        return $this->db->query("SELECT FormularioFotos.* FROM CentrosDeTrabajo JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo JOIN FormularioAsignacion on asignaInmueble.idAsignacion = FormularioAsignacion.idAsignacion JOIN Aut on FormularioAsignacion.idFormulario = Aut.idControl JOIN FormularioAcordeon on Aut.idControl = FormularioAcordeon.idControl JOIN Acordeon on FormularioAcordeon.idAcordeon = Acordeon.idAcordeon JOIN AcordeonIndicador on Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN formIndicador on AcordeonIndicador.idIndicador = formIndicador.idIndicador JOIN FormularioFotos ON FormularioFotos.idFormularioAsignacion = FormularioAsignacion.idFormularioAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion AND formIndicador.tipoIndicador = 6 AND Aut.idControl = $idFormulario GROUP BY foto;")->result_array();
    }
    function getEtiquetasTexto($idPlantilla, $idAsignacion)
    {
        return $this->db->query("SELECT plantillaTexto.nombreEtiqueta, FormularioAlmacenamiento.valor as valorEtiqueta FROM FormularioAlmacenamiento JOIN FormularioAsignacion on FormularioAlmacenamiento.idFormularioAsignacion = FormularioAsignacion.idFormularioAsignacion JOIN asignaInmueble on FormularioAsignacion.idAsignacion = asignaInmueble.idAsignacion JOIN etiquetaIndicador ON FormularioAlmacenamiento.idIndicador = etiquetaIndicador.idIndicador AND FormularioAsignacion.idFormulario = etiquetaIndicador.idFormulario AND FormularioAlmacenamiento.idAcordeon = etiquetaIndicador.idAcordeon JOIN plantillaTexto ON etiquetaIndicador.idEtiqueta = plantillaTexto.idControl JOIN Plantilla ON plantillaTexto.idPlantilla = Plantilla.idPlantilla WHERE Plantilla.idPlantilla = $idPlantilla and asignaInmueble.idAsignacion = $idAsignacion GROUP BY plantillaTexto.idControl;")->result_array();
    }
    function getTablasPlantilla($idPlantilla)
    {
        return $this->db->query("SELECT PlantillaTablas.* FROM PlantillaTablas JOIN Plantilla on PlantillaTablas.idPlantilla = Plantilla.idPlantilla WHERE Plantilla.idPlantilla=$idPlantilla;")->result_array();
    }
    function getDatosTablaPlantilla($idPlantillaTabla, $idAsignacion)
    {
        return $this->db->query("SELECT FormularioAlmacenamientoAcordeon.*, FormularioTablaAcordeon.idAcordeon, FormularioTablaAcordeon.idFormularioAsignacion, PlantillaTablaColumnas.nombreColumna FROM FormularioAlmacenamientoAcordeon JOIN FormularioTablaAcordeon ON FormularioTablaAcordeon.idFormularioTablaAcordeon = FormularioAlmacenamientoAcordeon.idFormularioTablaAcordeon JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador = FormularioAlmacenamientoAcordeon.idIndicador AND AcordeonIndicador.idAcordeon = FormularioTablaAcordeon.idAcordeon JOIN FormularioAsignacion Asignacion on FormularioTablaAcordeon.idFormularioAsignacion = Asignacion.idFormularioAsignacion JOIN asignaInmueble a on Asignacion.idAsignacion = a.idAsignacion JOIN Acordeon ON AcordeonIndicador.idAcordeon = Acordeon.idAcordeon JOIN formIndicador on AcordeonIndicador.idIndicador = formIndicador.idIndicador JOIN PlantillaTablas on Acordeon.idAcordeon = PlantillaTablas.idAcordeon JOIN PlantillaTablaColumnas on PlantillaTablas.idPlantillaTabla = PlantillaTablaColumnas.idPlantillaTablas AND formIndicador.idIndicador=PlantillaTablaColumnas.idIndicador WHERE a.idAsignacion = $idAsignacion And PlantillaTablas.idPlantillaTabla=$idPlantillaTabla ORDER BY idAcordeon, idFormularioTablaAcordeon, idFormularioAlmacenamientoAcordeon, AcordeonIndicador.posicion;")->result_array();
    }
    function getEtiquetasAcuse($idPlantilla)
    {
        return $this->db->get_where("PlantillaAcuse", array('idPlantilla' => $idPlantilla))->result_array();
    }
    function getValoresAcuse($idAsignacion, $idIndicadorAcuse)
    {
        $this->db->select("*");
        $this->db->from("acuseVisita");
        $this->db->where("idAsignacion", $idAsignacion);
        $this->db->where("idIndicador", $idIndicadorAcuse);
        return $this->db->get()->row_array();
    }
    function obtenerDatosProcedimientoEvacuacion($idAsignacion)
    {
        return $this->db->query("SELECT DatosProcedimientoEvacuacion.*, tablaProcedimiento.paso, tablaProcedimiento.proceso FROM (SELECT PasosEvacuacion.ordenPaso, ProcesosEvacuacion.orden, PasosEvacuacion.paso, ProcesosEvacuacion.proceso, ProcesosEvacuacion.id_proceso FROM ProcesosEvacuacion JOIN PasosEvacuacion ON ProcesosEvacuacion.id_paso = PasosEvacuacion.id_paso) tablaProcedimiento LEFT JOIN DatosProcedimientoEvacuacion ON DatosProcedimientoEvacuacion.id_proceso=tablaProcedimiento.id_proceso AND DatosProcedimientoEvacuacion.idAsignacion=$idAsignacion ORDER BY tablaProcedimiento.ordenPaso ASC, tablaProcedimiento.orden ASC;")->result_array();
    }
    function getDatosCentroTrabajo($idAsignacion)
    {
        //obtiene el glosario de etiquetas de una plantilla
        return $this->db->query("
SELECT
  CentrosDeTrabajo.nombre         as nombreCentroTrabajo,
  CentrosDeTrabajo.idDet          as idDet,
  CentrosDeTrabajo.nomContacto    as responsableInmueble,
  CentrosDeTrabajo.puestoContacto as puestoResponsable,
  CentrosDeTrabajo.telContacto    as telefonoResponsable,
  CentrosDeTrabajo.email          as emailCentroTrabajo,
  CentrosDeTrabajo.calle          as calleCentroTrabajo,
  CentrosDeTrabajo.numeroInterior as numeroInteriorCentroTrabajo,
  CentrosDeTrabajo.numeroExterior as numeroExteriorCentroTrabajo,
  CentrosDeTrabajo.telefonoInmueble as telefonoInmueble,
  CentrosDeTrabajo.correoInmueble as correoInmueble,
  CentrosDeTrabajo.horarioFuncionamientoInicio as horarioFuncionamientoInicio,
  CentrosDeTrabajo.horarioFuncionamientoFin as horarioFuncionamientoFin,
  CentrosDeTrabajo.horarioAtencionInicio as horarioAtencionInicio,
  CentrosDeTrabajo.horarioAtencionFin as horarioAtencionFin,
  CentrosDeTrabajo.giroInmueble as giroInmueble,
  CentrosDeTrabajo.latitud as latitud,
  CentrosDeTrabajo.longitud as longitud,
  CentrosDeTrabajo.metros         as metrosCentroTrabajo,
  inmuebles.nombreInmueble        as tipoInmuebleCentroTrabajo,
  Clientes.nombreCliente          as nombreCliente,
  Clientes.correoCl               as emailCliente,
  Formato.razonSocial             as razonSocial,
  Formato.nombre                  as nombreFormato,
  Formato.nombreRepresentante     as representanteLegal,
  Formato.rfc                     as rfc,
  Formato.comentarioRFC           as comentarioRFC,
  Formato.domicilioFiscal         as domicilioFiscal,
  Formato.foto                    as fotoFormato,
  regiones.nombreRegion           as nombreColonia,
  LPAD(regiones.cp, 5, 0)         as codigoPostal,
  municipios.nombreMunicipio      as nombreMunicipio,
  estados.nombreEstado            as nombreEstado,
  Usuario.nombre                  as nombreAnalista,
  Usuario.direccion               as direccionAnalista,
  Usuario.correo                  as correoAnalista,
  Usuario.telefono                as telefonoAnalista,
  Usuario.rfcUser                 as rfcAnalista,
  Usuario.curpUser                as curpAnalista,
  Usuario.telefonoOficina         as telefonoOficinaAnalista,
  Usuario.ContactoEmergencia      as contactoEmergenciaAnalista,
  Usuario.padecimientoUser        as padecimientoAnalista,
  asignaInmueble.nombreAtendioVisita as nombreAtendioVisita
FROM CentrosDeTrabajo
  JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo
  JOIN regiones on CentrosDeTrabajo.idColonia = regiones.idRegiones
  JOIN municipios on regiones.municipio = municipios.idMunicipio
  JOIN estados on municipios.estado = estados.id_Estado
  JOIN Formato on CentrosDeTrabajo.idFormato = Formato.idFormato
  JOIN Clientes ON Formato.idCliente = Clientes.idCliente
  JOIN AnalistaOti on asignaInmueble.idAsignacion = AnalistaOti.idAsignacion
  JOIN Usuario ON AnalistaOti.idUsuario = Usuario.idUsuario
  JOIN inmuebles ON CentrosDeTrabajo.idInmueble = inmuebles.idInmueble
WHERE asignaInmueble.idAsignacion = $idAsignacion;")->row_array();
    }

}