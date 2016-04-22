<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
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
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>MERCANCIA SIN DESPACHAR</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<div class="form-group col-md-12">
			<div class="col-md-6"><?php echo $this->Form->input('oficina',array('label'=>'Oficina: ','type'=>'select','options'=>$oficinas,'empty'=>'')); ?></div>
			<div class="col-md-6"><?php echo $this->Form->input('region',array('label'=>'Region: ','type'=>'select','options'=>$regiones,'order'=>'Regiones.nombre', 'empty'=>'')); ?></div>
		</div>
		<div class="form-group col-md-12">
			<div class="col-md-12"><?php echo $this->Form->input('observaciones',array('label'=>'Observaciones: ','type'=>'text')); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>oficina</th>
					<th>region</th>
					<th>Remesa</th>
					<th>Destinatario</th>
					<th>Cliente</th>
					<th>Origen</th>
					<th>Destino</th>
					<th>Cantidad</th>
					<th>Empaque</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

		</div>
	<?php echo $this->Form->end();?>
	<br>
</div>

<script>
	var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url     = <?php echo "'".Router::url('/')."ventas'"; ?>;

$(document).ready(function(){
	$("#VentaRegion").chosen({
		no_results_text           : 'No se encuentra la región.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione la región"
	});
	$("#VentaOficina").chosen({
		no_results_text           : 'No se encuentra la oficina.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione la oficina"
	});
	//$('#VentaRegion').tooltip({'trigger':'focus', 'title': 'Filtro por región'});
	$("#VentaOficina").change(function(){
		var oficinaId = $(this).val();
		oTable.fnFilter(oficinaId,1);
	});
	$("#VentaRegion").change(function(){
		var regionId = $(this).val();
		oTable.fnFilter(regionId,2);
	});
	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/sin_despachar.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a class="linkTrazabilidad btn btn-info" style="padding:0px;" title="Trazabilidad" href="'+url+'/trazabilidad/'+aData[0]+'">'+aData[3]+'</a></nav>';
			$('td:eq(0)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumns": [
			{ "sWidth": "0%" },
			{ "sWidth": "0%" },
			{ "sWidth": "0%" },
			{ "sWidth": "5%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "2%" },
			{ "sWidth": "2%" }
		],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0,1,2 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});

})
</script>