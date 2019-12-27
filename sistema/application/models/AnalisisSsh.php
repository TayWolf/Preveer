<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AnalisisSsh extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }

      function verificarExistenciadatosSSH($idOti)
    {
        return $this->db->query("SELECT sshOti.* FROM sshOti JOIN Oti ON sshOti.idOti=Oti.idOti WHERE Oti.idOti=$idOti")->result_array();
    }

     function nuevaExistencidatosSSH($idOti)
    {

        $data=Array(
            'personalFlotante'=> null,
            'poblacionFija'=> null,
            'aforo'=> null,
            'turnoMatutino'=> null,
            'turnoVepertino'=>null,
            'turnoNocturno'=>null,
            'turnoMixto'=>null,
            'turnoOtros'=>null,
            'horariosOperacion'=>null,
            ///'diasLborles'=>null,
            'lunes'=>null,
            'martes'=>null,
            'miercoles'=>null,
            'jueves'=>null,
            'viernes'=>null,
            'extencionTerreno'=>null,
            'superficieConstruida'=>null,
            'nivelesConstruidos'=>null,
            'nivelesOcupados'=>null,
            'comentariosNiveles'=>null,
            'inspeccionOrdinaria'=>null,
            'inspeccionExtra'=>null,
            'emplazamiento'=>null,
            'inspeccionComprobacion'=>null,
            'inspeccionAdiestramiento'=>null,
            'inspeccionCondicones'=>null,
            'otrosInpecciones'=>null,
            'comentariosSTPS'=>null,
            'idOti' => $idOti
        );
        $this->db->insert('sshOti', $data);
    }    

   function actualizarDatosOtros($idOti, $data)
    {
        $this->db->where('idOti', $idOti);
        $this->db->update('sshOti', $data);
    }
}