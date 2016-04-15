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
		<div><h3><center>CREDITO</center></h3></div>

		<?php
		echo $this->Form->create('Credito', array('role' => 'form'));
		echo $this->Form->input('prestamo');
		echo $this->Form->input('abono');
		echo $this->Form->input('representante_id');
	?>
	<p>
	<br>
	</p>
	<p>
		<?php echo $this->Form->end(array('label' => 'GUARDAR CREDITO', 'class' =>'btn btn-primary btn-block')); ?>
				</p>