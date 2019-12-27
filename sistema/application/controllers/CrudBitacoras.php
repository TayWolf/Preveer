<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use phpoffice\phpword\bootstrap;



class CrudBitacoras extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("bitacoras"); //cargamos el modelo
    }

    public function index($index = 1)
    {
        $usuario = $this->session->userdata('idusuariobase');
        $data['page'] = $this->bitacoras->data_pagination("/CrudBitacoras/index/", $this->bitacoras->getTotalRowAllData($usuario), 3);
        $data['listBitacoras'] = $this->bitacoras->getDatos($index, $usuario);
        $data['bitacoras'] = $this->bitacoras->getBitacorasAutoadministrables();
        $data['bitacoraAsignacion'] = $this->bitacoras->getBitacoraAsignacion($usuario);
        $this->load->view('viewTodoBitacoras', $data);
    }


    public function verBitacora($idBitacora, $idAsignacion)
    {
        // $data['idAsignacion']=$idAsignacion;
        $idCen=$this->bitacoras->idCentro($idAsignacion);  
            foreach ($idCen as $key) {
                $idCentroTrabajo= $key['idCentroTrabajo'];
            }

        $data = ['idAsignacion' => $idAsignacion, 'idBitacora' => $idBitacora,'idCentroTrabajo'=>$idCentroTrabajo];
        $data['areasUbicacion'] = $this->bitacoras->getAreasUbicacion();
        $data['indicadores'] = $this->bitacoras->getIndica($idBitacora);
        $data['ponderador']=array();

        foreach ($data['indicadores'] as $indicador)
        {
            if($indicador['tipoIndicador']==1)
                $data['ponderador'][$indicador['idIndicador']]=array($this->obtenerArregloPonde($idBitacora, " AND BitacoraIndicador.idIndicador=".$indicador['idIndicador']));

        }
        

        $data['datosBitacora'] = $this->bitacoras->getDatosBitacora($idBitacora, $idCentroTrabajo);
         //$data = ['idCentroTrabajo' => $idCentroTrabajo];
        // echo "datito".$idAsignacion;
        $data['nombreBitac'] = $this->bitacoras->getnombreBitacor($idBitacora);
        $data['condiciones'] = $this->bitacoras->getCondicionesBitacora($idBitacora);
        $data['indicadorInforme'] = $this->bitacoras->getIndicadorInforme($idBitacora);
        $data['indicadorContador'] = $this->bitacoras->getIndicadorContador($idBitacora);

        $this->load->view('gridBitacoraAdministrable', $data);
    }

    public function insertarArregloAutoadministrable($idAsignacion, $idBitacora)
    {

        $datosBitacora = json_decode($this->input->post('datos'), false);

        $almacenamiento = array('idBitacora' => $idBitacora, 'idAsignacion' => $idAsignacion);
        $llavePrimaria = $this->bitacoras->insertarAlmacenamiento($almacenamiento);
        foreach ($datosBitacora as $key => $value) {
            if (!empty($value)) {
                $arreglo = array('idIndicador' => $key, 'idAlmacenamiento' => $llavePrimaria, 'valor' => $value);
                $this->bitacoras->insertarDatoBitacora($arreglo);
            }
        }
        echo $llavePrimaria;

    }

    function eliminarAlmacenamiento($idAlmacenamiento)
    {
        $this->bitacoras->eliminarAlmacenamiento($idAlmacenamiento);
    }


    function registrarInformeBitacora($idAsignacion, $idBitacora, $cantidadIndicadorInforme, $cantidadCalculoInforme)
    {
        $this->bitacoras->borrarInforme($idAsignacion, $idBitacora);
        $comentarios = $this->input->post('observacionesGenerales');
        $arregloInformeBitacora = array('idAsignacion' => $idAsignacion, 'idBitacora' => $idBitacora, 'comentarios' => $comentarios);
        $idInformeBitacora = $this->bitacoras->registrarInformeBitacora($arregloInformeBitacora);
        for ($i = 0; $i < $cantidadCalculoInforme; $i++) {
            $identificadorCalculo = $this->input->post('calculo' . $i);
            $cantidad = $this->input->post('cantidad' . $i);
            $numero = $this->input->post('numero' . $i);
            $observaciones = $this->input->post('observaciones' . $i);
            $arregloCalculoInforme = array('idInformeBitacora' => $idInformeBitacora, 'idCalculo' => $identificadorCalculo, 'cantidad' => $cantidad, 'numero' => $numero, 'observaciones' => $observaciones);
            $this->bitacoras->insertarCalculoInforme($arregloCalculoInforme);
        }
        for ($i = 0; $i < $cantidadIndicadorInforme; $i++) {
            $idIndicadorBitacora = $this->input->post('idIndicadorInforme' . $i);
            $valor = $this->input->post('indicadorInforme' . $i);
            $arregloIndicadorInforme = array('idInformeBitacora' => $idInformeBitacora, 'idIndicadorBitacora' => $idIndicadorBitacora, 'valor' => $valor);
            $this->bitacoras->insertarIndicadorInforme($arregloIndicadorInforme);
        }


    }

    public function getInformeBitacora($idAsignacion, $idBitacora)
    {
        echo json_encode($this->bitacoras->getInformeBitacora($idAsignacion, $idBitacora));
    }

    public function getDatoInformeBitacora($idInformeBitacora)
    {
        echo json_encode($this->bitacoras->getDatoInformeBitacora($idInformeBitacora));
    }

    public function getCalculoInforme($idInformeBitacora)
    {
        echo json_encode($this->bitacoras->getCalculoInforme($idInformeBitacora));
    }

    public function biblioteca($index = 1)
    {
        $usuario = $this->session->userdata('idusuariobase');
        $data['page'] = $this->bitacoras->data_pagination("/CrudBitacoras/biblioteca/", $this->bitacoras->getTotalRowAllData($usuario), 3);
        $data['listBitacoras'] = $this->bitacoras->getDatos($index, $usuario);
        $this->load->view('viewTodoBibliotecaVirtual', $data);
    }

    public function bitacora001($idAsignacion)
    {
        $data['idAsignacion'] = $idAsignacion;
        $data['tablaBitacora'] = $this->bitacoras->cargarTabla('BitacoraDetectoresHumo', $idAsignacion);
        $data['areasUbicacion'] = $this->bitacoras->getAreasUbicacion();
        $this->load->view('gridBitacoraDetectoresHumo', $data);
    }

    public function actualizarBitacora001($idAsignacion)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        foreach ($datosBitacora as $key => $value2) {
            $accion = $value2->action;
            //INSERT
            if ($accion == 1) {
                $dataPuente = array(
                    'areaUbicacion' => $value2->areaUbicacion,
                    'enElPlano' => $value2->enElPlano,
                    'tipoSensor' => $value2->tipoSensor,
                    'libreObstruccion' => $value2->libreObstruccion,
                    'indicadorLuminoso' => $value2->indicadorLuminoso,
                    'cargaBien' => $value2->carga,
                    'activacionTablero' => $value2->activacionTablero,
                    'enBuenEstado' => $value2->enBuenEstado,
                    'limpio' => $value2->limpio,
                    'insectos' => $value2->insectos,
                    'equipoFijo' => $value2->equipoFijo,
                    'mesMantenimiento' => $value2->mesMantenimiento,
                    'observaciones' => $value2->observaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->bitacoras->insertarDatosBitacora($dataPuente, 'BitacoraDetectoresHumo');
            } //UPDATE
            else if ($accion == 2) {
                $idBitacora = $value2->idBitacora;
                $dataPuente = array(
                    'areaUbicacion' => $value2->areaUbicacion,
                    'enElPlano' => $value2->enElPlano,
                    'tipoSensor' => $value2->tipoSensor,
                    'libreObstruccion' => $value2->libreObstruccion,
                    'indicadorLuminoso' => $value2->indicadorLuminoso,
                    'cargaBien' => $value2->carga,
                    'activacionTablero' => $value2->activacionTablero,
                    'enBuenEstado' => $value2->enBuenEstado,
                    'limpio' => $value2->limpio,
                    'insectos' => $value2->insectos,
                    'equipoFijo' => $value2->equipoFijo,
                    'mesMantenimiento' => $value2->mesMantenimiento,
                    'observaciones' => $value2->observaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->bitacoras->actualizarDatosBitacora($dataPuente, $idBitacora, 'BitacoraDetectoresHumo');
            } //DELETE
            else if ($accion == 3) {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraDetectoresHumo');

            }
        }

    }

    function insertarArreglo($idAsignacion, $tabla)
    {
        $datosBitacora = json_decode($this->input->post('datos'), true);


        $insercion = array();
        foreach ($datosBitacora as $item => $value) {

            $insercion[$item] = $value;
        }
        $insercion[0]['idAsignacion'] = $idAsignacion;


        $idPrimaria = $this->bitacoras->insertarDatosBitacora($insercion[0], $tabla);
        foreach ($idPrimaria as $key3 => $val)
            echo($val['LAST_INSERT_ID()']);


    }

    function insertarArregloPuente($idPuente, $tabla, $campoPuente)
    {
        $datosBitacora = json_decode($this->input->post('datos'), true);

        $insercion = array();
        foreach ($datosBitacora as $item => $value) {

            $insercion[$item] = $value;
        }
        $insercion[0][$campoPuente] = $idPuente;


        $idPrimaria = $this->bitacoras->insertarDatosBitacora($insercion[0], $tabla);
        foreach ($idPrimaria as $key3 => $val)
            echo($val['LAST_INSERT_ID()']);


    }

    function insertarArregloSe($idBir, $tabla)
    {
        $datosBitacora = json_decode($this->input->post('datos'), true);
        $insercion = array();
        foreach ($datosBitacora as $item => $value) {
            $insercion[$item] = $value;
        }
        $insercion[0]['idBitacoraSenaletica'] = $idBir;
        $idPrimaria = $this->bitacoras->insertarDatosBitacora($insercion[0], $tabla);
        foreach ($idPrimaria as $key3 => $val)
            echo($val['LAST_INSERT_ID()']);
    }

    public function bitacora002($idAsignacion)
    {
        $data['idAsignacion'] = $idAsignacion;
        $data['tablaBitacora'] = $this->bitacoras->cargarTabla('BitacoraHidrantes', $idAsignacion);
        $data['resultadosBitacora'] = $this->bitacoras->cargarTabla('Resultado_Hidrante', $idAsignacion);
        $data['areasUbicacion'] = $this->bitacoras->getAreasUbicacion();
        $this->load->view('gridBitacoraHidrantes', $data);
    }

    public function actualizarBitacora002($idAsignacion)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        print_r($datosBitacora);
        foreach ($datosBitacora as $key => $value2) {
            $accion = $value2->action;
            //INSERT
            if ($accion == 1) {
                $dataPuente = array(
                    'ubicacion' => $value2->ubicacion,
                    'numeracion' => $value2->numeracion,
                    'obstruido' => $value2->obstruido,
                    'senalamiento' => $value2->senalamiento,
                    'estadoGabinete' => $value2->estadoGabinete,
                    'manometro' => $value2->manometro,
                    'manguera' => $value2->manguera,
                    'valvula' => $value2->valvula,
                    'copleValvula' => $value2->copleValvula,
                    'cristales' => $value2->cristales,
                    'sistemaCierre' => $value2->sistemaCierre,
                    'identificacion' => $value2->identificacion,
                    'doblesManguera' => $value2->doblesManguera,
                    'llaveAcople' => $value2->llaveAcople,
                    'observaciones' => $value2->observaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->bitacoras->insertarDatosBitacora($dataPuente, 'BitacoraHidrantes');
            } //UPDATE
            else if ($accion == 2) {
                $idBitacora = $value2->idBitacora;
                $dataPuente = array(
                    'ubicacion' => $value2->ubicacion,
                    'numeracion' => $value2->numeracion,
                    'obstruido' => $value2->obstruido,
                    'senalamiento' => $value2->senalamiento,
                    'estadoGabinete' => $value2->estadoGabinete,
                    'manometro' => $value2->manometro,
                    'manguera' => $value2->manguera,
                    'valvula' => $value2->valvula,
                    'copleValvula' => $value2->copleValvula,
                    'cristales' => $value2->cristales,
                    'sistemaCierre' => $value2->sistemaCierre,
                    'identificacion' => $value2->identificacion,
                    'doblesManguera' => $value2->doblesManguera,
                    'llaveAcople' => $value2->llaveAcople,
                    'observaciones' => $value2->observaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->bitacoras->actualizarDatosBitacora($dataPuente, $idBitacora, 'BitacoraHidrantes');
            } //DELETE
            else if ($accion == 3) {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraHidrantes');

            }
        }
        //RESULTADOS
        $arregloExterior = array(
            'idResultado' => 23,
            'cantidad' => $this->input->post('cantidadExterior'),
            'idAsignacion' => $idAsignacion
        );
        $arregloInterior = array(
            'idResultado' => 24,
            'cantidad' => $this->input->post('cantidadInterior'),
            'idAsignacion' => $idAsignacion
        );
        $arregloBuenEstado = array(
            'idResultado' => 15,
            'cantidad' => $this->input->post('cantidadBuenEstado'),
            'idAsignacion' => $idAsignacion
        );
        $arregloMalEstado = array(
            'idResultado' => 16,
            'cantidad' => $this->input->post('cantidadMalEstado'),
            'idAsignacion' => $idAsignacion
        );
        $arregloBloqueados = array(
            'idResultado' => 1,
            'cantidad' => $this->input->post('cantidadBloqueados'),
            'numero' => $this->input->post('numeroBloqueados'),
            'observaciones' => $this->input->post('observacionesBloqueados'),
            'idAsignacion' => $idAsignacion
        );
        $arregloSenalamiento = array(
            'idResultado' => 3,
            'cantidad' => $this->input->post('cantidadSenalamiento'),
            'numero' => $this->input->post('numeroSenalamiento'),
            'observaciones' => $this->input->post('observacionesSenalamiento'),
            'idAsignacion' => $idAsignacion
        );
        $arregloManguera = array(
            'idResultado' => 9,
            'cantidad' => $this->input->post('cantidadMangueras'),
            'numero' => $this->input->post('numeroMangueras'),
            'observaciones' => $this->input->post('observacionesMangueras'),
            'idAsignacion' => $idAsignacion
        );
        $arregloPiton = array(
            'idResultado' => 10,
            'cantidad' => $this->input->post('cantidadPiton'),
            'numero' => $this->input->post('numeroPiton'),
            'observaciones' => $this->input->post('observacionesPiton'),
            'idAsignacion' => $idAsignacion
        );
        $arregloLlave = array(
            'idResultado' => 11,
            'cantidad' => $this->input->post('cantidadLlaves'),
            'numero' => $this->input->post('numeroLlaves'),
            'observaciones' => $this->input->post('observacionesLlaves'),
            'idAsignacion' => $idAsignacion
        );
        $arregloGabinete = array(
            'idResultado' => 12,
            'cantidad' => $this->input->post('cantidadGabinete'),
            'numero' => $this->input->post('numeroGabinete'),
            'observaciones' => $this->input->post('observacionesGabinete'),
            'idAsignacion' => $idAsignacion
        );
        $arregloPresion = array(
            'idResultado' => 13,
            'cantidad' => $this->input->post('cantidadPresion'),
            'numero' => $this->input->post('numeroPresion'),
            'observaciones' => $this->input->post('observacionesPresion'),
            'idAsignacion' => $idAsignacion
        );
        $arregloObservacionGeneral = array(
            'idResultado' => 14,
            'observaciones' => $this->input->post('observacionesGenerales'),
            'idAsignacion' => $idAsignacion
        );
        $arregloFinal = array($arregloExterior, $arregloInterior, $arregloBuenEstado, $arregloMalEstado, $arregloBloqueados, $arregloSenalamiento, $arregloManguera, $arregloPiton, $arregloLlave, $arregloGabinete, $arregloPresion, $arregloObservacionGeneral);
        $this->bitacoras->eliminarResultado($idAsignacion, 'Resultado_Hidrante');
        $this->bitacoras->insertarResultado('Resultado_Hidrante', $arregloFinal);


    }

    public function actualizarBitacora003($idAsignacion)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        print_r($datosBitacora);
        foreach ($datosBitacora as $key => $value2) {
            $accion = $value2->action;
            //INSERT
            if ($accion == 1) {
                $dataPuente = array(
                    'lugarCorrecto' => $value2->lugarCorrecto,
                    'libreObstruccion' => $value2->libreObstruccion,
                    'senialamientoCorrecto' => $value2->senialamientoCorrecto,
                    'fechaRecarga' => $value2->fechaRecarga,
                    'peso' => $value2->peso,
                    'unidadPortacion' => $value2->unidadPortacion,
                    'manometro' => $value2->manometro,
                    'seguro' => $value2->seguro,
                    'collarin' => $value2->collarin,
                    'holograma' => $value2->holograma,
                    'manguera' => $value2->manguera,
                    'boquilla' => $value2->boquilla,
                    'palanca' => $value2->palanca,
                    'limpieza' => $value2->limpieza,
                    'gabinete' => $value2->gabinete,
                    'soporte' => $value2->soporte,
                    'altura' => $value2->altura,
                    'cilindro' => $value2->cilindro,
                    'fechaFabricacion' => $value2->fechaFabricacion,
                    'pruebaHidrostatica' => $value2->pruebaHidrostatica,
                    'agente' => $value2->agente,
                    'tipoFuego' => $value2->tipoFuego,
                    'observaciones' => $value2->observaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->bitacoras->insertarDatosBitacora($dataPuente, 'BitacoraExtintores');
            } //UPDATE
            else if ($accion == 2) {
                $idBitacora = $value2->idBitacora;
                $dataPuente = array(
                    'lugarCorrecto' => $value2->lugarCorrecto,
                    'libreObstruccion' => $value2->libreObstruccion,
                    'senialamientoCorrecto' => $value2->senialamientoCorrecto,
                    'fechaRecarga' => $value2->fechaRecarga,
                    'peso' => $value2->peso,
                    'unidadPortacion' => $value2->unidadPortacion,
                    'manometro' => $value2->manometro,
                    'seguro' => $value2->seguro,
                    'collarin' => $value2->collarin,
                    'holograma' => $value2->holograma,
                    'manguera' => $value2->manguera,
                    'boquilla' => $value2->boquilla,
                    'palanca' => $value2->palanca,
                    'limpieza' => $value2->limpieza,
                    'gabinete' => $value2->gabinete,
                    'soporte' => $value2->soporte,
                    'altura' => $value2->altura,
                    'cilindro' => $value2->cilindro,
                    'fechaFabricacion' => $value2->fechaFabricacion,
                    'pruebaHidrostatica' => $value2->pruebaHidrostatica,
                    'agente' => $value2->agente,
                    'tipoFuego' => $value2->tipoFuego,
                    'observaciones' => $value2->observaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->bitacoras->actualizarDatosBitacora($dataPuente, $idBitacora, 'BitacoraExtintores');
            } //DELETE
            else if ($accion == 3) {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraExtintores');

            }
        }
        //CODIGO PARA LOS RESULTADOS DE LOS EXTINTORES
        $arregloColocados = array(
            'idResultado' => 18,
            'cantidad' => $this->input->post('cantidadColocados'),
            'idAsignacion' => $idAsignacion
        );
        $arregloReserva = array(
            'idResultado' => 19,
            'cantidad' => $this->input->post('cantidadReserva'),
            'idAsignacion' => $idAsignacion
        );
        $arregloMantenimiento = array(
            'idResultado' => 20,
            'cantidad' => $this->input->post('cantidadMantenimiento'),
            'idAsignacion' => $idAsignacion
        );
        $arregloBloqueados = array(
            'idResultado' => 1,
            'cantidad' => $this->input->post('cantidadBloqueados'),
            'numero' => $this->input->post('numeroBloqueados'),
            'observaciones' => $this->input->post('observacionesBloqueados'),
            'idAsignacion' => $idAsignacion
        );
        $arregloLimpieza = array(
            'idResultado' => 2,
            'cantidad' => $this->input->post('cantidadLimpieza'),
            'numero' => $this->input->post('numeroLimpieza'),
            'observaciones' => $this->input->post('observacionesLimpieza'),
            'idAsignacion' => $idAsignacion
        );
        $arregloRecarga = array(
            'idResultado' => 21,
            'cantidad' => $this->input->post('cantidadRecarga'),
            'numero' => $this->input->post('numeroRecarga'),
            'observaciones' => $this->input->post('observacionesRecarga'),
            'idAsignacion' => $idAsignacion
        );
        $arregloSobrecarga = array(
            'idResultado' => 22,
            'cantidad' => $this->input->post('cantidadSobrecarga'),
            'numero' => $this->input->post('numeroSobrecarga'),
            'observaciones' => $this->input->post('observacionesSobrecarga'),
            'idAsignacion' => $idAsignacion
        );
        $arregloDano = array(
            'idResultado' => 4,
            'cantidad' => $this->input->post('cantidadDano'),
            'numero' => $this->input->post('numeroDano'),
            'observaciones' => $this->input->post('observacionesDano'),
            'idAsignacion' => $idAsignacion
        );
        $arregloBoquilla = array(
            'idResultado' => 5,
            'cantidad' => $this->input->post('cantidadBoquilla'),
            'numero' => $this->input->post('numeroBoquilla'),
            'observaciones' => $this->input->post('observacionesBoquilla'),
            'idAsignacion' => $idAsignacion
        );
        $arregloEtiqueta = array(
            'idResultado' => 6,
            'cantidad' => $this->input->post('cantidadEtiqueta'),
            'numero' => $this->input->post('numeroEtiqueta'),
            'observaciones' => $this->input->post('observacionesEtiqueta'),
            'idAsignacion' => $idAsignacion
        );
        $arregloSenalamiento = array(
            'idResultado' => 3,
            'cantidad' => $this->input->post('cantidadSenalamiento'),
            'numero' => $this->input->post('numeroSenalamiento'),
            'observaciones' => $this->input->post('observacionesSenalamiento'),
            'idAsignacion' => $idAsignacion
        );
        $arregloAltura = array(
            'idResultado' => 7,
            'cantidad' => $this->input->post('cantidadAltura'),
            'numero' => $this->input->post('numeroAltura'),
            'observaciones' => $this->input->post('observacionesAltura'),
            'idAsignacion' => $idAsignacion
        );
        $arregloSuelo = array(
            'idResultado' => 8,
            'cantidad' => $this->input->post('cantidadSuelo'),
            'numero' => $this->input->post('numeroSuelo'),
            'observaciones' => $this->input->post('observacionesSuelo'),
            'idAsignacion' => $idAsignacion
        );
        $arregloObservacionGeneral = array(
            'idResultado' => 14,
            'observaciones' => $this->input->post('observacionesGenerales'),
            'idAsignacion' => $idAsignacion
        );
        $arregloFinal = array($arregloColocados, $arregloReserva, $arregloMantenimiento, $arregloBloqueados, $arregloLimpieza, $arregloRecarga, $arregloSobrecarga, $arregloDano, $arregloBoquilla, $arregloEtiqueta, $arregloSenalamiento, $arregloAltura, $arregloSuelo, $arregloObservacionGeneral);
        $this->bitacoras->eliminarResultado($idAsignacion, 'Resultado_Extintores');
        $this->bitacoras->insertarResultado('Resultado_Extintores', $arregloFinal);


    }

    public function bitacora003($idAsignacion)
    {
        $data['idAsignacion'] = $idAsignacion;
        $data['tablaBitacora'] = $this->bitacoras->cargarTabla('BitacoraExtintores', $idAsignacion);
        $data['resultadosBitacora'] = $this->bitacoras->cargarTabla('Resultado_Extintores', $idAsignacion);
        $data['areasUbicacion'] = $this->bitacoras->getAreasUbicacion();
        $this->load->view('gridBitacoraExtintores', $data);
    }

    public function bitacora004($idAsignacion)
    {
        $data['idAsignacion'] = $idAsignacion;
        $data['tablaBitacora'] = $this->bitacoras->cargarTabla('BitacoraProteccionPersonal', $idAsignacion);
        $data['resultadosBitacora'] = $this->bitacoras->cargarTabla('Resultado_ProteccionPersonal', $idAsignacion);
        $data['areasUbicacion'] = $this->bitacoras->getAreasUbicacion();
        $this->load->view('gridBitacoraProteccionPersonal', $data);
    }

    public function actualizarBitacora004($idAsignacion)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        foreach ($datosBitacora as $key => $value2) {
            $accion = $value2->action;
            //Delete
            if ($accion == 3) {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraProteccionPersonal');
            }
        }

        $arregloBloqueados = array(
            'idResultado' => 1,
            'cantidad' => $this->input->post('cantidadBloqueados'),
            'numero' => $this->input->post('numeroBloqueados'),
            'observaciones' => $this->input->post('observacionesBloqueados'),
            'idAsignacion' => $idAsignacion
        );
        $arregloLimpieza = array(
            'idResultado' => 2,
            'cantidad' => $this->input->post('cantidadLimpieza'),
            'numero' => $this->input->post('numeroLimpieza'),
            'observaciones' => $this->input->post('observacionesLimpieza'),
            'idAsignacion' => $idAsignacion
        );
        $arregloSenalamiento = array(
            'idResultado' => 3,
            'cantidad' => $this->input->post('cantidadSenalamiento'),
            'numero' => $this->input->post('numeroSenalamiento'),
            'observaciones' => $this->input->post('observacionesSenalamiento'),
            'idAsignacion' => $idAsignacion
        );
        $arregloDano = array(
            'idResultado' => 4,
            'cantidad' => $this->input->post('cantidadDano'),
            'numero' => $this->input->post('numeroDano'),
            'observaciones' => $this->input->post('observacionesDano'),
            'idAsignacion' => $idAsignacion
        );
        $arregloObservacionGeneral = array(
            'idResultado' => 14,
            'observaciones' => $this->input->post('observacionesGenerales'),
            'idAsignacion' => $idAsignacion
        );
        $arregloTotales = array(
            'idResultado' => 17,
            'cantidad' => $this->input->post('total'),
            'idAsignacion' => $idAsignacion
        );
        $arregloFinal = array($arregloTotales, $arregloBloqueados, $arregloLimpieza, $arregloDano, $arregloSenalamiento, $arregloObservacionGeneral);
        $this->bitacoras->eliminarResultado($idAsignacion, 'Resultado_ProteccionPersonal');
        $this->bitacoras->insertarResultado('Resultado_ProteccionPersonal', $arregloFinal);


    }


    public function bitacora006($idAsignacion)
    {
        $data['bitacoraPrimaria'] = $this->bitacoras->getInfoBitacora($idAsignacion, 'BitacoraSenaletica');
        $data['tablaBitacora'] = $this->bitacoras->cargarTablaPuente('BitacoraSenaleticaPuente', 'BitacoraSenaletica', 'idBitacoraSenaletica', $idAsignacion);
        $data['idAsignacion'] = $idAsignacion;
        $data['areasUbicacion'] = $this->bitacoras->getAreasUbicacion();
        $this->load->view('gridBitacoraSenaletica', $data);
    }

    public function actualizarBitacora006($idAsignacion, $idPrimaria)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        foreach ($datosBitacora as $key => $value2) {
            $accion = $value2->action;
            //delete
            if ($accion == 3) {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraSenaleticaPuente');
            }
        }
        $datosPrimarios = json_decode($this->input->post('datosPrimarios'));
        foreach ($datosPrimarios as $key => $value2) {
            $idBitacora = $value2->idBitacora;
            $dataPuente = array(
                'total' => $value2->total,
                'bloqueadaCantidad' => $value2->bloqueadaCantidad,
                'bloqueadaNumero' => $value2->bloqueadaNumero,
                'bloqueadaObservaciones' => $value2->bloqueadaObservaciones,
                'limpiezaCantidad' => $value2->limpiezaCantidad,
                'limpiezaNumero' => $value2->limpiezaNumero,
                'limpiezaObservaciones' => $value2->limpiezaObservaciones,
                'danoCantidad' => $value2->danoCantidad,
                'danoNumero' => $value2->danoNumero,
                'danoObservaciones' => $value2->danoObservaciones
            );
            $this->bitacoras->actualizarDatosBitacora($dataPuente, $idBitacora, 'BitacoraSenaletica');
        }

    }

    public function bitacora005($idAsignacion)
    {

        $data['bitacoraPrimaria'] = $this->bitacoras->getInfoBitacora($idAsignacion, 'BitacoraLampara');
        $data['tablaBitacora'] = $this->bitacoras->cargarTablaPuente('BitacoraLamparaPuente', 'BitacoraLampara', 'idBitacoraLampara', $idAsignacion);
        $data['areasUbicacion'] = $this->bitacoras->getAreasUbicacion();
        $data['idAsignacion'] = $idAsignacion;
        $this->load->view('gridBitacoraLamparas', $data);
    }

    public function actualizarBitacora005($idAsignacion, $idPrimaria)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        var_dump($datosBitacora);
        foreach ($datosBitacora as $key => $value2) {
            $accion = $value2->action;
            //INSERT
            if ($accion == 1) {
                $dataPuente = array(
                    'ubicacion' => $value2->ubicacion,
                    'enPlano' => $value2->enPlano,
                    'pilasEstado' => $value2->enBuenEstado,
                    'encendido' => $value2->encendido,
                    'barraLed' => $value2->barraled,
                    'dosFocos' => $value2->dosfocos,
                    'otro' => $value2->otro,
                    'conectada' => $value2->conectada,
                    'conexionesEstado' => $value2->conexionesestado,
                    'tubofluorecente' => $value2->tubofluorecente,
                    'prendeCompleta' => $value2->prendecomp,
                    'limpia' => $value2->limpia,
                    'observaciones' => $value2->observaciones,
                    'idBitacoraLampara' => $idPrimaria
                );
                $this->bitacoras->insertarDatosBitacora($dataPuente, 'BitacoraLamparaPuente');
            } //UPDATE
            else if ($accion == 2) {
                $idBitacora = $value2->idBitacora;
                $dataPuente = array(
                    'ubicacion' => $value2->ubicacion,
                    'enPlano' => $value2->enPlano,
                    'pilasEstado' => $value2->enBuenEstado,
                    'encendido' => $value2->encendido,
                    'barraLed' => $value2->barraled,
                    'dosFocos' => $value2->dosfocos,
                    'otro' => $value2->otro,
                    'conectada' => $value2->conectada,
                    'conexionesEstado' => $value2->conexionesestado,
                    'tubofluorecente' => $value2->tubofluorecente,
                    'prendeCompleta' => $value2->prendecomp,
                    'limpia' => $value2->limpia,
                    'observaciones' => $value2->observaciones,
                    'idBitacoraLampara' => $idPrimaria
                );
                $this->bitacoras->actualizarDatosBitacora($dataPuente, $idBitacora, 'BitacoraLamparaPuente');
            } //DELETE
            else if ($accion == 3) {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraLamparaPuente');
            }
        }
        $datosPrimarios = json_decode($this->input->post('datosPrimarios'));
        foreach ($datosPrimarios as $key => $value2) {
            $idBitacora = $value2->idBitacora;
            $dataPuente = array(
                'ubicacionilumina' => $value2->ubicacionilumina,
                'obserUbicacion' => $value2->obserubicacionilumina,
                'evacilumina' => $value2->evacuacionilumina,
                'obserEvacua' => $value2->observacionevacuailumina,
                'salidailumina' => $value2->salidailumina,
                'obserSalida' => $value2->observacionsalidailumina,
                'comentariosObservaciones' => $value2->comentsobservaciones
            );
            $this->bitacoras->actualizarDatosBitacora($dataPuente, $idBitacora, 'BitacoraLampara');
        }

    }

    function getOportunidadMejora($llavePrimaria, $tabla)
    {
        echo json_encode($this->bitacoras->getOportunidadMejora($llavePrimaria, $tabla));
    }

    function subirFotoGeneralTabla($campo, $tabla, $llavePrimaria, $campoLlave)
    {
        if (empty($_FILES[$campo])) {
            echo json_encode(['error' => 'No hay imagen.']);
            return;
        }
        $images = $_FILES[$campo];
        $success = null;
        $paths = [];
        $filenames = $images['name'];
        if (!file_exists("assets/img/fotoBitacoras/$campo/") && !is_dir("assets/img/fotoBitacoras/$campo/")) {
            mkdir("assets/img/fotoBitacoras/$campo/");
        }
        for ($i = 0; $i < count($filenames); $i++) {
            $ext = explode('.', basename($filenames[$i]));
            $nombre = DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoBitacoras/$campo/" . $nombre;
            //  echo "entra $nombre";
            if (move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data = Array("$campo" => $nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->bitacoras->actualizarImagenGeneralTabla($campoLlave, $llavePrimaria, $data, $tabla);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error' => 'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error' => 'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function eliminarImagenArreglo($campo, $tabla, $llavePrimaria, $campoLlave)
    {
        //Comunicar con el modelo para sacar el nombre de la imagen
        //TODO: QUITAR EL NOMBRE DE LA IMAGEN DEL SERVIDOR
        $data = $this->bitacoras->getNombreImagenTabla($campo, $tabla, $llavePrimaria, $campoLlave);
        //Delete el nombre de la imagen de la base de datos
        $borrar = Array($campo => null);
        $this->bitacoras->deleteImagenTabla($borrar, $tabla, $llavePrimaria, $campoLlave);
        //Unlink el nombre de la imagen del servidor
        foreach ($data as $row) {
            $nombreImagen = $row[$campo];
            unlink("assets/img/fotoBitacoras/$campo/$nombreImagen");
            echo "OK";
        }

    }

    function subirOportunidadMejora($cadena, $llavePrimaria, $tabla, $campo)
    {
        $cadena = str_replace("%20", " ", $cadena);
        $cadena = str_replace("%30", "/", $cadena);
        $this->bitacoras->insertOportunidadMejora($cadena, $llavePrimaria, $tabla, $campo);
    }

    function obtenerPonde($idu, $condicion="")
    {
        $prueba = $this->bitacoras->getPonder($idu, $condicion);
        echo json_encode($prueba);
    }
    function obtenerArregloPonde($idu, $condicion="")
    {
        $prueba = $this->bitacoras->getArrayPonder($idu, $condicion);
        return $prueba;
    }

    function obtenerPondeIndica($idI)
    {
        $prueba = $this->bitacoras->getPPonder($idI);
        echo json_encode($prueba);
    }

    function traerIdind($idB)
    {
        $prueba = $this->bitacoras->getIndica($idB);
        echo json_encode($prueba);
    }

    function getCondicionesBitacora($idBitacora)
    {
        echo json_encode($this->bitacoras->getCondicionesBitacora($idBitacora));
    }

    function respaldarBitacora($idAsignacion, $idBitacora,$idCentro)
    {
        //obtiene los datos guardados de la bitacora
        $datosBitacora = $this->bitacoras->getDatosBitacora($idBitacora, $idCentro);
        //Obtiene los indicadores de informe
        $indicadorInforme = $this->bitacoras->getIndicadorInformeWord($idBitacora, $idCentro);
        //obtiene los calculos de informe
        $calculos= $this->bitacoras->getCalculoInformeWord($idBitacora, $idCentro);
        //obtiene los comentarios generales
        $comentariosGenerales= $this->bitacoras->getComentarioGeneralInformeWord($idBitacora, $idCentro);

        //Respalda la info guardada
        $respaldo=array('idBitacora' => $idBitacora, 'idAsignacion' =>$idAsignacion,'fecha' => date("Y-m-d"),
            'datosBitacora' =>json_encode($datosBitacora),
            'indicadorInforme'=> json_encode($indicadorInforme),
            'calculos' => json_encode($calculos),
            'comentariosGenerales' => json_encode($comentariosGenerales));
        $this->bitacoras->guardarRespaldo($respaldo);

    }
    function obtenerRespaldos($idAsignacion, $idBitacora)
    {
        echo json_encode($this->bitacoras->obtenerRespaldos($idAsignacion, $idBitacora));
    }
    function verPDF($idCe, $idBitacora)
    {
        //obtiene los indicadores de la bitacora
        $indicadores = $this->bitacoras->getIndica($idBitacora);
        //Obtiene los datos del centro de trabajo
        $datosCentroTrabajo=$this->bitacoras->getDatosCentroTrabajoWord($idCe);
        //obtiene los datos guardados de la bitacora
        $datosBitacora = $this->bitacoras->getDatosBitacora($idBitacora, $idCe);
        //obtiene el nombre de la bitacora
        $nombreBitac= $this->bitacoras->getnombreBitacor($idBitacora);
        //Obtiene los indicadores de informe
        $indicadorInforme = $this->bitacoras->getIndicadorInformeWord($idBitacora, $idCe);
        //obtiene los calculos de informe
        $calculos= $this->bitacoras->getCalculoInformeWord($idBitacora, $idCe);
        //obtiene los comentarios generales
        $comentariosGenerales= $this->bitacoras->getComentarioGeneralInformeWord($idBitacora, $idCe);

        //crea el nuevo documento
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES));


        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        $sectionStyle = $section->getStyle();
        $sectionStyle->setOrientation($sectionStyle::ORIENTATION_LANDSCAPE);

        $encabezado = $section->addTable(array('width' => 100*59, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);


        $row = $encabezado->addRow();
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText("ELABORÓ", [], $cellHCentered);

        $row->addCell(1000, array('gridSpan' => 2,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText("GIR (SSHI)",[], $cellHCentered);

        $row->addCell(1000, array('gridSpan' => 10,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText(($nombreBitac[0]['nombre']),array('bold' => true), $cellHCentered);
        if($datosCentroTrabajo["foto"]!="null")
            $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart'))->addImage('assets/img/fotoFormato/'.$datosCentroTrabajo["foto"], array('width' => 100, 'height' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        else
            $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart'));


        $row = $encabezado->addRow();
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText('FOLIO', [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 2,'vMerge' => 'restart'))->addText($datosCentroTrabajo["idDet"], [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText("FECHA DE INSPECCIÓN",[], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 6,'vMerge' => 'restart'))->addText(date("Y-m-d"), [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'continue'));

        $row = $encabezado->addRow();
        $row->addCell(1000, array('gridSpan' => 6, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText(' RAZÓN SOCIAL');
        $row->addCell(1000, array('gridSpan' => 10,'vMerge' => 'restart'))->addText($datosCentroTrabajo["razonSocial"], [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'continue'));

        $row = $encabezado->addRow(array('exactHeight' => 'exact'));
        $row->addCell(1000, array('gridSpan' => 6, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText(' CENTRO DE TRABAJO');
        $row->addCell(1000, array('gridSpan' => 10,'vMerge' => 'restart'))->addText($datosCentroTrabajo["nombre"], [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'continue'));

        $section->addTextBreak(1);

        //Inicio de la tabla bitacora
        $tablaBitacoraWord = $section->addTable(array('width' => 100*59, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
        $rowWord = $tablaBitacoraWord->addRow(3000,  array('exactHeight' => true));

        $arregloIndicadoresEncabezado=array();
        $contadorTh=0;
        //idContador sirve para obtener el indicador sobre el que se va a calcular el numero. Ejemplo: Numero de extintores= 3,4,5,7
        $idContador=0;
        $nospace = array('spaceafter' => 0);
        $rowWord->addCell(1000, array('vMerge' => 'restart', 'bgColor' => 'D9D9D9', 'valign'=>'center' ))->addText("No.", array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER), $cellHCentered);

        foreach ($indicadores as $row)
        {
            $id=$row['idIndicador'];
            $nombreIn=$row['nombreIndicador'];
            $tipo=$row['tipoIndicador'];
            $esContador=$row['esContador'];
            if($esContador)
                $idContador=$id;
            if($tipo!=4) {
                $arregloIndicadoresEncabezado[$contadorTh] = $id;
                $rowWord->addCell(1000, array('vMerge' => 'restart', 'bgColor' => 'D9D9D9','textDirection'=>\PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR, 'valign'=>'center' ))->addText("$nombreIn", array('bold'=>true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER), array('spaceafter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $contadorTh++;
            }
        }
        $contadorRegistros=1;
        $numeroRegistros=sizeof($datosBitacora);
        $arregloCondiciones=array();
        $i=0;
        //Recorre todos los datos de la bitacora
        while($i<$numeroRegistros)
        {
            $valorNumerico=0;
            $ultimoAlmacenamiento=$datosBitacora[$i]['idAlmacenamiento'];
            $fila=array();
            $j=0;
            //De la consulta, obtiene toda una fila de datos para mostrarlos en la tabla
            while($ultimoAlmacenamiento==$datosBitacora[$i]['idAlmacenamiento'])
            {
                if($datosBitacora[$i]['tipoIndicador']!=4)
                {
                    if($idContador==$datosBitacora[$i]['idIndicador'])
                    {
                        $valorNumerico=$datosBitacora[$i]['valor'];
                    }
                    $fila[$j++] = $datosBitacora[$i];
                    $ultimoAlmacenamiento = $datosBitacora[$i++]['idAlmacenamiento'];
                    if ($i >= $numeroRegistros)
                        break;
                }
            }
            //crea el tr y le pone un numero
            $nuevoRowWord=$tablaBitacoraWord->addRow();
            $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center' ))->addText("$contadorRegistros",[], $cellHCentered);
            //obtiene la diferencia entre los registros de la tabla y sus encabezados
            $diferencia = sizeof($arregloIndicadoresEncabezado) - sizeof($fila);
            //por cada uno de los datos de la fila
            for ($k = 0; $k < sizeof($fila); $k++)
            {
                //por cada uno de los encabezados
                for($l=$k; $l < sizeof($arregloIndicadoresEncabezado); $l++ )
                {
                    //si el encabezado coincide con el dato de la fila
                    if ($fila[$k]['idIndicador'] == $arregloIndicadoresEncabezado[$l])
                    {
                        $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center'))->addText($fila[$k]['valor'],[], $cellHCentered);
                        $k++;
                        if($k>=sizeof($fila))
                            break;
                    }
                    else
                    {
                        $diferencia--;
                        $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center'))->addText("");
                    }
                }

            }
            while($diferencia>0)
            {
                $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center'))->addText("");
                $diferencia--;
            }
            $contadorRegistros++;
        }
        //fin tabla bitacora
        $section->addTextBreak(1);

        //inicio calculo informe
        $tablaInformeWord= $section->addTable(array('width' => 100*59, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 6, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9', 'valign'=>'center' ))->addText("INFORME", array('bold' => true), $cellHCentered);
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center' ))->addText("Total de colocados");
        $rowWord->addCell(1000, array('gridSpan' => 4,'valign'=>'center' ))->addText($contadorRegistros-1, null,$cellHCentered);

        foreach ($indicadorInforme as $informe)
        {
                $rowWord=$tablaInformeWord->addRow();

                $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center' ))->addText($informe['texto']);
                $rowWord->addCell(1000, array('gridSpan' => 4,'valign'=>'center' ))->addText($informe['valor'],null ,$cellHCentered);
        }
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center' ))->addText("");
        $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center','bgColor' => 'D9D9D9', 'valign'=>'center'))->addText("Cantidad", [], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center','bgColor' => 'D9D9D9', 'valign'=>'center'))->addText("Número",[], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center','bgColor' => 'D9D9D9', 'valign'=>'center'))->addText("Observaciones",[], $cellHCentered);

        foreach($calculos as $calculo)
        {
            $rowWord=$tablaInformeWord->addRow();
            $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center'))->addText($calculo['descripcion']);
            $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center'))->addText($calculo['cantidad'], [], $cellHCentered);
            $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center'))->addText($calculo['numero'], [], $cellHCentered);
            $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center'))->addText($calculo['observaciones'], [], $cellHCentered);
        }
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 6,'valign'=>'center'))->addText("COMENTARIOS Y OBSERVACIONES:\n".$comentariosGenerales['comentarios'], array('bold' =>true));


        $rowWord = $tablaInformeWord->addRow(2000,  array('exactHeight' => true));

        $lugarFecha=$rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'bottom', 'vMerge' => 'continue' ));
        $lugarFecha->addText($datosCentroTrabajo["calle"]." No. ".$datosCentroTrabajo["numeroExterior"].", ".$datosCentroTrabajo["nombreRegion"].", ".$datosCentroTrabajo["nombreMunicipio"].", ".$datosCentroTrabajo["nombreEstado"], array('bold' => true), $cellHCentered);
        $lugarFecha->addText(date("Y-m-d"), array('bold' => true), $cellHCentered);
        $lugarFecha->addText("LUGAR Y FECHA", array('bold' =>true), $cellHCentered);

        $nombreRealizaInspeccion=$rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'bottom', 'vMerge' => 'continue'));

        $nombreRealizaInspeccion->addText($datosCentroTrabajo["nombreUsuario"], array('bold' =>true), $cellHCentered);
        $nombreRealizaInspeccion->addText("NOMBRE Y FIRMA DE QUIEN REALIZA LA INSPECCIÓN", array('bold' =>true), $cellHCentered);

        $nombreResponsable=$rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'bottom', 'vMerge' => 'continue' ));
        $nombreResponsable->addText("", array('bold' =>true), $cellHCentered);
        $nombreResponsable->addText("NOMBRE Y FIRMA DE RESPONSABLE DEL INMUEBLE\n", array('bold' =>true), $cellHCentered);
        //fin calculo informe

        //INICIO DE TABLA CONTROL DE CAMBIOS
/*        $section->addTextBreak(1);

        $tablaControlCambios= $section->addTable(array('width' => 100*50, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 10, 'borderColor' =>'000000'));
        $rowWord=$tablaControlCambios->addRow(2000, array('exactHeight' => true));

        $rowWord->addCell(1000, array('gridSpan' => 5, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9', 'valign'=>'center' ))->addText("CONTROL DE CAMBIOS FORMATO DE ".($nombreBitac[0]['nombre']), array('bold' => true), $cellHCentered);

        $rowWord=$tablaControlCambios->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("ELABORÓ", array('bold' => true), $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("REVISÓ", array('bold' => true), $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("REVISÓ", array('bold' => true), $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("AUTORIZÓ", array('bold' => true), $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("FECHA ÚLTIMA VERSIÓN", array('bold' => true), $cellHCentered);

        $rowWord=$tablaControlCambios->addRow(4000, array('exactHeight' => true));
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'))->addText(array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'))->addText(array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'))->addText(array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'))->addText(array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'));

        $rowWord=$tablaControlCambios->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'bottom', 'vMerge' => 'restart'))->addText("NOMBRE Y FIRMA", [], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'bottom', 'vMerge' => 'restart'))->addText("NOMBRE Y FIRMA", [], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'bottom', 'vMerge' => 'restart'))->addText("NOMBRE Y FIRMA", [], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'bottom', 'vMerge' => 'restart'))->addText("NOMBRE Y FIRMA", [], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'continue'));
*/

        //FIN TABLA DE CONTROL DE CAMBIOS

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Bitacora.docx');
        $this->load->helper('download');
        force_download('Bitacora.docx', NULL);

    }

    function verPDFAnterior($idcen, $idBitacora, $idRespaldo)
    {
        $nombreBitac= $this->bitacoras->getnombreBitacor($idBitacora);
        $arrayRespaldo=$this->bitacoras->obtenerRespaldoBitacora($idRespaldo);
        $indicadores = $this->bitacoras->getIndica($idBitacora);
        $datosCentroTrabajo=$this->bitacoras->getDatosCentroTrabajoWord($idcen);
        $datosBitacora=json_decode($arrayRespaldo["datosBitacora"], true);
        $indicadorInforme=json_decode($arrayRespaldo["indicadorInforme"], true);
        $calculos=json_decode($arrayRespaldo["calculos"], true);
        $comentariosGenerales=json_decode($arrayRespaldo["comentariosGenerales"], true);

        //crea el nuevo documento
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->getSettings()->setThemeFontLang(new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::ES_ES));


        $section = $phpWord->addSection(array('orientation' => 'landscape'));
        $sectionStyle = $section->getStyle();
        $sectionStyle->setOrientation($sectionStyle::ORIENTATION_LANDSCAPE);

        $encabezado = $section->addTable(array('width' => 100*59, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $cellHCentered = array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER);


        $row = $encabezado->addRow();
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText("ELABORÓ", [], $cellHCentered);

        $row->addCell(1000, array('gridSpan' => 2,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText("GIR (SSHI)",[], $cellHCentered);

        $row->addCell(1000, array('gridSpan' => 10,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText(($nombreBitac[0]['nombre']),array('bold' => true), $cellHCentered);
        if($datosCentroTrabajo["foto"]!="null")
            $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart'))->addImage('assets/img/fotoFormato/'.$datosCentroTrabajo["foto"], array('width' => 100, 'height' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        else
            $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart'));


        $row = $encabezado->addRow();
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText('FOLIO', [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 2,'vMerge' => 'restart'))->addText($datosCentroTrabajo["idDet"], [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText("FECHA DE INSPECCIÓN",[], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 6,'vMerge' => 'restart'))->addText(date("Y-m-d"), [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'continue'));

        $row = $encabezado->addRow();
        $row->addCell(1000, array('gridSpan' => 6, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText(' RAZÓN SOCIAL');
        $row->addCell(1000, array('gridSpan' => 10,'vMerge' => 'restart'))->addText($datosCentroTrabajo["razonSocial"], [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'continue'));

        $row = $encabezado->addRow(array('exactHeight' => 'exact'));
        $row->addCell(1000, array('gridSpan' => 6, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9'))->addText(' CENTRO DE TRABAJO');
        $row->addCell(1000, array('gridSpan' => 10,'vMerge' => 'restart'))->addText($datosCentroTrabajo["nombre"], [], $cellHCentered);
        $row->addCell(1000, array('gridSpan' => 4,'vMerge' => 'continue'));

        $section->addTextBreak(1);

        //Inicio de la tabla bitacora
        $tablaBitacoraWord = $section->addTable(array('width' => 100*59, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER));
        $rowWord = $tablaBitacoraWord->addRow(3000,  array('exactHeight' => true));

        $arregloIndicadoresEncabezado=array();
        $contadorTh=0;
        //idContador sirve para obtener el indicador sobre el que se va a calcular el numero. Ejemplo: Numero de extintores= 3,4,5,7
        $idContador=0;
        $nospace = array('spaceafter' => 0);
        $rowWord->addCell(1000, array('vMerge' => 'restart', 'bgColor' => 'D9D9D9', 'valign'=>'center' ))->addText("No.", array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER), $cellHCentered);

        foreach ($indicadores as $row)
        {
            $id=$row['idIndicador'];
            $nombreIn=$row['nombreIndicador'];
            $tipo=$row['tipoIndicador'];
            $esContador=$row['esContador'];
            if($esContador)
                $idContador=$id;
            if($tipo!=4) {
                $arregloIndicadoresEncabezado[$contadorTh] = $id;
                $rowWord->addCell(1000, array('vMerge' => 'restart', 'bgColor' => 'D9D9D9','textDirection'=>\PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR, 'valign'=>'center' ))->addText("$nombreIn", array('bold'=>true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER), array('spaceafter' => 0, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $contadorTh++;
            }
        }
        $contadorRegistros=1;
        $numeroRegistros=sizeof($datosBitacora);
        $arregloCondiciones=array();
        $i=0;
        //Recorre todos los datos de la bitacora
        while($i<$numeroRegistros)
        {
            $valorNumerico=0;
            $ultimoAlmacenamiento=$datosBitacora[$i]['idAlmacenamiento'];
            $fila=array();
            $j=0;
            //De la consulta, obtiene toda una fila de datos para mostrarlos en la tabla
            while($ultimoAlmacenamiento==$datosBitacora[$i]['idAlmacenamiento'])
            {
                if($datosBitacora[$i]['tipoIndicador']!=4)
                {
                    if($idContador==$datosBitacora[$i]['idIndicador'])
                    {
                        $valorNumerico=$datosBitacora[$i]['valor'];
                    }
                    $fila[$j++] = $datosBitacora[$i];
                    $ultimoAlmacenamiento = $datosBitacora[$i++]['idAlmacenamiento'];
                    if ($i >= $numeroRegistros)
                        break;
                }
            }
            //crea el tr y le pone un numero
            $nuevoRowWord=$tablaBitacoraWord->addRow();
            $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center' ))->addText("$contadorRegistros",[], $cellHCentered);
            //obtiene la diferencia entre los registros de la tabla y sus encabezados
            $diferencia = sizeof($arregloIndicadoresEncabezado) - sizeof($fila);
            //por cada uno de los datos de la fila
            for ($k = 0; $k < sizeof($fila); $k++)
            {
                //por cada uno de los encabezados
                for($l=$k; $l < sizeof($arregloIndicadoresEncabezado); $l++ )
                {
                    //si el encabezado coincide con el dato de la fila
                    if ($fila[$k]['idIndicador'] == $arregloIndicadoresEncabezado[$l])
                    {
                        $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center'))->addText($fila[$k]['valor'],[], $cellHCentered);
                        $k++;
                        if($k>=sizeof($fila))
                            break;
                    }
                    else
                    {
                        $diferencia--;
                        $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center'))->addText("");
                    }
                }

            }
            while($diferencia>0)
            {
                $nuevoRowWord->addCell(1000, array('vMerge' => 'restart','valign'=>'center'))->addText("");
                $diferencia--;
            }
            $contadorRegistros++;
        }
        //fin tabla bitacora
        $section->addTextBreak(1);

        //inicio calculo informe
        $tablaInformeWord= $section->addTable(array('width' => 100*59, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 6, 'borderColor' =>'000000'));
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 6, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9', 'valign'=>'center' ))->addText("INFORME", array('bold' => true), $cellHCentered);
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center' ))->addText("Total de colocados");
        $rowWord->addCell(1000, array('gridSpan' => 4,'valign'=>'center' ))->addText($contadorRegistros-1, null,$cellHCentered);

        foreach ($indicadorInforme as $informe)
        {
            $rowWord=$tablaInformeWord->addRow();

            $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center' ))->addText($informe['texto']);
            $rowWord->addCell(1000, array('gridSpan' => 4,'valign'=>'center' ))->addText($informe['valor'],null ,$cellHCentered);
        }
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center' ))->addText("");
        $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center','bgColor' => 'D9D9D9', 'valign'=>'center'))->addText("Cantidad", [], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center','bgColor' => 'D9D9D9', 'valign'=>'center'))->addText("Número",[], $cellHCentered);
        $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center','bgColor' => 'D9D9D9', 'valign'=>'center'))->addText("Observaciones",[], $cellHCentered);

        foreach($calculos as $calculo)
        {
            $rowWord=$tablaInformeWord->addRow();
            $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center'))->addText($calculo['descripcion']);
            $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center'))->addText($calculo['cantidad'], [], $cellHCentered);
            $rowWord->addCell(1000, array('gridSpan' => 1,'valign'=>'center'))->addText($calculo['numero'], [], $cellHCentered);
            $rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'center'))->addText($calculo['observaciones'], [], $cellHCentered);
        }
        $rowWord=$tablaInformeWord->addRow();
        $rowWord->addCell(1000, array('gridSpan' => 6,'valign'=>'center'))->addText("COMENTARIOS Y OBSERVACIONES:\n".$comentariosGenerales['comentarios'], array('bold' =>true));


        $rowWord = $tablaInformeWord->addRow(2000,  array('exactHeight' => true));

        $lugarFecha=$rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'bottom', 'vMerge' => 'continue' ));
        $lugarFecha->addText($datosCentroTrabajo["calle"]." No. ".$datosCentroTrabajo["numeroExterior"].", ".$datosCentroTrabajo["nombreRegion"].", ".$datosCentroTrabajo["nombreMunicipio"].", ".$datosCentroTrabajo["nombreEstado"], array('bold' => true), $cellHCentered);
        $lugarFecha->addText(date("Y-m-d"), array('bold' => true), $cellHCentered);
        $lugarFecha->addText("LUGAR Y FECHA", array('bold' =>true), $cellHCentered);

        $nombreRealizaInspeccion=$rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'bottom', 'vMerge' => 'continue'));

        $nombreRealizaInspeccion->addText($datosCentroTrabajo["nombreUsuario"], array('bold' =>true), $cellHCentered);
        $nombreRealizaInspeccion->addText("NOMBRE Y FIRMA DE QUIEN REALIZA LA INSPECCIÓN", array('bold' =>true), $cellHCentered);

        $nombreResponsable=$rowWord->addCell(1000, array('gridSpan' => 2,'valign'=>'bottom', 'vMerge' => 'continue' ));
        $nombreResponsable->addText("", array('bold' =>true), $cellHCentered);
        $nombreResponsable->addText("NOMBRE Y FIRMA DE RESPONSABLE DEL INMUEBLE\n", array('bold' =>true), $cellHCentered);
        //fin calculo informe

        //INICIO DE TABLA CONTROL DE CAMBIOS
        /*        $section->addTextBreak(1);

                $tablaControlCambios= $section->addTable(array('width' => 100*50, 'unit' => 'pct', 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'bordersize' => 10, 'borderColor' =>'000000'));
                $rowWord=$tablaControlCambios->addRow(2000, array('exactHeight' => true));

                $rowWord->addCell(1000, array('gridSpan' => 5, 'vMerge' => 'restart', 'bgColor' => 'D9D9D9', 'valign'=>'center' ))->addText("CONTROL DE CAMBIOS FORMATO DE ".($nombreBitac[0]['nombre']), array('bold' => true), $cellHCentered);

                $rowWord=$tablaControlCambios->addRow();
                $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("ELABORÓ", array('bold' => true), $cellHCentered);
                $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("REVISÓ", array('bold' => true), $cellHCentered);
                $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("REVISÓ", array('bold' => true), $cellHCentered);
                $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("AUTORIZÓ", array('bold' => true), $cellHCentered);
                $rowWord->addCell(1000, array('gridSpan' => 1, 'vMerge' => 'restart', 'bgColor' => 'f2f2f2', 'valign'=>'bottom', 'vMerge' => 'restart'))->addText("FECHA ÚLTIMA VERSIÓN", array('bold' => true), $cellHCentered);

                $rowWord=$tablaControlCambios->addRow(4000, array('exactHeight' => true));
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'))->addText(array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'))->addText(array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'))->addText(array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'))->addText(array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'restart'));

                $rowWord=$tablaControlCambios->addRow();
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'bottom', 'vMerge' => 'restart'))->addText("NOMBRE Y FIRMA", [], $cellHCentered);
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'bottom', 'vMerge' => 'restart'))->addText("NOMBRE Y FIRMA", [], $cellHCentered);
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'bottom', 'vMerge' => 'restart'))->addText("NOMBRE Y FIRMA", [], $cellHCentered);
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'bottom', 'vMerge' => 'restart'))->addText("NOMBRE Y FIRMA", [], $cellHCentered);
                $rowWord->addCell(1000, array('gridSpan' => 1,  'valign'=>'center', 'vMerge' => 'continue'));
        */

        //FIN TABLA DE CONTROL DE CAMBIOS

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Bitacora.docx');
        $this->load->helper('download');
        force_download('Bitacora.docx', NULL);

    }
    function editarFilaBitacora($numeroIndicadores)
    {
        $idAlmacenamiento= $this->input->post('identificador');
        unset($_POST['identificador']);
        unset($_POST['action']);
        foreach ($_POST as $item => $key)
        {
            $idIndicador=$item;

            $this->bitacoras->editarFilaBitacora($idIndicador, $idAlmacenamiento, $key);

        }


    }
}//Class


?>