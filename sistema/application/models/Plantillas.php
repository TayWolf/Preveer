<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantillas extends CI_Model
{
    function __construct(){
        parent::__construct();
    }


    function getDatos($no_page)
    {

        return $this->db->query("SELECT Plantilla.idPlantilla, Plantilla.idEstado, Plantilla.idCliente, Plantilla.idFormato, Plantilla.idCentroTrabajo, Plantilla.nombrePlantilla, Plantilla.nombreArchivo, Plantilla.tieneFoto, estados.nombreEstado, Clientes.nombreCliente, Formato.nombre as nombreFormato, CentrosDeTrabajo.nombre as nombreCentroDeTrabajo FROM Plantilla JOIN estados ON estados.id_Estado=Plantilla.idEstado JOIN Clientes ON Clientes.idCliente=Plantilla.idCliente LEFT JOIN Formato ON Formato.idFormato=Plantilla.idFormato LEFT JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo=Plantilla.idCentroTrabajo order by idPlantilla asc ")->result_array();
    }

    public function obtenerRegistroIdTabla($idP)
    {
        return $this->db->query("select * from PlantillaTablas where idPlantilla=$idP")->result_array();
    }

    function totalR($idP)
    {
        return $this->db->query("SELECT * FROM `PlantillaTablas` WHERE `idPlantilla`= $idP")->result_array();
    }

    function totalRI($idP)
    {
        return $this->db->query("SELECT * FROM `PlantillaTablaColumnas` WHERE `idPlantillaTablas`=$idP")->result_array();
    }



    function borrarDatos($idPlantilla)
    {
        //recuperar el nombre del archivo
        $nombreArchivo=$this->db->query("SELECT nombreArchivo FROM Plantilla WHERE idPlantilla=$idPlantilla")->row_array()['nombreArchivo'];
        //borre los datos
        $this->db->where('idPlantilla', $idPlantilla);
        $this->db->delete('Plantilla');

        return $nombreArchivo;
    }

    function insertaDatos($data)
    {
        $this->db->insert('Plantilla', $data);
        return  $this->db->insert_id();
    }

    function insertaDatosPuente($dataPuente)
    {
        $this->db->insert('PlantillaFoto', $dataPuente);
    }

    function insertaDatosPlantillaTabla($dataP)
    {
        $this->db->insert('PlantillaTablas', $dataP);
        return  $this->db->insert_id();
    }

    function insertaDatosPlantillaTablaPuente($dataP)
    {
        $this->db->insert('PlantillaTablaColumnas', $dataP);
        return  $this->db->insert_id();
    }

    function insertaDatosPuenteTexto($data)
    {
        $this->db->insert('plantillaTexto', $data);
        return  $this->db->insert_id();

    }

    function insertaDatosPuenteTextoF($data)
    {
        $this->db->insert('etiquetaIndicador', $data);

    }

    function getEdo()
    {
        return $this->db->query("SELECT estados.* FROM estados JOIN municipios m on estados.id_Estado = m.estado JOIN regiones r on m.idMunicipio = r.municipio JOIN CentrosDeTrabajo Trabajo on r.idRegiones = Trabajo.idColonia JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN asignaInmueble a on Trabajo.idCentroTrabajo = a.idCentroTrabajo JOIN serviciosSubservicios S2 on a.idProyecto = S2.idControl JOIN Proyectos P on S2.idServicio = P.idProyecto WHERE P.idArea=1  GROUP BY estados.id_Estado")->result_array();
    }

    function getClient()
    {
        return $this->db->query("SELECT Clientes.* FROM Clientes JOIN Formato F on Clientes.idCliente = F.idCliente JOIN CentrosDeTrabajo Trabajo on F.idFormato = Trabajo.idFormato JOIN asignaInmueble a on Trabajo.idCentroTrabajo = a.idCentroTrabajo JOIN serviciosSubservicios ON a.idProyecto = serviciosSubservicios.idControl JOIN Proyectos P on serviciosSubservicios.idServicio = P.idProyecto WHERE P.idArea=1 GROUP BY Clientes.nombreCliente")->result_array();
    }

    function getForm($idClie)
    {
        return $this->db->query("SELECT * from Formato where idCliente=$idClie")->result_array();
    }

    function getCentr($idFom)
    {
        return $this->db->query("SELECT * from CentrosDeTrabajo where idFormato=$idFom")->result_array();
    }

    function updateDatos($dataD,$idPlantilla)
    {
        $this->db->where('idPlantilla', $idPlantilla);
        $this->db->update('Plantilla', $dataD);

    }

    function borrarDatosPuente($idPlantilla)
    {
        $this->db->where('idPlantilla', $idPlantilla);
        $this->db->delete('PlantillaFoto');
    }

    function borrarDatosPuenteTexto($idPlantilla)
    {
        $this->db->where('idPlantilla', $idPlantilla);
        $this->db->delete('plantillaTexto');
    }
    function borrarDatosPuenteAcuse($idPlantilla)
    {
        $this->db->where('idPlantilla', $idPlantilla);
        $this->db->delete('PlantillaAcuse');
    }

    function borrarDatosTabla($idPlantilla)
    {
        $this->db->where('idPlantilla', $idPlantilla);
        $this->db->delete('PlantillaTablas');
    }

    function datosPlantilla($plantilla)
    {
        return $this->db->query("SELECT * FROM `Plantilla` WHERE `idPlantilla` =$plantilla")->row();
    }

    function getAut()
    {
        return $this->db->query("SELECT * FROM `Aut`")->result_array();
    }

    function getAcorde($idFormm)
    {
        return $this->db->query("SELECT Acordeon.nombreAcordeon,Acordeon.idAcordeon FROM `FormularioAcordeon` JOIN Acordeon on FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$idFormm")->result_array();
    }

    function getAcordeUni($idFormm)
    {
        return $this->db->query("SELECT Acordeon.nombreAcordeon,Acordeon.idAcordeon FROM `FormularioAcordeon` JOIN Acordeon on FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$idFormm and Acordeon.tablaRegistro=1")->result_array();
    }

    function getTotales($idPlant){
        return $this->db->query("SELECT COUNT(idPlantilla) as total FROM `PlantillaFoto` WHERE `idPlantilla`=$idPlant")->row();
    }

    function getTotalesText($idPlant){
        return $this->db->query("SELECT COUNT(idPlantilla) as total FROM `plantillaTexto` WHERE `idPlantilla`=$idPlant")->row();
    }
    function getTotalesAcuse($idPlant){
        return $this->db->query("SELECT COUNT(idPlantilla) as total FROM `PlantillaAcuse` WHERE `idPlantilla`=$idPlant")->row();
    }

    function getValoresEtiquetas($idPlant)
    {
        return $this->db->query("SELECT * FROM `PlantillaFoto` WHERE `idPlantilla`=$idPlant")->result_array();
    }

    function getValoresEtiquetasText($idPlant)
    {
        return $this->db->query("SELECT plantillaTexto.nombreEtiqueta,etiquetaIndicador.* FROM `etiquetaIndicador` JOIN plantillaTexto on plantillaTexto.idControl=etiquetaIndicador.idEtiqueta WHERE plantillaTexto.idPlantilla=$idPlant")->result_array();
    }

    function getValoresEtiquetasAcuse($idPlant)
    {
        return $this->db->query("SELECT PlantillaAcuse.* FROM PlantillaAcuse WHERE PlantillaAcuse.idPlantilla=$idPlant;")->result_array();
    }

    function getIndocador($idAcord)
    {
        return $this->db->query("SELECT formIndicador.idIndicador,formIndicador.nombreIndicador from formIndicador join AcordeonIndicador on AcordeonIndicador.idIndicador=formIndicador.idIndicador where AcordeonIndicador.idAcordeon=$idAcord")->result_array();
    }

    function getGrupos()
    {
        //Select de los grupos excepto el material seco y material humedo.
        //no se seleccionan esos 2 grupos porque los datos que tienen son los mismos que en el formulario de primeros auxilios
        $this->db->select("*");
        $this->db->from("grupoIndicador");
        $this->db->where("idGrupoIndicador !=", 5);
        $this->db->where("idGrupoIndicador !=", 6);
        return $this->db->get()->result_array();
    }
    function getIndicadorAcuse($idGrupo)
    {
        $this->db->select('AcuseIndicadores.idIndicador, AcuseIndicadores.nombreIndicador');
        $this->db->from("AcuseIndicadores");
        $this->db->join("grupoIndicador", "AcuseIndicadores on grupoIndicador.idGrupoIndicador = AcuseIndicadores.idGrupoIndicador");
        $this->db->where("grupoIndicador.idGrupoIndicador", $idGrupo);
        return $this->db->get()->result_array();
    }
    function insertaDatosPuenteAcuse($data)
    {
        $this->db->insert("PlantillaAcuse", $data);
    }


}
