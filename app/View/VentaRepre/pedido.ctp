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
	<?php echo $this->Form->create('VentaRepre',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>VENTAS POR PEDIDO (REPRESENTANTE)</center></h3></div>
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
		<?php echo $this->Form->input('contacto_tel',     array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
		<?php echo $this->Form->input('oficina',array('type'=>'hidden','default'=>$usuario_actual['Oficina']['id'])); ?>
	    <div class="form-group col-md-12">
			<div class="col-md-20"><?php echo $this->Form->input('remesa',array('label'=>'Remesa No.: ','type'=>'text','readonly'=>'readonly','default'=>$remesa)); ?></div>
			<div class="col-md-20"><?php echo $this->Form->input('documento1',array('label'=>'Documento Ref1.: ','type'=>'text')); ?></div>
			<div class="col-md-20"><?php echo $this->Form->input('tipo',array('label'=>'Tipo de Doc: : ','type'=>'text')); ?></div>
			<div class="col-md-20"><?php echo $this->Form->input('documento2',array('label'=>'Documento Ref2.: ','type'=>'text')); ?></div>
			<div class="col-md-20"><?php echo $this->Form->input('documento3',array('label'=>'Documento Ref3.: ','type'=>'text')); ?></div>
		</div>
		<div class="bs-callout bs-callout-warning" style="margin: 10px 0px 5px 30px;padding:2px;">
			<h4 style="float:left;">Cliente</h4><?php echo $this->Form->input('otro_remi',array('label'=>'Diferente remitente','type'=>'checkbox','style'=>'margin-left:20px;')); ?>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('documentoClien',array('label'=>'Documento: ','type'=>'text','placeholder'=>'Seleccione un cliente','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('nombreClien',array('label'=>'Nombre: ','type'=>'text','placeholder'=>'Seleccione un cliente','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('direccionClien',array('label'=>'Dirección: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
			</div>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('telefonoClien',array('label'=>'Teléfono:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('telefono2Clien',array('label'=>'Teléfono2:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('emailClien',array('label'=>'Email:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('faxClien',array('label'=>'Fax:','type'=>'text')); ?></div>
			</div>
		</div>
		<div id="div-remitente" class="bs-callout bs-callout-gray" style="margin: 10px 0px 5px 30px;padding:2px;">
			<h4>Remitente</h4>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('documentoRemi',array('label'=>'Documento: ','type'=>'text','placeholder'=>'Seleccione un remitente','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('nombreRemi',array('label'=>'Nombre: ','type'=>'text','placeholder'=>'Seleccione un remitente','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('direccionRemi',array('label'=>'Dirección: ','type'=>'text')); ?></div>
			</div>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('telefonoRemi',array('label'=>'Teléfono:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
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
			<div class="col-md-12 form-group">
				<div class="col-md-12"><?php echo $this->Form->input('recaudador',array('label'=>'Recaudador: ','type'=>'select','options'=>null)); ?></div>
			</div>
		</div>
		<div class="bs-callout bs-callout-info" style="margin: 0px 0px 5px 30px;padding:2px;">
			<h4>Destinatario</h4>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('documentoDest',array('label'=>'Documento: ','type'=>'text','placeholder'=>'Seleccione un destinatario')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('nombreDest',array('label'=>'Nombre: ','type'=>'text','placeholder'=>'Seleccione un destinatario','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('direccionDest',array('label'=>'Dirección: ','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
			</div>
		    <div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('telefonoDest',array('label'=>'Teléfono:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
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
							<?php echo $this->Form->input('empaques.',array('class'=>'empaques','label'=>false,'type'=>'select','options'=>$empaques,'empty'=>'','data-bind'=>'value: empaques')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('descripcion.',array('class'=>'descripcion','label'=>false,'type'=>'text','data-bind'=>'value: descripcion')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('cantidad.',array('class'=>"cantidad form-control",'label'=>false,'type'=>'text','style'=>'text-align: left;','data-bv-notempty'=>'true','data-bind'=>'value: cantidad','data-bv-trigger'=>'val focus change')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('valKilo.',array('class'=>'valKilo hidden','label'=>false,'type'=>'text','readonly'=>'readonly','data-bind'=>'value: valKilo')); ?>
							<?php echo $this->Form->input('pesoUni.',array('class'=>'pesoUni','label'=>false,'type'=>'text','data-bind'=>'value: pesoUni')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('largo.',array('class'=>"largo form-control",'label'=>false,'type'=>'text','data-bind'=>'value: largo')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('ancho.',array('class'=>"ancho form-control",'label'=>false,'type'=>'text','data-bind'=>'value: ancho')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('alto.',array('class'=>"alto form-control",'label'=>false,'type'=>'text','data-bind'=>'value: alto')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('peso.',array('class'=>"peso form-control",'label'=>false,'type'=>'text','data-bind'=>'value: peso')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('pesoVol.',array('class'=>"pesoVol",'label'=>false,'type'=>'text','readonly'=>'readonly','data-bind'=>'value: pesoVol')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('valor.',array('class'=>'valor','label'=>false,'type'=>'text','readonly'=>'readonly','data-bind'=>'value: valor')); ?>
						</td>
						<td class="col-md-1" style="padding:0px;">
							<?php echo $this->Form->input('kiloAd2.',array('class'=>'kiloAd2','label'=>false,'type'=>'text','readonly'=>'readonly','data-bind'=>'value: kiloAd')); ?>
							<?php echo $this->Form->input('kiloAd.',array('class'=>'kiloAd','label'=>false,'type'=>'hidden')); ?>
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
				<div class="form-group col-md-12">
					<div class="col-md-6"><?php echo $this->Form->input('declarado',array('label'=>'Valor declarado:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
					<div class="col-md-6"><?php echo $this->Form->input('firmado',array('label'=>'Devolver firmado:','type'=>'select','options'=>$firmado,'default'=>'No')); ?></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-12"><?php echo $this->Form->input('contenido',array('label'=>'Contenido:','type'=>'text','class'=>'form-control','data-bv-notempty'=>'true','data-bv-trigger'=>'val focus change')); ?></div>
					<div class="col-md-12"><?php echo $this->Form->input('observaciones',array('label'=>'Observaciones:','type'=>'text','default'=>'NO')); ?></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-12"><?php echo $this->Form->input('barras',array('label'=>'Codigo de Barras:','type'=>'text')); ?></div>
				</div>
				<div class="col-md-12">
					<div class="col-md-6"><?php echo $this->Form->input('checkRemitente',array('label'=>'Remitente','type'=>'checkbox','checked'=>'checked')); ?></div>
					<div class="col-md-6"><?php echo $this->Form->input('checkArchivo',array('label'=>'Archivo','type'=>'checkbox','checked'=>'checked')); ?></div>
				</div>
				<div class="col-md-12">
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
		<hr class='clearing'/>
		<div class="bs-callout bs-callout-info" style="margin: 0px 0px 5px 30px;padding:2px;">
			<h4>Confirmación</h4>
			<div class="form-group col-md-12">
				<div class="col-md-4"><?php echo $this->Form->input('recibio',array('label'=>'Recibio: ','type'=>'text')); ?></div>
				<div class="col-md-4"><?php echo $this->Form->input('cedula_recibio',array('label'=>'CC: ','type'=>'text')); ?></div>
				<div class="col-md-4"><?php echo $this->Form->input('cargo_recibido',array('label'=>'Parentezco/Cargo: ','type'=>'text')); ?></div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-4"><?php echo $this->Form->input('fecha_recibio',array('label'=>'Fecha: ','type'=>'text','placeholder'=>'AAAA-MM-DD')); ?></div>
				<div class="col-md-4"><?php echo $this->Form->input('telefono_recibido',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
				<div class="col-md-4"><?php echo $this->Form->input('observaciones_recibio',array('label'=>'Observaciones: ','type'=>'text')); ?></div>
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
				disable_search_threshold  : 3,
				placeholder_text_single   : "Seleccione el empaque"
			});
			$(value).val(6);
			$(value).trigger("chosen:updated");
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
			var pesoVolCalU = ((largoU/100)*(anchoU/100)*(altoU/100))*400*unidad;

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

		$("#VentaRepreKiloNego").val(sumaKiloNego.toFixed(0));
		$("#VentaRepreKiloAdic").val(pesoKiloAd.toFixed(0));
		$("#VentaRepreValorKiloAdic").val(costoAdic.toFixed(0));
		$("#VentaRepreValorSeguro").val(costoSeguro);
		$("#VentaRepreValorDevolucion").val(costoDevol);
		$("#VentaRepreDescFlete").val((costoFlete*descFlete/100).toFixed(0));
		$("#VentaRepreDescKilo").val((costoAdic*descKilo/100).toFixed(0));
		costoSeguro = parseFloat(costoSeguro);
		costoDevol  = parseFloat(costoDevol);
		var op      = costoFlete+costoAdic+costoSeguro+costoDevol-(costoFlete*descFlete/100)-(costoAdic*descKilo/100);
		op = round100(op);
		$("#VentaRepreValorTotal").val(op.toFixed(0));
		op = op.formatMoney(0,',','.');
		$("#costoTotal").text(op);
	}

	var clientes               = <?php echo json_encode($clientes); ?>;
	var tipo                   = <?php echo json_encode($tipo); ?>;
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
	var contactosArrayTel      = new Array();
	var tipoGuia               = new Array();
	var clienteId              = 1;
	var destinatarioId         = 0;
	var remitenteId            = 0;
	var origenId               = 0;
	var destinoId              = 0;
	var ajaxCall;
	var sumaCant               = 0;
	var sumaKiloAd             = 0;
	var sumaPeso               = 0;
	var sumaPesoVol            = 0;
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

	$("#VentaRepreTipo").autocomplete({
		source: tipoGuia,
		select: function( event, ui ) {
			/*$.each( clientes, function( key, value ) {
				if(ui.item.value == value.Cliente.documento){
				}
			});*/
		}
	});
	$("#VentaRepreDocumentoClien").autocomplete({
		source: clientesIdentificacion,
		select: function( event, ui ) {
			$.each( clientes, function( key, value ) {
				if(ui.item.value == value.Cliente.documento){
					if(value.Cliente.activo == "No"){
						$("#VentaRepreDocumentoClien").val("");
						$("#VentaRepreCliente").val("");
						$("#VentaRepreNombreClien").val("");
						$("#VentaRepreDireccionClien").val("");
						$("#VentaRepreTelefonoClien").val("");
						$("#VentaRepreTelefono2Clien").val("");
						$("#VentaRepreEmailClien").val("");
						$("#VentaRepreFaxClien").val("");
						alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
					} else if(value.Cliente.causal != "Activo"){
						$("#VentaRepreDocumentoClien").val("");
						$("#VentaRepreCliente").val("");
						$("#VentaRepreNombreClien").val("");
						$("#VentaRepreDireccionClien").val("");
						$("#VentaRepreTelefonoClien").val("");
						$("#VentaRepreTelefono2Clien").val("");
						$("#VentaRepreEmailClien").val("");
						$("#VentaRepreFaxClien").val("");
						alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
					} else {
						clienteId = value.Cliente.id;
						$("#VentaRepreCliente").val(value.Cliente.id);
						$("#VentaRepreNombreClien").val(value.Cliente.listNombre);
						$("#VentaRepreDireccionClien").val(value.Cliente.direccion);
						$("#VentaRepreTelefonoClien").val(value.Cliente.telefono);
						$("#VentaRepreTelefono2Clien").val(value.Cliente.telefono2);
						$("#VentaRepreEmailClien").val(value.Cliente.email);
						$("#VentaRepreFaxClien").val(value.Cliente.fax);
						remitentIdentificacion = new Array();
						remitentNombre         = new Array();
						var i = 0;
						$.each( value.Cliente.remitentes, function( key, value ) {
							value                     = parseInt(value);
							remitentIdentificacion[i] = remitentes[value].Remitente.documento;
							remitentNombre[i]         = remitentes[value].Remitente.nombre;
							i                         = i + 1;
						});
						$("#VentaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
						$("#VentaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
					}
					$("#VentaRepreDestino").val("");
					$("#VentaRepreDestino").trigger("chosen:updated");
				}
			});
			$("#VentaRepreNombreClien").trigger('val');
			$("#VentaRepreDocumentoClien").trigger('val');
			$("#VentaRepreDireccionClien").trigger('val');
			$("#VentaRepreTelefonoClien").trigger('val');
		}
	});
	$("#VentaRepreNombreClien").autocomplete({
		source: clientesNombre,
		select: function( event, ui ) {
			$.each( clientes, function( key, value ) {
				if(ui.item.value == value.Cliente.listNombre){
					if(value.Cliente.activo == "No"){
						$("#VentaRepreNombreClien").val("");
						$("#VentaRepreCliente").val("");
						$("#VentaRepreNombreClien").val("");
						$("#VentaRepreDireccionClien").val("");
						$("#VentaRepreTelefonoClien").val("");
						$("#VentaRepreTelefono2Clien").val("");
						$("#VentaRepreEmailClien").val("");
						$("#VentaRepreFaxClien").val("");
						alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
					} else if(value.Cliente.causal != "Activo"){
						$("#VentaRepreNombreClien").val("");
						$("#VentaRepreCliente").val("");
						$("#VentaRepreNombreClien").val("");
						$("#VentaRepreDireccionClien").val("");
						$("#VentaRepreTelefonoClien").val("");
						$("#VentaRepreTelefono2Clien").val("");
						$("#VentaRepreEmailClien").val("");
						$("#VentaRepreFaxClien").val("");
						alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
					} else {
						clienteId = value.Cliente.id;
						$("#VentaRepreCliente").val(value.Cliente.id);
						$("#VentaRepreDocumentoClien").val(value.Cliente.documento);
						$("#VentaRepreDireccionClien").val(value.Cliente.direccion);
						$("#VentaRepreTelefonoClien").val(value.Cliente.telefono);
						$("#VentaRepreTelefono2Clien").val(value.Cliente.telefono2);
						$("#VentaRepreEmailClien").val(value.Cliente.email);
						$("#VentaRepreFaxClien").val(value.Cliente.fax);
						remitentIdentificacion = new Array();
						remitentNombre         = new Array();
						var i = 0;
						$.each( value.Cliente.remitentes, function( key, value ) {
							value                     = parseInt(value);
							remitentIdentificacion[i] = remitentes[value].Remitente.documento;
							remitentNombre[i]         = remitentes[value].Remitente.nombre;
							i                         = i + 1;
						});
						$("#VentaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
						$("#VentaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
					}
					$("#VentaRepreDestino").val("");
					$("#VentaRepreDestino").trigger("chosen:updated");
				}
			});
			$("#VentaRepreNombreClien").trigger('val');
			$("#VentaRepreDocumentoClien").trigger('val');
			$("#VentaRepreDireccionClien").trigger('val');
			$("#VentaRepreTelefonoClien").trigger('val');
		}
	});

	$("#VentaRepreDocumentoRemi").autocomplete({
		source: remitentIdentificacion,
		select: function( event, ui ) {
			$.each( remitentes, function( key, value ) {
				if(ui.item.value == value.Remitente.documento){
					remitenteId = value.Remitente.id;
					$("#VentaRepreRemitente").val(value.Remitente.id);
					$("#VentaRepreNombreRemi").val(value.Remitente.nombre);
					$("#VentaRepreDireccionRemi").val(value.Remitente.direccion);
					$("#VentaRepreTelefonoRemi").val(value.Remitente.telefono);
					$("#VentaRepreCelularRemi").val(value.Remitente.celular);
					$("#VentaRepreEmailRemi").val(value.Remitente.email);
					var contactos = JSON.parse(value.Remitente.contacto);
					contactosArray    = new Array();
					contactosArrayTel = new Array();
					$.each(contactos, function(key2, value2) {
						contactosArray[key2]    = value2.nombre;
						contactosArrayTel[key2] = value2.telefono;
					});
					$("#VentaRepreContacto").autocomplete('option', 'source', contactosArray);
				}
			});
		}
	});
	$("#VentaRepreNombreRemi").autocomplete({
		source: remitentNombre,
		select: function( event, ui ) {
			$.each( remitentes, function( key, value ) {
				if(ui.item.value == value.Remitente.nombre){
					remitenteId = value.Remitente.id;
					$("#VentaRepreRemitente").val(value.Remitente.id);
					$("#VentaRepreDocumentoRemi").val(value.Remitente.documento);
					$("#VentaRepreDireccionRemi").val(value.Remitente.direccion);
					$("#VentaRepreTelefonoRemi").val(value.Remitente.telefono);
					$("#VentaRepreCelularRemi").val(value.Remitente.celular);
					$("#VentaRepreEmailRemi").val(value.Remitente.email);
					$("#VentaRepreNombreCont").val(value.Remitente.contacto);
					$("#VentaRepreTelefonoCont").val(value.Remitente.telefono_cont);
				}
			});
		}
	});

	$("#VentaRepreDocumentoDest").autocomplete({
		source: destinatIdentificacion,
		select: function( event, ui ) {
			$.each( destinatarios, function( key, value ) {
				if(ui.item.value == value.Destinatario.documento){
					destinatarioId = value.Destinatario.id;
					$("#VentaRepreDestinatario").val(value.Destinatario.id);
					$("#VentaRepreNombreDest").val(value.Destinatario.listNombre);
					$("#VentaRepreDireccionDest").val(value.Destinatario.direccion);
					$("#VentaRepreTelefonoDest").val(value.Destinatario.telefono);
					$("#VentaRepreTelefono2Dest").val(value.Destinatario.telefono2);
					$("#VentaRepreEmailDest").val(value.Destinatario.email);
					$("#VentaRepreFaxDest").val(value.Destinatario.fax);
				}
			});
			$("#VentaRepreNombreDest").trigger('val');
			$("#VentaRepreDireccionDest").trigger('val');
			$("#VentaRepreTelefonoDest").trigger('val');
		}
	});
	$("#VentaRepreNombreDest").autocomplete({
		source: destinatNombre,
		select: function( event, ui ) {
			$.each( destinatarios, function( key, value ) {
				if(ui.item.value == value.Destinatario.listNombre){
					destinatarioId = value.Destinatario.id;
					$("#VentaRepreDestinatario").val(value.Destinatario.id);
					$("#VentaRepreDocumentoDest").val(value.Destinatario.documento);
					$("#VentaRepreDireccionDest").val(value.Destinatario.direccion);
					$("#VentaRepreTelefonoDest").val(value.Destinatario.telefono);
					$("#VentaRepreTelefono2Dest").val(value.Destinatario.telefono2);
					$("#VentaRepreEmailDest").val(value.Destinatario.email);
					$("#VentaRepreFaxDest").val(value.Destinatario.fax);
				}
			});
		}
	});
	$("#VentaRepreContacto").autocomplete({
		source: contactosArray,
		select: function( event, ui ) {
			$.each( contactosArray, function( key, value ) {
				if(ui.item.value == value){
					$("#VentaRepreContactoTel").val(contactosArrayTel[key]);
				}
			});
		}
	});
});
	$("#div-remitente").hide();
	var ciudad = <?php echo $usuario_actual['ciudad']; ?>;

$(document).ready(function(){
	$("#VentaRepreFechaRecibio").datepicker();

	$('#VentaRepreCrearForm').bootstrapValidator({
		feedbackIcons: {
			required: 'glyphicon glyphicon-asterisk',
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		}
	});

	$.each( clientes, function( key, value ) {
		clientesIdentificacion[key] = value.Cliente.documento;
		clientesNombre[key]         = value.Cliente.listNombre;
	});
	var indexTipo = 0;
	$.each( tipo, function( key, value ) {
		tipoGuia[indexTipo] = value;
		indexTipo++;
	});

	viewModel.addUser();
	$("#VentaRepreFecha").datepicker({minDate: 0});

	$("#VentaRepreOtroRemi").change(function(){
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
		$("#VentaRepreDevolverFirmado").val(0);
		$("#VentaRepreTipo").val(0);
		$("#kiloAdSpan").text("0");
		$("#VentaRepreDeclarado").val("");
		$("#VentaRepreFirmado").val("No");
		$("#VentaRepreDestino").val("");
		$("#VentaRepreOrigen").val("");
		$("#VentaRepreDocumentoRemi").val("");
		$("#VentaRepreTelefono").val("");
		$("#VentaRepreTelefono").trigger("chosen:updated");
		$("#VentaRepreOrigen").trigger("chosen:updated");
		$("#VentaRepreDestino").trigger("chosen:updated");
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
	$("#VentaRepreDeclarado").number( true, 0 );
*/
	$("#VentaRepreDeclarado").keyup(function(){
		var strNum = $(this).val();
		var num    = parseFloat(strNum.replace(/,/g,""));
		num        = num.formatMoney(0,',','.');
		$(this).val(num);
		$("#VentaRepreDeclarado").trigger("val");
	});

	$("#VentaRepreDeclarado").blur(function(){
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
					$("#costoSeguro").text(seguro.formatMoney(0,',','.'));
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
						$("#costoSeguro").text(seguro.formatMoney(0,',','.'));
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
		$("#VentaRepreDeclarado").trigger("val");
	});

	$("#VentaRepreFirmado").change(function(){
		if($(this).val() == "Si"){
			var existeDevol = false;
			$.each( ajaxCall.Tarifa, function( key, value ) {
				if(4 == value.Tarifa.empaque_id){
					existeDevol = true;
					costoDevol = parseFloat(value.Tarifa.tarifa).toFixed(0);
					$("#costoDevol").text(costoDevol);
					$("#VentaRepreDevolverFirmado").val(costoDevol);
				}
			});
			if(!existeDevol){
				$.each( ajaxCall.TarifaBase, function( key, value ) {
					if(4 == value.Tarifa.empaque_id){
						existeDevol = true;
						costoDevol = parseFloat(value.Tarifa.tarifa).toFixed(0);
						$("#costoDevol").text(costoDevol);
						$("#VentaRepreDevolverFirmado").val(costoDevol);
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
			$("#VentaRepreDevolverFirmado").val(0);
		}
		calcularTotal();
	});

	$("#VentaRepreOrigen").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el origen"
	});
	$("#VentaRepreDestino").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el destino"
	});
	
	$("#VentaRepreRecaudador").chosen({
		no_results_text           : 'No se encuentra el recaudador.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el recaudador"
	});
	$("#VentaRepreOrigen").val(ciudad);
	$("#VentaRepreOrigen").trigger("chosen:updated");

	$("#VentaRepreDocumentoClien").change(function(){
		var flag = true;
		var docuCli = $(this).val();
		$.each( clientes, function( key, value ) {
			if(docuCli == value.Cliente.documento){
				flag   = false;
				if(value.Cliente.activo == "No"){
					$("#VentaRepreDocumentoClien").val("");
					$("#VentaRepreCliente").val("");
					$("#VentaRepreNombreClien").val("");
					$("#VentaRepreDireccionClien").val("");
					$("#VentaRepreTelefonoClien").val("");
					$("#VentaRepreTelefono2Clien").val("");
					$("#VentaRepreEmailClien").val("");
					$("#VentaRepreFaxClien").val("");
					alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
				} else if(value.Cliente.causal != "Activo"){
					$("#VentaRepreDocumentoClien").val("");
					$("#VentaRepreCliente").val("");
					$("#VentaRepreNombreClien").val("");
					$("#VentaRepreDireccionClien").val("");
					$("#VentaRepreTelefonoClien").val("");
					$("#VentaRepreTelefono2Clien").val("");
					$("#VentaRepreEmailClien").val("");
					$("#VentaRepreFaxClien").val("");
					alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
				} else {
					clienteId = value.Cliente.id;
					$("#VentaRepreCliente").val(value.Cliente.id);
					$("#VentaRepreNombreClien").val(value.Cliente.listNombre);
					$("#VentaRepreDireccionClien").val(value.Cliente.direccion);
					$("#VentaRepreTelefonoClien").val(value.Cliente.telefono);
					$("#VentaRepreTelefono2Clien").val(value.Cliente.telefono2);
					$("#VentaRepreEmailClien").val(value.Cliente.email);
					$("#VentaRepreFaxClien").val(value.Cliente.fax);
					remitentIdentificacion = new Array();
					remitentNombre         = new Array();
					var i = 0;
					$.each( value.Cliente.remitentes, function( key, value ) {
						value                     = parseInt(value);
						remitentIdentificacion[i] = remitentes[value].Remitente.documento;
						remitentNombre[i]         = remitentes[value].Remitente.nombre;
						i                         = i + 1;
					});
					$("#VentaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
					$("#VentaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
				}
				$("#VentaRepreDestino").val("");
				$("#VentaRepreDestino").trigger("chosen:updated");
			}
		});
		if(flag){
			if(confirm("El cliente NO existe, ¿Desea registrarlo?")){
				var docAct  = $("#VentaRepreDocumentoClien").val();
				var nomAct  = $("#VentaRepreNombreClien").val();
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
						$("#VentaRepreDocumentoClien").val(arrayInfo[0]);
						$("#VentaRepreNombreClien").val(arrayInfo[1]);
						$("#VentaRepreDireccionClien").val(arrayInfo[2]);
						$("#VentaRepreTelefonoClien").val(arrayInfo[3]);
						$("#VentaRepreTelefono2Clien").val(arrayInfo[4]);
						$("#VentaRepreEmailClien").val(arrayInfo[5]);
						$("#VentaRepreFaxClien").val(arrayInfo[6]);
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
						$("#VentaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
						$("#VentaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
					}
				});
			}
		}
	});

	$("#VentaRepreNombreClien").change(function(){
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
				var docAct  = $("#VentaRepreDocumentoClien").val();
				var nomAct  = $("#VentaRepreNombreClien").val();
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
						$("#VentaRepreDocumentoClien").val(arrayInfo[0]);
						$("#VentaRepreNombreClien").val(arrayInfo[1]);
						$("#VentaRepreDireccionClien").val(arrayInfo[2]);
						$("#VentaRepreTelefonoClien").val(arrayInfo[3]);
						$("#VentaRepreTelefono2Clien").val(arrayInfo[4]);
						$("#VentaRepreEmailClien").val(arrayInfo[5]);
						$("#VentaRepreFaxClien").val(arrayInfo[6]);
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
						$("#VentaRepreDocumentoRemi").autocomplete('option', 'source', remitentIdentificacion);
						$("#VentaRepreNombreRemi").autocomplete('option', 'source', remitentNombre);
					}
				});
			}
		}
	});
	$("#VentaRepreNombreDest").change(function(){
		var flag = true;
		var docuDest = $(this).val();
		$.each( destinatarios, function( key, value ) {
			if(docuDest == value.Destinatario.listNombre){
				destinatarioId = value.Destinatario.id;
				flag           = false;
			}
		});
		if(flag){
			if(confirm("El destinatario NO existe, ¿Desea registrarlo?")){
				var docAct  = $("#VentaRepreDocumentoDest").val();
				var nomAct  = $("#VentaRepreNombreDest").val();
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
						$("#VentaRepreDocumentoDest").val(arrayInfo[0]);
						$("#VentaRepreNombreDest").val(arrayInfo[1]);
						$("#VentaRepreDireccionDest").val(arrayInfo[2]);
						$("#VentaRepreTelefonoDest").val(arrayInfo[3]);
						$("#VentaRepreTelefono2Dest").val(arrayInfo[4]);
						$("#VentaRepreEmailDest").val(arrayInfo[5]);
						$("#VentaRepreFaxDest").val(arrayInfo[6]);
					}
				});
			}
		}
	});
	$("#VentaRepreDocumentoDest").change(function(){
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
				var docAct  = $("#VentaRepreDocumentoDest").val();
				var nomAct  = $("#VentaRepreNombreDest").val();
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
						$("#VentaRepreDocumentoDest").val(arrayInfo[0]);
						$("#VentaRepreNombreDest").val(arrayInfo[1]);
						$("#VentaRepreDireccionDest").val(arrayInfo[2]);
						$("#VentaRepreTelefonoDest").val(arrayInfo[3]);
						$("#VentaRepreTelefono2Dest").val(arrayInfo[4]);
						$("#VentaRepreEmailDest").val(arrayInfo[5]);
						$("#VentaRepreFaxDest").val(arrayInfo[6]);
					}
				});
			}
		}
	});
	/*
	$('#VentaRepreDocumentoClien').JCombo({
		'parentId': 'VentaRepreDocumentoClien',
		'nodeId'  : 'VentaRepreDocumentoRemi',
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

	$("#VentaRepreOrigen").change(function(){
		$("#VentaRepreDestino").val("");
		$("#VentaRepreDestino").trigger("chosen:updated");
	});
	$("#VentaRepreDestino").change(function(){
		if($("#VentaRepreOrigen").val() == ""){
			alert("Seleccione una ciudad de origen primero.");
			$("#VentaRepreDestino").val("");
			$("#VentaRepreDestino").trigger("chosen:updated");
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
				$("#VentaRepreDocumentoDest").autocomplete('option', 'source', destinatIdentificacion);
				$("#VentaRepreNombreDest").autocomplete('option', 'source', destinatNombre);
				$("#kiloAdSpan").val("");
				$("#VentaRepreDestinatario").val("");
				$("#VentaRepreNombreDest").val("");
				$("#VentaRepreDocumentoDest").val("");
				$("#VentaRepreDireccionDest").val("");
				$("#VentaRepreTelefonoDest").val("");
				$("#VentaRepreTelefono2Dest").val("");
				$("#VentaRepreEmailDest").val("");
				$("#VentaRepreFaxDest").val("");
				origenId  = $("#VentaRepreOrigen").val();
				destinoId = $("#VentaRepreDestino").val();
				$("#VentaRepreDeclarado").val("");
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
				$("#VentaRepreFirmado").val("No");
				calcularTotal();
				var clienteDocumActual = $("#VentaRepreDocumentoClien").val();
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
					url: fullpath+"ventasrepre/getTarifa/"+clienteId+"/"+origenId+"/"+destinoId,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					},
					success: function(response) {
						response = JSON.parse(response);
						ajaxCall = response;
						$("#VentaRepreRecaudador").empty();
						$.each(ajaxCall.Representante, function(key, value) {
							$("#VentaRepreRecaudador").append($("<option></option>").attr("value", key).text(value));
						});
						$("#VentaRepreRecaudador").trigger("chosen:updated");
						$.fancybox.hideLoading();
						$.fancybox.helpers.overlay.close();

		var existe = false;
		$.each( ajaxCall.Tarifa, function( key, value ) {
			if(2 == value.Tarifa.empaque_id){
				$.each($(".empaques"), function( key2, value2 ) {
					var padre = $(value2).parent().parent().parent();
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
					var pesoVolCal = ((largo/100)*(ancho/100)*(alto/100))*400*cantidad;
					$(padre).find(".pesoVol").val(pesoVolCal.toFixed(0));
				});
			}
		});
		if(!existe){
			$.each( ajaxCall.TarifaBase, function( key, value ) {
				if(2 == value.TarifaBase.empaque_id){
					$.each($(".empaques"), function( key2, value2 ) {
						var padre = $(value2).parent().parent().parent();
						existe = true;
						$("#kiloAdSpan").text(parseFloat(value.TarifaBase.valor_adicional).toFixed(0));
						$(padre).find(".valor").val(parseFloat(value.TarifaBase.tarifa).toFixed(0));
						$(padre).find(".kiloAd").val(parseFloat(value.TarifaBase.max_kilo).toFixed(0));
						$(padre).find(".kiloAd2").val(parseFloat(value.TarifaBase.max_kilo).toFixed(0));
						$(padre).find(".valKilo").val(parseFloat(value.TarifaBase.valor_adicional).toFixed(0));
						$(padre).find(".largo").val(parseFloat(value.TarifaBase.largo).toFixed(0));
						$(padre).find(".ancho").val(parseFloat(value.TarifaBase.ancho).toFixed(0));
						$(padre).find(".alto").val(parseFloat(value.TarifaBase.alto).toFixed(0));
						$(padre).find(".pesoUni").val(parseFloat(value.TarifaBase.peso).toFixed(0));
						var alto       = $(padre).find(".alto").val();
						var ancho      = $(padre).find(".ancho").val();
						var largo      = $(padre).find(".largo").val();
						var cantidad   = parseFloat($(padre).find(".cantidad").val());
						var pesoVolCal = ((largo/100)*(ancho/100)*(alto/100))*400*cantidad;
						$(padre).find(".pesoVol").val(pesoVolCal.toFixed(0));
					});
				}
			});
			if(!existe){
				alert("Empaque sin tarifa, contactar al administrador.");
location.reload(true);
				$(this).val("");
			}
		}

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