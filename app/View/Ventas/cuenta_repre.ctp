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
	<div><h3><center>CUENTA REPRESENTANTES</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('imprimir',array('type'=>'hidden','default'=>"")); ?>
	<?php echo $this->Form->input('informe',array('type'=>'hidden')); ?>
	<div class="form-group col-md-12">
		<div class="col-md-3"><?php echo $this->Form->input('desde',array('label'=>'Desde: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$desde)); ?></div>
		<div class="col-md-3"><?php echo $this->Form->input('hasta',array('label'=>'Hasta: ','type'=>'text','placeholder'=>'AAAA-MM-DD','default'=>$hasta)); ?></div>
		<div class="col-md-2">
			<?php echo $this->Form->button("Consultar",array("class"=>'btn btn-primary',"style"=>'margin-top: 20px','onmousedown'=>'itsclicked = true; return true;','onkeydown' =>'itsclicked = true; return true;'));?>
		</div>
	</div>
	<div class="form-group col-md-12">
		<div class="col-md-6"><?php echo $this->Form->input('representante',array('label'=>'Representante: ','type'=>'select','options'=>$representantes,'empty'=>"")); ?></div>

		<div class="col-md-6"><?php echo $this->Form->input('filtro',array('label'=>'Filtro: ','type'=>'select','multiple'=>true,'options'=>array('COMISIÓN X ENTREGA'=>'COMISIÓN X ENTREGA','DIGITAR ENTREGA'=>'DIGITAR ENTREGA','ESCANEAR'=>'ESCANEAR','DIGITAR'=>'DIGITAR','DIGITAR COBRO'=>'DIGITAR COBRO','FLETES PAGADOS'=>'FLETES PAGADOS'),'empty'=>"")); ?></div>
	</div>

	<?php echo $this->Form->end();?>
</div>
<center>
	<div style="width:97% !important">
	    <table id="tabla_id">
			<thead>
				<tr>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
					<th class="col-actions ui-state-default" style="padding-right:10px;"><input class="search_init" type="text" placeholder="Buscar"></th>
				</tr>
				<tr>
					<th>Tipo</th>
					<th>Doc Ref1</th>
					<th>Fecha</th>
					<th>Saldo</th>
					<th>Concepto</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	<div>
</center>

<br>
<button type="button" id="btn-imprimir" class="btn btn-primary btn-block">IMPRIMIR</button>
	<?php echo $this->Form->end();?>
</br>

</div>
<script>
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."ventas'"; ?>;
	var oTable ;


$(document).ready(function(){

	$.fn.dataTableExt.afnFiltering.push(
		function (settings, data, index) {
			var filtros = $("#VentaFiltro").val();
			if(filtros != null){
				var flag = true;
				for (var j = 0; j < filtros.length; j++) {
					for (var i=0; i < data.length; i++) {
						if(data[4] == filtros[j] && flag){
							flag = false;
						}
					}
				}
				if(!flag){
					return true;
				} else {
					return false;
				}
			} else {
				return true;
			}
		}
	);
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
			url: url+"/printDespachoRepre",
			data: $("#VentaDespachoRepreForm").serializeArray(),
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


	$("#btn-imprimir").click(function(){
		$("#VentaImprimir").val("SI");
		$("#VentaCuentaRepreForm").submit();
	});
	$("#VentaDesde").datepicker();
	$("#VentaHasta").datepicker();
	$("#VentaRepresentante").chosen({
		no_results_text           : 'No se encuentra el representante.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione"
	});
	$("#VentaFiltro").chosen({
		no_results_text           : 'No se encuentra el filtro.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_multiple : "Seleccione"
	});

	$("#VentaFiltro").change(function(){
		oTable.fnDraw();
	});

	var countTot = 0;
	oTable = $('#tabla_id').dataTable( {
		"sDom": "R<'clear'><'H'lfr>t<'F'ip>",
		"sAjaxSource": webroot+'sources/cuenta_repre.txt',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage":
			{
				"sProcessing":   "Procesando...",
				"sLengthMenu":   "Ver _MENU_ registros",
				"sZeroRecords":  "No se encontraron resultados",
				"sInfo":         "<span class='btnTable'>Total Registros: _END_</span>\
								  <span class='btnTable'>Total Suma: $<span id='countTot'>0</span></span>",
				"sInfoEmpty":    "",
				"sInfoFiltered": "",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",
		    },
		"fnDrawCallback": function( oSettings ) {
			$("#countTot").text(countTot.formatMoney(0,',','.'));
			countTot = 0;
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			var filas = $(nRow).find('td');
			$.each(filas, function( key, value ) {
				if($(value).hasClass('saldoClass')){
					countTot = countTot + parseFloat($(value).text());
				}
			});
			return nRow;
		},
		"aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
		"iDisplayLength": 25,
		"sScrollX": "100%",
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "sClass": "saldoClass", "aTargets": [3] }
		],
		"oColReorder": {
            "iFixedColumns": 1
        }
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

	});
</script>