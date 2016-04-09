<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
?>
<div class="row" style="width:90%; margin-left:5%;">
<br>
	<div class="units-row units-split">
		<div class="unit-40"><h2 class="icon group color theme">Editar Region</h2></div>
	</div>
	<?php 
		echo $this->Form->create('Region',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));
		echo $this->Form->input('id',array('type'=>'hidden'));
	?>
	<div class="thumbnail form-group col-md-6">
		<div class="form-group col-md-12"><?php echo $this->Form->input('codigo',array('label'=>'Código: ','type'=>'text','div'=>'etiqueta'));?></div>
		<div class="form-group col-md-12"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text','div'=>'etiqueta'));?></div>
		<div class="form-group col-md-12"><?php echo $this->Form->input('descuento',array('label'=>'Descuento: ','type'=>'text','div'=>'etiqueta'));?></div>
		<div class="form-group col-md-12"><?php echo $this->Form->input('departamento_id',array('label'=>'Departamento: ','type'=>'select', 'options'=>$departamentos,'div'=>'etiqueta'));?></div>
	</div>

	<div class="thumbnail form-group col-md-6">
		<div class="unique-row"><?php echo $this->Form->input('destinos',array('label'=>'Destinos: ','multiple'=>true,'class'=>'chosen-select','type'=>'select','options'=>$destinos)); ?></div>
	</div>
	<div class="form-group">
		<?php echo $this->Form->submit('Guardar',array('class'=>'pull-right btn btn-primary','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
	</div>
</div>

<br>
<?php echo $this->Form->end();?>



<script>
var destinosRegion  = <?php echo json_encode($destinosRegion); ?>;

$(document).ready(function(){
	$("#RegionDestinos").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_multiple : "Seleccione los destinos"
	});

	$.each( destinosRegion, function( key2, value2 ) {
		$("#RegionDestinos option").each(function( key, value ) {
			var actual = $(value).val();

			if(actual == key2){
				$(this).attr("selected","selected");
			}
		});
	});
/*	$.each( destinosT, function( key2, value2 ) {
		$("#RegionDestinos option").each(function( key, value ) {
			var actual = $(value).val();
			if(actual == key2){
				$(this).attr("title","Destino asociado a otra región");
			}
		});
	});*/
	$("#RegionDestinos").trigger("chosen:updated");

});
</script>
