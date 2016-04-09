<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.jsontotable.min');
	echo $this->Html->script('jquery.fancybox');
	echo $this->Html->css('jquery.fancybox');
?>

<style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
<div class="row" style="width:90%; margin-left:5%;">   

	<div><h3><center>REPRESENTANTES</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Representante',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('role',array('type'=>'hidden','default'=>$usuario_actual['role_id'])); ?>
	<div class="form-group col-md-12">
		<div class="col-md-20"><?php echo $this->Form->input('identificacion',array('label'=>'Documento:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('nombre1',array('label'=>'1er Nombre:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('nombre2',array('label'=>'2do Nombre:','type'=>'text')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('apellido1',array('label'=>'1er Apellido:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('apellido2',array('label'=>'2do Apellido:','type'=>'text')); ?></div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-20"><?php echo $this->Form->input('codigo',array('label'=>'Código (Población):','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('celular',array('label'=>'Celular:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('telefono1',array('label'=>'Teléfono 1:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('telefono2',array('label'=>'Teléfono 2:','type'=>'text')); ?></div>
		<div class="col-md-20"><?php echo $this->Form->input('telefono3',array('label'=>'Teléfono 3:','type'=>'text')); ?></div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-4"><?php echo $this->Form->input('oficina',array('label'=>'Oficina que recauda contraentrega:','type'=>'select','options'=>$oficina,'empty'=>"",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-4"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text','class'=>'col-md-100 form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-4"><?php echo $this->Form->input('email',array('label'=>'Correo:','type'=>'text','class'=>'col-md-100')); ?></div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-2"><?php echo $this->Form->input('contraentrega',array('label'=>'Contraentrega: ','type'=>'select','options'=>$contraentrega)); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('servicio',array('label'=>'Servicio: ','type'=>'select','options'=>$servicio)); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('banco',array('label'=>'Banco:','type'=>'select','options'=>$banco,'empty'=>"",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('cuenta',array('label'=>'No. de cuenta:','type'=>'text','class'=>'form-control')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('tipo',array('label'=>'Tipo de cuenta:','type'=>'select','options'=>$tipo,'empty'=>"",'class'=>'form-control')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('giro',array('label'=>'Giro bancaria:','type'=>'select','options'=>$giro,'empty'=>"",'class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
	</div>
	<div class="form-group col-md-12" style="margin-bottom:10px;">
		<div class="col-md-12"><?php echo $this->Form->input('destinos',array('label'=>'Destinos: ','multiple'=>true,'class'=>'chosen-select form-control','type'=>'select','options'=>$destinos,'data-bv-notempty'=>'true')); ?></div>
	</div>

<div id="datosNego">

	<div class="panel panel-info col-md-12" style="margin-bottom: 10px;padding:0px;margin-left:30px;width: 94%;">
		<div class ="panel-heading">
			<div class="col-md-12">
			DATOS DE NEGOCIACIÓN
			<?php echo $this->Form->button('Rangos',array('type'=>'button','id'=>'btnRangos','class'=>'btn btn-success','style'=>'float:right;padding:0px 10px;'));?>
			</div>
		</div>
		<div>
			<div class="form-group col-md-12">
				<div id="X">
					<div class="col-md-2"><?php echo $this->Form->input('digitar',array('label'=>'Digitar: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('escanear',array('label'=>'Escanear: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('base',array('label'=>'Valor general: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('caja',array('label'=>'Caja: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('sobre',array('label'=>'Sobre: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('paquete',array('label'=>'Paquete: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<?php echo $this->Form->input('rangos',array('type'=>'hidden','id'=>'rangoVal')); ?>
					<div class="col-md-2" style="margin-top: 20px;">
					</div>
				</div>
			</div>
			<center>
			<table id="tableRangos" class="table table-hover" style="width:50%;">
			</table>
			</center>
		</div>
	</div>
	<div class="panel panel-success col-md-12" style="margin-bottom: 10px;padding:0px;margin-left:30px;width: 94%;">
		<div class ="panel-heading">
			<div class="col-md-12">
			DATOS DE NEGOCIACIÓN <strong>(ESPECIAL)</strong>
			</div>
		</div>
		<div>
			<div class="form-group col-md-12">
				<div id="X">
					<div class="col-md-2"><?php echo $this->Form->input('digitar_espe',array('label'=>'Digitar: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('escanear_espe',array('label'=>'Escanear: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('base_espe',array('label'=>'Valor general: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('caja_espe',array('label'=>'Caja: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('sobre_espe',array('label'=>'Sobre: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('paquete_espe',array('label'=>'Paquete: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel panel-danger col-md-12" style="margin-bottom: 10px;padding:0px;margin-left:30px;width: 94%;">
		<div class ="panel-heading">
			<div class="col-md-12">
				DATOS DE NEGOCIACIÓN <strong>(CLIENTE)</strong>
				<div style="padding: 0px 8px;float:right;" class="btn btn-default" data-bind='click: addUser'>
					<span class="glyphicon glyphicon-plus"></span>Agregar
				</div>
			</div>
		</div>
		<div>
			<div class="form-group col-md-12"  data-bind='foreach: users'>
				<div data-bind='attr: {id: $index() } '>
					<div class="col-md-3"><?php echo $this->Form->input('clientes.',array('label'=>'Cliente:','class'=>'chosen-select','type'=>'select','empty'=>'','options'=>$clientes,'data-bind'=>'value: cliente, attr: {id: "tableCliente"+$index() }')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('base_clie.',array('label'=>'Valor general: ','type'=>'text','data-bind'=>'value: base')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('caja_clie.',array('label'=>'Caja: ','type'=>'text','data-bind'=>'value: caja')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('sobre_clie.',array('label'=>'Sobre: ','type'=>'text','data-bind'=>'value: sobre')); ?></div>
					<div class="col-md-2"><?php echo $this->Form->input('paquete_clie.',array('label'=>'Paquete:','type'=>'text','data-bind'=>'value: paquete')); ?></div>
					<div style="float:left;margin-top:20px;">
						<?php echo $this->Form->button('<span class="glyphicon glyphicon-remove"></span>',array('style'=>'padding:5px;','type'=>'button','class'=>'btn btn-danger push-right','data-bind'=>'click: $root.removeUser','escape'=>false));?>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

	<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
		<thead>
			<tr>
				<th>id</th>
				<th>Identificación</th>
				<th>Código</th>
				<th>Nombre</th>
				<th>Telefono</th>
				<th>Celular</th>
				<th>Oficina</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<div class="form-group" style="padding-left: 30px;">
		<?php echo $this->Form->button('Guardar',array('class'=>'btn btn-primary push-right'));?>
		<?php echo $this->Form->end();?>
	</div>
</div>

<script>

	var webroot                 = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url                     = <?php echo "'".Router::url('/')."representantes'"; ?>;
	var representantes          = <?php echo json_encode($representantes); ?>;
	var representantesSearch    = new Array();
	var representantesSearchCod = new Array();

	var User = function(data) {
		var self     = this;
		self.id      = data.id;
		self.cliente = data.cliente;
		self.base    = data.base;
		self.caja    = data.caja;
		self.sobre   = data.sobre;
		self.paquete = data.paquete;
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
	    }
	};
	viewModel.addUser = function() {
		viewModel.users.push(new User({id: 0, cliente:"", base:"", caja:"", sobre:"", paquete:""}));
	    //viewModel.users.push(new User({ id: 0, cliente:"", hasta:"", valor: "", valor1: "", valor2: "" }));
	    for (var i = 0; i < viewModel.users().length; i++) {
	    	$("#tableCliente"+i).chosen({
				no_results_text           : 'No se encuentra el cliente.',
				width                     : "95%",
				allow_single_deselect     : true, 
				search_contains           : true,
				disable_search_threshold  : 10,
				placeholder_text_single : "Seleccione el cliente"
			});
	    };
	};
	viewModel.removeUser = function(selected) {
	    viewModel.users.remove(selected);
	};
	viewModel.removeUserTotal = function() {
	    viewModel.users.removeAll();
	};
	ko.applyBindings(viewModel);

	var rangoJs;
	var rangArray;
	var count;
	var ajaxCall;
	var representanId = <?php echo json_encode($id); ?>;
	var role          = <?php echo $usuario_actual['role_id']; ?>;
$(document).ready(function(){

	$('#RepresentanteCrearForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'data[Representante][cuenta]': {
				validators: {
					callback: {
						callback: function (value, validator, $field) {
							var banco = $("#RepresentanteBanco").val();
							if(banco == "OTRO" || value != "") {
								return true;
							} else {
								return false;
							}
						}
					}
				}
			},
			'data[Representante][tipo]': {
				validators: {
					callback: {
						callback: function (value, validator, $field) {
							var banco = $("#RepresentanteBanco").val();
							if(banco == "OTRO" || value != "") {
								return true;
							} else {
								return false;
							}
						}
					}
				}
			}
		}
	});
	$('#RepresentanteBanco').change(function() {
		$("#RepresentanteCrearForm").bootstrapValidator('revalidateField', 'data[Representante][cuenta]');
		$("#RepresentanteCrearForm").bootstrapValidator('revalidateField', 'data[Representante][tipo]');
	});


	if(role == 5 || role == 6){
		$("#datosNego").hide();
	}

	$.each( representantes, function( key, value ) {
		if(representanId == value.Representante.id){
			$('#RepresentanteId').val(value.Representante.id);
			$('#RepresentanteCodigo').val(value.Representante.codigo);
			$('#RepresentanteIdentificacion').val(value.Representante.identificacion);
			$('#RepresentanteNombre1').val(value.Representante.nombre1);
			$('#RepresentanteNombre2').val(value.Representante.nombre2);
			$('#RepresentanteApellido1').val(value.Representante.apellido1);
			$('#RepresentanteApellido2').val(value.Representante.apellido2);
			$('#RepresentanteCelular').val(value.Representante.celular);
			$("#RepresentanteTelefono1").val(value.Representante.telefono1);
			$("#RepresentanteTelefono2").val(value.Representante.telefono2);
			$("#RepresentanteTelefono3").val(value.Representante.telefono3);
			$("#RepresentanteTelefono4").val(value.Representante.telefono4);
			$("#RepresentanteOficina").val(value.Representante.oficina);
			$('#RepresentanteEmail').val(value.Representante.email);
			$('#RepresentanteDireccion').val(value.Representante.direccion);
			$('#RepresentanteContraentrega').val(value.Representante.contraentrega);
			$('#RepresentanteServicio').val(value.Representante.servicio);
			$('#RepresentanteBanco').val(value.Representante.banco);
			$('#RepresentanteCuenta').val(value.Representante.cuenta);
			$('#RepresentanteTipo').val(value.Representante.tipo);
			$('#RepresentanteGiro').val(value.Representante.giro);
			$('#RepresentanteEspecial').val(value.Representante.especial);
			$('#RepresentanteDigitar').val(value.Representante.digitar);
			$('#RepresentanteEscanear').val(value.Representante.escanear);
			$('#RepresentanteBase').val(value.Representante.base);
			$('#RepresentanteCaja').val(value.Representante.caja);
			$('#RepresentanteSobre').val(value.Representante.sobre);
			$('#RepresentantePaquete').val(value.Representante.paquete);
			$('#RepresentanteDigitarEspe').val(value.Representante.digitar_espe);
			$('#RepresentanteEscanearEspe').val(value.Representante.escanear_espe);
			$('#RepresentanteBaseEspe').val(value.Representante.base_espe);
			$('#RepresentanteCajaEspe').val(value.Representante.caja_espe);
			$('#RepresentanteSobreEspe').val(value.Representante.sobre_espe);
			$('#RepresentantePaqueteEspe').val(value.Representante.paquete_espe);
			$('#rangoVal').val(value.Representante.rangos);

			$("#RepresentanteDestinos option").attr("selected",false);
			$.each( value.Representante.destinos, function( key2, value2 ) {
				$("#RepresentanteDestinos option").each(function( key, value ) {
					var actual = $(value).val();
					if(actual == value2){
						$(this).attr("selected","selected");
						$("#RepresentanteDestinos").trigger("chosen:updated");
					}
				});
			});
			viewModel.removeUserTotal();
			$("#tableRangos").empty();
			if(value.Representante.rangos != ""){
				rangoJs       = JSON.parse(value.Representante.rangos);
				var auxRango  = JSON.stringify(rangoJs.datos);
				var auxRango2 = auxRango.replace("[",'[{"id":"header","class":"header-class","_data":["Desde","Hasta","%"]},');
				$.jsontotable(auxRango2, { id: '#tableRangos', className: 'table table-hover' });
			}		
			$.each( value.Representante.negociacion, function( key3, value3 ) {
				viewModel.users.push(new User({id: 0, cliente:value3.Negociacion.clientes, base:value3.Negociacion.base_clie, caja:value3.Negociacion.caja_clie, sobre:value3.Negociacion.sobre_clie, paquete:value3.Negociacion.paquete_clie}));
				$("#tableCliente"+key3).chosen({
					no_results_text           : 'No se encuentra el cliente.',
					width                     : "95%",
					allow_single_deselect     : true, 
					search_contains           : true,
					disable_search_threshold  : 10,
					placeholder_text_single : "Seleccione el cliente"
				});
			});
		}
	});


    $("#RepresentanteDestinos").chosen({
    	no_results_text           : 'No se encuentra el destino.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_multiple : "Seleccione los destinos"
    });
    $("#tableCliente0").chosen({
    	no_results_text           : 'No se encuentra el cliente.',
    	width                     : "95%",
    	allow_single_deselect     : true, 
    	search_contains           : true,
    	disable_search_threshold  : 10,
    	placeholder_text_single : "Seleccione el cliente"
    });

    $("#btnRangos").click( function (){
		var repreId = $('#RepresentanteId').val();
		$.fancybox.open({
			href : "rangos/"+repreId,
			type : 'iframe',
			padding : 5,
			width : '50%',
			height :'50%',
			//maxHeight : 200,
			autoScale : false,
			beforeClose: function(){
				retorno       = $('.fancybox-iframe').contents().find('#retorno').val();
				console.log(retorno);
				if(retorno != ""){
					rangoJs       = JSON.parse(retorno);
					var auxRango  = JSON.stringify(rangoJs.datos);
					var auxRango2 = auxRango.replace("[",'[{"id":"header","class":"header-class","_data":["Desde","Hasta","%"]},');
					$("#tableRangos").empty();
					$.jsontotable(auxRango2, { id: '#tableRangos', className: 'table table-hover' });
				}
				$('#rangoVal').val(retorno);
			}
		});
	});

	$.each( representantes, function( key, value ) {
		representantesSearch[key]    = value.Representante.identificacion;
		representantesSearchCod[key] = value.Representante.codigo;
	});

	$("#btn-limpiar").click(function() {
		$("#RepresentanteDestinos option").attr("selected",false);
		$("#RepresentanteDestinos").trigger("chosen:updated");
	});

	$(function() {
		$( "#RepresentanteIdentificacion" ).autocomplete({
			source: representantesSearch,
			select: function( event, ui ) {
				$.each( representantes, function( key, value ) {
					if(ui.item.value == value.Representante.identificacion){
						$('#RepresentanteId').val(value.Representante.id);
						$('#RepresentanteCodigo').val(value.Representante.codigo);
						$('#RepresentanteNombre1').val(value.Representante.nombre1);
						$('#RepresentanteNombre2').val(value.Representante.nombre2);
						$('#RepresentanteApellido1').val(value.Representante.apellido1);
						$('#RepresentanteApellido2').val(value.Representante.apellido2);
						$('#RepresentanteCelular').val(value.Representante.celular);
						$("#RepresentanteTelefono1").val(value.Representante.telefono1);
						$("#RepresentanteTelefono2").val(value.Representante.telefono2);
						$("#RepresentanteTelefono3").val(value.Representante.telefono3);
						$("#RepresentanteTelefono4").val(value.Representante.telefono4);
						$("#RepresentanteOficina").val(value.Representante.oficina);
						$('#RepresentanteEmail').val(value.Representante.email);
						$('#RepresentanteDireccion').val(value.Representante.direccion);
						$('#RepresentanteContraentrega').val(value.Representante.contraentrega);
						$('#RepresentanteServicio').val(value.Representante.servicio);
						$('#RepresentanteBanco').val(value.Representante.banco);
						$('#RepresentanteCuenta').val(value.Representante.cuenta);
						$('#RepresentanteTipo').val(value.Representante.tipo);
						$('#RepresentanteGiro').val(value.Representante.giro);
						$('#RepresentanteEspecial').val(value.Representante.especial);
						$('#RepresentanteDigitar').val(value.Representante.digitar);
						$('#RepresentanteEscanear').val(value.Representante.escanear);
						$('#RepresentanteBase').val(value.Representante.base);
						$('#RepresentanteCaja').val(value.Representante.caja);
						$('#RepresentanteSobre').val(value.Representante.sobre);
						$('#RepresentantePaquete').val(value.Representante.paquete);
						$('#RepresentanteDigitarEspe').val(value.Representante.digitar_espe);
						$('#RepresentanteEscanearEspe').val(value.Representante.escanear_espe);
						$('#RepresentanteBaseEspe').val(value.Representante.base_espe);
						$('#RepresentanteCajaEspe').val(value.Representante.caja_espe);
						$('#RepresentanteSobreEspe').val(value.Representante.sobre_espe);
						$('#RepresentantePaqueteEspe').val(value.Representante.paquete_espe);
						$('#rangoVal').val(value.Representante.rangos);

						$("#RepresentanteDestinos option").attr("selected",false);
						$.each( value.Representante.destinos, function( key2, value2 ) {
							$("#RepresentanteDestinos option").each(function( key, value ) {
								var actual = $(value).val();
								if(actual == value2){
									$(this).attr("selected","selected");
									$("#RepresentanteDestinos").trigger("chosen:updated");
								}
							});
						});
						viewModel.removeUserTotal();
						$("#tableRangos").empty();
						if(value.Representante.rangos != ""){
							rangoJs       = JSON.parse(value.Representante.rangos);
							var auxRango  = JSON.stringify(rangoJs.datos);
							var auxRango2 = auxRango.replace("[",'[{"id":"header","class":"header-class","_data":["Desde","Hasta","%"]},');
							$.jsontotable(auxRango2, { id: '#tableRangos', className: 'table table-hover' });
						}		
						$.each( value.Representante.negociacion, function( key3, value3 ) {
							viewModel.users.push(new User({id: 0, cliente:value3.Negociacion.clientes, base:value3.Negociacion.base_clie, caja:value3.Negociacion.caja_clie, sobre:value3.Negociacion.sobre_clie, paquete:value3.Negociacion.paquete_clie}));
							$("#tableCliente"+key3).chosen({
								no_results_text           : 'No se encuentra el cliente.',
								width                     : "95%",
								allow_single_deselect     : true, 
								search_contains           : true,
								disable_search_threshold  : 10,
								placeholder_text_single : "Seleccione el cliente"
							});
						});
					}
				});
			}
		});
		$( "#RepresentanteCodigo" ).autocomplete({
			source: representantesSearchCod,
			select: function( event, ui ) {
				$.each( representantes, function( key, value ) {
					if(ui.item.value == value.Representante.codigo){
						$('#RepresentanteId').val(value.Representante.id);
						$('#RepresentanteIdentificacion').val(value.Representante.identificacion);
						$('#RepresentanteNombre1').val(value.Representante.nombre1);
						$('#RepresentanteNombre2').val(value.Representante.nombre2);
						$('#RepresentanteApellido1').val(value.Representante.apellido1);
						$('#RepresentanteApellido2').val(value.Representante.apellido2);
						$('#RepresentanteCelular').val(value.Representante.celular);
						$("#RepresentanteTelefono1").val(value.Representante.telefono1);
						$("#RepresentanteTelefono2").val(value.Representante.telefono2);
						$("#RepresentanteTelefono3").val(value.Representante.telefono3);
						$("#RepresentanteTelefono4").val(value.Representante.telefono4);
						$("#RepresentanteOficina").val(value.Representante.oficina);
						$('#RepresentanteEmail').val(value.Representante.email);
						$('#RepresentanteDireccion').val(value.Representante.direccion);
						$('#RepresentanteContraentrega').val(value.Representante.contraentrega);
						$('#RepresentanteServicio').val(value.Representante.servicio);
						$('#RepresentanteBanco').val(value.Representante.banco);
						$('#RepresentanteCuenta').val(value.Representante.cuenta);
						$('#RepresentanteTipo').val(value.Representante.tipo);
						$('#RepresentanteGiro').val(value.Representante.giro);
						$('#RepresentanteEspecial').val(value.Representante.especial);
						$('#RepresentanteDigitar').val(value.Representante.digitar);
						$('#RepresentanteEscanear').val(value.Representante.escanear);
						$('#RepresentanteBase').val(value.Representante.base);
						$('#RepresentanteCaja').val(value.Representante.caja);
						$('#RepresentanteSobre').val(value.Representante.sobre);
						$('#RepresentantePaquete').val(value.Representante.paquete);
						$('#RepresentanteDigitarEspe').val(value.Representante.digitar_espe);
						$('#RepresentanteEscanearEspe').val(value.Representante.escanear_espe);
						$('#RepresentanteBaseEspe').val(value.Representante.base_espe);
						$('#RepresentanteCajaEspe').val(value.Representante.caja_espe);
						$('#RepresentanteSobreEspe').val(value.Representante.sobre_espe);
						$('#RepresentantePaqueteEspe').val(value.Representante.paquete_espe);
						$('#rangoVal').val(value.Representante.rangos);

						$("#RepresentanteDestinos option").attr("selected",false);
						$.each( value.Representante.destinos, function( key2, value2 ) {
							$("#RepresentanteDestinos option").each(function( key, value ) {
								var actual = $(value).val();
								if(actual == value2){
									$(this).attr("selected","selected");
									$("#RepresentanteDestinos").trigger("chosen:updated");
								}
							});
						});
						viewModel.removeUserTotal();
						$("#tableRangos").empty();
						if(value.Representante.rangos != ""){
							rangoJs       = JSON.parse(value.Representante.rangos);
							var auxRango  = JSON.stringify(rangoJs.datos);
							var auxRango2 = auxRango.replace("[",'[{"id":"header","class":"header-class","_data":["Desde","Hasta","%"]},');
							$.jsontotable(auxRango2, { id: '#tableRangos', className: 'table table-hover' });
						}		
						$.each( value.Representante.negociacion, function( key3, value3 ) {
							viewModel.users.push(new User({id: 0, cliente:value3.Negociacion.clientes, base:value3.Negociacion.base_clie, caja:value3.Negociacion.caja_clie, sobre:value3.Negociacion.sobre_clie, paquete:value3.Negociacion.paquete_clie}));
							$("#tableCliente"+key3).chosen({
								no_results_text           : 'No se encuentra el cliente.',
								width                     : "95%",
								allow_single_deselect     : true, 
								search_contains           : true,
								disable_search_threshold  : 10,
								placeholder_text_single : "Seleccione el cliente"
							});
						});
					}
				});
			}
		});
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

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
    		$.each( representantes, function( key, value ) {
				if(id == value.Representante.id){
					$('#RepresentanteId').val(value.Representante.id);
					$('#RepresentanteIdentificacion').val(value.Representante.identificacion);
					$('#RepresentanteCodigo').val(value.Representante.codigo);
					$('#RepresentanteNombre1').val(value.Representante.nombre1);
					$('#RepresentanteNombre2').val(value.Representante.nombre2);
					$('#RepresentanteApellido1').val(value.Representante.apellido1);
					$('#RepresentanteApellido2').val(value.Representante.apellido2);
					$('#RepresentanteCelular').val(value.Representante.celular);
					$("#RepresentanteTelefono1").val(value.Representante.telefono1);
					$("#RepresentanteTelefono2").val(value.Representante.telefono2);
					$("#RepresentanteTelefono3").val(value.Representante.telefono3);
					$("#RepresentanteTelefono4").val(value.Representante.telefono4);
					$("#RepresentanteOficina").val(value.Representante.oficina);
					$('#RepresentanteEmail').val(value.Representante.email);
					$('#RepresentanteDireccion').val(value.Representante.direccion);
					$('#RepresentanteContraentrega').val(value.Representante.contraentrega);
					$('#RepresentanteServicio').val(value.Representante.servicio);
					$('#RepresentanteBanco').val(value.Representante.banco);
					$('#RepresentanteCuenta').val(value.Representante.cuenta);
					$('#RepresentanteTipo').val(value.Representante.tipo);
					$('#RepresentanteGiro').val(value.Representante.giro);
					$('#RepresentanteEspecial').val(value.Representante.especial);
					$('#RepresentanteDigitar').val(value.Representante.digitar);
					$('#RepresentanteEscanear').val(value.Representante.escanear);
					$('#RepresentanteBase').val(value.Representante.base);
					$('#RepresentanteCaja').val(value.Representante.caja);
					$('#RepresentanteSobre').val(value.Representante.sobre);
					$('#RepresentantePaquete').val(value.Representante.paquete);
					$('#RepresentanteDigitarEspe').val(value.Representante.digitar_espe);
					$('#RepresentanteEscanearEspe').val(value.Representante.escanear_espe);
					$('#RepresentanteBaseEspe').val(value.Representante.base_espe);
					$('#RepresentanteCajaEspe').val(value.Representante.caja_espe);
					$('#RepresentanteSobreEspe').val(value.Representante.sobre_espe);
					$('#RepresentantePaqueteEspe').val(value.Representante.paquete_espe);
					$('#rangoVal').val(value.Representante.rangos);
					$("#RepresentanteDestinos option").attr("selected",false);
					$.each( value.Representante.destinos, function( key2, value2 ) {
						$("#RepresentanteDestinos option").each(function( key, value ) {
							var actual = $(value).val();
							if(actual == value2){
								$(this).attr("selected","selected");
								$("#RepresentanteDestinos").trigger("chosen:updated");
							}
						});
					});
					viewModel.removeUserTotal();
					$("#tableRangos").empty();
					if(value.Representante.rangos != ""){
						rangoJs       = JSON.parse(value.Representante.rangos);
						var auxRango  = JSON.stringify(rangoJs.datos);
						var auxRango2 = auxRango.replace("[",'[{"id":"header","class":"header-class","_data":["Desde","Hasta","%"]},');
						$.jsontotable(auxRango2, { id: '#tableRangos', className: 'table table-hover' });
					}		
					$.each( value.Representante.negociacion, function( key3, value3 ) {
						viewModel.users.push(new User({id: 0, cliente:value3.Negociacion.clientes, base:value3.Negociacion.base_clie, caja:value3.Negociacion.caja_clie, sobre:value3.Negociacion.sobre_clie, paquete:value3.Negociacion.paquete_clie}));
						$("#tableCliente"+key3).chosen({
							no_results_text           : 'No se encuentra el cliente.',
							width                     : "95%",
							allow_single_deselect     : true, 
							search_contains           : true,
							disable_search_threshold  : 10,
							placeholder_text_single : "Seleccione el cliente"
						});
					});
				}
			});
	    	
	    }
	});


	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/representantes.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a class="btn btn-danger" style="padding:0px;" title="Eliminar" href="'+url+'/eliminar/'+aData[0]+'" onclick="return confirm(\'&iquest;Esta seguro de eliminar: '+aData[2]+' ?\');"><span class="glyphicon glyphicon-remove-sign"></span></a></nav>';
			$('td:eq(6)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumns": [
			{ "sWidth": "0%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "25%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "20%" },
			{ "sWidth": "3%" }
		],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0,7 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});


	})
</script>