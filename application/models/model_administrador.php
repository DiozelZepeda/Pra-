<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// validacion para el modelo de usuario login cambio de clave CRUD
class model_administrador extends CI_Model{

	function __construct()
	{
		parent::__construct();	
	}



/* **************************************************************************

INSERTAR EN LA COLUMN FAMILY DE CUENTA USUARIO (CORREO, NOMBRE, CONTRASEÑA, TIPOUSUARIO) . . .

Table: cuentausuario.
	-> Correo
		-> Nombre
		->Contraseña
		->TipoUsuario (Administrador, Terapeuta, Investigador).

************************************************************************** */

	function insert_cuentausuario($registro)
	{
		$this->db->setCF('cuentausuario');
		$columns = array(	'nombre' 		=> $registro['nombre'], 
							'pass' 			=> $registro['pass'], 
							'tipousuario' 	=> $registro['tipousuario']
						);
		$this->db->query()->insert($registro['correo'], $columns);
	}




/***************************************************************************

INSERTAR EN LA COLUNM FAMILY DE LISTA DE USUARIO (TipoUsuario(Terapeuta,administrador,))

Table: listausuario
	-> TipoUsuario(Administrador, Terapeuta, Investigador)
		-> row (0, 1, 2, 3, + +)
		-> correo 

***************************************************************************/
	
	function insert_listausuario($registro)
	{
		$this->db->setCF('listausuario');
		$row = $this->db->query()->get_count($registro['tipousuario']);
		$row = $row +1;
		$columns = array(	$row  => $registro['correo'] );
		$this->db->query()->insert($registro['tipousuario'], $columns);
	}




/***************************************************************************

FUNCION QUER DETERMINA SI EL CORREO INGRESADO, NO ESTA REGISTRADO COMO UN USUARIO
DE LOS DISTINTOS ACTORES (ADMINISTRADOR, INVESTIGADOR, TERAPEUTA).
SE PERMITE UN CORREO PARA CADA CUENTA DE USUARIO .

***************************************************************************/
// comprobar si existe el correo, dentro de las tablas administrador, terapeuta, investigador. 
	function correook($correo)
	{
		$this->db->setCF('investigador');
		$row1 = $this->db->query()->get_count($correo);

		$this->db->setCF('terapeuta');
		$row2 = $this->db->query()->get_count($correo);

		$this->db->setCF('administrador');
		$row3 = $this->db->query()->get_count($correo);

		$row = $row1+$row2+$row3;

		if($row == 0) 	return true;
		else 			return false;
	}








/***************************************************************************

FUNCIONES PARA INSERTAR UN NUEVO USUARIO DENTRO DE LA BASE DE DATOS. 
						(ADMINISTRADOR).

***************************************************************************/
// insertar en la tabla de administrador. 
	function insert_administrador($admin)
	{
		$this->db->setCF('administrador');
		$columns = array(	'nombre' 	=> 	$admin['nombre'], 
							'pais' 		=> 	$admin['pais'],
							'url' 		=> 	$admin['url'],
							'creador' 	=>	$admin['creador'],
							'creacion' 	=>	$admin['creacion'] 
						);	
		$this->db->query()->insert($admin['correo'], $columns);
	}

//FUNCIONES PARA LISTAR LOS ADMINITRADORES.
	function listar_administrador($tipousuario)
	{
		$this->db->setCF('listausuario');
		$listausuario = $this->db->query()->get($tipousuario);
		$row = $this->db->query()->get_count($tipousuario);

		$this->db->setCF('administrador');
		for ($i = 1; $i <= $row ; $i++) 
		{
			$administrador = $this->db->query()->get($listausuario[$i]);
			$query[$i] = array ( 	'correo'	=> $listausuario[$i],
									'nombre'	=> $administrador['nombre'],
									'pais'		=> $administrador['pais'],
									'url'		=> $administrador['url'],
									'creador'	=> $administrador['creador']
								);
    	}
		return $query;
	}

// FUNCION PARA OBTENER USUARIO QUE VA A SER MODIFICADO POR EL ADMINISTRADOR.
	function modificar_administrador($administrador)
	{
		$this->db->setCF('administrador');
		$admin = $this->db->query()->get($administrador);
		return $admin;

	}

	function insert_modificar($correo, $administrador, $cuentausuario)
	{
		$this->db->setCF('administrador');
		$this->db->query()->insert($correo, $administrador);
		$this->db->setCF('cuentausuario');
		$this->db->query()->insert($correo, $cuentausuario);

	}

	function eliminar_administrador($correo)
	{
		$this->db->setCF('administrador');
		$this->db->query()->remove($correo);
		$this->db->setCF('cuentausuario');
		$this->db->query()->remove($correo);

		//actualizar lista de usuario administrador.
		$this->db->setCF('listausuario');
		
		$admin = $this->db->query()->get('Administrador');
		$row = $this->db->query()->get_count('Administrador');

		$b = 1;
		for ($i=1; $i <= $row; $i++)
		{
			if($correo != $admin[$i])
			{
				$a[$b] = $admin[$i];	
				$b++;
			}
		}
		if($row > sizeof($a))
		{
			$this->db->query()->remove('Administrador');
			$this->db->query()->insert('Administrador', $a);
		}

	}




/***************************************************************************

FUNCIONES PARA INSERTAR UN NUEVO USUARIO DENTRO DE LA BASE DE DATOS. 
					( INVESTIGADORES).

***************************************************************************/

// FUNCIONES QUE SE UTILIZAN PARA CREAR, MODIFICAR Y ELIMINAR INVESTIGADORES. 

