<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox');
?>
<div class="row" style="width:90%; margin-left:5%;">   

	<br>
	<div><h3><center>DESTINATARIO NUEVO</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Destinatario',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('info',array('type'=>'hidden','default'=>'[]')); ?>

    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'select','options'=>$tipo,'empty'=>false,'default'=>'Natural')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('documento',array('label'=>'<span id="label-documento">Documento:</span>','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('nombre1',array('label'=>'Nombre: ')); ?></div>
        <div class="col-md-3 DestinatarioApellidosDiv"><?php echo $this->Form->input('nombre2',array('label'=>"Nombre 2: ")); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-3 DestinatarioApellidosDiv"><?php echo $this->Form->input('apellido1',array('label'=>'Apellido: ','type'=>'text')); ?></div>
        <div class="col-md-3 DestinatarioApellidosDiv"><?php echo $this->Form->input('apellido2',array('label'=>'Apellido 2:','type'=>'text')); ?></div>
   		<div class="col-md-3"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text')); ?></div>    	
        <div class="col-md-2"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono:','type'=>'text')); ?></div>
        <div class="col-md-1"><?php echo $this->Form->input('ext',array('label'=>'Extension:','type'=>'text','class'=>'col-md-6')); ?></div>
    </div>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('fax',array('label'=>'Fax:','type'=>'text')); ?></div>    	
        <div class="col-md-3"><?php echo $this->Form->input('email',array('label'=>'Email:','type'=>'text')); ?></div>
    </div>
    <div class="form-group col-md-12" style="margin-bottom: 10px;">
		<div class="col-md-12"><?php echo $this->Form->input('destinos',array('label'=>'Destinos: ','multiple'=>true,'class'=>'chosen-select','type'=>'select','options'=>$destinos)); ?></div>
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
	<?php echo $this->Form->button("Guardar",array("id"=>'btn-guardar',"type"=>'button',"class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
</div>

<script>
	var webroot   = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var destinoId = <?php echo "'".$destinoId."'"; ?>;
	var sendInfo  = new Array();
$(document).ready(function(){

	$("#DestinatarioDestinos").val(destinoId);
	$("#DestinatarioDestinos").trigger("chosen:updated");

	$("#btn-guardar").click(function(){
		postData = $("#DestinatarioCrear2Form").serializeArray();
		var formURL  = $("#DestinatarioCrear2Form").attr("action");
		var posting  = $.post( formURL, postData);
		posting.done(function( data ) {
			var doc = $("#DestinatarioDocumento").val();
			var no1 = $("#DestinatarioNombre1").val();
			var no2 = $("#DestinatarioNombre2").val();
			var ap1 = $("#DestinatarioApellido1").val();
			var ap2 = $("#DestinatarioApellido2").val();
			var dir = $("#DestinatarioDireccion").val();
			var tel = $("#DestinatarioTelefono").val();
			var te2 = $("#DestinatarioCelular").val();
			var ema = $("#DestinatarioEmail").val();
			var fax = $("#DestinatarioFax").val();
			sendInfo[0] = doc;
			sendInfo[1] = no1+" "+no2+" "+ap1+" "+ap2;
			sendInfo[2] = dir;
			sendInfo[3] = tel;
			sendInfo[4] = te2;
			sendInfo[5] = ema;
			sendInfo[6] = fax;
			var jsonInfo = JSON.stringify(sendInfo);
			$("#DestinatarioInfo").val(jsonInfo);
			parent.$.fancybox.close();
		});
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


	})
</script>