<?php
	echo $this->Html->css('prism');
	echo $this->Html->css('chosen');
	echo $this->Html->script('chosen.jquery');
?>

<div class="row" style="width:90%; margin-left:5%;">
	<br>	
	<?php echo $this->Form->create('Despacho',array('class'=>'form-inline'));?>
		<div><h3><center>DESPACHO VIRTUAL</center></h3></div>
		<?php echo $this->Form->input('id',array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('usuario',array('type'=>'hidden','default'=>$usuario_actual['id'])); ?>
	    <div class="form-group col-md-12">
       		<div class="col-md-12"><?php echo $this->Form->input('areas',array('label'=>'Filtro (Areas): ','type'=>'select','options'=>$areasL,'empty'=>"")); ?></div>
		</div>
		<table cellpadding="0" cellspacing="0" border="0" class="" id="tabla_id">
			<thead>
				<tr>
					<th>id</th>
					<th>origen</th>
					<th>destino</th>
					<th>Remesa</th>
					<th>Destinatario</th>
					<th>Cliente</th>
					<th>Origen</th>
					<th>Destino</th>
					<th>Cantidad</th>
					<th>Empaque</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>

	<?php echo $this->Form->button("Guardar",array("class"=>'btn btn-primary',"style"=>'float:right;margin-bottom: 15px;'));?>
	<?php echo $this->Form->end();?>
	<br>
</div>




<script>
	var webroot = <?php echo "'".Router::url('/')."app/webroot/'"; ?>;
	var url     = <?php echo "'".Router::url('/')."despachos'"; ?>;
	var areas   = <?php echo json_encode($areas); ?>;
	var oTable;
	var dest = new Array();

$("#DespachoAreas").change(function(){
		areaId = $(this).val();
		if(areaId == ""){
			oTable.fnFilter("");
		} else {
			$.each( areas, function( key, value ) {
				if(areaId == value.Area.id){
					dest = value.Area.destinos;
				}
			});
		}
	});

	$.fn.dataTableExt.afnFiltering.push(
		function (settings, data, index) {
			var areaId = $("#DespachoAreas").val();
			if(areaId != ""){
				for (var i=0; i < data.length; i++) {
					if(dest.length > 0){
						for (var j=0; j < dest.length; j++) {
						for (var k=0; k < dest.length; k++) {
							if ((data[0] == dest[i] && data[1] == dest[j]) || (data[0] == dest[k] && data[1] == dest[k])){
								return true;
							}
						}
						}
					} else {
						return true;
					}
				}
			} else {
				return true;
			}
			return false;
		}
	);
$(document).ready(function(){
	$("#DespachoAreas").chosen({
		no_results_text           : 'No se encuentra el area.',
		width                     : "95%",
		allow_single_deselect     : true, 
		search_contains           : true,
		disable_search_threshold  : 0,
		placeholder_text_single   : "Seleccione la area"
	});

	$("#DespachoAreas").change(function(){
		areaId = $(this).val();
		if(areaId != ""){
			$.each( areas, function( key, value ) {
				if(areaId == value.Area.id){
					dest = value.Area.destinos;
				}
			});
		}
		oTable.fnFilter("");
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
		"sAjaxSource": webroot+'sources/ventas_virtual.txt',
		"sDom": '<"H"<"toolbar">lfr>t<"F"ip>',
		"sPaginationType": "two_button", // full_numbers (Paginas) two_button (Sin Paginas)
		"oLanguage": {
		"sUrl": webroot + 'files/es.txt'
		},
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
			html = '<input type="checkbox" name="data[Despacho][virtual][]" value="'+aData[0]+'" style="height:20px;width:20px;">';
			jQuery('td:eq(7)', nRow).html(html);
			return nRow;
		},
		"bFilter": true,
		"bSort": true,
		"bInfo": true,
		"bLengthChange": true,
		//		"iDisplayLength": 10,
		"bJQueryUI": true,		
		"bAutoWidth": false,
	    "aoColumns": [
	        { "sWidth": "0%"},
	        { "sWidth": "0%"},
	        { "sWidth": "0%"},
	        { "sWidth": "8%"},
	        { "sWidth": "20%"},
	        { "sWidth": "20%"},
	        { "sWidth": "20%"},
	        { "sWidth": "20%"},
	        { "sWidth": "8%"},
	        { "sWidth": "8%"},
	        { "sWidth": "2%"}
	    ],
		"aoColumnDefs": [
			{ "bVisible": false, "aTargets": [ 0,1,2 ] },
			{ "bSearchable": false, "aTargets": [ 0 ,10] },
			{ "bSortable": false, "aTargets": [0 ,10] },
			{ "sClass": "col-actions", "aTargets": [2] }
		]
	});


})

</script>