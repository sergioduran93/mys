<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('bootstrap.min');
?>
<style type="text/css">
/*	::-webkit-scrollbar {
	    width: 12px;
	}
	::-webkit-scrollbar-thumb {
		-webkit-box-shadow: inset 0 0 6px rgb(137, 137, 137);
		border-radius: 5px;
		background-color: rgb(208, 226, 253);
	}
	::-webkit-scrollbar-track {
		background-color: rgb(244, 244, 244);
	}*/
	.dataTables_scroll{
		width: 100% !important;
	}
	table.table {
	clear: both;
	margin-top: 0px !important;
	margin-bottom: 0px !important;
	max-width: none !important;
	border-collapse: separate;
	}
	table.dataTable,
	table.dataTable td,
	table.dataTable th {
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	}
	.ColVis_collection li{
		width: 20%;
	}
	.ColVis_collection li label{
		float: left;
		padding: 0px 20px;
	}
	.dataTables_wrapper {
		margin-left: 0px;
	}
	.btnTable {
		padding: 4px 10px;
		background: rgb(205, 226, 244);
		color: rgb(65, 77, 94);
		border-radius: 5px;
		font-weight: bold;
	}
</style>
<div class="row" style="width:90%; margin-left:5%;">
	<br>	
		<?php echo $this->Form->create('Ingreso',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<?php echo $this->Form->input('usuario',array('label'=>false,'type'=>'hidden','default'=>$usuario_actual['id'])); ?>
		<?php echo $this->Form->input('oficina',array('label'=>false,'type'=>'hidden','default'=>$usuario_actual['oficina_id'])); ?>
		<div><h3><center>INGRESO DE MERCANCIA</center></h3></div>
		<div class="form-group col-md-12">
			<ul id="myTab" class="nav nav-tabs" style="margin-left: 15px;">
				<li class="active">
					<a href="#Registar" data-toggle="tab" id="registrarTab">Registar</a>
				</li>
				<li class="">
					<a href="#Ver" data-toggle="tab" id="verTab">Listado</a>
				</li>			
			</ul>
		</div>

		<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade active in" id="Registar">
				<div style="padding-left:30px;">
					<div class="form-group col-md-12">
						<div class="bs-callout bs-callout-green" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
							<h4 style="">Conductor</h4>
							<div class="form-group col-md-12">
									<div class="col-md-4"><?php echo $this->Form->input('conductor',array('label'=>'Cedula: ','type'=>'select','options'=>$conductorId,'empty'=>'')); ?></div>
									<div class="col-md-4"><?php echo $this->Form->input('conductornom',array('label'=>'Nombre: ','type'=>'select','options'=>$conductorNom,'empty'=>'')); ?></div>
									<div class="col-md-4"><?php echo $this->Form->input('celular',array('label'=>'Celular: ','type'=>'text')); ?></div>
							</div>
						</div>
					</div>
					<div class="form-group col-md-12">
						<div class="bs-callout bs-callout-info col-md-3" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
							<h4 style="">Auxiliar</h4>
							<div class="form-group col-md-12">
								<div class="col-md-12"><?php echo $this->Form->input('auxiliar',array('label'=>'Nombre: ','type'=>'select','options'=>$auxiliares,'empty'=>'')); ?></div>
							</div>
						</div>
						<div class="bs-callout bs-callout-info col-md-9" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
							<h4 style="">Vehículo</h4>
							<div class="form-group col-md-12">
									<div class="col-md-4"><?php echo $this->Form->input('placa',array('label'=>'Placa: ','select'=>'text','options'=>$vehiculo,'empty'=>'')); ?></div>
									<div class="col-md-4"><?php echo $this->Form->input('tipo',array('label'=>'Tipo: ','type'=>'text')); ?></div>
									<div class="col-md-4"><?php echo $this->Form->input('marca',array('label'=>'Marca: ','type'=>'text')); ?></div>
							</div>
						</div>
					</div>
					<div class="bs-callout bs-callout-gray" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
						<div class="col-md-12" id="contactosId">
						    <table style="margin-left:15px;width:100%;">
						        <tr>
						            <th>NIT</th>
						            <th>Cliente</th>
						            <th>Codigo de Barras</th>
						            <th>Traslado</th>
						            <th></th>
						        </tr>
						        <tbody data-bind="foreach: users">
						            <tr>
						    			<td>
						    				<?php echo $this->Form->input('ingresos.id.',array('data-bind'=>'value: id','label'=>false,'div'=>false,'type'=>'hidden','class'=>'idid')); ?>
						    				<?php echo $this->Form->input('ingresos.nit.',array('data-bind'=>'value: cliente','label'=>false,'div'=>false,'type'=>'text','placeholder'=>"Seleccione el cliente",'class'=>'nit')); ?>
						    			</td>
						    			<td><?php echo $this->Form->input('ingresos.cliente.',array('data-bind'=>'value: cliente','label'=>false,'div'=>false,'type'=>'text','placeholder'=>"Seleccione el cliente",'class'=>'clientes')); ?></td>
						    			<td><?php echo $this->Form->input('ingresos.barras.',array('data-bind'=>'value: barras','label'=>false,'div'=>false,'type'=>'text','placeholder'=>"Codigo de barras",'class'=>'barras')); ?></td>
						    			<td><?php echo $this->Form->input('ingresos.barras2.',array('data-bind'=>'value: barras2','label'=>false,'div'=>false,'type'=>'text','placeholder'=>"Codigo de barras",'class'=>'barras2')); ?></td>
						                <td style="padding:0px;" class="btn btn-danger" data-bind='click: $root.removeUser'>
										<span class="glyphicon glyphicon-remove"></span>
									</td>
						            </tr>
						        </tbody>
						    </table>
						</div>
					</div>
					<div class="col-md-12">
						<?php echo $this->Form->button("Guardar",array('type'=>'buttom',"id"=>"btn-submit","class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
						<?php echo $this->Form->end();?>
					</div>
				</div>
			</div>
			<div class="tab-pane fade in" id="Ver">
				<table id="tabla_id" style="width:100% !important;">
					<thead>
						<tr>
							<th></th>
							<th class="col-actions ui-state-default" style="padding-right:10px;">
								<input style="float:left;width:50%;padding:3px 0px 3px 6px;" placeholder="Desde" type="text" id="fechaDesde">
								<input style="float:left;width:50%;padding:3px 0px 3px 6px;" placeholder="Hasta" type="text" id="fechaHasta">
							</th>
							<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
							<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
							<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
							<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
							<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
							<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
							<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
							<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
						</tr>
						<tr>
							<th>id</th>
							<th>Fecha</th>
							<th>Codigo Barras</th>
							<th>Cliente</th>
							<th>Cliente NIT</th>
							<th>Placa</th>
							<th>Conductor</th>
							<th>Conductor C.C.</th>
							<th>Usuario</th>
							<th>Oficina</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
</div>
<hr class="clearing"/>


<script>


	var User = function(data) {
		var self     = this;
		self.id      = data.id;
		self.nit     = data.nit;
		self.cliente = data.cliente;
		self.barras  = data.barras;
		self.barras2 = data.barras2;
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
	    viewModel.users.push(new User({ id:"",nit:"", cliente:"" , barras:""}));
		$(".clientes").autocomplete({
			source: cliente,
			select: function( event, ui ) {
				var par = $(this).parent().parent();
				par.find(".barras").focus();
				var fin  = par.find(".nit");
				var idid = par.find(".idid");
				$.each( cliente, function( key, value ) {
					if(ui.item.value == value){
						fin.val(nit[key]);
						idid.val(clienteId[key]);
					}
				});
			}
		});
		$(".nit").autocomplete({
			source: nit,
			select: function( event, ui ) {
				var par = $(this).parent().parent();
				par.find(".barras").focus();
				var fin = par.find(".clientes");
				var idid = par.find(".idid");
				$.each( nit, function( key, value ) {
					if(ui.item.value == value){
						fin.val(cliente[key]);
						idid.val(clienteId[key]);
					}
				});
			}
		});
	};
	viewModel.removeUser = function(selected) {
	    viewModel.users.remove(selected);
	};
	viewModel.removeUserTotal = function() {
	    viewModel.users.removeAll();
	};
	ko.applyBindings(viewModel);

	var flag      = 0;
	var cliente   = <?php echo json_encode(array_values($cliente)); ?>;
	var clienteId = <?php echo json_encode(array_keys($cliente)); ?>;
	var nit       = <?php echo json_encode(array_values($clienteNit)); ?>;
	var conCel    = <?php echo json_encode($conductorCel); ?>;
	var vehiMarca = <?php echo json_encode($vehiculoMarca); ?>;
	var vehiTipo  = <?php echo json_encode($vehiculoTipo); ?>;
	var clienAnt = "";
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var oTable;
	var diaActual = <?php echo "'".date("Y-m-d")."'"; ?>;
$.fn.dataTableExt.afnFiltering.push(
    function( oSettings, aData, iDataIndex ) {
		var fechaInicial = $('#fechaDesde').val()+" 00:00:00";
		var fechaFinal   = $('#fechaHasta').val()+" 23:59:59";

		var iMin = "";
		var iMax = "";
		if(fechaInicial != " 00:00:00"){
			iMin = new Date(fechaInicial);
		}
		if(fechaFinal != " 23:59:59"){
			iMax = new Date(fechaFinal);
		}

		var iActual = new Date(aData[0]);

        if ( iMin == "" && iMax == "" ){
            return true;
        }
        else if ( iMin == "" && iActual < iMax ){
            return true;
        }
        else if ( iMin < iActual && "" == iMax ){
            return true;
        }
        else if ( iMin < iActual && iActual < iMax ){
            return true;
        }
        return false;
    }
);
$(document).ready(function(){

	$("#btn-submit").click(function(){
		itsclicked = true;
		$("#IngresoCrearForm").submit();
	});

	viewModel.addUser();

	$('#fechaDesde').datepicker();
    $('#fechaHasta').datepicker();
	$('#fechaDesde').val(diaActual);
    $('#fechaHasta').val(diaActual);
	$('#fechaDesde').change( function() { oTable.fnDraw(); } );
    $('#fechaHasta').change( function() { oTable.fnDraw(); } );

	$(".clientes").autocomplete({
		source: cliente,
		select: function( event, ui ) {
			var par = $(this).parent().parent();
			par.find(".barras").focus();
			var fin  = par.find(".nit");
			var idid = par.find(".idid");
			$.each( cliente, function( key, value ) {
				if(ui.item.value == value){
					fin.val(nit[key]);
					idid.val(clienteId[key]);
				}
			});
		}
	});
	$(".nit").autocomplete({
		source: nit,
		select: function( event, ui ) {
			var par = $(this).parent().parent();
			par.find(".barras").focus();
			var fin = par.find(".clientes");
			var idid = par.find(".idid");
			$.each( nit, function( key, value ) {
				if(ui.item.value == value){
					fin.val(cliente[key]);
					idid.val(clienteId[key]);
				}
			});
		}
	});
	$(document).on("keypress",".barras",function(e){
		if(e.which == 13) {
			var contAux   = 0;
			var valBarras = $(".barras:last").val();
			$.each($(".barras"), function( key, value ) {
				if(valBarras == $(value).val() && valBarras != ""){
					contAux++;
				}
			});
			if(contAux >= 2){
				$(".barras:last").val("");
				alertM("El codigo de barras: "+valBarras+" ya existe.");
				$(".barras:last").blur();
			} else {
				flag = 0;
				idAnt = $(".idid:last").val();
				clienAnt = $(".clientes:last").val();
				nitAnt = $(".nit:last").val();
				viewModel.addUser();
				$(".barras:last").focus();
				$(".clientes:last").val(clienAnt);
				$(".nit:last").val(nitAnt);
				$(".idid:last").val(idAnt);
			}
		}
	});
	$(document).on("keypress",".barras2",function(e){
		if(e.which == 13) {
			flag2 = 0;
			$(".clientes:last").val("TRASLADO");
			$(".nit:last").val("");
			$(".idid:last").val("");
			viewModel.addUser();
			$(".barras2:last").focus();
		}
	});

	$("#IngresoConductor").change(function(){
		var sel = $(this).val();
		$("#IngresoConductornom").val(sel);
		$("#IngresoCelular").val(conCel[sel]);
		$("#IngresoConductornom").trigger("chosen:updated");
	});

	$("#IngresoConductornom").change(function(){
		var sel = $(this).val();
		$("#IngresoConductor").val(sel);
		$("#IngresoCelular").val(conCel[sel]);
		$("#IngresoConductor").trigger("chosen:updated");
	});

	$("#IngresoPlaca").change(function(){
		var sel = $(this).val();
		$("#IngresoMarca").val(vehiMarca[sel]);
		$("#IngresoTipo").val(vehiTipo[sel]);
	});

	$("#IngresoAuxiliar").chosen({
		no_results_text           : 'No se encuentra el auxiliar.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 3,
		placeholder_text_single   : "Seleccione el auxiliar"
	});

	$("#IngresoConductor").chosen({
		no_results_text           : 'No se encuentra el conductor.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 3,
		placeholder_text_single   : "Seleccione el conductor"
	});

	$("#IngresoConductornom").chosen({
		no_results_text           : 'No se encuentra el conductor.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 3,
		placeholder_text_single   : "Seleccione el conductor"
	});

	$("#IngresoPlaca").chosen({
		no_results_text           : 'No se encuentra el vehículo.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 3,
		placeholder_text_single   : "Seleccione el vehículo"
	});

	 oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/ingresoCrear.txt',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage":
		{
			"sProcessing":   "Procesando...",
			"sLengthMenu":   "Ver _MENU_ registros",
			"sZeroRecords":  "No se encontraron resultados",
			"sInfo":         "<span class='btnTable'>Total Unidades: _END_</span>",
			"sInfoEmpty":    "",
			"sInfoFiltered": "",
			"sInfoPostFix":  "",
			"sSearch":       "Buscar:",
			"sUrl":          "",
	    },
		"scrollX": true,
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0] },
			{ "sClass": "col-actions", "aTargets": [1] }
		]
	});

	var asInitVals = new Array();

	$("thead input").keyup( function (){
		oTable.fnFilter(this.value, $("thead input").index(this) );
	});

	$("thead input").each( function (i){
		asInitVals[i] = this.value;
	});

	$("thead input").focus( function (){
		if ( this.className === "search_init" ){
			this.value     = "";
			this.className = "";
		}
	});

	$("thead input").blur( function (i){
		if ( this.value === "" ){
			this.className = "search_init";
			this.value     = asInitVals[$("thead input").index(this)];
		}
	});

	
})

</script>