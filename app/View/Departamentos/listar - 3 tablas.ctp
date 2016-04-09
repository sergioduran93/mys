<?php
	echo $this->Html->script('jquery');
	echo $this->Html->script('jquery.dataTables');
	echo $this->Html->script('tuktuk');
?>
<h2 class="color theme">Gestión</h2>
<div class="row">
<div class="caja2 gris column_4 offset_3">
	<?php
	echo $this->Form->create('Radio');
	$options=array('dep'=>'Departamento','reg'=>'Región','des'=>'Destino','emp'=>'Tipo de empaque','mer'=>'Tipo de mercancia');

	$attributes=array('legend'=>false ,'separator' => '<br><br>',);
	echo $this->Form->radio('gender',$options,$attributes);
	echo $this->Form->end();
	echo $this->Form->submit('Guardar',array('class'=>'hidden'));
	?>
</div>


<fieldset class="caja2 gris column_4" style="margin-left:20px">
<?php
echo $this->Form->create('Radio');
echo $this->Form->input('codigo',array('label'=>'Código: ','type'=>'text')).'<br>';
echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text'));
echo $this->Form->end('Guardar');
?>
</fieldset>

</div>

<div style="width:90%; margin-left:5%;margin-top:20px;" class="hidden dep">		
		<h2 class="color theme">Departamentos<span class="boton-esquina"><?php echo $this->Html->link('Crear nuevo', array('action' => 'crearDepartamento'),array('class'=>'button tiny')); ?></span></h2>
		<br>		
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead> 
				<tr>
					<th>Id</th>
					<th>Código</th>
					<th>Nombre</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($departamentos as $departamento): ?>		
					<tr>
						<td><?php echo $departamento['Departamento']['id']; ?>&nbsp;</td>
						<td><?php echo $departamento['Departamento']['codigo']; ?>&nbsp;</td>
						<td><?php echo $departamento['Departamento']['nombre']; ?>&nbsp;</td>
						<td style="text-align: center;">
							<nav data-tuktuk="menu">
								<?php echo $this->Html->link('', array('action' => 'editarDepartamento', $departamento['Departamento']['id']), array('class'=>'icon pencil')); ?>
								<?php echo $this->Form->postLink('', array('action' => 'eliminarDepartamento', $departamento['Departamento']['id']), array('class'=>'icon trash','confirm'=>'¿Está seguro que desea eliminar este Departamento?')); ?>

							</nav>
						</td>
					</tr>	
				<?php endforeach; ?>
			</tbody>
		</table>
</div>

<br>

<div style="width:90%; margin-left:5%;" class="hidden reg">		
		<h2 class=" color theme">Regiones<span class="boton-esquina"><?php echo $this->Html->link('Crear nuevo', array('action' => 'crearRegion'),array('class'=>'button tiny')); ?></span></h2>
		<br>		
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id1">
					<thead> 
						<tr>
							<th>Id</th>
							<th>Código</th>
							<th>Nombre</th>
							<th>Departamento</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($regiones as $region): ?>		
							<tr>
								<td><?php echo $region['Region']['id']; ?>&nbsp;</td>
								<td><?php echo $region['Region']['codigo']; ?>&nbsp;</td>
								<td><?php echo $region['Region']['nombre']; ?>&nbsp;</td>
								<td><?php echo $region['Region']['departamento']; ?>&nbsp;</td>
								<td style="text-align: center;">
									<nav data-tuktuk="menu">
										<?php echo $this->Html->link('', array('action' => 'editarRegion', $region['Region']['id']), array('class'=>'')); ?>
										<?php echo $this->Form->postLink('', array('action' => 'eliminarRegion', $region['Region']['id']), array('class'=>'icon trash','confirm'=>'¿Está seguro que desea eliminar esta Región?')); ?>

									</nav>
								</td>
							</tr>	
						<?php endforeach; ?>
					</tbody>
				</table>
</div>

<br>

