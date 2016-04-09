<?php
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->script('tips');
	echo $this->Html->css('jquery.fancybox');	
	echo $this->Html->css('tips');
?>
<style type="text/css">
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
	.search-choice{
		width: 99%;
	}
</style>

<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Despacho',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>PLANILLA DE DESPACHOS</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	    <?php echo $this->Form->input('valores',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
		<?php echo $this->Form->input('oficina',array('type'=>'hidden','default'=>$usuario_actual['oficina_id'])); ?>
		<div class="form-group col-md-12">
       		<div class="col-md-3"><?php echo $this->Form->input('negociador',array('label'=>'Negociador: ','type'=>'select','options'=>$negociadores,'empty'=>'','class'=>'chosen-select form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('placa',array('label'=>'Placa: ','type'=>'select','options'=>$placas,'empty'=>'','class'=>'chosen-select form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo vehiculo: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('modelo',array('label'=>'Modelo: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('conductor',array('label'=>'Identificación: ','type'=>'select','options'=>$conductoresId,'empty'=>'','class'=>'chosen-select form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('origen',array('label'=>'Origen: ','type'=>'select','options'=>$destinos,'empty'=>'','class'=>'chosen-select form-control','data-bv-notempty'=>'true','default'=>$usuario_actual['ciudad'])); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('destino',array('label'=>'Destino: ','type'=>'select','options'=>$destinos,'empty'=>'','class'=>'chosen-select form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-4">
				<?php echo $this->Form->input('barras',array('label'=>'Cod. Barras: ','type'=>'text')); ?>
				<a href="#" data-tooltip-direction="left" data-tooltip="Cod. No encontrado" class="tipError" id="tipMsgError"></a>
				<a href="#" data-tooltip-direction="left" data-tooltip="Cog. Agregado" class="tipOk" id="tipMsgOk"></a>
			</div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-10"><?php echo $this->Form->input('guias2',array('label'=>'Guias: ','type'=>'select','multiple'=>true,'options'=>$ventasL,'empty'=>'','class'=>'chosen-select form-control','data-bv-notempty'=>'true')); ?></div>
       		<div class="col-md-2"><?php echo $this->Form->input('valor',array('label'=>'Valor: ','type'=>'text','default'=>'0')); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>Remesa</th>
					<th>Cod. Barras</th>
					<th>Destinatario</th>
					<th>Dirección</th>
					<th>Destino</th>
					<th>Teléfono</th>
					<th>Cantidad</th>
					<th>Empaque</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>


<script>
	var webroot     = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var fullpath    = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var ventas      = <?php echo json_encode($ventas); ?>;
	var ventasL     = <?php echo json_encode($ventasL); ?>;
	var vehiculos   = <?php echo json_encode($vehiculos); ?>;
	var conductores = <?php echo json_encode($conductores); ?>;
	var pistola     = <?php echo json_encode($pistola); ?>;
	var pistola2    = JSON.parse( JSON.stringify( pistola ) );
	var ajaxCall;
	var oTable;
	var valores        = new Array();
	var valor          = 0;
	function sumarValor() {
		valores = new Array();
		valor = 0;
		var actuales = $("#DespachoGuias2").val();
		if(actuales != null){
			$.each(actuales, function( key, value ) {
				valor = valor + ajaxCall[value];
				valores.push(ajaxCall[value]);
			});
		}
		$("#DespachoValores").val(JSON.stringify(valores));		
		if(valor != 0){
			valor = valor.toFixed(2);
			$("#DespachoValor").attr('readonly','readonly');
		} else {
			$("#DespachoValor").attr('readonly',false);
		}
		$("#DespachoValor").val(valor);
	}

$(document).ready(function(){
	$.tips({
		action: 'click',
		fadeOut: 1000,
		element: '.tipOk',
		tooltipClass: 'toolOk',
		preventDefault: true
	});
	$.tips({
		action: 'click',
		fadeOut: 1000,
		element: '.tipError',
		tooltipClass: 'errorTip',
		preventDefault: true
	});
	$("#DespachoBarras").keypress(function(e) {
		var barras = $(this).val();
		if(e.which == 13) {
			var index = -1;
			$.each(pistola2, function( indexGuia, arrayBarra ) {
				index = arrayBarra.indexOf(barras);
				if (index > -1) {
					pistola2[indexGuia].splice(index, 1);
				}
				if(pistola2[indexGuia].length == 0 && pistola[indexGuia].length != 0){
					var actuales = $("#DespachoGuias2").val();
					if(actuales != null){
						actuales.push(indexGuia);
					} else {
						actuales = [indexGuia];
					}
					$("#DespachoGuias2").val(actuales);
					$("#DespachoGuias2").trigger("chosen:updated");
				}
				if (index > -1) {
					$("#tipMsgOk").click();
					return false;
				}
			});
			if(index < 0){
				$("#tipMsgError").click();
			}
			$("#DespachoBarras").val("");
		}
	});


	$('#DespachoCrearForm').bootstrapValidator({
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


	$("#DespachoNegociador").chosen({
		no_results_text           : 'No se encuentra el negociador.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el negociador"
	});
	$("#DespachoPlaca").chosen({
		no_results_text           : 'No se encuentra la placa.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el placa"
	});
	$("#DespachoConductor").chosen({
		no_results_text           : 'No se encuentra el conductor.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el conductor"
	});
	$("#DespachoOrigen").chosen({
		no_results_text           : 'No se encuentra la origen.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione la origen"
	});
	$("#DespachoDestino").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el destino"
	});
	$("#DespachoGuias2").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_multiple : "Seleccione la guia"
	});

	$("#DespachoPlaca").change(function(){
		var placaSel = $("#DespachoPlaca").val();
		$("#DespachoGuias2").val("");
		$("#DespachoGuias2").trigger("chosen:updated");
		sumarValor();
		$.each(vehiculos, function( key, value ) {
			if(placaSel == value.Vehiculo.id) {
				$("#DespachoTipo").val(value.Vehiculo.marca);
				$("#DespachoModelo").val(value.Vehiculo.modelo);
			}
		});
		
	});
	$("#DespachoDestino").change(function(){
		var destino  = $(this).val();
		var placaSel = $("#DespachoPlaca").val();

		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		$.ajax({
			type: 'json',
			url: fullpath+"despachos/getNegociacion/"+placaSel+"/"+destino,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			},
			success: function(response) {
				response = JSON.parse(response);
				ajaxCall = response;
				$.fancybox.hideLoading();
				$.fancybox.helpers.overlay.close();
			},
			error: function(e) {
				console.log("An error occurred: " + e.responseText.message);
			}
		});
	});


	$("#DespachoConductor").change(function(){
		var conductorSel = $("#DespachoConductor").val();
		$.each(conductores, function( key, value ) {
			if(conductorSel == value.Conductor.id) {
				$("#DespachoNombre").val(value.Conductor.listNombre);
				$("#DespachoTelefono").val(value.Conductor.telefono);
			}
		});
	});

	$("#DespachoGuias2").change(function(){
		sumarValor();
	});
	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	var actuales = $("#DespachoGuias2").val();
	    	if(actuales != null){
	    		actuales.push(id);
	    	} else {
	    		actuales = [id];
	    	}
	    	$("#DespachoGuias2").val(actuales);
			$("#DespachoGuias2").trigger("chosen:updated");
			sumarValor();
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

	oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/ventas.txt',
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
		//"iDisplayLength": 6,
		"bJQueryUI": true,		
		"bAutoWidth": false,
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "7%"},
	        { "sWidth": "7%"},
	        { "sWidth": "23%"},
	        { "sWidth": "22%"},
	        { "sWidth": "14%"},
	        { "sWidth": "10%"},
	        { "sWidth": "7%"},
	        { "sWidth": "10%"}
	    ],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0] },
			{ "sClass": "col-actions", "aTargets": [2] }
		]
	});

})

</script>