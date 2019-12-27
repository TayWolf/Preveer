<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VisitasAcuses extends CI_Model
{
    public $variable;

    function __construct()
    {
        parent::__construct();
    }

    function getInstalacion($grupo)
    {
        return $this->db->query("SELECT idIndicador, nombreIndicador FROM AcuseIndicadores WHERE idGrupoIndicador=$grupo")->result_array();
    }

    function getRecomendacione($idAsigna)
    {
        return $this->db->query("SELECT * FROM `ProcedimientoEvacuacion` WHERE `idAsignacion` =$idAsigna")->result_array();
    }


    function obtenerDatosGuardados($idFa)
    {
        return $this->db->query("SELECT * FROM FormularioAlmacenamiento WHERE `idFormularioAsignacion` = $idFa and `idAcordeon` = 18")->result_array();
    }

    function getInstalacionBotiquin()
    {
        return $this->db->query("SELECT formIndicador.*, Acordeon.idAcordeon FROM formIndicador JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador=formIndicador.idIndicador JOIN Acordeon on Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=21 and FormularioAcordeon.idAcordeon=18 ORDER BY AcordeonIndicador.posicion")->result_array();
    }

    function getInstalacionBotiquinAsignacion($idAsignacion)
    {
        return $this->db->query("SELECT formIndicador.*, Acordeon.idAcordeon, FormularioAlmacenamiento.valor FROM formIndicador JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador = formIndicador.idIndicador JOIN Acordeon on Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon = Acordeon.idAcordeon JOIN FormularioAlmacenamiento FormularioAlmacenamiento on formIndicador.idIndicador = FormularioAlmacenamiento.idIndicador JOIN FormularioAsignacion Asignacion on FormularioAlmacenamiento.idFormularioAsignacion = Asignacion.idFormularioAsignacion JOIN asignaInmueble a on Asignacion.idAsignacion = a.idAsignacion WHERE FormularioAcordeon.idControl = 21 and FormularioAcordeon.idAcordeon = 18 AND a.idAsignacion=$idAsignacion ORDER BY AcordeonIndicador.posicion")->result_array();
    }

    function getDoctosEstado($idAsignacion)
    {
        return $this->db->query("SELECT Documentos.*, estados.nombreEstado FROM 
        Documentos, estados WHERE 
        idEstado=(SELECT estados.id_estado FROM asignaInmueble
        JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo 
        JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia 
        JOIN municipios ON regiones.municipio=municipios.idMunicipio 
        JOIN estados ON municipios.estado=estados.id_Estado WHERE idAsignacion=$idAsignacion) 
        AND Documentos.idEstado=estados.id_Estado")->result_array();
    }

    function ResultadoCheck($idAsignacion)
    {
        // return $this->db->query("SELECT Documentos.nombreDocumento, estados.nombreEstado,ponderadorDocumento.nombrePonderador,documentoValor.comentario FROM asignaInmueble
        // JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo 
        // JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia 
        // JOIN municipios ON regiones.municipio=municipios.idMunicipio 
        // JOIN estados ON municipios.estado=estados.id_Estado join Documentos on Documentos.idEstado=estados.id_Estado join documentoValor on documentoValor.idAsignacion=asignaInmueble.idAsignacion join ponderadorDocumento on ponderadorDocumento.idPonderador=documentoValor.idPonderador where asignaInmueble.idAsignacion=$idAsignacion GROUP by Documentos.idDocumentos")->result_array();
        return $this->db->query("SELECT Documentos.idDocumentos,Documentos.nombreDocumento, estados.nombreEstado FROM asignaInmueble
        JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo 
        JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia 
        JOIN municipios ON regiones.municipio=municipios.idMunicipio 
        JOIN estados ON municipios.estado=estados.id_Estado join Documentos on Documentos.idEstado=estados.id_Estado  where asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function ResultadoPonde($idDocumentos, $idAsignacion)
    {
        return $this->db->query("SELECT documentoValor.*,ponderadorDocumento.nombrePonderador FROM `documentoValor` join ponderadorDocumento on ponderadorDocumento.idPonderador=documentoValor.idPonderador WHERE `idAsignacion`=$idAsignacion and idDocumento=$idDocumentos")->row_array();


    }

    function borrarAcuse($idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->delete("acuseVisita");
    }

    function insertarValoresAcuse($data)
    {
        $this->db->insert("acuseVisita", $data);
    }

    function getAcuses($idAsignacion)
    {
        return $this->db->query("SELECT * FROM acuseVisita WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function getRiesgoAcuse()
    {
        return $this->db->get("RiesgosAcuse")->result_array();
    }


    function getPrioridadMejora()
    {
        return $this->db->get("prioridadMejora")->result_array();
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


    /* GUARDAR DATOS GRID */

    function actualizarDatosOM($data, $where)
    {
        $this->db->where($where);
        $this->db->update('OMPC', $data);

    }

    function getFormularios()
    {
        return $this->db->query("SELECT * FROM Aut")->result_array();
    }

    function getFormularioAsignacion($idAsignacion, $idFormulario)
    {
        $reporte = $this->db->query("SELECT idFormularioAsignacion FROM FormularioAsignacion WHERE idAsignacion=$idAsignacion AND idFormulario=$idFormulario")->result_array();
        if (empty($reporte)) {
            $this->db->insert('FormularioAsignacion', array('idFormulario' => $idFormulario, 'idAsignacion' => $idAsignacion));
            return $this->getFormularioAsignacion($idAsignacion, $idFormulario);
        }
        return $reporte;
    }


    function getObservaciones($idFormularioAsignacion)
    {
        //Tipo indicador 7 son observaciones
        return $this->db->query("SELECT * FROM FormularioAlmacenamiento JOIN formIndicador ON formIndicador.idIndicador=FormularioAlmacenamiento.idIndicador WHERE formIndicador.tipoIndicador=7 AND FormularioAlmacenamiento.idFormularioAsignacion=$idFormularioAsignacion AND FormularioAlmacenamiento.idIndicador NOT IN (SELECT idIndicador FROM OMPC WHERE OMPC.idFormularioAsignacion=$idFormularioAsignacion);")->result_array();
    }

    function insertarOMPC($arregloInsercionObservacion)
    {
        $this->db->insert('OMPC', $arregloInsercionObservacion);
    }

    function getOMPC($idFormularioAsignacion)
    {
        return $this->db->query("SELECT OMPC.*, FormularioFotos.foto, FormularioAlmacenamiento.valor, Aut.nombreFormulario, prioridadMejora.color  as colorPM, prioridadMejora.nombre AS nombrePM, RiesgosAcuse.nombreRiesgo FROM OMPC LEFT JOIN prioridadMejora ON prioridadMejora.idPrioridad = OMPC.idPrioridad LEFT JOIN RiesgosAcuse ON OMPC.idRiesgo = RiesgosAcuse.idRiesgo LEFT JOIN FormularioFotos ON FormularioFotos.idFormularioFoto = OMPC.idFormularioFoto JOIN FormularioAsignacion on OMPC.idFormularioAsignacion = FormularioAsignacion.idFormularioAsignacion JOIN Aut ON FormularioAsignacion.idFormulario = Aut.idControl JOIN FormularioAcordeon ON Aut.idControl = FormularioAcordeon.idControl JOIN Acordeon ON FormularioAcordeon.idAcordeon = Acordeon.idAcordeon JOIN AcordeonIndicador ON Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN formIndicador ON OMPC.idIndicador = formIndicador.idIndicador JOIN FormularioAlmacenamiento on formIndicador.idIndicador = FormularioAlmacenamiento.idIndicador WHERE formIndicador.idIndicador = OMPC.idIndicador AND AcordeonIndicador.idIndicador = OMPC.idIndicador AND Acordeon.idAcordeon = OMPC.idAcordeon AND FormularioAlmacenamiento.idFormularioAsignacion = OMPC.idFormularioAsignacion AND FormularioAsignacion.idFormularioAsignacion = OMPC.idFormularioAsignacion AND OMPC.idFormularioAsignacion =$idFormularioAsignacion GROUP BY  OMPC.idOMPC")->result_array();
    }

    function getOMPCPDF($idFormularioAsignacion)
    {
        return $this->db->query("SELECT OMPC.*, FormularioFotos.foto, FormularioAlmacenamiento.valor, Aut.nombreFormulario, prioridadMejora.color  as colorPM, prioridadMejora.nombre AS nombrePM, RiesgosAcuse.nombreRiesgo FROM OMPC LEFT JOIN prioridadMejora ON prioridadMejora.idPrioridad = OMPC.idPrioridad LEFT JOIN RiesgosAcuse ON OMPC.idRiesgo = RiesgosAcuse.idRiesgo LEFT JOIN FormularioFotos ON FormularioFotos.idFormularioFoto = OMPC.idFormularioFoto JOIN FormularioAsignacion on OMPC.idFormularioAsignacion = FormularioAsignacion.idFormularioAsignacion JOIN Aut ON FormularioAsignacion.idFormulario = Aut.idControl JOIN FormularioAcordeon ON Aut.idControl = FormularioAcordeon.idControl JOIN Acordeon ON FormularioAcordeon.idAcordeon = Acordeon.idAcordeon JOIN AcordeonIndicador ON Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN formIndicador ON OMPC.idIndicador = formIndicador.idIndicador JOIN FormularioAlmacenamiento on formIndicador.idIndicador = FormularioAlmacenamiento.idIndicador WHERE OMPC.visual=1 and formIndicador.idIndicador = OMPC.idIndicador AND AcordeonIndicador.idIndicador = OMPC.idIndicador AND Acordeon.idAcordeon = OMPC.idAcordeon AND FormularioAlmacenamiento.idFormularioAsignacion = OMPC.idFormularioAsignacion AND FormularioAsignacion.idFormularioAsignacion = OMPC.idFormularioAsignacion AND OMPC.idFormularioAsignacion =$idFormularioAsignacion GROUP BY  OMPC.idOMPC")->result_array();
    }

    function getidOMPC($idFormularioAsignacion)
    {
        return $this->db->query("SELECT * from OMPC WHERE idOMPC=$idFormularioAsignacion")->result_array();
    }

    function verificarVisual($idOm)
    {
        return $this->db->query("SELECT * FROM `OMPC` WHERE `idOMPC`=$idOm")->row();
    }

    function getDatosCentroTrabajo($idAsignacion)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CentrosDeTrabajo.calle, CentrosDeTrabajo.numeroInterior as numinterior, CentrosDeTrabajo.numeroExterior as numexterior,  CentrosDeTrabajo.correoInmueble, CentrosDeTrabajo.idDet as numeroSucursal, CentrosDeTrabajo.nombre as nombreSucursal, CentrosDeTrabajo.giroInmueble as aep, Usuario.nombre as nombreRealizo, (SELECT COUNT(idAsignacion) FROM VisitasInmueble WHERE VisitasInmueble.idAsignacion=$idAsignacion AND tipoVisita=1) as numeroVisita, asignaInmueble.nombreAtendioVisita, Formato.nombre as nombreFormato, Formato.rfc, Formato.comentarioRFC, Formato.domicilioFiscal, Formato.razonSocial,regiones.nombreRegion,LPAD(regiones.cp, 5, 0) as codigoPostal, municipios.nombreMunicipio, estados.nombreEstado, CentrosDeTrabajo.correoInmueble, CentrosDeTrabajo.telefonoInmueble, CentrosDeTrabajo.nomContacto, CentrosDeTrabajo.puestoContacto, CentrosDeTrabajo.telContacto, CentrosDeTrabajo.email FROM asignaInmueble LEFT JOIN CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo LEFT JOIN AnalistaOti ON AnalistaOti.idAsignacion =$idAsignacion LEFT JOIN Usuario ON Usuario.idUsuario=AnalistaOti.idUsuario LEFT JOIN Formato ON CentrosDeTrabajo.idFormato=Formato.idFormato LEFT JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia LEFT JOIN municipios ON municipios.idMunicipio=regiones.municipio LEFT JOIN estados ON estados.id_Estado=municipios.estado where asignaInmueble.idAsignacion=$idAsignacion")->row_array();

    }

    function getIdCentroTrabajo($idAsignacion)
    {
        $arreglo = $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo WHERE asignaInmueble.idAsignacion=$idAsignacion")->row_array();
        return $arreglo['idCentroTrabajo'];
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

    function getNombreAtendioVisita($idAsignacion)
    {
        return $this->db->query("SELECT nombreAtendioVisita FROM asignaInmueble WHERE idAsignacion=$idAsignacion")->row_array();
    }


    function getDatosOMPC($idAsignacion)
    {
        return $this->db->query("SELECT OMPC.*, RiesgosAcuse.nombreRiesgo, prioridadMejora.nombre AS nombrePM, prioridadMejora.color AS colorPM FROM OMPC 
                                 LEFT JOIN RiesgosAcuse ON OMPC.idRiesgo = RiesgosAcuse.idRiesgo 
                                 LEFT JOIN prioridadMejora ON OMPC.idPrioridad = prioridadMejora.idPrioridad 
                                 WHERE idAsignacion=$idAsignacion")->result_array();
    }


    function datosTablasshi($idAsignacion)
    {
        return $this->db->query("SELECT OMSSH.*, prioridadIntervencion.nombre, areaClubesSW.descripcion,prioridadIntervencion.color FROM OMSSH 
                                 LEFT JOIN prioridadIntervencion ON OMSSH.idPrioridadIntervencion = prioridadIntervencion.idPrioridad 
                                 JOIN areaClubesSW ON areaClubesSW.idArea=OMSSH.idArea
                                 WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function idCentroTraba($idAsignacion)
    {
        return $this->db->query("SELECT * FROM `asignaInmueble` WHERE `idAsignacion`=$idAsignacion")->result_array();
    }

    function datosTablasshiPDF($idCentroTrabajo)
    {

        return $this->db->query("SELECT OMSSH.*, prioridadIntervencion.nombre, areaClubesSW.descripcion,prioridadIntervencion.color FROM OMSSH LEFT JOIN prioridadIntervencion ON OMSSH.idPrioridadIntervencion = prioridadIntervencion.idPrioridad JOIN areaClubesSW ON areaClubesSW.idArea=OMSSH.idArea join asignaInmueble on asignaInmueble.idAsignacion=OMSSH.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo WHERE CentrosDeTrabajo.idCentroTrabajo=$idCentroTrabajo")->result_array();
    }

    function insertarImagenOMPC($data, $where)
    {
        $datos = $this->db->get_where("OMPC", $where)->result_array();

        if (empty($datos)) {
            $this->db->insert("OMPC", $data);
        } else {
            $this->db->where($where);
            $this->db->update('OMPC', $data);
        }
    }

    function actualizarImagenOMPC($idFormulario, $idObservacion, $data)
    {
        $this->db->where(array("idFormulario" => $idFormulario, "idObservacion" => $idObservacion));
        $this->db->update('OMPC', $data);
    }

    function actualizarDatosTablaFA($data, $idAcorde, $idIndic, $idFormA)
    {
        $this->db->where(array("idIndicador" => $idIndic, "idAcordeon" => $idAcorde, "idFormularioAsignacion" => $idFormA));
        $this->db->update('FormularioAlmacenamiento', $data);
    }

    function getImagenesOMPC($array)
    {
        return $this->db->get_where("OMPC", $array)->result_array();
    }

    function getAllFotos($idFormularioAsignacion)
    {
        return $this->db->query("SELECT FormularioFotos.*,OMPC.idOMPC, OMPC.idFormularioFoto as fotoSeleccionada FROM FormularioFotos LEFT JOIN OMPC ON OMPC.idFormularioFoto=FormularioFotos.idFormularioFoto WHERE FormularioFotos.idFormularioAsignacion=$idFormularioAsignacion")->result_array();
    }

    function establecerFoto($idOMPC, $data)
    {
        $this->db->where('idOMPC', $idOMPC);
        $this->db->update('OMPC', $data);
    }

    function setNombreAtendioVisita($idAsignacion, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('asignaInmueble', $data);
    }

    function insertarHistoricoOportunidadMejora($data)
    {
        $this->db->insert("HistoricoOportunidadMejora", $data);
    }

    function nombreUsuarioVisita($idusuariobase)
    {
        $resultado = $this->db->query(" SELECT Usuario.idUsuario, Usuario.nombre as nombreUsuarioVisita FROM Usuario WHERE idUsuario=$idusuariobase ")->row_array();

        return $resultado['nombreUsuarioVisita'];

    }

    function getNumeroInspeccion($idAsignacion)
    {
        $numeroInspeccion = $this->db->query("SELECT * FROM HistoricoAcuseVisita WHERE idAsignacion=$idAsignacion GROUP BY HistoricoAcuseVisita.fecha")->result_array();
        return sizeof($numeroInspeccion);
    }

    function guardarHistoricoAcuse($data)
    {
        $this->db->insert("HistoricoAcuseVisita", $data);
    }

    function borrarfotoAcuseVisita($idAsignacion)
    {
        $array = $this->db->query("SELECT * FROM FotoAcuseVisita WHERE idAsignacion=$idAsignacion")->row_array();
        $this->db->where("idAsignacion", $idAsignacion);
        $this->db->delete("FotoAcuseVisita");
        return $array;
    }

    function getFotoAcuseVisita($idAsignacion)
    {
        $array = $this->db->query("SELECT * FROM FotoAcuseVisita WHERE idAsignacion=$idAsignacion")->row_array();
        return $array;
    }

    function subirImagenAcuseVisita($data)
    {
        $this->db->insert("FotoAcuseVisita", $data);
    }

    //Guarda el historico de la oportunidad de mejora de PC para que sea exportado a excel
    function insertarHistoricoOMPC($data)
    {
        $this->db->insert("HistorialExcelOMPC", $data);
    }

    function getFechasHistoricoOMPC($idAsignacion)
    {
        $this->db->select("idHistorialExcelOMPC, fecha");
        $this->db->from("HistorialExcelOMPC");
        $this->db->where("idAsignacion", $idAsignacion);
        return $this->db->get()->result_array();
    }

    function getHistorico($idHistorico)
    {
        $this->db->select("historial");
        $this->db->from("HistorialExcelOMPC");
        $this->db->where("idHistorialExcelOMPC", $idHistorico);
        return $this->db->get()->row_array();
    }

    function insertCorreoEnviado($data)
    {
        $this->db->insert("CorreoEnviado", $data);
        return $this->db->insert_id();
    }

    function getCorreosEnviados($idAsignacion)
    {
        $this->db->select("CorreoEnviado.*, Logeo.idLogeo, Logeo.nickName, Logeo.idUsuario, asignaInmueble.idAsignacion");
        $this->db->from("CorreoEnviado");
        $this->db->join("Logeo", "Logeo.idLogeo=CorreoEnviado.idLogeo", "LEFT");
        $this->db->join("asignaInmueble", "asignaInmueble.idAsignacion=CorreoEnviado.idAsignacion");
        $this->db->where("CorreoEnviado.idAsignacion", $idAsignacion);
        return $this->db->get()->result_array();
    }

}