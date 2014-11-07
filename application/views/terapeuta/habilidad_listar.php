
<ul class="nav nav-tabs">
  <li class="active">
    <li>
      <a href="http://localhost:8888/pra/terapeuta/terapeuta_habilidad">Crear Habilidad</a>
    </li>
    <li>
      <a href="http://localhost:8888/pra/terapeuta/terapeuta_habilidadlistar">Listar habilidades</a>
    </li>
</ul>


<div class="page-header">
<h3> Habilidades </h3>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th> Id </th>
      <th> Nombre </th>
      <th> Descripción </th>
      <th> Editar </th>
    </tr>
  </thead>

  <tbody>
    <?php for ($i=1; $i<= sizeof($query); $i++){  ?>
    <tr>
      <td><?= $query[$i]['identificador'] ?></td>
      <td><?= $query[$i]['nombre'] ?></td>
      <td><?= $query[$i]['descripcion'] ?></td>
      <td>
        <form action="/pra/terapeuta/habilidad_modificar" method="POST" >
            <input type="hidden" name="identificador" id="identificador" value="<?= $query[$i]['identificador']; ?>" />
            <input name="btn_send" class="btn btn-primary" type="submit" value="Editar" />
        </form>    
      </td>
    
    </tr>
    <? } ?>
  </tbody>

</table>