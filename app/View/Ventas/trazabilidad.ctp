<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
	echo $this->Html->script('bootstrap.min');
?>
<style>
/*.alinear h4 {float:left;}*/
.empClass td,.empClass th{	padding: 0px !important;text-align: center !important}
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
					<h4><span class="glyphicon glyphicon-tag"></span>Referencias</h4>
					<div class="form-group col-md-12">
						<div class="col-md-20"><h4 class="traz"><span>Remesa: </span><small id="guiaId"></small></h4></div>
						<div class="col-md-20"><h4 class="traz"><span>Tipo: </span><small id="guiaTipoRef"></small></h4></div>
						<div class="col-md-20"><h4 class="traz"><span>Doc Ref 1: </span><small id="guiaRef1"></small></h4></div>
						<div class="col-md-20"><h4 class="traz"><span>Doc Ref 2: </span><small id="guiaRef2"></small></h4></div>
						<div class="col-md-20"><h4 class="traz"><span>Doc Ref 3: </span><small id="guiaRef3"></small></h4></div>
					</div>
				</div>
				<div class="bs-callout bs-callout-warning" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
					<h4 style="color:rgb(226, 127, 0);"><span class="glyphicon glyphicon-user"></span>Cliente</h4>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4 class="traz"><span>Doc cliente: </span><small id="guiaClienteDoc"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Nombre cliente: </span><small id="guiaClienteNom"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Dirección cliente: </span><small id="guiaClienteDir"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-3"><h4 class="traz"><span>Origen: </span><small id="guiaOrigen"></small></h4></div>
						<div class="col-md-3"><h4 class="traz"><span>Teléfono cliente: </span><small id="guiaClienteTel"></small></h4></div>
						<div class="col-md-3"><h4 class="traz"><span>Fax cliente: </span><small id="guiaClienteFax"></small></h4></div>
						<div class="col-md-3"><h4 class="traz"><span>Email cliente: </span><small id="guiaClienteEma"></small></h4></div>
					</div>
				</div>
				<div id="remiDiv" class="bs-callout bs-callout-gray" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
					<h4><span class="glyphicon glyphicon-user"></span>Remitente</h4>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4 class="traz"><span>Doc remitente: </span><small id="guiaRemitenteDoc"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Nombre remitente: </span><small id="guiaRemitenteNom"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Dirección remitente: </span><small id="guiaRemitenteDir"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4 class="traz"><span>Teléfono remitente: </span><small id="guiaRemitenteTel"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Celular remitente: </span><small id="guiaRemitenteCel"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Email remitente: </span><small id="guiaRemitenteEma"></small></h4></div>
					</div>
				</div>
				<div class="bs-callout bs-callout-info" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
					<h4 style="color:rgb(55, 88, 131);"><span class="glyphicon glyphicon-user"></span>Destinatario</h4>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4 class="traz"><span>Doc destinatario: </span><small id="guiaDestinatarioDoc"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Nombre destinatario: </span><small id="guiaDestinatarioNom"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Dirección destinatario: </span><small id="guiaDestinatarioDir"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-3"><h4 class="traz"><span>Destino: </span><small id="guiaDestino"></small></h4></div>
						<div class="col-md-3"><h4 class="traz"><span>Teléfono destinatario: </span><small id="guiaDestinatarioTel"></small></h4></div>
						<div class="col-md-3"><h4 class="traz"><span>Fax destinatario: </span><small id="guiaDestinatarioFax"></small></h4></div>
						<div class="col-md-3"><h4 class="traz"><span>Email destinatario: </span><small id="guiaDestinatarioEma"></small></h4></div>
					</div>
				</div>
				<div class="bs-callout bs-callout-green" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
					<h4><span class="glyphicon glyphicon-list-alt"></span>Información envío</h4>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4 class="traz"><span>Kilos Adicionales: </span><small id="kiloAd"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Kilos Negociados: </span><small id="kiloNego"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Valor Kilo Adic: </span><small id="valKiloAd"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-4"><h4 class="traz"><span>Descuento Flete: </span><small id="descFlete"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Descuento Kilo: </span><small id="descKilo"></small></h4></div>
						<div class="col-md-4"><h4 class="traz"><span>Valor Seguro: </span><small id="seguro"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-3"><h4 class="traz"><span>Valor Declarado: </span><small id="declarado"></small></h4></div>
						<div class="col-md-3"><h4 class="traz"><span>Devolver firmado: </span><small id="devolucionDoc"></small></h4></div>
						<div class="col-md-3"><h4 class="traz"><span>Valor devolución: </span><small id="devolucion"></small></h4></div>
						<div class="col-md-3"><h4 class="traz"><span>Valor Total: </span><small id="valTotal"></small></h4></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-3"><h4 class="traz"><span>Tipo: </span><small id="clase"></small></h4></div>
						<div class="col-md-9"><h4 class="traz"><span>Obsevaciones: </span><small id="observ"></small></h4></div>
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
	var venta    = <?php echo json_encode($venta); ?>;
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."ventas'"; ?>;
	var urlReem  = <?php echo "'".Router::url('/')."reempaques'"; ?>;
	var fullpath = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;

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
		var rem = venta.Venta.remesa;
		$("#VentaGuia").val(rem.replace("-",""));
		if(venta.Venta.tipo == null){
			$("#guiaTipoRef").text("");
		} else {
			$("#guiaTipoRef").text(venta.Venta.tipo);
		}
		if(venta.Venta.tipo == "Reempaque"){
			$("#guiaRef1").empty();
			$("#guiaRef1").append('<a target="_blank" href="'+urlReem+'/trazabilidad/'+venta.Venta.documento1+'">'+venta.Venta.documento1+'</a>');
		} else {
			$("#guiaRef1").text(venta.Venta.documento1);
		}
		$("#guiaRef2").text(venta.Venta.documento2);
		$("#guiaRef3").text(venta.Venta.documento3);
		$("#guiaOrigen").text(venta.Venta.origenNombre);
		$("#guiaDestino").text(venta.Venta.destinoNombre);

		$("#kiloAd").text(parseFloat(venta.Venta.kilo_adic).formatMoney(0,',','.'));
		$("#kiloNego").text(parseFloat(venta.Venta.kilo_nego).formatMoney(0,',','.'));
		$("#valKiloAd").text(parseFloat(venta.Venta.valor_kilo_adic).formatMoney(0,',','.'));
		$("#descFlete").text(parseFloat(venta.Venta.desc_flete).formatMoney(0,',','.'));
		$("#descKilo").text(parseFloat(venta.Venta.desc_kilo).formatMoney(0,',','.'));
		$("#seguro").text(parseFloat(venta.Venta.valor_seguro).formatMoney(0,',','.'));
		$("#devolucion").text(parseFloat(venta.Venta.valor_devolucion).formatMoney(0,',','.'));
		$("#devolucionDoc").text(venta.Venta.firmado);
		$("#valTotal").text(parseFloat(venta.Venta.valor_total).formatMoney(0,',','.'));
		var declar = venta.Venta.declarado + "";
		declar     = declar.split(",").join("");
		$("#declarado").text(parseFloat(declar).formatMoney(0,',','.'));

		$("#guiaClienteDoc").text(venta.Venta.documentoClien != null ? venta.Venta.documentoClien : "");
		$("#guiaClienteNom").text(venta.Venta.nombreClien != null ? venta.Venta.nombreClien : "");
		$("#guiaClienteDir").text(venta.Venta.direccionClien != null ? venta.Venta.direccionClien : "");
		$("#guiaClienteTel").text(venta.Venta.telefonoClien != null ? venta.Venta.telefonoClien : "");
		$("#guiaClienteFax").text(venta.Venta.faxClien != null ? venta.Venta.faxClien : "");
		$("#guiaClienteEma").text(venta.Venta.emailClien != null ? venta.Venta.emailClien : "");
		$("#guiaRemitenteDoc").text(venta.Venta.documentoRemi != null ? venta.Venta.documentoRemi : "");
		$("#guiaRemitenteNom").text(venta.Venta.nombreRemi != null ? venta.Venta.nombreRemi : "");
		$("#guiaRemitenteDir").text(venta.Venta.direccionRemi != null ? venta.Venta.direccionRemi : "");
		$("#guiaRemitenteTel").text(venta.Venta.telefonoRemi != null ? venta.Venta.telefonoRemi : "");
		$("#guiaRemitenteCel").text(venta.Venta.celularRemi != null ? venta.Venta.celularRemi : "");
		$("#guiaRemitenteEma").text(venta.Venta.emailRemi != null ? venta.Venta.emailRemi : "");
		$("#guiaDestinatarioDoc").text(venta.Venta.documentoDest != null ? venta.Venta.documentoDest : "");
		$("#guiaDestinatarioNom").text(venta.Venta.nombreDest != null ? venta.Venta.nombreDest : "");
		$("#guiaDestinatarioDir").text(venta.Venta.direccionDest != null ? venta.Venta.direccionDest : "");
		$("#guiaDestinatarioTel").text(venta.Venta.telefonoDest != null ? venta.Venta.telefonoDest : "");
		$("#guiaDestinatarioFax").text(venta.Venta.faxDest != null ? venta.Venta.faxDest : "");
		$("#guiaDestinatarioEma").text(venta.Venta.emailDest != null ? venta.Venta.emailDest : "");
		$("#guiaKiloAd").text(venta.Venta.kilo_adic != null ? venta.Venta.kilo_adic : "");
		$("#guiaKiloNeg").text(venta.Venta.kilo_nego != null ? venta.Venta.kilo_nego : "");
		$("#guiaValKilo").text(venta.Venta.valor_kilo_adic != null ? venta.Venta.valor_kilo_adic : "");
		$("#guiaSeguro").text(venta.Venta.valor_seguro != null ? venta.Venta.valor_seguro : "");
		$("#guiaDevolucion").text(venta.Venta.valor_devolucion != null ? venta.Venta.valor_devolucion : "");
		$("#guiaTotal").text(venta.Venta.valor_total != null ? venta.Venta.valor_total : "");
		$("#observ").text(venta.Venta.observaciones != null ? venta.Venta.observaciones : "");
		$("#clase").text(venta.Venta.clase != null ? venta.Venta.clase : "");

		$("#guiaInfo").show();

	}

$(document).ready(function(){
	$("#verGuia").fancybox();
	$("#guiaInfo").hide();
	if(venta != ""){
		setInfo(venta);
	}
/*
	$("#verGuia").click(function(){
		var linkImage = $("#linkPropio").attr('src');
		linkImage     = linkImage.replace('propiob.png','');
		$.fancybox.open({
			href : linkImage+'/',
			type : 'iframe',
			padding : 5,
			width : "80%",
			height: "80%",
			//maxHeight : 200,
			//autoScale : true,
			scrolling : 'auto',
			scrollOutside : false
		});
	});
*/
	$("#btn-consultar").click(function(){
		var remesa = $("#VentaGuia").val();
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		$.ajax({
			type: 'json',
			url: fullpath+"ventas/trazabilidad2/"+remesa,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			},
			success: function(response) {
				console.log(response);
				response = JSON.parse(response);
				if(response != null && response != ""){
					setInfo(response);
				} else {
					alertM("La guia no se encuentra");
				}
				$.fancybox.hideLoading();
				$.fancybox.helpers.overlay.close();
			},
			error: function(e) {
				console.log("An error occurred: " + e.responseText.message);
			}
		});

	});

})
</script>