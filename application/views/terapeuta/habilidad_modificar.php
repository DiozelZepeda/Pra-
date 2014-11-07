<form class="form-horizontal" action="/pra/terapeuta/habilidad_insertmodificar" method="post" accept-charset="utf-8">  
  
  <fieldset>  
  <legend><h3>Nueva Habilidades</h3> </legend>  
  <?= my_validation_errors(validation_errors());?> 

<!-- nombre el alumno para tener registro de que persona es -->
    <div class="control-group">  
      <label class="control-label" for="identificador">Id Habilidad</label>  
      <div class="controls">  
          <span class="uneditable-input"> <?= $identificador; ?></span>
          <?= form_hidden('identificador', $identificador); ?>     
      </div>  
    </div> 

    <div class="control-group">  
      <label class="control-label" for="nombre">Nombre :</label>  
      <div class="controls">  
        <input type="text" class="input-xlarge" name="nombre" id="nombre" value="<?= $query['nombre'];?>" >
      </div>  
    </div> 
	 
    <div class="control-group">  
      <label class="control-label" for="descripcion">Descripción :</label>  
      <div class="controls">  
       <input type="text" class="input-xlarge" name="descripcion" id="descripcion" value="<?= $query['descripcion'];?>" >
    </div> 

    <div class="form-actions">  
      <button type="submit" class="btn btn-primary">Modificar</button>  
      <a href="http://localhost:8888/pra/terapeuta/terapeuta_habilidad" class="btn">cancelar</a>
    </div>  
  </fieldset>  
</form>  