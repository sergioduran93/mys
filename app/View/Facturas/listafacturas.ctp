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
<?php
   $this->Paginator->options(array(
      'update' => '#contenedor-facturas',
      'before' => $this->Js->get("#procesando")->effect('fadeIn', array('buffer' => false)),
      'complete' => $this->Js->get("#procesando")->effect('fadeOut', array('buffer' => false))
   ));
?>

<div id="contenedor-facturas">

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

				<div class="table-responsive" style="width:90%; ">   
	<br>
	<div><h3><center>LISTA DE FACTURAS</center></h3></div>
    <fieldset>
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline'));?>
	<?php echo $this->Form->input('imprimir',array('type'=>'hidden','default'=>"")); ?>
	<?php echo $this->Form->input('informe',array('type'=>'hidden')); ?>

		
	</div>

	<div class="table-responsive" style="width:97%;  !important">
		<table class="table table-bordered table-striped">
		<thead>
		<tr>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('NRO FACTURA'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('NRO RELACION'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('CLIENTE'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('FECHA'); ?></th>
				<th class="col-actions ui-state-focus" style="padding-right:13px;"><input class="search_init" type="text" placeholder="Buscar"><?php echo $this->Paginator->sort('VALOR'); ?></th>
				
				 <th class="col-actions ui-state-focus" style="padding-right:5px;"><?php echo __('ACCIONES'); ?></th>
				<tbody>
		<?php foreach ($facturas as $factura): ?>
		<tr>
			<td class="active"><?php echo h($factura['Factura']['id']); ?>&nbsp;</td>
			<td class="active"><?php echo h($factura['Factura']['relacionfactura_id']); ?>&nbsp;</td>
			<td class="active"><?php echo h($factura['Factura']['cliente_nom']); ?>&nbsp;</td>
			<td class="active"><?php echo h($factura['Factura']['fecha']); ?>&nbsp;</td>
			<td class="active"><?php echo h($factura['Factura']['valor']); ?>&nbsp;</td>
			
			
			<td class="actions">
			<?php echo $this->Html->link(__(''), array('controller' => 'facturas', 'action' => 'ver', $factura['Factura']['id']), array('class' => 'glyphicon glyphicon-list-alt')); ?>
				<?php echo $this->Html->link(__(''), array('action' => 'imprimirfacturarel', $factura['Factura']['id']), array('class' => 'glyphicon glyphicon-print')); ?>
				 <?php echo $this->Html->link(__(''), array('action' => 'edit', $mesero['Mesero']['id']), array('class' => 'glyphicon glyphicon-pencil')); ?> 
				<?php echo $this->Form->postLink(__(''), array('action' => 'delete', $factura['Factura']['id']), array('class' => 'glyphicon glyphicon-trash')) ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</tr>
		</thead>

		
		</tbody>
		</table>
			<div>
		</center>

<br>

 <!-- BOTONES IMPRIMIR -->

</div>
<p><?php
		echo $this->Paginator->counter(array(
		'format' => __('Pagina {:page} de {:pages}, {:count} Facturas en Total')
		));
		?>	</p>
		<ul class="pagination">
			<li> <?php echo $this->Paginator->prev('<< ' . __('Atras'), array('tag' => false), null, array('class' => 'prev disabled btn-primary')); ?> </li>
			<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
			<li> <?php echo $this->Paginator->next(__('Siguiente') . ' >>', array('tag' => false), null, array('class' => 'next disabled btn-primary')); ?> </li>
		</ul>
	<?php echo $this->Js->writeBuffer(); ?>
</div> 

</div>
<script>
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."facturas'"; ?>;
	var oTable ;


$(document).ready(function(){
	$("#").chosen({
		no_results_text           : 'No se encuentra el cliente.',
		width                     : "195%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione el cliente"
	});

	$("#imprimir").click(function(){
		var infoTable   = oTable._('tr', {"filter": "applied"});
		var columnArray = new Array();
		$.each(oTable.fnSettings().aoColumns, function( key, value ) {
			columnArray.push(value.sTitle);
		});
		infoTable.unshift(columnArray);
		$("").val(JSON.stringify(infoTable));
		$.ajax({
			type: "POST",
			cache: false,
			url: url+"/",
			data: $("#").serializeArray(),
			success: function (data) {
				$.fancybox(data, {
				    padding : 5,
					width : "700",
					height: "700",
				    openEffect: 'none',
				    closeEffect: 'none'
				});
			}
		}); 
	});

	// ACA no estaba VentaRelacionfacturasFrom estaba otro.... y tenias una variable Informe
	$("#btn-imprimir").click(function(){
		$("#VentaImprimir").val("SI");
		$("#").submit();
	});
	$("#").datepicker();
	$("#").datepicker();
	$("#").chosen({
		no_results_text           : 'No se encuentra el representante.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione"
	});
	$("#").chosen({
		no_results_text           : 'No se encuentra el filtro.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_multiple : "Seleccione"
	});

	$("#").change(function(){
		oTable.fnDraw();
	});

	var countTot = 0;
	oTable = $('#tabla_id').dataTable( {
		"sDom": "R<'clear'><'H'lfr>t<'F'ip>",
		"sAjaxSource": webroot+'sources/relacionfacturas.txt',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage":
			{
				"sProcessing":   "Procesando...",
				"sLengthMenu":   "Ver _MENU_ registros",
				"sZeroRecords":  "No se encontraron resultados",
				"sInfo":         "<span class='btnTable'>Total Registros: _END_</span>",	  
				"sInfoEmpty":    "",
				"sInfoFiltered": "",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",
		    },
		
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			var filas = $(nRow).find('td');
			$.each(filas, function( key, value ) {
				if($(value).hasClass('valor_totalClass')){
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
			{ "sClass": "valor_totalClass", "aTargets": [3] }
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


			<div>
		</center>

<br>

 <!-- BOTONES IMPRIMIR -->

</div>

</div>
<script>
	var webroot  = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url      = <?php echo "'".Router::url('/')."facturas'"; ?>;
	var oTable ;


$(document).ready(function(){
	$("#").chosen({
		no_results_text           : 'No se encuentra el cliente.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione el cliente"
	});

	$("#imprimir").click(function(){
		var infoTable   = oTable._('tr', {"filter": "applied"});
		var columnArray = new Array();
		$.each(oTable.fnSettings().aoColumns, function( key, value ) {
			columnArray.push(value.sTitle);
		});
		infoTable.unshift(columnArray);
		$("").val(JSON.stringify(infoTable));
		$.ajax({
			type: "POST",
			cache: false,
			url: url+"/",
			data: $("#").serializeArray(),
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

	// ACA no estaba VentaRelacionfacturasFrom estaba otro.... y tenias una variable Informe
	$("#btn-imprimir").click(function(){
		$("#VentaImprimir").val("SI");
		$("#").submit();
	});
	$("#").datepicker();
	$("#").datepicker();
	$("#").chosen({
		no_results_text           : 'No se encuentra el representante.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione"
	});
	$("#").chosen({
		no_results_text           : 'No se encuentra el filtro.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_multiple : "Seleccione"
	});

	$("#").change(function(){
		oTable.fnDraw();
	});

	var countTot = 0;
	oTable = $('#tabla_id').dataTable( {
		"sDom": "R<'clear'><'H'lfr>t<'F'ip>",
		"sAjaxSource": webroot+'sources/relacionfacturas.txt',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage":
			{
				"sProcessing":   "Procesando...",
				"sLengthMenu":   "Ver _MENU_ registros",
				"sZeroRecords":  "No se encontraron resultados",
				"sInfo":         "<span class='btnTable'>Total Registros: _END_</span>",
								  
				"sInfoEmpty":    "",
				"sInfoFiltered": "",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",
		    },
		
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			var filas = $(nRow).find('td');
			$.each(filas, function( key, value ) {
				if($(value).hasClass('valor_totalClass')){
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
			{ "sClass": "valor_totalClass", "aTargets": [3] }
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
</div>
