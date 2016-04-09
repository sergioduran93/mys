<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.jsontotable.min');
?>
<style type="text/css">
/*	::-webkit-scrollbar {
	    width: 12px;
	}
	::-webkit-scrollbar-thumb {
		-webkit-box-shadow: inset 0 0 6px rgb(137, 137, 137);
		border-radius: 5px;
		background-color: rgb(208, 226, 253);
	}
	::-webkit-scrollbar-track {
		background-color: rgb(244, 244, 244);
	}*/
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

	<div><h3><center>VEHICULOS (NEGOCIACIÓN)</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Vehiculo',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	<?php echo $this->Form->input('role',array('type'=>'hidden','default'=>$usuario_actual['role_id'])); ?>
    <div class="form-group col-md-12">
        <div class="col-md-3"><?php echo $this->Form->input('placa',array('label'=>'Placa: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'text','class'=>'form-control')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('marca',array('label'=>'Marca: ','type'=>'text','class'=>'form-control')); ?></div>
        <div class="col-md-3"><?php echo $this->Form->input('modelo',array('label'=>'Modelo: ','type'=>'text','class'=>'form-control')); ?></div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-12" style="padding-top:25px;">
			<?php
				$options=array('TodasRegiones'=>'Todas las regiones ','Region'=>'Región ','Destino'=>'Destino ');
				$attributes=array('legend'=>false,'default'=>'Destino');
				echo $this->Form->radio('Radio',$options,$attributes);
			?>
		</div>
	</div>
	<div class="form-group col-md-12" id="allDiv">
		<div class="col-md-6" id="regionDiv"><?php echo $this->Form->input('region',array('label'=>'Region: ','type'=>'select','options'=>$regiones,'empty'=>'','class'=>'form-control','data-bv-trigger'=>'val focus change')); ?></div>
		<div class="col-md-6" id="destinoDiv"><?php echo $this->Form->input('destino',array('label'=>'Destino: ','type'=>'select','options'=>$destinos,'empty'=>'','class'=>'form-control','data-bv-trigger'=>'val focus change')); ?></div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-2"><?php echo $this->Form->input('valor_sobre',array('label'=>'($) Sobre:','type'=>'text')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('valor_paquete',array('label'=>'($) Paquete:','type'=>'text')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('valor_caja',array('label'=>'($) Caja:','type'=>'text')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('valor_devol',array('label'=>'($) Sobre devolución:','type'=>'text')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('valor_base',array('label'=>'($) Otros:','type'=>'text')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('valor_adicional',array('label'=>'($) Valor kilo adicional','type'=>'text')); ?></div>
	</div>
    <div class="form-group col-md-12">
		<div class="col-md-2"><?php echo $this->Form->input('max_sobre',array('label'=>array('text'=>'(Kg Max) Sobre:'),'type'=>'text')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('max_paquete',array('label'=>'(Kg Max) Paquete:','type'=>'text')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('max_caja',array('label'=>'(Kg Max) Caja:','type'=>'text')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('max_devol',array('label'=>'(Kg Max) Sobre devol:','type'=>'text')); ?></div>
		<div class="col-md-2"><?php echo $this->Form->input('max_base',array('label'=>'(Kg Max) Otros:','type'=>'text')); ?></div>
		<div class="col-md-2"></div>
	</div>

	<div class="form-group col-md-12">
		<div class="panel panel-info thumbnail col-md-6">
			<div class="panel-heading">
				<span style="font-weight: bold">Rango unidades:</span>
			</div>
			<table>
				<tr>
					<th>Desde</th>
					<th>Hasta</th>
					<th>(%)</th>
				</tr>
				<tbody data-bind="foreach: users">
					<tr>
						<td><?php echo $this->Form->input('Vehiculo.rangoUnidad.desde.',array('label'=>false,'type'=>'text','data-bind'=>'value: desde')); ?></td>
						<td><?php echo $this->Form->input('Vehiculo.rangoUnidad.hasta.',array('label'=>false,'type'=>'text','data-bind'=>'value: hasta')); ?></td>
						<td><?php echo $this->Form->input('Vehiculo.rangoUnidad.descuento.',array('label'=>false,'type'=>'text','data-bind'=>'value: descuento')); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="panel panel-info thumbnail col-md-6">
			<div class ="panel-heading">
				<span style="font-weight: bold">Rango kilos:</span>
				<div style="padding: 0px 15px 0px 10px; float:right;" class="btn btn-success" data-bind='click: addUser'>
					<span class="glyphicon glyphicon-plus"></span> Agregar
				</div>
			</div>
			<table>
				<tr>
					<th>Desde</th>
					<th>Hasta</th>
					<th>(%)</th>
					<th></th>
				</tr>
				<tbody data-bind="foreach: users">
					<tr>
						<td><?php echo $this->Form->input('Vehiculo.rangoUnidad.desde2.',array('label'=>false,'type'=>'text','data-bind'=>'value: desde2')); ?></td>
						<td><?php echo $this->Form->input('Vehiculo.rangoUnidad.hasta2.',array('label'=>false,'type'=>'text','data-bind'=>'value: hasta2')); ?></td>
						<td><?php echo $this->Form->input('Vehiculo.rangoUnidad.descuento2.',array('label'=>false,'type'=>'text','data-bind'=>'value: descuento2')); ?></td>
						<td style="padding:0px; float:right;" class="btn btn-danger" data-bind='click: $root.removeUser'>
							<span class="glyphicon glyphicon-remove"></span>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
		<thead>
			<tr>
				<th>id</th>
				<th>Placa</th>
				<th>Tipo</th>
				<th>Marca</th>
				<th>Modelo</th>
				<th>Nro Motor</th>
				<th>Nro Chasis</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

	<div class="form-group btns">
		<?php echo $this->Form->button('Guardar',array('class'=>'btn btn-primary'));?>
	</div>
	<?php echo $this->Form->end();?>
	<br>

</div>
<script>
   // var destinos           = <?php echo json_encode($destinos); ?>;
    var vehiculos          = <?php echo json_encode($vehiculos); ?>;
    var vehiculosPlacas    = new Array();
	var webroot            = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var isVehiculo         = true;

	var contactosIniciales = [
		{desde: "", hasta: "", descuento: ""}
	];

	var User = function(data) {
		var self        = this;
		self.id         = data.id;
		self.desde      = data.desde;
		self.hasta      = data.hasta;
		self.descuento  = data.descuento;
		self.desde2     = data.desde2;
		self.hasta2     = data.hasta2;
		self.descuento2 = data.descuento2;
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
		viewModel.users.push(new User({id: 0, desde:"", hasta:"", descuento:"", desde2:"", hasta2:"", descuento2:""}));
	};
	viewModel.removeUser = function(selected) {
	    viewModel.users.remove(selected);
	};
	viewModel.removeUserTotal = function() {
	    viewModel.users.removeAll();
	};
	ko.applyBindings(viewModel);


$(document).ready(function(){
	viewModel.users.push(new User({id: 0, desde:"", hasta:"", descuento:""}));

	$('#VehiculoNegociacionForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'data[Vehiculo][region]': {
				validators: {
					callback: {
						callback: function (value, validator, $field) {
							var todas = $("#VehiculoRadioTodasRegiones").prop('checked');
							console.log(todas);
							if(todas || value!="") {
								return true;
							} else {
								return false;
							}
						}
					}
				}
			},
			'data[Vehiculo][destino]': {
				validators: {
					callback: {
						callback: function (value, validator, $field) {
							var todas = $("#VehiculoRadioTodasRegiones").prop('checked');
							var regio = $("#VehiculoRadioRegion").prop('checked');
							console.log(todas);
							console.log(regio);

							if(todas || regio || value!="") {
								return true;
							} else {
								return false;
							}
						}
					}
				}
			},
		}
	});



	$("#VehiculoRadioTodasRegiones").change(function(){
		if($(this).prop('checked')){
			$("#allDiv").hide();
		}
	});

	$("#VehiculoRadioRegion").change(function(){
		if($(this).prop('checked')){
			$("#allDiv").show();
			$("#regionDiv").show();
			$("#destinoDiv").hide();
		}
	});

	$("#VehiculoRadioDestino").change(function(){
		if($(this).prop('checked')){
			$("#allDiv").show();
			$("#regionDiv").show();
			$("#destinoDiv").show();
		}
	});

	$("#VehiculoRegion").chosen({
		no_results_text           : 'No se encuentra la región.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single : "Seleccione la región"
	});
	
	$("#VehiculoDestino").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single : "Seleccione los destinos"
	});

	$.each( vehiculos, function( key, value ) {
		vehiculosPlacas[key] = value.Vehiculo.placa;
	});

	$(function() {
		$( "#VehiculoPlaca" ).autocomplete({
			source: vehiculosPlacas,
			select: function( event, ui ) {
				$.each( vehiculos, function( key, value ) {
					if(ui.item.value == value.Vehiculo.placa){
						$('#VehiculoId').val(value.Vehiculo.id);
						$('#VehiculoTipo').val(value.Vehiculo.tipo);
						$('#VehiculoMarca').val(value.Vehiculo.marca);
						$('#VehiculoModelo').val(value.Vehiculo.modelo);
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
	    	$.each( vehiculos, function( key, value ) {
				if(id == value.Vehiculo.id){
					$('#VehiculoId').val(value.Vehiculo.id);
					$('#VehiculoPlaca').val(value.Vehiculo.placa);
					$('#VehiculoTipo').val(value.Vehiculo.tipo);
					$('#VehiculoMarca').val(value.Vehiculo.marca);
					$('#VehiculoModelo').val(value.Vehiculo.modelo);
				}
			});
	    }
	    $('#VehiculoNegociacionForm').data('bootstrapValidator').resetForm();
		$('#VehiculoNegociacionForm').bootstrapValidator('validate');
	});


	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/vehiculos.txt',
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
		"aoColumns": [
			{ "sWidth": "0%" },
			{ "sWidth": "15%" },
			{ "sWidth": "25%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "20%" }
		],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});

	})
</script>