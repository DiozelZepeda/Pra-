
<ul class="nav nav-tabs">
  <li class="active">
    <li>
      <a href="http://localhost:8888/pra/terapeuta/terapeuta_habilidad">Crear Habilidad</a>
    </li>
    <li>
      <a href="http://localhost:8888/pra/terapeuta/terapeuta_habilidadlistar">Listar habilidades</a>
    </li>
</ul>


<form class="form-horizontal" action="/pra/terapeuta/terapeuta_inserthabilidad" method="post" accept-charset="utf-8">  
  
  <fieldset>  
  <legend><h3>Nueva Habilidades</h3> </legend>  
  <?= my_validation_errors(validation_errors());?> 

    <div class="control-group">  
      <label class="control-label" for="terapeuta">Terapeuta:</label>  
      <div class="controls">  
        <!-- <input type="text" class="input-xlarge" id="identificador" >  --> 
        <span class="uneditable-input"> <?= $this->session->userdata['usuario']; ?></span>
        <?= form_hidden('terapeuta', $this->session->userdata['usuario']); ?> 
      </div>  
    </div> 

<!-- nombre el alumno para tener registro de que persona es -->
    <div class="control-group">  
      <label class="control-label" for="identificador">Id Habilidad</label>  
      <div class="controls">  
        <?= form_input(array('type'=>'text', 'class'=>'input-xlarge','name'=>'identificador', 'id'=>'identificador', 'value'=>set_value('identificador'))); ?>  
      </div>  
    </div> 

    <div class="control-group">  
      <label class="control-label" for="nombre">Nombre :</label>  
      <div class="controls">  
        <?= form_input(array('type'=>'text', 'class'=>'input-xlarge','name'=>'nombre', 'id'=>'nombre', 'value'=>set_value('nombre'))); ?>  
      </div>  
    </div> 
	 
    <div class="control-group">  
      <label class="control-label" for="descripcion">Descripción :</label>  
      <div class="controls">  
        <?= form_input(array('type'=>'text', 'class'=>'input-xlarge','name'=>'descripcion', 'id'=>'descripcion', 'value'=>set_value('descripcion'))); ?>
    </div> 

    <div class="form-actions">  
      <button type="submit" class="btn btn-primary">Registrar Habilidad</button>  
      <a href="http://localhost:8888/pra/terapeuta/terapeuta_habilidad" class="btn">cancelar</a>  
    </div>  
  </fieldset>  
</form>  