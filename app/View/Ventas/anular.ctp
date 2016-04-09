<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
	echo $this->Html->script('jquery.fancybox.pack');
	echo $this->Html->css('jquery.fancybox');
?>
<div class="row" style="width:90%; margin-left:5%;">
	<br>
	<?php echo $this->Form->create('Venta',array('class'=>'form-inline','onsubmit' => 'return itsclicked;'));?>
		<div><h3><center>ANULAR GUIA</center></h3></div>
		<div class="form-group col-md-12">
			<div class="col-md-12"><?php echo $this->Form->input('razon_anula',array('label'=>'Observaciones: ','type'=>'text')); ?></div>
		</div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>Remesa</th>
					<th>Destinatario</th>
					<th>Cliente</th>
					<th>Origen</th>
					<th>Destino</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	<?php echo $this->Form->end();?>
	<br>
</div>

<script>
	var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url     = <?php echo "'".Router::url('/')."ventas/'"; ?>;
	var guias   = <?php echo json_encode($guias); ?>;

$(document).ready(function(){

	$("#VentaGuia").chosen({
		no_results_text           : 'No se encuentra la guia.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione la guia"
	});


	var oTable = $('#tabla_id').dataTable( {
		"sAjaxSource": webroot+'sources/guias_anula.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
        "bScrollCollapse": true,
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
			"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<a target="_blank" class="linkTrazabilidad btn btn-info" style="padding:0px;" title="Trazabilidad" href="'+url+'trazabilidad/'+aData[0]+'">'+aData[1]+'</a></nav>';
			$('td:eq(0)', nRow).html(html);
			var razon = $("#VentaRazonAnula").val();
			html = '<a class="linkAnular btn btn-warning" style="padding:0px;" title="Anular" href="'+url+'anular/'+aData[0]+'/'+razon+'">'+"Anular"+'</a></nav>';
			$('td:eq(5)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		"bJQueryUI": true,
		"aoColumns": [
			{ "sWidth": "0%" },
			{ "sWidth": "5%" },
			{ "sWidth": "27%" },
			{ "sWidth": "28%" },
			{ "sWidth": "15%" },
			{ "sWidth": "15%" },
			{ "sWidth": "10%" }
		],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0 ] },
			{ "bSearchable": false, "aTargets": [ 0 ] },
			{ "bSortable": false, "aTargets": [0,6] },
			{ "sClass": "col-actions", "aTargets": [3] }
		]
	});



})
</script>