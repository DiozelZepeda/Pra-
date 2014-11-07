<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// validacion para el modelo de usuario login cambio de clave CRUD
class model_terapeuta extends CI_Model{

	function __construct()
	{
		parent::__construct();	
	}


	function idok($identificador)
	{
		$this->db->setCF('cuentaalumno');
		$row1 = $this->db->query()->get_count($identificador);

		$this->db->setCF('alumnos');
		$row2 = $this->db->query()->get_count($identificador);

		$row = $row1+$row2;

		if($row == 0) 	return true;
		else 			return false;
	}


	function insert_alumno($admin)
	{
		$this->db->setCF('alumnos');
		$columns = array(	'nombre' 		=> 	$admin['nombre'], 
							'sexo'			=>	$admin['sexo'],
							'fnacimiento' 	=> 	$admin['fechanacimiento'],
							'pais' 			=> 	$admin['pais'],
							'diagnostico'	=>	$admin['diagnostico'],
							'tratamiento'	=>	$admin['tratamiento'],
							'escuela'		=>	$admin['escuela'],
							'habilidades'	=>	$admin['habilidades'],
							'creador' 		=>	$admin['creador'],
							'creacion' 		=>	$admin['creacion'] 
						);	

		$this->db->query()->insert($admin['identificador'], $columns);
	}

	function insert_cuentaalumno($registro)
	{
		$this->db->setCF('cuentaalumno');
		$columns = array('pass' 	=> $registro['pass'],
						 'nombre'	=> $registro['nombre'] 
						 );
		$this->db->query()->insert($registro['identificador'], $columns);
	}

	function insert_terapeutaalumno($terapeutaalumno)
	{
		$terapeuta = $this->session->userdata('usuario');

		$this->db->setCF('terapeutaalumno');
		$row = $this->db->query()->get_count($terapeuta);
		$row = $row +1;
		$columns = array(	$row  => $terapeutaalumno['identificador']);
		$this->db->query()->insert($terapeuta, $columns);

	}

	function listar_alumnos($creador)
	{
		$this->db->setCF('terapeutaalumno');
		
		$row 		= $this->db->query()->get_count($creador);
		if ($row == 0)
		{
			return NULL;
		}
		else {
		$users 		= $this->db->query()->get($creador);
		$this->db->setCF('alumnos');
		for ($i = 1; $i <= $row ; $i++) 
		{
			$alumnos = $this->db->query()->get($users[$i]);
			
			if($alumnos)
			{
				$array['identificador'] 		= 	$users[$i];
				$array['nombre'] 				=  	$alumnos['nombre'];
				$array['fnacimiento'] 			=  	$alumnos['fnacimiento'];
				$array['escuela'] 				=  	$alumnos['escuela'];
				$array['pais'] 					=  	$alumnos['pais'];
				$query[$i] 						= 	$array;
    		}
    	}
		return $query;
		}
	}

	function insert_avance($idavance, $avance)
	{
		$this->db->setCF('avance');
		$this->db->query()->insert($idavance, $avance);

	}

	function insert_alumnoavance($alumnoavance, $idavance)
	{
		$this->db->setCF('alumnoavance');
		$row = $this->db->query()->get_count($alumnoavance['identificador']);
		$columns = array( $row+1 => $idavance );
		$this->db->query()->insert($alumnoavance['identificador'], $columns);
	}



	function terapeuta_alumno($identificador)
	{
		$this->db->setCF('alumnos');
		$admin = $this->db->query()->get($identificador);
		return $admin;
	}


