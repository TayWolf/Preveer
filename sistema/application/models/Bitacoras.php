<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bitacoras extends CI_Model
{
    public $variable;

    function __construct()
    {
        parent::__construct();
    }


    function getTotalRowAllData($usuario = null)
    {
        if ($usuario == 1)
            $query = $this->db->query("SELECT COUNT(DISTINCT(CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')'))) as row FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion")->row_array();
        else
            $query = $this->db->query("SELECT COUNT(DISTINCT(CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')'))) as row FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion WHERE AnalistaOti.idUsuario = $usuario")->row_array();
        return $query['row'];
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

    function getIndicadorContador($idBitacora)
    {
        return $this->db->query("SELECT indicadorBitacoras.idIndicador,esContador FROM BitacoraIndicador JOIN indicadorBitacoras ON indicadorBitacoras.idIndicador=BitacoraIndicador.idIndicador WHERE BitacoraIndicador.idBitacora=$idBitacora AND indicadorBitacoras.esContador=$idBitacora")->result_array();
    }

    function getDatos($no_page, $usuario)
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if ($no_page == 1) {
            $first = 0;
            $last = $perpage;
        } else {
            $first = ($no_page - 1) * $perpage;
            $last = $first + ($perpage - 1);
        }
        if ($usuario != 1)
            return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') AS nombre, asignaInmueble.idAsignacion FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE AnalistaOti.idUsuario = $usuario AND Oti.statusActiva=1 GROUP BY asignaInmueble.idOti, CentrosDeTrabajo.idCentroTrabajo ORDER BY asignaInmueble.idOti DESC")->result_array();
    }
    function getBitacoraAsignacion($usuario)
    {
        if ($usuario != 1)
            return $this->db->query("SELECT BitacoraAsignacion.idAsignacion, BitacoraAsignacion.idBitacora FROM asignaInmueble JOIN BitacoraAsignacion ON BitacoraAsignacion.idAsignacion = asignaInmueble.idAsignacion INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE AnalistaOti.idUsuario = $usuario AND Oti.statusActiva=1 order by BitacoraAsignacion.idAsignacion, BitacoraAsignacion.idBitacora;")->result_array();
    }

    function getBitacorasAutoadministrables()
    {
        return $this->db->query("SELECT * FROM Bitacora")->result_array();
    }

    function cargarTabla($tabla, $idAsignacion)
    {
        return $this->db->query("SELECT $tabla.* FROM $tabla WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function cargarTablaPuente($tablaPuente, $tabla, $llavePrimaria, $idAsignacion)
    {
        return $this->db->query("SELECT $tablaPuente.* FROM $tablaPuente JOIN $tabla ON $tablaPuente.$llavePrimaria=$tabla.idBitacora WHERE $tabla.idAsignacion=$idAsignacion")->result_array();
    }

    function getInfoBitacora($idAsignacion, $tabla)
    {
        $consulta = $this->db->query("SELECT * FROM $tabla WHERE idAsignacion=$idAsignacion")->result_array();
        if (empty($consulta)) {
            $this->db->insert($tabla, array('idAsignacion' => $idAsignacion));
            return $this->getInfoBitacora($idAsignacion, $tabla);
        }
        return $consulta;

    }
    function getInformeBitacora($idAsignacion, $idBitacora)
    {
        return $this->db->query("SELECT * FROM InformeBitacora WHERE idAsignacion=$idAsignacion AND idBitacora=$idBitacora")->result_array();
    }

    function getDatoInformeBitacora($idInformeBitacora)
    {
        return $this->db->query("SELECT * FROM DatoInformeBitacora WHERE idInformeBitacora=$idInformeBitacora")->result_array();
    }
    function getCalculoInforme($idInformeBitacora)
    {
        return $this->db->query("SELECT CalculoInforme.*, indicadorBitacoras.tipoIndicador FROM CalculoInforme JOIN IndicadorCalculo ON CalculoInforme.idCalculo=IndicadorCalculo.idIndicadorCalculo JOIN indicadorBitacoras ON indicadorBitacoras.idIndicador=IndicadorCalculo.idIndicador WHERE CalculoInforme.idInformeBitacora=$idInformeBitacora")->result_array();
    }

    function insertarDatosBitacora($dataPuente, $tabla)
    {
        $this->db->insert($tabla, $dataPuente);
        return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
    }

    function registrarInformeBitacora($datos)
    {
        $this->db->insert("InformeBitacora", $datos);
        return $this->db->insert_id();
    }

    function insertarCalculoInforme($arregloCalculoInforme)
    {
        $this->db->insert("CalculoInforme", $arregloCalculoInforme);
    }
    function insertarIndicadorInforme($arregloIndicadorInforme)
    {
        $this->db->insert("DatoInformeBitacora", $arregloIndicadorInforme);
    }
    function actualizarDatosBitacora($dataPuente, $idBitacora,$tabla)
    {
        $this->db->where('idBitacora', $idBitacora);
        $this->db->update($tabla, $dataPuente);
    }
    function borrarDatosBitacora($idBitacora, $tabla)
    {
        $this->db->where('idBitacora', $idBitacora);
        $this->db->delete($tabla);
    }

    function insertarResultado($tabla, $arreglo)
    {
        foreach ($arreglo as $item)
        {
            $this->db->insert($tabla, $item);
        }
    }
    function eliminarResultado($idAsignacion, $tabla)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->delete($tabla);
    }
    function getAreasUbicacion()
    {
        return $this->db->get('areaClubesSW')->result_array();
    }
    function getOportunidadMejora($llavePrimaria,$tabla)
    {
        $datos=$this->db->query("SELECT * FROM $tabla WHERE idAlmacenamiento=$llavePrimaria")->result_array();
        if(empty($datos))
        {
            $this->db->insert($tabla, array('idAlmacenamiento' => $llavePrimaria));
            return $this->getOportunidadMejora($llavePrimaria, $tabla);
        }
        return $datos;

    }
    function deleteImagenTabla($borrar, $tabla, $llavePrimaria, $campoLlave)
    {
        $this->db->where("$campoLlave", $llavePrimaria);
        $this->db->update("$tabla", $borrar);
    }
    function borrarInforme($idAsignacion, $idBitacora)
    {

        $this->db->where(array('idAsignacion' => $idAsignacion, 'idBitacora'=> $idBitacora));
        $this->db->delete('InformeBitacora');
    }
    function actualizarImagenGeneralTabla($campoLlave, $llavePrimaria, $data, $tabla)
    {
        $this->db->where("$campoLlave", $llavePrimaria);
        $this->db->update("$tabla", $data);
    }
    function insertOportunidadMejora($cadena, $llavePrimaria,$tabla, $campo)
    {
        $this->db->where('idAlmacenamiento', $llavePrimaria);
        $this->db->update($tabla, array($campo => $cadena));
    }

    function getIndica($idBitacora)
    {
        return $this->db->query("SELECT indicadorBitacoras.* from indicadorBitacoras join BitacoraIndicador on BitacoraIndicador.idIndicador=indicadorBitacoras.idIndicador where BitacoraIndicador.idBitacora=$idBitacora ORDER BY BitacoraIndicador.posicion ASC")->result_array();
    }
    function getPonder($idBitacora, $condicion)
    {
        return $this->db->query("select indicadorPonderadorbitacoras.*, BitacoraPonderador.texto from BitacoraPonderador join indicadorPonderadorbitacoras on indicadorPonderadorbitacoras.idPonderador=BitacoraPonderador.idBitacoraPonderador join BitacoraIndicador on BitacoraIndicador.idIndicador=indicadorPonderadorbitacoras.idIndicador where BitacoraIndicador.idBitacora=$idBitacora $condicion GROUP by indicadorPonderadorbitacoras.idIndicador")->result_array();
    }
    function getArrayPonder($idBitacora, $condicion)
    {
        return $this->db->query("select indicadorPonderadorbitacoras.*, BitacoraPonderador.texto from BitacoraPonderador join indicadorPonderadorbitacoras on indicadorPonderadorbitacoras.idPonderador=BitacoraPonderador.idBitacoraPonderador join BitacoraIndicador on BitacoraIndicador.idIndicador=indicadorPonderadorbitacoras.idIndicador where BitacoraIndicador.idBitacora=$idBitacora $condicion ")->result_array();
    }
    function getPPonder($idI)
    {
        return $this->db->query("SELECT BitacoraPonderador.* FROM BitacoraPonderador join indicadorPonderadorbitacoras on BitacoraPonderador.idBitacoraPonderador=indicadorPonderadorbitacoras.idPonderador WHERE indicadorPonderadorbitacoras.idIndicador=$idI")->result_array();
    }

    function getRespaldoDatosBitacora($idAsignacion, $idBitacora)
    {
        return $this->db->query("SELECT * FROM AlmacenamientoBitacora JOIN DatosBitacora ON DatosBitacora.idAlmacenamiento=AlmacenamientoBitacora.idAlmacenamiento WHERE idBitacora=$idBitacora AND idAsignacion=$idAsignacion")->result_array();
    }
    function getRespaldoOportunidadMejoraBitacora($idAsignacion, $idBitacora)
    {
        return $this->db->query("SELECT * FROM AlmacenamientoBitacora JOIN OportunidadMejoraBitacora ON OportunidadMejoraBitacora.idAlmacenamiento=AlmacenamientoBitacora.idAlmacenamiento WHERE idBitacora=$idBitacora AND idAsignacion=$idAsignacion")->result_array();
    }
    function getRespaldoInformeBitacora($idAsignacion, $idBitacora)
    {
        return $this->db->query("SELECT * FROM InformeBitacora JOIN CalculoInforme ON CalculoInforme.idInformeBitacora=InformeBitacora.idInformeBitacora WHERE idBitacora=$idBitacora AND idAsignacion=$idAsignacion")->result_array();
    }
    function guardarRespaldo($data)
    {
        $this->db->insert("BitacoraRespaldo", $data);
    }


    function idCentro($idAsignacion)
    {
        return $this->db->query("SELECT * FROM `asignaInmueble` WHERE `idAsignacion`=$idAsignacion")->result_array();
    }


    function getDatosBitacora($idBitacora, $idCentro)
    {
        return $this->db->query("SELECT DatosBitacora.*, AlmacenamientoBitacora.idBitacora, AlmacenamientoBitacora.idAsignacion, indicadorBitacoras.tipoIndicador FROM DatosBitacora JOIN AlmacenamientoBitacora ON AlmacenamientoBitacora.idAlmacenamiento=DatosBitacora.idAlmacenamiento JOIN BitacoraIndicador ON BitacoraIndicador.idIndicador=DatosBitacora.idIndicador JOIN indicadorBitacoras ON indicadorBitacoras.idIndicador=DatosBitacora.idIndicador join asignaInmueble on asignaInmueble.idAsignacion=AlmacenamientoBitacora.idAsignacion WHERE AlmacenamientoBitacora.idBitacora=$idBitacora AND BitacoraIndicador.idBitacora=$idBitacora AND asignaInmueble.idCentroTrabajo=$idCentro GROUP BY idDatoBitacora ORDER BY idAlmacenamiento,BitacoraIndicador.posicion ASC, idDatoBitacora, idIndicador")->result_array();
    }

    function insertarAlmacenamiento($almacenamiento)
    {
        $this->db->insert('AlmacenamientoBitacora', $almacenamiento);
        return $this->db->insert_id();
    }
    function insertarDatoBitacora($datoBitacora)
    {
        $this->db->insert('DatosBitacora', $datoBitacora);
    }
    function eliminarAlmacenamiento($idAlmacenamiento)
    {
        $this->db->where('idAlmacenamiento', $idAlmacenamiento);
        $this->db->delete('AlmacenamientoBitacora');
    }
    function getCondicionesBitacora($idBitacora)
    {
        return $this->db->query("SELECT IndicadorCalculo.*, IndicadorCalculoCondicion.condicion, IndicadorCalculoCondicion.valorCondicion, indicadorBitacoras.tipoIndicador FROM BitacoraIndicador JOIN indicadorBitacoras ON BitacoraIndicador.idIndicador=indicadorBitacoras.idIndicador JOIN IndicadorCalculo ON IndicadorCalculo.idIndicador=indicadorBitacoras.idIndicador JOIN IndicadorCalculoCondicion ON IndicadorCalculoCondicion.idIndicadorCalculo = IndicadorCalculo.idIndicadorCalculo WHERE idBitacora=$idBitacora")->result_array();
    }

    function getnombreBitacor($idBitacora)
    {
        return $this->db->query("select * from Bitacora where idBitacora=$idBitacora")->result_array();
    }
    function getIndicadorInforme($idBitacora)
    {
        return $this->db->query("SELECT * FROM IndicadorInformeBitacora WHERE idBitacora=$idBitacora")->result_array();
    }
    function getIndicadorInformeWord($idBitacora, $idCentro)
    {
        return $this->db->query("SELECT DatoInformeBitacora.*, IndicadorInformeBitacora.texto FROM DatoInformeBitacora JOIN InformeBitacora ON InformeBitacora.idInformeBitacora=DatoInformeBitacora.idInformeBitacora JOIN IndicadorInformeBitacora ON IndicadorInformeBitacora.idIndicadorInforme=DatoInformeBitacora.idIndicadorBitacora join asignaInmueble on asignaInmueble.idAsignacion=InformeBitacora.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo WHERE CentrosDeTrabajo.idCentroTrabajo=$idCentro AND InformeBitacora.idBitacora=$idBitacora GROUP by IndicadorInformeBitacora.idIndicadorInforme")->result_array();
    }
    function getCalculoInformeWord($idBitacora, $idCentro)
    {
        return $this->db->query("SELECT IndicadorCalculo.descripcion, CalculoInforme.cantidad, CalculoInforme.numero, CalculoInforme.observaciones FROM CalculoInforme JOIN InformeBitacora ON InformeBitacora.idInformeBitacora=CalculoInforme.idInformeBitacora JOIN IndicadorCalculo ON IndicadorCalculo.idIndicadorCalculo=CalculoInforme.idCalculo JOIN asignaInmueble on asignaInmueble.idAsignacion=InformeBitacora.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo WHERE CentrosDeTrabajo.idCentroTrabajo=$idCentro AND InformeBitacora.idBitacora=$idBitacora GROUP by IndicadorCalculo.idIndicadorCalculo")->result_array();
    }
    function getComentarioGeneralInformeWord($idBitacora, $idCentro)
    {
        return $this->db->query("SELECT InformeBitacora.comentarios FROM InformeBitacora JOIN asignaInmueble on asignaInmueble.idAsignacion=InformeBitacora.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo WHERE CentrosDeTrabajo.idCentroTrabajo=$idCentro AND InformeBitacora.idBitacora=$idBitacora")->row_array();

    }
    function getDatosCentroTrabajoWord($idCe)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.*, regiones.nombreRegion, municipios.nombreMunicipio, estados.nombreEstado, Formato.razonSocial, Formato.foto, U.nombre as nombreUsuario  FROM CentrosDeTrabajo JOIN asignaInmueble ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN Formato on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia JOIN municipios ON municipios.idMunicipio=regiones.municipio JOIN estados on municipios.estado = estados.id_Estado JOIN AnalistaOti O on asignaInmueble.idAsignacion = O.idAsignacion JOIN Usuario U on O.idUsuario = U.idUsuario WHERE CentrosDeTrabajo.idCentroTrabajo=$idCe")->row_array();
    }
    function obtenerRespaldos($idAsignacion, $idBitacora)
    {
        return $this->db->query("SELECT idBitacoraRespaldo, fecha FROM BitacoraRespaldo WHERE idBitacora=$idBitacora AND idAsignacion=$idAsignacion")->result_array();
    }
    function obtenerRespaldoBitacora($idRespaldo)
    {
        return $this->db->query("SELECT * FROM BitacoraRespaldo WHERE idBitacoraRespaldo=$idRespaldo")->row_array();
    }

    function editarFilaBitacora($idIndicador, $idAlmacenamiento, $valor)
    {
        $existencia=$this->db->query("SELECT * FROM DatosBitacora WHERe idAlmacenamiento=$idAlmacenamiento AND idIndicador=$idIndicador")->row_array();
        if(!empty($existencia))
            $this->db->query("UPDATE DatosBitacora SET valor='$valor' WHERE idAlmacenamiento=$idAlmacenamiento AND idIndicador=$idIndicador");
        else
            $this->db->insert("DatosBitacora", array('idIndicador' => $idIndicador, 'idAlmacenamiento' => $idAlmacenamiento, 'valor' => $valor));

    }


}