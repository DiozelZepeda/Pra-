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


<form class="form-horizontal" action="http://localhost:8888/pra/terapeuta/terapeuta_insertmodificar" method="post" accept-charset="utf-8">  
    <fieldset>  
        <legend>Modificar Alumno</legend>  

	<?= my_validation_errors(validation_errors());?> 

			<div class="control-group">  
            	<label class="control-label" for="identificador">Identificación:</label>  
            	<div class="controls"> 
              		<span class="uneditable-input"> <?= $identificador; ?></span>
                	<?= form_hidden('identificador', $identificador); ?> 
            	</div>  
          	</div> 


<!-- nombre el alumno para tener registro de que persona es -->
            <div class="control-group">  
            	<label class="control-label" for="nombre">Nombre:</label>  
            	<div class="controls"> 
              		<input type="text" class="input-xlarge" name="nombre" id="nombre" value="<?= $query['nombre'] ?>" > 
            	</div>  
          	</div> 


<!-- Fecha nacimiento del alumno  -->
		<div class="control-group">  
            <label class="control-label" for="fnacimiento">Fecha nacimiento :</label>  
    		 <div class="controls">  
              	<input type="text" class="input-xlarge" name="fnacimiento" id="fnacimiento" value="<?= $query['fnacimiento'] ?>"> 
            </div>        

    	</div> 

      	<div class="control-group">  
            <label class="control-label" for="diagnostico">Diagnostico :</label>  
            <div class="controls">  
              <textarea class="input-xlarge" id="diagnostico" name="diagnostico" rows="3" ><?= $query['diagnostico'] ?></textarea> 
            </div>  
         </div> 

         <div class="control-group">  
            <label class="control-label" for="tratamiento">Tratamiento :</label>  
            <div class="controls">  
              <textarea class="input-xlarge" id="tratamiento" name="tratamiento" rows="3"> <?= $query['tratamiento'] ?></textarea>
            </div>  
         </div> 

         <div class="control-group">  
            <label class="control-label" for="habilidades">Habilidades :</label>  
            <div class="controls">  
              <textarea class="input-xlarge" id="habilidades" name="habilidades" rows="3" ><?= $query['habilidades'] ?></textarea> 
            </div>  
         </div> 

		<div class="control-group">  
            	<label class="control-label" for="escuela">Escuela :</label>  
            	<div class="controls">  
              		<input type="text" class="input-xlarge" name="escuela" id="escuela" value="<?= $query['escuela'] ?>">
            	</div>  
          	</div> 


          <div class="form-actions">  
            <button type="submit" class="btn btn-primary">Modificar</button>  
            <a href="http://localhost:8888/pra/terapeuta/terapeuta_listar2" class="btn">cancelar</a>  
          </div>  
        </fieldset>  
</form>  


