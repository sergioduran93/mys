<?php 
	echo $this->Html->css('kube');
	echo $this->Html->css('superfish');
	echo $this->Html->css('jquery-ui-1.10.3_azul.custom'); 
	echo $this->Html->css('jquery.dataTables_themeroller'); 
	echo $this->Html->css('halflings');
	echo $this->Html->css('jquery.fancybox');
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery-1.9.1.min');
	echo $this->Html->script('hoverIntent');
	echo $this->Html->script('superfish');
	echo $this->Html->script('jquery.dataTables');
	echo $this->Html->script('knockout');
	echo $this->Html->script('jquery.fancybox');
	echo $this->Html->script('helpers/Tarifas');
?>

<div class="row" style="width:90%; margin-left:5%;">	
	<br>	
	<?php echo $this->Form->create('Convenio');?>

		<div><h3><center>ASIGNAR TRANSPORTE</center></h3></div>
	    <fieldset>
			    <div class="units-row-end units-split">
			        <div class="unit-20"><?php echo $this->Form->input('cliente',array('label'=>'Municipio: ','type'=>'text')); ?></div>
			        <div class="unit-50"><?php echo $this->Form->input('nombre',array('label'=>'Código: ','type'=>'text','style'=>'width:100%')); ?></div>
			        <div class="unit-30">
			        	<?php
						$options=array('Tra'=>'Transportadoras ','Veh'=>'Vehículos ');
						$attributes=array('legend'=>false,'default'=>'Tra');
						echo $this->Form->radio('tarifa',$options,$attributes);
						?>
					</div>
			    </div>
	<div id="nota" class="message" style="text-align: center;width: 35%;">
		<i class=""></i> No se ha seleccionado un municipio.
	</div>
			    <div class="units-row">
			        <div class="unit-50 b"><?php echo $this->Form->input('region',array('label'=>'NIT: ','type'=>'text','class'=>'unit-100')); ?></div>
			        <div class="unit-50 b"><?php echo $this->Form->input('destino1',array('label'=>'Razón social: ','type'=>'text','class'=>'unit-100')); ?></div>
			        <div class="unit-50 a"><?php echo $this->Form->input('destino2',array('label'=>"Placa:",'type'=>'text','class'=>'unit-100')); ?></div>
			        <div class="unit-50 a"><?php echo $this->Form->input('destino3',array('label'=>'Nombre del conductor: ','type'=>'text','class'=>'unit-100')); ?></div>
			    </div>
			<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
				<thead>
					<tr>
						<th>Cod. Departamento</th>
						<th>Nombre Departamento</th>
						<th>Cod. Región</th>
						<th>Nombre Región</th>
						<th>Cod. Destino</th>
						<th>Nombre Destino</th>
					</tr>
				</thead>
				<tbody style="text-align:center">
					<?php foreach ($destinosInfo as $des): ?>		
					<tr>
						<td><?php echo $des['Destino']['departamentoCodigo']; ?>&nbsp;</td>
						<td><?php echo $des['Destino']['departamentoNombre']; ?>&nbsp;</td>
						<td><?php echo $des['Destino']['regionCodigo']; ?>&nbsp;</td>
						<td><?php echo $des['Destino']['regionNombre']; ?>&nbsp;</td>
						<td><?php echo $des['Destino']['codigo']; ?>&nbsp;</td>
						<td><?php echo $des['Destino']['nombre']; ?>&nbsp;</td>
					</tr>	
			<?php endforeach; ?>
				</tbody>
			</table>
	    </fieldset>
	<?php echo $this->Form->submit("Guardar",array("class"=>'btn btn-blue',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>




<script>
	var webroot   = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;

$(document).ready(function(){

	$('#transportadoras1').click(function () {
		$('.b').show();
		$('.a').hide();
	});
	$('#vehiculos1').click(function () {
		$('.b').hide();
		$('.a').show();
	});
	
	$("#ConvenioDestino2").keyup( function (){
		oTable.fnFilter(this.value, 2 );
	});

	$("#ConvenioDestino3").keyup( function (){
		oTable.fnFilter(this.value, 2 );
	});
	
	$("#ConvenioDestino2").keyup( function (){
		oTable.fnReloadAjax(webroot+'sources/destinos_Tarifas.txt');
		oTable.fnSettings().aoColumns[2].nTh.innerHTML = 'Cod depart.';
		oTable.fnSettings().aoColumns[3].nTh.innerHTML = 'Nombre depart.';
	});

	$("#ConvenioDestino3").keyup( function (){
		oTable.fnReloadAjax(webroot+'sources/destinos_Tarifas.txt');
		oTable.fnSettings().aoColumns[6].nTh.innerHTML = 'Cod destino';
		oTable.fnSettings().aoColumns[7].nTh.innerHTML = 'Nombre destino';
	});

	var oTable = $('#tabla_id').dataTable( {
		//"sAjaxSource": webroot+'sources/clientes_Tarifas.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
		"sScrollXInner": "100%",
		"bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
		"sUrl": webroot + 'files/es.txt'
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		//		"iDisplayLength": 10,
		"bJQueryUI": true,		
		"bAutoWidth": false,
	    "aoColumns": [
	        { "sWidth": "10%"},
	        { "sWidth": "20%"},
	        { "sWidth": "15%"},
	        { "sWidth": "20%"},
	        { "sWidth": "15%"},
	        { "sWidth": "20%"}

	    ],

		"aoColumnDefs": [
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});


})
</script>