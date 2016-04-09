<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox'); 
?>
<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Liquidar',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>VENTA CLIENTE</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('cliente',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('devolverFirmado',array('type'=>'hidden')); ?>
	    <div class="form-group col-md-12">
			<div class="col-md-4"><?php echo $this->Form->input('origen',array('label'=>'Ciudad Origen: ','class'=>'chosen-select','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
			<div class="col-md-4"><?php echo $this->Form->input('destino',array('label'=>'Ciudad Destino: ','class'=>'chosen-select','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
			<div class="col-md-2"><?php echo $this->Form->input('declarado',array('label'=>'Valor declarado: ','type'=>'text')); ?></div>
			<div class="col-md-2"><?php echo $this->Form->input('firmado',array('label'=>'Devolver firmado:','type'=>'select','options'=>$firmado,'default'=>'No')); ?></div>
		</div>
		<div class="panel panel-info thumbnail col-md-12" style="margin-bottom:0px;" id="divDetalle">
			<div class ="panel-heading">
				Detalle de empaques
				<span style="margin-left:50%;color:#333333;font-weight:bolder;">Valor kilo adicional: $<span id="kiloAdSpan">0</span></span>
			<div style="padding: 0px 8px;float:right;" class="btn btn-success" data-bind='click: addUser'>
				<span class="glyphicon glyphicon-plus"></span>Agregar
			</div>
			</div>
			<table class='contactsEditor'>
		        <tr>
		            <th style="text-align:center;">Empaque</th>
		            <th style="text-align:center;">Cantidad</th>
		            <th style="text-align:center;">Peso Unitario</th>
		            <th style="text-align:center;">Largo</th>
		            <th style="text-align:center;">Ancho</th>
		            <th style="text-align:center;">Alto</th>
		            <th style="text-align:center;">Peso Total</th>
		            <th style="text-align:center;">Peso Volumen</th>
		            <th style="text-align:center;">Valor Unidad</th>
		            <th style="text-align:center;">Kilos Negociados</th>
					<th style="text-align:center;">Subtotal</th>
					<th style="text-align:center;"></th>
		        </tr>
		        <tbody data-bind="foreach: users">
		            <tr>
						<td class="col-md-2" style="padding:0px;">
							<?php echo $this->Form->input('empaques.',array('class'=>'empaques','label'=>false,'type'=>'select','options'=>$empaques,'empty'=>'')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('cantidad.',array('class'=>"cantidad",'label'=>false,'type'=>'text','default'=>'0','style'=>'text-align: left;')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('valKilo.',array('class'=>'valKilo hidden','label'=>false,'type'=>'text','readonly'=>'readonly')); ?>
							<?php echo $this->Form->input('pesoUni.',array('class'=>'pesoUni','label'=>false,'type'=>'text','default'=>'0')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('largo.',array('class'=>"largo",'label'=>false,'type'=>'text','default'=>'0')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('ancho.',array('class'=>"ancho",'label'=>false,'type'=>'text','default'=>'0')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('alto.',array('class'=>"alto",'label'=>false,'type'=>'text','default'=>'0')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('peso.',array('class'=>"peso",'label'=>false,'type'=>'text','default'=>'0')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('pesoVol.',array('class'=>"pesoVol",'label'=>false,'type'=>'text','default'=>'0','readonly'=>'readonly')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('valor.',array('class'=>'valor','label'=>false,'type'=>'text','readonly'=>'readonly')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('kiloAd.',array('class'=>'kiloAd','label'=>false,'type'=>'text','readonly'=>'readonly')); ?>
						</td>
						<td>
							<?php echo $this->Form->input('subtotal.',array('class'=>'subtotal','label'=>false,'type'=>'text','default'=>'0','readonly'=>'readonly')); ?>
						</td>
						<td style="padding:0px;border:none;" class="btn btn-danger" data-bind='click: $root.removeUser'>
							<span class="glyphicon glyphicon-remove"></span>
						</td>
		            </tr>	            
		        </tbody>
		        <tr style="border-top: 2px solid #000; text-align: center; font-weight: bold;">
	            	<td class="col-md-2" style="padding:0px;">
	            		Subtotal
					</td>
					<td class="col-md-1" style="padding:0px;">
						<span id="contCantidad">0</span>
					</td>
					<td class="col-md-1" style="padding:0px;">
					</td>
					<td class="col-md-1" style="padding:0px;">
					</td>
					<td class="col-md-1" style="padding:0px;">
					</td>
					<td class="col-md-1" style="padding:0px;">
						<span id="contPeso">0</span>
					</td>
					<td class="col-md-1" style="padding:0px;">
					</td>
					<td class="col-md-1" style="padding:0px;">
					</td>
					<td class="col-md-1" style="padding:0px;">
					</td>
					<td class="col-md-1" style="padding:0px;">
					</td>
					<td class="col-md-1" style="padding:0px;">
						$<span id="contTotal">0</span>
					</td>
	            </tr>
		    </table>
		</div>
		<div class="col-md-12" style="padding:0px;">
			<div class="form-group col-md-6">
				<div class="btn-group col-md-12" style="margin-top: 20px;">
					<?php echo $this->Form->button("Enviar",array("id"=>"btn-enviar","class"=>'btn btn-default',"type"=>'button'));?>
					<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"type"=>'submit','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
				</div>
			</div>
			<div class="col-md-6" style="padding:0px;">
				<table class="well col-md-12">
					<thead>
						<th class="col-md-6">Descripción</th>
						<th class="col-md-6"><span style="float:right;">Valor</span></th>
					</thead>
					<tbody>
						<tr>
							<td>Costo flete</td>
							<td style="float:right;"><span id="costoFlete">0</span></td>
						</tr>
						<tr>
							<td>Costo Kg adicional (<span id="costoAdicVal">0</span>Kg.)</td>
							<td style="float:right;"><span id="costoAdic">0</span></td>
						</tr>
						<tr>
							<td>Descuento flete (<span id="descFleteVal">0</span>%)</td>
							<td style="float:right;"><span id="descFlete">0</span></td>
						</tr>
						<tr>
							<td>Descuento kilos (<span id="descKiloVal">0</span>%)</td>
							<td style="float:right;"><span id="descKilo">0</span></td>
						</tr>
						<tr>
							<td>Costo valor seguro (<span id="costoSeguroVal">0</span>)</td>
							<td style="float:right;"><span id="costoSeguro">0</span></td>
						</tr>
						<tr>
							<td>Costo devolución de documentos</td>
							<td style="float:right;"><span id="costoDevol">0</span></td>
						</tr>
						<tr style="font-weight:bold;font-size:xx-large;">
							<td>Costo Total</td>
							<td style="float:right;">$<span id="costoTotal">0</span></td>
						</tr>
					</tbody>
				</table>
			</div>			
		</div>
	<?php echo $this->Form->end();?>
	<br>
</div>
<script>
	var User = function(data) {
	    var self = this;
	    self.id = data.id;
	    self.desde = data.desde;
	    self.hasta = data.hasta;
		self.valor = data.valor;
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
	    viewModel.users.push(new User({ id: 0, desde:"", hasta:"", valor: "" }));
	};
	viewModel.removeUser = function(selected) {
	    viewModel.users.remove(selected);

	    sumaCant = 0;
		$.each($(".cantidad"), function( key, value ) {
			sumaCant = sumaCant + parseInt($(value).val());
		});
		$("#contCantidad").text(sumaCant);
		costoFlete = 0;
		$.each($(".cantidad"), function( key, value ) {
			var padreAct = $(value).parent().parent().parent();
			var unidad   = parseFloat($(padreAct).find(".cantidad").val());
			var valorU   = parseFloat($(padreAct).find(".valor").val());
			costoFlete   = costoFlete + (unidad*valorU);
		});
		$("#costoFlete").text(costoFlete.toFixed(0));

		var existeDescFlete = false;
		$.each( ajaxCall.Convenio, function( key, value ) {
			if(value.Descuento.unidad_inicial != null){
				if(sumaCant >= value.Descuento.unidad_inicial && sumaCant <= value.Descuento.unidad_final){
					existeDescFlete = true;
					descFlete = parseFloat(value.Descuento.unidad_porcentaje);
				}
			}
		});
		if(!existeDescFlete){
			$.each( ajaxCall.ConvenioBase, function( key, value ) {
				if(value.Descuento.unidad_inicial != null){
					if(sumaCant >= value.Descuento.unidad_inicial && sumaCant <= value.Descuento.unidad_final){
						existeDescFlete = true;
						descFlete = parseFloat(value.Descuento.unidad_porcentaje);
					}
				}
			});
		}
		if(!existeDescFlete){
			descFlete = 0;
		}
		$("#descFlete").text((costoFlete*(descFlete/100)).toFixed(0));
		$("#descFleteVal").text(descFlete);

		sumaPeso = 0;
		$.each($(".peso"), function( key, value ) {
			sumaPeso = sumaPeso + parseFloat($(value).val());
		});
		$("#contPeso").text(sumaPeso);
		calcularSubtotal();
		calcularTotal();
	};
	viewModel.removeUserTotal = function() {
	    viewModel.users.removeAll();
	};
	ko.applyBindings(viewModel);

	function calcularSubtotal(){
		sumaTotal = 0;
		$.each($(".subtotal"), function( key, value ) {
			sumaTotal = sumaTotal + parseFloat($(value).val());
		});
		$("#contTotal").text(sumaTotal);
	}
	function calcularTotal(){
		costoAdic     = 0;
		sumaPesoMayor = 0;
		sumaKiloMax   = 0;
		sumaKiloNego  = 0;
		$.each($(".largo"), function( key, value ) {
			var padreAct    = $(value).parent().parent().parent();
			var unidad      = parseFloat($(padreAct).find(".cantidad").val());
			var largoU      = parseFloat($(padreAct).find(".largo").val());
			var anchoU      = parseFloat($(padreAct).find(".ancho").val());
			var altoU       = parseFloat($(padreAct).find(".alto").val());
			var pesoU       = parseFloat($(padreAct).find(".peso").val());
			var kiloAdU     = parseFloat($(padreAct).find(".kiloAd").val());
			var valKiloU    = parseFloat($(padreAct).find(".valKilo").val());
			valKilo         = valKiloU;
			var pesoVolCalU = ((largoU/100)*(anchoU/100)*(altoU/100))*400*unidad;
			var mayor;
			kiloAdU      = kiloAdU * unidad;
			sumaKiloNego = sumaKiloNego + kiloAdU;
			if(pesoU > pesoVolCalU){
				mayor = pesoU;
			} else {
				mayor = pesoVolCalU;
			}
			sumaPesoMayor = sumaPesoMayor + mayor;
			sumaKiloMax   = sumaKiloMax + kiloAdU;
		});
		descKilo           = 0;
		var existeDescKilo = false;
		pesoKiloAd         = sumaPesoMayor-sumaKiloMax;
		if(pesoKiloAd > 0){
			$.each( ajaxCall.Convenio, function( key, value ) {
				if(value.Descuento.kilo_inicial != null){
					if((pesoKiloAd >= value.Descuento.kilo_inicial) && (pesoKiloAd <= value.Descuento.kilo_final)){
						existeDescKilo = true;
						descKilo       = parseFloat(value.Descuento.kilo_porcentaje);
					}
				}
			});
			if(!existeDescKilo){
				$.each( ajaxCall.ConvenioBase, function( key, value ) {
					if(value.Descuento.kilo_inicial != null){
						if(pesoKiloAd >= value.Descuento.kilo_inicial && pesoKiloAd <= value.Descuento.kilo_final){
							existeDescKilo = true;
							descKilo       = parseFloat(value.Descuento.kilo_porcentaje);
						}
					}
				});
			}
			if(!existeDescKilo){
				descKilo = 0;
			}
			costoAdic = (pesoKiloAd)*valKilo;
		} else {
			descKilo   = 0;
			costoAdic  = 0;
			pesoKiloAd = 0;
		}
		$("#descKilo").text((costoAdic*(descKilo/100)).toFixed(0));
		$("#descKiloVal").text(descKilo);
		$("#costoAdic").text(costoAdic.toFixed(0));
		$("#costoAdicVal").text(pesoKiloAd.toFixed(0));

		$("#VentaKiloNego").val(sumaKiloNego.toFixed(0));
		$("#VentaKiloAdic").val(pesoKiloAd.toFixed(0));
		$("#VentaValorKiloAdic").val(costoAdic.toFixed(0));
		$("#VentaValorSeguro").val(costoSeguro);
		$("#VentaValorDevolucion").val(costoDevol);
		$("#VentaDescFlete").val((costoFlete*descFlete/100).toFixed(0));
		$("#VentaDescKilo").val((costoAdic*descKilo/100).toFixed(0));
		costoSeguro = parseFloat(costoSeguro);
		costoDevol  = parseFloat(costoDevol);
		var op      = costoFlete+costoAdic+costoSeguro+costoDevol-(costoFlete*descFlete/100)-(costoAdic*descKilo/100);
		$("#VentaValorTotal").val(op.toFixed(0));
		op = op.formatMoney(0,',','.');
		$("#costoTotal").text(op);
	}

	var descuentoMax           = 50;
	var valorT                 = 0;
	var fullpath               = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var clientes               = <?php echo json_encode($clientes); ?>;
	var clientesIdentificacion = new Array();
	var clientesTelefono       = new Array();
	var ajaxCall               = new Array();
	var clienteId              = 1;
	var origenId               = 0;
	var destinoId              = 0;
	var sumaCant               = 0;
	var sumaPeso               = 0;
	var sumaTotal              = 0;
	var costoFlete             = 0;
	var costoAdic              = 0;
	var descFlete              = 0;
	var descKilo               = 0;
	var costoSeguro            = 0;
	var costoDevol             = 0;
	var costoTotal             = 0;
	var seguro                 = 0;
	var sumaPesoMayor          = 0;
	var sumaKiloMax            = 0;
	var valKilo                = 0;
	var pesoKiloAd             = 0;
$(function() {
	$("#LiquidarDocumento").autocomplete({
		source: clientesIdentificacion,
		select: function( event, ui ) {
			$.each( clientes, function( key, value ) {
				if(ui.item.value == value.Cliente.documento){
					if(value.Cliente.activo == "No"){
						$("#LiquidarDocumento").val("");
						$("#LiquidarCliente").val("");
						$("#LiquidarNombre").val("");
						$("#LiquidarDireccion").val("");
						$("#LiquidarTelefono").val("");
						$("#LiquidarTelefono2").val("");
						$("#LiquidarEmail").val("");
						$("#LiquidarFax").val("");
						alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
					} else if(value.Cliente.causal != "Activo"){
						$("#LiquidarDocumento").val("");
						$("#LiquidarCliente").val("");
						$("#LiquidarNombre").val("");
						$("#LiquidarDireccion").val("");
						$("#LiquidarTelefono").val("");
						$("#LiquidarTelefono2").val("");
						$("#LiquidarEmail").val("");
						$("#LiquidarFax").val("");
						alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
					} else {
						clienteId = value.Cliente.id;
						$("#LiquidarCliente").val(value.Cliente.id);
						$("#LiquidarNombre").val(value.Cliente.listNombre);
						$("#LiquidarDireccion").val(value.Cliente.direccion);
						$("#LiquidarTelefono").val(value.Cliente.telefono);
						$("#LiquidarTelefono2").val(value.Cliente.telefono2);
						$("#LiquidarEmail").val(value.Cliente.email);
						$("#LiquidarFax").val(value.Cliente.fax);
					}
					$("#LiquidarDestino").val("");
					$("#LiquidarOrigen").val("");
					$("#LiquidarOrigen").trigger("chosen:updated");
					$("#LiquidarDestino").trigger("chosen:updated");
				}
			});
		}
	});
	$("#LiquidarTelefono").autocomplete({
		source: clientesTelefono,
		select: function( event, ui ) {
			$.each( clientes, function( key, value ) {
				if(ui.item.value == value.Cliente.telefono){
					if(value.Cliente.activo == "No"){
						$("#LiquidarNombre").val("");
						$("#LiquidarCliente").val("");
						$("#LiquidarNombre").val("");
						$("#LiquidarDireccion").val("");
						$("#LiquidarTelefono").val("");
						$("#LiquidarTelefono2").val("");
						$("#LiquidarEmail").val("");
						$("#LiquidarFax").val("");
						alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
					} else if(value.Cliente.causal != "Activo"){
						$("#LiquidarNombre").val("");
						$("#LiquidarCliente").val("");
						$("#LiquidarNombre").val("");
						$("#LiquidarDireccion").val("");
						$("#LiquidarTelefono").val("");
						$("#LiquidarTelefono2").val("");
						$("#LiquidarEmail").val("");
						$("#LiquidarFax").val("");
						alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
					} else {
						clienteId = value.Cliente.id;
						$("#LiquidarNombre").val(value.Cliente.listNombre);
						$("#LiquidarCliente").val(value.Cliente.id);
						$("#LiquidarDocumento").val(value.Cliente.documento);
						$("#LiquidarDireccion").val(value.Cliente.direccion);
						$("#LiquidarTelefono2").val(value.Cliente.telefono2);
						$("#LiquidarEmail").val(value.Cliente.email);
						$("#LiquidarFax").val(value.Cliente.fax);
					}
					$("#LiquidarDestino").val("");
					$("#LiquidarOrigen").val("");
					$("#LiquidarOrigen").trigger("chosen:updated");
					$("#LiquidarDestino").trigger("chosen:updated");
				}
			});
		}
	});
});

$(document).ready(function(){

	$("#btn-enviar").click(function(){
		email = $("#LiquidarEmail").val();
		var check = prompt("Esta seguro de enviar la cotización a:",email);
		if(check != null && check != ""){
			var arroba = check.indexOf("@");
			var punto  = check.lastIndexOf(".");
			if (arroba > -1 && punto > -1 && punto > arroba){
				$.fancybox.showLoading();
				$.fancybox.helpers.overlay.open();
				var infoEmail = new Array();
				infoEmail[0]  = email;
				var total     = valorTotal.formatMoney(0,',','.');
				infoEmail[1]  = "Probando si funciona.\nel salto de linea y el correo.\nPor un valor de $"+total;
				$.ajax({
					data: { dataEmail : JSON.stringify(infoEmail)},
					type: 'POST',
					url: "enviarLiquidacion",
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					},
					success: function(response) {
						$.fancybox.hideLoading();
						$.fancybox.helpers.overlay.close();
					},
					error: function(e) {
						console.log("An error occurred: " + e.responseText.message);
					}
				});
			} else {
				alert("Por favor ingrese un correo valido.");
			}
		}
	});
	$.each( clientes, function( key, value ) {
		clientesIdentificacion[key] = value.Cliente.documento;
		clientesTelefono[key]       = value.Cliente.telefono;
	});

	viewModel.addUser();
	$("#LiquidarFecha").datepicker({minDate: 0});

	$("#btn-limpiar").click(function(){
		viewModel.users.removeAll();
		viewModel.addUser();
		$("#div-remitente").hide();
		$("#LiquidarDevolverFirmado").val(0);
		$("#LiquidarTipo").val(0);
		$("#kiloAdSpan").text("0");
		$("#LiquidarDeclarado").val("");
		$("#LiquidarFirmado").val("No");
		$("#LiquidarDestino").val("");
		$("#LiquidarOrigen").val("");
		$("#LiquidarDocumentoRemi").val("");
		$("#LiquidarTelefono").val("");
		$("#LiquidarTelefono").trigger("chosen:updated");
		$("#LiquidarOrigen").trigger("chosen:updated");
		$("#LiquidarDestino").trigger("chosen:updated");
		clienteId      = 1;
		remitenteId    = 0;
		destinatarioId = 0;
		sumaCant       = 0;
		sumaPeso       = 0;
		sumaTotal      = 0;
		costoTotal     = 0;
		costoFlete     = 0;
		costoAdic      = 0;
		costoSeguro    = 0;
		costoDevol     = 0;
		descFlete      = 0;
		descKilo       = 0;
		$("#costoTotal").text("0");
		$("#costoFlete").text("0");
		$("#costoAdic").text("0");
		$("#costoAdicVal").text("0");
		$("#costoSeguro").text("0");
		$("#costoDevol").text("0");
		$("#descFlete").text("0");
		$("#descKilo").text("0");
		$("#costoSeguroVal").text(0);
		$("#descFleteVal").text(0);
		$("#descKiloVal").text(0);
		$("#contCantidad").text(0);
		$("#contPeso").text(0);
		$("#contTotal").text(0);
	});
	/*
		$("#LiquidarDeclarado").number( true, 0 );
	*/
	$("#LiquidarDeclarado").keyup(function(){
		var strNum = $(this).val();
		var num    = parseFloat(strNum.replace(/,/g,""));
		num        = num.formatMoney(0,',','.');
		$(this).val(num);
	});

	$("#LiquidarDeclarado").blur(function(){
		seguro = 0;
		if(ajaxCall != undefined){
			if(ajaxCall.Tarifa.length > 0){
				var strNum = $(this).val();
				var declaIn     = parseFloat(strNum.replace(/,/g,""));
				var declaBd     = parseFloat(ajaxCall.Tarifa[0].Tarifa.declarado);
				var porcenDecla = parseFloat(ajaxCall.Tarifa[0].Tarifa.porcen_declarado);
				if(declaIn > declaBd){
					seguro = (declaIn-declaBd)*(porcenDecla/100);
					$("#costoSeguroVal").text(declaBd+"-"+porcenDecla+"%");
					$("#costoSeguro").text(seguro);
					costoSeguro = parseFloat(seguro);
				} else {
					$("#costoSeguroVal").text(declaBd+"-"+porcenDecla+"%");
					$("#costoSeguro").text(0);
					costoSeguro = 0;
				}
			} else {
				if(ajaxCall.TarifaBase.length > 0){
					var strNum = $(this).val();
					var declaIn     = parseFloat(strNum.replace(/,/g,""));
					var declaBd     = parseFloat(ajaxCall.TarifaBase[0].Tarifa.declarado);
					var porcenDecla = parseFloat(ajaxCall.TarifaBase[0].Tarifa.porcen_declarado);
					console.log(porcenDecla);
					console.log(declaIn);
					if(declaIn > declaBd){
						seguro = (declaIn-declaBd)*(porcenDecla/100);
						$("#costoSeguroVal").text(declaBd+"-"+porcenDecla+"%");
						$("#costoSeguro").text(seguro);
						costoSeguro = parseFloat(seguro);
					} else {
						$("#costoSeguroVal").text(declaBd+"-"+porcenDecla+"%");
						$("#costoSeguro").text(0);
						costoSeguro = 0;
					}
				}
			}
		}
		calcularTotal();
	});

	$("#LiquidarFirmado").change(function(){
		if($(this).val() == "Si"){
			var existeDevol = false;
			$.each( ajaxCall.Tarifa, function( key, value ) {
				if(4 == value.Tarifa.empaque_id){
					existeDevol = true;
					costoDevol = parseFloat(value.Tarifa.tarifa).toFixed(0);
					$("#costoDevol").text(costoDevol);
					$("#LiquidarDevolverFirmado").val(costoDevol);
				}
			});
			if(!existeDevol){
				$.each( ajaxCall.TarifaBase, function( key, value ) {
					if(4 == value.Tarifa.empaque_id){
						existeDevol = true;
						costoDevol = parseFloat(value.Tarifa.tarifa).toFixed(0);
						$("#costoDevol").text(costoDevol);
						$("#LiquidarDevolverFirmado").val(costoDevol);
					}
				});
				if(!existeDevol){
					alert("Devolución de documentos sin tarifa, contactar al administrador.");
					$(this).val("No");
				}
			}
		} else {
			costoDevol = 0;
			$("#costoDevol").text(0);
			$("#LiquidarDevolverFirmado").val(0);
		}
		calcularTotal();
	});

	$("#LiquidarOrigen").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el origen"
	});
	$("#LiquidarDestino").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el destino"
	});


	$("#LiquidarDocumento").change(function(){
		var docuCli = $(this).val();
		$.each( clientes, function( key, value ) {
			if(docuCli == value.Cliente.documento){
				if(value.Cliente.activo == "No"){
					$("#LiquidarDocumento").val("");
					$("#LiquidarCliente").val("");
					$("#LiquidarNombre").val("");
					$("#LiquidarDireccion").val("");
					$("#LiquidarTelefono").val("");
					$("#LiquidarTelefono2").val("");
					$("#LiquidarEmail").val("");
					$("#LiquidarFax").val("");
					alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
				} else if(value.Cliente.causal != "Activo"){
					$("#LiquidarDocumento").val("");
					$("#LiquidarCliente").val("");
					$("#LiquidarNombre").val("");
					$("#LiquidarDireccion").val("");
					$("#LiquidarTelefono").val("");
					$("#LiquidarTelefono2").val("");
					$("#LiquidarEmail").val("");
					$("#LiquidarFax").val("");
					alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
				} else {
					clienteId = value.Cliente.id;
					$("#LiquidarCliente").val(value.Cliente.id);
					$("#LiquidarNombre").val(value.Cliente.listNombre);
					$("#LiquidarDireccion").val(value.Cliente.direccion);
					$("#LiquidarTelefono").val(value.Cliente.telefono);
					$("#LiquidarTelefono2").val(value.Cliente.telefono2);
					$("#LiquidarEmail").val(value.Cliente.email);
					$("#LiquidarFax").val(value.Cliente.fax);
				}
				$("#LiquidarDestino").val("");
				$("#LiquidarOrigen").val("");
				$("#LiquidarOrigen").trigger("chosen:updated");
				$("#LiquidarDestino").trigger("chosen:updated");
			}
		});
	});

	$("#LiquidarTelefono").change(function(){
		var docuCli = $(this).val();
		$.each( clientes, function( key, value ) {
			if(docuCli == value.Cliente.telefono){
				if(value.Cliente.activo == "No"){
					$("#LiquidarTelefono").val("");
					$("#LiquidarCliente").val("");
					$("#LiquidarNombre").val("");
					$("#LiquidarDireccion").val("");
					$("#LiquidarTelefono").val("");
					$("#LiquidarTelefono2").val("");
					$("#LiquidarEmail").val("");
					$("#LiquidarFax").val("");
					alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
				} else if(value.Cliente.causal != "Activo"){
					$("#LiquidarTelefono").val("");
					$("#LiquidarCliente").val("");
					$("#LiquidarNombre").val("");
					$("#LiquidarDireccion").val("");
					$("#LiquidarTelefono").val("");
					$("#LiquidarTelefono2").val("");
					$("#LiquidarEmail").val("");
					$("#LiquidarFax").val("");
					alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
				} else {
					clienteId = value.Cliente.id;
					$("#LiquidarCliente").val(value.Cliente.id);
					$("#LiquidarNombre").val(value.Cliente.listNombre);
					$("#LiquidarDireccion").val(value.Cliente.direccion);
					$("#LiquidarTelefono").val(value.Cliente.telefono);
					$("#LiquidarTelefono2").val(value.Cliente.telefono2);
					$("#LiquidarEmail").val(value.Cliente.email);
					$("#LiquidarFax").val(value.Cliente.fax);
				}
				$("#LiquidarDestino").val("");
				$("#LiquidarOrigen").val("");
				$("#LiquidarOrigen").trigger("chosen:updated");
				$("#LiquidarDestino").trigger("chosen:updated");
			}
		});
	});

	$(document).on("change",".largo",function(){
		var padre      = $(this).parent().parent().parent();
		var largo      = $(this).val();
		var ancho      = $(padre).find(".ancho").val();
		var alto       = $(padre).find(".alto").val();
		var cantidad   = parseFloat($(padre).find(".cantidad").val());
		var pesoVolCal = ((largo/100)*(ancho/100)*(alto/100))*400*cantidad;
		$(padre).find(".pesoVol").val(pesoVolCal.toFixed(0));

		var valor    = parseFloat($(padre).find(".valor").val());
		var mayor;
		var subtotal = (valor*cantidad);

		subtotal  = subtotal.toFixed(0);
		$(padre).find(".subtotal").val(subtotal);

		calcularSubtotal();
		calcularTotal();
	});
	$(document).on("change",".ancho",function(){
		var padre = $(this).parent().parent().parent();
		var ancho = $(this).val();
		var largo = $(padre).find(".largo").val();
		var alto  = $(padre).find(".alto").val();
		var cantidad   = parseFloat($(padre).find(".cantidad").val());
		var pesoVolCal = ((largo/100)*(ancho/100)*(alto/100))*400*cantidad;
		$(padre).find(".pesoVol").val(pesoVolCal.toFixed(0));

		var valor    = parseFloat($(padre).find(".valor").val());
		var pesoVol  = pesoVolCal;
		var subtotal = (valor*cantidad);
		$(padre).find(".subtotal").val(subtotal);

		calcularSubtotal();
		calcularTotal();
	});
	$(document).on("change",".alto",function(){
		var padre = $(this).parent().parent().parent();
		var alto  = $(this).val();
		var ancho = $(padre).find(".ancho").val();
		var largo = $(padre).find(".largo").val();
		var cantidad   = parseFloat($(padre).find(".cantidad").val());
		var pesoVolCal = ((largo/100)*(ancho/100)*(alto/100))*400*cantidad;
		$(padre).find(".pesoVol").val(pesoVolCal.toFixed(0));
		var valor    = parseFloat($(padre).find(".valor").val());
		var subtotal = (valor*cantidad);
		subtotal = subtotal.toFixed(0);
		$(padre).find(".subtotal").val(subtotal);

		calcularSubtotal();
		calcularTotal();
	});
	$(document).on("change",".empaques",function(){
		var padre = $(this).parent().parent().parent();
		var empa  = $(this).val();
		var existe = false;

		$(padre).find(".cantidad").val("0");
		$(padre).find(".largo").val("0");
		$(padre).find(".ancho").val("0");
		$(padre).find(".alto").val("0");
		$(padre).find(".peso").val("0");
		$(padre).find(".pesoUni").val("0");
		$(padre).find(".pesoVol").val("0");
		$(padre).find(".subtotal").val("0");

		$.each( ajaxCall.Tarifa, function( key, value ) {
			if(empa == value.Tarifa.empaque_id){
				existe = true;
				$("#kiloAdSpan").text(parseFloat(value.Tarifa.valor_adicional).toFixed(0));
				$(padre).find(".valor").val(parseFloat(value.Tarifa.tarifa).toFixed(0));
				$(padre).find(".kiloAd").val(parseFloat(value.Tarifa.max_kilo).toFixed(0));
				$(padre).find(".valKilo").val(parseFloat(value.Tarifa.valor_adicional).toFixed(0));
				$(padre).find(".largo").val(parseFloat(value.Tarifa.largo).toFixed(0));
				$(padre).find(".ancho").val(parseFloat(value.Tarifa.ancho).toFixed(0));
				$(padre).find(".alto").val(parseFloat(value.Tarifa.alto).toFixed(0));
				$(padre).find(".pesoUni").val(parseFloat(value.Tarifa.peso).toFixed(0));
				var alto       = $(padre).find(".alto").val();
				var ancho      = $(padre).find(".ancho").val();
				var largo      = $(padre).find(".largo").val();
				var cantidad   = parseFloat($(padre).find(".cantidad").val());
				var pesoVolCal = ((largo/100)*(ancho/100)*(alto/100))*400*cantidad;
				$(padre).find(".pesoVol").val(pesoVolCal.toFixed(0));
			}
		});
		if(!existe){
			$.each( ajaxCall.TarifaBase, function( key, value ) {
				if(empa == value.Tarifa.empaque_id){					
					existe = true;
					$("#kiloAdSpan").text(parseFloat(value.Tarifa.valor_adicional).toFixed(0));
					$(padre).find(".valor").val(parseFloat(value.Tarifa.tarifa).toFixed(0));
					$(padre).find(".kiloAd").val(parseFloat(value.Tarifa.max_kilo).toFixed(0));
					$(padre).find(".valKilo").val(parseFloat(value.Tarifa.valor_adicional).toFixed(0));
					$(padre).find(".largo").val(parseFloat(value.Tarifa.largo).toFixed(0));
					$(padre).find(".ancho").val(parseFloat(value.Tarifa.ancho).toFixed(0));
					$(padre).find(".alto").val(parseFloat(value.Tarifa.alto).toFixed(0));
					$(padre).find(".pesoUni").val(parseFloat(value.Tarifa.peso).toFixed(0));
					var alto       = $(padre).find(".alto").val();
					var ancho      = $(padre).find(".ancho").val();
					var largo      = $(padre).find(".largo").val();
					var cantidad   = parseFloat($(padre).find(".cantidad").val());
					var pesoVolCal = ((largo/100)*(ancho/100)*(alto/100))*400*cantidad;
					$(padre).find(".pesoVol").val(pesoVolCal.toFixed(0));
				}
			});
			if(!existe){
				alert("Empaque sin tarifa, contactar al administrador.");
location.reload(true);
				$(this).val("");
			}
		}
		
		calcularSubtotal();

		costoFlete        = 0;
		var sumaPesoMayor = 0;
		var sumaKiloMax   = 0;
		$.each($(".empaques"), function( key, value ) {
			var padreAct    = $(value).parent().parent().parent();
			var unidad      = parseFloat($(padreAct).find(".cantidad").val());
			var valorU      = parseFloat($(padreAct).find(".valor").val());
			costoFlete   = costoFlete + (unidad*valorU);
		});
		$("#costoFlete").text(costoFlete.toFixed(0));

		sumaPeso = 0;
		$.each($(".peso"), function( key, value ) {
			sumaPeso = sumaPeso + parseFloat($(value).val());
		});
		$("#contPeso").text(sumaPeso);
		sumaCant = 0;
		$.each($(".cantidad"), function( key, value ) {
			sumaCant = sumaCant + parseInt($(value).val());
		});
		$("#contCantidad").text(sumaCant);


		descFlete = 0;
		var existeDescFlete = false;
		$.each( ajaxCall.Convenio, function( key, value ) {
			if(value.Descuento.unidad_inicial != null){
				if((sumaCant >= value.Descuento.unidad_inicial) && (sumaCant <= value.Descuento.unidad_final)){
					existeDescFlete = true;
					descFlete = parseFloat(value.Descuento.unidad_porcentaje);
				}
			}
		});
		if(!existeDescFlete){
			$.each( ajaxCall.ConvenioBase, function( key, value ) {
				if(value.Descuento.unidad_inicial != null){
					if(sumaCant >= value.Descuento.unidad_inicial && sumaCant <= value.Descuento.unidad_final){
						existeDescFlete = true;
						descFlete = parseFloat(value.Descuento.unidad_porcentaje);
					}
				}
			});
		}
		if(!existeDescFlete){
			descFlete = 0;
		}
		$("#descFlete").text((costoFlete*(descFlete/100)).toFixed(0));
		$("#descFleteVal").text(descFlete);

		calcularTotal();
	});
	$(document).on("change",".cantidad",function(){
		sumaCant = 0;
		$.each($(".cantidad"), function( key, value ) {
			sumaCant = sumaCant + parseInt($(value).val());
		});
		$("#contCantidad").text(sumaCant);
		if(sumaCant >= 2){
			$(".descu").show();
		} else {
			$(".descu").hide();
			$("#LiquidarDescPorcen").val("");
			$("#LiquidarDescValor").val("");
		}
		var padre    = $(this).parent().parent().parent();
		var cantidad = parseFloat($(this).val());
		var valor    = parseFloat($(padre).find(".valor").val());

		var subtotal = (valor*cantidad);
		subtotal = subtotal.toFixed(0);
		$(padre).find(".subtotal").val(subtotal);

		var alto       = $(padre).find(".alto").val();
		var ancho      = $(padre).find(".ancho").val();
		var largo      = $(padre).find(".largo").val();
		var peso       = parseFloat($(padre).find(".peso").val());
		var pesoUni    = parseFloat($(padre).find(".pesoUni").val());
		var calcularPeso;
		if(peso > 0){
			calcularPeso = peso/cantidad;
			$(padre).find(".pesoUni").val(calcularPeso.toFixed(2));
		} else if(pesoUni > 0){
			calcularPeso = pesoUni*cantidad;
			$(padre).find(".peso").val(calcularPeso.toFixed(2));
		} 

		var pesoVolCal = ((largo/100)*(ancho/100)*(alto/100))*400*cantidad;
		$(padre).find(".pesoVol").val(pesoVolCal.toFixed(0));

		calcularSubtotal();

		costoFlete        = 0;
		var sumaPesoMayor = 0;
		var sumaKiloMax   = 0;
		$.each($(".cantidad"), function( key, value ) {
			var padreAct    = $(value).parent().parent().parent();
			var unidad      = parseFloat($(padreAct).find(".cantidad").val());
			var valorU      = parseFloat($(padreAct).find(".valor").val());
			var largoU      = parseFloat($(padreAct).find(".largo").val());
			var anchoU      = parseFloat($(padreAct).find(".ancho").val());
			var altoU       = parseFloat($(padreAct).find(".alto").val());
			var pesoU       = parseFloat($(padreAct).find(".peso").val());
			var kiloAdU     = parseFloat($(padreAct).find(".kiloAd").val());
			var pesoVolCalU = ((largoU/100)*(anchoU/100)*(altoU/100))*400*unidad;
			var mayor;
			kiloAdU = kiloAdU * unidad;
			if(pesoU > pesoVolCalU){
				mayor = pesoU;
			} else {
				mayor = pesoVolCalU;
			}
			sumaPesoMayor = sumaPesoMayor + mayor;
			sumaKiloMax   = sumaKiloMax + kiloAdU;

			costoFlete   = costoFlete + (unidad*valorU);
		});
		$("#costoFlete").text(costoFlete.toFixed(0));


		var existeDescFlete = false;
		$.each( ajaxCall.Convenio, function( key, value ) {
			if(value.Descuento.unidad_inicial != null){
				if(sumaCant >= value.Descuento.unidad_inicial && sumaCant <= value.Descuento.unidad_final){
					existeDescFlete = true;
					descFlete = parseFloat(value.Descuento.unidad_porcentaje);
				}
			}
		});
		if(!existeDescFlete){
			$.each( ajaxCall.ConvenioBase, function( key, value ) {
				if(value.Descuento.unidad_inicial != null){
					if(sumaCant >= value.Descuento.unidad_inicial && sumaCant <= value.Descuento.unidad_final){
						existeDescFlete = true;
						descFlete = parseFloat(value.Descuento.unidad_porcentaje);
					}
				}
			});
		}
		if(!existeDescFlete){
			descFlete = 0;
		}
		$("#descFlete").text((costoFlete*(descFlete/100)).toFixed(0));
		$("#descFleteVal").text(descFlete);

		descKilo           = 0;
		var existeDescKilo = false;
		pesoKiloAd         = sumaPesoMayor-sumaKiloMax;
		if(pesoKiloAd > 0){
			$.each( ajaxCall.Convenio, function( key, value ) {
				if(value.Descuento.kilo_inicial != null){
					if((pesoKiloAd >= value.Descuento.kilo_inicial) && (pesoKiloAd <= value.Descuento.kilo_final)){
						existeDescKilo = true;
						descKilo       = parseFloat(value.Descuento.kilo_porcentaje);
					}
				}
			});
			if(!existeDescKilo){
				$.each( ajaxCall.ConvenioBase, function( key, value ) {
					if(value.Descuento.kilo_inicial != null){
						if(pesoKiloAd >= value.Descuento.kilo_inicial && pesoKiloAd <= value.Descuento.kilo_final){
							existeDescKilo = true;
							descKilo       = parseFloat(value.Descuento.kilo_porcentaje);
						}
					}
				});
			}
			if(!existeDescKilo){
				descKilo = 0;
			}
		} else {
			descKilo = 0;
		}
		$("#descKilo").text((costoFlete*(descKilo/100)).toFixed(0));
		$("#descKiloVal").text(descKilo);
		calcularTotal();
	});
	$(document).on("change",".peso",function(){
		sumaPeso = 0;
		$.each($(".peso"), function( key, value ) {
			sumaPeso = sumaPeso + parseFloat($(value).val());
		});
		$("#contPeso").text(sumaPeso);

		var padre    = $(this).parent().parent().parent();
		var valor    = parseFloat($(padre).find(".valor").val());
		var cantidad = parseFloat($(padre).find(".cantidad").val());
		var pesoUni  = parseFloat($(padre).find(".pesoUni").val());
		var peso     = parseFloat($(this).val());
		var calcularPeso;
		if(peso > 0){
			calcularPeso = peso/cantidad;
			$(padre).find(".pesoUni").val(calcularPeso.toFixed(2));
		}
		var subtotal = (valor*cantidad);
		subtotal = subtotal.toFixed(0);
		$(padre).find(".subtotal").val(subtotal);

		calcularSubtotal();
		calcularTotal();
	});

	$(document).on("change",".pesoUni",function(){

		var padre    = $(this).parent().parent().parent();
		var valor    = parseFloat($(padre).find(".valor").val());
		var cantidad = parseFloat($(padre).find(".cantidad").val());
		var peso     = parseFloat($(padre).find(".peso").val());
		var pesoUni  = parseFloat($(this).val());
		var calcularPeso;
		if(pesoUni > 0){
			calcularPeso = pesoUni*cantidad;
			$(padre).find(".peso").val(calcularPeso.toFixed(2));
		}
		var subtotal = (valor*cantidad);
		subtotal = subtotal.toFixed(0);
		$(padre).find(".subtotal").val(subtotal);

		sumaPeso = 0;
		$.each($(".peso"), function( key, value ) {
			sumaPeso = sumaPeso + parseFloat($(value).val());
		});
		$("#contPeso").text(sumaPeso);

		calcularSubtotal();
		calcularTotal();
	});

	$("#LiquidarOrigen").change(function(){
		$("#LiquidarDestino").val("");
		$("#LiquidarDestino").trigger("chosen:updated");
	});
	$("#LiquidarDestino").change(function(){
		if($("#LiquidarOrigen").val() == ""){
			alert("Seleccione una ciudad de origen primero.");
			$("#LiquidarDestino").val("");
			$("#LiquidarDestino").trigger("chosen:updated");
		} else {
			if($(this).val() != ""){
				$("#kiloAdSpan").val("");
				origenId  = $("#LiquidarOrigen").val();
				destinoId = $("#LiquidarDestino").val();
				$("#LiquidarDeclarado").val("");
				viewModel.removeUserTotal();
				viewModel.addUser();
				sumaCant    = 0;
				sumaPeso    = 0;
				sumaTotal   = 0;
				costoSeguro = 0;
				costoDevol  = 0;
				$("#contCantidad").text(0);
				$("#contPeso").text(0);
				$("#contTotal").text(0);
				$("#costoSeguroVal").text(0);
				$("#costoSeguro").text(0);
				$("#costoDevol").text(0);
				$("#LiquidarFirmado").val("No");
				calcularTotal();
				var clienteDocumActual = $("#LiquidarDocumento").val();
				var flag = true;
				$.each( clientes, function( key, value ) {
					if(clienteDocumActual == value.Cliente.documento){
						clienteId = value.Cliente.id;
						flag      = false;
					}
					if(flag){
						clienteId = 1;
					}
				});
				$.fancybox.showLoading();
				$.fancybox.helpers.overlay.open();
				$.ajax({
					type: 'json',
					url: fullpath+"liquidar/getTarifa/"+clienteId+"/"+origenId+"/"+destinoId,
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
			}
		}
	});

})
</script>