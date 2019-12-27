<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudFormatos extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("formatos"); //cargamos el modelo de User

    }

    public function index($index = 1)
    {
        $data['page'] = $this->formatos->data_pagination("/CrudFormatos/index/",
            $this->formatos->getTotalRowAllData(), 3);
        $data['listFormato'] = $this->formatos->getDatos($index);
        $this->load->view('viewtodoformatos',$data);


    }

    public function formAltaFormato()

    {
        $data['cliente']= $this->formatos->clienteGet();
        $this->load->view('formformato',$data);
    }


    public function formEditarFormato($idFormato=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idFormato' => $idFormato, 'cliente' => $this->formatos->clienteGet()];
        $this->load->view('grideditarformato',$data);
    }

    public function formDetalleFormato($idFormato=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idFormato' => $idFormato];
        $this->load->view('griddetalleformato',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->formatos->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos()
    {

        $nombre_archivoima = $_FILES['foto']['name'];
        $tipo_archivoima = $_FILES['foto']['type'];
        $tamano_archivoima = $_FILES['foto']['size'];
        $temp_archivoima = $_FILES['foto']['tmp_name'];
        $images = $_FILES['foto'];
        $foto=$nombre_archivoima;
        $filenames = $images['name'];
        $ext = explode('.', basename($filenames));
        $nombre = DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
        $foto=$nombre;
        $fotoBase=$_POST['fotoBase'];
        $ruta="assets/img/fotoFormato/".$nombre;

        $idFormato = $this->input->post('idFormato');


        if($nombre_archivoima=="")
        {


            $data = array(
                'razonSocial' => $this->input->post('razonSocial'),
                'nombre' => $this->input->post('nombreFormato'),
                'nombreRepresentante' => $this->input->post('nombreRepresentante'),
                'rfc' => $this->input->post('rfc'),
                'comentarioRFC' => $this->input->post('comenRFC'),
                'domicilioFiscal' => $this->input->post('domFiscal'),
                'idCliente' => $this->input->post('idCliente')
            );
            $this->formatos->modificaDatos($data,$idFormato);
        }
        else
        {
            if($fotoBase=="")
            {
                if ((file_exists ($ruta) && $nombre_archivoima !="" ))
                {
                    echo "";
                }
                else
                {
                    move_uploaded_file($temp_archivoima, "assets/img/fotoFormato/".$nombre);
                    $data = array(
                        'razonSocial' => $this->input->post('razonSocial'),
                        'nombre' => $this->input->post('nombreFormato'),
                        'nombreRepresentante' => $this->input->post('nombreRepresentante'),
                        'rfc' => $this->input->post('rfc'),
                        'comentarioRFC' => $this->input->post('comenRFC'),
                        'domicilioFiscal' => $this->input->post('domFiscal'),
                        'foto' => $nombre,
                        'idCliente' => $this->input->post('idCliente')
                    );
                    $this->formatos->modificaDatos($data,$idFormato);
                    echo "";
                }
            }
            else
            {
                if ((file_exists ($ruta) && $nombre_archivoima !="" ))
                {
                    echo "Foto no Encontrada";
                }
                else
                {
                    unlink('assets/img/fotoFormato/'.$fotoBase); //borra el archivo anterior
                    move_uploaded_file($temp_archivoima, "assets/img/fotoFormato/".$nombre);
                    $data = array(
                        'razonSocial' => $this->input->post('razonSocial'),
                        'nombre' => $this->input->post('nombreFormato'),
                        'nombreRepresentante' => $this->input->post('nombreRepresentante'),
                        'rfc' => $this->input->post('rfc'),
                        'comentarioRFC' => $this->input->post('comenRFC'),
                        'domicilioFiscal' => $this->input->post('domFiscal'),
                        'foto' => $nombre,
                        'idCliente' => $this->input->post('idCliente')
                    );
                    $this->formatos->modificaDatos($data,$idFormato);
                    echo "";
                }
            }
        }
    }


    function modificarDatosPorAnalista()
    {


        $idFormato = $this->input->post('idFormato');
        $data = array(
            'razonSocial' => $this->input->post('razonSocial'),
            'nombre' => $this->input->post('nombreFormato'),
            'nombreRepresentante' => $this->input->post('nombreRepresentante'),
            'rfc' => $this->input->post('rfc'),
            'comentarioRFC' => $this->input->post('comenRFC'),
            'domicilioFiscal' => $this->input->post('domFiscal')
        );
        $this->formatos->modificaDatos($data,$idFormato);
    }



    function altaFormato()
    {
        $nombre_archivoima = $_FILES['foto']['name'];
        $tipo_archivoima = $_FILES['foto']['type'];
        $tamano_archivoima = $_FILES['foto']['size'];
        $temp_archivoima = $_FILES['foto']['tmp_name'];

        $idCliente = $this->input->post('idClienteF');
        $nombre = $this->input->post('nombreFormato');
        $nombreRepresentante = $this->input->post('nombreRepresentante');
        $razonSocial = $this->input->post('razonSocial');
        $rfc = $this->input->post('rfc');
        $comenRFC = $this->input->post('comenRFC');
        $domFiscal = $this->input->post('domFiscal');

        if($nombre_archivoima=="")
        {
            $data= array(
                'razonSocial' =>$razonSocial ,
                'nombre' => $nombre,
                'nombreRepresentante' => $nombreRepresentante,
                'rfc' =>$rfc ,
                'comentarioRFC' =>$comenRFC ,
                'domicilioFiscal' =>$domFiscal ,
                'foto' => "null",
                'idCliente' =>$idCliente
            );

            $this->formatos->insertaDatos($data);
            echo "1";
        }
        else
        {
            $ext = explode($nombre_archivoima, ".");
            $nombre = DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $foto=$nombre;
            $ruta="assets/img/fotoFormato/".$foto;

            if(file_exists($ruta))
            {
                $data= array(
                    'razonSocial' =>$razonSocial ,
                    'nombre' => $nombre,
                    'nombreRepresentante' => $nombreRepresentante,
                    'rfc' =>$rfc ,
                    'comentarioRFC' =>$comenRFC ,
                    'domicilioFiscal' =>$domFiscal ,
                    'foto' => "null",
                    'idCliente' =>$idCliente
                );

                $this->formatos->insertaDatos($data);
                echo "2";

            }
            else
            {

                move_uploaded_file($temp_archivoima, "assets/img/fotoFormato/".$foto);
                $data= array(
                    'razonSocial' =>$razonSocial ,
                    'nombre' => $nombre,
                    'nombreRepresentante' => $nombreRepresentante,
                    'rfc' =>$rfc ,
                    'comentarioRFC' =>$comenRFC ,
                    'domicilioFiscal' =>$domFiscal ,
                    'foto' => $foto,
                    'idCliente' =>$idCliente
                );

                $this->formatos->insertaDatos($data);
                echo "1";

            }

        }
    }

    function altaFormatoModal()
    {

        $idCliente = $this->input->post('idClienteModal');
        $nombre = $this->input->post('nombreFormatoModal');
        $nombreRepresentante = $this->input->post('nombreRepresentanteModal');
        $razonSocial = $this->input->post('razonSocialModal');
        $rfc = $this->input->post('rfcModal');
        $comenRFC = $this->input->post('comenRFCModal');
        $domFiscal = $this->input->post('domFiscalModal');

        $nombreImagen = $_FILES['fotoModal']['name'];
        $tmpImagen = $_FILES['fotoModal']['tmp_name'];

        $data= array(
            'razonSocial' =>$razonSocial ,
            'nombre' => $nombre,
            'nombreRepresentante' => $nombreRepresentante,
            'rfc' =>$rfc ,
            'comentarioRFC' =>$comenRFC ,
            'domicilioFiscal' =>$domFiscal ,
            'foto' => $nombreImagen,
            'idCliente' =>$idCliente
        );

        move_uploaded_file($tmpImagen, "assets/img/fotoFormato/".$nombreImagen);

        $this->formatos->insertaDatos($data);
        //print_r($data);
    }

    function deleteFormato($idFormato){

        $this->formatos->borrarDatos($idFormato);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudFormatos');

    }


}

?>