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

<div id="contenedor-relaciones">

<style type="text/css">
	.leftTd{
		text-align: left;
	}
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
	cursor: pointer;
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
	<div class="row" style="width:90%;">
	<br>
	<?php $estados = array('PENDIENTE','FACTURADO'); ?>
	<?php echo $this->Form->create('Cuenta',array('class'=>'form-inline'));?>
		<div><h3><center>LISTA DE RELACIONES</center></h3></div>
		<?php echo $this->Form->create('Venta',array('class'=>'form-inline'));?>
		<?php echo $this->Form->input('imprimir',array('type'=>'hidden','default'=>"")); ?>
		<?php echo $this->Form->input('informe',array('type'=>'hidden')); ?>
		</div>

		<div class="table-responsive" style="width:97%;  !important">
		<table id="tabla_id">
				<thead>
					<tr>
				
				<th class="col-actions ui-state-focus" style="padding-right:5px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('NRO RELACION'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:20px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('CLIENTE'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:5px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('FECHA'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:5px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('ESTADO'); ?></th>
					
				 <th class="col-actions ui-state-focus" style="padding-right:5px;"><?php echo __('ACCIONES'); ?></th>
				<tbody>

		<?php foreach ($relacionfacturas as $relacionfactura): ?>
		<tr>
			<td class="active"><?php echo h($relacionfactura['Relacionfactura']['dni']); ?>&nbsp;</td>
			<td class="active"><?php echo h($relacionfactura['Cliente']['listNombre']); ?>&nbsp;</td>
			<td class="active"><?php echo h($relacionfactura['Relacionfactura']['fecha']); ?>&nbsp;</td>
			<td class="active"><?php echo $estados[$relacionfactura['Relacionfactura']['estado']]; ?>&nbsp;</td>
			
			
			<td class="actions">
				<?php echo $this->Html->link(__(''), array('controller' => 'relacionfacturas', 'action' => 'ver', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-list-alt')); ?>
				<?php echo $this->Html->link(__(''), array('controller' =>'ventas', 'action' => 'reimprimir_relacion', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-print','target'=>'_blank')); ?>
				 <?php echo $this->Html->link(__(''), array('action' => 'edit', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-pencil')); ?> 
				<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $relacionfactura['Relacionfactura']['id']), array('class' => 'glyphicon glyphicon-trash')) ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tr>
				</thead>
				<tbody style="text-align:center">
				</tbody>
			</table>
		</div>
	</div>
		<?php echo $this->Form->end();?>

	<br>
</div>

		
	<?php echo $this->Js->writeBuffer(); ?>
</div> 


<script>
var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
var url     = <?php echo "'".Router::url('/')."facturas'"; ?>;
var oTable;
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
	oTable = $('#tabla_id').dataTable( {
		//"sAjaxSource": webroot+'sources/facturas.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sScrollX": "100%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
		"sPaginationType": "full_numbers", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
//		"iDisplayLength": 10,
		"bJQueryUI": true,
		"aoColumnDefs": [
			{ "bSortable": false, "aTargets": [0,1,2,3,4] },
			{ "sClass": "leftTd", "aTargets": [1] }
		],
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "15%"},
	        { "sWidth": "60%"},
	        { "sWidth": "20%"},
	        { "sWidth": "5%"}
	    ],
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