<ul class="nav nav-tabs">
  <li class="active">
  	<li>
  		<a href="http://localhost:8888/pra/terapeuta/terapeuta_listar">Alumnos</a>
  	</li>
   	<li>
   		<a href="http://localhost:8888/pra/terapeuta/terapeuta_crear">Crear Alumno</a>
  	</li>
  	<li>
  		<a href="http://localhost:8888/pra/terapeuta/terapeuta_listar2">Editar alumno</a>
  	</li>
</ul>

<div class="page-header">
<h3> Editar</h3>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th> Identificador </th>
			<th> Nombre </th>
			<th> Fecha Nacimiento </th>
			<th> Escuela </th>
			<th> Editar </th>
		</tr>
	</thead>

	<tbody>
		 <?php for ($i=1; $i<= sizeof($query); $i++){  ?>
		<tr>
			<td><?= $query[$i]['identificador'] ?></td>
			<td><?= $query[$i]['nombre'] ?></td>
			<td><?= $query[$i]['fnacimiento'] ?></td>
			<td><?= $query[$i]['escuela'] ?></td>
			<td>
				<form action="/pra/terapeuta/terapeuta_modificar" method="POST" >
   					<input type="hidden" name="identificador" id="identificador" value="<?= $query[$i]['identificador']; ?>" />
   					<input name="btn_send" class="btn btn-primary" type="submit" value="Editar" />
				</form>
			</td>
	
		</tr>
		<? } ?>
	<tr></tr>
	</tbody>

</table>
