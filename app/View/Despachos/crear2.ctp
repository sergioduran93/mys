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
<style>
.search-choice{
	width: 99%;
}
</style>

<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Despacho',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>PLANILLA DE DESPACHOS (ESPECIAL)</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
	    <?php echo $this->Form->input('valores',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
		<?php echo $this->Form->input('oficina',array('type'=>'hidden','default'=>$usuario_actual['oficina_id'])); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-3"><?php echo $this->Form->input('negociador',array('label'=>'Negociador: ','type'=>'select','options'=>$negociadores,'empty'=>'')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('placa',array('label'=>'Placa: ','type'=>'select','options'=>$placas,'empty'=>'')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Tipo vehiculo: ','type'=>'text')); ?></div>
       		<div class="col-md-3"><?php echo $this->Form->input('modelo',array('label'=>'Modelo: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('conductor',array('label'=>'Identificación: ','type'=>'select','options'=>$conductoresId,'empty'=>'')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('nombre',array('label'=>'Nombre: ','type'=>'text')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono: ','type'=>'text')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-4"><?php echo $this->Form->input('origen',array('label'=>'Origen: ','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
       		<div class="col-md-4"><?php echo $this->Form->input('destino',array('label'=>'Destino: ','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
       		<div class="col-md-2"><?php echo $this->Form->input('barras',array('label'=>'Codigo de barras: ','type'=>'text')); ?></div>
       		<div class="col-md-2"><?php echo $this->Form->input('valor',array('label'=>'Valor: ','type'=>'text','default'=>'0')); ?></div>
		</div>
		<div class="form-group col-md-12">
       		<div class="col-md-12"><?php echo $this->Form->input('guia',array('label'=>'Guia: ','type'=>'select','options'=>$ventasL,'empty'=>'')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<table style="margin-left: 15px;">
		    <tr>
				<th style="text-align:center;">Remesa</th>
				<th style="text-align:center;">Destinatario</th>
				<th style="text-align:center;">Dirección</th>
				<th style="text-align:center;">Destino</th>
				<th style="text-align:center;">Teléfono</th>
				<th style="text-align:center;">Cantidad</th>
				<th style="text-align:center;">Empaque</th>
				<th style="text-align:center;"></th>
		    </tr>
		    <tbody data-bind="foreach: users">
		        <tr>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('remesaId.',array('class'=>'remesaId','type'=>'hidden','data-bind'=>'value: id')); ?>
						<?php echo $this->Form->input('remesa.',array('class'=>'remesa','label'=>false,'type'=>'text','data-bind'=>'value: remesa','readonly'=>'readonly')); ?>
					</td>
					<td class="col-md-3" style="padding:0px;">
						<?php echo $this->Form->input('destinatario.',array('class'=>"destinatario",'label'=>false,'type'=>'text','data-bind'=>'value: destinatario','readonly'=>'readonly')); ?>
					</td>
					<td class="col-md-3" style="padding:0px;">
						<?php echo $this->Form->input('direccion.',array('class'=>'direccion','label'=>false,'type'=>'text','data-bind'=>'value: direccion','readonly'=>'readonly')); ?>
					</td>
					<td class="col-md-3" style="padding:0px;">
						<?php echo $this->Form->input('destino.',array('class'=>"destino",'label'=>false,'type'=>'text','data-bind'=>'value: destino','readonly'=>'readonly')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('telefono.',array('class'=>"telefono",'label'=>false,'type'=>'text','data-bind'=>'value: telefono','readonly'=>'readonly')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('cantidad.',array('label'=>false,'type'=>'text','data-bind'=>'value: cantidad, attr: {id: "cantidadId"+$index()}','readonly'=>'readonly')); ?>
					</td>
					<td class="col-md-1" style="padding:0px;">
						<?php echo $this->Form->input('empaque.',array('class'=>"empaque",'label'=>false,'type'=>'text','data-bind'=>'value: empaque','readonly'=>'readonly')); ?>
					</td>
					<td style="padding:0px;border:none;" class="btn btn-danger" data-bind='click: $root.removeUser'>
						<span class="glyphicon glyphicon-remove"></span>
					</td>
		        </tr>	            
		    </tbody>
		</table>
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
					<th>Cant</th>
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

$.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw ) {
    if ( sNewSource !== undefined && sNewSource !== null ) {
        oSettings.sAjaxSource = sNewSource;
    } 
    if ( oSettings.oFeatures.bServerSide ) {
        this.fnDraw();
        return;
    }
 
    this.oApi._fnProcessingDisplay( oSettings, true );
    var that = this;
    var iStart = oSettings._iDisplayStart;
    var aData = [];
 
    this.oApi._fnServerParams( oSettings, aData ); 
    oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
        that.oApi._fnClearTable( oSettings );
        var aData =  (oSettings.sAjaxDataProp !== "") ?
        that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json; 
        for ( var i=0 ; i<aData.length ; i++ ){
            that.oApi._fnAddData( oSettings, aData[i] );
        }         
        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice(); 
        that.fnDraw(); 
        if ( bStandingRedraw === true ){
            oSettings._iDisplayStart = iStart;
            that.oApi._fnCalculateEnd( oSettings );
            that.fnDraw( false );
        } 
        that.oApi._fnProcessingDisplay( oSettings, false );
        if ( typeof fnCallback == 'function' && fnCallback !== null ){
            fnCallback( oSettings );
        }
    }, oSettings );
};


	var webroot     = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var fullpath    = <?php echo "'".FULL_BASE_URL.Router::url('/')."'" ?>;
	var empaques;
	var ventasL     = <?php echo json_encode($ventasL); ?>;
	var vehiculos   = <?php echo json_encode($vehiculos); ?>;
	var conductores = <?php echo json_encode($conductores); ?>;
	var ajaxCall;
	var oTable;
	var User = function(data) {
	    var self = this;
	    self.id = data.id;
		self.remesa       = data.remesa;
		self.destinatario = data.destinatario;
		self.direccion    = data.direccion;
		self.destino      = data.destino;
		self.telefono     = data.telefono;
		self.cantidad     = data.cantidad;
		self.empaque      = data.empaque;
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
	    viewModel.users.push(new User({id: 0,remesa:"",destinatario:"",direccion:"",destino:"",telefono:"",cantidad:"",empaque:""}));
	};
	viewModel.removeUser = function(selected) {
	    viewModel.users.remove(selected);
	};
	viewModel.removeUserTotal = function() {
	    viewModel.users.removeAll();
	};
	ko.applyBindings(viewModel);


	function sumarValor() {
		valor = 0;
		var actuales = $("#DespachoGuia").val();
		if(actuales != null){
			$.each(actuales, function( key, value ) {
				valor = valor + ajaxCall[value];
			});
		}
		if(valor != 0){
			valor = valor.toFixed(2);
			$("#DespachoValor").attr('readonly','readonly');
		} else {
			$("#DespachoValor").attr('readonly',false);
		}
		$("#DespachoValor").val(valor);
	}

$(document).ready(function(){
	$("#DespachoBarras").keypress(function(e) {
		//console.log(e.which);
		var barras = $(this).val();
		if(e.which == 13) {
			if(ventasL[barras] != undefined){
				$.each(ventas, function( key, value ) {
					if(barras == value.Venta.id){
						var flag = true;
						$.each(viewModel.users(), function( key2, value2 ) {
							if(barras == value2.id && flag){
								flag              = false;
								var valorC        = $("#cantidadId"+key2).val();
								var cantidadArray = valorC.split("/");
								var cantidadNueva = parseInt(cantidadArray[0]) + 1;

								if(cantidadNueva <= value.Venta.cantidad){
									var cantidadN = cantidadNueva+"/"+value.Venta.cantidad;
									$("#cantidadId"+key2).val(cantidadN);
								}
							}
						});
						if(flag){
							var cantidadN2 = "1/"+value.Venta.cantidad;
							viewModel.users.push(new User({id: value.Venta.id,remesa:value.Venta.remesa ,destinatario:value.Venta.nombreDest ,direccion:value.Venta.direccionDest ,destino:value.Venta.destinoN ,telefono:value.Venta.telefonoDest ,cantidad:cantidadN2 ,empaque:value.Venta.empaque }));
						}
					}
				});
			}
			$("#DespachoBarras").val("");
		}
	});
	$("#DespachoNegociador").chosen({
		no_results_text           : 'No se encuentra el negociador.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione el negociador"
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
	$("#DespachoGuia").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione la guia"
	});

	$("#DespachoPlaca").change(function(){
		var placaSel = $("#DespachoPlaca").val();
		$("#DespachoGuia").val("");
		$("#DespachoGuia").trigger("chosen:updated");
		
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
	});

	$("#DespachoGuia").change(function(){
		viewModel.removeUserTotal();
		var guiaSel  = $(this).val();
		var placaSel = $("#DespachoPlaca").val();
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		$.ajax({
			type: 'json',
			url: fullpath+"despachos/getEmpaques/"+placaSel+"/"+guiaSel,
			beforeSend: function(xhr) {
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			},
			success: function(response) {
				response = JSON.parse(response);
				ajaxCall = response;
				oTable.fnReloadAjax(webroot+'sources/empaques_despacho.txt');
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
		var flag  = true;
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	$.each(ajaxCall, function( key, value ) {
	    		if(id == value.Empa.id){
	    			$.each(viewModel.users(), function( key2, value2 ) {
	    				if(id == value2.id && flag){
							flag              = false;
							var valorC        = $("#cantidadId"+key2).val();
							var cantidadArray = valorC.split("/");
							var cantidadNueva = parseInt(cantidadArray[0]) + 1;

							if(cantidadNueva <= value.Empa.cantidad){
								var cantidadN = cantidadNueva+"/"+value.Empa.cantidad;
	    						$("#cantidadId"+key2).val(cantidadN);
							}
	    				}
					});
					if(flag){
						var cantidadN2 = "1/"+value.Empa.cantidad;
						viewModel.users.push(new User({id: value.Empa.id,remesa:value.Empa.remesa ,destinatario:value.Empa.nombreDest ,direccion:value.Empa.direccionDest ,destino:value.Empa.destinoN ,telefono:value.Empa.telefonoDest ,cantidad:cantidadN2 ,empaque:value.Empa.empaque }));
					}
	    		}
				//valor = valor + ajaxCall[value.Venta.id];
			});
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
		"sAjaxSource": webroot+'sources/empaques_despacho.txt',
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
	        { "sWidth": "10%"},
	        { "sWidth": "15%"},
	        { "sWidth": "22%"},
	        { "sWidth": "30%"},
	        { "sWidth": "10%"},
	        { "sWidth": "2%"},
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