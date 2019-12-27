<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudUsuarios extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("usuarios"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
	    $data['listaUser'] = $this->usuarios->getDatos($index);
		$this->load->view('viewtodousuarios',$data);
	}

	function logout(){
  $this->session->sess_destroy();
  redirect('https://cointic.com.mx/preveer/sistema/');
 }

	public function formAltaUsuario()
	{
    $data['areas'] = $this->usuarios->getAreas();
			$this->load->view('formusuarios',$data);  
	}


	

public function formEditarUsuario()

	{
    // $idUser=$_REQUEST['id'];
    $data = ['areas' => $this->usuarios->getAreas(), 'idUser' => $_REQUEST['id']];
		
			$this->load->view('grideditarusuario',$data); 
	}


public function formDetalleUsuario()

  {
    // $idUser=$_REQUEST['id'];
    $data = ['areas' => $this->usuarios->getAreas(), 'idUser' => $_REQUEST['id']];
    
      $this->load->view('griddetalleusuario',$data); 
  }

  
	function obtenerDatos($idu)
	{
		
    	$prueba= $this->usuarios->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

  function getcamb($idu)
  {
      $prueba= $this->usuarios->obtenerFicha($idu);
      echo json_encode ($prueba);
  }

   function verificarDatos()
  {
      $nickUser = $this->input->post('nickUser');
      $correoUser = $this->input->post('correoUser');

      $prueba= $this->usuarios->obtenerUser($nickUser,$correoUser);
      echo json_encode ($prueba);
  }

  function verificarDatosEditados()
  {
      $nickUser = $this->input->post('nickUser');
      $correoUser = $this->input->post('correoUser');
      $idUser = $this->input->post('idUser');
      $prueba= $this->usuarios->obtenerUserEditado($nickUser,$correoUser,$idUser);
      echo json_encode ($prueba);
  }

  function ModPassword($newContra,$idUser)
  {
    $uno=1;
    $data = array(  
      'password' => $newContra,
      'cambio' => $uno
      );
      $this->usuarios->modificaPassword($data,$idUser);
      echo "1";
  }

	function modificarDatos(){

		  $nombre_archivoima = $_FILES['foto']['name'];
			$tipo_archivoima = $_FILES['foto']['type'];
			$tamano_archivoima = $_FILES['foto']['size'];
			$temp_archivoima = $_FILES['foto']['tmp_name'];
			$idUser = $this->input->post('idUser');

			$foto=$nombre_archivoima;

			$fotoBase=$_POST['fotoBase'];
			//echo "foto $fotoBase";
			$ruta="assets/img/fotoUser/".$nombre_archivoima;
		if($nombre_archivoima==""){
			$data = array(	
			'nombre' => $this->input->post('nombreUser'),
			'rfcUser' => $this->input->post('rfcUser'),
      'curpUser' => $this->input->post('curpTrabajador'),
      'areaUser' => $this->input->post('idArea'),
      'telefonoOficina' => $this->input->post('numeroOficin'),
      'ContactoEmergencia' => $this->input->post('contaEmerge'),
      'padecimientoUser' => $this->input->post('padeciUser'),
      'direccion' => $this->input->post('DireccionUser'),
			'correo' => $this->input->post('correoUser'),
			'telefono' => $this->input->post('telefonoUser')
			);
			$this->usuarios->modificaDatos($data,$idUser);

			$dataP = array(	
			'nickName' => $this->input->post('nickUser'),
			'password' => $this->input->post('passwordUser'),
			'tipo' => $this->input->post('tipoUser')
			);
			$this->usuarios->modificaDatosPuente($dataP,$idUser);


			}
			else
			{	
				if ($fotoBase=="") {
					if ((file_exists ($ruta) && $nombre_archivoima !="" ))
           					{
            					echo "";
           					}
           					else
           					{
           			move_uploaded_file($temp_archivoima, "assets/img/fotoUser/".$nombre_archivoima);
 								$data = array(	
								'nombre' => $this->input->post('nombreUser'),
								'foto' => $foto,
                'rfcUser' => $this->input->post('rfcUser'),
                'curpUser' => $this->input->post('curpTrabajador'),
                'areaUser' => $this->input->post('idArea'),
                'telefonoOficina' => $this->input->post('numeroOficin'),
                'ContactoEmergencia' => $this->input->post('contaEmerge'),
                'padecimientoUser' => $this->input->post('padeciUser'),
								'direccion' => $this->input->post('DireccionUser'),
								'correo' => $this->input->post('correoUser'),
								'telefono' => $this->input->post('telefonoUser')
								);
								$this->usuarios->modificaDatos($data,$idUser);
								$dataP = array(	
								'nickName' => $this->input->post('nickUser'),
								'password' => $this->input->post('passwordUser'),
								'tipo' => $this->input->post('tipoUser')
								);
								$this->usuarios->modificaDatosPuente($dataP,$idUser);
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
           						unlink('assets/img/fotoUser/'.$fotoBase); //borra el archivo anterior
           						move_uploaded_file($temp_archivoima, "assets/img/fotoUser/".$nombre_archivoima);
 								$data = array(	
								'nombre' => $this->input->post('nombreUser'),
								'foto' => $foto,
                'rfcUser' => $this->input->post('rfcUser'),
                'curpUser' => $this->input->post('curpTrabajador'),
                'areaUser' => $this->input->post('idArea'),
                'telefonoOficina' => $this->input->post('numeroOficin'),
                'ContactoEmergencia' => $this->input->post('contaEmerge'),
                'padecimientoUser' => $this->input->post('padeciUser'),
								'direccion' => $this->input->post('DireccionUser'),
								'correo' => $this->input->post('correoUser'),
								'telefono' => $this->input->post('telefonoUser')
								);
								$this->usuarios->modificaDatos($data,$idUser);
								$dataP = array(	
								'nickName' => $this->input->post('nickUser'),
								'password' => $this->input->post('passwordUser'),
								'tipo' => $this->input->post('tipoUser')
								);
								$this->usuarios->modificaDatosPuente($dataP,$idUser);
								echo "";	
           					}
				}


			}

	}
	

	
		function altaUser()
	{	

			$nombre_archivoima = $_FILES['foto']['name'];
			$tipo_archivoima = $_FILES['foto']['type'];
			$tamano_archivoima = $_FILES['foto']['size'];
			$temp_archivoima = $_FILES['foto']['tmp_name'];
			$foto=$nombre_archivoima;

	
			$correoUs = $this->input->post('correoUser');
			$telefonoUse = $this->input->post('telefonoUser');
			$nickUser = $this->input->post('nickUser');
			$passwordUser = $this->input->post('passwordUser');
			//echo "nombre $nombre_archivoima";
			$nombreIden = $this->input->post('nombreUser');
			$rfcUser = $this->input->post('rfcUser');
			if($nombre_archivoima==""){

			$data = array(	
			'nombre' => $this->input->post('nombreUser'),
			'foto' => "null",
      'rfcUser' => $this->input->post('rfcUser'),
      'curpUser' => $this->input->post('curpUser'),
      'areaUser' => $this->input->post('idArea'),
      'telefonoOficina' => $this->input->post('telefoOfici'),
      'ContactoEmergencia' => $this->input->post('contacEmergencia'),
      'padecimientoUser' => $this->input->post('padecimientoUser'),
			'direccion' => $this->input->post('DireccionUser'),
			'correo' => $this->input->post('correoUser'),
			'telefono' => $this->input->post('telefonoUser')
			);
			$this->usuarios->insertaDatos($data);

			$pruebaid= $this->usuarios->obtenerIdUser($nombreIden,$rfcUser);
			foreach ($pruebaid as $row)	{
    			$idUserU= $row['idUsuario'];
    			
    		}

			$cambio=0;
			$dataP = array(	
			'nickName' => $this->input->post('nickUser'),
			'password' => $this->input->post('passwordUser'),
			'tipo' => $this->input->post('tipoUser'),
			'idUsuario' => $idUserU,
			'cambio' => $cambio
			);
			$this->usuarios->insertaDatosPuent($dataP);



			echo "1";
            }
            else
           {
           		 $ruta="assets/img/fotoUser/".$nombre_archivoima;
           		// move_uploaded_file($temp_archivoima, "assets/images/user/".$nombre_archivoima);
           		if ((file_exists ($ruta) && $nombre_archivoima !="" ))
           		{
           			$data = array(	
					'nombre' => $this->input->post('nombreUser'),
					'foto' => "null",
					'rfcUser' => $this->input->post('rfcUser'),
          'curpUser' => $this->input->post('curpUser'),
          'areaUser' => $this->input->post('idArea'),
          'telefonoOficina' => $this->input->post('telefoOfici'),
          'ContactoEmergencia' => $this->input->post('contacEmergencia'),
          'padecimientoUser' => $this->input->post('padecimientoUser'),
          'direccion' => $this->input->post('DireccionUser'),
          'correo' => $this->input->post('correoUser'),
          'telefono' => $this->input->post('telefonoUser')
					);
					$this->usuarios->insertaDatos($data);
					
					$pruebaid= $this->usuarios->obtenerIdUser($nombreIden,$rfcUser);
					foreach ($pruebaid as $row)	{
		    			$idUserU= $row['idUsuario'];
		    			//echo "sacar el ultimo ".$idUserU;
		    		}

					$cambio=0;
					$dataP = array(	
					'nickName' => $this->input->post('nickUser'),
					'password' => $this->input->post('passwordUser'),
					'tipo' => $this->input->post('tipoUser'),
					'idUsuario' => $idUserU,
					'cambio' => $cambio
					);
					$this->usuarios->insertaDatosPuent($dataP);
            		echo "2";
           		}
           		else
           		{

            		move_uploaded_file($temp_archivoima, "assets/img/fotoUser/".$nombre_archivoima);
 					$data = array(	
					'nombre' => $this->input->post('nombreUser'),
					'foto' => $foto,
					'rfcUser' => $this->input->post('rfcUser'),
          'curpUser' => $this->input->post('curpUser'),
          'areaUser' => $this->input->post('idArea'),
          'telefonoOficina' => $this->input->post('telefoOfici'),
          'ContactoEmergencia' => $this->input->post('contacEmergencia'),
          'padecimientoUser' => $this->input->post('padecimientoUser'),
          'direccion' => $this->input->post('DireccionUser'),
          'correo' => $this->input->post('correoUser'),
          'telefono' => $this->input->post('telefonoUser')
					);
					$this->usuarios->insertaDatos($data);

							$pruebaid= $this->usuarios->obtenerIdUser($nombreIden,$rfcUser);
					foreach ($pruebaid as $row)	{
		    			$idUserU= $row['idUsuario'];
		    		}

					$cambio=0;
					$dataP = array(	
					'nickName' => $this->input->post('nickUser'),
					'password' => $this->input->post('passwordUser'),
					'tipo' => $this->input->post('tipoUser'),
					'idUsuario' => $idUserU,
					'cambio' => $cambio
					);
					$this->usuarios->insertaDatosPuent($dataP);
					echo "1";
		               }

            }
            date_default_timezone_set("America/Mexico_City");
            setlocale(LC_TIME, 'es_ES.UTF-8');
                $fechaSoli=date("Y-m-d"); 
                $fecha4=strftime("%d-%B-%Y",strtotime($fechaSoli));

            $mensaje = "
 <html xmlns='http://www.w3.org/1999/xhtml'>
    <head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
      <title>Correo de confirmación</title>
      <style type='text/css'>
      body {
       padding-top: 0 !important;
       padding-bottom: 0 !important;
       padding-top: 0 !important;
       padding-bottom: 0 !important;
       margin:0 !important;
       width: 100% !important;
       -webkit-text-size-adjust: 100% !important;
       -ms-text-size-adjust: 100% !important;
       -webkit-font-smoothing: antialiased !important;
     }
     .tableContent img {
       border: 0 !important;
       display: block !important;
       outline: none !important;
     }
     a{
      color:#382F2E;
    }
    p, h1{
      color:#382F2E;
      margin:0;
    }
 p{
      text-align:left;
      color:#999999;
      font-size:14px;
      font-weight:normal;
      line-height:19px;
    }
    a.link1{
      color:#382F2E;
    }
    a.link2{
      font-size:16px;
      text-decoration:none;
      color:#ffffff;
    }
    h2{
      /*text-align:left;*/
       color:#222222; 
       font-size:19px;
      font-weight:normal;
    }
    div,p,ul,h1{
      margin:0;
    }
    .bgBody{
      background: #ffffff;
    }
    .bgItem{
      background: #ffffff;
    }
    </style>
<script type='colorScheme' class='swatch active'>
{
    'name':'Default',
    'bgBody':'ffffff',
    'link':'382F2E',
    'color':'999999',
    'bgItem':'ffffff',
    'title':'222222'
}
</script>
  </head>
  <body paddingwidth='0' paddingheight='0'   style='padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;' offset='0' toppadding='0' leftpadding='0'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0' class='tableContent bgBody' align='center'  style='font-family:Helvetica, Arial,serif;'>
      <tr><td height='35'></td></tr>
      <tr>
        <td>
          <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='bgItem'>
            <tr>
              <td width='40'></td>
              <td width='520'>
                <table width='520' border='0' cellspacing='0' cellpadding='0' align='center'>
<!-- =============================== Header ====================================== -->           
                  <tr><td height='75'></td></tr>
<!-- =============================== Body ====================================== -->
                  <tr>
                    <td class='movableContentContainer' valign='top'>
                      <div lass='movableContent'>
                        <table width='520' border='0' cellspacing='0' cellpadding='0' align='center'>
                          <tr>
                            <td valign='top' align='center'>
                              <div class='contentEditableContainer contentTextEditable'>
                                <div class='contentEditable'>
                                  <p style='text-align:center;margin:0;font-family:Futura-Condensed-regular;font-size:26px;color:#b81e25;line-height: 25px;padding-bottom: 10px;'>Cuenta registrada <span style='color:#000;'>Preveer.</span></p>
                                  <img class='logo' src='https://cointic.com.mx/preveer/sistema/assets/img/logo-preveer.png' alt='logo' width='350' height='110'/>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div lass='movableContent'>
                        <table width='520' border='0' cellspacing='0' cellpadding='0' align='center'>
                          <tr>
                            <td valign='top' align='center'>
                              <div class='contentEditableContainer contentImageEditable'>
                                <div class='contentEditable'>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class='movableContent'>
                        <table width='520' border='0' cellspacing='0' cellpadding='0' align='center'>
                          <tr><td height='15'></td></tr>
                          <tr>
                            <td align='left'>
                              <div class='contentEditableContainer contentTextEditable'>
                                <div class='contentEditable' align='center'>
                                  <h2>Su cuenta se ha registrado para acceder al sistema <a href=''>https://cointic.com.mx/preveer/sistema/</a></h2>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                          <div class='contentEditableContainer contentTextEditable'>
                            <div class='contentEditable' align='center'>
                               <p>
                               
                                 <font color='#2d3920'>Fecha de registro:</font> $fecha4 <br/>
                                  <font color='#2d3920'>Nombre del usuario:</font> $nombreIden <br/>
                                 <font color='#2d3920'>Correo del usuario:</font> $correoUs <br/>
                                  <font color='#2d3920'>Teléfono del usuario:</font> $telefonoUse <br/>
                               </p>
                               <h2>Datos para ingresar al sistema.</h2>
                               <p>
                                 <font color='#2d3920'>Nick:</font> $nickUser <br/>
                                  <font color='#2d3920'>password:</font> $passwordUser <br/>
                                  
                               </p>
                           <div>
                          </div>
                          </tr> 
                          </tr>
                          <tr><td height='15'></td></tr>
                          <tr>
                            <td align='center'>
                              <table>
                                <tr>
                                  <td align='center' bgcolor='#2d3920' style='background:#b81e25; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;'>
                                    <div class='contentEditableContainer contentTextEditable'>
                                      <div class='contentEditable' align='center' style='color:white;'>
                                       Al ingresar al sistema, por favor modifique la contraseña desde 'Mi cuenta'.</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr><td height='20'></td></tr>
                        </table>
                      </div>
                      <div lass='movableContent'>
                        <table width='520' border='0' cellspacing='0' cellpadding='0' align='center'>
                          <tr><td height='65'></td></tr>
                          <tr><td  style='border-bottom:1px solid #DDDDDD;'></td></tr>
                          <tr><td height='25'></td></tr>
                          <tr>
                            <td>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </td>
                  </tr>
<!-- =============================== footer ====================================== -->
                </table>
              </td>
              <td width='40'></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr><td height='88'></td></tr>
    </table>
      </body>
      </html>
";
    
    
      $this->load->library("email");
      $this->email->from("hugoless91@gmail.com",$nombreIden);
      $this->email->to($correoUs);
      $this->email->subject('Cuenta registrada.');
      $this->email->message($mensaje);
      $this->email->set_mailtype('html');
      if ($this->email->send()) {
        //echo "1";
       } 
       else
       {
        //echo "2";
       }
			
	}


	function deleteUser($idUser){

		$this->usuarios->borrarDatos($idUser);
		$this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudusuarios');
		
	}
		

	}

?>