	function insert_modificaravance($identificador, $alumnos)
	{
		$this->db->setCF('alumnos');
		$this->db->query()->insert($identificador, $alumnos);
	}







function listar_avances($alumno)
	{
		$this->db->setCF('alumnoavance');
		$row 		= $this->db->query()->get_count($alumno);
		if ($row == 0)
		{
			return NULL;
		}
		else {

		$users 		= $this->db->query()->get($alumno);


		printf($row);
		$this->db->setCF('avance');
		for ($i = 1; $i <= $row ; $i++) 
		{
			$alumnos = $this->db->query()->get($users[$i]);
			
			if($alumnos)
			{
				$array['identificador'] 		= 	$users[$i];
				$array['objetivo'] 				=  	$alumnos['objetivo'];
				$array['descripcion'] 			=  	$alumnos['descripcion'];
				$array['habilidad'] 			=  	$alumnos['habilidad'];
				$array['asistencia'] 			=  	$alumnos['asistencia'];
				$array['fecha'] 				=  	$alumnos['fecha'];
				$query[$i] 						= 	$array;
    		}

    	}
		return $query;
		//print_r($query);
	}
}

/* POPUP QUE MUESTRA LA HABILIDAD INGRESADA. */
function consulta_habilidad($identificador)
{
	$this->db->setCF('habilidades');
	$habilidad = $this->db->query()->get($identificador);
	return $habilidad;
}


/* POPUP QUE MUESTRA LA HABILIDAD INGRESADA. */
function consulta_indicadores($alumno)
{
	$this->db->setCF('alumnoindicador');
	$users 		= $this->db->query()->get($alumno);
	$row 		= $this->db->query()->get_count($alumno);


	$this->db->setCF('indicadores');
	for ($i = 1; $i <= $row ; $i++) 
	{
		$alumnos = $this->db->query()->get($users[$i]);
		if($alumnos)
		{
				$array['identificador'] 		= 	$users[$i];
				$array['aplicacion'] 			=  	$alumnos['aplicacion'];
				$array['descripcion'] 			=  	$alumnos['descripcion'];
				$array['fecha'] 				=  	$alumnos['fecha'];
				$array['habilidad'] 			=  	$alumnos['habilidad'];
				$array['indicador'] 			=  	$alumnos['indicador'];
				$query[$i] 						= 	$array;
    	}
    }
		return $query;
	
}






/**********************************************************************

INSERTAR NUEVAS HABILIDADES QUE PUEDEN SER UTILIZADAS POR LOS ESPECIALISTAS

**********************************************************************/
 function insert_habilidad($habilidad)
 {
 	$this->db->setCF('habilidades');
		$columns = array('nombre' 		=> $habilidad['nombre'],
						 'descripcion'	=> $habilidad['descripcion'],
						 'creador'		=> $habilidad['creador'] ,
						 'creacion'		=> $habilidad['creacion']
						 );
		$this->db->query()->insert($habilidad['identificador'], $columns);
 }

function insert_clavehabilidad($clavehabilidades)
{
		$this->db->setCF('clavehabilidades');
		$row = $this->db->query()->get_count('Habilidades');
		$row = $row +1;
		$columns = array(	$row  => $clavehabilidades['identificador']);
		$this->db->query()->insert('Habilidades', $columns);
}

function habilidades_listar()
{
	$this->db->setCF('clavehabilidades');
	$users 		= $this->db->query()->get('Habilidades');
	$row 		= $this->db->query()->get_count('Habilidades');

	$this->db->setCF('habilidades');
	for ($i = 1; $i <= $row ; $i++) 
	{
		$alumnos = $this->db->query()->get($users[$i]);
			$array['identificador'] 		= 	$users[$i];
			$array['nombre'] 				=  	$alumnos['nombre'];
			$array['descripcion'] 			=  	$alumnos['descripcion'];
			$query[$i] 						= 	$array;
    }
	return $query;
}

function habilididad_especifica($identificador)
{
	$this->db->setCF('habilidades');
	$habilidad = $this->db->query()->get($identificador);

			$array['nombre'] 				=  	$habilidad['nombre'];
			$array['descripcion'] 			=  	$habilidad['descripcion'];
			$query 	= 	$array;
	return $query;
}


function habilidad_insertmodificar($identificador, $array)
{
	$this->db->setCF('habilidades');
	$this->db->query()->insert($identificador, $array);

}

/**********************************************************************

CIERRE FUNCIONES QUE INGRESAM Y MODIFICAN HABILIDADDES DISPONIBLE SOLO PARA TERAPEUTAS.

**********************************************************************/











}