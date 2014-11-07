
<ul class="nav nav-tabs">
  <li class="active">
   	<li>
   		<a href="http://localhost:8888/pra/administrador/administrador_crear">Crear Administrador</a>
  	</li>
  	<li>
  		<a href="http://localhost:8888/pra/administrador/administrador_listar">Listar Administradores</a>
  	</li>
</ul>


<form class="form-horizontal" action="http://localhost:8888/pra/administrador/administrador_insertmodificar" method="post" accept-charset="utf-8">

	<fieldset>  
    <legend>Modificar Administrador</legend> 
	
	<?= my_validation_errors(validation_errors());?> 


<!--  correo  del nuevo administrador -->
        <div class="control-group">  
            <label class="control-label" for="input01">Correo Electronico :</label>  
            <div class="controls">  
				<span class="uneditable-input"> <?= $correo; ?></span>
                <?= form_hidden('correo', $correo); ?> 
            </div>  
        </div> 

<!--  nombre de nuevo administrador -->
        <div class="control-group">  
        	<label class="control-label" for="name">Nombre :</label>  
            <div class="controls">  
              	<input type="text" class="input-xlarge" name="nombre" id="nombre" value="<?= $query['nombre'];?>" >
            </div>  
        </div> 

<!-- url del nuevo administrador -->
        <div class="control-group">  
            <label class="control-label" for="url">URL Sitio web :</label>  
            <div class="controls">  
              	<input type="text" name="url" id="url" class="input-xlarge" value="<?= $query['url'];?>" >
            </div>  
        </div> 
 
<!--  Envio de formulario -->
        <div class="form-actions">  
            <button type="submit" class="btn btn-primary">Modificar</button>  
            <a href="http://localhost:8888/pra/administrador/administrador_listar" class="btn">cancelar</a>  
        </div>  

    </fieldset>  
</form>  

