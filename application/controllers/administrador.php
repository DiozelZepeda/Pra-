<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrador extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();

		$this->form_validation->set_message('required','Debe ingresar un valor para %s');
		$this->form_validation->set_message('correook','Correo electronico, ya esta registrado');
		$this->form_validation->set_message('numeric','Caracteres no validos');

		$this->form_validation->set_message('min_length[6]','El campo %s debe tener almenos 6 caracteres');
		$this->form_validation->set_message('max_length[10]','El campo %s debe tener a lo mas 10 caracteres');
        $this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto');
	}



/***************************************************************************

FUNCION CALLBACK QUE COMPRUEBA SI EXISTE O NO EL CORREO QUE QUIERO REGISTRARSE

***************************************************************************/
	public function correook()
	{
		$correo = $this->input->post('correo');
		return $this->model_administrador->correook($correo);
	}







/***************************************************************************

FUNCIONES DEL ADMINISTRADOR PARA CREAR NUEVOS ADMINISTRADORES.

***************************************************************************/
	public function administrador_crear()
	{
		$data['contenido'] = '/administrador/administrador/crear';
		$data['titulo'] = 'Crear Administrador';
		$this->load->view('template/page', $data);
	}

	public function insert_administrador()
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('url', 'url', 'required');
		$this->form_validation->set_rules('correo', 'correo', 'required|valid_email|trim|callback_correook');
		$this->form_validation->set_rules('pass', 'pass', 'required|numeric|min_length[6]|max_length[10]');

		if($this->form_validation->run() == FALSE)
		{
			$this->administrador_crear();
		}
		else
		{
			// arreglo que inserta en tabla administrador 
			$registro['correo'] 			= $this->input->post('correo'); 
				$registro['nombre'] 			= $this->input->post('nombre');
				$registro['pass'] 				= $this->input->post('pass');
				$registro['tipousuario'] 		= $this->input->post('tipousuario');


			// arreglo que inserta en tabla cuenta de usuario 
			$admin['correo'] 				= $this->input->post('correo');
				$admin['creador'] 				= $this->session->userdata('usuario');
				$admin['creacion'] 				= date('Y/m/d H:i');
				$admin['nombre'] 				= $this->input->post('nombre');
				$admin['url'] 					= $this->input->post('url');
				$admin['pais'] 					= $this->input->post('pais');

			//pasar el arreglo al modelo de usuario que se encarga de insertar.
			$this->model_administrador->insert_cuentausuario($registro);
			$this->model_administrador->insert_listausuario($registro);
			$this->model_administrador->insert_administrador($admin);
		
			echo "<script> alert('Usuario Creador Satisfactoriamente');
			window.location.href='administrador_crear';
			</script>";
		}
	}




//Funcion que accede a los modelos para listar los administradores.
	public function administrador_listar()
	{
		$tipousuario = 'Administrador';

		$data['contenido'] = '/administrador/administrador/listar';
		$data['titulo'] = 'Listar Administradores';
		$data['query'] = $this->model_administrador->listar_administrador($tipousuario);
		$this->load->view('template/page', $data);
	}



//Vista que modifica un registro 
	public function administrador_modificar()
	{
		$correo = $this->input->post('correo');

		$data['contenido'] = '/administrador/administrador/modificar';
		$data['titulo'] = 'Editar administrador';
		$data['correo'] = $correo;
		$data['query'] = $this->model_administrador->modificar_administrador($correo);
		$this->load->view('template/page', $data);
	}

	public function administrador_insertmodificar()
	{
		$correo = $this->input->post('correo');
		$nombre = $this->input->post('nombre');
		$url 	= $this->input->post('url');

		$administrador = array(	'nombre' 	=> $nombre,
						  		'url' 		=> $url);

		$cuentausuario = array('nombre' 	=> $nombre );

		$this->model_administrador->insert_modificar($correo, $administrador, $cuentausuario);

		echo "<script> alert('Usuario modificado Satisfactoriamente');
			window.location.href='administrador_crear';
			</script>";

	}


// FUNCION QUE ELIMINA UN ADMINISTRADOR
	public function administrador_eliminar()
	{
		$correo = $this->input->post('correo');
		$this->model_administrador->eliminar_administrador($correo);
		echo "<script> alert('Administrador eliminado Satisfactoriamente');
			window.location.href='administrador_crear';
			</script>";
	}