<div style="width:90%; margin-left:5%;"  class="">		
		<h2 class=" color theme">Destinos<span class="boton-esquina"><?php echo $this->Html->link('Crear nuevo', array('action' => 'crearDestino'),array('class'=>'button tiny')); ?></span></h2>
		<br>		
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id2">
					<thead> 
						<tr>
							<th>Id</th>
							<th>Código</th>
							<th>Nombre</th>
							<th>Departamento</th>
							<th>Región</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($destinos as $destino): ?>		
							<tr>
								<td><?php echo $destino['Destino']['id']; ?>&nbsp;</td>
								<td><?php echo $destino['Destino']['codigo']; ?>&nbsp;</td>
								<td><?php echo $destino['Destino']['nombre']; ?>&nbsp;</td>
								<td><?php echo $destino['Destino']['departamento']; ?>&nbsp;</td>
								<td><?php echo $destino['Destino']['region']; ?>&nbsp;</td>
								<td style="text-align: center;">
									<nav data-tuktuk="menu">
										<?php echo $this->Html->link('', array('action' => 'editarDestino', $destino['Destino']['id']), array('class'=>'icon pencil')); ?>
										<?php echo $this->Form->postLink('', array('action' => 'eliminarDestino', $destino['Destino']['id']), array('class'=>'icon trash','confirm'=>'¿Está seguro que desea eliminar este Destino?')); ?>

									</nav>
								</td>
							</tr>	
						<?php endforeach; ?>
					</tbody>
				</table>
</div>

<br>

<div style="width:90%; margin-left:5%;" class="">		
		<h2 class=" color theme">Tipos de Empaques<span class="boton-esquina"><?php echo $this->Html->link('Crear nuevo', array('action' => 'crearEmpaque'),array('class'=>'button tiny')); ?></span></h2>
		<br>		
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id3">
					<thead> 
						<tr>
							<th>Id</th>
							<th>Código</th>
							<th>Nombre</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($empaques as $empaque): ?>		
							<tr>
								<td><?php echo $empaque['Empaque']['id']; ?>&nbsp;</td>
								<td><?php echo $empaque['Empaque']['codigo']; ?>&nbsp;</td>
								<td><?php echo $empaque['Empaque']['nombre']; ?>&nbsp;</td>
								<td style="text-align: center;">
									<nav data-tuktuk="menu">
										<?php echo $this->Html->link('', array('action' => 'editarEmpaque', $empaque['Empaque']['id']), array('class'=>'icon pencil')); ?>
										<?php echo $this->Form->postLink('', array('action' => 'eliminarEmpaque', $empaque['Empaque']['id']), array('class'=>'icon trash','confirm'=>'¿Está seguro que desea eliminar este Tipo de Empaque?')); ?>

									</nav>
								</td>
							</tr>	
						<?php endforeach; ?>
					</tbody>
				</table>
</div>

<br>

<div style="width:90%; margin-left:5%;" class="">		
		<h2 class=" color theme">Tipos de Mercancias<span class="boton-esquina"><?php echo $this->Html->link('Crear nuevo', array('action' => 'crearMercancia'),array('class'=>'button tiny')); ?></span></h2>
		<br>		
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id4">
					<thead> 
						<tr>
							<th>Id</th>
							<th>Código</th>
							<th>Nombre</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($mercancias as $mercancia): ?>		
							<tr>
								<td><?php echo $mercancia['Mercancia']['id']; ?>&nbsp;</td>
								<td><?php echo $mercancia['Mercancia']['codigo']; ?>&nbsp;</td>
								<td><?php echo $mercancia['Mercancia']['nombre']; ?>&nbsp;</td>
								<td style="text-align: center;">
									<nav data-tuktuk="menu">
										<?php echo $this->Html->link('', array('action' => 'editarMercancia', $mercancia['Mercancia']['id']), array('class'=>'icon pencil')); ?>
										<?php echo $this->Form->postLink('', array('action' => 'eliminarMercancia', $mercancia['Mercancia']['id']), array('class'=>'icon trash','confirm'=>'¿Está seguro que desea eliminar este Tipo de Mercancia?')); ?>

									</nav>
								</td>
							</tr>	
						<?php endforeach; ?>
					</tbody>
				</table>
</div>

<script>

var webroot =<?php echo "'".Router::url('/')."app/webroot/'"; ?>;

$(document).ready(function(){

	$('#RadioGenderDep').change(function(){
		$('.dep').removeClass('hidden');
		$('.reg').addClass('hidden');
	});

	$('#RadioGenderReg').change(function(){
		$('.reg').removeClass('hidden');
		$('.dep').addClass('hidden');
	});


	$('#tabla_id').dataTable( {

		"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [3] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]

	});

	$('#tabla_id1').dataTable( {

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
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [4] },
			{ "sClass": "col-actions", "aTargets": [4] }
		]

	});

		$('#tabla_id2').dataTable( {



		"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},





		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [5] },
			{ "sClass": "col-actions", "aTargets": [5] }
		]

	});

	$('#tabla_id3').dataTable( {

		"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},


		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [3] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]

	});





	$('#tabla_id4').dataTable( {

		"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},


		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [3] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]

	});

})

</script>

