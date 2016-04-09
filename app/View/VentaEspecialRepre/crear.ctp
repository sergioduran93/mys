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
	<?php echo $this->Form->create('VentaEspecialRepre',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3 class="h3-black"><center>VENTA ESPECIAL</center></h3></div>
		<?php echo $this->Form->input('id',               array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('cancelada',        array('type'=>'hidden','default'=>'No')); ?>
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
				<div class="col-md-3"><?php echo $this->Form->input('documentoClien',array('label'=>'Documento: ','type'=>'select','options'=>$clientesD,'empty'=>'')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('nombreClien',array('label'=>'Nombre: ','type'=>'select','options'=>$clientesN,'empty'=>'')); ?></div>
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
				<div class="col-md-3"><?php echo $this->Form->input('documentoRemi',array('label'=>'Documento: ','type'=>'select','options'=>$remitentesD,'empty'=>'')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('nombreRemi',array('label'=>'Nombre: ','type'=>'select','options'=>$remitentesNom,'empty'=>'')); ?></div>
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
				<div class="col-md-3"><?php echo $this->Form->input('documentoDest',array('label'=>'Documento: ','type'=>'text','placeholder'=>'Seleccione el destinatario')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('nombreDest',array('label'=>'Nombre: ','type'=>'text','placeholder'=>'Seleccione el destinatario')); ?></div>
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
		<div class="col-md-12" style="padding:0px;">
			<div class="col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('declarado',array('label'=>'Valor declarado:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('firmado',array('label'=>'Devolver firmado:','type'=>'select','options'=>$firmado,'default'=>'No')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('contenido',array('label'=>'Contenido:','type'=>'text','class'=>'eexpand50-200')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('observaciones',array('label'=>'Observaciones:','type'=>'text','default'=>'NO')); ?></div>
			</div>
			<div class="col-md-12" style="padding:0px;">
				<div class="col-md-6" style="padding:0px;">
					<div class="form-group col-md-12">
						<div class="col-md-6"><?php echo $this->Form->input('checkRemitente',array('label'=>'Remitente','type'=>'checkbox')); ?></div>
						<div class="col-md-6"><?php echo $this->Form->input('checkArchivo',array('label'=>'Archivo','type'=>'checkbox')); ?></div>
					</div>
					<div class="form-group col-md-12">
						<div class="col-md-6"><?php echo $this->Form->input('checkDestinatario',array('label'=>'Destinatario','type'=>'checkbox')); ?></div>
						<div class="col-md-6"><?php echo $this->Form->input('checkPrueba',array('label'=>'Prueba de entrega','type'=>'checkbox')); ?></div>
					</div>
				</div>
				<div class="col-md-6" style="font-weight:bold;font-size:xx-large;text-align:right;padding-right:25px;">
					Costo Total $0
				</div>
			</div>
		</div>

	<?php echo $this->Form->button("Guardar",array('type'=>'submit',"class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>

<script>
	$("#btn-submit").click(function(){
		if(submit){
			itsclicked = true;
			$("#VentaEspecialRepreCrearForm").submit();
		} else {
			alert("Cliente sin cupo suficiente");
		}
	});
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
		costoFlete  = 0;
		costoAdic   = 0;
		descFlete   = 0;
		descKilo    = 0;
		costoSeguro = 0;
		costoDevol  = 0;
		costoTotal  = 0;
		seguro      = 0;
	}

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
	var submit = true;

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("#VentaEspecialRepreDocumentoClien").change(function(){
		var clienteSelec = $("#VentaEspecialRepreDocumentoClien").val();
		$.each( clientes, function( key, value ) {
			if(clienteSelec == value.Cliente.id){
				if(value.Cliente.activo == "No"){
					$("#VentaEspecialRepreDocumentoClien").val("");
					$("#VentaEspecialRepreCliente").val("");
					$("#VentaEspecialRepreNombreClien").val("");
					$("#VentaEspecialRepreDireccionClien").val("");
					$("#VentaEspecialRepreTelefonoClien").val("");
					$("#VentaEspecialRepreTelefono2Clien").val("");
					$("#VentaEspecialRepreEmailClien").val("");
					$("#VentaEspecialRepreFaxClien").val("");
					alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
				} else if(value.Cliente.causal != "Activo" && value.Cliente.causal != null){
					$("#VentaEspecialRepreDocumentoClien").val("");
					$("#VentaEspecialRepreCliente").val("");
					$("#VentaEspecialRepreNombreClien").val("");
					$("#VentaEspecialRepreDireccionClien").val("");
					$("#VentaEspecialRepreTelefonoClien").val("");
					$("#VentaEspecialRepreTelefono2Clien").val("");
					$("#VentaEspecialRepreEmailClien").val("");
					$("#VentaEspecialRepreFaxClien").val("");
					alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
				} else {
					clienteId = value.Cliente.id;
					$("#VentaEspecialRepreCliente").val(value.Cliente.id);
					$("#VentaEspecialRepreNombreClien").val(clienteSelec);
					$("#VentaEspecialRepreDireccionClien").val(value.Cliente.direccion);
					$("#VentaEspecialRepreTelefonoClien").val(value.Cliente.telefono);
					$("#VentaEspecialRepreTelefono2Clien").val(value.Cliente.telefono2);
					$("#VentaEspecialRepreEmailClien").val(value.Cliente.email);
					$("#VentaEspecialRepreFaxClien").val(value.Cliente.fax);
					remitentIdentificacion    = new Array();
					remitentNombre            = new Array();
					remitentIdentificacion[0] = "";
					remitentNombre[0]         = "";
					var i = 1;
					$.each( value.Cliente.remitentes, function( key, value ) {
						value                     = parseInt(value);
						remitentIdentificacion[i] = remitentes[value].Remitente.documento;
						remitentNombre[i]         = remitentes[value].Remitente.nombre;
						i                         = i + 1;
					});

					$("#VentaEspecialRepreDocumentoRemi").empty();
					$("#VentaEspecialRepreNombreRemi").empty();
					$.each(remitentIdentificacion, function(key, value) {
						$("#VentaEspecialRepreDocumentoRemi").append($("<option></option>").attr("value", value).text(value));
					});
					$.each(remitentNombre, function(key, value) {
						$("#VentaEspecialRepreNombreRemi").append($("<option></option>").attr("value", value).text(value));
					});
				}
				$("#VentaEspecialRepreDestino").val("");
				$("#VentaEspecialRepreOrigen").val("");
				$("#VentaEspecialRepreOrigen").trigger("chosen:updated");
				$("#VentaEspecialRepreDestino").trigger("chosen:updated");
				$("#VentaEspecialRepreDocumentoRemi").trigger("chosen:updated");
				$("#VentaEspecialRepreNombreRemi").trigger("chosen:updated");
				$("#VentaEspecialRepreNombreClien").trigger("chosen:updated");
			}
		});
	});
	$("#VentaEspecialRepreNombreClien").change(function(){
		var clienteSelec = $("#VentaEspecialRepreNombreClien").val();
		$.each( clientes, function( key, value ) {
			if(clienteSelec == value.Cliente.id){
				if(value.Cliente.activo == "No"){
					$("#VentaEspecialRepreDocumentoClien").val("");
					$("#VentaEspecialRepreCliente").val("");
					$("#VentaEspecialRepreNombreClien").val("");
					$("#VentaEspecialRepreDireccionClien").val("");
					$("#VentaEspecialRepreTelefonoClien").val("");
					$("#VentaEspecialRepreTelefono2Clien").val("");
					$("#VentaEspecialRepreEmailClien").val("");
					$("#VentaEspecialRepreFaxClien").val("");
					alert("Cliente inactivo, contacte con el administrador.");
		location.reload(true);
				} else if(value.Cliente.causal != "Activo" && value.Cliente.causal != null){
					$("#VentaEspecialRepreDocumentoClien").val("");
					$("#VentaEspecialRepreCliente").val("");
					$("#VentaEspecialRepreNombreClien").val("");
					$("#VentaEspecialRepreDireccionClien").val("");
					$("#VentaEspecialRepreTelefonoClien").val("");
					$("#VentaEspecialRepreTelefono2Clien").val("");
					$("#VentaEspecialRepreEmailClien").val("");
					$("#VentaEspecialRepreFaxClien").val("");
					alert("Cliente con causal ("+value.Cliente.causal+"), contacte con el administrador.");
				} else {
					clienteId = value.Cliente.id;
					$("#VentaEspecialRepreCliente").val(value.Cliente.id);
					$("#VentaEspecialRepreDocumentoClien").val(clienteSelec);
					$("#VentaEspecialRepreDireccionClien").val(value.Cliente.direccion);
					$("#VentaEspecialRepreTelefonoClien").val(value.Cliente.telefono);
					$("#VentaEspecialRepreTelefono2Clien").val(value.Cliente.telefono2);
					$("#VentaEspecialRepreEmailClien").val(value.Cliente.email);
					$("#VentaEspecialRepreFaxClien").val(value.Cliente.fax);
					remitentIdentificacion    = new Array();
					remitentNombre            = new Array();
					remitentIdentificacion[0] = "";
					remitentNombre[0]         = "";
					var i = 1;
					$.each( value.Cliente.remitentes, function( key, value ) {
						value                     = parseInt(value);
						remitentIdentificacion[i] = remitentes[value].Remitente.documento;
						remitentNombre[i]         = remitentes[value].Remitente.nombre;
						i                         = i + 1;
					});

					$("#VentaEspecialRepreDocumentoRemi").empty();
					$("#VentaEspecialRepreNombreRemi").empty();
					$.each(remitentIdentificacion, function(key, value) {
						$("#VentaEspecialRepreDocumentoRemi").append($("<option></option>").attr("value", value).text(value));
					});
					$.each(remitentNombre, function(key, value) {
						$("#VentaEspecialRepreNombreRemi").append($("<option></option>").attr("value", value).text(value));
					});
				}
				$("#VentaEspecialRepreDestino").val("");
				$("#VentaEspecialRepreOrigen").val("");
				$("#VentaEspecialRepreOrigen").trigger("chosen:updated");
				$("#VentaEspecialRepreDestino").trigger("chosen:updated");
				$("#VentaEspecialRepreDocumentoRemi").trigger("chosen:updated");
				$("#VentaEspecialRepreNombreRemi").trigger("chosen:updated");
				$("#VentaEspecialRepreDocumentoClien").trigger("chosen:updated");
			}
		});
	});

	$("#VentaEspecialRepreDocumentoRemi").change(function(){
		var remitenSelec = $("#VentaEspecialRepreDocumentoRemi").val();
		$.each( remitentes, function( key, value ) {
			if(remitenSelec == value.Remitente.documento){
				remitenteId = value.Remitente.id;
				$("#VentaEspecialRepreRemitente").val(value.Remitente.id);
				$("#VentaEspecialRepreNombreRemi").val(value.Remitente.nombre);
				$("#VentaEspecialRepreDireccionRemi").val(value.Remitente.direccion);
				$("#VentaEspecialRepreTelefonoRemi").val(value.Remitente.telefono);
				$("#VentaEspecialRepreCelularRemi").val(value.Remitente.celular);
				$("#VentaEspecialRepreEmailRemi").val(value.Remitente.email);
				$("#VentaEspecialRepreNombreRemi").trigger("chosen:updated");
			}
		});
	});
	$("#VentaEspecialRepreNombreRemi").change(function(){
		var remitenSelec = $("#VentaEspecialRepreNombreRemi").val();
		$.each( remitentes, function( key, value ) {
			if(remitenSelec == value.Remitente.nombre){
				remitenteId = value.Remitente.id;
				$("#VentaEspecialRepreRemitente").val(value.Remitente.id);
				$("#VentaEspecialRepreDocumentoRemi").val(value.Remitente.documento);
				$("#VentaEspecialRepreDireccionRemi").val(value.Remitente.direccion);
				$("#VentaEspecialRepreTelefonoRemi").val(value.Remitente.telefono);
				$("#VentaEspecialRepreCelularRemi").val(value.Remitente.celular);
				$("#VentaEspecialRepreEmailRemi").val(value.Remitente.email);
				$("#VentaEspecialRepreDocumentoRemi").trigger("chosen:updated");
				var contactos = JSON.parse(value.Remitente.contacto);
				var contactosArray = new Array();
				$.each(contactos, function(key2, value2) {
					contactosArray[key2] = value2.nombre;
				});
				$("#VentaContacto").autocomplete('option', 'source', contactosArray);
			}
		});
	});

	$("#VentaEspecialRepreDocumentoDest").autocomplete({
		source: destinatIdentificacion,
		select: function( event, ui ) {
			$.each( destinatarios, function( key, value ) {
				if(ui.item.value == value.Destinatario.documento){
					destinatarioId = value.Destinatario.id;
					$("#VentaEspecialRepreDestinatario").val(value.Destinatario.id);
					$("#VentaEspecialRepreNombreDest").val(value.Destinatario.listNombre);
					$("#VentaEspecialRepreDireccionDest").val(value.Destinatario.direccion);
					$("#VentaEspecialRepreTelefonoDest").val(value.Destinatario.telefono);
					$("#VentaEspecialRepreTelefono2Dest").val(value.Destinatario.telefono2);
					$("#VentaEspecialRepreEmailDest").val(value.Destinatario.email);
					$("#VentaEspecialRepreFaxDest").val(value.Destinatario.fax);
					var contactos = JSON.parse(value.Remitente.contacto);
					var contactosArray = new Array();
					$.each(contactos, function(key2, value2) {
						contactosArray[key2] = value2.nombre;
					});
					$("#VentaContacto").autocomplete('option', 'source', contactosArray);
				}
			});
		}
	});
	$("#VentaEspecialRepreNombreDest").autocomplete({
		source: destinatNombre,
		select: function( event, ui ) {
			$.each( destinatarios, function( key, value ) {
				if(ui.item.value == value.Destinatario.listNombre){
					destinatarioId = value.Destinatario.id;
					$("#VentaEspecialRepreDestinatario").val(value.Destinatario.id);
					$("#VentaEspecialRepreDocumentoDest").val(value.Destinatario.documento);
					$("#VentaEspecialRepreDireccionDest").val(value.Destinatario.direccion);
					$("#VentaEspecialRepreTelefonoDest").val(value.Destinatario.telefono);
					$("#VentaEspecialRepreTelefono2Dest").val(value.Destinatario.telefono2);
					$("#VentaEspecialRepreEmailDest").val(value.Destinatario.email);
					$("#VentaEspecialRepreFaxDest").val(value.Destinatario.fax);
				}
			});
		}
	});
	$("#VentaContacto").autocomplete({
		source: contactosArray
	});

	$("#div-remitente").hide();

$(document).ready(function(){


	$("#selbarra").keypress(function(e){
		if(e.which == 13) {
			var cl = ingresos[$(this).val()];
			$("#VentaEspecialRepreDocumentoClien").val(cl);
			$("#VentaEspecialRepreDocumentoClien").trigger('chosen:updated');
			$("#VentaEspecialRepreDocumentoClien").trigger('change');
			//$("#VentaEspecialRepreDestino").trigger('chosen:activate');
			$("#VentaEspecialRepreDocumento1").focus();
			$("#VentaEspecialRepreOrigen").val(ciudad);
			$("#VentaEspecialRepreOrigen").trigger("chosen:updated");
		}
	});
	$(document).on("keypress",".barras",function(e){
		if(e.which == 13) {
			$(this).val($(this).val()+",");
		}
	});



	$.each( clientes, function( key, value ) {
		clientesIdentificacion[key] = value.Cliente.documento;
		clientesNombre[key]         = value.Cliente.listNombre;
	});

	viewModel.addUser();
	$("#VentaEspecialRepreFecha").datepicker({minDate: 0});

	$("#VentaEspecialRepreOtroRemi").change(function(){
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
		$("#VentaEspecialRepreDevolverFirmado").val(0);
		$("#VentaEspecialRepreTipo").val(0);
		$("#kiloAdSpan").text("0");
		$("#VentaEspecialRepreDeclarado").val("");
		$("#VentaEspecialRepreFirmado").val("No");
		$("#VentaEspecialRepreCancelada").val("No");
		$("#VentaEspecialRepreDestino").val("");
		$("#VentaEspecialRepreOrigen").val("");
		$("#VentaEspecialRepreDocumentoRemi").val("");
		$("#VentaEspecialRepreTelefono").val("");
		$("#VentaEspecialRepreTelefono").trigger("chosen:updated");
		$("#VentaEspecialRepreOrigen").trigger("chosen:updated");
		$("#VentaEspecialRepreDestino").trigger("chosen:updated");
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
	$("#VentaEspecialRepreDeclarado").number( true, 0 );
*/
	$("#VentaEspecialRepreDeclarado").keyup(function(){
		var strNum = $(this).val();
		var num    = parseFloat(strNum.replace(/,/g,""));
		num        = num.formatMoney(0,',','.');
		$(this).val(num);
	});

	$("#VentaEspecialRepreDeclarado").blur(function(){
		seguro = 0;
	});

	$("#VentaEspecialRepreOrigen").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el origen"
	});
	$("#VentaEspecialRepreDestino").chosen({
		no_results_text           : 'No se encuentra el destino.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el destino"
	});

	$("#VentaEspecialRepreDocumentoClien").chosen({
		no_results_text           : 'No se encuentra el cliente.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el cliente"
	});
	$("#VentaEspecialRepreNombreClien").chosen({
		no_results_text           : 'No se encuentra el cliente.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el cliente"
	});
	$("#VentaEspecialRepreDocumentoRemi").chosen({
		no_results_text           : 'No se encuentra el remitente.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el remitente"
	});
	$("#VentaEspecialRepreNombreRemi").chosen({
		no_results_text           : 'No se encuentra el remitente.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el remitente"
	});
	$("#VentaEspecialRepreRecaudador").chosen({
		no_results_text           : 'No se encuentra el recaudador.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el recaudador"
	});

	$("#VentaEspecialRepreNombreDest").change(function(){
		var flag = true;
		var docuDest = $(this).val();
		$.each( destinatarios, function( key, value ) {
			if(docuDest == value.Destinatario.listNombre){
				$("#VentaEspecialRepreDestinatario").val(value.Destinatario.id);
				destinatarioId = value.Destinatario.id;
				flag           = false;
			}
		});
		if(flag){
			if(confirm("El destinatario NO existe, ¿Desea registrarlo?")){
				var docAct  = $("#VentaEspecialRepreDocumentoDest").val();
				var nomAct  = $("#VentaEspecialRepreNombreDest").val();
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
						$("#VentaEspecialRepreDocumentoDest").val(arrayInfo[0]);
						$("#VentaEspecialRepreNombreDest").val(arrayInfo[1]);
						$("#VentaEspecialRepreDireccionDest").val(arrayInfo[2]);
						$("#VentaEspecialRepreTelefonoDest").val(arrayInfo[3]);
						$("#VentaEspecialRepreTelefono2Dest").val(arrayInfo[4]);
						$("#VentaEspecialRepreEmailDest").val(arrayInfo[5]);
						$("#VentaEspecialRepreFaxDest").val(arrayInfo[6]);
					}
				});
			}
		}
	});
	$("#VentaEspecialRepreDocumentoDest").change(function(){
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
				var docAct  = $("#VentaEspecialRepreDocumentoDest").val();
				var nomAct  = $("#VentaEspecialRepreNombreDest").val();
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
						$("#VentaEspecialRepreDocumentoDest").val(arrayInfo[0]);
						$("#VentaEspecialRepreNombreDest").val(arrayInfo[1]);
						$("#VentaEspecialRepreDireccionDest").val(arrayInfo[2]);
						$("#VentaEspecialRepreTelefonoDest").val(arrayInfo[3]);
						$("#VentaEspecialRepreTelefono2Dest").val(arrayInfo[4]);
						$("#VentaEspecialRepreEmailDest").val(arrayInfo[5]);
						$("#VentaEspecialRepreFaxDest").val(arrayInfo[6]);
					}
				});
			}
		}
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

		var alto       = $(padre).find(".alto").val();
		var ancho      = $(padre).find(".ancho").val();
		var largo      = $(padre).find(".largo").val();
		var cantidad   = parseFloat($(padre).find(".cantidad").val());
		var pesoVolCal = ((largo/100)*(ancho/100)*(alto/100))*400*cantidad;
		$(padre).find(".pesoVol").val(pesoVolCal.toFixed(0));

		calcularSubtotal();

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
		descKilo           = 0;
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

	$("#VentaEspecialRepreOrigen").change(function(){
		$("#VentaEspecialRepreDestino").val("");
		$("#VentaEspecialRepreDestino").trigger("chosen:updated");
	});
	$("#VentaEspecialRepreDestino").change(function(){
		if($("#VentaEspecialRepreOrigen").val() == ""){
			alert("Seleccione una ciudad de origen primero.");
			$("#VentaEspecialRepreDestino").val("");
			$("#VentaEspecialRepreDestino").trigger("chosen:updated");
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
				$("#VentaEspecialRepreDocumentoDest").autocomplete('option', 'source', destinatIdentificacion);
				$("#VentaEspecialRepreNombreDest").autocomplete('option', 'source', destinatNombre);
				$("#kiloAdSpan").val("");
				$("#VentaEspecialRepreDestinatario").val("");
				$("#VentaEspecialRepreNombreDest").val("");
				$("#VentaEspecialRepreDocumentoDest").val("");
				$("#VentaEspecialRepreDireccionDest").val("");
				$("#VentaEspecialRepreTelefonoDest").val("");
				$("#VentaEspecialRepreTelefono2Dest").val("");
				$("#VentaEspecialRepreEmailDest").val("");
				$("#VentaEspecialRepreFaxDest").val("");
				origenId  = $("#VentaEspecialRepreOrigen").val();
				destinoId = $("#VentaEspecialRepreDestino").val();
				$("#VentaEspecialRepreDeclarado").val("");
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
				$("#VentaEspecialRepreFirmado").val("No");
				calcularTotal();
				var clienteDocumActual = $("#VentaEspecialRepreDocumentoClien").val();
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
					url: fullpath+"VentaEspecialRepre/getTarifa/"+clienteId+"/"+origenId+"/"+destinoId,
					beforeSend: function(xhr) {
						xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					},
					success: function(response) {
						response = JSON.parse(response);
						ajaxCall = response;
						$("#VentaEspecialRepreRecaudador").empty();
						$.each(ajaxCall.Representante, function(key, value) {
							$("#VentaEspecialRepreRecaudador").append($("<option></option>").attr("value", key).text(value));
						});
						$("#VentaEspecialRepreRecaudador").trigger("chosen:updated");
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