	<script type="text/javascript">
            
            var controller = 'terapeuta';
            var base_url = '<?php echo site_url();?>';

            function load_data_ajax(type){
                $.ajax({
                    'url' : base_url + '/' + controller + '/terapeuta_consultarhabilidad',
                    'type' : 'POST', //the way you want to send data to your URL
                    'data' : {'type' : type},
                    'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
                        var container = $('#container'); //jquery selector (get element by id)
                        if(data){
                            container.html(data);
                        }
                        
                    }
                });
            } 
</script>






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
	<h3> Historial de avances</h3> <a href="http://localhost:8888/pra/terapeuta/terapeuta_listar" class="btn">Volver</a>
</div>





<div id="container"></div>
<!-- <div class="simple-ajax-popup-align-top" id="container"></div> -->

<!-- <div id="simple-ajax-popup-align-top" style="display: none" title="Nueva Ventana"></div> -->

<table class="table table-bordered">
	<thead>
		<tr>
			<th> Fecha </th>
			<th> Objetivo </th>
			<th> Descripción </th>
			<th> Habilidad </th>
			<th> Asistencia</th>
			<th> Indicadores </th>
		</tr>
	</thead>

	<tbody>
		 <?php for ($i=1; $i<= sizeof($query); $i++){  ?>
		<tr>
			<td><?= $query[$i]['fecha'] ?></td>
			<td><?= $query[$i]['objetivo'] ?></td>
			<td><?= $query[$i]['descripcion'] ?></td>
			<td>
				<button onclick="load_data_ajax(<?= $query[$i]['habilidad'] ?>)"><?= $query[$i]['habilidad'] ?></button>
			</td>
			<td>
				<?= $query[$i]['asistencia'] ?>
			</td>
			<td>
				<form action="/pra/terapeuta/terapeuta_consultarindicador" method="POST" >
   					<input type="hidden" name="identificador" id="identificador" value="<?= $query[$i]['identificador']; ?>" />
   					<input name="btn_send" class="btn btn-primary" type="submit" value="Indicadores" />
				</form>
			</td>

		</tr>
		<? } ?>
	<tr></tr>
	</tbody>

</table>
