<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hidrantes extends CI_Model{
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
        return $this->db->query("SELECT CentrosDeTrabajo.*, asignaInmueble.idAsignacion FROM CentrosDeTrabajo JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario=Usuario.idUsuario JOIN Logeo ON Usuario.idUsuario=Logeo.idUsuario WHERE Logeo.idUsuario=$usuario limit 20 offset $first")->result_array();
    }


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
    }

    function verificarExistencia($idAsignacion)
    {
        return $this->db->query("SELECT DatosGenerales.* FROM DatosGenerales JOIN asignaInmueble ON DatosGenerales.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
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

    function verificarExistenciaColindancia($idAsignacion)
    {
        return $this->db->query("SELECT Colindancia.*,Estacionamiento.* FROM Colindancia JOIN asignaInmueble ON Colindancia.idAsignacion=asignaInmueble.idAsignacion join Estacionamiento on Estacionamiento.idAsignacion=Colindancia.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function obtenerArray($idAsignacion)
    {
        return $this->db->query("SELECT * from AntecedentesAccidentes where idAsignacion=$idAsignacion")->result_array();
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
            'fotoTransformador'=>null,
            'subEstacion'=>null,
            'fotoSubEstacion'=>null,
            'fotoSenaSubEstacion'=>null,
            'observacionesSubEstacion'=>null,
            'plantaEmergencia'=>null,
            'capPlantaEmergencia'=>null,
            'fotoPlantaEmergencia'=>null,
            'almDieselPE'=>null,
            'fotoTanqueDieselUno'=>null,
            'fotoTanqueDieselDos'=>null,
            'senalPlantaEmergencia'=>null,
            'observacionPlantaEmergencia'=>null,
            'idAsignacion' => $idAsignacion
        );
        $this->db->insert('InstalacionesElectricas', $data);
    }

    function nuevaExistenciaMaterialesPeligrosos($idAsignacion)
    {

        $data=Array(
            'fechaVisita'=> date("Y-m-d"),
            'tipoDeGas'=> null,
            'NoTanques'=> null,
            'Capacidad'=> null,
            'anoDeFabricacion'=>null,
            'dictamen'=>null,
            'ano'=>null,
            'isometrico'=>null,
            'ubicacionGas'=>null,
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
        return $this->db->query("SELECT HidraulicaCatalogoPuente.*, CatalogoHidraulica.nombre FROM InstalacionesHidraulicas 
                                JOIN asignaInmueble ON InstalacionesHidraulicas.idAsignacion = asignaInmueble.idAsignacion  
                                JOIN HidraulicaCatalogoPuente ON InstalacionesHidraulicas.idInstalacionesHidraulicas = HidraulicaCatalogoPuente.idInstalacion 
                                JOIN CatalogoHidraulica ON HidraulicaCatalogoPuente.idCatalogo = CatalogoHidraulica.idCatalogoHidraulica 
                                WHERE asignaInmueble.idAsignacion = $idAsignacion")->result_array();
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
    }

    function actualizarDatosHidraulicaPuente($datosHidraulicaPuente, $idHidraulicaCatalogo)
    {
        $this->db->where('idHidraulicaCatalogo', $idHidraulicaCatalogo);
        $this->db->update('HidraulicaCatalogoPuente', $datosHidraulicaPuente);
    }

    function borrarDatosHidraulicaPuente($idHidraulicaCatalogo)
    {
        $this->db->where('idHidraulicaCatalogo', $idHidraulicaCatalogo);
        $this->db->delete('HidraulicaCatalogoPuente');
    }

    function borrarDatosPuenteAnte($idAsigna)
    {
        $this->db->where('idAsignacion', $idAsigna);
        $this->db->delete('AntecedentesAccidentes');
    }


    function actualizarDatoGeneral($data, $id)
    {
        $this->db->where('idAsignacion', $id);
        $this->db->update('DatosGenerales', $data);
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
    function getNombreImagen($campo, $tabla, $idAsignacion)
    {
        return $this->db->query("SELECT $campo FROM $tabla WHERE idAsignacion=$idAsignacion")->result_array();
    }
    function deleteImagen($borrar, $tabla, $idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update("$tabla", $borrar);
    }

    //codigo Hidrantes
    function verificarExistenciaHidrantes($idAsignacion)
    {
        return $this->db->query("SELECT Hidrantes.* FROM Hidrantes JOIN asignaInmueble ON Hidrantes.idAsignac=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function nuevaExistenciaHidrante($idAsignacion)
    {

        $data=Array(
            'fechaVisita'=> date("Y-m-d"),
            'boquillaExterior15'=> null,
            'boquillaExterior30'=>null,
            'llaveExteroior15'=>null,
            'totalBoquillas'=>null,
            'llaveExteroior15'=>null,
            'llaveExterior30'=>null,
            'boquillaInterior15'=>null,
            'boquillaInterior30'=>null,
            'llaveInterior15'=>null,
            'llaveInterior30'=>null,
            'llaveInterior30'=>null,
            'totalLlaves'=>null,
            'siamesa'=>null,
            'ubicacionSiamesa'=>null,
            'fotoSiamesa'=>null,
            'fotoInterior'=>null,
            'fototExterior'=>null,
            'fotoRedIncendios4'=>null,
            'fotoRedIncendios5'=>null,
            'fotoRedIncendios6'=>null,
            'observacionesGral'=>null,
            'observacionesGrales'=>null,
            'idAsignac' => $idAsignacion
        );
        $this->db->insert('Hidrantes', $data);
    }


    function actualizarImagenInterior($idAsignacion, $data)
    {
        $this->db->where('idAsignac', $idAsignacion);
        $this->db->update('Hidrantes', $data);
    }

    function actualizarCuartoBombas($idAsignacion, $data)
    {
        $this->db->where('idAsignac', $idAsignacion);
        $this->db->update('cuartoBombas', $data);
    }

    function getNombreImagenes($campo, $tabla, $idAsignacion)
    {
        return $this->db->query("SELECT $campo FROM $tabla WHERE idAsignac=$idAsignacion")->result_array();
    }
    function deleteImagenes($borrar, $tabla, $idAsignacion)
    {
        $this->db->where('idAsignac', $idAsignacion);
        $this->db->update("$tabla", $borrar);
    }
    // fin codigo Hidrantes


    // inicio extintore

    function verificarExistenciaExtintores($idAsignacion)
    {
        return $this->db->query("SELECT Extintores.* FROM Extintores JOIN asignaInmueble ON Extintores.idAsignacion=asignaInmueble.idAsignacion WHERE asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    // fin extintor


    /*
     * SUBIR FOTO GENERAL
     * */

    function actualizarImagenGeneral($idAsignacion, $data, $tabla)
    {
        $this->db->where('idAsignac', $idAsignacion);
        $this->db->update("$tabla", $data);
    }

    /*
     * SUBIR FOTO GENERAL
     * */



    /*
     * Cuarto bombas
     * */
    function vericarExistenciaCuartoBombas($idAsignacion)
    {

        $valor = $this->db->query("SELECT * FROM cuartoBombas WHERE idAsignac = $idAsignacion")->result_array();
        if(empty($valor)){
            $this->db->query("INSERT INTO cuartoBombas(idAsignac) VALUES ($idAsignacion)");
            return $this->vericarExistenciaCuartoBombas($idAsignacion);
        }
        return $valor;
    }
}