
<ul class="nav nav-tabs">
  <li class="active">
   	<li>
   		<a href="http://localhost:8888/pra/administrador/investigador_crear">Crear investigador</a>
  	</li>
  	<li>
  		<a href="http://localhost:8888/pra/administrador/investigador_listar">Listar investigadores</a>
  	</li>
</ul>


<div class="page-header">
<h3> Investigadores </h3>
</div>

<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th> Nombre </th>
			<th> Correo </th>
			<th> Institución </th>
			<th> Url </th>
			<th> Editar</th>
			<th> Remover </th>
		</tr>
	</thead>

	<tbody>
		<?php for ($i=1; $i<= sizeof($query); $i++){  ?>
		<tr>
			<td><?= $query[$i]['nombre'] ?></td>
			<td><?= $query[$i]['correo'] ?></td>
			<td><?= $query[$i]['institucion'] ?></td>
			<td><a href="<?= $query[$i]['url'] ?>" target="_blank"><?= $query[$i]['url'] ?></td>
			<td>
				<form action="/pra/administrador/investigador_modificar" method="POST" >
   					<input type="hidden" name="correo" id="correo" value="<?= $query[$i]['correo']; ?>" />
   					<input name="btn_send" class="btn btn-primary" type="submit" value="Editar" />
				</form>
			</td>
			<td>
				<form action="/pra/administrador/investigador_eliminar" method="POST" >
   					<input type="hidden" name="correo" value="<?= $query[$i]['correo']; ?>" />
   					<input name="btn_send" class="btn btn-primary" type="submit" value="Eliminar" />
				</form>

			</td>
		</tr>
		<? } ?>
	</tbody>

</table>
