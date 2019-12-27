<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudAnalisisSsh extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("analisisSsh"); //cargamos el modelo

    }

    public function otrosDatos($idOti)
    {
        $data['idAsignacion']=$idOti;
        $data['existencia']=$this->analisisSsh->verificarExistenciadatosSSH($idOti);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisSsh->nuevaExistencidatosSSH($idOti);
            $data['existencia']=$this->analisisSsh->verificarExistenciadatosSSH($idOti);

        }
         
        $this->load->view('griddatosotissh', $data);
    }


    public function actualizarOtrosDatos()
    {

        $idOti=$this->input->post('idAsignacion');
        $personaFlot=$this->input->post('personaFlot');
        $poblacionFija=$this->input->post('poblacionFija');
        $aforo=$this->input->post('aforo');
        $matutino=$this->input->post('matutino');
        $vepertino=$this->input->post('vepertino');
        $nocturno = $this->input->post('nocturno');
        $mixto=$this->input->post('mixto');
        $operacionHorario=$this->input->post('operacionHorario');
        $lunes = $this->input->post('lunes');
        $martes=$this->input->post('martes');
        $miercoles = $this->input->post('miercoles');
        $jueves = $this->input->post('jueves');
        $viernes =$this->input->post('viernes');
        $extTerreno=$this->input->post('extTerreno');
        $superficieContruida=$this->input->post('superficieContruida');
        $nivelesOcupados=$this->input->post('nivelesOcupados');
        $nivelesConstruidos=$this->input->post('nivelesConstruidos');
        $comentariosNiveles=$this->input->post('comentariosNiveles');
        $inpeccOrdi=$this->input->post('inpeccOrdi');
        $inspeExtra = $this->input->post('inspeExtra');
        $emplazamie = $this->input->post('emplazamie');
        $inpeccionCompr = $this->input->post('inpeccionCompr');
        $inpensAdiest = $this->input->post('inpensAdiest');
        $inspecCondic = $this->input->post('inspecCondic');
        $Otro = $this->input->post('Otro');
        $comentariosSTP = $this->input->post('comentariosSTP');

       
        echo " entraCheck  $lunes ";
        $datosParaActualizar=Array(
            'personalFlotante'=>$personaFlot,
              'poblacionFija' =>$poblacionFija,
              'aforo' =>$aforo,
              'turnoMatutino' =>$matutino,
              'turnoVepertino' =>$vepertino,
              'turnoNocturno' =>$nocturno,
              'turnoMixto' =>$mixto,
              'turnoOtros' =>$mixto,
              'horariosOperacion' =>$operacionHorario,
              //'diasLborles' =>$fechaVisita,
              'lunes' =>$lunes,
              'martes' =>$martes,
              'miercoles' =>$miercoles,
              'jueves' =>$jueves,
              'viernes' =>$viernes,
              'extencionTerreno' =>$extTerreno,
              'superficieConstruida' =>$superficieContruida,
              'nivelesConstruidos' =>$nivelesConstruidos,
              'nivelesOcupados' =>$nivelesOcupados,
              'comentariosNiveles' =>$comentariosNiveles,
              'inspeccionOrdinaria' =>$inpeccOrdi,
              'inspeccionExtra' =>$inspeExtra,
              'emplazamiento' =>$emplazamie,
              'inspeccionComprobacion' =>$inpeccionCompr,
              'inspeccionAdiestramiento' =>$inpensAdiest,
              'inspeccionCondicones' =>$inspecCondic,
              'otrosInpecciones' =>$Otro,
              'corrosivos' =>$this->input->post('corrosivos'),
              'reactivos' =>$this->input->post('reactivos'),
              'explosivos' =>$this->input->post('explosivos'),
              'toxicos' =>$this->input->post('toxicos'),
              'inflamables' =>$this->input->post('inflamables'),
              'biologicos' =>$this->input->post('biologicos'),
              'comentariosSTPS' =>$comentariosSTP,
            'idOti'=>$idOti
        );
        //
        $this->analisisSsh->actualizarDatosOtros($idOti,$datosParaActualizar);
    }

}//Class


?>