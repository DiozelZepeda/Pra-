<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->library('usuariolib'); 
		
		$this->form_validation->set_message('required','Debe ingresar un valor para %s');
		$this->form_validation->set_message('loginok','Usuario y/o Clave incorrectos');
		$this->form_validation->set_message('numeric','Caracteres no validos');

		$this->form_validation->set_message('min_length[6]','El campo %s debe tener almenos 6 caracteres');
		$this->form_validation->set_message('max_length[10]','El campo %s debe tener a lo mas 10 caracteres');
        $this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto');

	}


//pagina de inicio para todo tipo de usuario 
	public function index()
	{
		$data['contenido'] = '/home/index';
		$data['titulo'] = 'Inicio';
		$this->load->view('template/page', $data);
	}

	public function bienvenida()
	{
		$data['contenido'] = '/template/bienvenida';
		$data['titulo'] = 'Inicio';
		$this->load->view('template/page', $data);
	}

	public function acerca_de()
	{
		$data['contenido'] = '/home/acerca_de';
		$data['titulo'] = 'Inicio';
		$this->load->view('template/page', $data);
	}

	public function salir()
	{
		$this->session->sess_destroy();
		redirect('home/index');
	}







//FUNCION QUE TOMA LOS DATOS INSERTADOS PARA INICIAR SESSION Y CONSULTA POR ELLOS DENTRO DE LA BASE DE DATOS.
	public function ingresar()
	{
		$usuario = $this->input->post('login');
		$password = $this->input->post('password');
	
		// validaciones de formulario 
		$this->form_validation->set_rules('login', 'usuario', 'required||valid_email|trim|callback_loginok');
		$this->form_validation->set_rules('password', 'clave', 'required|numeric|min_length[6]|max_length[10]');

		if($this->form_validation->run() == FALSE)
		{
			$this->index();
		}
		else
		{
			redirect('/home/bienvenida');
		}
	}


//FUNCION QUE COMPRUEBA SI EL USUARIO, ESTA DENTRO DE LA BASE DE DATOS CALLBACK_LOGINOK DENTRO DEL REQUIRED.
	public function loginok()
	{
		$usuario = $this->input->post('login');
		$password = $this->input->post('password');
		return $this->model_usuario->get_login($usuario, $password);
	}
}
