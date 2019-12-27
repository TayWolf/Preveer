<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudOportunidamejorasshi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("bitacoras"); //cargamos el modelo
    }

    public function index($index = 1)
    {
        $usuario=$this->session->userdata('idusuariobase');
        $data['page'] = $this->bitacoras->data_pagination("/CrudOportunidamejorasshi/index/", $this->bitacoras->getTotalRowAllData(), 3);
        $data['listBitacoras'] = $this->bitacoras->getDatos($index, $usuario);
        $this->load->view('gridoportunidadmejorasshi',$data);
    }
       public function bitacora001($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['tablaBitacora']=$this->bitacoras->cargarTabla('BitacoraDetectoresHumo', $idAsignacion);
        $this->load->view('gridBitacoraDetectoresHumo', $data);
    }

    public function actualizarBitacora001($idAsignacion)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        foreach ($datosBitacora as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
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
            }
            //UPDATE
            else if($accion == 2)
            {
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
            }
            //DELETE
            else if($accion == 3)
            {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraDetectoresHumo');

            }
        }

    }

    public function bitacora002($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['tablaBitacora']=$this->bitacoras->cargarTabla('BitacoraHidrantes', $idAsignacion);
        $data['resultadosBitacora']=$this->bitacoras->cargarTabla('Resultado_Hidrante', $idAsignacion);

        $this->load->view('gridBitacoraHidrantes', $data);
    }

    public function actualizarBitacora002($idAsignacion)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        print_r ($datosBitacora);
        foreach ($datosBitacora as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
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
            }
            //UPDATE
            else if($accion == 2)
            {
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
            }
            //DELETE
            else if($accion == 3)
            {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraHidrantes');

            }
        }
        //RESULTADOS
        $arregloExterior=array(
            'idResultado' => 23,
            'cantidad' => $this->input->post('cantidadExterior'),
            'idAsignacion' => $idAsignacion
        );
        $arregloInterior=array(
            'idResultado' => 24,
            'cantidad' => $this->input->post('cantidadInterior'),
            'idAsignacion' => $idAsignacion
        );
        $arregloBuenEstado=array(
            'idResultado' => 15,
            'cantidad' => $this->input->post('cantidadBuenEstado'),
            'idAsignacion' => $idAsignacion
        );
        $arregloMalEstado=array(
            'idResultado' => 16,
            'cantidad' => $this->input->post('cantidadMalEstado'),
            'idAsignacion' => $idAsignacion
        );
        $arregloBloqueados=array(
            'idResultado' => 1,
            'cantidad' => $this->input->post('cantidadBloqueados'),
            'numero' => $this->input->post('numeroBloqueados'),
            'observaciones' => $this->input->post('observacionesBloqueados'),
            'idAsignacion' => $idAsignacion
        );
        $arregloSenalamiento=array(
            'idResultado' => 3,
            'cantidad' => $this->input->post('cantidadSenalamiento'),
            'numero' => $this->input->post('numeroSenalamiento'),
            'observaciones' => $this->input->post('observacionesSenalamiento'),
            'idAsignacion' => $idAsignacion
        );
        $arregloManguera=array(
            'idResultado' => 9,
            'cantidad' => $this->input->post('cantidadMangueras'),
            'numero' => $this->input->post('numeroMangueras'),
            'observaciones' => $this->input->post('observacionesMangueras'),
            'idAsignacion' => $idAsignacion
        );
        $arregloPiton=array(
            'idResultado' => 10,
            'cantidad' => $this->input->post('cantidadPiton'),
            'numero' => $this->input->post('numeroPiton'),
            'observaciones' => $this->input->post('observacionesPiton'),
            'idAsignacion' => $idAsignacion
        );
        $arregloLlave=array(
            'idResultado' => 11,
            'cantidad' => $this->input->post('cantidadLlaves'),
            'numero' => $this->input->post('numeroLlaves'),
            'observaciones' => $this->input->post('observacionesLlaves'),
            'idAsignacion' => $idAsignacion
        );
        $arregloGabinete=array(
            'idResultado' => 12,
            'cantidad' => $this->input->post('cantidadGabinete'),
            'numero' => $this->input->post('numeroGabinete'),
            'observaciones' => $this->input->post('observacionesGabinete'),
            'idAsignacion' => $idAsignacion
        );
        $arregloPresion=array(
            'idResultado' => 13,
            'cantidad' => $this->input->post('cantidadPresion'),
            'numero' => $this->input->post('numeroPresion'),
            'observaciones' => $this->input->post('observacionesPresion'),
            'idAsignacion' => $idAsignacion
        );
        $arregloObservacionGeneral=array(
            'idResultado' => 14,
            'observaciones' => $this->input->post('observacionesGenerales'),
            'idAsignacion' => $idAsignacion
        );
        $arregloFinal=array($arregloExterior, $arregloInterior, $arregloBuenEstado, $arregloMalEstado, $arregloBloqueados, $arregloSenalamiento, $arregloManguera, $arregloPiton, $arregloLlave, $arregloGabinete, $arregloPresion, $arregloObservacionGeneral);
        $this->bitacoras->eliminarResultado($idAsignacion, 'Resultado_Hidrante');
        $this->bitacoras->insertarResultado('Resultado_Hidrante', $arregloFinal);


    }

    public function actualizarBitacora003($idAsignacion)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        print_r ($datosBitacora);
        foreach ($datosBitacora as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
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
            }
            //UPDATE
            else if($accion == 2)
            {
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
            }
            //DELETE
            else if($accion == 3)
            {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraExtintores');

            }
        }
        //CODIGO PARA LOS RESULTADOS DE LOS EXTINTORES
        $arregloColocados=array(
            'idResultado' => 18,
            'cantidad' => $this->input->post('cantidadColocados'),
            'idAsignacion' => $idAsignacion
        );
        $arregloReserva=array(
            'idResultado' => 19,
            'cantidad' => $this->input->post('cantidadReserva'),
            'idAsignacion' => $idAsignacion
        );
        $arregloMantenimiento=array(
            'idResultado' => 20,
            'cantidad' => $this->input->post('cantidadMantenimiento'),
            'idAsignacion' => $idAsignacion
        );
        $arregloBloqueados=array(
            'idResultado' => 1,
            'cantidad' => $this->input->post('cantidadBloqueados'),
            'numero' => $this->input->post('numeroBloqueados'),
            'observaciones' => $this->input->post('observacionesBloqueados'),
            'idAsignacion' => $idAsignacion
        );
        $arregloLimpieza=array(
            'idResultado' => 2,
            'cantidad' => $this->input->post('cantidadLimpieza'),
            'numero' => $this->input->post('numeroLimpieza'),
            'observaciones' => $this->input->post('observacionesLimpieza'),
            'idAsignacion' => $idAsignacion
        );
        $arregloRecarga=array(
            'idResultado' => 21,
            'cantidad' => $this->input->post('cantidadRecarga'),
            'numero' => $this->input->post('numeroRecarga'),
            'observaciones' => $this->input->post('observacionesRecarga'),
            'idAsignacion' => $idAsignacion
        );
        $arregloSobrecarga=array(
            'idResultado' => 22,
            'cantidad' => $this->input->post('cantidadSobrecarga'),
            'numero' => $this->input->post('numeroSobrecarga'),
            'observaciones' => $this->input->post('observacionesSobrecarga'),
            'idAsignacion' => $idAsignacion
        );
        $arregloDano=array(
            'idResultado' => 4,
            'cantidad' => $this->input->post('cantidadDano'),
            'numero' => $this->input->post('numeroDano'),
            'observaciones' => $this->input->post('observacionesDano'),
            'idAsignacion' => $idAsignacion
        );
        $arregloBoquilla=array(
            'idResultado' => 5,
            'cantidad' => $this->input->post('cantidadBoquilla'),
            'numero' => $this->input->post('numeroBoquilla'),
            'observaciones' => $this->input->post('observacionesBoquilla'),
            'idAsignacion' => $idAsignacion
        );
        $arregloEtiqueta=array(
            'idResultado' => 6,
            'cantidad' => $this->input->post('cantidadEtiqueta'),
            'numero' => $this->input->post('numeroEtiqueta'),
            'observaciones' => $this->input->post('observacionesEtiqueta'),
            'idAsignacion' => $idAsignacion
        );
        $arregloSenalamiento=array(
            'idResultado' => 3,
            'cantidad' => $this->input->post('cantidadSenalamiento'),
            'numero' => $this->input->post('numeroSenalamiento'),
            'observaciones' => $this->input->post('observacionesSenalamiento'),
            'idAsignacion' => $idAsignacion
        );
        $arregloAltura=array(
            'idResultado' => 7,
            'cantidad' => $this->input->post('cantidadAltura'),
            'numero' => $this->input->post('numeroAltura'),
            'observaciones' => $this->input->post('observacionesAltura'),
            'idAsignacion' => $idAsignacion
        );
        $arregloSuelo=array(
            'idResultado' => 8,
            'cantidad' => $this->input->post('cantidadSuelo'),
            'numero' => $this->input->post('numeroSuelo'),
            'observaciones' => $this->input->post('observacionesSuelo'),
            'idAsignacion' => $idAsignacion
        );
        $arregloObservacionGeneral=array(
            'idResultado' => 14,
            'observaciones' => $this->input->post('observacionesGenerales'),
            'idAsignacion' => $idAsignacion
        );
        $arregloFinal=array($arregloColocados,$arregloReserva,$arregloMantenimiento,$arregloBloqueados, $arregloLimpieza, $arregloRecarga, $arregloSobrecarga,$arregloDano,$arregloBoquilla,$arregloEtiqueta, $arregloSenalamiento, $arregloAltura, $arregloSuelo, $arregloObservacionGeneral);
        $this->bitacoras->eliminarResultado($idAsignacion, 'Resultado_Extintores');
        $this->bitacoras->insertarResultado('Resultado_Extintores', $arregloFinal);



    }

    public function bitacora003($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['tablaBitacora']=$this->bitacoras->cargarTabla('BitacoraExtintores', $idAsignacion);
        $data['resultadosBitacora']=$this->bitacoras->cargarTabla('Resultado_Extintores', $idAsignacion);

        $this->load->view('gridBitacoraExtintores', $data);
    }

    public function bitacora004($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['tablaBitacora']=$this->bitacoras->cargarTabla('BitacoraProteccionPersonal', $idAsignacion);
        $data['resultadosBitacora']=$this->bitacoras->cargarTabla('Resultado_ProteccionPersonal', $idAsignacion); 
        $this->load->view('gridBitacoraProteccionPersonal', $data);
    }

    public function actualizarBitacora004($idAsignacion)
{

    $datosBitacora = json_decode($this->input->post('datosBitacora'));
    foreach ($datosBitacora as $key => $value2)
    {
        $accion=$value2->action;
        //INSERT
        if($accion == 1)
        {
            $dataPuente = array(
                'enElPlano' => $value2->enElPlano,
                'libreObstruccion' => $value2->libreObstruccion,
                'casco' => $value2->casco,
                'monja' => $value2->monja,
                'chaqueton' => $value2->chaqueton,
                'pantalonera' => $value2->pantalonera,
                'tirantes' => $value2->tirantes,
                'botas' => $value2->botas,
                'mascarilla' => $value2->mascarilla,
                'hachas' => $value2->hachas,
                'guantes' => $value2->guantes,
                'acceso' => $value2->acceso,
                'observaciones' => $value2->observaciones,
                'idAsignacion' => $idAsignacion
            );
            $this->bitacoras->insertarDatosBitacora($dataPuente, 'BitacoraProteccionPersonal');
        }
        //UPDATE
        else if($accion == 2)
        {
            $idBitacora = $value2->idBitacora;
            $dataPuente = array(
                'ubicacion' => $value2->ubicacion,
                'casco' => $value2->casco,
                'monja' => $value2->monja,
                'chaqueton' => $value2->chaqueton,
                'pantalonera' => $value2->pantalonera,
                'tirantes' => $value2->tirantes,
                'botas' => $value2->botas,
                'mascarilla' => $value2->mascarilla,
                'hachas' => $value2->hachas,
                'guantes' => $value2->guantes,
                'acceso' => $value2->acceso,
                'observaciones' => $value2->observaciones,
                'idAsignacion' => $idAsignacion
            );
            $this->bitacoras->actualizarDatosBitacora($dataPuente, $idBitacora, 'BitacoraProteccionPersonal');
        }
        //DELETE
        else if($accion == 3)
        {
            $idBitacora = $value2->idBitacora;
            $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraProteccionPersonal');
        }
    }

    $arregloBloqueados=array(
        'idResultado' => 1,
        'cantidad' => $this->input->post('cantidadBloqueados'),
        'numero' => $this->input->post('numeroBloqueados'),
        'observaciones' => $this->input->post('observacionesBloqueados'),
        'idAsignacion' => $idAsignacion
    );
    $arregloLimpieza=array(
        'idResultado' => 2,
        'cantidad' => $this->input->post('cantidadLimpieza'),
        'numero' => $this->input->post('numeroLimpieza'),
        'observaciones' => $this->input->post('observacionesLimpieza'),
        'idAsignacion' => $idAsignacion
    );
    $arregloSenalamiento=array(
        'idResultado' => 3,
        'cantidad' => $this->input->post('cantidadSenalamiento'),
        'numero' => $this->input->post('numeroSenalamiento'),
        'observaciones' => $this->input->post('observacionesSenalamiento'),
        'idAsignacion' => $idAsignacion
    );
    $arregloDano=array(
        'idResultado' => 4,
        'cantidad' => $this->input->post('cantidadDano'),
        'numero' => $this->input->post('numeroDano'),
        'observaciones' => $this->input->post('observacionesDano'),
        'idAsignacion' => $idAsignacion
    );
    $arregloObservacionGeneral=array(
        'idResultado' => 14,
        'observaciones' => $this->input->post('observacionesGenerales'),
        'idAsignacion' => $idAsignacion
    );
    $arregloTotales=array(
        'idResultado' => 17,
        'cantidad' => $this->input->post('total'),
        'idAsignacion' => $idAsignacion
    );
    $arregloFinal=array($arregloTotales,$arregloBloqueados,$arregloLimpieza,$arregloDano,$arregloSenalamiento, $arregloObservacionGeneral);
    $this->bitacoras->eliminarResultado($idAsignacion, 'Resultado_ProteccionPersonal');
    $this->bitacoras->insertarResultado('Resultado_ProteccionPersonal', $arregloFinal);


}




    public function bitacora006($idAsignacion)
    {
        $data['bitacoraPrimaria']=$this->bitacoras->getInfoBitacora($idAsignacion, 'BitacoraSenaletica');
        $data['tablaBitacora']=$this->bitacoras->cargarTablaPuente('BitacoraSenaleticaPuente', 'BitacoraSenaletica','idBitacoraSenaletica', $idAsignacion);
        $data['idAsignacion']=$idAsignacion;
        $this->load->view('gridBitacoraSenaletica', $data);
    }

    public function actualizarBitacora006($idAsignacion, $idPrimaria)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        foreach ($datosBitacora as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
                $dataPuente = array(
                    'ubicacion' => $value2->ubicacion,
                    'enPlano' => $value2->enPlano,
                    'enBuenEstado' => $value2->enBuenEstado,
                    'bienColocada' => $value2->bienColocada,
                    'limpia' => $value2->limpia,
                    'libreObstruccion' => $value2->libreObstruccion,
                    'legible' => $value2->legible,
                    'observaciones' => $value2->observaciones,
                    'idBitacoraSenaletica' => $idPrimaria
                );
                $this->bitacoras->insertarDatosBitacora($dataPuente, 'BitacoraSenaleticaPuente');
            }
            //UPDATE
            else if($accion == 2)
            {
                $idBitacora = $value2->idBitacora;
                $dataPuente = array(
                    'ubicacion' => $value2->ubicacion,
                    'enPlano' => $value2->enPlano,
                    'enBuenEstado' => $value2->enBuenEstado,
                    'bienColocada' => $value2->bienColocada,
                    'limpia' => $value2->limpia,
                    'libreObstruccion' => $value2->libreObstruccion,
                    'legible' => $value2->legible,
                    'observaciones' => $value2->observaciones,
                    'idBitacoraSenaletica' => $idPrimaria
                );
                $this->bitacoras->actualizarDatosBitacora($dataPuente, $idBitacora, 'BitacoraSenaleticaPuente');
            }
            //DELETE
            else if($accion == 3)
            {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraSenaleticaPuente');
            }
        }
        $datosPrimarios = json_decode($this->input->post('datosPrimarios'));
        foreach ($datosPrimarios as $key => $value2)
        {
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
        $data['bitacoraPrimaria']=$this->bitacoras->getInfoBitacora($idAsignacion, 'BitacoraLampara');
        $data['tablaBitacora']=$this->bitacoras->cargarTablaPuente('BitacoraLamparaPuente', 'BitacoraLampara','idBitacoraLampara', $idAsignacion);
        $data['idAsignacion']=$idAsignacion;
        $this->load->view('gridBitacoraLamparas', $data);
    }

    public function actualizarBitacora005($idAsignacion, $idPrimaria)
    {

        $datosBitacora = json_decode($this->input->post('datosBitacora'));
        var_dump($datosBitacora); 
        foreach ($datosBitacora as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
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
            }
            //UPDATE
            else if($accion == 2)
            {
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
            }
            //DELETE
            else if($accion == 3)
            {
                $idBitacora = $value2->idBitacora;
                $this->bitacoras->borrarDatosBitacora($idBitacora, 'BitacoraLamparaPuente');
            }
        }
        $datosPrimarios = json_decode($this->input->post('datosPrimarios'));
        foreach ($datosPrimarios as $key => $value2)
        {
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

}//Class


?>