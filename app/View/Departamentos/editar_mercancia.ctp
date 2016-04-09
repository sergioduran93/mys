<div class="units-row units-split">
	<div class="unit-40"><h2 class="icon group color theme">Editar Mercancias</h2></div>
	<?php 
		echo $this->Form->create('Mercancia',array('class'=>'form-inline'));
		echo $this->Form->input('id',array('type'=>'hidden'));
	?>
	<div class="form-group col-md-12">	
		<div class="col-md-6"><?php echo $this->Form->input('codigo',array('label'=>'Código: ','type'=>'text','div'=>'etiqueta'));?></div>
		<div class="col-md-6"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text','div'=>'etiqueta'));?></div>
	</div>
	<div class="form-group col-md-12 btns">
		<?php echo $this->Form->button("Guardar",array('type'=>'submit','class'=>'btn btn-primary')); ?>
		<?php echo $this->Html->link('Cancelar', array('action' => 'listar'),array('class'=>'btn btn-danger')); ?>	
	</div>
</div>
<br>
<?php echo $this->Form->end();?>

