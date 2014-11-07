<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// validacion para el modelo de usuario login cambio de clave CRUD
class model_usuario extends CI_Model{

	function __construct()
	{
		parent::__construct();	
	}



	function get_login($user, $pass)
	{
		$this->db->setCF('cuentausuario');
		$row   = $this->db->query()->get_count($user);
		
		
		if($row != 0)
		{
			$users = $this->db->query()->get($user);
			if($users['pass'] == $pass){
			$user = array ( 
					'nombre' => $users['nombre'],
					'usuario' => $user, 
					'tipousuario' => $users['tipousuario']
					);

			$this->session->set_userdata($user);
			return true;
			}
			else return false;
			
		}
		else 
		{
			$this->session->sess_destroy();
			return false;
		}
	}

}