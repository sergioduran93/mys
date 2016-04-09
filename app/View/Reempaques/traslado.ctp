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
	<?php echo $this->Form->create('Reempaque',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>TRASLADO NACIONAL</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('valores',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
		<?php echo $this->Form->input('destinatario',array('type'=>'hidden')); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-3"><?php echo $this->Form->input('negociador',array('label'=>'Auxiliar: ','type'=>'select','options'=>$negociadores,'empty'=>'')); ?></div>
       		<div class="col-md-3 hidden"><?php echo $this->Form->input('representante',array('label'=>'Representante: ','type'=>'select','options'=>$representanteC,'empty'=>'')); ?></div>
       		<div class="col-md-6 hidden"><?php echo $this->Form->input('nombreR',array('label'=>'Nombre: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12 hidden">
       		<div class="col-md-3"><?php echo $this->Form->input('telefonoR',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('identificacion',array('label'=>'Identificación: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('direccion',array('label'=>'Dirección: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('celular',array('label'=>'Celular: ','type'=>'text')); ?></div>
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
       		<div class="col-md-10"><?php echo $this->Form->input('guias2',array('label'=>'Guias: ','type'=>'select','multiple'=>true,'options'=>$ventasL,'empty'=>'')); ?></div>
       		<div class="col-md-2 hidden"><?php echo $this->Form->input('valor',array('label'=>'Valor: ','type'=>'text','default'=>'0')); ?></div>
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
	var webroot        = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var ventasL        = <?php echo json_encode($ventasL); ?>;
	var ventas         = <?php echo json_encode($ventas); ?>;
	var representantes = <?php echo json_encode($representantes); ?>;
	var conductores    = <?php echo json_encode($conductores); ?>;
	var fullpath       = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var ajaxCall       = new Array();
	var valores        = new Array();
	var valor          = 0;
	var oficinas       = <?php echo json_encode($oficinas); ?>;
	var oficinaId      = <?php echo json_encode($usuario_actual['oficina_id']); ?>;
	
	function sumarValor() {
		valor = 0;
		valores = new Array();
		var actuales = $("#ReempaqueGuias2").val();
		if(actuales != null){
			$.each(actuales, function( key, value ) {
				valor = valor + ajaxCall[value];
				valores.push(ajaxCall[value]);
			});
		}
		$("#ReempaqueValores").val(JSON.stringify(valores));
		if(valor != 0){
			valor = valor.toFixed(2);
			$("#ReempaqueValor").attr('readonly','readonly');
		} else {
			$("#ReempaqueValor").attr('readonly',false);
		}
		$("#ReempaqueValor").val(valor);
	}
$(document).ready(function(){
	$("#ReempaqueBarras").keypress(function(e) {
		//console.log(e.which);
		var barras = $(this).val();
		if(e.which == 13) {
			if(ventasL[barras] != undefined){
				var actuales = $("#ReempaqueGuias2").val();
				if(actuales != null){
					actuales.push(barras);
				} else {
					actuales = [barras];
				}
				$("#ReempaqueGuias2").val(actuales);
				$("#ReempaqueGuias2").trigger("chosen:updated");
				sumarValor();
			}
			$("#ReempaqueBarras").val("");
		}
	});
	$.each(oficinas, function( key, value ) {
		if(value.Oficina.id == oficinaId){
			$("#ReempaqueDireccionO").val(value.Oficina.direccion);
			$("#ReempaqueTelefonoO").val(value.Oficina.telefono);
		}
	});
	

	$("#ReempaqueOrigen").change(function(){
		var origenId = $(this).val();
		$.each(oficinas, function( key, value ) {
			if(value.Oficina.id == origenId){
				$("#ReempaqueDireccionO").val(value.Oficina.direccion);
				$("#ReempaqueTelefonoO").val(value.Oficina.telefono);
			}
		});
	});

	$("#ReempaqueDestino").change(function(){
		var destinoId = $(this).val();
		$.each(oficinas, function( key, value ) {
			if(value.Oficina.id == destinoId){
				$("#ReempaqueDireccionD").val(value.Oficina.direccion);
				$("#ReempaqueTelefonoD").val(value.Oficina.telefono);
			}
		});
	});
	$("#ReempaqueNegociador").chosen({
		no_results_text           : 'No se encuentra el negociador.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el negociador"
	});
	$("#ReempaqueRepresentante").chosen({
		no_results_text           : 'No se encuentra el representante.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el representante"
	});
	$("#ReempaqueConductor").chosen({
		no_results_text           : 'No se encuentra el conductor.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el conductor"
	});
	$("#ReempaqueOrigen").chosen({
		no_results_text           : 'No se encuentra la origen.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione la origen"
	});
	$("#ReempaqueDestino").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el destino"
	});
	$("#ReempaqueGuias2").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_multiple : "Seleccione la guia"
	});

	$("#ReempaqueGuias2").change(function(){
		sumarValor();
	});

	$("#ReempaqueRepresentante").change(function(){
		$("#ReempaqueGuias2").val("");
		$("#ReempaqueGuias2").trigger("chosen:updated");
		sumarValor();
		var represenSel = $("#ReempaqueRepresentante").val();
		
		if(represenSel != ""){
			$.each(representantes, function( key, value ) {
				if(represenSel == value.Representante.id) {
					$("#ReempaqueNombreR").val(value.Representante.listNombre);
					$("#ReempaqueTelefonoR").val(value.Representante.telefono1);
					$("#ReempaqueIdentificacion").val(value.Representante.identificacion);
					$("#ReempaqueDireccion").val(value.Representante.direccion);
					$("#ReempaqueCelular").val(value.Representante.celular);
				}
			});
			$.fancybox.showLoading();
			$.fancybox.helpers.overlay.open();
			$.ajax({
				type: 'json',
				url: fullpath+"reempaques/getNegociacion/"+represenSel,
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				},
				success: function(response) {
					console.log(response);
					response = JSON.parse(response);
					ajaxCall = response;
					$("#ReempaqueDestinatario").val(ajaxCall['Destinatario']);
					$.fancybox.hideLoading();
					$.fancybox.helpers.overlay.close();
				},
				error: function(e) {
					console.log("An error occurred: " + e.responseText.message);
				}
			});
		} else {
			$("#ReempaqueNombreR").val("");
			$("#ReempaqueTelefonoR").val("");
			ajaxCall = null;
		}

	});

	$("#ReempaqueConductor").change(function(){
		var conductorSel = $("#ReempaqueConductor").val();
		$.each(conductores, function( key, value ) {
			if(conductorSel == value.Conductor.id) {
				$("#ReempaqueNombreC").val(value.Conductor.listNombre);
				$("#ReempaqueTelefonoC").val(value.Conductor.telefono);
			}
		});
	});

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	var actuales = $("#ReempaqueGuias2").val();
	    	if(actuales != null){
	    		actuales.push(id);
	    	} else {
	    		actuales = [id];
	    	}
	    	$("#ReempaqueGuias2").val(actuales);
			$("#ReempaqueGuias2").trigger("chosen:updated");
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

	var oTable = $('#tabla_id').dataTable( {
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