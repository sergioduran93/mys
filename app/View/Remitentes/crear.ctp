<?php 
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
?>

<div class="row" style="width:90%; margin-left:5%;">
	<br>
	<div><h3><center>REMITENTES</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Remitente',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
    <div class="form-group col-md-12">
        <div class="col-md-4"><?php echo $this->Form->input('documento',array('label'=>'Documento:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-8"><?php echo $this->Form->input('nombre',array('label'=>'Nombre:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-4"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>    	
        <div class="col-md-4"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-4"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-4"><?php echo $this->Form->input('ciudad',array('label'=>'Ciudad:','type'=>'select','options'=>$destinos,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>    	
        <div class="col-md-4"><?php echo $this->Form->input('email',array('label'=>'Email:','type'=>'text')); ?></div>
    </div>
	<div class="form-group panel panel-info thumbnail col-md-12" style="margin-bottom: 2px;margin-left: 30px;width: 97%;">
		<div class ="panel-heading">
			<span style="font-weight: bold">Contactos:</span>
			<div style="padding: 0px 15px 0px 10px; float:right;" class="btn btn-success" data-bind='click: addUser'>
				<span class="glyphicon glyphicon-plus"></span> Agregar
			</div>
		</div>
		<div class='contactsEditor col-md-12'>
	        <div style="width:95%">
	            <div class="col-md-3">Cargo</div>
	            <div class="col-md-3">Nombre</div>
	            <div class="col-md-3">Teléfono</div>
	            <div class="col-md-3">Correo</div>
	        </div>
	        <div style="width:5%">
	        </div>
	        <div data-bind="foreach: users">
	            <div class="col-md-12">
					<div style="width:95%">
						<div class="col-md-3" style="padding:0px;"><?php echo $this->Form->input('contacto.cargo.',array('label'=>false,'data-bind'=>'value: cargo','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
						<div class="col-md-3" style="padding:0px;"><?php echo $this->Form->input('contacto.nombre.',array('label'=>false,'data-bind'=>'value: nombre','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
						<div class="col-md-3" style="padding:0px;"><?php echo $this->Form->input('contacto.telefono.',array('label'=>false,'data-bind'=>'value: telefono','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
						<div class="col-md-3" style="padding:0px;"><?php echo $this->Form->input('contacto.correo.',array('label'=>false,'data-bind'=>'value: correo','type'=>'text')); ?></div>
					</div>
					<div class="btn btn-danger" style="width:5%;padding:0px; float:right;" data-bind='click: $root.removeUser'>
							<span class="glyphicon glyphicon-remove"></span>
						</div>
					</div>
					<hr class="clearing" />
	            </div>
	        </div>
	    </div>
	</div>
    <table id="tabla_id">
		<thead> 
			<tr>
				<th>id</th>
				<th>Documento</th>
				<th>Nombre</th>
				<th>Teléfono</th>
				<th>Dirección</th>
				<th>Celular</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<?php echo $this->Form->button("Guardar",array('id'=>"btn-submit","class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
	<?php echo $this->Form->end();?>
	<hr class="clearing" />

</div>

<script>
	var webroot    = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var remitentes = <?php echo json_encode($remitentes); ?>;
	
	var User = function(data) {
		var self      = this;
		self.id       = data.id;
		self.cargo    = data.cargo;
		self.nombre   = data.nombre;
		self.telefono = data.telefono;
		self.correo   = data.correo;
	}
	var dataMappingOptions = {
	    key: function(data) {
	        return data.id;
	    },
	    create: function(options) {
	        return new User(options.data);
	    }
	};
	var viewModel = {
	    users: ko.mapping.fromJS([]),
	    loadUpdatedData: function(newData) {
	        ko.mapping.fromJS(newData, viewModel.users);
	    },
	};
	viewModel.addUser = function() {
	    viewModel.users.push(new User({ id: 0, cargo:"", nombre:"", telefono: "", correo: "" }));
	};
	viewModel.removeUser = function(selected) {
		if(confirm('¿Esta seguro de eliminar este contacto?')){
			viewModel.users.remove(selected);
		}
	};
	viewModel.removeUserTotal = function() {
	    viewModel.users.removeAll();
	};
	ko.applyBindings(viewModel);
	viewModel.addUser();
$(document).ready(function(){

	$("#btn-submit").click(function(){
		$('#RemitenteCrearForm').bootstrapValidator('validate');
		if($("#RemitenteCrearForm").data('bootstrapValidator').isValid()) {
			itsclicked = true;
			$("#RemitenteCrearForm").data('bootstrapValidator').defaultSubmit(); 
			$('#RemitenteCrearForm').bootstrapValidator('validate');
			$("#RemitenteCrearForm").submit(function(event){
					return;
					//event.preventDefault();
			});
		}
	});


	$('#RemitenteCrearForm').bootstrapValidator({
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});


	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	$.each( remitentes, function( key, value ) {
				if(id == value.Remitente.id){
					$('#RemitenteId').val(value.Remitente.id);
					$('#RemitenteDocumento').val(value.Remitente.documento);
					$('#RemitenteNombre').val(value.Remitente.nombre);
					$('#RemitenteCelular').val(value.Remitente.celular);
					$('#RemitenteTelefono').val(value.Remitente.telefono);
					$('#RemitenteEmail').val(value.Remitente.email);
					$('#RemitenteDireccion').val(value.Remitente.direccion);
					viewModel.users.removeAll();
					viewModel.loadUpdatedData(value.Remitente.contacto);
				}
			});
	    }
	});

	$('#tabla_id').css('cursor', 'pointer');
	var odd = false;
	var even = false;
	$('#tabla_id').on('mouseenter', 'tr', function(event) {
		if ($(this).hasClass("odd")){
			odd = true;
			$(this).removeClass('odd').addClass('row-select');
		}
		if ($(this).hasClass("even")){
			even = true;
			$(this).removeClass('even').addClass('row-select');
		}
	});
	$('#tabla_id').on('mouseleave', 'tr', function(event) {
		if (odd){
			odd = false;
			$(this).removeClass('row-select').addClass('odd');
		}
		if (even){
			even = false;
			$(this).removeClass('row-select').addClass('even');
		}
	});

	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/remitentes.txt',
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
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});

	})
</script>