<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('my_validation_errors'))
{
	function my_validation_errors($errors)
	{
		$salida= '';
		if($errors)
		{
			$salida = '<div class="alert alert-error">';
			$salida = $salida.'<button href="#" type="button" class="close" data-dismiss="alert"> x </button>';
			$salida = $salida.'<h4>Mensaje de Validación </h4>';
			$salida = $salida.'<small>'.$errors.'</small>';
			$salida = $salida.'</div>';
		}
		return $salida;
	}
}


// menu navbar superior.

if ( ! function_exists('menu_navbar'))
{
	function menu_navbar()
	{
		$opcion = '<li>'.anchor('/home','Inicio').'</li>';
		$opcion = $opcion.'<li>'.anchor('/home/acerca_de','Acerca_de').'</li>';
	 	return $opcion;
	}
}


// menu para todos 

if ( ! function_exists('menu_var_administrador'))
{
	function menu_var_administrador()
	{
		if(get_instance()->session->userdata('usuario') && get_instance()->session->userdata('tipousuario')=='Administrador')
		{
			$opcion = '<li>'.anchor('/home/bienvenida','Inicio').'</li>';
			$opcion = $opcion.'<li>'.anchor('/administrador/administrador_listar','- Administrador').'</li>';
			$opcion = $opcion.'<li>'.anchor('/administrador/investigador_listar','- Investigador').'</li>';
			$opcion = $opcion.'<li>'.anchor('/administrador/terapeuta_listar','- Terapeuta').'</li>';
			$opcion = $opcion.'<li>'.anchor('/home/salir','Salir').'</li>';
		}
		else if(get_instance()->session->userdata('usuario') && get_instance()->session->userdata('tipousuario')=='Terapeuta')
		{
			$opcion = '<li>'.anchor('/home/bienvenida','Inicio').'</li>';
			$opcion = $opcion.'<li>'.anchor('/terapeuta/terapeuta_crear','- Alumno').'</li>';
			$opcion = $opcion.'<li>'.anchor('/terapeuta/terapeuta_habilidad','- Habilidades').'</li>';
			$opcion = $opcion.'<li>'.anchor('/home/salir','Salir').'</li>';
		}


		else if(get_instance()->session->userdata('usuario') && get_instance()->session->userdata('tipousuario')=='Investigador')
		{	
			$opcion = '<li>'.anchor('/home/bienvenida','Inicio').'</li>';
			$opcion = $opcion.'<li>'.anchor('/investigador/listar','Mostrar informe').'</li>';
			$opcion = $opcion.'<li>'.anchor('/home/salir','Salir').'</li>';
		}
		else  
		{
			$opcion = '<li>'.anchor('/home','Inicio').'</li>';
		}	
	 return $opcion;
	}
}
