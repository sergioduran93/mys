<?php 
		echo $this->Html->css('kube');
		echo $this->Html->css('superfish');
		echo $this->Html->css('jquery-ui-1.10.3_azul.custom'); 
        echo $this->Html->css('jquery.dataTables_themeroller'); 
		echo $this->Html->css('halflings');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery');
		echo $this->Html->script('jquery-1.9.1.min');
		echo $this->Html->script('hoverIntent');
		echo $this->Html->script('superfish');
		echo $this->Html->script('jquery.dataTables');
?>
<div class="row caja gris column_4">
	<?php
	echo $this->Form->create('Radio');
	$options=array('dep'=>'Departamento','reg'=>'Región','des'=>'Destino','emp'=>'Tipo de empaque','mer'=>'Tipo de mercancia');
	$attributes=array('legend'=>false ,'separator' => '<br><br>',);
	echo $this->Form->radio('gender',$options,$attributes);
	echo $this->Form->end('Guardar');
	?>
</div>

<fieldset class="caja gris column_5" style="margin-left:20px">
<?php
	echo $this->Form->create('Radio');
	echo $this->Form->input('codigo',array('label'=>'Código: ','type'=>'text')).'<br>';
	echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text'));
	echo $this->Form->end('Guardar');
?>
</fieldset>


<div class ="row">
	<div class ="column_2">
		<h3>Acciones</h3>
		<ul>
			<?php echo $this->Html->link('Crear nuevo', array('action' => 'add'),array('class'=>'button tiny secondary')); ?>
		</ul>
	</div>

	<div class="column_8">
		
		<fieldset class ="">
		<?php 	
			echo $this->Form->create('Variable');
			echo $this->Form->input('id',array('class'=>'column_3'));
			echo $this->Form->input('name',array('class'=>'column_3'));
			echo $this->Form->input('username',array('class'=>'column_3'));
			echo $this->Form->input('email',array('class'=>'column_3'));
			echo $this->Form->submit('Enviar',array('class'=>'button tiny secondary'));
		?>
		</fieldset>
		<div class="">
			<h4 class="icon group color theme">Usuarios</h4>
			<div class="">
				<table cellpadding="0" cellspacing="0" border="0" class="pretty" id="tabla_id">
					<thead>
						<tr>
							<th>Identificación</th>
							<th>Nombre</th>
							<th>Usuario</th>
							<th>Email</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $user): ?>		
							<tr>
								<td><?php echo $user['User']['id']; ?>&nbsp;</td>
								<td><?php echo $user['User']['name']; ?>&nbsp;</td>
								<td><?php echo $user['User']['username']; ?>&nbsp;</td>
								<td><?php echo $user['User']['email']; ?>&nbsp;</td>
								<td style="text-align: center;">
									<nav data-tuktuk="menu">
										<?php echo $this->Html->link('Ver', array('action' => 'view', $user['User']['id']), array('class'=>'icon eye-open')); ?>
										<?php if ($current_user['id'] == $user['User']['id'] || $current_user['role'] == 'admin'): ?>
											<?php echo $this->Html->link('Editar', array('action' => 'edit', $user['User']['id']), array('class'=>'icon pencil')); ?>
											<?php echo $this->Form->postLink('Eliminar', array('action' => 'delete', $user['User']['id']), array('class'=>'icon trash','confirm'=>'Are you sure you want to delete that user?')); ?>
										<?php endif; ?>
									</nav>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>

<script>
var oTable;
var webroot =<?php echo "'".Router::url('/')."app/webroot/'"; ?>;
$(document).ready(function(){


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
		"bJQueryUI": true

	});


})

</script>