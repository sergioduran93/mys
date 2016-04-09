<div class="row">
	<h2 class ="icon user"> Ingreso al sistema</h2>
</div>
<div class="row column_6 offset_3">	
	<fieldset class ="caja gris column_4 offset_3 form">
		<?php
		echo $this->Form->create();
		echo $this->Form->input('username',array('label'=>'Usuario<span class="rojo">*</span>'));
		echo $this->Form->input('password',array('label'=>'Contraseña'));		
		echo $this->Form->submit('Entrar',array('div' => false,'class'=>'button small'));
		?>
	</fieldset>	
</div>
<div class="on-right">
	<br>
	<?php 
	//echo $this->Html->link('¿Olvidaste la contraseña?','#inline_content',array('class'=>'inline')); 
	echo $this->Html->link('¿Olvidaste la contraseña?',array('action'=>'recuperar'),array('class'=>'inline')); 
	?>
</div>
