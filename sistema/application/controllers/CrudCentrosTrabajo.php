<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class CrudCentrosTrabajo extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("centrosTrabajo"); //cargamos el modelo

    }

    public function index($index = 1)
    {
        $data['page'] = $this->centrosTrabajo->data_pagination("/CrudCentrosTrabajo/index/",
            $this->centrosTrabajo->getTotalRowAllData(), 3);
        $data['listCentrosTrabajo'] = $this->centrosTrabajo->getDatos($index);
        $this->load->view('viewtodocentrostrabajo',$data);
    }

    public function formAltaCentroTrabajo()

    {
        $data['formato']= $this->centrosTrabajo->formatoGet();
        $data['inmueble']=$this->centrosTrabajo->inmuebleGet();
        $this->load->view('formcentrotrabajo',$data);
    }


    public function formEditarCentroTrabajo($idCentroTrabajo=null)
    {
        $data = ['idCentroTrabajo' => $idCentroTrabajo, 'formato' => $this->centrosTrabajo->formatoGet(), 'inmueble' => $this->centrosTrabajo->inmuebleGet()];
        $this->load->view('grideditarcentrotrabajo',$data);
    }

    public function formDetalleCentroTrabajo($idCentroTrabajo=null)
    {
        $data = ['idCentroTrabajo' => $idCentroTrabajo, 'formato' => $this->centrosTrabajo->formatoGet(), 'inmueble' => $this->centrosTrabajo->inmuebleGet()];
        $this->load->view('griddetallecentrotrabajo',$data);
    }

    function obtenerDatos($idc)
    {
        $prueba= $this->centrosTrabajo->obtenerFicha($idc);
        echo json_encode ($prueba);
    }
	
	function obtenerDatosVerificiar()
	{
		$idFormato = $this->input->post('idFormato');
		$idInmueble = $this->input->post('idInmueble');
		$nombreCentro = $this->input->post('nombreCentro');
		$prueba= $this->centrosTrabajo->obtenerCentro($idFormato,$idInmueble,$nombreCentro);
        echo json_encode ($prueba);
		
	}

    function modificarDatos(){

        $colonia= $this->input->post('colonia');
        $calle=$this->input->post('calle');
        $numeroInterior=$this->input->post('numInterior');
        $numeroExterior=$this->input->post('numExterior');
        $aplica=null;
        if($this->input->post('aplicaHorarioAtencion')=='NoAplica' && isset ($_POST['NoAplica']))
        {
            $aplica=1;
        }
        $idCentroTrabajo = $this->input->post('idCentroTrabajo');
        $data = array(
            'nombre' => $this->input->post('nombreCentro'),
            'idDet' => $this->input->post('idDet'),
            'nomContacto' => $this->input->post('nomContacto'),
            'puestoContacto' => $this->input->post('puestoContacto'),
            'telContacto' => $this->input->post('telContacto'),
            'email' => $this->input->post('correoContacto'),
            'idColonia' => $colonia,
            'calle' => $calle,
            'numeroInterior' => $numeroInterior,
            'numeroExterior' => $numeroExterior,
            'idFormato'=>$this->input->post('idFormato'),
            'telefonoInmueble' => $this->input->post('telefonoInmueble'),
            'correoInmueble' => $this->input->post('correoInmueble'),
            'horarioFuncionamientoInicio' => $this->input->post('horarioFuncionamientoInicio'),
            'horarioFuncionamientoFin' => $this->input->post('horarioFuncionamientoFin'),
            'aplicaHorarioAtencion' => $aplica,
            'horarioAtencionInicio' => $this->input->post('horarioAtencionInicio'),
            'horarioAtencionFin' => $this->input->post('horarioAtencionFin'),
            'giroInmueble' => $this->input->post('giroInmueble'),
            'latitud' => $this->input->post('latitud'),
            'longitud'  => $this->input->post('longitud'),
            'Metros'  => $this->input->post('Metros'),
            'idInmueble'=>$this->input->post('inmueble')
        );

        $this->centrosTrabajo->modificaDatos($data,$idCentroTrabajo);

        if($this->input->post("razonSocial"))
        {
            $this->centrosTrabajo->modificaFormato(array('razonSocial' => $this->input->post("razonSocial")), $this->input->post('idFormato'));
        }

    }

    function modificarDatosPorAnalista()
    {
        $colonia= $this->input->post('colonia');
        $calle=$this->input->post('calle');
        $numeroInterior=$this->input->post('numInterior');
        $numeroExterior=$this->input->post('numExterior');
        $aplica=null;
        if($this->input->post('aplicaHorarioAtencion')=='NoAplica' && isset ($_POST['aplicaHorarioAtencion']))
        {
            $aplica=1;
        }

        $idCentroTrabajo = $this->input->post('idCentroTrabajo');
        $data = array(
            'nombre' => $this->input->post('nombreCentro'),
            'idDet' => $this->input->post('idDet'),
            'nomContacto' => $this->input->post('nomContacto'),
            'puestoContacto' => $this->input->post('puestoContacto'),
            'telContacto' => $this->input->post('telContacto'),
            'email' => $this->input->post('correoContacto'),
            'idColonia' => $colonia,
            'calle' => $calle,
            'numeroInterior' => $numeroInterior,
            'numeroExterior' => $numeroExterior,
            'telefonoInmueble' => $this->input->post('telefonoInmueble'),
            'correoInmueble' => $this->input->post('correoInmueble'),
            'horarioFuncionamientoInicio' => $this->input->post('horarioFuncionamientoInicio'),
            'horarioFuncionamientoFin' => $this->input->post('horarioFuncionamientoFin'),
            'aplicaHorarioAtencion' => $aplica,
            'horarioAtencionInicio' => $this->input->post('horarioAtencionInicio'),
            'horarioAtencionFin' => $this->input->post('horarioAtencionFin'),
            'giroInmueble' => $this->input->post('giroInmueble'),
            'latitud' => $this->input->post('latitud'),
            'longitud'  => $this->input->post('longitud'),
            'Metros'  => $this->input->post('Metros')
        );

        $this->centrosTrabajo->modificaDatos($data,$idCentroTrabajo);
    }



    function altaCentroTrabajo()
    {
        $idFormato = $this->input->post('idFormato');
        $idInmueble= $this->input->post('idInmueble');
        $nombreCentro=$this->input->post('nombreCentro');
        $idDet = $this->input->post('idDet');

        $colonia= $this->input->post('colonia');
        $calle=$this->input->post('calle');
        $numeroInterior=$this->input->post('numInterior');
        $numeroExterior=$this->input->post('numExterior');

        if(strlen($numeroInterior)<1)
        {
            $numeroInterior=0;
        }
        if(strlen($numeroExterior)<1)
        {
            $numeroExterior=0;
        }

        $nomContacto = $this->input->post('nomContacto');
        $puestoContacto = $this->input->post('puestoContacto');
        $telContacto = $this->input->post('telContacto');
        $correoContacto =$this->input->post('correoContacto');
        $aplica=null;
        if($this->input->post('aplicaHorarioAtencion')=='NoAplica')
        {
            $aplica=1;
        }

        $data= array(
            'nombre' => $nombreCentro,
            'idDet' =>$idDet ,
            'nomContacto' =>$nomContacto ,
            'puestoContacto' =>$puestoContacto ,
            'telContacto' =>$telContacto ,
            'email' => $correoContacto,
            'idColonia' => $colonia,
            'calle' => $calle,
            'numeroInterior' => $numeroInterior,
            'numeroExterior' => $numeroExterior,
            'idFormato' =>$idFormato,
            'telefonoInmueble' => $this->input->post('telefonoInmueble'),
            'correoInmueble' => $this->input->post('correoInmueble'),
            'horarioFuncionamientoInicio' => $this->input->post('horarioFuncionamientoInicio'),
            'horarioFuncionamientoFin' => $this->input->post('horarioFuncionamientoFin'),
            'aplicaHorarioAtencion' => $aplica,
            'horarioAtencionInicio' => $this->input->post('horarioAtencionInicio'),
            'horarioAtencionFin' => $this->input->post('horarioAtencionFin'),
            'giroInmueble' => $this->input->post('giroInmueble'),
            'latitud' => $this->input->post('latitud'),
            'longitud'  => $this->input->post('longitud'),
            'Metros'  => $this->input->post('Metros'),
            'idInmueble' =>$idInmueble
        );

        $this->centrosTrabajo->insertaDatos($data);
        echo "1";

    }
    function altaMasivaCentrosTrabajo()
    {
        /*Recibir y guardar el excel*/
        if (!empty($_FILES["excel"]))
        {
            $file=$_FILES['excel'];
            $ext = explode('.', basename($file['name']));
            $nombre=md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/excelCentrosTrabajo/" . $nombre;

            //  echo "entra $nombre";
            if(move_uploaded_file($file['tmp_name'], $target))
            {

                //Leer el excel que se acaba de guardar
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($target);
                $hojaExcel=$spreadsheet->getActiveSheet();
                $ultimaFila=$hojaExcel->getHighestDataRow();
                $arrayFallos=array();
                //Recorre cada registro y lo intenta insertar
                for($i=2; $i<=$ultimaFila; $i++)
                {
                    $formato=$hojaExcel->getCell('A'.$i)->getFormattedValue();
                    $tipoInmueble=$hojaExcel->getCell('B'.$i)->getFormattedValue();
                    $nombreCentro=$hojaExcel->getCell('C'.$i)->getFormattedValue();
                    $idDet=$hojaExcel->getCell('D'.$i)->getFormattedValue();
                    $nombreColonia=$hojaExcel->getCell('E'.$i)->getFormattedValue();
                    $codigoPostal=$hojaExcel->getCell('F'.$i)->getFormattedValue();
                    $calle=$hojaExcel->getCell('G'.$i)->getFormattedValue();
                    $numeroExterior=$hojaExcel->getCell('H'.$i)->getFormattedValue();
                    $numeroInterior=$hojaExcel->getCell('I'.$i)->getFormattedValue();
                    $nomContacto=$hojaExcel->getCell('J'.$i)->getFormattedValue();
                    $puestoContacto=$hojaExcel->getCell('K'.$i)->getFormattedValue();
                    $telContacto=$hojaExcel->getCell('L'.$i)->getFormattedValue();
                    $correoContacto=$hojaExcel->getCell('M'.$i)->getFormattedValue();
                    $telefono=$hojaExcel->getCell('N'.$i)->getFormattedValue();
                    $correoInmueble=$hojaExcel->getCell('O'.$i)->getFormattedValue();
                    $giro=$hojaExcel->getCell('P'.$i)->getFormattedValue();
                    $latitud=$hojaExcel->getCell('Q'.$i)->getFormattedValue();
                    $longitud=$hojaExcel->getCell('R'.$i)->getFormattedValue();
                    $metros=$hojaExcel->getCell('S'.$i)->getFormattedValue();

                    $idColonia=$this->centrosTrabajo->buscarColonia($codigoPostal, $nombreColonia);

                    $idFormato=$this->centrosTrabajo->buscarFormato($formato);

                    $idinmueble=$this->centrosTrabajo->buscarInmueble($tipoInmueble);

                    $idCentro=$this->centrosTrabajo->getExistente($idFormato,$idinmueble,$nombreCentro);

                    
                    if(empty($idinmueble)||empty($idFormato)||empty($idColonia||empty($nombreCentro) )){
                        array_push($arrayFallos, $i);
                    }else{

                        if (!empty($idCentro)) {
                            //array_push($arrayFallos, $i)
                            //echo json_encode($arrayFallos);
                             array_push($arrayFallos, $i);
                        }

                        $data= array(
                            'nombre' => $nombreCentro,
                            'idDet' =>$idDet ,
                            'nomContacto' =>$nomContacto ,
                            'puestoContacto' =>$puestoContacto ,
                            'telContacto' =>$telContacto ,
                            'email' => $correoContacto,
                            'idColonia' => $idColonia,
                            'calle' => $calle,
                            'numeroInterior' => $numeroInterior,
                            'numeroExterior' => $this->get_numeric($numeroExterior),
                            'idFormato' =>$idFormato,
                            'telefonoInmueble' => $telefono,
                            'correoInmueble' => $correoInmueble,
                            'giroInmueble' =>$giro,
                            'latitud' => $this->get_numeric($latitud),
                            'longitud'  =>$this->get_numeric($longitud),
                            'Metros'  =>$this->get_numeric($metros),
                            'idInmueble' =>$idinmueble
                        );
                        $this->centrosTrabajo->insertaDatos($data);
                    }
                }
                echo json_encode($arrayFallos);


            }
        }

    }
    function get_numeric($val) {
        if (is_numeric($val)) {
            return $val + 0;
        }
        return 0;
    }

    function deleteCentroTrabajo($idCentroTrabajo){

        $this->centrosTrabajo->borrarDatos($idCentroTrabajo);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudCentrosTrabajo');

    }

    function obtenerEstados()
    {
        $estados=$this->centrosTrabajo->getEstados();
        echo json_encode($estados);
    }
    function obtenerMunicipios($idEstado)
    {
        $municipios=$this->centrosTrabajo->getMunicipios($idEstado);
        echo json_encode($municipios);
    }
    function obtenerColonias($idMunicipio)
    {
        $regiones=$this->centrosTrabajo->getRegiones($idMunicipio);
        echo json_encode($regiones);
    }
    function obtenerCodigoPostal($idColonia)
    {
        $cp=$this->centrosTrabajo->getCodigoPostal($idColonia);
        echo json_encode($cp);
    }
    function getNombreAtendioVisita($idAsignacion)
    {
        echo json_encode($this->centrosTrabajo->getNombreAtendioVisita($idAsignacion));
    }
    function cambiarNombreAtendioVisita($idAsignacion)
    {
        $this->centrosTrabajo->cambiarNombreAtendioVisita(array('nombreAtendioVisita' => $this->input->post("nombre")), $idAsignacion);
    }

}


?>