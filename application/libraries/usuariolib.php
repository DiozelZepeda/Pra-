<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// validacion para el modelo de usuario login cambio de clave CRUD
class usuariolib{

	function __construct()
	{
		$this->CI = & get_instance(); //instancias que carga de la libreria.
		$this->CI->load->model('model_usuario'); 
	}

	public function login ($user, $pass){
		$query = $this->CI->model_usuario->get_login($user,$pass);
		if(!$query)
		{
			$user = array ( 'nombre' => $query[0],
							'usuario' => $user, 
							'tipousuario' => $query[2]);

			$this->CI->session->set_userdata($user);
			return true;
		}

			$this->CI->session->sess_destroy();
			return false;


	}

}