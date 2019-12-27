<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudRegiones extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("regiones"); //cargamos el modelo de User
		
	}

	public function index($index = 1){
	    //$data['listaRegion'] = $this->regiones->getDatos($index);
		$data['consultaEdo'] = $this->regiones->getEstados();
		$this->load->view('viewtodoregiones',$data);
	}
	
	function traerEdo(){
		 $prueba= $this->regiones->getEstados();
        echo json_encode ($prueba);
		
	}

    function getMunicipio($idEdo){
         $prueba= $this->regiones->traerMunicipio($idEdo);
        echo json_encode ($prueba);
        
    }
	
	function getCodigopostal($idmunicipio){
		 $prueba= $this->regiones->traercp($idmunicipio);
        echo json_encode ($prueba);
		
	}

	function altaColonia(){
		
			$id_municiopios = $this->input->post('id_municipios');
			$id_codigopostal = $this->input->post('id_codigopostal');
			$nombre_colonia = $this->input->post('nombre_colonia');
			

			$data = array(	
			'nombreRegion' => $nombre_colonia,
			'cp' => $id_codigopostal,
			'municipio' => $id_municiopios
		);
			$this->regiones->insertaDatos($data);
			
	}

	function deleteColonia($idRegion){

		$this->regiones->borrarDatos($idRegion);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudregiones');
		
	}

   

    function modificarDatos(){
        $idR = $this->input->post('idR');
        $nombreRegion =$this->input->post('nombreRegion');
        
            if ($idR > "150976") {
                if (!empty($nombreRegion)) {
                    $data = array(
                        'nombreRegion' => $nombreRegion
                    );
                    $this->regiones->modificaDatos($data,$idR);
                } 
                echo "1";
            }else{
                echo "2";
            }
                           
    }

    function Modific(){
        $idcategoria = $this->input->post('idcategoria');
        $id = $this->input->post('id');
        //echo "dataa $ruta";
        if ($id > "150976") {
             $data = array(
              'municipio' => $idcategoria
             );
            $this->regiones->modificaDatos($data,$id);
            echo "1";
        }else{
            echo "2";
        }
       
    }

    function ModificP(){
        $idSel = $this->input->post('idSel');
        $id = $this->input->post('id');
        if ($id > "150976") {
             $data = array(
              'cp' => $idSel
             );
        $this->regiones->modificaDatos($data,$id);
        echo "1";
    }else{
        echo "2";
    }
       
        
    }
	
	 function getListaregiones()
    {
    	 
        $columnas=array(
            0 => 'idRegiones',
            1 => 'nombreRegion',
            2 => 'cp',
            3 => 'Edo',
            4 => 'municipio',
            5 => 'Eliminar'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columnas[$this->input->post('order')[0]['column']];
        //$dir = $this->input->post('order')[0]['dir'];
        $dir = "DESC";
        $order = "idRegiones";
        $totalData = $this->regiones->cuentaTodosRegiones();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value']))
        {
            $getRegionesresultado = $this->regiones->allRegiones($limit,$start,$order,$dir);
        }
        else {
             
            $search = $this->input->post('search')['value'];
            $getRegionesresultado =  $this->regiones->busquedaRegion($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->regiones->cuentaRegionesfiltrados($search);
        }
        $data = array();
       // $botonEliminar="";
        if(!empty($getRegionesresultado))
        {
             
            foreach ($getRegionesresultado as $getRegionesresultad)
            {
               
                $nestedData['idRegiones']=$getRegionesresultad['idRegiones'];
                $nestedData['nombreRegion']=$getRegionesresultad['nombreRegion'];
                
               
                if ( $nestedData['idRegiones'] <= "150976") {
                    $nestedData['Eliminar']="";
                    $botonEliminar=$nestedData['Eliminar'];
                }else{
                    $nestedData['Eliminar']="<a href='#' onclick='confirmaDeleteRegion(".$getRegionesresultad['idRegiones'].");'><i class='fa fa-trash'></i></a>"; 
                   
                   $botonEliminar=$nestedData['Eliminar'];
                }

                $nestedData['Edo']="<div id='nombreEstado".$getRegionesresultad['idRegiones']."' onclick=traerEdos(".$getRegionesresultad['idRegiones'].");>".$getRegionesresultad['nombreEstado']."<input type='hidden' id='idee".$getRegionesresultad['idRegiones']."' name='idee".$getRegionesresultad['idRegiones']."' value='".$getRegionesresultad['id_Estado']."'></div>
                                                       <td id='muestraselectEdo".$getRegionesresultad['idRegiones']."' style='display: none;'>
                                                       <select style='display: none;' id='selectEdo".$getRegionesresultad['idRegiones']."' onclick=traerCategoria(".$getRegionesresultad['idRegiones']."); onchange='cambiarIdEdo(".$getRegionesresultad['idRegiones'].")' name='selectEdo".$getRegionesresultad['idRegiones']."' );'> </select>
                                                       </td>";
               
                $nestedData['municipio']="<div id='nombreCategoria".$getRegionesresultad['idRegiones']."' onclick=traerCategoria(".$getRegionesresultad['idRegiones'].");>".$getRegionesresultad['nombreMunicipio']."<input type='hidden' id='idMM".$getRegionesresultad['idRegiones']."' name='idMM".$getRegionesresultad['idRegiones']."' value='".$getRegionesresultad['idMunicipio']."'></div>
                                                       <td id='muestraselectcategoria".$getRegionesresultad['idRegiones']."' style='display: none;'>
                                                       <select style='display: none;' id='selectcategoria".$getRegionesresultad['idRegiones']."' onclick=traerCodigos(".$getRegionesresultad['idRegiones']."); name='selectcategoria".$getRegionesresultad['idRegiones']."' onchange='modificarDatosCate(".$getRegionesresultad['idRegiones'].");cambiarIdMuni(".$getRegionesresultad['idRegiones'].")'> </select>
                                                       </td>";

                //$nestedData['cp']=$getRegionesresultad['cp'];
                $nestedData['cp']="<div id='numberCodigo".$getRegionesresultad['idRegiones']."' onclick=traerCodigos(".$getRegionesresultad['idRegiones'].");>".$getRegionesresultad['cp']."<input type='hidden' id='idCP".$getRegionesresultad['idRegiones']."' name='idCP".$getRegionesresultad['idRegiones']."' value='".$getRegionesresultad['cp']."'></div>
                                                       <td id='muestraselectcp".$getRegionesresultad['idRegiones']."' style='display: none;'>
                                                       <select style='display: none;' id='selectcp".$getRegionesresultad['idRegiones']."' name='selectcp".$getRegionesresultad['idRegiones']."' onchange='modificarDatosCp(".$getRegionesresultad['idRegiones'].");'> </select>
                                                       </td>";
                
               
                    $botonEliminar;

                $data[] = $nestedData;

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