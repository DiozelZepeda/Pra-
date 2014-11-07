<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Terapeuta extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();


		$this->form_validation->set_message('required','Debe ingresar un valor para %s');
		$this->form_validation->set_message('idok','identificador, ya esta registrado');
		$this->form_validation->set_message('numeric','Caracteres no validos');

		$this->form_validation->set_message('min_length[6]','El campo %s debe tener almenos 6 caracteres');
		$this->form_validation->set_message('max_length[10]','El campo %s debe tener a lo mas 10 caracteres');
        $this->form_validation->set_message('valid_email','El campo %s debe ser un email correcto');
	}


/***************************************************************************

FUNCION CALLBACK QUE COMPRUEBA SI EXISTE O NO LA IDE ASIGNADA AL ALUMNO

***************************************************************************/
	public function idok()
	{
		$identificador = $this->input->post('identificador');
		return $this->model_terapeuta->idok($identificador);
	}


/***************************************************************************

FUNCION QUE CARGA LA VISTA DE INGRESAR UN NUEVO ALUMNO A LA BASE DE DATOS

***************************************************************************/


// FUNCIONES DEL TERAPEUTA PARA CREAR NUEVOS ADMINISTRADORES.
	public function terapeuta_crear()
	{
		$data['contenido'] = '/terapeuta/crear';
		$data['titulo'] = 'Crear alumno';
		$this->load->view('template/page', $data);
	}


// VALIDACION DE FORMULARIO Y POSTERIOR INSERCION DENTRO DE LA BASE DE DATOS.
	public function insert_alumno()
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('fnacimiento', 'fnacimiento', 'required');
		$this->form_validation->set_rules('identificador', 'identificador', 'required|callback_idok');
		$this->form_validation->set_rules('pass', 'pass', 'required|numeric|min_length[6]|max_length[10]');

		if($this->form_validation->run() == FALSE){
			$this->terapeuta_crear();
		}
		else{

			// arreglo que inserta en tabla cuenta de usuario 
			$registro['identificador'] 		= $this->input->post('identificador');
				$registro['pass'] 			= $this->input->post('pass');
				$registro['nombre'] 		= $this->input->post('nombre');


			// tabla parcial para almacenar los identificadores asociados a un terapeuta 
			$terapeutaalumno['creador'] 			= $this->session->userdata('usuario');
				$terapeutaalumno['identificador'] 	= $this->input->post('identificador');


			// arreglo que inserta en tabla investigador
			$admin['identificador'] 		= $this->input->post('identificador');
				$admin['creador'] 			= $this->session->userdata('usuario');
				$admin['creacion'] 			= date('Y/m/d H:i');
				$admin['nombre'] 			= $this->input->post('nombre');
				$admin['sexo'] 				= $this->input->post('sexo');
				$admin['fechanacimiento']   = $this->input->post('fnacimiento');
				$admin['diagnostico'] 		= $this->input->post('diagnostico');
				$admin['tratamiento'] 		= $this->input->post('tratamiento');
				$admin['escuela'] 			= $this->input->post('escuela');
				$admin['habilidades'] 		= $this->input->post('habilidades');
				$admin['pais'] 				= $this->input->post('pais');


			//pasar el arreglo al modelo de usuario que se encarga de insertar.
			$this->model_terapeuta->insert_alumno($admin);
			$this->model_terapeuta->insert_cuentaalumno($registro);
			$this->model_terapeuta->insert_terapeutaalumno($terapeutaalumno);
			echo "<script> alert('Alumno Creador Satisfactoriamente');
			window.location.href='terapeuta_crear';
			</script>";

		}

	}


// FUNCION QUE LISTA LOS USUARIOS ASOCIADOS AL TERAPEUTA QUE INICIO SESION
	public function terapeuta_listar()
	{
		$creador = $this->session->userdata('usuario');
		$data['contenido'] = '/terapeuta/listar';
		$data['titulo'] = 'Listas alumnos';
		$data['query'] = $this->model_terapeuta->listar_alumnos($creador);
		$this->load->view('template/page', $data);

		//print_r($data['query']);
		if($data['query'] == NULL){
			echo "<script> alert('No tiene alumnos');</script>";
		}
	}

	

	public function terapeuta_listar2()
	{
		$creador = $this->session->userdata('usuario');
		$data['contenido'] = '/terapeuta/listar2';
		$data['titulo'] = 'Listas alumnos';
		$data['query'] = $this->model_terapeuta->listar_alumnos($creador);
		$this->load->view('template/page', $data);

		if($data['query'] == NULL){
			echo "<script> alert('No tiene alumnos');</script>";
		}
	}


