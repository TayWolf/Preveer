<?php



class VisitaAnalisis extends CI_Model

{

    function __construct()

    {

        parent::__construct();

    }

    function getTotalRowAllData($area, $usuario)

    {

        $query = $this->db->query("SELECT COUNT(*) as row FROM CentrosDeTrabajo JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario=Usuario.idUsuario JOIN Logeo ON Usuario.idUsuario=Logeo.idUsuario join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio=serviciosSubservicios.idSubservicio WHERE Logeo.idUsuario=$usuario")->row_array();

        return $query['row'];

    }
    function getTiposInmueble()
    {
        return $this->db->get("inmuebles")->result_array();
    }

    function getAllFormatos()
    {
        return $this->db->get("Formato")->result_array();
    }


    function getIdCentroTrabajo($idAsignacion)
    {
        $arreglo=$this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo WHERE asignaInmueble.idAsignacion=$idAsignacion")->row_array();
        return $arreglo['idCentroTrabajo'];
    }
    function getNombreCentroTrabajo($idAsignacion)
    {
        $arreglo=$this->db->query("SELECT CONCAT(CentrosDeTrabajo.nombre,' (OTI ',Oti.idOti,')') as nombre FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE asignaInmueble.idAsignacion=$idAsignacion")->row_array();
        return $arreglo['nombre'];
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



        $this->pagination->initialize($config);

        return $this->pagination->create_links();

    }

    function getDatos($usuario)

    {



        return $this->db->query("SELECT Subservicios.idSubservicio, asignaInmueble.idProyecto, CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') as nombre, asignaInmueble.idAsignacion, asignaInmueble.idOti FROM CentrosDeTrabajo JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario = Usuario.idUsuario JOIN Logeo ON Usuario.idUsuario = Logeo.idUsuario join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE Logeo.idUsuario = $usuario AND Oti.statusActiva=1;")->result_array();

    }

    function getFormularios()

    {

        return $this->db->query("SELECT * FROM Aut")->result_array();

    }

    function getAcordeones($idFormulario)

    {

        return $this->db->query("SELECT Acordeon.* FROM Acordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$idFormulario ORDER BY FormularioAcordeon.posicion")->result_array();

    }

    function getIndicadores($idFormulario)

    {

        return $this->db->query("SELECT formIndicador.*, Acordeon.idAcordeon FROM formIndicador JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador=formIndicador.idIndicador JOIN Acordeon on Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$idFormulario ORDER BY AcordeonIndicador.posicion")->result_array();

    }

    function getNombreFormulario($idFormulario)

    {

        return $this->db->query("SELECT nombreFormulario FROM Aut WHERE idControl=$idFormulario")->result_array();

    }

    function getPonderadores($idFormulario)

    {

        return $this->db->query("SELECT formPonderador.*, formIndicador.idIndicador, Acordeon.idAcordeon FROM formPonderador JOIN formPondInd ON formPondInd.idPonderador=formPonderador.idPonderador JOIN formIndicador ON formIndicador.idIndicador=formPondInd.idIndicador JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador=formIndicador.idIndicador JOIN Acordeon on Acordeon.idAcordeon = AcordeonIndicador.idAcordeon JOIN FormularioAcordeon ON FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$idFormulario")->result_array();

    }

    function getFormularioAsignacion($idAsignacion, $idFormulario)

    {

        $reporte=$this->db->query("SELECT idFormularioAsignacion FROM FormularioAsignacion WHERE idAsignacion=$idAsignacion AND idFormulario=$idFormulario")->result_array();

        if(empty($reporte))

        {

            $this->db->insert('FormularioAsignacion', array('idFormulario' => $idFormulario,'idAsignacion' => $idAsignacion));

            return $this->getFormularioAsignacion($idAsignacion, $idFormulario);

        }

        return $reporte;

    }

    function borrarAlmacenamiento($idFormularioAsignacion)

    {

        $this->db->where('idFormularioAsignacion', $idFormularioAsignacion);

        $this->db->delete('FormularioAlmacenamiento');

    }

    function insertarAlmacenamiento($data)

    {

        $this->db->insert('FormularioAlmacenamiento', $data);

    }

    function obtenerDatosGuardados($idFormularioAsignacion)

    {

        return $this->db->query("SELECT * FROM FormularioAlmacenamiento WHERE idFormularioAsignacion=$idFormularioAsignacion")->result_array();

    }

