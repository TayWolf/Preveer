<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    public function index()
	{
		if(isset($_POST['password'])) //si la variable contiene algún valor
		{
			$this->load->model("usuarios"); //cargamos el controlador de User
			$result=$this->usuarios->login($_POST['username'],$_POST['password']);
			if($result)//si es verdadero el dato ver el modelo User
			{	
				$name= $result->nickName;
				$tipo=$result->tipo;
				$iduser=$result->idUsuario;
				$cambioPas=$result->cambio;
				$area=$result->areaUser;
				// $foto=$result->fotoUser;

				$this->session->set_userdata("idUsuario",$iduser);
				$this->session->set_userdata("nickName",$_POST['username']);//Generamos la variable de usuario
				// $this->session->set_userdata("nombreUser",$name);//Generamos la variable de usuario
				// $this->session->set_userdata("idUser",$iduser);//Generamos la variable de usuario
				$this->session->set_userdata("fotoUser",$foto);
				$this->session->set_userdata("area",$area);
				//echo "datos entrantes $name $tipo $iduser $foto";
				// session_start();
				$_SESSION['idusuariobase']=$iduser;
				$_SESSION['tipoUser']=$tipo;
				$_SESSION['nombre']=$name;
				$_SESSION['cambioPas']=$cambioPas;
				$_SESSION['area']=$area;

				redirect('menus');
			}
			else
			{	
				$this->session->set_flashdata('mensaje','true');
				echo "<script>
				var r =confirm('El usuario o Contraseña es incorrecta.');
          if (r == true){
          	location.href='https://cointic.com.mx/preveer/sistema/';
             
          }else{
          	location.href='https://cointic.com.mx/preveer/sistema/';}</script>";

			}
		}
		else
		{
			$this->load->view('login_view');
		}
		
	}
}