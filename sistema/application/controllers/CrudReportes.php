<?php
class CrudReportes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("Reportes");
    }

    function index($index = 1)
    {
        $usuario = $this->session->userdata('idusuariobase');
        if ($usuario!="") {
            $data['page'] = $this->Reportes->data_pagination("/CrudReportes/index/", $this->Reportes->getTotalRowAllData($usuario), 3);
        $data['datos'] = $this->Reportes->getDatos($index, $usuario);
        $data['reportes'] = $this->Reportes->getTodosReportes();
        }
      
        $this->load->view("viewTodoReportes", $data);
    }

    function verReportes($idReporte, $idAsignacion)
    {
        $data['idReporte'] = $idReporte;
        $data['idAsignacion'] = $idAsignacion;
        $data['ReporteAsignacion'] = $this->Reportes->getReporteAsignacion($idReporte, $idAsignacion);
        $data['nombreReporte'] = $this->Reportes->getNombreReporte($idReporte)[0]['nombreReportes'];
        $data['apartados'] = $this->Reportes->getApartadosReporte($idReporte);
        $data['indicadores'] = $this->Reportes->getIndicadoresApartadosReporte($idReporte);
        $data['correccion']=$this->Reportes->getCorreccion($idReporte);
        $this->load->view("gridReporteAdministrable", $data);
    }

    function actualizarReporte($numeroIndicadores, $idReporteAsignacion)
    {
        $this->Reportes->borrarAlmacenamiento($idReporteAsignacion);
        for ($i = 0; $i < $numeroIndicadores; $i++) {
            $almacenamiento = array('idReporteAsignacion' => $idReporteAsignacion, 'idIndicadorReporte' => $this->input->post('idIndicador' . $i), 'valor' => $this->input->post('indicador' . $i), 'idApartadoReporte' => $this->input->post('apartado_indicador' . $i));
            $this->Reportes->insertarAlmacenamiento($almacenamiento);
        }
    }

    function cargarResultados($idReporteAsignacion)
    {
        echo json_encode($this->Reportes->cargarResultados($idReporteAsignacion));
    }
    function obtenerPonderadoresReporte($idReporte)
    {
        echo json_encode($this->Reportes->getPonderadoresIndicadoresApartadosReporte($idReporte));
    }
    function subirFotoGeneral($nombreCampo)
    {
        $conclusion=$this->input->post('conclusion');
        $idReporteAsignacion=$this->input->post('idReporteAsignacion');
        $idReporteCorreccion=$this->input->post('idReporteCorreccion');
        $success = null;
        $paths= [];
        if(!empty($_FILES[$nombreCampo]))
        {
            $images = $_FILES[$nombreCampo];
            $filenames = $images['name'];
        }
        else
            $filenames = false;



        if(!file_exists("assets/img/fotoReportes/evidenciaFotografica") && !is_dir("assets/img/fotoReportes/evidenciaFotografica")) {
            mkdir("assets/img/fotoReportes/evidenciaFotografica");
        }
        if($filenames)
        {
            for($i=0; $i < count($filenames); $i++)
            {
                $ext = explode('.', basename($filenames[$i]));
                $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
                $target = "assets/img/fotoReportes/evidenciaFotografica/" . $nombre;
                if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                    $output =array("idReporteCorreccion" =>$idReporteCorreccion,"idReporteAsignacion"=>$idReporteAsignacion,"evidenciaFotografica"=>$nombre, "correccion" => $conclusion);
                    //AQUI VA A GUARDAR EN LA BASE DE DATOS
                    if(($idReporteCorreccion)==0)
                        $this->Reportes->insertarCorreccion(array("idReporteAsignacion"=>$idReporteAsignacion,"evidenciaFotografica"=>$nombre, "correccion" => $conclusion));
                    else
                        $this->Reportes->actualizarCorreccion(array("idReporteAsignacion"=>$idReporteAsignacion,"evidenciaFotografica"=>$nombre, "correccion" => $conclusion), $idReporteCorreccion);
                    $success = true;
                    $paths[] = $target;
                } else {
                    $success = false;
                    break;
                }
            }
        }
        else
        {
            if(($idReporteCorreccion)==0)
                $this->Reportes->insertarCorreccion(array("idReporteAsignacion"=>$idReporteAsignacion,"evidenciaFotografica"=>"", "correccion" => $conclusion));
            else
                $this->Reportes->actualizarCorreccion(array("idReporteAsignacion"=>$idReporteAsignacion, "correccion" => $conclusion), $idReporteCorreccion);

            echo json_encode([]);
            return;
        }

        if ($success === true) {
            $output = array("Hola");
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
    function obtenerCorrecciones($idReporteAsignacion)
    {
        echo json_encode($this->Reportes->obtenerCorrecciones($idReporteAsignacion));
    }
}
?>