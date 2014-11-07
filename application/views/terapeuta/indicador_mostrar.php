

<div class="page-header">
<a href="http://localhost:8888/pra/terapeuta/terapeuta_listar" class="btn">Volver</a>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th> Fecha </th>
      <th> Aplicación </th>
      <th> Descripción </th>
      <th> Habilidad </th>
      <th> Indicador</th>
    </tr>
  </thead>

  <tbody>
     <?php for ($i=1; $i<= sizeof($query); $i++){  ?>
    <tr>
      <td>    <?= $query[$i]['fecha'] ?>        </td>
      <td>    <?= $query[$i]['aplicacion'] ?>     </td>
      <td>    <?= $query[$i]['descripcion'] ?>  </td>
      <td>    <?= $query[$i]['habilidad'] ?>  </td>
      <td>    <?= $query[$i]['indicador'] ?>   </td>
    </tr>
    <? } ?>
  <tr></tr>
  </tbody>

</table>



