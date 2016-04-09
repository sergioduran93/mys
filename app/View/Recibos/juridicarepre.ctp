<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->script('jquery.jCombo.min');
	echo $this->Html->css('jquery.fancybox');
?>
<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Recibo',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>RECIBO</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('oficina',array('type'=>'hidden','default'=>$usuario_actual['oficina_id'])); ?>
		<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
		<?php echo $this->Form->input('tipo',array('type'=>'hidden','default'=>'Juridica')); ?>
	    <div class="form-group col-md-12">
			<div class="col-md-6"><?php echo $this->Form->input('guia_id',array('label'=>'Guia: ','type'=>'select','options'=>$ventasL,'empty'=>'')); ?></div>
			<div class="col-md-6"><?php echo $this->Form->input('barras',array('label'=>'Barras: ','type'=>'text')); ?></div>
		</div>
	    <div class="form-group col-md-12">
	    	<div class="col-md-4"><?php echo $this->Form->input('destino',array('label'=>'Destino: ','class'=>'provisional','type'=>'select','options'=>$destinos,'empty'=>"")); ?></div>
	    	<div class="col-md-4"><?php echo $this->Form->input('negociador',array('label'=>'Representante CC: ','class'=>'provisional','type'=>'select','options'=>$representantesD,'empty'=>'','default'=>$usuario_actual['representante_id'])); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('negociador_nom',array('label'=>'Nombre: ','class'=>'provisional','type'=>'select','options'=>$representantesN,'empty'=>'','default'=>$usuario_actual['representante_id'])); ?></div>
		</div>
	    <div class="form-group col-md-12">
	    	<div class="col-md-6"><?php echo $this->Form->input('documento',array('label'=>'Transportadora NIT: ','class'=>'provisional','type'=>'text','placeholder'=>'Seleccione')); ?></div>
	    	<div class="col-md-6"><?php echo $this->Form->input('razon',array('label'=>'Transportadora Nombre: ','class'=>'provisional','type'=>'text','placeholder'=>'Seleccione')); ?></div>
		</div>
	    <div class="form-group col-md-12">
	    	<div class="col-md-3"><?php echo $this->Form->input('numero',array('label'=>'Nro Recibo: ','class'=>'provisional','type'=>'text')); ?></div>
	    	<div class="col-md-3"><?php echo $this->Form->input('seguro',array('label'=>'Vlr seguro: ','class'=>'provisional','type'=>'text','default'=>'0')); ?></div>
	    	<div class="col-md-3"><?php echo $this->Form->input('flete',array('label'=>'Vlr flete: ','class'=>'provisional','type'=>'text')); ?></div>
	    	<div class="col-md-3"><?php echo $this->Form->input('forma_pago',array('label'=>'Forma de pago: ','class'=>'provisional','type'=>'select','options'=>$forma)); ?></div>
		</div>
		<div class="form-group col-md-12">
	    	<div class="col-md-12"><?php echo $this->Form->input('obs',array('label'=>'Observaciones: ','placeholder'=>'Tel Conductor, Nro Bus, Etc...')); ?></div>
		</div>
		<div class="form-group">
			<?php echo $this->Form->button('Guardar',array('class'=>'btn btn-primary','style'=>'margin-left:30px;float:right;margin-bottom: 15px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
		</div>
		<div id="guiaInfo">
			<div class="bs-callout bs-callout-info">
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4>Remesa: <small id="guiaId"></small></h4></div>
					<div class="col-md-4"><h4>Doc Ref 1: <small id="guiaRef1"></small></h4></div>
					<div class="col-md-4"><h4>Doc Ref 2: <small id="guiaRef2"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4>Doc Ref 3: <small id="guiaRef3"></small></h4></div>
					<div class="col-md-4"><h4>Origen: <small id="guiaOrigen"></small></h4></div>
					<div class="col-md-4"><h4>Destino: <small id="guiaDestino"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4>Kilos Adic.: <small id="guiaKiloAd"></small></h4></div>
					<div class="col-md-4"><h4>Kilos Negociados: <small id="guiaKiloNeg"></small></h4></div>
					<div class="col-md-4"><h4>Valor Kg. Adic: <small id="guiaValKilo"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4>Valor Seguro: <small id="guiaSeguro"></small></h4></div>
					<div class="col-md-4"><h4>Valor Devolución: <small id="guiaDevolucion"></small></h4></div>
					<div class="col-md-4"><h4>Valor Total: <small id="guiaTotal"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<h4 style="font-weight:bold;font-size:160%;color:rgb(55, 88, 131);">Cliente</h4>
					<div class="col-md-4"><h4>Doc cliente: <small id="guiaClienteDoc"></small></h4></div>
					<div class="col-md-4"><h4>Nombre cliente: <small id="guiaClienteNom"></small></h4></div>
					<div class="col-md-4"><h4>Dirección cliente: <small id="guiaClienteDir"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4>Teléfono cliente: <small id="guiaClienteTel"></small></h4></div>
					<div class="col-md-4"><h4>Fax cliente: <small id="guiaClienteFax"></small></h4></div>
					<div class="col-md-4"><h4>Email cliente: <small id="guiaClienteEma"></small></h4></div>
				</div>
				<div id="remiDiv">
					<div class="form-group col-md-12">
						<h4 style="font-weight:bold;font-size:160%;color:rgb(55, 88, 131);">Remitente</h4>
						<div class="col-md-4"><h4>Doc remitente: <small id="guiaRemitenteDoc"></small></h4></div>
						<div class="col-md-4"><h4>Nombre remitente: <small id="guiaRemitenteNom"></small></h4></div>
						<div class="col-md-4"><h4>Dirección remitente: <small id="guiaRemitenteDir"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Teléfono remitente: <small id="guiaRemitenteTel"></small></h4></div>
						<div class="col-md-4"><h4>Celular remitente: <small id="guiaRemitenteCel"></small></h4></div>
						<div class="col-md-4"><h4>Email remitente: <small id="guiaRemitenteEma"></small></h4></div>
					</div>
				</div>
				<div class="form-group col-md-12">
					<h4 style="font-weight:bold;font-size:160%;color:rgb(55, 88, 131);">Destinatario</h4>
					<div class="col-md-4"><h4>Doc destinatario: <small id="guiaDestinatarioDoc"></small></h4></div>
					<div class="col-md-4"><h4>Nombre destinatario: <small id="guiaDestinatarioNom"></small></h4></div>
					<div class="col-md-4"><h4>Dirección destinatario: <small id="guiaDestinatarioDir"></small></h4></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-4"><h4>Teléfono destinatario: <small id="guiaDestinatarioTel"></small></h4></div>
					<div class="col-md-4"><h4>Fax destinatario: <small id="guiaDestinatarioFax"></small></h4></div>
					<div class="col-md-4"><h4>Email destinatario: <small id="guiaDestinatarioEma"></small></h4></div>
				</div>
			</div>
			<div id="empaquesDiv"></div>
		</div>
	<?php echo $this->Form->end();?>
	<br>
</div>




<script>
	var ventas          = <?php echo json_encode($ventas); ?>;
	var reciboG         = <?php echo json_encode($reciboG); ?>;
	var transportadoras = <?php echo json_encode($transportadoras); ?>;
	var representantesD = <?php echo json_encode($representantesD); ?>;
	var representantesN = <?php echo json_encode($representantesN); ?>;
	var transNit        = new Array();
	var transRazon      = new Array();
	var negoDoc         = new Array();
	var negoNom         = new Array();

	$.each( transportadoras, function( key, value ) {
		transNit[key]   = value.Transportadora.nit;
		transRazon[key] = value.Transportadora.razon;
	});


$(document).ready(function(){
	$("#guiaInfo").hide();
	$("#ReciboDestino").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el destino"
	});
	$("#ReciboGuiaId").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione la guia"
	});
	$("#ReciboNegociador").chosen({
		no_results_text           : 'No se encuentra el representante.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione el representante"
	});
	$("#ReciboNegociadorNom").chosen({
		no_results_text           : 'No se encuentra el representante.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione el representante"
	});
	$("#ReciboNegociador").change(function(){
		var representanteId = $(this).val();
		$("#ReciboNegociadorNom").val(representanteId);
		$("#ReciboNegociadorNom").trigger("chosen:updated");
	});
	$("#ReciboNegociadorNom").change(function(){
		var representanteId = $(this).val();
		$("#ReciboNegociador").val(representanteId);
		$("#ReciboNegociador").trigger("chosen:updated");
	});
	$("#ReciboGuiaId").change(function(){
		var guiaId = $(this).val();
		if(guiaId != ""){
			$.each( ventas ,function(key,value) {
				if(guiaId == value.Venta.id){
					$("#empaquesDiv").empty();
					$("#empaquesDiv").append(value.Venta.html);
					$("#guiaId").text(value.Venta.remesa);
					$("#guiaRef1").text(value.Venta.documento1);
					$("#guiaRef2").text(value.Venta.documento2);
					$("#guiaRef3").text(value.Venta.documento3);
					$("#guiaOrigen").text(value.Venta.origen);
					$("#guiaDestino").text(value.Venta.destino);
					$("#guiaClienteDoc").text(value.Venta.documentoClien);
					$("#guiaClienteNom").text(value.Venta.nombreClien);
					$("#guiaClienteDir").text(value.Venta.direccionClien);
					$("#guiaClienteTel").text(value.Venta.telefonoClien);
					$("#guiaClienteFax").text(value.Venta.faxClien);
					$("#guiaClienteEma").text(value.Venta.emailClien);
					if(value.Venta.otro_remi == 1){
						$("#guiaRemitenteDoc").text(value.Venta.documentoRemi);
						$("#guiaRemitenteNom").text(value.Venta.nombreRemi);
						$("#guiaRemitenteDir").text(value.Venta.direccionRemi);
						$("#guiaRemitenteTel").text(value.Venta.telefonoRemi);
						$("#guiaRemitenteCel").text(value.Venta.celularRemi);
						$("#guiaRemitenteEma").text(value.Venta.emailRemi);
					} else {
						$("#remiDiv").hide();
					}
					$("#guiaDestinatarioDoc").text(value.Venta.documentoDest);
					$("#guiaDestinatarioNom").text(value.Venta.nombreDest);
					$("#guiaDestinatarioDir").text(value.Venta.direccionDest);
					$("#guiaDestinatarioTel").text(value.Venta.telefonoDest);
					$("#guiaDestinatarioFax").text(value.Venta.faxDest);
					$("#guiaDestinatarioEma").text(value.Venta.emailDest);
					$("#guiaKiloAd").text(value.Venta.kilo_adic);
					$("#guiaKiloNeg").text(value.Venta.kilo_nego);
					$("#guiaValKilo").text(value.Venta.valor_kilo_adic);
					$("#guiaSeguro").text(value.Venta.valor_seguro);
					$("#guiaDevolucion").text(value.Venta.valor_devolucion);
					$("#guiaTotal").text(value.Venta.valor_total);

					var recibo = reciboG[guiaId];
					if(recibo != null){
						$("#ReciboNegociadorNom").val(recibo.Recibo.negociador_nom);
						$("#ReciboNegociador").val(recibo.Recibo.negociador);
						$("#ReciboDocumento").val(recibo.Recibo.documento);
						$("#ReciboRazon").val(recibo.Recibo.razon);
						$("#ReciboNumero").val(recibo.Recibo.numero);
						$("#ReciboSeguro").val(recibo.Recibo.seguro);
						$("#ReciboFlete").val(recibo.Recibo.flete);
						$("#ReciboFormaPago").val(recibo.Recibo.forma_pago);
						$("#ReciboDestino").val(recibo.Recibo.destino);
						$("#ReciboDestino").trigger("chosen:updated");
						if(recibo.Recibo.provisional){
							$("#ReciboProvisional").prop('checked',true);
							$('#ReciboFormaPago option:not(:selected)').attr('disabled',false);
							$.each($(".provisional"), function(key2,value2) {
								$(value2).removeAttr('readonly');
							});
						} else {
							$("#ReciboProvisional").prop('checked',false);
							$('#ReciboFormaPago option:not(:selected)').attr('disabled',true);
							/*$.each($(".provisional"), function(key2,value2) {
								$(value2).attr('readonly','readonly');
							});*/
						}
					} else {
						$("#ReciboProvisional").prop('checked',true);
						$('#ReciboFormaPago option:not(:selected)').attr('disabled',false);
						$.each($(".provisional"), function(key2,value2) {
							$(value2).removeAttr('readonly');
						});
					}

					$("#guiaInfo").show();
				}
			});
		} else {
			$("#guiaInfo").hide();
		}
	});



$(function() {
	$("#ReciboDocumento").autocomplete({
		source: transNit,
		select: function( event, ui ) {
			$.each( transportadoras, function( key, value ) {
				if(ui.item.value == value.Transportadora.nit){
					$("#ReciboRazon").val(value.Transportadora.razon);
					if(value.Transportadora.credito == 'Si'){
						$("#ReciboFormaPago").val('Credito');
					} else {
						$("#ReciboFormaPago").val('Contado');
					}
				}
			});
		}
	});
	$("#ReciboRazon").autocomplete({
		source: transRazon,
		select: function( event, ui ) {
			$.each( transportadoras, function( key, value ) {
				if(ui.item.value == value.Transportadora.razon){
					$("#ReciboDocumento").val(value.Transportadora.nit);
					if(value.Transportadora.credito == 'Si'){
						$("#ReciboFormaPago").val('Credito');
					} else {
						$("#ReciboFormaPago").val('Contado');
					}
				}
			});
		}
	});
	
});

})
</script>