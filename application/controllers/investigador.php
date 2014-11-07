<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Investigador extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
	}


// FUNCIONES DEL INVESTIGADOR PARA LISTAR 
	public function listar()
	{
		$data['contenido'] = '/investigador/listar';
		$data['titulo'] = 'Listar avances';
		$this->load->view('template/page', $data);
	}

}


