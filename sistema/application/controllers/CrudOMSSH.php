<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudOMSSH extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Omssh"); //cargamos el modelo
    }

    public function index($index = 1)
    {
        $tipoUsuario= $this->session->userdata('tipoUser');
        $idUsuario= $this->session->userdata('idusuariobase');
        $data['listCT'] = $this->Omssh->getDatos($idUsuario, $tipoUsuario);
        $this->load->view('viewTodoOMSSH',$data);
    }
    public function verOMSSH($idAsignacion)
    {   
        $idUs=$this->session->userdata('idusuariobase');
        $data['datosCentroTrabajo']=$this->Omssh->getDatosCentroTrabajo($idAsignacion);

        $data['areasUbicacion']=$this->Omssh->getAreasUbicacion();
        $data['getUser']=$this->Omssh->getUser($idUs);
        $data['idAsignacion']=$idAsignacion;
        $idCen=$this->Omssh->idCentro($idAsignacion);  
            foreach ($idCen as $key) {
                $idCentroTrabajo= $key['idCentroTrabajo'];
            }
        $data['tabla']= $this->Omssh->obtenerTabla($idCentroTrabajo);
        $data['coloresIntervencion']= json_encode($this->Omssh->obtenercoloresIntervencion());
        $data['getPrioritario']= $this->Omssh->obtenerProri();
        $this->load->view('viewOMSSH', $data);
    }
    function guardarHistorico($idAsignacion)
    {
        $idCen=$this->Omssh->idCentro($idAsignacion);  
            foreach ($idCen as $key) {
                $idCentroTrabajo= $key['idCentroTrabajo'];
            }

        $array=array('idAsignacion' => $idAsignacion, 'data' => json_encode($this->Omssh->obtenerTabla($idCentroTrabajo)), 'fecha' => date('Y-m-d'));
        echo json_encode($this->Omssh->guardarHistorico($array));

    }
    public function borrarFoto($nombrecampo, $llavePrimaria)
    {
        $nombreFoto=$this->Omssh->borrarFoto($nombrecampo,$llavePrimaria);
        unlink("assets/img/fotoOMSSH/$nombrecampo/".$nombreFoto);
    }

     public function borrarOM($idOm)
    {
        $idCen=$this->Omssh->getFotosOMSSHI($idOm);  
            foreach ($idCen as $key) {
                $fotoMal0= $key['fotoMal0'];
                $fotoCorreccion0= $key['fotoCorreccion0'];
                unlink("assets/img/fotoOMSSH/fotoMal0/".$fotoMal0);
                unlink("assets/img/fotoOMSSH/fotoCorreccion0/".$fotoCorreccion0);
            }
            //echo "$idOm";
         $this->Omssh->borrarOMSS($idOm);
       
    }
    public function agregarOportunidadMejora()
    {
        $areaUbicacion=$this->input->post('areaUbicacion');
        $factorRiesgo=$this->input->post('factorRiesgo');
        $oportunidadMejora=$this->input->post('oportunidadMejora');
        $prioridadIntervencion=$this->input->post('prioridadIntervencion');
        $recomendacion=$this->input->post('recomendacion');
        $responsable=$this->input->post('responsable');
        $fechaEjecucion=$this->input->post('fechaEjecucion');
        if($fechaEjecucion==null)
            $fechaEjecucion=date("Y-m-d");
        $start = new DateTime($fechaEjecucion, new DateTimeZone("UTC"));
        $month_later = clone $start;
        $month_later->add(new DateInterval("P1M"));
        $fechaVerificacion = $month_later->format('Y-m-d');
        $seguimiento=$this->input->post('seguimiento');
        $idAsignacion=$this->input->post('idAsignacion');
        $arreglo=array('idAsignacion' =>$idAsignacion,'idArea' => $areaUbicacion,'factorRiesgo'=> $factorRiesgo, 'oportunidadMejora' =>$oportunidadMejora,
            'idPrioridadIntervencion' => $prioridadIntervencion, 'recomendacion' => $recomendacion, 'responsable' => $responsable, 'fechaEjecucion' => $fechaEjecucion, 'fechaVerificacion' => $fechaVerificacion,
            'seguimiento' => $seguimiento);
        
        $idOMSSH = $this->Omssh->insertarOportunidadMejora($arreglo);
        print json_encode(array($idOMSSH, $fechaVerificacion)); 

    }
    public function traerFotoMala($idOMSSH)
    {
        echo json_encode($this->Omssh->getFotoMala($idOMSSH));
    }
    public function traerFotoBuena($idOMSSH)
    {
        echo json_encode($this->Omssh->getFotoBuena($idOMSSH));
    }
    function subirFoto($campo, $tabla, $idOmssh)
    {
        if (empty($_FILES[$campo]))
        {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES[$campo];
        $success = null;
        $paths= [];
        $filenames = $images['name'];

        if(!file_exists("assets/img/fotoOMSSH/$campo/") && !is_dir("assets/img/fotoOMSSH/$campo/"))
        {
            mkdir("assets/img/fotoOMSSH/$campo/");
        }
        for($i=0; $i < count($filenames); $i++)
        {
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoOMSSH/$campo/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array("$campo"=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->Omssh->actualizarImagen($idOmssh, $data, $tabla);
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
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }
    function actualizarOMSSH()
    {
        $arreglo=array(array('idArea'=>$this->input->post('areaTabla')),
            array('factorRiesgo'=>$this->input->post('factorRiesgoTabla')),
            array('oportunidadMejora'=>$this->input->post('oportunidadMejoraTabla')),
            array('idPrioridadIntervencion'=>$this->input->post('prioridadIntervencionTabla')),
            array('recomendacion'=>$this->input->post('recomendacionTabla')),
            array('responsable'=>$this->input->post('responsableTabla')),
            array('fechaEjecucion'=>$this->input->post('fechaEjecucionTabla')),
            array('fechaVerificacion'=>$this->input->post('fechaVerificacionTabla')),
            array('seguimiento'=>$this->input->post('seguimientoTabla')),
            
        );
        $idOMSSH= $this->input->post('identificador');
        foreach ($arreglo as $item)
        {
            while($nombre_item= current($item))
            {
                if(!empty($nombre_item))
                {

                    $this->Omssh->actualizarOMSSH($idOMSSH, $item);
                    echo json_encode(array($this->input->post('prioridadIntervencionTabla'), $idOMSSH));
                    break;
                }
                next($item);
            }

        }


    }
    //Código ejecutado desde las bitacoras
    function subirOportunidadMejora($idAlmacenamiento, $cadena, $idAsignacion)
    {
        //cadena es la oportunidad de mejora
        $cadena = str_replace("%20", " ", $cadena);
        $cadena = str_replace("%30", "/", $cadena);
        $array=array('idAlmacenamiento' => $idAlmacenamiento, 'idAsignacion' => $idAsignacion, 'oportunidadMejora' => $cadena);
        $id=$this->Omssh->insertOportunidadMejoraBitacora($array);
        echo json_encode($id);

    }

}


?>