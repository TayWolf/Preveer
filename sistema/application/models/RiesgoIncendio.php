<?php


class RiesgoIncendio extends CI_Model
{

    function getDatosCentroTrabajo($idAsignacion)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CentrosDeTrabajo.calle, CentrosDeTrabajo.numeroInterior as numinterior, CentrosDeTrabajo.numeroExterior as numexterior,  CentrosDeTrabajo.correoInmueble, CentrosDeTrabajo.idDet as numeroSucursal, CentrosDeTrabajo.nombre as nombreSucursal, CentrosDeTrabajo.giroInmueble as aep, Usuario.nombre as nombreRealizo, (SELECT COUNT(idAsignacion) FROM VisitasInmueble WHERE VisitasInmueble.idAsignacion=$idAsignacion AND tipoVisita=1) as numeroVisita, asignaInmueble.nombreAtendioVisita, Formato.nombre as nombreFormato, Formato.rfc, Formato.comentarioRFC, Formato.domicilioFiscal, Formato.razonSocial,regiones.nombreRegion,LPAD(regiones.cp, 5, 0) as codigoPostal, municipios.nombreMunicipio, estados.nombreEstado, CentrosDeTrabajo.correoInmueble, CentrosDeTrabajo.telefonoInmueble, CentrosDeTrabajo.nomContacto, CentrosDeTrabajo.puestoContacto, CentrosDeTrabajo.telContacto, CentrosDeTrabajo.email FROM asignaInmueble LEFT JOIN CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo LEFT JOIN AnalistaOti ON AnalistaOti.idAsignacion =$idAsignacion LEFT JOIN Usuario ON Usuario.idUsuario=AnalistaOti.idUsuario LEFT JOIN Formato ON CentrosDeTrabajo.idFormato=Formato.idFormato LEFT JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia LEFT JOIN municipios ON municipios.idMunicipio=regiones.municipio LEFT JOIN estados ON estados.id_Estado=municipios.estado where asignaInmueble.idAsignacion=$idAsignacion")->row_array();

    }
    function getNombreCentroTrabajo($idAsignacion)
    {
        $arreglo=$this->db->query("SELECT CONCAT(CentrosDeTrabajo.nombre,' (OTI ',Oti.idOti,')') as nombre FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE asignaInmueble.idAsignacion=$idAsignacion")->row_array();
        return $arreglo['nombre'];
    }
    function getIdCentroTrabajo($idAsignacion)
    {
        $arreglo = $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo WHERE asignaInmueble.idAsignacion=$idAsignacion")->row_array();
        return $arreglo['idCentroTrabajo'];
    }
    function getTiposInmueble()
    {
        return $this->db->get("inmuebles")->result_array();
    }

    function getAllFormatos()
    {
        return $this->db->get("Formato")->result_array();
    }
    function getAbreviaturas()
    {
        return $this->db->get("abreviaturaPc")->result_array();
    }
    function getIndicadores()
    {
        return $this->db->query("SELECT formIndicador.*, Acordeon.idAcordeon, abreviaturaPc.abreviatura, FormularioAcordeon.idControl as idFormulario FROM formIndicador JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador = formIndicador.idIndicador JOIN Acordeon on Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon = Acordeon.idAcordeon JOIN abreviaturaIndicador ON formIndicador.idIndicador = abreviaturaIndicador.idIndicador JOIN abreviaturaPc ON abreviaturaIndicador.idAbreviaturaPc = abreviaturaPc.idAbreviaturaPc WHERE Acordeon.tablaRegistro != 1 ORDER BY AcordeonIndicador.posicion")->result_array();
    }

    function getIndicadoresTablas()
    {
        return $this->db->query("SELECT formIndicador.*, Acordeon.*, abreviaturaPc.abreviatura, FormularioAcordeon.idControl as idFormulario FROM formIndicador JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador = formIndicador.idIndicador JOIN Acordeon on Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon = Acordeon.idAcordeon LEFT JOIN abreviaturaIndicador ON formIndicador.idIndicador = abreviaturaIndicador.idIndicador LEFT JOIN abreviaturaPc ON abreviaturaIndicador.idAbreviaturaPc = abreviaturaPc.idAbreviaturaPc LEFT JOIN multiplicadorIndicador ON formIndicador.idIndicador = multiplicadorIndicador.idIndicador WHERE Acordeon.tablaRegistro = 1 AND (abreviaturaPc.idAbreviaturaPc IS NOT NULL OR multiplicadorIndicador.idIndicador IS NOT NULL) ORDER BY FormularioAcordeon.posicion, AcordeonIndicador.posicion, abreviaturaPc.abreviatura;")->result_array();
    }

    function getInformacionDetalle($idAsignacion)
    {
        return $this->db->query("SELECT formIndicador.*, (FormularioAlmacenamiento.valor * (CASE WHEN (Multiplicadores.valor IS NULL OR LENGTH (Multiplicadores.valor)<1) THEN 1 ELSE Multiplicadores.valor END)) as resultado, abreviaturaPc.*, Acordeon.idAcordeon FROM FormularioAlmacenamiento JOIN formIndicador ON FormularioAlmacenamiento.idIndicador = formIndicador.idIndicador JOIN FormularioAsignacion ON FormularioAlmacenamiento.idFormularioAsignacion = FormularioAsignacion.idFormularioAsignacion JOIN asignaInmueble ON FormularioAsignacion.idAsignacion = asignaInmueble.idAsignacion JOIN abreviaturaIndicador ON formIndicador.idIndicador = abreviaturaIndicador.idIndicador JOIN abreviaturaPc ON abreviaturaIndicador.idAbreviaturaPc = abreviaturaPc.idAbreviaturaPc JOIN AcordeonIndicador ON formIndicador.idIndicador = AcordeonIndicador.idIndicador JOIN Acordeon ON AcordeonIndicador.idAcordeon = Acordeon.idAcordeon LEFT JOIN (SELECT FormularioAlmacenamiento.valor, otroIndicador.* FROM FormularioAlmacenamiento JOIN formIndicador ON FormularioAlmacenamiento.idIndicador = formIndicador.idIndicador JOIN FormularioAsignacion ON FormularioAlmacenamiento.idFormularioAsignacion = FormularioAsignacion.idFormularioAsignacion JOIN asignaInmueble ON FormularioAsignacion.idAsignacion = asignaInmueble.idAsignacion JOIN multiplicadorIndicador ON formIndicador.idIndicador = multiplicadorIndicador.idIndicador JOIN abreviaturaIndicador ON multiplicadorIndicador.IdAbIndicador = abreviaturaIndicador.IdAbIndicador JOIN formIndicador otroIndicador ON abreviaturaIndicador.idIndicador = otroIndicador.idIndicador WHERE asignaInmueble.idAsignacion = $idAsignacion) Multiplicadores ON Multiplicadores.idIndicador = formIndicador.idIndicador WHERE asignaInmueble.idAsignacion = $idAsignacion;")->result_array();
    }
    function getInformacionTablas($idAsignacion)
    {
        return $this->db->query("SELECT FormularioAlmacenamientoAcordeon.*, FormularioTablaAcordeon.idAcordeon, FormularioTablaAcordeon.idFormularioAsignacion FROM FormularioAlmacenamientoAcordeon JOIN FormularioTablaAcordeon ON FormularioTablaAcordeon.idFormularioTablaAcordeon = FormularioAlmacenamientoAcordeon.idFormularioTablaAcordeon JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador = FormularioAlmacenamientoAcordeon.idIndicador AND AcordeonIndicador.idAcordeon = FormularioTablaAcordeon.idAcordeon JOIN Acordeon ON FormularioTablaAcordeon.idAcordeon = Acordeon.idAcordeon JOIN FormularioAsignacion ON FormularioTablaAcordeon.idFormularioAsignacion = FormularioAsignacion.idFormularioAsignacion JOIN asignaInmueble ON FormularioAsignacion.idAsignacion = asignaInmueble.idAsignacion JOIN formIndicador ON AcordeonIndicador.idIndicador = formIndicador.idIndicador LEFT JOIN multiplicadorIndicador ON multiplicadorIndicador.idIndicador=formIndicador.idIndicador LEFT JOIN abreviaturaIndicador ON formIndicador.idIndicador = abreviaturaIndicador.idIndicador LEFT JOIN abreviaturaPc ON abreviaturaIndicador.idAbreviaturaPc = abreviaturaPc.idAbreviaturaPc WHERE asignaInmueble.idAsignacion= $idAsignacion AND (idMultiplicador IS NOT NULL OR abreviaturaPc.idAbreviaturaPc IS NOT NULL) ORDER BY idAcordeon, idFormularioTablaAcordeon, AcordeonIndicador.posicion, idFormularioAlmacenamientoAcordeon, abreviaturaPc.abreviatura")->result_array();
    }
    function getExtensionConstruccion($idAsignacion)
    {
        $resultado=$this->db->query("SELECT COALESCE(SUM((FormularioAlmacenamiento.valor * (CASE WHEN (Multiplicadores.valor IS NULL OR LENGTH(Multiplicadores.valor) < 1) THEN 1 ELSE Multiplicadores.valor END))), 0) as resultado FROM FormularioAlmacenamiento JOIN formIndicador ON FormularioAlmacenamiento.idIndicador = formIndicador.idIndicador JOIN FormularioAsignacion ON FormularioAlmacenamiento.idFormularioAsignacion = FormularioAsignacion.idFormularioAsignacion JOIN asignaInmueble ON FormularioAsignacion.idAsignacion = asignaInmueble.idAsignacion JOIN abreviaturaIndicador ON formIndicador.idIndicador = abreviaturaIndicador.idIndicador JOIN abreviaturaPc ON abreviaturaIndicador.idAbreviaturaPc = abreviaturaPc.idAbreviaturaPc JOIN AcordeonIndicador ON formIndicador.idIndicador = AcordeonIndicador.idIndicador JOIN Acordeon ON AcordeonIndicador.idAcordeon = Acordeon.idAcordeon LEFT JOIN (SELECT FormularioAlmacenamiento.valor, otroIndicador.* FROM FormularioAlmacenamiento JOIN formIndicador ON FormularioAlmacenamiento.idIndicador = formIndicador.idIndicador JOIN FormularioAsignacion ON FormularioAlmacenamiento.idFormularioAsignacion = FormularioAsignacion.idFormularioAsignacion JOIN asignaInmueble ON FormularioAsignacion.idAsignacion = asignaInmueble.idAsignacion JOIN multiplicadorIndicador ON formIndicador.idIndicador = multiplicadorIndicador.idIndicador JOIN abreviaturaIndicador ON multiplicadorIndicador.IdAbIndicador = abreviaturaIndicador.IdAbIndicador JOIN formIndicador otroIndicador ON abreviaturaIndicador.idIndicador = otroIndicador.idIndicador WHERE asignaInmueble.idAsignacion = $idAsignacion) Multiplicadores ON Multiplicadores.idIndicador = formIndicador.idIndicador WHERE asignaInmueble.idAsignacion = $idAsignacion AND abreviaturaPc.idAbreviaturaPc = 9")->row_array();
        return $resultado['resultado'];

    }
}