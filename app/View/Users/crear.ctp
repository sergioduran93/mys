	<div><h3><center>USUARIOS</center></h3></div>
	<fieldset>
	<?php echo $this->Form->create('User',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>

	<div class="form-group col-md-12">
	    <div class="col-md-4"><?php echo $this->Form->input('oficina_id',array('label'=>'Oficina:','type'=>'select','options'=>$oficinas,'empty'=>'')); ?></div>
	    <div class="col-md-2"><?php echo $this->Form->input('codigo',array('label'=>'Codigo:','type'=>'text','default'=>$codigo,'readonly'=>'readonly')); ?></div>
	    <div class="col-md-4"><?php echo $this->Form->input('role_id',array('label'=>'Role:','type'=>'select','options'=>$roles,'empty'=>'')); ?></div>
	    <div class="col-md-2"><?php echo $this->Form->input('archivo',array('label'=>'Control de Archivo:','type'=>'select','options'=>array('No','Si'),'default'=>'No')); ?></div>
	</div>
	<div class="form-group col-md-12">
	    <div class="col-md-6"><?php echo $this->Form->input('cliente_id',array('label'=>'Cliente:','type'=>'select','options'=>$clientes,'empty'=>'')); ?></div>
	    <div class="col-md-6"><?php echo $this->Form->input('representante_id',array('label'=>'Representante:','type'=>'select','options'=>$representantes,'empty'=>'')); ?></div>
	</div>
	<div class="form-group col-md-12">
	    <div class="col-md-3"><?php echo $this->Form->input('name',array('label'=>'Nombres:','type'=>'text')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('lastname',array('label'=>'Apellidos:','type'=>'text')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('email',array('label'=>'Email:','type'=>'text')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono:','type'=>'text')); ?></div>
	</div>
	<div class="form-group col-md-12">
	    <div class="col-md-3"><?php echo $this->Form->input('ciudad',array('label'=>'Ciudad:','type'=>'select','options'=>$destinos,'empty'=>"")); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('username',array('label'=>'Usuario:','type'=>'text')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('password',array('label'=>'Contraseña:','type'=>'password')); ?></div>
	    <div class="col-md-3"><?php echo $this->Form->input('password2',array('label'=>'Repetir contraseña:','type'=>'password')); ?></div>
	</div>
<!--
	-->
	<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id" style="width:100% !important;">
		<thead>
			<tr>
				<th>Formulario</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Gestión</td>
				<td><input type="checkbox" name="data[User][gestion][]" value="1" style="height:20px;width:20px;"></td>
			</tr>
		</tbody>
	</table>

	<div class="form-group" style="padding-left: 30px;">
		<?php echo $this->Form->button('Guardar',array('type'=>'button','id'=>'btn-submit','class'=>'btn btn-primary push-right'));?>
		<?php echo $this->Form->end();?>
	</div>
<script>
	var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url     = <?php echo "'".Router::url('/')."users'"; ?>;
	var codigos = <?php echo json_encode($codigos); ?>;

	$(document).ready(function() {
		$("#btn-submit").click(function() {
			if($("#UserPassword").val() == $("#UserPassword2").val()){
				$("#UserCrearForm").submit();
			} else {
				alert("Las contraseñas no coinciden");
				$("#UserPassword").val("");
				$("#UserPassword2").val("");
			}
		});

		$("#UserOficinaId").change(function(){
			$("#UserCodigo").val(codigos[$(this).val()]);
		});

		var oTable = $('#tabla_id').dataTable( {
			"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
			"oLanguage": {
				"sUrl": webroot + 'files/es.txt'
			},
			"aaSorting": [[ 1, "asc" ]],
			"bFilter": true,
			"bSort": true,
			"bInfo": true,
			"bLengthChange": true,
	//		"iDisplayLength": 10,
			"bJQueryUI": true,
			"aoColumns": [
		        { "sWidth": "95%"},
		        { "sWidth": "5%"}
		    ],
			"aoColumnDefs": [
				{ "bSortable": false, "aTargets": [1] },
				{ "bSearchable": false, "aTargets": [ 1 ] },
				{ "sClass": "col-actions", "aTargets": [0] }
			]
		});

	});
</script>