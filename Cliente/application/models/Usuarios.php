<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }
    function login($correo,$password)
    {

        $this ->db-> select('*');
        $this ->db-> from('Clientes');
        $this ->db->where('correoCl', $correo);
        $this ->db->where('passwordCl', $password);
        //$this->db->join('Usuario', 'Logeo.idUsuario = Usuario.idUsuario');
        $query = $this -> db -> get();
        // return $query= $this->db->query("SELECT Logeo.nickName, Logeo.tipo, Logeo.idUsuario, Logeo.cambio,Usuario.areaUser FROM Logeo JOIN Usuario ON Logeo.idUsuario = Usuario.idUsuario WHERE Logeo.nickName='$correo' AND Logeo.password=$password")->row();
        if($query -> num_rows() >= 1)
        {
            return $query->row();
        }
        else
        {
            return false;
        }
    }

    function obtenerFichaEdos($Cliente)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.nombre, Areas.nombreArea,estados.id_Estado,estados.nombreEstado FROM CentrosDeTrabajo JOIN regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio join estados on estados.id_Estado=municipios.estado JOIN Formato on Formato.idFormato=CentrosDeTrabajo.idFormato join Clientes on Clientes.idCliente=Formato.idCliente JOIN asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Areas on Areas.idArea=Proyectos.idArea WHERE Clientes.idCliente=$Cliente and Proyectos.idArea=2 GROUP BY estados.nombreEstado")->result_array();
    }

    function obtenerFichaCentros($Cliente,$and)
    {
        return $this->db->query("SELECT Oti.fechaSolicitud,CentrosDeTrabajo.idCentroTrabajo,CentrosDeTrabajo.nombre,asignaInmueble.idOti,asignaInmueble.idAsignacion FROM CentrosDeTrabajo join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato join Clientes on Clientes.idCliente=Formato.idCliente join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Oti on Oti.idOti=asignaInmueble.idOti JOIN regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio join estados on estados.id_Estado=municipios.estado where Clientes.idCliente=$Cliente and Proyectos.idArea=2 $and GROUP by CentrosDeTrabajo.nombre")->result_array();
    }

    function obtenerNormarCen($Cliente,$idCen)
    {
        return $this->db->query("select Subservicios.idSubservicio,Subservicios.nombre from asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio=serviciosSubservicios.idSubservicio  join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio where asignaInmueble.idCentroTrabajo=$idCen and Proyectos.idArea=2")->result_array();
    }

    function obtenerNormarCenArreglo($Cliente,$idCen)
    {
        return $this->db->query("SELECT MAX(asignaInmueble.porcentajeValor) as porcentajeValor, Subservicios.nombre as nombreNorma FROM asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio where asignaInmueble.idCentroTrabajo = $idCen and Proyectos.idArea = 2 AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3) GROUP BY Subservicios.idSubservicio ORDER BY Subservicios.nombre;")->result();
    }
    function obtenerNormarCenArregloTiempo($Cliente,$idCen)
    {
        return $this->db->query("SELECT (SUM(CumplimientoTiempoNorma.porcentajeValor) / (select COUNT(DISTINCT(Subservicios.idSubservicio)) as divisor from asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio where asignaInmueble.idCentroTrabajo = $idCen and Proyectos.idArea = 2)) as porcentajeValor, CONCAT(CumplimientoTiempoNorma.fechaRespaldo) as nombreNorma FROM asignaInmueble JOIN serviciosSubservicios S3 on asignaInmueble.idProyecto = S3.idControl JOIN CentrosDeTrabajo Trabajo on asignaInmueble.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN CumplimientoTiempoNorma on asignaInmueble.idAsignacion = CumplimientoTiempoNorma.idAsignacion JOIN Subservicios S2 on S3.idSubservicio = S2.idSubservicio JOIN Proyectos P on S3.idServicio = P.idProyecto where asignaInmueble.idCentroTrabajo = $idCen and P.idArea = 2")->result_array();
    }

    function obtenerNormarPorcentaje($idSub,$idCen)
    {
        return $this->db->query("SELECT asignaInmueble.porcentajeValor FROM `asignaInmueble` join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto WHERE asignaInmueble.idCentroTrabajo=$idCen and serviciosSubservicios.idSubservicio=$idSub")->result_array();
    }

    function getMunicipios($idEstado)
    {
        return $this->db->query("SELECT municipios.* FROM municipios join regiones on regiones.municipio=municipios.idMunicipio join CentrosDeTrabajo on CentrosDeTrabajo.idColonia = regiones.idRegiones join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo where municipios.estado=$idEstado GROUP by municipios.idMunicipio")->result_array();
    }

    function obtenerGraficasNacionalesHora($idCliente, $fechaInicial, $fechaFinal)
    {
        $this->db->query("SET lc_time_names ='ES_es'");
        return $this->db->query("SELECT COUNT(idvisitas) * 3 as valor1, (SELECT SUM(TIMESTAMPDIFF(SECOND, HorasTrabajadas.fechaInicio, HorasTrabajadas.fechaFin) / 3600) FROM HorasTrabajadas JOIN CentrosDeTrabajo Trabajo on HorasTrabajadas.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F2 on Trabajo.idFormato = F2.idFormato JOIN Clientes C3 on F2.idCliente = C3.idCliente WHERE HorasTrabajadas.fechaInicio BETWEEN '$fechaInicial' AND '$fechaFinal' AND HorasTrabajadas.fechaFin BETWEEN '$fechaInicial' AND '$fechaFinal' AND YEAR(fechaFin) = YEAR(fechaVisita) AND MONTH(fechaFin) = MONTH(fechaVisita) AND C3.idCliente = $idCliente) as valor2, CONCAT(MONTHNAME(fechaVisita), ' de ', YEAR(fechaVisita)) as fechaVisita FROM visitasshi JOIN CentrosDeTrabajo C2 on visitasshi.idCentro = C2.idCentroTrabajo JOIN Formato F on C2.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE C.idCliente = $idCliente AND fechaVisita BETWEEN '$fechaInicial' AND '$fechaFinal' AND visitasshi.status != 1 GROUP BY YEAR(fechaVisita), MONTH(fechaVisita);")->result_array();
    }
    function obtenerGraficasEstatalesHora($idCliente, $idEstado, $fechaInicial, $fechaFinal)
    {
        $this->db->query("SET lc_time_names ='ES_es'");
        return $this->db->query("SELECT COUNT(idvisitas) * 3 as valor1, (SELECT SUM(TIMESTAMPDIFF(SECOND, HorasTrabajadas.fechaInicio, HorasTrabajadas.fechaFin) / 3600) FROM HorasTrabajadas JOIN CentrosDeTrabajo Trabajo on HorasTrabajadas.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r2 on Trabajo.idColonia = r2.idRegiones JOIN municipios m2 on r2.municipio = m2.idMunicipio JOIN estados e2 on m2.estado = e2.id_Estado JOIN Formato F2 on Trabajo.idFormato = F2.idFormato JOIN Clientes C3 on F2.idCliente = C3.idCliente WHERE HorasTrabajadas.fechaInicio BETWEEN '$fechaInicial' AND '$fechaFinal' AND HorasTrabajadas.fechaFin BETWEEN '$fechaInicial' AND '$fechaFinal' AND YEAR(fechaFin) = YEAR(fechaVisita) AND MONTH(fechaFin) = MONTH(fechaVisita) AND C3.idCliente = $idCliente AND e2.id_Estado = $idEstado) as valor2, CONCAT(MONTHNAME(fechaVisita), ' de ', YEAR(fechaVisita))                                               as fechaVisita FROM visitasshi JOIN CentrosDeTrabajo C2 on visitasshi.idCentro = C2.idCentroTrabajo JOIN Formato F on C2.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN regiones r on C2.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN estados e on m.estado = e.id_Estado WHERE C.idCliente = $idCliente AND e.id_Estado = $idEstado AND fechaVisita BETWEEN '$fechaInicial' AND '$fechaFinal' AND visitasshi.status != 1 GROUP BY YEAR(fechaVisita), MONTH(fechaVisita);")->result_array();
    }
    function obtenerGraficasMunicipalesHora($idCliente, $idMunicipio, $fechaInicial, $fechaFinal)
    {
        $this->db->query("SET lc_time_names ='ES_es'");
        return $this->db->query("SELECT COUNT(idvisitas) * 3 as valor1, (SELECT SUM(TIMESTAMPDIFF(SECOND, HorasTrabajadas.fechaInicio, HorasTrabajadas.fechaFin) / 3600) FROM HorasTrabajadas JOIN CentrosDeTrabajo Trabajo on HorasTrabajadas.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r2 on Trabajo.idColonia = r2.idRegiones JOIN municipios m2 on r2.municipio = m2.idMunicipio JOIN Formato F2 on Trabajo.idFormato = F2.idFormato JOIN Clientes C3 on F2.idCliente = C3.idCliente WHERE HorasTrabajadas.fechaInicio BETWEEN '$fechaInicial' AND '$fechaFinal' AND HorasTrabajadas.fechaFin BETWEEN '$fechaInicial' AND '$fechaFinal' AND YEAR(fechaFin) = YEAR(fechaVisita) AND MONTH(fechaFin) = MONTH(fechaVisita) AND C3.idCliente = $idCliente AND m2.idMunicipio = $idMunicipio) as valor2, CONCAT(MONTHNAME(fechaVisita), ' de ', YEAR( fechaVisita))                                                                                            as fechaVisita FROM visitasshi JOIN CentrosDeTrabajo C2 on visitasshi.idCentro = C2.idCentroTrabajo JOIN Formato F on C2.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN regiones r on C2.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio WHERE C.idCliente = $idCliente AND m.idMunicipio = $idMunicipio AND fechaVisita BETWEEN '$fechaInicial' AND '$fechaFinal' AND visitasshi.status != 1 GROUP BY YEAR(fechaVisita), MONTH(fechaVisita);")->result_array();
    }
    function obtenerGraficasCentroTrabajoHora($idCliente, $idCentroTrabajo, $fechaInicial, $fechaFinal)
    {
        $this->db->query("SET lc_time_names ='ES_es'");
        return $this->db->query("SELECT (COUNT(idvisitas) * 3) as valor1, (SELECT SUM(TIMESTAMPDIFF(SECOND, HorasTrabajadas.fechaInicio, HorasTrabajadas.fechaFin) / 3600) FROM HorasTrabajadas WHERE HorasTrabajadas.fechaInicio BETWEEN '$fechaInicial' AND '$fechaFinal' AND HorasTrabajadas.fechaFin BETWEEN '$fechaInicial' AND '$fechaFinal' AND YEAR(fechaFin) = YEAR(fechaVisita) AND MONTH(fechaFin) = MONTH(fechaVisita) AND HorasTrabajadas.idCentroTrabajo = $idCentroTrabajo) as valor2, CONCAT(MONTHNAME(fechaVisita), ' de ', YEAR(fechaVisita))                                           as fechaVisita FROM visitasshi JOIN CentrosDeTrabajo C2 on visitasshi.idCentro = C2.idCentroTrabajo JOIN Formato F on C2.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE C.idCliente = $idCliente AND C2.idCentroTrabajo = $idCentroTrabajo AND fechaVisita BETWEEN '$fechaInicial' AND '$fechaFinal' AND visitasshi.status != 1 GROUP BY YEAR(fechaVisita), MONTH(fechaVisita);")->result_array();
    }
    function obtenerGraficasNacionales($idCliente, $tipoGrafica, $area=2)
    {
        return $this->db->query("SELECT AVG(asignaInmueble.porcentajeValor) as porcentajeValor, S.nombre as nombreNorma FROM asignaInmueble JOIN CentrosDeTrabajo Trabajo on asignaInmueble.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN serviciosSubservicios S2 on asignaInmueble.idProyecto = S2.idControl JOIN Proyectos P on S2.idServicio = P.idProyecto JOIN Subservicios S on S2.idSubservicio = S.idSubservicio JOIN Clientes C on F.idCliente = $idCliente WHERE P.idArea=$area AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3) GROUP BY S.idSubservicio ORDER BY S.nombre;")->result_array();
    }
    function obtenerGraficasEstado($idCliente, $idEstado,$tipoGrafica, $area=2)
    {
        //Grafica de tipo CUMPLIMIENTO
        return $this->db->query("SELECT AVG(asignaInmueble.porcentajeValor) as porcentajeValor, S.nombre as nombreNorma FROM asignaInmueble JOIN CentrosDeTrabajo Trabajo on asignaInmueble.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN serviciosSubservicios S2 on asignaInmueble.idProyecto = S2.idControl JOIN Subservicios S on S2.idSubservicio = S.idSubservicio JOIN Proyectos P on S2.idServicio = P.idProyecto JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN estados e on m.estado = $idEstado JOIN Clientes C on F.idCliente = $idCliente WHERE P.idArea=$area AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3) GROUP BY S.idSubservicio  ORDER BY S.nombre;")->result_array();
    }
    function obtenerGraficasMunicipio($idCliente, $idMunicipio,$tipoGrafica, $area=2)
    {
        return $this->db->query("SELECT AVG(asignaInmueble.porcentajeValor) as porcentajeValor, S.nombre as nombreNorma FROM asignaInmueble JOIN CentrosDeTrabajo Trabajo on asignaInmueble.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN serviciosSubservicios S2 on asignaInmueble.idProyecto = S2.idControl JOIN Subservicios S on S2.idSubservicio = S.idSubservicio JOIN Proyectos P on S2.idServicio = P.idProyecto JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = $idMunicipio JOIN Clientes C on F.idCliente = $idCliente WHERE P.idArea=$area AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3) GROUP BY S.idSubservicio  ORDER BY S.nombre;")->result_array();
    }


    //AQUI EMPIEZA EL CÓDIGO QUE ESTA BIEN
    function getNumeroNormasAplicables($idCentroTrabajo)
    {
        return $this->db->query("select DISTINCT(serviciosSubservicios.idControl) as idProyecto from asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio where asignaInmueble.idCentroTrabajo = $idCentroTrabajo and Proyectos.idArea = 2 AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3)")->result_array();
    }
    function getNumeroNormasAplicablesMunicipio($idMunicipio, $idCliente)
    {
        return $this->db->query("select DISTINCT (serviciosSubservicios.idControl) as idProyecto from asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio JOIN CentrosDeTrabajo Trabajo on asignaInmueble.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente where m.idMunicipio = $idMunicipio and Proyectos.idArea = 2 AND C.idCliente=$idCliente AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3); ")->result_array();
    }
    function getNumeroNormasAplicablesEstado($idEstado, $idCliente)
    {
        return $this->db->query("select DISTINCT (serviciosSubservicios.idControl) as idProyecto from asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio JOIN CentrosDeTrabajo Trabajo on asignaInmueble.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN estados e on m.estado = e.id_Estado JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente where e.id_Estado=$idEstado and Proyectos.idArea = 2 AND C.idCliente = $idCliente AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3)")->result_array();
    }
    function getNumeroNormasAplicablesNacionales($idCliente)
    {
        return $this->db->query("select DISTINCT (serviciosSubservicios.idControl) as idProyecto from asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio JOIN CentrosDeTrabajo Trabajo on asignaInmueble.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente where Proyectos.idArea = 2 AND C.idCliente = $idCliente AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3); ")->result_array();
    }
    function getFechaMinima($idCentroTrabajo, $funcion, $fechaMinima)
    {
        $array=$this->db->query("SELECT $funcion(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma WHERE CumplimientoTiempoNorma.idCentroTrabajo=$idCentroTrabajo and fechaRespaldo>='$fechaMinima' GROUP BY idCentroTrabajo")->row_array();
        return $array["fecha"];
    }
    function getFechaMaxima($idCentroTrabajo, $funcion, $fechaMaxima)
    {
        $array=$this->db->query("SELECT $funcion(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma WHERE CumplimientoTiempoNorma.idCentroTrabajo=$idCentroTrabajo and fechaRespaldo<='$fechaMaxima' GROUP BY idCentroTrabajo")->row_array();
        return $array["fecha"];
    }
    function getFechaMinimaMunicipio($idMunicipio, $funcion, $idCliente, $fechaMinima)
    {
        $array=$this->db->query("SELECT $funcion(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE m.idMunicipio = $idMunicipio and C.idCliente=$idCliente AND fechaRespaldo>='$fechaMinima' GROUP BY idMunicipio;")->row_array();
        return $array["fecha"];
    }
    function getFechaMaximaMunicipio($idMunicipio, $funcion, $idCliente, $fechaMaxima)
    {
        $array=$this->db->query("SELECT $funcion(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE m.idMunicipio = $idMunicipio and C.idCliente=$idCliente AND fechaRespaldo<='$fechaMaxima' GROUP BY idMunicipio;")->row_array();
        return $array["fecha"];
    }
    function getFechaMinimaEstado($idEstado, $funcion, $idCliente, $fechaMinima)
    {
        $array=$this->db->query("SELECT $funcion(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN estados e on m.estado = e.id_Estado JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE e.id_Estado=$idEstado and C.idCliente = $idCliente AND fechaRespaldo >= '$fechaMinima' GROUP BY id_Estado; ")->row_array();
        return $array["fecha"];
    }
    function getFechaMaximaEstado($idEstado, $funcion, $idCliente, $fechaMaxima)
    {
        $array=$this->db->query("SELECT $funcion(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN estados e on m.estado = e.id_Estado JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE e.id_Estado=$idEstado and C.idCliente = $idCliente AND fechaRespaldo <= '$fechaMaxima' GROUP BY id_Estado; ")->row_array();
        return $array["fecha"];
    }
    function getFechaMinimaNacional($funcion, $idCliente, $fechaMinima)
    {
        $array=$this->db->query("SELECT $funcion(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE C.idCliente = $idCliente AND fechaRespaldo>='$fechaMinima';")->row_array();
        return $array["fecha"];
    }
    function getFechaMaximaNacional($funcion, $idCliente, $fechaMaxima)
    {
        $array=$this->db->query("SELECT $funcion(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE C.idCliente = $idCliente AND fechaRespaldo<='$fechaMaxima';")->row_array();
        return $array["fecha"];
    }
    function getFechaSiguiente($idCentroTrabajo, $fechaAnterior, $fechaSiguiente)
    {
        $array=$this->db->query("SELECT MIN(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma WHERE CumplimientoTiempoNorma.idCentroTrabajo=$idCentroTrabajo AND fechaRespaldo>'$fechaAnterior' AND fechaRespaldo<='$fechaSiguiente' GROUP BY idCentroTrabajo")->row_array();
        return $array["fecha"];
    }
    function buscarCumplimiento($normaAplicable, $fecha, $idCen)
    {
        return $this->db->query("SELECT MAX(porcentajeValor) as valor FROM CumplimientoTiempoNorma WHERE fechaRespaldo='$fecha' AND idProyecto=$normaAplicable AND idCentroTrabajo=$idCen")->result_array();
    }
    function getArrayFechaMinima($fechaMinima, $idCentroTrabajo)
    {
        return $this->db->query("SELECT CumplimientoTiempoNorma.*, CumplimientoTiempoNorma.fechaRespaldo as nombreNorma FROM CumplimientoTiempoNorma JOIN asignaInmueble on CumplimientoTiempoNorma.idAsignacion = asignaInmueble.idAsignacion WHERE CumplimientoTiempoNorma.idCentroTrabajo=$idCentroTrabajo and fechaRespaldo='$fechaMinima' AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3)  GROUP BY CumplimientoTiempoNorma.idProyecto;")->result_array();
    }
    function getArrayFechaMinimaMunicipio($fechaMinima, $idMunicipio, $idCliente)
    {
        return $this->db->query("SELECT CumplimientoTiempoNorma.idCumplimiento, CumplimientoTiempoNorma.idAsignacion, CumplimientoTiempoNorma.idCentroTrabajo, CumplimientoTiempoNorma.idProyecto, AVG(CumplimientoTiempoNorma.porcentajeValor) as porcentajeValor, CumplimientoTiempoNorma.fechaRespaldo        as nombreNorma, S.nombre FROM CumplimientoTiempoNorma JOIN asignaInmueble on CumplimientoTiempoNorma.idAsignacion = asignaInmueble.idAsignacion JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN serviciosSubservicios S2 on CumplimientoTiempoNorma.idProyecto = S2.idControl JOIN Subservicios S on S2.idSubservicio = S.idSubservicio WHERE m.idMunicipio = $idMunicipio and fechaRespaldo = '$fechaMinima' and C.idCliente = $idCliente AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3) GROUP BY CumplimientoTiempoNorma.idProyecto;")->result_array();
    }
    function getArrayFechaMinimaEstado($fechaMinima, $idEstado, $idCliente)
    {
        return $this->db->query("SELECT CumplimientoTiempoNorma.idCumplimiento, CumplimientoTiempoNorma.idAsignacion, CumplimientoTiempoNorma.idCentroTrabajo, CumplimientoTiempoNorma.idProyecto, AVG(CumplimientoTiempoNorma.porcentajeValor) as porcentajeValor, CumplimientoTiempoNorma.fechaRespaldo        as nombreNorma, S.nombre FROM CumplimientoTiempoNorma JOIN asignaInmueble on CumplimientoTiempoNorma.idAsignacion = asignaInmueble.idAsignacion JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN estados e on m.estado = e.id_Estado JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN serviciosSubservicios S2 on CumplimientoTiempoNorma.idProyecto = S2.idControl JOIN Subservicios S on S2.idSubservicio = S.idSubservicio WHERE e.id_Estado=$idEstado and fechaRespaldo = '$fechaMinima' and C.idCliente = $idCliente AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3) GROUP BY CumplimientoTiempoNorma.idProyecto;")->result_array();
    }
    function getArrayFechaMinimaNacional($fechaMinima,$idCliente)
    {
        return $this->db->query("SELECT CumplimientoTiempoNorma.idCumplimiento, CumplimientoTiempoNorma.idAsignacion, CumplimientoTiempoNorma.idCentroTrabajo, CumplimientoTiempoNorma.idProyecto, AVG(CumplimientoTiempoNorma.porcentajeValor) as porcentajeValor, CumplimientoTiempoNorma.fechaRespaldo        as nombreNorma, S.nombre FROM CumplimientoTiempoNorma JOIN asignaInmueble on CumplimientoTiempoNorma.idAsignacion = asignaInmueble.idAsignacion JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN serviciosSubservicios S2 on CumplimientoTiempoNorma.idProyecto = S2.idControl JOIN Subservicios S on S2.idSubservicio = S.idSubservicio JOIN Proyectos P on S2.idServicio = P.idProyecto WHERE fechaRespaldo = '$fechaMinima' and C.idCliente = $idCliente AND (asignaInmueble.normaInvalida IS NULL OR  asignaInmueble.normaInvalida!=3) AND P.idArea=2 GROUP BY CumplimientoTiempoNorma.idProyecto;")->result_array();
    }
    function getNumeroFechas($idCen, $fechaMinima, $fechaMaxima)
    {
        $numero=$this->db->query("SELECT COUNT(DISTINCT(CONCAT(YEAR (fechaRespaldo),'-',MONTH (fechaRespaldo)))) as cuenta FROM CumplimientoTiempoNorma WHERE idCentroTrabajo=$idCen And fechaRespaldo BETWEEN '$fechaMinima' AND '$fechaMaxima'")->row_array();
        return $numero["cuenta"];
    }
    function getNumeroFechasMunicipio($idMunicipio, $idCliente, $fechaMinima, $fechaMaxima)
    {
        $numero=$this->db->query("SELECT COUNT(DISTINCT (CONCAT(YEAR(fechaRespaldo), '-', MONTH(fechaRespaldo)))) as cuenta FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE m.idMunicipio = $idMunicipio AND C.idCliente=$idCliente and fechaRespaldo BETWEEN '$fechaMinima' AND '$fechaMaxima';")->row_array();
        return $numero["cuenta"];
    }
    function getNumeroFechasEstado($idEstado, $idCliente, $fechaMinima, $fechaMaxima)
    {
        $numero=$this->db->query("SELECT COUNT(DISTINCT (CONCAT(YEAR(fechaRespaldo), '-', MONTH(fechaRespaldo)))) as cuenta FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN estados e on m.estado = e.id_Estado JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE e.id_Estado=$idEstado AND C.idCliente = $idCliente and fechaRespaldo BETWEEN '$fechaMinima' AND '$fechaMaxima'; ")->row_array();
        return $numero["cuenta"];
    }
    function getNumeroFechasNacional($idCliente, $fechaMinima, $fechaMaxima)
    {
        $numero=$this->db->query("SELECT COUNT(DISTINCT (CONCAT(YEAR(fechaRespaldo), '-', MONTH(fechaRespaldo)))) as cuenta FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE C.idCliente = $idCliente and fechaRespaldo BETWEEN '$fechaMinima' AND '$fechaMaxima';")->row_array();
        return $numero["cuenta"];
    }
    function getFechaSiguienteMunicipio($idMunicipio, $fechaAnterior, $fechaSiguiente, $idCliente)
    {
        $array=$this->db->query("SELECT MIN(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio WHERE m.idMunicipio = $idMunicipio AND fechaRespaldo > '$fechaAnterior' AND fechaRespaldo <= '$fechaSiguiente' AND C.idCliente=$idCliente GROUP BY m.idMunicipio;")->row_array();
        return $array["fecha"];
    }
    function getFechaSiguienteEstado($idEstado, $fechaAnterior, $fechaSiguiente, $idCliente)
    {
        $array=$this->db->query("SELECT MIN(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente JOIN regiones r on Trabajo.idColonia = r.idRegiones JOIN municipios m on r.municipio = m.idMunicipio JOIN estados e on m.estado = e.id_Estado WHERE e.id_Estado=$idEstado AND fechaRespaldo > '$fechaAnterior' AND fechaRespaldo <= '$fechaSiguiente' AND C.idCliente = $idCliente GROUP BY e.id_Estado;")->row_array();
        return $array["fecha"];
    }
    function getFechaSiguienteNacional($fechaAnterior, $fechaSiguiente, $idCliente)
    {
        $array=$this->db->query("SELECT MIN(fechaRespaldo) as fecha FROM CumplimientoTiempoNorma JOIN CentrosDeTrabajo Trabajo on CumplimientoTiempoNorma.idCentroTrabajo = Trabajo.idCentroTrabajo JOIN Formato F on Trabajo.idFormato = F.idFormato JOIN Clientes C on F.idCliente = C.idCliente WHERE fechaRespaldo > '$fechaAnterior' AND fechaRespaldo <= '$fechaSiguiente' AND C.idCliente = $idCliente;")->row_array();
        return $array["fecha"];
    }
    function getNombreCliente($idCliente)
    {
        return $this->db->query("SELECT Clientes.nombreCliente FROM Clientes WHERE idCliente=$idCliente")->row_array();
    }
}