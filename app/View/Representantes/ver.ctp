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
		<div><h3><center>DETALLE REPRESENTANTE</center></h3></div>

		
		<p><strong>Nombre: </strong><?php echo $representante['Representante']['nombre1']; ?><?php echo $representante['Representante']['nombre2']; ?><?php echo $representante['Representante']['apellido1']; ?><?php echo $representante['Representante']['apellido2']; ?></p>
		<p><strong>Cedula: </strong><?php echo $representante['Representante']['identificacion']; ?></p>
		<p><strong>Codigo: </strong><?php echo $representante['Representante']['codigo']; ?></p>
		<p><strong>Celular: </strong><?php echo $representante['Representante']['celular']; ?></p>
		<p><strong>Telefono: </strong><?php echo $representante['Representante']['telefono1']; ?></p>
		<p><strong>Direccion: </strong><?php echo $representante['Representante']['direccion']; ?></p>
		<p><strong>E-mail: </strong><?php echo $representante['Representante']['email']; ?></p>
		<p><strong>Banco: </strong><?php echo $representante['Representante']['banco']; ?></p>
		<p><strong>Nro Cuenta: </strong><?php echo $representante['Representante']['cuenta']; ?></p>
		<p><strong>Tipo Cuenta: </strong><?php echo $representante['Representante']['tipo']; ?></p>
	
	<div><h3><center> HISTORIAL CREDITO REPRESENTANTE </center></h3></div>
	<!--
	<center>
	  <?php if (empty($representante['Credito'])): ?>
		<p>No tiene Creditos el representante</p>
		<?php endif ?>
		  <?php foreach($representante['Credito'] as $m): ?>
			<p>
			<strong>Prestamo: </strong> <?php echo $m['prestamo']?>

			<strong>Abono: </strong> <?php echo $m['abono']?>
			
			<strong>SubTotal: </strong> <?php echo $m['subtotal']?>

			<strong>Fecha: </strong> <?php echo $m['fecha']?>

			</p>
			<?php endforeach; ?>
-->
<div class="table-responsive" style="width:97%;  !important">
		<table class="table table-bordered table-striped">
				<thead>
					<tr>
				
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('FECHA'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('PRESTAMO'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('ABONO'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('SUBTOTAL'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:5px;"><?php echo __('ACCIONES'); ?></th>
				<tbody>
				  <?php if (empty($representante['Credito'])): ?>
		<p>No tiene Creditos el representante</p>
		<?php endif ?>
		 <?php foreach($representante['Credito'] as $m): ?>
		<tr>
			<td class="active"><?php echo $m['fecha']?>&nbsp;</td>
			<td class="active"><?php echo $m['prestamo']?>&nbsp;</td>
			<td class="active"><?php echo $m['abono']?>&nbsp;</td>
			<td class="active"><?php echo $m['subtotal']?>&nbsp;</td>
			
			<td class="actions">
				<?php echo $this->Html->link(__(''), array('controller' => 'relacionfacturas', 'action' => 'ver', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-list-alt')); ?>
				 <?php echo $this->Html->link(__(''), array('action' => 'edit', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-pencil')); ?> 
				<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-trash')) ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tr>

		<div class="row">
		<div class="col col-sm-12">
		<div class="pull-right tr">

		<span class="total">Total Deuda:</span>
		<span id="total" class="total">
		$ <?php echo $total_creditos; ?>
		</span>
				</thead>
				<tbody style="text-align:center">

				</tbody>
			</table>
		</div>

</center>
<br>
<p>
			<?php
echo $this->Html->link('Volver a Lista de Representantes', array('controller' => 'representantes', 'action' => 'listarepresentantes', array('class' => 'btn btn-success')));
?>
</p>

