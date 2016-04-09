<?php 
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
?>
<style type="text/css">
td{
	padding:0px !important;
}
</style>
<div class="row" style="width:90%; margin-left:5%;">   
	<br>
	<div><h3><center>INGRESOS INFORME</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Ingreso',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<table class="table">
		<thead>
			<th>Conductor</th>
			<th>Vehiculo</th>
			<th>Cliente</th>
			<th>Cantidad</th>
		</thead>
		<tbody>
		<?php
			foreach ($cuenta as $key => $value) {
				$condVehi = explode("*", $key);
				$countClien = count($value);
				echo '<tr>';
				echo '<td rowspan="'.$countClien.'">'.$condVehi[0].'</td>';
				echo '<td rowspan="'.$countClien.'">'.$condVehi[1].'</td>';
				if($countClien > 0){
					$primero = true;
					foreach ($value as $key2 => $value2) {
						if($primero){
							$primero = false;
						} else {
							echo '<tr>';
						}
						echo '<td>'.$key2.'</td>';
						echo '<td>'.$value2.'</td>';
						echo '</tr>';
					}
				}
				
				
				
			}
		?>
		</tbody>
	</table>
<!--
    <table id="tabla_id">
		<thead>
			<tr>
				<th></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
			</tr>
			<tr>
				<th>id</th>
				<th>Fecha</th>
				<th>Codigo Barras</th>
				<th>Cliente</th>
				<th>Cliente CC</th>
				<th>Placa</th>
				<th>Conductor</th>
				<th>Conductor CC</th>
				<th>Usuario</th>
				<th>Oficina</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
-->
	<?php echo $this->Form->end();?>
</div>

<script>
	var webroot  =<?php echo "'".Router::url('/')."app/webroot/'"; ?>;
$(document).ready(function(){


	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/ingresos.txt',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},

		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0] },
			{ "sClass": "col-actions", "aTargets": [1] }
		]
	});

	var asInitVals = new Array();

	$("thead input").keyup( function (){
		oTable.fnFilter(this.value, $("thead input").index(this)+1 );
	});

	$("thead input").each( function (i){
		asInitVals[i] = this.value;
	});

	$("thead input").focus( function (){
		if ( this.className === "search_init" ){
			this.value     = "";
			this.className = "";
		}
	});

	$("thead input").blur( function (i){
		if ( this.value === "" ){
			this.className = "search_init";
			this.value     = asInitVals[$("thead input").index(this)+1];
		}
	});

	});
</script>