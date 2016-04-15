<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->script('jquery.jCombo.min');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->css('jquery.fancybox');
?>
<style type="text/css">
	.dataTables_scroll{
		width: 100% !important;
	}
	table.table {
	clear: both;
	margin-top: 0px !important;
	margin-bottom: 0px !important;
	max-width: none !important;
	border-collapse: separate;
	}
	table.dataTable,
	table.dataTable td,
	table.dataTable th {
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	}
	.ColVis_collection li{
		width: 20%;
	}
	.ColVis_collection li label{
		float: left;
		padding: 0px 20px;
	}
	.dataTables_wrapper {
		margin-left: 0px;
	}
	.btnTable {
		padding: 4px 10px;
		background: rgb(205, 226, 244);
		color: rgb(65, 77, 94);
		border-radius: 5px;
		font-weight: bold;
	}
</style>

<div class="row" style="width:90%; margin-left:5%;">
	<br>
	<!-- <?php echo $valor; ?>-->
	<?php echo $this->Form->create('Factura',array('class'=>'form-inline'));?>
		<div><h3><center>FACTURACIÓN</center></h3></div>
	    <div class="form-group col-md-12">
       		<div class="col-md-9"><?php echo $this->Form->input('relacionfactura_id',array('label'=>'Relación: ','type'=>'select','options'=>$relaciones,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		</div>
		
		</br>
				</br>
				<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
				<br>
	<?php echo $this->Form->button("Facturar y Guardar",array("class"=>'btn btn-primary btn-lg btn-block',"style"=>'float:right;margin-bottom: 20px;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>




<script>


$(document).ready(function(){
/*
	$('#FacturaCrearForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});
*/

	$("#FacturaRelacionfacturaId").chosen({
		no_results_text           : 'No se encuentra la relación.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione la Relacion a Facturar"
	});


})

</script>