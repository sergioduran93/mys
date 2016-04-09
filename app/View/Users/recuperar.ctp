<div class="row">
	<h2>Recuperar contraseña</h2>
	<?php 
	echo $this->Form->create('Recuperar');
	echo $this->Form->input('email');
	echo $this->Form->end('Enviar');
	?>
</div>
