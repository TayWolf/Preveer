<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudDocumentosNormas extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("DocumentosNormas"); //cargamos el modelo
    }

    public function index($index = 1)
    {
        //$data['page'] = $this->DocumentosNormas->data_pagination("/CrudDocumentosNormas/index/", $this->DocumentosNormas->getTotalRowAllData(), 3);
        $data['listDocumentosNormas'] = $this->DocumentosNormas->getDatos($index);
        $this->load->view('viewtododocumentosnormas',$data);
    }


    public function indexFiltrado($index= 1)
    {
        $data['page'] = $this->DocumentosNormas->data_pagination("/CrudDocumentosNormas/indexFiltrado/", $this->DocumentosNormas->getFilterRowData("Conservar las instalaciones del centro de trabajo en condiciones seguras para que no representen riesgos"), 3);
        $data['listDocumentosNormas'] = $this->DocumentosNormas->getDatos($index);
        $this->load->view('viewtododocumentosnormas',$data);
    }


    public function getDatosFaltantes()
    {
        print json_encode($this->DocumentosNormas->getDatosRestantes());
    }

    


    public function formAltaDocumentoNormas()
    {
        $data['listSubAreas'] = $this->DocumentosNormas->getSubAreas();
        $this->load->view('formdocumentosnormas', $data);
    }


    public function formEditarDocumentoNormas($idDocSTPS=null)

    {
        // $idDocumento=$_REQUEST['id'];
        $data = ['idDocSTPS' => $idDocSTPS];
        $data ['datos'] =  $this->DocumentosNormas->obtenerFicha($idDocSTPS);
        $data['listSubAreas'] = $this->DocumentosNormas->getSubAreas();
        $this->load->view('grideditardocumentonormas',$data);
    }


    function modificarDatos()
    {
        $idDocSTPS = $this->input->post('idDocSTPS');
        $data = [
            'texto' => $this->input->post('nombreDocumento'),
            'idNorma' => $this->input->post('idSubservicio'),
            'tipo' => $this->input->post('tipo')
        ];
        $this->DocumentosNormas->modificaDatos($data,$idDocSTPS);

    }



    function altaDocumento()//pendiente
    {
        $arreglo= array(
            'texto' => $this->input->post('nombreDocumento'),
            'idNorma' => $this->input->post('idSubservicio'),
            'tipo' => $this->input->post('tipo')
        );
        $data = $arreglo;

        $this->DocumentosNormas->insertaDatos($data);
    }




    function deleteDocumentoNormas($idDocSTPS){

        $this->DocumentosNormas->borrarDatos($idDocSTPS);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormas');

    }


    public function traerNormas($idSubArea)
    {
        $normas=$this->DocumentosNormas->getNormas($idSubArea);
        echo json_encode($normas);

    }

    function getListadoDocumentos()
    {
         
        $columnas=array(
            0 => 'idDocSTPS',
            1 => 'texto',
            2 => 'nombreArea',
            3 => 'nombre',
            4 => 'Modificar',
            5 => 'Eliminar'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columnas[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];
        //echo "order = $order dir $dir";
        $totalData = $this->DocumentosNormas->cuentaTodosDocumentos();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value']))
        {
            $pacientes = $this->DocumentosNormas->allDocumentos($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $pacientes =  $this->DocumentosNormas->busquedaDocumentos($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->DocumentosNormas->cuentaDocumentoFiltrados($search);
        }
        $data = array();
        if(!empty($pacientes))
        {
            $conta=1;
            foreach ($pacientes as $paciente)
            {

                $nestedData['idDocSTPS']=$conta;
                $nestedData['texto']=$paciente['texto'];
                $nestedData['nombreArea']=$paciente['nombreArea'];
                $nestedData['nombre']=$paciente['nombre'];
                $nestedData['Modificar']="<a href='https://cointic.com.mx/preveer/sistema/index.php/CrudDocumentosNormas/formEditarDocumentoNormas/".$paciente['idDocSTPS']."'><i class='fa fa-pencil-square-o'></i></a>";
                
                // $nestedData['duracion']=$paciente['duracion'];
                // $nestedData['precioPublico']=$paciente['precioPublico'];
                // $nestedData['categoria']="<div id='nombreCategoria".$paciente['IdEstudio']."' ondblclick=traerCategoria(".$paciente['IdEstudio'].");>".$paciente['nombreCat']."</div>
                //                                        <td id='muestraselectcategoria".$paciente['IdEstudio']."' style='display: none;'>
                //                                        <select style='display: none;' id='selectcategoria".$paciente['IdEstudio']."' name='selectcategoria".$paciente['IdEstudio']."' onchange='modificarDatosCate(".$paciente['IdEstudio'].");'> </select>
                //                                        </td>";

                // $nestedData['empresa']="<div id='nombreEmpresa".$paciente['IdEstudio']."' ondblclick=traerEmpresa(".$paciente['IdEstudio'].");>".$paciente['nombreEmpresa']."</div>
                //                                        <td id='muestraselectempresas".$paciente['IdEstudio']."' style='display: none;'>
                //                                        <select style='display: none;' id='selectempresa".$paciente['IdEstudio']."' name='selectempresa".$paciente['IdEstudio']."' onchange='modificarDatosEmpre(".$paciente['IdEstudio'].");'> </select>
                //                                        </td>";
                // $nestedData['numeroPlacas']="<div align='center'>".$paciente['numeroPlacas']."</div>";
            
                
                // $nestedData['asigSala']="<a href='#' onclick='traerId(".$paciente['IdEstudio'].");identificaSalasAsignadas();' data-toggle='modal' data-target='#myModal2'>Asignar Salas</a> ";
                // $nestedData['asigaPreci']="<a href='#' onclick='traerId(".$paciente['IdEstudio']."); traeNombre(".$paciente['IdEstudio'].");traeclientes();' data-toggle='modal' data-target='#myModal3'>Asignar/Modificar Precios</a>";
                // $nestedData['resultad']=$paciente['diasResultado'];
                $nestedData['Eliminar']="<a href='#' onclick='confirmaDeleteDocumento(".$paciente['idDocSTPS'].");'><i class='fa fa-trash'></i></a>";

                $data[] = $nestedData;
                $conta++;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);

    }



}

?>