/***************************************************************************

FUNCIONES DEL ADMINISTRADOR PARA CREAR NUEVOS INVESTIGADORES.

***************************************************************************/


// FUNCIONES DEL ADMINISTRADOR PARA CREAR NUEVOS INVESTIGADORES
	public function investigador_crear()
	{
		$data['contenido'] = '/administrador/investigador/crear';
		$data['titulo'] = 'Crear Investigador';
		$this->load->view('template/page', $data);
	}

	public function insert_investigador()
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('institucion', 'institucion', 'required');
		$this->form_validation->set_rules('url', 'url', 'required');
		$this->form_validation->set_rules('motivo', 'motivo', 'required');
		$this->form_validation->set_rules('correo', 'correo', 'required|valid_email|trim|callback_correook');
		$this->form_validation->set_rules('pass', 'pass', 'required|numeric|min_length[6]|max_length[10]');

		if($this->form_validation->run() == FALSE)
		{
			$this->investigador_crear();
		}
		else{

			// arreglo que inserta en tabla cuenta de usuario 
			$registro['correo'] 			= $this->input->post('correo'); 
				$registro['nombre'] 			= $this->input->post('nombre');
				$registro['pass'] 				= $this->input->post('pass');
				$registro['tipousuario'] 		= $this->input->post('tipousuario');


			// arreglo que insertasele en tabla investigador
			$admin['correo'] 				= $this->input->post('correo');
				$admin['creador'] 				= $this->session->userdata('usuario');
				$admin['creacion']	 			= date('Y/m/d H:i');
				$admin['nombre'] 				= $this->input->post('nombre');
				$admin['pais'] 					= $this->input->post('pais');
				$admin['institucion'] 			= $this->input->post('institucion');
				$admin['url'] 					= $this->input->post('url');
				$admin['motivoinvestigacion'] 	= $this->input->post('motivo');

			//pasar el arreglo al modelo de usuario que se encarga de insertar.
			$this->model_administrador->insert_cuentausuario($registro);
			$this->model_administrador->insert_listausuario($registro);
			$this->model_administrador->investigador_insert($admin);
			
			echo "<script> alert('Usuario Creador Satisfactoriamente');
			window.location.href='investigador_crear';
			</script>";
		}
	}


//FUNCION PARA LISTAR LOS TERAPEUTAS, YA INGRESADOS Y PASARLOS A LA VISTA LISTAR.
	public function investigador_listar()
	{
		$tipousuario = 'Investigador';

		$data['contenido'] = '/administrador/investigador/listar';
		$data['titulo'] = 'Listar Investigadores';
		$data['query'] = $this->model_administrador->listar_investigador($tipousuario);
		$this->load->view('template/page', $data);
	}




	public function investigador_modificar()
	{
		$correo = $this->input->post('correo');

		$data['contenido'] = '/administrador/investigador/modificar';
		$data['titulo'] = 'Modificar investigador';
		$data['correo'] = $correo;
		$data['query'] = $this->model_administrador->modificar_investigador($correo);
		$this->load->view('template/page', $data);
	}


	public function investigador_insertmodificar()
	{
		$correo 				= $this->input->post('correo');
		$nombre 				= $this->input->post('nombre');
		$institucion 			= $this->input->post('institucion');
		$url 					= $this->input->post('url');
		$motivoinvestigacion 	= $this->input->post('motivoinvestigacion');

		$update = array(	'nombre' 				=> $nombre,
								'institucion'			=> $institucion,
						  		'url' 					=> $url,
						  		'motivoinvestigacion'	=> $motivoinvestigacion
						  		);

		$nombreupdate = array('nombre' 				=> $nombre );

		$this->model_administrador->insert_modificarinvestigador($correo, $update, $nombreupdate);

		echo "<script> alert('Usuario modificado Satisfactoriamente');
			window.location.href='administrador_crear';
			</script>";

	}

// FUNCION QUE ELIMINA UN ADMINISTRADOR
	public function investigador_eliminar()
	{
		$correo = $this->input->post('correo');
		$this->model_administrador->eliminar_investigador($correo);
		echo "<script> alert('Investigador eliminado Satisfactoriamente');
			window.location.href='administrador_crear';
			</script>";
	}






