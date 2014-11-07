

<form class="form-horizontal" action="/pra/terapeuta/terapeuta_insertavance" method="post" accept-charset="utf-8">  
    <fieldset>  
        <legend><h3>Ingresar avance de alumno</h3> </legend>  
<?= my_validation_errors(validation_errors());?> 

<!--
        <div class="control-group">
              <label class="control-label" for="avance">Id de Avance:</label>  
              <div class="controls">  
                <input class="span2" value="02-16-2012" id="dp1" type="text">
                <input type="datetime"  value="<?php echo date("Y-m-d\TH:i:s",$timestamp); ?>"/>
          </div>
        </div>
-->
          <div class="control-group">  
              <label class="control-label" for="avance">Id de Avance:</label>  
              <div class="controls">  
                  <input type="text" class="input-xlarge" name="avance" id="avance"> 
              </div>  
            </div> 


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
            	<label class="control-label" for="identificador">Identificador (alumno) :</label>  
            	<div class="controls">  
              	    <!-- <input type="text" class="input-xlarge" id="identificador" >  --> 
                    <span class="uneditable-input"> <?= $identificador; ?></span>
                    <?= form_hidden('identificador', $identificador); ?> 

            	</div>  
          	</div> 


        <div class="control-group">
              <label class="control-label" for="dp1">Fecha Avance:</label>  
              <div class="controls">  
                <input class="span2" value="02/03/2014" id="dp1" name="dp1" type="text">
          </div>
        </div>

			      <div class="control-group">  
            	<label class="control-label" for="habilidad">Habilidad (tabla contenido) :</label>  
            	<div class="controls">  
              		<!-- <input type="text" class="input-xlarge" id="input01">  -->
                  <select class="input-xlarge" name="habilidad" id="habilidad">

                    <?php for ($i=1; $i<= sizeof($habilidad); $i++){  ?>
                    <option value="<?= $habilidad[$i]['identificador']; ?>"><?= $habilidad[$i]['nombre']; ?></option>
                    <? } ?>
                  </select>
            	</div>  
          	</div> 

           
           <div class="control-group">  
            <label class="control-label" for="objetivo">Objetivo :</label>  
            <div class="controls">  
              <textarea class="input-xlarge" name="objetivo" id="objetivo" rows="3"></textarea>  
            </div>  
         </div> 

		 <div class="control-group">  
            <label class="control-label" for="textarea">Nivel apoyo :</label>  
            <div class="controls">  
				<select class="input-xlarge" name="asistencia" id="asistencia">
					<option value="Sinapoyo">sin apoyo</option>
					<option value="Asistidoparcial">Asistencia parcial</option>
					<option value="Asistidototal">Asistencia total</option>
				</select>
			</div>  
    	</div> 

		<div class="control-group">  
            <label class="control-label" for="descripcion">Descripcion :</label>  
            <div class="controls">  
              <textarea class="input-xlarge" name="descripcion" id="descripcion" rows="3"></textarea>  
            </div>  
         </div> 

          <div class="form-actions">  
            <button type="submit" class="btn btn-primary">Registrar avance</button>  
            <a href="http://localhost:8888/pra/terapeuta/terapeuta_listar" class="btn">cancelar</a>   
          </div>  
        </fieldset>  
</form>  

