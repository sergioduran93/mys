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
	<?php echo $this->Form->create('VentaContraentregaRepre',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3 class="h3-red"><center>VENTAS DE CONTRAENTREGA (REPRESENTANTE)</center></h3></div>
		<?php echo $this->Form->input('id',               array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('devolverFirmado',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('cliente',          array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('remitente',        array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('destinatario',     array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('kilo_adic',        array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('valor_kilo_adic',  array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('desc_flete',       array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('desc_kilo',        array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('valor_seguro',     array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('valor_devolucion', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('valor_total',      array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('kilo_nego',        array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
		<?php echo $this->Form->input('oficina',array('type'=>'hidden','default'=>'7')); ?>
	    <div class="form-group col-md-12">
			<div class="col-md-20"><?php echo $this->Form->input('remesa',array('label'=>'Remesa No.: ','type'=>'text','readonly'=>'readonly','default'=>$remesa)); ?></div>
			<div class="col-md-20"><?php echo $this->Form->input('documento1',array('label'=>'Documento Ref1.: ','type'=>'text')); ?></div>
			<div class="col-md-20"><?php echo $this->Form->input('tipo',array('label'=>'Tipo de Doc: ','type'=>'select','options'=>$tipo,'empty'=>'')); ?></div>
			<div class="col-md-20"><?php echo $this->Form->input('documento2',array('label'=>'Documento Ref2.: ','type'=>'text')); ?></div>
			<div class="col-md-20"><?php echo $this->Form->input('documento3',array('label'=>'Documento Ref3.: ','type'=>'text')); ?></div>
		</div>
		<div class="bs-callout bs-callout-warning" style="margin: 10px 0px 5px 30px;padding:2px;">
			<h4 style="float:left;">Cliente</h4><?php echo $this->Form->input('otro_remi',array('label'=>'Diferente remitente','type'=>'checkbox','style'=>'margin-left:20px;')); ?>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('documentoClien',array('label'=>'Documento: ','type'=>'text','placeholder'=>'Seleccione un cliente')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('nombreClien',array('label'=>'Nombre: ','type'=>'text','placeholder'=>'Seleccione un cliente')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('direccionClien',array('label'=>'Dirección: ','type'=>'text')); ?></div>
			</div>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('telefonoClien',array('label'=>'Teléfono:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('telefono2Clien',array('label'=>'Teléfono2:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('emailClien',array('label'=>'Email:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('faxClien',array('label'=>'Fax:','type'=>'text')); ?></div>
			</div>
		</div>
		<div id="div-remitente" class="bs-callout bs-callout-gray" style="margin: 10px 0px 5px 30px;padding:2px;">
			<h4>Remitente</h4>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('documentoRemi',array('label'=>'Documento: ','type'=>'text','placeholder'=>'Seleccione un remitente')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('nombreRemi',array('label'=>'Nombre: ','type'=>'text','placeholder'=>'Seleccione un remitente')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('direccionRemi',array('label'=>'Dirección: ','type'=>'text')); ?></div>
			</div>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('telefonoRemi',array('label'=>'Teléfono:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('celularRemi',array('label'=>'Celular:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('emailRemi',array('label'=>'Email:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('contacto',array('label'=>'Contacto:','type'=>'text','placeholder'=>'Seleccione el contacto')); ?></div>
			</div>
		</div>
		<div class="bs-callout bs-callout-green" style="margin: 10px 0px 5px 30px;padding:2px;">
			<div class="form-group col-md-12">
				<div class="col-md-6"><?php echo $this->Form->input('origen',array('label'=>'Ciudad Origen: ','class'=>'chosen-select','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('destino',array('label'=>'Ciudad Destino: ','class'=>'chosen-select','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
			</div>
		</div>
		<div class="bs-callout bs-callout-green" style="margin: 10px 0px 5px 30px;padding:2px;">
			<div class="form-group col-md-12">
				<div class="col-md-12"><?php echo $this->Form->input('recaudador',array('label'=>'Recaudador: ','class'=>'chosen-select','type'=>'select','options'=>null)); ?></div>
			</div>
		</div>
		<div class="bs-callout bs-callout-info" style="margin: 0px 0px 5px 30px;padding:2px;">
			<h4>Destinatario</h4>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('documentoDest',array('label'=>'Documento: ','type'=>'text','placeholder'=>'Seleccione un destinatario')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('nombreDest',array('label'=>'Nombre: ','type'=>'text','placeholder'=>'Seleccione un destinatario')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('direccionDest',array('label'=>'Dirección: ','type'=>'text')); ?></div>
			</div>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('telefonoDest',array('label'=>'Teléfono:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('telefono2Dest',array('label'=>'Teléfono2:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('emailDest',array('label'=>'Email:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('faxDest',array('label'=>'Fax:','type'=>'text')); ?></div>
			</div>
		</div>
		
		<div class="panel panel-info thumbnail" style="margin-bottom:0px;margin-left: 29px;" id="divDetalle">
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
		            <th style="text-align:center;">Peso Unitario</th>
		            <th style="text-align:center;">Largo</th>
		            <th style="text-align:center;">Ancho</th>
		            <th style="text-align:center;">Alto</th>
		            <th style="text-align:center;">Peso Total</th>
		            <th style="text-align:center;">Peso Volumen</th>
		            <th style="text-align:center;">Valor Unidad</th>
		            <th style="text-align:center;">Kilos Negociados</th>
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
		<div class="col-md-12" style="padding:0px;">
			<div class="col-md-6">
				<div class="col-md-12">
					<div class="col-md-6"><?php echo $this->Form->input('declarado',array('label'=>'Valor declarado:','type'=>'text')); ?></div>
					<div class="col-md-6"><?php echo $this->Form->input('firmado',array('label'=>'Devolver firmado:','type'=>'select','options'=>$firmado,'default'=>'No')); ?></div>
				</div>
				<div class="col-md-12" style="margin-top:52px;">
					<div class="col-md-12"><?php echo $this->Form->input('contenido',array('label'=>'Contenido:','type'=>'text','class'=>'eexpand50-200')); ?></div>
					<div class="col-md-12"><?php echo $this->Form->input('observaciones',array('label'=>'Observaciones:','type'=>'text','default'=>'NO')); ?></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-6"><?php echo $this->Form->input('checkRemitente',array('label'=>'Remitente','type'=>'checkbox')); ?></div>
					<div class="col-md-6"><?php echo $this->Form->input('checkArchivo',array('label'=>'Archivo','type'=>'checkbox')); ?></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-6"><?php echo $this->Form->input('checkDestinatario',array('label'=>'Destinatario','type'=>'checkbox')); ?></div>
					<div class="col-md-6"><?php echo $this->Form->input('checkPrueba',array('label'=>'Prueba de entrega','type'=>'checkbox')); ?></div>
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

		</div>
	<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>

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

		$("#VentaContraentregaRepreKiloNego").val(sumaKiloNego.toFixed(0));
		$("#VentaContraentregaRepreKiloAdic").val(pesoKiloAd.toFixed(0));
		$("#VentaContraentregaRepreValorKiloAdic").val(costoAdic.toFixed(0));
		$("#VentaContraentregaRepreValorSeguro").val(costoSeguro);
		$("#VentaContraentregaRepreValorDevolucion").val(costoDevol);
		$("#VentaContraentregaRepreDescFlete").val((costoFlete*descFlete/100).toFixed(0));
		$("#VentaContraentregaRepreDescKilo").val((costoAdic*descKilo/100).toFixed(0));
		costoSeguro = parseFloat(costoSeguro);
		costoDevol  = parseFloat(costoDevol);
		var op      = costoFlete+costoAdic+costoSeguro+costoDevol-(costoFlete*descFlete/100)-(costoAdic*descKilo/100);
		op = round100(op);
		$("#VentaContraentregaRepreValorTotal").val(op.toFixed(0));
		op = op.formatMoney(0,',','.');
		$("#costoTotal").text(op);
	}

	var ingresos               = <?php echo json_encode($ingresos); ?>;
	var clientes               = <?php echo json_encode($clientes); ?>;
	var destinatarios          = <?php echo json_encode($destinatarios); ?>;
	var destinatariosN         = <?php echo json_encode($destinatariosN); ?>;
	var remitentes             = <?php echo json_encode($remitentes); ?>;
	var empaques               = <?php echo json_encode($empaques); ?>;
	var fullpath               = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var clientesIdentificacion = new Array();
	var clientesNombre         = new Array();
	var remitentIdentificacion = new Array();
	var remitentNombre         = new Array();
	var destinatIdentificacion = new Array();
	var destinatNombre         = new Array();
	var contactosArray         = new Array();
	var clienteId              = 1;
	var destinatarioId         = 0;
	var remitenteId            = 0;
	var origenId               = 0;
	var destinoId              = 0;
	var ajaxCall;
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
	var arrayInfo;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(function() {
	$("#VentaContraentregaRepreDocumentoClien").autocomplete({
		source: clientesIdentificacion,
		select: function( event, ui ) {
			$.each( clientes, function( key, value ) {
				if(ui.item.value == value.Cliente.documento){
					if(value.Cliente.activo == "No"){
						$("#VentaContraentregaRepreDocumentoClien").val("");
						$("#VentaContraentregaRepreCliente").val("");
						$("#VentaContraentregaRepreNombreClien").val("");
						$("#VentaContraentregaRepreDireccionClien").val("");
						$("#VentaContraentregaRepreTelefonoClien").val("");
						$("#VentaContraentregaRepreTelefono2Clien").val("");
						$("#VentaContraentregaRepreEmailClien").val("");
						$("#VentaContraentregaRepreFaxClien").val("");
						alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
					} else if(value.Cliente.causal != "Activo"){
						$("#VentaContraentregaRepreDocumentoClien").val("");
						$("#VentaContraentregaRepreCliente").val("");
						$("#VentaContraentregaRepreNombreClien").val("");
						$("#VentaContraentregaRepreDireccionClien").val("");
						$("#VentaContraentregaRepreTelefonoClien").val("");
						$("#VentaContraentregaRepreTelefono2Clien").val("");
						$("#VentaContraentregaRepreEmailClien").val("");
						$("#VentaContraentregaRepreFaxClien").val("");
						alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
					} else {
						clienteId = value.Cliente.id;
						$("#VentaContraentregaRepreCliente").val(value.Cliente.id);
						$("#VentaContraentregaRepreNombreClien").val(value.Cliente.listNombre);
						$("#VentaContraentregaRepreDireccionClien").val(value.Cliente.direccion);
						$("#VentaContraentregaRepreTelefonoClien").val(value.Cliente.telefono);
						$("#VentaContraentregaRepreTelefono2Clien").val(value.Cliente.telefono2);
						$("#VentaContraentregaRepreEmailClien").val(value.Cliente.email);
						$("#VentaContraentregaRepreFaxClien").val(value.Cliente.fax);
						remitentIdentificacion = new Array();
						remitentNombre         = new Array();
						var i = 0;
						$.each( value.Cliente.remitentes, function( key, value ) {
							value                     = parseInt(value);
							remitentIdentificacion[i] = remitentes[value].Remitente.documento;
							remitentNombre[i]         = remitentes[value].Remitente.nombre;
							i                         = i + 1;
						});
						$("#VentaContraentregaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
						$("#VentaContraentregaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
					}
					$("#VentaContraentregaRepreDestino").val("");
					$("#VentaContraentregaRepreOrigen").val("");
					$("#VentaContraentregaRepreOrigen").trigger("chosen:updated");
					$("#VentaContraentregaRepreDestino").trigger("chosen:updated");
				}
			});
		}
	});
	$("#VentaContraentregaRepreNombreClien").autocomplete({
		source: clientesNombre,
		select: function( event, ui ) {
			$.each( clientes, function( key, value ) {
				if(ui.item.value == value.Cliente.listNombre){
					if(value.Cliente.activo == "No"){
						$("#VentaContraentregaRepreNombreClien").val("");
						$("#VentaContraentregaRepreCliente").val("");
						$("#VentaContraentregaRepreNombreClien").val("");
						$("#VentaContraentregaRepreDireccionClien").val("");
						$("#VentaContraentregaRepreTelefonoClien").val("");
						$("#VentaContraentregaRepreTelefono2Clien").val("");
						$("#VentaContraentregaRepreEmailClien").val("");
						$("#VentaContraentregaRepreFaxClien").val("");
						alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
					} else if(value.Cliente.causal != "Activo"){
						$("#VentaContraentregaRepreNombreClien").val("");
						$("#VentaContraentregaRepreCliente").val("");
						$("#VentaContraentregaRepreNombreClien").val("");
						$("#VentaContraentregaRepreDireccionClien").val("");
						$("#VentaContraentregaRepreTelefonoClien").val("");
						$("#VentaContraentregaRepreTelefono2Clien").val("");
						$("#VentaContraentregaRepreEmailClien").val("");
						$("#VentaContraentregaRepreFaxClien").val("");
						alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
					} else {
						clienteId = value.Cliente.id;
						$("#VentaContraentregaRepreCliente").val(value.Cliente.id);
						$("#VentaContraentregaRepreDocumentoClien").val(value.Cliente.documento);
						$("#VentaContraentregaRepreDireccionClien").val(value.Cliente.direccion);
						$("#VentaContraentregaRepreTelefonoClien").val(value.Cliente.telefono);
						$("#VentaContraentregaRepreTelefono2Clien").val(value.Cliente.telefono2);
						$("#VentaContraentregaRepreEmailClien").val(value.Cliente.email);
						$("#VentaContraentregaRepreFaxClien").val(value.Cliente.fax);
						remitentIdentificacion = new Array();
						remitentNombre         = new Array();
						var i = 0;
						$.each( value.Cliente.remitentes, function( key, value ) {
							value                     = parseInt(value);
							remitentIdentificacion[i] = remitentes[value].Remitente.documento;
							remitentNombre[i]         = remitentes[value].Remitente.nombre;
							i                         = i + 1;
						});
						$("#VentaContraentregaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
						$("#VentaContraentregaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
					}
					$("#VentaContraentregaRepreDestino").val("");
					$("#VentaContraentregaRepreOrigen").val("");
					$("#VentaContraentregaRepreOrigen").trigger("chosen:updated");
					$("#VentaContraentregaRepreDestino").trigger("chosen:updated");
				}
			});
		}
	});

	$("#VentaContraentregaRepreDocumentoRemi").autocomplete({
		source: remitentIdentificacion,
		select: function( event, ui ) {
			$.each( remitentes, function( key, value ) {
				if(ui.item.value == value.Remitente.documento){
					remitenteId = value.Remitente.id;
					$("#VentaContraentregaRepreRemitente").val(value.Remitente.id);
					$("#VentaContraentregaRepreNombreRemi").val(value.Remitente.nombre);
					$("#VentaContraentregaRepreDireccionRemi").val(value.Remitente.direccion);
					$("#VentaContraentregaRepreTelefonoRemi").val(value.Remitente.telefono);
					$("#VentaContraentregaRepreCelularRemi").val(value.Remitente.celular);
					$("#VentaContraentregaRepreEmailRemi").val(value.Remitente.email);
					var contactos = JSON.parse(value.Remitente.contacto);
					var contactosArray = new Array();
					$.each(contactos, function(key2, value2) {
						contactosArray[key2] = value2.nombre;
					});
					$("#VentaContraentregaRepreContacto").autocomplete('option', 'source', contactosArray);
				}
			});
		}
	});
	$("#VentaContraentregaRepreNombreRemi").autocomplete({
		source: remitentNombre,
		select: function( event, ui ) {
			$.each( remitentes, function( key, value ) {
				if(ui.item.value == value.Remitente.nombre){
					remitenteId = value.Remitente.id;
					$("#VentaContraentregaRepreRemitente").val(value.Remitente.id);
					$("#VentaContraentregaRepreDocumentoRemi").val(value.Remitente.documento);
					$("#VentaContraentregaRepreDireccionRemi").val(value.Remitente.direccion);
					$("#VentaContraentregaRepreTelefonoRemi").val(value.Remitente.telefono);
					$("#VentaContraentregaRepreCelularRemi").val(value.Remitente.celular);
					$("#VentaContraentregaRepreEmailRemi").val(value.Remitente.email);
					var contactos = JSON.parse(value.Remitente.contacto);
					var contactosArray = new Array();
					$.each(contactos, function(key2, value2) {
						contactosArray[key2] = value2.nombre;
					});
					$("#VentaContraentregaRepreContacto").autocomplete('option', 'source', contactosArray);
				}
			});
		}
	});

	$("#VentaContraentregaRepreDocumentoDest").autocomplete({
		source: destinatIdentificacion,
		select: function( event, ui ) {
			$.each( destinatarios, function( key, value ) {
				if(ui.item.value == value.Destinatario.documento){
					destinatarioId = value.Destinatario.id;
					$("#VentaContraentregaRepreDestinatario").val(value.Destinatario.id);
					$("#VentaContraentregaRepreNombreDest").val(value.Destinatario.listNombre);
					$("#VentaContraentregaRepreDireccionDest").val(value.Destinatario.direccion);
					$("#VentaContraentregaRepreTelefonoDest").val(value.Destinatario.telefono);
					$("#VentaContraentregaRepreTelefono2Dest").val(value.Destinatario.telefono2);
					$("#VentaContraentregaRepreEmailDest").val(value.Destinatario.email);
					$("#VentaContraentregaRepreFaxDest").val(value.Destinatario.fax);
				}
			});
		}
	});
	$("#VentaContraentregaRepreNombreDest").autocomplete({
		source: destinatNombre,
		select: function( event, ui ) {
			$.each( destinatarios, function( key, value ) {
				if(ui.item.value == value.Destinatario.listNombre){
					destinatarioId = value.Destinatario.id;
					$("#VentaContraentregaRepreDestinatario").val(value.Destinatario.id);
					$("#VentaContraentregaRepreDocumentoDest").val(value.Destinatario.documento);
					$("#VentaContraentregaRepreDireccionDest").val(value.Destinatario.direccion);
					$("#VentaContraentregaRepreTelefonoDest").val(value.Destinatario.telefono);
					$("#VentaContraentregaRepreTelefono2Dest").val(value.Destinatario.telefono2);
					$("#VentaContraentregaRepreEmailDest").val(value.Destinatario.email);
					$("#VentaContraentregaRepreFaxDest").val(value.Destinatario.fax);
				}
			});
		}
	});
	$("#VentaContraentregaRepreContacto").autocomplete({
		source: contactosArray
	});
});
	$("#div-remitente").hide();

$(document).ready(function(){

	$("#selbarra").keypress(function(e){
		if(e.which == 13) {
			var cl = ingresos[$(this).val()];
			$.each( clientes, function( key, value ) {
				if(value.Cliente.id == cl){
					$("#VentaContraentregaRepreDocumentoClien").val(clientesIdentificacion[key]);
					$("#VentaContraentregaRepreDocumentoClien").trigger("change");
					$("#VentaContraentregaRepreNombreClien").trigger("change");
					$("#VentaContraentregaRepreDireccionClien").trigger("change");
					$("#VentaContraentregaRepreTelefonoClien").trigger("change");
				}
			});
			$("#VentaContraentregaRepreDocumento1").focus();
			$("#VentaContraentregaRepreOrigen").val(ciudad);
			$("#VentaContraentregaRepreOrigen").trigger("chosen:updated");
		}
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



	$("#VentaContraentregaRepreRecaudador").chosen({
		no_results_text           : 'No se encuentra el recaudador.',
		width                     : "95%",
		allow_single_deselect     : true,
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el recaudador"
	});

	$.each( clientes, function( key, value ) {
		clientesIdentificacion[key] = value.Cliente.documento;
		clientesNombre[key]         = value.Cliente.listNombre;
	});

	viewModel.addUser();
	$("#VentaContraentregaRepreFecha").datepicker({minDate: 0});

	$("#VentaContraentregaRepreOtroRemi").change(function(){
		if($(this).is(':checked')){
			$("#div-remitente").show();
		} else {
			$("#div-remitente").hide();
		}
	});

	$("#btn-limpiar").click(function(){
		viewModel.users.removeAll();
		viewModel.addUser();
		$("#div-remitente").hide();
		$("#VentaContraentregaRepreDevolverFirmado").val(0);
		$("#VentaContraentregaRepreTipo").val(0);
		$("#kiloAdSpan").text("0");
		$("#VentaContraentregaRepreDeclarado").val("");
		$("#VentaContraentregaRepreFirmado").val("No");
		$("#VentaContraentregaRepreDestino").val("");
		$("#VentaContraentregaRepreOrigen").val("");
		$("#VentaContraentregaRepreDocumentoRemi").val("");
		$("#VentaContraentregaRepreTelefono").val("");
		$("#VentaContraentregaRepreTelefono").trigger("chosen:updated");
		$("#VentaContraentregaRepreOrigen").trigger("chosen:updated");
		$("#VentaContraentregaRepreDestino").trigger("chosen:updated");
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
	$("#VentaContraentregaRepreDeclarado").number( true, 0 );
*/
	$("#VentaContraentregaRepreDeclarado").keyup(function(){
		var strNum = $(this).val();
		var num    = parseFloat(strNum.replace(/,/g,""));
		num        = num.formatMoney(0,',','.');
		$(this).val(num);
	});

	$("#VentaContraentregaRepreDeclarado").blur(function(){
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

	$("#VentaContraentregaRepreFirmado").change(function(){
		if($(this).val() == "Si"){
			var existeDevol = false;
			$.each( ajaxCall.Tarifa, function( key, value ) {
				if(4 == value.Tarifa.empaque_id){
					existeDevol = true;
					costoDevol = parseFloat(value.Tarifa.tarifa).toFixed(0);
					$("#costoDevol").text(costoDevol);
					$("#VentaContraentregaRepreDevolverFirmado").val(costoDevol);
				}
			});
			if(!existeDevol){
				$.each( ajaxCall.TarifaBase, function( key, value ) {
					if(4 == value.Tarifa.empaque_id){
						existeDevol = true;
						costoDevol = parseFloat(value.Tarifa.tarifa).toFixed(0);
						$("#costoDevol").text(costoDevol);
						$("#VentaContraentregaRepreDevolverFirmado").val(costoDevol);
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
			$("#VentaContraentregaRepreDevolverFirmado").val(0);
		}
		calcularTotal();
	});

	$("#VentaContraentregaRepreOrigen").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el origen"
	});
	$("#VentaContraentregaRepreDestino").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el destino"
	});


	$("#VentaContraentregaRepreDocumentoClien").change(function(){
		var flag = true;
		var docuCli = $(this).val();
		$.each( clientes, function( key, value ) {
			if(docuCli == value.Cliente.documento){
				flag   = false;
				if(value.Cliente.activo == "No"){
					$("#VentaContraentregaRepreDocumentoClien").val("");
					$("#VentaContraentregaRepreCliente").val("");
					$("#VentaContraentregaRepreNombreClien").val("");
					$("#VentaContraentregaRepreDireccionClien").val("");
					$("#VentaContraentregaRepreTelefonoClien").val("");
					$("#VentaContraentregaRepreTelefono2Clien").val("");
					$("#VentaContraentregaRepreEmailClien").val("");
					$("#VentaContraentregaRepreFaxClien").val("");
					alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
				} else if(value.Cliente.causal != "Activo"){
					$("#VentaContraentregaRepreDocumentoClien").val("");
					$("#VentaContraentregaRepreCliente").val("");
					$("#VentaContraentregaRepreNombreClien").val("");
					$("#VentaContraentregaRepreDireccionClien").val("");
					$("#VentaContraentregaRepreTelefonoClien").val("");
					$("#VentaContraentregaRepreTelefono2Clien").val("");
					$("#VentaContraentregaRepreEmailClien").val("");
					$("#VentaContraentregaRepreFaxClien").val("");
					alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
				} else {
					clienteId = value.Cliente.id;
					$("#VentaContraentregaRepreCliente").val(value.Cliente.id);
					$("#VentaContraentregaRepreNombreClien").val(value.Cliente.listNombre);
					$("#VentaContraentregaRepreDireccionClien").val(value.Cliente.direccion);
					$("#VentaContraentregaRepreTelefonoClien").val(value.Cliente.telefono);
					$("#VentaContraentregaRepreTelefono2Clien").val(value.Cliente.telefono2);
					$("#VentaContraentregaRepreEmailClien").val(value.Cliente.email);
					$("#VentaContraentregaRepreFaxClien").val(value.Cliente.fax);
					remitentIdentificacion = new Array();
					remitentNombre         = new Array();
					var i = 0;
					$.each( value.Cliente.remitentes, function( key, value ) {
						value                     = parseInt(value);
						remitentIdentificacion[i] = remitentes[value].Remitente.documento;
						remitentNombre[i]         = remitentes[value].Remitente.nombre;
						i                         = i + 1;
					});
					$("#VentaContraentregaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
					$("#VentaContraentregaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
				}
				$("#VentaContraentregaRepreDestino").val("");
				$("#VentaContraentregaRepreOrigen").val("");
				$("#VentaContraentregaRepreOrigen").trigger("chosen:updated");
				$("#VentaContraentregaRepreDestino").trigger("chosen:updated");
			}
		});
		if(flag){
			if(confirm("El cliente NO existe, ¿Desea registrarlo?")){
				var docAct  = $("#VentaContraentregaRepreDocumentoClien").val();
				var nomAct  = $("#VentaContraentregaRepreNombreClien").val();
				var nomAct2 = "";
				if(docAct == ""){
					docAct = "*";
				}
				if(nomAct != ""){
					nomAct2 = nomAct.replace(" ", "%20");
					nomAct2 = "/"+nomAct2;
				}
				$.fancybox.open({
					href : fullpath+"clientes/crear2/"+docAct+nomAct2,
					type : 'iframe',
					padding : 5,
					width : "90%",
					height: "90%",
					//maxHeight : 200,
					//autoScale : true,
					scrolling : 'auto',
					scrollOutside   : false,
					beforeClose: function(){
						var retorno   = $('.fancybox-iframe').contents().find('#ClienteInfo').val();
						arrayInfo = JSON.parse(retorno);
						$("#VentaContraentregaRepreDocumentoClien").val(arrayInfo[0]);
						$("#VentaContraentregaRepreNombreClien").val(arrayInfo[1]);
						$("#VentaContraentregaRepreDireccionClien").val(arrayInfo[2]);
						$("#VentaContraentregaRepreTelefonoClien").val(arrayInfo[3]);
						$("#VentaContraentregaRepreTelefono2Clien").val(arrayInfo[4]);
						$("#VentaContraentregaRepreEmailClien").val(arrayInfo[5]);
						$("#VentaContraentregaRepreFaxClien").val(arrayInfo[6]);
						remitentIdentificacion = new Array();
						remitentNombre         = new Array();
						if(arrayInfo[7] != null){
							var i = 0;
							$.each( arrayInfo[7] , function( key, value ) {
								value                     = parseInt(value);
								remitentIdentificacion[i] = remitentes[value].Remitente.documento;
								remitentNombre[i]         = remitentes[value].Remitente.nombre;
								i                         = i + 1;
							});
						}
						$("#VentaContraentregaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
						$("#VentaContraentregaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
					}
				});
			}
		}
	});
	$("#VentaContraentregaRepreNombreClien").change(function(){
		var flag = true;
		var docuCli = $(this).val();
		$.each( clientes, function( key, value ) {
			if(docuCli == value.Cliente.listNombre){
				clienteId = value.Cliente.id;
				flag      = false;
			}
		});
		if(flag){
			if(confirm("El cliente NO existe, ¿Desea registrarlo?")){
				var docAct  = $("#VentaContraentregaRepreDocumentoClien").val();
				var nomAct  = $("#VentaContraentregaRepreNombreClien").val();
				var nomAct2 = "";
				if(docAct == ""){
					docAct = "*";
				}
				if(nomAct != ""){
					nomAct2 = nomAct.replace(" ", "%20");
					nomAct2 = "/"+nomAct2;
				}
				$.fancybox.open({
					href : fullpath+"clientes/crear2/"+docAct+nomAct2,
					type : 'iframe',
					padding : 5,
					width : "90%",
					height: "90%",
					//maxHeight : 200,
					//autoScale : true,
					scrolling : 'auto',
					scrollOutside   : false,
					beforeClose: function(){
						var retorno   = $('.fancybox-iframe').contents().find('#ClienteInfo').val();
						arrayInfo = JSON.parse(retorno);
						$("#VentaContraentregaRepreDocumentoClien").val(arrayInfo[0]);
						$("#VentaContraentregaRepreNombreClien").val(arrayInfo[1]);
						$("#VentaContraentregaRepreDireccionClien").val(arrayInfo[2]);
						$("#VentaContraentregaRepreTelefonoClien").val(arrayInfo[3]);
						$("#VentaContraentregaRepreTelefono2Clien").val(arrayInfo[4]);
						$("#VentaContraentregaRepreEmailClien").val(arrayInfo[5]);
						$("#VentaContraentregaRepreFaxClien").val(arrayInfo[6]);
						remitentIdentificacion = new Array();
						remitentNombre         = new Array();
						if(arrayInfo[7] != null){
							var i = 0;
							$.each( arrayInfo[7] , function( key, value ) {
								value                     = parseInt(value);
								remitentIdentificacion[i] = remitentes[value].Remitente.documento;
								remitentNombre[i]         = remitentes[value].Remitente.nombre;
								i                         = i + 1;
							});
						}
						$("#VentaContraentregaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
						$("#VentaContraentregaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
					}
				});
			}
		}
	});
	$("#VentaContraentregaRepreNombreDest").change(function(){
		var flag = true;
		var docuDest = $(this).val();
		$.each( destinatarios, function( key, value ) {
			if(docuDest == value.Destinatario.listNombre){
				$("#VentaContraentregaRepreDestinatario").val(value.Destinatario.id);
				destinatarioId = value.Destinatario.id;
				flag           = false;
			}
		});
		if(flag){
			if(confirm("El destinatario NO existe, ¿Desea registrarlo?")){
				var docAct  = $("#VentaContraentregaRepreDocumentoDest").val();
				var nomAct  = $("#VentaContraentregaRepreNombreDest").val();
				var nomAct2 = "";
				if(docAct == ""){
					docAct = "/*";
				} else {
					docAct = "/"+docAct;
				}
				if(nomAct != ""){
					nomAct2 = nomAct.replace(" ", "%20");
					nomAct2 = "/"+nomAct2;
				}
				$.fancybox.open({
					href : fullpath+"destinatarios/crear2/"+destinoId+docAct+nomAct2,
					type : 'iframe',
					padding : 5,
					width : "90%",
					height: "90%",
					//maxHeight : 200,
					//autoScale : true,
					scrolling : 'auto',
					scrollOutside   : false,
					beforeClose: function(){
						var retorno   = $('.fancybox-iframe').contents().find('#DestinatarioInfo').val();
						arrayInfo = JSON.parse(retorno);
						$("#VentaContraentregaRepreDocumentoDest").val(arrayInfo[0]);
						$("#VentaContraentregaRepreNombreDest").val(arrayInfo[1]);
						$("#VentaContraentregaRepreDireccionDest").val(arrayInfo[2]);
						$("#VentaContraentregaRepreTelefonoDest").val(arrayInfo[3]);
						$("#VentaContraentregaRepreTelefono2Dest").val(arrayInfo[4]);
						$("#VentaContraentregaRepreEmailDest").val(arrayInfo[5]);
						$("#VentaContraentregaRepreFaxDest").val(arrayInfo[6]);
					}
				});
			}
		}
	});
	$("#VentaContraentregaRepreDocumentoDest").change(function(){
		var flag = true;
		var docuDest = $(this).val();
		$.each( destinatarios, function( key, value ) {
			if(docuDest == value.Destinatario.documento){
				destinatarioId = value.Destinatario.id;
				flag           = false;
			}
		});
		if(flag){
			if(confirm("El destinatario NO existe, ¿Desea registrarlo?")){
				var docAct  = $("#VentaContraentregaRepreDocumentoDest").val();
				var nomAct  = $("#VentaContraentregaRepreNombreDest").val();
				var nomAct2 = "";
				if(docAct == ""){
					docAct = "/*";
				} else {
					docAct = "/"+docAct;
				}
				if(nomAct != ""){
					nomAct2 = nomAct.replace(" ", "%20");
					nomAct2 = "/"+nomAct2;
				}
				$.fancybox.open({
					href : fullpath+"destinatarios/crear2/"+destinoId+docAct+nomAct2,
					type : 'iframe',
					padding : 5,
					width : "90%",
					height: "90%",
					//maxHeight : 200,
					//autoScale : true,
					scrolling : 'auto',
					scrollOutside   : false,
					beforeClose: function(){
						var retorno   = $('.fancybox-iframe').contents().find('#DestinatarioInfo').val();
						arrayInfo = JSON.parse(retorno);
						$("#VentaContraentregaRepreDocumentoDest").val(arrayInfo[0]);
						$("#VentaContraentregaRepreNombreDest").val(arrayInfo[1]);
						$("#VentaContraentregaRepreDireccionDest").val(arrayInfo[2]);
						$("#VentaContraentregaRepreTelefonoDest").val(arrayInfo[3]);
						$("#VentaContraentregaRepreTelefono2Dest").val(arrayInfo[4]);
						$("#VentaContraentregaRepreEmailDest").val(arrayInfo[5]);
						$("#VentaContraentregaRepreFaxDest").val(arrayInfo[6]);
					}
				});
			}
		}
	});
	/*
	$('#VentaContraentregaRepreDocumentoClien').JCombo({
		'parentId': 'VentaContraentregaRepreDocumentoClien',
		'nodeId'  : 'VentaContraentregaRepreDocumentoRemi',
		'data'    : selectDep
	});*/
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

	$("#VentaContraentregaRepreOrigen").change(function(){
		$("#VentaContraentregaRepreDestino").val("");
		$("#VentaContraentregaRepreDestino").trigger("chosen:updated");
	});
	$("#VentaContraentregaRepreDestino").change(function(){
		if($("#VentaContraentregaRepreOrigen").val() == ""){
			alert("Seleccione una ciudad de origen primero.");
			$("#VentaContraentregaRepreDestino").val("");
			$("#VentaContraentregaRepreDestino").trigger("chosen:updated");
		} else {
			if($(this).val() != ""){
				var ind                = parseInt($(this).val());
				destinatIdentificacion = new Array();
				destinatNombre         = new Array();
				var ind2               = 0;
				if(destinatariosN[ind] != undefined) {
					$.each( destinatariosN[ind], function( key, value ) {
						$.each( destinatarios, function( key2, value2 ) {
							if(value == value2.Destinatario.id){
								destinatIdentificacion[ind2] = value2.Destinatario.documento;
								destinatNombre[ind2]         = value2.Destinatario.listNombre;
								ind2                         = ind2 + 1;
							}
						});
					});
				}
				$("#VentaContraentregaRepreDocumentoDest").autocomplete('option', 'source', destinatIdentificacion);
				$("#VentaContraentregaRepreNombreDest").autocomplete('option', 'source', destinatNombre);
				$("#kiloAdSpan").val("");
				$("#VentaContraentregaRepreDestinatario").val("");
				$("#VentaContraentregaRepreNombreDest").val("");
				$("#VentaContraentregaRepreDocumentoDest").val("");
				$("#VentaContraentregaRepreDireccionDest").val("");
				$("#VentaContraentregaRepreTelefonoDest").val("");
				$("#VentaContraentregaRepreTelefono2Dest").val("");
				$("#VentaContraentregaRepreEmailDest").val("");
				$("#VentaContraentregaRepreFaxDest").val("");
				origenId  = $("#VentaContraentregaRepreOrigen").val();
				destinoId = $("#VentaContraentregaRepreDestino").val();
				$("#VentaContraentregaRepreDeclarado").val("");
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
				$("#VentaContraentregaRepreFirmado").val("No");
				calcularTotal();
				var clienteDocumActual = $("#VentaContraentregaRepreDocumentoClien").val();
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
					url: fullpath+"VentaContraentregaRepre/getTarifa/"+clienteId+"/"+origenId+"/"+destinoId,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					},
					success: function(response) {
						response = JSON.parse(response);
						ajaxCall = response;
						$("#VentaContraentregaRepreRecaudador").empty();
						$.each(ajaxCall.Representante, function(key, value) {
							$("#VentaContraentregaRepreRecaudador").append($("<option></option>").attr("value", key).text(value));
						});
						$("#VentaContraentregaRepreRecaudador").trigger("chosen:updated");
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