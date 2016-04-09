<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
?>
<div class="row" style="width:90%; margin-left:5%;">   

	<br>
	<div><h3><center>DESTINATARIOS</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Destinatario',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('role',array('type'=>'hidden','default'=>$usuario_actual['role_id'])); ?>

    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'select','options'=>$tipo,'empty'=>false,'default'=>'Natural','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('documento',array('label'=>'<span id="label-documento">Documento:</span>','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('nombre1',array('label'=>'Nombre: ','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3 DestinatarioApellidosDiv"><?php echo $this->Form->input('nombre2',array('label'=>"Nombre 2: ",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-3 DestinatarioApellidosDiv"><?php echo $this->Form->input('apellido1',array('label'=>'Apellido: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3 DestinatarioApellidosDiv"><?php echo $this->Form->input('apellido2',array('label'=>'Apellido 2:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
   		<div class="col-md-3"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>    	
        <div class="col-md-2"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-1"><?php echo $this->Form->input('ext',array('label'=>'Extension:','type'=>'text','class'=>'col-md-6')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('fax',array('label'=>'Fax:','type'=>'text')); ?></div>    	
        <div class="col-md-3"><?php echo $this->Form->input('email',array('label'=>'Email:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12" style="margin-bottom: 10px;">
		<div class="col-md-12"><?php echo $this->Form->input('destinos',array('label'=>'Destinos: ','multiple'=>true,'class'=>'chosen-select','type'=>'select','options'=>$destinos,'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	</div>
    <div class="form-group col-md-12 btns">
    	<div class="panel panel-info thumbnail col-md-6" style="margin-bottom:0px;">
			<div class ="panel-heading">
				<span style="font-weight: bold">Contactos:</span>
				<div style="padding: 0px 15px 0px 10px; float:right;" class="btn btn-success" data-bind='click: addUser'>
					<span class="glyphicon glyphicon-plus"></span> Agregar
				</div>
			</div>
			<table class='contactsEditor col-md-12'>
		        <tr>
		            <th>Nombre</th>
		            <th>Teléfono</th>
		            <th></th>
		        </tr>
		        <tbody data-bind="foreach: users">
		            <tr>
		                <td><input type="text" name="data[Destinatario][contacto][nombre][]" data-bind='value: nombre'/></td>
		                <td><input type="text" name="data[Destinatario][contacto][telefono][]" data-bind='value: telefono'/></td>
		                <td style="padding:0px; float:right;" class="btn btn-danger" data-bind='click: $root.removeUser'>
							<span class="glyphicon glyphicon-remove"></span>
						</td>
		            </tr>
		        </tbody>
		    </table>
    	</div>
    </div>
    <table id="tabla_id">
		<thead> 
			<tr>
				<th>id</th>
				<th>Documento</th>
				<th>Nombre</th>
				<th>Teléfono</th>
				<th>Email</th>
				<th>Dirección</th>
				<th>Contacto</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
</div>

<script>
	var webroot       = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var destinatarios = <?php echo json_encode($destinatarios); ?>;
	
$(document).ready(function(){

	$('#DestinatarioCrearForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});

	$("#btn-limpiar").click(function(){
		$("#DestinatarioDestinos").trigger("chosen:updated");
		$(".DestinatarioApellidosDiv").show();
		$("#label-documento").text("Documento: ");
	    viewModel.users.removeAll();
		viewModel.addUser();
	});

	$("#DestinatarioDestinos").chosen({
    	no_results_text           : 'No se encuentra el destino.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_multiple : "Seleccione los destinos"
    });

	$("#DestinatarioTipo").change(function(){
		if($(this).val() == "Juridica"){
			$(".DestinatarioApellidosDiv").hide();
			$("#label-documento").text("Identificación: ");
		} else {
			$(".DestinatarioApellidosDiv").show();
			$("#label-documento").text("Documento: ");
		}
	});

	var User = function(data) {
	    var self = this;
	    self.id = data.id;
	    self.nombre = data.nombre;
		self.telefono = data.telefono;
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
	    viewModel.users.push(new User({ id: 0, nombre:"", telefono: "" }));
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


	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	$.each( destinatarios, function( key, value ) {
				if(id == value.Destinatario.id){
					$('#DestinatarioId').val(value.Destinatario.id);
					$('#DestinatarioTipo').val(value.Destinatario.tipo);
					if(value.Destinatario.tipo == "Juridica") {
						$(".DestinatarioApellidosDiv").hide();
						$("#label-documento").text("Identificación: ");
					} else {
						$(".DestinatarioApellidosDiv").show();
						$("#label-documento").text("Documento: ");
					}

					$('#DestinatarioCelular').val(value.Destinatario.celular);
					$('#DestinatarioFax').val(value.Destinatario.fax);
					$('#DestinatarioEmail').val(value.Destinatario.email);
					$('#DestinatarioDocumento').val(value.Destinatario.documento);
					$('#DestinatarioNombre1').val(value.Destinatario.nombre1);
					$('#DestinatarioNombre2').val(value.Destinatario.nombre2);
					$('#DestinatarioApellido1').val(value.Destinatario.apellido1);
					$('#DestinatarioApellido2').val(value.Destinatario.apellido2);
					$('#DestinatarioDireccion').val(value.Destinatario.direccion);
					$('#DestinatarioTelefono').val(value.Destinatario.telefono);
					$('#DestinatarioExt').val(value.Destinatario.ext);

					$("#DestinatarioDestinos option").attr("selected",false);
					if(value.Destinatario.destinos != null){
						$.each( value.Destinatario.destinos, function( key2, value2 ) {
							$("#DestinatarioDestinos option").each(function( key, value ) {
								var actual = $(value).val();
								if(actual == value2){
									$(this).attr("selected","selected");
									$("#DestinatarioDestinos").trigger("chosen:updated");
								}
							});
						});
					} else {
						$("#DestinatarioDestinos").trigger("chosen:updated");
					}
					viewModel.loadUpdatedData(value.Destinatario.contacto);
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
		"sAjaxSource": webroot+'sources/destinatarios.txt',
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