<?php
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
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
		<div><h3><center>TRASLADO DE MERCANCIA (LOCAL)</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-3"><?php echo $this->Form->input('auxiliar',array('label'=>'Auxiliar: ','type'=>'select','options'=>$auxiliares,'empty'=>'')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('placa',array('label'=>'Placa: ','type'=>'select','options'=>$placas,'empty'=>'')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo vehiculo: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('modelo',array('label'=>'Modelo: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-3"><?php echo $this->Form->input('conductor',array('label'=>'Identificación: ','type'=>'select','options'=>$conductoresId,'empty'=>'')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('barras',array('label'=>'Codigo de barras: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('origen',array('label'=>'Oficina(Origen): ','type'=>'select','options'=>$oficinasL,'default'=>$usuario_actual['oficina_id'],'empty'=>'')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('direccionO',array('label'=>'Dirección: ','type'=>'text')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('telefonoO',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('destino',array('label'=>'Oficina(Destino): ','type'=>'select','options'=>$oficinasL,'empty'=>'')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('direccionD',array('label'=>'Dirección: ','type'=>'text')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('telefonoD',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-10"><?php echo $this->Form->input('guias',array('label'=>'Guia: ','type'=>'select','multiple'=>true,'options'=>$ventasL,'empty'=>'')); ?></div>
       		<div class="col-md-2"><?php echo $this->Form->input('valor',array('label'=>'Valor: ','type'=>'text','default'=>'0')); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>Remesa</th>
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
	var oficinas    = <?php echo json_encode($oficinas); ?>;
	var oficinaId   = <?php echo json_encode($usuario_actual['oficina_id']); ?>;
	var ajaxCall;
	var oTable;

$(document).ready(function(){
	$.each(oficinas, function( key, value ) {
		if(value.Oficina.id == oficinaId){
			$("#DespachoDireccionO").val(value.Oficina.direccion);
			$("#DespachoTelefonoO").val(value.Oficina.telefono);
		}
	});
	

	$("#DespachoOrigen").change(function(){
		var origenId = $(this).val();
		$.each(oficinas, function( key, value ) {
			if(value.Oficina.id == origenId){
				$("#DespachoDireccionO").val(value.Oficina.direccion);
				$("#DespachoTelefonoO").val(value.Oficina.telefono);
			}
		});
	});

	$("#DespachoDestino").change(function(){
		var destinoId = $(this).val();
		$.each(oficinas, function( key, value ) {
			if(value.Oficina.id == destinoId){
				$("#DespachoDireccionD").val(value.Oficina.direccion);
				$("#DespachoTelefonoD").val(value.Oficina.telefono);
			}
		});
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
	$("#DespachoGuias").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_multiple : "Seleccione la guia"
	});
	$("#DespachoAuxiliar").chosen({
		no_results_text           : 'No se encuentra el auxiliar.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el auxiliar"
	});

	$("#DespachoPlaca").change(function(){
		var placaSel = $("#DespachoPlaca").val();
		$("#DespachoGuias").val("");
		$("#DespachoGuias").trigger("chosen:updated");
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
		"sAjaxSource": webroot+'sources/ventasT.txt',
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