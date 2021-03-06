<?php
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	//echo $this->Html->script('jstree.min');
	//echo $this->Html->css('tree.min');
	echo $this->Html->css('jquery.fancybox');
?>
<style>
.search-choice{
	width: 99%;
}
</style>

<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Despacho',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>PLANILLA DE DESPACHOS</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-3"><?php echo $this->Form->input('negociador',array('label'=>'Negociador: ','type'=>'select','options'=>$negociadores,'empty'=>'')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('placa',array('label'=>'Placa: ','type'=>'select','options'=>$placas,'empty'=>'')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo vehiculo: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('modelo',array('label'=>'Modelo: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('conductor',array('label'=>'Identificación: ','type'=>'select','options'=>$conductoresId,'empty'=>'')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('origen',array('label'=>'Origen: ','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('destino',array('label'=>'Destino: ','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('barras',array('label'=>'Codigo de barras: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('filtro',array('label'=>'Filtro(Destino): ','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
       		<div class="col-md-2"><?php echo $this->Form->input('valor',array('label'=>'Valor: ','type'=>'text','default'=>'0')); ?></div>
		</div>
		<div class="form-group col-md-12" style="max-height: 301px;overflow: auto;">
			<?php echo $arbol; ?>
		</div>

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
	var ajaxCall;
	var oTable;
	function sumarValor() {
		valor = 0;
		var actuales = $("#DespachoGuias").val();
		if(actuales != null){
			$.each(actuales, function( key, value ) {
				valor = valor + ajaxCall[value];
			});
		}
		if(valor != 0){
			valor = valor.toFixed(2);
			$("#DespachoValor").attr('readonly','readonly');
		} else {
			$("#DespachoValor").attr('readonly',false);
		}
		$("#DespachoValor").val(valor);
	}

$(document).ready(function(){

	$("#DespachoFiltro").change(function() {
		var destinoId = $("#DespachoFiltro").val();
		$.each($(".ventaTab"), function( key, value ) {
			if(destinoId != ""){
				var flag = $(value).hasClass("tab"+destinoId);
				if(!flag){
					$(value).addClass("hidden");
				} else {
					$(value).removeClass("hidden");
				}
			} else {
				$(value).removeClass("hidden");
			}
		});
	});
	$("#DespachoBarras").keypress(function(e) {
		//console.log(e.which);
		var barras = $(this).val();
		if(e.which == 13) {
			if(ventasL[barras] != undefined){
				var actuales = $("#DespachoGuias").val();
				if(actuales != null){
					actuales.push(barras);
				} else {
					actuales = [barras];
				}
				$("#DespachoGuias").val(actuales);
				$("#DespachoGuias").trigger("chosen:updated");
				sumarValor();
			}
			$("#DespachoBarras").val("");
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
	$("#DespachoFiltro").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el destino"
	});
	$("#DespachoGuias").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione la guia"
	});

	$("#DespachoPlaca").change(function(){
		var placaSel = $("#DespachoPlaca").val();
		$("#DespachoGuias").val("");
		$("#DespachoGuias").trigger("chosen:updated");
		sumarValor();
		$.each(vehiculos, function( key, value ) {
			if(placaSel == value.Vehiculo.id) {
				$("#DespachoTipo").val(value.Vehiculo.marca);
				$("#DespachoModelo").val(value.Vehiculo.modelo);
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

	$("#DespachoGuias").change(function(){
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		$.ajax({
			type: 'json',
			url: fullpath+"despachos/getNegociacion/"+placaSel,
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
		sumarValor();
	});
	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	var actuales = $("#DespachoGuias").val();
	    	if(actuales != null){
	    		actuales.push(id);
	    	} else {
	    		actuales = [id];
	    	}
	    	$("#DespachoGuias").val(actuales);
			$("#DespachoGuias").trigger("chosen:updated");
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
	        { "sWidth": "14%"},
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