
<div class="row" style="width:90%; margin-left:5%;">
	<br>
	<?php echo $this->Form->create('VentasCredito',array('type'=>'file','class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
	<div><h3><center>IMPORTACIÓN DE GUIAS</center></h3></div>
	<div class="form-group col-md-12">
		<div class="col-md-12"><?php echo $this->Form->input('excel',array('label'=>'Excel: ','type'=>'file','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
	</div>
	<?php echo $this->Form->button("Guardar",array('type'=>'submit',"class"=>'btn btn-primary',"style"=>'float:right;margin-top: 15px;margin-right: 30px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
	<?php echo $this->Form->end();?>
</div>
