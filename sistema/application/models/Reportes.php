<?php
class Reportes extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    function getTotalRowAllData($usuario)
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
    function getTodosReportes()
    {
        return $this->db->query("SELECT * FROM Reportes_SSHL")->result_array();
    }
    function getNombreReporte($idReporte)
    {
        return $this->db->query("SELECT nombreReportes FROM Reportes_SSHL WHERE idReporte=$idReporte")->result_array();
    }
    function getApartadosReporte($idReporte)
    {
        return $this->db->query("SELECT Reporte_ApartadoReporte.*, ApartadoReporte.nombre FROM Reporte_ApartadoReporte JOIN ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte WHERE Reporte_ApartadoReporte.idReporte=$idReporte ORDER BY Reporte_ApartadoReporte.posicion")->result_array();
    }
    function getIndicadoresApartadosReporte($idReporte)
    {
        return $this->db->query("SELECT Apartado_IndicadorReporte.*, indicadorReporte.nombreIndicador, indicadorReporte.tipo, indicadorReporte.required FROM Reporte_ApartadoReporte JOIN ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte JOIN Apartado_IndicadorReporte ON Apartado_IndicadorReporte.idApartadoReporte=Reporte_ApartadoReporte.idApartadoReporte JOIN indicadorReporte ON indicadorReporte.idIndicador=Apartado_IndicadorReporte.idIndicadorReporte WHERE Reporte_ApartadoReporte.idReporte=$idReporte ORDER BY Reporte_ApartadoReporte.posicion")->result_array();
    }
    function getPonderadoresIndicadoresApartadosReporte($idReporte)
    {
        return $this->db->query("SELECT PonderadoresReportes.*, indicadorReporte.idIndicador, indicadorReporte.nombreIndicador, ApartadoReporte.idApartadoReporte FROM PonderadoresReportes JOIN PonderadorIndicadorRep ON PonderadorIndicadorRep.idPonderador=PonderadoresReportes.idPonderador JOIN indicadorReporte ON indicadorReporte.idIndicador=PonderadorIndicadorRep.idIndicador JOIN Apartado_IndicadorReporte ON Apartado_IndicadorReporte.idIndicadorReporte=indicadorReporte.idIndicador JOIN ApartadoReporte ON ApartadoReporte.idApartadoReporte=Apartado_IndicadorReporte.idApartadoReporte JOIN Reporte_ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte WHERE Reporte_ApartadoReporte.idReporte=$idReporte")->result_array();
    }

    function getReporteAsignacion($idReporte, $idAsignacion)
    {
        $consulta=$this->db->query("SELECT * FROM ReporteAsignacion WHERE idReporte=$idReporte AND idAsignacion=$idAsignacion")->result_array();
        if(empty($consulta))
        {
            $this->db->insert('ReporteAsignacion', array('idReporte' => $idReporte, 'idAsignacion' => $idAsignacion, 'fecha' => date("Y-m-d")));
            return $this->getReporteAsignacion($idReporte, $idAsignacion);
        }
        return $consulta;

    }
    function insertarAlmacenamiento($almacenamiento)
    {
        $this->db->insert('ReporteAlmacenamiento', $almacenamiento);
    }
    function borrarAlmacenamiento($idReporteAsignacion)
    {
        $this->db->where('idReporteAsignacion', $idReporteAsignacion);
        $this->db->delete('ReporteAlmacenamiento');
    }
    function cargarResultados($idReporteAsignacion)
    {
        return $this->db->query("SELECT ReporteAlmacenamiento.valor, ReporteAlmacenamiento.idIndicadorReporte, Apartado_IndicadorReporte.idApartadoReporte FROM `ReporteAlmacenamiento` JOIN indicadorReporte ON indicadorReporte.idIndicador=ReporteAlmacenamiento.idIndicadorReporte JOIN Apartado_IndicadorReporte ON Apartado_IndicadorReporte.idApartadoReporte=ReporteAlmacenamiento.idApartadoReporte AND ReporteAlmacenamiento.idIndicadorReporte=Apartado_IndicadorReporte.idIndicadorReporte JOIN ApartadoReporte ON Apartado_IndicadorReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte JOIN Reporte_ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte WHERE ReporteAlmacenamiento.idReporteAsignacion=$idReporteAsignacion")->result_array();
    }
    function getCorreccion($idReporte)
    {
        return $this->db->query("SELECT numeroCorrecciones, posicionCorreccion FROM Reportes_SSHL WHERE idReporte=$idReporte")->result_array();
    }
    function actualizarCorreccion($data, $idCorreccion)
    {
        $this->db->where('idReporteCorreccion', $idCorreccion);
        $this->db->update('ReporteCorreccion', $data);
    }
    function insertarCorreccion($data)
    {
        $this->db->insert('ReporteCorreccion', $data);
    }
    function obtenerCorrecciones($idReporteAsignacion)
    {
        return $this->db->query("SELECT * FROM ReporteCorreccion WHERE idReporteAsignacion=$idReporteAsignacion")->result_array();
    }
}
?>