/**********************************************************************

FUNCION PARA INSERTAR UN AVANCE DE UN ALUMNO EN ESPECIFICO
**********************************************************************/

	public function terapeuta_avance()
	{
		$identificador 		= 	$this->input->post('identificador');
		$terapeuta 			=	$this->session->userdata('usuario');

		$data['contenido'] 		= '/terapeuta/avance';
		$data['titulo'] 		= 'Ingreso Avance';
		$data['terapeuta']		= $terapeuta;
		$data['identificador'] 	= $identificador;
		$data['habilidad'] 		= $this->model_terapeuta->habilidades_listar();
		$this->load->view('template/page', $data);
	}

	public function terapeuta_insertavance()
	{

		$this->form_validation->set_rules('avance', 'avance', 'required');
		$this->form_validation->set_rules('terapeuta', 'terapeuta', 'required');
		$this->form_validation->set_rules('identificador', 'identificador', 'required');
		$this->form_validation->set_rules('habilidad', 'habilidad', 'required');
		$this->form_validation->set_rules('objetivo', 'objetivo', 'required');
		$this->form_validation->set_rules('dp1', 'fecha', 'required');
		$this->form_validation->set_rules('asistencia', 'asistencia', 'required');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required');


		if($this->form_validation->run() == FALSE){
			$this->terapeuta_avance();
		}
		else{

			$idavance = $this->input->post('avance');
			$avance = array (	'terapeuta'		=> $this->input->post('terapeuta'),
								'identificador'	=> $this->input->post('identificador'),
								'habilidad'		=> $this->input->post('habilidad'),
								'objetivo'		=> $this->input->post('objetivo'),
								'fecha'			=> $this->input->post('dp1'),
								'asistencia'	=> $this->input->post('asistencia'),
								'descripcion'	=> $this->input->post('descripcion')
								);


			$alumnoavance['identificador'] 		= $this->input->post('identificador');
		
			//insertar en base de datos en tablas (alumnoavance y avance.)
			$this->model_terapeuta->insert_avance($idavance, $avance);
			$this->model_terapeuta->insert_alumnoavance($alumnoavance, $idavance);
			echo "<script> alert('Avance insertado Satisfactoriamente');
			window.location.href='terapeuta_crear';
			</script>";
		}

	}

/**********************************************************************

TERMINO DE FUNCIONES DE INGRESO DE AVANCES
**********************************************************************/








/**********************************************************************

MODIFICAR DATOS DE UN ALUMNO ESPECIFICO

**********************************************************************/
//FUNCION PARA MODIFICAR UN ALUMNOS ASOCIADO A UN TERAPEUTA
	public function terapeuta_modificar()
	{
		$identificador 		= 	$this->input->post('identificador');

		$data['contenido'] 		= '/terapeuta/modificar';
		$data['titulo'] 		= 'Modificar Alumno';
		$data['identificador'] 	= $identificador;
		$data['query'] 			= $this->model_terapeuta->terapeuta_alumno($identificador);

		$this->load->view('template/page', $data);
	}


	public function terapeuta_insertmodificar()
	{
		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('fnacimiento', 'fnacimiento', 'required');
		$this->form_validation->set_rules('diagnostico', 'diagnostico', 'required');
		$this->form_validation->set_rules('tratamiento', 'tratamiento', 'required');
		$this->form_validation->set_rules('habilidades', 'habilidades', 'required');
		$this->form_validation->set_rules('escuela', 'escuela', 'required');


		if($this->form_validation->run() == FALSE)
		{
			$this->terapeuta_modificar();
		}
		else
		{
		
		$identificador = $this->input->post('identificador');
		$alumnos = array(	'nombre' 			=> 	$this->input->post('nombre'),	
						 	'fnacimiento' 		=> 	$this->input->post('fnacimiento'),
						 	'diagnostico' 		=> 	$this->input->post('diagnostico'),
						  	'tratamiento' 		=>	$this->input->post('tratamiento'),
							'habilidades' 		=>	$this->input->post('habilidades'),
							'escuela'			=>	$this->input->post('escuela')
			);


		$this->model_terapeuta->insert_modificaravance($identificador, $alumnos);
		echo "<script> alert('Avance insertado Satisfactoriamente');
			window.location.href='terapeuta_listar';
			</script>";

		}

	}


/**********************************************************************

TERMINO DE FUNCIONES DE MODIFICAR

**********************************************************************/