/***************************************************************************

FUNCIONES DEL ADMINISTRADOR PARA CREAR NUEVOS TERAPEUTA.

***************************************************************************/



// FUNCIONES DEL ADMINISTRADOR PARA CREAR NUEVOS TERAPEUTAS
	public function terapeuta_crear()
	{
		$data['contenido'] = '/administrador/terapeuta/crear';
		$data['titulo'] = 'Crear Terapeuta';
		$this->load->view('template/page', $data);
	}

	public function insert_terapeuta()
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('titulo', 'titulo', 'required');
		$this->form_validation->set_rules('institucion', 'institucion', 'required');
		$this->form_validation->set_rules('especializacion', 'especializacion', 'required');
		$this->form_validation->set_rules('correo', 'correo', 'required|valid_email|trim|callback_correook');
		$this->form_validation->set_rules('pass', 'pass', 'required|numeric|min_length[6]|max_length[10]');

		if($this->form_validation->run() == FALSE)
		{
			$this->terapeuta_crear();
		}
		else
		{
			// arreglo que inserta en tabla cuenta de usuario y listausuario
			$registro['correo'] 			= $this->input->post('correo');
				$registro['nombre'] 			= $this->input->post('nombre');
				$registro['pass'] 				= $this->input->post('pass');
				$registro['tipousuario'] 		= $this->input->post('tipousuario');

			// arreglo que inserta en tabla terapeuta 
			$admin['correo'] 				= $this->input->post('correo');
				$admin['creador'] 			= $this->session->userdata('usuario');
				$admin['creacion'] 			= date('Y/m/d H:i');
				$admin['nombre'] 			= $this->input->post('nombre');
				$admin['titulo'] 			= $this->input->post('titulo');
				$admin['institucion'] 		= $this->input->post('institucion');
				$admin['especializacion']	= $this->input->post('especializacion');
				$admin['pais'] 				= $this->input->post('pais');

			

			//pasar el arreglo al modelo de usuario que se encarga de insertar.

			$this->model_administrador->insert_cuentausuario($registro);
			$this->model_administrador->insert_listausuario($registro);
			$this->model_administrador->terapeuta_insert($admin);
		
			echo "<script> alert('Usuario Creador Satisfactoriamente');
			window.location.href='administrador_crear';
			</script>";
		}	
	}


//FUNCION PARA LISTAR LOS TERAPEUTAS, YA INGRESADOS Y PASARLOS A LA VISTA LISTAR.
	public function terapeuta_listar()
	{
		$tipousuario = 'Terapeuta';

		$data['contenido'] = '/administrador/terapeuta/listar';
		$data['titulo'] = 'Listar Terapeutas';
		$data['query'] = $this->model_administrador->listar_terapeuta($tipousuario);
		$this->load->view('template/page', $data);
	}


public function terapeuta_modificar()
	{
		$correo = $this->input->post('correo');

		$data['contenido'] = '/administrador/terapeuta/modificar';
		$data['titulo'] = 'Modificar terapeuta';
		$data['correo'] = $correo;
		$data['query'] = $this->model_administrador->modificar_terapueta($correo);
		$this->load->view('template/page', $data);
	}


public function terapeuta_insertmodificar()
	{
		$correo 				= $this->input->post('correo');
		$nombre 				= $this->input->post('nombre');
		$institucion 			= $this->input->post('institucion');
		$titulo 				= $this->input->post('titulo');
		$especializacion 		= $this->input->post('especializacion');

		$update = array(		'nombre' 					=> $nombre,
								'institucion'				=> $institucion,
						  		'titulo' 					=> $titulo,
						  		'especializacion'			=> $especializacion
						  		);

		$nombreupdate = array('nombre' 				=> $nombre );

		$this->model_administrador->insert_modificarterapeuta($correo, $update, $nombreupdate);

		echo "<script> alert('Usuario modificado Satisfactoriamente');
			window.location.href='terapeuta_listar';
			</script>";

	}

// FUNCION QUE ELIMINA UN ADMINISTRADOR
	public function terapeuta_eliminar()
	{
		$correo = $this->input->post('correo');
		$this->model_administrador->eliminar_terapeuta($correo);
		echo "<script> alert('Investigador eliminado Satisfactoriamente');
			window.location.href='terapeuta_listar';
			</script>";
	}




}