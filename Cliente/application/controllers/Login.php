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
				$nombreCliente= $result->nombreCliente;
				$idCliente=$result->idCliente;
				

				$this->session->set_userdata("idCliente",$idCliente);
				$this->session->set_userdata("nombreCliente",$_POST['username']);//Generamos la variable de usuario
				// $this->session->set_userdata("nombreUser",$name);//Generamos la variable de usuario
				
				// session_start();
				$_SESSION['idCliente']=$idCliente;
			
				$_SESSION['nombreCliente']=$nombreCliente;
				
				redirect('menus');
			}
			else
			{	
				$this->session->set_flashdata('mensaje','true');
				echo "<script>
				var r =confirm('El usuario o Contraseña es incorrecta.');
          if (r == true){
          	location.href='https://cointic.com.mx/preveer/Cliente/';
             
          }else{
          	location.href='https://cointic.com.mx/preveer/Cliente/';}</script>";

			}
		}
		else
		{
			$this->load->view('login_view');
		}
		
	}

	function logout(){
  $this->session->sess_destroy();
  redirect('https://cointic.com.mx/preveer/Cliente/');
 }
}