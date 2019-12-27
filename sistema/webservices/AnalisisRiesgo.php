<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnalisisRiesgo extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM CentrosDeTrabajo")->row_array();
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


    function getDatos($no_page, $usuario)
    {
        $perpage = 20; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        return $this->db->query("SELECT Subservicios.idSubservicio,asignaInmueble.idProyecto, CentrosDeTrabajo.*, asignaInmueble.idAsignacion,asignaInmueble.idOti FROM CentrosDeTrabajo JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario=Usuario.idUsuario JOIN Logeo ON Usuario.idUsuario=Logeo.idUsuario join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio=serviciosSubservicios.idSubservicio WHERE Logeo.idUsuario=$usuario limit 20 offset $first")->result_array();
    }
    function getDatosAnalista($no_page, $usuario)
    {
        $perpage = 20; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        return $this->db->query("SELECT Subservicios.idSubservicio,asignaInmueble.idProyecto, CONCAT(Formato.nombre,' (OTI ',asignaInmueble.idOti, ')') as nombreFormato, CentrosDeTrabajo.*, asignaInmueble.idAsignacion,asignaInmueble.idOti FROM CentrosDeTrabajo JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario=Usuario.idUsuario JOIN Logeo ON Usuario.idUsuario=Logeo.idUsuario join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio=serviciosSubservicios.idSubservicio JOIN Formato ON Formato.idFormato = CentrosDeTrabajo.idFormato WHERE Logeo.idUsuario=$usuario GROUP BY asignaInmueble.idOti limit 20 offset $first")->result_array();
    }

    /*
    * EQUIPO DIELECTRICO
    * */
    function nuevaExistenciaEquipoDielectrico($idAsignacion)
    {

        $data=Array(
            'pertiga'=> null,
            //'condicionesPertiga'=> null,
            //'fotoPertiga'=>null,
            'casco'=>null,
            //'condicionesCasco'=>null,
            //'fotoCasco'=>null,
            'googles'=>null,
            //'condicionesGoogles'=>null,
            //'fotoGoogles'=>null,
            'guantes'=>null,
            'guantesCarnazas'=>null,
            //'condicionesGuantes'=>null,
            //'fotoGuantes'=>null,
            'calzado'=>null,
            //'condicionesCalzado'=>null,
            //'fotoCalzado'=>null,
            'tarimas'=>null,
            //'codicionesTarima'=>null,
            //'fotoTarima'=>null,
            'arnes'=>null,
            //'condicionesArnes'=>null,
            //'fotosArnes'=>null,
            'lineaVida'=>null,
            //'condicionesLineavida'=>null,
            //'fotoLineavida'=>null,
            'sistemaAnclaje'=>null,
            'fotoGrales'=>null,
            'fotoGralesD'=>null,
            'fotoGralesT'=>null,
            'fotoGralesC'=>null,
            'observacionesGrales'=>null,
            //'condicionesSistemaanclaje'=>null,
            //'fotoAnclaje'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('equipoDielectico', $data);
    }

    function verificarExistenciaEquipoDielectrico($idAsignacion)
    {
        return $this->db->query("SELECT equipoDielectico.* FROM equipoDielectico JOIN asignaInmueble ON equipoDielectico.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }
    function getCentroTrabajo($idAsignacion)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CentrosDeTrabajo.idFormato FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function actualizarImagenGeneral($idAsignacion, $data, $tabla)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update("$tabla", $data);
    }
    function actualizarImagenGeneralTabla($campoLlave, $llavePrimaria, $data, $tabla)
    {
        $this->db->where("$campoLlave", $llavePrimaria);
        $this->db->update("$tabla", $data);
    }

    function actualizarEquipoDieletrico($data, $idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update("equipoDielectico", $data);
    }

    /* FIN EQUIPO DIELECTRICO*/


    /*
    * EQUIPO BOMBERO
    * */
    function nuevaExistenciaEquipoBombero($idAsignacion)
    {

        $data=Array(
            'fotoEquipoB'=> null,
            'fotoEquipoBD'=> null,
            'fotoEquipoBT'=>null,
            'fotoEquipoBC'=>null,
            'observaciones'=>null,
            /*'fotoMonja'=>null,
            'chaqueton'=>null,
            'condicionesChaqueton'=>null,
            'fotoChaqueton'=>null,
            'pantalon'=>null,
            'condicionesPantalon'=>null,
            'fotoPantalon'=>null,
            'guantes'=>null,
            'condicionesGuantes'=>null,
            'fotoGuantes'=>null,
            'botas'=>null,
            'condicionesBotas'=>null,
            'fotoBotas'=>null,
            'botasLargas'=>null,
            'condicionesBotasLar'=>null,
            'fotoBotaslarga'=>null,
            'pala'=>null,
            'condicionesPala'=>null,
            'fotoPala'=>null,
            'picoHacha'=>null,
            'condicionesPicoHacha'=>null,
            'fotoPicoHac'=>null,*/
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('equipoBombero', $data);
    }

 function insertarDatosEquipos($dataPuente, $tabla)
    {
        $this->db->insert($tabla, $dataPuente);
    }

    function actualizarDatosEquipo($dataPuente, $idBitacora,$tabla)
    {
        $this->db->where('idControl', $idBitacora);
        $this->db->update($tabla, $dataPuente);
    }

    function borrarDatosEquipo($idEquipo, $tabla)
    {
        $this->db->where('idControl', $idEquipo);
        $this->db->delete($tabla);
    }
    function verificarExistenciaEquipoBombero($idAsignacion)
    {
        return $this->db->query("SELECT equipoBombero.* FROM equipoBombero JOIN asignaInmueble ON equipoBombero.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function cargarTablaPuenteE($idAsignacion)
    {
        return $this->db->query("SELECT * FROM equipoBomberospuente  WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function retornarFotoPK($llavePrimaria, $tabla, $campoPK)
{
   return $this->db->query("SELECT * FROM $tabla WHERE $campoPK = $llavePrimaria")->result_array();
}

function insertarArregloRevisionInstalaciones($arrayResiduosPeligrosos)
{
   $this->db->insert('RevisionInstalaciones', $arrayResiduosPeligrosos);
   return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
}
    function insertarArregloExtintores($array)
    {
        $this->db->insert('Extintores', $array);
        return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
    }

    function actualizaEqBombero($idAsignacion, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('equipoBombero', $data);
    }

    /* FIN EQUIPO BOMBERO */
    function nuevaExistenciaPrimerosAuxilios($idAsignacion)
    {

        $data=Array(
            'camilla'=>null,
            'fotoCamillas'=>null,
            'ferulas'=>null,
            'fotoFerulas'=>null,
            'collarin'=>null,
            'fotoCollarin'=>null,
            'botiquinFijo'=>null,
            'fotoBotiquinF'=>null,
            'botiquinMovil'=>null,
            'fotoBotiquinMovil'=>null,
            'inmoCraneal'=>null,
            'fotoInmoviCraneal'=>null,
            'inmoviTipoarana'=>null,
            'fotoTipoarana'=>null,
            'regadera'=>null,
            'fotoRegadera'=>null,
            'otrosContenidoBotiquin'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('primerosAuxilios', $data);
    }

    function verificarExistenciaPrimerosAuxilios($idAsignacion)
    {
        return $this->db->query("SELECT primerosAuxilios.* FROM primerosAuxilios JOIN asignaInmueble ON primerosAuxilios.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function actualizarPrimerosAuxilios($data, $idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update("primerosAuxilios", $data);
    }

    function getInstalacion($grupo)
    {
        return $this->db->query("SELECT idIndicador, nombreIndicador FROM AcuseIndicadores WHERE idGrupoIndicador=$grupo")->result_array();
    }

    function insertarContenidoBotiquin($data)
    {
        $this->db->insert("contenidoBotiquin", $data);
    }

    function borrarContenidoBotiquin($idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->delete("contenidoBotiquin");
    }

    function getContenidoBotiquin($idAsignacion)
    {
        return $this->db->query("SELECT * FROM contenidoBotiquin WHERE idAsignacion=$idAsignacion")->result_array();
    }

    /*PRIMEROS AUXILIOS FIN*/

    function nuevaExistenciaDatosGenerales($idAsignacion)
    {

        $data=Array(
            'fechaVisita'=> date("Y-m-d"),
            'numVisita'=> '1',
            'licenciaFuncionamiento'=>null,
            'fachada'=>null,
            'numPersonalInterno'=>null,
            'numPersonalExterno'=>null,
            'aforo'=>null,
            'fechaConstruccion'=>null,
            'fechaInicioOperaciones'=>null,
            'areasRemodeladas'=>null,
            'metrosConstruccion'=>null,
            'metrosTerreno'=>null,
            'usoDelInmueble'=>null,
            'vidrioTemplado'=>null,
            'peliculaAntiAsalto'=>null,
            'docRespaldo'=>null,
            'retardante'=>null,
            'alertaSismo'=>null,
            'fotoVidrio'=>null,
            'fotoPelicula'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('DatosGenerales', $data);

        $dataVisita=array(
            'idAsignacion'=> $idAsignacion,
            'fechaAgenda' => date("Y-m-d"),
            'Status' => 1,
            'fechaAplicacion' => '0000-00-00',
            'tipoVisita' => 1,
            'comentario' => null
        );

        $this->db->insert('VisitasInmueble', $dataVisita);
    }

    function nuevaExistenciaFotosDatosGenerales($idAsignacion)
    {

        $data=Array(
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('fotosDatosGenerales', $data);
    }




    function verificarExistencia($idAsignacion)
    {
        return $this->db->query("SELECT DatosGenerales.* FROM DatosGenerales JOIN asignaInmueble ON DatosGenerales.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }
    function verificarExistenciaFotosDatosGenerales($idAsignacion)
    {
        return $this->db->query("SELECT fotosDatosGenerales.* FROM fotosDatosGenerales JOIN asignaInmueble ON fotosDatosGenerales.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function verificarExistenciaInstalacionesElectricas($idAsignacion)
    {
        return $this->db->query("SELECT InstalacionesElectricas.* FROM InstalacionesElectricas JOIN asignaInmueble ON InstalacionesElectricas.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }
    function verificarExistenciaRevisionInstalaciones($idAsignacion)
    {
        return $this->db->query("SELECT RevisionInstalaciones.* FROM RevisionInstalaciones JOIN asignaInmueble ON RevisionInstalaciones.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }
    function obtenerDatosCatalogoRevision()
    {
        return $this->db->query("SELECT CatalogoRevision.* FROM CatalogoRevision")->result_array();
    }
    function verificarExistenciaMaterialesPeligrosos($idAsignacion)
    {
        return $this->db->query("SELECT MaterialPeligroso.* FROM MaterialPeligroso JOIN asignaInmueble ON MaterialPeligroso.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }
    function verificarExistenciaResiduosPeligrosos($idAsignacion)
    {
        return $this->db->query("SELECT ResiduosPeligrosos.* FROM ResiduosPeligrosos JOIN asignaInmueble ON ResiduosPeligrosos.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }
    function verificarExistenciaColindancia($idAsignacion)
    {
        return $this->db->query("SELECT Colindancia.*,Estacionamiento.* FROM Colindancia JOIN asignaInmueble ON Colindancia.idAsignacion=asignaInmueble.idAsignacion join Estacionamiento on Estacionamiento.idAsignacion=Colindancia.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function obtenerArray($idAsignacion)
    {
        return $this->db->query("SELECT * from AntecedentesAccidentes where idAsignacion=$idAsignacion")->result_array();
    }
    function obtenerArrayExtintor($idAsignacion)
    {
        return $this->db->query("SELECT * from Extintores where idAsignacion=$idAsignacion")->result_array();
    }

    function nuevaExistenciaInstalacionesElectricas($idAsignacion)
    {

        $data=Array(
            'fechaVisita'=> date("Y-m-d"),
            'acometida'=> null,
            'tipoAcometida'=> null,
            'fotoAcometida'=> null,
            'observacionesAcometida'=>null,
            'transformador'=>null,
            'fotoTransformador1'=>null,
            'subEstacion'=>null,
            'fotoSubEstacion1'=>null,
            'fotoSenaSubEstacion'=>null,
            'observacionesSubEstacion'=>null,
            'plantaEmergencia'=>null,
            'capPlantaEmergencia'=>null,
            'fotoPlantaEmergencia1'=>null,
            //'almDieselPE'=>null,
            // 'fotoTanqueDieselUno'=>null,
            //'fotoTanqueDieselDos'=>null,
            'senalPlantaEmergencia'=>null,
            //'observacionPlantaEmergencia'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('InstalacionesElectricas', $data);
    }

    function nuevaExistenciaMaterialesPeligrosos($idAsignacion)
    {

        $data=Array(
            'fechaVisita'=> date("Y-m-d"),
            //'tipoDeGas'=> null,
            //'NoTanques'=> null,
            // 'Capacidad'=> null,
            //'anoDeFabricacion'=>null,
            'dictamen'=>null,
            'ano'=>null,
            'isometrico'=>null,
            'areaEquipo'=>null,
            'ubicacValculacierre'=>null,
            'ubicacionGas'=>null,
            'observacionesInstalacionGas'=>null,
            'observacionesInstalacionDiesel'=>null,
            'fotoTanqueGas'=>null,
            'cantDiesel'=>null,
            'ubicaDiesel'=>null,
            'diqueContencionDiesel'=>null,
            'cantGasolina'=>null,
            'ubicaGasolina'=>null,
            'diqueContencionGasolina'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('MaterialPeligroso', $data);

        /* $dataD=Array(
            'idAsignacion' => $idAsignacion,
            'tipoGas'=>0,
            'noTanque'=>0,
            'capacidadGas'=>0,
            'anioFabricacion'=>0,
            'senalizacion'=>0,
            'observacionesGas'=>null,
            'fotoGas'=>null,
            'fotoGasDos'=>null,
            'fotoGasTres'=>null
            
        );
        $this->db->insert('MaterialPeliPuente', $dataD);*/
    }

    function nuevaExistenciaResiduosPeligrosos($idAsignacion)
    {
        $data=Array(
            'tipoAlmacen'=> null,
            'cantidad'=> null,
            'ubicacion'=> null,
            'materialesComunes'=> null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('ResiduosPeligrosos', $data);
    }

    function nuevaExistenciaRevisionInstalaciones($idAsignacion)
    {
        $data= array(
            'estadoInstalacion'=> null,
            'cantidadInstalacion'=>null,
            'ubicacion'=>null,
            'observaciones'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('RevisionInstalaciones', $data);
    }


    function nuevaExistenciaRevisionPrueba($datosRevisionInstalacion)
    {
        //$this->db->insert('RevisionInstalaciones', );
    }


    function nuevaExistenciaColindancia($idAsignacion)
    {

        $data=Array(
            'fechaVisita'=> date("Y-m-d"),
            'calleNorte'=> null,
            'localNorte'=> null,
            'calleSur'=>null,
            'localSur'=>null,
            'calleOriente'=>null,
            'localOriente'=>null,
            'callePoniente'=>null,
            'localPoniente'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('Colindancia', $data);

        $data2=Array(

            'cajones'=> null,
            'area'=> null,
            'fotoEstacionamiento'=>null,
            'cajonesDiscapacitados'=>null,
            'fotoEstaDisca'=>null,
            'tipo'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('Estacionamiento', $data2);
    }




    function verificarExistenciaHidraulicas($idAsignacion)
    {
        return $this->db->query("SELECT InstalacionesHidraulicas.* FROM InstalacionesHidraulicas 
                                 JOIN asignaInmueble ON InstalacionesHidraulicas.idAsignacion=asignaInmueble.idAsignacion
                                 WHERE asignaInmueble.idAsignacion = $idAsignacion")->result_array();
    }

    function getCatalogoHidraulica()
    {
        return $this->db->query("SELECT CatalogoHidraulica.* FROM CatalogoHidraulica")->result_array();
    }

    function getHidraulicaPuente($idAsignacion)
    {
        return $this->db->query("SELECT HidraulicaCatalogoPuente.*, CatalogoHidraulica.nombre,InstalacionesHidraulicas.idAsignacion FROM InstalacionesHidraulicas JOIN asignaInmueble ON InstalacionesHidraulicas.idAsignacion = asignaInmueble.idAsignacion JOIN HidraulicaCatalogoPuente ON InstalacionesHidraulicas.idInstalacionesHidraulicas = HidraulicaCatalogoPuente.idCatalogo JOIN CatalogoHidraulica ON HidraulicaCatalogoPuente.idInstalacion = CatalogoHidraulica.idCatalogoHidraulica WHERE HidraulicaCatalogoPuente.idAsignacion=$idAsignacion")->result_array();
    }


    function getTanquePuente($idAsignacion)
    {
        return $this->db->query("SELECT * FROM fotoTanques WHERE idAsignacion = $idAsignacion")->result_array();
    }

    function getGasPuente($idAsignacion)
    {
        return $this->db->query("SELECT * FROM MaterialPeliPuente WHERE idAsignacion = $idAsignacion")->result_array();
    }
    function obtenerFotosAlertamiento($idAsignacion)
    {
        return $this->db->query("SELECT sensorHumoFoto1,sensorHumoFoto2,sensorHumoFoto3,sensorTemperaturaFoto1,sensorTemperaturaFoto2,sensorTemperaturaFoto3,sensorTipoHazFoto1,sensorTipoHazFoto2,sensorTipoHazFoto3,sensorHidrogenoFoto1,sensorHidrogenoFoto2,sensorHidrogenoFoto3,sensorInfrarrojoFoto1,sensorInfrarrojoFoto2,sensorInfrarrojoFoto3, fotoAlertamientoIncendio1,fotoAlertamientoIncendio2,fotoAlertamientoIncendio3,fotoAlertamientoIncendio4 FROM Alertamiento WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function obtenerFotosBrigadista($idAsignacion)
    {
        return $this->db->query("SELECT fotoIdentificacionBrigadista1,fotoIdentificacionBrigadista2,fotoIdentificacionBrigadista3,fotoIdentificacionBrigadista4 FROM IdentificacionBrigadista WHERE idAsignacion=$idAsignacion")->result_array();
    }
    function obtenerFotosEvaluacionAlertamiento($idAsignacion)
    {
        return $this->db->query("SELECT fotoEvaluacionAlertamiento1,fotoEvaluacionAlertamiento2,fotoEvaluacionAlertamiento3,fotoEvaluacionAlertamiento4, fotoEvaluacionAlertamiento5, fotoEvaluacionAlertamiento6 FROM EvaluacionAlertamiento WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function nuevaExistenciaHidraulica($idAsignacion)
    {
        $data=Array(
            'suministro'=> null,
            'sumOtro'=> null,
            'tuberia'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('InstalacionesHidraulicas', $data);
    }

    function actualizarExistenciaHidraulica($datosInHidraulica, $idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('InstalacionesHidraulicas', $datosInHidraulica);
    }

    //HidraulicaCatalogoPuente
    function insertaDatosHidraulicaPuente($datosHidraulicaPuente)
    {
        $this->db->insert('HidraulicaCatalogoPuente', $datosHidraulicaPuente);
         return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
    }

    

    function insertaDatosTanquePuente($dataPuente)
    {
        $this->db->insert('fotoTanques', $dataPuente);
    }

    function actualizarDatosHidraulicaPuente($datosHidraulicaPuente, $idHidraulicaCatalogo)
    {
        $this->db->where('idHidraulicaCatalogo', $idHidraulicaCatalogo);
        $this->db->update('HidraulicaCatalogoPuente', $datosHidraulicaPuente);
    }

    function actualizarDatosTanquesPuente($dataPuente, $idControl)
    {
        $this->db->where('idControl', $idControl);
        $this->db->update('fotoTanques', $dataPuente);
    }

    function actualizarDatosGasPuente($dataPuente, $idPuente)
    {
        $this->db->where('idPuente', $idPuente);
        $this->db->update('MaterialPeliPuente', $dataPuente);
    }

    function borrarDatosHidraulicaPuente($idHidraulicaCatalogo)
    {
        $this->db->where('idHidraulicaCatalogo', $idHidraulicaCatalogo);
        $this->db->delete('HidraulicaCatalogoPuente');
    }

    function borrarDatosTanquePuente($idControl)
    {
        $this->db->where('idControl', $idControl);
        $this->db->delete('fotoTanques');
    }

    function borrarDatosGasPuente($idPuente)
    {
        $this->db->where('idPuente', $idPuente);
        $this->db->delete('MaterialPeliPuente');
    }


    /*
     * RevisionInstalacion
    */

    function getCatalogoRevision($idAsignacion)
    {
        return $this->db->query("SELECT RevisionInstalaciones.*, CatalogoRevision.* FROM RevisionInstalaciones 
                                JOIN asignaInmueble ON RevisionInstalaciones.idAsignacion = asignaInmueble.idAsignacion  
                                JOIN CatalogoRevision ON RevisionInstalaciones.idCatalogoRevision = CatalogoRevision.idCatalogoRevision 
                                WHERE asignaInmueble.idAsignacion = $idAsignacion")->result_array();
    }

    function insertarDatosRevisionInstalacion($datosRevisionInstalacion)
    {
        $this->db->insert('RevisionInstalaciones', $datosRevisionInstalacion);
    }

    function actualizarDatosRevisionInstalacion($datosRevisionInstalacion, $idRevisionInstalaciones)
    {
        $this->db->where('idRevisionInstalaciones', $idRevisionInstalaciones);
        $this->db->update('RevisionInstalaciones', $datosRevisionInstalacion);
    }

    function borrarDatosRevisionInstalacion($idRevisionInstalaciones)
    {
        $this->db->where('idRevisionInstalaciones', $idRevisionInstalaciones);
        $this->db->delete('RevisionInstalaciones');
    }

    function borrarDatosRevisionHidraulicas($idHid)
    {
        $this->db->where('idHidraulicaCatalogo', $idHid);
        $this->db->delete('HidraulicaCatalogoPuente');
    }
    /*
     * RevisionInstalacion
    */


    /*
     * ResiduosPeligrosos
    */


    function insertarDatosResiduosPeligrosos($arrayResiduosPeligrosos)
    {
        $this->db->insert('ResiduosPeligrosos', $arrayResiduosPeligrosos);
    }
    function insertarArregloResiduosPeligrosos($arrayResiduosPeligrosos)
    {
        $this->db->insert('ResiduosPeligrosos', $arrayResiduosPeligrosos);
        return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
    }

    function actualizarDatosResiduosPeligrosos($arrayResiduosPeligrosos, $idResiduosPeligrosos)
    {
        $this->db->where('idResiduosPeligrosos', $idResiduosPeligrosos);
        $this->db->update('ResiduosPeligrosos', $arrayResiduosPeligrosos);
    }

    function borrarDatosResiduosPeligrosos($idResiduosPeligrosos)
    {
        $this->db->where('idResiduosPeligrosos', $idResiduosPeligrosos);
        $this->db->delete('ResiduosPeligrosos');
    }

    function retornarFoto($idAsi,$idCata,$Estadid)
    {
        return $this->db->query("SELECT * FROM RevisionInstalaciones WHERE idAsignacion = $idAsi and idCatalogoRevision =$idCata and estadoInstalacion = '$Estadid' ")->result_array();
    }

    function retornarFotoTanqu($idAsi,$capa,$canti)
    {
        return $this->db->query("SELECT * FROM fotoTanques WHERE idAsignacion = $idAsi and CapacidadTanque =$capa and cantidadTanque = '$canti' ")->result_array();
    }

    function retornarFotoHidrante($idAsi,$idT,$capa,$canti)
    {
        return $this->db->query("SELECT HidraulicaCatalogoPuente.* FROM `HidraulicaCatalogoPuente` join InstalacionesHidraulicas on InstalacionesHidraulicas.idInstalacionesHidraulicas=HidraulicaCatalogoPuente.idInstalacion where InstalacionesHidraulicas.idAsignacion=$idAsi and HidraulicaCatalogoPuente.idCatalogo=$idT and HidraulicaCatalogoPuente.cantidad=$canti and HidraulicaCatalogoPuente.capacidad=$capa ")->result_array();
    }
    function obtenerFotosResiduosPeligrosos($id)
    {
        return $this->db->query("SELECT fotoResiduos1,fotoResiduos2,fotoResiduos3,fotoResiduos4,fotoResiduos5 FROM ResiduosPeligrosos WHERE idResiduosPeligrosos=$id")->result_array();
    }

    function retornarFotoGas($idAsi,$tipG,$capa)
    {
        return $this->db->query("SELECT * FROM MaterialPeliPuente WHERE idAsignacion = $idAsi and tipoGas ='$tipG' and capacidadGas = '$capa' ")->result_array();
    }
    /*
     * ResiduosPeligrosos
    */



    /*
     *
     * SUSTANCIA QUÍMICA
     *
     * */

    function insertarDatosSustaciaQuimica($arraySustanciaQuimica)
    {
        $this->db->insert('SustanciasQuimicas', $arraySustanciaQuimica);
        return $this->db->query('SELECT LAST_INSERT_ID()')->result_array();
    }

    function obtenerFotosSustanciasQuimicas($id)
    {
        return $this->db->query("SELECT fotoSustancia1,fotoSustancia2,fotoSustancia3,fotoSustancia4,fotoSustancia5 FROM SustanciasQuimicas WHERE idSustanciaQuimica=$id")->result_array();
    }

    function verificarExistenciaSustancias($idAsignacion)
    {

        $valor = $this->db->query("SELECT SustanciasQuimicas.* FROM SustanciasQuimicas JOIN asignaInmueble ON SustanciasQuimicas.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();

        if(empty($valor))
        {
            $this->db->insert('SustanciasQuimicas', array('idAsignacion' => $idAsignacion));
            return $this->verificarExistenciaSustancias($idAsignacion);
        }

        return $valor;
    }

    function actualizarDatosSustanciaQuimica($datosSustancia, $idSustanciaQuimica)
    {
        $this->db->where('idSustanciaQuimica', $idSustanciaQuimica);
        $this->db->update('SustanciasQuimicas', $datosSustancia);
    }

    function borrarDatosSustanciaQuimica($idSustanciaQuimica)
    {
        $this->db->where('idSustanciaQuimica', $idSustanciaQuimica);
        $this->db->delete('SustanciasQuimicas');
    }


    /*
     *
     * SUSTANCIA QUÍMICA
     *
     * */


    function borrarDatosPuenteAnte($idAsigna)
    {
        $this->db->where('idAsignacion', $idAsigna);
        $this->db->delete('AntecedentesAccidentes');
    }
    function borrarDatosPuenteAnteExtintor($idAsigna)
    {
        $this->db->where('idAsignacion', $idAsigna);
        $this->db->delete('Extintores');
    }
    function borrarDatosExtintor($idExtintor)
    {
        $this->db->where('idExtintor', $idExtintor);
        $this->db->delete('Extintores');
    }


    function actualizarDatoGeneral($data, $id)
    {
        $this->db->where('idAsignacion', $id);
        $this->db->update('DatosGenerales', $data);
    }
    function actualizarFotoDatoGeneral($data, $id)
    {
        $this->db->where('idAsignacion', $id);
        $this->db->update('fotosDatosGenerales', $data);
    }

    function actualizarMaterialPeligroso($data, $id)
    {
        $this->db->where('idAsignacion', $id);
        $this->db->update('MaterialPeligroso', $data);
    }

    function actualizarColindancia($data, $id)
    {
        $this->db->where('idAsignacion', $id);
        $this->db->update('Colindancia', $data);
    }


    function obtenerIdUser($nombreIden,$direccion)
    {

        return $this->db->query("SELECT * from Usuario where nombre='$nombreIden' and direccion ='$direccion'; ")->result_array();
    }

    function actualizarImagen($idAsignacion, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('DatosGenerales', $data);
    }


    function updateEstacionamiento($data,$idAsignacion)
    {
        //$this->db->insert('Estacionamiento', $data);
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('Estacionamiento', $data);
    }
    function insertaDatosPuente($data)
    {
        $this->db->insert('AntecedentesAccidentes', $data);
    }

    function insertaDatosGasPuente($data)
    {
        $this->db->insert('MaterialPeliPuente', $data);
    }

    function insertaDatosPuenteExtintor($data)
    {
        $this->db->insert('Extintores', $data);
    }

    function borrarDatosEstacionamiento($idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->delete('Estacionamiento');
    }

    function actualizarImagenEstacionamiento($idAsignacion, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('Estacionamiento', $data);
    }

    function actualizarImagenInsta($idAsignacion,$idCta,$estado, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->where('idCatalogoRevision', $idCta);
        $this->db->where('estadoInstalacion', $estado);
        $this->db->update('RevisionInstalaciones', $data);
    }

    function actualizarImagenAcometida($idAsignacion, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('InstalacionesElectricas', $data);
    }

    function actualizarImagenTanqueGas($idAsignacion, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('MaterialPeligroso', $data);
    }



    function actualizarImagenTransformador($idAsignacion, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('InstalacionesElectricas', $data);
    }

    function actualizarImagenTanque($idAsignacion,$capac,$cantid,$data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->where('CapacidadTanque', $capac);
        $this->db->where('cantidadTanque', $cantid);
        $this->db->update('fotoTanques', $data);
    }

    function actualizarImagenHidra($idAsignacion,$idti,$capac,$cantid,$data)
    {
        //$this->db->where('idAsignacion', $idAsignacion);
        $this->db->where('capacidad', $capac);
        $this->db->where('idCatalogo', $idti);
        $this->db->where('cantidad', $cantid);
        $this->db->update('HidraulicaCatalogoPuente', $data);
    }

    function actualizarGas($idAsignacion,$tipoG,$capa, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->where('tipoGas', $tipoG);
        $this->db->where('capacidadGas', $capa);
        $this->db->update('MaterialPeliPuente', $data);
    }
    function getNombreImagen($campo, $tabla, $idAsignacion)
    {
        return $this->db->query("SELECT $campo FROM $tabla WHERE idAsignacion=$idAsignacion")->result_array();
    }
    function getNombreImagenTabla($campo, $tabla, $llavePrimaria, $nombreLlave)
    {
        return $this->db->query("SELECT $campo FROM $tabla WHERE $nombreLlave=$llavePrimaria")->result_array();
    }

    function getNombreImagenTanques($idAsi, $capa, $canti)
    {
        return $this->db->query("SELECT * FROM fotoTanques WHERE idAsignacion=$idAsi and CapacidadTanque=$capa and cantidadTanque =$canti ")->result_array();
    }

    function getNombreImagenHidrau($idAsi, $capa, $canti,$idT ,$capa, $canti,$idContr)
    {
        return $this->db->query("SELECT * FROM HidraulicaCatalogoPuente WHERE idHidraulicaCatalogo =$idContr ")->result_array();
    }

    function getNombreImagenGas($idAsi, $tipoG, $Capac)
    {
        return $this->db->query("SELECT * FROM MaterialPeliPuente WHERE idAsignacion=$idAsi and tipoGas=$tipoG and capacidadGas =$Capac ")->result_array();
    }

    function getNombreImagenControl($idControl)
    {
        return $this->db->query("SELECT fotoInstalacion FROM RevisionInstalaciones WHERE idRevisionInstalaciones=$idControl")->result_array();
    }

    function deleteImagen($borrar, $tabla, $idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update("$tabla", $borrar);
    }
    function deleteImagenTabla($borrar, $tabla, $llavePrimaria, $campoLlave)
    {
        $this->db->where("$campoLlave", $llavePrimaria);
        $this->db->update("$tabla", $borrar);
    }

    function deleteImagenTanques($idAsi, $capa, $canti,$borrar)
    {
        $this->db->where('idAsignacion', $idAsi);
        $this->db->where('cantidadTanque', $canti);
        $this->db->where('CapacidadTanque', $capa);
        $this->db->update("fotoTanques", $borrar);
    }

    function deleteImagenHidraulica($idAsi,$idT ,$capa, $canti,$idContr,$borrar)
    {
        $this->db->where('idHidraulicaCatalogo', $idContr);
        // $this->db->where('cantidadTanque', $canti);
        //  $this->db->where('CapacidadTanque', $capa);
        $this->db->update("HidraulicaCatalogoPuente", $borrar);
    }

    function deleteImagenGas($idAsi, $tipoG, $Capac, $borrar)
    {
        $this->db->where('idAsignacion', $idAsi);
        $this->db->where('tipoGas', $tipoG);
        $this->db->where('capacidadGas', $Capac);
        $this->db->update("MaterialPeliPuente", $borrar);
    }

    function deleteImagenControl($idControl,$borrar)
    {
        $this->db->where('idRevisionInstalaciones', $idControl);
        $this->db->update("RevisionInstalaciones", $borrar);
    }


    function actualizarSensores($datosBrigadistas, $datosEvaluacion,$datosParaActualizar, $idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update("Alertamiento", $datosParaActualizar);

        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update("EvaluacionAlertamiento", $datosEvaluacion);

        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update("IdentificacionBrigadista", $datosBrigadistas);
    }


    function verificarExistenciaSensores($idAsignacion)
    {
        return $this->db->query("SELECT Alertamiento.* FROM Alertamiento JOIN asignaInmueble ON Alertamiento.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function nuevaFecha($fechaVisita)
    {
        $this->db->insert('VisitasInmueble', $fechaVisita);
    }

    function nuevaExistenciaSensores($idAsignacion)
    {

        $data=Array(
            'sensorHumoCantidad'=>null,
            'sensorHumoFaltantes'=>null,
            'sensorHumoAveriados'=>null,
            'sensorTemperaturaCantidad'=>null,
            'sensorTemperaturaFaltantes'=>null,
            'sensorTemperaturaAveriados'=>null,
            'sensorTipoHazCantidad'=>null,
            'sensorTipoHazFaltantes'=>null,
            'sensorTipoHazAveriados'=>null,
            'sensorHidrogenoCantidad'=>null,
            'sensorHidrogenoFaltantes'=>null,
            'sensorHidrogenoAveriados'=>null,
            'sensorInfrarrojoCantidad'=>null,
            'sensorInfrarrojoFaltantes'=>null,
            'sensorInfrarrojoAveriados'=>null,
            'pulsadorManual'=>null,
            'alarmaLuminosa'=>null,
            'megafono'=>null,
            'otro'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('Alertamiento', $data);
    }
    function getTiposVisita($visita=null)
    {
        if(empty($visita))
            return $this->db->query("SELECT visitasTipo.* FROM visitasTipo")->result_array();
        else
            return $this->db->query("SELECT visitasTipo.* FROM visitasTipo WHERE idControl=$visita")->result_array();
    }
    function getFotosExtintor($idExtintor)
    {
        $datos=$this->db->query("SELECT fotoExtintor1,fotoExtintor2,fotoExtintor3,fotoExtintor4,fotoExtintor5,fotoExtintor6,fotoExtintor7,fotoExtintor8 FROM FotoExtintor WHERE idExtintor=$idExtintor")->result_array();
        if(empty($datos))
        {
            $this->db->insert('FotoExtintor', array('idExtintor' => $idExtintor));
            return $this->getFotosExtintor($idExtintor);
        }
        return $datos;
    }
    function borrarDatoExtintor($idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->delete('DatoExtintor');
    }
    function insertarDatoExtintor($datos)
    {
        $this->db->insert('DatoExtintor', $datos);
    }
    function getDatoExtintor($idAsignacion)
    {
        return $this->db->query("SELECT * FROM DatoExtintor WHERE idAsignacion=$idAsignacion")->result_array();
    }
    function getDatosIdentificacionBrigadista($idAsignacion)
    {
        $datos=$this->db->query("SELECT * FROM IdentificacionBrigadista WHERE idAsignacion=$idAsignacion")->result_array();
        if(empty($datos))
        {
            $this->db->insert('IdentificacionBrigadista', array('idAsignacion' => $idAsignacion));
            return $this->getDatosIdentificacionBrigadista($idAsignacion);
        }
        return $datos;
    }
    function getDatosEvaluacionAlertamiento($idAsignacion)
    {
        $datos=$this->db->query("SELECT * FROM EvaluacionAlertamiento WHERE idAsignacion=$idAsignacion")->result_array();
        if(empty($datos))
        {
            $this->db->insert('EvaluacionAlertamiento', array('idAsignacion' => $idAsignacion));
            return $this->getDatosEvaluacionAlertamiento($idAsignacion);
        }
        return $datos;
    }

}