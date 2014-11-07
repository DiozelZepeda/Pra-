<?= form_open('home/ingresar', array('class' => 'form_horizontal'));?>
	<legend> Inicio de sesión </legend>

	 <?= my_validation_errors(validation_errors());?> 

	<div class="control-group">
		<?= form_label('Ingrese su correo electrónico:', 'login', array('class'=> 'control-label'))?>
		<?= form_input(array('type'=>'email', 'name'=>'login', 'id'=>'login', 'placeholder'=>'Correo electrónico', 'value'=>set_value('login'))); ?>
	</div>

	<div class="control-group">
		<?= form_label('Ingrese su contraseña:' ,'login', array('class'=> 'control-label'))?>
		<?= form_input(array('type'=>'password', 'name'=>'password', 'placeholder'=>'Contraseña','id'=>'password', 'value'=>set_value('password'))); ?>
	</div>

	<div class="form-action">
		<?= form_button(array('type'=> 'submit', 'content'=>'Ingresar', 'class'=>'btn btn-primary'))?>
		<?= anchor('home/index', 'cancelar', array('class'=>'btn'))?>
	</div>
<?= form_close(); ?>