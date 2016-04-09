<div class="row" style="width:90%; margin-left:5%;">
	<h2 class="icon group color theme">Crear Departamentos<span class="boton-esquina"><?php echo $this->Html->link('Listar Mercancias', array('action' => 'listar'),array('class'=>'button tiny')); ?></span></h2>
	<br>
	<?php echo $this->Form->create('Mercancia');?>
	<fieldset class="column_4">
	<?php 
		echo $this->Form->input('codigo');
		echo $this->Form->input('nombre');
	?>
	</fieldset>
</div>
<br>
<div class="row" style="margin-left:5%;">
	<?php echo $this->Form->button("Guardar",array('type'=>'submit','class'=>'offset_1 button tiny')); ?>
	<?php echo $this->Html->link('Cancelar', array('action' => 'listar'),array('class'=>'button alert tiny')); ?>
	
</div>
<?php echo $this->Form->end();?>


