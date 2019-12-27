<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menus extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("usuarios");
        $this->load->library('user_agent');
    }
    public function index()
    {

        if($_SESSION['idCliente'] != '')
        {
            //$this->load->view('graficas');
            $data['nombreCliente']=$this->usuarios->getNombreCliente($_SESSION['idCliente']);
            if($this->agent->is_mobile())
            {
                $this->load->view('headerMovil');
                $this->load->view('dashboard_view', $data);
                $this->load->view('footerMovil');
            }
            else
            {
                $this->load->view('header');
                $this->load->view('dashboard_view', $data);
                $this->load->view('footer');
            }

        }
        else
        {
            header("location: https://cointic.com.mx/preveer/Cliente/");

        }
    }
    public function prueba()
    {
        $this->load->view('graficas');
    }

    function getEdos()
    {
        $Cliente=$this->session->userdata('idCliente');
        $prueba = $this->usuarios->obtenerFichaEdos($Cliente);
        echo json_encode ($prueba);
    }

    function obtenerMunicipios($idEstado)
    {
        $municipios=$this->usuarios->getMunicipios($idEstado);
        echo json_encode($municipios);
    }
    function getCentros($estadoI,$municipio)
    {
        if ($estadoI=="0" && $municipio=="0") {
            //echo "todos";
            $and="";
        }
        if ($estadoI!="0" && $municipio=="0") {
            //echo "todos municipios";
            $and="and  estados.id_Estado=$estadoI";
        }
        if ($estadoI!="0" && $municipio!="0") {
            //echo "especificos";
            $and="and municipios.idMunicipio=$municipio";
        }
        $Cliente=$this->session->userdata('idCliente');
        $prueba = $this->usuarios->obtenerFichaCentros($Cliente,$and);
        echo json_encode ($prueba);
    }

    function getNormar($idCen)
    {
        $Cliente=$this->session->userdata('idCliente');
        $prueba = $this->usuarios->obtenerNormarCen($Cliente,$idCen);
        echo json_encode ($prueba);
    }

    function getNormarArreglo($idCen)
    {
        $Cliente=$this->session->userdata('idCliente');
        $prueba = $this->usuarios->obtenerNormarCenArreglo($Cliente,$idCen);
        $data = array();
        foreach ($prueba as $row)
        {
            $data[] = $row;
        }
        echo json_encode ($data);
    }

    function getPorcen($idSub,$idCen)
    {

        $prueba = $this->usuarios->obtenerNormarPorcentaje($idSub,$idCen);
        echo json_encode ($prueba);
    }

    function getGraficasNacionales()
    {
        $Cliente=$this->session->userdata('idCliente');
        $graficas=array();
        //Grafica nacional sobre el cumplimiento de norma
        $graficas[0]=array('label' => 'Cumplimiento de norma', 'type'=>'line', 'data' => $this->usuarios->obtenerGraficasNacionales($Cliente, 0, 2));
        echo json_encode($graficas);
    }
    function getGraficasEstado($idEstado)
    {
        $cliente=$this->session->userdata('idCliente');
        $graficas=array();
        //Grafica nacional sobre el cumplimiento de norma
        $graficas[0]=array('label' => 'Cumplimiento de norma', 'type'=>'line', 'data' => $this->usuarios->obtenerGraficasEstado($cliente,$idEstado, 0, 2));
        echo json_encode($graficas);
    }
    function getGraficasMunicipio($idMunicipio)
    {
        $cliente=$this->session->userdata('idCliente');
        $graficas=array();
        //Grafica nacional sobre el cumplimiento de norma
        $graficas[0]=array('label' => 'Cumplimiento de norma', 'type'=>'line', 'data' => $this->usuarios->obtenerGraficasMunicipio($cliente,$idMunicipio, 0, 2));
        echo json_encode($graficas);
    }
    function getGraficasNacionalesHora($fechaInicial="1000-01-01", $fechaFinal="2038-01-01")
    {
        $fechaHoy=date("Y-m-d");
        if(strtotime($fechaFinal)>strtotime($fechaHoy))
            $fechaFinal=$fechaHoy;
        $Cliente=$this->session->userdata('idCliente');
        $graficas=array();
        //Grafica nacional sobre el cumplimiento de norma
        $graficas[0]=array('label' => 'Horas trabajadas por los analistas', 'type'=>'bar', 'data' => $this->usuarios->obtenerGraficasNacionalesHora($Cliente, $fechaInicial, $fechaFinal));
        echo json_encode($graficas);
    }
    function getGraficasEstatalesHora($idEstado, $fechaInicial="1000-01-01", $fechaFinal="2038-01-01")
    {
        $fechaHoy=date("Y-m-d");
        if(strtotime($fechaFinal)>strtotime($fechaHoy))
            $fechaFinal=$fechaHoy;
        $Cliente=$this->session->userdata('idCliente');
        $graficas=array();
        //Grafica nacional sobre el cumplimiento de norma
        $graficas[0]=array('label' => 'Horas trabajadas por los analistas', 'type'=>'bar', 'data' => $this->usuarios->obtenerGraficasEstatalesHora($Cliente, $idEstado, $fechaInicial, $fechaFinal));
        echo json_encode($graficas);
    }
    function getGraficasMunicipalesHora($idMunicipio, $fechaInicial="1000-01-01", $fechaFinal="2038-01-01")
    {
        $fechaHoy=date("Y-m-d");
        if(strtotime($fechaFinal)>strtotime($fechaHoy))
            $fechaFinal=$fechaHoy;
        $Cliente=$this->session->userdata('idCliente');
        $graficas=array();
        //Grafica nacional sobre el cumplimiento de norma
        $graficas[0]=array('label' => 'Horas trabajadas por los analistas', 'type'=>'bar', 'data' => $this->usuarios->obtenerGraficasMunicipalesHora($Cliente, $idMunicipio, $fechaInicial, $fechaFinal));
        echo json_encode($graficas);
    }
    function getGraficasCentroTrabajoHora($idCentroTrabajo, $fechaInicial="1000-01-01", $fechaFinal="2038-01-01")
    {
        $fechaHoy=date("Y-m-d");
        if(strtotime($fechaFinal)>strtotime($fechaHoy))
            $fechaFinal=$fechaHoy;
        $Cliente=$this->session->userdata('idCliente');
        $graficas=array();
        //Grafica nacional sobre el cumplimiento de norma
        $graficas[0]=array('label' => 'Horas trabajadas por los analistas', 'type'=>'bar', 'data' => $this->usuarios->obtenerGraficasCentroTrabajoHora($Cliente, $idCentroTrabajo, $fechaInicial, $fechaFinal));
        echo json_encode($graficas);
    }
    function getNormarArregloTiempo($idCen, $fechaMinima="1000-01-01", $fechaMaxima="2038-01-01")
    {
        //ESTE CÓDIGO YA FUNCIONA! Hay que analizar como reemplazar la condicion de centro de trabajo por su correspondiente
        //Puede ser municipio, estado, o cliente, pero el código es el mismo
        //$Cliente=$this->session->userdata('idCliente');
        //SELECCIONA los ids de las normas aplicables al centro de trabajo
        $normasAplicables=$this->usuarios->getNumeroNormasAplicables($idCen); //4 normas para el de prueba
        //SELECCIONA la fecha minima y maxima en la tabla de cumplimiento para el centro de trabajo
        $fechaMinima=$this->usuarios->getFechaMinima($idCen, "MIN", $fechaMinima);
        //la fecha minima indica cual fue el último arreglo que tiene todos los valores
        //la fecha maxima indica la ultima fecha registrada
        $fechaMaxima=$this->usuarios->getFechaMaxima($idCen, "MAX", $fechaMaxima);
        $arregloPorcentajesFechaMinima=$this->usuarios->getArrayFechaMinima($fechaMinima,$idCen);
        $numeroFechas=$this->usuarios->getNumeroFechas($idCen, $fechaMinima, $fechaMaxima);
        for($i=0; $i<sizeof($normasAplicables); $i++)
        {
            $ultimoArregloCompleto[$i]=array('idCumplimiento' => 0, 'idAsignacion' => 0, 'idCentroTrabajo' => 0, 'idProyecto' => $normasAplicables[$i]['idProyecto'], 'porcentajeValor' => 0, 'nombreNorma'=>$fechaMinima, 'nombre' => 'Relleno');
        }
        $arregloFinal=array();

        for($j=0; $j<$numeroFechas; $j++)
        {

            $arregloPorcentajesFechaMinima=$this->usuarios->getArrayFechaMinima($fechaMinima, $idCen);
            //SI coincide el numero de normas con el numero de porcentajes, cambia la fecha minima
            if(sizeof($arregloPorcentajesFechaMinima)==sizeof($normasAplicables))
            {
                $ultimoArregloCompleto=$arregloPorcentajesFechaMinima;
                array_push($arregloFinal, $ultimoArregloCompleto);

            }
            //Tomar, del mes anterior, porcentaje que falta, si es que existe
            else if(sizeof($arregloPorcentajesFechaMinima)!=sizeof($normasAplicables))
            {
                //Aqui se debe crear un arreglo que contenga los valores de arregloPorcentajesFechaMinima, más los valores que hacen falta
                $nuevoArreglo=$arregloPorcentajesFechaMinima;
                $viejoArreglo=$ultimoArregloCompleto;
                $tamano=sizeof($viejoArreglo);
                for($i=0; $i<$tamano; $i++)
                {
                    if(isset($viejoArreglo[$i]))
                    {
                        foreach ($nuevoArreglo as $nuevo)
                        {

                            if ($nuevo['idProyecto'] == $viejoArreglo[$i]['idProyecto'])
                            {
                                unset($viejoArreglo[$i]);
                                $i = -1;
                                break;
                            }
                        }
                    }

                }

                foreach ($viejoArreglo as $viejo)
                {
                    $viejo['nombreNorma']=$fechaMinima;
                    array_push($nuevoArreglo, $viejo);
                }
                array_push($arregloFinal, $nuevoArreglo);
                $ultimoArregloCompleto=$nuevoArreglo;
            }
            //actualiza las fechas minimas
            $fechaMinima=$this->usuarios->getFechaSiguiente($idCen, $fechaMinima, $fechaMaxima);

        }
        echo json_encode($arregloFinal);


    }
    function getGraficasMunicipioTiempo($idMunicipio,  $fechaMinima="1000-01-01", $fechaMaxima="2038-01-01")
    {
        //ESTE CÓDIGO YA FUNCIONA! Hay que analizar como reemplazar la condicion de centro de trabajo por su correspondiente
        //Puede ser municipio, estado, o cliente, pero el código es el mismo
        $Cliente=$this->session->userdata('idCliente');
        //SELECCIONA los ids de las normas aplicables al centro de trabajo
        $normasAplicables=$this->usuarios->getNumeroNormasAplicablesMunicipio($idMunicipio, $Cliente); //4 normas para el de prueba
        //SELECCIONA la fecha minima y maxima en la tabla de cumplimiento para el centro de trabajo
        $fechaMinima=$this->usuarios->getFechaMinimaMunicipio($idMunicipio, "MIN", $Cliente, $fechaMinima);
        //la fecha minima indica cual fue el último arreglo que tiene todos los valores
        //la fecha maxima indica la ultima fecha registrada
        $fechaMaxima=$this->usuarios->getFechaMaximaMunicipio($idMunicipio, "MAX", $Cliente, $fechaMaxima);
        $arregloPorcentajesFechaMinima=$this->usuarios->getArrayFechaMinimaMunicipio($fechaMinima, $idMunicipio, $Cliente);
        $numeroFechas=$this->usuarios->getNumeroFechasMunicipio($idMunicipio, $Cliente, $fechaMinima, $fechaMaxima);
        for($i=0; $i<sizeof($normasAplicables); $i++)
        {
            $ultimoArregloCompleto[$i]=array('idCumplimiento' => 0, 'idAsignacion' => 0, 'idCentroTrabajo' => 0, 'idProyecto' => $normasAplicables[$i]['idProyecto'], 'porcentajeValor' => 0, 'nombreNorma'=>$fechaMinima, 'nombre' => 'Relleno');
        }
        $arregloFinal=array();

        for($j=0; $j<$numeroFechas; $j++)
        {

            $arregloPorcentajesFechaMinima=$this->usuarios->getArrayFechaMinimaMunicipio($fechaMinima, $idMunicipio, $Cliente);
            //SI coincide el numero de normas con el numero de porcentajes, cambia la fecha minima
            if(sizeof($arregloPorcentajesFechaMinima)==sizeof($normasAplicables))
            {
                $ultimoArregloCompleto=$arregloPorcentajesFechaMinima;
                array_push($arregloFinal, $ultimoArregloCompleto);

            }
            //Tomar, del mes anterior, porcentaje que falta, si es que existe
            else if(sizeof($arregloPorcentajesFechaMinima)!=sizeof($normasAplicables))
            {
                //Aqui se debe crear un arreglo que contenga los valores de arregloPorcentajesFechaMinima, más los valores que hacen falta
                $nuevoArreglo=$arregloPorcentajesFechaMinima;
                $viejoArreglo=$ultimoArregloCompleto;
                $tamano=sizeof($viejoArreglo);
                for($i=0; $i<$tamano; $i++)
                {
                    if(isset($viejoArreglo[$i]))
                    {
                        foreach ($nuevoArreglo as $nuevo)
                        {

                            if ($nuevo['idProyecto'] == $viejoArreglo[$i]['idProyecto'])
                            {
                                unset($viejoArreglo[$i]);
                                $i = -1;
                                break;
                            }
                        }
                    }

                }

                foreach ($viejoArreglo as $viejo)
                {
                    $viejo['nombreNorma']=$fechaMinima;
                    array_push($nuevoArreglo, $viejo);
                }
                array_push($arregloFinal, $nuevoArreglo);
                $ultimoArregloCompleto=$nuevoArreglo;
            }
            //actualiza las fechas minimas
            $fechaMinima=$this->usuarios->getFechaSiguienteMunicipio($idMunicipio, $fechaMinima, $fechaMaxima, $Cliente);
        }
        echo json_encode($arregloFinal);

    }
    function getGraficasEstadoTiempo($idEstado, $fechaMinima="1000-01-01", $fechaMaxima="2038-01-01")
    {
        //ESTE CÓDIGO YA FUNCIONA! Hay que analizar como reemplazar la condicion de centro de trabajo por su correspondiente
        //Puede ser municipio, estado, o cliente, pero el código es el mismo
        $Cliente=$this->session->userdata('idCliente');
        //SELECCIONA los ids de las normas aplicables al centro de trabajo
        $normasAplicables=$this->usuarios->getNumeroNormasAplicablesEstado($idEstado, $Cliente); //4 normas para el de prueba
        //SELECCIONA la fecha minima y maxima en la tabla de cumplimiento para el centro de trabajo
        $fechaMinima=$this->usuarios->getFechaMinimaEstado($idEstado, "MIN", $Cliente, $fechaMinima);
        //la fecha minima indica cual fue el último arreglo que tiene todos los valores
        //la fecha maxima indica la ultima fecha registrada
        $fechaMaxima=$this->usuarios->getFechaMaximaEstado($idEstado, "MAX", $Cliente, $fechaMaxima);
        $arregloPorcentajesFechaMinima=$this->usuarios->getArrayFechaMinimaEstado($fechaMinima, $idEstado, $Cliente);
        $numeroFechas=$this->usuarios->getNumeroFechasEstado($idEstado, $Cliente, $fechaMinima, $fechaMaxima);
        for($i=0; $i<sizeof($normasAplicables); $i++)
        {
            $ultimoArregloCompleto[$i]=array('idCumplimiento' => 0, 'idAsignacion' => 0, 'idCentroTrabajo' => 0, 'idProyecto' => $normasAplicables[$i]['idProyecto'], 'porcentajeValor' => 0, 'nombreNorma'=>$fechaMinima, 'nombre' => 'Relleno');
        }
        $arregloFinal=array();
        for($j=0; $j<$numeroFechas; $j++)
        {

            $arregloPorcentajesFechaMinima=$this->usuarios->getArrayFechaMinimaEstado($fechaMinima, $idEstado, $Cliente);
            //SI coincide el numero de normas con el numero de porcentajes, cambia la fecha minima
            if(sizeof($arregloPorcentajesFechaMinima)==sizeof($normasAplicables))
            {
                $ultimoArregloCompleto=$arregloPorcentajesFechaMinima;
                array_push($arregloFinal, $ultimoArregloCompleto);

            }
            //Tomar, del mes anterior, porcentaje que falta, si es que existe
            else if(sizeof($arregloPorcentajesFechaMinima)!=sizeof($normasAplicables))
            {
                //Aqui se debe crear un arreglo que contenga los valores de arregloPorcentajesFechaMinima, más los valores que hacen falta
                $nuevoArreglo=$arregloPorcentajesFechaMinima;
                $viejoArreglo=$ultimoArregloCompleto;
                $tamano=sizeof($viejoArreglo);
                for($i=0; $i<$tamano; $i++)
                {
                    if(isset($viejoArreglo[$i]))
                    {
                        foreach ($nuevoArreglo as $nuevo)
                        {

                            if ($nuevo['idProyecto'] == $viejoArreglo[$i]['idProyecto'])
                            {
                                unset($viejoArreglo[$i]);
                                $i = -1;
                                break;
                            }
                        }
                    }

                }

                foreach ($viejoArreglo as $viejo)
                {
                    $viejo['nombreNorma']=$fechaMinima;
                    array_push($nuevoArreglo, $viejo);
                }
                array_push($arregloFinal, $nuevoArreglo);
                $ultimoArregloCompleto=$nuevoArreglo;
            }
            //actualiza las fechas minimas
            $fechaMinima=$this->usuarios->getFechaSiguienteEstado($idEstado, $fechaMinima, $fechaMaxima, $Cliente);
        }
        echo json_encode($arregloFinal);
    }
    function getGraficasNacionalesTiempo($fechaInicial="1000-01-01", $fechaFinal="2038-01-01")
    {
        //ESTE CÓDIGO YA FUNCIONA! Hay que analizar como reemplazar la condicion de centro de trabajo por su correspondiente
        //Puede ser municipio, estado, o cliente, pero el código es el mismo
        $Cliente=$this->session->userdata('idCliente');
        //SELECCIONA los ids de las normas aplicables al centro de trabajo
        $normasAplicables=$this->usuarios->getNumeroNormasAplicablesNacionales($Cliente); //6 para sports world
        //SELECCIONA la fecha minima y maxima en la tabla de cumplimiento para el centro de trabajo
        $fechaMinima=$this->usuarios->getFechaMinimaNacional("MIN", $Cliente, $fechaInicial); //DIC
        //la fecha minima indica cual fue el último arreglo que tiene todos los valores
        //la fecha maxima indica la ultima fecha registrada
        $fechaMaxima=$this->usuarios->getFechaMaximaNacional("MAX", $Cliente, $fechaFinal); //ENERO
        $arregloFinal=array();

        if(empty($fechaMinima)||empty($fechaMaxima))
            return json_encode($arregloFinal);

        $arregloPorcentajesFechaMinima=$this->usuarios->getArrayFechaMinimaNacional($fechaMinima, $Cliente);
        $numeroFechas=$this->usuarios->getNumeroFechasNacional($Cliente, $fechaMinima, $fechaMaxima);
        $ultimoArregloCompleto=array();

        for($i=0; $i<sizeof($normasAplicables); $i++)
        {
            $ultimoArregloCompleto[$i]=array('idCumplimiento' => 0, 'idAsignacion' => 0, 'idCentroTrabajo' => 0, 'idProyecto' => $normasAplicables[$i]['idProyecto'], 'porcentajeValor' => 0, 'nombreNorma'=>$fechaMinima, 'nombre' => 'Relleno');
        }
        for($j=0; $j<$numeroFechas; $j++)
        {
            $arregloPorcentajesFechaMinima=$this->usuarios->getArrayFechaMinimaNacional($fechaMinima, $Cliente); //6 y 3
            //SI coincide el numero de normas con el numero de porcentajes, cambia la fecha minima
            if(sizeof($arregloPorcentajesFechaMinima)==sizeof($normasAplicables))
            {
                $ultimoArregloCompleto=$arregloPorcentajesFechaMinima;
                array_push($arregloFinal, $ultimoArregloCompleto);

            }
            //Tomar, del mes anterior, porcentaje que falta, si es que existe
            else if(sizeof($arregloPorcentajesFechaMinima)!=sizeof($normasAplicables))
            {
                //Aqui se debe crear un arreglo que contenga los valores de arregloPorcentajesFechaMinima, más los valores que hacen falta
                $nuevoArreglo=$arregloPorcentajesFechaMinima;
                $viejoArreglo=$ultimoArregloCompleto;
                $tamano=sizeof($viejoArreglo);
                for($i=0; $i<$tamano; $i++)
                {
                    if(isset($viejoArreglo[$i]))
                    {
                        foreach ($nuevoArreglo as $nuevo)
                        {

                            if ($nuevo['idProyecto'] == $viejoArreglo[$i]['idProyecto'])
                            {
                                unset($viejoArreglo[$i]);
                                $i = -1;
                                break;
                            }
                        }
                    }
                }
                foreach ($viejoArreglo as $viejo)
                {
                    $viejo['nombreNorma']=$fechaMinima;
                    array_push($nuevoArreglo, $viejo);
                }
                array_push($arregloFinal, $nuevoArreglo);
                $ultimoArregloCompleto=$nuevoArreglo;
            }
            //actualiza las fechas minimas
            $fechaMinima=$this->usuarios->getFechaSiguienteNacional($fechaMinima, $fechaMaxima, $Cliente);
        }
        echo json_encode($arregloFinal);

    }
}
	