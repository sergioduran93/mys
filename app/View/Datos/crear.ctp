
<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Dato',array('class'=>'form-inline'));?>
		<div><h3><center>DATOS DE LA EMPRESA</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('nit',array('label'=>'NIT: ','type'=>'text')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('despachar',array('label'=>'Despachar Mercancia: ','type'=>'select','options'=>$despachar)); ?></div>
		</div>
	    <div class="form-group col-md-12">
	    	<div class="col-md-6"><?php echo $this->Form->input('destino',array('label'=>'Ciudad: ','type'=>'select','options'=>$destinos)); ?></div>
       		<div class="col-md-6"><?php echo $this->Form->input('direccion',array('label'=>'Dirección: ','type'=>'text')); ?></div>
		</div>
	    <div class="form-group col-md-12">
	    	<div class="col-md-3"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('codigo',array('label'=>'Código: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('fecha_habilitada',array('label'=>'Fecha Habilitada: ','type'=>'text','placeholder'=>'DD/MM/AAAA')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('fecha_expiracion',array('label'=>'Fecha Expiración: ','type'=>'text','placeholder'=>'DD/MM/AAAA')); ?></div>
		</div>
		<div class=" bs-callout bs-callout-info" style="padding-top: 10px;">
			<div class=""><strong>POLIZA</strong></div>
			<div class="form-group col-md-12">
				<div class="col-md-20"><?php echo $this->Form->input('poliza_aseguradora',array('label'=>'Aseguradora: ','type'=>'text')); ?></div>
				<div class="col-md-20"><?php echo $this->Form->input('poliza_nit',array('label'=>'NIT: ','type'=>'text')); ?></div>
				<div class="col-md-20"><?php echo $this->Form->input('poliza_no',array('label'=>'Numero: ','type'=>'text')); ?></div>
				<div class="col-md-20"><?php echo $this->Form->input('poliza_inicio',array('label'=>'Fecha Inicio: ','type'=>'text','placeholder'=>'DD/MM/AAAA')); ?></div>
				<div class="col-md-20"><?php echo $this->Form->input('poliza_vencimiento',array('label'=>'Fecha Vencimiento: ','type'=>'text','placeholder'=>'DD/MM/AAAA')); ?></div>
			</div>
		</div>
		<div class=" bs-callout bs-callout-info" style="padding-top: 10px;">
			<div class=""><strong>AUTORIZACIÓN MANIFIESTOS</strong></div>
			<div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('manifiestos_no',array('label'=>'No. Resolución: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('manifiestos_autorizacion',array('label'=>'Fecha Autorización: ','type'=>'text','placeholder'=>'DD/MM/AAAA')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('manifiestos_rango',array('label'=>'Rango autorizados: ','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('otro',array('label'=>'Otro: ','type'=>'text')); ?></div>
			</div>
		</div>
	<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>




<script>	
$(document).ready(function(){
	$("#DatoFechaHabilitada").datepicker();
	$("#DatoFechaExpiracion").datepicker();
	$("#DatoPolizaInicio").datepicker();
	$("#DatoPolizaVencimiento").datepicker();
	$("#DatoManifiestosAutorizacion").datepicker();
})
</script>