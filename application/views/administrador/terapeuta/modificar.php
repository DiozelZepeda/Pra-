<ul class="nav nav-tabs">
  <li class="active">
   	<li>
   		<a href="http://localhost:8888/pra/administrador/terapeuta_crear">Crear terapeuta</a>
  	</li>
  	<li>
  		<a href="http://localhost:8888/pra/administrador/terapeuta_listar">Listar terapeutas</a>
  	</li>
</ul>




<form class="form-horizontal" action="http://localhost:8888/pra/administrador/terapeuta_insertmodificar" method="post" accept-charset="utf-8">  
        <fieldset>  
          <legend>Crear nuevo Terapeuta</legend>  

		<?= my_validation_errors(validation_errors());?> 

	  	<div class="control-group">  
            <label class="control-label" for="correo">Correo Electronico</label>  
            <div class="controls">  
              	<span class="uneditable-input"> <?= $correo; ?></span>
                <?= form_hidden('correo', $correo); ?>  
            </div>  
       	</div> 


        <div class="control-group">  
        	<label class="control-label" for="nombre">Nombre</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" name="nombre" id="nombre" value="<?= $query['nombre'];?>" >
            </div>  
        </div> 
          
        <div class="control-group">  
            <label class="control-label" for="titulo">Titulo Profesional</label>  
            <div class="controls">  
              <input type="text" class="input-xlarge" name="titulo" id="titulo" value="<?= $query['titulo'];?>" >
            </div>  
          </div> 

		 <div class="control-group">  
            <label class="control-label" for="institucion">Institución laboral</label>  
            <div class="controls">  
             <input type="text" class="input-xlarge" name="institucion" id="institucion" value="<?= $query['institucion'];?>" >
            </div>  
          </div> 

		<div class="control-group">  
            <label class="control-label" for="textarea">Especializaciones profesionales</label>  
            <div class="controls">  
             <input type="text" class="input-xlarge" name="especializacion" id="especializacion" value="<?= $query['especializacion'];?>" >
            </div>  
         </div>  
	
   
          <div class="form-actions">  
            <button type="submit" class="btn btn-primary">Modificar</button>  
            <a href="http://localhost:8888/pra/administrador/terapeuta_listar" class="btn">cancelar</a>   
          </div>  
        </fieldset>  
</form>  

