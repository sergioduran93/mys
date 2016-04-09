<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->script('jquery.jCombo.min');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->css('jquery.fancybox');
	echo $this->Html->script('bootstrapValidator.min');

?>
<?php echo $this->Form->create('Venta',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<?php echo $this->Form->input('id',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('oficina_trae',  array('type'=>'hidden','default'=>$usuario_actual['oficina_id'])); ?>
		<?php echo $this->Form->input('valor_seguro',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('valor_devolucion',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('kilo_nego',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('kilo_adic',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('valor_kilo_adic',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('desc_flete',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('desc_kilo',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('valor_total',  array('type'=>'hidden')); ?>
	<div style="margin: 0px 30px;">
		<div class="bs-callout bs-callout-warning" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
			<h4 style="color:rgb(226, 127, 0);">Cliente</h4>
			<div class="form-group col-md-12">
				<div class="col-md-4"><h4 class="traz"><span>Doc cliente: </span><small><?php echo $this->data['Venta']['documentoClien'] ?></small></h4></div>
				<div class="col-md-4"><h4 class="traz"><span>Nombre cliente: </span><small><?php echo $this->data['Venta']['nombreClien'] ?></small></h4></div>
				<div class="col-md-4"><h4 class="traz"><span>Dirección cliente: </span><small><?php echo $this->data['Venta']['direccionClien'] ?></small></h4></div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-3"><h4 class="traz"><span>Origen: </span><small><?php echo $this->data['Venta']['origenNombre'] ?></small></h4></div>
				<div class="col-md-3"><h4 class="traz"><span>Teléfono cliente: </span><small><?php echo $this->data['Venta']['telefonoClien'] ?></small></h4></div>
				<div class="col-md-3"><h4 class="traz"><span>Fax cliente: </span><small><?php echo $this->data['Venta']['faxClien'] ?></small></h4></div>
				<div class="col-md-3"><h4 class="traz"><span>Email cliente: </span><small><?php echo $this->data['Venta']['emailClien'] ?></small></h4></div>
			</div>
		</div>
		<div class="bs-callout bs-callout-info" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
			<h4 style="color:rgb(55, 88, 131);">Destinatario</h4>
			<div class="form-group col-md-12">
				<div class="col-md-4"><h4 class="traz"><span>Doc destinatario: </span><small><?php echo $this->data['Venta']['documentoDest'] ?></small></h4></div>
				<div class="col-md-4"><h4 class="traz"><span>Nombre destinatario: </span><small><?php echo $this->data['Venta']['nombreDest'] ?></small></h4></div>
				<div class="col-md-4"><h4 class="traz"><span>Dirección destinatario: </span><small><?php echo $this->data['Venta']['direccionDest'] ?></small></h4></div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-3"><h4 class="traz"><span>Destino: </span><small><?php echo $this->data['Venta']['destinoNombre'] ?></small></h4></div>
				<div class="col-md-3"><h4 class="traz"><span>Teléfono destinatario: </span><small><?php echo $this->data['Venta']['telefonoDest'] ?></small></h4></div>
				<div class="col-md-3"><h4 class="traz"><span>Fax destinatario: </span><small><?php echo $this->data['Venta']['faxDest'] ?></small></h4></div>
				<div class="col-md-3"><h4 class="traz"><span>Email destinatario: </span><small><?php echo $this->data['Venta']['emailDest'] ?></small></h4></div>
			</div>
		</div>
		<div class="bs-callout bs-callout-green" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
			<div class="form-group col-md-12">
				<div class="col-md-6"><h4 class="traz"><span>Valor Declarado: </span><small><?php echo $this->data['Venta']['declarado'] ?></small></h4></div>
				<div class="col-md-6"><h4 class="traz"><span>Valor Devolución: </span><small id="devolSpan"><?php echo $this->data['Venta']['valor_devolucion'] ?></small></h4></div>
			</div>
		</div>
	</div>
	<div class="panel panel-info thumbnail" style="margin: 10px 30px 0px 30px;" id="divDetalle">
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
	            <th style="text-align:center;">Cod. Barras</th>
	            <th style="text-align:center;">Descrip</th>
	            <th style="text-align:center;">Cantidad</th>
	            <th style="text-align:center;">Peso Unidad</th>
	            <th style="text-align:center;">Largo</th>
	            <th style="text-align:center;">Ancho</th>
	            <th style="text-align:center;">Alto</th>
	            <th style="text-align:center;">Peso Total</th>
	            <th style="text-align:center;">Peso Vol.</th>
	            <th style="text-align:center;">Valor Unitario</th>
	            <th style="text-align:center;">Kilos Negocid</th>
				<th style="text-align:center;"></th>
	        </tr>
	        <tbody data-bind="foreach: users">
	            <tr>
					<td class="col-md-2" style="padding:0px;">
						<?php echo $this->Form->input('empaques.',array('class'=>'empaques','label'=>false,'type'=>'select','options'=>$empaques,'empty'=>'')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('cbarras.',array('class'=>'barras','label'=>false,'type'=>'text')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('descripcion.',array('class'=>'descripcion','label'=>false,'type'=>'text')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('cantidad.',array('class'=>"cantidad form-control",'label'=>false,'type'=>'text','default'=>'0','style'=>'text-align: left;','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change keyup')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('valKilo.',array('class'=>'valKilo hidden','label'=>false,'type'=>'text','readonly'=>'readonly')); ?>
						<?php echo $this->Form->input('pesoUni.',array('class'=>'pesoUni','label'=>false,'type'=>'text','default'=>'0')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('largo.',array('class'=>"largo form-control",'label'=>false,'type'=>'text','default'=>'0','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change keyup')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('ancho.',array('class'=>"ancho form-control",'label'=>false,'type'=>'text','default'=>'0','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change keyup')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('alto.',array('class'=>"alto form-control",'label'=>false,'type'=>'text','default'=>'0','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change keyup')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('peso.',array('class'=>"peso form-control",'label'=>false,'type'=>'text','default'=>'0','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change keyup')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('pesoVol.',array('class'=>"pesoVol",'label'=>false,'type'=>'text','default'=>'0','readonly'=>'readonly')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('valor.',array('class'=>'valor','label'=>false,'type'=>'text','readonly'=>'readonly',"style"=>"padding: 3px 0px;text-align: center;")); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('kiloAd2.',array('class'=>'kiloAd2','label'=>false,'type'=>'text','readonly'=>'readonly','data-bind'=>'value: kiloAd')); ?>
						<?php echo $this->Form->input('kiloAd.',array('class'=>'kiloAd','type'=>'hidden')); ?>
					</td>
					<td style="padding:0px;border:none;" class="btn btn-danger" data-bind='click: $root.removeUser'>
						<span class="glyphicon glyphicon-remove"></span>
					</td>
	            </tr>	            
	        </tbody>
	        <tr style="border-top: 2px solid #000; text-align: center; font-weight: bold;">
	        	<td class="col-md-1" style="padding:0px;">
				</td>
	        	<td class="col-md-2" style="padding:0px;">
	        		Subtotal
				</td>
				<td class="col-md-1" style="padding:0px;">
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
				</td>
				<td class="col-md-1" style="padding:0px;">
					<span id="contPeso">0</span>
				</td>
				<td class="col-md-1" style="padding:0px;">
					<span id="contPesoVol">0</span>
				</td>
				<td class="col-md-1" style="padding:0px;">
				</td>
				<td class="col-md-1" style="padding:0px;">
					<span id="contKiloAd">0</span>
				</td>
	        </tr>
	    </table>
	</div>
	<div class="col-md-6" style="padding:0px;float:right;margin-right: 30px;">
		<?php if($recibo>0){ echo "Falta recibo";}else{ echo "Con recibo";} ?>
	</div>
	<div class="col-md-6" style="padding:0px;float:right;margin-right: 30px;">
		<table class="well col-md-12">
			<thead>
				<th class="col-md-6">Descripción</th>
				<th class="col-md-6"><span style="float:right;">Valor</span></th>
			</thead>
			<tbody>
				<tr>
					<td>Costo flete</td>
					<td><span style="float:right;" id="costoFlete">0</span></td>
				</tr>
				<tr>
					<td>Costo Kg adicional (<span id="costoAdicVal">0</span>Kg.)</td>
					<td><span style="float:right;" id="costoAdic">0</span></td>
				</tr>
				<tr>
					<td>Descuento flete (<span id="descFleteVal">0</span>%)</td>
					<td><span style="float:right;" id="descFlete">0</span></td>
				</tr>
				<tr>
					<td>Descuento kilos (<span id="descKiloVal">0</span>%)</td>
					<td><span style="float:right;" id="descKilo">0</span></td>
				</tr>
				<tr>
					<td>Costo valor seguro (<span id="costoSeguroVal">0</span>)</td>
					<td><span style="float:right;" id="costoSeguro">0</span></td>
				</tr>
				<tr>
					<td>Costo devolución de documentos</td>
					<td><span style="float:right;" id="costoDevol">0</span></td>
				</tr>
				<tr style="font-weight:bold;font-size:xx-large;">
					<td>Costo Total</td>
					<td><span style="float:right;" id="costoTotal">0</span><span style="float:right;">$</span></td>
				</tr>
			</tbody>
		</table>
	</div>
<div style="">
	<?php echo $this->Form->button("Guardar",array('type'=>'submit',"class"=>'btn btn-primary',"style"=>'float:right;margin-right: 30px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
</div>
<?php echo $this->Form->end();?>

<script>
	var User = function(data) {
		var self   = this;
		self.empaques    = data.empaques;
		self.descripcion = data.descripcion;
		self.cantidad    = data.cantidad;
		self.valKilo     = data.valKilo;
		self.pesoUni     = data.pesoUni;
		self.largo       = data.largo;
		self.ancho       = data.ancho;
		self.alto        = data.alto;
		self.peso        = data.peso;
		self.pesoVol     = data.pesoVol;
		self.valor       = data.valor;
		self.kiloAd      = data.kiloAd;
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
		viewModel.users.push(new User({empaques:"", descripcion:"", cantidad:"", valKilo:"", pesoUni:"", largo:"", ancho:"", alto:"", peso:"", pesoVol:"", valor:"", kiloAd:"" }));
	    $.each($(".empaques"), function( key, value ) {
	    	$(value).chosen({
				no_results_text           : 'No se encuentra el empaque.',
				width                     : "95%",
				allow_single_deselect     : true, 
				search_contains           : true,
				disable_search_threshold  : 0,
				placeholder_text_single   : "Seleccione el empaque"
			});
		});
		$(".valKilo").val(valKilo);
	};
	viewModel.removeUser = function(selected) {
	    viewModel.users.remove(selected);
		checkPrice();
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

	function checkPrice() {
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
		$("#costoFlete").text(costoFlete.formatMoney(0,',','.'));

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
		$("#descFlete").text((costoFlete*(descFlete/100)).formatMoney(0,',','.'));
		$("#descFleteVal").text(descFlete);

		sumaPeso = 0;
		$.each($(".peso"), function( key, value ) {
			sumaPeso = sumaPeso + parseFloat($(value).val());
		});
		$("#contPeso").text(sumaPeso);
		sumaPesoVol = 0;
		$.each($(".pesoVol"), function( key, value ) {
			sumaPesoVol = sumaPesoVol + parseFloat($(value).val());
		});
		$("#contPesoVol").text(sumaPesoVol);
		sumaKiloAd = 0;
		$.each($(".KiloAd2"), function( key, value ) {
			sumaKiloAd = sumaKiloAd + parseFloat($(value).val());
		});
		$("#contKiloAd").text(sumaKiloAd);
	}

	function calcularTotal(){
		checkPrice();
		costoAdic   = 0;
		sumaPeso    = 0;
		sumaPesoVol = 0;
		sumaKiloNego = 0;
		var mayor   = 0;
		$.each($(".largo"), function( key, value ) {
			var padreAct    = $(value).parent().parent().parent();
			var unidad      = parseFloat($(padreAct).find(".cantidad").val());
			var largoU      = parseFloat($(padreAct).find(".largo").val());
			var anchoU      = parseFloat($(padreAct).find(".ancho").val());
			var altoU       = parseFloat($(padreAct).find(".alto").val());
			var pesoU       = parseFloat($(padreAct).find(".peso").val());
			var pesoVolU    = parseFloat($(padreAct).find(".pesoVol").val());
			var kiloAdU     = parseFloat($(padreAct).find(".kiloAd2").val());
			var valKiloU    = parseFloat($(padreAct).find(".valKilo").val());
			valKilo         = valKiloU;
			var pesoVolCalU = (((largoU/100)*(anchoU/100)*(altoU/100))*400*unidad).toFixed(2);

			sumaPeso    = sumaPeso + pesoU;
			sumaPesoVol = sumaPesoVol + pesoVolU;
			sumaKiloNego = sumaKiloNego + kiloAdU;
		});
		if(sumaPeso > sumaPesoVol){
			mayor = sumaPeso;
		} else {
			mayor = sumaPesoVol;
		}

		descKilo           = 0;
		var existeDescKilo = false;
		pesoKiloAd         = mayor-sumaKiloNego;
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
		$("#descKilo").text((costoAdic*(descKilo/100)).formatMoney(0,',','.'));
		$("#descKiloVal").text(descKilo.formatMoney(0,',','.'));
		$("#costoAdic").text(costoAdic.formatMoney(0,',','.'));
		$("#costoAdicVal").text(pesoKiloAd.formatMoney(0,',','.'));

		$("#VentaKiloNego").val(sumaKiloNego.toFixed(0));
		$("#VentaKiloAdic").val(pesoKiloAd.toFixed(0));
		$("#VentaValorKiloAdic").val(costoAdic.toFixed(0));
		$("#VentaDescFlete").val((costoFlete*descFlete/100).toFixed(0));
		$("#VentaDescKilo").val((costoAdic*descKilo/100).toFixed(0));
		costoSeguro = parseFloat(costoSeguro);
		var costoDevol2 = 0;
		if(firmado == "Si"){
			costoDevol2  = parseFloat(costoDevol);
		}
		var op      = costoFlete+costoAdic+costoSeguro+costoDevol2-(costoFlete*descFlete/100)-(costoAdic*descKilo/100);
		$("#VentaValorTotal").val(op.toFixed(0));
		op = op.formatMoney(0,',','.');
		$("#costoTotal").text(op);
	}


		
	var costoSeguro   = 0;
	var declarado     = <?php echo floatval(str_replace(",", "",$this->data['Venta']['declarado'])); ?>;
	var firmado       = <?php echo '"'.$this->data['Venta']['firmado'].'"'; ?>;
//	var costoDevol    = <?php echo $costoDevol; ?>;
	var costoDevol    = 0;
	var cantidadCheck = <?php echo $cantidadCheck; ?>;

	var costoTotal = 0;
	var costoAdic = 0;
	var costoFlete = 0;
	var costoAdicVal = 0;
	var valKilo = 0;
	var ajaxCall   = <?php echo $data.";"; ?>
	var empaquesKO = <?php echo $empaque_info.";"; ?>
	var itsclicked = false;
	var cantidad   = 0;
	var contPeso = 0;
$(document).ready(function(){
//	viewModel.addUser();
/*
	$('#VentaGetReliquidarForm').bootstrapValidator({
		framework: 'bootstrap',
		excluded: ':disabled',
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'data[Venta][cantidad][]': {
				validators: {
					callback: {
						callback: function (value, validator, $field) {
							alert("entro");
							return true;
						}
					}
				}
			}
		}
	});
*/
	viewModel.loadUpdatedData(empaquesKO);
	$(".empaques").trigger("change");

	$.each($(".empaques"),function(key,value){
		var padreAux = $(this).parent().parent().parent();
		padreAux.find('.alto').val(empaquesKO[key].alto);
		padreAux.find('.ancho').val(empaquesKO[key].ancho);
		padreAux.find('.cantidad').val(empaquesKO[key].cantidad);

		cantidad = cantidad + parseFloat(empaquesKO[key].cantidad);

		padreAux.find('.descripcion').val(empaquesKO[key].descripcion);
		padreAux.find('.kiloAd').val(empaquesKO[key].kiloAd);
		padreAux.find('.kiloAd2').val(parseFloat(empaquesKO[key].kiloAd)*parseFloat(empaquesKO[key].cantidad));
		padreAux.find('.largo').val(empaquesKO[key].largo);
		padreAux.find('.peso').val(empaquesKO[key].peso);

		contPeso = contPeso + parseFloat(empaquesKO[key].peso);

		padreAux.find('.pesoUni').val(empaquesKO[key].peso/empaquesKO[key].cantidad);
		var pesoVolAux = (((empaquesKO[key].largo/100)*(empaquesKO[key].ancho/100)*(empaquesKO[key].alto/100))*400*empaquesKO[key].cantidad).toFixed(2);
		padreAux.find('.pesoVol').val(pesoVolAux);
		padreAux.find('.valor').val(empaquesKO[key].valor);
		padreAux.find('.empaques').val(empaquesKO[key].empaques);
		padreAux.find('.empaques').trigger("chosen:updated");
	});

	var existe = false;
	if(ajaxCall.Tarifa.length > 0){
		valKilo = parseFloat(ajaxCall.Tarifa[0].Tarifa.valor_adicional);
		$(".valKilo").val(valKilo);
		$("#kiloAdSpan").text(valKilo);
		var declaBd     = parseFloat(ajaxCall.Tarifa[0].Tarifa.declarado);
		var porcenDecla = parseFloat(ajaxCall.Tarifa[0].Tarifa.porcen_declarado);
		if(declarado > declaBd){
			seguro = (declarado-declaBd)*(porcenDecla/100);
			$("#costoSeguroVal").text(declaBd+"-"+porcenDecla+"%");
			$("#costoSeguro").text(seguro.formatMoney(0,',','.'));
			costoSeguro = parseFloat(seguro);
		} else {
			$("#costoSeguroVal").text(declaBd+"-"+porcenDecla+"%");
			$("#costoSeguro").text(0);
			costoSeguro = 0;
		}
		$.each(ajaxCall.Tarifa,function(key,value){
			$.each($(".empaques"),function(key2,empaqueDom){
				if(value.Tarifa.empaque_id == $(empaqueDom).val()){
					var padreAux = $(empaqueDom).parent().parent().parent();
					padreAux.find('.valor').val(parseFloat(value.Tarifa.tarifa));
					padreAux.find('.kiloAd').val(parseFloat(value.Tarifa.max_kilo));
					padreAux.find('.kiloAd2').val(parseFloat(value.Tarifa.max_kilo)*parseFloat(padreAux.find('.cantidad').val()));
				}
			});
			if(value.Tarifa.empaque_id == '4'){
				costoDevol = parseFloat(value.Tarifa.tarifa);
				if(firmado == "Si"){
					$("#devolSpan").text(costoDevol);
				}
			}
		});
		$('#VentaValorSeguro').val(costoSeguro);
		if(firmado == "Si"){
			$('#VentaValorDevolucion').val(costoDevol);
		} else {
			$('#VentaValorDevolucion').val(0);
		}
	} else if(ajaxCall.TarifaBase.length > 0){
		valKilo = parseFloat(ajaxCall.TarifaBase[0].Tarifa.valor_adicional);
		$(".valKilo").val(valKilo);
		$("#kiloAdSpan").text(valKilo);
		var declaBd     = parseFloat(ajaxCall.TarifaBase[0].Tarifa.declarado);
		var porcenDecla = parseFloat(ajaxCall.TarifaBase[0].Tarifa.porcen_declarado);
		if(declarado > declaBd){
			seguro = (declarado-declaBd)*(porcenDecla/100);
			$("#costoSeguroVal").text(declaBd+"-"+porcenDecla+"%");
			$("#costoSeguro").text(seguro.formatMoney(0,',','.'));
			costoSeguro = parseFloat(seguro);
		} else {
			$("#costoSeguroVal").text(declaBd+"-"+porcenDecla+"%");
			$("#costoSeguro").text(0);
			costoSeguro = 0;
		}
		$.each(ajaxCall.TarifaBase,function(key,value){
			$.each($(".empaques"),function(key2,empaqueDom){
				if(value.Tarifa.empaque_id == $(empaqueDom).val()){
					var padreAux = $(empaqueDom).parent().parent().parent();
					padreAux.find('.valor').val(parseFloat(value.Tarifa.tarifa));
					padreAux.find('.kiloAd').val(parseFloat(value.Tarifa.max_kilo));
					padreAux.find('.kiloAd2').val(parseFloat(value.Tarifa.max_kilo)*parseFloat(padreAux.find('.cantidad').val()));
				}
			});
			if(value.Tarifa.empaque_id == '4'){
				costoDevol = parseFloat(value.Tarifa.tarifa);
				if(firmado == "Si"){
					$("#devolSpan").text(costoDevol);
				}
			}
		});
		$('#VentaValorSeguro').val(costoSeguro);
		if(firmado == "Si"){
			$('#VentaValorDevolucion').val(costoDevol);
		} else {
			$('#VentaValorDevolucion').val(0);
		}
	} else {
		alert("Empaque sin tarifa, contactar al administrador.");
		location.reload(true);
	}

	$("#contCantidad").text(cantidad);
	$("#contPeso").text(contPeso);
	$("#costoSeguro").text(costoSeguro);
	if(firmado == "Si"){
		$('#costoDevol').val(costoDevol);
	} else {
		$('#costoDevol').val(0);
	}

	$(".cantidad").trigger("change");
	$(".largo").trigger("change");
	$(".peso").trigger("change");
	calcularTotal();

	$.each($(".empaques"), function( key, value ) {
    	$(value).chosen({
			no_results_text           : 'No se encuentra el empaque.',
			width                     : "95%",
			allow_single_deselect     : true, 
			search_contains           : true,
			disable_search_threshold  : 3,
			placeholder_text_single   : "Seleccione el empaque"
		});
	});

	$(document).on("keypress",".barras",function(e){
		if(e.which == 13) {
			$(this).val($(this).val()+",");
		}
	});

	$(document).on("change",".barras",function(e){
		var par = $(this).parent().parent().parent();
		var str = $(this).val();
		if(str != ""){
			var res = str.split(",");
			par.find(".cantidad").val(res.length);		
		} else {
			par.find(".cantidad").val(0);		
		}
		par.find(".cantidad").trigger('change');		
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
		sumaPesoVol = 0;
		$.each($(".pesoVol"), function( key, value ) {
			sumaPesoVol = sumaPesoVol + parseFloat($(value).val());
		});
		$("#contPesoVol").text(sumaPesoVol);
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
		sumaPesoVol = 0;
		$.each($(".pesoVol"), function( key, value ) {
			sumaPesoVol = sumaPesoVol + parseFloat($(value).val());
		});
		$("#contPesoVol").text(sumaPesoVol);
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
		sumaPesoVol = 0;
		$.each($(".pesoVol"), function( key, value ) {
			sumaPesoVol = sumaPesoVol + parseFloat($(value).val());
		});
		$("#contPesoVol").text(sumaPesoVol);
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
				$(padre).find(".kiloAd2").val(parseFloat(value.Tarifa.max_kilo).toFixed(0));
				$(padre).find(".valKilo").val(parseFloat(value.Tarifa.valor_adicional).toFixed(0));
				$(padre).find(".largo").val(parseFloat(value.Tarifa.largo).toFixed(0));
				$(padre).find(".ancho").val(parseFloat(value.Tarifa.ancho).toFixed(0));
				$(padre).find(".alto").val(parseFloat(value.Tarifa.alto).toFixed(0));
				$(padre).find(".pesoUni").val(parseFloat(value.Tarifa.peso).toFixed(0));
				var alto       = $(padre).find(".alto").val();
				var ancho      = $(padre).find(".ancho").val();
				var largo      = $(padre).find(".largo").val();
				var cantidad   = parseFloat($(padre).find(".cantidad").val());
				var pesoVolCal = (((largo/100)*(ancho/100)*(alto/100))*400*cantidad).toFixed(2);
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
					$(padre).find(".kiloAd2").val(parseFloat(value.Tarifa.max_kilo).toFixed(0));
					$(padre).find(".valKilo").val(parseFloat(value.Tarifa.valor_adicional).toFixed(0));
					$(padre).find(".largo").val(parseFloat(value.Tarifa.largo).toFixed(0));
					$(padre).find(".ancho").val(parseFloat(value.Tarifa.ancho).toFixed(0));
					$(padre).find(".alto").val(parseFloat(value.Tarifa.alto).toFixed(0));
					$(padre).find(".pesoUni").val(parseFloat(value.Tarifa.peso).toFixed(0));
					var alto       = $(padre).find(".alto").val();
					var ancho      = $(padre).find(".ancho").val();
					var largo      = $(padre).find(".largo").val();
					var cantidad   = parseFloat($(padre).find(".cantidad").val());
					var pesoVolCal = (((largo/100)*(ancho/100)*(alto/100))*400*cantidad).toFixed(2);
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
		$("#costoFlete").text(costoFlete.formatMoney(0,',','.'));

		sumaPeso = 0;
		$.each($(".peso"), function( key, value ) {
			sumaPeso = sumaPeso + parseFloat($(value).val());
		});
		$("#contPeso").text(sumaPeso);
		sumaPesoVol = 0;
		$.each($(".pesoVol"), function( key, value ) {
			sumaPesoVol = sumaPesoVol + parseFloat($(value).val());
		});
		$("#contPesoVol").text(sumaPesoVol);
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
		$("#descFlete").text((costoFlete*(descFlete/100)).formatMoney(0,',','.'));
		$("#descFleteVal").text(descFlete);

		calcularTotal();
	});
	$(document).on("change",".cantidad",function(){
		sumaCant = 0;
		$.each($(".cantidad"), function( key, value ) {
			sumaCant = sumaCant + parseInt($(value).val());
		});
		$("#contCantidad").text(sumaCant);

		var padre    = $(this).parent().parent().parent();
		var cantidad = parseFloat($(this).val());
		var valor    = parseFloat($(padre).find(".valor").val());

		var kiloAdCalcu = $(padre).find(".kiloAd").val();
		$(padre).find(".kiloAd2").val(kiloAdCalcu*cantidad);

		sumaKiloAd = 0;
		$.each($(".kiloAd2"), function( key, value ) {
			sumaKiloAd = sumaKiloAd + parseInt($(value).val());
		});
		$("#contKiloAd").text(sumaKiloAd);

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

		var pesoVolCal = (((largo/100)*(ancho/100)*(alto/100))*400*cantidad).toFixed(2);
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
			var pesoVolCalU = (((largoU/100)*(anchoU/100)*(altoU/100))*400*unidad).toFixed(2);
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
		$("#costoFlete").text(costoFlete.formatMoney(0,',','.'));


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
		$("#descFlete").text((costoFlete*(descFlete/100)).formatMoney(0,',','.'));
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
		$("#descKilo").text((costoFlete*(descKilo/100)).formatMoney(0,',','.'));
		$("#descKiloVal").text(descKilo.formatMoney(0,',','.'));
		sumaPesoVol = 0;
		$.each($(".pesoVol"), function( key, value ) {
			sumaPesoVol = sumaPesoVol + parseFloat($(value).val());
		});
		$("#contPesoVol").text(sumaPesoVol);
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
		sumaPesoVol = 0;
		$.each($(".pesoVol"), function( key, value ) {
			sumaPesoVol = sumaPesoVol + parseFloat($(value).val());
		});
		$("#contPesoVol").text(sumaPesoVol);
		calcularSubtotal();
		calcularTotal();
	});

});
</script>