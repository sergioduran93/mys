<?php 
	echo $this->Html->css('chosen');
	echo $this->Html->script('knockout');
	echo $this->Html->script('knockout.mapping');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('reorder');
	echo $this->Html->script('bootstrap.min');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
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
	<div><h3><center>MOVILIZACIÓN POR CONDUCTOR</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('informe',array('type'=>'hidden')); ?>
	<div class="form-group col-md-12">
		<div class="col-md-3"><?php echo $this->Form->input('desde',array('label'=>'Desde: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$desde)); ?></div>
		<div class="col-md-3"><?php echo $this->Form->input('hasta',array('label'=>'Hasta: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$hasta)); ?></div>
		<div class="col-md-2">
			<?php echo $this->Form->button("Consultar",array("class"=>'btn btn-primary',"style"=>'margin-top: 20px','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
		</div>
	</div>
	<div class="bs-callout bs-callout-info" style="margin:2px 0px 2px 0px;padding: 0px 5px;">
		<h4>Conductor</h4>
		<div class="form-group col-md-12">
			<div class="col-md-3"><?php echo $this->Form->input('conducD',array('label'=>'Cedula: ','type'=>'select','options'=>$conducD,'empty'=>"")); ?></div>
			<div class="col-md-3"><?php echo $this->Form->input('conducT',array('label'=>'Nombre: ','type'=>'select','options'=>$conducT,'empty'=>"")); ?></div>
			<div class="col-md-3"><?php echo $this->Form->input('direccion',array('label'=>'Dirección: ','type'=>'text','readonly'=>'readonly')); ?></div>
			<div class="col-md-3"><?php echo $this->Form->input('telefono',array('label'=>'Telefono: ','type'=>'text','readonly'=>'readonly')); ?></div>
		</div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-3"><?php echo $this->Form->input('tipo',array('label'=>'Forma Pago: ','type'=>'select','options'=>$tipo,'empty'=>"")); ?></div>
		<div class="col-md-3"><?php echo $this->Form->input('destino',array('label'=>'Destino: ','type'=>'select','options'=>$areasL,'empty'=>"")); ?></div>
		<div class="col-md-3"><?php echo $this->Form->input('origen',array('label'=>'Origen: ','type'=>'select','options'=>$areasL,'empty'=>"")); ?></div>
	</div>

	<?php echo $this->Form->end();?>
</div>
<center>
	<div style="width:97% !important">
	    <table id="tabla_id">
			<thead>
				<tr>
					<th></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
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
					<th>Remesa</th>
					<th>Cliente CC</th>
					<th>Cliente Nombre</th>
					<th>Remitente CC</th>
					<th>Remitente Nombre</th>
					<th>Doc. Ref1</th>
					<th>Conductor CC</th>
					<th>Conductor Nombre</th>
					<th>Placa</th>
					<th>Origen</th>
					<th>Destino</th>
					<th>Destinatario CC</th>
					<th>Destinatario Nombre</th>
					<th>Cantidad</th>
					<th>Empaque</th>
					<th>Estado</th>
					<th># Recibo</th>
					<th>Vlr Flete</th>
					<th>Vlr Seguro</th>
					<th>Fecha Registro</th>
					<th>Fecha Despacho</th>
					<th>Fecha Confirmo</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	<div>
</center>

<script>
	var areas    = <?php echo json_encode($areas); ?>;
	var conducA  = <?php echo json_encode($conducA); ?>;
	var destinos = <?php echo json_encode($destinos); ?>;
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."ventas'"; ?>;
	var countUni = 0;
	var countFle = 0;
	var countSeg = 0;
	var countTot = 0;
	var oTable ;

	$.fn.dataTableExt.afnFiltering.push(
		function (settings, data, index) {
			if($("#VentaDestino").val() != ""){
				var dest = JSON.parse(areas[$("#VentaDestino").val()]);
				var flag;
				flag = true;
				$.each(dest,function(key,value){
					if(data[10] == destinos[value]){
						flag = false;
					}
				});
				if(flag){
					return false;
				}
			}
			if($("#VentaOrigen").val() != ""){
				var dest = JSON.parse(areas[$("#VentaOrigen").val()]);
				var flag;
				flag = true;
				$.each(dest,function(key,value){
					if(data[9] == destinos[value]){
						flag = false;
					}
				});
				if(flag){
					return false;
				}
			}
			return true;
		}
	);

$(document).ready(function(){
	$("#btn-limpiar").after('<button type="button" id="descargar" style="margin-left:4px;" class="btn btn-success"><span class="glyphicon glyphicon-cloud-download" style="margin:0px 5px 0px 0px;"></span>Descargar</button>\
							<button type="button" id="imprimir" class="btn btn-info"><span class="glyphicon glyphicon-print" style="margin:0px 5px 0px 0px;"></span>Imprimir</button>');

	$("#descargar").click(function(){
		var infoTable   = oTable._('tr', {"filter": "applied"});
		var columnArray = new Array();
		$.each(oTable.fnSettings().aoColumns, function( key, value ) {
			columnArray.push(value.sTitle);
		});
		infoTable.unshift(columnArray);
		$("#VentaInforme").val(JSON.stringify(infoTable));
		$.fancybox.showLoading();
		$.fancybox.helpers.overlay.open();
		$.ajax({
			method : "POST",
			url: url+"/downMovNatural",
			data: $("#VentaMovNaturalForm").serializeArray(),
			success: function(response) {
				document.location.href="../informes/"+response;
				$.fancybox.hideLoading();
				$.fancybox.helpers.overlay.close();
			}
		}); 
	});
	$("#imprimir").click(function(){
		var infoTable   = oTable._('tr', {"filter": "applied"});
		var columnArray = new Array();
		$.each(oTable.fnSettings().aoColumns, function( key, value ) {
			columnArray.push(value.sTitle);
		});
		infoTable.unshift(columnArray);
		$("#VentaInforme").val(JSON.stringify(infoTable));
		$.ajax({
			type: "POST",
			cache: false,
			url: url+"/printMovNatural",
			data: $("#VentaMovNaturalForm").serializeArray(),
			success: function (data) {
				$.fancybox(data, {
				    padding : 5,
					width : "1000",
					height: "700",
				    openEffect: 'none',
				    closeEffect: 'none'
				});
			}
		}); 
	});

	$("#VentaDesde").datepicker();
	$("#VentaHasta").datepicker();
	$("#VentaConducT").change(function(){
		var sel = $(this).val();
		if(sel == ""){
			oTable.fnFilter("",8);
			$("#VentaTelefono").val("");
			$("#VentaDireccion").val("");
		} else {
			$.each(conducA, function( key, value ) {
				if(value.Conductor.id == sel){
					$("#VentaTelefono").val(value.Conductor.telefono);
					$("#VentaDireccion").val(value.Conductor.direccion);
				}
			});
			oTable.fnFilter($("#VentaConducT option:selected").text(), 8);
		}
		$("#VentaConducD").val(sel);
		$("#VentaConducD").trigger("chosen:updated");
	});
	$("#VentaConducD").change(function(){
		var sel = $(this).val();
		if(sel == ""){
			oTable.fnFilter("",7);
			$("#VentaTelefono").val("");
			$("#VentaDireccion").val("");
		} else {
			$.each(conducA, function( key, value ) {
				if(value.Conductor.id == sel){
					$("#VentaTelefono").val(value.Conductor.telefono);
					$("#VentaDireccion").val(value.Conductor.direccion);
				}
			});
			oTable.fnFilter($("#VentaConducD option:selected").text(), 7);
		}
		$("#VentaConducT").val(sel);
		$("#VentaConducT").trigger("chosen:updated");
	});

	$("#VentaConducT").chosen({
		no_results_text           : 'No se encuentra el cliente.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione"
	});
	$("#VentaConducD").chosen({
		no_results_text           : 'No se encuentra.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione"
	});

	$("#VentaTipo").change(function(){
		oTable.fnFilter($("#VentaTipo option:selected").text(), 17);
	});

	$("#VentaDestino").change(function(){
		oTable.fnFilter("", 25);
	});
	$("#VentaOrigen").change(function(){
		oTable.fnFilter("", 25);
	});
	oTable = $('#tabla_id').dataTable( {
		"sDom": "R<'clear'><'H'lfr>t<'F'ip>",
		"sAjaxSource": webroot+'sources/mov_conductor.txt',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage":
			{
				"sProcessing":   "Procesando...",
				"sLengthMenu":   "Ver _MENU_ registros",
				"sZeroRecords":  "No se encontraron resultados",
				"sInfo":         "<span class='btnTable'>Total Remesas: _END_</span>\
								  <span class='btnTable'>Total Unidades:<span id='countUni'>0</span></span>\
								  <span class='btnTable'>Total Flete: $<span id='countFle'>0</span></span>\
								  <span class='btnTable'>Total Vlr Seguro: $<span id='countSeg'>0</span></span>\
								  <span class='btnTable'>Total Suma: $<span id='countTot'>0</span></span>",
				"sInfoEmpty":    "",
				"sInfoFiltered": "",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",
		    },
		"fnDrawCallback": function( oSettings ) {
			$("#countUni").text(countUni.formatMoney(0,',','.'));
			$("#countFle").text(countFle.formatMoney(0,',','.'));
			$("#countSeg").text(countSeg.formatMoney(0,',','.'));
			$("#countTot").text((countFle+countSeg).formatMoney(0,',','.'));
			countUni = 0;
			countFle = 0;
			countSeg = 0;
			countTot = 0;
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			var remesaIndex = $(nRow).find('td');
			var index       = -1;
			var remesaText  = "";
			$.each(remesaIndex, function( key, value ) {
				if($(value).hasClass('remesaClass')){
					index = key;
					remesaText = $(value).text();
				}
				if($(value).hasClass('unidadClass')){
					countUni = countUni + parseFloat($(value).text());
				}
				if($(value).hasClass('fleteClass')){
					countFle = countFle + parseFloat($(value).text());
				}
				if($(value).hasClass('seguroClass')){
					countSeg = countSeg + parseFloat($(value).text());
				}
			});
			if(index == 0){
				html = '<a class="btn btn-info" target="_blank" style="padding:0px;" title="Trazabilidad" href="'+url+'/trazabilidad/'+aData[0]+'">'+remesaText+'</a>';
				$('td:eq(0)', nRow).html(html);
			}
			return nRow;
		},
		"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
		"iDisplayLength": -1,
		"sScrollX": "100%",
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "sWidth": "50px", "aTargets": [1,11,12,13] },
			{ "sWidth": "100px", "aTargets": [2,4,6,14,15,16,17,18,19,20,21] },
			{ "sWidth": "150px", "aTargets": [3,5,7,8,9,10] },
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0] },
			{ "sClass": "remesaClass", "aTargets": [1] },
			{ "sClass": "unidadClass", "aTargets": [14] },
			{ "sClass": "fleteClass", "aTargets": [18] },
			{ "sClass": "seguroClass", "aTargets": [19] }
		],
		"oColReorder": {
            "iFixedColumns": 1
        }
	});

	var asInitVals = new Array();

	$("thead input").keyup( function (){
		oTable.fnFilter(this.value, $("thead input").index(this)+1 );
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
			this.value     = asInitVals[$("thead input").index(this)+1];
		}
	});

	});
</script>