/**********************************************************************

Listar los avances por alumno 

**********************************************************************/


	public function terapeuta_listaravance()
	{
		$identificador 		= 	$this->input->post('identificador');

		$data['contenido'] 		= '/terapeuta/listar_avances';
		$data['titulo'] 		= 'Avance de alumnos';
		$data['identificador'] 	= $identificador;
		$data['query'] 			= $this->model_terapeuta->listar_avances($identificador);

		//print_r($data);

		$this->load->view('template/page', $data); 

		if($data['query'] == NULL){
			echo "<script> alert('No tiene avances el alumno seleccionado');</script>";
		}
		
	}


	public function terapeuta_consultarhabilidad()
	{
		$identificador 		= 	$this->input->post('type');

		$data['titulo'] 		= 'Consulta Habilidad';
		$data['identificador'] 	= $identificador;
		$data['query'] 			= $this->model_terapeuta->consulta_habilidad($identificador);
		echo $this->load->view('/terapeuta/habilidad_mostrar', $data, true);
		
	}

	public function terapeuta_consultarindicador()
	{
		$identificador 		= 	$this->input->post('identificador');

		$data['contenido'] 		= '/terapeuta/indicador_mostrar';
		$data['titulo'] 		= 'Consulta indicador';
		$data['identificador'] 	= $identificador;
		$data['query'] 			= $this->model_terapeuta->consulta_indicadores($identificador);
		//$this->load->view('template/page', $data);
		
		//echo print_r($data);
	    $this->load->view('template/page', $data);
		
	}










/**********************************************************************

INSERTAR NUEVAS HABILIDADES QUE PUEDEN SER UTILIZADAS POR LOS ESPECIALISTAS

**********************************************************************/

// CARGAR VISTA DE HABILIDAD ( FORMULARIO -> terapeuta, id, nombre, descripción )
	public function terapeuta_habilidad()
	{

		$data['contenido'] = '/terapeuta/habilidad_insert';
		$data['titulo'] = 'Ingresar nueva habilidad';
		$this->load->view('template/page', $data);
	}


// recepccion de los datos provenientes del formulario de insert habilidades (terapeuta_habilidad();)
	public function terapeuta_inserthabilidad()
	{

		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('descripcion', 'descripcion', 'required');
		$this->form_validation->set_rules('identificador', 'identificador', 'required');

		if($this->form_validation->run() == FALSE){
			$this->terapeuta_habilidad();
		}
		else{
			$habilidad['identificador'] 		= $this->input->post('identificador');
				$habilidad['nombre'] 			= $this->input->post('nombre');
				$habilidad['descripcion'] 		= $this->input->post('descripcion');
				$habilidad['creador'] 			= $this->input->post('terapeuta');
				$habilidad['creacion'] 			= date('Y/m/d H:i');


			$clavehabilidades['identificador'] 		= $this->input->post('identificador');

			//pasar el arreglo al modelo de usuario que se encarga de insertar.
			$this->model_terapeuta->insert_habilidad($habilidad);
			$this->model_terapeuta->insert_clavehabilidad($clavehabilidades);
			echo "<script> alert('Habilidad creada Satisfactoriamente');
			window.location.href='terapeuta_crear';
			</script>";
		}
	}

	public function terapeuta_habilidadlistar()
	{
		$data['contenido'] 	= '/terapeuta/habilidad_listar';
		$data['titulo'] 	= 'Listar habilidades';
		$data['query'] 		= $this->model_terapeuta->habilidades_listar();
		$this->load->view('template/page', $data);
	}


	public function habilidad_modificar()
	{
		$identificador 			= $this->input->post('identificador');
		$data['contenido'] 		= '/terapeuta/habilidad_modificar';
		$data['titulo'] 		= 'Modificar habilidades';
		$data['identificador'] 	= $identificador;
		$data['query'] 			= $this->model_terapeuta->habilididad_especifica($identificador);
		$this->load->view('template/page', $data);
	}

	public function habilidad_insertmodificar()
	{
		$identificador 	= $this->input->post('identificador');
		$nombre			= $this->input->post('nombre');
		$descripcion	= $this->input->post('descripcion');

		$array = array (	'nombre' 		=> $nombre,
							'descripcion' 	=> $descripcion
							);
		$this->model_terapeuta->habilidad_insertmodificar($identificador, $array);
		echo "<script> alert('Habilidad modificada satisfactoriamente');
			window.location.href='terapeuta_habilidad';
			</script>";
	}


/**********************************************************************

CIERRE FUNCIONES QUE INGRESAM Y MODIFICAN HABILIDADDES DISPONIBLE SOLO PARA TERAPEUTAS.

**********************************************************************/
	
}
