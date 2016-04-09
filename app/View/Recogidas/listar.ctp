<?php
	echo $this->Html->script('bootstrap-datetimepicker.min');
	echo $this->Html->script('jquery.fancybox');
	echo $this->Html->css('jquery.fancybox');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
?>

<div class="row" style="width:90%; margin-left:5%;">   
	<br>
	<div><h3><center>CONTROL DE RECOGIDAS</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Recogida',array('class'=>'form-inline','action'=>'listar'));?>
	<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>

	<div class="form-group col-md-12">
		<ul id="myTab" class="nav nav-tabs" style="margin-left: 15px;">
			<li class="active">
				<a href="#Registar" data-toggle="tab" id="registrarTab">Registar</a>
			</li>
			<li class="">
				<a href="#Asignar" data-toggle="tab" id="asignarTab">Asignar</a>
			</li>
			<li class="">
				<a href="#Anuladas" data-toggle="tab" id="anularTab">Anuladas</a>
			</li>			
		</ul>
	</div>

	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade active in" id="Registar">			
		    <div class="bs-callout bs-callout-gray" style="margin: 0px 0px 5px 30px;padding:2px;">
				<h4 style="float:left;">Datos del cliente</h4>
				<?php echo $this->Form->input('otro_remitente',array('label'=>'Otro remitente','type'=>'checkbox','style'=>'margin-left:20px;')); ?>
				<?php echo $this->Form->input('verTabla',array('label'=>'Ver tabla','type'=>'checkbox','style'=>'margin-left:20px;')); ?>
				<div class="form-group col-md-12">
					<div class="col-md-3"><?php echo $this->Form->input('clienteCc',array('label'=>'CC/NIT:','type'=>'text','placeholder'=>'Selecione un cliente')); ?></div>
					<div class="col-md-6"><?php echo $this->Form->input('clienteNom',array('label'=>'Nombre:','type'=>'text','class'=>'required','placeholder'=>'Selecione un cliente')); ?></div>
					<div class="col-md-3"><?php echo $this->Form->input('clienteTel',array('label'=>'Telefono:','type'=>'text')); ?></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-3"><?php echo $this->Form->input('clienteDir',array('label'=>'Dirección:','type'=>'text')); ?></div>
					<div class="col-md-3"><?php echo $this->Form->input('clienteCiu',array('label'=>'Ciudad:','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
					<div class="col-md-3"><?php echo $this->Form->input('llamo',array('label'=>'Llamó:','type'=>'text')); ?></div>
					<div class="col-md-3" id="remiDiv"><?php echo $this->Form->input('remitente',array('label'=>'Remitente:','type'=>'text','placeholder'=>'Selecione un remitente')); ?></div>
				</div>
		    </div>
		    <div id="divClientesTable">
			    <table id="clientesTable">
					<thead> 
						<tr>
							<th>id</th>
							<th>Documento</th>
							<th>Nombre</th>
							<th>Telefono</th>
							<th>Telefono2</th>
							<th>Dirección</th>
							<th>Celular</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		    <div class="bs-callout bs-callout-info" style="margin: 0px 0px 0px 30px;padding:2px;">
				<h4>Datos de Recogida</h4>
				<div class="form-group col-md-12">
					<div class="col-md-4"><?php echo $this->Form->input('direccion',array('label'=>'Dirección:','type'=>'text')); ?></div>
					<div class="col-md-4"><?php echo $this->Form->input('telefono',array('label'=>'Teléfono:','type'=>'text')); ?></div>
					<div class="col-md-4"><?php echo $this->Form->input('ciudad',array('label'=>'Ciudad:','type'=>'select','options'=>$destinos,'empty'=>'')); ?></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-3"><?php echo $this->Form->input('cargo',array('label'=>'Cargo:','type'=>'text')); ?></div>
					<div class="col-md-9"><?php echo $this->Form->input('preguntar',array('label'=>'Preguntar x:','type'=>'text')); ?></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-3"><?php echo $this->Form->input('cantidad',array('label'=>'Cantidad:','type'=>'text')); ?></div>
					<div class="col-md-9"><?php echo $this->Form->input('detalle',array('label'=>'Detalle:','type'=>'text')); ?></div>
				</div>
				<div class="form-group col-md-12">
					<div class="col-md-3" id="time1"><?php echo $this->Form->input('desde',array('label'=>'Hora (Desde):','type'=>'text','class'=>'add-on','data-format'=>'HH:mm PP','placeholder'=>'Click para selecionar la hora')); ?></div>
					<div class="col-md-3" id="time2"><?php echo $this->Form->input('hasta',array('label'=>'Hora (Hasta):','type'=>'text','class'=>'add-on','data-format'=>'HH:mm PP','placeholder'=>'Click para selecionar la hora')); ?></div>
					<div class="col-md-3"><?php echo $this->Form->input('fecha',array('label'=>'Fecha recoger:','type'=>'text')); ?></div>
					<div class="col-md-3"><?php echo $this->Form->input('hora',array('label'=>'Hora(Llamada):','type'=>'text','default'=>$horaActual,'readonly'=>'readonly')); ?></div>
				</div>
			    <div class="form-group col-md-12" style="margin-left: 15px;">
			    	<?php echo $this->Form->input('observaciones',array('label'=>'Observaciones:','type'=>'textarea','style'=>'height:38px;width:97%;')); ?>
			    </div>
			</div>
					
		    <table id="tabla_id">
				<thead> 
					<tr>
						<th>id</th>
						<th>Hora</th>
						<th>Fecha</th>
						<th>Dirección</th>
						<th>Cliente</th>
						<th>Cant.</th>
						<th>Preguntar x</th>
						<th>Telefono</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<?php echo $this->Form->button('Registrar',array('class'=>'pull-right btn btn-primary'));?>
			<?php echo $this->Form->end();?>
		</div>
		
		<div class="tab-pane fade" id="Asignar">
			<div class="form-group col-md-12">
				<?php echo $this->Form->input('verTabla2',array('label'=>'Ver tabla','type'=>'checkbox','style'=>'margin-left:20px;margin-top: 25px;')); ?>
				<div class="form-group col-md-6 pull-right">
					<div class="col-md-4"><?php echo $this->Form->input('inicio',array('label'=>'Fecha Inicio: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$fechaUnMesA)); ?></div>
					<div class="col-md-4"><?php echo $this->Form->input('final',array('label'=>'Fecha Final: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$fechaActual)); ?></div>
					<div class="col-md-4"><?php echo $this->Form->button("Consultar x fecha",array('id'=>'btn-buscar','style'=>'margin-top: 25px;',"class"=>'btn-primary','type'=>'button'));?></div>
				</div>
			</div>
	    	<div id="asignado" class="bs-callout bs-callout-info" style="margin: 0px 0px 0px 30px;padding:2px;">
				<div class="form-group col-md-12">
					<h4 class="col-md-1">Hora:</h4>
					<h4 id="contHora" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Fecha:</h4>
					<h4 id="contFecha" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Dirección:</h4>
					<h4 id="contDir" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Cliente:</h4>
					<h4 id="contClie" style="color:#3F4E61;" class="col-md-2"></h4>
				</div>
				<div class="form-group col-md-12">
					<h4 class="col-md-1">Cantidad:</h4>
					<h4 id="contCant" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Preguntar:</h4>
					<h4 id="contPreg" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Telefono:</h4>
					<h4 id="contTele" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Detalle:</h4>
					<h4 id="contDeta" style="color:#3F4E61;" class="col-md-2"></h4>
				</div>
			</div>
			<?php echo $this->Form->create('Recogida',array('class'=>'form-inline','action'=>'listar2'));?>
			<?php echo $this->Form->input('id3',array('type'=>'hidden')); ?>
			<div class="form-group col-md-12">
				<div class="col-md-3"><?php echo $this->Form->input('placa',array('label'=>'Placa vehiculo:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('conductor_id',array('label'=>'Conductor CC:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('conductor_nombre',array('label'=>'Conductor Nombres:','type'=>'text')); ?></div>
				<div class="col-md-3"><?php echo $this->Form->input('hora_asig',array('label'=>'Hora:','type'=>'text','default'=>$horaActual,'readonly'=>'readonly')); ?></div>
			</div>
			<div class="form-group col-md-12" style="margin-left: 15px;">
		    	<?php echo $this->Form->input('observaciones2',array('label'=>'Observaciones:','type'=>'textarea','style'=>'height:38px;width:97%;')); ?>
		    </div>
		    <div id="divVehiculoTable">
			    <table cellpadding="0" cellspacing="0" border="0" class="" id="vehiculosTabla">
					<thead>
						<tr>
							<th>id</th>
							<th>Placa</th>
							<th>Tipo</th>
							<th>Marca</th>
							<th>Modelo</th>
							<th>Nro Motor</th>
							<th>Nro Chasis</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<center><h4>Recogidas Asignadas</h4></center>
			<table id="tabla_id2">
				<thead> 
					<tr>
						<th>id</th>
						<th>Hora</th>
						<th>Fecha</th>
						<th>Dirección</th>
						<th>Cliente</th>
						<th>Cant.</th>
						<th>Preguntar x</th>
						<th>Telefono</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>			
			<?php echo $this->Form->button('Asignar',array('class'=>'pull-right btn btn-primary'));?>
			<?php echo $this->Form->end();?>
		</div>
		<div class="tab-pane fade" id="Anuladas">
			<?php echo $this->Form->create('Recogida',array('class'=>'form-inline','action'=>'listar3'));?>
			<?php echo $this->Form->input('id2',array('type'=>'hidden')); ?>
			<div id="anulado" class="bs-callout bs-callout-info" style="margin: 0px 0px 0px 30px;padding:2px;">
				<div class="form-group col-md-12">
					<h4 class="col-md-1">Hora:</h4>
					<h4 id="contHora2" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Fecha:</h4>
					<h4 id="contFecha2" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Dirección:</h4>
					<h4 id="contDir2" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Cliente:</h4>
					<h4 id="contClie2" style="color:#3F4E61;" class="col-md-2"></h4>
				</div>
				<div class="form-group col-md-12">
					<h4 class="col-md-1">Cantidad:</h4>
					<h4 id="contCant2" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Preguntar:</h4>
					<h4 id="contPreg2" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Telefono:</h4>
					<h4 id="contTele2" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Detalle:</h4>
					<h4 id="contDeta2" style="color:#3F4E61;" class="col-md-2"></h4>
				</div>
				<div class="form-group col-md-12">
					<h4 class="col-md-1">Placa:</h4>
					<h4 id="contPlaca2" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Conductor CC:</h4>
					<h4 id="contCondId2" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Conductor:</h4>
					<h4 id="contCondNom2" style="color:#3F4E61;" class="col-md-2"></h4>
					<h4 class="col-md-1">Obs:</h4>
					<h4 id="contObs2" style="color:#3F4E61;" class="col-md-2"></h4>
				</div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-md-6"><?php echo $this->Form->input('anulo',array('type'=>'text')); ?></div>
				<div class="col-md-6"><?php echo $this->Form->input('novedad',array('type'=>'select','options'=>$novedades)); ?></div>
			</div>
			<table id="tabla_id3">
				<thead> 
					<tr>
						<th>id</th>
						<th>Hora</th>
						<th>Fecha</th>
						<th>Dirección</th>
						<th>Cliente</th>
						<th>Cant.</th>
						<th>Preguntar x</th>
						<th>Telefono</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<?php echo $this->Form->button('Anular',array('class'=>'pull-right btn btn-primary'));?>
			<?php echo $this->Form->end();?>

		</div>
	</div>

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

	var webroot              = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url                  = <?php echo "'".Router::url('/')."recogidas'"; ?>;
	var orden                = <?php echo json_encode($orden); ?>;
	var clientes             = <?php echo json_encode($clientes); ?>;
	var clientesC            = <?php echo json_encode($clientesC); ?>;
	var remitentes           = <?php echo json_encode($remitentes); ?>;
	var remitenteC           = <?php echo json_encode($remitenteC); ?>;
	var conductores          = <?php echo json_encode($conductores); ?>;
	var vehiculos            = <?php echo json_encode($vehiculos); ?>;
	var recogidasRegistradas = <?php echo json_encode($recogidasRegistradas); ?>;
	var recogidasAsignadas   = <?php echo json_encode($recogidasAsignadas); ?>;
	var recogidasAnuladas    = <?php echo json_encode($recogidasAnuladas); ?>;
	var roleId               = <?php echo $usuario_actual['role_id']; ?>;
	var clientesNit          = new Array();
	var remitentesNombre     = new Array();
	var clientesNombre       = new Array();
	var vehiculosPlaca       = new Array();
	var conductoresInfo      = new Array();
	var isVehiculo           = true;
    function asignarFun (idr) {
    	$.each( recogidasRegistradas, function( key, value ) {
			if(idr == value.Recogida.id){
				$("#contDeta").text(value.Recogida.detalle);
				$("#contTele").text(value.Recogida.telefono);
				$("#contPreg").text(value.Recogida.preguntar);
				$("#contCant").text(value.Recogida.cantidad);
				$("#contClie").text(value.Recogida.clienteNom);
				$("#contDir").text(value.Recogida.direccion);
				$("#contFecha").text(value.Recogida.fecha);
				$("#contHora").text(value.Recogida.desde+"   "+value.Recogida.hasta);
				$("#RecogidaId3").val(value.Recogida.id);
			}
		});
		$("#asignado").show();
		$('#asignarTab').tab('show');
    }
    function anularJs (idr) {
		/*var nombreAnula = prompt("Por favor escribir el NOMBRE de la persona que CANCELO la recogida","");
		if(nombreAnula != null){
			$("#RecogidaId2").val(idr);
			$("#RecogidaAnulo").val(nombreAnula);
			$("#RecogidaListar3Form").submit();
		}*/
		var reco = true;
		$.each( recogidasRegistradas, function( key, value ) {
			if(idr == value.Recogida.id){
				reco = false;
				$("#contPlaca2").text("");
				$("#contCondId2").text("");
				$("#contCondNom2").text("");
				$("#contObs2").text("");
				$("#contDeta2").text(value.Recogida.detalle);
				$("#contTele2").text(value.Recogida.telefono);
				$("#contPreg2").text(value.Recogida.preguntar);
				$("#contCant2").text(value.Recogida.cantidad);
				$("#contClie2").text(value.Recogida.clienteNom);
				$("#contDir2").text(value.Recogida.direccion);
				$("#contFecha2").text(value.Recogida.fecha);
				$("#contHora2").text(value.Recogida.hora);
				$("#RecogidaId3").val(value.Recogida.id);
			}
		});
		if(reco){
			$.each( recogidasAnuladas, function( key, value ) {
				if(idr == value.Recogida.id){
					$("#contPlaca2").text(value.Recogida.placa);
					$("#contCondId2").text(value.Recogida.conductor_id);
					$("#contCondNom2").text(value.Recogida.conductor_nombre);
					$("#contObs2").text(value.Recogida.observaciones2);
					$("#contDeta2").text(value.Recogida.detalle);
					$("#contTele2").text(value.Recogida.telefono);
					$("#contPreg2").text(value.Recogida.preguntar);
					$("#contCant2").text(value.Recogida.cantidad);
					$("#contClie2").text(value.Recogida.clienteNom);
					$("#contDir2").text(value.Recogida.direccion);
					$("#contFecha2").text(value.Recogida.fecha);
					$("#contHora2").text(value.Recogida.hora);
					$("#RecogidaId3").val(value.Recogida.id);
				}
			});
		}
		$("#anulado").show();
		$('#anularTab').tab('show');
    }

$(document).ready(function(){
	if(roleId == 5 || roleId == 3){
		$("#asignarTab").hide();
		$("#anularTab").hide();
	}

	$("#divClientesTable").hide();
	$("#divVehiculoTable").hide();
	$("#remiDiv").hide();

	$("#RecogidaVerTabla").change(function () {
		if($(this).is(':checked')){
			$("#divClientesTable").show();
		} else {
			$("#divClientesTable").hide();
		}
	});
	$("#verTabla2").change(function () {
		if($(this).is(':checked')){
			$("#divVehiculoTable").show();
		} else {
			$("#divVehiculoTable").hide();
		}
	});
	$("#RecogidaOtroRemitente").change(function () {
		if($(this).is(':checked')){
			$("#remiDiv").show();
		} else {
			$("#remiDiv").hide();
		}
	});
	$("#RecogidaPlaca").focus(function () {
		isVehiculo = true;
		oTable2.fnSettings().aoColumns[1].nTh.innerHTML = 'Placa';
		oTable2.fnSettings().aoColumns[2].nTh.innerHTML = 'Tipo';
		oTable2.fnSettings().aoColumns[3].nTh.innerHTML = 'Marca';
		oTable2.fnSettings().aoColumns[4].nTh.innerHTML = 'Modelo';
		oTable2.fnSettings().aoColumns[5].nTh.innerHTML = 'Nro Motor';
		oTable2.fnSettings().aoColumns[6].nTh.innerHTML = 'Nro Chasis';
		oTable2.fnReloadAjax(webroot+'sources/vehiculos.txt');
	});
	$("#RecogidaConductorId").focus(function () {
		isVehiculo = false;
		oTable2.fnSettings().aoColumns[1].nTh.innerHTML = 'Identificación';
		oTable2.fnSettings().aoColumns[2].nTh.innerHTML = 'Nombre';
		oTable2.fnSettings().aoColumns[3].nTh.innerHTML = 'Ciudad';
		oTable2.fnSettings().aoColumns[4].nTh.innerHTML = 'Telefono';
		oTable2.fnSettings().aoColumns[5].nTh.innerHTML = 'Celular';
		oTable2.fnSettings().aoColumns[6].nTh.innerHTML = 'Dirección';
		oTable2.fnReloadAjax(webroot+'sources/conductores.txt');
	});

	$("#asignado").hide();
	$("#anulado").hide();
	$("#RecogidaCiudad").chosen({
		no_results_text           : 'No se encuentra la ciudad.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione la ciudad"
	});
	$("#RecogidaClienteCiu").chosen({
		no_results_text           : 'No se encuentra la ciudad.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 10,
		placeholder_text_single   : "Seleccione la ciudad"
	});
	
/*	if(orden == 1){
		$('#registrarTab').tab('show');
	} else if(orden == 2){
		$('#asignarTab').tab('show');
	} else if(orden == 3){
		$('#anularTab').tab('show');
	}
*/
	$.each( clientes, function( key, value ) {
		clientesNit[key] = value.Cliente.documento;
	});
	$.each( clientes, function( key, value ) {
		clientesNombre[key] = value.Cliente.listNombre;
	});
	$.each( vehiculos, function( key, value ) {
		vehiculosPlaca[key] = value.Vehiculo.placa;
	});
	$.each( conductores, function( key, value ) {
		conductoresInfo[key] = value.Conductor.identificacion;
	});
	
	$("#RecogidaFecha").datepicker({minDate: 0});
	$("#RecogidaInicio").datepicker();
	$("#RecogidaFinal").datepicker();

	$('#time1').datetimepicker({
		language: 'en',
		pickDate: false,
		pickSeconds: false,
		pick12HourFormat: true
	});
	$('#time2').datetimepicker({
		language: 'en',
		pickDate: false,
		pickSeconds: false,
		pick12HourFormat: true
	});

	$(function() {
		$( "#RecogidaClienteCc" ).autocomplete({
			source: clientesNit,
			select: function( event, ui ) {
				$.each( clientes, function( key, value ) {
					if(ui.item.value == value.Cliente.documento){
						$('#RecogidaClienteNom').val(value.Cliente.listNombre);
						$('#RecogidaClienteTel').val(value.Cliente.telefono);
						$('#RecogidaClienteDir').val(value.Cliente.direccion);
						$('#RecogidaClienteCiu').val(value.Cliente.ciudad);
						$("#RecogidaClienteCiu").trigger("chosen:updated");
						var remitentNombre = new Array();
						$.each( value.Cliente.remitentes, function( key2, value2 ) {
							remitentNombre[key2] = remitentes[value2].Remitente.nombre;
						});
						$("#RecogidaRemitente").autocomplete('option', 'source', remitentNombre);
						$("#RecogidaDireccion").val(value.Cliente.direccion);
						$("#RecogidaTelefono").val(value.Cliente.telefono);
						$("#RecogidaCiudad").val(value.Cliente.ciudad);
						$("#RecogidaCiudad").trigger("chosen:updated");
						var contactos   = JSON.parse(clientesC[value.Cliente.id]);
						if(contactos.length > 0){
							$("#RecogidaPreguntar").val(contactos[0].nombre);
							$("#RecogidaCargo").val(contactos[0].cargo);
						}
					}
				});
			}
		});
		$( "#RecogidaClienteNom" ).autocomplete({
			source: clientesNombre,
			select: function( event, ui ) {
				$.each( clientes, function( key, value ) {
					if(ui.item.value == value.Cliente.listNombre){
						$('#RecogidaClienteCc').val(value.Cliente.documento);
						$('#RecogidaClienteTel').val(value.Cliente.telefono);
						$('#RecogidaClienteDir').val(value.Cliente.direccion);
						$('#RecogidaClienteCiu').val(value.Cliente.ciudad);
						$("#RecogidaClienteCiu").trigger("chosen:updated");
						var remitentNombre = new Array();
						$.each( value.Cliente.remitentes, function( key2, value2 ) {
							remitentNombre[key2] = remitentes[value2].Remitente.nombre;
						});
						$("#RecogidaRemitente").autocomplete('option', 'source', remitentNombre);

						$("#RecogidaDireccion").val(value.Cliente.direccion);
						$("#RecogidaTelefono").val(value.Cliente.telefono);
						$("#RecogidaCiudad").val(value.Cliente.ciudad);
						$("#RecogidaCiudad").trigger("chosen:updated");
						var contactos   = JSON.parse(clientesC[value.Cliente.id]);
						if(contactos.length > 0){
							$("#RecogidaPreguntar").val(contactos[0].nombre);
							$("#RecogidaCargo").val(contactos[0].cargo);
						}
					}
				});
			}
		});
		$("#RecogidaPlaca").autocomplete({
			source: vehiculosPlaca
		});
		$( "#RecogidaConductorId" ).autocomplete({
			source: conductoresInfo,
			select: function( event, ui ) {
				$.each( conductores, function( key, value ) {
					if(ui.item.value == value.Conductor.identificacion){
						$('#RecogidaConductorNombre').val(value.Conductor.listNombre);
					}
				});
			}
		});
		$("#RecogidaRemitente" ).autocomplete({
			source: remitentesNombre,
			select: function( event, ui ) {
				$.each( remitentes, function( key, value ) {
					if(ui.item.value == value.Remitente.nombre){
						var remitenteId = value.Remitente.id;
						$("#RecogidaDireccion").val(remitentes[remitenteId].Remitente.direccion);
						$("#RecogidaTelefono").val(remitentes[remitenteId].Remitente.telefono);
						$("#RecogidaCiudad").val(remitentes[remitenteId].Remitente.ciudad);
						$("#RecogidaCiudad").trigger("chosen:updated");
						var contactos   = JSON.parse(remitenteC[remitenteId]);
						if(contactos.length > 0){
							$("#RecogidaPreguntar").val(contactos[0].nombre);
							$("#RecogidaCargo").val(contactos[0].cargo);
						}
					}
				});
			}
		});
	});
	$('#clientesTable').on('click', 'tr', function(event) {
		var aData = oTable.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	$.each( clientes, function( key, value ) {
				if(id == value.Cliente.id){
					$('#RecogidaClienteNom').val(value.Cliente.listNombre);
					$('#RecogidaClienteTel').val(value.Cliente.telefono);
					$('#RecogidaClienteDir').val(value.Cliente.direccion);
					$('#RecogidaClienteCiu').val(value.Cliente.ciudad);
					$("#RecogidaClienteCiu").trigger("chosen:updated");
					var remitentNombre = new Array();
					$.each( value.Cliente.remitentes, function( key2, value2 ) {
						remitentNombre[key2] = remitentes[value2].Remitente.nombre;
					});
					$("#RecogidaRemitente").autocomplete('option', 'source', remitentNombre);
					$("#RecogidaDireccion").val(value.Cliente.direccion);
					$("#RecogidaTelefono").val(value.Cliente.telefono);
					$("#RecogidaCiudad").val(value.Cliente.ciudad);
					$("#RecogidaCiudad").trigger("chosen:updated");
					var contactos   = JSON.parse(clientesC[value.Cliente.id]);
					if(contactos.length > 0){
						$("#RecogidaPreguntar").val(contactos[0].nombre);
						$("#RecogidaCargo").val(contactos[0].cargo);
					}
				}
			});
	    }
	});
	$('#vehiculosTabla').on('click', 'tr', function(event) {
		var aData = oTable2.fnGetData(this);
		if (null != aData) {
	    	var id = aData[0].replace(/(&nbsp;)*/g,"");
	    	if(isVehiculo){
	    		$.each( vehiculos, function( key, value ) {
					if(id == value.Vehiculo.id){
						$("#RecogidaPlaca").val(value.Vehiculo.placa);
					}
				});
	    	} else {
	    		$.each( conductores, function( key, value ) {
					if(id == value.Conductor.id){
						$("#RecogidaConductorId").val(value.Conductor.identificacion);
						$("#RecogidaConductorNombre").val(value.Conductor.listNombre);
					}
				});
	    	}
	    	
	    }
	});

	$('#tabla_id').on('click', 'tr', function(event) {
		var aData = oTableRegistradas.fnGetData(this);
		if (null != aData) {
			var id = aData[0].replace(/(&nbsp;)*/g,"");
			$.each( recogidasRegistradas, function( key, value ) {
				if(id == value.Recogida.id){
					$("#RecogidaClienteCc").val(value.Recogida.clienteCc);
					$("#RecogidaClienteNom").val(value.Recogida.clienteNom);
					$("#RecogidaClienteTel").val(value.Recogida.clienteTel);
					$("#RecogidaClienteDir").val(value.Recogida.clienteDir);
					$("#RecogidaClienteCiu").val(value.Recogida.clienteCiu);
					$("#RecogidaLlamo").val(value.Recogida.llamo);
					$("#RecogidaDireccion").val(value.Recogida.direccion);
					$("#RecogidaPreguntar").val(value.Recogida.preguntar);
					$("#RecogidaCargo").val(value.Recogida.cargo);
					$("#RecogidaTelefono").val(value.Recogida.telefono);
					$("#RecogidaObservaciones").val(value.Recogida.observaciones);
					$("#RecogidaCantidad").val(value.Recogida.cantidad);
					$("#RecogidaDetalle").val(value.Recogida.detalle);
					$("#RecogidaDesde").val(value.Recogida.desde);
					$("#RecogidaHasta").val(value.Recogida.hasta);
					$("#RecogidaFecha").val(value.Recogida.fecha);
					$("#RecogidaHora").val(value.Recogida.hora);
					$("#RecogidaCiudad").val(value.Recogida.ciudad);
					$('#RecogidaClienteCiu').val(value.Recogida.clienteCiu);
					$("#RecogidaRemitente").val(value.Recogida.remitente);
					$("#RecogidaClienteCiu").trigger("chosen:updated");
					$("#RecogidaCiudad").trigger("chosen:updated");
				}
			});
		}
	});
	$('#tabla_id2').on('click', 'tr', function(event) {
		var aData = oTableAsignadas.fnGetData(this);
		if (null != aData) {
			var id = aData[0].replace(/(&nbsp;)*/g,"");
			$.each( recogidasAsignadas, function( key, value ) {
				if(id == value.Recogida.id){
					$("#RecogidaPlaca").val(value.Recogida.placa);
					$("#RecogidaConductorId").val(value.Recogida.conductor_id);
					$("#RecogidaConductorNombre").val(value.Recogida.conductor_nombre);
					$("#RecogidaHoraAsig").val(value.Recogida.hora_asig);
					$("#RecogidaObservaciones2").val(value.Recogida.observaciones2);
					$("#contDeta").text(value.Recogida.detalle);
					$("#contTele").text(value.Recogida.telefono);
					$("#contPreg").text(value.Recogida.preguntar);
					$("#contCant").text(value.Recogida.cantidad);
					$("#contClie").text(value.Recogida.clienteNom);
					$("#contDir").text(value.Recogida.direccion);
					$("#contFecha").text(value.Recogida.fecha);
					$("#contHora").text(value.Recogida.hora);
					$("#RecogidaId2").val(value.Recogida.id);
					$("#asignado").show();
				}
			});
		}
	});
	$('#tabla_id3').on('click', 'tr', function(event) {
		var aData = oTableAnuladas.fnGetData(this);
		if (null != aData) {
			var id = aData[0].replace(/(&nbsp;)*/g,"");
			$.each( recogidasAnuladas, function( key, value ) {
				if(id == value.Recogida.id){
					$("#RecogidaAnulo").val(value.Recogida.anulo);
					$("#RecogidaNovedad").val(value.Recogida.novedad);
					if(value.Recogida.placa != null){
						$("#contPlaca2").text(value.Recogida.placa);
						$("#contCondId2").text(value.Recogida.conductor_id);
						$("#contCondNom2").text(value.Recogida.conductor_nombre);
						$("#contObs2").text(value.Recogida.observaciones2);
					} else {
						$("#contPlaca2").text("");
						$("#contCondId2").text("");
						$("#contCondNom2").text("");
						$("#contObs2").text("");
					}
					$("#contDeta2").text(value.Recogida.detalle);
					$("#contTele2").text(value.Recogida.telefono);
					$("#contPreg2").text(value.Recogida.preguntar);
					$("#contCant2").text(value.Recogida.cantidad);
					$("#contClie2").text(value.Recogida.clienteNom);
					$("#contDir2").text(value.Recogida.direccion);
					$("#contFecha2").text(value.Recogida.fecha);
					$("#contHora2").text(value.Recogida.hora);
					$("#RecogidaId3").val(value.Recogida.id);
					$("#anulado").show();
				}
			});
		}
	});
	$('#tabla_id, #tabla_id2, #tabla_id3, #clientesTable, #vehiculosTabla').css('cursor', 'pointer');
	var odd = false;
	var even = false;
	$('#tabla_id, #tabla_id2, #tabla_id3, #clientesTable, #vehiculosTabla').on('mouseenter', 'tr', function(event) {
		if ($(this).hasClass("odd")){
			odd = true;
			$(this).removeClass('odd').addClass('row-select');
		}
		if ($(this).hasClass("even")){
			even = true;
			$(this).removeClass('even').addClass('row-select');
		}
	});
	$('#tabla_id, #tabla_id2, #tabla_id3, #clientesTable, #vehiculosTabla').on('mouseleave', 'tr', function(event) {
		if (odd){
			odd = false;
			$(this).removeClass('row-select').addClass('odd');
		}
		if (even){
			even = false;
			$(this).removeClass('row-select').addClass('even');
		}
	});

	var oTable = $('#clientesTable').dataTable( {
		"sAjaxSource": webroot+'sources/clientes.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"bFilter": true,
		"aaSorting": [[ 2, "asc" ]],
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6] },
			{ "sClass": "col-actions", "aTargets": [0] }
		],
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "7%"},
	        { "sWidth": "16%"},
	        { "sWidth": "18%"},
	        { "sWidth": "18%"},
	        { "sWidth": "10%"},
	        { "sWidth": "8%"}
	    ],
	});

	var oTable2 = $('#vehiculosTabla').dataTable( {
		"sAjaxSource": webroot+'sources/vehiculos.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"bFilter": true,
		"aaSorting": [[ 2, "asc" ]],
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6] },
			{ "sClass": "col-actions", "aTargets": [0] }
		],
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "7%"},
	        { "sWidth": "16%"},
	        { "sWidth": "18%"},
	        { "sWidth": "18%"},
	        { "sWidth": "10%"},
	        { "sWidth": "8%"}
	    ],
	});

	var oTableRegistradas = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/recogidasRegistradas.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a id="recogida_id'+aData[0]+'" class="btn btn-info" style="padding:0px;" title="Asignar" href="javascript:;" onclick="asignarFun('+aData[0]+')"><span class="glyphicon glyphicon-user"></span></a></nav>';
			html += '<a class="btn btn-warning" style="padding:0px;" title="Anular" href="javascript:;" onclick="anularJs('+aData[0]+')"><span class="glyphicon glyphicon-ban-circle"></span></a></nav>';
			jQuery('td:eq(7)', nRow).html(html);
			return nRow;
		},
		"fnInitComplete": function() {
			if(roleId == 5){
				$("#tabla_id_wrapper").hide();
			}
		},
		"bFilter": true,
		"aaSorting": [[ 2, "asc" ]],
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7,8] },
			{ "sClass": "col-actions", "aTargets": [0] }
		],
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "7%"},
	        { "sWidth": "16%"},
	        { "sWidth": "18%"},
	        { "sWidth": "18%"},
	        { "sWidth": "7%"},
	        { "sWidth": "14%"},
	        { "sWidth": "10%"},
	        { "sWidth": "10%"}
	    ],
	});

	var oTableAsignadas = $('#tabla_id2').dataTable( {
		"sAjaxSource": webroot+'sources/recogidasAsignadas.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a class="btn btn-info" style="padding:0px;" title="Desasignar" href="'+url+'/desasignar/'+aData[0]+'" onclick="return confirm(\'La recogida se desasignara.\');"><span class="glyphicon glyphicon-arrow-left"></span></a></nav>';
			html += '<a class="btn btn-warning" style="padding:0px;" title="Anular" href="javascript:;" onclick="anularJs('+aData[0]+')"><span class="glyphicon glyphicon-ban-circle"></span></a></nav>';
			jQuery('td:eq(7)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7,8] },
			{ "sClass": "col-actions", "aTargets": [0] }
		],
	    "aoColumns": [
			{ "sWidth": "0%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "19.5%"},
			{ "sWidth": "5.5%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "12.5%"}
	    ],
	});

	var oTableAnuladas = $('#tabla_id3').dataTable( {
		"sAjaxSource": webroot+'sources/recogidasAnuladas.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,

		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a class="btn btn-danger" style="padding:0px;" title="Eliminar" href="'+url+'/eliminar/'+aData[0]+'" onclick="return confirm(\'&iquest;Esta seguro de eliminar la recogida ?\');"><span class="glyphicon glyphicon-remove-sign"></span></a></nav>';
			jQuery('td:eq(7)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,1,2,3,4,5,6,7,8] },
			{ "sClass": "col-actions", "aTargets": [0] }
		],
	    "aoColumns": [
			{ "sWidth": "0%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "19.5%"},
			{ "sWidth": "5.5%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "12.5%"},
			{ "sWidth": "12.5%"}
	    ],
	});

	})
</script>