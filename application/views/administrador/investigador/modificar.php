
<ul class="nav nav-pills ">
  <li class="active">
   	<li>
   		<a href="http://localhost:8888/pra/administrador/investigador_crear">Crear investigador</a>
  	</li>
  	<li>
  		<a href="http://localhost:8888/pra/administrador/investigador_listar">Listar investigadores</a>
  	</li>
</ul>

<form class="form-horizontal" action="http://localhost:8888/pra/administrador/investigador_insertmodificar" method="post" accept-charset="utf-8">  
        <fieldset>  
          <legend>Crear nuevo Investigador</legend>  

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
            <label class="control-label" for="institucion">Institución</label>  
            <div class="controls">  
              	<input type="text" class="input-xlarge" name="institucion" id="institucion" value="<?= $query['institucion'];?>" >
            </div>  
        </div> 

		<div class="control-group">  
            <label class="control-label" for="textarea">Url</label>  
            <div class="controls">  
              	<input type="text" class="input-xlarge" name="url" id="url" value="<?= $query['url'];?>" >
            </div>  
        </div>  
		
         <div class="control-group">  
            <label class="control-label" for="textarea">Motivo Investigación</label>  
            <div class="controls">  
              	<!-- <textarea class="input-xlarge" id="textarea" rows="3"></textarea> --> 
              	<input type="text" class="input-xlarge" name="motivoinvestigacion" id="motivoinvestigacion" value="<?= $query['motivoinvestigacion'];?>" >
            </div>  
         </div>  

          <div class="form-actions">  
            <button type="submit" class="btn btn-primary">Registrar Usuario</button>  
            <a href="http://localhost:8888/pra/administrador/investigador_listar" class="btn">cancelar</a>    
          </div>  
        </fieldset>  
</form>  
