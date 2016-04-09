<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
?>
<style>
/*.alinear h4 {float:left;}*/
</style>
<div class="row" style="width:90%; margin-left:5%;">
	<br>
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>TRAZABILIDAD</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<div class="form-group col-md-12">
			<div class="col-md-12">
				<div class="col-md-6">
					<?php echo $this->Form->input('guia',array('label'=>'Guia:','type'=>'text')); ?>
				</div>
				<div class="col-md-6">
					<button type="button" class="btn btn-primary start" id="btn-consultar" style="margin-top: 25px;padding: 0px;">
						<i class="glyphicon glyphicon-repeat"></i>
						<span>Consultar</span>
					</button>
				</div>
			</div>
			<hr class="clearing"/>
			<div id="guiaInfo" class="col-md-12" style="margin-top:5px;">
				<div class="bs-callout bs-callout-green" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
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
				</div>
				<div class="bs-callout bs-callout-warning" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
					<h4 style="color:rgb(226, 127, 0);">Cliente</h4>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Doc cliente: <small id="guiaClienteDoc"></small></h4></div>
						<div class="col-md-4"><h4>Nombre cliente: <small id="guiaClienteNom"></small></h4></div>
						<div class="col-md-4"><h4>Dirección cliente: <small id="guiaClienteDir"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4>Teléfono cliente: <small id="guiaClienteTel"></small></h4></div>
						<div class="col-md-4"><h4>Fax cliente: <small id="guiaClienteFax"></small></h4></div>
						<div class="col-md-4"><h4>Email cliente: <small id="guiaClienteEma"></small></h4></div>
					</div>
				</div>
				<div id="remiDiv" class="bs-callout bs-callout-gray" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
					<h4>Remitente</h4>
					<div class="form-group col-md-12">
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
				<div class="bs-callout bs-callout-info" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
					<h4 style="color:rgb(55, 88, 131);">Destinatario</h4>
					<div class="form-group col-md-12">
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
				<div id="trazaDiv"></div>
			</div>
		</div>
		<?php echo $this->Form->end();?>
		</div>
</div>
<script>
	var venta   = <?php echo json_encode($venta); ?>;
	var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url     = <?php echo "'".Router::url('/')."ventas'"; ?>;

	function setInfo (venta) {
		if(venta.Venta.otro_remi == 1){
			$("#remiDiv").show();
		} else {
			$("#remiDiv").hide();
		}
		$("#empaquesDiv").empty();
		$("#empaquesDiv").append(venta.Venta.html);
		$("#trazaDiv").empty();
		$("#trazaDiv").append(venta.Venta.html2);
		$("#VentaId").val(venta.Venta.id);
		$("#guiaId").text(venta.Venta.remesa);
		$("#guiaRef1").text(venta.Venta.documento1);
		$("#guiaRef2").text(venta.Venta.documento2);
		$("#guiaRef3").text(venta.Venta.documento3);
		$("#guiaOrigen").text(venta.Venta.origenNombre);
		$("#guiaDestino").text(venta.Venta.destinoNombre);
		$("#guiaClienteDoc").text(venta.Venta.documentoClien);
		$("#guiaClienteNom").text(venta.Venta.nombreClien);
		$("#guiaClienteDir").text(venta.Venta.direccionClien);
		$("#guiaClienteTel").text(venta.Venta.telefonoClien);
		$("#guiaClienteFax").text(venta.Venta.faxClien);
		$("#guiaClienteEma").text(venta.Venta.emailClien);
		$("#guiaRemitenteDoc").text(venta.Venta.documentoRemi);
		$("#guiaRemitenteNom").text(venta.Venta.nombreRemi);
		$("#guiaRemitenteDir").text(venta.Venta.direccionRemi);
		$("#guiaRemitenteTel").text(venta.Venta.telefonoRemi);
		$("#guiaRemitenteCel").text(venta.Venta.celularRemi);
		$("#guiaRemitenteEma").text(venta.Venta.emailRemi);
		$("#guiaDestinatarioDoc").text(venta.Venta.documentoDest);
		$("#guiaDestinatarioNom").text(venta.Venta.nombreDest);
		$("#guiaDestinatarioDir").text(venta.Venta.direccionDest);
		$("#guiaDestinatarioTel").text(venta.Venta.telefonoDest);
		$("#guiaDestinatarioFax").text(venta.Venta.faxDest);
		$("#guiaDestinatarioEma").text(venta.Venta.emailDest);
		$("#guiaKiloAd").text(venta.Venta.kilo_adic);
		$("#guiaKiloNeg").text(venta.Venta.kilo_nego);
		$("#guiaValKilo").text(venta.Venta.valor_kilo_adic);
		$("#guiaSeguro").text(venta.Venta.valor_seguro);
		$("#guiaDevolucion").text(venta.Venta.valor_devolucion);
		$("#guiaTotal").text(venta.Venta.valor_total);
		$("#guiaInfo").show();

	}

$(document).ready(function(){

	$("#guiaInfo").hide();
	if(venta != ""){
		setInfo(venta);
	}


})
</script>