    function getFotosFormulario($idFormularioAsignacion)

    {

        return $this->db->query("SELECT * FROM FormularioFotos WHERE idFormularioAsignacion=$idFormularioAsignacion")->result_array();

    }

    function actualizarImagenTabla($data, $tabla)

    {

        $existe=$this->db->query("SELECT * FROM FormularioFotos WHERE idFormularioAsignacion=".$data['idFormularioAsignacion']." AND idFormularioTablaAcordeon=".$data['idFormularioTablaAcordeon']." AND numeroFotoTabla=".$data['numeroFotoTabla'])->result_array();

        if(empty($existe))

        {

            $this->db->insert($tabla, $data);

        }

        else

        {

            $this->db->where('idFormularioFoto', $existe[0]['idFormularioFoto']);

            $this->db->update($tabla,$data);

        }

    }

    function actualizarImagen($data, $tabla)

    {

        $existe=$this->db->query("SELECT * FROM FormularioFotos WHERE idFormularioAsignacion=".$data['idFormularioAsignacion']." AND idIndicador=".$data['idIndicador']." AND idAcordeon=".$data['idAcordeon'])->result_array();

        if(empty($existe))

        {

            $this->db->insert($tabla, $data);

        }

        else

        {

            $this->db->where('idFormularioFoto', $existe[0]['idFormularioFoto']);

            $this->db->update($tabla,$data);

        }

    }

    function getTablas($idFormularioAsignacion)

    {

        return $this->db->query("SELECT FormularioAlmacenamientoAcordeon.*, FormularioTablaAcordeon.idAcordeon, FormularioTablaAcordeon.idFormularioAsignacion FROM FormularioAlmacenamientoAcordeon JOIN FormularioTablaAcordeon ON FormularioTablaAcordeon.idFormularioTablaAcordeon= FormularioAlmacenamientoAcordeon.idFormularioTablaAcordeon JOIN AcordeonIndicador ON AcordeonIndicador.idIndicador=FormularioAlmacenamientoAcordeon.idIndicador AND AcordeonIndicador.idAcordeon=FormularioTablaAcordeon.idAcordeon WHERE idFormularioAsignacion=$idFormularioAsignacion ORDER BY idAcordeon, idFormularioTablaAcordeon, AcordeonIndicador.posicion, idFormularioAlmacenamientoAcordeon ")->result_array();

    }

    function crearFilaTabla($idAcordeon, $idFormularioAsignacion)

    {

        $this->db->insert('FormularioTablaAcordeon', array('idAcordeon' => $idAcordeon, 'idFormularioAsignacion' => $idFormularioAsignacion));

        return $this->db->insert_id();

    }

    function insertarFilaTabla($tabla, $arreglo)

    {

        $this->db->insert($tabla, $arreglo);

    }

    function eliminarFilaTabla($idFila)

    {

        $this->db->where('idFormularioTablaAcordeon', $idFila);

        $this->db->delete("FormularioTablaAcordeon");

    }

    function obtenerFotosFila($idFila)

    {

        return $this->db->query("SELECT * FROM FormularioFotos WHERE idFormularioTablaAcordeon=$idFila ORDER BY numeroFotoTabla")->result_array();

    }

    function borrarFoto($idFormularioAsignacion, $idIndicador, $idAcordeon)

    {

        $row= $this->db->query("SELECT idFormularioFoto, foto FROM FormularioFotos WHERE idFormularioAsignacion=$idFormularioAsignacion AND idIndicador=$idIndicador AND idAcordeon=$idAcordeon")->row_array();

        $this->db->where('idFormularioFoto', $row['idFormularioFoto']);

        $this->db->delete('FormularioFotos');

        return $row['foto'];

    }

    function borrarFotoModal($idFormularioAsignacion, $idFormularioTablaAcordeon, $numeroFotoTabla)

    {

        $row= $this->db->query("SELECT idFormularioFoto, foto FROM FormularioFotos WHERE idFormularioAsignacion=$idFormularioAsignacion AND idFormularioTablaAcordeon=$idFormularioTablaAcordeon AND numeroFotoTabla=$numeroFotoTabla")->row_array();

        $this->db->where('idFormularioFoto', $row['idFormularioFoto']);

        $this->db->delete('FormularioFotos');

        return $row['foto'];

    }

    function insertarHistoricoFormulario($data)

    {

        $this->db->insert("historicoFormulario", $data);

    }

}