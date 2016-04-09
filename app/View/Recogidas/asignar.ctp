<?php
	echo $this->Html->css('jquery-ui-1.10.3_azul.custom'); 
	echo $this->Html->css('jquery.dataTables_themeroller'); 
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-1.10.2.min');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('custom');
	echo $this->Html->css('jquery-ui-1.10.3_azul.custom'); 
	echo $this->Html->css('jquery.dataTables_themeroller'); 
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-1.9.1.min');
	echo $this->Html->script('jquery-ui');
	echo $this->Html->script('jquery.fancybox');
	echo $this->Html->script('jquery.dataTables');
?>
<div class="row" style="width:90%; margin-left:5%;">   
	<br>
    <fieldset>
	<?php echo $this->Form->create('Recogida',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden','default'=>$id)); ?>
	<div class="form-group col-md-12">
		<div class="col-md-6"><?php echo $this->Form->input('placa',array('label'=>'Placa vehiculo:','type'=>'text')); ?></div>
		<div class="col-md-6"><?php echo $this->Form->input('conductorNombre',array('label'=>'Conductor Nombres:','type'=>'text')); ?></div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-6"><?php echo $this->Form->input('conductorId',array('label'=>'Conductor CC:','type'=>'text')); ?></div>
		<div class="col-md-6"><?php echo $this->Form->input('horaAsig',array('label'=>'Hora:','type'=>'text')); ?></div>
	</div>
	<div class="form-group btns">
		<?php echo $this->Form->button('Asignar',array('class'=>'pull-right btn btn-primary'));?>
		<?php echo $this->Form->end();?>
	</div>
</div>
	

<script>
	var webroot     =<?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url     = <?php echo "'".Router::url('/')."recogidas'"; ?>;
    var conductores = <?php echo json_encode($conductores); ?>;
    var vehiculos   = <?php echo json_encode($vehiculos); ?>;
    var vehiculosPlaca   = new Array();
    var conductoresInfo  = new Array();
$(document).ready(function(){
	$('.btn-primary').click( function (i){
        $.fancybox.close();
    });

	$.each( vehiculos, function( key, value ) {
		vehiculosPlaca[key] = value.Vehiculo.placa;
	});
	$.each( conductores, function( key, value ) {
		conductoresInfo[key] = value.Conductor.identificacion;
	});
	
	$(function() {
		$("#RecogidaPlaca").autocomplete({
			source: vehiculosPlaca
		});
		$( "#RecogidaConductorId" ).autocomplete({
			source: conductoresInfo,
			select: function( event, ui ) {
				$.each( conductores, function( key, value ) {
					if(ui.item.value == value.Conductor.identificacion){
						$('#RecogidaConductorNombre').val(value.Conductor.listNombre);
					}
				});
			}
		});
	});

	})
</script>