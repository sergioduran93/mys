<div class="row">
	<h2><?php echo $password ?></h2>

	<?php 
	echo $this->Form->create('Pw');
	echo $this->Form->input('pw');
	echo $this->Form->end('Enviar');
	?>


</div>