	function investigador_insert($admin)
	{
		$this->db->setCF('investigador');

		$columns = array(	'creador' 				=>	$admin['creador'],
							'creacion' 				=>	$admin['creacion'],
							'nombre' 				=> 	$admin['nombre'], 
							'pais' 					=> 	$admin['pais'],
							'institucion' 			=> 	$admin['institucion'],
							'url' 					=> 	$admin['url'],
							'motivoinvestigacion'	=>	$admin['motivoinvestigacion']
						);	

		$this->db->query()->insert($admin['correo'], $columns);
	}


	function listar_investigador($tipousuario)
	{
		$this->db->setCF('listausuario');
		$listausuario = $this->db->query()->get($tipousuario);
		$row = $this->db->query()->get_count($tipousuario);

		$this->db->setCF('investigador');
		for ($i = 1; $i <= $row ; $i++) 
		{
			$investigador = $this->db->query()->get($listausuario[$i]);
			$query[$i] = array ( 	'correo'				=> $listausuario[$i],
									'nombre'				=> $investigador['nombre'],
									'institucion'			=> $investigador['institucion'],
									'url'					=> $investigador['url']
								);
    	}
		return $query;
	}

	function modificar_investigador($correo)
	{
		$this->db->setCF('investigador');
		$data = $this->db->query()->get($correo);
		return $data;

	}

	function insert_modificarinvestigador($correo, $update, $updatenombre)
	{
		$this->db->setCF('investigador');
		$this->db->query()->insert($correo, $update);
		$this->db->setCF('cuentausuario');
		$this->db->query()->insert($correo, $updatenombre);
	}



	function eliminar_investigador($correo)
	{
		$this->db->setCF('investigador');
		$this->db->query()->remove($correo);
		$this->db->setCF('cuentausuario');
		$this->db->query()->remove($correo);

		//actualizar lista de usuario administrador.
		$this->db->setCF('listausuario');
		
		$admin = $this->db->query()->get('Investigador');
		$row = $this->db->query()->get_count('Investigador');

		$b = 1;
		for ($i=1; $i <= $row; $i++)
		{
			if($correo != $admin[$i])
			{
				$a[$b] = $admin[$i];	
				$b++;
			}
		}
		if($row > sizeof($a))
		{
			$this->db->query()->remove('Investigador');
			$this->db->query()->insert('Investigador', $a);
		}

	}









/***************************************************************************

FUNCIONES PARA INSERTAR UN NUEVO USUARIO DENTRO DE LA BASE DE DATOS. 
					( TERAPEUTA).

***************************************************************************/

	//FUNCIONES PARA LA CREACION DE TERAPEUTAS POR PARTE DEL ADMINISTRADOR 

	function terapeuta_insert($admin)
	{
		$this->db->setCF('terapeuta');

		$columns = array(	'creador' 				=>	$admin['creador'],
							'creacion' 				=>	$admin['creacion'],
							'nombre' 				=> 	$admin['nombre'], 
							'titulo' 				=> 	$admin['titulo'],
							'institucion' 			=> 	$admin['institucion'],
							'especializacion' 		=> 	$admin['especializacion'],
							'pais'					=>	$admin['pais']
						);	

		$this->db->query()->insert($admin['correo'], $columns);
	}




	function listar_terapeuta($tipousuario)
	{
		$this->db->setCF('listausuario');
		$listausuario = $this->db->query()->get($tipousuario);
		$row = $this->db->query()->get_count($tipousuario);

		$this->db->setCF('terapeuta');
		for ($i = 1; $i <= $row ; $i++) 
		{
			$terapeuta = $this->db->query()->get($listausuario[$i]);
			$query[$i] = array ( 	'correo'				=> $listausuario[$i],
									'nombre'				=> $terapeuta['nombre'],
									'titulo'				=> $terapeuta['titulo']
								);
    	}
		return $query;
	}

	function modificar_terapueta($correo)
	{
		$this->db->setCF('terapeuta');
		$data = $this->db->query()->get($correo);
		return $data;

	}

		function insert_modificarterapeuta($correo, $update, $updatenombre)
	{
		$this->db->setCF('terapeuta');
		$this->db->query()->insert($correo, $update);
		$this->db->setCF('cuentausuario');
		$this->db->query()->insert($correo, $updatenombre);
	}


		function eliminar_terapeuta($correo)
	{
		$this->db->setCF('terapeuta');
		$this->db->query()->remove($correo);
		$this->db->setCF('cuentausuario');
		$this->db->query()->remove($correo);

		//actualizar lista de usuario administrador.
		$this->db->setCF('listausuario');
		
		$admin = $this->db->query()->get('Terapeuta');
		$row = $this->db->query()->get_count('Terapeuta');

		$b = 1;
		for ($i=1; $i <= $row; $i++)
		{
			if($correo != $admin[$i])
			{
				$a[$b] = $admin[$i];	
				$b++;
			}
		}
		if($row > sizeof($a))
		{
			$this->db->query()->remove('Terapeuta');
			$this->db->query()->insert('Terapeuta', $a);
		}

	}



}