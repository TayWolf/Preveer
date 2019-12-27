<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPlantillas extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Plantillas');
    }

    public function index($index=1)
    {

        $data['listaplantilla'] = $this->Plantillas->getDatos($index);
        $this->load->view('viewTodoPlantillas',$data);
    }

    function buscarIdt($idP)
    {
        $prueba= $this->Plantillas->obtenerRegistroIdTabla($idP);
        echo json_encode ($prueba);
        //echo json_encode("hola");
    }


    function deletePlantilla($idPlantilla)
    {

        $nombreArchivo=$this->Plantillas->borrarDatos($idPlantilla);
        unlink('assets/img/plantillasPc/'.$nombreArchivo);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudPlantillas');

    }

    public function formAltaplantilla()
    {
        $data['edo'] = $this->Plantillas->getEdo();
        $data['client'] = $this->Plantillas->getClient();
        $data['formuDb'] = $this->Plantillas->getAut();
        $data['gruposAcuseVisita'] = $this->Plantillas->getGrupos();

        $this->load->view('formplantilla',$data);
    }
    function getGruposAcuse()
    {
        echo json_encode( $this->Plantillas->getGrupos());
    }


    public function editarPlantillaRegistrada($plantilla)
    {
        $data = ['plantilla' => $plantilla];

        $data['edo'] = $this->Plantillas->getEdo();
        $data['client'] = $this->Plantillas->getClient();
        $data['formuDb'] = $this->Plantillas->getAut();
        $data['gruposAcuseVisita'] = $this->Plantillas->getGrupos();
        $this->load->view('grideditarplantilla',$data);
    }

    public function tablas($plantilla)
    {
        $data = ['plantilla' => $plantilla];
        $data['formuDb'] = $this->Plantillas->getAut();
        $this->load->view('gridtablasform',$data);
    }

    public function tablasEditar($plantilla)
    {
        $data = ['plantilla' => $plantilla];
        $data['formuDb'] = $this->Plantillas->getAut();
        $this->load->view('gridtablaseditar',$data);
    }

    function editarPantilla()
    {
        $nombrePlantilla = $this->input->post('nombrePlantilla');
        $idEdo = $this->input->post('idEdo');
        $idCliente = $this->input->post('idCliente');
        $idFormato = $this->input->post('idFormato');
        $idCentro = $this->input->post('idCentro');
        $totalCont = $this->input->post('totalCont');
        $cuentaFot = $this->input->post('cuentaFot');
        $nombreArchivo = $_FILES['plantillaFile']['name'];
        $idPlantilla = $this->input->post('idPlantilla');

        $cuentaTexto = $this->input->post('cuentaTexto');

        $totalContText= $this->input->post('totalContText');


        $cuentaAcuse=$this->input->post('cuentaAcuse');
        $totalContAcuse=$this->input->post('totalContAcuse');
        if (empty($cuentaAcuse)) {
            $cuentaAcuse=0;
        }

        if (empty($idFormato)) {
            $idFormato=null;
        }
        if (empty($idCentro)) {
            $idCentro=null;
        }

        if ($nombreArchivo!="") {
            if(!file_exists("assets/img/plantillasPc") && !is_dir("assets/img/plantillasPc"))
            {
                mkdir("assets/img/plantillasPc");
            }
            $success = null;
            if(!empty($_FILES['plantillaFile']))
            {
                $images = $_FILES['plantillaFile'];
                $filenames = $images['name'];
            }
            else
                $filenames = false;
            if($filenames)
            {
                for($i=0; $i < count($filenames); $i++)
                {
                    $ext = explode('.', basename($filenames));
                    $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
                    $target = "assets/img/plantillasPc" . $nombre;
                    if(move_uploaded_file($images['tmp_name'], $target))
                    {
                        $data = array(
                            'idEstado' => $idEdo,
                            'idCliente' => $idCliente,
                            'idFormato' => $idFormato,
                            'idCentroTrabajo' => $idCentro,
                            'nombrePlantilla' => $nombrePlantilla,
                            'nombreArchivo' => $nombre,
                            'tieneFoto' => $cuentaFot,
                            'tieneTexto' => $cuentaTexto,
                            'tieneAcuse' => $cuentaAcuse
                        );
                        $idInsertado= $this->Plantillas->updateDatos($data,$idPlantilla);
                        $this->Plantillas->borrarDatosPuente($idPlantilla);
                        if ($cuentaFot==1) {

                            for ($i=0; $i < $totalCont ; $i++) {
                                $etiqueta = $this->input->post('etiqueta'.$i);
                                if ($etiqueta != "") {
                                    $dataPuente = array(
                                        'idPlantilla' => $idPlantilla,
                                        'nombreEtiqueta' => $etiqueta
                                    );
                                    $this->Plantillas->insertaDatosPuente($dataPuente);
                                }
                            }
                        }
                        $this->Plantillas->borrarDatosPuenteTexto($idPlantilla);
                        $this->Plantillas->borrarDatosPuenteAcuse($idPlantilla);
                        //echo "entra $cuentaTexto totalContText $totalContText <br>";
                        //Aqui viene el el texto
                        if ($cuentaTexto==1) {
                            for ($ix=0; $ix <= $totalContText ; $ix++) {
                                //echo "datos $etiquetaTX";
                                $etiquetaTX = $this->input->post('etiquetaTX'.$ix);
                                $idFormm = $this->input->post('idFormm'.$ix);
                                $idAcord = $this->input->post('idAcord'.$ix);
                                $indicad = $this->input->post('indicad'.$ix);

                                if ($etiquetaTX != "") {
                                    $dataPuenteTex = array(
                                        'idPlantilla' => $idPlantilla,
                                        'nombreEtiqueta' => $etiquetaTX
                                    );
                                    $idPlTex= $this->Plantillas->insertaDatosPuenteTexto($dataPuenteTex);

                                    $dataPuenteTexF = array(
                                        'idEtiqueta' => $idPlTex,
                                        'idFormulario' => $idFormm,
                                        'idAcordeon' => $idAcord,
                                        'idIndicador' => $indicad
                                    );
                                    $this->Plantillas->insertaDatosPuenteTextoF($dataPuenteTexF);
                                }
                            }
                        }
                        if ($cuentaAcuse==1)
                        {
                            for ($ix=0; $ix <= $totalContAcuse; $ix++) {
                                $etiquetaAcuse= $this->input->post('etiquetaAcuse'.$ix);
                                $idGrupo= $this->input->post('idGrupo'.$ix);
                                $idIndicador= $this->input->post('idIndicadorAcuse'.$ix);


                                if ($etiquetaAcuse!= "")
                                {
                                    $dataPuenteAcuse = array(
                                        'idPlantilla' => $idPlantilla,
                                        'nombreEtiqueta' => $etiquetaAcuse,
                                        'idGrupo' => $idGrupo,
                                        'idIndicadorAcuse'=> $idIndicador
                                    );
                                    $this->Plantillas->insertaDatosPuenteAcuse($dataPuenteAcuse);
                                }
                            }
                        }

                    }
                    return null;
                }

            }
        }else{
            $data = array(
                'idEstado' => $idEdo,
                'idCliente' => $idCliente,
                'idFormato' => $idFormato,
                'idCentroTrabajo' => $idCentro,
                'nombrePlantilla' => $nombrePlantilla,
                'tieneFoto' => $cuentaFot,
                'tieneTexto' => $cuentaTexto,
                'tieneAcuse' => $cuentaAcuse
            );
            // echo "datitos $cuentaFot";
            $idInsertado= $this->Plantillas->updateDatos($data,$idPlantilla);
            $this->Plantillas->borrarDatosPuente($idPlantilla);
            if ($cuentaFot==1) {
                for ($i=0; $i < $totalCont ; $i++) {
                    $etiqueta = $this->input->post('etiqueta'.$i);

                    if ($etiqueta != "") {

                        $dataPuente = array(
                            'idPlantilla' => $idPlantilla,
                            'nombreEtiqueta' => $etiqueta
                        );
                        $this->Plantillas->insertaDatosPuente($dataPuente);
                    }
                }
            }
            $this->Plantillas->borrarDatosPuenteTexto($idPlantilla);
            $this->Plantillas->borrarDatosPuenteAcuse($idPlantilla);
            //Aqui viene el el texto
            if ($cuentaTexto==1) {
                for ($ix=0; $ix <= $totalContText ; $ix++) {
                    $etiquetaTX = $this->input->post('etiquetaTX'.$ix);
                    $idFormm = $this->input->post('idFormm'.$ix);
                    $idAcord = $this->input->post('idAcord'.$ix);
                    $indicad = $this->input->post('indicad'.$ix);

                    if ($etiquetaTX != "") {
                        $dataPuenteTex = array(
                            'idPlantilla' => $idPlantilla,
                            'nombreEtiqueta' => $etiquetaTX
                        );
                        $idPlTex= $this->Plantillas->insertaDatosPuenteTexto($dataPuenteTex);

                        $dataPuenteTexF = array(
                            'idEtiqueta' => $idPlTex,
                            'idFormulario' => $idFormm,
                            'idAcordeon' => $idAcord,
                            'idIndicador' => $indicad
                        );
                        $this->Plantillas->insertaDatosPuenteTextoF($dataPuenteTexF);
                    }
                }
            }
            if ($cuentaAcuse==1)
            {
                for ($ix=0; $ix <= $totalContAcuse; $ix++) {
                    $etiquetaAcuse= $this->input->post('etiquetaAcuse'.$ix);
                    $idGrupo= $this->input->post('idGrupo'.$ix);
                    $idIndicador= $this->input->post('idIndicadorAcuse'.$ix);


                    if ($etiquetaAcuse!= "")
                    {
                        $dataPuenteAcuse = array(
                            'idPlantilla' => $idPlantilla,
                            'nombreEtiqueta' => $etiquetaAcuse,
                            'idGrupo' => $idGrupo,
                            'idIndicadorAcuse'=> $idIndicador
                        );
                        $this->Plantillas->insertaDatosPuenteAcuse($dataPuenteAcuse);
                    }
                }
            }
        }



    }

    function editarTablaPlantilla(){

        $cantidadTablas = $this->input->post('cantidadTablas');
        $idP=$this->input->post('idPlantilla');
        $this->Plantillas->borrarDatosTabla($idP);

        for ($i=0; $i <$cantidadTablas ; $i++) {
            $nombreTabla=$this->input->post('nombreTabla'.$i);

            $contadorIndicador=$this->input->post('contadorIndicador'.$i);
            if ($nombreTabla != ""){
                $data = array(
                    'idPlantilla' => $this->input->post('idPlantilla'),
                    'idFormulario' => $this->input->post('idFormm'.$i),// dato
                    'idAcordeon' => $this->input->post('idAcord'.$i),//dato
                    'nombreTabla' => $this->input->post('nombreTabla'.$i)//dato
                );

                $idInsertado= $this->Plantillas->insertaDatosPlantillaTabla($data);


                for ($x=0; $x <$contadorIndicador ; $x++) {
                    $nombreColumna=$this->input->post('tabla'.$i.'NombreColumna'.$x);
                    $indicad=$this->input->post('tabla'.$i.'indicad'.$x);
                    if ($nombreColumna != ""){

                        $dataPuente = array(
                            'idPlantillaTablas' => $idInsertado,
                            'idIndicador' =>$indicad,
                            'nombreColumna' => $nombreColumna
                        );
                        $this->Plantillas->insertaDatosPlantillaTablaPuente($dataPuente);
                    }
                }
            }
        }
    }

    function altaTablaPlantilla(){

        $cantidadTablas = $this->input->post('cantidadTablas');
        for ($i=0; $i <$cantidadTablas ; $i++) {
            $nombreTabla=$this->input->post('nombreTabla'.$i);

            $contadorIndicador=$this->input->post('contadorIndicador'.$i);
            if ($nombreTabla != ""){
                $data = array(
                    'idPlantilla' => $this->input->post('idPlantilla'),
                    'idFormulario' => $this->input->post('idFormm'.$i),// dato
                    'idAcordeon' => $this->input->post('idAcord'.$i),//dato
                    'nombreTabla' => $this->input->post('nombreTabla'.$i)//dato
                );

                $idInsertado= $this->Plantillas->insertaDatosPlantillaTabla($data);


                for ($x=0; $x <$contadorIndicador ; $x++) {
                    $nombreColumna=$this->input->post('tabla'.$i.'NombreColumna'.$x);
                    $indicad=$this->input->post('tabla'.$i.'indicad'.$x);
                    if ($nombreColumna != ""){

                        $dataPuente = array(
                            'idPlantillaTablas' => $idInsertado,
                            'idIndicador' =>$indicad,
                            'nombreColumna' => $nombreColumna
                        );
                        $this->Plantillas->insertaDatosPlantillaTablaPuente($dataPuente);
                    }
                }
            }
        }
    }

    function altaPlantilla()
    {
        $nombrePlantilla = $this->input->post('nombrePlantilla');
        $idEdo = $this->input->post('idEdo');
        $idCliente = $this->input->post('idCliente');
        $idFormato = $this->input->post('idFormato');
        $idCentro = $this->input->post('idCentro');
        $totalCont = $this->input->post('totalCont');
        $cuentaFot = $this->input->post('cuentaFot');

        $cuentaTexto=$this->input->post('cuentaTexto');
        $totalContText=$this->input->post('totalContText');
        $cuentaAcuse=$this->input->post('cuentaAcuse');
        $totalContAcuse=$this->input->post('totalContAcuse');
        if (empty($cuentaAcuse)) {
            $cuentaAcuse=0;
        }
        if (empty($cuentaTexto)) {
            $cuentaTexto=0;
        }
        // echo "datitos $cuentaTexto";
        // $nombreCampo = $_FILES['plantillaFile']['name'];
        if (empty($idFormato)) {
            $idFormato=null;
        }
        if (empty($idCentro)) {
            $idCentro=null;
        }



        if(!file_exists("assets/img/plantillasPc") && !is_dir("assets/img/plantillasPc"))
        {
            mkdir("assets/img/plantillasPc");
        }
        $success = null;
        if(!empty($_FILES['plantillaFile']))
        {
            $images = $_FILES['plantillaFile'];
            $filenames = $images['name'];
        }
        else
            $filenames = false;
        if($filenames)
        {
            for($i=0; $i < count($filenames); $i++)
            {
                $ext = explode('.', basename($filenames));
                $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
                $target = "assets/img/plantillasPc" . $nombre;
                if(move_uploaded_file($images['tmp_name'], $target))
                {
                    $data = array(
                        'idEstado' => $idEdo,
                        'idCliente' => $idCliente,
                        'idFormato' => $idFormato,
                        'idCentroTrabajo' => $idCentro,
                        'nombrePlantilla' => $nombrePlantilla,
                        'nombreArchivo' => $nombre,
                        'tieneFoto' => $cuentaFot,
                        'tieneTexto' => $cuentaTexto,
                        'tieneAcuse' => $cuentaAcuse
                    );

                    $idInsertado= $this->Plantillas->insertaDatos($data);
                    if ($cuentaFot==1) {
                        for ($i=0; $i <= $totalCont ; $i++) {
                            $etiqueta = $this->input->post('etiqueta'.$i);
                            if ($etiqueta != "") {
                                $dataPuente = array(
                                    'idPlantilla' => $idInsertado,
                                    'nombreEtiqueta' => $etiqueta
                                );
                                $this->Plantillas->insertaDatosPuente($dataPuente);
                            }
                        }
                    }

                    if ($cuentaTexto==1)
                    {
                        for ($ix=0; $ix <= $totalContText ; $ix++) {
                            $etiquetaTX = $this->input->post('etiquetaTX'.$ix);
                            $idFormm = $this->input->post('idFormm'.$ix);
                            $idAcord = $this->input->post('idAcord'.$ix);
                            $indicad = $this->input->post('indicad'.$ix);

                            if ($etiquetaTX != "") {
                                $dataPuenteTex = array(
                                    'idPlantilla' => $idInsertado,
                                    'nombreEtiqueta' => $etiquetaTX
                                );
                                $idPlTex= $this->Plantillas->insertaDatosPuenteTexto($dataPuenteTex);

                                $dataPuenteTexF = array(
                                    'idEtiqueta' => $idPlTex,
                                    'idFormulario' => $idFormm,
                                    'idAcordeon' => $idAcord,
                                    'idIndicador' => $indicad
                                );
                                $this->Plantillas->insertaDatosPuenteTextoF($dataPuenteTexF);
                            }
                        }
                    }
                    if ($cuentaAcuse==1)
                    {
                        for ($ix=0; $ix <= $totalContAcuse; $ix++) {
                            $etiquetaAcuse= $this->input->post('etiquetaAcuse'.$ix);
                            $idGrupo= $this->input->post('idGrupo'.$ix);
                            $idIndicador= $this->input->post('idIndicadorAcuse'.$ix);


                            if ($etiquetaAcuse!= "")
                            {
                                $dataPuenteAcuse = array(
                                    'idPlantilla' => $idInsertado,
                                    'nombreEtiqueta' => $etiquetaAcuse,
                                    'idGrupo' => $idGrupo,
                                    'idIndicadorAcuse'=> $idIndicador,

                                );
                                $this->Plantillas->insertaDatosPuenteAcuse($dataPuenteAcuse);
                            }
                        }
                    }

                }
                return null;
            }

        }


    }

    function getFormatos($idClie)
    {
        $data= $this->Plantillas->getForm($idClie);
        echo json_encode ($data);
    }

    function getForm()
    {
        $data= $this->Plantillas->getAut();
        echo json_encode ($data);
    }

    function contadores($idPlantilla)
    {
        $data= $this->Plantillas->totalR($idPlantilla);
        echo json_encode ($data);
    }


    function contadoresInter($idPlantilla)
    {
        $data= $this->Plantillas->totalRI($idPlantilla);
        echo json_encode ($data);
    }

    function getCentro($idForm)
    {
        $data= $this->Plantillas->getCentr($idForm);
        echo json_encode ($data);
    }

    function obtenerDatos($plantilla){
        $data= $this->Plantillas->datosPlantilla($plantilla);
        echo json_encode ($data);
    }

    function obtenerDatosTotalesPuente($idPlant)
    {
        $data= $this->Plantillas->getTotales($idPlant);
        echo json_encode ($data);
    }

    function obtenerDatosTotalesPuenteText($idPlant)
    {
        $data= $this->Plantillas->getTotalesText($idPlant);
        echo json_encode ($data);
    }
    function obtenerDatosPlantillaAcuse($idPlant)
    {
        $data= $this->Plantillas->getTotalesAcuse($idPlant);
        echo json_encode ($data);
    }

    function obtenerEtiquetasValores($idPlantilla)
    {
        $data= $this->Plantillas->getValoresEtiquetas($idPlantilla);
        echo json_encode ($data);
    }

    function obtenerEtiquetasValoresText($idPlantilla)
    {
        $data= $this->Plantillas->getValoresEtiquetasText($idPlantilla);
        echo json_encode ($data);
    }
    function obtenerEtiquetasValoresAcuse($idPlantilla)
    {
        $data= $this->Plantillas->getValoresEtiquetasAcuse($idPlantilla);
        echo json_encode ($data);
    }
    //
    function getCordeones($idFormm)
    {
        $data= $this->Plantillas->getAcorde($idFormm);
        echo json_encode ($data);
    }

    function getCordeonesUni($idFormm)
    {
        $data= $this->Plantillas->getAcordeUni($idFormm);
        echo json_encode ($data);
    }

    function getIndocador($idAcord)
    {
        $data= $this->Plantillas->getIndocador($idAcord);
        echo json_encode ($data);
    }
    function getIndicadorAcuse($idGrupo)
    {
        $data= $this->Plantillas->getIndicadorAcuse($idGrupo);
        echo json_encode ($data);
    }


}

?>

