
<ul class="nav nav-tabs">
  <li class="active">
   	<li>
   		<a href="http://localhost:8888/pra/administrador/administrador_crear">Crear Administrador</a>
  	</li>
  	<li>
  		<a href="http://localhost:8888/pra/administrador/administrador_listar">Listar Administradores</a>
  	</li>
</ul>


<div class="page-header">
<h3> Administradores </h3>
</div>

<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th> Nombre </th>
			<th> Correo </th>
			<th> Url </th>
			<th> Creador </th>
			<th> Editar </th>
			<th> Remover </th>
		</tr>
	</thead>
	<tbody>
		<?php for ($i=1; $i<= sizeof($query); $i++){  ?>
		<tr>
			<td><?= $query[$i]['nombre'] ?></td>
			<td><?= $query[$i]['correo'] ?></td>
			<td><a href="<?= $query[$i]['url'] ?>" target="_blank"><?= $query[$i]['url'] ?></td>
			<td><?= $query[$i]['creador'] ?></td>
			<td>

				<form action="/pra/administrador/administrador_modificar" method="POST" >
   					<input type="hidden" name="correo" id="correo" value="<?= $query[$i]['correo']; ?>" />
   				<!--	<input name="btn_send" class="btn btn-primary" type="submit" value="Editar" /> -->
   					<button name="" type="submit" class="btn"> <i class="icon-edit"></i></button>
				</form>

			</td>
			<td>
				<form action="/pra/administrador/administrador_eliminar" method="POST" >
   					<input type="hidden" name="correo" value="<?= $query[$i]['correo']; ?>" />
   				<!--	<input name="btn_send" type="submit" value="Eliminar" /> -->
   					<button name="" type="submit" onMouseOver="eliminar" class="btn"> <i class="icon-remove"></i></button>
				</form>

			</td>
		</tr>
		<? } ?>
	</tbody>

</table>
