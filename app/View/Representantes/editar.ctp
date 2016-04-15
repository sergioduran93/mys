<style type="text/css">
	.leftTd{
		text-align: left;
	}
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
	cursor: pointer;
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
		<div><h3><center>EDICION REPRESENTANTE</center></h3></div>

		<?php echo $this->Form->create('Representante'); ?>
		<?php echo $this->Form->input('nombre1'); ?>
		<?php echo $this->Form->input('nombre2'); ?>
		<?php echo $this->Form->input('apellido1'); ?>
		<?php echo $this->Form->input('apellido2'); ?>
		<?php echo $this->Form->input('codigo'); ?>
		<?php echo $this->Form->input('celular'); ?>
		<?php echo $this->Form->input('telefono1'); ?>
		<?php echo $this->Form->input('direccion'); ?>
		<?php echo $this->Form->input('email'); ?>
		<?php echo $this->Form->input('banco'); ?>
		<?php echo $this->Form->input('cuenta'); ?>

		<?php echo $this->Form->end('Editar Representate'); ?>


			<?php
echo $this->Html->link('Volver a Lista de Representantes', array('controller' => 'representantes', 'action' => 'listarepresentantes', array('class' => 'btn btn-primary'));
?>

